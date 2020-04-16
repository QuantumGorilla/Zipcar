/*
 Navicat Premium Data Transfer

 Source Server         : localhost2
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : autos

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 16/04/2020 04:19:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for autos
-- ----------------------------
DROP TABLE IF EXISTS `autos`;
CREATE TABLE `autos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `modelo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `combustible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of autos
-- ----------------------------
INSERT INTO `autos` VALUES (1, 'Fiat', 'Uno', 'Nafta');

-- ----------------------------
-- Table structure for ordenes
-- ----------------------------
DROP TABLE IF EXISTS `ordenes`;
CREATE TABLE `ordenes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(255) NULL DEFAULT NULL,
  `idauto` int(255) NULL DEFAULT NULL,
  `desde` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hasta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ordenes
-- ----------------------------
INSERT INTO `ordenes` VALUES (1, 3, 0, '01/02/2020', '02/03/2020');
INSERT INTO `ordenes` VALUES (2, 3, 0, '05/05/2020', '06/06/2020');
INSERT INTO `ordenes` VALUES (3, 3, 1, '10/22/2051', '10/10/2020');
INSERT INTO `ordenes` VALUES (4, 3, 1, '10/22/2051', '10/10/2020');
INSERT INTO `ordenes` VALUES (5, 3, 1, '10/22/2051', '10/10/2020');
INSERT INTO `ordenes` VALUES (6, 3, 1, '10/22/2051', '10/10/2020');

-- ----------------------------
-- Table structure for reservas
-- ----------------------------
DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(255) NULL DEFAULT NULL,
  `idauto` int(255) NULL DEFAULT NULL,
  `fechareserva` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reservas
-- ----------------------------
INSERT INTO `reservas` VALUES (1, 3, 1, '01/02/2020');
INSERT INTO `reservas` VALUES (2, 3, 1, '02/02/2021');
INSERT INTO `reservas` VALUES (3, 3, 1, '11/02/2020');
INSERT INTO `reservas` VALUES (4, 3, 1, '24/08/2020');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `apellido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `identificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contraseña` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, '', '', '', '', '', '', NULL);
INSERT INTO `usuarios` VALUES (2, 'asd', 'asd', 'asd', '1234', 'asdasd', 'asdads@gmail.com', NULL);
INSERT INTO `usuarios` VALUES (3, 'Rodrigo', 'Rodrigo', 'Calabrese', '37228154', '123', 'privatedofus.net@gmail.com', 1);

SET FOREIGN_KEY_CHECKS = 1;
