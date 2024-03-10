-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2024 at 02:01 PM
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
  `dob` date DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photocontent` longblob DEFAULT NULL,
  `phototype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `dob` date DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photocontent` longblob DEFAULT NULL,
  `phototype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `male`
--

INSERT INTO `male` (`id`, `name`, `email`, `pass`, `age`, `gender`, `number`, `city`, `dob`, `pob`, `tob`, `latitude`, `longitude`, `height`, `weight`, `bmi`, `sign`, `quote`, `description`, `photocontent`, `phototype`) VALUES
(1, 'a s', 'a@s.com', '211b8b86c4ed2c192aa9fa105e656d1facba10ab', 19, 'male', 1234567891, 'kalyan', '2005-03-03', 'Kalyan', '21:26:00', NULL, NULL, 96, 69, 74.8698, NULL, 'If it is to be it is upto ma', 'If it is to be it is upto ma', 0x53637265656e73686f742066726f6d20323032342d30332d30392031342d30342d35392e706e67, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liketable`
--
ALTER TABLE `liketable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `male`
--
ALTER TABLE `male`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
