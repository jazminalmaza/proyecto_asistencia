-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2026 a las 19:02:59
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `DNI` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `teléfono` int(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `DNI`, `nombre`, `apellido`, `teléfono`, `email`) VALUES
(5, 48512687, 'Guadalupe', 'Medel', 2147483647, 'guada@gmail.com'),
(6, 48749707, 'Sofia', 'Lencina', 2147483647, 'sofiaepet20@gmail.com'),
(7, 48749707, 'Sofia', 'Lencina', 2147483647, 'sofiaepet20@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_materias`
--

CREATE TABLE `docentes_materias` (
  `id_docente` int(70) NOT NULL,
  `id_materia` int(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'Inglés', 'Mañana', '3° 3°', '16:00:00', '17:20:00');

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
  ADD PRIMARY KEY (`id_materia`);

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
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `jefes_de_preceptores`
--
ALTER TABLE `jefes_de_preceptores`
  MODIFY `id_jefe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prosecretario`
--
ALTER TABLE `prosecretario`
  MODIFY `id_prosecretario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
