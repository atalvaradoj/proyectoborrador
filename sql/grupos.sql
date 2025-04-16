CREATE TABLE IF NOT EXISTS grupos (
    ID_grupo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_grupo VARCHAR(100) NOT NULL,
    ID_docente VARCHAR(20) NOT NULL,
    FOREIGN KEY (ID_docente) REFERENCES docentes(ID_docente)
);

CREATE TABLE IF NOT EXISTS grupo_estudiante (
    ID_grupo INT,
    ID_estudiante VARCHAR(50),
    PRIMARY KEY (ID_grupo, ID_estudiante),
    FOREIGN KEY (ID_grupo) REFERENCES grupos(ID_grupo),
    FOREIGN KEY (ID_estudiante) REFERENCES estudiantes(ID_estudiante)
);