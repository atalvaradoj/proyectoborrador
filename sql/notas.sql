-- Script para crear la tabla de notas en la base de datos
use sistema_academico; -- Seleccionar la base de datos donde se creará la tabla
CREATE TABLE notas (
    ID_nota INT AUTO_INCREMENT PRIMARY KEY, -- Llave única para identificar cada nota
    ID_estudiante VARCHAR(50) NOT NULL, -- Llave foránea que referencia al estudiante
    Materia VARCHAR(100) NOT NULL, -- Materia asociada a la nota
    Nota INT NOT NULL, -- Calificación del estudiante
    Asistencia VARCHAR(10) NOT NULL COMMENT 'Formato: Ej. 7/10', -- Registro de asistencia
    Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha en la que se registra la nota
    FOREIGN KEY (ID_estudiante) REFERENCES estudiantes(ID_estudiante) -- Relación con la tabla estudiantes
);

SELECT * FROM notas; -- Consulta para verificar el contenido de la tabla notas

ALTER TABLE notas
MODIFY Asistencia INT NOT NULL;