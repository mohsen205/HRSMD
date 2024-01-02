-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 06:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `id` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`id`, `username`, `role`, `status`, `password`, `createdAt`, `updatedAt`) VALUES
(2, 'ameni.kohila', 'super_admin', '0', '$2y$10$qn.VCto1yGp4R7NkO7ZcU.XIzvUCDFk7qQqSLLmOp3FTP0p1puKh.', '2024-01-01 17:27:09', '2023-11-26 13:23:14'),
(3, 'revini', 'doctor', 'pending', '$2y$10$cAHXssoZuCDmvheuH0cnZORegmIaCI43aAGsS5yXJtCkzRxT692My', '2024-01-01 17:22:31', '0000-00-00 00:00:00'),
(4, 'najugyxaly', 'nurse', 'pending', '$2y$10$PQy6kzCibumvyxZW2kIABOlcynaM6CnFQp4Heqmm9t.NHwqxVbSAW', '2024-01-01 17:27:41', '0000-00-00 00:00:00'),
(5, 'vojapo', 'pharmacist', 'pending', '$2y$10$O/gqvBpokf5.qBVQKd2qu.98NRD1jkKlkwn08sxZ5dRBIylWpngjK', '2024-01-01 17:28:09', '0000-00-00 00:00:00'),
(6, 'sovunu', 'pharmacist', 'pending', '$2y$10$4yzeuAtuoFODgtItqiR30ubhi8u7CGAMxxHMaF9QpGu2fs.csncZa', '2024-01-02 05:16:32', '0000-00-00 00:00:00'),
(7, 'dywolamom', 'pharmacist', 'approved', '$2y$10$agdrQ/iWsSqwLzHjDRG13.jwe928Pgr1a2ZEehFJ0Npgla0Ai0aq.', '2024-01-02 05:52:06', '0000-00-00 00:00:00'),
(8, 'ravylewih', 'pharmacist', 'approved', '$2y$10$.Ns0mMZAq7nG4v58tepsfua0LthnXV8M1RQXIRPbjipHW1rGQjGWe', '2024-01-02 05:21:58', '0000-00-00 00:00:00'),
(10, 'ameni', 'doctor', 'approved', '$2y$10$BS8kweacJXRmSmIuwjVdnu0s95QJiBf5wRrkOwUwMja9RAbtpWt2O', '2024-01-02 05:52:48', '0000-00-00 00:00:00'),
(11, 'ameni 2', 'pharmacist', 'approved', '$2y$10$KBnOe4fkZx39BUNqtWExe.eiLvcWp4v4.wUGRo7Bw31z64m5C65S6', '2024-01-02 05:53:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bedtb`
--

CREATE TABLE `bedtb` (
  `id` int(11) NOT NULL,
  `roomName` text NOT NULL,
  `bedNumber` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `specialty` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `shiftType` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`id`, `fullName`, `email`, `phoneNumber`, `specialty`, `startTime`, `endTime`, `shiftType`, `createdAt`, `updatedAt`) VALUES
(3, 'Breanna Cain', 'xumewelano@gmail.com', '+1 (519) 119-8786', 'general', '20:16:00', '02:30:00', 'morning', '2023-11-26 18:05:06', '0000-00-00 00:00:00'),
(5, 'Linda Sellers', 'diwafipepi@mailinator.com', '+1 (332) 976-6971', 'general', '04:09:00', '07:24:00', 'afternoon', '2023-11-26 18:04:42', '0000-00-00 00:00:00'),
(7, 'Geraldine Mcmahon', 'jucera@mailinator.com', '+1 (679) 591-1144', 'general', '01:12:00', '08:12:00', 'morning', '2023-11-27 16:10:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `bedId` int(11) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `fees` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `patientStatus` varchar(20) DEFAULT NULL,
  `doctorStatus` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedtb`
--
ALTER TABLE `bedtb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctb`
--
ALTER TABLE `doctb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bedId` (`bedId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintb`
--
ALTER TABLE `admintb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bedtb`
--
ALTER TABLE `bedtb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctb`
--
ALTER TABLE `doctb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`bedId`) REFERENCES `bedtb` (`id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
