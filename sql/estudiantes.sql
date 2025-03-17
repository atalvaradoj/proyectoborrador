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
CREATE TABLE IF NOT EXISTS estudiantes (
    ID_estudiante VARCHAR(20) PRIMARY KEY,
    Type_Doc VARCHAR(10) NOT NULL,
    Fecha_Nac DATE NOT NULL,
    Nombres VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Genero CHAR(1) NOT NULL,
    Correo VARCHAR(100) NOT NULL,
    Direccion VARCHAR(200) NOT NULL,
    Ciudad VARCHAR(100) NOT NULL,
    Grado VARCHAR(100) NOT NULL,
    Fecha_Ing DATE NOT NULL,
    Estado VARCHAR(20) NOT NULL,
    Comentarios TEXT,
    Foto VARCHAR(255)
);
