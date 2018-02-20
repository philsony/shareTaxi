-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2018 at 11:53 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharetaxi-route`
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
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 2, 4),
(6, 1, 5),
(7, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `origin_latitude` decimal(11,8) NOT NULL,
  `origin_longitude` decimal(11,8) NOT NULL,
  `destination_latitude` decimal(11,8) NOT NULL,
  `destination_longitude` decimal(11,8) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `origin_address` varchar(50) NOT NULL,
  `destination_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_time`, `end_time`, `origin_latitude`, `origin_longitude`, `destination_latitude`, `destination_longitude`, `status`, `cost`, `origin_address`, `destination_address`) VALUES
(1, '2018-02-15 00:00:00', '2018-02-17 00:00:00', '48.85660000', '2.35220000', '51.50740000', '-0.12780000', 'WAITING', 200, 'Paris, France', 'London, England'),
(2, '2018-02-15 00:00:00', '2018-02-22 00:00:00', '48.85660000', '2.35220000', '35.68950000', '139.69170000', 'WAITING', 555, 'Paris, France', 'Tokyo, Japan'),
(3, '2018-02-09 00:00:00', '2018-02-10 00:00:00', '48.85660000', '2.35220000', '51.50740000', '-0.12780000', 'WAITING', 500, 'Paris, France', 'London, England'),
(4, '2018-02-16 00:00:00', '2018-02-24 00:00:00', '50.22200000', '2.35220000', '9.85000000', '124.14350000', 'WAITING', 10000, 'Bouquemaison, France', 'Bohol, Philippines'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '10.35037190', '0.00000000', '10.31892970', '123.90415530', 'Waiting', 0, 'Damascus Rd, Cebu City, Cebu, Philippines', 'Ayala Center Cebu Tower, Cebu, Philippines');

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
  `location_latitude` decimal(11,8) NOT NULL,
  `location_longitude` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `date_joined`, `location_latitude`, `location_longitude`) VALUES
(1, 'carlo janea', 'bekek', '123456', '0000-00-00 00:00:00.000000', '48.85660000', '2.35220000'),
(2, 'Renie Mimo', 'carloisnoob', 'reni@gmail.com', '2018-02-08 00:00:00.000000', '10.31570000', '123.88540000');

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
  MODIFY `pool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pool`
--
ALTER TABLE `pool`
  ADD CONSTRAINT `pool_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pool_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
