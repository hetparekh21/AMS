-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 07:23 AM
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
-- Database: `ams`
--
CREATE DATABASE IF NOT EXISTS `ams` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ams`;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `att_id` int(11) NOT NULL,
  `att_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `att_id` (`att_id`),
  UNIQUE KEY `att_name` (`att_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE IF NOT EXISTS `att_jsons` (
  `att_json_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `att_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`att_json`)),
  PRIMARY KEY (`att_json_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `att_jsons`
--

INSERT INTO `att_jsons` (`att_json_id`, `class_id`, `att_json`) VALUES
(2, 5, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 1, \"5\": 0}'),
(17, 20, '{\"1\": 0,\"2\": 0,\"3\": 0,\"4\": 0,\"5\": 0}'),
(20, 23, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(30, 33, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(31, 34, '{\"1\": 0, \"2\": 0, \"3\": 1, \"4\": 0, \"5\": 1}'),
(32, 36, '{\"1\": 0, \"2\": 1, \"3\": 0, \"4\": 0, \"5\": 0}'),
(33, 37, '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 1, \"5\": 1}'),
(34, 38, '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 0, \"5\": 0}'),
(35, 39, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(36, 40, '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 1, \"5\": 0}'),
(37, 41, '{\"1\": 0, \"2\": 1, \"3\": 1, \"4\": 1, \"5\": 1}'),
(38, 42, '{\"1\": 0, \"2\": 1, \"3\": 1, \"4\": 1, \"5\": 1}'),
(39, 43, '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 0, \"5\": 0}'),
(40, 44, '{\"1\": 0, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(41, 45, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 1, \"5\": 1}'),
(42, 46, '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 0, \"5\": 0}'),
(43, 47, '{\"1\": 0, \"2\": 1, \"3\": 0, \"4\": 0, \"5\": 1}'),
(45, 49, '{\"1\": 1, \"2\": 1, \"3\": 0, \"4\": 0, \"5\": 0}'),
(46, 50, '{\"1\": 1, \"2\": 0, \"3\": 1, \"4\": 1, \"5\": 1}'),
(47, 51, '{\"1\": 1, \"2\": 1, \"3\": 1, \"4\": 0, \"5\": 0}'),
(48, 52, '{\"6\": 1, \"7\": 1, \"8\": 1, \"9\": 0, \"10\": 0}'),
(49, 53, '{}');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(5) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_code` (`class_code`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(46, 'LxwgJ', '2023-02-09', 5),
(47, 'hgrLX', '2023-02-12', 1),
(49, 'xz5oe', '2023-02-13', 3),
(50, 'oirGp', '2023-02-14', 5),
(51, 'Srul6', '2023-02-15', 2),
(52, 'KAeB7', '2023-02-15', 8),
(53, 'wkH2B', '2023-04-27', 5);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(50) NOT NULL,
  `course_code` varchar(10) DEFAULT NULL,
  `semesters` tinyint(4) NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_code` (`course_code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table stores the information about courses';

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`, `semesters`) VALUES
(1, 'Software Development', '1105ITSW', 6),
(2, 'Cyber Security', '1105ITCS', 6);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_mappers`
--

DROP TABLE IF EXISTS `dynamic_mappers`;
CREATE TABLE IF NOT EXISTS `dynamic_mappers` (
  `class_code` varchar(5) NOT NULL,
  `dynamic_code` varchar(5) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  KEY `class_code` (`class_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynamic_mappers`
--

INSERT INTO `dynamic_mappers` (`class_code`, `dynamic_code`, `Timestamp`) VALUES
('ABCDE', '0KZL1', '2023-02-19 14:44:04'),
('ABCDE', 'LuW6Z', '2023-02-19 16:34:52'),
('ABCDE', 'yUmQh', '2023-02-20 04:37:34'),
('ABCDE', 'WgPpv', '2023-02-20 04:38:04'),
('ABCDE', 'uIxhZ', '2023-02-20 04:38:35'),
('ABCDE', 'cMBfQ', '2023-02-20 04:39:04'),
('ABCDE', '3o8aL', '2023-02-20 04:39:30'),
('ABCDE', 'TGZKY', '2023-02-20 04:40:00'),
('ABCDE', 'yA4wS', '2023-02-20 04:40:30'),
('ABCDE', 'pY7sQ', '2023-02-20 04:41:00'),
('ABCDE', '8yD7Q', '2023-02-20 04:41:30'),
('wkH2B', 'I2XBW', '2023-04-27 17:56:19'),
('wkH2B', 'XLogP', '2023-04-27 17:56:49'),
('wkH2B', 'V8f2N', '2023-04-27 17:57:19'),
('wkH2B', 'JbwQt', '2023-04-27 17:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE IF NOT EXISTS `semesters` (
  `semester_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester_name` varchar(20) NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table stores the information about Semesters';

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
CREATE TABLE IF NOT EXISTS `students` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `semester_id` (`semester_id`),
  KEY `course_id` (`course_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `subject_code` varchar(20) NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_code` (`subject_code`),
  KEY `course_id` (`course_id`),
  KEY `semester_id` (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `course_id`, `subject_code`, `semester_id`) VALUES
(1, 'Advanced Java Programing -I', 1, 'AJP-I', 2),
(2, 'Foundation Of Linux', 2, 'FL', 4),
(3, 'Database Administration', NULL, 'DBA', NULL),
(4, 'Data structures And Algorithms', NULL, 'DSA', NULL),
(5, 'Developing Windows Applications', 1, 'DWA', 1),
(6, 'Programming Using Python -I', 1, 'PUP-I', 2),
(7, 'Problem Solving Using C Programming', 2, 'PSCP', 1),
(8, 'Database Management System', 2, 'DMS', 3),
(9, 'Linux Administration', 1, 'LA', 3),
(10, 'Advanced Concepts Of Networking - I ', 2, 'ACN-I', 3),
(11, 'Fundamentals Of Storage Management', 2, 'FSM', 3),
(12, 'Installation & Configuration Of Server', 2, 'ICS', 3),
(13, 'Programming Using Python - II', 1, 'PUP-II', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sub_tech`
--

DROP TABLE IF EXISTS `sub_tech`;
CREATE TABLE IF NOT EXISTS `sub_tech` (
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`,`teacher_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_tech`
--

INSERT INTO `sub_tech` (`subject_id`, `teacher_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(5, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(30) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `subject_id`, `teacher_id`) VALUES
(9, 3, 2),
(16, 5, 1),
(17, 2, 3),
(18, 8, 3),
(19, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pass_` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `pass_`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'het@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, '2023-01-13 04:59:23', '2023-01-13 04:59:23'),
(2, 'parth@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(3, 'soham@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(4, 'devam@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(5, 'dhairya@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(6, 'khushi@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(7, 'darshit@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(8, 'sohan@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(9, 'somya@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(10, 'devanshi@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 3, NULL, NULL, NULL),
(12, 'raveena@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 2, NULL, NULL, NULL),
(13, 'hardik@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 2, NULL, NULL, NULL),
(14, 'ashok@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 2, NULL, NULL, NULL),
(15, 'dharmesh@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 2, NULL, NULL, NULL),
(16, 'admin@gmail.com', NULL, '$2y$10$jJRNYyuBptMB94N/81wYsuOVAxZU4P5tCo5SDoGVYVGcmfZo/F6p6', '12345678', 1, NULL, NULL, NULL);

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
-- Constraints for table `dynamic_mappers`
--
ALTER TABLE `dynamic_mappers`
  ADD CONSTRAINT `dynamic_mappers_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`);

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
