-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2024 a las 13:54:26
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
(1, '11.111.11.1', 'windows', 'MAC'),
(2, '22.22.22.22', 'linux', 'MAC');

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
(1, 'señal', 'essid', 'bssid', 1233, 2);

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
(1, 'puerto 1', 'servicio 1', 'protocolo 1', 1),
(2, 'puerto 2', 'servicio 2', 'protocolo 2', 3);

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
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port_status`
--

CREATE TABLE `port_status` (
  `id_port_status` int(11) NOT NULL,
  `status` varchar(9) DEFAULT NULL
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
  `id_user` int(11) DEFAULT NULL,
  `id_network` int(11) DEFAULT NULL,
  `scan_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scan`
--

INSERT INTO `scan` (`id_scan`, `id_user`, `id_network`, `scan_date`) VALUES
(1, 1, 1, '2024-10-03 11:49:28');

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
(1, 1, 1),
(2, 1, 2);

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
(1, 'opn'),
(2, 'wep'),
(3, 'wpa'),
(4, 'wpa2'),
(5, 'wpa3');

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
(1, 'solucion  borrar cuenta', 'codigo de vuln 2123123', 'uf esta difcil esto che'),
(2, 'imposibol', 'code 121311', 'vulnerable permite el acceso no autorizado al minecraft');

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
(1, 'test', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$b4lp0SeauKWRb4OHIRkVT.nTy2IpyrZCVpgGBEnm.JpF13dvRlyxu', '2024-10-02 16:44:18', 0);

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
  MODIFY `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
