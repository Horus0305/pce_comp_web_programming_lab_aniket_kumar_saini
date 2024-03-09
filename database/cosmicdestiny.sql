-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2024 at 05:26 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `age` int(11) DEFAULT 0,
  `gender` text DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `height` int(11) DEFAULT 0,
  `weight` float DEFAULT 0,
  `bmi` float DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `match` int(11) DEFAULT NULL,
  `photo` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `pass`, `age`, `gender`, `number`, `pob`, `dob`, `tob`, `height`, `weight`, `bmi`, `sign`, `quote`, `description`, `match`, `photo`) VALUES
(1, '', 'a@s', '356a192b7913b04c54574d18c28d46e6395428ab', 19, 'Male', 1234567891, 'Kalyan', '2005-03-03', '03:10:00', 178, 98, 30.9304, NULL, 'If it is to be it is upto ma', 'If it is to be it is upto ma', NULL, 0x53637265656e73686f742066726f6d20323032342d30332d30352032332d35362d31332e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `match` (`match`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
