
CREATE DATABASE IF NOT EXISTS colegio;
USE colegio;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante VARCHAR(50),
    asignatura VARCHAR(50),
    parcial1 DECIMAL(4,2),
    parcial2 DECIMAL(4,2),
    parcial3 DECIMAL(4,2),
    examen DECIMAL(4,2),
    promedio DECIMAL(4,2),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS registro_sesiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuarios
INSERT INTO usuarios (id, nombre, usuario, password) VALUES (1, 'Fernando Tipantiza', 'ftipantiza', 'UTPL2025');
INSERT INTO usuarios (id, nombre, usuario, password) VALUES (2, 'Margoth López', 'mlopez', 'UTPL2025');
INSERT INTO usuarios (id, nombre, usuario, password) VALUES (3, 'Emily Vallejo', 'evallejo', 'UTPL2025');
