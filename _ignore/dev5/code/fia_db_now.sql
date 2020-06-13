-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.6005
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for fia_db
DROP DATABASE IF EXISTS `fia_db`;
CREATE DATABASE IF NOT EXISTS `fia_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fia_db`;

-- Dumping structure for table fia_db.firm
DROP TABLE IF EXISTS `firm`;
CREATE TABLE IF NOT EXISTS `firm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buid` varchar(50) DEFAULT NULL,
  `name` text,
  `email` text,
  `phone` text,
  `address` text,
  `addresso` text,
  `webmail` text,
  `timezone` varchar(50) DEFAULT 'Europe/London',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `buid` (`buid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.firm: 31 rows
/*!40000 ALTER TABLE `firm` DISABLE KEYS */;
REPLACE INTO `firm` (`id`, `buid`, `name`, `email`, `phone`, `address`, `addresso`, `webmail`, `timezone`) VALUES
	(1, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(2, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(3, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(4, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(5, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(6, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(7, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(8, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(9, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(10, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(11, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(12, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(13, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(14, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(15, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(16, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(17, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(18, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(19, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(20, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(21, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(22, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(23, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(24, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(25, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(26, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(27, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(28, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(29, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(30, NULL, 'Samsung Limited', 'info@samsungc.co', NULL, NULL, NULL, NULL, 'Europe/London'),
	(31, NULL, 'Jerry Gyang', NULL, NULL, NULL, NULL, NULL, 'Europe/London');
/*!40000 ALTER TABLE `firm` ENABLE KEYS */;

-- Dumping structure for table fia_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table fia_db.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `bind`, `username`, `password`, `type`) VALUES
	(1, '0909799', 'odao', 'oneguy', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
