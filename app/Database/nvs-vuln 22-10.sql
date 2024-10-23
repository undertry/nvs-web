-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 04:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nvs`
--

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `id_recovery_code` int(11) NOT NULL,
  `recovery_code` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id_devices` int(11) NOT NULL,
  `ip_address` varchar(12) DEFAULT NULL,
  `operating_system` varchar(30) DEFAULT NULL,
  `mac_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id_devices`, `ip_address`, `operating_system`, `mac_address`) VALUES
(26, NULL, 'Microsoft Windows XP|2019 (89%', '6c:fd:b9:a8:1b:2c'),
(27, NULL, 'Microsoft Windows XP|2019 (89%', '6c:fd:b9:a8:1b:2c'),
(28, NULL, 'Microsoft Windows XP|2019 (89%', '6c:fd:b9:a8:1b:2c');

-- --------------------------------------------------------

--
-- Table structure for table `network`
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
-- Dumping data for table `network`
--

INSERT INTO `network` (`id_network`, `signal`, `essid`, `bssid`, `channel`, `id_security_type`) VALUES
(2, '-38', 'Fibertel Comba 2.4GHz', '78:45:61:DA:B9:C0', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id_port` int(11) NOT NULL,
  `port_name` varchar(15) DEFAULT NULL,
  `service` varchar(45) DEFAULT NULL,
  `protocol` varchar(12) DEFAULT NULL,
  `id_port_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id_port`, `port_name`, `service`, `protocol`, `id_port_status`) VALUES
(2, 'Discovered', 'port 3306/tcp on 192.168.0.23', 'tcp', 1),
(3, 'Discovered', 'port 80/tcp on 192.168.0.23', 'tcp', 1),
(4, 'Discovered', 'port 443/tcp on 192.168.0.23', 'tcp', 1),
(5, 'Discovered', 'port 7680/tcp on 192.168.0.23', 'tcp', 1),
(6, '80/tcp', 'http syn-ack ttl 128 Apache httpd 2.4.58 ((Wi', 'tcp', 1),
(7, '443/tcp', 'ssl/http syn-ack ttl 128 Apache httpd 2.4.58 ', 'tcp', 1),
(8, '3306/tcp', 'mysql syn-ack ttl 128 MariaDB (unauthorized)', 'tcp', 1),
(9, '7680/tcp', 'pando-pub? syn-ack ttl 128', 'tcp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `port_analysis`
--

CREATE TABLE `port_analysis` (
  `id_analysis` int(11) NOT NULL,
  `id_port` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `port_analysis`
--

INSERT INTO `port_analysis` (`id_analysis`, `id_port`, `id_devices`) VALUES
(3, 2, 28),
(4, 3, 28),
(5, 4, 28),
(6, 5, 28),
(7, 6, 28),
(8, 7, 28),
(9, 8, 28),
(10, 9, 28);

-- --------------------------------------------------------

--
-- Table structure for table `port_details`
--

CREATE TABLE `port_details` (
  `id_port_details` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_solution` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `port_details`
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
(34, 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `port_status`
--

CREATE TABLE `port_status` (
  `id_port_status` int(11) NOT NULL,
  `status` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `port_status`
--

INSERT INTO `port_status` (`id_port_status`, `status`) VALUES
(1, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `id_scan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_network` int(11) DEFAULT NULL,
  `scan_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`id_scan`, `id_user`, `id_network`, `scan_date`) VALUES
(29, 2, NULL, '2024-10-23 02:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `scan_details`
--

CREATE TABLE `scan_details` (
  `id_scan_details` int(11) NOT NULL,
  `id_scan` int(11) DEFAULT NULL,
  `id_devices` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scan_details`
--

INSERT INTO `scan_details` (`id_scan_details`, `id_scan`, `id_devices`) VALUES
(2, 25, 24),
(3, 29, 28);

-- --------------------------------------------------------

--
-- Table structure for table `security_type`
--

CREATE TABLE `security_type` (
  `id_security_type` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_type`
--

INSERT INTO `security_type` (`id_security_type`, `type`) VALUES
(1, 'wpa'),
(2, 'wp2');

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `id_solution` int(11) NOT NULL,
  `solution` varchar(255) DEFAULT NULL,
  `vulnerability_code` varchar(100) DEFAULT NULL,
  `vuln_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solution`
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
(34, NULL, 'CVE-2023-38709', '//vulners.com/cve/CVE-2023-38709');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `verification`) VALUES
(1, 'test', 'cristianmonteverde@alumnos.itr3.edu.ar', '$2y$10$fiFGhFuX50rERrZ9fe03nOTOWTrzA9TU3E2YBYtUMb/ix3BNe9KW6', '2024-10-17 23:32:13', NULL),
(2, 'tiago', 'tiago@gmail.com', '$2y$10$xFLyaMuvMkcMKpCxNwNGEuE9jRfL/p3aeHmM6a6jbbVCkORF9dgwu', '2024-10-22 22:10:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id_recovery_code`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id_devices`);

--
-- Indexes for table `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`id_network`);

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id_port`);

--
-- Indexes for table `port_analysis`
--
ALTER TABLE `port_analysis`
  ADD PRIMARY KEY (`id_analysis`);

--
-- Indexes for table `port_details`
--
ALTER TABLE `port_details`
  ADD PRIMARY KEY (`id_port_details`);

--
-- Indexes for table `port_status`
--
ALTER TABLE `port_status`
  ADD PRIMARY KEY (`id_port_status`);

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id_scan`);

--
-- Indexes for table `scan_details`
--
ALTER TABLE `scan_details`
  ADD PRIMARY KEY (`id_scan_details`);

--
-- Indexes for table `security_type`
--
ALTER TABLE `security_type`
  ADD PRIMARY KEY (`id_security_type`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id_solution`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `network`
--
ALTER TABLE `network`
  MODIFY `id_network` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `port_analysis`
--
ALTER TABLE `port_analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `port_details`
--
ALTER TABLE `port_details`
  MODIFY `id_port_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `port_status`
--
ALTER TABLE `port_status`
  MODIFY `id_port_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scan`
--
ALTER TABLE `scan`
  MODIFY `id_scan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `scan_details`
--
ALTER TABLE `scan_details`
  MODIFY `id_scan_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `security_type`
--
ALTER TABLE `security_type`
  MODIFY `id_security_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `solution`
--
ALTER TABLE `solution`
  MODIFY `id_solution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
