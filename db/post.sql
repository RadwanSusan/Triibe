-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 05:06 PM
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
  `likes_count` mediumtext NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `created_date`, `author`, `form_id`, `img_id`, `likes_count`) VALUES
(1, NULL, 'Lorem ipsum dolor sit amet consectetur adipiscing elit laoreet convallis, dictumst in suscipit semper senectus class congue ornare, metus interdum hendrerit aliquet accumsan nullam commodo erat. Ut nam convallis velit curae aenean per sociosqu mi platea quis, nascetur class primis posuere tortor eros laoreet aptent euismod varius dui, pellentesque sed sapien aliquet tellus feugiat inceptos lacus ligula. Eros malesuada feugiat potenti maecenas egestas urna turpis taciti vestibulum, metus laoreet ', '2022-04-09 1:21', 120180612100, 1, NULL, '1'),
(2, NULL, 'hi', '2022-04-09 1:21', 120180612122, 1, 3, '0'),
(4, NULL, 'hi', '2022-04-09 1:21', 120180612122, 1, 3, '1');

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
  MODIFY `post_id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
