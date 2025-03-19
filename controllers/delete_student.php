<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['studentId'];

    if (empty($studentId)) {
        $_SESSION['error_message'] = "ID del estudiante no proporcionado.";
        header("Location: ../Registro.php#estudiantes");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            // Obtener la foto actual del estudiante
            $sql = "SELECT Foto FROM estudiantes WHERE ID_estudiante = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $foto_actual = "../" . $row['Foto'];

                // Eliminar la foto actual si existe
                if (!empty($foto_actual) && file_exists($foto_actual)) {
                    unlink($foto_actual);
                }
            }

            $stmt->close();

            // Eliminar el estudiante de la base de datos
            $sql = "DELETE FROM estudiantes WHERE ID_estudiante = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $studentId);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Estudiante eliminado correctamente.";
            } else {
                throw new Exception("Error al eliminar el estudiante: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
        } finally {
            $conn->close();
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    // Redirigir de vuelta a Registro.php con la pestaña activa
    header("Location: ../Registro.php#estudiantes");
    exit;
} else {
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: ../Registro.php#estudiantes");
    exit;
}
?>



