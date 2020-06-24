-- --------------------------------------------------------
-- Host:                         localhost
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

-- Dumping data for table fia_db.booking: ~18 rows (approximately)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'oAPP',
  `status` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `suite` char(100) DEFAULT NULL,
  `room` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.room: ~0 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Dumping structure for table fia_db.suite
DROP TABLE IF EXISTS `suite`;
CREATE TABLE IF NOT EXISTS `suite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'oAPP',
  `status` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `suite` char(100) DEFAULT NULL,
  `price` bigint(20) DEFAULT '0',
  `stock` tinyint(5) DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table fia_db.suite: ~0 rows (approximately)
/*!40000 ALTER TABLE `suite` DISABLE KEYS */;
/*!40000 ALTER TABLE `suite` ENABLE KEYS */;

-- Dumping structure for table fia_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'oAPP',
  `status` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` char(50) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `office` char(50) DEFAULT NULL,
  `name` char(100) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table fia_db.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `bind`, `author`, `status`, `entry`, `username`, `password`, `type`, `office`, `name`, `phone`, `email`) VALUES
	(1, '246368795', 'SELF', 'active', '2020-06-21 22:31:40', 'odao', 'OneGuy', 'ADMIN', 'ADMIN', 'ODAO VAE', '09097996048', 'odao@guy.com'),
	(2, '1457580891', 'oAPP', 'active', '2020-06-21 23:23:30', 'salon', 'SalonGuy', 'STAFF', 'SALON', 'Salon Guy', '09097996043', 'salon@guy.com'),
	(3, '1809771323', 'oAPP', 'active', '2020-06-21 23:26:24', 'clean', 'CleanGuy', 'STAFF', 'CLEANING', 'Clean Guy', '09097996045', 'clean@guy.com'),
	(4, '448264615', 'oAPP', 'active', '2020-06-21 23:27:40', 'lounge', 'LoungeGuy', 'STAFF', 'LOUNGE', 'Lounge Guy', '09097996047', 'lounge@guy.com'),
	(5, '946937716', 'oAPP', 'active', '2020-06-21 23:30:30', 'room', 'RoomGuy', 'STAFF', 'ROOM', 'Room Guy', '09097996078', 'room@guy.com');
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
