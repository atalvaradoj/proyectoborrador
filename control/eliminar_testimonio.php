<?php
session_start();
include "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $conn = getConnection();

    $stmt = $conn->prepare("DELETE FROM testimonios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Testimonio eliminado exitosamente";
    } else {
        $_SESSION['error_message'] = "Error al eliminar el testimonio";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin_testimonios.php");
    exit();
}
