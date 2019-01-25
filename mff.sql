-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2019 at 03:16 PM
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
('Humidité', 'sen-hmdt-reztr', 1, 30, 1),
('A/C', 'sen-smok-ughbuf', 2, 0, 1),
('Thermomètre', 'sen-temp-rerzac', 2, 21, 1),
('A/C', 'sma-airc-huihv', 1, 28, 1),
('Veilleuse', 'sma-lght-mmmm', 1, 0, 1),
('Volet', 'sma-shtr-ueri', 3, 20, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
(9, '56789', '678', '567', '678');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `presets`
--

INSERT INTO `presets` (`id`, `id_home`, `name`) VALUES
(1, 1, 'Pre7'),
(2, 1, ''),
(3, 1, 'Volet 20%');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `preset_values`
--

INSERT INTO `preset_values` (`id`, `id_preset`, `serial_number`, `on_off`, `value`) VALUES
(1, 1, 'iyutdysjd875443', b'0', NULL),
(2, 2, 'sma-shtr-ueri', b'1', 26),
(3, 2, 'sma-lght-mmmm', b'0', NULL),
(4, 2, 'sen-smok-ughbuf', b'1', NULL),
(5, 3, 'sma-shtr-ueri', b'0', 20);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `id_home`, `name`) VALUES
(1, 1, 'Cuisine'),
(2, 1, 'Salon'),
(3, 1, 'Chambre');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_preset` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `hour` time DEFAULT NULL,
  `frequency` enum('daily','weekly','monthly','single use') COLLATE utf8mb4_unicode_520_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `birthdate`, `phone`, `password`, `id_home`) VALUES
(1, 'administrator', 'Matthieu', 'LORMEAU', 'matthieulormeau@gmail.com', '1997-01-15', '0685910051', 'in the court of Matthew king', NULL),
(2, 'administrator', 'Julie', 'Adalian', 'julie.adalian@isep.fr', '1997-03-01', '+33634601799', 'jesappelleroot', NULL),
(3, 'administrator', 'COMTE', 'Florian', 'comte.florian@gmail.com', '1997-09-27', '', '$2y$10$1jwCHDVpKMxx.c/IShftSewHA7YvunUzkGYKC.5KkRtc6euJiE2qO', NULL),
(4, 'administrator', 'strap', 'on', 'ilikestrapon@strapon.com', '2018-10-02', '', 'heyheyhey', NULL),
(5, 'house_member', 'house', 'member', 'house.member@test.com', '2018-11-27', '0687489685', 'housemember', 1),
(7, 'house_manager', 'Jean-Michelle', 'Crapaudw', 'jean-michel@crapaud.com', '2018-11-28', '0666666666wer', '$2y$10$O0oLH0BwjMzJxXzFYDQxkOawqL6xuEIq9f9VUf5u2HQjQ/5rwjq.G', 1),
(8, 'house_manager', 'Michel', 'Pierrot', 'pierrot@gmail.com', '0890-06-07', '4567890-=', '$2y$10$/websZQbJkDgbmORoq1nu.wl6K0r6vGx9j9j/kOStzH.uW0DgDQlS', 4),
(9, 'house_manager', 'fg', 'dfg', 'jean-ichel@crapaud.com', '0007-05-06', 'frtg', '$2y$10$4n1f8cQZgIa4z2IashVjDO43QL0MeEg2S/y.i9/U5D0fpuu0r4q1O', 7),
(10, 'house_manager', 'yui', 'tyu', 'qqq@qqq.prout', '2000-04-05', 't6', '$2y$10$B1elBsDfv7.nCgrIeVNGT.p1vDNpM8TRFQWQyz2DzMSLQgraYUyoW', 8),
(11, 'house_member', 'dctfvgbhnjm', 'rtyhuijm', 'comte.florian@outlook.com', '6789-04-05', '456789', '$2y$10$JMnmNXnWpTHEM.lNYNQjK.dRkMMafoiOkpUVwKAlquiqcuvB3lVPW', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `id_user`, `serial_number`, `access_level`) VALUES
(1, 2, 'iyutdysjd875443', 'write'),
(2, 5, 'iyutdysjd875443', 'none'),
(3, 5, 'jhzerijeor5489', 'read'),
(4, 5, 'uiezyriuer86', 'write');

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
