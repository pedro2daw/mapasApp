#
# TABLE STRUCTURE FOR: mapas
#

DROP TABLE IF EXISTS `mapas`;

CREATE TABLE `mapas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `fecha` smallint(6) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  `ancho` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `fecha_de_subida` datetime NOT NULL,
  `id_paquete` int(10) unsigned NOT NULL,
  `desviacion_x` decimal(10,0) DEFAULT NULL,
  `desviacion_y` decimal(10,0) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: calles
#

DROP TABLE IF EXISTS `calles`;

CREATE TABLE `calles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(25) NOT NULL,
  `ano_inicio` smallint(6) NOT NULL,
  `ano_fin` smallint(6) NOT NULL,
  `id_mapa` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: hotspots
#

DROP TABLE IF EXISTS `hotspots`;

CREATE TABLE `hotspots` (
  `id` int(10) unsigned NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `punto_x` int(10) unsigned NOT NULL,
  `punto_y` int(10) unsigned NOT NULL,
  `id_mapa` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: mapas_calles
#

DROP TABLE IF EXISTS `mapas_calles`;

CREATE TABLE `mapas_calles` (
  `id_map` int(10) unsigned DEFAULT NULL,
  `id_lamina` int(10) unsigned DEFAULT NULL,
  `id_calle` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: puntos
#

DROP TABLE IF EXISTS `puntos`;

CREATE TABLE `puntos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `punto_x` int(10) unsigned NOT NULL,
  `punto_y` int(10) unsigned NOT NULL,
  `id_calle` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: usuarios
#

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` smallint(5) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `nivel` smallint(5) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`id`, `username`, `passwd`, `nivel`) VALUES (1, 'admin', '$2y$10$GSEFXPJ5.fOFot2es7YF5exKp21HXMjYj06Z60pQrEeHneXjc2xB6', 2);


