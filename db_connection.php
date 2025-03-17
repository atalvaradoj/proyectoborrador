<?php
// Parámetros de conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$database = "sistema_academico";

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer charset
$conn->set_charset("utf8");
?>

