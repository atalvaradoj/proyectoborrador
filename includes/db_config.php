<?php
// includes/db_config.php

function getConnection() {
    $servername = "localhost";
    $username = "root";  // Cambia esto por tu usuario de MySQL
    $password = "";      // Cambia esto por tu contraseña de MySQL
    $dbname = "sistema_academico";  // Cambia esto por el nombre de tu base de datos
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        error_log("Conexión fallida: " . $conn->connect_error);
        return null;
    }
    
    // Establecer charset
    $conn->set_charset("utf8");
    
    return $conn;
}
?>


