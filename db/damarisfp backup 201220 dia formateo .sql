-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2020 a las 23:16:18
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

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
(0, 0, 'Sin Cliente', 'Sin telefono', 1),
(1, 1, 'Aida Perez', '0412807252', 1),
(2, 1, 'Carmen Mata', '0424925129', 1),
(3, 1, 'Blanca Ramirez', '0414853229', 1),
(4, 1, 'Yendis', '0414997395', 1),
(5, 1, 'Mariannys', '0424854784', 1),
(6, 1, 'Luis Gonzales', '0414761537', 1),
(7, 1, 'Mariela Marin', '0414386582', 1),
(8, 1, 'Berny', '04262950813', 1),
(9, 1, 'Briceida Bauza', '0414871185', 1),
(10, 1, 'Felix Cabreras', '0416898084', 1),
(11, 1, 'Sr carolina', '0414877755', 1),
(12, 1, 'Senaida', '0414868736', 1),
(13, 1, 'Eduaro araya', '0414386216', 1),
(14, 1, 'keilyn gonzales', '4148671100', 1),
(15, 1, 'Katherine', '0424961720', 1),
(16, 1, 'Oriennys', '041486265', 1),
(17, 1, 'Niurkas gonzales', '0414895088', 1),
(18, 1, 'Rena', '041476032', 0),
(19, 1, 'Annys Valladares', '0424915688', 1),
(20, 1, 'Mariannys', '0414896436', 1),
(21, 1, 'Xioamara', '0414894624', 1),
(22, 1, 'Alicett', '4249128118', 1),
(23, 1, 'Rosalinda pineda', '0414897020', 1),
(24, 1, 'Ruzbelia', '041486765', 1),
(25, 1, 'Libia', '041476032', 1),
(26, 1, 'Georgina', '0424882543', 1),
(27, 1, 'Rosiel', '042494500', 1),
(28, 1, 'Kathy', '0426580870', 1),
(29, 1, 'Alexander', '0424930046', 1),
(30, 1, 'Liriam rojas', '0416586478', 1),
(31, 1, 'Maria luisa Duarte', '0414386299', 1),
(32, 1, 'Eugenio medori', '0416490265', 1),
(33, 1, 'Angela', '0414899156', 1),
(34, 1, 'Pedro', '4249675642', 1),
(35, 1, 'Gladis', '0414894727', 1),
(36, 1, 'manuel dos santos', '0414822217', 1),
(37, 1, 'Nuris batancour', '0424954140', 1),
(38, 1, 'Majdelis Bruzual', '0414877199', 1),
(39, 1, 'Roxana', '0424916947', 1),
(40, 1, 'Safa', '0424945703', 1),
(41, 1, 'Francisco', '4249664529', 1),
(42, 1, 'Yurima', '4249300137', 1),
(43, 1, 'Ailed Rodriguez', '4249555477', 1),
(44, 1, 'Neida', '0414885832', 1),
(45, 1, 'Cesar Quintini', '0414083424', 1),
(46, 1, 'Carlos Fuentes', '0414896873', 1),
(47, 1, 'Eliezer', '0424947564', 1),
(48, 1, 'Norjul Gonzales', '0414875338', 1),
(49, 1, 'Lisett Rodriguez', '042497226', 1),
(50, 1, 'Lorenzo Regifo', '0416687841', 1),
(51, 1, 'Lucia', '0416990928', 1),
(52, 1, 'Jose Antonio', '0414867359', 1),
(53, 1, 'Ydarlide Garcia', '04128599967', 1),
(54, 1, 'Carmen Rodriguez', '4148981109', 1),
(55, 1, 'Yuraima Raucci', '4148985158', 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_residencia` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `tasa` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `referencia` varchar(25) DEFAULT NULL,
  `dolares` float DEFAULT NULL,
  `bs` float DEFAULT NULL,
  `emisor` varchar(45) DEFAULT NULL,
  `receptor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_residencia`, `id_cliente`, `tasa`, `fecha`, `referencia`, `dolares`, `bs`, `emisor`, `receptor`) VALUES
(48, 51, 41, 548442, '2020-11-11', '', 57.2501, 31398400, 'Caroní', 'Caroní'),
(52, 1, 1, 550128, '2020-12-06', '', 30, 5700000, ' - ', ' - '),
(108, 1, 1, 1100000, '2020-12-07', '', 35, 38500000, ' - ', ' - '),
(109, 3, 3, 312879, '2020-12-07', '', 35, 10950800, ' - ', ' - '),
(110, 1, 1, 560999, '2020-12-07', '', 10.1604, 5700000, ' - ', ' - '),
(111, 2, 2, 550128, '2020-12-07', '', 28, 15403600, ' - ', ' - '),
(112, 1, 1, 1100000, '2020-12-07', '', 35, 5000000, ' - ', ' - '),
(113, 6, 6, 560999, '2020-12-07', '', 35, 5000000, ' - ', ' - '),
(114, 39, 35, 550128, '2020-12-07', '', 35, 19254500, ' - ', ' - '),
(115, 2, 2, 1100000, '2020-12-07', '', 35, 38500000, ' - ', ' - '),
(116, 15, 15, 1100000, '2020-12-07', '', 10, 11000000, ' - ', ' - '),
(117, 3, 3, 560999, '2020-12-07', '', 10, 5609990, ' - ', ' - '),
(118, 4, 4, 560999, '2020-12-07', '', 57, 31976900, ' - ', ' - '),
(119, 5, 5, 365025, '2020-12-07', '', 30, 10950800, ' - ', ' - '),
(120, 16, 16, 750000, '2020-12-07', '', 7.6, 5700000, ' - ', ' - '),
(121, 15, 15, 560999, '2020-12-07', '', 57, 31976900, ' - ', ' - ');

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
(1, 1, 'Aida Suites', '', '', 8, 1, 8, '0.0000000', '0.0000000', 1),
(2, 2, 'ALTA VISTA I', '', '', 100, 1, 100, '0.0000000', '0.0000000', 1),
(3, 3, 'ALTA VISTA II', '', '', 22, 0, 22, '0.0000000', '0.0000000', 1),
(4, 4, 'America country club', '', '', 80, 0, 70, '0.0000000', '0.0000000', 1),
(5, 5, 'Aljive', '', '', 24, 0, 24, '0.0000000', '0.0000000', 1),
(6, 6, 'ARAGUANEY', '', '', 72, 0, 50, '0.0000000', '0.0000000', 1),
(7, 7, 'ARIVANA COUNTRY CLUB', '', '', 80, 0, 80, '0.0000000', '0.0000000', 1),
(8, 8, 'CAMILA SUITES', '', '', 15, 0, 30, '0.0000000', '0.0000000', 1),
(9, 9, 'CAMINO REAL', '', '', 50, 0, 50, '0.0000000', '0.0000000', 1),
(10, 10, 'CIUDAD JARDIN', '', '', 50, 0, 50, '0.0000000', '0.0000000', 1),
(11, 11, 'BAHAMAS', '', '', 18, 0, 6, '0.0000000', '0.0000000', 1),
(12, 12, 'BARBADOS', '', '', 3, 0, 10, '0.0000000', '0.0000000', 1),
(13, 13, 'California', '', NULL, 4, 0, 4, '0.0000000', '0.0000000', 1),
(14, 14, 'Canaima Suites', '', NULL, 6, 0, 6, '0.0000000', '0.0000000', 1),
(15, 15, 'Coimbra', '', '', 7, 0, 5, '0.0000000', '0.0000000', 1),
(16, 16, 'Costa Azul', '', '', 80, 0, 60, '0.0000000', '0.0000000', 1),
(17, 5, 'Costa del sol', '', '', 1, 0, 45, '0.0000000', '0.0000000', 1),
(18, 17, 'DOÑA LUISA', '', '', 81, 0, 80, '0.0000000', '0.0000000', 1),
(19, 18, 'Esmeralda', '', '', 22, 0, 20, '0.0000000', '0.0000000', 1),
(20, 19, 'El caimito', '', '', 70, 0, 60, '0.0000000', '0.0000000', 1),
(21, 20, 'Fuente Azul', '', '', 30, 0, 30, '0.0000000', '0.0000000', 1),
(22, 18, 'Fl PLACE', '', '', 64, 0, 40, '0.0000000', '0.0000000', 1),
(23, 18, 'Fl. GARDEN I', '', '', 31, 0, 25, '0.0000000', '0.0000000', 1),
(24, 18, 'Fl.GARDEN II', '', '', 27, 0, 25, '0.0000000', '0.0000000', 1),
(25, 21, 'Gardenia', '', '', 14, 0, 12, '0.0000000', '0.0000000', 1),
(26, 21, 'Gurimagua', '', '', 15, 0, 15, '0.0000000', '0.0000000', 1),
(27, 0, 'Granata plaza', '', '', 15, 0, 15, '0.0000000', '0.0000000', 1),
(28, 24, 'Isla bonita', '', '', 29, 0, 43.5, '0.0000000', '0.0000000', 1),
(29, 25, 'Kavac', '', '', 32, 0, 27, '0.0000000', '0.0000000', 1),
(30, 26, 'Las Garzas', '', '', 7, 0, 7, '0.0000000', '0.0000000', 1),
(31, 27, 'Las Garzas rosiel', '', '', 27, 0, 27, '0.0000000', '0.0000000', 1),
(32, 28, 'Las orquideas', '', '', 110, 0, 50, '0.0000000', '0.0000000', 1),
(33, 29, 'Las villas', '', '', 10, 0, 10, '0.0000000', '0.0000000', 1),
(34, 30, 'LAS CALAS SUITES', '', '', 30, 0, 30, '0.0000000', '0.0000000', 1),
(35, 31, 'Las palmas', '', '', 15, 0, 30, '0.0000000', '0.0000000', 1),
(36, 32, 'Loft 202', '', '', 6, 0, 18, '0.0000000', '0.0000000', 1),
(37, 33, 'Los frailes', '', '', 40, 0, 40, '0.0000000', '0.0000000', 1),
(38, 34, 'Los tulipanes', '', '', 40, 0, 40, '0.0000000', '0.0000000', 1),
(39, 35, 'La abadia', '', '', 13, 0, 13, '0.0000000', '0.0000000', 1),
(40, 0, 'Manantial', '', '', 46, 0, 30, '0.0000000', '0.0000000', 1),
(41, 36, 'Maritza suites 2', '', '', 5, 0, 10, '0.0000000', '0.0000000', 1),
(42, 37, 'Maritza suites 3', '', '', 5, 0, 20, '0.0000000', '0.0000000', 1),
(43, 38, 'Recreo', '', '', 4, 0, 12, '0.0000000', '0.0000000', 1),
(44, 39, 'Residencias 919', '', '', 8, 0, 24, '0.0000000', '0.0000000', 1),
(45, 40, 'Sofia Gardens', '', '', 6, 0, 30, '0.0000000', '0.0000000', 1),
(46, 18, 'Parque Caroni', '', '', 32, 0, 25, '0.0000000', '0.0000000', 1),
(47, 18, 'PASEO I', '', '', 42, 0, 30, '0.0000000', '0.0000000', 1),
(48, 18, 'PASEO II', '', '', 42, 0, 30, '0.0000000', '0.0000000', 1),
(49, 18, 'Paseo III', '', '', 42, 0, 30, '0.0000000', '0.0000000', 1),
(50, 0, 'Terrazas del Atlantico A', '', '', 70, 0, 70, '0.0000000', '0.0000000', 1),
(51, 41, 'Terrazas del Atlantico B', '', '', 114, 0, 114, '0.0000000', '0.0000000', 1),
(52, 0, 'Terrazas del Atlantico C', '', '', 45, 0, 45, '0.0000000', '0.0000000', 1),
(53, 42, 'Tocoma I', '', '', 150, 0, 70, '0.0000000', '0.0000000', 1),
(54, 43, 'TOCOMA II', '', '', 130, 0, 65, '0.0000000', '0.0000000', 1),
(55, 44, 'Torre Continental', '', '', 24, 0, 50, '0.0000000', '0.0000000', 1),
(56, 45, 'Valentina Suites', '', '', 7, 0, 7, '0.0000000', '0.0000000', 1),
(57, 18, 'Valle Alto', '', '', 19, 0, 20, '0.0000000', '0.0000000', 1),
(58, 46, 'San Charbel', '', '', 42, 0, 63, '0.0000000', '0.0000000', 1),
(59, 47, 'Valaire', '', '', 40, 0, 40, '0.0000000', '0.0000000', 1),
(60, 48, 'Villa Antillana', '', '', 17, 0, 17, '0.0000000', '0.0000000', 1),
(61, 49, 'Villa Luna', '', '', 8, 0, 8, '0.0000000', '0.0000000', 1),
(62, 50, 'Villa Rimac', '', '', 34, 0, 25, '0.0000000', '0.0000000', 1),
(63, 51, 'Villa Sisilia', '', '', 12, 0, 12, '0.0000000', '0.0000000', 1),
(64, 52, 'Villas del Tepuy', '', '', 110, 0, 110, '0.0000000', '0.0000000', 1),
(65, 53, 'Mediterrane', '', '', 42, 0, 84, '0.0000000', '0.0000000', 1),
(66, 54, 'Granadina I', '', '', 45, 0, 90, '0.0000000', '0.0000000', 1),
(67, 55, 'Loma Granada', '', '', 5, 0, 15, '0.0000000', '0.0000000', 1);

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
  `ver` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `fechaCaptura`, `ver`) VALUES
(1, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2020-11-17', 1);

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
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_residencia` (`id_residencia`);

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
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reportes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `residencia`
--
ALTER TABLE `residencia`
  MODIFY `id_residencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_residencia`) REFERENCES `residencia` (`id_residencia`);

--
-- Filtros para la tabla `residencia`
--
ALTER TABLE `residencia`
  ADD CONSTRAINT `residencia_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
