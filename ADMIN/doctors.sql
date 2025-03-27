-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 04:40 PM
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
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `doctor_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `sitting_hours` varchar(50) NOT NULL,
  `status` enum('Pending','Approved') DEFAULT 'Approved',
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctor_id`, `name`, `email`, `gender`, `contact_number`, `specialization`, `sitting_hours`, `status`, `photo`) VALUES
(1, 'DOC1002', 'Rajeev Jain', 'rajeevjain@banasthali.in', 'Male', '9876545678', 'Dermatologist', '9Am-4PM', 'Approved', 'Doctor1.jpg'),
(2, 'DOC002', 'Dr. Aditi Sharma', 'aditi.sharma@example.com', 'Female', '9876543210', 'Cardiologist', '9 AM - 1 PM', 'Approved', 'Doctor2.jpg'),
(3, 'DOC003', 'Dr. Rohan Mehta', 'rohan.mehta@example.com', 'Male', '9876543211', 'Dermatologist', '10 AM - 2 PM', 'Approved', 'Doctor3.jpg'),
(4, 'DOC004', 'Dr. Priya Verma', 'priya.verma@example.com', 'Female', '9876543212', 'Neurologist', '11 AM - 3 PM', 'Approved', 'Doctor4.jpg'),
(5, 'DOC005', 'Dr. Arjun Kapoor', 'arjun.kapoor@example.com', 'Male', '9876543213', 'Pediatrician', '8 AM - 12 PM', '', ''),
(6, 'DOC006', 'Dr. Sneha Gupta', 'sneha.gupta@example.com', 'Female', '9876543214', 'Gynecologist', '9 AM - 1 PM', 'Pending', ''),
(7, 'DCDCH7788', 'Dr. Amit Thapa', 'amit.thapa@example.com', 'Male', '9876543210', 'Physician', '10 AM - 4 PM', 'Approved', 'default-profile.png'),
(8, 'DCDCH7799', 'Dr. Rajesh Sharma', 'rajesh.sharma@example.com', 'Male', '9876543222', 'Cardiologist', '9 AM - 3 PM', 'Approved', 'uploads/DCDCH7799.jpg'),
(9, 'DCDCH7811', 'Dr. Jane Doe', '', 'Male', '', 'Dermatology', '', 'Approved', 'uploads/default-profile.png'),
(11, 'DCDCH7800', 'Dr. John Smith', 'dr.john@example.com', 'Male', '', 'Cardiology', '', 'Approved', ''),
(15, 'DCDCH7823', 'Dr. Jane Doe', 'janedoe@example.com', 'Female', '9876543210', 'Dermatology', '9 AM - 5 PM', 'Approved', 'uploads/DCDCH7823.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor_id` (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
