-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 05:38 PM
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
(7, 'Microsoft Azure Administrator', '', 'AZ-1003T00-A', 'Active'),
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
  `trainingId` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `paymentAmount` int(11) DEFAULT 0,
  `paymentFile` varchar(255) NOT NULL,
  `isApproved` varchar(255) NOT NULL DEFAULT '0',
  `isPaid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `trainingId`, `paymentDate`, `paymentMethod`, `paymentAmount`, `paymentFile`, `isApproved`, `isPaid`) VALUES
(12, 12, '2020-04-07 22:08:23', NULL, 0, '2020-04-07_22-08-23_Mark Exequiel-Sale.jpg', '0', 0);

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
(1, 'Cash', 'Active'),
(2, 'BDO', 'Active'),
(3, 'Cheque', 'Active');

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
(68, 98, 0, '4', 5, 21, '2020-03-01 16:29:52', '', 0, 0),
(70, 0, 24, '11', 26, 1, '2020-03-31 21:38:34', 'sdasdasd', 0, 0),
(71, 0, 25, '4', 5, 1, '2020-03-31 21:40:10', 'asdzxcqwe', 0, 0),
(72, 0, 25, '11', 26, 1, '2020-03-31 21:40:10', 'asdzxcqwe', 0, 0),
(73, 7, 0, '4', 5, 1, '2020-03-31 21:45:37', '1234', 0, 0);

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
(25, 'asdasdasda', 'dasdasdasdas', 'dasdasdsa', 'dsadsadasd@dsadasdas.asd', '12412412');

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
(2, 1, '20000', 111, 1, 12, 10, '2020-04-20', '2020-04-24', 'none', '1', 'Active'),
(3, 2, '20000', 111, 2, 50, 49, '2020-05-04', '2020-05-08', 'none', '1', 'Active'),
(4, 1, '20000', 110, 1, 50, 50, '2020-04-30', '2020-05-01', 'none', '1', 'Active'),
(5, 4, '20000', 111, 2, 50, 50, '2020-04-07', '2020-04-07', 'none', '1', 'Inactive'),
(6, 12, '20000', 111, 1, 49, 49, '2020-04-13', '2020-04-17', 'none', '1', 'Active'),
(25, 12, '20000', 110, 1, 1, 1, '2020-03-09', '2020-03-10', 'none', '1', 'Active'),
(26, 12, '20000', 110, 1, 1, 1, '2020-04-07', '2020-04-08', 'none', '1', 'Inactive'),
(27, 10, '20000', 110, 1, 1, 1, '2020-04-07', '2020-04-09', 'none', '1', 'Inactive'),
(28, 7, '10000', 110, 2, 25, 25, '2020-04-08', '2020-04-10', 'none', '1', 'Active'),
(29, 10, '8000', 110, 2, 1, 0, '2020-05-14', '2020-05-15', 'none', '1', 'Active'),
(32, 7, '9999', 110, 2, 99, 98, '2020-05-25', '2020-05-29', 'none', '1', 'Active'),
(42, 12, '2000', 110, 1, 10, 10, '2020-05-03', '2020-05-10', 'weekly', '2', 'Active'),
(43, 7, '41241', 111, 1, 1, 0, '2020-04-12', '2020-04-19', 'weekly', '2', 'Active');

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
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `certificateIssued` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id`, `studentId`, `scheduleId`, `isDone`, `certificateIssued`) VALUES
(11, 7, 32, 0, 0),
(12, 7, 2, 0, 0);

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
(1, 'chris123', 'chris', 'Christopher', 'Iglesia', 'Buenaventura', 'Super Admin', '', '09261759759', 'chrisventures@gmail.com', 'Active', ''),
(7, 'markus', 'markus', 'Mark Exequiel', 'Reambillo', 'Sale', 'Student', 'Concentrix', '516874621345', 'markexequielsale@gmail.com', 'Active', ''),
(59, 'student17', 'student', 'Leonard Mayer', 'White', 'Daniel', 'Student', 'Mayer, Fisher and Dibbert', '14531', 'wehner.twila@example.net', 'Inactive', ''),
(64, 'student10', 'student', 'Loyal Wisozk', 'Gutkowski', 'Reinger', 'Student', 'Dare-Bernhard', '88381', 'ashleigh68@example.org', 'Active', ''),
(70, 'student14', 'student', 'Bethel Bergstrom', 'Lakin', 'Roob', 'Student', 'Greenfelder, Olson and DuBuque', '32110', 'gjacobs@example.net', 'Active', ''),
(73, 'student16', 'student', 'Haskell Schmeler', 'Harvey', 'Blick', 'Student', 'Lynch Group', '80359', 'jason.reichert@example.com', 'Active', ''),
(79, 'student11', 'student', 'Dave Breitenberg V', 'Spencer', 'Weber', 'Student', 'Schiller Ltd', '58602', 'lonie77@example.com', 'Inactive', ''),
(92, 'student15', 'student', 'Ora Mayert Sr.', 'Pouros', 'Heathcote', 'Student', 'Eichmann Group', '16384', 'tschowalter@example.com', 'Active', ''),
(97, 'student12', 'student', 'Fay Gorczany', 'Bergnaum', 'Hilpert', 'Student', 'Botsford and Sons', '89606', 'coreilly@example.net', 'Inactive', ''),
(98, 'aries', 'student', 'Aries', 'Valenzuela', 'Macandili', 'Student', 'Cafe24 PH', '09161225985', 'macandili.aries@gmail.com', 'Active', ''),
(103, 'student13', 'student', 'Milton Dibbert', 'Quitzon', 'Hyatt', 'Student', 'Bradtke-West', '28141', 'gregg33@example.net', 'Inactive', ''),
(108, 'angelyn', 'angelyn', 'Angelyn', '', 'Dequito', 'Student', 'Google', '09123456789', 'gelyn@gmail.com', 'Active', ''),
(109, 'mark', 'mark', 'Mark', '', 'Sampayan', 'Instructor', 'Ingram Micro', '1234567890', 'marksampayan@gmail.com', 'Inactive', ''),
(110, 'richard', 'richard', 'Richard', '', 'Reblando', 'Instructor', 'Nexus ITTC', '1234567890', 'richardreblando@gmail.com', 'Active', ''),
(111, 'judith', 'judith', 'Judith', '', 'Correa', 'Instructor', 'Nexus ITTC', '1234567890', 'judithcorrea@gmail.com', 'Active', 'CCNA'),
(113, 'aubrey', 'aubrey', 'Angelika Aubrey', 'Albano', 'Arbiol', 'Admin', 'Nexus ITTC', '09261759759', 'angelikaaubreyarbiol@gmail.com', 'Inactive', ''),
(114, 'drei', 'drei', 'Andrea Nicole', 'Albano', 'Arbiol', 'Admin', '', '09121234567', 'drei_nikki@gmail.com', 'Active', '');

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
-- AUTO_INCREMENT for table `tbl_cancellations`
--
ALTER TABLE `tbl_cancellations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_payment_methods`
--
ALTER TABLE `tbl_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_quotation_senders`
--
ALTER TABLE `tbl_quotation_senders`
  MODIFY `quoteSenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_sent_quotations`
--
ALTER TABLE `tbl_sent_quotations`
  MODIFY `invoiceNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
