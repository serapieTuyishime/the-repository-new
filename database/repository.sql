-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 11:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repository`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` int(11) NOT NULL,
  `client_id` varchar(30) NOT NULL,
  `client_type` varchar(30) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `client_id`, `client_type`, `balance`) VALUES
(1, 'noeline', 'client', 99742.4);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `education` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `education`, `username`, `password`) VALUES
(1, 'icyimpaye noeline', 'nono@gmail.com', 'Primary', 'noeline', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'accounting'),
(2, 'finance'),
(3, 'mathematics for all'),
(4, 'business'),
(5, 'civil engineering');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `on_subscription` tinyint(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `resource_id` int(11) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notId` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `sender` varchar(100) NOT NULL,
  `access` varchar(50) DEFAULT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `price` float NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `active`) VALUES
(3, 'silver', 'Actual contents edited', 3434, 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_detail`
--

CREATE TABLE `package_detail` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_detail`
--

INSERT INTO `package_detail` (`id`, `package_id`, `department_id`, `enabled`) VALUES
(12, 3, 2, 1),
(13, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `researchers`
--

CREATE TABLE `researchers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  `bank_acc` varchar(40) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` tinytext NOT NULL,
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchers`
--

INSERT INTO `researchers` (`id`, `name`, `email`, `photo`, `bank_acc`, `username`, `password`, `description`) VALUES
(1, 'byukusenge jojo', 'jojo@gmail.com', 'IMG_20210701_114848.jpg', '', 'jojoo', 'e10adc3949ba59abbe56e057f20f883e', 'contact jojo on 232134123');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `researcher_id` int(11) NOT NULL,
  `title_slug` varchar(255) NOT NULL COMMENT 'the slug form of the title so we''ll be able to use it as a link somehow and the folder woll be named like that',
  `title` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `price` float NOT NULL,
  `file` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `save_for_later`
--

CREATE TABLE `save_for_later` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `save_for_later`
--

INSERT INTO `save_for_later` (`id`, `resource_id`, `username`, `date`) VALUES
(1, 1, '0', '2021-07-09 13:39:00'),
(2, 1, '0', '2021-07-09 13:39:25'),
(3, 1, '0', '2021-07-09 13:39:34'),
(4, 4, 'noeline', '2021-07-14 07:29:59'),
(5, 4, '1-4', '2021-07-14 07:30:36'),
(6, 16, 'noeline', '2021-07-14 20:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `description` tinytext NOT NULL,
  `bank_acc` varchar(30) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `email`, `telephone`, `description`, `bank_acc`, `username`, `password`) VALUES
(1, 'university', 'uni@gmail.com', '43543', 'feelings', NULL, 'university', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'university of rwanda', 'unirwanda@gmail.com', '214234234', 'the amasest schhool', NULL, 'universi', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expiring_date` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(30) DEFAULT NULL,
  `password` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `school_id`, `name`, `email`, `expiring_date`, `username`, `password`) VALUES
(1, 1, '568hhj', 'fghfghr', '2021-07-29', 'nono', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 1, '568hhj', 'fghfghr', '2021-07-29', 'nono', 'hfgfhfy'),
(4, 1, 'chacha', 'cha@gmail.com', '2024-07-04', '1-4', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 1, 'icyizere dorothee', 'cha@gmail.com', '2023-07-04', '1-5', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `package_id`, `school_id`, `date_start`, `date_end`, `active`) VALUES
(2, 3, 1, '2021-07-11', '2021-10-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'transaction type either a in or out',
  `details` tinytext NOT NULL COMMENT 'states what was the transaction ex: download of aresource',
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `date`, `reference_no`, `type`, `details`, `amount`, `status`) VALUES
(1, '2021-07-14 21:13:12', 'noeline', 'in', 'download of a resource ABULE patoranking', 32.2, 0),
(2, '2021-07-14 21:13:53', 'noeline', 'in', 'download of a resource ABULE patoranking', 32.2, 0),
(3, '2021-07-14 21:14:48', 'noeline', 'in', 'download of a resource ABULE patoranking', 32.2, 0),
(4, '2021-07-14 21:15:01', 'noeline', 'in', 'download of a resource ABULE patoranking', 32.2, 0),
(5, '2021-07-14 21:15:50', 'noeline', 'in', 'download of a resource ABULE patoranking', 32.2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notId`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_detail`
--
ALTER TABLE `package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_detail_ibfk_1` (`package_id`);

--
-- Indexes for table `researchers`
--
ALTER TABLE `researchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `researcher_id` (`researcher_id`);

--
-- Indexes for table `save_for_later`
--
ALTER TABLE `save_for_later`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_detail`
--
ALTER TABLE `package_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `researchers`
--
ALTER TABLE `researchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `save_for_later`
--
ALTER TABLE `save_for_later`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`username`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `package_detail`
--
ALTER TABLE `package_detail`
  ADD CONSTRAINT `package_detail_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`researcher_id`) REFERENCES `researchers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
