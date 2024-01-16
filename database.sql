-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 04:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nishancable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(244) NOT NULL,
  `password` varchar(244) NOT NULL,
  `token` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `token`) VALUES
(1, 'neupanerijan6@gmail.com', 'abc', '56765163852831122529');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cuid` int(11) NOT NULL,
  `name` varchar(244) NOT NULL,
  `address` varchar(244) NOT NULL,
  `email` varchar(244) NOT NULL,
  `mobile` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `cuid`, `name`, `address`, `email`, `mobile`) VALUES
(21, 6123884, 'Rijan Neupane', 'Sindhuli, Nepal', '', '9826807700'),
(22, 6274143, 'Praveen Maharjan', 'Basantapur, Kathmandu', 'maharjan.praveen@gmail.com', '9824562757');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `cuid` int(11) NOT NULL,
  `date` varchar(244) NOT NULL,
  `install_charge` int(11) NOT NULL DEFAULT 0,
  `service_charge` int(11) NOT NULL DEFAULT 0,
  `recharge` int(11) NOT NULL DEFAULT 0,
  `item1_name` varchar(244) NOT NULL,
  `item1_amount` int(11) NOT NULL DEFAULT 0,
  `item2_name` varchar(244) DEFAULT NULL,
  `item2_amount` int(11) NOT NULL DEFAULT 0,
  `item3_name` varchar(244) NOT NULL,
  `item3_amount` int(11) NOT NULL DEFAULT 0,
  `item4_name` varchar(244) NOT NULL,
  `item4_amount` int(11) NOT NULL DEFAULT 0,
  `total_exp` int(11) NOT NULL DEFAULT 0,
  `paid` int(11) NOT NULL DEFAULT 0,
  `due` int(11) NOT NULL DEFAULT 0,
  `datetime` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `cuid`, `date`, `install_charge`, `service_charge`, `recharge`, `item1_name`, `item1_amount`, `item2_name`, `item2_amount`, `item3_name`, `item3_amount`, `item4_name`, `item4_amount`, `total_exp`, `paid`, `due`, `datetime`) VALUES
(27, 6123884, '2021-12-10', 2147483647, 124, 234, '', 0, '', 0, '', 0, '', 0, 2147483647, 324, 2147483647, '2021-11-29 10:14:57'),
(28, 6123884, '2024-01-09', 5000, 500, 1075, '', 0, '', 0, '', 0, '', 0, 6575, 6575, 0, '2024-01-09 10:29:02'),
(29, 6274143, '2024-01-10', 987, 9876, 567, 'Laptop', 45678, 'Charger', 986, 'Keyboard', 789, 'Microwave Oven', 345, 59228, 4547, 54681, '2024-01-09 10:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
