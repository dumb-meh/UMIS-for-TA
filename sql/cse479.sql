-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 04:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cse479`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `contact_us_id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`contact_us_id`, `name`, `email`, `phone`, `message`) VALUES
(2, 'a', 'test@ewubd.edu', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `visibility` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `author`, `visibility`, `email`) VALUES
(4, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu'),
(6, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu'),
(7, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu'),
(8, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu'),
(10, 'ad', 'add', 'ads', 'Faculty', 'tes2@ewubd.edu'),
(11, 'asd', 'adasd', 'assd', 'TA', 'tes2@ewubd.edu'),
(12, 'ad', 'asd', 'asdsad', 'Faculty', 'tes2@ewubd.edu'),
(13, 'adasdas', 'adadad', 'adada', 'Faculty', 'tes2@ewubd.edu'),
(14, 'asd', 'adad', 'asd', 'Admin', 'tes2@ewubd.edu'),
(15, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu'),
(16, 'as', 'awawad', '233', 'Public', 'tes2@ewubd.edu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(250) DEFAULT NULL,
  `usersEmail` varchar(250) DEFAULT NULL,
  `usersPwd` varchar(250) DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `active` int(11) DEFAULT 0,
  `verifaction` int(11) DEFAULT 0,
  `adress` varchar(250) DEFAULT NULL,
  `about` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `2step` int(11) DEFAULT 0,
  `position` varchar(250) DEFAULT NULL,
  `person` varchar(250) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPwd`, `role`, `active`, `verifaction`, `adress`, `about`, `mobile`, `image`, `2step`, `position`, `person`, `otp`, `otp_expiry`) VALUES
(1, 'Omar', '2020-2-60-214@std.ewubd.edu', '$2y$10$FCKmjcMYy5te/.9CnhnE1ONximk2fI0iktkvbrGYW9H145iMFNxw2', 2, 1, 0, '123/Banasree', 'Top Level Dumbass', '123445', 'profile_2020-2-60-214@std.ewubd.edu.jpg', 1, 'Super Admin', NULL, 203320, '2023-12-27 12:06:01'),
(2, 'AR', 'test@ewubd.edu', '$2y$10$MlT8oisAzw/LoX9accukUeg0okriA5ouTi4XTBIUm4J9m7gKjLNFe', 2, 1, 0, '123/Banasree', 'Dumbass', '123445', 'profile_test@ewubd.edu.jpg', 0, 'Admin', NULL, NULL, NULL),
(22, 'AR', 'tes2@ewubd.edu', '$2y$10$MlT8oisAzw/LoX9accukUeg0okriA5ouTi4XTBIUm4J9m7gKjLNFe', 1, 1, 0, '123/Banasree', 'Dumbass', '123445', 'profile_tes2@ewubd.edu.JPG', 0, 'GTA', NULL, NULL, NULL),
(26, 'AR', 'test234@ewubd.edu', '$2y$10$5NtfRs4CCM/Cl9B8NllgdeTJtNbUrHZT5oLh0vSa62UgoulG05KXO', 0, 1, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
