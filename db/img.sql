-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 08:08 PM
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
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `img_id` bigint(12) NOT NULL,
  `img_name` varchar(100) DEFAULT NULL,
  `album_id` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`img_id`, `img_name`, `album_id`) VALUES
(64, 'db_images/628a78d2c52109.60813168.gif', 120180612100),
(65, 'db_images/628a79f3841a61.56048157.png', 120180612100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `img_id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;
