-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2018 at 07:24 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_supermart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tree`
--

CREATE TABLE `tbl_tree` (
  `id` bigint(10) NOT NULL,
  `parent_id` varchar(10) NOT NULL,
  `child_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tree`
--

INSERT INTO `tbl_tree` (`id`, `parent_id`, `child_id`) VALUES
(4, '56789', '5438176'),
(16, '5438176', '1077343'),
(17, '5438176', '6894450'),
(18, '1077343', '300787'),
(19, '1077343', '8539452'),
(20, '6894450', '9606259'),
(21, '6894450', '9718445'),
(22, '6894450', '7391274'),
(23, '6894450', '122163'),
(24, '122163', '5222609'),
(25, '122163', '9240753'),
(26, '1077343', '1827478');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint(8) NOT NULL,
  `profile_id` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `ph_no` varchar(12) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `nominee_name` varchar(30) NOT NULL,
  `nominee_relation` varchar(20) NOT NULL,
  `father_name` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pin` bigint(8) NOT NULL,
  `country` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `img1` varchar(15) NOT NULL DEFAULT 'dummy.jpg',
  `created_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `profile_id`, `name`, `email`, `pwd`, `ph_no`, `status`, `nominee_name`, `nominee_relation`, `father_name`, `gender`, `state`, `city`, `pin`, `country`, `address`, `img1`, `created_date`) VALUES
(13, '5438176', 'Admin', 'admin@gm.com', '$2y$10$HVm5sDPyaxFy7h8lWl3rpecwoXqsKPbI70xaNt3NbID8YQ9NpZ7cy', '3456789', 1, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '17-01-2018 07:41:48 AM'),
(25, '1077343', 'Sanjoy Sonar', 'sanjoyn93@gmail.com', '$2y$10$jxwoBnA1AmMHafLVqOkV.OsA7.EWgNNuwlM45e.bKOraXtkmbhDVW', '987654321', 0, '', '', '', '', '', '', 0, '', '', 'me.jpg', '18-01-2018 10:55:39 AM'),
(26, '6894450', 'Himanshu', 'rayhimanshu@gmail.com', '$2y$10$VHXs.C9bSte4nsWHKwCtAOLUFj14P6FXJZFp0I/79OXehyIJ/JLi6', '87654323', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 10:56:22 AM'),
(27, '300787', 'Akas', 'akas@gmail.com', '$2y$10$pThEu5bYLadpjYlHUyJp8.WNML6W3NA.lfXQNoyPB.7mB80BvVjk2', '9876543345', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 10:57:17 AM'),
(28, '8539452', 'Rajesh', 'raj@gmail.com', '$2y$10$hRcIcBO3MniH49gNVpJIeOe8P3r/4QO4EexU5qNypJ5aqKNLwuOAy', '876543234', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 10:57:59 AM'),
(29, '9606259', 'Rohit', 'rohit@gmail.com', '$2y$10$i14niwGhitj7bNXTdhYj1OqhV8zSzJJgAMfuG9jefA/zTvcO4hAve', '765433456', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:06:13 AM'),
(30, '9718445', 'Sanjeev ', 'sanjeev@gmail.com', '$2y$10$LqKEYrtUInH7MauPwRelQO3qHPMLHWHGMj03NtE9E.1LBZj991lvi', '654322345', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:06:40 AM'),
(31, '7391274', 'Ujjal', 'ujjal@gmail.com', '$2y$10$ECpy8MT2Rau3SEtpx1HTK.ObKbeIr1X7uxBN0WQ134alAFLNtdHy2', '654323456', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:07:20 AM'),
(32, '122163', 'Subha', 'subha@gmail.com', '$2y$10$ZzqLNkdn9CaZkxSuK9WWpuM7fLOX5hZXQA0lNXtz6xG7kfLOHJv0q', '5432345677', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:07:45 AM'),
(33, '5222609', 'Neel', 'neel@gmail.com', '$2y$10$SuP1iNEdvfdmVYO2mHo5oOPMwdgrlazTZpWhRNUV7VSfKURrvkUGq', '765432345', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:08:32 AM'),
(34, '9240753', 'Dhiman', 'dhiman@gmail.com', '$2y$10$YUasB1k58QzbD6wpyiaAceEzh9QtpkQ48rX/LgsawHVPg0HlSoXT6', '5432234564', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '18-01-2018 11:09:01 AM'),
(35, '1827478', 'Sonu', 'sonu@gmail.com', '$2y$10$fqnC.6fzldXtUcIXlnrg7.0Kd/XFebtN4TgfsqBe7RKdEYsm8fJNa', '345678954', 0, '', '', '', '', '', '', 0, '', '', 'dummy.jpg', '19-01-2018 11:39:37 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_tree`
--
ALTER TABLE `tbl_tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile_id` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_tree`
--
ALTER TABLE `tbl_tree`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
