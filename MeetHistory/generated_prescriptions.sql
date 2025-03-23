-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 06:57 AM
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
-- Table structure for table `generated_prescriptions`
--

CREATE TABLE `generated_prescriptions` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `date_issued` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generated_prescriptions`
--

INSERT INTO `generated_prescriptions` (`id`, `student_id`, `doctor_id`, `doctor_name`, `file_name`, `file_type`, `file_path`, `date_issued`) VALUES
(3, 'BTBTC22014', 'DTDTC22021', NULL, 'blob', 'application/pdf', 'generated_prescriptions/blob', '2025-03-13 07:49:19'),
(6, 'BTBTC22014', 'nmwjk', 'kfnk', 'Prescription_nmwjk_1741859580304.pdf', 'application/pdf', 'generated_prescriptions/Prescription_nmwjk_1741859580304.pdf', '2025-03-13 09:53:00'),
(7, 'BTBTC22014', 'DTDTC22002', 'DR. Praveen Gupta', 'Prescription_DTDTC22002_1741859676802.pdf', 'application/pdf', 'generated_prescriptions/Prescription_DTDTC22002_1741859676802.pdf', '2025-03-13 09:54:36'),
(8, 'BTBTC22014', 'DTDTC22189', 'amit thapa', 'Prescription_DTDTC22189_1741906515797.pdf', 'application/pdf', 'generated_prescriptions/Prescription_DTDTC22189_1741906515797.pdf', '2025-03-13 22:55:15'),
(9, 'BTBTC22014', 'DTDTC22034', 'Bhavika sharma', 'Prescription_DTDTC22034_1741908160382.pdf', 'application/pdf', 'generated_prescriptions/Prescription_DTDTC22034_1741908160382.pdf', '2025-03-13 23:22:40'),
(10, 'BTBTC22014', 'DTDTC22189', 'Devanshi mehta', 'Prescription_DTDTC22189_1741908285500.pdf', 'application/pdf', 'generated_prescriptions/Prescription_DTDTC22189_1741908285500.pdf', '2025-03-13 23:24:45'),
(11, 'BTBTC22014', 'DTDTC22034', 'Preeti', 'Prescription_DTDTC22034_1742709246151.pdf', 'application/pdf', 'generated_prescriptions/Prescription_DTDTC22034_1742709246151.pdf', '2025-03-23 05:54:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generated_prescriptions`
--
ALTER TABLE `generated_prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generated_prescriptions`
--
ALTER TABLE `generated_prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
