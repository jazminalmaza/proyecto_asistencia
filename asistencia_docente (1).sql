-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2026 a las 21:11:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia_docente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombre_docente` varchar(100) NOT NULL,
  `materia` varchar(70) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `hora_ingreso` time NOT NULL,
  `hora_egreso` time NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `fecha`, `nombre_docente`, `materia`, `turno`, `hora_ingreso`, `hora_egreso`, `estado`) VALUES
(1, '2026-08-14', 'Sofia Lencina', 'Inglés', '', '15:57:58', '15:48:24', 'Presente'),
(2, '2026-08-14', 'Malena Viscardi', 'Geografia', '', '15:52:05', '00:00:00', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `DNI` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `teléfono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_huella` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `DNI`, `nombre`, `apellido`, `teléfono`, `email`, `id_huella`) VALUES
(5, 48512687, 'Guadalupe', 'Medel', '2147483647', 'guada@gmail.com', NULL),
(6, 48749707, 'Sofia', 'Lencina', '2147483647', 'sofiaepet20@gmail.com', NULL),
(7, 48749707, 'Sofia', 'Lencina', '2147483647', 'sofiaepet20@gmail.com', NULL),
(8, 0, '', '', '0', '', NULL),
(9, 48749707, 'Sofia', 'Lencina', '2994108659', 'sofiaepet20@gmail.com', 1248858),
(10, 48512687, 'Sofia', 'Lencina', '2994108659', 'sofiaepet20@gmail.com', 18745856),
(11, 48512687, 'Sofia', 'Lencina', '2994567891', 'sofiaepet20@gmail.com', 68547),
(12, 0, '', '', '', '', NULL),
(13, 0, '', '', '', '', NULL),
(14, 0, '', '', '', '', NULL),
(15, 48795812, '', 'Medel', '2334118795', 'guada08@gmail.com', 698742),
(16, 48795812, 'Sofia', 'Lencina', '2994567891', 'sofiaepet20@gmail.com', 27585),
(17, 0, '', '', '', '', NULL),
(18, 48749707, 'Sofia', 'Lencina', '2994108659', 'sofiaepet20@gmail.com', 587234),
(19, 48512687, 'Sofia', 'Lencina', '2994108659', 'sofiaepet20@gmail.com', 5498465),
(20, 48795812, 'Sofia', 'Lencina', '2994567891', 'sofiaepet20@gmail.com', 8546574),
(21, 48749708, 'Malena', 'Viscardi', '2994517896', 'male.viscardi@gmail.com', 70725);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_materias`
--

CREATE TABLE `docentes_materias` (
  `id_docente` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_materias`
--

INSERT INTO `docentes_materias` (`id_docente`, `id_materia`) VALUES
(9, 5),
(9, 6),
(10, 7),
(10, 8),
(11, 9),
(16, 10),
(20, 11),
(21, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes_de_preceptores`
--

CREATE TABLE `jefes_de_preceptores` (
  `id_jefe` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(10) NOT NULL,
  `turno` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_modifica_asistencia`
--

CREATE TABLE `jefe_modifica_asistencia` (
  `id_jefe` int(11) NOT NULL,
  `id_asistencia` int(11) NOT NULL,
  `fecha_modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `curso` varchar(10) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_finalizacion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre`, `turno`, `curso`, `horario_inicio`, `horario_finalizacion`) VALUES
(2, 'Dibujo', 'Mañana', '1° 1°', '01:30:00', '03:00:00'),
(3, 'Inglés', 'Vespertino', '4° 1°', '03:40:00', '04:40:00'),
(4, 'Inglés', 'Mañana', '3° 3°', '16:00:00', '17:20:00'),
(5, 'Inglés', 'Mañana', '1° 1°', '15:00:00', '16:20:00'),
(6, 'Dibujo', 'Mañana', '2° 1°', '16:20:00', '17:50:00'),
(7, 'Matematica', 'Mañana', '1° 1°', '15:16:00', '18:09:00'),
(8, 'Sistemas Operativos', 'Vespertino', '5° 5°', '18:00:00', '19:20:00'),
(9, 'Matematica', 'Tarde', '3° 6°', '15:54:00', '17:51:00'),
(10, 'Lengua', 'Mañana', '1° 1°', '08:01:00', '09:20:00'),
(11, 'Lengua', 'Mañana', '1° 1°', '18:19:00', '16:22:00'),
(12, 'Geografia', 'Tarde', '1° 3°', '15:30:00', '16:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prosecretario`
--

CREATE TABLE `prosecretario` (
  `id_prosecretario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docentes_materias`
--
ALTER TABLE `docentes_materias`
  ADD PRIMARY KEY (`id_docente`,`id_materia`);

--
-- Indices de la tabla `jefes_de_preceptores`
--
ALTER TABLE `jefes_de_preceptores`
  ADD PRIMARY KEY (`id_jefe`);

--
-- Indices de la tabla `jefe_modifica_asistencia`
--
ALTER TABLE `jefe_modifica_asistencia`
  ADD PRIMARY KEY (`id_jefe`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `prosecretario`
--
ALTER TABLE `prosecretario`
  ADD PRIMARY KEY (`id_prosecretario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `jefes_de_preceptores`
--
ALTER TABLE `jefes_de_preceptores`
  MODIFY `id_jefe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `prosecretario`
--
ALTER TABLE `prosecretario`
  MODIFY `id_prosecretario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
