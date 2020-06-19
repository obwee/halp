-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 05:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

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
CREATE DATABASE IF NOT EXISTS `nexus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nexus`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancellations`
--

CREATE TABLE `tbl_cancellations` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `isApproved` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) NOT NULL
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
(4, 'MCP 20410D', 'Installing and Configuring Windows Server 2012', '20410D', 'Inactive'),
(5, 'MCSA in Windows Server 2016', 'Microsoft Certified Solutions Associate in Windows Server 2016', 'MCSA2016', 'Active'),
(6, 'MCSA in Windows Server 2012', 'Microsoft Certified Solutions Associate in Windows Server 2012', 'MCSA2012', 'Active'),
(7, 'Microsoft Azure Administrator', 'Implementing, Monitoring and Maintaining Azure Solutions', 'AZ-1003T00-A', 'Active'),
(8, 'AWS - Solutions Architect', 'Amazon Web Services Solutions Architect', 'AWS', 'Inactive'),
(9, 'VMware 6.7 ICM', 'Vmware vSphere 6.7: Install, Configure and Manage', 'VMware', 'Active'),
(10, 'Vmware Hyper-Converged Infrastructure', '', 'HCI', 'Active'),
(11, 'Ethical Hacking & Penetration Testing', '', 'EH', 'Inactive'),
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
(33, 'fsafkajk', 'jfkslajfkalsj', 'kfjsakfjaskl', 'jfsklasjfkl@gmail.com', 'fjsakfjsak', 'jfklsajfklasjfklsafj<br />\r\n<br />\r\n2141421412', '2020-02-21 23:37:23');

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
(30, 7, 12, 42, '3', 1, 'student', 0, '2020-05-02 21:43:50', 0, 0),
(31, 26, 0, 0, '8', 1, 'admin', 0, '2020-05-02 21:48:11', 1, 0),
(32, 7, 12, 42, '2', 1, 'admin', 0, '2020-05-02 21:50:19', 1, 0),
(33, 7, 12, 42, '3', 1, 'student', 0, '2020-05-02 21:50:28', 0, 0),
(34, 108, 1, 2, '0', 1, 'admin', 1, '2020-05-03 14:32:54', 1, 0),
(35, 7, 12, 42, '2', 1, 'admin', 0, '2020-05-08 22:15:29', 1, 0),
(36, 7, 12, 42, '4', 1, 'student', 0, '2020-05-08 22:15:35', 0, 0),
(37, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 14:35:20', 1, 0),
(38, 7, 7, 32, '3', 1, 'student', 0, '2020-05-10 14:36:45', 0, 0),
(39, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 15:06:04', 1, 0),
(40, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-10 15:06:13', 1, 0),
(41, 7, 7, 32, '3', 1, 'student', 0, '2020-05-10 15:06:27', 0, 0),
(42, 7, 7, 32, '3', 1, 'student', 0, '2020-05-10 15:06:43', 0, 0),
(43, 7, 1, 2, '0', 1, 'admin', 0, '2020-05-11 20:41:18', 1, 0),
(44, 7, 1, 2, '2', 1, 'admin', 0, '2020-05-11 20:41:31', 1, 0),
(45, 7, 7, 32, '0', 1, 'admin', 0, '2020-05-16 18:24:11', 1, 0),
(46, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 18:46:21', 1, 0),
(47, 7, 12, 25, '0', 1, 'admin', 0, '2020-05-16 18:56:13', 1, 0),
(48, 7, 7, 32, '3', 1, 'student', 0, '2020-05-16 18:56:33', 0, 0),
(49, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 18:56:56', 1, 0),
(50, 7, 12, 25, '2', 1, 'admin', 0, '2020-05-16 19:02:05', 1, 0),
(51, 7, 7, 32, '2', 1, 'admin', 0, '2020-05-16 19:02:55', 1, 0),
(52, 64, 7, 32, '0', 1, 'admin', 0, '2020-05-16 19:30:02', 1, 0),
(53, 64, 1, 2, '0', 1, 'admin', 0, '2020-05-16 19:30:35', 1, 0),
(54, 27, 0, 0, '8', 0, 'admin', 0, '2020-06-09 21:32:40', 1, 0),
(55, 28, 0, 0, '8', 0, 'admin', 1, '2020-06-13 18:56:08', 1, 0),
(56, 29, 0, 0, '8', 0, 'admin', 0, '2020-06-13 23:48:10', 1, 0);

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

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `trainingId`, `paymentDate`, `paymentMethod`, `paymentAmount`, `paymentFile`, `isApproved`, `isPaid`, `remarks`, `rejectReason`) VALUES
(188, 39, '2020-05-16 18:46:21', '2', 1000, '2020-05-16_18-46-21_Mark Exequiel-Sale.jpg', '1', 2, 'Payment', NULL),
(191, 39, '2020-05-16 19:02:55', '2', 9000, '2020-05-16_19-02-55_Mark Exequiel-Sale.jpg', '1', 2, 'Payment', NULL),
(192, 41, '2020-05-16 18:46:21', '2', 1000, '2020-05-16_18-46-21_Mark Exequiel-Sale.jpg', '1', 2, 'Payment', NULL),
(193, 41, '2020-05-16 19:02:55', '2', 9000, '2020-05-16_19-02-55_Mark Exequiel-Sale.jpg', '1', 2, 'Payment', NULL);

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
(24, 0, 13, '1', 2, 1, '2020-03-01 16:29:52', '', 0, 0),
(25, 0, 13, '3', 4, 2, '2020-03-01 16:29:52', '', 0, 0),
(34, 0, 13, '12', 2, 2, '2020-03-01 21:28:48', 'Gelabee Corp.', 1, 0),
(35, 0, 16, '1', 0, 1, '2020-03-02 21:28:03', '', 0, 0),
(36, 0, 16, '4', 5, 2, '2020-03-02 21:28:03', '', 0, 0),
(37, 0, 14, '1', 2, 2, '2020-03-02 23:25:09', '', 0, 0),
(38, 0, 14, '2', 3, 1, '2020-03-02 23:25:09', '', 0, 0),
(39, 0, 14, '4', 5, 3, '2020-03-02 23:25:09', '', 0, 0),
(44, 0, 14, '3', 4, 10, '2020-02-29 16:30:43', '', 0, 0),
(45, 0, 14, '4', 5, 2, '2020-02-29 16:30:43', '', 0, 0),
(48, 0, 17, '1', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(49, 0, 17, '3', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(50, 0, 17, '2', 0, 1, '2020-03-07 16:51:31', 'TEST', 0, 1),
(56, 0, 20, '1', 0, 1, '2020-03-08 22:13:31', 'asdasd', 1, 0),
(57, 0, 21, '1', 0, 0, '2020-03-08 22:14:09', '', 0, 0),
(58, 0, 22, '1', 0, 1, '2020-03-08 22:16:42', '', 0, 0),
(59, 0, 22, '1', 0, 1, '2020-03-08 22:16:46', '', 0, 0),
(60, 0, 23, '1', 2, 1, '2020-03-08 22:17:27', 'fsaffsa', 1, 0),
(61, 0, 23, '2', 0, 1, '2020-03-08 22:17:27', 'fsaffsa', 1, 0),
(68, 98, 0, '4', 5, 21, '2020-03-01 16:29:52', '', 0, 0),
(70, 0, 24, '11', 26, 1, '2020-03-31 21:38:34', 'sdasdasd', 0, 0),
(71, 0, 25, '4', 5, 1, '2020-03-31 21:40:10', 'asdzxcqwe', 0, 0),
(72, 0, 25, '11', 26, 1, '2020-03-31 21:40:10', 'asdzxcqwe', 0, 0),
(80, 7, 0, '2', 3, 1, '2020-05-02 17:19:33', 'Test123', 0, 1),
(81, 0, 26, '2', 3, 1, '2020-05-02 21:48:11', 'asdada', 0, 0),
(82, 0, 27, '1', 46, 1, '2020-06-09 21:32:40', 'Sunlife', 0, 0),
(83, 0, 28, '1', 46, 2, '2020-06-13 18:51:14', 'test company', 1, 1),
(84, 0, 28, '1', 46, 2, '2020-06-13 18:56:08', 'test company', 1, 1),
(85, 0, 29, '1', 0, 1, '2020-06-13 23:48:10', 'asdasda', 0, 0);

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
(13, 'Angela', 'Valenzuela', 'Macandili', 'macandili.gelabee@gmail.com', '09161225985'),
(14, 'Andrei', 'Valenzuela', 'Macandili', 'itsmeandrei@gmail.com', '09171336096'),
(16, 'Arianne', 'Valenzuela', 'Macandili', 'macandili.arianne@gmail.com', '09754538593'),
(17, 'Angelika Aubrey', 'Albano', 'Arbiol', 'angelikaaubreyarbiol@gmail.com', '412444214'),
(20, 'asdasd', '', 'asdasd', 'dsadasd@adasdas.com', '12412412'),
(21, 'fsafasf', '', 'fasfas', 'dsadasd@adasdas.com', '2141241241'),
(22, 'sasadasd', 'dsadasd', 'jfklsjfdlk', 'asjfklsafj@gmail.com', '42141241'),
(23, 'fsafasf', 'fsafasf', 'fsdfas', 'asjfklsafj@gmail.com', '4328423'),
(24, 'fsafasf', 'fasfasf', 'fsafasf', 'fasfasf@gmail.com', '41241241'),
(25, 'asdasdasda', 'dasdasdasdas', 'dasdasdsa', 'dsadsadasd@dsadasdas.asd', '12412412'),
(26, 'test', 'test', 'test', 'afasfa@gmail.com', '1241241'),
(27, 'Arlo', 'Valenzuela', 'Macandili', 'testEmail@email.com', '1241414214'),
(28, 'Test Quote', 'Test Quote', 'Test Quote', 'testQuote@gmail.com', '09151234567'),
(29, 'test quote again', 'test quote', 'asdfasfa', 'testemail123@gmail.com', '421741927498');

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
(2, 1, '20000', 111, 1, 13, 13, '2020-05-27', '2020-06-01', 'none', '1', 'Active'),
(3, 2, '20000', 111, 2, 50, 50, '2020-05-04', '2020-05-08', 'none', '1', 'Active'),
(4, 1, '20000', 110, 1, 50, 50, '2020-05-04', '2020-05-05', 'none', '1', 'Active'),
(5, 4, '20000', 111, 2, 50, 50, '2020-04-07', '2020-04-07', 'none', '1', 'Inactive'),
(6, 12, '20000', 111, 1, 50, 50, '2020-04-20', '2020-04-24', 'none', '1', 'Active'),
(25, 12, '8000', 110, 1, 1, 1, '2020-06-09', '2020-06-10', 'none', '1', 'Active'),
(26, 12, '20000', 110, 1, 1, 1, '2020-04-07', '2020-04-08', 'none', '1', 'Inactive'),
(27, 10, '20000', 110, 1, 1, 1, '2020-04-07', '2020-04-09', 'none', '1', 'Inactive'),
(28, 7, '10000', 110, 2, 25, 25, '2020-04-08', '2020-04-10', 'none', '1', 'Active'),
(29, 10, '8000', 110, 2, 1, 1, '2020-05-14', '2020-05-15', 'none', '1', 'Inactive'),
(32, 7, '10000', 110, 2, 99, 98, '2020-05-25', '2020-05-29', 'none', '1', 'Active'),
(42, 12, '2000', 110, 1, 10, 10, '2020-05-04', '2020-05-09', 'weekly', '2', 'Active'),
(43, 7, '8999', 111, 1, 1, 1, '2020-05-03', '2020-05-10', 'weekly', '2', 'Active'),
(44, 5, '7000', 111, 2, 30, 30, '2020-04-18', '2020-04-22', 'none', '1', 'Active'),
(45, 5, '7000', 110, 2, 30, 30, '2020-05-31', '2020-06-04', 'none', '1', 'Active'),
(46, 1, '12345', 110, 1, 10, 10, '2020-06-23', '2020-06-26', 'none', '1', 'Active');

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

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id`, `studentId`, `scheduleId`, `isReserved`, `isDone`, `certificateIssued`, `isCancelled`, `cancellationReason`) VALUES
(39, 7, 32, 1, 1, 0, 0, NULL),
(40, 7, 25, 0, 1, 0, 1, 'Unsettled payment.'),
(41, 64, 32, 1, 1, 0, 0, NULL),
(42, 64, 2, 0, 1, 0, 1, 'Unsettled payment.');

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
(1, 'chris', 'e4c2da91f2feb68f1685320f467f989cbc1fdc31c31334ccc3fa38e3be555c9102fb324b32faf76e849536c2da3b8149b03af56c2bc39efe3a9f02653bbf7de6', 'Christopher', 'Iglesia', 'Buenaventura', 'Super Admin', '', '09261759759', 'chrisventures@gmail.com', 'Active', ''),
(7, 'markus', '2a888860d7da3c94a58f720b5df868dac76dff618b7fc0b1f9502032bc5a0182731c892ee327e9e60d08025673935097a09c09cfb1e2ff8356268949276b4764', 'Mark Exequiel', 'Reambillo', 'Sale', 'Student', 'Concentrix', '516874621345', 'markexequielsale@gmail.com', 'Active', ''),
(59, 'student17', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Leonard Mayer', 'White', 'Daniel', 'Student', 'Mayer, Fisher and Dibbert', '14531', 'wehner.twila@example.net', 'Inactive', ''),
(64, 'student10', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Loyal Wisozk', 'Gutkowski', 'Reinger', 'Student', 'Dare-Bernhard', '88381', 'ashleigh68@example.org', 'Active', ''),
(70, 'student14', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Bethel Bergstrom', 'Lakin', 'Roob', 'Student', 'Greenfelder, Olson and DuBuque', '32110', 'gjacobs@example.net', 'Active', ''),
(73, 'student16', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Haskell Schmeler', 'Harvey', 'Blick', 'Student', 'Lynch Group', '80359', 'jason.reichert@example.com', 'Active', ''),
(79, 'student11', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Dave Breitenberg V', 'Spencer', 'Weber', 'Student', 'Schiller Ltd', '58602', 'lonie77@example.com', 'Inactive', ''),
(92, 'student15', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Ora Mayert Sr.', 'Pouros', 'Heathcote', 'Student', 'Eichmann Group', '16384', 'tschowalter@example.com', 'Active', ''),
(97, 'student12', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Fay Gorczany', 'Bergnaum', 'Hilpert', 'Student', 'Botsford and Sons', '89606', 'coreilly@example.net', 'Inactive', ''),
(98, 'aries', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Aries', 'Valenzuela', 'Macandili', 'Student', 'Cafe24 PH', '09161225985', 'macandili.aries@gmail.com', 'Active', ''),
(103, 'student13', '7768487066f5fd146d89617ba238ab8c4a712c1dd8a55a596b985488450c50ba69d04158a712654dd1c8b2dbd146714208e37b1b5be3b6f8ab49b0868db29ac4', 'Milton Dibbert', 'Quitzon', 'Hyatt', 'Student', 'Bradtke-West', '28141', 'gregg33@example.net', 'Inactive', ''),
(108, 'angelyn', '8771435b3a9b205953419d770b78ca53bacc3d813b0bde269b7bd28c0d6a88533f7159594bfb996ab34e36ae1e2bcac7a63fd0469cf1724b7ce86f5932cebff6', 'Angelyn', '', 'Dequito', 'Student', 'Google', '09123456789', 'gelyn@gmail.com', 'Active', ''),
(109, 'mark', '48e88cf566ec0f1560a7865057b28b876715148d4873a1811d451ee128a09f8d3543910352ae11af8a98a0596dca026f855b6f7d4a8f598dfe9ec194cd6e978b', 'Mark', '', 'Sampayan', 'Instructor', 'Ingram Micro', '1234567890', 'marksampayan@gmail.com', 'Inactive', ''),
(110, 'richard', '9a522c94b08c1547570fa7aeb65ea23e916ccf6edffd81e8e16d0ad399b4ff4f122224b8608a0549d7828c0d5a19b732f33a6014d93ba677f0665c2053ec985d', 'Richard', '', 'Reblando', 'Instructor', 'Nexus ITTC', '1234567890', 'richardreblando@gmail.com', 'Active', ''),
(111, 'judith', '45dabf71a19c582b37e4a5a643cc83e67e2bad30e8f00657e289fe201f038cfd4d2cf60a175622608a56f25c98050ca3cb7ed742cba2c73b05abc5fd95fdc5b3', 'Judith', '', 'Correa', 'Instructor', 'Nexus ITTC', '1234567890', 'judithcorrea@gmail.com', 'Active', 'CCNA'),
(113, 'aubrey', '3d754f754786175c261157efc4433deb4d3eb4bcdb56b62714cc53845a6a73caebd03db04b9cf76e61da7448421d42c848841a6db64ab3422b5610a0005ea141', 'Angelika Aubrey', 'Albano', 'Arbiol', 'Admin', 'Nexus ITTC', '09261759759', 'angelikaaubreyarbiol@gmail.com', 'Inactive', ''),
(114, 'drei', 'c4befa2271888e146c29c48af917e7e905e1e706b6baa3e4e10606ec4b54cafe29ea906bbc78578875ba875c8399ae7ed9412f0c054813eb57cd0eaec8771eec', 'Andrea Nicole', 'Albano', 'Arbiol', 'Admin', '', '09121234567', 'drei_nikki@gmail.com', 'Active', '');

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
(2, 'Makati', 'Unit 2417, 24th Floor Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City', '+63 2 8362-3755', 'Active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_quotation_senders`
--
ALTER TABLE `tbl_quotation_senders`
  MODIFY `quoteSenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_refunds`
--
ALTER TABLE `tbl_refunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_sent_quotations`
--
ALTER TABLE `tbl_sent_quotations`
  MODIFY `invoiceNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
