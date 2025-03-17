<?php
require_once 'db_connection.php';

// Consulta para obtener todos los estudiantes
$sql = "SELECT ID_estudiante, Nombres, Apellidos, Grado, Estado, Foto FROM estudiantes ORDER BY Apellidos, Nombres";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Cerrar conexión
$conn->close();

// Devolver datos en formato JSON si es una solicitud AJAX
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'data' => $students]);
    exit;
}
?>
