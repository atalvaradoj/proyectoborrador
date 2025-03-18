<?php
session_start();
require_once "../includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['ID_estudiante'];
    $tipo_doc = $_POST['Type_Doc'];
    $fecha_nac = $_POST['Fecha_Nac'];
    $nombres = $_POST['Nombres'];
    $apellidos = $_POST['Apellidos'];
    $genero = $_POST['Genero'];
    $correo = $_POST['Correo'];
    $direccion = $_POST['Direccion'];
    $ciudad = $_POST['Ciudad'];
    $grado = $_POST['Grado'];
    $fecha_ing = $_POST['Fecha_Ing'];
    $estado = $_POST['Estado'];
    $comentarios = $_POST['Comentarios'];

    // Procesar la foto si se subió
    $foto_path = "img/sombrero-de-graduacion.png"; // Foto predeterminada
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "../uploads/estudiantes/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_extension = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
        $new_filename = 'student_' . $id_estudiante . '_' . time() . '.' . $file_extension;
        $target_file = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['Foto']['tmp_name'], $target_file)) {
            $foto_path = "uploads/estudiantes/" . $new_filename;
        }
    }

    // Insertar en la base de datos
    $conn = getConnection();
    if ($conn) {
        $sql = "INSERT INTO estudiantes (ID_estudiante, Type_Doc, Fecha_Nac, Nombres, Apellidos, Genero, Correo, Direccion, Ciudad, Grado, Fecha_Ing, Estado, Comentarios, Foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssss", $id_estudiante, $tipo_doc, $fecha_nac, $nombres, $apellidos, $genero, $correo, $direccion, $ciudad, $grado, $fecha_ing, $estado, $comentarios, $foto_path);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Estudiante agregado correctamente.";
        } else {
            $_SESSION['error_message'] = "Error al agregar el estudiante: " . $stmt->error;
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
