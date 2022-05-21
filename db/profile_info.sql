-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 08:43 PM
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
-- Table structure for table `profile_info`
--

CREATE TABLE `profile_info` (
  `std_id` bigint(12) NOT NULL,
  `uni` varchar(100) DEFAULT NULL,
  `lives_in` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `github` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `snapchat` varchar(100) DEFAULT NULL,
  `img_name` varchar(200) DEFAULT NULL,
  `discerption` varchar(100) DEFAULT NULL,
  `fromto` varchar(50) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_info`
--

INSERT INTO `profile_info` (`std_id`, `uni`, `lives_in`, `instagram`, `facebook`, `github`, `linkedin`, `snapchat`, `img_name`, `discerption`, `fromto`, `twitter`) VALUES
(120180612100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'db_images/6289328a886cd4.40161268.jpg', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile_info`
--
ALTER TABLE `profile_info`
  ADD PRIMARY KEY (`std_id`);
COMMIT;
