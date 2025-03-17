<?php
require_once 'db_connection.php';

// Verificar si se recibió un ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_estudiante = $_GET['id'];
    
    // Preparar consulta SQL
    $sql = "SELECT * FROM estudiantes WHERE ID_estudiante = ?";
    
    // Preparar statement
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("s", $id_estudiante);
    
    // Ejecutar consulta
    $stmt->execute();
    
    // Obtener resultado
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $student]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Estudiante no encontrado']);
    }
    
    // Cerrar statement
    $stmt->close();
    
} else {
    echo json_encode(['success' => false, 'message' => 'ID de estudiante no proporcionado']);
}

// Cerrar conexión
$conn->close();
?>
