<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['ID_docente'];
    $nombres = $_POST['Nombres'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $especialidad = $_POST['Especialidad'];
    $otra_especialidad = $_POST['Otra_especialidad'] ?? null;
    $comentarios = $_POST['Comentarios'];

    $conn = getConnection();
    if ($conn) {
        $sql = "INSERT INTO docentes (ID_docente, Nombres, Apellidos, Correo, Especialidad, Otra_especialidad, Comentarios) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Verificar si la preparación de la consulta falló
        if (!$stmt) {
            $_SESSION['error_message'] = "Error al preparar la consulta: " . $conn->error;
            header("Location: ../Registro.php#docentes");
            exit;
        }

        $stmt->bind_param("sssssss", $id_docente, $nombres, $apellidos, $correo, $especialidad, $otra_especialidad, $comentarios);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Docente agregado correctamente.";
        } else {
            $_SESSION['error_message'] = "Error al agregar el docente: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    header("Location: ../Registro.php#docentes");
    exit;
}
?>