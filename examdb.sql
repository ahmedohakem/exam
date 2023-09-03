-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2023 at 11:40 AM
-- Server version: 8.1.0
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `exams`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `record_id` int NOT NULL,
  `student_sys_id` int NOT NULL,
  `q_id` int NOT NULL,
  `op_selected` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int NOT NULL,
  `e_faculty` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `e_year` int NOT NULL,
  `e_subject` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `e_date` date NOT NULL,
  `e_time` time NOT NULL,
  `e_duration_in_mint` int NOT NULL,
  `e_duration_in_format` time NOT NULL,
  `number_of_q` int NOT NULL,
  `e_full_mark` double NOT NULL,
  `exam_status` int NOT NULL DEFAULT '0' COMMENT '1 is Online, 0 is Offline',
  `import_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `q_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `op1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `op2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `op3` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `op4` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `op5` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `opv` varchar(5) NOT NULL,
  `q_mark` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_sys_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `student_sys_id` int NOT NULL,
  `session_start_date` date NOT NULL,
  `session_start_time` time NOT NULL,
  `session_end_date` date DEFAULT NULL,
  `session_end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_sys_id` int NOT NULL,
  `student_nusu_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `student_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `q_id` (`q_id`),
  ADD KEY `student_sys_id` (`student_sys_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_sys_id`,`exam_id`,`student_sys_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_sys_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_sys_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_sys_id` int NOT NULL AUTO_INCREMENT;
COMMIT;
