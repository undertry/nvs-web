CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45),
  `email` varchar(128),
  `password` varchar(255),
  `created_at` timestamp,
  `verification` tinyint
);

CREATE TABLE `code` (
  `id_recovery_code` int PRIMARY KEY AUTO_INCREMENT,
  `recovery_code` varchar(45),
  `id_user` int
);

CREATE TABLE `scan_details` (
  `id_scan_details` int PRIMARY KEY AUTO_INCREMENT,
  `id_scan` int,
  `id_devices` int,
  `id_solution` int,
  `vulnerability_code` varchar(100),
  `vulnerability` tinyint
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
  `encryption` varchar(10)
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

CREATE TABLE `port_id_analysis` (
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
  `open` tinyint,
  `close` tinyint,
  `filtered` tinyint
);

ALTER TABLE `code` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `scan_details` ADD FOREIGN KEY (`id_scan`) REFERENCES `scan` (`id_scan`);

ALTER TABLE `scan_details` ADD FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`);

ALTER TABLE `scan_details` ADD FOREIGN KEY (`id_solution`) REFERENCES `solution` (`id_solution`);

ALTER TABLE `scan` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `scan` ADD FOREIGN KEY (`id_network`) REFERENCES `network` (`id_network`);

ALTER TABLE `port_id_analysis` ADD FOREIGN KEY (`id_port`) REFERENCES `ports` (`id_port`);

ALTER TABLE `port_id_analysis` ADD FOREIGN KEY (`id_devices`) REFERENCES `devices` (`id_devices`);

ALTER TABLE `ports` ADD FOREIGN KEY (`id_port_status`) REFERENCES `port_status` (`id_port_status`);
