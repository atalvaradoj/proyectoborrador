<?php
$servername = "localhost"; // Servidor de la base de datos
$username = "root"; // Usuario de MySQL (cambia si es necesario)
$password = ""; // Contraseña (déjala vacía si no tienes una)Tables
$dbname = "sistema_academico"; 

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

