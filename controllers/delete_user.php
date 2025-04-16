<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST['ID_usuario'] ?? null;

    if (!$id_usuario) {
        $_SESSION['error_message'] = "El ID del usuario es obligatorio.";
        header("Location: ../registro.php#usuarios");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            // Eliminar el usuario de la base de datos
            $sql = "DELETE FROM usuarios WHERE ID_usuario = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conn->error);
            }

            $stmt->bind_param("s", $id_usuario);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Usuario eliminado correctamente.";
            } else {
                throw new Exception("Error al eliminar el usuario: " . $stmt->error);
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

    header("Location: ../registro.php#usuarios");
    exit;
} else {
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: ../registro.php#usuarios");
    exit;
}
?>