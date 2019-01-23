-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 05:00 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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

CREATE TABLE `components` (
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_room` int(11) NOT NULL,
  `value` float NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`name`, `serial_number`, `id_room`, `value`, `state`) VALUES
('Veilleuse', 'bas-lght-mmmm', 1, 0, 1),
('Détecteur de fumée', 'bas-smok-ughbuf', 1, 0, 1),
('Humidité', 'sen-hmdt-reztr', 1, 30, 1),
('Thermomètre', 'sen-temp-rerzac', 2, 21, 1),
('A/C', 'sma-airc-huihv', 1, 30, 1),
('Volet', 'sma-shtr-ueri', 3, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `zip_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `address`, `city`, `country`, `zip_code`) VALUES
(1, '7 allée du Basilic', 'Saint Germain-lès-Corbeil', 'France', '91250'),
(2, '666 rue des crapauds mÃ©talleux', 'Clisson', 'France', '44190'),
(3, '45 rue des bons raisins', 'Prais', 'france', '75998'),
(4, '11 Rue Benjamin Franklin, ', 'Paris', 'France', '75116');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_keys`
--

CREATE TABLE `password_reset_keys` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hashed_key` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset_keys`
--

INSERT INTO `password_reset_keys` (`id`, `id_user`, `hashed_key`, `expiration`) VALUES
(22, 7, '$2y$10$mqF1wfCQH6RzrUXQdWJtyuoqteEwyOltr7eJej7Pe1K7n/j5nz91a', '2018-12-12 09:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `presets`
--

CREATE TABLE `presets` (
  `id` int(11) NOT NULL,
  `id_home` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presets`
--

INSERT INTO `presets` (`id`, `id_home`, `name`) VALUES
(8, 1, 'fumée'),
(9, 1, 'ezraezr'),
(10, 1, 'pls marche');

-- --------------------------------------------------------

--
-- Table structure for table `preset_values`
--

CREATE TABLE `preset_values` (
  `id` int(50) NOT NULL,
  `id_preset` int(11) NOT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `on_off` bit(1) NOT NULL,
  `value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `preset_values`
--

INSERT INTO `preset_values` (`id`, `id_preset`, `serial_number`, `on_off`, `value`) VALUES
(18, 8, 'bas-smok-ughbuf', b'0', NULL),
(19, 9, 'sen-hmdt-reztr', b'0', 30),
(20, 9, 'bas-smok-ughbuf', b'1', NULL),
(21, 10, 'bas-smok-ughbuf', b'1', NULL),
(22, 10, 'sen-hmdt-reztr', b'1', 30),
(23, 10, 'sma-shtr-ueri', b'1', 30),
(24, 10, 'bas-lght-mmmm', b'1', NULL),
(25, 10, 'sen-temp-rerzac', b'1', 21),
(26, 10, 'sma-airc-huihv', b'1', 30);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `id_home` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `id_home`, `name`) VALUES
(1, 1, 'Antichambre'),
(2, 1, 'Salon'),
(3, 1, 'La Couuuisine');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `id_preset` int(11) NOT NULL,
  `on_off` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `start_date` date NOT NULL,
  `hour` time NOT NULL,
  `frequency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `id_preset`, `on_off`, `name`, `start_date`, `hour`, `frequency`) VALUES
(34, 10, 1, 'pls marche', '2019-01-24', '14:40:00', 86400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('administrator','house_manager','house_member') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_home` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `birthdate`, `phone`, `password`, `id_home`) VALUES
(1, 'administrator', 'Matthieu', 'LORMEAU', 'matthieulormeau@gmail.com', '1997-01-15', '0685910051', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', NULL),
(2, 'administrator', 'Julie', 'Adalian', 'julie.adalian@isep.fr', '1997-03-01', '+33634601799', 'jesappelleroot', NULL),
(3, 'administrator', 'COMTE', 'Florian', 'comte.florian@gmail.com', '1997-09-27', '', 'koukou', NULL),
(4, 'administrator', 'strap', 'on', 'ilikestrapon@strapon.com', '2018-10-02', '', 'heyheyhey', NULL),
(5, 'house_member', 'house', 'member', 'house.member@test.com', '2018-11-27', '0687489685', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', 1),
(7, 'house_manager', 'Jean-Michel', 'Crapaud', 'jean-michel@crapaud.com', '2018-11-28', '0666666666', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', 1),
(8, 'house_manager', 'Matthieu', 'rzre', 'lormeau@gmail.com', '2017-02-01', '666992818', '$2y$10$IGkTMqei2TR.aqa6nGHHseS02yX3L0p97Z1RH4hRKA.Bc0b4HHIxO', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `access_level` enum('none','read','write') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `id_user`, `serial_number`, `access_level`) VALUES
(45, 5, 'sen-hmdt-reztr', 'write'),
(46, 5, 'sen-smok-ughbuf', 'read'),
(47, 5, 'sma-airc-huihv', 'read'),
(48, 5, 'sma-lght-mmmm', 'write'),
(49, 5, 'sen-temp-rerzac', 'read'),
(50, 5, 'sma-shtr-ueri', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `values_history`
--

CREATE TABLE `values_history` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `serial_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `values_history`
--

INSERT INTO `values_history` (`id`, `timestamp`, `serial_number`, `value`) VALUES
(134, '2019-01-23 14:14:00', 'sen-hmdt-reztr', 30),
(135, '2019-01-23 14:14:00', 'sen-temp-rerzac', 21),
(136, '2019-01-23 14:14:00', 'sma-airc-huihv', 30),
(137, '2019-01-23 14:14:00', 'sma-shtr-ueri', 30),
(141, '2019-01-23 14:15:00', 'sen-hmdt-reztr', 30),
(142, '2019-01-23 14:15:00', 'sen-temp-rerzac', 21),
(143, '2019-01-23 14:15:00', 'sma-airc-huihv', 30),
(144, '2019-01-23 14:15:00', 'sma-shtr-ueri', 30),
(148, '2019-01-23 14:16:00', 'sen-hmdt-reztr', 30),
(149, '2019-01-23 14:16:00', 'sen-temp-rerzac', 21),
(150, '2019-01-23 14:16:00', 'sma-airc-huihv', 30),
(151, '2019-01-23 14:16:00', 'sma-shtr-ueri', 30),
(155, '2019-01-23 14:17:00', 'sen-hmdt-reztr', 30),
(156, '2019-01-23 14:17:00', 'sen-temp-rerzac', 21),
(157, '2019-01-23 14:17:00', 'sma-airc-huihv', 30),
(158, '2019-01-23 14:17:00', 'sma-shtr-ueri', 30),
(162, '2019-01-23 14:18:00', 'sen-hmdt-reztr', 30),
(163, '2019-01-23 14:18:00', 'sen-temp-rerzac', 21),
(164, '2019-01-23 14:18:00', 'sma-airc-huihv', 30),
(165, '2019-01-23 14:18:00', 'sma-shtr-ueri', 30),
(169, '2019-01-23 14:19:00', 'sen-hmdt-reztr', 30),
(170, '2019-01-23 14:19:00', 'sen-temp-rerzac', 21),
(171, '2019-01-23 14:19:00', 'sma-airc-huihv', 30),
(172, '2019-01-23 14:19:00', 'sma-shtr-ueri', 30),
(176, '2019-01-23 14:20:00', 'sen-hmdt-reztr', 30),
(177, '2019-01-23 14:20:00', 'sen-temp-rerzac', 21),
(178, '2019-01-23 14:20:00', 'sma-airc-huihv', 30),
(179, '2019-01-23 14:20:00', 'sma-shtr-ueri', 30),
(183, '2019-01-23 14:21:00', 'sen-hmdt-reztr', 30),
(184, '2019-01-23 14:21:00', 'sen-temp-rerzac', 21),
(185, '2019-01-23 14:21:00', 'sma-airc-huihv', 30),
(186, '2019-01-23 14:21:00', 'sma-shtr-ueri', 30),
(190, '2019-01-23 14:22:00', 'sen-hmdt-reztr', 30),
(191, '2019-01-23 14:22:00', 'sen-temp-rerzac', 21),
(192, '2019-01-23 14:22:00', 'sma-airc-huihv', 30),
(193, '2019-01-23 14:22:00', 'sma-shtr-ueri', 30),
(197, '2019-01-23 14:23:00', 'sen-hmdt-reztr', 30),
(198, '2019-01-23 14:23:00', 'sen-temp-rerzac', 21),
(199, '2019-01-23 14:23:00', 'sma-airc-huihv', 30),
(200, '2019-01-23 14:23:00', 'sma-shtr-ueri', 30),
(204, '2019-01-23 14:24:00', 'sen-hmdt-reztr', 30),
(205, '2019-01-23 14:24:00', 'sen-temp-rerzac', 21),
(206, '2019-01-23 14:24:00', 'sma-airc-huihv', 30),
(207, '2019-01-23 14:24:00', 'sma-shtr-ueri', 30),
(211, '2019-01-23 14:25:00', 'sen-hmdt-reztr', 30),
(212, '2019-01-23 14:25:00', 'sen-temp-rerzac', 21),
(213, '2019-01-23 14:25:00', 'sma-airc-huihv', 30),
(214, '2019-01-23 14:25:00', 'sma-shtr-ueri', 30),
(218, '2019-01-23 14:26:00', 'sen-hmdt-reztr', 30),
(219, '2019-01-23 14:26:00', 'sen-temp-rerzac', 21),
(220, '2019-01-23 14:26:00', 'sma-airc-huihv', 30),
(221, '2019-01-23 14:26:00', 'sma-shtr-ueri', 30),
(225, '2019-01-23 14:27:00', 'sen-hmdt-reztr', 30),
(226, '2019-01-23 14:27:00', 'sen-temp-rerzac', 21),
(227, '2019-01-23 14:27:00', 'sma-airc-huihv', 30),
(228, '2019-01-23 14:27:00', 'sma-shtr-ueri', 30),
(232, '2019-01-23 14:28:00', 'sen-hmdt-reztr', 30),
(233, '2019-01-23 14:28:00', 'sen-temp-rerzac', 21),
(234, '2019-01-23 14:28:00', 'sma-airc-huihv', 30),
(235, '2019-01-23 14:28:00', 'sma-shtr-ueri', 30),
(239, '2019-01-23 14:29:00', 'sen-hmdt-reztr', 30),
(240, '2019-01-23 14:29:00', 'sen-temp-rerzac', 21),
(241, '2019-01-23 14:29:00', 'sma-airc-huihv', 30),
(242, '2019-01-23 14:29:00', 'sma-shtr-ueri', 30),
(246, '2019-01-23 14:30:00', 'sen-hmdt-reztr', 30),
(247, '2019-01-23 14:30:00', 'sen-temp-rerzac', 21),
(248, '2019-01-23 14:30:00', 'sma-airc-huihv', 30),
(249, '2019-01-23 14:30:00', 'sma-shtr-ueri', 30),
(253, '2019-01-23 14:31:00', 'sen-hmdt-reztr', 30),
(254, '2019-01-23 14:31:00', 'sen-temp-rerzac', 21),
(255, '2019-01-23 14:31:00', 'sma-airc-huihv', 30),
(256, '2019-01-23 14:31:00', 'sma-shtr-ueri', 30),
(260, '2019-01-23 14:32:00', 'sen-hmdt-reztr', 30),
(261, '2019-01-23 14:32:00', 'sen-temp-rerzac', 21),
(262, '2019-01-23 14:32:00', 'sma-airc-huihv', 30),
(263, '2019-01-23 14:32:00', 'sma-shtr-ueri', 30),
(267, '2019-01-23 14:33:00', 'sen-hmdt-reztr', 30),
(268, '2019-01-23 14:33:00', 'sen-temp-rerzac', 21),
(269, '2019-01-23 14:33:00', 'sma-airc-huihv', 30),
(270, '2019-01-23 14:33:00', 'sma-shtr-ueri', 30),
(274, '2019-01-23 14:34:00', 'sen-hmdt-reztr', 30),
(275, '2019-01-23 14:34:00', 'sen-temp-rerzac', 21),
(276, '2019-01-23 14:34:00', 'sma-airc-huihv', 30),
(277, '2019-01-23 14:34:00', 'sma-shtr-ueri', 30),
(281, '2019-01-23 14:35:00', 'sen-hmdt-reztr', 30),
(282, '2019-01-23 14:35:00', 'sen-temp-rerzac', 21),
(283, '2019-01-23 14:35:00', 'sma-airc-huihv', 30),
(284, '2019-01-23 14:35:00', 'sma-shtr-ueri', 30),
(288, '2019-01-23 14:36:00', 'sen-hmdt-reztr', 30),
(289, '2019-01-23 14:36:00', 'sen-temp-rerzac', 21),
(290, '2019-01-23 14:36:00', 'sma-airc-huihv', 30),
(291, '2019-01-23 14:36:00', 'sma-shtr-ueri', 30),
(295, '2019-01-23 14:37:00', 'sen-hmdt-reztr', 30),
(296, '2019-01-23 14:37:00', 'sen-temp-rerzac', 21),
(297, '2019-01-23 14:37:00', 'sma-airc-huihv', 30),
(298, '2019-01-23 14:37:00', 'sma-shtr-ueri', 30),
(302, '2019-01-23 14:38:00', 'sen-hmdt-reztr', 30),
(303, '2019-01-23 14:38:00', 'sen-temp-rerzac', 21),
(304, '2019-01-23 14:38:00', 'sma-airc-huihv', 30),
(305, '2019-01-23 14:38:00', 'sma-shtr-ueri', 30),
(309, '2019-01-23 14:39:00', 'sen-hmdt-reztr', 30),
(310, '2019-01-23 14:39:00', 'sen-temp-rerzac', 21),
(311, '2019-01-23 14:39:00', 'sma-airc-huihv', 30),
(312, '2019-01-23 14:39:00', 'sma-shtr-ueri', 30),
(316, '2019-01-23 14:40:00', 'sen-hmdt-reztr', 30),
(317, '2019-01-23 14:40:00', 'sen-temp-rerzac', 21),
(318, '2019-01-23 14:40:00', 'sma-airc-huihv', 30),
(319, '2019-01-23 14:40:00', 'sma-shtr-ueri', 30),
(323, '2019-01-23 14:41:00', 'sen-hmdt-reztr', 30),
(324, '2019-01-23 14:41:00', 'sen-temp-rerzac', 21),
(325, '2019-01-23 14:41:00', 'sma-airc-huihv', 30),
(326, '2019-01-23 14:41:00', 'sma-shtr-ueri', 30),
(330, '2019-01-23 14:42:00', 'sen-hmdt-reztr', 30),
(331, '2019-01-23 14:42:00', 'sen-temp-rerzac', 21),
(332, '2019-01-23 14:42:00', 'sma-airc-huihv', 30),
(333, '2019-01-23 14:42:00', 'sma-shtr-ueri', 30),
(337, '2019-01-23 14:43:00', 'sen-hmdt-reztr', 30),
(338, '2019-01-23 14:43:00', 'sen-temp-rerzac', 21),
(339, '2019-01-23 14:43:00', 'sma-airc-huihv', 30),
(340, '2019-01-23 14:43:00', 'sma-shtr-ueri', 30),
(344, '2019-01-23 14:44:00', 'sen-hmdt-reztr', 30),
(345, '2019-01-23 14:44:00', 'sen-temp-rerzac', 21),
(346, '2019-01-23 14:44:00', 'sma-airc-huihv', 30),
(347, '2019-01-23 14:44:00', 'sma-shtr-ueri', 30),
(351, '2019-01-23 14:45:00', 'sen-hmdt-reztr', 30),
(352, '2019-01-23 14:45:00', 'sen-temp-rerzac', 21),
(353, '2019-01-23 14:45:00', 'sma-airc-huihv', 30),
(354, '2019-01-23 14:45:00', 'sma-shtr-ueri', 30),
(358, '2019-01-23 14:46:00', 'sen-hmdt-reztr', 30),
(359, '2019-01-23 14:46:00', 'sen-temp-rerzac', 21),
(360, '2019-01-23 14:46:00', 'sma-airc-huihv', 30),
(361, '2019-01-23 14:46:00', 'sma-shtr-ueri', 30),
(365, '2019-01-23 14:47:00', 'sen-hmdt-reztr', 30),
(366, '2019-01-23 14:47:00', 'sen-temp-rerzac', 21),
(367, '2019-01-23 14:47:00', 'sma-airc-huihv', 30),
(368, '2019-01-23 14:47:00', 'sma-shtr-ueri', 30),
(372, '2019-01-23 14:48:00', 'sen-hmdt-reztr', 30),
(373, '2019-01-23 14:48:00', 'sen-temp-rerzac', 21),
(374, '2019-01-23 14:48:00', 'sma-airc-huihv', 30),
(375, '2019-01-23 14:48:00', 'sma-shtr-ueri', 30),
(379, '2019-01-23 14:49:00', 'sen-hmdt-reztr', 30),
(380, '2019-01-23 14:49:00', 'sen-temp-rerzac', 21),
(381, '2019-01-23 14:49:00', 'sma-airc-huihv', 30),
(382, '2019-01-23 14:49:00', 'sma-shtr-ueri', 30),
(386, '2019-01-23 14:50:00', 'sen-hmdt-reztr', 30),
(387, '2019-01-23 14:50:00', 'sen-temp-rerzac', 21),
(388, '2019-01-23 14:50:00', 'sma-airc-huihv', 30),
(389, '2019-01-23 14:50:00', 'sma-shtr-ueri', 30),
(393, '2019-01-23 14:51:00', 'sen-hmdt-reztr', 30),
(394, '2019-01-23 14:51:00', 'sen-temp-rerzac', 21),
(395, '2019-01-23 14:51:00', 'sma-airc-huihv', 30),
(396, '2019-01-23 14:51:00', 'sma-shtr-ueri', 30),
(400, '2019-01-23 14:52:00', 'sen-hmdt-reztr', 30),
(401, '2019-01-23 14:52:00', 'sen-temp-rerzac', 21),
(402, '2019-01-23 14:52:00', 'sma-airc-huihv', 30),
(403, '2019-01-23 14:52:00', 'sma-shtr-ueri', 30),
(407, '2019-01-23 14:53:00', 'sen-hmdt-reztr', 30),
(408, '2019-01-23 14:53:00', 'sen-temp-rerzac', 21),
(409, '2019-01-23 14:53:00', 'sma-airc-huihv', 30),
(410, '2019-01-23 14:53:00', 'sma-shtr-ueri', 30),
(414, '2019-01-23 14:54:00', 'sen-hmdt-reztr', 30),
(415, '2019-01-23 14:54:00', 'sen-temp-rerzac', 21),
(416, '2019-01-23 14:54:00', 'sma-airc-huihv', 30),
(417, '2019-01-23 14:54:00', 'sma-shtr-ueri', 30),
(421, '2019-01-23 14:55:00', 'sen-hmdt-reztr', 30),
(422, '2019-01-23 14:55:00', 'sen-temp-rerzac', 21),
(423, '2019-01-23 14:55:00', 'sma-airc-huihv', 30),
(424, '2019-01-23 14:55:00', 'sma-shtr-ueri', 30),
(428, '2019-01-23 14:56:00', 'sen-hmdt-reztr', 30),
(429, '2019-01-23 14:56:00', 'sen-temp-rerzac', 21),
(430, '2019-01-23 14:56:00', 'sma-airc-huihv', 30),
(431, '2019-01-23 14:56:00', 'sma-shtr-ueri', 30),
(435, '2019-01-23 14:57:00', 'sen-hmdt-reztr', 30),
(436, '2019-01-23 14:57:00', 'sen-temp-rerzac', 21),
(437, '2019-01-23 14:57:00', 'sma-airc-huihv', 30),
(438, '2019-01-23 14:57:00', 'sma-shtr-ueri', 30),
(442, '2019-01-23 14:58:00', 'sen-hmdt-reztr', 30),
(443, '2019-01-23 14:58:00', 'sen-temp-rerzac', 21),
(444, '2019-01-23 14:58:00', 'sma-airc-huihv', 30),
(445, '2019-01-23 14:58:00', 'sma-shtr-ueri', 30),
(449, '2019-01-23 14:59:00', 'sen-hmdt-reztr', 30),
(450, '2019-01-23 14:59:00', 'sen-temp-rerzac', 21),
(451, '2019-01-23 14:59:00', 'sma-airc-huihv', 30),
(452, '2019-01-23 14:59:00', 'sma-shtr-ueri', 30),
(456, '2019-01-23 15:00:00', 'sen-hmdt-reztr', 30),
(457, '2019-01-23 15:00:00', 'sen-temp-rerzac', 21),
(458, '2019-01-23 15:00:00', 'sma-airc-huihv', 30),
(459, '2019-01-23 15:00:00', 'sma-shtr-ueri', 30),
(463, '2019-01-23 15:01:00', 'sen-hmdt-reztr', 30),
(464, '2019-01-23 15:01:00', 'sen-temp-rerzac', 21),
(465, '2019-01-23 15:01:00', 'sma-airc-huihv', 30),
(466, '2019-01-23 15:01:00', 'sma-shtr-ueri', 30),
(470, '2019-01-23 15:02:00', 'sen-hmdt-reztr', 30),
(471, '2019-01-23 15:02:00', 'sen-temp-rerzac', 21),
(472, '2019-01-23 15:02:00', 'sma-airc-huihv', 30),
(473, '2019-01-23 15:02:00', 'sma-shtr-ueri', 30),
(477, '2019-01-23 15:03:00', 'sen-hmdt-reztr', 30),
(478, '2019-01-23 15:03:00', 'sen-temp-rerzac', 21),
(479, '2019-01-23 15:03:00', 'sma-airc-huihv', 30),
(480, '2019-01-23 15:03:00', 'sma-shtr-ueri', 30),
(484, '2019-01-23 15:04:00', 'sen-hmdt-reztr', 30),
(485, '2019-01-23 15:04:00', 'sen-temp-rerzac', 21),
(486, '2019-01-23 15:04:00', 'sma-airc-huihv', 30),
(487, '2019-01-23 15:04:00', 'sma-shtr-ueri', 30),
(491, '2019-01-23 15:05:00', 'sen-hmdt-reztr', 30),
(492, '2019-01-23 15:05:00', 'sen-temp-rerzac', 21),
(493, '2019-01-23 15:05:00', 'sma-airc-huihv', 30),
(494, '2019-01-23 15:05:00', 'sma-shtr-ueri', 30),
(498, '2019-01-23 15:06:00', 'sen-hmdt-reztr', 30),
(499, '2019-01-23 15:06:00', 'sen-temp-rerzac', 21),
(500, '2019-01-23 15:06:00', 'sma-airc-huihv', 30),
(501, '2019-01-23 15:06:00', 'sma-shtr-ueri', 30),
(505, '2019-01-23 15:07:00', 'sen-hmdt-reztr', 30),
(506, '2019-01-23 15:07:00', 'sen-temp-rerzac', 21),
(507, '2019-01-23 15:07:00', 'sma-airc-huihv', 30),
(508, '2019-01-23 15:07:00', 'sma-shtr-ueri', 30),
(512, '2019-01-23 15:08:00', 'sen-hmdt-reztr', 30),
(513, '2019-01-23 15:08:00', 'sen-temp-rerzac', 21),
(514, '2019-01-23 15:08:00', 'sma-airc-huihv', 30),
(515, '2019-01-23 15:08:00', 'sma-shtr-ueri', 30),
(519, '2019-01-23 15:09:00', 'sen-hmdt-reztr', 30),
(520, '2019-01-23 15:09:00', 'sen-temp-rerzac', 21),
(521, '2019-01-23 15:09:00', 'sma-airc-huihv', 30),
(522, '2019-01-23 15:09:00', 'sma-shtr-ueri', 30),
(526, '2019-01-23 15:10:00', 'sen-hmdt-reztr', 30),
(527, '2019-01-23 15:10:00', 'sen-temp-rerzac', 21),
(528, '2019-01-23 15:10:00', 'sma-airc-huihv', 30),
(529, '2019-01-23 15:10:00', 'sma-shtr-ueri', 30),
(533, '2019-01-23 15:11:00', 'sen-hmdt-reztr', 30),
(534, '2019-01-23 15:11:00', 'sen-temp-rerzac', 21),
(535, '2019-01-23 15:11:00', 'sma-airc-huihv', 30),
(536, '2019-01-23 15:11:00', 'sma-shtr-ueri', 30),
(540, '2019-01-23 15:12:00', 'sen-hmdt-reztr', 30),
(541, '2019-01-23 15:12:00', 'sen-temp-rerzac', 21),
(542, '2019-01-23 15:12:00', 'sma-airc-huihv', 30),
(543, '2019-01-23 15:12:00', 'sma-shtr-ueri', 30),
(547, '2019-01-23 15:13:00', 'sen-hmdt-reztr', 30),
(548, '2019-01-23 15:13:00', 'sen-temp-rerzac', 21),
(549, '2019-01-23 15:13:00', 'sma-airc-huihv', 30),
(550, '2019-01-23 15:13:00', 'sma-shtr-ueri', 30),
(554, '2019-01-23 15:14:00', 'sen-hmdt-reztr', 30),
(555, '2019-01-23 15:14:00', 'sen-temp-rerzac', 21),
(556, '2019-01-23 15:14:00', 'sma-airc-huihv', 30),
(557, '2019-01-23 15:14:00', 'sma-shtr-ueri', 30),
(561, '2019-01-23 15:15:00', 'sen-hmdt-reztr', 30),
(562, '2019-01-23 15:15:00', 'sen-temp-rerzac', 21),
(563, '2019-01-23 15:15:00', 'sma-airc-huihv', 30),
(564, '2019-01-23 15:15:00', 'sma-shtr-ueri', 30),
(568, '2019-01-23 15:16:00', 'sen-hmdt-reztr', 30),
(569, '2019-01-23 15:16:00', 'sen-temp-rerzac', 21),
(570, '2019-01-23 15:16:00', 'sma-airc-huihv', 30),
(571, '2019-01-23 15:16:00', 'sma-shtr-ueri', 30),
(575, '2019-01-23 15:17:00', 'sen-hmdt-reztr', 30),
(576, '2019-01-23 15:17:00', 'sen-temp-rerzac', 21),
(577, '2019-01-23 15:17:00', 'sma-airc-huihv', 30),
(578, '2019-01-23 15:17:00', 'sma-shtr-ueri', 30),
(582, '2019-01-23 15:18:00', 'sen-hmdt-reztr', 30),
(583, '2019-01-23 15:18:00', 'sen-temp-rerzac', 21),
(584, '2019-01-23 15:18:00', 'sma-airc-huihv', 30),
(585, '2019-01-23 15:18:00', 'sma-shtr-ueri', 30),
(589, '2019-01-23 15:19:00', 'sen-hmdt-reztr', 30),
(590, '2019-01-23 15:19:00', 'sen-temp-rerzac', 21),
(591, '2019-01-23 15:19:00', 'sma-airc-huihv', 30),
(592, '2019-01-23 15:19:00', 'sma-shtr-ueri', 30),
(596, '2019-01-23 15:20:00', 'sen-hmdt-reztr', 30),
(597, '2019-01-23 15:20:00', 'sen-temp-rerzac', 21),
(598, '2019-01-23 15:20:00', 'sma-airc-huihv', 30),
(599, '2019-01-23 15:20:00', 'sma-shtr-ueri', 30),
(603, '2019-01-23 15:21:00', 'sen-hmdt-reztr', 30),
(604, '2019-01-23 15:21:00', 'sen-temp-rerzac', 21),
(605, '2019-01-23 15:21:00', 'sma-airc-huihv', 30),
(606, '2019-01-23 15:21:00', 'sma-shtr-ueri', 30),
(610, '2019-01-23 15:22:00', 'sen-hmdt-reztr', 30),
(611, '2019-01-23 15:22:00', 'sen-temp-rerzac', 21),
(612, '2019-01-23 15:22:00', 'sma-airc-huihv', 30),
(613, '2019-01-23 15:22:00', 'sma-shtr-ueri', 30),
(617, '2019-01-23 15:23:00', 'sen-hmdt-reztr', 30),
(618, '2019-01-23 15:23:00', 'sen-temp-rerzac', 21),
(619, '2019-01-23 15:23:00', 'sma-airc-huihv', 30),
(620, '2019-01-23 15:23:00', 'sma-shtr-ueri', 30),
(624, '2019-01-23 15:24:00', 'sen-hmdt-reztr', 30),
(625, '2019-01-23 15:24:00', 'sen-temp-rerzac', 21),
(626, '2019-01-23 15:24:00', 'sma-airc-huihv', 30),
(627, '2019-01-23 15:24:00', 'sma-shtr-ueri', 30),
(631, '2019-01-23 15:25:00', 'sen-hmdt-reztr', 30),
(632, '2019-01-23 15:25:00', 'sen-temp-rerzac', 21),
(633, '2019-01-23 15:25:00', 'sma-airc-huihv', 30),
(634, '2019-01-23 15:25:00', 'sma-shtr-ueri', 30),
(638, '2019-01-23 15:26:00', 'sen-hmdt-reztr', 30),
(639, '2019-01-23 15:26:00', 'sen-temp-rerzac', 21),
(640, '2019-01-23 15:26:00', 'sma-airc-huihv', 30),
(641, '2019-01-23 15:26:00', 'sma-shtr-ueri', 30),
(645, '2019-01-23 15:27:00', 'sen-hmdt-reztr', 30),
(646, '2019-01-23 15:27:00', 'sen-temp-rerzac', 21),
(647, '2019-01-23 15:27:00', 'sma-airc-huihv', 30),
(648, '2019-01-23 15:27:00', 'sma-shtr-ueri', 30),
(652, '2019-01-23 15:28:00', 'sen-hmdt-reztr', 30),
(653, '2019-01-23 15:28:00', 'sen-temp-rerzac', 21),
(654, '2019-01-23 15:28:00', 'sma-airc-huihv', 30),
(655, '2019-01-23 15:28:00', 'sma-shtr-ueri', 30),
(659, '2019-01-23 15:29:00', 'sen-hmdt-reztr', 30),
(660, '2019-01-23 15:29:00', 'sen-temp-rerzac', 21),
(661, '2019-01-23 15:29:00', 'sma-airc-huihv', 30),
(662, '2019-01-23 15:29:00', 'sma-shtr-ueri', 30),
(666, '2019-01-23 15:30:00', 'sen-hmdt-reztr', 30),
(667, '2019-01-23 15:30:00', 'sen-temp-rerzac', 21),
(668, '2019-01-23 15:30:00', 'sma-airc-huihv', 30),
(669, '2019-01-23 15:30:00', 'sma-shtr-ueri', 30),
(673, '2019-01-23 15:47:21', 'sen-hmdt-reztr', 30),
(674, '2019-01-23 15:47:21', 'sen-temp-rerzac', 21),
(675, '2019-01-23 15:47:21', 'sma-airc-huihv', 30),
(676, '2019-01-23 15:47:21', 'sma-shtr-ueri', 30),
(680, '2019-01-23 15:48:00', 'sen-hmdt-reztr', 30),
(681, '2019-01-23 15:48:00', 'sen-temp-rerzac', 21),
(682, '2019-01-23 15:48:00', 'sma-airc-huihv', 30),
(683, '2019-01-23 15:48:00', 'sma-shtr-ueri', 30),
(687, '2019-01-23 15:49:00', 'sen-hmdt-reztr', 30),
(688, '2019-01-23 15:49:00', 'sen-temp-rerzac', 21),
(689, '2019-01-23 15:49:00', 'sma-airc-huihv', 30),
(690, '2019-01-23 15:49:00', 'sma-shtr-ueri', 30),
(694, '2019-01-23 15:50:00', 'sen-hmdt-reztr', 30),
(695, '2019-01-23 15:50:00', 'sen-temp-rerzac', 21),
(696, '2019-01-23 15:50:00', 'sma-airc-huihv', 30),
(697, '2019-01-23 15:50:00', 'sma-shtr-ueri', 30),
(701, '2019-01-23 15:51:00', 'sen-hmdt-reztr', 30),
(702, '2019-01-23 15:51:00', 'sen-temp-rerzac', 21),
(703, '2019-01-23 15:51:00', 'sma-airc-huihv', 30),
(704, '2019-01-23 15:51:00', 'sma-shtr-ueri', 30),
(708, '2019-01-23 15:52:00', 'sen-hmdt-reztr', 30),
(709, '2019-01-23 15:52:00', 'sen-temp-rerzac', 21),
(710, '2019-01-23 15:52:00', 'sma-airc-huihv', 30),
(711, '2019-01-23 15:52:00', 'sma-shtr-ueri', 30),
(715, '2019-01-23 15:53:00', 'sen-hmdt-reztr', 30),
(716, '2019-01-23 15:53:00', 'sen-temp-rerzac', 21),
(717, '2019-01-23 15:53:00', 'sma-airc-huihv', 30),
(718, '2019-01-23 15:53:00', 'sma-shtr-ueri', 30),
(722, '2019-01-23 15:54:00', 'sen-hmdt-reztr', 30),
(723, '2019-01-23 15:54:00', 'sen-temp-rerzac', 21),
(724, '2019-01-23 15:54:00', 'sma-airc-huihv', 30),
(725, '2019-01-23 15:54:00', 'sma-shtr-ueri', 30),
(729, '2019-01-23 15:55:00', 'sen-hmdt-reztr', 30),
(730, '2019-01-23 15:55:00', 'sen-temp-rerzac', 21),
(731, '2019-01-23 15:55:00', 'sma-airc-huihv', 30),
(732, '2019-01-23 15:55:00', 'sma-shtr-ueri', 30),
(736, '2019-01-23 15:56:00', 'sen-hmdt-reztr', 30),
(737, '2019-01-23 15:56:00', 'sen-temp-rerzac', 21),
(738, '2019-01-23 15:56:00', 'sma-airc-huihv', 30),
(739, '2019-01-23 15:56:00', 'sma-shtr-ueri', 30),
(743, '2019-01-23 15:57:00', 'sen-hmdt-reztr', 30),
(744, '2019-01-23 15:57:00', 'sen-temp-rerzac', 21),
(745, '2019-01-23 15:57:00', 'sma-airc-huihv', 30),
(746, '2019-01-23 15:57:00', 'sma-shtr-ueri', 30),
(750, '2019-01-23 15:58:00', 'sen-hmdt-reztr', 30),
(751, '2019-01-23 15:58:00', 'sen-temp-rerzac', 21),
(752, '2019-01-23 15:58:00', 'sma-airc-huihv', 30),
(753, '2019-01-23 15:58:00', 'sma-shtr-ueri', 30),
(757, '2019-01-23 15:59:00', 'sen-hmdt-reztr', 30),
(758, '2019-01-23 15:59:00', 'sen-temp-rerzac', 21),
(759, '2019-01-23 15:59:00', 'sma-airc-huihv', 30),
(760, '2019-01-23 15:59:00', 'sma-shtr-ueri', 30),
(764, '2019-01-23 16:00:00', 'sen-hmdt-reztr', 30),
(765, '2019-01-23 16:00:00', 'sen-temp-rerzac', 21),
(766, '2019-01-23 16:00:00', 'sma-airc-huihv', 30),
(767, '2019-01-23 16:00:00', 'sma-shtr-ueri', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_keys`
--
ALTER TABLE `password_reset_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `presets`
--
ALTER TABLE `presets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preset_values`
--
ALTER TABLE `preset_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `values_history`
--
ALTER TABLE `values_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_reset_keys`
--
ALTER TABLE `password_reset_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `presets`
--
ALTER TABLE `presets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `preset_values`
--
ALTER TABLE `preset_values`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `values_history`
--
ALTER TABLE `values_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=771;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_history` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-01-23 00:00:00' ENDS '2019-01-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO values_history(
    values_history.timestamp,
    values_history.serial_number,
    values_history.value
)
SELECT
    CURRENT_TIMESTAMP,
    components.serial_number,
    components.value
FROM
    components
WHERE
    (
        components.serial_number LIKE 'sma%' OR components.serial_number LIKE 'sen%'
    )$$

CREATE DEFINER=`root`@`localhost` EVENT `update_tasks` ON SCHEDULE EVERY 10 SECOND STARTS '2019-01-21 23:35:06' ENDS '2019-01-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE
        components AS c1
    INNER JOIN preset_values AS pv1
    ON
        pv1.serial_number = c1.serial_number
    INNER JOIN tasks AS t1
    ON
        t1.id_preset = pv1.id_preset
    SET
        c1.value = pv1.value,
        c1.state = pv1.on_off
    WHERE
        t1.start_date <= CURRENT_DATE AND t1.hour <= CURRENT_TIME AND t1.on_off=1;
        
    UPDATE
        tasks
    SET
        tasks.start_date = DATE_ADD(
            tasks.start_date,
            INTERVAL tasks.frequency SECOND
        )
    WHERE
        tasks.start_date <= CURRENT_DATE AND tasks.hour <= CURRENT_TIME AND tasks.on_off=1 ;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
