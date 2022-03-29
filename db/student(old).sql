-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 01:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `triibe`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` bigint(12) NOT NULL,
  `std_pass` varchar(30) NOT NULL,
  `std_fname` varchar(15) NOT NULL,
  `std_lname` varchar(15) NOT NULL,
  `loc` varchar(15) NOT NULL,
  `collage` varchar(25) NOT NULL,
  `gender` int(1) NOT NULL,
  `College_Year` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `status` int(1) NOT NULL,
  `created_date` date NOT NULL,
  `account_id` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_pass`, `std_fname`, `std_lname`, `loc`, `collage`, `gender`, `College_Year`, `email`, `status`, `created_date`, `account_id`) VALUES
(120180612100, '0799317489', 'omar', 'thaer', 'amman', 'IT', 1, 4, '120180612100@st.ahu.edu.jo', 0, '2022-03-18', 99999999999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
