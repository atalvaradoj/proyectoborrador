<?php

file_put_contents('debug.log', 'Solicitud recibida: ' . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents('debug.log', 'GET: ' . print_r($_GET, true) . "\n", FILE_APPEND);


// controllers/get_student.php
header('Content-Type: application/json');

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de configuración de la base de datos
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    $studentId = $input['studentId'];

    $conn = getConnection();
    if ($conn) {
        $sql = "SELECT * FROM estudiantes WHERE ID_estudiante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            echo json_encode(['success' => true, 'student' => $student]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Estudiante no encontrado.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}

// Verificar si se recibió un ID de estudiante
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de estudiante no proporcionado']);
    exit;
}

// Obtener ID del estudiante
$id_estudiante = $_GET['id'];

// Obtener conexión a la base de datos
$conn = getConnection();

// Verificar conexión
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

try {
    // Preparar consulta SQL para obtener datos del estudiante
    $sql = "SELECT * FROM estudiantes WHERE ID_estudiante = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    
    // Vincular parámetros
    $stmt->bind_param("s", $id_estudiante);
    
    // Ejecutar consulta
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
    
    // Obtener resultados
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No se encontró el estudiante con ID: ' . $id_estudiante]);
        exit;
    }
    
    // Obtener datos del estudiante
    $student = $result->fetch_assoc();
    
    // Determinar la URL de la foto
    $photo_url = !empty($student['Foto']) && file_exists("../" . $student['Foto'])
        ? $student['Foto']
        : 'img/sombrero-de-graduacion.png';
    
    $student['photo_url'] = $photo_url;
    
    // Devolver datos del estudiante
    echo json_encode(['success' => true, 'data' => $student]);
    
    // Cerrar statement
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    // Cerrar conexión
    if (isset($conn)) {
        $conn->close();
    }
}
