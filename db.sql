-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.2.6-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for devdb
CREATE DATABASE IF NOT EXISTS `devdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `devdb`;

-- Dumping structure for table devdb.booking
DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT current_timestamp(),
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'PENDING',
  `suite` char(100) DEFAULT NULL,
  `refid` char(100) DEFAULT NULL,
  `type` char(100) DEFAULT NULL,
  `name` char(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `phone` char(100) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `sex` char(100) DEFAULT NULL,
  `summary` char(200) DEFAULT NULL,
  `amount` bigint(20) DEFAULT 0,
  `schedule` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `author` (`author`) USING BTREE,
  KEY `entry` (`entry`) USING BTREE,
  KEY `title` (`refid`) USING BTREE,
  KEY `type` (`type`),
  KEY `suite` (`suite`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table devdb.booking: ~4 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
REPLACE INTO `booking` (`id`, `bind`, `entry`, `author`, `status`, `suite`, `refid`, `type`, `name`, `email`, `phone`, `address`, `sex`, `summary`, `amount`, `schedule`) VALUES
	(3, '301159345425314', '2020-06-29 19:10:53', 'APP', 'PENDING', NULL, '3586', 'CLEANING', 'Kingston Larel', '', '', '', '', '', 0, '2020-10-12 09:45:30'),
	(4, '585159345462292', '2020-06-29 19:17:02', 'APP', 'PENDING', NULL, '5386', 'CLEANING', 'Derik Leventis', 'derik@leventis.co', '09077886251', '', '', 'Cleaning at my apartment', 0, '2020-06-19 09:48:00'),
	(8, '859160669295237', '2020-11-30 00:35:52', 'APP', 'PENDING', 'Standard', '9149', 'ROOM', 'Cali', '', '0909', '', '', 'New', 0, '2020-12-01 11:34:00'),
	(9, '346160669306556', '2020-11-30 00:37:45', 'APP', 'PENDING', NULL, '2705', 'SALON', 'Silas More', '', '090977463', '', '', 'Nothing more\r\n', 0, '2021-12-28 23:36:00');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;

-- Dumping structure for table devdb.room
DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT current_timestamp(),
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

-- Dumping data for table devdb.room: ~4 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
REPLACE INTO `room` (`id`, `bind`, `entry`, `author`, `status`, `suite`, `title`) VALUES
	(1, '973159301914232', '2020-06-24 18:19:02', 'APP', 'AVAILABLE', '442159301116415', '202'),
	(2, '638159302092748', '2020-06-24 18:48:47', 'APP', 'AVAILABLE', '442159301116415', '201'),
	(3, '556159302093725', '2020-06-24 18:48:57', 'APP', 'AVAILABLE', '442159301116415', '204'),
	(4, '425159302094494', '2020-06-24 18:49:04', 'APP', 'AVAILABLE', '442159301116415', '207');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Dumping structure for table devdb.suite
DROP TABLE IF EXISTS `suite`;
CREATE TABLE IF NOT EXISTS `suite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT current_timestamp(),
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'AVAILABLE',
  `title` char(100) DEFAULT NULL,
  `price` bigint(20) DEFAULT 0,
  `stock` tinyint(5) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind` (`bind`) USING BTREE,
  UNIQUE KEY `title` (`title`),
  KEY `status` (`status`),
  KEY `author` (`author`),
  KEY `entry` (`entry`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table devdb.suite: ~4 rows (approximately)
/*!40000 ALTER TABLE `suite` DISABLE KEYS */;
REPLACE INTO `suite` (`id`, `bind`, `entry`, `author`, `status`, `title`, `price`, `stock`) VALUES
	(1, '904159301114463', '2020-06-24 16:05:44', 'APP', 'AVAILABLE', 'Standard', 10000, 0),
	(2, '442159301116415', '2020-06-24 16:06:04', 'APP', 'AVAILABLE', 'Double', 16000, 4),
	(3, '790159301645356', '2020-06-24 17:34:13', 'APP', 'AVAILABLE', 'Executive', 31500, 0),
	(4, '611159346444569', '2020-06-29 22:00:45', 'APP', 'AVAILABLE', 'Single', 8000, 5);
/*!40000 ALTER TABLE `suite` ENABLE KEYS */;

-- Dumping structure for table devdb.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'APP',
  `status` char(50) DEFAULT 'ACTIVE',
  `entry` timestamp NULL DEFAULT current_timestamp(),
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table devdb.user: ~11 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `bind`, `author`, `status`, `entry`, `session`, `email`, `phone`, `username`, `password`, `name`, `type`, `office`, `address`, `sex`, `birth`) VALUES
	(1, '246368795', 'SELF', 'active', '2020-06-21 22:31:40', NULL, 'odao@vae.com', '09097996048', 'odao', 'oneguy', 'ODAO', 'ADMIN', 'ADMIN', NULL, NULL, NULL),
	(2, '1457580891', 'oAPP', 'active', '2020-06-21 23:23:30', NULL, 'salon@guy.com', '09097996043', 'salon', 'salon', 'Salon Guy', 'STAFF', 'SALON', NULL, NULL, NULL),
	(3, '1809771323', 'oAPP', 'active', '2020-06-21 23:26:24', NULL, 'clean@guy.com', '09097996045', 'clean', 'CleanGuy', 'Clean Guy', 'STAFF', 'CLEANING', NULL, NULL, NULL),
	(4, '448264615', 'oAPP', 'active', '2020-06-21 23:27:40', NULL, 'lounge@guy.com', '09097996047', 'lounge', 'LoungeGuy', 'Lounge Guy', 'STAFF', 'LOUNGE', NULL, NULL, NULL),
	(5, '946937716', 'oAPP', 'active', '2020-06-21 23:30:30', NULL, 'room@guy.com', '09097996078', 'room', 'RoomGuy', 'Room Guy', 'STAFF', 'ROOM', NULL, NULL, NULL),
	(6, NULL, 'APP', 'ACTIVE', '2020-06-24 14:27:18', NULL, 'odao@vae24.com', '09097996061', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(7, NULL, 'APP', 'ACTIVE', '2020-06-24 14:28:13', NULL, 'odao@vae24.co', '09097996051', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(8, NULL, 'APP', 'ACTIVE', '2020-06-24 14:28:31', NULL, 'odao@vae24.org', '09057996051', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(10, '159300579486392', 'APP', 'ACTIVE', '2020-06-24 14:36:34', NULL, 'odao@vae24.co.uk', '09057996054', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(17, '213159300650793', 'APP', 'ACTIVE', '2020-06-24 14:48:27', NULL, 'odao@vae24.ng', '09037996054', NULL, NULL, 'ODAO VAE', NULL, NULL, NULL, 'male', NULL),
	(18, '502159346846425', 'APP', 'ACTIVE', '2020-06-29 23:07:44', NULL, 'gerrad@merry.com', '', 'gerrad', 'ger203', 'Gerradine Merry', 'staff', 'LOUNGE', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
