-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 02:48 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `pwd_request`
--

CREATE TABLE `pwd_request` (
  `id` int(10) NOT NULL,
  `user_token` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pwd_request`
--

INSERT INTO `pwd_request` (`id`, `user_token`, `user_email`) VALUES
(1, '161be8f3455184', 'newjoe73@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_chats`
--

CREATE TABLE `users_chats` (
  `msg_id` int(11) NOT NULL,
  `sender_username` varchar(100) NOT NULL,
  `sender_token` text NOT NULL,
  `receiver_username` varchar(100) NOT NULL,
  `receiver_token` text NOT NULL,
  `msg_content` varchar(200) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_chats`
--

INSERT INTO `users_chats` (`msg_id`, `sender_username`, `sender_token`, `receiver_username`, `receiver_token`, `msg_content`, `msg_status`, `msg_date`) VALUES
(1, 'MJ', '161bda47bd5e7c', 'fathela', '161bda5cb34baf', 'Niaje msee ', 'read', '2021-12-18 09:19:56'),
(2, 'fathela', '161bda5cb34baf', 'MJ', '161bda47bd5e7c', 'fity fity ', 'read', '2021-12-18 09:22:02'),
(3, 'fathela', '161bda5cb34baf', 'MJ', '161bda47bd5e7c', 'rada ni gani', 'read', '2021-12-18 09:22:16'),
(4, 'MJ', '161bda47bd5e7c', 'fathela', '161bda5cb34baf', 'ii stuff ndo nime create nilikuwa napiga testa kama iko fine', 'read', '2021-12-18 09:23:54'),
(5, 'fathela', '161bda5cb34baf', 'MJ', '161bda47bd5e7c', 'ndo adi nimecheki kina tajiri wako pia', 'read', '2021-12-18 09:25:12'),
(6, 'MJ', '161bda47bd5e7c', 'fathela', '161bda5cb34baf', 'eeh so hii stuff ni ya grup chat', 'read', '2021-12-18 09:26:37'),
(7, 'fathela', '161bda5cb34baf', 'MJ', '161bda47bd5e7c', 'so uki text msee watu wengine wataona', 'read', '2021-12-18 09:28:21'),
(8, 'MJ', '161bda47bd5e7c', 'fathela', '161bda5cb34baf', 'zii ni sender na receiver peke wataona', 'unread', '2021-12-18 09:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_records`
--

CREATE TABLE `users_records` (
  `id` int(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `verified` int(1) NOT NULL,
  `token` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_records`
--

INSERT INTO `users_records` (`id`, `status`, `fullname`, `username`, `email`, `phone`, `gender`, `password`, `profile`, `verified`, `token`, `date_created`) VALUES
(1, 'Online', 'json kruger', 'MJ', 'newjoe73@gmail.com', 707451236, 'Male', '$2y$10$fcdexv7hLUAnVqK6B5NVOuzasj73Q5aOCFlYjCIHokrtPcPRhVMM6', 'MyProfiles/61bdab2b3ae3d8.95177576.jpg', 1, '161bda47bd5e7c', '2021-12-18 09:06:03'),
(2, 'Offline', 'geoffrey makau', 'tajiri', 'tajiri@newmail.com', 745123680, 'Male', '$2y$10$Xx0RwtLAFMlavRQ4gC6dVO5IftJ/Vdobj.MrO/N2E4J7aZmlgpdXS', 'MyCustom/images/placeholder.jpg', 1, '161bda53432b86', '2021-12-18 09:09:08'),
(3, 'Offline', 'dennis muthama', 'fathela', 'fathela@newmail.com', 704125411, 'Male', '$2y$10$uqZDnVA6v5SqhGrcYyaXwuxo5gAluO11697ek/QvD3e2E328Guoze', 'MyProfiles/61bdacc1e04883.74028312.jpg', 1, '161bda5cb34baf', '2021-12-18 09:11:39'),
(4, 'Offline', 'keren ruth', 'deski', 'deski@newmail.com', 785412354, 'Female', '$2y$10$alOG4I7cMLr8pDYWy9jMIud76EyZhdXUECVyQAOFD0W7b/9/lVUXm', 'MyProfiles/61bdad72b7ccc8.41903549.jpg', 1, '161bda68014206', '2021-12-18 09:14:40'),
(5, 'Offline', 'Tr Nelly', 'nelly', 'nelly@newmail.com', 784512365, 'Female', '$2y$10$3Hie2cz67imJoUA0PqvWp.xKkEOHcu7.3OH7.hMKVm2yEGynxp9N.', 'MyProfiles/61bdac33489016.78927240.jpg', 1, '161bda724cd19d', '2021-12-18 09:17:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pwd_request`
--
ALTER TABLE `pwd_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_chats`
--
ALTER TABLE `users_chats`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users_records`
--
ALTER TABLE `users_records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pwd_request`
--
ALTER TABLE `pwd_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_chats`
--
ALTER TABLE `users_chats`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_records`
--
ALTER TABLE `users_records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
