<?php
include "../includes/db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $testimonio = $_POST['testimonio'];
    $estado = $_POST['estado'];

    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE testimonios SET nombre = ?, testimonio = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $testimonio, $estado, $id);

    if ($stmt->execute()) {
        // Enviar correo electrónico
        $to = "correo_destinatario@example.com"; // Cambia esto por el correo designado
        $subject = "Actualización de Testimonio";
        $message = "
            <html>
            <head>
                <title>Actualización de Testimonio</title>
            </head>
            <body>
                <h2>Se ha actualizado un testimonio</h2>
                <p><strong>ID:</strong> $id</p>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Testimonio:</strong> $testimonio</p>
                <p><strong>Estado:</strong> $estado</p>
            </body>
            </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@example.com" . "\r\n"; // Cambia esto por un correo válido

        if (mail($to, $subject, $message, $headers)) {
            session_start();
            $_SESSION['success_message'] = "Testimonio actualizado y correo enviado correctamente.";
        } else {
            session_start();
            $_SESSION['error_message'] = "Testimonio actualizado, pero no se pudo enviar el correo.";
        }
    } else {
        session_start();
        $_SESSION['error_message'] = "Error al actualizar el testimonio.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin_testimonios.php");
    exit();
}
?>