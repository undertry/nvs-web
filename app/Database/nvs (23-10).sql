-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 14:37:26
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
  `ip_address` varchar(25) DEFAULT NULL,
  `operating_system` varchar(30) DEFAULT NULL,
  `mac_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id_devices`, `ip_address`, `operating_system`, `mac_address`) VALUES
(30, '192.168.0.23', 'Microsoft Windows XP|2019 (89%', '6c:fd:b9:a8:1b:2c'),
(31, '192.168.0.23', 'Microsoft Windows XP|2019 (89%', '6c:fd:b9:a8:1b:2c');

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
(2, '-38', 'Fibertel Comba 2.4GHz', '78:45:61:DA:B9:C0', 1, NULL);

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
(2, 'Discovered', 'port 3306/tcp on 192.168.0.23', 'tcp', 1),
(3, 'Discovered', 'port 80/tcp on 192.168.0.23', 'tcp', 1),
(4, 'Discovered', 'port 443/tcp on 192.168.0.23', 'tcp', 1),
(5, 'Discovered', 'port 7680/tcp on 192.168.0.23', 'tcp', 1),
(6, '80/tcp', 'http syn-ack ttl 128 Apache httpd 2.4.58 ((Wi', 'tcp', 1),
(7, '443/tcp', 'ssl/http syn-ack ttl 128 Apache httpd 2.4.58 ', 'tcp', 1),
(8, '3306/tcp', 'mysql syn-ack ttl 128 MariaDB (unauthorized)', 'tcp', 1),
(9, '7680/tcp', 'pando-pub? syn-ack ttl 128', 'tcp', 1),
(10, 'Discovered', 'port 3306/tcp on 192.168.0.23', 'tcp', 1),
(11, 'Discovered', 'port 80/tcp on 192.168.0.23', 'tcp', 1),
(12, 'Discovered', 'port 443/tcp on 192.168.0.23', 'tcp', 1),
(13, 'Discovered', 'port 7680/tcp on 192.168.0.23', 'tcp', 1),
(14, '80/tcp', 'http syn-ack ttl 128 Apache httpd 2.4.58 ((Wi', 'tcp', 1),
(15, '443/tcp', 'ssl/http syn-ack ttl 128 Apache httpd 2.4.58 ', 'tcp', 1),
(16, '3306/tcp', 'mysql syn-ack ttl 128 MariaDB (unauthorized)', 'tcp', 1),
(17, '7680/tcp', 'pando-pub? syn-ack ttl 128', 'tcp', 1),
(18, 'Discovered', 'port 3306/tcp on 192.168.0.23', 'tcp', 1),
(19, 'Discovered', 'port 80/tcp on 192.168.0.23', 'tcp', 1),
(20, 'Discovered', 'port 443/tcp on 192.168.0.23', 'tcp', 1),
(21, 'Discovered', 'port 7680/tcp on 192.168.0.23', 'tcp', 1),
(22, '80/tcp', 'http syn-ack ttl 128 Apache httpd 2.4.58 ((Wi', 'tcp', 1),
(23, '443/tcp', 'ssl/http syn-ack ttl 128 Apache httpd 2.4.58 ', 'tcp', 1),
(24, '3306/tcp', 'mysql syn-ack ttl 128 MariaDB (unauthorized)', 'tcp', 1),
(25, '7680/tcp', 'pando-pub? syn-ack ttl 128', 'tcp', 1),
(26, 'Discovered', 'port 3306/tcp on 192.168.0.23', 'tcp', 1),
(27, 'Discovered', 'port 80/tcp on 192.168.0.23', 'tcp', 1),
(28, 'Discovered', 'port 443/tcp on 192.168.0.23', 'tcp', 1),
(29, 'Discovered', 'port 7680/tcp on 192.168.0.23', 'tcp', 1),
(30, '80/tcp', 'http syn-ack ttl 128 Apache httpd 2.4.58 ((Wi', 'tcp', 1),
(31, '443/tcp', 'ssl/http syn-ack ttl 128 Apache httpd 2.4.58 ', 'tcp', 1),
(32, '3306/tcp', 'mysql syn-ack ttl 128 MariaDB (unauthorized)', 'tcp', 1),
(33, '7680/tcp', 'pando-pub? syn-ack ttl 128', 'tcp', 1);

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
(3, 2, 28),
(4, 3, 28),
(5, 4, 28),
(6, 5, 28),
(7, 6, 28),
(8, 7, 28),
(9, 8, 28),
(10, 9, 28),
(11, 10, 29),
(12, 11, 29),
(13, 12, 29),
(14, 13, 29),
(15, 14, 29),
(16, 15, 29),
(17, 16, 29),
(18, 17, 29),
(19, 18, 30),
(20, 19, 30),
(21, 20, 30),
(22, 21, 30),
(23, 22, 30),
(24, 23, 30),
(25, 24, 30),
(26, 25, 30),
(27, 26, 31),
(28, 27, 31),
(29, 28, 31),
(30, 29, 31),
(31, 30, 31),
(32, 31, 31),
(33, 32, 31),
(34, 33, 31);

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
(3, 0, 3),
(4, 0, 4),
(5, 0, 5),
(6, 0, 6),
(7, 0, 7),
(8, 0, 8),
(9, 0, 9),
(10, 0, 10),
(11, 0, 11),
(12, 0, 12),
(13, 0, 13),
(14, 0, 14),
(15, 0, 15),
(16, 0, 16),
(17, 0, 17),
(18, 0, 18),
(19, 0, 19),
(20, 0, 20),
(21, 0, 21),
(22, 0, 22),
(23, 0, 23),
(24, 0, 24),
(25, 0, 25),
(26, 0, 26),
(27, 0, 27),
(28, 0, 28),
(29, 0, 29),
(30, 0, 30),
(31, 0, 31),
(32, 0, 32),
(33, 0, 33),
(34, 0, 34),
(35, 0, 35),
(36, 0, 36),
(37, 0, 37),
(38, 0, 38),
(39, 0, 39),
(40, 0, 40),
(41, 0, 41),
(42, 0, 42),
(43, 0, 43),
(44, 0, 44),
(45, 0, 45),
(46, 0, 46),
(47, 0, 47),
(48, 0, 48),
(49, 0, 49),
(50, 0, 50),
(51, 0, 51),
(52, 0, 52),
(53, 0, 53),
(54, 0, 54),
(55, 0, 55),
(56, 0, 56),
(57, 0, 57),
(58, 0, 58),
(59, 0, 59),
(60, 0, 60),
(61, 0, 61),
(62, 0, 62),
(63, 0, 63),
(64, 0, 64),
(65, 0, 65),
(66, 0, 66),
(67, 0, 67),
(68, 0, 68),
(69, 0, 69),
(70, 0, 70),
(71, 0, 71),
(72, 0, 72),
(73, 0, 73),
(74, 0, 74),
(75, 0, 75),
(76, 0, 76),
(77, 0, 77),
(78, 0, 78),
(79, 0, 79),
(80, 0, 80),
(81, 0, 81),
(82, 0, 82),
(83, 0, 83),
(84, 0, 84),
(85, 0, 85),
(86, 0, 86),
(87, 0, 87),
(88, 0, 88),
(89, 0, 89),
(90, 0, 90),
(91, 0, 91),
(92, 0, 92),
(93, 0, 93),
(94, 0, 94),
(95, 0, 95),
(96, 0, 96),
(97, 0, 97),
(98, 0, 98),
(99, 0, 99),
(100, 0, 100),
(101, 0, 101),
(102, 0, 102),
(103, 0, 103),
(104, 0, 104),
(105, 0, 105),
(106, 0, 106),
(107, 0, 107),
(108, 0, 108),
(109, 0, 109),
(110, 0, 110),
(111, 0, 111),
(112, 0, 112),
(113, 0, 113),
(114, 0, 114),
(115, 0, 115),
(116, 0, 116),
(117, 0, 117),
(118, 0, 118),
(119, 0, 119),
(120, 0, 120),
(121, 0, 121),
(122, 0, 122),
(123, 0, 123),
(124, 0, 124),
(125, 0, 125),
(126, 0, 126),
(127, 0, 127),
(128, 0, 128),
(129, 0, 129),
(130, 0, 130);

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
(1, 'open');

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
(29, 2, NULL, '2024-10-23 02:43:54'),
(30, 1, NULL, '2024-10-23 12:30:46'),
(31, 1, NULL, '2024-10-23 12:32:19'),
(32, 1, NULL, '2024-10-23 12:36:38');

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
(2, 25, 24),
(3, 29, 28),
(4, 30, 29),
(5, 31, 30),
(6, 32, 31);

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
(1, 'wpa'),
(2, 'wp2');

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
(1, 'solucion1 puerto 1', 'code 1 puerto 1', 'descripcion 1 puerto 1'),
(2, 'solucion 2 puerto 1', 'code vuln 2 puerto 1', 'descripcion 2 puerto 1'),
(3, NULL, 'N/A', '|   VULNERABLE:'),
(4, NULL, 'N/A', '|     State: LIKELY VULNERABLE'),
(5, NULL, 'CVE-2007-6750', 'CVE:CVE-2007-6750'),
(6, NULL, 'CVE-2007-6750', '//cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-6750'),
(7, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(8, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(9, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(10, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(11, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(12, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(13, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(14, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(15, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(16, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(17, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(18, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(19, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(20, NULL, 'N/A', '|   VULNERABLE:'),
(21, NULL, 'N/A', '|     State: VULNERABLE'),
(22, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(23, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(24, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(25, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(26, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(27, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(28, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(29, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(30, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(31, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(32, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(33, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(34, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(35, NULL, 'N/A', '|   VULNERABLE:'),
(36, NULL, 'N/A', '|     State: LIKELY VULNERABLE'),
(37, NULL, 'CVE-2007-6750', 'CVE:CVE-2007-6750'),
(38, NULL, 'CVE-2007-6750', '//cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-6750'),
(39, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(40, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(41, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(42, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(43, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(44, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(45, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(46, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(47, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(48, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(49, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(50, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(51, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(52, NULL, 'N/A', '|   VULNERABLE:'),
(53, NULL, 'N/A', '|     State: VULNERABLE'),
(54, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(55, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(56, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(57, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(58, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(59, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(60, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(61, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(62, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(63, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(64, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(65, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(66, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(67, NULL, 'N/A', '|   VULNERABLE:'),
(68, NULL, 'N/A', '|     State: LIKELY VULNERABLE'),
(69, NULL, 'CVE-2007-6750', 'CVE:CVE-2007-6750'),
(70, NULL, 'CVE-2007-6750', '//cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-6750'),
(71, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(72, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(73, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(74, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(75, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(76, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(77, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(78, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(79, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(80, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(81, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(82, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(83, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(84, NULL, 'N/A', '|   VULNERABLE:'),
(85, NULL, 'N/A', '|     State: VULNERABLE'),
(86, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(87, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(88, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(89, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(90, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(91, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(92, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(93, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(94, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(95, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(96, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(97, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(98, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(99, NULL, 'N/A', '|   VULNERABLE:'),
(100, NULL, 'N/A', '|     State: LIKELY VULNERABLE'),
(101, NULL, 'CVE-2007-6750', 'CVE:CVE-2007-6750'),
(102, NULL, 'CVE-2007-6750', '//cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-6750'),
(103, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(104, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(105, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(106, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(107, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(108, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(109, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(110, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(111, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(112, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(113, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(114, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(115, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709'),
(116, NULL, 'N/A', '|   VULNERABLE:'),
(117, NULL, 'N/A', '|     State: VULNERABLE'),
(118, NULL, 'CVE-2024-38476', '//vulners.com/cve/CVE-2024-38476'),
(119, NULL, 'CVE-2024-38474', '//vulners.com/cve/CVE-2024-38474'),
(120, NULL, 'CVE-2024-38475', '//vulners.com/cve/CVE-2024-38475'),
(121, NULL, 'CVE-2024-38473', '//vulners.com/cve/CVE-2024-38473'),
(122, NULL, 'CVE-2024-40898', '//vulners.com/cve/CVE-2024-40898'),
(123, NULL, 'CVE-2024-39573', '//vulners.com/cve/CVE-2024-39573'),
(124, NULL, 'CVE-2024-38477', '//vulners.com/cve/CVE-2024-38477'),
(125, NULL, 'CVE-2024-38472', '//vulners.com/cve/CVE-2024-38472'),
(126, NULL, 'CVE-2024-27316', '//vulners.com/cve/CVE-2024-27316'),
(127, NULL, 'CVE-2024-39884', '//vulners.com/cve/CVE-2024-39884'),
(128, NULL, 'CVE-2024-36387', '//vulners.com/cve/CVE-2024-36387'),
(129, NULL, 'CVE-2024-24795', '//vulners.com/cve/CVE-2024-24795'),
(130, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'test', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$fiFGhFuX50rERrZ9fe03nOTOWTrzA9TU3E2YBYtUMb/ix3BNe9KW6', '2024-10-17 23:32:13', NULL),
(2, 'tiago', 'tiago@gmail.com', '$2y$10$xFLyaMuvMkcMKpCxNwNGEuE9jRfL/p3aeHmM6a6jbbVCkORF9dgwu', '2024-10-22 22:10:00', NULL);

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
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `port_details`
--
ALTER TABLE `port_details`
  MODIFY `id_port_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
