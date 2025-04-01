<?php
require 'vendor/autoload.php'; // Cargar PHPMailer
require 'shared/db_config.php'; // Incluir la conexión a la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si el formulario fue enviado y si la acción es 'aprobar' o 'rechazar'
if (isset($_POST['id_usuario'], $_POST['accion'])) {

    $id_usuario = $_POST['id_usuario'];
    $accion = $_POST['accion'];  // 'aprobar' o 'rechazar'

    if ($accion == 'rechazar') {
        // Si se rechaza la solicitud, eliminar los datos de la tabla
        $sql = "DELETE FROM usuarios WHERE ID_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_usuario);
        if ($stmt->execute()) {
            echo "Solicitud rechazada y eliminada.";
        } else {
            echo "Error al rechazar la solicitud: " . $stmt->error;
        }

    } elseif ($accion == 'aprobar') {
        // Si se aprueba la solicitud, actualizar el estado, asignar el rol y generar contraseñas

        // Verificar si el rol ha sido enviado
        if (!isset($_POST['rol']) || empty($_POST['rol'])) {
            die("Error: El rol no ha sido seleccionado.");
        }

        $rol = $_POST['rol'];  // El rol seleccionado por el administrador

        // Generar una contraseña aleatoria
        $contrasena = substr(md5(uniqid(mt_rand(), true)), 0, 10); // 10 caracteres aleatorios
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Actualizar el estado de la solicitud, asignar el rol y la contraseña
        $sql = "UPDATE usuarios SET Estado = 'aprobado', Contrasena = ?, Rol = ? WHERE ID_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $contrasena_hash, $rol, $id_usuario);
        
        if ($stmt->execute()) {
            // Enviar correo con la contraseña generada
            // Recuperar el correo del usuario
            $sql_user = "SELECT Nombres, Correo FROM usuarios WHERE ID_usuario = ?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("s", $id_usuario);
            $stmt_user->execute();
            $stmt_user->store_result();
            $stmt_user->bind_result($nombre, $correo);
            $stmt_user->fetch();

            // Enviar el correo solo si el usuario fue encontrado
            if ($stmt_user->num_rows > 0) {
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto si usas otro servidor
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mikirourke09@gmail.com'; // Tu correo
                    $mail->Password = 'qzof dkvr reny zezb'; // Tu contraseña (usa OAuth o App Password si es Gmail)
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Configuración del correo
                    $mail->setFrom('mikirourke09@gmail.com', 'Sistema Académico');
                    $mail->addAddress($correo);
                    $mail->Subject = "Creación de cuenta en el sistema";
                    $mail->Body = "Hola $nombre,\n\nTu cuenta ha sido aprobada y aquí está tu contraseña:\n\n$contrasena\n\nPor favor, cámbiala después de iniciar sesión.";

                    $mail->send();
                    echo "Correo enviado exitosamente con la contraseña.";
                } catch (Exception $e) {
                    echo "Error al enviar el correo: {$mail->ErrorInfo}";
                }
            } else {
                echo "No se encontró el usuario para enviar el correo.";
            }
        } else {
            echo "Error al aprobar la solicitud: " . $stmt->error;
        }
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
