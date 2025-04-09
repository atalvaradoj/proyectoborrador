<?php
include "../includes/db_config.php";
require 'vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM testimonios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Enviar correo electrónico
        $to = "correo_destinatario@example.com"; // Cambia esto por el correo designado
        $subject = "Eliminación de Testimonio";
        $message = "
            <html>
            <head>
                <title>Eliminación de Testimonio</title>
            </head>
            <body>
                <h2>Se ha eliminado un testimonio</h2>
                <p><strong>ID:</strong> $id</p>
            </body>
            </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@example.com" . "\r\n"; // Cambia esto por un correo válido

        if (mail($to, $subject, $message, $headers)) {
            session_start();
            $_SESSION['success_message'] = "Testimonio eliminado y correo enviado correctamente.";
        } else {
            session_start();
            $_SESSION['error_message'] = "Testimonio eliminado, pero no se pudo enviar el correo.";
        }
    } else {
        session_start();
        $_SESSION['error_message'] = "Error al eliminar el testimonio.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin_testimonios.php");
    exit();
}
?>