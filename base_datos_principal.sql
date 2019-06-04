-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2019 a las 10:53:59
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5
CREATE DATABASE mapas;
USE mapas;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mapas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE `calles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(25) NOT NULL,
  `ano_inicio` smallint(6) NOT NULL,
  `ano_fin` smallint(6) NOT NULL,
  `id_mapa` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotspots`
--

CREATE TABLE `hotspots` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `punto_x` int(10) UNSIGNED NOT NULL,
  `punto_y` int(10) UNSIGNED NOT NULL,
  `id_mapa` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE `mapas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `fecha` smallint(6) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  `ancho` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `fecha_de_subida` datetime NOT NULL,
  `id_paquete` int(10) UNSIGNED NOT NULL,
  `desviacion_x` decimal(10,0) DEFAULT NULL,
  `desviacion_y` decimal(10,0) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_calles`
--

CREATE TABLE `mapas_calles` (
  `id_map` int(10) UNSIGNED DEFAULT NULL,
  `id_lamina` int(10) UNSIGNED DEFAULT NULL,
  `id_calle` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id`, `nombre`, `fecha_subida`, `descripcion`) VALUES
(1, 'Seleccione un paquete', '1000-01-01 00:00:00', 'default'),
(2, 'Almería Centro', '2019-02-07 12:37:50', 'Descripción'),
(3, 'Almería Torrecardenas', '2019-02-07 12:37:50', 'Descripción'),
(4, 'La Molineta', '2019-02-07 12:37:50', 'Descripción'),
(5, '', '2019-02-18 09:54:47', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `punto_x` int(10) UNSIGNED NOT NULL,
  `punto_y` int(10) UNSIGNED NOT NULL,
  `id_calle` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `punto_x`, `punto_y`, `id_calle`) VALUES
(29, 131, 130, 62),
(46, 240, 163, 63),
(47, 147, 129, 64),
(48, 504, 270, 65),
(49, 565, 881, 66),
(50, 2562, 2189, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `nivel` smallint(5) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `passwd`, `nivel`) VALUES
(8, 'admin', '$2y$10$yu0J2vwN/LCmOZOBlM8vAOfJ.ESma3nDOFt5vN9ur/jo7Uhnf1ZwS', 2),
(10, 'test', '$2y$10$z9Aw8Eio7HcMN47uIMdpDulSNAGnFhbMFANVGgqkoPFaue.0/4iki', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calles`
--
ALTER TABLE `calles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);


--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
