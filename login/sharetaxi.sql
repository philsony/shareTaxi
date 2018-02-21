-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 07:43 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharetaxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pool`
--

CREATE TABLE `pool` (
  `pool_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pool`
--

INSERT INTO `pool` (`pool_id`, `user_id`, `route_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `origin_latitude` int(11) NOT NULL,
  `origin_longitude` int(11) NOT NULL,
  `destination_latitude` int(11) NOT NULL,
  `destination_longitude` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_time`, `end_time`, `origin_latitude`, `origin_longitude`, `destination_latitude`, `destination_longitude`, `status`, `cost`) VALUES
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 124, 10, 124, 'Waiting', 0),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 124, 10, 124, 'Waiting', 0),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 124, 10, 124, 'Waiting', 0),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 124, 10, 124, 'Waiting', 0),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 124, 10, 123, 'Waiting', 0),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 'Waiting', 0),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 15, 121, 16, 121, 'Waiting', 0),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 'Waiting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  `location_latitude` int(11) NOT NULL,
  `location_longitude` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `date_joined`, `location_latitude`, `location_longitude`) VALUES
(1, 'test', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', 'test@test.com', '2018-02-16 06:30:14.000000', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pool`
--
ALTER TABLE `pool`
  ADD PRIMARY KEY (`pool_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pool`
--
ALTER TABLE `pool`
  MODIFY `pool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pool`
--
ALTER TABLE `pool`
  ADD CONSTRAINT `pool_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pool_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
