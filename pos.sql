/*
 Navicat Premium Data Transfer

 Source Server         : keremy
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : pos

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 26/08/2019 17:49:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, 'termos', '2019-01-23 16:04:52');
INSERT INTO `categorias` VALUES (2, 'hornillas', '2019-01-23 16:05:00');
INSERT INTO `categorias` VALUES (3, 'cafeteras', '2019-01-23 16:05:05');
INSERT INTO `categorias` VALUES (4, 'ollas', '2019-01-23 16:05:10');
INSERT INTO `categorias` VALUES (5, 'tapas', '2019-01-23 16:05:29');
INSERT INTO `categorias` VALUES (6, 'teteras', '2019-01-23 18:10:23');
INSERT INTO `categorias` VALUES (7, 'vasijas', '2019-01-23 16:06:48');
INSERT INTO `categorias` VALUES (8, 'tasas', '2019-01-23 18:17:28');
INSERT INTO `categorias` VALUES (9, 'vasitos', '2019-01-26 12:39:44');
INSERT INTO `categorias` VALUES (12, 'alcancia', '2019-01-31 12:36:12');
INSERT INTO `categorias` VALUES (13, 'menudencia', '2019-01-31 12:36:20');
INSERT INTO `categorias` VALUES (14, 'pollo', '2019-01-31 12:36:42');

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `fecha` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES (1, 'keremy', 72573737, 'keremy@gmail.com', '928-371-292', 'mz j1 lt 29 aa hh villa emilia', '0000-00-00', 4, '2019-02-19 12:05:35');
INSERT INTO `clientes` VALUES (2, 'jean carlos', 54354545, 'jean@gmail.com', '976-767-676', 'los robles 1212', '0000-00-00', 3, '2019-02-20 09:46:12');

-- ----------------------------
-- Table structure for lh_ficha
-- ----------------------------
DROP TABLE IF EXISTS `lh_ficha`;
CREATE TABLE `lh_ficha`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `back` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `temp25` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `temp26` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_asignacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_creacion_lote` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_hora_llamada` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numero_lote` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_asignacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `secuencia_gar` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_gestion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numero_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `razon_social` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `primer_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `segundo_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido_paterno` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido_materno` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `representante_legal` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `segmento` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `operador_cedente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamento_atencion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dni_vendedor` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre_vendedor` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `modalidad_actual` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `modalidad_deseada` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_solicitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `bodega` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `distrito_tienda` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_campana` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mod_imai` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sim_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_consulta_previa` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imei` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamento_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `provincia_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `distrito_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `monto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado_civil_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sexo_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `id_ticket` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_consulta_previa2` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_solicitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_porta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_hora_solicitud` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_hora_programacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `comentario` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sub_estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nro_prospecto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `anexo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_activacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lh_ficha
-- ----------------------------
INSERT INTO `lh_ficha` VALUES (1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '72573737', 'ruc', 'keremy', 'draxler', 'vergaray', 'miranda', 'keremy', '2', '2', '1', '928371292', '77676766', 'jean', '1', '1', '1', 'sarita', '1', '12345', '123456789', '54321', '97542', '987654321', '1', '1', '1', 'mz j1 lt 29 villa emilia', '120', '1', '2018-10-01', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `lh_ficha` VALUES (2, '1', '1', '1', '1', '2018-10-11 16:43:58', '2018-10-11 16:43:58', '2018-10-11 16:43:58', '1', '1', '1', '1', '3', '72573737', 'ruc', 'keremy', '', '', '', '', '2', '2', '2', '', '', '', '2', '1', '2', '', '1', '', '', '', '', '', '2', '2', '2', '', '', '2', '', '2', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `codigo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `fecha` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `ventas` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (1, 1, '101', 'Aspiradora Industrial ', '', 14, 1500, 2100, '2019-02-20 09:46:12', 4);
INSERT INTO `productos` VALUES (2, 1, '102', 'Plato Flotante para Allanadora', '', 12, 4500, 6300, '2019-02-20 09:46:12', 1);
INSERT INTO `productos` VALUES (3, 1, '103', 'Compresor de Aire para pintura', '', 15, 3000, 4200, '2019-02-20 09:46:12', 1);
INSERT INTO `productos` VALUES (4, 1, '104', 'Cortadora de Adobe sin Disco ', '', 17, 4000, 5600, '2019-02-19 12:05:35', 1);
INSERT INTO `productos` VALUES (5, 1, '105', 'Cortadora de Piso sin Disco ', '', 19, 1540, 2156, '2019-02-18 17:22:44', 1);
INSERT INTO `productos` VALUES (6, 1, '106', 'Disco Punta Diamante ', '', 20, 1100, 1540, '2019-02-18 10:32:18', 0);
INSERT INTO `productos` VALUES (7, 1, '107', 'Extractor de Aire ', '', 20, 1540, 2156, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (8, 1, '108', 'Guada?adora ', '', 20, 1540, 2156, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (9, 1, '109', 'Hidrolavadora El?ctrica ', '', 20, 2600, 3640, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (10, 1, '110', 'Hidrolavadora Gasolina', '', 20, 2210, 3094, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (11, 1, '111', 'Motobomba a Gasolina', '', 20, 2860, 4004, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (12, 1, '112', 'Motobomba El?ctrica', '', 20, 2400, 3360, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (13, 1, '113', 'Sierra Circular ', '', 20, 1100, 1540, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (14, 1, '114', 'Disco de tugsteno para Sierra circular', '', 20, 4500, 6300, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (15, 1, '115', 'Soldador Electrico ', '', 20, 1980, 2772, '2019-02-14 17:19:15', 0);
INSERT INTO `productos` VALUES (16, 1, '116', 'Careta para Soldador', '', 20, 4200, 5880, '2019-02-14 17:19:16', 0);
INSERT INTO `productos` VALUES (17, 1, '117', 'Torre de iluminacion ', '', 20, 1800, 2520, '2019-02-14 17:19:16', 0);
INSERT INTO `productos` VALUES (18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, '2019-02-14 17:19:16', 0);
INSERT INTO `productos` VALUES (19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, '2019-02-14 17:19:16', 0);
INSERT INTO `productos` VALUES (20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, '2019-02-14 17:19:16', 0);
INSERT INTO `productos` VALUES (21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (22, 2, '205', 'Taladro Percutor de 1/2\" Madera y Metal', '', 20, 8000, 11200, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, '2019-02-14 17:19:17', 0);
INSERT INTO `productos` VALUES (29, 3, '305', 'Tijera para andamio', '', 20, 162, 226, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (32, 3, '308', 'Rueda giratoria para andamio', '', 20, 168, 235, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (33, 3, '309', 'Arnes de seguridad', '', 20, 1750, 2450, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, '2019-02-14 17:19:18', 0);
INSERT INTO `productos` VALUES (38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (46, 5, '503', 'Gato tensor', '', 20, 380, 532, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (48, 5, '505', 'Llave de Tubo', '', 20, 480, 960, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (49, 5, '506', 'Manila por Metro', '', 20, 600, 840, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, '2019-02-14 17:19:19', 0);
INSERT INTO `productos` VALUES (51, 5, '508', 'Tensor', '', 20, 100, 140, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (52, 5, '509', 'Bascula ', '', 20, 130, 182, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (53, 5, '510', 'Bomba Hidrostatica', '', 20, 770, 1078, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (54, 5, '511', 'Chapeta', '', 20, 660, 924, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (55, 5, '512', 'Cilindro muestra de concreto', '', 20, 400, 560, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (56, 5, '513', 'Cizalla de Palanca', '', 20, 450, 630, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (57, 5, '514', 'Cizalla de Tijera', '', 20, 580, 812, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (59, 5, '516', 'Cono slump', '', 20, 140, 196, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (60, 5, '517', 'Cortadora de Baldosin', '', 20, 930, 1302, '2019-02-14 17:19:20', 0);
INSERT INTO `productos` VALUES (66, NULL, '518', 'Balon', 'app/media/img/productos/alcansia/descarga.jpg', 10, 120, 166.8, '2019-02-26 12:41:24', 0);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime(0) NOT NULL,
  `fecha` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 941 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (938, 'keremy', 'keremy', '$2a$07$usesomesillystringforeatfgC6vwoecxM0oqYOD8A1MNT9jYfYK', 'especial', 'app/media/img/usuarios/keremy/linux.png', 1, '2019-04-26 11:38:44', '2019-04-26 11:38:44');
INSERT INTO `usuarios` VALUES (939, 'larry', 'larry', '$2a$07$usesomesillystringfore.RUqGMcO3kEe9UBzFZAOhS/tPX2jKiu', 'especial', 'app/media/img/usuarios/larry/linux.png', 1, '2019-01-29 12:07:13', '2019-01-29 12:07:13');
INSERT INTO `usuarios` VALUES (940, 'leninc', 'lenin', '$2a$07$usesomesillystringforewXz4L.mVWXGroU/sd.V6G6NUsKj5AB.', 'especial', 'app/media/img/usuarios/lenin/descarga.jpg', 0, '2019-01-26 12:35:44', '2019-02-02 23:39:48');

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES (1, 10001, 1, 938, '[{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2100\",\"total\":\"2100\"}]', 630, 12600, 13230, 'TC-765657675765', '2019-02-18 16:57:13');
INSERT INTO `ventas` VALUES (2, 10002, 2, 938, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"2100\",\"total\":\"2100\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5600\",\"total\":\"5600\"}]', 910, 18200, 19110, 'TC-546576654654654', '2019-02-18 17:20:09');
INSERT INTO `ventas` VALUES (3, 10003, 2, 938, '[{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"2100\",\"total\":\"2100\"}]', 1017.8, 20356, 21373.8, 'TC-657457676556564', '2019-02-18 17:22:44');
INSERT INTO `ventas` VALUES (4, 10004, 1, 938, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"2100\",\"total\":\"2100\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"5600\",\"total\":\"5600\"}]', 1456, 18200, 19656, 'TC-7684687687687768', '2019-02-19 12:05:35');
INSERT INTO `ventas` VALUES (5, 10005, 1, 938, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"2100\",\"total\":\"2100\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"3\",\"stock\":\"13\",\"precio\":\"6300\",\"total\":\"18900\"}]', 1260, 21000, 22260, 'TC-6767678786', '2019-02-19 12:12:39');
INSERT INTO `ventas` VALUES (6, 10006, 2, 938, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"2100\",\"total\":\"2100\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"4200\",\"total\":\"4200\"}]', 630, 12600, 13230, 'Efectivo', '2019-02-20 09:46:12');

SET FOREIGN_KEY_CHECKS = 1;
