-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 08:14 PM
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
-- Table structure for table `friends_request`
--

CREATE TABLE `friends_request` (
  `sender` bigint(12) NOT NULL,
  `receiver` bigint(12) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends_request`
--

INSERT INTO `friends_request` (`sender`, `receiver`, `status`, `date`) VALUES
(120180612999, 120180612100, 1, '2022-05-22 19:36:02');
COMMIT;
