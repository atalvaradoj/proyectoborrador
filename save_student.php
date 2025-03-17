<?php
require_once 'db_connection.php';

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener datos del formulario
    $id_estudiante = $_POST['studentId'];
    $tipo_documento = $_POST['documentType'];
    $fecha_nacimiento = $_POST['birthDate'];
    $nombres = $_POST['firstName'];
    $apellidos = $_POST['lastName'];
    $genero = $_POST['gender'];
    $correo = $_POST['email'];
    $direccion = $_POST['address'];
    $ciudad = $_POST['city'];
    $grado = $_POST['program']; // Programa académico
    $fecha_ingreso = $_POST['admissionDate'];
    $estado = $_POST['status'];
    $comentarios = $_POST['observations'];
    
    // Manejo de la foto
    $foto_path = "";
    if (isset($_FILES['studentPhoto']) && $_FILES['studentPhoto']['error'] == 0) {
        $upload_dir = 'uploads/';
        
        // Crear directorio si no existe
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Generar nombre único para la foto
        $foto_name = time() . '_' . basename($_FILES['studentPhoto']['name']);
        $foto_path = $upload_dir . $foto_name;
        
        // Mover archivo subido al directorio de destino
        if (move_uploaded_file($_FILES['studentPhoto']['tmp_name'], $foto_path)) {
            // Archivo subido correctamente
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al subir la foto']);
            exit;
        }
    }
    
    // Preparar consulta SQL
    $sql = "INSERT INTO estudiantes (ID_estudiante, Type_Doc, Fecha_Nac, Nombres, Apellidos, Genero, Correo, Direccion, Ciudad, Grado, Fecha_Ing, Estado, Comentarios, Foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Preparar statement
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("ssssssssssssss", 
        $id_estudiante, 
        $tipo_documento, 
        $fecha_nacimiento, 
        $nombres, 
        $apellidos, 
        $genero, 
        $correo, 
        $direccion, 
        $ciudad, 
        $grado, 
        $fecha_ingreso, 
        $estado, 
        $comentarios, 
        $foto_path
    );
    
    // Ejecutar consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estudiante guardado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar estudiante: ' . $stmt->error]);
    }
    
    // Cerrar statement
    $stmt->close();
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

// Cerrar conexión
$conn->close();
?>
