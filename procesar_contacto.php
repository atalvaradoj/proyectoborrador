<?php
require 'vendor/autoload.php'; // Cargar PHPMailer

// Verificar si el archivo db_config.php existe antes de incluirlo
if (!file_exists("../includes/db_config.php")) {
    die("Error: El archivo db_config.php no se encuentra en la ruta especificada.");
}
include "../includes/db_config.php"; // Cargar configuración de la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Verificar si la conexión a la base de datos es exitosa
    $conn = getConnection();
    if (!$conn) {
        die("Error: No se pudo conectar a la base de datos. " . mysqli_connect_error());
    }

    // Guardar los datos en la base de datos
    $sql = "INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: No se pudo preparar la consulta. " . $conn->error);
    }
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

    if ($stmt->execute()) {
        // Enviar correo electrónico de confirmación
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'mikirourke09@gmail.com'; // Cambia esto por tu correo
            $mail->Password = 'qzof dkvr reny zezb'; // Cambia esto por tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('no-reply@example.com', 'Formulario de Contacto'); // Cambia esto por un correo válido
            $mail->addAddress($email); // Enviar al correo del usuario
            $mail->addAddress('mikirourke09@gmail.com'); // Enviar al correo designado (administrador)

            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de envío de contacto';
            $mail->Body = "
                <html>
                <head>
                    <title>Confirmación de Contacto</title>
                </head>
                <body>
                    <h2>Gracias por contactarnos, $nombre</h2>
                    <p>Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
                    <p><strong>Detalles del mensaje:</strong></p>
                    <p><strong>Nombre:</strong> $nombre</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Teléfono:</strong> $telefono</p>
                    <p><strong>Mensaje:</strong> $mensaje</p>
                </body>
                </html>
            ";

            $mail->send();

            // Redirigir con mensaje de éxito
            header("Location: apicontactenos.php?status=success");
            exit();
        } catch (Exception $e) {
            // Redirigir con mensaje de error si el correo falla
            header("Location: apicontactenos.php?status=error&message=" . urlencode($mail->ErrorInfo));
            exit();
        }
    } else {
        // Redirigir con mensaje de error si la base de datos falla
        header("Location: apicontactenos.php?status=error&message=" . urlencode($stmt->error));
        exit();
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: apicontactenos.php");
    exit();
}
?>