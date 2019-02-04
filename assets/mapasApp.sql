DROP DATABASE IF EXISTS mapas;

CREATE DATABASE mapas CHARACTER SET utf8;

use mapas;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS mapas;
-- DROP TABLE IF EXISTS laminas;
DROP TABLE IF EXISTS hotspots;
DROP TABLE IF EXISTS calles;
DROP TABLE IF EXISTS mapas_calles;

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
    ancho INT NOT NULL,
    altura INT NOT NULL,
    fecha_de_subida DATETIME NOT NULL,

        id_paquete INT UNSIGNED NOT NULL
);


CREATE TABLE paquetes(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(250) NOT NULL UNIQUE,
    fecha_subida DATETIME NOT NULL,
    descripcion VARCHAR(250) NOT NULL
);

/*
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
*/

CREATE TABLE calles(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tipo VARCHAR(25) NOT NULL,
    ano_inicio SMALLINT NOT NULL,
    ano_fin SMALLINT NOT NULL,

        id_mapa INT UNSIGNED
);

CREATE TABLE mapas_calles(
    id_map INT UNSIGNED UNIQUE,
    id_lamina INT UNSIGNED UNIQUE,
    id_calle INT UNSIGNED UNIQUE
);


CREATE TABLE puntos(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    punto_x INT UNSIGNED NOT NULL,
    punto_y INT UNSIGNED NOT NULL,

        id_calle INT UNSIGNED 
);

CREATE TABLE hotspots (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imagen VARCHAR(250) NOT NULL,
    descripcion VARCHAR(600) NOT NULL,
    punto_x INT UNSIGNED NOT NULL,
    punto_y INT UNSIGNED NOT NULL,
    id_mapa INT UNSIGNED
);

INSERT INTO usuarios VALUES (null, 'admin','1');

/*id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha SMALLINT NOT NULL,
    imagen VARCHAR(250) NOT NULL,
    nivel SMALLINT NOT NULL,
    ancho INT NOT NULL,
    altura INT NOT NULL,
    fecha_de_subida DATETIME NOT NULL,

        id_paquete INT UNSIGNED NOT NULL
        */

INSERT INTO mapas VALUES (null,'Ortofoto Almería del Siglo XXI', 'Ortofoto de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/1_almeria.png',2,1000,1000,10,2);
INSERT INTO mapas VALUES (null,'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas','Almeria',1864,'/assets/img/mapas/2_almeria.png',1,1000,1000,10,2);
INSERT INTO mapas VALUES (null,'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/3_almeria.png',2,1000,1000,10,2);


INSERT INTO mapas VALUES (null,'Ortofoto Almería del Siglo XXI', 'Ortofoto de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/4_almeria.png',2,1000,1000,10,3);
INSERT INTO mapas VALUES (null,'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/5_almeria.png',2,1000,1000,10,3);
INSERT INTO mapas VALUES (null,'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas','Almeria',1864,'/assets/img/mapas/6_almeria.png',1,1000,1000,10,3);

INSERT INTO mapas VALUES (null,'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas','Almeria',1864,'/assets/img/mapas/7_almeria.png',1,1000,1000,10,4);
INSERT INTO mapas VALUES (null,'Ortofoto Almería del Siglo XXI', 'Ortofoto de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/8_almeria.png',2,1000,1000,10,4);
INSERT INTO mapas VALUES (null,'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI','Almeria',2017,'/assets/img/mapas/9_almeria.png',2,1000,1000,10,4);

DELETE FROM MAPAS where id = 4;

INSERT INTO paquetes VALUES (null,'Seleccione un paquete','1000-01-01 00:00:00', 'default');
INSERT INTO paquetes VALUES (null,'Almería Centro',now(), 'Descripción');
INSERT INTO paquetes VALUES (null,'Almería Torrecardenas',now(), 'Descripción');
INSERT INTO paquetes VALUES (null,'La Molineta',now(), 'Descripción');

select * from paquetes;