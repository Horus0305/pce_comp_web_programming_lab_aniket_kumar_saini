-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 02:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmicdestiny`
--

-- --------------------------------------------------------

--
-- Table structure for table `female`
--

CREATE TABLE `female` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` text NOT NULL,
  `number` bigint(20) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `work` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `compatibility` float DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photocontent` longblob DEFAULT NULL,
  `phototype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `female`
--

INSERT INTO `female` (`id`, `name`, `email`, `pass`, `age`, `gender`, `number`, `city`, `work`, `dob`, `pob`, `tob`, `latitude`, `longitude`, `height`, `weight`, `bmi`, `sign`, `compatibility`, `quote`, `description`, `photocontent`, `phototype`) VALUES
(2, 'Ananya Gupta', 'a@g.com', 'a753c776ff3ed4fefa2af948af87448910153281', 19, 'female', 1234567891, 'kalyan', 'College Student', '2005-03-10', 'Kalyan', '19:33:00', 19.2716, 73.2359, 165, 55, 20.202, 'Pisces', NULL, 'If it is to be it is upto me', 'Hi, I am Ananya', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `liketable`
--

CREATE TABLE `liketable` (
  `id` int(11) NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `r_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `male`
--

CREATE TABLE `male` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` text NOT NULL,
  `number` bigint(20) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `work` text NOT NULL,
  `dob` date DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `compatibility` float NOT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photocontent` longblob DEFAULT NULL,
  `phototype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `male`
--

INSERT INTO `male` (`id`, `name`, `email`, `pass`, `age`, `gender`, `number`, `city`, `work`, `dob`, `pob`, `tob`, `latitude`, `longitude`, `height`, `weight`, `bmi`, `sign`, `compatibility`, `quote`, `description`, `photocontent`, `phototype`) VALUES
(2, 'Arjun  Patel', 'a@p.com', 'a753c776ff3ed4fefa2af948af87448910153281', 19, 'male', 1234567890, 'Kalyan', 'College Student', '2005-03-03', 'Kalyan', '15:13:00', 19.2716, 73.2359, 178, 69, 21.7776, 'Pisces', 0, 'If it is to be it is upto me', 'Hi ! I am Arjun', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matchtable`
--

CREATE TABLE `matchtable` (
  `id` int(11) NOT NULL,
  `u1` int(11) NOT NULL,
  `u2` int(11) NOT NULL,
  `matched` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `female`
--
ALTER TABLE `female`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `liketable`
--
ALTER TABLE `liketable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `male`
--
ALTER TABLE `male`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `number` (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `female`
--
ALTER TABLE `female`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `liketable`
--
ALTER TABLE `liketable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `male`
--
ALTER TABLE `male`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
