<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_docente = $_POST['ID_docente'] ?? null;

    if (!$id_docente) {
        $_SESSION['error_message'] = "El ID del docente es obligatorio.";
        header("Location: ../registro.php#docentes");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            $sql = "DELETE FROM docentes WHERE ID_docente = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id_docente);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Docente eliminado correctamente.";
            } else {
                throw new Exception("Error al eliminar el docente: " . $stmt->error);
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

    header("Location: ../registro.php#docentes");
    exit;
}
?>