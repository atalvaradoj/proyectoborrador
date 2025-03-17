<?php
// includes/db_config.php

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si tienes un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "sistema_academico";

// Crear conexión
function getConnection() {
    global $servername, $username, $password, $dbname;
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Establecer el conjunto de caracteres a utf8
    $conn->set_charset("utf8");
    
    return $conn;
}
?>

