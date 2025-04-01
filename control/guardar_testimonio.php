<?php
session_start();
include "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $testimonio = filter_input(INPUT_POST, 'testimonio', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);

    $conn = getConnection();

    $stmt = $conn->prepare("UPDATE testimonios SET nombre = ?, testimonio = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $testimonio, $estado, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Testimonio actualizado exitosamente";
    } else {
        $_SESSION['error_message'] = "Error al actualizar el testimonio";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin_testimonios.php");
    exit();
}
