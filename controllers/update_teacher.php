<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_docente = $_POST['ID_docente'] ?? null;
    $nombres = $_POST['Nombres'] ?? null;
    $apellidos = $_POST['Apellidos'] ?? null;
    $correo = $_POST['Correo'] ?? null;
    $especialidad = $_POST['Especialidad'] ?? null;
    $otra_especialidad = $_POST['Otra_especialidad'] ?? null;
    $comentarios = $_POST['Comentarios'] ?? null;

    if (!$id_docente || !$nombres || !$apellidos || !$correo || !$especialidad) {
        $_SESSION['error_message'] = "Todos los campos obligatorios deben completarse.";
        header("Location: ../registro.php#docentes");
        exit;
    }

    $conn = getConnection();
    if ($conn) {
        try {
            $sql = "UPDATE docentes SET Nombres = ?, Apellidos = ?, Correo = ?, Especialidad = ?, Otra_especialidad = ?, Comentarios = ? WHERE ID_docente = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nombres, $apellidos, $correo, $especialidad, $otra_especialidad, $comentarios, $id_docente);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Docente actualizado correctamente.";
            } else {
                throw new Exception("Error al actualizar el docente: " . $stmt->error);
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