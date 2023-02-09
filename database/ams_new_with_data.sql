-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 09, 2023 at 08:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--
CREATE DATABASE IF NOT EXISTS `ams` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ams`;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `att_id` int(11) NOT NULL,
  `att_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`att_id`, `att_name`) VALUES
(0, 'Absent'),
(3, 'Informed Leave'),
(1, 'Present'),
(2, 'Suspicious  ');

-- --------------------------------------------------------

--
-- Table structure for table `att_jsons`
--

DROP TABLE IF EXISTS `att_jsons`;
CREATE TABLE `att_jsons` (
  `att_json_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `att_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`att_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `att_jsons`
--

INSERT INTO `att_jsons` (`att_json_id`, `class_id`, `att_json`) VALUES
(2, 5, '{\"1\": 0, \"2\": 1, \"3\": 1, \"4\": 1, \"5\": 0}'),
(17, 20, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(20, 23, '{\"1\": 1, \"2\": 1, \"3\": 0, \"4\": 1, \"5\": 0}'),
(30, 33, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(31, 34, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(32, 36, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(33, 37, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(34, 38, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(35, 39, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(36, 40, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(37, 41, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(38, 42, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(39, 43, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(40, 44, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(41, 45, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(42, 46, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_code` varchar(5) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_code`, `date`, `subject_id`) VALUES
(5, 'ABCDE', '2022-12-31', 1),
(20, 'VFT9E', '2023-01-20', 3),
(23, 'mPn1y', '2023-01-23', 5),
(33, 'swolH', '2023-02-04', 1),
(34, '0u6tU', '2023-02-06', 1),
(36, 'KkTRG', '2023-02-06', 1),
(37, 'dmNFf', '2023-02-06', 5),
(38, 'GLDaY', '2023-02-06', 3),
(39, 'kCBry', '2023-02-06', 3),
(40, 'uontz', '2023-02-06', 3),
(41, 'YI0aV', '2023-02-06', 5),
(42, 'vCTR2', '2023-02-06', 1),
(43, '0fW2l', '2023-02-06', 5),
(44, 'BuT1U', '2023-02-06', 5),
(45, 'lRmNp', '2023-02-06', 5),
(46, 'LxwgJ', '2023-02-09', 5);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_fees` int(11) NOT NULL DEFAULT 0,
  `course_name` varchar(50) NOT NULL,
  `course_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table stores the information about courses';

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_fees`, `course_name`, `course_code`) VALUES
(1, 40000, 'Software Development', '1105ITSW'),
(2, 40000, 'Cyber Security', '1105ITCS');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table stores the information about Semesters';

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`) VALUES
(1, 'Sem 1'),
(2, 'Sem 2'),
(3, 'Sem 3'),
(4, 'Sem 4'),
(5, 'Sem 5'),
(6, 'Sem 6'),
(7, 'Sem 7'),
(8, 'Sem 8'),
(9, 'Sem 9'),
(10, 'Sem 10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`uid`, `student_id`, `roll_no`, `student_name`, `semester_id`, `course_id`) VALUES
(1, 1, 1, 'Het Parekh', 3, 1),
(2, 2, 2, 'Parth Banker', 3, 1),
(3, 3, 3, 'Soham Satvara', 3, 1),
(4, 4, 4, 'Devam Jaipal', 3, 1),
(5, 5, 5, 'Dhairya Vora', 3, 1),
(6, 6, 1, 'Khushi Mehta', 3, 2),
(7, 7, 2, 'Darshit Shah', 3, 2),
(8, 8, 3, 'Sohan Sharma', 3, 2),
(9, 9, 4, 'Somya Shah', 3, 2),
(10, 10, 5, 'Devanshi Shah', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `course_id`, `subject_code`, `semester_id`) VALUES
(1, 'Advanced Java Programing -I', 1, 'AJP-I', 3),
(2, 'Foundation Of Linux', 1, 'FL', 3),
(3, 'Database Administration', 1, 'DBA', 3),
(4, 'Data structures And Algorithms', 1, 'DSA', 3),
(5, 'Developing Windows Applications', 1, 'DWA', 3),
(6, 'Programming Using Python -I', 1, 'PUP-I', 3),
(7, 'Problem Solving Using C Programming', 2, 'PSCP', 3),
(8, 'Database Management System', 2, 'DMS', 3),
(9, 'Linux Administration', 2, 'LA', 3),
(10, 'Advanced Concepts Of Networking - I ', 2, 'ACN-I', 3),
(11, 'Fundamentals Of Storage Management', 2, 'FSM', 3),
(12, 'Installation & Configuration Of Server', 2, 'ICS', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sub_tech`
--

DROP TABLE IF EXISTS `sub_tech`;
CREATE TABLE `sub_tech` (
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_tech`
--

INSERT INTO `sub_tech` (`subject_id`, `teacher_id`) VALUES
(1, 1),
(2, 3),
(3, 2),
(5, 1),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`uid`, `teacher_id`, `teacher_name`) VALUES
(12, 1, 'Raveena'),
(13, 2, 'Hardik'),
(14, 3, 'Ashok'),
(15, 4, 'Dharmesh');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `subject_id`, `teacher_id`) VALUES
(9, 3, 2),
(13, 1, 1),
(14, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Het Parekh', 'het@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, '2023-01-13 04:59:23', '2023-01-13 04:59:23'),
(2, 'Parth Banker', 'parth@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(3, 'Soham Satvara', 'soham@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(4, 'Devam Jaipal', 'devam@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(5, 'Dhairya Vora', 'dhairya@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(6, 'Khushi Mehta', 'khushi@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(7, 'Darshit Shah', 'darshit@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(8, 'Sohan Sharma', 'sohan@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(9, 'Somya Shah', 'somya@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(10, 'Devanshi Shah', 'devanshi@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 3, NULL, NULL, NULL),
(12, 'Raveena Manghnani', 'raveena@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 2, NULL, NULL, NULL),
(13, 'Hardik Vyas', 'hardik@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 2, NULL, NULL, NULL),
(14, 'Ashok Vestiya', 'ashok@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 2, NULL, NULL, NULL),
(15, 'Dharmesh Wala', 'dharmesh@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 2, NULL, NULL, NULL),
(16, 'admin', 'admin@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD UNIQUE KEY `att_id` (`att_id`),
  ADD UNIQUE KEY `att_name` (`att_name`);

--
-- Indexes for table `att_jsons`
--
ALTER TABLE `att_jsons`
  ADD PRIMARY KEY (`att_json_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_code` (`class_code`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `sub_tech`
--
ALTER TABLE `sub_tech`
  ADD PRIMARY KEY (`subject_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `att_jsons`
--
ALTER TABLE `att_jsons`
  MODIFY `att_json_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `att_jsons`
--
ALTER TABLE `att_jsons`
  ADD CONSTRAINT `att_jsons_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`);

--
-- Constraints for table `sub_tech`
--
ALTER TABLE `sub_tech`
  ADD CONSTRAINT `sub_tech_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `sub_tech_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `templates_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
