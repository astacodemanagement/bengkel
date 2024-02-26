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

-- Dumping structure for table db_bengkel.consumers
CREATE TABLE IF NOT EXISTS `consumers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `telephone` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.details: ~0 rows (approximately)

-- Dumping structure for table db_bengkel.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `price1` int NOT NULL,
  `price2` int NOT NULL,
  `price3` int NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `stock` int DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `location` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jenismobil` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `kode`, `name`, `price`, `price1`, `price2`, `price3`, `type`, `stock`, `gambar`, `location`, `jenismobil`, `description`) VALUES
	(7, '112023', 'Ban Mobil', 120000, 200000, 250000, 300000, 'sparepart', 10, '', 'gedung a', NULL, 'gaskeun'),
	(8, '0', 'Ganti Oli', 50000, 0, 0, 0, 'service', NULL, NULL, NULL, 'sample2', NULL),
	(9, '112024', 'Oli Evalube', 30000, 40000, 50000, 60000, 'sparepart', 10, '', 'tokoku.ltpresent.com', NULL, 'ddddd'),
	(12, '0', 'Cairan Pembersih', 30000, 0, 0, 0, 'service', NULL, NULL, NULL, 'sample', NULL);

-- Dumping structure for table db_bengkel.purchase
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `total` int NOT NULL,
  `supplier_id` int NOT NULL,
  `description` text,
  `pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.purchase: ~1 rows (approximately)
INSERT INTO `purchase` (`id`, `date`, `total`, `supplier_id`, `description`, `pic`) VALUES
	(20, '2024-02-23 13:33:43', 2000000, 1, NULL, NULL);

-- Dumping structure for table db_bengkel.purchase_details
CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.purchase_details: ~2 rows (approximately)
INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `price`, `qty`) VALUES
	(23, 20, 7, 100000, 10),
	(24, 20, 9, 100000, 10);

-- Dumping structure for table db_bengkel.shop_info
CREATE TABLE IF NOT EXISTS `shop_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.shop_info: ~0 rows (approximately)
INSERT INTO `shop_info` (`id`, `name`, `address`) VALUES
	(1, 'Daesan Jaya Autocare', 'Jl. Mencari Cinta Sejati');

-- Dumping structure for table db_bengkel.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.suppliers: ~1 rows (approximately)
INSERT INTO `suppliers` (`id`, `name`, `address`, `telephone`, `description`) VALUES
	(1, 'Jaya Bengkel', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', 'Jaya Bengkel'),
	(2, 'Leska Jaya', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', '085320555394', 'Leska Jaya');

-- Dumping structure for table db_bengkel.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('sparepart','service') NOT NULL,
  `total` int NOT NULL,
  `date` datetime NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `plat` varchar(15) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.transactions: ~0 rows (approximately)

-- Dumping structure for table db_bengkel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(32) DEFAULT NULL,
  `name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telephone` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `position` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `birthplace` varchar(32) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `level` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `joindate` date DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `username` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_bengkel.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `code`, `name`, `telephone`, `position`, `birthplace`, `birthdate`, `level`, `joindate`, `address`, `username`, `password`) VALUES
	(2, 'K001', 'Koperasi Satu', '085320555394', '1', '1', '2024-02-20', 'Superadmin', NULL, 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', 'admin', '$2y$10$tjaLcH9H8s0sEMgFAilvBu9.czn8JT3DpXEneInFWQLNJmg95/UZu'),
	(3, 'K002', 'Koperasi Dua', '085320555394', '1', '1', '1994-02-22', 'Superadmin', '2024-02-22', 'Perumahan CGM Sukarindik Kecamatan Bungursari. Blok C31. RT/RW 02/11. Kota Tasikmalaya\nJl. Tajur Indah', 'kasir', '$2y$10$RWH//svpdDjSJSc9uJ/W2.MgH/ZiueM4lpTQE2AF7rfmDiaexydbG');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
