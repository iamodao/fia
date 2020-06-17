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

-- Dumping structure for table fia_db.booking
DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT NULL,
  `status` char(20) DEFAULT 'pending',
  `entry` timestamp NULL DEFAULT NULL,
  `summary` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `amount` bigint(20) DEFAULT '0',
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.booking: ~2 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
REPLACE INTO `booking` (`id`, `bind`, `author`, `status`, `entry`, `summary`, `type`, `name`, `phone`, `email`, `amount`, `date`, `time`) VALUES
	(1, '45553', '0909799', 'pending', NULL, 'Teni Omoni', 'SALON', 'Teni Omoni', '08037788621', NULL, 0, '2020-06-15', '09:15:21'),
	(2, '79231', '0909799', 'pending', '2020-06-15 04:11:57', 'Richard Quest schedules a spa session for June 15th, 2020 at 10AM', 'SALON', 'Richard Quest', NULL, 'richard@quest.co.uk', 0, '2020-06-15', '10:13:40'),
	(3, '32455', '0909799', 'pending', '2020-06-17 11:49:53', 'Kelly Rowland', 'ROOM', 'Kelly Rowland', '09037788621', 'kelly@rowland.com', 0, '2020-06-17', '11:49:51');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;

-- Dumping structure for table fia_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table fia_db.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `bind`, `author`, `status`, `entry`, `username`, `password`, `type`) VALUES
	(1, '0909799', NULL, NULL, NULL, 'odao', 'oneguy', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table fia_db._table
DROP TABLE IF EXISTS `_table`;
CREATE TABLE IF NOT EXISTS `_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT NULL,
  `status` char(20) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT NULL,
  `Column 5` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db._table: ~0 rows (approximately)
/*!40000 ALTER TABLE `_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `_table` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
