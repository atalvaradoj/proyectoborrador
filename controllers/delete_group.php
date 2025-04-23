<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_grupo = $_POST['ID_grupo'];

    if (empty($id_grupo)) {
        $_SESSION['error_message'] = "ID del grupo no proporcionado.";
        header("Location: ../registro.php#grupos");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            // Iniciar una transacción
            $conn->begin_transaction();

            // Eliminar registros relacionados en la tabla grupo_estudiante
            $sql_delete_related = "DELETE FROM grupo_estudiante WHERE ID_grupo = ?";
            $stmt_related = $conn->prepare($sql_delete_related);
            $stmt_related->bind_param("i", $id_grupo);
            $stmt_related->execute();
            $stmt_related->close();

            // Eliminar el grupo
            $sql = "DELETE FROM grupos WHERE ID_grupo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_grupo);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Grupo eliminado correctamente.";
            } else {
                throw new Exception("Error al eliminar el grupo: " . $stmt->error);
            }

            // Confirmar la transacción
            $conn->commit();

            $stmt->close();
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conn->rollback();
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
        } finally {
            $conn->close();
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    header("Location: ../registro.php#grupos");
    exit;
}
?>