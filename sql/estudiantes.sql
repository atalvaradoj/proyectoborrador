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
    ID_estudiante VARCHAR(50) PRIMARY KEY,
    Type_Doc VARCHAR(10),
    Fecha_Nac DATE,
    Nombres VARCHAR(100),
    Apellidos VARCHAR(100),
    Genero VARCHAR(10),
    Correo VARCHAR(100),
    Direccion VARCHAR(255),
    Ciudad VARCHAR(100),
    Grado VARCHAR(50),
    Fecha_Ing DATE,
    Estado VARCHAR(20),
    Comentarios TEXT,
    Foto VARCHAR(255)
);
