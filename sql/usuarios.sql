-- Otorgar permisos (solo si es necesario)
GRANT ALL PRIVILEGES ON sistema_academico.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- Verificar si la base de datos existe
SHOW DATABASES LIKE 'sistema_academico';

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sistema_academico;

-- Seleccionar la base de datos
USE sistema_academico;


CREATE TABLE IF NOT EXISTS usuarios (
    ID_usuario VARCHAR(20) PRIMARY KEY,
    Nombres VARCHAR(100) NOT NULL,
    Correo VARCHAR(100) NOT NULL UNIQUE,
    Rol ENUM('docentes', 'padres' 'admin') DEFAULT 'usuario',
    Fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_Rol CHECK (Rol IN ('usuario', 'admin'))
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
