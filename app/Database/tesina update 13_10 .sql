CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45),
  `email` varchar(128),
  `password` varchar(255),
  `created_at` timestamp,
  `verification` bool
);

CREATE TABLE `code` (
  `id_recovery_code` int PRIMARY KEY AUTO_INCREMENT,
  `recovery_code` varchar(45),
  `id_user` int
);

CREATE TABLE `scan_details` (
  `id_scan_details` int PRIMARY KEY AUTO_INCREMENT,
  `id_scan` int,
  `id_devices` int
);

CREATE TABLE `scan` (
  `id_scan` int PRIMARY KEY AUTO_INCREMENT,
  `id_user` int,
  `id_network` int,
  `scan_date` timestamp
);

CREATE TABLE `network` (
  `id_network` int PRIMARY KEY AUTO_INCREMENT,
  `signal` varchar(64),
  `essid` varchar(35),
  `bssid` varchar(18),
  `channel` int,
  `id_security_type` int
);

CREATE TABLE `security_type` (
  `id_security_type` int PRIMARY KEY AUTO_INCREMENT,
  `type` varchar(20)
);

CREATE TABLE `solution` (
  `id_solution` int PRIMARY KEY AUTO_INCREMENT,
  `solution` varchar(255),
  `vulnerability_code` varchar(100),
  `vuln_description` varchar(255)
);

CREATE TABLE `devices` (
  `id_devices` int PRIMARY KEY AUTO_INCREMENT,
  `ip_address` varchar(12),
  `operating_system` varchar(30),
  `mac_address` varchar(20)
);

CREATE TABLE `port_analysis` (
  `id_analysis` int PRIMARY KEY AUTO_INCREMENT,
  `id_port` int,
  `id_devices` int
);

CREATE TABLE `ports` (
  `id_port` int PRIMARY KEY AUTO_INCREMENT,
  `port_name` varchar(15),
  `service` varchar(45),
  `protocol` varchar(12),
  `id_port_status` int
);

CREATE TABLE `port_status` (
  `id_port_status` int PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(9)
);

CREATE TABLE `port_details` (
  `id_port_details` int PRIMARY KEY AUTO_INCREMENT,
  `id_port_analysis` int,
  `id_solution` int
);
