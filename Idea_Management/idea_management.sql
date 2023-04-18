-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 09:14 AM
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
-- Database: `idea_management`
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
(2, 'Duong Vu Tuong', 'staff@gmail.com', '', '2023-04-03', '', '', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
(5, 'Nhan', 'nhan@gmail.com', 'Other', '0000-00-00', 'TP.Can Tho', '0215781', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
(6, 'Dat', 'dat@gmail.com', 'Male', '0000-00-00', 'TP.Can Tho', '0125485220', 'e10adc3949ba59abbe56e057f20f883e', 0, 1);

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
(1, 'Event1'),
(2, 'Opinions about teaching'),
(3, 'Infrastructure'),
(4, 'Club'),
(5, 'Workshop');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `feedback_Id` int(11) NOT NULL,
  `date_comment` date NOT NULL DEFAULT current_timestamp(),
  `account_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_Id`, `content`, `feedback_Id`, `date_comment`, `account_Id`) VALUES
(10, 'may noi qua dung luon', 24, '2023-04-07', 1),
(11, 'tao cung nghi vay', 24, '2023-04-07', 1),
(12, 'tru luong', 24, '2023-04-07', 7),
(13, 'tao da thay', 24, '2023-04-07', 7),
(14, 'chuẩn bị thất nghiệp hết nhe!', 24, '2023-04-07', 7),
(16, 'âssssssssssssssss', 17, '2023-04-07', 1),
(17, 'ké sao t nạp 20k r mà không nhận được giftcode', 25, '2023-04-08', 7),
(18, 'test1', 26, '2023-04-10', 1),
(19, 'asasa', 27, '2023-04-10', 1),
(20, 'test1', 27, '2023-04-10', 1);

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
(0, 'Bussiness'),
(1, 'Computer');

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

-- --------------------------------------------------------

--
-- Table structure for table `idea`
--

CREATE TABLE `idea` (
  `idea_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `thumb_up` bigint(20) NOT NULL,
  `thumb_down` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `content` text NOT NULL,
  `account_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_Id`, `title`, `category_Id`, `department_Id`, `date_create`, `date_ending`, `content`, `account_Id`) VALUES
(30, 'âsas', 1, 1, '2023-04-06 08:30:37', '2023-04-06 15:30:00', 'aaaaaaaaaaaa', 1),
(31, '31', 3, 1, '2023-04-06 08:42:14', '2023-04-06 15:42:00', '31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_Id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `gender` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `position` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thumbup`
--

CREATE TABLE `thumbup` (
  `thumbUp_Id` int(11) NOT NULL,
  `account_Id` int(11) NOT NULL,
  `feedback_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_Id`);

--
-- Indexes for table `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`idea_Id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_Id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_Id`);

--
-- Indexes for table `thumbup`
--
ALTER TABLE `thumbup`
  ADD PRIMARY KEY (`thumbUp_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `idea_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thumbup`
--
ALTER TABLE `thumbup`
  MODIFY `thumbUp_Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
