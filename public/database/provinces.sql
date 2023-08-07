/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_voting

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 29/07/2023 11:00:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 95 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES (11, 'ACEH');
INSERT INTO `provinces` VALUES (12, 'SUMATERA UTARA');
INSERT INTO `provinces` VALUES (13, 'SUMATERA BARAT');
INSERT INTO `provinces` VALUES (14, 'RIAU');
INSERT INTO `provinces` VALUES (15, 'JAMBI');
INSERT INTO `provinces` VALUES (16, 'SUMATERA SELATAN');
INSERT INTO `provinces` VALUES (17, 'BENGKULU');
INSERT INTO `provinces` VALUES (18, 'LAMPUNG');
INSERT INTO `provinces` VALUES (19, 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO `provinces` VALUES (21, 'KEPULAUAN RIAU');
INSERT INTO `provinces` VALUES (31, 'DKI JAKARTA');
INSERT INTO `provinces` VALUES (32, 'JAWA BARAT');
INSERT INTO `provinces` VALUES (33, 'JAWA TENGAH');
INSERT INTO `provinces` VALUES (34, 'DI YOGYAKARTA');
INSERT INTO `provinces` VALUES (35, 'JAWA TIMUR');
INSERT INTO `provinces` VALUES (36, 'BANTEN');
INSERT INTO `provinces` VALUES (51, 'BALI');
INSERT INTO `provinces` VALUES (52, 'NUSA TENGGARA BARAT');
INSERT INTO `provinces` VALUES (53, 'NUSA TENGGARA TIMUR');
INSERT INTO `provinces` VALUES (61, 'KALIMANTAN BARAT');
INSERT INTO `provinces` VALUES (62, 'KALIMANTAN TENGAH');
INSERT INTO `provinces` VALUES (63, 'KALIMANTAN SELATAN');
INSERT INTO `provinces` VALUES (64, 'KALIMANTAN TIMUR');
INSERT INTO `provinces` VALUES (65, 'KALIMANTAN UTARA');
INSERT INTO `provinces` VALUES (71, 'SULAWESI UTARA');
INSERT INTO `provinces` VALUES (72, 'SULAWESI TENGAH');
INSERT INTO `provinces` VALUES (73, 'SULAWESI SELATAN');
INSERT INTO `provinces` VALUES (74, 'SULAWESI TENGGARA');
INSERT INTO `provinces` VALUES (75, 'GORONTALO');
INSERT INTO `provinces` VALUES (76, 'SULAWESI BARAT');
INSERT INTO `provinces` VALUES (81, 'MALUKU');
INSERT INTO `provinces` VALUES (82, 'MALUKU UTARA');
INSERT INTO `provinces` VALUES (91, 'PAPUA BARAT');
INSERT INTO `provinces` VALUES (94, 'PAPUA');

SET FOREIGN_KEY_CHECKS = 1;
