<?php
// delete_student.php
session_start();

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de configuración
require_once "includes/db_config.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID del estudiante
    if (!isset($_POST['studentId']) || empty($_POST['studentId'])) {
        $_SESSION['error_message'] = "ID de estudiante no proporcionado.";
        header("Location: estudiantes.php");
        exit;
    }

    // Obtener ID del estudiante a eliminar
    $id_estudiante = $_POST['studentId'];
    
    // Establecer conexión directamente (sin usar getConnection)
    $servername = "localhost";
    $username = "root";  // Cambia esto por tu usuario de MySQL
    $password = "";      // Cambia esto por tu contraseña de MySQL
    $dbname = "sistema_academico";  // Cambia esto por el nombre de tu base de datos
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        $_SESSION['error_message'] = "Error de conexión: " . $conn->connect_error;
        header("Location: estudiantes.php");
        exit;
    }
    
    // Establecer charset
    $conn->set_charset("utf8");

    try {
        // Obtener información de la foto antes de eliminar
        $sql_foto = "SELECT Foto FROM estudiantes WHERE ID_estudiante = ?";
        $stmt_foto = $conn->prepare($sql_foto);
        
        if (!$stmt_foto) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt_foto->bind_param("s", $id_estudiante);
        $stmt_foto->execute();
        $result_foto = $stmt_foto->get_result();
        
        $foto_path = '';
        if ($result_foto->num_rows > 0) {
            $row = $result_foto->fetch_assoc();
            $foto_path = $row['Foto'];
        }
        
        $stmt_foto->close();
        
        // Preparar consulta SQL para eliminar
        $sql = "DELETE FROM estudiantes WHERE ID_estudiante = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta de eliminación: " . $conn->error);
        }
        
        // Vincular parámetros
        $stmt->bind_param("s", $id_estudiante);
        
        // Ejecutar consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta de eliminación: " . $stmt->error);
        }
        
        // Verificar si se eliminó alguna fila
        $affected_rows = $stmt->affected_rows;
        
        if ($affected_rows <= 0) {
            throw new Exception("No se encontró el estudiante con ID: " . $id_estudiante);
        }
        
        // Eliminar foto si existe y no es la imagen predeterminada
        if (!empty($foto_path) && file_exists($foto_path) && strpos($foto_path, 'sombrero-de-graduacion.png') === false) {
            if (!unlink($foto_path)) {
                // Solo registrar el error, no detener el proceso
                error_log("No se pudo eliminar la foto: " . $foto_path);
            }
        }
        
        // Guardar mensaje de éxito en la sesión
        $_SESSION['success_message'] = "Estudiante eliminado correctamente.";
        
        // Cerrar statement
        $stmt->close();
        
    } catch (Exception $e) {
        // Guardar mensaje de error en la sesión
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    } finally {
        // Cerrar conexión
        if (isset($conn)) {
            $conn->close();
        }
    }
    
    // Redirigir de vuelta a la página de estudiantes
    header("Location: estudiantes.php");
    exit;
    
} else {
    // Si no es una solicitud POST, redirigir a la página principal
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: estudiantes.php");
    exit;
}
?>

