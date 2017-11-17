-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 11:51 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_studentapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `faculties_id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_faculties` (`faculties_id`),
  KEY `assignments_students` (`students_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `name`, `details`, `completed`, `faculties_id`, `students_id`) VALUES
(1, 'SQL Injection', 'Get some notes about SQL Injection', 0, 1, 3),
(2, 'DBMS', 'Discuss all type of joins', 0, 1, 1),
(3, 'Business Management', 'Discuss role of IT in HRM', 1, 1, 2),
(4, 'C++', 'Create a simple login app using c++', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `username`, `password`, `subject`, `api_key`) VALUES
(1, 'Ritesh Kumar', 'ritesh', '81dc9bdb52d04dc20036dbd8313ed055', 'DBMS', '0c81c1be0741a08d857f55e2dd0268b6');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `username`, `password`, `api_key`) VALUES
(1, 'belal', 'belal', '81dc9bdb52d04dc20036dbd8313ed055', '50addfeb14283e2568ca98e2a8ecf7f6'),
(2, 'Belal Khan', 'probelalkhan', '81dc9bdb52d04dc20036dbd8313ed055', '589d3d5ad22808e7cb54fd1ee2affd3c'),
(3, 'Vivek Raj', 'vivek', 'e2fc714c4727ee9395f324cd2e7f331f', '2d092996274be2edf7a0771ba427e134');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_students` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `assignments_faculties` FOREIGN KEY (`faculties_id`) REFERENCES `faculties` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
