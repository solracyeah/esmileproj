-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 02:42 PM
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
-- Database: `esmile_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('Set Request','Approved','Cancel Requested','Cancelled') NOT NULL DEFAULT 'Set Request',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cancel_reason` varchar(255) DEFAULT NULL,
  `payment_screenshot` varchar(255) DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `treatment_fee` decimal(10,2) DEFAULT NULL,
  `reference_number` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `title`, `appointment_date`, `appointment_time`, `status`, `created_at`, `cancel_reason`, `payment_screenshot`, `patient_name`, `notes`, `treatment_fee`, `reference_number`) VALUES
(1, 7, 'Check-up', '2024-12-19', '11:00:00', 'Cancel Requested', '2024-12-18 06:21:04', 'Change of plans', NULL, '', NULL, 0.00, NULL),
(2, 7, 'Check-up', '2024-12-19', '12:00:00', 'Set Request', '2024-12-18 06:31:52', NULL, NULL, '', NULL, 0.00, NULL),
(4, 8, 'Check-up', '2024-12-19', '13:00:00', 'Set Request', '2024-12-18 11:22:51', NULL, NULL, '', NULL, 0.00, NULL),
(5, 8, 'hello there!', '2024-12-18', '21:25:00', 'Cancel Requested', '2024-12-18 11:23:09', 'Other', NULL, '', NULL, 0.00, NULL),
(6, 8, 'Cavity Filling', '2024-12-20', '14:00:00', 'Set Request', '2024-12-18 13:42:51', NULL, NULL, '', NULL, 0.00, NULL),
(7, 17, 'Toothache', '2024-12-20', '14:00:00', 'Approved', '2024-12-18 16:00:48', NULL, NULL, '', NULL, 0.00, NULL),
(10, 11, 'Check-up', '2025-01-15', '15:00:00', 'Set Request', '2024-12-18 16:30:29', NULL, NULL, '', NULL, 0.00, NULL),
(11, 49, 'Check-up', '2024-12-20', '14:00:00', 'Set Request', '2024-12-19 15:58:45', NULL, NULL, '', NULL, 0.00, NULL),
(12, 17, 'Check-up', '2025-01-01', '10:00:00', '', '2024-12-19 16:19:48', NULL, NULL, '', NULL, 0.00, NULL),
(13, 10, 'Cavity Filling', '2025-01-02', '11:00:00', 'Set Request', '2024-12-19 16:31:53', NULL, NULL, '', NULL, 0.00, NULL),
(14, 10, 'Cavity Filling', '2025-01-02', '11:00:00', 'Set Request', '2024-12-19 16:32:19', NULL, NULL, '', NULL, 0.00, NULL),
(15, 17, 'Whitening', '2024-12-24', '14:00:00', 'Approved', '2024-12-19 16:42:58', NULL, NULL, '', NULL, 0.00, NULL),
(16, 17, 'Check-up', '2024-12-24', '15:00:00', 'Approved', '2024-12-19 16:43:08', NULL, NULL, '', NULL, 0.00, NULL),
(17, 23, 'Check-up', '2024-12-21', '14:00:00', 'Approved', '2024-12-19 16:53:21', NULL, NULL, '', NULL, 0.00, NULL),
(18, 23, 'Toothache', '2024-12-20', '12:00:00', 'Approved', '2024-12-19 16:53:33', NULL, NULL, '', NULL, 0.00, NULL),
(19, 10, 'Cavity Filling', '2025-01-07', '13:00:00', 'Set Request', '2025-01-06 00:23:41', NULL, NULL, '', NULL, 0.00, NULL),
(20, 6, 'Check-up', '2025-01-10', '09:00:00', 'Approved', '2025-01-06 11:01:47', NULL, NULL, '', NULL, 0.00, NULL),
(21, 7, 'Check-up', '2025-01-09', '08:00:00', 'Set Request', '2025-01-08 12:07:45', NULL, NULL, '', NULL, 0.00, NULL),
(22, 7, 'Check-up', '2025-02-06', '16:00:00', 'Set Request', '2025-01-08 12:09:01', NULL, NULL, '', NULL, 0.00, NULL),
(23, 7, 'Whitening', '2025-01-24', '11:00:00', 'Approved', '2025-01-23 05:35:34', NULL, NULL, '', NULL, 0.00, NULL),
(24, 7, 'Check-up', '2025-01-25', '12:00:00', 'Set Request', '2025-01-23 05:57:46', NULL, NULL, '', NULL, 0.00, NULL),
(25, 7, 'Check-up', '2025-01-31', '08:00:00', 'Set Request', '2025-01-23 07:16:00', NULL, NULL, '', NULL, 0.00, NULL),
(26, 7, 'Check-up', '2025-01-31', '17:00:00', 'Set Request', '2025-01-23 07:22:30', NULL, 'uploads/payments/image.png', '', NULL, 0.00, NULL),
(27, 17, 'Check-up', '2025-01-30', '16:00:00', '', '2025-01-29 10:31:35', NULL, 'uploads/payments/migga.jpg', '', NULL, 0.00, NULL),
(29, 17, 'Cavity Filling', '2025-01-31', '10:00:00', 'Approved', '2025-01-30 15:22:22', NULL, NULL, 'Snow  White', 'try', 0.00, NULL),
(30, 17, 'Cleaning', '2025-02-03', '08:00:00', 'Approved', '2025-01-30 15:26:58', NULL, NULL, 'Snow  White', 'test', 0.00, NULL),
(31, 17, 'Check-up', '2025-02-06', '10:00:00', 'Set Request', '2025-02-06 13:54:37', NULL, 'uploads/payments/torybor.png', '', 'test', 1000.00, NULL),
(32, 53, 'Check-up', '2025-02-28', '10:00:00', 'Approved', '2025-02-12 05:12:23', NULL, 'uploads/payments/nulogo.png', '', NULL, NULL, NULL),
(33, 53, 'Toothache', '2025-02-27', '08:00:00', 'Approved', '2025-02-12 05:22:47', NULL, 'uploads/payments/nulogo.png', '', NULL, NULL, NULL),
(34, 52, 'Check-up', '2025-02-13', '08:00:00', 'Set Request', '2025-02-12 11:10:00', NULL, 'uploads/payments/1739359170_387763514_2208544606016382_5530384470978886284_n (1).jpg', '', NULL, NULL, 2147483647),
(35, 52, 'Cleaning', '2025-02-13', '16:00:00', 'Set Request', '2025-02-12 12:08:37', NULL, 'uploads/payments/1739362124_387763514_2208544606016382_5530384470978886284_n (1).jpg', '', NULL, NULL, 2147483647),
(36, 52, 'Check-up', '2025-02-14', '16:00:00', 'Set Request', '2025-02-12 13:04:32', NULL, 'uploads/payments/1739365479_387763514_2208544606016382_5530384470978886284_n (1).jpg', '', NULL, NULL, 2147483647),
(37, 52, 'Removal of Impacted Tooth', '2025-02-20', '08:00:00', 'Set Request', '2025-02-12 13:32:17', NULL, 'uploads/payments/1739367146_387763514_2208544606016382_5530384470978886284_n (1).jpg', '', NULL, NULL, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
