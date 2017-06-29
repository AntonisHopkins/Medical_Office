-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for medical_office
CREATE DATABASE IF NOT EXISTS `medical_office` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `medical_office`;

-- Dumping structure for table medical_office.drugs
CREATE TABLE IF NOT EXISTS `drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table medical_office.drugs: ~5 rows (approximately)
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` (`id`, `name`) VALUES
	(4, 'abraxane'),
	(3, 'augmentin'),
	(1, 'morfine'),
	(5, 'renagel'),
	(2, 'testosterone');
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;

-- Dumping structure for table medical_office.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `health_insurance` varchar(50) NOT NULL,
  `medical_history` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `history` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `health_insurance` (`health_insurance`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 CHECKSUM=1;

-- Dumping data for table medical_office.patient: ~11 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `firstname`, `lastname`, `health_insurance`, `medical_history`, `phone`, `address`, `history`) VALUES
	(1, 'Giwrgos', 'Georgiou', '2', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(2, 'Vasilis', 'Vasilis', '3', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(3, 'Antonis', 'Antoniou', '10', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(4, 'Kostas', 'Papadopoulos', '100', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(5, 'Iordanis', 'Antoniou', '101', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(6, 'Antonis', 'Emmanouilidis', '13', NULL, NULL, NULL, '2016-12-12 22:06:50'),
	(7, 'Koutsirkas', 'Maximos', '313', NULL, NULL, NULL, '2017-03-05 14:09:48'),
	(8, 'Iordanis', 'Pasxas', '000123', NULL, NULL, NULL, '2017-03-05 14:09:48'),
	(9, 'Vasilopoulos', 'Lazaridis', '1245', NULL, NULL, NULL, '2017-03-06 20:12:45'),
	(10, 'Willy', 'FromLidl', '321', NULL, NULL, NULL, '2017-03-06 20:12:45'),
	(11, 'Kiriakos', 'Karas', '2017', NULL, NULL, NULL, '2017-03-06 20:12:45');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table medical_office.patient_drugs
CREATE TABLE IF NOT EXISTS `patient_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `prescription` varchar(50) NOT NULL,
  `history` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `drug` (`drug_id`),
  CONSTRAINT `drug` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table medical_office.patient_drugs: ~0 rows (approximately)
/*!40000 ALTER TABLE `patient_drugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_drugs` ENABLE KEYS */;

-- Dumping structure for table medical_office.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `history` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_date_time` (`date`,`hour`),
  KEY `FK1` (`patient_id`),
  CONSTRAINT `FK1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table medical_office.schedule: ~13 rows (approximately)
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` (`id`, `patient_id`, `date`, `hour`, `history`) VALUES
	(1, 3, '1994-02-02', '09:00', '2017-01-10 09:00:49'),
	(3, 2, '2020-03-17', '16:40', '2017-03-08 11:42:34'),
	(4, 3, '2017-03-17', '08:30', '2017-03-07 13:27:04'),
	(5, 4, '2017-03-17', '12:25', '2017-03-07 13:26:53'),
	(6, 5, '2017-03-17', '08:00', '2017-03-07 13:27:00'),
	(8, 7, '2017-03-17', '16:30', '2017-03-07 12:46:53'),
	(9, 8, '2017-03-17', '14:10', '2017-03-06 20:14:25'),
	(10, 9, '2017-03-17', '15:10', '2017-03-06 20:14:25'),
	(11, 10, '2017-03-17', '18:00', '2017-03-06 20:14:25'),
	(12, 11, '2017-03-17', '18:35', '2017-03-06 20:14:25'),
	(13, 10, '2017-03-17', '20:10', '2017-03-06 20:14:25'),
	(14, 1, '2017-03-17', '21:00', '2017-03-06 20:14:25'),
	(15, 2, '2017-03-17', '19:40', '2017-03-06 20:14:25');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;

-- Dumping structure for table medical_office.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table medical_office.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
