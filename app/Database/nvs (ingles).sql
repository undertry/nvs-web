-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2024 a las 13:52:27
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
-- Estructura de tabla para la tabla `code`
--

CREATE TABLE `code` (
  `id_recovery_code` int(11) NOT NULL,
  `recovery_code` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE `devices` (
  `id_devices` int(11) NOT NULL,
  `ip_address` varchar(12) DEFAULT NULL,
  `operating_system` varchar(30) DEFAULT NULL,
  `mac_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id_devices`, `ip_address`, `operating_system`, `mac_address`) VALUES
(1, '192.168.1.10', 'Windows', '00:1A:2B:3C:4D:5E'),
(2, '10.0.2.15', 'Linux', ' 08:00:27:B6:73'),
(3, '172.217.6.46', 'Android', ' 64:A2:F9:82:1B'),
(4, '192.168.0.10', 'Windows', '00:24:8C:7E:8A:0B'),
(5, '172.205.3.46', 'iOS', '98:01:A7:B4:3F:71');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `network`
--

CREATE TABLE `network` (
  `id_network` int(11) NOT NULL,
  `signal` varchar(6) DEFAULT NULL,
  `essid` varchar(35) DEFAULT NULL,
  `bssid` varchar(18) DEFAULT NULL,
  `id_security_type` int(11) DEFAULT NULL,
  `channel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `network`
--

INSERT INTO `network` (`id_network`, `signal`, `essid`, `bssid`, `id_security_type`, `channel`) VALUES
(1, '-65 dB', 'WindowsNet', '00:1A:2B:3C:4D:5E', 1, 0),
(2, '-70 dB', 'LinuxWiFi', '08:00:27:B6:73', 2, 0),
(3, '-68 dB', 'AndroidAP', ' 64:A2:F9:82:1B', 3, 0),
(4, ' -67 d', ' WindowsWireless', '00:24:8C:7E:8A:0B', 3, 0),
(5, '-72 dB', 'iOSWiFi', '98:01:A7:B4:3F:71', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ports`
--

CREATE TABLE `ports` (
  `id_port` int(11) NOT NULL,
  `port_name` varchar(15) DEFAULT NULL,
  `service` varchar(45) DEFAULT NULL,
  `protocol` varchar(12) DEFAULT NULL,
  `id_port_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ports`
--

INSERT INTO `ports` (`id_port`, `port_name`, `service`, `protocol`, `id_port_status`) VALUES
(1, '80', 'HTTP', 'TCP', 1),
(2, '22', 'SSH', 'TCP', 2),
(3, '5228', 'VNC', 'TCP', 3),
(4, '443', 'HTTPS', 'TCP', 4),
(5, '5223', 'HTTP', 'TCP', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_analysis`
--

CREATE TABLE `port_analysis` (
  `id_analysis` int(11) NOT NULL,
  `id_port` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_analysis`
--

INSERT INTO `port_analysis` (`id_analysis`, `id_port`, `id_devices`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_status`
--

CREATE TABLE `port_status` (
  `id_port_status` int(11) NOT NULL,
  `open` tinyint(1) DEFAULT NULL,
  `close` tinyint(1) DEFAULT NULL,
  `filtered` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_status`
--

INSERT INTO `port_status` (`id_port_status`, `open`, `close`, `filtered`) VALUES
(1, 1, 0, 0),
(2, 1, 0, 0),
(3, 0, 0, 1),
(4, 0, 1, 0),
(5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan`
--

CREATE TABLE `scan` (
  `id_scan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_network` int(11) DEFAULT NULL,
  `scan_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan`
--

INSERT INTO `scan` (`id_scan`, `id_user`, `id_network`, `scan_date`) VALUES
(1, 1, 1, '2024-06-11 13:05:03'),
(2, 2, 2, '2024-06-02 14:02:34'),
(3, 1, 3, '2024-08-16 11:41:21'),
(4, 1, 4, '2024-06-26 00:05:01'),
(5, 38, 2, '2024-08-16 11:49:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan_details`
--

CREATE TABLE `scan_details` (
  `id_scan_details` int(11) NOT NULL,
  `id_scan` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL,
  `id_solution` int(11) DEFAULT NULL,
  `vulnerability_code` varchar(100) NOT NULL,
  `vulnerability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan_details`
--

INSERT INTO `scan_details` (`id_scan_details`, `id_scan`, `id_devices`, `id_solution`, `vulnerability_code`, `vulnerability`) VALUES
(1, 1, 1, 1, 'CVE-2017-0143 ', 1),
(2, 2, 2, 7, 'CVE-2016-5195', 1),
(3, 3, 3, 9, 'CVE-2015-7547', 1),
(5, 5, 2, 7, 'CVE-2016-5195', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_type`
--

CREATE TABLE `security_type` (
  `id_security_type` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `security_type`
--

INSERT INTO `security_type` (`id_security_type`, `type`) VALUES
(1, 'WEP'),
(2, 'WPA'),
(3, 'WPA2'),
(4, 'WPA3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solution`
--

CREATE TABLE `solution` (
  `id_solution` int(11) NOT NULL,
  `solution` varchar(255) DEFAULT NULL,
  `vulnerability_code` varchar(255) NOT NULL,
  `vuln_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solution`
--

INSERT INTO `solution` (`id_solution`, `solution`, `vulnerability_code`, `vuln_description`) VALUES
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
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'Tiago Comba', 'tiagocomba@gmail.com', '$2y$10$hR4ZI9WGXcnTZgsVdI2K6.GRiwVclxlpHMxIfzg7iHOWOUlTu81Y.', '2024-06-27 02:17:33', 0),
(2, 'Ezequiel Monteverde', 'eze@gmail.com', '$2y$10$rfCt5w4s7gt6zX/ga2Cb3epPqKr637uwscK.CgMmSRj11RM9VEc5O', '2024-06-27 16:38:28', 0),
(3, 'Octavio Galarza', 'octavio@gmail.com', '$2y$10$iRbBLO9mDATXsD4exG5EP.cngyQVGoBJQAYdk/8g3tve3uUw.6YzO', '2024-06-19 11:56:50', 0),
(4, 'Pedro Carranza', 'pedro@gmail.com', '$2y$10$HTDMeI3Ei6SVp5ZSNDey4.B9aPxqd9gbdyWc4i3lGHLYnHLuq9pLW', '2024-06-19 11:58:00', 0),
(5, 'Marcelo Asevedo', 'marcelo@gmail.com', '$2y$10$rKejczKDIuMkI2spq3IajuKL96MLjYHyXsx/9OE5EC.fO0ceoJj6a', '2024-06-19 11:58:50', 0),
(38, 'eze', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$mH8SrWcCM1X0jioeom.lbepYkB17qKcUpcXffBhpQ1slefNxs2ATy', '2024-08-16 11:48:49', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id_recovery_code`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id_devices`);

--
-- Indices de la tabla `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`id_network`),
  ADD KEY `id_tipo_seguridad` (`id_security_type`);

--
-- Indices de la tabla `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`),
  ADD KEY `id_estado_puerto` (`id_port_status`);

--
-- Indices de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  ADD PRIMARY KEY (`id_analysis`),
  ADD KEY `id_puerto` (`id_port`),
  ADD KEY `id_dispositivos` (`id_devices`);

--
-- Indices de la tabla `port_status`
--
ALTER TABLE `port_status`
  ADD PRIMARY KEY (`id_port_status`);

--
-- Indices de la tabla `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id_scan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_red` (`id_network`);

--
-- Indices de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  ADD PRIMARY KEY (`id_scan_details`),
  ADD KEY `id_scan` (`id_scan`),
  ADD KEY `id_dispositivos` (`id_devices`),
  ADD KEY `id_solucion` (`id_solution`);

--
-- Indices de la tabla `security_type`
--
ALTER TABLE `security_type`
  ADD PRIMARY KEY (`id_security_type`);

--
-- Indices de la tabla `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id_solution`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `code`
--
ALTER TABLE `code`
  MODIFY `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `code`
--
ALTER TABLE `code`
  ADD CONSTRAINT `code_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `network`
--
ALTER TABLE `network`
  ADD CONSTRAINT `network_ibfk_1` FOREIGN KEY (`id_security_type`) REFERENCES `security_type` (`id_security_type`);

--
-- Filtros para la tabla `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `ports_ibfk_1` FOREIGN KEY (`id_port_status`) REFERENCES `port_status` (`id_port_status`);

--
-- Filtros para la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  ADD CONSTRAINT `port_analysis_ibfk_1` FOREIGN KEY (`id_port`) REFERENCES `ports` (`id_port`),
  ADD CONSTRAINT `port_analysis_ibfk_2` FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`);

--
-- Filtros para la tabla `scan`
--
ALTER TABLE `scan`
  ADD CONSTRAINT `scan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `scan_ibfk_2` FOREIGN KEY (`id_network`) REFERENCES `network` (`id_network`);

--
-- Filtros para la tabla `scan_details`
--
ALTER TABLE `scan_details`
  ADD CONSTRAINT `scan_details_ibfk_1` FOREIGN KEY (`id_scan`) REFERENCES `scan` (`id_scan`),
  ADD CONSTRAINT `scan_details_ibfk_2` FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`),
  ADD CONSTRAINT `scan_details_ibfk_3` FOREIGN KEY (`id_solution`) REFERENCES `solution` (`id_solution`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
