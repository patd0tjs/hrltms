-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 04:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrltms`
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
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `s_date` date NOT NULL,
  `e_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id`, `emp_id`, `time_in`, `time_out`, `s_date`, `e_date`) VALUES
(33, 'delacruz', '09:00:00', '15:00:00', '2023-05-06', '2023-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `f_name`, `m_name`, `l_name`, `timestamp`) VALUES
('delacruz', 'Juan', 'Miguel', 'De La Cruz', '2023-04-01 15:03:53'),
('dfgshb', 'Ghjkgfzdfsxghj', 'Gfdzhjghkm', 'Dfghdfgshb Dfgs', '2023-04-01 15:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` varchar(255) NOT NULL,
  `id_pic` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `status` enum('Permanent','JO','Casual') NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `bday` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `purok` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `date_hired` date NOT NULL,
  `plantilla` varchar(255) DEFAULT NULL,
  `education` enum('Elementary','JHS','SHS','Bachelor''s Degree','Post Graduate') NOT NULL,
  `school` varchar(255) NOT NULL,
  `prc` varchar(255) DEFAULT NULL,
  `prc_reg` date DEFAULT NULL,
  `prc_exp` date DEFAULT NULL,
  `philhealth` varchar(255) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `marital_status` enum('Single','Married','Separated','Divorced','Widowed') NOT NULL,
  `gsis` varchar(255) DEFAULT NULL,
  `sss` varchar(255) DEFAULT NULL,
  `pag_ibig` varchar(255) DEFAULT NULL,
  `tin` int(11) NOT NULL,
  `atm` int(11) NOT NULL,
  `blood_type` enum('A+','A-','B+','B-','AB+','AB','O+','O-') NOT NULL,
  `email` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `id_pic`, `department_id`, `designation_id`, `status`, `sex`, `bday`, `birth_place`, `purok`, `brgy`, `municipality`, `province`, `zip`, `date_hired`, `plantilla`, `education`, `school`, `prc`, `prc_reg`, `prc_exp`, `philhealth`, `phone`, `marital_status`, `gsis`, `sss`, `pag_ibig`, `tin`, `atm`, `blood_type`, `email`, `remarks`, `region`) VALUES
('delacruz', 'http://localhost/hrltms/assets/img/id/daniel-leone-g30P1zcOzXo-unsplash.jpg', 16, 16, 'JO', 'Male', '1996-07-01', 'Sampaloc, Manila', 'Sdfg', 'Sfghdfsg', 'Sdfgsdfg', 'Sdfgsd', 67374, '2023-04-01', '0', 'Bachelor\'s Degree', 'Ust', '2147483647', '2023-04-03', '2023-04-27', '2147483647', 2147483647, 'Married', '2147483647', '2147483647', '23452345', 2147483647, 2147483647, 'B-', 'entertainment.pgbalanza@gmail.com', 'srtghsdfgetyjsrythsrghsw', NULL),
('dfgshb', 'http://localhost/hrltms/assets/img/id/339011341_1217352725579719_1353004476805906824_n.jpg', 16, 1, 'JO', 'Male', '2023-04-02', 'Gdhjddfszghjknd', 'Dfsghhfds', 'Hfdsgh', 'New Washington', 'Aklan', 67345634, '2023-04-04', '', 'JHS', 'Fgdhjdfdsg', '2147483647', '2023-04-05', '2023-04-03', '', 2, 'Married', '3', '4', '5', 6, 7, 'O+', 'gsdfg@maghsa.com', 'dfhghghs', NULL);

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
(14, 'dfgshb', 'approved', '2023-04-03', '2023-04-07', 'Vacation Leave', '2023-04-01 15:08:19', ''),
(15, 'delacruz', 'approved', '2023-04-01', '2023-05-04', 'Others', '2023-04-01 15:11:19', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` char(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `user_id`, `message`, `is_read`) VALUES
(1, 'delacruz', 'Your Social Privilege Leave has been declined', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `s_date` date DEFAULT NULL,
  `e_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `emp_id`, `time_in`, `time_out`, `s_date`, `e_date`) VALUES
(41, 'delacruz', '08:00:00', '17:00:00', '2023-05-06', '2023-05-06');

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

--
-- Dumping data for table `tardy`
--

INSERT INTO `tardy` (`id`, `emp_id`, `date`, `diff`) VALUES
(30, 'delacruz', '2023-05-06', '01:00:00');

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

--
-- Dumping data for table `undertime`
--

INSERT INTO `undertime` (`id`, `emp_id`, `date`, `diff`) VALUES
(23, 'delacruz', '2023-05-06', '02:00:00');

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
('admin', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'admin'),
('delacruz', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'emp'),
('dfgshb', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'emp');

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
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recovery_code`
--
ALTER TABLE `recovery_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tardy`
--
ALTER TABLE `tardy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `undertime`
--
ALTER TABLE `undertime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Constraints for table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `notif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`username`);

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
