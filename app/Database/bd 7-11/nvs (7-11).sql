-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 23:01:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

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
  `ip_address` varchar(20) NOT NULL,
  `operating_system` varchar(255) NOT NULL,
  `mac_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id_devices`, `ip_address`, `operating_system`, `mac_address`) VALUES
(36, '192.168.0.23', 'Microsoft Windows XP|2019 (89%)', '6c:fd:b9:a8:1b:2c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `network`
--

CREATE TABLE `network` (
  `id_network` int(11) NOT NULL,
  `signal` varchar(64) NOT NULL,
  `essid` varchar(35) NOT NULL,
  `bssid` varchar(20) NOT NULL,
  `channel` int(11) NOT NULL,
  `id_security_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `network`
--

INSERT INTO `network` (`id_network`, `signal`, `essid`, `bssid`, `channel`, `id_security_type`) VALUES
(13, '-43', 'Fibertel Comba 2.4GHz', '78:45:61:DA:B9:C0', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ports`
--

CREATE TABLE `ports` (
  `id_port` int(11) NOT NULL,
  `port_name` varchar(40) NOT NULL,
  `service` varchar(255) NOT NULL,
  `id_port_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ports`
--

INSERT INTO `ports` (`id_port`, `port_name`, `service`, `id_port_status`) VALUES
(29, '80/tcp', 'http Apache httpd 2.4.58 ((Win64) OpenSSL/3.1.3 PHP/8.2.12)', 1),
(30, '443/tcp', 'ssl/http Apache httpd 2.4.58 ((Win64) OpenSSL/3.1.3 PHP/8.2.12)', 1),
(31, '3306/tcp', 'mysql MariaDB (unauthorized)', 1),
(32, '7680/tcp', 'pando-pub?', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_analysis`
--

CREATE TABLE `port_analysis` (
  `id_analysis` int(11) NOT NULL,
  `id_port` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_analysis`
--

INSERT INTO `port_analysis` (`id_analysis`, `id_port`, `id_devices`) VALUES
(30, 29, 36),
(31, 30, 36),
(32, 31, 36),
(33, 32, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_details`
--

CREATE TABLE `port_details` (
  `id_port_details` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_solution` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_details`
--

INSERT INTO `port_details` (`id_port_details`, `id_analysis`, `id_solution`) VALUES
(54, 30, 51),
(55, 30, 52),
(56, 30, 53),
(57, 30, 54),
(58, 30, 55),
(59, 30, 56),
(60, 30, 57),
(61, 30, 58),
(62, 30, 59),
(63, 30, 60),
(64, 30, 61),
(65, 30, 62),
(66, 30, 63),
(67, 31, 64),
(68, 31, 65),
(69, 31, 66),
(70, 31, 67),
(71, 31, 68),
(72, 31, 69),
(73, 31, 70),
(74, 31, 71),
(75, 31, 72),
(76, 31, 73),
(77, 31, 74),
(78, 31, 75),
(79, 31, 76),
(80, 31, 77),
(81, 31, 78),
(82, 31, 79),
(83, 31, 80),
(84, 31, 81),
(85, 31, 82),
(86, 32, 83),
(87, 33, 84);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_status`
--

CREATE TABLE `port_status` (
  `id_port_status` int(11) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port_status`
--

INSERT INTO `port_status` (`id_port_status`, `status`) VALUES
(1, 'open'),
(2, 'closed'),
(3, 'filtered');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan`
--

CREATE TABLE `scan` (
  `id_scan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_network` int(11) NOT NULL,
  `scan_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan`
--

INSERT INTO `scan` (`id_scan`, `id_user`, `id_network`, `scan_date`) VALUES
(39, 1, 13, '2024-11-04 23:11:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scan_details`
--

CREATE TABLE `scan_details` (
  `id_scan_details` int(11) NOT NULL,
  `id_scan` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan_details`
--

INSERT INTO `scan_details` (`id_scan_details`, `id_scan`, `id_devices`) VALUES
(10, 39, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_type`
--

CREATE TABLE `security_type` (
  `id_security_type` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `security_type`
--

INSERT INTO `security_type` (`id_security_type`, `type`) VALUES
(1, 'wpa'),
(2, 'wpa2'),
(3, 'wpa3'),
(4, 'wpa wpa2'),
(5, 'opn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solution`
--

CREATE TABLE `solution` (
  `id_solution` int(11) NOT NULL,
  `vulnerability_code` varchar(100) NOT NULL,
  `vuln_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solution`
--

INSERT INTO `solution` (`id_solution`, `vulnerability_code`, `vuln_description`) VALUES
(51, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(52, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(53, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(54, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(55, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(56, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(57, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(58, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(59, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(60, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(61, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(62, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(63, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(64, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(65, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(66, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(67, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(68, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(69, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(70, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(71, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(72, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(73, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(74, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(75, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(76, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(77, 'N/A', '|   VULNERABLE:'),
(78, 'N/A', '|     State: LIKELY VULNERABLE'),
(79, 'CVE-2007-6750', 'CVE:CVE-2007-6750'),
(80, 'CVE-2007-6750', '//cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-6750'),
(81, 'N/A', '|   VULNERABLE:'),
(82, 'N/A', '|     State: VULNERABLE'),
(83, 'N/A', 'N/A'),
(84, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'test', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$fiFGhFuX50rERrZ9fe03nOTOWTrzA9TU3E2YBYtUMb/ix3BNe9KW6', '2024-10-17 23:32:13', 0),
(2, 'tiago', 'tiago@gmail.com', '$2y$10$xFLyaMuvMkcMKpCxNwNGEuE9jRfL/p3aeHmM6a6jbbVCkORF9dgwu', '2024-10-22 22:10:00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id_recovery_code`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id_devices`);

--
-- Indices de la tabla `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`id_network`);

--
-- Indices de la tabla `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`);

--
-- Indices de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  ADD PRIMARY KEY (`id_analysis`);

--
-- Indices de la tabla `port_details`
--
ALTER TABLE `port_details`
  ADD PRIMARY KEY (`id_port_details`);

--
-- Indices de la tabla `port_status`
--
ALTER TABLE `port_status`
  ADD PRIMARY KEY (`id_port_status`);

--
-- Indices de la tabla `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id_scan`);

--
-- Indices de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  ADD PRIMARY KEY (`id_scan_details`);

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
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `port_details`
--
ALTER TABLE `port_details`
  MODIFY `id_port_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
