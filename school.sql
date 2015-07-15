-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2015 at 06:31 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`ID` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Details` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `Name`, `Code`, `StartDate`, `EndDate`, `Details`) VALUES
(1, 'Bangla', 'BAN101', '0000-00-00', '2014-12-03', 'It is a fundamental course in Bangla language. It is essential for all students.'),
(2, 'English', 'ENG101', '0000-00-00', '2014-12-31', 'It is a funfamental course.'),
(3, 'Math', 'MAT101', '2014-12-01', '2014-12-31', 'It is the fundamental Math course'),
(4, 'Astonomy', 'AST101', '2014-12-01', '2014-12-13', 'Thisgdgdh'),
(5, 'Physics', 'PHY101', '2014-12-24', '2014-12-18', 'fundamental'),
(6, 'hUMINITY', 'A12', '2015-01-29', '2015-01-30', 'ADFAG'),
(7, 'Computer Basic ', 'CB201', '2015-02-14', '2016-02-14', 'Student will able to learn computer fundamentals.');

-- --------------------------------------------------------

--
-- Table structure for table `taken_course`
--

CREATE TABLE IF NOT EXISTS `taken_course` (
`ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taken_course`
--

INSERT INTO `taken_course` (`ID`, `user_id`, `course_id`) VALUES
(1, 41, 1),
(42, 41, 2),
(43, 40, 1),
(44, 40, 2),
(45, 23, 1),
(46, 23, 3),
(47, 29, 1),
(48, 29, 3),
(63, 29, 5),
(50, 33, 4),
(51, 25, 1),
(54, 23, 2),
(57, 30, 3),
(56, 30, 2),
(58, 30, 4),
(59, 30, 5),
(60, 34, 1),
(61, 34, 4),
(62, 33, 1),
(65, 35, 6),
(66, 35, 4),
(67, 29, 2),
(68, 37, 1),
(69, 37, 2),
(70, 37, 5),
(71, 43, 1),
(72, 43, 2),
(73, 43, 3),
(75, 21, 1),
(76, 36, 1),
(77, 45, 1),
(78, 45, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`ID` int(100) NOT NULL,
  `Name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `User_Id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Gender` char(1) CHARACTER SET latin1 NOT NULL,
  `ContactNo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DateOfBirth` date NOT NULL,
  `Address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `Salary` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tutionfee` varchar(255) DEFAULT NULL,
  `Role` varchar(255) CHARACTER SET latin1 NOT NULL,
  `isActive` int(1) NOT NULL,
  `Picture` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `User_Id`, `Email`, `Password`, `Gender`, `ContactNo`, `DateOfBirth`, `Address`, `Salary`, `tutionfee`, `Role`, `isActive`, `Picture`) VALUES
(21, 'moin', 't31', 'moin@gmail.com', 'agshssdfhgfdhhfgsgh', 'M', 'asdgfsasf', '1990-12-05', 'asfasf', NULL, NULL, 'teacher', 1, 'uploads/male/teacher.png'),
(31, 'masum', 't31', 'masum.eu9@gmail.com', '01913449590', 'M', '01913871881', '1990-12-29', '4/a,Zigatola,Dhanmondi, Dhaka-1209', NULL, NULL, 'teacher', 1, 'uploads/male/teacher.png'),
(33, 'raj', 'std33', 'raj@gmail.com', '123456', 'M', '', '2014-12-02', '', NULL, NULL, 'student', 1, 'uploads/1802297-master_shifu_5.jpg'),
(23, 'nishu', 't23', 'nishu@gmail.com', '123456', 'F', '', '2014-12-23', '', NULL, NULL, 'teacher', 1, 'uploads/female/teacher.png'),
(32, 'jakir hossen', 'std32', 'sajib.remix@gmail.com', '123456', 'M', '01717372528', '2014-12-10', 'adfsdafwesd3e', NULL, NULL, 'student', 1, 'uploads/male/student.png'),
(45, 'ssss', 't43', 'ssss@gmail.com', '123456', 'M', '0965426788', '2015-02-24', 'farmgate', NULL, NULL, 'teacher', 1, 'uploads/male/teacher.png'),
(26, 'esita', 't31', 'ishita@gmail.com', 'sdgsgdsghsd', 'F', '', '2000-02-15', 'sdghdsh', NULL, NULL, 'teacher', 1, 'uploads/female/teacher.png'),
(41, 'sss', 't41', 'sss@gmail.com', '123456', 'M', '08866521', '0009-02-20', 'farmgate', NULL, NULL, 'teacher', 0, 'uploads/male/teacher.png'),
(29, 'Ayman', 'std33', 'ayman@gmail.com', '123456', 'M', '', '2005-05-06', 'Makibag, Dhaka', NULL, NULL, 'student', 1, 'uploads/Detective1.png'),
(30, 'momo', 'std30', 'momo@gamil.com', '123456', 'F', '', '2000-01-04', '', NULL, NULL, 'student', 1, 'uploads/female/student.png'),
(34, 'Saikat Kishore Biswas', 'std34', 'saikat.biswas@rocketmail.com', 'germany2014', 'M', '01749484454', '2042-05-15', 'ufguygiujn', NULL, NULL, 'student', 1, 'uploads/male/student.png'),
(39, 'bishawjit', 't39', 'abc@gmail.com', '1233467', 'M', '0176567899', '2015-02-18', 'farmgate', NULL, NULL, 'teacher', 0, 'uploads/male/teacher.png'),
(36, 'sunabsaha', 't43', 'sunabsaha@gmail.com', '222222', 'M', '01752998660', '1989-01-01', '17,greenroad,dhaka', NULL, NULL, 'teacher', 1, 'uploads/7a636608_o.jpeg'),
(37, 'app', 'std37', 'ap@gmail.com', '123456', 'M', '1111', '2011-02-01', 'Sahjanpur', NULL, NULL, 'student', 1, 'uploads/male/student.png'),
(38, 'Reza', 'std38', 'reza@gmail.com', '123456', 'M', '01715010005', '1961-02-08', 'Shantibagh, Dhaka', NULL, NULL, 'student', 0, 'uploads/male/student.png'),
(42, 'fff', 'std42', 'fff@yahoomail.com', '123456', 'M', '', '0009-02-20', '', NULL, NULL, 'student', 1, 'uploads/male/student.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `taken_course`
--
ALTER TABLE `taken_course`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `taken_course`
--
ALTER TABLE `taken_course`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
