-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 01:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Pediatric Department'),
(2, 'Surgery Department'),
(3, 'Internal Medicine'),
(4, 'Anesthesia Department'),
(5, 'Medical Department'),
(6, 'OB-Gyne Department'),
(7, 'Out-Patient Department'),
(8, 'ER Department'),
(9, 'Medical Records Section'),
(10, 'Billing Section'),
(11, 'Claims Section'),
(12, 'IT Section'),
(13, 'Cashiering Section'),
(14, 'Pharmacy Department'),
(15, 'Laboratory Department'),
(16, 'Radiologic Department'),
(17, 'Delivery/OR Department'),
(18, 'Dietary Section'),
(19, 'Supply Section'),
(20, 'Maintenance and Engineering Department'),
(21, 'Transport Section'),
(22, 'Nursing Service Section'),
(23, 'Human Resource Management Section');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`) VALUES
(1, 'Nurse I'),
(2, 'Nurse II'),
(3, 'Nurse III'),
(4, 'Nursing Attendant I'),
(5, 'Nursing Attendant II'),
(6, 'Chief Nurse'),
(7, 'Medical Technologist I'),
(8, 'Medical Technologist II'),
(9, 'Radiologist Technologist I'),
(10, 'Radiologist Technologist II'),
(11, 'Pharmacist I'),
(12, 'Pharmacist II'),
(13, 'Medical Officer III'),
(14, 'Medical Officer IV'),
(15, 'Medical Specialist II'),
(16, 'Chief of Clinics'),
(17, 'Chief of Hospital II'),
(18, 'Administrative Officer III'),
(19, 'Administrative Officer II'),
(20, 'Administrative Aide IV'),
(21, 'Administrative Aide III'),
(22, 'Administrative Aide I'),
(23, 'Administrative Assistant II'),
(24, 'Administrative Assistant I'),
(25, 'Social Welfare Officer I'),
(26, 'Midwife I'),
(27, 'Midwife II'),
(28, 'Nutritionist/Dietitian II'),
(29, 'Cook I'),
(30, 'Cook II'),
(31, 'Laundry Worker I'),
(32, 'Medical Equipment Technician I');

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `am_in` time DEFAULT NULL,
  `am_out` time DEFAULT NULL,
  `pm_in` time DEFAULT NULL,
  `pm_out` time DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` varchar(255) NOT NULL,
  `id_pic` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `status` enum('regular','irregular') NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `bday` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `purok` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `date_hired` date NOT NULL,
  `plantilla` int(11) NOT NULL,
  `education` enum('elem','jhs','shs','bachelors','post_grad') NOT NULL,
  `school` varchar(255) NOT NULL,
  `prc` int(11) DEFAULT NULL,
  `prc_reg` date DEFAULT NULL,
  `prc_exp` date DEFAULT NULL,
  `philhealth` int(11) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `marital_status` enum('single','married','separated','divorced','widowed') NOT NULL,
  `gsis` int(11) DEFAULT NULL,
  `sss` int(11) DEFAULT NULL,
  `pag_ibig` int(11) DEFAULT NULL,
  `tin` int(11) NOT NULL,
  `atm` int(11) NOT NULL,
  `blood_type` enum('A+','A-','B+','B-','AB+','AB','O+','O-') NOT NULL,
  `email` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  `s_date` date NOT NULL,
  `e_date` date NOT NULL,
  `nature` varchar(255) NOT NULL,
  `date_filed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tardy`
--

CREATE TABLE `tardy` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `diff` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `undertime`
--

CREATE TABLE `undertime` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `diff` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `type` enum('admin','emp') DEFAULT 'emp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pw`, `type`) VALUES
('admin', 'test', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designation_id` (`designation_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `tardy`
--
ALTER TABLE `tardy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `undertime`
--
ALTER TABLE `undertime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tardy`
--
ALTER TABLE `tardy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `undertime`
--
ALTER TABLE `undertime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtr`
--
ALTER TABLE `dtr`
  ADD CONSTRAINT `dtr_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`username`);

--
-- Constraints for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD CONSTRAINT `employee_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `employee_details_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`),
  ADD CONSTRAINT `employee_details_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `tardy`
--
ALTER TABLE `tardy`
  ADD CONSTRAINT `tardy_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `undertime`
--
ALTER TABLE `undertime`
  ADD CONSTRAINT `undertime_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
