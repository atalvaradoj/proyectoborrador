<?php
include "../includes/db_config.php"; // Cargar configuración de la base de datos
require 'vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Configuración del correo
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Cambia esto por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@example.com'; // Cambia esto por tu correo
        $mail->Password = 'tu_contraseña'; // Cambia esto por tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('no-reply@example.com', 'Formulario de Contacto'); // Cambia esto por un correo válido
        $mail->addAddress('correo_destinatario@example.com'); // Cambia esto por el correo designado

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "
            <html>
            <head>
                <title>Nuevo mensaje de contacto</title>
            </head>
            <body>
                <h2>Detalles del mensaje:</h2>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Teléfono:</strong> $telefono</p>
                <p><strong>Mensaje:</strong></p>
                <p>$mensaje</p>
            </body>
            </html>
        ";

        // Enviar el correo
        $mail->send();

        // Redirigir con mensaje de éxito
        header("Location: apicontactenos.php?status=success");
        exit();
    } catch (Exception $e) {
        // Redirigir con mensaje de error
        header("Location: apicontactenos.php?status=error&message=" . urlencode($mail->ErrorInfo));
        exit();
    }
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: apicontactenos.php");
    exit();
}
?>