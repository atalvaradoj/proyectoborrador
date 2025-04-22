<?php
include '../includes/db_config.php';
session_start();
$conn = getConnection();

if (isset($_POST['ID_usuario'], $_POST['ID_estudiante'])) {
    $ID_usuario = $_POST['ID_usuario'];
    $ID_estudiante = $_POST['ID_estudiante'];

    $stmt = $conn->prepare("INSERT INTO padres_estudiantes (ID_usuario, ID_estudiante) VALUES (?, ?)");
    $stmt->bind_param("ss", $ID_usuario, $ID_estudiante);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Asociación registrada con éxito.";
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
    }
}

header("Location: ../registro.php#padreHijo");
exit;
