-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 15:25:02
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
-- Base de datos: `nvs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisis_puertos`
--

CREATE TABLE `analisis_puertos` (
  `id_analisis` int(11) NOT NULL,
  `id_puerto` int(11) DEFAULT NULL,
  `id_dispositivos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `analisis_puertos`
--
ALTER TABLE `analisis_puertos`
  ADD PRIMARY KEY (`id_analisis`),
  ADD KEY `id_puerto` (`id_puerto`),
  ADD KEY `id_dispositivos` (`id_dispositivos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `analisis_puertos`
--
ALTER TABLE `analisis_puertos`
  MODIFY `id_analisis` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `analisis_puertos`
--
ALTER TABLE `analisis_puertos`
  ADD CONSTRAINT `analisis_puertos_ibfk_1` FOREIGN KEY (`id_puerto`) REFERENCES `puertos` (`id_puerto`),
  ADD CONSTRAINT `analisis_puertos_ibfk_2` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
