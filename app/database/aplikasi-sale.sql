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


-- Dumping database structure for aplikasi-sale
CREATE DATABASE IF NOT EXISTS `aplikasi-sale` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aplikasi-sale`;

-- Dumping structure for table aplikasi-sale.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(200) DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `harga_beli` float DEFAULT NULL,
  `harga_jual` float DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.barang: ~4 rows (approximately)

-- Dumping structure for table aplikasi-sale.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.kategori: ~4 rows (approximately)

-- Dumping structure for table aplikasi-sale.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `id_barang` int DEFAULT NULL,
  `id_akun` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `kurir` varchar(15) DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.keranjang: ~0 rows (approximately)

-- Dumping structure for table aplikasi-sale.pesanan
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` int NOT NULL AUTO_INCREMENT,
  `id_barang` int DEFAULT NULL,
  `id_akun` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `kurir` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.pesanan: ~0 rows (approximately)

-- Dumping structure for table aplikasi-sale.satuan
CREATE TABLE IF NOT EXISTS `satuan` (
  `id_satuan` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.satuan: ~4 rows (approximately)

-- Dumping structure for table aplikasi-sale.sistem
CREATE TABLE IF NOT EXISTS `sistem` (
  `id_sistem` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bank` enum('Bank Mandiri','Bank Syariah Indonesia (BSI)','Bank Negara Indonesia (BNI)','Bank Rakyat Indonesia (BRI)','Bank Central Asia (BCA)','Bank Tabungan Negara (BTN)','CIMB Niaga','CIMB Niaga Syariah','Bank Danamon','Bank Danamon Syariah','Bank Muamalat','Maybank','OCBC NISP','Bank Bukopin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_rekening` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `flags` int NOT NULL,
  PRIMARY KEY (`id_sistem`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Data Sistem Pengaturan Warung';

-- Dumping data for table aplikasi-sale.sistem: ~1 rows (approximately)
REPLACE INTO `sistem` (`id_sistem`, `nama_toko`, `jenis_bank`, `nomor_rekening`, `logo`, `flags`) VALUES
	(1, 'Warung Baba', 'Bank Mandiri', '152-442-572-145-1', 'toko.jpeg', 1);

-- Dumping structure for table aplikasi-sale.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_akun` int NOT NULL AUTO_INCREMENT,
  `username` varchar(80) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `repassword` varchar(128) DEFAULT NULL,
  `alamat` text,
  `no_telepon` varchar(13) DEFAULT NULL,
  `nama_pengguna` varchar(100) DEFAULT NULL,
  `role` enum('pengguna','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_akun`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aplikasi-sale.user: ~1 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
