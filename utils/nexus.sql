-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 02:38 PM
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
  `examCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `courseName`, `coursePrice`, `courseDescription`, `examCode`) VALUES
(1, 'CCNA v4', '12000', 'Implementing and Administering Cisco Solutions', '200-301'),
(2, 'CCNP', '12000', 'Implementing Cisco Enterprise Advanced Routing and Services', ''),
(3, 'MCP', '8000', 'Windows 2012 R2', '20410'),
(4, 'Ethical Hacking with Penetration Testing', '3000', '', '');

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
-- Table structure for table `tbl_paymentmethods`
--

CREATE TABLE `tbl_paymentmethods` (
  `id` int(11) NOT NULL,
  `methodName` varchar(255) NOT NULL
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
-- Table structure for table `tbl_quotations`
--

CREATE TABLE `tbl_quotations` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `companySponsored` tinyint(1) NOT NULL,
  `courseId` varchar(255) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `dateSent` datetime NOT NULL,
  `isQuotationSent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `id` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `scheduleType` varchar(255) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`id`, `courseId`, `venueId`, `scheduleType`, `fromDate`, `toDate`) VALUES
(2, 1, 1, 'Weekdays', '2020-03-16', '2020-03-20'),
(3, 2, 1, 'Weekdays', '2020-03-23', '2020-03-27'),
(4, 3, 2, 'Weekends', '2020-03-28', '2020-03-29'),
(5, 4, 1, 'Sundays', '2020-03-29', '2020-03-29'),
(6, 1, 1, 'Weekdays', '2020-03-09', '2020-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `instructorId` int(11) NOT NULL,
  `scheduleId` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `paymentId` int(11) NOT NULL,
  `certificateIssued` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id`, `studentId`, `courseId`, `instructorId`, `scheduleId`, `isDone`, `paymentId`, `certificateIssued`) VALUES
(1, 3, 1, 2, 1, 0, 1, 0),
(2, 4, 1, 2, 1, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
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

INSERT INTO `tbl_users` (`userID`, `username`, `password`, `firstName`, `middleName`, `lastName`, `position`, `companyName`, `contactNum`, `email`, `status`) VALUES
(1, 'chris', 'chris123', 'Christopher', 'Iglesia', 'Buenaventura', 'Super Admin', '', '09261759759', 'angelikaaubreyarbiol@gmail.com', 'Active'),
(7, 'markus', '123456789', 'Mark Exequiel', 'Reambillo', 'Sale', 'Student', 'Concentrix', '516874621345', 'markexequielsale@gmail.com', 'Active'),
(59, 'student17', 'student', 'Leonard Mayer', 'White', 'Daniel', 'Student', 'Mayer, Fisher and Dibbert', '14531', 'wehner.twila@example.net', 'Inactive'),
(64, 'student10', 'student', 'Loyal Wisozk', 'Gutkowski', 'Reinger', 'Student', 'Dare-Bernhard', '88381', 'ashleigh68@example.org', 'Active'),
(70, 'student14', 'student', 'Bethel Bergstrom', 'Lakin', 'Roob', 'Student', 'Greenfelder, Olson and DuBuque', '32110', 'gjacobs@example.net', 'Active'),
(73, 'student16', 'student', 'Haskell Schmeler', 'Harvey', 'Blick', 'Student', 'Lynch Group', '80359', 'jason.reichert@example.com', 'Active'),
(79, 'student11', 'student', 'Dave Breitenberg V', 'Spencer', 'Weber', 'Student', 'Schiller Ltd', '58602', 'lonie77@example.com', 'Inactive'),
(92, 'student15', 'student', 'Ora Mayert Sr.', 'Pouros', 'Heathcote', 'Student', 'Eichmann Group', '16384', 'tschowalter@example.com', 'Active'),
(97, 'student12', 'student', 'Fay Gorczany', 'Bergnaum', 'Hilpert', 'Student', 'Botsford and Sons', '89606', 'coreilly@example.net', 'Inactive'),
(98, 'student1', 'student', 'Linda McGlynn', 'Rolfson', 'Stamm', 'Student', 'Johnston, O\'Conner and Schuster', '38792', 'stanton.kristoffer@example.org', 'Inactive'),
(103, 'student13', 'student', 'Milton Dibbert', 'Quitzon', 'Hyatt', 'Student', 'Bradtke-West', '28141', 'gregg33@example.net', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `venue`, `address`) VALUES
(1, 'Manila', 'Room 401 Dona Amparo Bldg., Espana Blvd., Manila'),
(2, 'Makati', 'Unit 2417, 24th Floor Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City\r\n');

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
-- Indexes for table `tbl_paymentmethods`
--
ALTER TABLE `tbl_paymentmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tbl_paymentmethods`
--
ALTER TABLE `tbl_paymentmethods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotations`
--
ALTER TABLE `tbl_quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
