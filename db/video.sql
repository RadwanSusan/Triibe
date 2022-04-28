-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 02:33 PM
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
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` bigint(12) NOT NULL,
  `video_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `video_name`) VALUES
(1, 'db_images/626a7d72c17f18.25171702.mp4'),
(2, 'db_images/626a7d8cddbac8.96134091.mp4'),
(3, 'db_images/626a7daf97d7b7.19422951.mp4'),
(4, 'db_images/626a7dc8ceae95.32883917.mp4'),
(5, 'db_images/626a7dcd8676e4.87369301.mp4'),
(6, 'db_images/626a7e61317a52.55086812.mp4'),
(7, 'db_images/626a7e6614bc34.59439079.mp4'),
(8, 'db_images/626a7e8588b446.21403750.mp4'),
(9, 'db_images/626a7f32020694.83354380.mp4'),
(10, 'db_images/626a7f52e258d9.48566418.mp4'),
(11, 'db_images/626a7fb39fb415.53073430.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;
