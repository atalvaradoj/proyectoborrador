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
    Rol ENUM('docentes', 'padres' 'admin'),
    Contrasena VARCHAR(255) NULL,
    Estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente'
) 


-- Agregar nuevamente el campo 'Rol' con la definición correcta
ALTER TABLE usuarios ADD COLUMN telefono VARCHAR(20) NULL AFTER Correo;

-- Agregar nuevamente el campo 'Rol' con la definición correcta
ALTER TABLE usuarios ADD COLUMN Rol ENUM('docentes', 'padres', 'admin') DEFAULT 'padres';


select `ID_usuario` from usuarios;

ALTER TABLE usuarios DROP COLUMN Rol;