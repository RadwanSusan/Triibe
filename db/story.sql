-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 09:18 PM
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
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `story_id` bigint(100) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `author` bigint(12) NOT NULL,
  `img_name` varchar(100) DEFAULT NULL,
  `video_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`story_id`, `created_date`, `author`, `img_name`, `video_name`) VALUES
(2, '09:35:52', 120180612100, NULL, 'db_images/62951c98595c06.88753381.mp4'),
(6, '08:44:07', 120180612100, 'db_images/629661f7e97cd3.90357452.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`story_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `story_id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
