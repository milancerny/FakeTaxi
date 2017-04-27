-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2017 at 04:01 PM
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
(1, 'Testovaci task pre id 4', 'Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už\r\n                    od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak\r\n', '2017-04-30', 1, 1, '2017-04-21 15:29:21', '2017-04-27 00:00:00', 0, 0, 4),
(2, 'TESTIK PRE DVA ', 'TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK TESTIK', '2017-04-26', 1, 1, '2017-04-21 22:21:52', '2017-04-27 00:00:00', 0, 0, 4),
(3, 'Test Create', 'testujem vytvorenie po prve', '2017-04-30', 1, 1, '2017-04-26 00:37:55', '2017-04-27 00:00:00', 0, 0, 4),
(4, 'Test Redirect', 'TEST REDIRECT', '2017-05-12', 1, 1, '2017-04-26 00:44:20', '2017-04-26 00:00:00', 0, 1, 2),
(5, 'Tasky Na Zajtra', '- pri create task due date calendar\r\n- vylistovanie vsetkych taskov nahradit ciselnu hodnotu ikonou\r\n- premyslet ci chcem pri tasku obrazok\r\n- dokoncit update / delete tasku', '2017-04-26', 2, 1, '2017-04-26 00:59:04', '2017-04-26 00:00:00', 0, 0, 4),
(6, 'Testovanie S Datepickerom', 'testujem veselo o sto sest', '2017-04-30', 1, 1, '2017-04-26 10:32:31', '2017-04-26 10:32:31', 0, 0, 4),
(7, '<b>test Xss</b>', 'testujeme <b>XSS</b>', '2017-05-01', 1, 1, '2017-04-26 11:09:00', '2017-04-26 00:00:00', 0, 0, 4),
(8, '<b>xss</b>', 'dadasas', '2017-04-27', 1, 1, '2017-04-26 11:27:29', '2017-04-26 00:00:00', 0, 0, 4),
(9, '<b>xss</b>', 'XSS LOOOOL', '2017-05-02', 1, 1, '2017-04-26 11:28:34', '2017-04-26 11:28:34', 0, 0, 4),
(10, '<b><i>loool</i></b>', '[removed]alert&#40;"AHOOOOJ"&#41;[removed]', '2017-04-26', 1, 1, '2017-04-26 11:30:39', '2017-04-26 11:30:39', 0, 0, 4),
(11, 'Task', 'task', '2017-04-28', 1, 1, '2017-04-26 13:57:12', '2017-04-27 00:00:00', 0, 0, 4);

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
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@codeinsect.com', '$2y$10$WQQRBQDkxV/98bqK.24Dp.uMVS6KcztVqdwwTrOBLIWLSeSqE2gii', 'Milanko Cerny', '9890098900', 1, 0, 0, '2015-07-01 00:00:00', 1, '2017-03-03 00:00:00'),
(2, 'manager@codeinsect.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', '9890098900', 2, 0, 1, '2016-12-09 00:00:00', 1, '2017-04-11 00:00:00'),
(3, 'employee@codeinsect.com', '$2y$10$M3ttjnzOV2lZSigBtP0NxuCtKRte70nc8TY5vIczYAQvfG/8syRze', 'Employee', '9890098900', 3, 0, 1, '2016-12-09 00:00:00', NULL, NULL),
(4, 'milan@me.sk', '$2y$10$TDNDq3cvmyD3dewjpzmsjuAOrb9Yq7MmnCyWvE4vSuFFls4CI3eHm', 'Milan Cerny', '0904011975', 3, 0, 1, '2017-04-11 00:00:00', 1, '2017-04-11 00:00:00'),
(5, 'TESTOVACI@xx.com', '$2y$10$1xKCQ0WZ3P0Yd86lfl.2zuJXUYa7hqZr9ojsF1uiiYkqkLc5f.AeC', 'Testovac', '0902113609', 2, 1, 1, '2017-04-26 00:00:00', 1, '2017-04-26 00:00:00');

--
-- Indexes for dumped tables
--

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
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
