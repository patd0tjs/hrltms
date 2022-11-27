-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 03:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `f_name`, `m_name`, `l_name`) VALUES
('asda', 'dasdas', 'dasdasdasdas', 'asdas'),
('demo', 'dasdasd', 'asdasd', 'asdas'),
('itspatnotrick', 'Patrick', 'Capili', 'Balanza');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `id_pic`, `department_id`, `designation_id`, `status`, `sex`, `bday`, `birth_place`, `purok`, `brgy`, `municipality`, `province`, `zip`, `date_hired`, `plantilla`, `education`, `school`, `prc`, `prc_reg`, `prc_exp`, `philhealth`, `phone`, `marital_status`, `gsis`, `sss`, `pag_ibig`, `tin`, `atm`, `blood_type`, `email`, `remarks`) VALUES
('asda', 'http://localhost/hris/assets/img/null_pic.jpg', 2, 4, 'irregular', 'female', '2022-11-08', 'asdasd', 'asdasd', 'asdasd', 'dasdasd', 'asdasdas', 212312312, '2022-11-03', 234234, 'jhs', 'asdasdas', 2342342, '2022-11-22', '2022-11-30', 234234, 242342342, 'married', 3424234, 234234, 4234234, 2423423, 23423423, 'A+', 'balanzaairlines@gmail.com', ''),
('demo', 'http://localhost/hris/assets/img/null_pic.jpg', 2, 3, 'irregular', 'female', '2022-10-31', 'asd', 'fgasdfas', 'dfadsf', 'adsfsadfadsf', 'adsfasf', 345345, '2022-11-15', 453453, 'shs', 'dfgdfsfga', 3423424, '2022-11-27', '2022-11-24', 453453, 34534534, 'separated', 234324, 234234, 56456456, 45674565, 234123423, 'B+', 'pgbalanza@gmail.com', 'demo'),
('itspatnotrick', 'http://localhost/hris/assets/img/id/Joker-Wallpaper-For-PC.jpg', 1, 1, 'regular', 'male', '1999-08-25', 'Manila', '', '456', 'Manila', 'Manila', 23, '2022-07-18', 11234, 'elem', 'University of Santo Tomas', 12345, '2022-11-13', '2026-09-13', 11234, 2147483647, 'single', 1, 1, 1, 1, 1, 'A+', 'pgbalanza@gmail.com', 'full stack');

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
  `date_filed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `emp_id`, `status`, `s_date`, `e_date`, `nature`, `date_filed`, `reason`) VALUES
(10, 'itspatnotrick', 'approved', '2022-11-13', '2022-11-15', 'Others', '2022-11-27 14:12:25', 'lamay');

-- --------------------------------------------------------

--
-- Table structure for table `recovery_code`
--

CREATE TABLE `recovery_code` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `used` enum('Y','N') DEFAULT 'N',
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recovery_code`
--

INSERT INTO `recovery_code` (`id`, `user_id`, `expire`, `used`, `code`) VALUES
(1, '0', '2022-11-25 22:03:29', 'N', 7441),
(2, '0', '2022-11-25 21:55:07', 'N', 2023),
(3, '0', '2022-11-26 07:07:38', 'N', 3011),
(4, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 1239),
(5, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 9069),
(6, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 6335),
(7, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 3757),
(8, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 4108),
(9, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 5000),
(10, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 6139),
(11, 'itspatnotrick', '2022-11-26 08:22:57', 'Y', 1651),
(12, 'itspatnotrick', '2022-11-26 08:32:43', 'Y', 4132),
(13, 'itspatnotrick', '2022-11-27 12:21:38', 'Y', 1508);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `s_date` date DEFAULT NULL,
  `e_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `emp_id`, `date`, `time_in`, `time_out`, `s_date`, `e_date`) VALUES
(36, 'itspatnotrick', '0000-00-00', '22:25:00', '05:26:00', '2022-11-20', '2022-11-20'),
(37, 'itspatnotrick', '0000-00-00', '22:25:00', '05:26:00', '2022-11-20', '2022-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `tardy`
--

CREATE TABLE `tardy` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `diff` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `undertime`
--

CREATE TABLE `undertime` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `diff` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `type` enum('admin','emp') DEFAULT 'emp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pw`, `type`) VALUES
('admin', 'test', 'admin'),
('asda', 'password', 'emp'),
('demo', 'password', 'emp'),
('itspatnotrick', 'password', 'emp');

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
-- Indexes for table `recovery_code`
--
ALTER TABLE `recovery_code`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recovery_code`
--
ALTER TABLE `recovery_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
