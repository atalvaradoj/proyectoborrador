<?php
require_once "../includes/db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se envió el ID del docente
    if (isset($_POST['ID_docente']) && !empty($_POST['ID_docente'])) {
        $id_docente = $_POST['ID_docente'];

        // Conexión a la base de datos
        $conn = getConnection();

        // Preparar la consulta para eliminar el docente
        $sql = "DELETE FROM docentes WHERE ID_docente = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $id_docente); // Vincular el ID del docente
            if ($stmt->execute()) {
                // Redirigir con un mensaje de éxito
                session_start();
                $_SESSION['success_message'] = "Docente eliminado correctamente.";
                header("Location: ../registro.php");
                exit();
            } else {
                // Redirigir con un mensaje de error
                session_start();
                $_SESSION['error_message'] = "Error al eliminar el docente.";
                header("Location: ../registro.php");
                exit();
            }
        } else {
            // Redirigir con un mensaje de error si la consulta falla
            session_start();
            $_SESSION['error_message'] = "Error al preparar la consulta.";
            header("Location: ../registro.php");
            exit();
        }
    } else {
        // Redirigir con un mensaje de error si no se envió el ID del docente
        session_start();
        $_SESSION['error_message'] = "No se proporcionó un ID de docente válido.";
        header("Location: ../registro.php");
        exit();
    }
} else {
    // Redirigir si no es una solicitud POST
    header("Location: ../registro.php");
    exit();
}
?>