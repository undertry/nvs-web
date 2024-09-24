-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 16:19:21
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
(1, '192.168.1.2', 'Linux', '01:23:45:67:89:AB'),
(2, '192.168.1.3', 'Windows', '01:23:45:67:89:AC'),
(3, '192.168.1.4', 'macOS', '01:23:45:67:89:AD'),
(4, '192.168.1.5', 'Android', '01:23:45:67:89:AE'),
(5, '192.168.1.6', 'iOS', '01:23:45:67:89:AF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `network`
--

CREATE TABLE `network` (
  `id_network` int(11) NOT NULL,
  `signal` varchar(64) DEFAULT NULL,
  `essid` varchar(35) DEFAULT NULL,
  `bssid` varchar(18) DEFAULT NULL,
  `channel` int(11) DEFAULT NULL,
  `id_security_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `network`
--

INSERT INTO `network` (`id_network`, `signal`, `essid`, `bssid`, `channel`, `id_security_type`) VALUES
(1, 'strong', 'Network_1', '00:14:22:01:23:45', 6, 1),
(2, 'medium', 'Network_2', '00:14:22:01:23:46', 11, 2),
(3, 'weak', 'Network_3', '00:14:22:01:23:47', 1, 3),
(4, 'strong', 'Network_4', '00:14:22:01:23:48', 11, 4),
(5, 'medium', 'Network_5', '00:14:22:01:23:49', 6, 2);

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
(1, 'HTTP', 'Web Service', 'TCP', 1),
(2, 'SSH', 'Secure Shell', 'TCP', 1),
(3, 'DNS', 'Domain Service', 'UDP', 2),
(4, 'FTP', 'File Transfer', 'TCP', 1),
(5, 'SMTP', 'Email Service', 'TCP', 2),
(6, 'IMAP', 'Email Service', 'TCP', 1),
(7, 'HTTPS', 'Secure Web Service', 'TCP', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_analysis`
--

CREATE TABLE `port_analysis` (
  `id_analysis` int(11) NOT NULL,
  `id_port` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL,
  `id_solution` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_analysis`
--

INSERT INTO `port_analysis` (`id_analysis`, `id_port`, `id_devices`, `id_solution`) VALUES
(27, 1, 1, 1),
(28, 2, 1, 2),
(29, 4, 1, 4),
(30, 3, 2, 3),
(31, 5, 2, 5),
(32, 1, 3, 1),
(33, 2, 3, 2),
(34, 6, 3, 1),
(35, 4, 4, 4),
(36, 7, 4, 1),
(37, 3, 5, 3),
(38, 5, 5, 5),
(39, 7, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_status`
--

CREATE TABLE `port_status` (
  `id_port_status` int(11) NOT NULL,
  `open` tinyint(4) DEFAULT NULL,
  `close` tinyint(4) DEFAULT NULL,
  `filtered` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_status`
--

INSERT INTO `port_status` (`id_port_status`, `open`, `close`, `filtered`) VALUES
(1, 1, 0, 0),
(2, 0, 1, 0),
(3, 0, 0, 1),
(4, 1, 0, 0),
(5, 0, 1, 0);

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
(1, 1, 1, '2024-09-20 22:04:56'),
(2, 2, 2, '2024-09-20 22:05:00'),
(3, 3, 3, '2024-09-20 22:05:02'),
(4, 4, 4, '2024-09-20 22:05:05'),
(5, 5, 5, '2024-09-20 22:05:09'),
(6, 5, 5, '2024-09-20 22:05:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan_details`
--

CREATE TABLE `scan_details` (
  `id_scan_details` int(11) NOT NULL,
  `id_scan` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan_details`
--

INSERT INTO `scan_details` (`id_scan_details`, `id_scan`, `id_devices`) VALUES
(83, 1, 1),
(84, 1, 2),
(85, 1, 3),
(86, 2, 2),
(87, 2, 3),
(88, 3, 3),
(89, 3, 4),
(90, 4, 4),
(91, 4, 5),
(92, 5, 5),
(93, 5, 1);

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
  `vulnerability_code` varchar(100) DEFAULT NULL,
  `vuln_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solution`
--

INSERT INTO `solution` (`id_solution`, `solution`, `vulnerability_code`, `vuln_description`) VALUES
(1, 'Patch applied', 'CVE-1234-5678', 'Critical vulnerability in Web Service'),
(2, 'Firewall updated', 'CVE-2345-6789', 'SSH port exposed to public internet'),
(3, 'DNS settings secured', 'CVE-3456-7890', 'DNS vulnerability detected'),
(4, 'FTP vulnerability fixed', 'CVE-4567-8901', 'FTP protocol has unencrypted access'),
(5, 'SMTP firewall rule applied', 'CVE-5678-9012', 'Email service ports are exposed');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'eze', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$CDqEM16rCrVz.eGJe9EX9OwV8TVJO7ZCRNBbxJQMoN/I3MvY8WAtC', '2024-09-20 21:51:41', 0),
(2, 'test', 'test@gmail.com', '$2y$10$EciS8nVgk.0nRPAuW6MM4un3R6xUFmgoFcuTqoW43ksxV.wKWkcgK', '2024-09-20 21:47:07', 0),
(3, 'test1', 'test1@gmail.com', '$2y$10$VffnIfAc46s1LUZL5o0hhOPhrEx1sLhKuG0ICFzBoq7vZ1wz1NLUO', '2024-09-20 21:47:38', 0),
(4, 'test2', 'test2@gmail.com', '$2y$10$hyv6kyTKYEKcUn8e/6ucJ.crXVc52Crp9ARo78cLYRRAAytZyiRCa', '2024-09-20 21:48:06', 0),
(5, 'test3', 'test3@gmail.com', '$2y$10$4/D6hHzkfb28vohqOhM3Ne/EEq6GStleK29lLAt.hS.a58C3xkeuS', '2024-09-20 21:48:30', 0),
(6, 'test4', 'test4@gmail.com', '$2y$10$32nio87V8xgoRH/2gqRuheej99/v2agYQpBTLYwBM5cYokbR8jQim', '2024-09-20 21:50:35', 0);

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
  ADD KEY `id_security_type` (`id_security_type`);

--
-- Indices de la tabla `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`),
  ADD KEY `id_port_status` (`id_port_status`);

--
-- Indices de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  ADD PRIMARY KEY (`id_analysis`),
  ADD KEY `id_port` (`id_port`),
  ADD KEY `id_devices` (`id_devices`),
  ADD KEY `id_solution` (`id_solution`);

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
  ADD KEY `id_network` (`id_network`);

--
-- Indices de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  ADD PRIMARY KEY (`id_scan_details`),
  ADD KEY `id_scan` (`id_scan`),
  ADD KEY `id_devices` (`id_devices`);

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
  MODIFY `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `port_analysis_ibfk_2` FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`),
  ADD CONSTRAINT `port_analysis_ibfk_3` FOREIGN KEY (`id_solution`) REFERENCES `solution` (`id_solution`);

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
  ADD CONSTRAINT `scan_details_ibfk_2` FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
