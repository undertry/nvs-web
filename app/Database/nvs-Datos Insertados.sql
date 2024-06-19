-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2024 a las 15:20:56
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
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo`
--

CREATE TABLE `codigo` (
  `id_codigo_recuperacion` int(11) NOT NULL,
  `cod_recup` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '192.168.1.10', 'Windows', '00:1A:2B:3C:4D:5E'),
(2, '10.0.2.15', 'Linux', ' 08:00:27:B6:73'),
(3, '172.217.6.46', 'Android', ' 64:A2:F9:82:1B'),
(4, '192.168.0.10', 'Windows', '00:24:8C:7E:8A:0B'),
(5, '172.205.3.46', 'iOS', '98:01:A7:B4:3F:71');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_puerto`
--

CREATE TABLE `estado_puerto` (
  `id_estado_puerto` int(11) NOT NULL,
  `abierto` tinyint(1) DEFAULT NULL,
  `cerrado` tinyint(1) DEFAULT NULL,
  `filtrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_puerto`
--

INSERT INTO `estado_puerto` (`id_estado_puerto`, `abierto`, `cerrado`, `filtrado`) VALUES
(1, 0, 1, 0),
(2, 1, 0, 0),
(3, 0, 0, 1),
(4, 0, 1, 0),
(5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puertos`
--

CREATE TABLE `puertos` (
  `id_puerto` int(11) NOT NULL,
  `puerto_nombre` varchar(15) DEFAULT NULL,
  `servicio` varchar(45) DEFAULT NULL,
  `protocolo` varchar(12) DEFAULT NULL,
  `id_estado_puerto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puertos`
--

INSERT INTO `puertos` (`id_puerto`, `puerto_nombre`, `servicio`, `protocolo`, `id_estado_puerto`) VALUES
(1, '80', 'HTTP', 'TCP', 1),
(2, '22', 'SSH', 'TCP', 2),
(3, '5228', 'VNC', 'TCP', 3),
(4, '443', 'HTTPS', 'TCP', 4),
(5, '5223', 'HTTP', 'TCP', 5);

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
(1, '192.168.1.0/24', '-65 dBm', 'WindowsNet', '00:1A:2B:3C:4D:5E', 1),
(2, '10.0.0.0/24', '-70 dBm', 'LinuxWiFi', '08:00:27:B6:73', 2),
(3, '172.16.0.0/24', '-68 dBm', 'AndroidAP', ' 64:A2:F9:82:1B', 3),
(4, '192.168.0.0/24', ' -67 dBm', ' WindowsWireless', '00:24:8C:7E:8A:0B', 3),
(5, '192.168.0.0/24', '-72 dBm', 'iOSWiFi', '98:01:A7:B4:3F:71', 4);

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
(1, 1, 1, '2024-06-11 13:05:03'),
(2, 2, 2, '2024-06-02 14:02:34'),
(3, 3, 3, '2024-05-15 21:26:12'),
(4, 4, 4, '2024-06-01 10:59:00'),
(5, 5, 5, '2014-05-23 15:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solucion`
--

CREATE TABLE `solucion` (
  `id_solucion` int(11) NOT NULL,
  `solucion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'WEP'),
(2, 'WPA'),
(3, 'WPA2'),
(4, 'WPA3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Tiago Comba', 'tiagocomba@gmail.com', '$2y$10$/Dzko5dYAR3bda3QaIvLku0XrR8JIRReQzwbK1qDCFHzNFEbbLAF.', '2024-06-19 11:51:50'),
(2, 'Ezequiel Monteverde', 'eze@gmail.com', '$2y$10$EXqfxNoo/yvXzlXjIQBG5.Et1Ks5UK7rTxYkz3vwMqTghpBBHazTO', '2024-06-19 11:55:41'),
(3, 'Octavio Galarza', 'octavio@gmail.com', '$2y$10$iRbBLO9mDATXsD4exG5EP.cngyQVGoBJQAYdk/8g3tve3uUw.6YzO', '2024-06-19 11:56:50'),
(4, 'Pedro Carranza', 'pedro@gmail.com', '$2y$10$HTDMeI3Ei6SVp5ZSNDey4.B9aPxqd9gbdyWc4i3lGHLYnHLuq9pLW', '2024-06-19 11:58:00'),
(5, 'Marcelo Asevedo', 'marcelo@gmail.com', '$2y$10$rKejczKDIuMkI2spq3IajuKL96MLjYHyXsx/9OE5EC.fO0ceoJj6a', '2024-06-19 11:58:50');

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
-- Indices de la tabla `codigo`
--
ALTER TABLE `codigo`
  ADD PRIMARY KEY (`id_codigo_recuperacion`),
  ADD KEY `id_user` (`id_user`);

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
-- Indices de la tabla `estado_puerto`
--
ALTER TABLE `estado_puerto`
  ADD PRIMARY KEY (`id_estado_puerto`);

--
-- Indices de la tabla `puertos`
--
ALTER TABLE `puertos`
  ADD PRIMARY KEY (`id_puerto`),
  ADD KEY `id_estado_puerto` (`id_estado_puerto`);

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
-- AUTO_INCREMENT de la tabla `codigo`
--
ALTER TABLE `codigo`
  MODIFY `id_codigo_recuperacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  MODIFY `id_det_scan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_puerto`
--
ALTER TABLE `estado_puerto`
  MODIFY `id_estado_puerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_solucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_seguridad`
--
ALTER TABLE `tipo_seguridad`
  MODIFY `id_tipo_seguridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Filtros para la tabla `codigo`
--
ALTER TABLE `codigo`
  ADD CONSTRAINT `codigo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);

--
-- Filtros para la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  ADD CONSTRAINT `detalle_scan_ibfk_1` FOREIGN KEY (`id_scan`) REFERENCES `scan` (`id_scan`),
  ADD CONSTRAINT `detalle_scan_ibfk_2` FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`),
  ADD CONSTRAINT `detalle_scan_ibfk_3` FOREIGN KEY (`id_solucion`) REFERENCES `solucion` (`id_solucion`);

--
-- Filtros para la tabla `puertos`
--
ALTER TABLE `puertos`
  ADD CONSTRAINT `puertos_ibfk_1` FOREIGN KEY (`id_estado_puerto`) REFERENCES `estado_puerto` (`id_estado_puerto`);

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
