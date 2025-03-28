<?php
include "includes/db_config.php";

// Crear la conexión
$conn = getConnection();

// SQL para crear la tabla testimonios
$sql = "CREATE TABLE IF NOT EXISTS testimonios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    testimonio TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
)";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Tabla testimonios creada exitosamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

$conn->close();
?>
