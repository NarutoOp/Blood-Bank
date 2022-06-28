-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2020 at 08:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15622607_blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_info`
--

CREATE TABLE `blood_info` (
  `id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_info`
--

INSERT INTO `blood_info` (`id`, `h_id`, `blood_type`, `time`) VALUES
(1, 1, 'A+', '2020-12-07 15:50:17'),
(2, 1, 'AB-', '2020-12-07 16:11:01'),
(3, 2, 'B+', '2020-12-08 00:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `h_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hos_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`h_id`, `username`, `hos_name`, `city`, `category`, `password`, `cpassword`) VALUES
(1, 'CityHospital', 'City Hospital', 'Nagpur', 'Govt', '$2y$10$kO/.rdDY0qPrp4wfRMK8nOJKFHohszf7qCvczgt9eEXsjrae2uaPm', '$2y$10$yspxffvgvnoCF1FbkqNXC.pWQf7FcxoM6o/bSo5/YSY0sr0pVQxF.'),
(2, 'LataMangeshkar', 'Lata Mangeshkar', 'Nagpur', 'Govt', '$2y$10$yspUyfrYYE5K96G27n6kF.thWmDlb.rlegcrFYK8p.LE.V8BjKGSy', '$2y$10$faCOrOSOtMSNUii7yav4meZPvC.oLjIrWN1CpSrkUKB2wMkbv1Px.');

-- --------------------------------------------------------

--
-- Table structure for table `reciever`
--

CREATE TABLE `reciever` (
  `r_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `request` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reciever`
--

INSERT INTO `reciever` (`r_id`, `name`, `gender`, `age`, `mobile`, `blood_group`, `email`, `password`, `cpassword`, `request`) VALUES
(4, 'Arpit Sanjay Gupta', '7020113840', 21, 'age', 'B+', 'asgupta@mitaoe.ac.in', '$2y$10$dNtt5/mXnhWUkp3nftAwiekCM73T6j6c92DCRi/E8.1beTUcsnbqu', '$2y$10$KkyfBtiZi9K6OKv1qJm2/OIXsPf0WVnP6jm960c1UiV.ehuljqECK', 'true'),
(5, 'Sujal Gupta', '9881376257', 0, '18', 'B+', 'zingahugane@gmail.com', '$2y$10$GB/Z4oZ/jychOSGMVCwPl.tY08aDKkuEjyA.cV5.Balq2eZqpJyJq', '$2y$10$qqeqGVApQqPL.hPQfjgPPujka7FeQkwnDtmglgMHFeQ5G.CXh6U3O', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `hos_id` int(11) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `rec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `hos_id`, `blood_type`, `rec_id`) VALUES
(10, 2, 'B+', 4),
(11, 2, 'B+', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_info`
--
ALTER TABLE `blood_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `reciever`
--
ALTER TABLE `reciever`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_info`
--
ALTER TABLE `blood_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reciever`
--
ALTER TABLE `reciever`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
