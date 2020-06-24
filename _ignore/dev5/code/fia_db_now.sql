-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.6013
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
  `author` char(50) DEFAULT 'oAPP',
  `status` char(20) DEFAULT 'pending',
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `refid` varchar(20) DEFAULT NULL,
  `summary` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `suite` varchar(100) DEFAULT NULL,
  `amount` bigint(20) DEFAULT '0',
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.booking: ~21 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
REPLACE INTO `booking` (`id`, `bind`, `author`, `status`, `entry`, `refid`, `summary`, `type`, `name`, `phone`, `email`, `suite`, `amount`, `schedule_date`, `schedule_time`) VALUES
	(1, '159286806196009', '1809771323', 'pending', '2020-06-23 00:21:01', '3430', 'Let\'s clean my home', 'CLEANING', 'Jirk Falon', '0908877627', 'jirk@falon.com', NULL, 0, '2020-06-25', '11:13:00'),
	(2, '159287270379790', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(3, '159294783141834', '1457580891', 'pending', '2020-06-23 22:30:31', '7417', 'I will like to get my nails done', 'SALON', 'Jeka Nada', '07038899761', 'jeka@nada.com', NULL, 0, '2020-06-26', '11:44:00'),
	(4, '159295100376703', '246368795', 'pending', '2020-06-23 23:23:23', '9641', '', 'LOUNGE', 'Nicole Sanders', '08090786531', 'nicole@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(5, '159295100376795', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(6, '159295100376792', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(7, '159294783141835', '1457580891', 'pending', '2020-06-23 22:30:31', '7417', 'I will like to get my nails done', 'SALON', 'Jeka Nada', '07038899761', 'jeka@nada.com', NULL, 0, '2020-06-26', '11:44:00'),
	(8, '159287270379791', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(9, '159295100376762', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(10, '159287270379745', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(11, '159286806196049', '1809771323', 'pending', '2020-06-23 00:21:01', '3430', 'Let\'s clean my home', 'CLEANING', 'Jirk Falon', '0908877627', 'jirk@falon.com', NULL, 0, '2020-06-25', '11:13:00'),
	(12, '159287270379712', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(13, '159287270379711', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(14, '159287270379111', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(15, '159287270334311', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(16, '159287270379311', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(17, '009295100376794', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(18, '159295100376794', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(19, '159295100376721', '246368795', 'pending', '2020-06-23 23:23:23', '9642', '', 'LOUNGE', 'Zina Sanders', '08090786532', 'zina@gmail.com', NULL, 0, '2020-06-28', '12:15:00'),
	(20, '159287270311755', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00'),
	(21, '159287270311711', '246368795', 'pending', '2020-06-23 01:38:23', '5200', '', 'LOUNGE', 'Simion Kesta', '08077663813', '', NULL, 0, '2020-06-24', '10:35:00');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;

-- Dumping structure for table fia_db.room
DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'AVAILABLE',
  `suite` char(100) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`) USING BTREE,
  UNIQUE KEY `title` (`title`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `author` (`author`) USING BTREE,
  KEY `entry` (`entry`) USING BTREE,
  KEY `suite` (`suite`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.room: ~4 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
REPLACE INTO `room` (`id`, `bind`, `entry`, `author`, `status`, `suite`, `title`) VALUES
	(1, '973159301914232', '2020-06-24 18:19:02', 'APP', 'AVAILABLE', '442159301116415', '202'),
	(2, '638159302092748', '2020-06-24 18:48:47', 'APP', 'AVAILABLE', '442159301116415', '201'),
	(3, '556159302093725', '2020-06-24 18:48:57', 'APP', 'AVAILABLE', '442159301116415', '204'),
	(4, '425159302094494', '2020-06-24 18:49:04', 'APP', 'AVAILABLE', '442159301116415', '207');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Dumping structure for table fia_db.suite
DROP TABLE IF EXISTS `suite`;
CREATE TABLE IF NOT EXISTS `suite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'AVAILABLE',
  `title` char(100) DEFAULT NULL,
  `price` bigint(20) DEFAULT '0',
  `stock` tinyint(5) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`) USING BTREE,
  UNIQUE KEY `title` (`title`),
  KEY `status` (`status`),
  KEY `author` (`author`),
  KEY `entry` (`entry`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.suite: ~3 rows (approximately)
/*!40000 ALTER TABLE `suite` DISABLE KEYS */;
REPLACE INTO `suite` (`id`, `bind`, `entry`, `author`, `status`, `title`, `price`, `stock`) VALUES
	(1, '904159301114463', '2020-06-24 16:05:44', 'APP', 'AVAILABLE', 'Standard', 10000, 0),
	(2, '442159301116415', '2020-06-24 16:06:04', 'APP', 'AVAILABLE', 'Double', 16000, 4),
	(3, '790159301645356', '2020-06-24 17:34:13', 'APP', 'AVAILABLE', 'Execute', 31500, 0);
/*!40000 ALTER TABLE `suite` ENABLE KEYS */;

-- Dumping structure for table fia_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'ACTIVE',
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `session` char(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `phone` char(100) DEFAULT NULL,
  `username` char(100) DEFAULT NULL,
  `password` char(100) DEFAULT NULL,
  `name` char(100) DEFAULT NULL,
  `type` char(100) DEFAULT NULL,
  `office` char(100) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `sex` char(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`),
  KEY `type` (`type`),
  KEY `office` (`office`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table fia_db.user: ~10 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `bind`, `author`, `status`, `entry`, `session`, `email`, `phone`, `username`, `password`, `name`, `type`, `office`, `address`, `sex`, `birth`) VALUES
	(1, '246368795', 'SELF', 'active', '2020-06-21 22:31:40', NULL, 'odao@guy.com', '09097996048', 'odao', 'OneGuy', 'ODAO VAE', 'ADMIN', 'ADMIN', NULL, NULL, NULL),
	(2, '1457580891', 'oAPP', 'active', '2020-06-21 23:23:30', NULL, 'salon@guy.com', '09097996043', 'salon', 'SalonGuy', 'Salon Guy', 'STAFF', 'SALON', NULL, NULL, NULL),
	(3, '1809771323', 'oAPP', 'active', '2020-06-21 23:26:24', NULL, 'clean@guy.com', '09097996045', 'clean', 'CleanGuy', 'Clean Guy', 'STAFF', 'CLEANING', NULL, NULL, NULL),
	(4, '448264615', 'oAPP', 'active', '2020-06-21 23:27:40', NULL, 'lounge@guy.com', '09097996047', 'lounge', 'LoungeGuy', 'Lounge Guy', 'STAFF', 'LOUNGE', NULL, NULL, NULL),
	(5, '946937716', 'oAPP', 'active', '2020-06-21 23:30:30', NULL, 'room@guy.com', '09097996078', 'room', 'RoomGuy', 'Room Guy', 'STAFF', 'ROOM', NULL, NULL, NULL),
	(6, NULL, 'APP', 'ACTIVE', '2020-06-24 14:27:18', NULL, 'odao@vae24.com', '09097996061', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(7, NULL, 'APP', 'ACTIVE', '2020-06-24 14:28:13', NULL, 'odao@vae24.co', '09097996051', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(8, NULL, 'APP', 'ACTIVE', '2020-06-24 14:28:31', NULL, 'odao@vae24.org', '09057996051', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(10, '159300579486392', 'APP', 'ACTIVE', '2020-06-24 14:36:34', NULL, 'odao@vae24.co.uk', '09057996054', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(17, '213159300650793', 'APP', 'ACTIVE', '2020-06-24 14:48:27', NULL, 'odao@vae24.ng', '09037996054', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table fia_db._table
DROP TABLE IF EXISTS `_table`;
CREATE TABLE IF NOT EXISTS `_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'oAPP',
  `status` char(20) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Column 5` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db._table: ~0 rows (approximately)
/*!40000 ALTER TABLE `_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `_table` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
