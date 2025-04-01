<?php
require 'vendor/autoload.php'; // Cargar PHPMailer
require 'shared/db_config.php'; // Incluir la conexión a la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Validar datos del formulario
if (empty($_POST["nombre"]) || empty($_POST["correo"]) || empty($_POST["telefono"])) {
    die("Error: Todos los campos son obligatorios.");
}

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];

// Insertar la solicitud en la base de datos con estado 'pendiente'
$sql = "INSERT INTO usuarios (ID_usuario, Nombres, Correo, telefono, Estado) VALUES (?, ?, ?, ?, 'pendiente')";
$id_usuario = uniqid("USR_"); // Generar un ID único
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $id_usuario, $nombre, $correo, $telefono);

if ($stmt->execute()) {
    echo "Solicitud enviada correctamente. Un administrador revisará tu solicitud.";
} else {
    echo "Error al registrar la solicitud: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
