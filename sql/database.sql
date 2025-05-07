-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS periodico;

-- Usar la base de datos
USE periodico;

-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuario (
  Id_usuario INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(100) NOT NULL,
  contraseña VARCHAR(100) NOT NULL,
  nombre_completo VARCHAR(100) NOT NULL,
  PRIMARY KEY (Id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuarios de prueba
-- Contraseña: admin123 (hasheada con password_hash)
INSERT INTO usuario (usuario, contraseña, nombre_completo) VALUES 
('admin', '$2y$10$FZ7xTVNPJK6FY1QJ7UxHKOtZLXWUfP4.0qeG2BFfomwR1VTj4kJcO', 'Administrador');

-- Contraseña: editor123 (hasheada con password_hash)
INSERT INTO usuario (usuario, contraseña, nombre_completo) VALUES 
('editor', '$2y$10$AZXuN6TePOdQjMOvzjdmSeSFNQA9R2D.tX40cNtQP8cRTGAKHN7Yi', 'Editor de contenido');

-- Contraseña: lector123 (hasheada con password_hash)
INSERT INTO usuario (usuario, contraseña, nombre_completo) VALUES 
('lector', '$2y$10$YM9IHqf13A5X.BaE4mGHoOTqmA6yfJVBxMWEKybN0K4Vw5IgOr4uO', 'Usuario Lector'); 