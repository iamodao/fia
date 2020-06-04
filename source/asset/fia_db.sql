DROP DATABASE IF EXISTS `fia_db`;
CREATE DATABASE IF NOT EXISTS `fia_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fia_db`;

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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
	(33, NULL, 'Jerry Giang', 'info@jerry.com', NULL, NULL, NULL, NULL, 'Europe/London'),
	(31, NULL, 'Jerry Gyang', NULL, NULL, NULL, NULL, NULL, 'Europe/London'),
	(32, NULL, 'Jerry Gyang', 'info@jerry.com', NULL, NULL, NULL, NULL, 'Europe/London');