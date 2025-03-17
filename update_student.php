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
    
    // Verificar si se subió una nueva foto
    $foto_path = $_POST['currentPhoto'] ?? '';
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
            
            // Eliminar foto anterior si existe
            if (!empty($_POST['currentPhoto']) && file_exists($_POST['currentPhoto'])) {
                unlink($_POST['currentPhoto']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al subir la foto']);
            exit;
        }
    }
    
    // Preparar consulta SQL
    $sql = "UPDATE estudiantes SET 
            Type_Doc = ?, 
            Fecha_Nac = ?, 
            Nombres = ?, 
            Apellidos = ?, 
            Genero = ?, 
            Correo = ?, 
            Direccion = ?, 
            Ciudad = ?, 
            Grado = ?, 
            Fecha_Ing = ?, 
            Estado = ?, 
            Comentarios = ?, 
            Foto = ? 
            WHERE ID_estudiante = ?";
    
    // Preparar statement
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("ssssssssssssss", 
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
        $foto_path,
        $id_estudiante
    );
    
    // Ejecutar consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estudiante actualizado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar estudiante: ' . $stmt->error]);
    }
    
    // Cerrar statement
    $stmt->close();
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

// Cerrar conexión
$conn->close();
?>
