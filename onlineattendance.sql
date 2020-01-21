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

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_dept`, `admin_gen`, `email`, `password`, `otp`) VALUES
(2, 'John di', 1, 'M', 'montoshrai666@gmail.com', 'bW8=', '1450194733'),
(3, 'baker', 1, 'M', 'bakerlang777@gmail.com', 'bW9udG9zaA==', ''),
(4, 'ritish', 1, 'M', 'sangyal.tmg@gmail.com', 'bW9udG9zaA==', '');

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

INSERT INTO `attendance_info` (`record_id`, `std_id`, `logbook_id`, `attended`, `atten_taken`) VALUES
(115, 112345, 11, 3, '2018-12-12'),
(116, 170441, 12, 2, '2018-12-13'),
(117, 112345, 13, 9, '2018-12-13');

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

INSERT INTO `course` (`course_id`, `course_name`, `duration`, `dept_id`) VALUES
(1, 'MCA', 0, 1),
(3, 'BCA', 0, 1),
(4, 'PGDCA', 0, 1),
(5, 'BscHNT', 0, 1),
(6, 'MTech', 0, 1),
(7, 'png', 0, 1);

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

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'Computer Science '),
(2, 'Music'),
(3, 'environment'),
(4, 'management');

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

INSERT INTO `faculty_info` (`faculty_id`, `faculty_name`, `dept`, `gender`, `email`, `otp`, `password`, `status`) VALUES
(1, 'MONTOSH', 1, 'M', 'montoshrai666@gmail.com', '398469935', 'bW9udG9zaA==', 1),
(2, 'Dahun', 3, 'M', 'montoshrai8@gmail.com', '', 'bW9udG9zaA==', 1);

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

INSERT INTO `faculty_subject` (`fsub_id`, `faculty_id`, `course_id`, `sub_id`, `std_batch`, `year_of_assign`, `session`) VALUES
(2, 1, 1, 2, 20182020, 2018, 2),
(3, 1, 2, 1, 20172018, 2019, 1),
(4, 1, 1, 2, 20172020, 2018, 2);

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

INSERT INTO `log_book` (`logbook_id`, `faculty_id`, `time_from`, `time_to`, `allowed_hr`, `course_id`, `sub_id`, `std_batch`, `total_class`, `date`, `sessions`) VALUES
(11, 1, '09:30', '12:30', '10:00', 1, 2, 20182020, 3, '2018-12-12', 2),
(12, 1, '15:00', '17:00', '15:00', 1, 2, 20172020, 2, '2018-12-13', 2),
(13, 1, '22:20', '12:30', '23:00', 1, 2, 20172020, 9, '2018-12-13', 2),
(14, 1, '10:20', '12:30', '11:00', 1, 2, 20172020, 2, '2018-12-13', 2),
(15, 1, '', '', '', 2, 1, 20172018, 0, '2019-02-24', 1),
(16, 1, '', '', '', 2, 1, 20172018, 0, '2019-08-09', 1);

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

INSERT INTO `student_info` (`std_id`, `std_name`, `std_dept`, `std_course`, `std_batch`, `std_gender`, `std_dob`) VALUES
(112345, 'hello', 1, 1, '20172019', 'M', '2018-11-01'),
(133455, 'sdfdxfgfch', 1, 1, '20172019', 'M', '2018-11-09'),
(150616, 'LN', 1, 3, '20172019', 'F', '1995-02-02'),
(170441, 'aoakum jamir', 1, 1, '20172019', 'M', '1994-07-31'),
(170458, 'kyntiew', 1, 1, '20172019', 'M', '2018-11-09'),
(170616, 'mo', 1, 1, '20172019', 'M', '2018-11-11'),
(170961, 'lolly', 1, 1, '20182020', 'M', '2018-11-03'),
(170999, 'hello', 1, 1, '20172020', 'M', '2018-12-07'),
(174545, 'Deingait lang pyrtuh', 1, 1, '20172019', 'M', '2018-11-14'),
(222222, 'huh', 1, 4, '20172019', 'M', '2018-12-02'),
(555555, 'hello', 1, 1, '20172019', 'M', '2018-11-15'),
(777777, 'hello', 1, 3, '20182020', 'M', '2018-12-15'),
(999999, 'baker', 1, 3, '20172019', 'M', '2018-12-15'),
(1702997, 'mjhxsa', 1, 4, '20172020', 'M', '2018-12-01');

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

INSERT INTO `subject` (`sub_id`, `sub_name`, `course_id`) VALUES
(2, 'c==', 1),
(3, 'Computer Graphic', 1),
(4, 'C++', 3),
(5, 'PHP', 1),
(6, 'j2ee', 1);

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
