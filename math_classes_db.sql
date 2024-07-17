-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 01:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `math_classes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `booking_date` time DEFAULT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `classroom_id`, `booking_date`, `student_name`, `created_at`) VALUES
(15, 1, '17:00:00', 'Test', '2024-07-17 10:54:46'),
(16, 1, '17:00:00', 'Test', '2024-07-17 10:54:47'),
(17, 1, '17:00:00', 'Test', '2024-07-17 10:54:48'),
(18, 1, '17:00:00', 'Test', '2024-07-17 11:24:24'),
(19, 1, '17:00:00', 'Test', '2024-07-17 11:24:44'),
(20, 1, '15:00:00', 'Test', '2024-07-17 11:25:12'),
(21, 1, '15:00:00', 'Test', '2024-07-17 11:25:14'),
(22, 1, '17:00:00', 'Test', '2024-07-17 11:25:23'),
(23, 1, '17:00:00', 'Test', '2024-07-17 11:25:24'),
(24, 1, '17:00:00', 'Test', '2024-07-17 11:25:25'),
(25, 1, '17:00:00', 'Test', '2024-07-17 11:25:26'),
(26, 1, '15:00:00', 'Test', '2024-07-17 11:26:15'),
(27, 1, '14:00:00', 'Rubanraj', '2024-07-17 11:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `timetable` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`timetable`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `capacity`, `timetable`) VALUES
(1, 'Classroom A', 10, '{\"Monday\": [\"09:00\", \"10:00\", \"11:00\", \"12:00\", \"13:00\", \"14:00\", \"15:00\", \"16:00\", \"17:00\"], \"Wednesday\": [\"09:00\", \"10:00\", \"11:00\", \"12:00\", \"13:00\", \"14:00\", \"15:00\", \"16:00\", \"17:00\"]}'),
(2, 'Classroom B', 15, '{\"Monday\": [\"08:00\", \"10:00\", \"12:00\", \"14:00\", \"16:00\", \"18:00\"], \"Thursday\": [\"08:00\", \"10:00\", \"12:00\", \"14:00\", \"16:00\", \"18:00\"], \"Saturday\": [\"08:00\", \"10:00\", \"12:00\", \"14:00\", \"16:00\", \"18:00\"]}'),
(3, 'Classroom C', 7, '{\"Tuesday\": [\"15:00\", \"16:00\", \"17:00\", \"18:00\", \"19:00\", \"20:00\", \"21:00\"], \"Friday\": [\"15:00\", \"16:00\", \"17:00\", \"18:00\", \"19:00\", \"20:00\", \"21:00\"], \"Saturday\": [\"15:00\", \"16:00\", \"17:00\", \"18:00\", \"19:00\", \"20:00\", \"21:00\"]}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
