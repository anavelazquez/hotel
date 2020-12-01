/*
 Navicat Premium Data Transfer

 Source Server         : MySQL local
 Source Server Type    : MySQL
 Source Server Version : 100316
 Source Host           : localhost:3306
 Source Schema         : hotel

 Target Server Type    : MySQL
 Target Server Version : 100316
 File Encoding         : 65001

 Date: 30/11/2020 20:33:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes`  (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NULL DEFAULT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `primer_apellido` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `segundo_apellido` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha_registro` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE,
  INDEX `fk_id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES (1, 2, 'JUAN', 'PEREZ', 'SANCHEZ', '2020-11-29');
INSERT INTO `clientes` VALUES (2, 3, 'PEDRO', 'HERNANDEZ', 'GARCIA', '2020-11-29');
INSERT INTO `clientes` VALUES (3, 4, 'MARIA', 'GOMEZ', 'HERNANDEZ', '2020-11-29');

-- ----------------------------
-- Table structure for edificios
-- ----------------------------
DROP TABLE IF EXISTS `edificios`;
CREATE TABLE `edificios`  (
  `id_edificio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_edificio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_edificio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of edificios
-- ----------------------------
INSERT INTO `edificios` VALUES (1, 'Sierra');
INSERT INTO `edificios` VALUES (2, 'Alaskafff');

-- ----------------------------
-- Table structure for estatus_habitacion
-- ----------------------------
DROP TABLE IF EXISTS `estatus_habitacion`;
CREATE TABLE `estatus_habitacion`  (
  `id_estatus_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estatus_habitacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_estatus_habitacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of estatus_habitacion
-- ----------------------------
INSERT INTO `estatus_habitacion` VALUES (1, 'Activa');
INSERT INTO `estatus_habitacion` VALUES (2, 'Reservada');
INSERT INTO `estatus_habitacion` VALUES (3, 'Ocupada');
INSERT INTO `estatus_habitacion` VALUES (4, 'Baja');
INSERT INTO `estatus_habitacion` VALUES (5, 'Mantenimiento');

-- ----------------------------
-- Table structure for estatus_reservacion
-- ----------------------------
DROP TABLE IF EXISTS `estatus_reservacion`;
CREATE TABLE `estatus_reservacion`  (
  `id_estatus_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estatus_reservacion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_estatus_reservacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for habitaciones
-- ----------------------------
DROP TABLE IF EXISTS `habitaciones`;
CREATE TABLE `habitaciones`  (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_edificio` int(11) NULL DEFAULT NULL,
  `nivel_piso` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `numero_habitacion` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_tipo_habitacion` int(11) NULL DEFAULT NULL,
  `id_vista` int(11) NULL DEFAULT NULL,
  `id_estatus_habitacion` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_habitacion`) USING BTREE,
  INDEX `fk_id_tipo_habitacion`(`id_tipo_habitacion`) USING BTREE,
  INDEX `fk_id_edificio`(`id_edificio`) USING BTREE,
  INDEX `fk_id_vista`(`id_vista`) USING BTREE,
  INDEX `fk_id_estatus_habitacion`(`id_estatus_habitacion`) USING BTREE,
  CONSTRAINT `fk_id_edificio` FOREIGN KEY (`id_edificio`) REFERENCES `edificios` (`id_edificio`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_estatus_habitacion` FOREIGN KEY (`id_estatus_habitacion`) REFERENCES `estatus_habitacion` (`id_estatus_habitacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_tipo_habitacion` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipos_habitacion` (`id_tipo_habitacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_vista` FOREIGN KEY (`id_vista`) REFERENCES `vistas` (`id_vista`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of habitaciones
-- ----------------------------
INSERT INTO `habitaciones` VALUES (1, 1, 'PB', '001', 1, 1, 2);
INSERT INTO `habitaciones` VALUES (2, 1, '1', '101', 1, 1, 1);
INSERT INTO `habitaciones` VALUES (4, 1, '2', '201', 1, 1, 1);

-- ----------------------------
-- Table structure for pantallas
-- ----------------------------
DROP TABLE IF EXISTS `pantallas`;
CREATE TABLE `pantallas`  (
  `id_pantalla` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_pantalla` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pantalla`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rel_rol_pantalla
-- ----------------------------
DROP TABLE IF EXISTS `rel_rol_pantalla`;
CREATE TABLE `rel_rol_pantalla`  (
  `id_rel_rol_pantalla` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NULL DEFAULT NULL,
  `id_pantalla` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_rel_rol_pantalla`) USING BTREE,
  INDEX `fk_idrol`(`id_rol`) USING BTREE,
  INDEX `fk_idpantalla`(`id_pantalla`) USING BTREE,
  CONSTRAINT `fk_idpantalla` FOREIGN KEY (`id_pantalla`) REFERENCES `pantallas` (`id_pantalla`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_idrol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reservacion
-- ----------------------------
DROP TABLE IF EXISTS `reservacion`;
CREATE TABLE `reservacion`  (
  `id_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NULL DEFAULT NULL,
  `id_habitacion` int(11) NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `monto` float NULL DEFAULT NULL,
  `fecha_reservacion` date NULL DEFAULT NULL,
  `id_estatus_reservacion` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_reservacion`) USING BTREE,
  INDEX `fk_id_cliente`(`id_cliente`) USING BTREE,
  INDEX `fk_id_habitacion`(`id_habitacion`) USING BTREE,
  INDEX `fk_id_estatus_reservacion`(`id_estatus_reservacion`) USING BTREE,
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_estatus_reservacion` FOREIGN KEY (`id_estatus_reservacion`) REFERENCES `estatus_reservacion` (`id_estatus_reservacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reservacion_detalle
-- ----------------------------
DROP TABLE IF EXISTS `reservacion_detalle`;
CREATE TABLE `reservacion_detalle`  (
  `id_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_in` date NULL DEFAULT NULL,
  `fecha_out` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_reservacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reservacion_huespedes
-- ----------------------------
DROP TABLE IF EXISTS `reservacion_huespedes`;
CREATE TABLE `reservacion_huespedes`  (
  `id_reservacion_huesped` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nombre_huesped` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edad_huesped` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_reservacion_huesped`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_rol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'ADMINISTRADOR');
INSERT INTO `roles` VALUES (2, 'SUBADMINISTRADOR');
INSERT INTO `roles` VALUES (3, 'CLIENTE');

-- ----------------------------
-- Table structure for tipos_habitacion
-- ----------------------------
DROP TABLE IF EXISTS `tipos_habitacion`;
CREATE TABLE `tipos_habitacion`  (
  `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_habitacion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio` float NULL DEFAULT NULL,
  `capacidad_ninos` int(11) NULL DEFAULT NULL,
  `capacidad_adultos` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_habitacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipos_habitacion
-- ----------------------------
INSERT INTO `tipos_habitacion` VALUES (1, 'Oro', 500, 2, 2);
INSERT INTO `tipos_habitacion` VALUES (2, 'Diamante', 600, 3, 5);
INSERT INTO `tipos_habitacion` VALUES (3, 'Plata', 700, 4, 7);
INSERT INTO `tipos_habitacion` VALUES (4, 'Platino', 800, 5, 9);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `fk_id_rol`(`id_rol`) USING BTREE,
  CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (2, 3, 'ana', '123');
INSERT INTO `usuarios` VALUES (3, 3, 'pedro', '123');
INSERT INTO `usuarios` VALUES (4, 3, 'maria', '123');
INSERT INTO `usuarios` VALUES (5, 3, '', '');
INSERT INTO `usuarios` VALUES (6, 3, '', '');
INSERT INTO `usuarios` VALUES (7, 3, '', '');
INSERT INTO `usuarios` VALUES (8, 3, '', '');
INSERT INTO `usuarios` VALUES (9, 3, 'sdfd', 'sfdsf');
INSERT INTO `usuarios` VALUES (10, 3, 'kjhkjhkjh', 'hkjjhj');
INSERT INTO `usuarios` VALUES (11, 3, 'ggg', 'gg');
INSERT INTO `usuarios` VALUES (12, 3, 'kkk', 'kkk');
INSERT INTO `usuarios` VALUES (13, 3, 'kkk', 'kkk');
INSERT INTO `usuarios` VALUES (14, 3, 'sfdfff', 'fff');
INSERT INTO `usuarios` VALUES (15, 3, 'ppp', 'pp');
INSERT INTO `usuarios` VALUES (16, 3, 'ppp', 'pp');
INSERT INTO `usuarios` VALUES (17, 3, 'sdfdsf', 'dsfdsfsd');

-- ----------------------------
-- Table structure for vistas
-- ----------------------------
DROP TABLE IF EXISTS `vistas`;
CREATE TABLE `vistas`  (
  `id_vista` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_vista` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_vista`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vistas
-- ----------------------------
INSERT INTO `vistas` VALUES (1, 'Jardin');
INSERT INTO `vistas` VALUES (2, 'Playa');

SET FOREIGN_KEY_CHECKS = 1;
