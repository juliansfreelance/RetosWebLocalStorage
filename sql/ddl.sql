CREATE DATABASE IF NOT EXISTS  retoLocalStorage;
USE retoLocalStorage;

-- --------------------------------------------------------------------------
-- Creación DDL
-- --------------------------------------------------------------------------

-- Creación de la Tabla Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
	id INT(20) NOT NULL UNIQUE,
	nombre VARCHAR(60) NOT NULL,
	apellido VARCHAR(60) NOT NULL,
	telefono VARCHAR(10) NULL,
	registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

-- Creación de la Tabla LogIn
CREATE TABLE IF NOT EXISTS login (
	usuario_id INT(20) NOT NULL,
	correo VARCHAR(80) NOT NULL,
	password VARCHAR(100) NOT NULL,
	hash VARCHAR(32) NOT NULL,
	actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	ultimoLog TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (usuario_id),
	CONSTRAINT PK_LOGIN_USUARIO FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE
);