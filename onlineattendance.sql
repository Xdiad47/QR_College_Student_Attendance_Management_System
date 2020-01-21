-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 05:18 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` bigint(15) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_dept` bigint(15) NOT NULL,
  `admin_gen` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `otp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `attendance_info`
--

CREATE TABLE `attendance_info` (
  `record_id` bigint(15) NOT NULL,
  `std_id` bigint(15) NOT NULL,
  `logbook_id` bigint(15) NOT NULL,
  `attended` int(11) NOT NULL,
  `atten_taken` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` bigint(15) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `dept_id` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--



-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` bigint(15) NOT NULL,
  `dept_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--


-- --------------------------------------------------------

--
-- Table structure for table `faculty_info`
--

CREATE TABLE `faculty_info` (
  `faculty_id` bigint(15) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `dept` bigint(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `otp` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject`
--

CREATE TABLE `faculty_subject` (
  `fsub_id` bigint(15) NOT NULL,
  `faculty_id` bigint(15) NOT NULL,
  `course_id` bigint(15) NOT NULL,
  `sub_id` bigint(15) NOT NULL,
  `std_batch` bigint(15) NOT NULL,
  `year_of_assign` int(11) NOT NULL,
  `session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_subject`
--



-- --------------------------------------------------------

--
-- Table structure for table `log_book`
--

CREATE TABLE `log_book` (
  `logbook_id` bigint(15) NOT NULL,
  `faculty_id` bigint(15) NOT NULL,
  `time_from` text NOT NULL,
  `time_to` text NOT NULL,
  `allowed_hr` text NOT NULL,
  `course_id` bigint(15) NOT NULL,
  `sub_id` bigint(15) NOT NULL,
  `std_batch` bigint(15) NOT NULL,
  `total_class` int(11) NOT NULL,
  `date` date NOT NULL,
  `sessions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_book`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `std_id` bigint(15) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `std_dept` bigint(15) NOT NULL,
  `std_course` bigint(15) NOT NULL,
  `std_batch` text NOT NULL,
  `std_gender` varchar(2) NOT NULL,
  `std_dob` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` bigint(15) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `course_id` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK_departmentadmin_info` (`admin_dept`);

--
-- Indexes for table `attendance_info`
--
ALTER TABLE `attendance_info`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `FK_log_bookattendance_info` (`logbook_id`) USING BTREE,
  ADD KEY `FK_student_infoattendance_info` (`std_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `FK_departmentcourse` (`dept_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `faculty_info`
--
ALTER TABLE `faculty_info`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `FK_departmentfaculty_info` (`dept`);

--
-- Indexes for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  ADD PRIMARY KEY (`fsub_id`),
  ADD KEY `FK_faculty_subjectfaculty_info` (`faculty_id`);

--
-- Indexes for table `log_book`
--
ALTER TABLE `log_book`
  ADD PRIMARY KEY (`logbook_id`),
  ADD KEY `FK_faculty_infoattendance_info` (`faculty_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `FK_departmentstudent_info` (`std_dept`),
  ADD KEY `FK_coursestudent_info` (`std_course`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `subject_ibfk_1` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance_info`
--
ALTER TABLE `attendance_info`
  MODIFY `record_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty_info`
--
ALTER TABLE `faculty_info`
  MODIFY `faculty_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  MODIFY `fsub_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_book`
--
ALTER TABLE `log_book`
  MODIFY `logbook_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD CONSTRAINT `FK_departmentadmin_info` FOREIGN KEY (`admin_dept`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE;

--
-- Constraints for table `attendance_info`
--
ALTER TABLE `attendance_info`
  ADD CONSTRAINT `FK_log_bookattendance_info` FOREIGN KEY (`logbook_id`) REFERENCES `log_book` (`logbook_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_infoattendance_info` FOREIGN KEY (`std_id`) REFERENCES `student_info` (`std_id`) ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_departmentcourse` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculty_info`
--
ALTER TABLE `faculty_info`
  ADD CONSTRAINT `FK_departmentfaculty_info` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  ADD CONSTRAINT `FK_faculty_subjectfaculty_info` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_info` (`faculty_id`) ON UPDATE CASCADE;

--
-- Constraints for table `log_book`
--
ALTER TABLE `log_book`
  ADD CONSTRAINT `FK_faculty_infoattendance_info` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_info` (`faculty_id`) ON UPDATE CASCADE;

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `FK_coursestudent_info` FOREIGN KEY (`std_course`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_departmentstudent_info` FOREIGN KEY (`std_dept`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
