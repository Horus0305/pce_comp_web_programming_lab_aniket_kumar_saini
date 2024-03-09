-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2024 at 12:36 PM
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
  `age` int(11) DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `pob` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
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
(1, 'Soumedu', 'soumedumanna1232gmail.com', '1234567890', 18, 'Male', 1234567890, 'West Bengal', '2005-05-17', '15:49:48', 170, 75, 25.9516, 'Taurus', 'If it is to be it is upto me', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo nesciunt minima maxime a ut explicabo culpa, doloremque perspiciatis aliquam. Debitis, temporibus atque fugit.\" ', NULL, 0x53637265656e73686f742066726f6d20323032342d30332d30392031342d30342d35392e706e67);

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
