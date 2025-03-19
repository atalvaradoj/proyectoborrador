<?php
// controllers/update_student.php
session_start();

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de configuración de la base de datos
require_once "../includes/db_config.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID del estudiante
    if (!isset($_POST['studentId']) || empty($_POST['studentId'])) {
        $_SESSION['error_message'] = "ID de estudiante no proporcionado.";
        header("Location: ../estudiantes.php");
        exit;
    }

    // Obtener datos del formulario
    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $observations = $_POST['observations'];
    $foto_actual = $_POST['currentPhoto'];
    $foto_path = $foto_actual;
    
    // Obtener conexión a la base de datos
    $conn = getConnection();
    
    // Verificar conexión
    if (!$conn) {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
        header("Location: ../estudiantes.php");
        exit;
    }

    try {
        // Procesar la foto si se ha subido una nueva
        if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = "../uploads/estudiantes/";
            
            // Crear directorio si no existe
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generar nombre único para la foto
            $file_extension = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
            $new_filename = 'student_' . $studentId . '_' . time() . '.' . $file_extension;
            $target_file = $upload_dir . $new_filename;
            
            // Mover archivo subido al directorio de destino
            if (move_uploaded_file($_FILES['Foto']['tmp_name'], $target_file)) {
                // Eliminar foto anterior si existe y no es la predeterminada
                if (!empty($foto_actual) && file_exists("../" . $foto_actual)) {
                    unlink("../" . $foto_actual);
                }
                
                // Actualizar ruta de la foto
                $foto_path = 'uploads/estudiantes/' . $new_filename;
            } else {
                throw new Exception("Error al subir la foto.");
            }
        }
        
        // Preparar consulta SQL para actualizar
        $sql = "UPDATE estudiantes SET 
                Nombres = ?, 
                Apellidos = ?, 
                Correo = ?, 
                Grado = ?, 
                Comentarios = ?, 
                Foto = IF(? != '', ?, Foto) 
                WHERE ID_estudiante = ?";
                
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }
        
        // Vincular parámetros
        $stmt->bind_param("ssssssss", 
            $firstName, 
            $lastName, 
            $email, 
            $program, 
            $observations, 
            $foto_path, 
            $foto_path, 
            $studentId
        );
        
        // Ejecutar consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
        
        // Verificar si se actualizó alguna fila
        if ($stmt->affected_rows > 0 || $stmt->errno === 0) {
            $_SESSION['success_message'] = "Estudiante actualizado correctamente.";
        } else {
            $_SESSION['warning_message'] = "No se realizaron cambios en el estudiante.";
        }
        
        // Cerrar statement
        $stmt->close();
        
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    } finally {
        // Cerrar conexión
        if (isset($conn)) {
            $conn->close();
        }
    }
    
    // Redirigir de vuelta a la página de estudiantes
    header("Location: ../Registro.php#estudiantes");
    exit;
    
} else {
    // Si no es una solicitud POST, redirigir a la página principal
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: ../Registro.php#estudiantes");
    exit;
}
?>
