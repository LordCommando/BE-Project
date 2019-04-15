-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2019 at 11:34 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darktest`
--

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `fid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `i` int(11) NOT NULL,
  `temp` float NOT NULL,
  `humidity` float NOT NULL,
  `pressure` float NOT NULL,
  `wind` float NOT NULL,
  `summary` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`fid`, `timestamp`, `i`, `temp`, `humidity`, `pressure`, `wind`, `summary`) VALUES
(0, '2019-03-25 13:28:52', 0, 109.33, 0.24, 1009.73, 3.76, 'Foggy in the morning.'),
(0, '2019-03-25 13:28:52', 1, 103.71, 0.26, 1010.99, 6.67, 'Clear throughout the day.'),
(0, '2019-03-25 13:28:52', 2, 100.45, 0.32, 1012.22, 2.94, 'Clear throughout the day.'),
(0, '2019-03-25 13:28:52', 3, 98.97, 0.5, 1011.94, 2.86, 'Clear throughout the day.'),
(0, '2019-03-25 13:28:52', 4, 100.47, 0.39, 1010.15, 4.55, 'Clear throughout the day.'),
(0, '2019-03-25 13:28:52', 5, 99.72, 0.43, 1009.84, 5.1, 'Clear throughout the day.'),
(0, '2019-03-25 13:28:52', 6, 98.11, 0.52, 1009.76, 3.6, 'Clear throughout the day.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`fid`,`timestamp`,`i`),
  ADD KEY `fid` (`fid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
