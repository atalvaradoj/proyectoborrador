<?php
// filepath: controllers/save_user.php
require_once "../includes/db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = bin2hex(random_bytes(8)); // Genera un ID aleatorio de 16 caracteres
    $nombres = $_POST['Nombres'];
    $correo = $_POST['Correo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['Rol'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    $conn = getConnection();
    $sql = "INSERT INTO usuarios (ID_usuario, Nombres, Correo, telefono, Rol, Contrasena) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $id_usuario, $nombres, $correo, $telefono, $rol, $password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Usuario agregado correctamente.";
    } else {
        $_SESSION['error_message'] = "Error al agregar el usuario.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../registro.php#usuarios");
    exit();
}
?>