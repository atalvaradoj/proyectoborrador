-- Tabla de relación entre padres y estudiantes
CREATE TABLE IF NOT EXISTS padres_estudiantes (
    ID_usuario VARCHAR(20),
    ID_estudiante VARCHAR(50),
    FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario) ON DELETE CASCADE,
    FOREIGN KEY (ID_estudiante) REFERENCES estudiantes(ID_estudiante) ON DELETE CASCADE,
    PRIMARY KEY (ID_usuario, ID_estudiante)
);