-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 10:21 PM
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
-- Table structure for table `market_post`
--

CREATE TABLE `market_post` (
  `market_post_id` bigint(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `author` bigint(12) NOT NULL,
  `img_id` bigint(12) NOT NULL,
  `price` varchar(10) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `market_post`
--
ALTER TABLE `market_post`
  ADD PRIMARY KEY (`market_post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `market_post`
--
ALTER TABLE `market_post`
  MODIFY `market_post_id` bigint(100) NOT NULL AUTO_INCREMENT;
COMMIT;
