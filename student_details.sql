-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 07:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aarogya_seva`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `Class` varchar(255) NOT NULL,
  `Session` varchar(255) NOT NULL,
  `Id` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(255) DEFAULT NULL,
  `Dob` date NOT NULL,
  `Height` float NOT NULL,
  `Weight` float NOT NULL,
  `Address` varchar(320) NOT NULL,
  `Pin` varchar(6) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `hostel_name` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`Class`, `Session`, `Id`, `Name`, `fathers_name`, `mothers_name`, `Dob`, `Height`, `Weight`, `Address`, `Pin`, `Phone`, `Email`, `hostel_name`, `profile_pic`) VALUES
('B.Tech 3rd year', '2022-2026', 'BTBTC22014', 'Bhakti Garg', 'Anil Sharma', 'Monika Sharma', '2005-04-29', 160, 80, 'Swastik Art Printers, Rayali Campan, Pali Baazar , Beawar', '305890', '8209523398', 'btbtc22021_bhavika@banasthali.in', NULL, NULL),
('B.Tech 3rd year', '2022-2026', 'BTBTC22021', 'Bhavika sharma', 'Anil Sharma', 'Monika Sharma', '2005-04-29', 160, 55, 'Swastik Art Printers, Rayali Campan, Pali Baazar , Beawar', '305890', '8209523398', 'btbtc22021_bhavika@banasthali.in', NULL, 'uploads/Doctor1.jpg\r\n'),
('Ba 1st year', '2022-23', 'btbtc22135', 'devanshi mehta', 'ankur mehta', 'madhavi mehta', '2008-08-28', 145, 56, 'dahsdvxajhdbh123', '45622', '1234567891', 'btbts22145_deva@banasthali.in', NULL, NULL),
('B.Tech 3rd year', '2022-2026', 'BTBTS22101', 'Bhavika sharma', 'Anil Sharma', 'Monika Sharma', '2005-04-29', 160, 80, 'Swastik Art Printers, Rayali Campan, Pali Baazar , Beawar', '305890', '8209523398', 'btbtc22021_bhavika@banasthali.in', NULL, NULL),
('B.Tech 3rd year', '2022-2026', 'btbtx123', 'bhvxzz', 'x233', 'xyx', '2025-03-06', 150, 62, 'Swastik Art Printers, Rayali Campan, Pali Baazar , Beawar', '305901', '1234567890', 'bhavika29@gmail.com', 'Soudh', NULL),
('i', 'qaswd', 'xsxscs', 'czccsdc', 'csdcdvdfv', 'vdfvdvsd', '2025-03-30', 146, 44, 'scsdcvsdvsc', 'csdcsd', 'czdcsdcscd', 'cascsdcsdcs@gmail.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
