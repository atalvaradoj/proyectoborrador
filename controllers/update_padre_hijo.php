<?php
include '../includes/db_config.php';
session_start();
$conn = getConnection();

if (isset($_POST['ID_estudiante'], $_POST['new_ID_usuario'])) {
    $ID_estudiante = $_POST['ID_estudiante'];
    $new_ID_usuario = $_POST['new_ID_usuario'];

    $stmt = $conn->prepare("UPDATE padres_estudiantes SET ID_usuario = ? WHERE ID_estudiante = ?");
    $stmt->bind_param("ss", $new_ID_usuario, $ID_estudiante);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Asociación actualizada correctamente.";
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
    }
}

header("Location: ../registro.php#padreHijo");
exit;
