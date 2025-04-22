<?php
include '../includes/db_config.php';
session_start();
$conn = getConnection();

if (isset($_POST['ID_estudiante'], $_POST['Materia'], $_POST['Nota'], $_POST['Asistencia'])) {
    $ID_estudiante = $_POST['ID_estudiante'];
    $Materia = $_POST['Materia'];
    $Nota = $_POST['Nota'];
    $Asistencia = $_POST['Asistencia'];

    // Validar rango
    if ($Asistencia < 1 || $Asistencia > 100) {
        $_SESSION['error_message'] = "Asistencia debe estar entre 1 y 100.";
        header("Location: ../registro.php#notas");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notas (ID_estudiante, Materia, Nota, Asistencia) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $ID_estudiante, $Materia, $Nota, $Asistencia);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Nota registrada correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al registrar nota: " . $conn->error;
    }
}

header("Location: ../registro.php#notas");
exit;