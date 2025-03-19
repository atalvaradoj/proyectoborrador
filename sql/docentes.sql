-- Otorgar permisos (solo si es necesario)
GRANT ALL PRIVILEGES ON sistema_academico.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- Verificar si la base de datos existe
SHOW DATABASES LIKE 'sistema_academico';

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sistema_academico;

-- Seleccionar la base de datos
USE sistema_academico;

-- Crear la tabla con la definición completa
CREATE TABLE IF NOT EXISTS docentes (
    ID_docente VARCHAR(20) PRIMARY KEY,
    Nombres VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Correo VARCHAR(100) NOT NULL,
    Especialidad VARCHAR(50) NOT NULL,
    Otra_especialidad VARCHAR(100) DEFAULT NULL,
    Comentarios TEXT
);