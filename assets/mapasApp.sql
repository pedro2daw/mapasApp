DROP DATABASE IF EXISTS mapas;

CREATE DATABASE mapas CHARACTER SET utf8;

use mapas;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS mapas;
DROP TABLE IF EXISTS laminas;
DROP TABLE IF EXISTS hotspots;
DROP TABLE IF EXISTS calles;
DROP TABLE IF EXISTS calles_laminas;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE usuarios (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    passwd VARCHAR(30)
);

CREATE TABLE mapas(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha SMALLINT NOT NULL,
    imagen VARCHAR(250) NOT NULL,
    nivel SMALLINT NOT NULL,
    ancho TINYINT NOT NULL,
    altura TINYINT NOT NULL
);

CREATE TABLE laminas(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imagen VARCHAR(250) NOT NULL,
    posicion_x SMALLINT ,
    posicion_y SMALLINT ,
    punto1_top SMALLINT ,
    punto2_top SMALLINT ,
    punto3_top SMALLINT ,
    punto1_left SMALLINT ,
    punto2_left SMALLINT ,
    punto3_left SMALLINT ,    
    id_mapa INT UNSIGNED
);

CREATE TABLE calles(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tipo VARCHAR(25) NOT NULL,
    ano_inicio SMALLINT NOT NULL,
    ano_fin SMALLINT NOT NULL
);

CREATE TABLE laminas_calles(
    id_map INT UNSIGNED UNIQUE,
    id_lamina INT UNSIGNED UNIQUE,
    id_calle INT UNSIGNED UNIQUE
);


CREATE TABLE puntos(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    punto_x INT UNSIGNED NOT NULL,
    punto_y INT UNSIGNED NOT NULL
);
CREATE TABLE hotspots (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imagen VARCHAR(250) NOT NULL,
    descripcion VARCHAR(600) NOT NULL,
    punto_x INT UNSIGNED NOT NULL,
    punto_y INT UNSIGNED NOT NULL,
    id_lamina INT UNSIGNED
);

INSERT INTO usuarios VALUES (null, 'admin','1');