<?php
require_once "../includes/db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_estudiante = $_POST['ID_estudiante'];
    $ID_docente = $_POST['ID_docente'];
    $Asignatura = $_POST['Asignatura'];
    $Nota = $_POST['Nota'];
    $Comentarios = $_POST['Comentarios'];

    $conn = getConnection();
    $sql = "INSERT INTO notas (ID_estudiante, ID_docente, Asignatura, Nota, Comentarios) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $ID_estudiante, $ID_docente, $Asignatura, $Nota, $Comentarios);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Nota asignada correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al asignar la nota.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../registro.php#notas");
    exit();
}
?>