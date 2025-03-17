<?php
// save_student.php
session_start();
include "includes/db_config.php";

// Verificar si la carpeta uploads existe, si no, crearla
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener conexión a la base de datos
    $conn = getConnection();
    
    // Recoger los datos del formulario
    $studentId = $_POST['studentId'];
    $documentType = $_POST['documentType'];
    $birthDate = $_POST['birthDate'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $program = $_POST['program'];
    $admissionDate = $_POST['admissionDate'];
    $status = $_POST['status'];
    $observations = isset($_POST['observations']) ? $_POST['observations'] : '';
    
    // Manejar la carga de la foto
    $foto = "";
    if (isset($_FILES['studentPhoto']) && $_FILES['studentPhoto']['error'] == 0) {
        $target_dir = "uploads/";
        
        // Generar un nombre único para el archivo
        $foto = $target_dir . uniqid() . "_" . basename($_FILES["studentPhoto"]["name"]);
        
        // Mover el archivo subido al directorio de destino
        if (move_uploaded_file($_FILES["studentPhoto"]["tmp_name"], $foto)) {
            // Archivo subido correctamente
        } else {
            $_SESSION['error_message'] = "Error al subir la foto.";
            header("Location: estudiantes.php");
            exit;
        }
    }
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO estudiantes (ID_estudiante, Type_Doc, Fecha_Nac, Nombres, Apellidos, 
            Genero, Correo, Direccion, Ciudad, Grado, Fecha_Ing, Estado, Comentarios, Foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $_SESSION['error_message'] = "Error en la preparación de la consulta: " . $conn->error;
        header("Location: estudiantes.php");
        exit;
    }
    
    // Vincular parámetros
    $stmt->bind_param("ssssssssssssss", 
        $studentId, 
        $documentType, 
        $birthDate, 
        $firstName, 
        $lastName, 
        $gender, 
        $email, 
        $address, 
        $city, 
        $program, 
        $admissionDate, 
        $status, 
        $observations, 
        $foto
    );
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Guardar mensaje de éxito en la sesión
        $_SESSION['success_message'] = "El estudiante ha sido guardado correctamente.";
        $_SESSION['redirect_url'] = "estudiantes.php"; // Opcional: redirigir a otra página
        header("Location: estudiantes.php");
        exit;
    } else {
        // Guardar mensaje de error en la sesión
        $_SESSION['error_message'] = "Error al guardar el estudiante: " . $stmt->error;
        header("Location: estudiantes.php");
        exit;
    }
    
    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir a la página principal
    header("Location: estudiantes.php");
    exit;
}
?>
