-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2021 a las 02:36:39
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `idemployee` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`idemployee`, `name`, `lastname`, `profile_pic`) VALUES
(1, 'Ignacio', 'Truffa', NULL),
(2, 'Gianfranco', 'Rocco', NULL),
(3, 'Leandro', 'Fernandez', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `managers`
--

CREATE TABLE `managers` (
  `idmanager` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `managers`
--

INSERT INTO `managers` (`idmanager`, `name`, `lastname`, `profile_pic`) VALUES
(1, 'Walt', 'Cossani', NULL),
(2, 'Daniel', 'Stone', NULL),
(3, 'Lauren', 'Collins', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `idproject` int(11) NOT NULL,
  `project_info` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_idproject_manager` int(11) DEFAULT NULL,
  `fk_idassigned_to` int(11) DEFAULT NULL,
  `fk_idstatus` int(11) DEFAULT NULL,
  `uploaded_at` datetime(6) DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`idproject`, `project_info`, `fk_idproject_manager`, `fk_idassigned_to`, `fk_idstatus`, `uploaded_at`, `description`) VALUES
(12, 'this is a test', 2, 1, 3, '2021-01-23 01:26:25.000000', 'asdasd'),
(13, 'Landing page', 3, 2, 1, '2021-01-23 01:26:48.000000', 'Landing page'),
(14, 'project 1', 1, 1, 1, '2021-01-23 01:28:44.000000', 'Landing page');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_status`
--

CREATE TABLE `project_status` (
  `idstatus` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `project_status`
--

INSERT INTO `project_status` (`idstatus`, `status`) VALUES
(1, 'Pending'),
(2, 'Enabled'),
(3, 'Completed');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`idemployee`) USING BTREE;

--
-- Indices de la tabla `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`idmanager`) USING BTREE;

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`idproject`) USING BTREE;

--
-- Indices de la tabla `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`idstatus`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `managers`
--
ALTER TABLE `managers`
  MODIFY `idmanager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `idproject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `project_status`
--
ALTER TABLE `project_status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
