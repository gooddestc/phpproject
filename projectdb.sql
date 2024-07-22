-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 10:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `profileimage` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `profileimage`, `email`, `password`, `date`) VALUES
(1, 'peter Idemiri', 'userAvater.jpg', 'xime@gmail.com', '$2y$10$zEkl9jXPhi5IoW6/jP28Qe8dCMRlHxSfeihhHt4oq47Cmg/GwHuIO', '2024-07-13 '),
(2, 'john xime ', NULL, 'john@gmial.com', '$2y$10$B4NW2b1x3GXdN6AX5wYXs.xnadFDfI0vm2Aj92E85sKJXZdLaXWK6', '2024-07-15 '),
(3, 'john gage', NULL, 'kime@gmail.com', '$2y$10$3qJsvAL6SiAk1yrvNgxJ7OIGAu3V1lzGSGfPkM823HZ1CEIQ1NgD2', '2024-07-15 ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profileimage` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `username`, `gender`, `profileimage`, `password`, `country`, `occupation`, `date`) VALUES
(4, 'mira ', 'mick', 'kick', 'mick@gmail.com', 'dan', 'female', '1674331802949.jpg', '$2y$10$2TWa9Lz5KHk.rly7GYjzFuv1ZfypnF25.g/kw9jEG.deV4HG9F5M2', 'Armenia', 'doctor', '2024-06-29 '),
(7, 'john', 'Goodnews', 'xime', 'xime@gmail.com', 'Gstage', 'male', '1674331879841.jpg', '$2y$10$74HjR.ysRAQWSMGJq.ew6OUD1aY6Gldu/AyVk1Tk8p7DN5Ts6ma3G', 'Nigeria', 'doctor', '2024-07-22 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
