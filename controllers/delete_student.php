<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['studentId'];

    if (empty($id_estudiante)) {
        $_SESSION['error_message'] = "ID del estudiante no proporcionado.";
        header("Location: ../estudiantes.php");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        // Eliminar la foto del estudiante si no es la predeterminada
        $sql = "SELECT Foto FROM estudiantes WHERE ID_estudiante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_estudiante);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foto_path = "../" . $row['Foto'];

            if (file_exists($foto_path) && strpos($foto_path, 'sombrero-de-graduacion.png') === false) {
                unlink($foto_path);
            }
        }

        $stmt->close();

        // Eliminar el estudiante de la base de datos
        $sql = "DELETE FROM estudiantes WHERE ID_estudiante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_estudiante);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Estudiante eliminado correctamente.";
        } else {
            $_SESSION['error_message'] = "Error al eliminar el estudiante: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    header("Location: ../estudiantes.php");
    exit;
} else {
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: ../estudiantes.php");
    exit;
}
?>



