/*
 Navicat Premium Data Transfer

 Source Server         : MyProject
 Source Server Type    : MySQL
 Source Server Version : 100411 (10.4.11-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ahp_saw_hotel

 Target Server Type    : MySQL
 Target Server Version : 100411 (10.4.11-MariaDB)
 File Encoding         : 65001

 Date: 21/05/2023 21:32:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alternatif
-- ----------------------------
DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kabupaten_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` int UNSIGNED NOT NULL,
  `nama_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_alternatif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `objek_wisata_alternatif` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `alternatif_jenis_id_foreign`(`jenis_id` ASC) USING BTREE,
  CONSTRAINT `alternatif_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of alternatif
-- ----------------------------
INSERT INTO `alternatif` VALUES (139, 'Dumai', 3, 'Penginapan Lenggogeni', 'Sudirman, Dumai Kota, Kota Dumai, Riau 28821', '16.805.086', '0', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (140, 'Dumai', 3, 'Southern Asia Hotel', 'Datuk Laksamana No.122, Dumai Kota, Kota Dumai, Riau 28826', '16.832.463', '1.014.447.398', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (141, 'Dumai', 3, 'Komala Hotel', 'Jl. Sultan Syarif Kasim No.65, Buluh Kasap, Dumai Tim., Kota Dumai, Riau 28826', '16.783.681', '1.014.494.719', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (142, 'Dumai', 3, 'HOTEL CITY', 'Jl. Jend. Sudirman No.445, Dumai Kota, Kota Dumai, Riau 28826', '16.806.437', '1.014.458.033', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (143, 'Dumai', 3, 'Hotel K77', 'Jl. Cempedak No.15, Rimba Sekampung, Dumai Bar., Kota Dumai, Riau 28826', '16.714.735', '1.014.347.419', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (144, 'Dumai', 4, 'Cititel Hotel | Dumai', 'Jl. Jend. Sudirman No.429A, Dumai Kota, Dumai Tim., Kota Dumai, Riau 28826', '16.805.783', '101.445.505', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (145, 'Dumai', 4, 'Patra Dumai Hotel', 'Jl. Sultan Syarif Kasim, Buluh Kasap, Dumai Tim., Kota Dumai, Riau', '16.784.046', '1.014.606.888', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (146, 'Dumai', 4, 'Sonaview Hotel', 'Jl. Pattimura No.40, Dumai Kota, Kota Dumai, Riau 28821', '16.815.177', '1.014.391.277', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (147, 'Dumai', 4, 'Comforta Hotel Dumai', 'Jl. Jend. Sudirman No.58, Dumai Kota, Kota Dumai, Riau 28826', '16.426.109', '1.014.701.566', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (148, 'Dumai', 5, 'The Zuri Dumai', 'Jl. Jend. Sudirman No.108, Tlk. Binjai, Dumai Tim., Kota Dumai, Riau 28826', '1.670.828', '1.014.462.691', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (149, 'Dumai', 5, 'The Zuri Dumai', 'Jl. Jend. Sudirman No.88, Bintan, Dumai Kota, Kota Dumai, Riau 28812', '16.426.109', '1.014.701.566', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (150, 'Siak', 3, 'SPOT ON 2809 Hotel Yasmin', 'Gg. Indragiri No.18, Kp. Rempak, Siak, Kabupaten\nSiak, Riau 28673', '0.8017847 ', '1.020.410.538', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (151, 'Rohil', 4, 'Hotel Bintang', 'Jl. Jenderal Sudirman No.360, Bagan Batu, Kec. Bagan Sinembah, Kabupaten Rokan Hilir, Riau 28992', '1.702.962', '100.402.958', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (152, 'Meranti ', 3, 'Grand Indobaru Hotel\nSelatpanjang', 'Jl. Diponegoro No.101, Selat Panjang Kota,\nKec. Tebing Tinggi, Kabupaten Kepulauan\nMeranti, Riau', '10.089.664', '1.027.083.033', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (153, 'Meranti ', 4, 'Grand Meranti Hotel', 'Jalan Kartini, Kecamatan Tebing Tinggi,\nSelat Panjang Timur, Meranti, Kabupaten\nKepulauan Meranti, Riau ', '10.070.744', '1.027.073.645', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (154, 'Kampar', 3, 'Homestay Asmalaila', 'Tj. Belit, Kec. Kampar Kiri Hulu, Kabupaten Kampar, Riau 28471,', '0.1691485', '0', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (155, 'Kampar', 6, 'Labersa Grand Hotel &\nConvention Centers', 'Jl. Labersa, Tanah Merah, Kec. Siak\nHulu, Kabupaten Kampar, Riau 28282', '0.4371942 ', '1.014.801.007', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (156, 'Inhil', 4, 'Elite Hotel Tembilahan', 'Jl. H. Arsyad Ahmad No.2, Tembilahan Kota, Tembilahan, Kabupaten Indragiri Hilir, Riau 29214', '-323.974', '103.155.322', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (157, 'Bengkalis', 3, 'HOTEL CHITRA', 'Jl. Jenderal Sudirman, Balai Makam, Kec. Mandau,\nKabupaten Bengkalis, Riau 28884', '1.294.358', '1.011.803.905', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (158, 'Bengkalis', 3, 'HOTEL COMFORT', 'Jl. Kom. L, Jl. Yos Sudarso, Bengkalis Kota, Bengkalis Sub-District, Bengkalis Regency, Riau 28713', '14.671.481', '1.021.051.224', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (159, 'Bengkalis', 3, 'HOTEL DURI EXECUTIVE', 'Jl. Karet No.8, Air Jamban, Kec. Mandau, Kabupaten Bengkalis, Riau 28784', '1.285.607', '1.011.915.388', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (160, 'Bengkalis', 3, 'mbah jamal n family', 'Bantan Air, Bantan, Kabupaten Bengkalis, Riau', '15.209.901', '1.022.692.836', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (161, 'Bengkalis', 3, 'HOTEL SUSUKA', 'Jl. Jenderal Sudirman No.388, Babussalam, Kec. Mandau, Kabupaten Bengkalis, Riau 28784', '12.816.429', '1.011.924.222', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (162, 'Bengkalis', 4, 'Grand Zuri Duri', 'Jl. Hangtuah No. 26 Duri, Mandau, Bengkalis, Riau,\nIndonesia, 28884', '12.736.808 ', '1.011.750.711', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (163, 'Bengkalis', 4, 'HOTEL GRAND ZURI', 'Jl. Hangtuah No.26, Babussalam, Kec. Mandau, Kabupaten Bengkalis, Riau 28784', '12.734.503', '12.734.503', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (164, 'Bengkalis', 4, 'Hotel Graha Bangunsari', 'Bantan Air, Bantan, Kabupaten Bengkalis, Riau 28754', '15.209.901', '1.022.692.836', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (165, 'Pekanbaru', 2, 'Bintang Lima', 'Jl. Teuku Umar No. 18 A-B (0761) 24115-26115', '0.5323309 ', '1.014.491.355', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (166, 'Pekanbaru', 2, 'Hotel Tasia Ratu', 'Jl. Hasyim Ashari No.10, Sukaramai, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28155', '0.5306656 ', '1.014.446.818', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (167, 'Pekanbaru', 3, 'Parma Panam Hotel', 'Jl. HR. Soebrantas No. 28', '0.4638782 ', '1.013.915.606', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (168, 'Pekanbaru', 3, 'Flora', 'Jl. Samarinda No.7, Tangkerang Utara, Kec. Bukit Raya, Kota Pekanbaru, Riau 28282', '0.5014702 ', '1.014.620.326', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (169, 'Pekanbaru', 3, 'Hotel Intan', 'Jl. Tuanku Tambusai, Labuh Baru Timur, Kec. Payung Sekaki, Kota Pekanbaru, Riau 28124', '0.5046179 ', '1.014.245.203', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (170, 'Pekanbaru', 3, 'Whiz', 'Jalan Jendral Sudirman No. 345, Pusat Kota Pekanbaru, Pekanbaru, Riau, Indonesia, 28111', '0.5230312 ', '1.014.455.076', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (171, 'Pekanbaru', 3, 'Marcopolo Homestay', 'ABCDE, Jl. Riau No.40, Kp. Bandar, Kec. Senapelan, Kota Pekanbaru, Riau 28292', '0.53547 ', '1.014.399.604', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (172, 'Pekanbaru', 3, 'Amryrooms', 'Jl. Rawamangun No.20, Tengkerang Labuai, Kec.\nBukit Raya, Kota Pekanbaru, Riau 28281', '0.4852194 ', '1.014.670.246', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (173, 'Pekanbaru', 3, 'Dharma Utama\nFamily', 'Jl. Sisingamangaraja No.10, Sumahilang, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28111', '0.528205', '1.014.459.612', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (174, 'Pekanbaru', 3, 'D\'Lira Syariah Hotel', 'Jl. Pepaya No. 73 (0761) 23719', ' 0.5110706 ', '1.014.448.437', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (175, 'Pekanbaru', 3, 'Damon', 'Jl. Hangtuah Ujung No.46-A, Suka Mulia, Kec. Sail, Kota Pekanbaru, Riau 28132', '0.5251563', '1.014.540.289', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (176, 'Pekanbaru', 3, 'Hotel Sukajadi', 'Jl. Melur No.67, Harjosari, Kec. Sukajadi, Kota Pekanbaru, Riau 28156', '0.5271203 ', '1.014.323.925', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (177, 'Pekanbaru', 3, 'Edotel Amanah HOTEL Syariah By Smk Muhammadiyah 1\n', 'Jl. Senapelan No.10A, Kp. Bandar, Kec. Senapelan, Kota Pekanbaru, Riau 28155', '0.5374343 ', '1.014.415.329', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (178, 'Pekanbaru', 3, 'Dyan Graha Hotel', 'Jl. Gatot Subroto No.7, Kota Tinggi, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28112, (0761) 26600', '0.5300606', '1.014.487.759', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (179, 'Pekanbaru', 3, 'Hotel Holie ', ' Jl. Tuanku Tambusai No. 116 ((0761) 35281', ' 0.541833', '1.014.583.484', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (180, 'Pekanbaru', 3, 'Hotel Sabrina  ', 'Jl.Tambusai Komp. Paninsula ((0761) 572677', '0.5079119 ', '101.442.085', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (181, 'Pekanbaru', 3, 'Green Hotel ', 'Jl.Arifin ahmad No.8/ ((0761) 856667', ' 0.477982 ', '101.449.701', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (182, 'Pekanbaru', 3, 'Parma Indah ', ' Jl. Ikhlas No.20 Telp.0761-851228', '0.5051089 ', '101.428.801', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (183, 'Pekanbaru', 3, 'Hotel Holiday', 'Komplek Mahkota, Jl. Tanjung Datuk Gg. Holiday, Tanjung Rhu, Lima Puluh, Pekanbaru City, Riau 28151', ' - 0.5415793', '1.014.361.007', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (184, 'Pekanbaru', 3, 'Hotel Gadja', 'Jl. Dr. Sutomo No.90, Suka Mulia, Kec. Sail, Kota Pekanbaru, Riau 28142', '0.5292414', '1.014.541.013', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (185, 'Pekanbaru', 3, 'Hotel Citismart', 'Jl. Gatot Subroto No.5, Kota Tinggi, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28155', '0.5296788 ', '1.014.480.543', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (186, 'Pekanbaru', 3, 'Hotel D\'e White\n\n', 'Jalan Soekarno - Hatta No.1, Labuh Baru Timur, Payung Sekaki, Tengkerang Bar., Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28289', '0.499291 ', '1.014.198.563', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (187, 'Pekanbaru', 3, 'Citismart Bandara', 'Jl. Kaharuddin Nst No.47, Simpang Tiga, Kec. Bukit Raya, Kota Pekanbaru, Riau 28288', '0.4619152 ', '1.014.498.784', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (188, 'Pekanbaru', 3, 'Hotel Tampan', 'Jl. Riau No. 2A, Kampung Baru, Kec. Senapelan, Kota Pekanbaru, Kepulauan Riau 28284', '0.5353705 ', '1.014.313.093', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (189, 'Pekanbaru', 3, 'Zuri Express', 'Jl. Gatot Subroto No.39B, Kota Tinggi, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28112', '0.5273712 ', '1.014.481.079', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (190, 'Pekanbaru', 3, 'Trenz Panam Hotel', 'Jl. HR. Soebrantas Panam No.228,Tobekgodang, Kec.Tampan, Kota Pekanbaru, Riau 28289', '0.4642911 ', '1.014.088.967', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (191, 'Pekanbaru', 3, 'Sabrina Hotel Sisingamangaraja', 'Jl. Sisingamangaraja, Rintis, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28156', '0.5275492 ', '1.014.490.467', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (192, 'Pekanbaru', 3, 'Hotel Resty Menara', 'Jl. Sisingamangaraja No.102, Rintis, Kec. Lima Puluh, Kota Pekanbaru, Riau 28156', '0.5272532', '1.014.482.474', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (193, 'Pekanbaru', 3, 'Wisma Dahlia  ', 'Jl. Dahlia No.137 (0761) 859996', '0.5231332 ', '1.014.355.501', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (194, 'Pekanbaru', 3, 'Hotel Paramitha  ', 'Jl. Teuku Umar No. 20 A (0761) 856722', '0.5321346', '1.014.481.107', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (195, 'Pekanbaru', 3, 'Tirta Kencana Syariah', 'Jl. Kaharuddin Nst No.167, Simpang Tiga, Kec. Bukit Raya, Kota Pekanbaru, Riau 28284', '0.4585894 ', '1.014.509.727', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (196, 'Pekanbaru', 3, 'Aloha', 'Jl. Riau Ujung No. 80, Tampan, Kec. Payung Sekaki, Kota Pekanbaru, Riau', '0.5352606 ', '1.014.145.206', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (197, 'Pekanbaru', 3, 'Hotel Akasia  ', 'Jl. Jend. Sudirman No. 419B Telp. 0761-862872', '0.5023284 ', '1.014.520.572', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (198, 'Pekanbaru', 3, 'Variz Homestay', 'Jl. Kopi No.8, Tengkerang Labuai, Kec. Bukit Raya, Kota Pekanbaru, Riau 28288', '0.4985755', '1.014.598.241', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (199, 'Pekanbaru', 3, 'Nilam sari', 'Jl. Sarwo Edhi No. 110, Suka Mulia, Kec. Sail, Kota Pekanbaru, Riau 28156', '\n0.5216136 ', '1.014.527.573', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (200, 'Pekanbaru', 3, 'Parma', ' Jl. Soekarno Hatta', ' 0.4597669 ', '1.014.165.055', 'default.png', '', '1', NULL, NULL);
INSERT INTO `alternatif` VALUES (201, 'Pekanbaru', 3, 'Hotel Amaris', 'Jalan KH. Wahid Hasyim Pinang Sebatang No.30, Sumahilang, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28133', '0.5266524 ', '1.014.486.122', 'default.png', '', '1', NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for gambar_alternatif_detail
-- ----------------------------
DROP TABLE IF EXISTS `gambar_alternatif_detail`;
CREATE TABLE `gambar_alternatif_detail`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_gambar_alternatif_detail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alternatif_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_utama` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `gambar_alternatif_detail_alternatif_id_foreign`(`alternatif_id` ASC) USING BTREE,
  CONSTRAINT `gambar_alternatif_detail_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gambar_alternatif_detail
-- ----------------------------

-- ----------------------------
-- Table structure for hasil
-- ----------------------------
DROP TABLE IF EXISTS `hasil`;
CREATE TABLE `hasil`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_hasil` date NOT NULL,
  `judul_hasil` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan_hasil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_hasil` tinyint(1) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hasil
-- ----------------------------

-- ----------------------------
-- Table structure for hasil_detail
-- ----------------------------
DROP TABLE IF EXISTS `hasil_detail`;
CREATE TABLE `hasil_detail`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `alternatif_id` int UNSIGNED NOT NULL,
  `hasil_id` int UNSIGNED NOT NULL,
  `bobot_hasil_detail` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `alternatif_id`(`alternatif_id` ASC) USING BTREE,
  INDEX `hasil_id`(`hasil_id` ASC) USING BTREE,
  CONSTRAINT `hasil_detail_ibfk_1` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_detail_ibfk_2` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hasil_detail
-- ----------------------------

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis
-- ----------------------------
INSERT INTO `jenis` VALUES (1, 'None Bintang', '2023-04-14 20:06:57', '2023-04-14 20:06:57');
INSERT INTO `jenis` VALUES (2, 'Bintang 1', '2023-04-14 20:07:04', '2023-04-14 20:07:04');
INSERT INTO `jenis` VALUES (3, 'Bintang 2', '2023-04-14 20:07:10', '2023-04-14 20:07:10');
INSERT INTO `jenis` VALUES (4, 'Bintang 3', '2023-04-14 20:07:14', '2023-04-14 20:07:14');
INSERT INTO `jenis` VALUES (5, 'Bintang 4', '2023-04-14 20:07:19', '2023-04-14 20:07:19');
INSERT INTO `jenis` VALUES (6, 'Bintang 5', '2023-04-14 20:07:24', '2023-04-14 20:07:24');

-- ----------------------------
-- Table structure for konfigurasi
-- ----------------------------
DROP TABLE IF EXISTS `konfigurasi`;
CREATE TABLE `konfigurasi`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_konfigurasi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_konfigurasi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_konfigurasi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_konfigurasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_konfigurasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_konfigurasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_konfigurasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `konfigurasi_email_konfigurasi_unique`(`email_konfigurasi` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of konfigurasi
-- ----------------------------
INSERT INTO `konfigurasi` VALUES (1, 'Sistem Pendukung Keputusan AHP & SAW', 'default.png', '082277562382', 'Sistem Pendukung Keputusan Hotel Terbaik di Pekanbaru', 'rsky15@gmail.com', 'Sistem Pendukung Keputusan AHP & SAW', 'Rsky @ TA', '2023-04-14 19:54:36', '2023-04-14 19:54:36');

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kriteria` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `definisi_kriteria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kriteria_kode_kriteria_unique`(`kode_kriteria` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES (5, 'K001', 'lokasi', '-', '2023-05-21 15:14:56', '2023-05-21 15:14:56');
INSERT INTO `kriteria` VALUES (6, 'K002', 'Harga Sewa', '-', '2023-05-21 15:15:09', '2023-05-21 15:15:09');
INSERT INTO `kriteria` VALUES (7, 'K003', 'Fasilitas', '-', '2023-05-21 15:15:21', '2023-05-21 15:15:21');
INSERT INTO `kriteria` VALUES (8, 'K004', 'Tipe Hotel', '-', '2023-05-21 15:15:32', '2023-05-21 15:15:32');

-- ----------------------------
-- Table structure for management_menu
-- ----------------------------
DROP TABLE IF EXISTS `management_menu`;
CREATE TABLE `management_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_management_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_management_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_management_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_management_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `membawahi_menu_management_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_node_management_menu` tinyint(1) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of management_menu
-- ----------------------------
INSERT INTO `management_menu` VALUES (1, '1', 'Dashboard', 'home', '/admin/home', '', 0, NULL, NULL);
INSERT INTO `management_menu` VALUES (2, '13', 'Data master', 'hard-drive', '#', '3,4,5,6,7,8,9,10,11', 1, NULL, '2023-04-16 10:53:43');
INSERT INTO `management_menu` VALUES (3, '3', 'Menu', 'far fa-circle', '/admin/menu', '', 0, NULL, NULL);
INSERT INTO `management_menu` VALUES (4, '4', 'Roles', 'far fa-circle', '/admin/roles', NULL, NULL, '2023-04-14 19:57:15', '2023-04-14 19:57:15');
INSERT INTO `management_menu` VALUES (5, '5', 'Users', 'far fa-circle', '/admin/users', NULL, NULL, '2023-04-14 19:57:31', '2023-04-16 10:32:26');
INSERT INTO `management_menu` VALUES (6, '6', 'Konfigurasi', 'far fa-circle', '/admin/konfigurasi', NULL, NULL, '2023-04-14 19:58:11', '2023-04-14 19:58:11');
INSERT INTO `management_menu` VALUES (7, '7', 'Akses User', 'far fa-circle', '/admin/access', NULL, NULL, '2023-04-14 19:58:43', '2023-04-14 19:58:43');
INSERT INTO `management_menu` VALUES (8, '8', 'Jenis', 'far fa-circle', '/admin/jenis', NULL, NULL, '2023-04-14 19:59:02', '2023-04-14 19:59:02');
INSERT INTO `management_menu` VALUES (9, '9', 'Kriteria', 'far fa-circle', '/admin/kriteria', NULL, NULL, '2023-04-14 19:59:20', '2023-04-14 19:59:20');
INSERT INTO `management_menu` VALUES (10, '10', 'Sub Kriteria', 'far fa-circle', '/admin/subKriteria', NULL, NULL, '2023-04-14 19:59:41', '2023-04-14 19:59:41');
INSERT INTO `management_menu` VALUES (11, '11', 'Alternatif', 'far fa-circle', '/admin/alternatif', NULL, NULL, '2023-04-14 20:00:02', '2023-04-14 20:00:02');
INSERT INTO `management_menu` VALUES (12, '2', 'My Profile', 'user', '/admin/profile', NULL, NULL, '2023-04-16 10:24:38', '2023-04-16 10:25:37');
INSERT INTO `management_menu` VALUES (13, '3', 'Penilaian User', 'book', '/admin/penilaianUser', NULL, NULL, '2023-04-16 10:52:51', '2023-04-16 10:52:51');
INSERT INTO `management_menu` VALUES (14, '4', 'AHP & SAW', 'book-open', '/admin/perhitungan', NULL, NULL, '2023-04-16 14:52:35', '2023-04-16 14:52:35');
INSERT INTO `management_menu` VALUES (15, '5', 'Hasil', 'bookmark', '/admin/hasil', NULL, NULL, '2023-04-17 04:01:09', '2023-04-17 04:01:09');

-- ----------------------------
-- Table structure for management_menu_roles
-- ----------------------------
DROP TABLE IF EXISTS `management_menu_roles`;
CREATE TABLE `management_menu_roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `management_menu_id` int UNSIGNED NOT NULL,
  `roles_id` int UNSIGNED NOT NULL,
  `is_create` tinyint(1) NULL DEFAULT NULL,
  `is_update` tinyint(1) NULL DEFAULT NULL,
  `is_delete` tinyint(1) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `management_menu_roles_management_menu_id_foreign`(`management_menu_id` ASC) USING BTREE,
  INDEX `management_menu_roles_roles_id_foreign`(`roles_id` ASC) USING BTREE,
  CONSTRAINT `management_menu_roles_management_menu_id_foreign` FOREIGN KEY (`management_menu_id`) REFERENCES `management_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `management_menu_roles_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 70 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of management_menu_roles
-- ----------------------------
INSERT INTO `management_menu_roles` VALUES (55, 1, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (56, 2, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (57, 3, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (58, 7, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (59, 4, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (60, 5, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (61, 6, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (62, 8, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (63, 9, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (64, 10, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (65, 11, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (66, 12, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (67, 13, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (68, 14, 1, 1, 1, 1, NULL, NULL);
INSERT INTO `management_menu_roles` VALUES (69, 15, 1, 1, 1, 1, NULL, '2023-04-17 04:01:25');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_11_26_231143_create_roles_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_11_26_231333_create_management_menus_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_11_26_231405_create_role_users_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_11_26_231515_create_konfigurasis_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_11_26_231630_create_profiles_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_11_28_091312_create_management_menu_roles_table', 1);
INSERT INTO `migrations` VALUES (12, '2023_01_17_183948_create_kriterias_table', 1);
INSERT INTO `migrations` VALUES (13, '2023_01_17_184212_create_sub_kriterias_table', 1);
INSERT INTO `migrations` VALUES (14, '2023_01_17_185400_create_jenis_table', 1);
INSERT INTO `migrations` VALUES (15, '2023_01_17_185800_create_alternatifs_table', 1);
INSERT INTO `migrations` VALUES (16, '2023_04_11_010939_create_gambar_alternatif_details_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for penilaian_user
-- ----------------------------
DROP TABLE IF EXISTS `penilaian_user`;
CREATE TABLE `penilaian_user`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `alternatif_id` int UNSIGNED NOT NULL,
  `kriteria_id` int UNSIGNED NOT NULL,
  `sub_kriteria_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_penilaian_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `alternatif_id`(`alternatif_id` ASC) USING BTREE,
  INDEX `kriteria_id`(`kriteria_id` ASC) USING BTREE,
  INDEX `penilaian_user_ibfk_3`(`sub_kriteria_id` ASC) USING BTREE,
  CONSTRAINT `penilaian_user_ibfk_1` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_user_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_user_ibfk_3` FOREIGN KEY (`sub_kriteria_id`) REFERENCES `sub_kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penilaian_user
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` int UNSIGNED NOT NULL,
  `nama_profile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_profile` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin_profile` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_profile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `profile_email_profile_unique`(`email_profile` ASC) USING BTREE,
  INDEX `profile_users_id_foreign`(`users_id` ASC) USING BTREE,
  CONSTRAINT `profile_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (1, 1, 'Admin maut', 'adminspk@gmail.com', 'alamat admin', '082277506232', 'P', '1684399667-1681617813-ganteng.jpeg', '2023-04-14 19:54:37', '2023-05-18 15:47:47');
INSERT INTO `profile` VALUES (2, 2, 'owner maut', 'ownermaut@gmail.com', 'alamat owner', '082277506232', 'L', 'default.png', '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `profile` VALUES (3, 3, 'developer maut', 'developermaut@gmail.com', 'alamat developer', '082277506232', 'L', 'default.png', '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `profile` VALUES (4, 4, 'user maut', 'usermaut@gmail.com', 'alamat user', '082277506232', 'L', 'default.png', '2023-04-14 19:54:37', '2023-04-14 19:54:37');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id` ASC) USING BTREE,
  INDEX `role_user_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1, 1, '2023-04-14 19:54:37', '2023-05-18 15:47:47');
INSERT INTO `role_user` VALUES (2, 2, 2, '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `role_user` VALUES (3, 3, 3, '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `role_user` VALUES (4, 4, 4, '2023-04-14 19:54:37', '2023-04-14 19:54:37');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `roles` VALUES (2, 'owner', '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `roles` VALUES (3, 'developer', '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `roles` VALUES (4, 'user', '2023-04-14 19:54:37', '2023-04-14 19:54:37');

-- ----------------------------
-- Table structure for sub_hasil_detail
-- ----------------------------
DROP TABLE IF EXISTS `sub_hasil_detail`;
CREATE TABLE `sub_hasil_detail`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `hasil_id` int UNSIGNED NOT NULL,
  `kriteria_id` int UNSIGNED NOT NULL,
  `matriks_sub_hasil_detail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kriteria_id`(`kriteria_id` ASC) USING BTREE,
  INDEX `sub_hasil_detail_ibfk_1`(`hasil_id` ASC) USING BTREE,
  CONSTRAINT `sub_hasil_detail_ibfk_1` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_hasil_detail_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_hasil_detail
-- ----------------------------

-- ----------------------------
-- Table structure for sub_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `sub_kriteria`;
CREATE TABLE `sub_kriteria`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_sub_kriteria` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sub_kriteria` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `definisi_sub_kriteria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `kriteria_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bobot_sub_kriteria` double NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sub_kriteria_kode_sub_kriteria_unique`(`kode_sub_kriteria` ASC) USING BTREE,
  INDEX `sub_kriteria_kriteria_id_foreign`(`kriteria_id` ASC) USING BTREE,
  CONSTRAINT `sub_kriteria_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sub_kriteria
-- ----------------------------
INSERT INTO `sub_kriteria` VALUES (22, 'S001', 'Tengah Kota', NULL, 5, '2023-05-21 15:16:14', '2023-05-21 15:16:14', 0.5);
INSERT INTO `sub_kriteria` VALUES (23, 'S002', 'Dalam Kota', NULL, 5, '2023-05-21 15:16:35', '2023-05-21 15:16:48', 1);
INSERT INTO `sub_kriteria` VALUES (24, 'S003', 'Pinggir Kota', NULL, 5, '2023-05-21 15:17:09', '2023-05-21 15:17:17', 0);
INSERT INTO `sub_kriteria` VALUES (25, 'S004', 'Murah', NULL, 6, '2023-05-21 15:17:42', '2023-05-21 15:17:42', 1);
INSERT INTO `sub_kriteria` VALUES (26, 'S005', 'Menengah', NULL, 6, '2023-05-21 15:17:58', '2023-05-21 15:17:58', 0.5);
INSERT INTO `sub_kriteria` VALUES (27, 'S006', 'Mahal', NULL, 6, '2023-05-21 15:18:10', '2023-05-21 15:18:10', 0);
INSERT INTO `sub_kriteria` VALUES (28, 'S007', 'Hotel bintang 1 dan 2, jumlah minimal 15-20 kamar, kamar mandi dalam, terdapat tempat rekreasi dan olahraga (minimal 1), dan halamn parkir', NULL, 7, '2023-05-21 15:18:34', '2023-05-21 15:18:51', 0);
INSERT INTO `sub_kriteria` VALUES (29, 'S008', 'hotel bintang 3, jumlah minimal 30 kamar, sarapan, wifi, kolam renang, taman, dan halaman parkir', NULL, 7, '2023-05-21 15:19:14', '2023-05-21 15:19:14', 0.5);
INSERT INTO `sub_kriteria` VALUES (30, 'S009', 'hotel bintang 4 dan 5, jumlah minimal kamar 50-100 kamar, sarapan, wifi, terdapat restaurant dan bar, tempat gym, kolam renang, ballroom, taman, lounge dan halaman parkir', NULL, 7, '2023-05-21 15:19:31', '2023-05-21 15:19:31', 1);
INSERT INTO `sub_kriteria` VALUES (31, 'S010', 'bintang 1-2', NULL, 8, '2023-05-21 15:21:18', '2023-05-21 15:21:18', 0);
INSERT INTO `sub_kriteria` VALUES (32, 'S011', 'bintang 3', NULL, 8, '2023-05-21 15:21:31', '2023-05-21 15:21:31', 0.5);
INSERT INTO `sub_kriteria` VALUES (33, 'S012', 'bintang 4 dan 5', NULL, 8, '2023-05-21 15:21:43', '2023-05-21 15:21:43', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin123', NULL, '$2y$10$vCR46ev8F2annV4GNKORouyfzJE2AEa1eLX499S4739heRNRX2xBC', NULL, NULL, NULL, NULL, '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `users` VALUES (2, 'owner123', NULL, '$2y$10$5uSA.4wmb.bOnfH4DWsNCeJoeSUsuad3YFQV2EWyhrs5W/aGbvFoO', NULL, NULL, NULL, NULL, '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `users` VALUES (3, 'developer123', NULL, '$2y$10$.RHretMV0/Ek0E.LU/YoE.Za8zxnm0XBxJs42Is57Dz3JI7CIHl6i', NULL, NULL, NULL, NULL, '2023-04-14 19:54:37', '2023-04-14 19:54:37');
INSERT INTO `users` VALUES (4, 'user123', NULL, '$2y$10$E0oRIbYr9j2E8GPyYETNh.yqLPC9Tt5RS0Ovgbhvrvm6.iCF9lR02', NULL, NULL, NULL, NULL, '2023-04-14 19:54:37', '2023-04-14 19:54:37');

SET FOREIGN_KEY_CHECKS = 1;
