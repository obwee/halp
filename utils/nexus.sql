-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 01:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancellations`
--

CREATE TABLE `tbl_cancellations` (
  `id` int(11) NOT NULL,
  `trainingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `id` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseDescription` varchar(255) NOT NULL,
  `courseCode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `courseName`, `courseDescription`, `courseCode`, `status`) VALUES
(1, 'Cisco Certified Network Associate v4', 'Implementing and Administering Cisco Solutions', 'CCNAv4', 'Active'),
(2, 'Cisco Certified Network Professional', 'Enterprise Core', 'CCNP&CCIE', 'Active'),
(3, 'Cisco Certified Network Professional', 'Implementing Cisco Enterprise Advanced Routing and Services', 'CCNP ENARSI', 'Active'),
(4, 'MCP 20410D', 'Installing and Configuring Windows Server 2012', '20410D', 'Active'),
(5, 'MCSA in Windows Server 2016', 'Microsoft Certified Solutions Associate in Windows Server 2016', 'MCSA2016', 'Active'),
(6, 'MCSA in Windows Server 2012', 'Microsoft Certified Solutions Associate in Windows Server 2012', 'MCSA2012', 'Active'),
(7, 'Microsoft Azure Administrator', 'Implementing, Monitoring and Maintaining Azure Solutions', 'AZ-1003T00-A', 'Active'),
(8, 'AWS - Solutions Architect', 'Amazon Web Services Solutions Architect', 'AWS', 'Active'),
(9, 'VMware 6.7 ICM', 'Vmware vSphere 6.7: Install, Configure and Manage', 'VMware', 'Active'),
(10, 'Vmware Hyper-Converged Infrastructure', '', 'HCI', 'Active'),
(11, 'Ethical Hacking & Penetration Testing', '', 'EH', 'Active'),
(12, 'Certified Digital Forensics Examiner', '', 'CDFE', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emails`
--

CREATE TABLE `tbl_emails` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `dateSent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emails`
--

INSERT INTO `tbl_emails` (`id`, `firstName`, `middleName`, `lastName`, `email`, `title`, `message`, `dateSent`) VALUES
(29, 'asfmalkf', 'fjskljfkl', 'fjskalfjsakl', 'aubrey@gmail.com', 'sfajsfkl', 'fjkslfja<br />\r\ns', '2020-02-21 23:26:32'),
(30, 'asfmalkf', 'fjskljfkl', 'fjskalfjsakl', 'aubrey@gmail.com', 'sfajsfkl', 'fjkslfja<br />\r\ns', '2020-02-21 23:26:37'),
(31, 'asfmalkf', 'fjskljfkl', 'fjskalfjsakl', 'aubrey@gmail.com', 'sfajsfkl', 'fjkslfja<br />\r\ns', '2020-02-21 23:32:09'),
(32, 'asfmalkf', 'fjskljfkl', 'fjskalfjsakl', 'aubrey@gmail.com', 'sfajsfkl', 'fjkslfja<br />\r\ns', '2020-02-21 23:32:54'),
(33, 'fsafkajk', 'jfkslajfkalsj', 'kfjsakfjaskl', 'jfsklasjfkl@gmail.com', 'fjsakfjsak', 'jfklsajfklasjfklsafj<br />\r\n<br />\r\n2141421412', '2020-02-21 23:37:23'),
(34, 'Test First', 'Test Middle', 'Test Last', 'testEmail@email.com', 'Test Subject', 'Test message.', '2020-06-19 09:13:17'),
(35, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:44:59'),
(36, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:45:03'),
(37, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:45:08'),
(38, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:45:15'),
(39, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:45:51'),
(40, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:46:03'),
(41, 'Test', '', 'Test', 'test@gmail.com', 'Test Email', 'Test test test.', '2020-11-03 23:46:07'),
(42, 'Test', 'test', 'Test', 'test@gmail.com', 'Test Email', 'tetetetetetet etetetestetest', '2020-11-03 23:47:27'),
(43, 'Test', '', 'Test', 'angelikaaubreyarbiol@gmail.com', 'Test Email', 'Test dataaaaaaa.', '2020-11-04 18:45:54'),
(44, 'Test', '', 'Test', 'angelikaaubreyarbiol@gmail.com', 'Test Email', 'Test message.', '2020-11-04 19:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `studentId` int(11) DEFAULT 0,
  `courseId` int(11) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `hasAccount` tinyint(1) NOT NULL DEFAULT 1,
  `receiver` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0,
  `date` datetime NOT NULL,
  `hasOpenedByAdmin` int(11) NOT NULL DEFAULT 0,
  `hasOpenedByStudent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`id`, `studentId`, `courseId`, `scheduleId`, `type`, `hasAccount`, `receiver`, `status`, `date`, `hasOpenedByAdmin`, `hasOpenedByStudent`) VALUES
(1, 7, 1, 2, '0', 1, 'admin', 0, '2020-04-26 16:13:28', 1, 0),
(2, 7, 2, 3, '0', 1, 'admin', 1, '2020-04-27 21:59:54', 1, 0),
(15, 7, 1, 2, '3', 1, 'student', 0, '2020-04-29 20:56:45', 0, 1),
(16, 7, 2, 3, '4', 1, 'student', 0, '2020-04-29 21:55:53', 0, 1),
(17, 7, 1, 2, '2', 1, 'admin', 1, '2020-04-30 21:43:57', 1, 0),
(18, 7, 1, 2, '4', 1, 'student', 1, '2020-04-30 21:45:48', 0, 1),
(19, 7, 12, 42, '0', 1, 'admin', 1, '2020-04-30 21:58:00', 1, 0),
(20, 7, 12, 42, '1', 1, 'student', 1, '2020-04-30 21:58:17', 0, 1),
(21, 7, 1, 2, '5', 1, 'admin', 1, '2020-04-30 22:19:19', 1, 0),
(22, 7, 1, 2, '7', 1, 'student', 0, '2020-04-30 22:26:12', 0, 1),
(23, 7, 1, 2, '7', 1, 'student', 1, '2020-04-30 22:27:03', 0, 1),
(24, 7, 1, 2, '5', 1, 'admin', 1, '2020-04-30 22:27:30', 1, 0),
(25, 7, 1, 2, '6', 1, 'student', 1, '2020-04-30 22:27:38', 0, 1),
(26, 7, 0, 0, '8', 1, 'admin', 1, '2020-05-02 17:19:34', 1, 0),
(27, 7, 0, 0, '9', 1, 'student', 1, '2020-05-02 17:28:01', 0, 1),
(28, 7, 12, 42, '0', 1, 'admin', 0, '2020-05-02 21:41:56', 1, 0),
(29, 7, 12, 42, '2', 1, 'admin', 0, '2020-05-02 21:42:33', 1, 0),
(30, 7, 12, 42, '3', 1, 'student', 0, '2020-05-02 21:43:50', 0, 1),
(31, 26, 0, 0, '8', 1, 'admin', 0, '2020-05-02 21:48:11', 1, 0),
(32, 7, 12, 42, '2', 1, 'admin', 0, '2020-05-02 21:50:19', 1, 0),
(33, 7, 12, 42, '3', 1, 'student', 0, '2020-05-02 21:50:28', 0, 1),
(34, 108, 1, 2, '0', 1, 'admin', 1, '2020-05-03 14:32:54', 1, 0),
(35, 7, 12, 42, '2', 1, 'admin', 0, '2020-05-08 22:15:29', 1, 0),
(36, 7, 12, 42, '4', 1, 'student', 0, '2020-05-08 22:15:35', 0, 1),
(37, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 14:35:20', 1, 0),
(38, 7, 7, 32, '3', 1, 'student', 0, '2020-05-10 14:36:45', 0, 1),
(39, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 15:06:04', 1, 0),
(40, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 15:06:13', 1, 0),
(41, 7, 7, 32, '3', 1, 'student', 0, '2020-05-10 15:06:27', 0, 1),
(42, 7, 7, 32, '3', 1, 'student', 1, '2020-05-10 15:06:43', 0, 1),
(43, 7, 1, 2, '0', 1, 'admin', 0, '2020-05-11 20:41:18', 1, 0),
(44, 7, 1, 2, '2', 1, 'admin', 0, '2020-05-11 20:41:31', 1, 0),
(45, 7, 7, 32, '0', 1, 'admin', 0, '2020-05-16 18:24:11', 1, 0),
(46, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 18:46:21', 1, 0),
(47, 7, 12, 25, '0', 1, 'admin', 0, '2020-05-16 18:56:13', 1, 0),
(48, 7, 7, 32, '3', 1, 'student', 0, '2020-05-16 18:56:33', 0, 1),
(49, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 18:56:56', 1, 0),
(50, 7, 12, 25, '2', 1, 'admin', 0, '2020-05-16 19:02:05', 1, 0),
(51, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 19:02:55', 1, 0),
(52, 64, 7, 32, '0', 1, 'admin', 0, '2020-05-16 19:30:02', 1, 0),
(53, 64, 1, 2, '0', 1, 'admin', 0, '2020-05-16 19:30:35', 1, 0),
(54, 27, 0, 0, '8', 0, 'admin', 0, '2020-06-09 21:32:40', 1, 0),
(55, 28, 0, 0, '8', 0, 'admin', 1, '2020-06-13 18:56:08', 1, 0),
(56, 29, 0, 0, '8', 0, 'admin', 0, '2020-06-13 23:48:10', 1, 0),
(57, 1, 1, 46, '2', 1, 'admin', 0, '2020-06-19 09:17:37', 1, 0),
(58, 98, 1, 46, '3', 1, 'student', 0, '2020-06-19 09:17:54', 0, 0),
(59, 7, 0, 0, '8', 1, 'admin', 1, '2020-11-03 22:19:15', 1, 0),
(60, 113, 0, 0, '8', 1, 'admin', 0, '2020-11-03 22:26:59', 1, 0),
(61, 113, 0, 0, '9', 1, 'student', 0, '2020-11-03 22:27:09', 0, 0),
(62, 113, 0, 0, '8', 1, 'admin', 1, '2020-11-03 22:51:07', 1, 0),
(63, 113, 0, 0, '9', 1, 'student', 0, '2020-11-03 22:51:20', 0, 0),
(64, 30, 0, 0, '8', 0, 'admin', 1, '2020-11-03 22:59:48', 1, 0),
(65, 30, 0, 0, '9', 1, 'student', 0, '2020-11-03 23:00:24', 0, 0),
(66, 98, 0, 0, '9', 1, 'student', 0, '2020-11-03 23:01:35', 0, 0),
(67, 7, 1, 47, '0', 1, 'admin', 1, '2020-11-03 23:05:14', 1, 0),
(68, 113, 0, 0, '8', 1, 'admin', 0, '2020-11-03 23:14:32', 1, 0),
(69, 113, 0, 0, '9', 1, 'student', 0, '2020-11-03 23:14:43', 0, 0),
(70, 7, 1, 47, '2', 1, 'admin', 1, '2020-11-03 23:27:14', 1, 0),
(71, 7, 1, 47, '3', 1, 'student', 0, '2020-11-03 23:27:49', 0, 1),
(72, 118, 1, 47, '0', 1, 'admin', 0, '2020-11-03 23:57:54', 1, 0),
(73, 118, 1, 47, '2', 1, 'admin', 1, '2020-11-03 23:58:03', 1, 0),
(74, 118, 1, 47, '3', 1, 'student', 1, '2020-11-03 23:58:46', 0, 1),
(75, 1, 1, 47, '2', 1, 'admin', 0, '2020-11-04 17:53:51', 1, 0),
(76, 97, 1, 47, '3', 1, 'student', 0, '2020-11-04 17:54:11', 0, 0),
(77, 1, 6, 48, '2', 1, 'admin', 0, '2020-11-04 18:10:32', 1, 0),
(78, 92, 6, 48, '3', 1, 'student', 0, '2020-11-04 18:10:49', 0, 0),
(79, 1, 6, 48, '5', 1, 'admin', 1, '2020-11-04 18:18:03', 1, 0),
(80, 92, 6, 48, '6', 1, 'student', 0, '2020-11-04 18:18:39', 0, 0),
(81, 113, 0, 0, '8', 1, 'admin', 0, '2020-11-04 18:48:43', 1, 0),
(82, 113, 0, 0, '9', 1, 'student', 0, '2020-11-04 18:55:58', 0, 0),
(83, 31, 0, 0, '8', 0, 'admin', 0, '2020-11-04 18:57:59', 1, 0),
(84, 31, 0, 0, '9', 1, 'student', 0, '2020-11-04 18:58:14', 0, 0),
(85, 7, 1, 47, '0', 1, 'admin', 1, '2020-11-04 19:06:21', 1, 0),
(86, 7, 8, 49, '5', 1, 'admin', 1, '2020-11-04 19:06:37', 1, 0),
(87, 7, 0, 0, '8', 1, 'admin', 1, '2020-11-04 19:06:52', 1, 0),
(88, 7, 1, 47, '2', 1, 'admin', 1, '2020-11-04 19:11:14', 1, 0),
(89, 7, 1, 47, '3', 1, 'student', 1, '2020-11-04 19:11:52', 0, 1),
(90, 7, 8, 49, '6', 1, 'student', 0, '2020-11-04 19:13:46', 0, 1),
(91, 1, 1, 47, '5', 1, 'admin', 0, '2020-11-04 19:28:56', 1, 0),
(92, 7, 1, 47, '6', 1, 'student', 0, '2020-11-04 19:29:34', 0, 1),
(93, 1, 1, 47, '5', 1, 'admin', 0, '2020-11-04 19:41:01', 1, 0),
(94, 97, 1, 47, '6', 1, 'student', 0, '2020-11-04 19:42:11', 0, 0),
(95, 7, 1, 47, '0', 1, 'admin', 0, '2020-11-04 22:00:21', 1, 0),
(96, 7, 1, 47, '2', 1, 'admin', 1, '2020-11-04 22:00:34', 1, 0),
(97, 7, 1, 47, '3', 1, 'student', 0, '2020-11-04 22:01:13', 0, 1),
(98, 119, 0, 0, '8', 1, 'admin', 1, '2020-11-04 22:04:06', 1, 0),
(99, 119, 0, 0, '9', 1, 'student', 1, '2020-11-04 22:04:37', 0, 1),
(100, 119, 1, 47, '0', 1, 'admin', 0, '2020-11-04 22:07:45', 1, 0),
(101, 119, 1, 47, '2', 1, 'admin', 1, '2020-11-04 22:13:57', 1, 0),
(102, 119, 1, 47, '3', 1, 'student', 1, '2020-11-04 22:15:05', 0, 1),
(103, 119, 1, 47, '2', 1, 'admin', 1, '2020-11-04 22:16:08', 1, 0),
(104, 119, 1, 47, '4', 1, 'student', 0, '2020-11-04 22:16:56', 0, 1),
(105, 119, 1, 47, '2', 1, 'admin', 1, '2020-11-04 22:18:31', 1, 0),
(106, 119, 1, 47, '3', 1, 'student', 0, '2020-11-04 22:19:13', 0, 1),
(107, 118, 6, 48, '0', 1, 'admin', 0, '2020-11-04 22:42:28', 1, 0),
(108, 118, 8, 49, '0', 1, 'admin', 0, '2020-11-04 22:43:39', 1, 0),
(109, 118, 6, 48, '0', 1, 'admin', 0, '2020-11-04 22:44:08', 1, 0),
(110, 118, 8, 49, '0', 1, 'admin', 0, '2020-11-05 21:24:40', 1, 0),
(111, 118, 8, 49, '0', 1, 'admin', 0, '2020-11-05 21:58:46', 1, 0),
(112, 118, 8, 49, '1', 1, 'student', 0, '2020-11-05 21:58:52', 0, 1),
(113, 118, 8, 49, '0', 1, 'admin', 0, '2020-11-05 21:59:13', 1, 0),
(114, 118, 8, 49, '1', 1, 'student', 0, '2020-11-05 22:00:26', 0, 1),
(115, 7, 12, 25, '1', 1, 'student', 0, '2020-11-05 22:00:53', 0, 1),
(116, 7, 12, 25, '1', 1, 'student', 0, '2020-11-05 22:00:57', 0, 1),
(117, 7, 12, 25, '1', 1, 'student', 0, '2020-11-05 22:01:11', 0, 1),
(118, 118, 1, 47, '0', 1, 'admin', 0, '2020-11-08 16:20:04', 1, 0),
(119, 98, 8, 49, '1', 1, 'student', 0, '2020-11-08 16:52:12', 0, 0),
(120, 59, 1, 47, '1', 1, 'student', 0, '2020-11-08 16:57:21', 0, 0),
(121, 118, 6, 48, '0', 1, 'admin', 0, '2020-11-08 16:57:57', 1, 0),
(122, 118, 6, 48, '1', 1, 'student', 0, '2020-11-08 16:58:18', 0, 0),
(123, 7, 0, 0, '8', 1, 'admin', 0, '2020-11-08 19:13:14', 1, 0),
(124, 7, 0, 0, '8', 1, 'admin', 1, '2020-11-08 19:14:10', 1, 0),
(125, 7, 0, 0, '8', 1, 'admin', 0, '2020-11-08 19:14:39', 1, 0),
(126, 7, 0, 0, '9', 1, 'student', 0, '2020-11-08 19:15:00', 0, 0),
(127, 7, 0, 0, '9', 1, 'student', 0, '2020-11-08 19:24:53', 0, 0),
(128, 7, 11, 50, '0', 1, 'admin', 0, '2020-11-08 20:42:22', 1, 0),
(129, 7, 11, 50, '2', 1, 'admin', 1, '2020-11-08 20:45:48', 1, 0),
(130, 7, 11, 50, '3', 1, 'student', 0, '2020-11-08 20:49:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `trainingId` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `paymentAmount` int(11) DEFAULT 0,
  `paymentFile` varchar(255) NOT NULL,
  `isApproved` varchar(255) NOT NULL DEFAULT '0',
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` varchar(255) DEFAULT 'Payment',
  `rejectReason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE `tbl_payment_methods` (
  `id` int(11) NOT NULL,
  `methodName` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_methods`
--

INSERT INTO `tbl_payment_methods` (`id`, `methodName`, `status`) VALUES
(1, 'Change', 'Active'),
(2, 'BDO', 'Active'),
(3, 'Cash', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_details`
--

CREATE TABLE `tbl_quotation_details` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `senderId` int(11) NOT NULL DEFAULT 0,
  `courseId` varchar(255) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `numPax` int(11) NOT NULL,
  `dateRequested` datetime NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `isCompanySponsored` tinyint(1) NOT NULL DEFAULT 0,
  `isQuotationSent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation_details`
--

INSERT INTO `tbl_quotation_details` (`id`, `userId`, `senderId`, `courseId`, `scheduleId`, `numPax`, `dateRequested`, `companyName`, `isCompanySponsored`, `isQuotationSent`) VALUES
(48, 0, 17, '1', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(49, 0, 17, '3', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(50, 0, 17, '2', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(68, 98, 0, '4', 5, 21, '2020-03-01 16:29:52', '', 0, 1),
(83, 0, 28, '1', 46, 2, '2020-06-13 18:51:14', 'test company', 1, 1),
(84, 0, 28, '1', 46, 2, '2020-06-13 18:56:08', 'test company', 1, 1),
(87, 113, 17, '1', 47, 1, '2020-11-03 22:26:59', 'Nexus Inc.', 0, 1),
(88, 113, 17, '1', 47, 1, '2020-11-03 22:51:07', 'Nexus Inc.', 0, 1),
(89, 0, 30, '1', 47, 1, '2020-11-03 22:59:47', '', 0, 1),
(90, 113, 17, '1', 47, 1, '2020-11-03 23:14:32', 'Nexus Inc.', 0, 1),
(91, 113, 17, '8', 49, 1, '2020-11-04 18:48:43', 'Nexus Inc.', 1, 1),
(92, 113, 17, '1', 47, 3, '2020-11-04 18:48:43', 'Nexus Inc.', 1, 1),
(93, 0, 31, '8', 49, 1, '2020-11-04 18:57:59', 'Test Company', 1, 1),
(94, 0, 31, '1', 0, 1, '2020-11-04 18:57:59', 'Test Company', 1, 1),
(95, 0, 31, '6', 48, 1, '2020-11-04 18:57:59', 'Test Company', 1, 1),
(98, 119, 0, '1', 47, 1, '2020-11-04 22:04:06', 'Nexus Inc.', 1, 1),
(103, 7, 0, '8', 49, 1, '2020-11-08 19:14:09', 'Concentrix', 1, 1),
(104, 7, 0, '6', 48, 1, '2020-11-08 19:14:39', 'Nexus Inc.', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_senders`
--

CREATE TABLE `tbl_quotation_senders` (
  `quoteSenderId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation_senders`
--

INSERT INTO `tbl_quotation_senders` (`quoteSenderId`, `firstName`, `middleName`, `lastName`, `email`, `contactNum`) VALUES
(17, 'Angelika Aubrey', 'Albano', 'Arbiol', 'angelikaaubreyarbiol@gmail.com', '412444214'),
(28, 'Test Quote', 'Test Quote', 'Test Quote', 'testQuote@gmail.com', '09151234567'),
(30, 'Angelika Aubrey', '', 'test', 'angelikaaubreyarbiol@gmail.com', '554545454545'),
(31, 'Angelica', '', 'Blances', 'blances_a@yahoo.com', '092121212121');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_refunds`
--

CREATE TABLE `tbl_refunds` (
  `id` int(11) NOT NULL,
  `trainingId` int(11) NOT NULL,
  `refundReason` varchar(255) NOT NULL,
  `dateRequested` datetime NOT NULL,
  `isApproved` int(11) DEFAULT 0,
  `executor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_refunds`
--

INSERT INTO `tbl_refunds` (`id`, `trainingId`, `refundReason`, `dateRequested`, `isApproved`, `executor`) VALUES
(15, 47, 'Test refund for MCSA2012.', '2020-11-04 18:18:03', 1, 'Christopher Buenaventura'),
(16, 44, 'Test refund from student.', '2020-11-04 19:06:37', 1, 'Christopher Buenaventura'),
(17, 48, 'Test refund from admin.', '2020-11-04 19:28:56', 1, 'Christopher Buenaventura'),
(18, 46, 'Test refund #2 from admin.', '2020-11-04 19:41:01', 1, 'Christopher Buenaventura');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `id` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `coursePrice` varchar(255) NOT NULL,
  `instructorId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `numSlots` int(11) NOT NULL,
  `remainingSlots` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `recurrence` varchar(255) DEFAULT 'none',
  `numRepetitions` varchar(255) NOT NULL DEFAULT '1',
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`id`, `courseId`, `coursePrice`, `instructorId`, `venueId`, `numSlots`, `remainingSlots`, `fromDate`, `toDate`, `recurrence`, `numRepetitions`, `status`) VALUES
(48, 6, '8000', 111, 2, 15, 15, '2020-11-14', '2020-11-28', 'weekly', '3', 'Active'),
(49, 8, '3000', 109, 2, 12, 12, '2020-11-14', '2020-11-28', 'weekly', '3', 'Active'),
(50, 11, '3000', 125, 4, 15, 14, '2020-11-20', '2020-11-22', 'none', '1', 'Active'),
(51, 1, '10000', 124, 2, 18, 18, '2020-11-16', '2020-11-20', 'none', '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sent_quotations`
--

CREATE TABLE `tbl_sent_quotations` (
  `invoiceNum` int(11) NOT NULL,
  `quotationId` int(11) NOT NULL,
  `dateSent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `isReserved` int(11) NOT NULL DEFAULT 0,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `certificateIssued` tinyint(1) NOT NULL DEFAULT 0,
  `isCancelled` int(11) NOT NULL DEFAULT 0,
  `cancellationReason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `certificationTitle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `username`, `password`, `firstName`, `middleName`, `lastName`, `position`, `companyName`, `contactNum`, `email`, `status`, `certificationTitle`) VALUES
(1, 'chris', 'e4c2da91f2feb68f1685320f467f989cbc1fdc31c31334ccc3fa38e3be555c9102fb324b32faf76e849536c2da3b8149b03af56c2bc39efe3a9f02653bbf7de6', 'Christopher', 'Iglesia', 'Buenaventura', 'Super Admin', '', '12345678901', 'kdoz@live.com', 'Active', ''),
(7, 'markus', '2a888860d7da3c94a58f720b5df868dac76dff618b7fc0b1f9502032bc5a0182731c892ee327e9e60d08025673935097a09c09cfb1e2ff8356268949276b4764', 'Mark Exequiel', 'Reambillo', 'Sale', 'Student', 'Concentrix', '516874621345', 'markexequielsale@gmail.com', 'Active', ''),
(122, 'aubrey', '3d754f754786175c261157efc4433deb4d3eb4bcdb56b62714cc53845a6a73caebd03db04b9cf76e61da7448421d42c848841a6db64ab3422b5610a0005ea141', 'Angelika Aubrey', 'Albano', 'Arbiol', 'Admin', '', '09261759759', 'angelikaaubreyarbiol@gmail.com', 'Active', ''),
(123, 'ryan', 'bc16e02108eacb827088ef161f872cfd72d8d54679ec6b835f1f44c4c23190560e5e55517d936140fd8146cccaef27251cf22fbdcd769f99f48588453729a134', 'Ryan James', 'Martinez', 'Velasquez', 'Admin', '', '23245365476', 'kdoz@live.com', 'Active', ''),
(124, '', '', 'Christopher', 'Iglesia', 'Buenaventura', 'Instructor', '', '12345678901', 'kdoz@live.com', 'Active', 'CCNA, MCP, MCSA'),
(125, '', '', 'Richard', '', 'Reblando', 'Instructor', '', '12564758675', 'test1@gmail.com', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactNum` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `venue`, `address`, `contactNum`, `status`) VALUES
(1, 'Manila', 'Room 401 Dona Amparo Bldg., Espana Blvd., Manila', '+63 2 8355-7759', 'Active'),
(2, 'Makati', 'Unit 2417, 24th Floor Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City', '+63 2 8362-3755', 'Active'),
(4, 'Ortigas', '1611 AIC Burgundy Empire Tower, ADB Ave, Ortigas Center, Pasig City', '+63 2 8584-1881', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cancellations`
--
ALTER TABLE `tbl_cancellations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation_senders`
--
ALTER TABLE `tbl_quotation_senders`
  ADD PRIMARY KEY (`quoteSenderId`);

--
-- Indexes for table `tbl_refunds`
--
ALTER TABLE `tbl_refunds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sent_quotations`
--
ALTER TABLE `tbl_sent_quotations`
  ADD PRIMARY KEY (`invoiceNum`);

--
-- Indexes for table `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cancellations`
--
ALTER TABLE `tbl_cancellations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tbl_quotation_senders`
--
ALTER TABLE `tbl_quotation_senders`
  MODIFY `quoteSenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_refunds`
--
ALTER TABLE `tbl_refunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_sent_quotations`
--
ALTER TABLE `tbl_sent_quotations`
  MODIFY `invoiceNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
