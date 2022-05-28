-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 02:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `triibe`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `account_type` int(1) NOT NULL DEFAULT 1,
  `std_id` bigint(12) NOT NULL,
  `std_pass` varchar(30) NOT NULL,
  `std_fname` varchar(15) NOT NULL,
  `std_lname` varchar(15) NOT NULL,
  `loc` varchar(15) NOT NULL,
  `collage` varchar(25) NOT NULL,
  `gender` int(1) NOT NULL,
  `College_Year` int(1) NOT NULL,
  `email` varchar(35) NOT NULL,
  `status` int(1) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `account_id` bigint(10) NOT NULL,
  `img_id` bigint(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`account_type`, `std_id`, `std_pass`, `std_fname`, `std_lname`, `loc`, `collage`, `gender`, `College_Year`, `email`, `status`, `created_date`, `account_id`, `img_id`) VALUES
(1, 120180612100, '0799317489', 'omar', 'thaer', 'maan', 'IT', 1, 4, '120180612100@st.ahu.edu.jo', 1, '2022-03-28', 251986197, 59),
(3, 120180612114, '56789', 'zaid', 'mohammad', 'maan', 'IT', 1, 4, '120180612114@st.ahu.edu.jo', 1, '2022-03-28', 945532290, 74),
(1, 120180612122, 'Blackbox@007', 'Radwan', 'Susan', '', '', 1, 4, '120180612122@st.ahu.edu.jo', 1, '2022-05-04', 882342624, 72),
(1, 120180612999, '12345', 'samer', 'khaled', '', '', 1, 4, '120180612999@st.ahu.edu.jo', 0, '2022-04-01', 697723097, NULL),
(1, 120201408061, '123456789', 'amer', 'hindawi', '', '', 1, 4, '120201408061@st.ahu.edu.jo', 0, '2022-04-05', 949058306, NULL),
(1, 999999999999, 'AdminBox@007', 'Triibe', 'Team', '', '', 1, 1, '999999999999@st.ahu.edu.jo', 0, '2022-05-04', 528706628, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);
COMMIT;
