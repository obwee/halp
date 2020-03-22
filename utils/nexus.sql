-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 09:03 AM
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
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `id` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `coursePrice` decimal(10,0) NOT NULL,
  `courseDescription` varchar(255) NOT NULL,
  `courseCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `courseName`, `coursePrice`, `courseDescription`, `courseCode`) VALUES
(1, 'Cisco Certified Network Associate v4', '20000', 'Implementing and Administering Cisco Solutions', 'CCNAv4'),
(2, 'Cisco Certified Network Professional', '28000', 'Enterprise Core', 'CCNP&CCIE'),
(3, 'Cisco Certified Network Professional', '28000', 'Implementing Cisco Enterprise Advanced Routing and Services', 'CCNP ENARSI'),
(4, 'MCP 20410D', '8000', 'Installing and Configuring Windows Server 2012', '20410D'),
(5, 'MCSA in Windows Server 2016', '22500', 'Microsoft Certified Solutions Associate in Windows Server 2016', 'MCSA2016'),
(6, 'MCSA in Windows Server 2012', '18000', 'Microsoft Certified Solutions Associate in Windows Server 2012', 'MCSA2012'),
(7, 'Microsoft Azure Administrator', '30000', '', 'AZ-1003T00-A'),
(8, 'AWS - Solutions Architect', '18000', 'Amazon Web Services Solutions Architect', 'AWS'),
(9, 'VMware 6.7 ICM', '25000', 'Vmware vSphere 6.7: Install, Configure and Manage', 'VMware'),
(10, 'Vmware Hyper-Converged Infrastructure', '55000', '', 'HCI'),
(11, 'Ethical Hacking & Penetration Testing', '3000', '', 'EH'),
(12, 'Certified Digital Forensics Examiner', '45000', '', 'CDFE');

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
-- Table structure for table `tbl_inclusions`
--

CREATE TABLE `tbl_inclusions` (
  `id` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `inclusion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE `tbl_payment_methods` (
  `id` int(11) NOT NULL,
  `methodName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(33, 0, 13, '1', 0, 1, '2020-03-01 21:28:48', 'Gelabee Corp.', 1, 0),
(34, 0, 13, '2', 3, 2, '2020-03-01 21:28:48', 'Gelabee Corp.', 1, 0),
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
(60, 0, 23, '1', 6, 1, '2020-03-08 22:17:27', 'fsaffsa', 1, 0),
(61, 0, 23, '2', 0, 1, '2020-03-08 22:17:27', 'fsaffsa', 1, 0),
(68, 98, 0, '4', 5, 21, '2020-03-01 16:29:52', '', 0, 0);

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
(23, 'fsafasf', 'fsafasf', 'fsdfas', 'asjfklsafj@gmail.com', '4328423');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `id` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `instructorId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `numSlots` int(11) NOT NULL,
  `remainingSlots` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`id`, `courseId`, `instructorId`, `venueId`, `numSlots`, `remainingSlots`, `fromDate`, `toDate`) VALUES
(2, 1, 111, 2, 50, 50, '2020-04-23', '2020-04-27'),
(3, 2, 111, 1, 50, 50, '2020-04-23', '2020-04-27'),
(4, 1, 109, 2, 50, 50, '2020-04-28', '2020-04-29'),
(5, 4, 110, 1, 50, 50, '2020-04-29', '2020-04-29'),
(6, 8, 109, 1, 50, 50, '2020-04-16', '2020-04-20'),
(9, 9, 111, 2, 10, 0, '2020-04-09', '2020-04-11');

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
  `courseId` int(11) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `paymentId` int(11) NOT NULL,
  `certificateIssued` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id`, `studentId`, `courseId`, `scheduleId`, `isDone`, `paymentId`, `certificateIssued`) VALUES
(1, 98, 3, 1, 0, 1, 0),
(2, 98, 2, 1, 0, 2, 0);

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
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `username`, `password`, `firstName`, `middleName`, `lastName`, `position`, `companyName`, `contactNum`, `email`, `status`) VALUES
(1, 'chris', 'chris123', 'Christopher', 'Iglesia', 'Buenaventura', 'Super Admin', '', '09261759759', 'angelikaaubreyarbiol@gmail.com', 'Active'),
(7, 'markus', '123456789', 'Mark Exequiel', 'Reambillo', 'Sale', 'Student', 'Concentrix', '516874621345', 'markexequielsale@gmail.com', 'Active'),
(59, 'student17', 'student', 'Leonard Mayer', 'White', 'Daniel', 'Student', 'Mayer, Fisher and Dibbert', '14531', 'wehner.twila@example.net', 'Inactive'),
(64, 'student10', 'student', 'Loyal Wisozk', 'Gutkowski', 'Reinger', 'Student', 'Dare-Bernhard', '88381', 'ashleigh68@example.org', 'Active'),
(70, 'student14', 'student', 'Bethel Bergstrom', 'Lakin', 'Roob', 'Student', 'Greenfelder, Olson and DuBuque', '32110', 'gjacobs@example.net', 'Active'),
(73, 'student16', 'student', 'Haskell Schmeler', 'Harvey', 'Blick', 'Student', 'Lynch Group', '80359', 'jason.reichert@example.com', 'Active'),
(79, 'student11', 'student', 'Dave Breitenberg V', 'Spencer', 'Weber', 'Student', 'Schiller Ltd', '58602', 'lonie77@example.com', 'Inactive'),
(92, 'student15', 'student', 'Ora Mayert Sr.', 'Pouros', 'Heathcote', 'Student', 'Eichmann Group', '16384', 'tschowalter@example.com', 'Active'),
(97, 'student12', 'student', 'Fay Gorczany', 'Bergnaum', 'Hilpert', 'Student', 'Botsford and Sons', '89606', 'coreilly@example.net', 'Inactive'),
(98, 'aries', 'student', 'Aries', 'Valenzuela', 'Macandili', 'Student', 'Cafe24 PH', '09161225985', 'macandili.aries@gmail.com', 'Active'),
(103, 'student13', 'student', 'Milton Dibbert', 'Quitzon', 'Hyatt', 'Student', 'Bradtke-West', '28141', 'gregg33@example.net', 'Inactive'),
(108, 'angelyn', 'angelyn', 'Angelyn', '', 'Dequito', 'Student', 'Google', '09123456789', 'gelyn@gmail.com', 'Active'),
(109, 'mark', 'mark123', 'Mark', '', 'Sampayan', 'Instructor', 'Ingram Micro', '1234567890', 'marksampayan@gmail.com', 'Active'),
(110, 'richard', 'richard123', 'Richard', '', 'Reblando', 'Instructor', 'Nexus ITTC', '1234567890', 'richardreblando@gmail.com', 'Active'),
(111, 'judith', 'judith123', 'Judith', '', 'Correa', 'Instructor', 'Nexus ITTC', '1234567890', 'judithcorrea@gmail.com', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactNum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `venue`, `address`, `contactNum`) VALUES
(1, 'Manila', 'Room 401 Dona Amparo Bldg., Espana Blvd., Manila', '+63 2 8355-7759'),
(2, 'Makati', 'Unit 2417, 24th Floor Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City\r\n', '+63 2 8362-3755');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_inclusions`
--
ALTER TABLE `tbl_inclusions`
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
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_inclusions`
--
ALTER TABLE `tbl_inclusions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_quotation_senders`
--
ALTER TABLE `tbl_quotation_senders`
  MODIFY `quoteSenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_sent_quotations`
--
ALTER TABLE `tbl_sent_quotations`
  MODIFY `invoiceNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
