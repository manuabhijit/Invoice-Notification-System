-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 02:42 PM
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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `s_email` varchar(80) NOT NULL,
  `r_email` varchar(80) NOT NULL,
  `r1` varchar(200) NOT NULL,
  `r1_c` varchar(8) NOT NULL,
  `r2` varchar(200) NOT NULL,
  `r2_c` varchar(8) NOT NULL,
  `r3` varchar(200) NOT NULL,
  `r3_c` varchar(8) NOT NULL,
  `r4` varchar(200) NOT NULL,
  `r4_c` varchar(8) NOT NULL,
  `r5` varchar(200) NOT NULL,
  `r5_c` varchar(8) NOT NULL,
  `total_cost` varchar(8) NOT NULL,
  `tax_percent` varchar(8) NOT NULL,
  `notification` varchar(10) NOT NULL,
  `notificaton_type` varchar(10) NOT NULL,
  `notification_message` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `d1` varchar(3) NOT NULL DEFAULT '0',
  `d2` varchar(3) NOT NULL DEFAULT '0',
  `d3` varchar(3) NOT NULL DEFAULT '0',
  `d4` varchar(3) NOT NULL DEFAULT '0',
  `d5` varchar(3) NOT NULL DEFAULT '0',
  `q1` varchar(8) NOT NULL,
  `q2` varchar(8) NOT NULL,
  `q3` varchar(8) NOT NULL,
  `q4` varchar(8) NOT NULL,
  `q5` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `timestamp`, `s_email`, `r_email`, `r1`, `r1_c`, `r2`, `r2_c`, `r3`, `r3_c`, `r4`, `r4_c`, `r5`, `r5_c`, `total_cost`, `tax_percent`, `notification`, `notificaton_type`, `notification_message`, `comment`, `d1`, `d2`, `d3`, `d4`, `d5`, `q1`, `q2`, `q3`, `q4`, `q5`) VALUES
('My_Comp_inv001', '2017-04-07 12:32:34', 'user_three@gmail.com', 'user_three@gmail.com', 'Item_name', '10', 'Item_name', '10', 'Item_name', '10', 'Item_name', '10', 'Item_name', '10', '258', '10', 'reciever', 'passive', 'no_message', '', '14', '14', '14', '14', '14', '6', '6', '6', '6', '6');

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
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
