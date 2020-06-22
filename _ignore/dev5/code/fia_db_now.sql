
DROP DATABASE IF EXISTS `fia_db`;
CREATE DATABASE IF NOT EXISTS `fia_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fia_db`;

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
  `amount` bigint(20) DEFAULT '0',
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

REPLACE INTO `booking` (`id`, `bind`, `author`, `status`, `entry`, `refid`, `summary`, `type`, `name`, `phone`, `email`, `amount`, `date`, `time`) VALUES
	(1, '45553', '0909799', 'pending', NULL, '0014', 'Teni Omoni', 'SALON', 'Teni Omoni', '08037788621', NULL, 5000, '2020-06-15', '09:15:21'),
	(2, '79231', '0909799', 'pending', '2020-06-15 04:11:57', '0013', 'Richard Quest schedules a spa session for June 15th, 2020 at 10AM', 'SALON', 'Richard Quest', NULL, 'richard@quest.co.uk', 300, '2020-06-15', '10:13:40'),
	(3, '32455', '0909799', 'pending', '2020-06-17 11:49:53', '0012', 'Kelly Rowland', 'ROOM', 'Kelly Rowland', '09037788621', 'kelly@rowland.com', 23706, '2020-06-17', '11:49:51');

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


DROP TABLE IF EXISTS `suite`;
CREATE TABLE IF NOT EXISTS `suite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bind` char(50) DEFAULT NULL,
  `author` char(50) DEFAULT 'oAPP',
  `status` char(50) DEFAULT NULL,
  `entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `suite` char(100) DEFAULT NULL,
  `price` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `bind` (`bind`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;


REPLACE INTO `user` (`id`, `bind`, `author`, `status`, `entry`, `username`, `password`, `type`, `office`, `name`, `phone`, `email`) VALUES
	(1, '246368795', 'SELF', 'active', '2020-06-21 22:31:40', 'odao', 'OneGuy', 'ADMIN', 'ADMIN', 'ODAO VAE', '09097996048', 'odao@guy.com'),
	(2, '1457580891', 'oAPP', 'active', '2020-06-21 23:23:30', 'salon', 'SalonGuy', 'STAFF', 'SALON', 'Salon Guy', '09097996043', 'salon@guy.com'),
	(3, '1809771323', 'oAPP', 'active', '2020-06-21 23:26:24', 'clean', 'CleanGuy', 'STAFF', 'CLEANING', 'Clean Guy', '09097996045', 'clean@guy.com'),
	(4, '448264615', 'oAPP', 'active', '2020-06-21 23:27:40', 'lounge', 'LoungeGuy', 'STAFF', 'LOUNGE', 'Lounge Guy', '09097996047', 'lounge@guy.com'),
	(5, '946937716', 'oAPP', 'active', '2020-06-21 23:30:30', 'room', 'RoomGuy', 'STAFF', 'ROOM', 'Room Guy', '09097996078', 'room@guy.com');

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

