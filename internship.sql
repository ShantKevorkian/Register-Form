-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2021 at 01:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(191, 24, 'sad', '2021-03-23 11:04:03', NULL),
(192, 24, 'asd', '2021-03-23 11:06:37', NULL),
(186, 25, 'aefaafaff', '2021-03-23 08:47:55', NULL),
(185, 25, 'aefaafaff', '2021-03-23 08:47:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

DROP TABLE IF EXISTS `user_reg`;
CREATE TABLE IF NOT EXISTS `user_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`id`, `name`, `email`, `password`) VALUES
(25, 'test', 'test@test.com', '202cb962ac59075b964b07152d234b70'),
(26, 'raffi', 'raffi95@outlook.com', '202cb962ac59075b964b07152d234b70'),
(27, 'test', 'test@test.com', '202cb962ac59075b964b07152d234b70'),
(24, 'nazo', 'nazo@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(23, 'aa', 'aa@aa.com', '202cb962ac59075b964b07152d234b70'),
(22, 'Shant Kevorkian', 'shant97@outlook.com', '25f9e794323b453885f5181f1b624d0b'),
(28, 'rrrr', 'ss@ss.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `weather_data`
--

DROP TABLE IF EXISTS `weather_data`;
CREATE TABLE IF NOT EXISTS `weather_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(32) NOT NULL,
  `temperature` int(11) NOT NULL,
  `weatherTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
