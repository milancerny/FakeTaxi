-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 03:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_detail`
--

CREATE TABLE `tbl_car_detail` (
  `id` int(11) NOT NULL,
  `createdDate` date DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `updatedDate` date DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `ECV` varchar(10) CHARACTER SET utf8 NOT NULL,
  `VIN` varchar(17) CHARACTER SET utf8 NOT NULL,
  `totalCountKm` int(11) NOT NULL,
  `driverId` int(11) NOT NULL DEFAULT '0',
  `createdByUserId` int(11) NOT NULL,
  `updatedByUserId` int(11) NOT NULL,
  `color` varchar(45) CHARACTER SET utf8 NOT NULL,
  `carSubTypeId` int(11) NOT NULL,
  `carSubId` int(11) NOT NULL COMMENT 'sub category id',
  `isDeleted` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tbl_car_detail`
--

INSERT INTO `tbl_car_detail` (`id`, `createdDate`, `createdBy`, `updatedDate`, `updatedBy`, `ECV`, `VIN`, `totalCountKm`, `driverId`, `createdByUserId`, `updatedByUserId`, `color`, `carSubTypeId`, `carSubId`, `isDeleted`) VALUES
(1, '2017-05-18', 1, NULL, NULL, 'HC-755BZ', '2C4RC1CG6DR632915', 150000, 2, 0, 0, 'dark red', 3, 1, 0),
(2, '2017-05-19', 1, NULL, NULL, 'HC-555LV', 'JF2SHCBCXDH460561', 15000, 3, 0, 0, 'gold', 1, 5, 0),
(3, '2017-05-22', 1, NULL, NULL, 'HC-666BA', '1FTPF12525NB60466', 85320, 3, 0, 0, 'green', 3, 6, 0),
(4, '2017-05-22', 1, '2017-05-22', 1, 'BA-456LC', 'RFBS4K1917B257370', 65981, 3, 0, 0, 'dark blue', 1, 5, 0),
(5, '2017-05-22', 1, '2017-05-22', 1, 'KE-689CV', '1HGCG31092A886620', 66985, 4, 0, 0, 'light green', 3, 1, 0),
(6, '2017-05-22', 1, '2017-05-22', 1, 'TT-456FF', '1GTHK34R9XR568924', 66666, 4, 0, 0, 'dark red', 1, 5, 0),
(7, '2017-05-22', 1, NULL, NULL, 'TN-369HC', '1GNDV33W48D253516', 99656, 3, 0, 0, 'white', 1, 5, 0),
(8, '2017-05-22', 1, NULL, NULL, 'ZA-557XY', '1G6YV34A245699295', 78523, 9, 0, 0, 'black', 3, 6, 0),
(9, '2017-05-22', 1, NULL, NULL, 'NR-798YZ', '4T1BG22K4XUA44793', 6983, 0, 0, 0, 'white', 4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_repair`
--

CREATE TABLE `tbl_car_repair` (
  `id` int(11) NOT NULL,
  `totalCountRepair` int(11) NOT NULL,
  `discarded` int(11) NOT NULL DEFAULT '0',
  `nextTour` date DEFAULT NULL,
  `lastTour` date NOT NULL,
  `carDetailId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_sub_type`
--

CREATE TABLE `tbl_car_sub_type` (
  `id` int(11) NOT NULL,
  `subType` varchar(255) CHARACTER SET utf8 NOT NULL,
  `carTypeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tbl_car_sub_type`
--

INSERT INTO `tbl_car_sub_type` (`id`, `subType`, `carTypeId`) VALUES
(1, 'Octávia', 3),
(2, 'Fábia', 3),
(3, 'Astra', 4),
(4, 'A4', 2),
(5, '530i Sedan', 1),
(6, 'Felícia', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_type`
--

CREATE TABLE `tbl_car_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tbl_car_type`
--

INSERT INTO `tbl_car_type` (`id`, `type`) VALUES
(1, 'BMW'),
(2, 'Audi'),
(3, 'Škoda'),
(4, 'Opel'),
(5, 'Mercedes'),
(6, 'Suzuki');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reset_password`
--

INSERT INTO `tbl_reset_password` (`id`, `email`, `activation_id`, `agent`, `client_ip`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(22, 'milan@me.sk', 'GjKm88jEgQZJVPB', 'Chrome 54.0.2840.90', '0.0.0.0', 0, 1, '2017-04-19 10:11:49', NULL, NULL),
(23, 'milan@me.sk', 'AoaN19kfyhfMVEw', 'Chrome 54.0.2840.90', '0.0.0.0', 0, 1, '2017-04-19 10:12:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `taskId` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dueDate` date NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` int(4) NOT NULL DEFAULT '0',
  `isCompleted` int(4) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`taskId`, `subject`, `description`, `dueDate`, `createdBy`, `updatedBy`, `createdDate`, `updatedDate`, `isDeleted`, `isCompleted`, `userId`) VALUES
(1, 'Testovaci task pre id 4', 'Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už\n                    od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak\n', '2017-04-30', 1, 1, '2017-04-21 15:29:21', '2017-04-27 00:00:00', 0, 1, 1),
(2, 'Testik Pre Dva 222', 'TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK', '2017-04-26', 1, 1, '2017-04-21 22:21:52', '2017-04-27 00:00:00', 0, 1, 1),
(3, 'Test Create', 'testujem vytvorenie po prve', '2017-04-30', 1, 1, '2017-04-26 00:37:55', '2017-04-27 00:00:00', 0, 0, 4),
(4, 'Test Redirect 21', 'TEST REDIRECT', '2017-05-12', 1, 1, '2017-04-26 00:44:20', '2017-04-26 00:00:00', 0, 1, 2),
(5, 'Tasky Na Zajtra', '- pri create task due date calendar\r\n- vylistovanie vsetkych taskov nahradit ciselnu hodnotu ikonou\r\n- premyslet ci chcem pri tasku obrazok\r\n- dokoncit update / delete tasku', '2017-04-26', 2, 1, '2017-04-26 00:59:04', '2017-04-26 00:00:00', 0, 0, 4),
(6, 'Testovanie S Datepickerom', 'testujem veselo o sto sest', '2017-04-30', 1, 1, '2017-04-26 10:32:31', '2017-04-26 10:32:31', 0, 0, 2),
(7, '<b>test Xss</b>', 'testujeme <b>XSS</b>', '2017-05-01', 1, 1, '2017-04-26 11:09:00', '2017-04-26 00:00:00', 0, 0, 2),
(8, '<b>xss</b>', 'dadasas', '2017-04-27', 1, 1, '2017-04-26 11:27:29', '2017-04-26 00:00:00', 0, 1, 4),
(9, '<b>xss</b>', 'XSS LOOOOL', '2017-05-02', 1, 1, '2017-04-26 11:28:34', '2017-04-26 11:28:34', 0, 1, 4),
(10, '<b><i>loool</i></b>', '[removed]alert&#40;"AHOOOOJ"&#41;[removed]', '2017-04-26', 1, 1, '2017-04-26 11:30:39', '2017-04-26 11:30:39', 0, 0, 4),
(11, 'Task', 'Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už\n                    od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak', '2017-04-28', 1, 1, '2017-04-26 13:57:12', '2017-04-27 00:00:00', 0, 1, 1),
(12, 'Test Redirect 2', 'testujeme hide title panu', '2017-05-31', 1, 1, '2017-05-05 13:18:22', '2017-05-05 13:18:22', 0, 0, 7),
(13, 'Test Delay', 'test delay na title pane', '2017-05-31', 2, 2, '2017-05-05 13:22:05', '2017-05-05 13:22:05', 0, 0, 3),
(14, 'Subject', 'ssss', '2017-05-31', 2, 2, '2017-05-06 08:36:57', '2017-05-06 08:36:57', 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `superior` int(11) DEFAULT NULL COMMENT 'nadriaddeny'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`, `superior`) VALUES
(1, 'admin@codeinsect.com', '$2y$10$WQQRBQDkxV/98bqK.24Dp.uMVS6KcztVqdwwTrOBLIWLSeSqE2gii', 'Milanko Cerny', '9890098900', 1, 0, 0, '2015-07-01 00:00:00', 1, '2017-03-03 00:00:00', NULL),
(2, 'manager@codeinsect.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Ali ', '9890098900', 2, 0, 1, '2016-12-09 00:00:00', 1, '2017-04-11 00:00:00', 1),
(3, 'employee@codeinsect.com', '$2y$10$M3ttjnzOV2lZSigBtP0NxuCtKRte70nc8TY5vIczYAQvfG/8syRze', 'Janko Zamestnanec', '9890098900', 3, 0, 1, '2016-12-09 00:00:00', 1, '2017-04-11 00:00:00', 2),
(4, 'ferko@me.sk', '$2y$10$TDNDq3cvmyD3dewjpzmsjuAOrb9Yq7MmnCyWvE4vSuFFls4CI3eHm', 'Ferko Zamestnanec', '0904011975', 3, 0, 1, '2017-04-11 00:00:00', 1, '2017-04-11 00:00:00', 2),
(7, 'janpaz@me.sk', '$2y$10$SNMvvtRCs.2blVXioX2MAegMRxr7MBn.mhxJ98Dq6LnZAEN0V4Qla', 'Jan Pazitny', '0902113656', 2, 0, 1, '2017-05-05 00:00:00', NULL, NULL, 1),
(6, 'iky@me.sk', '$2y$10$Sh0MY.sC2bxpWsJrvKmA7OcaRbrjC2B/0/I5wYgRqzM/bJi/TfgdK', 'Iky Ujlaky', '0902113609', 2, 0, 1, '2017-05-05 07:37:22', NULL, NULL, 1),
(9, 'mladucky@me.sk', '$2y$10$TeC/LVYT2mM54BlmyP0UTeni7.6giLd4QzKyPmyEWNAL2ED2UVo/e', 'Jan Mladucky', '0902113699', 3, 0, 1, '2017-05-05 00:00:00', NULL, NULL, 7),
(10, 'mirka@me.sk', '$2y$10$p.6/bMa8/DpI/D5bukdO7uXI57bw94rwrqyRvcOV5pPO4h9NBfjdW', 'Mirka Cerna', '0902113677', 2, 0, 1, '2017-05-05 00:00:00', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_car_detail`
--
ALTER TABLE `tbl_car_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_car_repair`
--
ALTER TABLE `tbl_car_repair`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carDetailId` (`carDetailId`);

--
-- Indexes for table `tbl_car_sub_type`
--
ALTER TABLE `tbl_car_sub_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_car_type`
--
ALTER TABLE `tbl_car_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`taskId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_car_detail`
--
ALTER TABLE `tbl_car_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_car_repair`
--
ALTER TABLE `tbl_car_repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_car_sub_type`
--
ALTER TABLE `tbl_car_sub_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_car_type`
--
ALTER TABLE `tbl_car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
