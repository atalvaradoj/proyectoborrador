<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['ID_estudiante'];
    $nombres = $_POST['Nombres'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $grado = $_POST['Grado'];
    $comentarios = $_POST['Comentarios'];
    $foto_path = '';

    $conn = getConnection();
    if ($conn) {
        try {
            // Procesar la foto si se ha subido
            if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../uploads/estudiantes/";

                // Crear directorio si no existe
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Generar nombre único para la foto
                $file_extension = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
                $new_filename = 'student_' . $id_estudiante . '_' . time() . '.' . $file_extension;
                $target_file = $upload_dir . $new_filename;

                // Mover archivo subido al directorio de destino
                if (move_uploaded_file($_FILES['Foto']['tmp_name'], $target_file)) {
                    $foto_path = 'uploads/estudiantes/' . $new_filename;
                } else {
                    throw new Exception("Error al subir la foto.");
                }
            }

            // Insertar datos del estudiante en la base de datos
            $sql = "INSERT INTO estudiantes (ID_estudiante, Nombres, Apellidos, Correo, Grado, Comentarios, Foto) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $id_estudiante, $nombres, $apellidos, $correo, $grado, $comentarios, $foto_path);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Estudiante agregado correctamente.";
            } else {
                throw new Exception("Error al agregar el estudiante: " . $stmt->error);
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
