<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_grupo = $_POST['ID_grupo'];
    $nombre_grupo = $_POST['Nombre_grupo'];
    $id_docente = $_POST['ID_docente'];

    if (empty($id_grupo) || empty($nombre_grupo) || empty($id_docente)) {
        $_SESSION['error_message'] = "Todos los campos son obligatorios.";
        header("Location: ../registro.php#grupos");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            // Actualizar el grupo
            $sql = "UPDATE grupos SET Nombre_grupo = ?, ID_docente = ? WHERE ID_grupo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $nombre_grupo, $id_docente, $id_grupo);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Grupo actualizado correctamente.";
            } else {
                throw new Exception("Error al actualizar el grupo: " . $stmt->error);
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

    header("Location: ../registro.php#grupos");
    exit;
}
?>