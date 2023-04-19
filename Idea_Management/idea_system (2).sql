-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 09:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idea_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_Id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `department_Id` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_Id`, `fullname`, `email`, `gender`, `date_of_birth`, `address`, `phone`, `password`, `department_Id`, `role`) VALUES
(1, 'Vinh', 'admin@gmail.com', 'Other', '2023-03-27', 'TP.Can Tho', '021352876', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(9, 'Tran Quan Vinh', 'staff@gmail.com', 'Male', '0000-00-00', 'ca mau', '0914593431', 'e10adc3949ba59abbe56e057f20f883e', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_Id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_Id`, `categoryName`) VALUES
(1, 'Event'),
(2, 'Study');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `feedback_Id` int(11) NOT NULL,
  `date_comment` date NOT NULL DEFAULT current_timestamp(),
  `account_Id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_Id`, `content`, `feedback_Id`, `date_comment`, `account_Id`, `active`) VALUES
(22, 'OK', 34, '2023-04-15', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_Id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_Id`, `departmentName`) VALUES
(1, 'Computer research'),
(2, 'Bussiness');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_Id` int(11) NOT NULL,
  `post_Id` int(11) DEFAULT NULL,
  `department_Id` int(11) DEFAULT NULL,
  `file_path` longblob DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `date_submited` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `feedback` text DEFAULT NULL,
  `likes` bigint(20) DEFAULT NULL,
  `liked_by` text NOT NULL,
  `account_Id` int(11) DEFAULT NULL,
  `anonymous` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_Id`, `post_Id`, `department_Id`, `file_path`, `file_name`, `date_submited`, `feedback`, `likes`, `liked_by`, `account_Id`, `anonymous`) VALUES
(33, 34, 1, 0x75706c6f6164732f6d696c6577736b615f74686520652d636f6d6d657263655f36302d32303139202831292e706466, 'milewska_the e-commerce_60-2019 (1).pdf', '2023-04-14 09:24:07', 'submit idea\r\n', 0, '', 2, 'anonymous'),
(34, 35, 4, 0x75706c6f6164732f6d696c6577736b615f74686520652d636f6d6d657263655f36302d32303139202831292e706466, 'milewska_the e-commerce_60-2019 (1).pdf', '2023-04-15 08:10:12', 'I agree create an event for the holiday', 1, '[\"Quan Vinh\"]', 8, 'anonymous'),
(35, 41, 1, 0x75706c6f6164732f6d696c6577736b615f74686520652d636f6d6d657263655f36302d32303139202831292e706466, 'milewska_the e-commerce_60-2019 (1).pdf', '2023-04-15 09:28:21', 'I agree organize an event for the holiday of 8/3', 0, '', 1, 'anonymous');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_Id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_Id` int(11) NOT NULL,
  `department_Id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_ending` datetime NOT NULL,
  `date_end_read` datetime NOT NULL,
  `content` text NOT NULL,
  `account_Id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_Id`, `title`, `category_Id`, `department_Id`, `date_create`, `date_ending`, `date_end_read`, `content`, `account_Id`, `active`) VALUES
(41, 'Create an event for the holiday of 8/3', 1, 4, '2023-04-17 09:38:34', '2023-04-27 23:59:00', '2023-04-27 23:59:00', 'Organize an event for the holiday of 8/3', 1, 0),
(42, 'aaaaaaaaa', 7, 1, '2023-04-15 09:51:20', '2023-04-21 16:51:00', '2023-04-22 16:51:00', 'aaaaaaaa', 1, 0),
(43, 'ccccccccccccc', 8, 1, '2023-04-15 09:52:55', '2023-04-15 16:52:00', '2023-04-15 16:52:00', 'aaaaaaaaaaaacccccc', 1, 0),
(44, 'Event of school', 1, 1, '2023-04-15 10:00:11', '2023-04-16 17:00:00', '2023-04-16 17:00:00', 'aaaaaaa', 1, 0),
(46, 'Create an event for the holiday of 8/3', 1, 1, '2023-04-17 00:41:17', '2023-04-27 23:59:00', '2023-04-27 23:59:00', 'Create an event for the holiday of 8/3', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_Id`),
  ADD KEY `department_Id` (`department_Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_Id`),
  ADD KEY `feedback_Id` (`feedback_Id`,`account_Id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_Id`),
  ADD KEY `post_Id` (`post_Id`,`department_Id`,`account_Id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_Id`),
  ADD KEY `category_Id` (`category_Id`,`department_Id`,`account_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
