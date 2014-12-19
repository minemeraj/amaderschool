-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2014 at 02:24 পূর্বাহ্ণ
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `Name`, `Code`, `StartDate`, `EndDate`, `Details`) VALUES
(1, 'Bangla', 'BAN101', '0000-00-00', '2014-12-03', 'It is a fundamental course in Bangla language. It is essential for all students.'),
(2, 'English', 'ENG101', '0000-00-00', '2014-12-31', 'It is a funfamental course.'),
(3, 'Math', 'MAT101', '2014-12-01', '2014-12-31', 'This is the fundamental math course.'),
(6, 'CSE', 'CSE101', '2014-12-01', '2015-02-19', 'It is fundamental for cse.'),
(7, 'Astonomy', 'AST101', '2014-12-01', '2014-12-27', 'aaagda');

-- --------------------------------------------------------

--
-- Table structure for table `taken_course`
--

CREATE TABLE IF NOT EXISTS `taken_course` (
`ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taken_course`
--

INSERT INTO `taken_course` (`ID`, `user_id`, `course_id`) VALUES
(42, 41, 2),
(43, 40, 1),
(44, 40, 2),
(45, 37, 1),
(51, 41, 1),
(61, 32, 7),
(73, 24, 1),
(74, 24, 3),
(75, 24, 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `User_Id`, `Email`, `Password`, `Gender`, `ContactNo`, `DateOfBirth`, `Address`, `Salary`, `tutionfee`, `Role`, `isActive`, `Picture`) VALUES
(23, 'asfa', 't23', 'mineme.shahriar@gmail.com', '123456', 'M', 'afadga', '2014-02-04', '', NULL, NULL, 'admin', 1, 'uploads/male/admin.png'),
(24, 'israt zahan', 't24', 'israt@gmail.com', '123456', 'F', '', '1990-03-14', '', NULL, NULL, 'teacher', 1, 'uploads/female/teacher.png'),
(27, 'shahriar aasdsadasdas', 'std26', 'mineme.rahul@gmail.com', '123456', 'M', '', '2000-02-02', '', NULL, NULL, 'student', 0, 'uploads/male/student.png'),
(29, 'prova', 'std41', 'bnbsfhsd@gmail.com', '123456', 'F', '', '2014-12-10', '', NULL, NULL, 'student', 1, 'uploads/school.png'),
(32, 'bala', 'std41', 'bal@val', '123456', 'M', '', '2014-02-04', '', NULL, NULL, 'student', 1, 'uploads/screen.jpg'),
(33, 'nokia', 'std33', 'nokia@ovi.com', '123456', 'M', '0121651', '2014-12-02', '', NULL, NULL, 'student', 1, 'uploads/school.png'),
(34, 'momo', 'std38', 'momo@gmail.pm', '123456', 'M', '', '2014-12-04', '', NULL, NULL, 'student', 1, 'uploads/school.png'),
(36, 'fgfdjgdgsf', 'std36', '123@bal.com', '61656516', 'M', '', '2014-12-01', '', NULL, NULL, 'student', 1, 'uploads/male/student.png'),
(37, 'fdafa', 't37', 'agffghf@kkh', 'fsdfsdgfsg', 'M', '', '2014-12-02', '', NULL, NULL, 'teacher', 0, 'uploads/male/teacher.png'),
(40, 'helo', 'std40', 'hlw@a.com', '123456', 'M', '', '2014-12-15', '', NULL, NULL, 'student', 1, 'uploads/male/student.png'),
(41, 'raj', 't41', 'raj@gmail.com', '123456', 'M', '', '2014-12-02', '', NULL, NULL, 'teacher', 0, 'uploads/Computer-User-Male1.png'),
(42, 'Aymanaasdasd', 't42', 'ayman1@gmail.com', 'sdhdfjfdjfdj', 'M', '', '2014-12-01', '', NULL, NULL, 'teacher', 1, 'uploads/male/teacher.png');

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
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Email` (`Email`);

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
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
