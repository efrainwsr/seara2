-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2020 a las 04:52:04
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `damarisfp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `ver` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_usuario`, `nombre`, `telefono`, `ver`) VALUES
(0, 0, 'Sin Cliente', 'Sin Telefono', 666),
(23333333, 1, 'juan narvaez', '04129491621', 1),
(24444444, 1, 'Ariannys Campos', '04148716912', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sueldo` float DEFAULT NULL,
  `ver` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `telefono`, `observaciones`, `fecha`, `sueldo`, `ver`) VALUES
(20000000, 'alejandro guzman', '04148716912', 'NA', '2020-09-21', 300, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reportes` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_vehiculo` varchar(10) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `vehiculo` varchar(25) DEFAULT NULL,
  `residencia` varchar(25) DEFAULT NULL,
  `ruta` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reportes`, `fecha`, `id_cliente`, `descripcion`, `id_usuario`, `id_vehiculo`, `nombre`, `vehiculo`, `residencia`, `ruta`) VALUES
(1, '2020-09-21', NULL, 'fdgrrtdg', 1, NULL, 'REPORTE1 ', 'F-350 - HGYUTG', 'los tulipanes', 'ruta prueba con dias'),
(2, '2020-09-23', NULL, 'trhtyhthtrh', 1, NULL, 'REPORTE2', 'F-350 - HGYUTG', 'los tulipanes', 'ruta prueba con dias'),
(6, '2020-08-01', 2, 'jfeofefefwfe', 1, '0', 'Ana maria', NULL, 'America Country club', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia`
--

CREATE TABLE `residencia` (
  `id_residencia` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `gmap` varchar(200) DEFAULT NULL,
  `casas` int(11) DEFAULT NULL,
  `kgbasura` float DEFAULT NULL,
  `pago` float DEFAULT NULL,
  `lat` decimal(8,7) DEFAULT NULL,
  `lng` decimal(9,7) DEFAULT NULL,
  `ver` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `residencia`
--

INSERT INTO `residencia` (`id_residencia`, `id_cliente`, `nombre`, `direccion`, `gmap`, `casas`, `kgbasura`, `pago`, `lat`, `lng`, `ver`) VALUES
(1, 23333333, 'los tulipanes', 'Av guayana', 'https://goo.gl/maps/A39FwpXmfAD5k2pQ7', 100, 400, 120, '8.3030277', '-62.7101660', 1),
(2, 24444444, 'America country club', 'regr', 'https://goo.gl/maps/A39FwpXmfAD5k2pQ7', 70, 200, 120, '8.2639027', '-62.7837751', 0),
(3, 23333333, 'America country club', '873Q+5W Ciudad Guayana, Bolívar', 'rgegreg45345', 100, 400, 120, '8.3030270', '-62.7101660', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `casas` int(11) DEFAULT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `kgbasura` float DEFAULT NULL,
  `ver` int(11) DEFAULT 1,
  `nombre_residencia` varchar(25) DEFAULT NULL,
  `nombre_ruta` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `id_cliente`, `id_residencia`, `id_usuario`, `fecha`, `casas`, `dia`, `kgbasura`, `ver`, `nombre_residencia`, `nombre_ruta`) VALUES
(1, 23333333, 1, 1, '2020-09-21', 100, 'Lunes-Martes', 400, 1, 'los tulipanes', 'ruta prueba con dias'),
(1, 24444444, 2, 1, '2020-09-21', 70, 'Lunes-Martes', 200, 1, 'America country club', 'ruta prueba con dias'),
(2, 24444444, 2, 1, '2020-09-21', 70, 'Lunes-Jueves', 200, 0, 'America country club', 'ruta prueba con dias'),
(2, 23333333, 1, 1, '2020-09-21', 100, 'Lunes-Jueves', 400, 0, 'los tulipanes', 'ruta prueba con dias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` tinytext DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL,
  `ver` int(11) DEFAULT 1,
  `pregunta1` varchar(45) DEFAULT NULL,
  `pregunta2` varchar(45) DEFAULT NULL,
  `pregunta3` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `fechaCaptura`, `ver`, `pregunta1`, `pregunta2`, `pregunta3`) VALUES
(1, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2020-09-21', 1, 'hola1', 'hola2', 'hola3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` varchar(10) NOT NULL,
  `capacidad` float DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `cant_ruedas` int(11) DEFAULT NULL,
  `rin` int(11) DEFAULT NULL,
  `ver` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `capacidad`, `marca`, `modelo`, `cant_ruedas`, `rin`, `ver`) VALUES
('GHURYTYY', 14, 'chevrolet', 'silverado', 4, 15, 1),
('HGYUTG', 200, 'FORD', 'F-350', 6, 16, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reportes`);

--
-- Indices de la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD PRIMARY KEY (`id_residencia`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reportes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `residencia`
--
ALTER TABLE `residencia`
  MODIFY `id_residencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD CONSTRAINT `residencia_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
