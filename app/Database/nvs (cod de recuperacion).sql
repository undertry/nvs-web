CREATE TABLE `usuarios` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45),
  `email` varchar(128),
  `password` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `codigo` (
  `id_codigo_recuperacion` int PRIMARY KEY AUTO_INCREMENT,
  `cod_recup` varchar(45),
  `id_user` int
);

CREATE TABLE `detalle_scan` (
  `id_det_scan` int PRIMARY KEY AUTO_INCREMENT,
  `id_scan` int,
  `id_dispositivos` int,
  `id_solucion` int
);

CREATE TABLE `scan` (
  `id_scan` int PRIMARY KEY AUTO_INCREMENT,
  `id_user` int,
  `id_red` int,
  `fecha_scan` timestamp
);

CREATE TABLE `red` (
  `id_red` int PRIMARY KEY AUTO_INCREMENT,
  `direccion_red` varchar(22),
  `potencia` varchar(64),
  `essid` varchar(35),
  `bssid` varchar(18),
  `id_tipo_seguridad` int
);

CREATE TABLE `tipo_seguridad` (
  `id_tipo_seguridad` int PRIMARY KEY AUTO_INCREMENT,
  `tipo` varchar(20)
);

CREATE TABLE `solucion` (
  `id_solucion` int PRIMARY KEY AUTO_INCREMENT,
  `solucion` varchar(255)
);

CREATE TABLE `dispositivos` (
  `id_dispositivos` int PRIMARY KEY AUTO_INCREMENT,
  `direccion_ip` varchar(12),
  `sistema_operativo` varchar(30),
  `dir_mac` varchar(20)
);

CREATE TABLE `analisis_puertos` (
  `id_analisis` int PRIMARY KEY AUTO_INCREMENT,
  `id_puerto` int,
  `id_dispositivos` int
);

CREATE TABLE `puertos` (
  `id_puerto` int PRIMARY KEY AUTO_INCREMENT,
  `puerto_nombre` varchar(15),
  `servicio` varchar(45),
  `protocolo` varchar(12),
  `id_estado_puerto` int
);

CREATE TABLE `estado_puerto` (
  `id_estado_puerto` int PRIMARY KEY AUTO_INCREMENT,
  `abierto` bool,
  `cerrado` bool,
  `filtrado` bool
);

ALTER TABLE `codigo` ADD FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);

ALTER TABLE `detalle_scan` ADD FOREIGN KEY (`id_scan`) REFERENCES `scan` (`id_scan`);

ALTER TABLE `detalle_scan` ADD FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`);

ALTER TABLE `detalle_scan` ADD FOREIGN KEY (`id_solucion`) REFERENCES `solucion` (`id_solucion`);

ALTER TABLE `scan` ADD FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);

ALTER TABLE `scan` ADD FOREIGN KEY (`id_red`) REFERENCES `red` (`id_red`);

ALTER TABLE `red` ADD FOREIGN KEY (`id_tipo_seguridad`) REFERENCES `tipo_seguridad` (`id_tipo_seguridad`);

ALTER TABLE `analisis_puertos` ADD FOREIGN KEY (`id_puerto`) REFERENCES `puertos` (`id_puerto`);

ALTER TABLE `analisis_puertos` ADD FOREIGN KEY (`id_dispositivos`) REFERENCES `dispositivos` (`id_dispositivos`);

ALTER TABLE `puertos` ADD FOREIGN KEY (`id_estado_puerto`) REFERENCES `estado_puerto` (`id_estado_puerto`);
