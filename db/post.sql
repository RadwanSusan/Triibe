-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 10:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `triibe`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` bigint(100) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(1500) DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `author` bigint(12) NOT NULL,
  `form_id` int(5) NOT NULL,
  `img_id` bigint(12) DEFAULT NULL,
  `likes_count` mediumtext NOT NULL DEFAULT '0',
  `video_id` bigint(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `created_date`, `author`, `form_id`, `img_id`, `likes_count`, `video_id`) VALUES
(5, NULL, 'Welcome To Triibe ✌️', '2022-05-04 20:10:39', 999999999999, 1, NULL, '0', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
