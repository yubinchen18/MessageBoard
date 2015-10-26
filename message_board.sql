-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 26, 2015 at 09:40 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `message_board`
--
CREATE DATABASE IF NOT EXISTS `message_board` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `message_board`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(8) NOT NULL,
  `datetime` varchar(19) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `content`, `date`, `time`, `datetime`) VALUES
(1, 'Hallo!', 'â•”â•¦â•¦â•¦â•â•¦â•—â•”â•â•¦â•â•¦â•â•â•¦â•â•—&nbsp<br />\nâ•‘â•‘â•‘â•‘â•©â•£â•šâ•£â•â•£â•‘â•‘â•‘â•‘â•‘â•©â•£&nbsp<br />\nâ•šâ•â•â•©â•â•©â•â•©â•â•©â•â•©â•©â•©â•©â•â•', '26-10-2015', '04:15:10', '26-10-2015 04:15:10'),
(2, 'Yubin&nbspChen', 'Have&nbspa&nbspnice&nbspday!', '26-10-2015', '08:56:12', '26-10-2015 08:56:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
