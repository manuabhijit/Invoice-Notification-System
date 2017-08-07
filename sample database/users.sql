-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 02:57 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(60) NOT NULL,
  `password` varchar(512) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `address`) VALUES
('h@kj.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS\n', 'jhk', 'ssf, fds, fds, sf, fds'),
('h@kjs.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS', 'jhk', 'ssf, fds, fds, sf, fds'),
('user_four@gmail.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS\n', 'User Four', 'Add1, Add2, City1, State, Country'),
('user_one@gmail.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS', 'User One', 'Add part1, Add part2, City1, State1, Country1'),
('user_three@gmail.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS', 'User Three', 'Address1, Address2, City1, State1, Country1'),
('user_two@gmail.com', '$2y$12$heykitheykitheykitheyeJTfen9HxVu6Kpp.NZ6DIfjgasBtplLS\n', 'User Two', 'Address par1, Address par2, City2, State2, Country2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
