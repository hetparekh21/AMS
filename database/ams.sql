-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2024 at 10:25 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.30

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

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `att_id` int NOT NULL,
  `att_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
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

CREATE TABLE `att_jsons` (
  `att_json_id` int NOT NULL,
  `class_id` int NOT NULL,
  `att_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

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
(67, 71, '{\"1\": 1, \"2\": 1, \"3\": 0, \"4\": 0, \"5\": 1}'),
(68, 72, '{\"1\": 1, \"2\": 1, \"3\": 0, \"4\": 1, \"5\": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int NOT NULL,
  `class_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date DEFAULT (curdate()),
  `subject_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(53, 'wkH2B', '2023-04-27', 5),
(71, 'ayHAT', '2024-11-13', 5),
(72, 'Ulfbr', '2024-11-13', 9);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semesters` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table stores the information about courses';

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

CREATE TABLE `dynamic_mappers` (
  `class_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `dynamic_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_11_12_103738_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `semesters` (
  `semester_id` int NOT NULL,
  `semester_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table stores the information about Semesters';

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('W3cKA0ubhocQc7W4ERsUp6AjKXELlDF2NEHZpkkl', 12, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmtRb0tGd2g2ZTU2ZmtZcUlNaEsydEdscXZrT3R0VVp1NkRCREduViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFjaGVyL2NsYXNzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1733331238);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `uid` bigint UNSIGNED NOT NULL,
  `student_id` int NOT NULL,
  `roll_no` int NOT NULL,
  `student_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `semester_id` int NOT NULL,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `subjects` (
  `subject_id` int NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `course_id` int DEFAULT NULL,
  `subject_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `semester_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `sub_tech` (
  `subject_id` int NOT NULL,
  `teacher_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_tech`
--

INSERT INTO `sub_tech` (`subject_id`, `teacher_id`) VALUES
(1, 1),
(5, 1),
(9, 1),
(2, 3),
(8, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sus`
--

CREATE TABLE `sus` (
  `id` int NOT NULL,
  `class_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(45) NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sus`
--

INSERT INTO `sus` (`id`, `class_code`, `ip`, `student_id`) VALUES
(1, 'Ulfbr', '10.21.8.189', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `uid` bigint UNSIGNED NOT NULL,
  `teacher_id` int NOT NULL,
  `teacher_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `templates` (
  `id` int NOT NULL,
  `subject_id` int NOT NULL,
  `teacher_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `subject_id`, `teacher_id`) VALUES
(9, 3, 2),
(16, 5, 1),
(17, 2, 3),
(18, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `dynamic_mappers`
--
ALTER TABLE `dynamic_mappers`
  ADD KEY `class_code` (`class_code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- Indexes for table `sus`
--
ALTER TABLE `sus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sus_ibfk_2` (`student_id`),
  ADD KEY `sus_ibfk_1` (`class_code`);

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
  MODIFY `att_json_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sus`
--
ALTER TABLE `sus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Constraints for table `sus`
--
ALTER TABLE `sus`
  ADD CONSTRAINT `sus_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `dynamic_mappers` (`class_code`),
  ADD CONSTRAINT `sus_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
