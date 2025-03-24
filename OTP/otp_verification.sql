-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 05:25 AM
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
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `otp_id` int(11) NOT NULL,
  `Id` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expiry_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`otp_id`, `Id`, `otp`, `expiry_time`) VALUES
(32, 'BTBTC22014', '066132', '2025-03-15 02:32:03'),
(34, 'BTBTC22021', '275483', '2025-03-15 02:42:28'),
(35, 'BTBTC22021', '860175', '2025-03-15 02:51:47'),
(36, 'BTBTC22021', '935422', '2025-03-15 02:53:21'),
(37, 'btbtc22021', '753232', '2025-03-23 18:47:26'),
(38, 'BTBTC22021', '769927', '2025-03-24 09:47:52'),
(39, 'BTBTC22021', '679558', '2025-03-24 09:49:23'),
(40, 'BTBTC22021', '606095', '2025-03-24 09:51:37'),
(41, 'BTBTC22021', '853093', '2025-03-24 09:58:26'),
(42, 'BTBTC22021', '965066', '2025-03-24 10:01:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`otp_id`),
  ADD KEY `otp_verification_ibfk_1` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD CONSTRAINT `otp_verification_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `student_details` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
