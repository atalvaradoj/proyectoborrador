<?php
require_once 'db_connection.php';

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener ID del estudiante a eliminar
    $id_estudiante = $_POST['studentId'];
    
    // Obtener información de la foto antes de eliminar
    $sql_foto = "SELECT Foto FROM estudiantes WHERE ID_estudiante = ?";
    $stmt_foto = $conn->prepare($sql_foto);
    $stmt_foto->bind_param("s", $id_estudiante);
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();
    
    if ($result_foto->num_rows > 0) {
        $row = $result_foto->fetch_assoc();
        $foto_path = $row['Foto'];
    }
    
    $stmt_foto->close();
    
    // Preparar consulta SQL para eliminar
    $sql = "DELETE FROM estudiantes WHERE ID_estudiante = ?";
    
    // Preparar statement
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("s", $id_estudiante);
    
    // Ejecutar consulta
    if ($stmt->execute()) {
        // Eliminar foto si existe
        if (!empty($foto_path) && file_exists($foto_path)) {
            unlink($foto_path);
        }
        
        echo json_encode(['success' => true, 'message' => 'Estudiante eliminado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar estudiante: ' . $stmt->error]);
    }
    
    // Cerrar statement
    $stmt->close();
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

// Cerrar conexión
$conn->close();
?>
