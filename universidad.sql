-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-06-2023 a las 05:27:16
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carrera` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text,
  `fecha_apertura` date DEFAULT NULL,
  `facultad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `anios_cursada` int DEFAULT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre`, `descripcion`, `fecha_apertura`, `facultad`, `anios_cursada`) VALUES
(2, 'Licenciatura en Administración de Empresas', 'Carrera orientada a la gestión y dirección de empresas', '1995-04-01', 'Facultad de Ciencias Económicas', 3),
(1, 'Ingeniería en Informática', 'Carrera orientada hacia el desarrollo de proyectos software y hardware', '1995-04-01', 'Ciencias Exactas', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id_materia` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `horas_cursada` text,
  `forma_aprobacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `carrera` int DEFAULT NULL,
  `anio_cursada` int DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `carrera` (`carrera`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`, `horas_cursada`, `forma_aprobacion`, `carrera`, `anio_cursada`) VALUES
(57, 'Inteligencia Artificial', '85 hrs', 'Con examen final', 1, 3),
(53, 'Bases de Datos', '110 hrs', 'Con examen final', 1, 2),
(54, 'Sistemas Operativos', '100 hrs', 'Con examen final', 1, 2),
(55, 'Redes de Computadoras', '95 hrs', 'Con examen final', 1, 3),
(56, 'Ingeniería de Software', '105 hrs', 'Con examen final', 1, 3),
(52, 'Programación Orientada a Objetos', '90 hrs', 'Con examen final', 1, 2),
(51, 'Algoritmos y Estructuras de Datos', '80 hrs', 'Con examen final', 1, 1),
(50, 'Matemática Discreta', '120 hrs', 'Con examen final', 1, 1),
(1, 'Introducción', '100 hrs', 'promoción', 2, 1),
(2, 'Contabilidad', '120 hsr', 'Con examen Final', 2, 2),
(3, 'Economía', '100 hrs', 'Con examen final', 2, 1),
(4, 'Marketing', '130 hrs', 'Promoción', 2, 2),
(91, 'ejemplo', '6454', 'Con examen Final', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_cursadas`
--

DROP TABLE IF EXISTS `materias_cursadas`;
CREATE TABLE IF NOT EXISTS `materias_cursadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libreta` text NOT NULL,
  `id_materia` int NOT NULL,
  `estado` text,
  `parcial_1` decimal(4,2) NOT NULL,
  `parcial_2` decimal(4,2) NOT NULL,
  `parcial_3` decimal(4,2) NOT NULL,
  `parcial_4` decimal(4,2) NOT NULL,
  `nota_final` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_id_materia` (`id_materia`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `materias_cursadas`
--

INSERT INTO `materias_cursadas` (`id`, `libreta`, `id_materia`, `estado`, `parcial_1`, `parcial_2`, `parcial_3`, `parcial_4`, `nota_final`) VALUES
(24, 'estudiante', 55, 'No cursada', '0.00', '0.00', '0.00', '0.00', '0.00'),
(23, 'estudiante', 56, 'No cursada', '0.00', '0.00', '0.00', '0.00', '0.00'),
(22, 'estudiante', 54, 'Aprobada', '7.00', '7.00', '8.00', '0.00', '3.50'),
(20, 'estudiante', 52, 'Regular', '8.00', '8.00', '8.00', '0.00', '8.00'),
(10, 'estudiante', 51, 'Aprobada', '8.00', '8.00', '7.00', '6.00', '7.00'),
(17, 'estudiante', 49, 'Aprobada', '6.00', '6.00', '6.00', '6.00', '6.00'),
(25, 'estudiante', 57, 'No cursada', '0.00', '0.00', '0.00', '0.00', '0.00'),
(59, 'estudiante', 53, 'Aprobada', '10.00', '10.00', '10.00', '10.00', '10.00'),
(57, 'estudiante', 50, 'Aprobada', '7.00', '7.00', '7.50', '6.00', '6.88'),
(62, 'Ema', 3, 'Aprobada', '7.00', '7.00', '7.00', '7.00', '7.00'),
(61, 'Ema', 1, 'Aprobada', '7.00', '7.00', '7.00', '7.00', '7.00'),
(63, 'estudiante', 0, 'Regular', '8.00', '8.00', '8.00', '8.00', '6.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libreta` text NOT NULL,
  `clave` text NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fechanac` text NOT NULL,
  `Fecha_Inscripcion` date NOT NULL,
  `id_carrera` int NOT NULL,
  `rol` text NOT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `codigopostal` text NOT NULL,
  `celular` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_dni` (`dni`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `libreta`, `clave`, `nombre`, `apellido`, `fechanac`, `Fecha_Inscripcion`, `id_carrera`, `rol`, `dni`, `codigopostal`, `celular`, `email`) VALUES
(1, 'admin', '1234', 'Rosana ', 'Vallejos', '1982-05-19', '0000-00-00', 0, 'Administrador', '29429422', '3340', '3756-505367', 'rov@gmail.com'),
(9, 'estudiante', '1234', 'Juan', 'Pérez', '1982-05-19', '2020-06-08', 1, 'Estudiante', '12345678', '12345', '1234567890', 'juan@example.com'),
(27, 'ejemplo', '54', 'LAURA', 'SOSA', '1999-12-01', '2023-06-29', 2, 'Estudiante', '526363', '2525', '545454', '454@54'),
(26, 'estudiante2', '47488596', 'Romina', 'Perez', '1980-05-01', '2023-06-28', 1, 'Estudiante', '27258963', '1263', '3456321', '32@774'),
(25, 'Ema', '111', 'Guada', 'Lopez', '2011-02-01', '2023-06-28', 2, 'Estudiante', '2052636', '6363', '336', '33@41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
