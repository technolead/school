-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2007 at 07:37 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `work_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_fee_register`
--

CREATE TABLE IF NOT EXISTS `additional_fee_register` (
  `additional_fee_register_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `register_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`additional_fee_register_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `additional_fee_register`
--

INSERT INTO `additional_fee_register` (`additional_fee_register_id`, `class_map_id`, `section`, `description`, `register_date`, `user_id`, `is_delete`) VALUES
(1, 1, 'Section A', 'Picnic Fee', '2011-05-03', 1, 0),
(6, 1, 'Section A', 'School Dress Fee', '2011-05-04', 1, 0),
(7, 2, 'Section A', 'Library Fee', '2011-05-05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admission_fee_register`
--

CREATE TABLE IF NOT EXISTS `admission_fee_register` (
  `admission_fee_register_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `admission_fee` float NOT NULL DEFAULT '0',
  `register_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admission_fee_register_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admission_fee_register`
--

INSERT INTO `admission_fee_register` (`admission_fee_register_id`, `class_map_id`, `admission_fee`, `register_date`, `user_id`, `is_delete`) VALUES
(2, 1, 800, '2011-04-27', 1, 0),
(6, 2, 1000, '2011-05-04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `books_id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `serial_no` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `book_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `author` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `edition` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `publication` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `book_price` int(11) NOT NULL,
  `no_of_copies` int(11) NOT NULL,
  `available_copies` int(11) NOT NULL DEFAULT '0',
  `shelf_no` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `rack_no` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`books_id`),
  UNIQUE KEY `UK_Serial_No` (`serial_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`books_id`, `isbn`, `serial_no`, `category_id`, `book_name`, `author`, `edition`, `publication`, `book_price`, `no_of_copies`, `available_copies`, `shelf_no`, `rack_no`, `user_id`, `status`, `date_created`, `is_delete`) VALUES
(1, '123', '123', 1, 'Life and Lies of Albus Dumbledore', 'Rita Scitter', '1st', '2008', 120, 10, 6, '2', '1', 1, 'enabled', '2011-04-18 13:28:10', 0),
(2, '123', '456', 2, 'Ektu Khani Biggan', 'Md. Zafar Iqbal', '3rd', '2001', 120, 5, 3, '2', '3', 1, 'enabled', '2011-04-18 13:29:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books_category`
--

CREATE TABLE IF NOT EXISTS `books_category` (
  `books_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `des` text COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`books_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `books_category`
--

INSERT INTO `books_category` (`books_category_id`, `parent_id`, `category_name`, `des`, `status`, `date`, `is_delete`) VALUES
(1, 0, 'History', 'Historical Books', 'enabled', '2011-04-18 13:26:53', 0),
(2, 0, 'Science', 'Scientific Books', 'enabled', '2011-04-18 13:27:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_issued`
--

CREATE TABLE IF NOT EXISTS `book_issued` (
  `issued_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `books_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine_amount` float NOT NULL DEFAULT '0',
  `paid_amount` float NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`issued_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `book_issued`
--


-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `user_id`, `status`, `date`, `is_delete`) VALUES
(1, 'Main Branch', 1, 'enabled', '2011-04-18 12:30:45', 0),
(2, 'Secondary Branch', 1, 'enabled', '2011-04-18 12:31:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE latin1_general_ci NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `is_delete`) VALUES
('24d00605c813cde0defcdf416003143e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:2.0) Gecko/2010010', 1304846272, 'a:10:{s:7:"cur_uri";s:5:"/home";s:9:"branch_id";s:0:"";s:7:"user_id";s:1:"1";s:9:"user_name";s:5:"admin";s:10:"first_name";s:4:"SCMS";s:9:"last_name";s:13:"Administrator";s:9:"user_type";s:5:"admin";s:9:"logged_in";s:1:"1";s:16:"class_routine_id";s:1:"1";s:3:"msg";s:28:"Routine Added Successfully!!";}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `class_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_code`, `class_name`, `user_id`, `status`, `date`, `is_delete`) VALUES
(1, '0006', 'Class Six', 1, 'enabled', '2011-04-18 12:36:02', 0),
(2, '0011', '1st Year', 1, 'enabled', '2011-04-18 12:36:18', 0),
(3, '0007', 'Class Seven', 1, 'enabled', '2011-05-03 12:44:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_attendance`
--

CREATE TABLE IF NOT EXISTS `class_attendance` (
  `class_attendance_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `attendance_type_id` int(11) NOT NULL,
  `section` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `no_present` int(11) NOT NULL DEFAULT '0',
  `no_absent` int(11) NOT NULL DEFAULT '0',
  `no_leave` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class_attendance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `class_attendance`
--

INSERT INTO `class_attendance` (`class_attendance_id`, `class_map_id`, `attendance_type_id`, `section`, `date`, `no_present`, `no_absent`, `no_leave`, `user_id`, `is_delete`) VALUES
(1, 1, 9, 'Section A', '2011-05-03', 1, 1, 0, 1, 0),
(2, 1, 9, 'Section A', '2011-05-04', 1, 1, 0, 1, 0),
(3, 1, 9, 'Section A', '2011-05-05', 1, 1, 0, 1, 0),
(4, 2, 9, 'Section A', '2011-05-03', 2, 0, 0, 1, 0),
(5, 1, 9, 'Section A', '2011-05-07', 2, 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_fee_register`
--

CREATE TABLE IF NOT EXISTS `class_fee_register` (
  `class_fee_register_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `section` varchar(30) NOT NULL,
  `month` varchar(30) NOT NULL,
  `monthly_fee` float NOT NULL DEFAULT '0',
  `register_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class_fee_register_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `class_fee_register`
--

INSERT INTO `class_fee_register` (`class_fee_register_id`, `class_map_id`, `section`, `month`, `monthly_fee`, `register_date`, `user_id`, `is_delete`) VALUES
(1, 1, 'Section A', 'April', 100, '2011-04-01', 1, 0),
(2, 2, 'Section A', 'February', 200, '2011-04-27', 1, 0),
(3, 1, 'Section A', 'July', 100, '2011-04-27', 1, 0),
(4, 1, 'Section A', 'March', 100, '2011-03-01', 1, 0),
(5, 1, 'Section A', 'January', 100, '2011-04-27', 1, 0),
(6, 2, 'Section A', 'June', 200, '2011-05-03', 1, 0),
(7, 2, 'Section A', 'January', 200, '2011-05-03', 1, 0),
(8, 2, 'Section A', 'March', 200, '2011-05-04', 1, 0),
(9, 2, 'Section A', 'April', 200, '2011-05-04', 1, 0),
(10, 2, 'Section A', 'May', 200, '2011-05-04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_map`
--

CREATE TABLE IF NOT EXISTS `class_map` (
  `class_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `class_duration` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `start_date` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `end_date` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `class_fee` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `monthly_fee` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `exam_id` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class_map_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `class_map`
--

INSERT INTO `class_map` (`class_map_id`, `session_id`, `class_id`, `class_duration`, `start_date`, `end_date`, `class_fee`, `monthly_fee`, `staff_id`, `exam_id`, `status`, `user_id`, `is_delete`) VALUES
(1, 1, 1, '1 year', '2011-01-01', '2011-11-30', '800', '100', 1, '1,2,3', 'enabled', 1, 0),
(2, 1, 2, '1 year', '2011-01-01', '2011-11-29', '1000', '200', 2, '4,5', 'enabled', 1, 0),
(3, 1, 3, '1 year', '2011-01-03', '2011-11-03', '1000', '80', 1, '6', 'enabled', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `class_routine`
--

INSERT INTO `class_routine` (`class_routine_id`, `class_map_id`, `section`, `user_id`) VALUES
(1, 1, 'Section A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conf_status`
--

CREATE TABLE IF NOT EXISTS `conf_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status_for` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `conf_status`
--

INSERT INTO `conf_status` (`status_id`, `status_name`, `status_for`, `date`, `is_delete`) VALUES
(1, 'Active', 'STAFFS_STATUS', '2011-04-18 12:45:22', 0),
(2, 'Inactive', 'STAFFS_STATUS', '2011-04-18 12:45:30', 0),
(3, 'Excellent', 'REPORT_STATUS', '2011-04-18 13:20:33', 0),
(4, 'Good', 'REPORT_STATUS', '2011-04-18 13:20:42', 0),
(5, 'Poor', 'REPORT_STATUS', '2011-04-18 13:20:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `conf_type`
--

CREATE TABLE IF NOT EXISTS `conf_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `type_for` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `conf_type`
--

INSERT INTO `conf_type` (`type_id`, `type_name`, `type_for`, `date`, `is_delete`) VALUES
(1, 'Section A', 'SECTION', '2011-04-18 12:40:01', 0),
(2, 'Section B', 'SECTION', '2011-04-18 12:40:11', 0),
(3, 'Monthly', 'SALARY_TYPE', '2011-04-18 12:45:49', 0),
(4, 'Weekly', 'SALARY_TYPE', '2011-04-18 12:46:00', 0),
(5, 'Full Time', 'EMPLOYMENT_TYPE', '2011-04-18 12:46:39', 0),
(6, 'Part Time', 'EMPLOYMENT_TYPE', '2011-04-18 12:46:48', 0),
(7, 'Permanent', 'EMPLOYMENT_NATURE', '2011-04-18 12:49:23', 0),
(8, 'Temporary', 'EMPLOYMENT_NATURE', '2011-04-18 12:49:33', 0),
(9, 'Lecture', 'STD_ATTENDANCE', '2011-04-18 13:19:47', 0),
(10, 'Seminar', 'STD_ATTENDANCE', '2011-04-18 13:19:55', 0),
(11, 'First', 'SUBJECT_ATTEMPT', '2011-04-18 13:20:09', 0),
(12, 'Second', 'SUBJECT_ATTEMPT', '2011-04-18 13:20:18', 0),
(13, 'Cheque', 'PAY_MOOD', '2011-04-18 13:23:10', 0),
(14, 'Cash', 'PAY_MOOD', '2011-04-18 13:23:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `nationality` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `nationality`, `status`, `is_delete`) VALUES
(1, 'Bangladesh', 'Bangladeshi', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(255) NOT NULL,
  `exam_fee` float NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_name`, `exam_fee`, `user_id`, `date`, `is_delete`) VALUES
(1, 'Class Six First Term Exam', 1000, 1, '2011-04-18 12:41:06', 0),
(2, 'Class Six Half Yearly Exam', 1200, 1, '2011-04-18 12:41:24', 0),
(3, 'Class Six Annual Exam', 1300, 1, '2011-04-18 12:41:43', 0),
(4, '1st Year Final', 1200, 1, '2011-04-18 12:42:51', 0),
(5, '1st Year Mid Term', 900, 1, '2011-04-18 12:43:10', 0),
(6, 'Class Seven 1st Term Exam', 1000, 1, '2011-05-03 12:46:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_fee_register`
--

CREATE TABLE IF NOT EXISTS `exam_fee_register` (
  `exam_fee_register_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_map_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_fee` float NOT NULL DEFAULT '0',
  `register_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_fee_register_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `exam_fee_register`
--

INSERT INTO `exam_fee_register` (`exam_fee_register_id`, `class_map_id`, `exam_id`, `exam_fee`, `register_date`, `user_id`, `is_delete`) VALUES
(1, 1, 1, 1000, '2011-04-27', 1, 0),
(2, 1, 2, 1200, '2011-04-27', 1, 0),
(3, 1, 3, 1300, '2011-04-27', 1, 0),
(4, 2, 4, 1200, '2011-05-01', 1, 0),
(5, 2, 5, 900, '2011-05-03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exemption`
--

CREATE TABLE IF NOT EXISTS `exemption` (
  `exemption_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exemption_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exemption`
--

INSERT INTO `exemption` (`exemption_id`, `student_id`, `from_date`, `to_date`, `reason`, `user_id`, `is_delete`) VALUES
(1, 4, '2011-04-13', '2011-04-14', 'Cousin''s Wedding', 1, 0),
(2, 1, '2011-04-28', '2011-04-29', 'Fever', 1, 0),
(3, 4, '2011-05-05', '2011-05-07', 'Fever', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_title` varchar(255) NOT NULL,
  `exp_des` varchar(255) DEFAULT NULL,
  `exp_amount` double NOT NULL,
  `pay_mood` varchar(30) NOT NULL,
  `pay_details_id` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`expense_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `exp_title`, `exp_des`, `exp_amount`, `pay_mood`, `pay_details_id`, `exp_date`, `user_id`, `is_delete`) VALUES
(1, 'Class Decoration', 'Benches for class six', 5000, 'Cash', 3, '2011-05-01', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade_settings`
--

CREATE TABLE IF NOT EXISTS `grade_settings` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(10) NOT NULL,
  `grade_point` float NOT NULL,
  `marks_from` float NOT NULL,
  `marks_to` float NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `grade_settings`
--

INSERT INTO `grade_settings` (`grade_id`, `grade`, `grade_point`, `marks_from`, `marks_to`) VALUES
(71, 'A+', 5, 80, 100),
(72, 'A', 4, 75, 79),
(73, 'A-', 3.5, 70, 74),
(74, 'B+', 3.25, 65, 69),
(75, 'B', 3, 60, 64),
(76, 'B-', 2.75, 55, 59),
(77, 'C+', 2.5, 50, 54),
(78, 'C', 2.25, 45, 49),
(79, 'C-', 2, 40, 44),
(80, 'F', 0, 0, 39);

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE IF NOT EXISTS `letters` (
  `letters_id` int(11) NOT NULL AUTO_INCREMENT,
  `letters_type_id` int(11) NOT NULL,
  `letter_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `des` text COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`letters_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`letters_id`, `letters_type_id`, `letter_title`, `des`, `status`, `is_delete`) VALUES
(1, 1, '3 continuous class missed', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<p><span style="font-family: arial,helvetica,sans-serif; font-size: medium;">Dear $user_name</span>,</p>\n<p>This is to inform you that, you have missed three continuous academic class of $class_name.</p>\n<p>If you don''t show proper cause of these absence, you will be dismissed from the class.</p>\n<p>Thank you,</p>\n<p>$awarding_body_name</p>\n</body>\n</html>', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `letters_type`
--

CREATE TABLE IF NOT EXISTS `letters_type` (
  `letters_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`letters_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `letters_type`
--

INSERT INTO `letters_type` (`letters_type_id`, `title`, `status`, `date`, `is_delete`) VALUES
(1, 'Warning Letter', 'enabled', '2011-04-18 13:23:37', 0),
(2, 'Enrollment Letter', 'enabled', '2011-04-18 13:23:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `library_fine`
--

CREATE TABLE IF NOT EXISTS `library_fine` (
  `fine_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `days_permitted` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `fine_per_day` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fine_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `library_fine`
--


-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_code` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `module_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `marks` int(11) NOT NULL DEFAULT '100',
  `is_compulsary` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_code`, `module_name`, `marks`, `is_compulsary`, `user_id`, `status`, `date`, `is_delete`) VALUES
(1, 'BAN', 'Bangla', 100, 1, 1, 'enabled', '2011-04-18 12:37:00', 0),
(2, 'ENG', 'English', 100, 1, 1, 'enabled', '2011-04-18 12:37:18', 0),
(3, 'MAT', 'General Mathematics', 100, 1, 1, 'enabled', '2011-04-18 12:37:38', 0),
(4, 'phy-01', 'Physics 1st', 100, 1, 1, 'enabled', '2011-04-18 12:37:54', 0),
(5, 'CHE', 'Chemistry', 100, 1, 1, 'enabled', '2011-04-18 12:38:07', 0),
(6, 'HM', 'Higher Math', 75, 0, 1, 'enabled', '2011-04-18 12:38:21', 0),
(7, 'com-02', 'Computer', 100, 0, 1, 'enabled', '2011-04-18 12:38:35', 0),
(8, 'BIO', 'Biology', 75, 0, 1, 'enabled', '2011-04-18 12:39:07', 0),
(9, 'STA', 'Statistics', 100, 0, 1, 'enabled', '2011-04-18 12:39:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_distribution`
--

CREATE TABLE IF NOT EXISTS `module_distribution` (
  `distribution_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`distribution_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `module_distribution`
--

INSERT INTO `module_distribution` (`distribution_id`, `staffs_id`, `class_id`, `module_id`, `user_id`, `is_delete`) VALUES
(1, 2, 2, 4, 1, 0),
(2, 2, 2, 9, 1, 0),
(3, 1, 1, 1, 1, 0),
(4, 1, 1, 2, 1, 0),
(5, 1, 1, 6, 1, 0),
(6, 1, 2, 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_map`
--

CREATE TABLE IF NOT EXISTS `module_map` (
  `module_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_compulsary` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_map_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `module_map`
--

INSERT INTO `module_map` (`module_map_id`, `class_id`, `module_id`, `is_compulsary`, `user_id`, `status`, `date`, `is_delete`) VALUES
(1, 1, 1, 1, 1, 'enabled', '2011-04-18 13:10:14', 0),
(2, 1, 2, 1, 1, 'enabled', '2011-04-18 13:10:14', 0),
(3, 1, 3, 1, 1, 'enabled', '2011-04-18 13:10:14', 0),
(4, 1, 6, 0, 1, 'enabled', '2011-04-18 13:10:14', 0),
(5, 2, 8, 0, 1, 'enabled', '2011-04-18 13:11:25', 0),
(6, 2, 5, 1, 1, 'enabled', '2011-04-18 13:11:25', 0),
(7, 2, 4, 1, 1, 'enabled', '2011-04-18 13:11:25', 0),
(8, 2, 9, 0, 1, 'enabled', '2011-04-18 13:11:25', 0),
(9, 1, 7, 0, 1, 'enabled', '2011-04-18 13:12:04', 0),
(10, 3, 6, 0, 1, 'enabled', '2011-05-03 12:54:01', 0),
(11, 3, 5, 1, 1, 'enabled', '2011-05-03 12:54:01', 0),
(12, 3, 2, 1, 1, 'enabled', '2011-05-03 12:54:01', 0),
(13, 3, 3, 1, 1, 'enabled', '2011-05-03 12:54:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_material`
--

CREATE TABLE IF NOT EXISTS `module_material` (
  `module_material_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `staffs_id` int(11) NOT NULL,
  `lecture_notes` text COLLATE latin1_general_ci,
  `lecture_file` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `posted_date` date NOT NULL,
  `valid_until` date NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_material_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `module_material`
--

INSERT INTO `module_material` (`module_material_id`, `module_id`, `staffs_id`, `lecture_notes`, `lecture_file`, `file_name`, `posted_date`, `valid_until`, `status`, `is_delete`) VALUES
(1, 4, 2, 'this is test note', '1922799180_1304245375.txt', 'New Text Document (2).txt', '2011-05-01', '2011-05-31', 'enabled', 0),
(2, 1, 1, 'Kobita', '1808513742_1304245588.txt', 'pagination.txt', '2011-05-01', '2011-05-31', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_result`
--

CREATE TABLE IF NOT EXISTS `module_result` (
  `module_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_map_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `marks` double NOT NULL,
  `grade` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `final_marks` float NOT NULL,
  `final_grade` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `final_grade_point` float NOT NULL,
  `tutorial` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `attendance` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `attempt` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `result_status` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `module_result`
--

INSERT INTO `module_result` (`module_result_id`, `student_id`, `class_map_id`, `exam_id`, `session_id`, `module_id`, `exam_date`, `marks`, `grade`, `final_marks`, `final_grade`, `final_grade_point`, `tutorial`, `attendance`, `attempt`, `notes`, `result_status`, `user_id`, `date`, `is_delete`) VALUES
(1, 3, 1, 1, 1, 1, '2011-05-05', 60, 'B', 56, 'B-', 2.75, '14', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:05:43', 0),
(2, 10, 1, 1, 1, 1, '2011-05-05', 50, 'C+', 48, 'C', 2.25, '13', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:05:43', 0),
(3, 1, 1, 1, 1, 1, '2011-05-05', 90, 'A+', 86, 'A+', 5, '16', '7%', 'First', '', 'Passed', 1, '2011-05-05 17:08:15', 0),
(4, 7, 1, 1, 1, 1, '2011-05-05', 78, 'A', 71.6, 'A-', 3.5, '17', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:05:43', 0),
(8, 1, 1, 1, 1, 6, '2011-05-05', 75, 'A+', 77, 'A', 4, '', '7%', 'First', '', 'Passed', 1, '2011-05-05 18:06:23', 0),
(7, 3, 1, 1, 1, 6, '2011-05-05', 55, 'A-', 51.3333, 'C+', 2.5, '', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:43:43', 0),
(9, 3, 1, 1, 1, 2, '2011-05-05', 65, 'B+', 45.5, 'C', 2.25, '', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:55:21', 0),
(10, 10, 1, 1, 1, 2, '2011-05-05', 50, 'C+', 35, 'F', 0, '', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:55:21', 0),
(11, 1, 1, 1, 1, 2, '2011-05-05', 78, 'A', 61.6, 'B', 3, '', '7%', 'First', '', 'Passed', 1, '2011-05-05 17:55:21', 0),
(12, 7, 1, 1, 1, 2, '2011-05-05', 70, 'A-', 49, 'C', 2.25, '', '0%', 'First', '', 'Passed', 1, '2011-05-05 17:55:21', 0),
(13, 3, 1, 2, 1, 1, '2011-05-07', 70, 'A-', 49, 'C', 2.25, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:19:02', 0),
(14, 10, 1, 2, 1, 1, '2011-05-07', 50, 'C+', 35, 'F', 0, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:19:02', 0),
(15, 1, 1, 2, 1, 1, '2011-05-07', 78, 'A', 61.6, 'B', 3, '', '7%', 'First', '', 'Passed', 1, '2011-05-07 10:19:02', 0),
(16, 7, 1, 2, 1, 1, '2011-05-07', 75, 'A', 52.5, 'C+', 2.5, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:19:02', 0),
(17, 3, 1, 2, 1, 2, '2011-05-07', 78, 'A', 55, 'B-', 2.75, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:34:49', 0),
(18, 10, 1, 2, 1, 2, '2011-05-07', 60, 'B', 42, 'C-', 2, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:34:49', 0),
(19, 1, 1, 2, 1, 2, '2011-05-07', 81, 'A+', 64, 'B', 3, '', '7%', 'First', '', 'Passed', 1, '2011-05-07 10:34:49', 0),
(20, 7, 1, 2, 1, 2, '2011-05-07', 80, 'A+', 56, 'B-', 2.75, '', '0%', 'First', '', 'Passed', 1, '2011-05-07 10:34:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_id` int(11) NOT NULL,
  `notice_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `des` text COLLATE latin1_general_ci NOT NULL,
  `notice_type` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `priority` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `valid_until` date NOT NULL,
  `posted_date` date NOT NULL,
  `posted_to` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notice`
--


-- --------------------------------------------------------

--
-- Table structure for table `official_letter`
--

CREATE TABLE IF NOT EXISTS `official_letter` (
  `official_letter_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `letter_insert_type` varchar(20) NOT NULL,
  `letter_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `issue_date` date NOT NULL,
  PRIMARY KEY (`official_letter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `official_letter`
--

INSERT INTO `official_letter` (`official_letter_id`, `title`, `letter_insert_type`, `letter_url`, `description`, `issue_date`) VALUES
(1, 'Govt. Letter', 'upload', '990855536_1304758148.txt', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n\n</body>\n</html>', '2011-05-07'),
(2, 'Another Letter', 'description', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<p><span style="font-family: comic sans ms,sans-serif; font-size: small;">Hello Dear</span></p>\n<p><span style="font-family: comic sans ms,sans-serif; font-size: small;">Everybody is joining in the song, , fa la la , fa la la, tra la la , la la la</span></p>\n<p><span style="font-family: comic sans ms,sans-serif; font-size: small;">Mu hu ha ha ha<br /></span></p>\n</body>\n</html>', '2011-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE IF NOT EXISTS `payment_details` (
  `pay_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `details_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pay_details_for` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `pay_effect` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pay_details_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`pay_details_id`, `details_name`, `pay_details_for`, `pay_effect`, `status`, `is_delete`) VALUES
(1, 'Course Fee', 'STUDENT_PAYMENT', 'Credit', 'enabled', 0),
(2, 'Monthly Salary', 'STAFF_PAYMENT', 'Debit', 'enabled', 0),
(3, 'Expense', 'EXPENSE_PAYMENT', 'Debit', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` tinyint(4) NOT NULL DEFAULT '1',
  `branch` tinyint(4) NOT NULL DEFAULT '0',
  `grade` tinyint(4) NOT NULL DEFAULT '1',
  `marking` tinyint(4) NOT NULL DEFAULT '1',
  `alert` tinyint(4) NOT NULL DEFAULT '0',
  `ts_config` tinyint(4) NOT NULL DEFAULT '1',
  `student` tinyint(4) NOT NULL DEFAULT '1',
  `std_attendance` tinyint(4) NOT NULL DEFAULT '1',
  `exemption` tinyint(4) NOT NULL DEFAULT '0',
  `arv_attd` tinyint(4) NOT NULL DEFAULT '0',
  `print_attd` tinyint(4) NOT NULL DEFAULT '0',
  `absent` tinyint(4) NOT NULL DEFAULT '0',
  `counselling` tinyint(4) NOT NULL DEFAULT '0',
  `result` tinyint(4) NOT NULL DEFAULT '1',
  `std_account` tinyint(4) NOT NULL DEFAULT '1',
  `fee` tinyint(4) NOT NULL DEFAULT '1',
  `class_fee` tinyint(4) NOT NULL DEFAULT '0',
  `admission_fee` tinyint(4) NOT NULL DEFAULT '0',
  `exam_fee` tinyint(4) NOT NULL DEFAULT '0',
  `additional_fee` tinyint(4) NOT NULL DEFAULT '0',
  `level_fee` tinyint(4) NOT NULL DEFAULT '0',
  `fee_installment` tinyint(4) NOT NULL DEFAULT '0',
  `std_payment` tinyint(4) NOT NULL DEFAULT '0',
  `class` tinyint(4) NOT NULL DEFAULT '1',
  `level` tinyint(4) NOT NULL DEFAULT '1',
  `module` tinyint(4) NOT NULL DEFAULT '1',
  `session` tinyint(4) NOT NULL DEFAULT '1',
  `exam` tinyint(4) NOT NULL DEFAULT '0',
  `staffs` tinyint(4) NOT NULL DEFAULT '1',
  `staff_account` tinyint(4) NOT NULL DEFAULT '1',
  `staff_payment` tinyint(4) NOT NULL DEFAULT '0',
  `staff_balance` tinyint(4) NOT NULL DEFAULT '0',
  `staff_attendance` tinyint(4) NOT NULL DEFAULT '1',
  `agents` tinyint(4) NOT NULL DEFAULT '1',
  `agent_account` tinyint(4) NOT NULL DEFAULT '1',
  `agent_payment` tinyint(4) NOT NULL DEFAULT '0',
  `letters` tinyint(4) NOT NULL DEFAULT '1',
  `library` tinyint(4) NOT NULL DEFAULT '0',
  `up_history` tinyint(4) NOT NULL DEFAULT '0',
  `progress_rep` tinyint(4) NOT NULL DEFAULT '0',
  `std_report` tinyint(4) NOT NULL DEFAULT '0',
  `std_acc_report` tinyint(4) NOT NULL DEFAULT '0',
  `std_attd_rep` tinyint(4) NOT NULL DEFAULT '0',
  `account_rep` tinyint(4) NOT NULL DEFAULT '0',
  `letter_rep` tinyint(4) NOT NULL DEFAULT '0',
  `library_rep` tinyint(4) NOT NULL DEFAULT '0',
  `staff_report` tinyint(4) NOT NULL DEFAULT '0',
  `staff_acc_rep` tinyint(4) NOT NULL DEFAULT '0',
  `agent_report` tinyint(4) NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `user_id`, `user`, `branch`, `grade`, `marking`, `alert`, `ts_config`, `student`, `std_attendance`, `exemption`, `arv_attd`, `print_attd`, `absent`, `counselling`, `result`, `std_account`, `fee`, `class_fee`, `admission_fee`, `exam_fee`, `additional_fee`, `level_fee`, `fee_installment`, `std_payment`, `class`, `level`, `module`, `session`, `exam`, `staffs`, `staff_account`, `staff_payment`, `staff_balance`, `staff_attendance`, `agents`, `agent_account`, `agent_payment`, `letters`, `library`, `up_history`, `progress_rep`, `std_report`, `std_acc_report`, `std_attd_rep`, `account_rep`, `letter_rep`, `library_rep`, `staff_report`, `staff_acc_rep`, `agent_report`, `is_delete`) VALUES
(1, 9, 0, 3, 1, 1, 6, 1, 7, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prev_attd`
--

CREATE TABLE IF NOT EXISTS `prev_attd` (
  `attd_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `attd_date` date NOT NULL,
  `attd_attendance` varchar(255) NOT NULL,
  `attd_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prev_attd`
--

INSERT INTO `prev_attd` (`attd_id`, `student_id`, `class_id`, `attd_date`, `attd_attendance`, `attd_create`, `is_delete`) VALUES
(1, 1, 1, '2011-05-02', '80', '2011-05-03 17:30:56', 0),
(2, 3, 1, '2011-05-02', '77', '2011-05-03 17:30:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `print_attendance`
--

CREATE TABLE IF NOT EXISTS `print_attendance` (
  `print_attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `class_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `attendance_type` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `taken_by` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`print_attendance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_attendance`
--


-- --------------------------------------------------------

--
-- Table structure for table `progress_report`
--

CREATE TABLE IF NOT EXISTS `progress_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_map_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `attendance` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `punctuality` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `class_preparation` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `writing_skills` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `academic_performance` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `communication_skills` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `final_grade` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `final_grade_point` float NOT NULL,
  `result_status` tinyint(4) NOT NULL DEFAULT '0',
  `tutor_comment` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `suggestions` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `progress_report`
--

INSERT INTO `progress_report` (`report_id`, `student_id`, `class_map_id`, `exam_id`, `attendance`, `punctuality`, `class_preparation`, `writing_skills`, `academic_performance`, `communication_skills`, `final_grade`, `final_grade_point`, `result_status`, `tutor_comment`, `suggestions`, `date`, `user_id`, `is_delete`) VALUES
(1, 1, 1, 1, '66.67%', '1', '1', '2', '1', '1', 'A', 4.4375, 1, '', '', '2011-05-05 19:36:24', 1, 0),
(2, 1, 1, 2, '66.67%', '1', '1', '1', '1', '1', 'A', 4.43, 1, 'Hmm', '', '2011-05-07 10:39:15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reg_class`
--

CREATE TABLE IF NOT EXISTS `reg_class` (
  `reg_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_map_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `class_start_date` date NOT NULL,
  `class_end_date` date NOT NULL,
  `section` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT '0',
  `class_status` int(1) NOT NULL,
  `class_status_date` date NOT NULL,
  `class_comment` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `class_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_recent` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reg_class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `reg_class`
--

INSERT INTO `reg_class` (`reg_class_id`, `student_id`, `class_map_id`, `session_id`, `class_id`, `class_start_date`, `class_end_date`, `section`, `privilege`, `class_status`, `class_status_date`, `class_comment`, `user_id`, `class_reg_date`, `is_recent`, `is_delete`) VALUES
(1, 1, 1, 1, 1, '2011-01-01', '2011-11-30', 'Section A', 0, 1, '2011-05-04', '', 1, '2011-04-18 13:32:56', 1, 0),
(2, 3, 1, 1, 1, '2011-01-01', '2011-11-30', 'Section A', 0, 1, '2011-04-18', '', 1, '2011-04-18 13:41:18', 1, 0),
(3, 4, 2, 1, 2, '2011-01-01', '2011-11-30', 'Section A', 0, 1, '2011-04-18', '', 1, '2011-04-18 13:45:39', 1, 0),
(4, 5, 2, 1, 2, '2011-01-01', '2011-11-30', 'Section A', 0, 1, '2011-04-18', '', 1, '2011-04-18 13:48:25', 1, 1),
(5, 6, 2, 1, 2, '2011-01-01', '2011-11-29', 'Section A', 0, 1, '2011-05-03', '', 1, '2011-05-03 13:16:06', 1, 0),
(6, 7, 1, 1, 1, '2011-01-01', '2011-11-30', 'Section A', 2, 1, '2011-05-04', '', 1, '2011-05-04 10:52:18', 1, 0),
(7, 8, 2, 1, 2, '2011-01-01', '2011-11-29', 'Section A', 1, 1, '2011-05-04', '', 1, '2011-05-04 12:50:41', 1, 0),
(8, 9, 2, 1, 2, '2011-01-01', '2011-11-29', 'Section A', 2, 1, '2011-05-04', '', 1, '2011-05-04 15:33:38', 1, 0),
(9, 10, 1, 1, 1, '2011-01-01', '2011-11-30', 'Section A', 0, 1, '2011-05-04', '', 1, '2011-05-04 19:26:29', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reg_module`
--

CREATE TABLE IF NOT EXISTS `reg_module` (
  `reg_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_status` int(1) NOT NULL DEFAULT '1',
  `module_attempt` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `module_comment` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reg_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `reg_module`
--

INSERT INTO `reg_module` (`reg_module_id`, `student_id`, `class_id`, `session_id`, `module_id`, `module_status`, `module_attempt`, `module_comment`, `is_delete`) VALUES
(54, 1, 1, 1, 6, 1, 'First', '', 0),
(53, 1, 1, 1, 3, 1, 'First', '', 0),
(52, 1, 1, 1, 2, 1, 'First', '', 0),
(51, 1, 1, 1, 1, 1, 'First', '', 0),
(5, 3, 1, 1, 1, 1, 'First', '', 0),
(6, 3, 1, 1, 2, 1, 'First', '', 0),
(7, 3, 1, 1, 3, 1, 'First', '', 0),
(8, 3, 1, 1, 6, 1, 'First', '', 0),
(9, 4, 2, 1, 5, 1, 'First', '', 0),
(10, 4, 2, 1, 4, 1, 'First', '', 0),
(11, 4, 2, 1, 9, 1, 'First', '', 0),
(12, 5, 2, 1, 5, 1, 'First', '', 1),
(13, 5, 2, 1, 4, 1, 'First', '', 1),
(14, 5, 2, 1, 9, 1, 'First', '', 1),
(30, 7, 1, 1, 1, 1, 'First', '', 0),
(21, 6, 2, 1, 8, 1, 'First', '', 0),
(20, 6, 2, 1, 4, 1, 'First', '', 0),
(19, 6, 2, 1, 5, 1, 'First', '', 0),
(31, 7, 1, 1, 2, 1, 'First', '', 0),
(32, 7, 1, 1, 3, 1, 'First', '', 0),
(33, 7, 1, 1, 7, 1, 'First', '', 0),
(34, 8, 2, 1, 5, 1, 'First', '', 0),
(35, 8, 2, 1, 4, 1, 'First', '', 0),
(36, 8, 2, 1, 9, 1, 'First', '', 0),
(37, 9, 2, 1, 5, 1, 'First', '', 0),
(38, 9, 2, 1, 4, 1, 'First', '', 0),
(39, 9, 2, 1, 8, 1, 'First', '', 0),
(63, 10, 1, 1, 3, 1, 'First', '', 0),
(62, 10, 1, 1, 2, 1, 'First', '', 0),
(61, 10, 1, 1, 1, 1, 'First', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_status_mark`
--

CREATE TABLE IF NOT EXISTS `report_status_mark` (
  `report_status_mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_status` varchar(100) NOT NULL,
  `mark` float NOT NULL,
  PRIMARY KEY (`report_status_mark_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `report_status_mark`
--

INSERT INTO `report_status_mark` (`report_status_mark_id`, `report_status`, `mark`) VALUES
(1, 'Excellent', 80),
(2, 'Good', 70),
(3, 'Poor', 40);

-- --------------------------------------------------------

--
-- Table structure for table `routine_details`
--

CREATE TABLE IF NOT EXISTS `routine_details` (
  `routine_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_routine_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `period` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `module_id` int(11) NOT NULL,
  `staffs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`routine_details_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `routine_details`
--

INSERT INTO `routine_details` (`routine_details_id`, `class_routine_id`, `day`, `period`, `time`, `module_id`, `staffs_id`, `user_id`) VALUES
(16, 1, 'monday', '4th', '11am-12am', 1, 1, 1),
(15, 1, 'sunday', '2nd', '9am-10am', 2, 1, 1),
(14, 1, 'sunday', '1st', '8am-9am', 6, 1, 1),
(13, 1, 'saturday', '2nd', '9am-10am', 2, 1, 1),
(12, 1, 'saturday', '1st', '8am-9am', 1, 1, 1),
(17, 1, 'monday', '1st', '8am-9am', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_name`, `status`, `is_delete`) VALUES
(1, '2011', 'enabled', 0),
(2, '2012', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_flag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `key_value` mediumtext COLLATE latin1_general_ci NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `key_flag`, `key_value`, `is_delete`) VALUES
(1, 'contact_name', 'Sample School', 0),
(2, 'contact_address', 'Somewhere in the world', 0),
(3, 'contact_phone', '019...', 0),
(4, 'contact_mobile', '1932...', 0),
(5, 'contact_email', 'someschool@edu.com', 0),
(6, 'admin_email', 'admin@admin.com', 0),
(7, 'notify_email', 'no-reply@scms.com', 0),
(8, 'delete', '1', 0),
(9, 'con_start_1', '0', 0),
(10, 'con_start_2', '2', 0),
(11, 'con_start_3', '4', 0),
(12, 'con_end_1', '1', 0),
(13, 'con_end_2', '3', 0),
(14, 'con_end_3', 'N/A', 0),
(15, 'per_start_1', '80', 0),
(16, 'per_start_2', '60', 0),
(17, 'per_start_3', '0', 0),
(18, 'per_end_1', '100', 0),
(19, 'per_end_2', '79', 0),
(20, 'per_end_3', '59', 0),
(21, 'tutorial', '20', 0),
(22, 'attendance', '10', 0),
(23, 'final_exam', '70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_logo`
--

CREATE TABLE IF NOT EXISTS `site_logo` (
  `site_logo_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_logo` varchar(100) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_logo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_logo`
--

INSERT INTO `site_logo` (`site_logo_id`, `site_logo`, `is_delete`) VALUES
(1, '1055085360_1304252393.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `staffs_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gender` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `present_address` text COLLATE latin1_general_ci NOT NULL,
  `permanent_address` text COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `mobile` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `designation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `mpo_listed` tinyint(4) NOT NULL DEFAULT '0',
  `training_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `staff_status` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `status_change_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `nationality` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `marital_status` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ielts_score` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `qualification_verification` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `photograph` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `documents` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `comments` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staffs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staffs_id`, `user_id`, `user_name`, `title`, `gender`, `first_name`, `last_name`, `date_of_birth`, `present_address`, `permanent_address`, `phone`, `mobile`, `email`, `designation_id`, `department_id`, `mpo_listed`, `training_id`, `staff_status`, `status_change_date`, `branch_id`, `nationality`, `marital_status`, `ielts_score`, `qualification_verification`, `photograph`, `documents`, `comments`, `status`, `is_delete`) VALUES
(1, 1, 'SMS', 'School Teacer', 'Male', 'Saif', 'Shams', '1980-04-01', 'Some Address', '', '', '', 'saif@yahoo.com', 3, 2, 0, '2', 'Active', '2011-04-18', 1, 'Bangladeshi', 'Married', '', '', '741893506_1303109784.png', '1826478830_1303109784.txt', '', 'enabled', 0),
(2, 1, 'KEA', 'School Teacher', 'Male', 'Khondokar', 'Entenum', '1980-04-01', 'Some Address', '', '', '', 'tanvi.cse@yahoo.com', 2, 2, 1, '1,2', 'Active', '2011-04-18', 1, 'Bangladeshi', 'Single', '', '', '141518081_1303110244.png', '1609530721_1303110244.txt', '', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffs_attendance`
--

CREATE TABLE IF NOT EXISTS `staffs_attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `present` tinyint(4) NOT NULL DEFAULT '0',
  `absent` tinyint(4) NOT NULL DEFAULT '0',
  `sick` tinyint(4) NOT NULL DEFAULT '0',
  `holiday` tinyint(4) NOT NULL DEFAULT '0',
  `excuse` tinyint(4) NOT NULL DEFAULT '0',
  `hours` float NOT NULL DEFAULT '0',
  `extra_hour` float NOT NULL DEFAULT '0',
  `absent_hour` float NOT NULL DEFAULT '0',
  `late` float NOT NULL DEFAULT '0',
  `authorize` varchar(10) DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attendance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `staffs_attendance`
--

INSERT INTO `staffs_attendance` (`attendance_id`, `staffs_id`, `date`, `present`, `absent`, `sick`, `holiday`, `excuse`, `hours`, `extra_hour`, `absent_hour`, `late`, `authorize`, `comments`, `user_id`, `is_delete`) VALUES
(1, 2, '2011-04-30', 1, 0, 0, 0, 0, 4, 0, 0, 0, 'Yes', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_contract`
--

CREATE TABLE IF NOT EXISTS `staff_contract` (
  `staff_contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `admission_date` date DEFAULT NULL,
  `employ_type` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `employ_nature` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `employ_duration` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days_per_week` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `hours_per_week` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `salary_type` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `amount` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `ni_number` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `contract_comment` text COLLATE latin1_general_ci,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_contract_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_contract`
--

INSERT INTO `staff_contract` (`staff_contract_id`, `staffs_id`, `admission_date`, `employ_type`, `employ_nature`, `employ_duration`, `start_date`, `end_date`, `days_per_week`, `hours_per_week`, `salary_type`, `amount`, `ni_number`, `contract_comment`, `is_delete`) VALUES
(1, 1, '2011-01-01', 'Full Time', 'Permanent', '2 Years', '2011-01-01', '2013-06-30', '4', '16', 'Monthly', '7000', '8976543332', 'Entered', 0),
(2, 2, '2006-04-02', 'Full Time', 'Permanent', '', '0000-00-00', '0000-00-00', '', '', 'Monthly', '12000', '12345687', 'Assistant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_department`
--

CREATE TABLE IF NOT EXISTS `staff_department` (
  `staff_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_department`
--

INSERT INTO `staff_department` (`staff_department_id`, `name`, `status`, `is_delete`) VALUES
(1, 'Administration', 'enabled', 0),
(2, 'Academic', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_designation`
--

CREATE TABLE IF NOT EXISTS `staff_designation` (
  `staff_designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `mpo_scale` float NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_designation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `staff_designation`
--

INSERT INTO `staff_designation` (`staff_designation_id`, `designation`, `mpo_scale`, `user_id`, `date`) VALUES
(1, 'Head Master', 6500, 1, '2011-04-18 12:44:07'),
(2, 'Assistant Head Master', 5000, 1, '2011-04-18 12:44:23'),
(3, 'Lecturer', 5000, 1, '2011-04-18 12:44:37'),
(4, 'Assistant Professor', 7000, 1, '2011-04-18 12:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff_experience`
--

CREATE TABLE IF NOT EXISTS `staff_experience` (
  `exprience_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `duration_from` varchar(100) DEFAULT NULL,
  `duration_to` varchar(100) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `employer_details` varchar(255) DEFAULT NULL,
  `responsibilities` varchar(150) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exprience_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `staff_experience`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff_notice`
--

CREATE TABLE IF NOT EXISTS `staff_notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `posted_to` tinyint(4) NOT NULL DEFAULT '1',
  `priority` varchar(50) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `std_user_name` varchar(100) DEFAULT NULL,
  `valid_until` date NOT NULL,
  `posted_date` date NOT NULL,
  `staffs_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `staff_notice`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff_payment`
--

CREATE TABLE IF NOT EXISTS `staff_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `paid_date` date NOT NULL,
  `paid_amount` double NOT NULL,
  `mpo_amount` float NOT NULL DEFAULT '0',
  `pay_mood` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pay_details_id` int(11) NOT NULL,
  `month` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `year` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `dur_from_date` date NOT NULL,
  `dur_to_date` date NOT NULL,
  `purpose` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_payment`
--

INSERT INTO `staff_payment` (`payment_id`, `staffs_id`, `paid_date`, `paid_amount`, `mpo_amount`, `pay_mood`, `pay_details_id`, `month`, `year`, `dur_from_date`, `dur_to_date`, `purpose`, `user_id`, `is_delete`) VALUES
(1, 2, '2011-05-01', 12000, 5000, 'Cash', 2, '05', '2011', '0000-00-00', '0000-00-00', '', 1, 0),
(2, 1, '2011-05-07', 8000, 0, 'Cash', 2, '05', '2011', '0000-00-00', '0000-00-00', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_qualifications`
--

CREATE TABLE IF NOT EXISTS `staff_qualifications` (
  `staff_qualifications_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `qualification` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `awarding_body` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `year` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `grade` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_qualifications_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `staff_qualifications`
--

INSERT INTO `staff_qualifications` (`staff_qualifications_id`, `staffs_id`, `qualification`, `awarding_body`, `year`, `grade`, `is_delete`) VALUES
(33, 1, 'H.S.C', 'Dhaka College', '1995', 'A', 0),
(32, 1, 'B.Sc', 'Dhaka University', '2000', 'A', 0),
(31, 2, 'S.S.C', 'Dhaka College', '1993', 'A', 0),
(30, 2, 'H.S.C', 'Dhaka College', '1995', 'A', 0),
(28, 2, 'M.Sc', 'Harvard University', '2002', 'A', 0),
(29, 2, 'B.Sc', 'Dhaka University', '2000', 'A', 0),
(34, 1, 'S.S.C', 'Dhaka School', '1993', 'A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_shift`
--

CREATE TABLE IF NOT EXISTS `staff_shift` (
  `staff_shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `day_of_week` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `institution_id` int(11) NOT NULL,
  `from_time` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `to_time` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `shift` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_shift_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `staff_shift`
--

INSERT INTO `staff_shift` (`staff_shift_id`, `staffs_id`, `day_of_week`, `institution_id`, `from_time`, `to_time`, `shift`, `is_delete`) VALUES
(1, 1, 'Sunday', 0, '9am', '3pm', 1, 0),
(2, 1, 'Monday', 0, '9am', '3pm', 1, 0),
(3, 1, 'Tuesday', 0, '9am', '3pm', 1, 0),
(4, 1, 'Wednesday', 0, '9am', '3pm', 1, 0),
(5, 1, 'Thursday', 0, '9am', '3pm', 1, 0),
(6, 1, '', 0, '', '', 1, 0),
(7, 1, '', 0, '', '', 1, 0),
(27, 2, '', 0, '', '', NULL, 0),
(26, 2, 'Sunday', 0, '9am', '3pm', NULL, 0),
(25, 2, 'Monday', 0, '9am', '3pm', NULL, 0),
(24, 2, 'Tuesday', 0, '9am', '3pm', NULL, 0),
(23, 2, 'Wednesday', 0, '9am', '3pm', NULL, 0),
(22, 2, 'Thursday', 0, '9am', '3pm', NULL, 0),
(28, 2, '', 0, '', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_training`
--

CREATE TABLE IF NOT EXISTS `staff_training` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_title` varchar(255) NOT NULL,
  `increment` double NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_training`
--

INSERT INTO `staff_training` (`training_id`, `training_title`, `increment`, `user_id`) VALUES
(1, 'B.Ed', 2000, 1),
(2, 'BCS', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_additional_fee`
--

CREATE TABLE IF NOT EXISTS `std_additional_fee` (
  `additional_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `additional_fee_register_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee` double NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `paid_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`additional_fee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `std_additional_fee`
--

INSERT INTO `std_additional_fee` (`additional_fee_id`, `additional_fee_register_id`, `student_id`, `fee`, `is_paid`, `paid_date`, `user_id`, `is_delete`) VALUES
(1, 1, 1, 50, 1, '2011-05-04', 1, 0),
(2, 1, 3, 48, 1, '2011-05-03', 1, 0),
(6, 6, 1, 100, 1, '2011-05-04', 1, 0),
(5, 1, 7, 46, 1, '2011-05-04', 1, 0),
(7, 6, 3, 100, 1, '2011-05-04', 1, 0),
(8, 6, 7, 100, 0, '0000-00-00', 1, 0),
(9, 7, 4, 50, 1, '2011-05-05', 1, 0),
(10, 7, 6, 50, 0, '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_admission_fee`
--

CREATE TABLE IF NOT EXISTS `std_admission_fee` (
  `admission_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_fee_register_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee` float NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paid_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admission_fee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `std_admission_fee`
--

INSERT INTO `std_admission_fee` (`admission_fee_id`, `admission_fee_register_id`, `student_id`, `fee`, `is_paid`, `paid_date`, `user_id`, `is_delete`) VALUES
(17, 6, 8, 800, 0, '0000-00-00', 1, 0),
(3, 2, 1, 800, 1, '2011-04-27', 1, 0),
(5, 2, 3, 800, 1, '2011-05-01', 1, 0),
(16, 6, 6, 1000, 1, '2011-05-04', 1, 0),
(15, 6, 4, 1000, 1, '2011-05-04', 1, 0),
(8, 2, 7, 400, 1, '2011-05-04', 1, 0),
(18, 6, 9, 500, 1, '2011-05-04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_attendance`
--

CREATE TABLE IF NOT EXISTS `std_attendance` (
  `std_attendance_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class_attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(4) NOT NULL DEFAULT '0',
  `leave_excuse` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`std_attendance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `std_attendance`
--

INSERT INTO `std_attendance` (`std_attendance_id`, `class_attendance_id`, `student_id`, `attendance`, `leave_excuse`, `date`, `is_delete`) VALUES
(1, 1, 1, 1, 0, '2011-05-03', 0),
(2, 1, 3, 0, 0, '2011-05-03', 0),
(3, 2, 1, 1, 0, '2011-05-04', 0),
(4, 2, 3, 0, 0, '2011-05-04', 0),
(5, 3, 1, 0, 0, '2011-05-05', 0),
(6, 3, 3, 0, 0, '2011-05-05', 0),
(7, 4, 4, 1, 0, '2011-05-03', 0),
(8, 4, 6, 1, 0, '2011-05-03', 0),
(9, 5, 1, 1, 0, '2011-05-07', 0),
(10, 5, 3, 1, 0, '2011-05-07', 0),
(11, 5, 7, 0, 0, '2011-05-07', 0),
(12, 5, 10, 0, 0, '2011-05-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_class_fee`
--

CREATE TABLE IF NOT EXISTS `std_class_fee` (
  `class_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_fee_register_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee` float NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `fine` float NOT NULL DEFAULT '0',
  `paid_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class_fee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `std_class_fee`
--

INSERT INTO `std_class_fee` (`class_fee_id`, `class_fee_register_id`, `student_id`, `fee`, `is_paid`, `fine`, `paid_date`, `user_id`, `is_delete`) VALUES
(1, 1, 1, 0, 1, 10, '2011-04-01', 1, 0),
(2, 1, 3, 0, 0, 0, '0000-00-00', 1, 0),
(3, 4, 1, 0, 1, 0, '2011-03-01', 1, 0),
(4, 5, 1, 100, 1, 0, '2011-04-27', 1, 0),
(5, 2, 4, 0, 1, 0, '2011-05-01', 1, 0),
(6, 6, 4, 0, 1, 0, '2011-05-03', 1, 0),
(7, 6, 6, 0, 1, 0, '2011-05-03', 1, 0),
(8, 7, 4, 200, 1, 0, '2011-05-03', 1, 0),
(9, 7, 6, 200, 1, 0, '2011-05-03', 1, 0),
(10, 2, 6, 0, 1, 0, '2011-05-03', 1, 0),
(11, 5, 3, 100, 0, 0, '0000-00-00', 1, 0),
(12, 5, 7, 50, 1, 0, '2011-05-04', 1, 0),
(13, 7, 8, 0, 1, 0, '2011-05-04', 1, 0),
(14, 8, 4, 200, 1, 0, '2011-05-04', 1, 0),
(15, 8, 6, 200, 1, 0, '2011-05-04', 1, 0),
(16, 8, 8, 0, 1, 0, '2011-05-04', 1, 0),
(17, 7, 9, 100, 1, 0, '2011-05-04', 1, 0),
(18, 2, 9, 100, 1, 10, '2011-05-04', 1, 0),
(19, 9, 4, 200, 1, 5, '2011-05-04', 1, 0),
(20, 9, 6, 200, 1, 0, '2011-05-04', 1, 0),
(21, 9, 8, 0, 1, 0, '2011-05-04', 1, 0),
(22, 9, 9, 100, 1, 0, '2011-05-04', 1, 0),
(23, 8, 9, 100, 1, 0, '2011-05-04', 1, 0),
(24, 10, 4, 200, 0, 0, '0000-00-00', 1, 0),
(25, 10, 6, 200, 1, 0, '2011-05-04', 1, 0),
(26, 10, 8, 200, 0, 0, '0000-00-00', 1, 0),
(27, 10, 9, 200, 0, 0, '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_con_absent`
--

CREATE TABLE IF NOT EXISTS `std_con_absent` (
  `absent_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_map_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `absent` int(11) NOT NULL,
  `is_recent` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`absent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `std_con_absent`
--

INSERT INTO `std_con_absent` (`absent_id`, `student_id`, `class_map_id`, `from_date`, `to_date`, `absent`, `is_recent`, `is_delete`) VALUES
(10, 1, 1, '2011-05-03', '2011-05-05', 1, 0, 0),
(12, 3, 1, '2011-05-03', '2011-05-05', 3, 0, 0),
(8, 4, 2, '2011-05-03', '2011-05-03', 0, 1, 0),
(9, 6, 2, '2011-05-03', '2011-05-03', 0, 1, 0),
(11, 1, 1, '2011-05-07', '2011-05-07', 0, 1, 0),
(13, 3, 1, '2011-05-07', '2011-05-07', 0, 1, 0),
(14, 7, 1, '2011-05-07', '2011-05-07', 1, 1, 0),
(15, 10, 1, '2011-05-07', '2011-05-07', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_exam_fee`
--

CREATE TABLE IF NOT EXISTS `std_exam_fee` (
  `exam_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_fee_register_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `paid_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_fee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `std_exam_fee`
--

INSERT INTO `std_exam_fee` (`exam_fee_id`, `exam_fee_register_id`, `student_id`, `is_paid`, `paid_date`, `user_id`, `is_delete`) VALUES
(1, 1, 1, 1, '2011-04-27', 1, 0),
(2, 1, 3, 1, '2011-04-27', 1, 0),
(3, 2, 1, 1, '2011-04-27', 1, 0),
(4, 3, 1, 1, '2011-04-27', 1, 0),
(5, 4, 4, 0, '0000-00-00', 1, 0),
(6, 5, 4, 1, '2011-05-03', 1, 0),
(7, 5, 6, 1, '2011-05-03', 1, 0),
(8, 4, 6, 1, '2011-05-03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_qualifications`
--

CREATE TABLE IF NOT EXISTS `std_qualifications` (
  `std_qualifications_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `qualification` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `awarding_body` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `year` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `grade` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`std_qualifications_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `std_qualifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `gender` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `present_address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `permanent_address` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `admission_date` date NOT NULL,
  `student_status` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `std_status_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `nationality` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `marital_status` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `doc_submitted` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `photograph` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `doc_certificates` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `doc_required` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  `is_regular` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `user_name`, `title`, `gender`, `first_name`, `last_name`, `date_of_birth`, `present_address`, `permanent_address`, `phone`, `mobile`, `email`, `admission_date`, `student_status`, `std_status_date`, `branch_id`, `nationality`, `marital_status`, `doc_submitted`, `photograph`, `doc_certificates`, `doc_required`, `comments`, `date`, `status`, `is_online`, `is_regular`, `is_delete`) VALUES
(1, 1, 'neela', 'High School Student', 'Female', 'Mahjabeen', 'Akter', '1986-03-18', 'Somewhere', '', '', '', '', '2011-01-01', 'Active', '2011-04-18', 1, 'Bangladeshi', 'Single', '1,2', '1169935670_1303111976.png', '612179707_1303111976.txt', '', '', '2011-04-18 13:32:56', 'enabled', 0, 1, 0),
(3, 1, 'holy', 'High School Student', 'Female', 'Ghori', 'Nazmun Nahar', '1986-04-20', 'Somewhere', '', '', '', '', '2011-01-01', 'Active', '2011-03-21', 1, 'Bangladeshi', 'Single', '1,2', '1210213770_1303112478.png', '1379609919_1303112478.txt', '', '', '2011-04-18 13:41:18', 'enabled', 0, 1, 0),
(4, 1, 'himel', 'College Student', 'Male', 'Mahbub', 'Alam Khan', '1986-05-31', 'Somewhere', '', '', '', '', '2011-01-01', 'Active', '2011-04-18', 2, 'Bangladeshi', 'Single', '1,2', '1878551146_1303112739.png', '1515541198_1303112739.txt', '', '', '2011-04-18 13:45:39', 'enabled', 0, 1, 0),
(5, 1, 'tomal', 'College Student', 'Male', 'Tomal', 'Kanti Gosh', '1986-08-01', 'Somewhere', '', '', '', '', '2011-01-01', 'Active', '2011-04-18', 2, 'Bangladeshi', 'Single', '1,2', '1890307873_1303112905.png', '1746096614_1303112905.txt', '', '', '2011-04-18 13:48:25', 'enabled', 0, 1, 1),
(6, 1, 'sheuli', 'Miss', 'Female', 'Tohurun', 'Sheuli', '1986-01-19', 'Dhaka', '', '', '', '', '2011-02-01', 'Active', '2011-05-03', 1, 'Bangladeshi', 'Single', '1', '38085603_1304406966.png', '', '', '', '2011-05-03 13:16:06', 'enabled', 0, 1, 0),
(7, 1, 'ruby', 'Miss', 'Female', 'Ruby', 'Paul', '1986-12-02', 'Dhaka', '', '', '', '', '2011-01-01', 'Active', '2011-05-04', 1, 'Bangladeshi', 'Single', '1', '1149941755_1304484738.png', '', '', '', '2011-05-04 10:52:18', 'enabled', 0, 1, 0),
(8, 1, 'alamin', 'Mr', 'Male', 'Alamin', 'Sorkar', '1986-07-17', 'Dhaka', '', '', '', '', '2011-01-01', 'Active', '2011-05-04', 1, 'Bangladeshi', 'Single', '1', '1321789224_1304491841.png', '', '', '', '2011-05-04 12:50:41', 'enabled', 0, 1, 0),
(9, 1, 'mitu', 'Miss', 'Female', 'Rukhsana', 'Jahan', '1986-05-01', 'Sylhet', '', '', '', '', '2011-01-01', 'Active', '2011-05-04', 1, 'Bangladeshi', 'Single', '1', '1263936582_1304501618.png', '', '', '', '2011-05-04 15:33:38', 'enabled', 0, 1, 0),
(10, 1, 'keya', 'Miss', 'Female', 'Najmun', 'Nahar', '1986-04-19', 'Dhaka', '', '012354656', '', '', '2011-01-01', 'Active', '2011-05-04', 1, 'Bangladeshi', 'Single', '1', '1857417460_1304515589.png', '', '', '', '2011-05-04 19:26:29', 'enabled', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_letters`
--

CREATE TABLE IF NOT EXISTS `student_letters` (
  `student_letters_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `letters_id` int(11) NOT NULL,
  `letter_des` text COLLATE latin1_general_ci,
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view_status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'false',
  `is_recent` tinyint(4) NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_letters_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_letters`
--

INSERT INTO `student_letters` (`student_letters_id`, `user_id`, `student_id`, `session_id`, `letters_id`, `letter_des`, `issue_date`, `view_status`, `is_recent`, `is_delete`) VALUES
(1, 1, 3, 1, 1, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<p><span style="font-family: arial,helvetica,sans-serif; font-size: medium;">Dear $user_name</span>,</p>\n<p>This is to inform you that, you have missed three continuous academic class of $class_name.</p>\n<p>If you don''t show proper cause of these absence, you will be dismissed from the class.</p>\n<p>Thank you,</p>\n<p>$awarding_body_name</p>\n</body>\n</html>', '2011-04-18 00:00:00', 'false', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_parent_info`
--

CREATE TABLE IF NOT EXISTS `student_parent_info` (
  `parent_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `parent_address` text NOT NULL,
  `parent_phone` varchar(30) NOT NULL,
  `legal_guardian_name` varchar(100) NOT NULL,
  `legal_guardian_address` text NOT NULL,
  `legal_guardian_phone` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`parent_info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `student_parent_info`
--

INSERT INTO `student_parent_info` (`parent_info_id`, `student_id`, `father_name`, `mother_name`, `parent_address`, `parent_phone`, `legal_guardian_name`, `legal_guardian_address`, `legal_guardian_phone`, `user_id`, `date`, `is_delete`) VALUES
(1, 1, 'Atiqur Rahman Chowdhury', 'Surayia Akter', 'Tilagor', '01711645856', '', '', '', 1, '2011-04-18 13:32:56', 0),
(3, 3, 'Uncle', 'Aunty', 'MejorTila', '01711645856', '', '', '', 1, '2011-04-18 13:41:18', 0),
(8, 4, 'Baba', 'Ma', 'Dhaka', '01711645856', '', '', '', 1, '2011-05-03 13:13:49', 0),
(5, 5, 'Uncle', 'Aunty', 'Somewhere', '01711645856', '', '', '', 1, '2011-04-18 13:48:25', 1),
(9, 6, 'Uncle', 'Aunty', 'Comilla', '01711645856', '', '', '', 1, '2011-05-03 13:16:06', 0),
(12, 7, 'Ruby''s Father', 'Ruby''s Mother', 'Mymansing', '1111111', '', '', '', 1, '2011-05-04 12:49:00', 0),
(13, 8, 'Alamin Pita', 'Alamin Mata', 'Shirajgong', '0123654', '', '', '', 1, '2011-05-04 12:50:41', 0),
(14, 9, 'Mitur baba', 'Mitur Ma', 'Sylhet', '111111', '', '', '', 1, '2011-05-04 15:33:38', 0),
(16, 10, 'Keya Pita', 'Keya Mata', 'Dhaka', '21564654', '', '', '', 1, '2011-05-04 19:26:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_result`
--

CREATE TABLE IF NOT EXISTS `tutorial_result` (
  `tutorial_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_map_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `tutorial_date` date NOT NULL,
  `total_marks` double NOT NULL,
  `obtained_marks` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tutorial_result_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tutorial_result`
--

INSERT INTO `tutorial_result` (`tutorial_result_id`, `student_id`, `class_map_id`, `exam_id`, `module_id`, `description`, `tutorial_date`, `total_marks`, `obtained_marks`, `user_id`, `date`, `is_delete`) VALUES
(1, 3, 1, 1, 1, 'Term Test 1', '2011-05-05', 10, 7.5, 1, '2011-05-05 13:43:28', 0),
(2, 10, 1, 1, 1, 'Term Test 1', '2011-05-05', 10, 6, 1, '2011-05-05 12:24:30', 0),
(3, 1, 1, 1, 1, 'Term Test 1', '2011-05-05', 10, 7, 1, '2011-05-05 12:24:30', 0),
(4, 7, 1, 1, 1, 'Term Test 1', '2011-05-05', 10, 9, 1, '2011-05-05 12:24:30', 0),
(5, 3, 1, 1, 1, 'Term Test 2', '2011-05-06', 10, 6, 1, '2011-05-05 12:26:33', 0),
(6, 10, 1, 1, 1, 'Term Test 2', '2011-05-06', 10, 7, 1, '2011-05-05 12:26:33', 0),
(7, 1, 1, 1, 1, 'Term Test 2', '2011-05-06', 10, 9, 1, '2011-05-05 12:26:33', 0),
(8, 7, 1, 1, 1, 'Term Test 2', '2011-05-06', 10, 8, 1, '2011-05-05 12:26:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `designation` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `joining_date` date NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'enabled',
  `last_login` datetime NOT NULL,
  `user_type` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `forgot_password_verify` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `designation`, `joining_date`, `status`, `last_login`, `user_type`, `forgot_password_verify`, `date`, `is_delete`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'SCMS', 'Administrator', 'someemail@somedomain.com', 'Admin', '0000-00-00', 'enabled', '2009-12-27 09:10:36', 'admin', 'abcbbed70bb08fb850e72889db161315', '2010-02-26 23:39:08', 0),
(2, 'SMS', '4cecb21b44628b17c436739bf6301af2', 'Saif', 'Shams', 'saif@yahoo.com', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'staffs', NULL, '2011-04-18 12:56:24', 0),
(3, 'KEA', '7dcbc7f9baa8ee951141a082f98be6de', 'Khondokar', 'Entenum', 'tanvi.cse@yahoo.com', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'staffs', NULL, '2011-04-18 13:04:04', 0),
(4, 'neela', 'fff4dca67f359752ed6739334477664a', 'Mahjabeen', 'Akter', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-04-18 13:32:56', 0),
(6, 'holy', 'ff0eca571f7670efa4ac4a2c37214c6b', 'Ghori', 'Nazmun Nahar', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-04-18 13:41:18', 0),
(7, 'himel', '9805170e5646d4c938412a267f52e428', 'Mahbub', 'Alam Khan', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-04-18 13:45:39', 0),
(8, 'tomal', '9b89b7713fd72002f29be0c1fc3ff445', 'Tomal', 'Kanti Gosh', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-04-18 13:48:25', 0),
(9, 'ash', '2852f697a9f8581725c6fc6a5472a2e5', 'Ashraful', 'Alom', 'ashraful@flammabd.com', 'Co Administrator', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'admin', NULL, '2011-04-18 19:21:12', 0),
(10, 'sheuli', 'ed9098825c40bf1afb1bc022f121862b', 'Tohurun', 'Sheuli', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-05-03 13:16:06', 0),
(11, 'ruby', '58e53d1324eef6265fdb97b08ed9aadf', 'Ruby', 'Paul', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-05-04 10:52:18', 0),
(12, 'alamin', 'd061f4891bd39deb65390f62677c38d1', 'Alamin', 'Sorkar', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-05-04 12:50:41', 0),
(13, 'mitu', 'ea9ea0a2d0440da76c2aff574c2f07b5', 'Rukhsana', 'Jahan', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-05-04 15:33:38', 0),
(14, 'keya', '74378b19b736af202de0a80ec489697e', 'Najmun', 'Nahar', '', '', '0000-00-00', 'enabled', '0000-00-00 00:00:00', 'student', NULL, '2011-05-04 19:26:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(20) DEFAULT NULL,
  `is_recent` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`user_log_id`, `user_id`, `login`, `logout`, `ip_address`, `is_recent`, `is_delete`) VALUES
(1, 1, '2011-04-18 12:20:56', '2011-04-18 12:29:07', '127.0.0.1', 0, 0),
(2, 1, '2011-04-18 12:29:14', '2011-04-18 12:29:26', '127.0.0.1', 0, 0),
(3, 1, '2011-04-18 12:29:32', '2011-04-18 13:18:28', '127.0.0.1', 0, 0),
(4, 1, '2011-04-18 13:18:34', '2011-04-18 13:19:04', '127.0.0.1', 0, 0),
(5, 1, '2011-04-18 13:19:09', '2011-04-18 18:15:10', '127.0.0.1', 0, 0),
(6, 1, '2011-04-18 18:14:45', '2011-04-18 18:15:10', '127.0.0.1', 0, 0),
(7, 1, '2011-04-18 18:16:49', '2011-04-18 18:23:23', '127.0.0.1', 0, 0),
(8, 1, '2011-04-18 18:23:37', '2011-04-18 18:29:22', '127.0.0.1', 0, 0),
(9, 1, '2011-04-18 18:29:37', '2011-04-18 18:29:49', '127.0.0.1', 0, 0),
(10, 1, '2011-04-18 18:30:07', '2011-04-18 18:42:49', '127.0.0.1', 0, 0),
(11, 1, '2011-04-18 18:46:03', '2011-04-18 18:46:05', '127.0.0.1', 0, 0),
(12, 1, '2011-04-18 18:46:10', '2011-04-18 18:46:12', '127.0.0.1', 0, 0),
(13, 1, '2011-04-18 18:46:18', '2011-04-18 18:47:13', '127.0.0.1', 0, 0),
(14, 1, '2011-04-18 18:47:52', '2011-04-18 18:49:23', '127.0.0.1', 0, 0),
(15, 1, '2011-04-18 18:53:38', '2011-04-18 18:55:10', '127.0.0.1', 0, 0),
(16, 1, '2011-04-18 19:11:39', '2011-04-18 19:18:58', '127.0.0.1', 0, 0),
(17, 1, '2011-04-18 19:20:18', '2011-04-18 19:21:50', '127.0.0.1', 0, 0),
(18, 9, '2011-04-18 19:21:58', '0000-00-00 00:00:00', '127.0.0.1', 1, 0),
(19, 1, '2011-04-19 10:04:37', '2011-04-27 17:58:28', '127.0.0.1', 0, 0),
(20, 1, '2011-04-23 15:29:48', '2011-04-27 17:58:28', '127.0.0.1', 0, 0),
(21, 1, '2011-04-23 15:44:59', '2011-04-27 17:58:28', '127.0.0.1', 0, 0),
(22, 1, '2011-04-27 15:10:19', '2011-04-27 17:58:28', '127.0.0.1', 0, 0),
(23, 1, '2011-04-27 17:39:54', '2011-04-27 17:58:28', '127.0.0.1', 0, 0),
(24, 1, '2011-04-27 17:59:00', '2011-04-27 18:35:54', '127.0.0.1', 0, 0),
(25, 1, '2011-04-27 18:40:26', '2011-05-01 12:25:39', '127.0.0.1', 0, 0),
(26, 1, '2011-04-30 09:57:16', '2011-05-01 12:25:39', '127.0.0.1', 0, 0),
(27, 1, '2011-04-30 11:46:35', '2011-05-01 12:25:39', '127.0.0.1', 0, 0),
(28, 1, '2011-04-30 16:57:57', '2011-05-01 12:25:39', '192.168.1.7', 0, 0),
(29, 1, '2011-04-30 16:58:33', '2011-05-01 12:25:39', '192.168.1.33', 0, 0),
(30, 1, '2011-05-01 10:44:24', '2011-05-01 12:25:39', '127.0.0.1', 0, 0),
(31, 1, '2011-05-01 11:12:29', '2011-05-01 12:25:39', '127.0.0.1', 0, 0),
(32, 1, '2011-05-01 12:25:18', '2011-05-01 12:25:39', '192.168.1.33', 0, 0),
(33, 1, '2011-05-01 16:18:25', '2011-05-01 16:22:13', '127.0.0.1', 0, 0),
(34, 1, '2011-05-01 16:33:25', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(35, 1, '2011-05-01 18:18:59', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(36, 1, '2011-05-02 10:08:29', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(37, 1, '2011-05-02 16:32:33', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(38, 1, '2011-05-02 16:32:36', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(39, 1, '2011-05-02 17:19:02', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(40, 1, '2011-05-03 10:01:47', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(41, 1, '2011-05-03 11:14:19', '2011-05-03 17:51:37', '127.0.0.1', 0, 0),
(42, 1, '2011-05-03 18:11:31', '2011-05-03 18:23:33', '127.0.0.1', 0, 0),
(43, 1, '2011-05-03 18:23:39', '2011-05-04 11:51:43', '127.0.0.1', 0, 0),
(44, 1, '2011-05-04 09:59:23', '2011-05-04 11:51:43', '127.0.0.1', 0, 0),
(45, 1, '2011-05-04 11:55:39', '2011-05-04 13:09:03', '127.0.0.1', 0, 0),
(46, 1, '2011-05-04 13:14:31', '2011-05-04 17:08:15', '127.0.0.1', 0, 0),
(47, 1, '2011-05-04 17:12:30', '2011-05-07 15:17:51', '127.0.0.1', 0, 0),
(48, 1, '2011-05-05 09:58:50', '2011-05-07 15:17:51', '127.0.0.1', 0, 0),
(49, 1, '2011-05-07 10:04:09', '2011-05-07 15:17:51', '127.0.0.1', 0, 0),
(50, 1, '2011-05-07 15:18:23', '0000-00-00 00:00:00', '127.0.0.1', 1, 0),
(51, 1, '2011-05-08 10:04:56', '0000-00-00 00:00:00', '127.0.0.1', 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_attd`
--
CREATE TABLE IF NOT EXISTS `view_attd` (
`student_id` int(11)
,`date` date
,`attendance` decimal(25,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_std_attd`
--
CREATE TABLE IF NOT EXISTS `view_std_attd` (
`student_id` int(11)
,`user_name` varchar(50)
,`type_name` varchar(100)
,`attendance_type_id` int(11)
,`class_map_id` int(11)
,`class_name` varchar(255)
,`session_name` varchar(100)
,`present` decimal(25,0)
,`total_leave` decimal(32,0)
,`absent` decimal(33,0)
,`total_class` bigint(21)
,`percentage` decimal(32,4)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_std_reg`
--
CREATE TABLE IF NOT EXISTS `view_std_reg` (
`student_id` int(11)
,`user_name` varchar(50)
,`student_name` varchar(201)
,`email` varchar(100)
,`student_status` varchar(50)
,`branch_id` int(11)
,`class_map_id` int(11)
,`class_code` varchar(255)
,`class_name` varchar(255)
,`class_id` int(11)
,`section` varchar(100)
,`privilege` int(11)
,`session_id` int(11)
,`session_name` varchar(100)
,`class_status` int(1)
,`class_status_date` date
,`is_recent` tinyint(1)
,`staff_id` int(11)
,`tutor_name` varchar(511)
);
-- --------------------------------------------------------

--
-- Table structure for table `wb_content`
--

CREATE TABLE IF NOT EXISTS `wb_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_des` text NOT NULL,
  `content_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wb_content`
--

INSERT INTO `wb_content` (`content_id`, `menu_id`, `content_title`, `content_des`, `content_date`, `status`, `is_delete`) VALUES
(1, 1, 'About Us Content', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<span style="font-family: tahoma,arial,helvetica,sans-serif; font-size: small;">This is test content</span>\n</body>\n</html>', '2011-03-28 15:55:52', 1, 0),
(2, 3, 'Post Graduate', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: medium;">Post Graduate Students are very smart</span></span>\n</body>\n</html>', '2011-03-29 12:55:11', 1, 0),
(3, 2, 'Under Graduate', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<span style="font-family: arial,helvetica,sans-serif; font-size: medium;">Under Graduate students are very curious.</span>\n</body>\n</html>', '2011-03-29 12:55:59', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_events`
--

CREATE TABLE IF NOT EXISTS `wb_events` (
  `wb_events_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL DEFAULT '',
  `event_des` text NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(20) NOT NULL DEFAULT '',
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`wb_events_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wb_events`
--

INSERT INTO `wb_events` (`wb_events_id`, `category_id`, `event_title`, `event_des`, `event_date`, `event_time`, `status`, `is_delete`) VALUES
(1, 1, 'Final Sport,2011', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\n<span style="font-family: arial black,avant garde; font-size: small;">The Final sport 2011 will be held on 31-3-2011</span>\n</body>\n</html>', '2011-03-31', '11 am', 'enabled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_event_category`
--

CREATE TABLE IF NOT EXISTS `wb_event_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wb_event_category`
--

INSERT INTO `wb_event_category` (`category_id`, `title`, `status`, `is_delete`) VALUES
(1, 'Sporty', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_featured_box`
--

CREATE TABLE IF NOT EXISTS `wb_featured_box` (
  `featured_id` int(11) NOT NULL AUTO_INCREMENT,
  `featured_title` varchar(255) NOT NULL DEFAULT '',
  `featured_url` varchar(255) NOT NULL DEFAULT '',
  `featured_image` varchar(100) NOT NULL DEFAULT '',
  `featured_links` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`featured_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wb_featured_box`
--

INSERT INTO `wb_featured_box` (`featured_id`, `featured_title`, `featured_url`, `featured_image`, `featured_links`, `status`, `is_delete`) VALUES
(1, 'Campus', 'http://campus.com', '370589173_1301373535.png', '2', '1', 0),
(2, 'Examination', 'http://www.exam.com', '402945292_1301373865.png', '3', '1', 0),
(3, 'Student', 'http://www.student.com', '489722298_1301373890.png', '4', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_menus`
--

CREATE TABLE IF NOT EXISTS `wb_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `menu_name` varchar(100) NOT NULL,
  `menu_title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wb_menus`
--

INSERT INTO `wb_menus` (`menu_id`, `parent_id`, `menu_name`, `menu_title`, `status`, `sort`, `is_delete`) VALUES
(1, 0, 'aboutus', 'About Us', 1, 0, 0),
(2, 0, 'undergraduate', 'Under Graduate', 1, 0, 0),
(3, 0, 'postgraduate', 'Post Graduate', 1, 0, 0),
(4, 1, 'site/terms', 'Terms of Services', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_news`
--

CREATE TABLE IF NOT EXISTS `wb_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_des` text NOT NULL,
  `news_image` varchar(100) NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wb_news`
--

INSERT INTO `wb_news` (`news_id`, `category_id`, `news_title`, `news_des`, `news_image`, `news_date`, `status`, `is_delete`) VALUES
(1, 1, 'Only Spot Trade for Rights - ASIA', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n<head>\n<title>Untitled document</title>\n</head>\n<body>\nThis is dummy news, ha ha<br />\n</body>\n</html>', '735245232_1302255937.png', '2011-04-08 15:45:37', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_page_image`
--

CREATE TABLE IF NOT EXISTS `wb_page_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `image_title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `wb_page_image`
--

INSERT INTO `wb_page_image` (`image_id`, `menu_id`, `image_title`, `image`, `status`, `is_delete`) VALUES
(1, 1, 'About Us Image', '1994543063_1301375287.png', '1', 0),
(2, 3, 'Post Graduate', '1989903227_1301381632.png', '1', 0),
(3, 2, 'Under Graduate', '1347308433_1301381661.png', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_right_content`
--

CREATE TABLE IF NOT EXISTS `wb_right_content` (
  `right_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `des` text NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`right_content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wb_right_content`
--

INSERT INTO `wb_right_content` (`right_content_id`, `menu_id`, `title`, `des`, `image`, `status`, `is_delete`) VALUES
(1, 1, 'Right Content', 'This is right Content', '1166704683_1301306298.jpg', '1', 0),
(2, 2, 'News', 'News for under graduate students will appear here', '1653508903_1301381820.jpg', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_slider`
--

CREATE TABLE IF NOT EXISTS `wb_slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `des` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `image` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wb_slider`
--

INSERT INTO `wb_slider` (`slider_id`, `title`, `des`, `image`, `sort`, `status`, `is_delete`) VALUES
(1, 'Welcome Slider', 'Welcome visitors to the site', '1153333681_1301374316.jpg', 0, 1, 0),
(2, 'Second Slider', 'Appears after the welcome slider', '551123818_1301374323.png', 0, 1, 0),
(3, 'Third Slider', 'Comes after the second one', '1139870022_1301374347.jpg', 0, 1, 0),
(4, 'Fourth Slider', 'Comes last', '1912257555_1301374369.jpg', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_static_pages`
--

CREATE TABLE IF NOT EXISTS `wb_static_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `page_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wb_static_pages`
--

INSERT INTO `wb_static_pages` (`page_id`, `page_name`, `page_title`, `date_added`, `page_sort`, `status`, `is_delete`) VALUES
(1, 'terms', 'Terms of Services', '2011-03-29 10:24:19', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wb_useful_link`
--

CREATE TABLE IF NOT EXISTS `wb_useful_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_title` varchar(255) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wb_useful_link`
--

INSERT INTO `wb_useful_link` (`link_id`, `link_title`, `link_url`, `status`, `is_delete`) VALUES
(1, 'Flamma Corporation Ltd.', 'http://www.flammabd.com', '1', 0),
(2, 'Campus', 'http://www.campus.com', '1', 0),
(3, 'Examination', 'http://www.exam.com', '1', 0),
(4, 'Student', 'http://www.student.com', '1', 0);

-- --------------------------------------------------------

--
-- Structure for view `view_attd`
--
DROP TABLE IF EXISTS `view_attd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_attd` AS select `std_attendance`.`student_id` AS `student_id`,`std_attendance`.`date` AS `date`,sum(`std_attendance`.`attendance`) AS `attendance` from `std_attendance` where 1 group by `std_attendance`.`student_id`,`std_attendance`.`date` order by `std_attendance`.`date`,`std_attendance`.`student_id`;

-- --------------------------------------------------------

--
-- Structure for view `view_std_attd`
--
DROP TABLE IF EXISTS `view_std_attd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_std_attd` AS select `sa`.`student_id` AS `student_id`,`s`.`user_name` AS `user_name`,`ct`.`type_name` AS `type_name`,`ca`.`attendance_type_id` AS `attendance_type_id`,`cm`.`class_map_id` AS `class_map_id`,`c`.`class_name` AS `class_name`,`ss`.`session_name` AS `session_name`,sum(`sa`.`attendance`) AS `present`,sum(`sa`.`leave_excuse`) AS `total_leave`,((count(`ca`.`class_attendance_id`) - sum(`sa`.`attendance`)) - sum(`sa`.`leave_excuse`)) AS `absent`,count(`ca`.`class_attendance_id`) AS `total_class`,((sum(`sa`.`attendance`) / count(`ca`.`class_attendance_id`)) * 100) AS `percentage` from ((((((`std_attendance` `sa` join `student` `s` on((`s`.`student_id` = `sa`.`student_id`))) join `class_attendance` `ca` on((`ca`.`class_attendance_id` = `sa`.`class_attendance_id`))) join `class_map` `cm` on((`cm`.`class_map_id` = `ca`.`class_map_id`))) join `class` `c` on((`c`.`class_id` = `cm`.`class_id`))) join `session` `ss` on((`ss`.`session_id` = `cm`.`session_id`))) join `conf_type` `ct` on((`ct`.`type_id` = `ca`.`attendance_type_id`))) where (1 = 1) group by `sa`.`student_id`,`cm`.`class_map_id`,`ca`.`attendance_type_id` order by `c`.`class_name`;

-- --------------------------------------------------------

--
-- Structure for view `view_std_reg`
--
DROP TABLE IF EXISTS `view_std_reg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_std_reg` AS select `s`.`student_id` AS `student_id`,`s`.`user_name` AS `user_name`,concat(`s`.`first_name`,' ',`s`.`last_name`) AS `student_name`,`s`.`email` AS `email`,`s`.`student_status` AS `student_status`,`s`.`branch_id` AS `branch_id`,`cm`.`class_map_id` AS `class_map_id`,`c`.`class_code` AS `class_code`,`c`.`class_name` AS `class_name`,`rc`.`class_id` AS `class_id`,`rc`.`section` AS `section`,`rc`.`privilege` AS `privilege`,`cm`.`session_id` AS `session_id`,`sm`.`session_name` AS `session_name`,`rc`.`class_status` AS `class_status`,`rc`.`class_status_date` AS `class_status_date`,`rc`.`is_recent` AS `is_recent`,`cm`.`staff_id` AS `staff_id`,concat(`st`.`first_name`,' ',`st`.`last_name`) AS `tutor_name` from (((((`student` `s` join `reg_class` `rc` on((`rc`.`student_id` = `s`.`student_id`))) join `class` `c` on((`c`.`class_id` = `rc`.`class_id`))) join `class_map` `cm` on((`c`.`class_id` = `cm`.`class_id`))) join `session` `sm` on((`sm`.`session_id` = `cm`.`session_id`))) join `staffs` `st` on((`st`.`staffs_id` = `cm`.`staff_id`)));
