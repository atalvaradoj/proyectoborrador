<?php
session_start();
require_once "../includes/db_config.php"; // Asegúrate de que este archivo existe y funciona correctamente

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_grupo = $_POST['Nombre_grupo'];
    $id_docente = $_POST['ID_docente'];
    $estudiantes = isset($_POST['ID_estudiante']) ? $_POST['ID_estudiante'] : []; // Array de IDs de estudiantes

    $conn = getConnection(); // Llamar a la función para obtener la conexión
    if ($conn) {
        try {
            // Iniciar una transacción para garantizar consistencia
            $conn->begin_transaction();

            // Insertar el grupo en la tabla "grupos"
            $sql_grupo = "INSERT INTO grupos (Nombre_grupo, ID_docente) VALUES (?, ?)";
            $stmt_grupo = $conn->prepare($sql_grupo);
            if (!$stmt_grupo) {
                throw new Exception("Error en la consulta SQL (grupos): " . $conn->error);
            }

            $stmt_grupo->bind_param("ss", $nombre_grupo, $id_docente);
            if (!$stmt_grupo->execute()) {
                throw new Exception("Error al guardar el grupo: " . $stmt_grupo->error);
            }

            // Obtener el ID del grupo recién creado
            $id_grupo = $conn->insert_id;

            // Insertar estudiantes en la tabla "grupo_estudiante"
            $sql_estudiante = "INSERT INTO grupo_estudiante (ID_grupo, ID_estudiante) VALUES (?, ?)";
            $stmt_estudiante = $conn->prepare($sql_estudiante);
            if (!$stmt_estudiante) {
                throw new Exception("Error en la consulta SQL (grupo_estudiante): " . $conn->error);
            }

            foreach ($estudiantes as $id_estudiante) {
                $stmt_estudiante->bind_param("is", $id_grupo, $id_estudiante);
                if (!$stmt_estudiante->execute()) {
                    throw new Exception("Error al asignar estudiante al grupo: " . $stmt_estudiante->error);
                }
            }

            // Confirmar la transacción si todo salió bien
            $conn->commit();

            $_SESSION['success_message'] = "Grupo agregado correctamente con los estudiantes asignados.";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conn->rollback();
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
        } finally {
            // Verificar y cerrar las declaraciones
            if (isset($stmt_grupo) && $stmt_grupo instanceof mysqli_stmt) $stmt_grupo->close();
            if (isset($stmt_estudiante) && $stmt_estudiante instanceof mysqli_stmt) $stmt_estudiante->close();

            // Cerrar la conexión
            $conn->close();
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    // Redirigir de vuelta a la página con la pestaña activa
    header("Location: ../Registro.php#grupos");
    exit;
} else {
    $_SESSION['error_message'] = "Método no permitido.";
    header("Location: ../Registro.php#grupos");
    exit;
}
?>