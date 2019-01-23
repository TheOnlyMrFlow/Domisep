-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2019 at 04:06 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mff`
--

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
CREATE TABLE IF NOT EXISTS `components` (
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_room` int(11) NOT NULL,
  `value` float NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`serial_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`name`, `serial_number`, `id_room`, `value`, `state`) VALUES
('Thermomètre', 'sen-temp-rerzac', 2, 21, 0),
('Unanmed', 'sma-lght-def', 12, 0, 1),
('Unanmed', 'sma-lght-ppp', 10, 0, 1),
('Unanmed', 'sma-lght-qwefgr', 15, 0, 1),
('Unanmed', 'sma-lght-wdefrg', 11, 0, 1),
('Unanmed', 'sma-lght-wet', 16, 0, 1),
('Unanmed', 'sma-lght-wqefr', 13, 0, 1),
('Unanmed', 'sma-lght-wqefrw', 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE IF NOT EXISTS `homes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `address`, `city`, `country`, `zip_code`) VALUES
(1, '7allée du Basilic', 'Saint Germain-lès-Corbeil', 'France', '91250'),
(2, '666 rue des crapauds mÃ©talleux', 'Clisson', 'France', '44190'),
(3, '45 rue des bons raisins', 'Prais', 'france', '75998'),
(4, '346890-', '456890-=', '456780[', '456780-'),
(5, 'dfghjk', 'tyuio', 'gfhgjhkjkl', '5677'),
(6, 'vbhj', 'vgbhij', 'vgybuh', 'vgybuh'),
(7, 'fvgh', 'tgy', 'ty', 'tgyh'),
(8, 'ui', 'yu', 'yui', 'yui'),
(9, '56789', '678', '567', '678'),
(10, '11 rue de Bellevue', 'Boulogne', 'France', '92130'),
(11, 'cfg', 'cfygh', 'vyg', 'cyg'),
(12, 'cfg', 'cfygh', 'vyg', 'cyg'),
(13, 'vygh', 'vgybh', 'gbh', 'vgbh'),
(14, 'cgh', 'vtgh', 'vg', 'vgh'),
(15, 'ty', 'tg', 't', 'ty'),
(16, 'cfg', 'cdfg', 'cdt', 'cdt'),
(17, 'edrfg', 'drfgyh', 'd5tg', 'detg'),
(18, 'edrfg', 'drfgyh', 'd5tg', 'detg'),
(19, 'f', 'cdrf', 'c', 'xrdf'),
(20, '5r', 'fr', 'd5', '5rt');

-- --------------------------------------------------------

--
-- Table structure for table `invite_keys`
--

DROP TABLE IF EXISTS `invite_keys`;
CREATE TABLE IF NOT EXISTS `invite_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `inv_key` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_home` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `invite_keys`
--

INSERT INTO `invite_keys` (`id`, `email`, `inv_key`, `id_home`) VALUES
(1, 'wdfegr@wdef.co', '$2y$10$BCDUeliA/J2wO45k3RYjze4skfMOpAZx2m/vfndnfXATjez3I1igK', 1),
(2, 'comte.florian@outlook.com', '$2y$10$Qtc00.rCKUI2fNt8UEny9OChpPBds.VdBkmFrZct1ByE3ZCfI.VCu', 1),
(3, 'comte.florian@outlook.com', '$2y$10$PNJVK/NlU.Mx15OQYKnRD.2YW7CkjdwArujwYRnJ4mV.pQtgXULCC', 1),
(4, 'comte.florian@outlook.com', '$2y$10$jCIZNUqVzGo9Jf6iCJgyPe0o.jS0QHNde1kc4AfCx3OeI1BypBU2i', 1),
(5, 'comte.florian@outlook.com', '03i5Rgvxj6QKoakGeF7rAWcwPESHNY', 1),
(6, 'comte.florian@outlook.com', 'dmH7S06sZeC1RVWJpNybtlB4xAr9TO', 1),
(7, 'comte.florian@outlook.com', 'GiZnupyFd2CUXcvQIxH1w0AgjqK9S8', 1),
(8, 'comte.florian@outlook.com', 'Ek1aNuPc7VrXzx2MKDlfTZAm4gC0Wv', 1),
(9, 'comte.florian@outlook.com', '$2y$10$/WOQWpQQ4rf9lEVIK9KdbucS69j5ESjEunarGcGWa3yPPpDyEo5eC', 1),
(10, 'comte.florian@outlook.com', '$2y$10$DHxJJ/sipnBgkfotqbLiaeGVfiJlJF08K/Fzt76R.vU.V49QTbh6q', 1),
(11, 'comte.florian@outlook.com', '$2y$10$NqPzVZIzyBpZBr9yt/96x.4PIU3v92fs.QzhPDn9d7FjZmBXY49aS', 1),
(12, 'comte.florian@outlook.com', '$2y$10$9dJ/N/biXtV9Nn8VJK2Ft.R4rrt2hTF5yW/sO71J2Rb37T4ZvHR2S', 1),
(13, 'comte.florian@outlook.com', '$2y$10$.UKZ9ZMPwzOjPb2HVo6YROpDsk72m44Z.SvdBuIs1ZFn6s9wP76wm', 1),
(14, 'comte.florian@outlook.com', '$2y$10$WsWdLEsGlH1VKHXh9G033.lnsRzNBSTiYH9cuSNxQMmcHGVD.7Jgy', 1),
(15, 'comte.florian@outlook.com', '$2y$10$CrlH0kiu/Rao3UqdCgzvt.R2mJ0rr9xgVSBuJGvun1L8jbD12zuuS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_keys`
--

DROP TABLE IF EXISTS `password_reset_keys`;
CREATE TABLE IF NOT EXISTS `password_reset_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `hashed_key` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `password_reset_keys`
--

INSERT INTO `password_reset_keys` (`id`, `id_user`, `hashed_key`, `expiration`) VALUES
(26, 7, '$2y$10$PT.i.3E71IJuyiy5ofos/uRd0Ul9UZ4f.xmdezpoGPs0IstWePNmq', '2018-12-23 11:47:01'),
(23, 3, '$2y$10$mIdHCP8vIRMvPGcNYT5lPOK7miQb4OAYYmRE9t2d/Yus3yAnZcPAm', '2018-12-07 13:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `presets`
--

DROP TABLE IF EXISTS `presets`;
CREATE TABLE IF NOT EXISTS `presets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_home` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `presets`
--

INSERT INTO `presets` (`id`, `id_home`, `name`) VALUES
(12, 1, 'prout'),
(14, 1, 'pqpqpqpq'),
(15, 20, 'Nuit');

-- --------------------------------------------------------

--
-- Table structure for table `preset_values`
--

DROP TABLE IF EXISTS `preset_values`;
CREATE TABLE IF NOT EXISTS `preset_values` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_preset` int(11) NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `on_off` bit(1) NOT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `preset_values`
--

INSERT INTO `preset_values` (`id`, `id_preset`, `serial_number`, `on_off`, `value`) VALUES
(16, 14, 'sma-shtr-wevf', b'1', 5),
(17, 15, 'sma-lght-wet', b'0', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_home` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `id_home`, `name`) VALUES
(10, 14, 'Room'),
(11, 15, 'Room'),
(12, 16, 'Room'),
(13, 17, 'Room'),
(14, 18, 'Room'),
(15, 19, 'Room'),
(16, 20, 'Room');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_preset` int(11) NOT NULL,
  `on_off` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `start_date` date NOT NULL,
  `hour` time NOT NULL,
  `frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `id_preset`, `name`, `start_date`, `hour`, `frequency`) VALUES
(1, 1, 'sksat', NULL, NULL, 'single use'),
(2, 1, 'Pre7', '2018-07-22', '14:08:00', 'weekly');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('administrator','house_manager','house_member') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_home` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `birthdate`, `phone`, `password`, `id_home`) VALUES
(1, 'administrator', 'Matthieu', 'LORMEAU', 'matthieulormeau@gmail.com', '1997-01-15', '0685910051', 'in the court of Matthew king', NULL),
(2, 'administrator', 'Julie', 'Adalian', 'julie.adalian@isep.fr', '1997-03-01', '+33634601799', 'jesappelleroot', NULL),
(4, 'administrator', 'strap', 'on', 'ilikestrapon@strapon.com', '2018-10-02', '', 'heyheyhey', NULL),
(5, 'house_member', 'house', 'member', 'house.member@test.com', '2018-11-27', '0687489685', 'housemember', 1),
(8, 'house_manager', 'Michel', 'Pierrot', 'pierrot@gmail.com', '0890-06-07', '4567890-=', '$2y$10$/websZQbJkDgbmORoq1nu.wl6K0r6vGx9j9j/kOStzH.uW0DgDQlS', 4),
(9, 'house_manager', 'fg', 'dfg', 'jean-ichel@crapaud.com', '0007-05-06', 'frtg', '$2y$10$4n1f8cQZgIa4z2IashVjDO43QL0MeEg2S/y.i9/U5D0fpuu0r4q1O', 7),
(10, 'house_manager', 'yui', 'tyu', 'qqq@qqq.prout', '2000-04-05', 't6', '$2y$10$B1elBsDfv7.nCgrIeVNGT.p1vDNpM8TRFQWQyz2DzMSLQgraYUyoW', 8),
(12, 'house_manager', 'Comte', 'Florian', 'comte.florian@gmail.com', '1997-09-27', '06 44 23 43 41', '$2y$10$GAAlmj/x7d7konOM1d0KM.8xBNV0MVo3VI0rhqpcW4cnbNcH./5b6', 10),
(14, 'house_manager', 'dcfyg', 'xdtyg', 'lolol@lol.com', '7890-05-06', 'gfh', '$2y$10$NO3/4swbUkFUqr5p8OPYFu/iX4Nsq8dcYqY7VSYWEf2OIwuBPOoqu', 12),
(15, 'house_manager', 'gbh', 'vgbj', 'gbh@efbg.wdefg', '0890-06-07', 'fvgh', '$2y$10$.Wg9kIyV.c0zEKlM6Efh5erRUqnu6DIiWFrW04Qto6n0/QEUa8wam', 13),
(16, 'house_manager', 'vyj', 'cfghjk', 'qqq@fergth.dfghjm', '6890-04-05', 'cfghj', '$2y$10$Ctz72wKOv.PxDB1JUyHby.WWRegXbZFY7HKPxksggLCVDI9wPgo7W', 14),
(17, 'house_manager', 'drfg', 'edfg', 'ggg@ggg.wet', '7890-05-06', 'rtyu', '$2y$10$aY1qo8vnsQ99uw0m3Zi4/.LvBYeCLEEjSnxz2qsTFZvHByA.AeO6q', 15),
(18, 'house_manager', 'xrgbh', 'xdcfgh', 'jjj@jjj.jjj', '2000-04-05', 'g', '$2y$10$E3kqW8.OREkA5YVb09xH8eX8PVDdbvBaxxJLza/ux4woZz7sGL.Ua', 16),
(19, 'house_manager', 'ctgb', 'xrdgbh', 'jj@jj.mjo', '6789-04-05', 'edrfyhuji', '$2y$10$jKTqerguDry4SuV6QECH6uT4pfXquNToPYbmrzfsb5pKmLWSLtWte', 17),
(20, 'house_manager', 'ctgb', 'xrdgbh', 'dfe@efe.wef', '6789-04-05', 'edrfyhuji', '$2y$10$08D8uov.0Sa48s5w43SB7OR/.njneFAIFc9oACO.YWyY6qadsfkwm', 18),
(21, 'house_manager', 'fg', 'cfg', 'tgyuhij@ubj.wdefg', '6789-04-05', 'dcfg', '$2y$10$hf2uNDLekd7lV45Xk38VuO/OvW0.F.6jeFRFjNMIsy8X/BpJMka4y', 19),
(22, 'house_manager', 'tvgh', 'ctuhijn', 'wefth@efgh.qwfe', '0090-07-08', 'rfy', '$2y$10$HylSTFZYYOV0uapHlmyzQudBZD3Ko1OtvXx54agsGboVZllPW1VAe', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

DROP TABLE IF EXISTS `user_rights`;
CREATE TABLE IF NOT EXISTS `user_rights` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `access_level` enum('none','read','write') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `id_user`, `serial_number`, `access_level`) VALUES
(1, 2, 'iyutdysjd875443', 'write'),
(2, 5, 'iyutdysjd875443', 'none'),
(3, 5, 'jhzerijeor5489', 'read'),
(4, 5, 'uiezyriuer86', 'write'),
(11, 5, 'sma-shtr-wevf', 'none'),
(12, 11, 'sma-shtr-wevf', 'write');

-- --------------------------------------------------------

--
-- Table structure for table `values_history`
--

DROP TABLE IF EXISTS `values_history`;
CREATE TABLE IF NOT EXISTS `values_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;






COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
