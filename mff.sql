-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 02:23 PM
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
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_room` int(11) NOT NULL,
  `value` float NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`name`, `serial_number`, `id_room`, `value`, `state`) VALUES
('Humidité', 'sen-hmdt-reztr', 1, 30, 0),
('Détecteur de fumée', 'sen-smok-ughbuf', 1, 0, 1),
('Thermomètre', 'sen-temp-rerzac', 2, 21, 1),
('A/C', 'sma-airc-huihv', 1, 15, 1),
('Veilleuse', 'sma-lght-mmmm', 1, 0, 1),
('Volet', 'sma-shtr-ueri', 3, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `address`, `city`, `country`, `zip_code`) VALUES
(1, '7 allée du Basilic', 'Saint Germain-lès-Corbeil', 'France', '91250'),
(2, '666 rue des crapauds mÃ©talleux', 'Clisson', 'France', '44190'),
(3, '45 rue des bons raisins', 'Prais', 'france', '75998');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_keys`
--

CREATE TABLE `password_reset_keys` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hashed_key` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `presets`
--

INSERT INTO `presets` (`id`, `id_home`, `name`) VALUES
(2, 1, 'holidays'),
(3, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `preset_values`
--

CREATE TABLE `preset_values` (
  `id` int(50) NOT NULL,
  `id_preset` int(11) NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `on_off` bit(1) NOT NULL,
  `value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `preset_values`
--

INSERT INTO `preset_values` (`id`, `id_preset`, `serial_number`, `on_off`, `value`) VALUES
(2, 2, 'sma-airc-huihv', b'1', 14),
(3, 2, 'sen-temp-rerzac', b'1', 21),
(4, 3, 'sen-smok-ughbuf', b'1', NULL),
(5, 3, 'sma-lght-mmmm', b'1', NULL),
(6, 3, 'sen-hmdt-reztr', b'0', 30),
(7, 3, 'sen-temp-rerzac', b'0', 21),
(8, 3, 'sma-airc-huihv', b'1', 25);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `id_home` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `id_home`, `name`) VALUES
(1, 1, 'Antichambre'),
(2, 1, 'Salon'),
(3, 1, 'La Couuuisine'),
(4, 1, 'Gaming room');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `id_preset` int(11) NOT NULL,
  `on_off` bit(1) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `start_date` date NOT NULL,
  `hour` time NOT NULL,
  `frequency` enum('daily','weekly','monthly','single use') COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('administrator','house_manager','house_member') COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_home` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `birthdate`, `phone`, `password`, `id_home`) VALUES
(1, 'administrator', 'Matthieu', 'LORMEAU', 'matthieulormeau@gmail.com', '1997-01-15', '0685910051', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', NULL),
(2, 'administrator', 'Julie', 'Adalian', 'julie.adalian@isep.fr', '1997-03-01', '+33634601799', 'jesappelleroot', NULL),
(3, 'administrator', 'COMTE', 'Florian', 'comte.florian@gmail.com', '1997-09-27', '', 'koukou', NULL),
(4, 'administrator', 'strap', 'on', 'ilikestrapon@strapon.com', '2018-10-02', '', 'heyheyhey', NULL),
(5, 'house_member', 'house', 'member', 'house.member@test.com', '2018-11-27', '0687489685', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', 1),
(7, 'house_manager', 'Jean-Michel', 'Crapaud', 'jean-michel@crapaud.com', '2018-11-28', '0666666666', '$2y$10$3UYpHWC.MbdfMVQH.zNis.xI0./N1ZYT/F/1vE2cKXJeFOLQQiTIa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `access_level` enum('none','read','write') COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_reset_keys`
--
ALTER TABLE `password_reset_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `presets`
--
ALTER TABLE `presets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `preset_values`
--
ALTER TABLE `preset_values`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `values_history`
--
ALTER TABLE `values_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
