-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 13:55:13
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
-- Volcado de datos para la tabla `analisis_puertos`
--

INSERT INTO `analisis_puertos` (`id_analisis`, `id_puerto`, `id_dispositivos`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 5, 3),
(4, 2, 4),
(5, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_scan`
--

CREATE TABLE `detalle_scan` (
  `id_det_scan` int(11) NOT NULL,
  `id_scan` int(11) DEFAULT NULL,
  `id_dispositivos` int(11) DEFAULT NULL,
  `id_solucion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_scan`
--

INSERT INTO `detalle_scan` (`id_det_scan`, `id_scan`, `id_dispositivos`, `id_solucion`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 3),
(4, 4, 4, 4),
(5, 5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id_dispositivos` int(11) NOT NULL,
  `direccion_ip` varchar(12) DEFAULT NULL,
  `sistema_operativo` varchar(30) DEFAULT NULL,
  `dir_mac` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id_dispositivos`, `direccion_ip`, `sistema_operativo`, `dir_mac`) VALUES
(1, '192.168.1.10', 'Windows 10', '00:11:22:33:44:55'),
(2, '192.168.1.10', 'Linux Ubuntu', 'AA:BB:CC:DD:EE:FF'),
(3, '192.168.1.10', 'MacOS', '11:22:33:44:55:66'),
(4, '192.168.1.10', 'Android', 'BB:CC:DD:EE:FF:AA'),
(5, '192.168.1.10', 'iOS', 'CC:DD:EE:FF:AA:BB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puertos`
--

CREATE TABLE `puertos` (
  `id_puerto` int(11) NOT NULL,
  `puerto_nombre` varchar(15) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `servicio` varchar(45) DEFAULT NULL,
  `protocolo` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puertos`
--

INSERT INTO `puertos` (`id_puerto`, `puerto_nombre`, `estado`, `servicio`, `protocolo`) VALUES
(1, '80', 'Abierto', 'HTTP', 'TCP'),
(2, '22', 'Cerrado', 'SSH', 'TCP'),
(3, '443', 'Abierto', 'HTTPS', 'TCP'),
(4, '21', 'Cerrado', 'FTP', 'TCP'),
(5, '25', 'Abierto', 'SMTP', 'TCP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red`
--

CREATE TABLE `red` (
  `id_red` int(11) NOT NULL,
  `direccion_red` varchar(22) DEFAULT NULL,
  `potencia` varchar(64) DEFAULT NULL,
  `essid` varchar(35) DEFAULT NULL,
  `bssid` varchar(18) DEFAULT NULL,
  `id_tipo_seguridad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `red`
--

INSERT INTO `red` (`id_red`, `direccion_red`, `potencia`, `essid`, `bssid`, `id_tipo_seguridad`) VALUES
(1, '192.168.1.0', 'Alta', 'MiRed1', '00:11:22:33:44:55', 1),
(2, '10.0.0.0', 'Media', 'Casa', 'AA:BB:CC:DD:EE:FF', 2),
(3, '172.16.0.0', 'Baja', 'Oficina', '11:22:33:44:55:66', 3),
(4, '192.168.2.0', 'Alta', 'Empresa', 'BB:CC:DD:EE:FF:AA', 1),
(5, '10.1.1.0', 'Media', 'OtroWifi', 'CC:DD:EE:FF:AA:BB', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan`
--

CREATE TABLE `scan` (
  `id_scan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_red` int(11) DEFAULT NULL,
  `fecha_scan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan`
--

INSERT INTO `scan` (`id_scan`, `id_user`, `id_red`, `fecha_scan`) VALUES
(1, 1, 1, '2024-05-14 11:00:00'),
(2, 2, 2, '2024-05-14 12:00:00'),
(3, 3, 3, '2024-05-14 13:00:00'),
(4, 4, 4, '2024-05-14 14:00:00'),
(5, 5, 5, '2024-05-14 15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solucion`
--

CREATE TABLE `solucion` (
  `id_solucion` int(11) NOT NULL,
  `solucion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solucion`
--

INSERT INTO `solucion` (`id_solucion`, `solucion`) VALUES
(1, 'Actualizar firmware del router'),
(2, 'Cambiar contraseña por una más segura'),
(3, 'Desactivar el broadcast del SSID'),
(4, 'Configurar MAC filtering'),
(5, 'Actualizar software del dispositivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_seguridad`
--

CREATE TABLE `tipo_seguridad` (
  `id_tipo_seguridad` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_seguridad`
--

INSERT INTO `tipo_seguridad` (`id_tipo_seguridad`, `tipo`) VALUES
(1, 'WPA2'),
(2, 'WPA'),
(3, 'WEP'),
(4, 'Sin seguridad'),
(5, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cod_recup` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `name`, `email`, `password`, `cod_recup`, `created_at`) VALUES
(1, 'Ana', 'ana@example.com', 'password123', '', '2024-05-24 11:26:16'),
(2, 'Carlos', 'carlos@example.com', 'securepass', '', '2024-05-24 11:26:13'),
(3, 'María', 'maria@example.com', 'mysecretpassword', '', '2024-05-24 11:26:07'),
(4, 'Pedro', 'pedro@example.com', '123456789', '', '2024-05-24 11:26:10'),
(5, 'Laura', 'laura@example.com', 'password', '', '2024-05-24 11:25:59'),
(6, 'pepito', 'pepito@gmail.com', '$2y$10$wQSNMiwmhFP3NbZyL.YdNucBJab4SowJI76neFDUEuDTB/Zfk9bKG', 'f4VpmOpu', '2024-05-24 11:38:05'),
(7, 'fsesfesf', 'esfsef@gmail.com', '$2y$10$Lvc4O7ukEDjxkZVBWybe6eoSkqVgJFRMln0m4UXL.wn6G6UHMBsMy', 'ibXqBMZ8', '2024-05-24 11:48:49'),
(8, 'wdwddwwd', 'wdwdwd@gmail.com', '$2y$10$0GYegQp1JeA37byatnyqO.P3oTvHR0BsaUJCrARS0dXr.FAec7sRO', 'E7abZuOA', '2024-05-24 11:50:54');

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
-- Indices de la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  ADD PRIMARY KEY (`id_det_scan`),
  ADD KEY `id_scan` (`id_scan`),
  ADD KEY `id_dispositivos` (`id_dispositivos`),
  ADD KEY `id_solucion` (`id_solucion`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivos`);

--
-- Indices de la tabla `puertos`
--
ALTER TABLE `puertos`
  ADD PRIMARY KEY (`id_puerto`);

--
-- Indices de la tabla `red`
--
ALTER TABLE `red`
  ADD PRIMARY KEY (`id_red`),
  ADD KEY `id_tipo_seguridad` (`id_tipo_seguridad`);

--
-- Indices de la tabla `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id_scan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_red` (`id_red`);

--
-- Indices de la tabla `solucion`
--
ALTER TABLE `solucion`
  ADD PRIMARY KEY (`id_solucion`);

--
-- Indices de la tabla `tipo_seguridad`
--
ALTER TABLE `tipo_seguridad`
  ADD PRIMARY KEY (`id_tipo_seguridad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `analisis_puertos`
--
ALTER TABLE `analisis_puertos`
  MODIFY `id_analisis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  MODIFY `id_det_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `puertos`
--
ALTER TABLE `puertos`
  MODIFY `id_puerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `red`
--
ALTER TABLE `red`
  MODIFY `id_red` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solucion`
--
ALTER TABLE `solucion`
  MODIFY `id_solucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_seguridad`
--
ALTER TABLE `tipo_seguridad`
  MODIFY `id_tipo_seguridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `analisis_puertos`
--
ALTER TABLE `analisis_puertos`
  ADD CONSTRAINT `analisis_puertos_ibfk_1` FOREIGN KEY (`id_puerto`) REFERENCES `puertos` (`id_puerto`),
  ADD CONSTRAINT `analisis_puertos_ibfk_2` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`);

--
-- Filtros para la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  ADD CONSTRAINT `detalle_scan_ibfk_1` FOREIGN KEY (`id_scan`) REFERENCES `scan` (`id_scan`),
  ADD CONSTRAINT `detalle_scan_ibfk_2` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`),
  ADD CONSTRAINT `detalle_scan_ibfk_3` FOREIGN KEY (`id_solucion`) REFERENCES `solucion` (`id_solucion`);

--
-- Filtros para la tabla `red`
--
ALTER TABLE `red`
  ADD CONSTRAINT `red_ibfk_1` FOREIGN KEY (`id_tipo_seguridad`) REFERENCES `tipo_seguridad` (`id_tipo_seguridad`);

--
-- Filtros para la tabla `scan`
--
ALTER TABLE `scan`
  ADD CONSTRAINT `scan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`),
  ADD CONSTRAINT `scan_ibfk_2` FOREIGN KEY (`id_red`) REFERENCES `red` (`id_red`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
