-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_bengkel.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `users_id` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `jumlah_hari_kerja` varchar(50) NOT NULL DEFAULT '0',
  `jumlah_masuk_kerja` varchar(50) NOT NULL DEFAULT '0',
  `jumlah_absen_kerja` varchar(50) NOT NULL DEFAULT '0',
  `uang_harian` varchar(50) NOT NULL DEFAULT '0',
  `bonus` varchar(50) NOT NULL DEFAULT '0',
  `kasbon` varchar(50) NOT NULL DEFAULT '0',
  `total_gaji` varchar(50) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_bengkel.absensi: ~0 rows (approximately)

-- Dumping structure for table db_bengkel.consumers
CREATE TABLE IF NOT EXISTS `consumers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` text,
  `telephone` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_bengkel.consumers: ~3 rows (approximately)
INSERT INTO `consumers` (`id`, `code`, `name`, `address`, `telephone`, `tipe`, `description`) VALUES
	(1, '1111', 'Koperasi Satu', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', NULL, NULL),
	(2, '2222', 'Koperasi Dua', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', NULL, NULL),
	(3, '3333', 'Koperasi Tiga', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', NULL, NULL);

-- Dumping structure for table db_bengkel.details
CREATE TABLE IF NOT EXISTS `details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.details: ~7 rows (approximately)
INSERT INTO `details` (`id`, `transaction_id`, `product_id`, `name`, `price`, `qty`) VALUES
	(47, 31, 8, 'Ganti Oli', 50000, 1),
	(48, 31, 12, 'Cairan Pembersih', 30000, 1),
	(49, 32, 9, 'Oli Evalube', 30000, 1),
	(50, 32, 8, 'Ganti Oli', 50000, 1),
	(51, 33, 8, 'Ganti Oli', 50000, 1),
	(52, 34, 9, 'Oli Evalube', 30000, 1),
	(53, 34, 13, 'Ban', 50000, 1),
	(54, 35, 9, 'Oli Evalube', 30000, 1),
	(55, 35, 13, 'Ban', 50000, 1),
	(56, 35, 8, 'Ganti Oli', 50000, 1),
	(57, 35, 12, 'Cairan Pembersih', 30000, 1),
	(58, 36, 9, 'Oli Evalube', 30000, 1),
	(59, 36, 13, 'Ban', 50000, 1),
	(60, 36, 8, 'Ganti Oli', 50000, 1),
	(61, 36, 12, 'Cairan Pembersih', 30000, 1),
	(62, 37, 8, 'Ganti Oli', 50000, 1),
	(63, 38, 8, 'Ganti Oli', 50000, 1),
	(64, 39, 8, 'Ganti Oli', 50000, 1),
	(65, 40, 12, 'Cairan Pembersih', 30000, 1),
	(66, 41, 9, 'Oli Evalube', 30000, 1),
	(67, 41, 13, 'Ban', 50000, 1),
	(68, 41, 8, 'Ganti Oli', 50000, 1),
	(69, 41, 12, 'Cairan Pembersih', 30000, 1),
	(70, 42, 7, 'Ban Mobil', 120000, 1),
	(71, 42, 9, 'Oli Evalube', 30000, 1),
	(72, 42, 13, 'Ban', 50000, 1),
	(73, 42, 8, 'Ganti Oli', 50000, 2),
	(74, 42, 12, 'Cairan Pembersih', 30000, 2);

-- Dumping structure for table db_bengkel.mechanic_details
CREATE TABLE IF NOT EXISTS `mechanic_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cost` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table db_bengkel.mechanic_details: ~4 rows (approximately)
INSERT INTO `mechanic_details` (`id`, `transaction_id`, `user_id`, `cost`, `date`) VALUES
	(8, 31, 4, 80000.000000, '2024-03-01 14:40:15'),
	(9, 32, 4, 40000.000000, '2024-03-03 01:10:44'),
	(10, 32, 5, 40000.000000, '2024-03-03 01:10:44'),
	(11, 33, 4, 50000.000000, '2024-03-04 12:05:34'),
	(12, 37, 4, 25000.000000, '0000-00-00 00:00:00'),
	(13, 37, 5, 25000.000000, '0000-00-00 00:00:00'),
	(14, 38, 4, 25000.000000, '2024-03-04 15:02:52'),
	(15, 38, 5, 25000.000000, '2024-03-04 15:02:52'),
	(16, 39, 4, 50000.000000, '2024-03-04 15:03:48'),
	(17, 40, 5, 30000.000000, '2024-03-04 15:04:45'),
	(18, 41, 4, 100000.000000, '2024-03-04 16:57:43'),
	(19, 41, 5, 60000.000000, '2024-03-04 16:57:43');

-- Dumping structure for table db_bengkel.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `price1` int NOT NULL,
  `price2` int NOT NULL,
  `price3` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `stock` int DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `jenismobil` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `kode`, `name`, `price`, `price1`, `price2`, `price3`, `type`, `stock`, `gambar`, `location`, `jenismobil`, `description`) VALUES
	(7, '112023', 'Ban Mobil', 120000, 200000, 250000, 300000, 'sparepart', 9, 'ee981f27827378159157bfe86c378eb3.jpg', 'gedung', NULL, 'gaskeun'),
	(8, '0', 'Ganti Oli', 50000, 0, 0, 0, 'service', NULL, NULL, NULL, 'sample2', NULL),
	(9, '112024', 'Oli Evalube', 30000, 40000, 50000, 60000, 'sparepart', 9, NULL, 'rak', NULL, 'ddddd'),
	(12, '0', 'Cairan Pembersih', 30000, 0, 0, 0, 'service', NULL, NULL, NULL, 'sample', NULL),
	(13, '00001', 'Ban', 50000, 100000, 110000, 120000, 'sparepart', 9, '21eda0b4980a803f99c2e154b8dc6d9f.png', 'Rak 2', NULL, 'BAN Luar tubeless');

-- Dumping structure for table db_bengkel.purchase
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `total` int NOT NULL,
  `supplier_id` int NOT NULL,
  `description` text,
  `pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.purchase: ~0 rows (approximately)
INSERT INTO `purchase` (`id`, `date`, `total`, `supplier_id`, `description`, `pic`) VALUES
	(23, '2024-03-05 09:09:31', 3000000, 1, 'Pembelian 1', NULL);

-- Dumping structure for table db_bengkel.purchase_details
CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.purchase_details: ~0 rows (approximately)
INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `price`, `qty`) VALUES
	(27, 23, 13, 100000, 10),
	(28, 23, 7, 100000, 10),
	(29, 23, 9, 100000, 10);

-- Dumping structure for table db_bengkel.shop_info
CREATE TABLE IF NOT EXISTS `shop_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.shop_info: ~0 rows (approximately)
INSERT INTO `shop_info` (`id`, `name`, `address`, `image`) VALUES
	(1, 'Daesan Jaya Autocare', 'Jl. Mencari Cinta Sejati', NULL);

-- Dumping structure for table db_bengkel.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.suppliers: ~2 rows (approximately)
INSERT INTO `suppliers` (`id`, `name`, `address`, `telephone`, `description`) VALUES
	(1, 'Jaya Bengkel', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', 'Jaya Bengkel'),
	(2, 'Leska Jaya', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', 'Leska Jaya');

-- Dumping structure for table db_bengkel.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `type` enum('sparepart','service') NOT NULL,
  `total` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `mechanical_costs` decimal(20,6) DEFAULT NULL,
  `date` datetime NOT NULL,
  `customer_id` int DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `plat` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `car_type` varchar(100) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `km` int DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.transactions: ~4 rows (approximately)
INSERT INTO `transactions` (`id`, `code`, `type`, `total`, `mechanical_costs`, `date`, `customer_id`, `customer_name`, `plat`, `car_type`, `pic`, `km`, `description`) VALUES
	(39, 'TRX0000000001', 'service', 50000.000000, 50000.000000, '2024-03-04 00:00:00', 1, 'Koperasi Satu', '9', '9', NULL, 9, '9'),
	(40, 'TRX0000000002', 'service', 30000.000000, 30000.000000, '2024-03-01 00:00:00', 3, 'Koperasi Tiga', '1', '1', NULL, 1, '1'),
	(41, 'TRX0000000003', 'service', 160000.000000, 160000.000000, '2024-03-04 00:00:00', 1, 'Koperasi Satu', '1', '1', NULL, 1, '1'),
	(42, 'TRX0000000004', 'service', 360000.000000, 0.000000, '2024-03-05 00:00:00', 1, 'Koperasi Satu', '123', '123', NULL, 123, '123');

-- Dumping structure for table db_bengkel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `position` varchar(32) DEFAULT NULL,
  `birthplace` varchar(32) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `joindate` date DEFAULT NULL,
  `address` text,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `code`, `name`, `telephone`, `position`, `birthplace`, `birthdate`, `level`, `joindate`, `address`, `username`, `password`) VALUES
	(2, 'K001', 'Koperasi Satu', '085320555394', '1', '1', '2024-02-20', 'Superadmin', NULL, 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', 'admin', '$2y$10$tjaLcH9H8s0sEMgFAilvBu9.czn8JT3DpXEneInFWQLNJmg95/UZu'),
	(3, 'K002', 'Koperasi Dua', '085320555394', '1', '1', '1994-02-22', 'Superadmin', '2024-02-22', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', 'kasir', '$2y$10$RWH//svpdDjSJSc9uJ/W2.MgH/ZiueM4lpTQE2AF7rfmDiaexydbG'),
	(4, 'K003', 'Mekanik 1', '0895331261219', 'Mekanik', 'Tangerang', '2024-02-27', 'Kasir', '2024-02-27', 'Kp. Dongkal', 'mekanik1', '$2y$10$1F/4YxwnEzGJv4Q502qXUezQ/zKxj5lNFXLBFmtlCWDOK4Eupu2GO'),
	(5, 'K004', 'Mekanik 2', '0895331261220', 'Mekanik', 'Tangerang', '2024-02-28', 'Kasir', '2024-02-28', 'Kp. Dongkal', 'mekanik2', '$2y$10$81od/5pjE3s60TD7BE0mVe/J3oVSixXCfE4FOMQBST3H8S/Ecnfc6');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
