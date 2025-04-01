<?php
require 'vendor/autoload.php'; // Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Conectar a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si tienes otro usuario
$password = "";      // Cambia esto si tienes contraseña en MySQL
$dbname = "sistema_academico"; // Cambia al nombre de tu BD

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar datos del formulario
if (empty($_POST["nombre"]) || empty($_POST["correo"]) || empty($_POST["telefono"])) {
    die("Error: Todos los campos son obligatorios.");
}

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];

// Generar una contraseña aleatoria y encriptarla
$contrasena = substr(md5(uniqid(mt_rand(), true)), 0, 10); // 10 caracteres aleatorios
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Insertar usuario en la base de datos
$sql = "INSERT INTO usuarios (nombre, correo, telefono, contrasena) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $correo, $telefono, $contrasena_hash);

if ($stmt->execute()) {
    echo "Registro exitoso. Se enviará un correo con la contraseña.";

    // Enviar correo con la contraseña generada
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
        $mail->Body = "Hola $nombre,\n\nTu cuenta ha sido creada con éxito. Aquí está tu contraseña:\n\n$contrasena\n\nPor favor, cámbiala después de iniciar sesión.";

        $mail->send();
        echo "Correo enviado correctamente.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
