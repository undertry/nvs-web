-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2024 a las 18:47:41
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
  `id_solucion` int(11) DEFAULT NULL,
  `codigo_vul` varchar(100) NOT NULL,
  `vulnerabilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_scan`
--

INSERT INTO `detalle_scan` (`id_det_scan`, `id_scan`, `id_dispositivos`, `id_solucion`, `codigo_vul`, `vulnerabilidad`) VALUES
(1, 1, 1, 1, 'CVE-2017-0143 ', 1),
(2, 2, 2, 7, 'CVE-2016-5195', 1),
(3, 3, 3, 9, 'CVE-2015-7547', 1),
(5, 5, 2, 7, 'CVE-2016-5195', 1);

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
(1, 1, 0, 0),
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
(3, 9, 3, '2024-07-24 13:36:37'),
(4, 1, 4, '2024-06-26 00:05:01'),
(5, 9, 2, '2024-07-24 13:34:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solucion`
--

CREATE TABLE `solucion` (
  `id_solucion` int(11) NOT NULL,
  `solucion` varchar(255) DEFAULT NULL,
  `codigo_vulnerabilidad` varchar(255) NOT NULL,
  `descripcion_vuln` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solucion`
--

INSERT INTO `solucion` (`id_solucion`, `solucion`, `codigo_vulnerabilidad`, `descripcion_vuln`) VALUES
(1, 'Instalar las actualizaciones de seguridad proporcionadas por Microsoft. Esta vulnerabilidad fue parcheada con actualizaciones de seguridad de Microsoft Windows.', 'CVE-2017-0143 ', 'Vulnerabilidad en el protocolo SMB de Windows que permite ejecución remota de código.'),
(2, 'Actualizar Microsoft Edge a la versión más reciente disponible. Microsoft lanzó parches para corregir esta vulnerabilidad.', 'CVE-2018-8174', 'Vulnerabilidad en el motor de scripting de Microsoft Edge que permite ejecución remota de código.'),
(3, 'Aplicar los parches de seguridad disponibles para las versiones afectadas de Windows. Microsoft proporcionó parches incluso para sistemas operativos fuera de soporte estándar.', 'CVE-2019-0708', 'Vulnerabilidad en el servicio de Escritorio remoto de Windows (BlueKeep) que permite ejecución remota de código sin autenticación.'),
(4, 'Instalar las actualizaciones de seguridad de Windows. Microsoft lanzó parches para corregir esta vulnerabilidad.', 'CVE-2020-0601', 'Vulnerabilidad en la validación de certificados en Windows CryptoAPI que permite suplantación de identidad.'),
(5, 'Aplicar las actualizaciones de seguridad proporcionadas por Microsoft. Además, se recomienda deshabilitar el servicio de impresión si no es esencial.', 'CVE-2021-34527 ', 'Vulnerabilidad en el servicio de impresión de Windows (PrintNightmare) que permite escalada de privilegios y ejecución remota de código.'),
(6, 'Actualizar Apache Log4j a la versión 2.15.0 o superior, que corrige esta vulnerabilidad. También es importante asegurarse de que todas las dependencias y aplicaciones que utilizan Log4j estén actualizadas.', 'CVE-2021-44228', 'Vulnerabilidad crítica en la biblioteca de registro Log4j utilizada en aplicaciones Java que permite la ejecución remota de código.'),
(7, 'Aplicar las actualizaciones del kernel proporcionadas por el proveedor de la distribución de Linux. Reiniciar los sistemas afectados tras aplicar las actualizaciones.', 'CVE-2016-5195', 'Vulnerabilidad en el kernel de Linux (Dirty COW) que permite escalada de privilegios.'),
(8, 'Actualizar Adobe Flash Player a la última versión disponible. Adobe lanzó parches para corregir esta vulnerabilidad.', 'CVE-2018-4878', 'Vulnerabilidad en Adobe Flash Player que permite ejecución remota de código.'),
(9, 'Aplicar las actualizaciones de seguridad proporcionadas por el proveedor de la distribución de Linux. Reiniciar los sistemas afectados tras aplicar las actualizaciones.', 'CVE-2015-7547', 'Vulnerabilidad en la librería GNU C (glibc) que permite ejecución remota de código.');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'Tiago Comba', 'tiagocomba@gmail.com', '$2y$10$hR4ZI9WGXcnTZgsVdI2K6.GRiwVclxlpHMxIfzg7iHOWOUlTu81Y.', '2024-06-27 02:17:33', 0),
(2, 'Ezequiel Monteverde', 'eze@gmail.com', '$2y$10$rfCt5w4s7gt6zX/ga2Cb3epPqKr637uwscK.CgMmSRj11RM9VEc5O', '2024-06-27 16:38:28', 0),
(3, 'Octavio Galarza', 'octavio@gmail.com', '$2y$10$iRbBLO9mDATXsD4exG5EP.cngyQVGoBJQAYdk/8g3tve3uUw.6YzO', '2024-06-19 11:56:50', 0),
(4, 'Pedro Carranza', 'pedro@gmail.com', '$2y$10$HTDMeI3Ei6SVp5ZSNDey4.B9aPxqd9gbdyWc4i3lGHLYnHLuq9pLW', '2024-06-19 11:58:00', 0),
(5, 'Marcelo Asevedo', 'marcelo@gmail.com', '$2y$10$rKejczKDIuMkI2spq3IajuKL96MLjYHyXsx/9OE5EC.fO0ceoJj6a', '2024-06-19 11:58:50', 0),
(6, 'eze', 'eze123@gmail.com', '$2y$10$YkObUX7kkKHXIPyQsqQkHOkmA17IZfGBE1KUHok8G.xMUWugIsFr6', '2024-07-26 11:49:16', 0),
(8, 'Marcelo', 'marceloasevedo@itr3.edu.ar', '$2y$10$PPs/cXYqLb8KtV.g.C9ZFuZ1ex4jEXWb8Lv.i6ERwnju3WJyxgzBu', '2024-06-27 11:57:11', 0),
(9, 'Laureano', 'laureanopeirone@alumnos.itr3.edu.ar', '$2y$10$M4bVB5LRV2QRtI3/pQDr9OyWxEijqKfzzFDC084DASOGV0keVVA3O', '2024-07-25 16:47:19', 0),
(23, 'gaspar', 'gasparschwartz@alumnos.itr3.edu.ar', '$2y$10$Lq/lrLSnCOUsFtrRAEc9luQUCZ4rWv.jqYSZ8CEkm4W.rOhEYwjQm', '2024-07-31 13:07:04', 0),
(24, 'eze', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$a662NHdE/Oi9ZzaO8zqEGOG8TwonoGyYh..DDiRqgrpEzZE.V.im2', '2024-08-01 16:41:15', 0),
(25, 'tiago', 'tiagocomba@alumnos.itr3.edu.ar', '$2y$10$rWuYYHMzS/yftJ4CD2nsBeRWM6wSboyG3TqG9nIe9qchjXFQAP1zS', '2024-08-01 16:45:45', 0);

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
  MODIFY `id_codigo_recuperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_scan`
--
ALTER TABLE `detalle_scan`
  MODIFY `id_det_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solucion`
--
ALTER TABLE `solucion`
  MODIFY `id_solucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_seguridad`
--
ALTER TABLE `tipo_seguridad`
  MODIFY `id_tipo_seguridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
