-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2020 at 08:42 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bistro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`, `id`, `email`, `phone`, `location`, `description`) VALUES
('reeya1', '040ac25923ee3bcb2fcc276476e5b5b3', 1, 'reeya6792@gmail.com', '9818232669', 'haugal', 'reeya'),
('priscilla', '040ac25923ee3bcb2fcc276476e5b5b3', 2, 'prisci1994@gmail.com', '9231492411', 'Ekantakuna', 'i love programming.');

-- --------------------------------------------------------

--
-- Table structure for table `cuisinecats`
--

CREATE TABLE `cuisinecats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisinecats`
--

INSERT INTO `cuisinecats` (`id`, `name`, `description`, `img`) VALUES
(6, 'Nepalese', 'A typical nepalese dish', '5e0c3d77b5c717.42634946.jpeg'),
(9, 'Indian', 'indian food', '5e0c41d254e9a3.39357729.jpeg'),
(8, 'Chinese', 'china food', '5e0c3df73e9539.44334448.jpeg'),
(10, 'Continental', 'continental foods', '5e0c46eb885b65.21271822.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `type_of_qty` varchar(64) NOT NULL,
  `description` varchar(512) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `warmth` varchar(64) NOT NULL,
  `type` varchar(384) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`, `category`, `cat_id`, `type_of_qty`, `description`, `img1`, `img2`, `img3`, `warmth`, `type`) VALUES
(16, 'Mediterrinean Beans', 'Continental', 10, 'n/a', 'Tasty authentic mediterrenan beans', '5e0c4757603437.65145948.jpeg', '5e0c4757603538.23391650.jpeg', '5e0c4757603550.93214886.jpeg', 'not applicable', 'n/a'),
(15, 'Idli', 'Indian', 9, 'piece', 'idli', '5e0c468082b9a4.87967659.jpeg', '5e0c468082ba29.67657381.jpeg', '5e0c468082baf9.14730084.jpeg', 'not applicable', 'non-egg,sweet'),
(14, 'chuankchou', 'Chinese', 8, 'stick', 'chuankchou, simply amazing', '5e0c42aab912e1.56772538.jpeg', '5e0c42aab913a6.34329313.jpeg', '5e0c42aab913d4.69421040.jpeg', 'hot', 'veg,sweet'),
(12, 'chowmein', 'Chinese', 8, 'plate', 'chinese chowmein', '5e0c4216977c44.05840490.jpeg', '5e0c4216977cd5.05408022.jpeg', '5e0c4216977ce6.34209442.jpeg', 'not applicable', 'veg,non-veg,non-egg'),
(8, 'Momo', 'Nepalese', 6, 'plate', 'nepali', '5e0c3e97d292c0.72299625.jpeg', '5e0c3e97d29333.28850225.jpeg', '5e0c3e97d29352.70134279.jpeg', 'not applicable', 'veg,non-veg'),
(9, 'Thakali Khana', 'Nepalese', 6, 'plate', 'dal bhat', '5e0c3f3587e6b8.87816678.jpeg', '5e0c3f3587e730.90931028.jpeg', '5e0c3f3587e756.00700436.jpeg', 'not applicable', 'veg,non-veg'),
(13, 'Dal Dhokli', 'Indian', 9, 'bowl', 'dal dhokli', '5e0c42549bd473.19559293.jpeg', '5e0c42549bd505.23617958.jpeg', '5e0c42549bd525.56742491.jpeg', 'not applicable', 'veg,non-veg,non-egg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Database for storing of customer details.';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `location`, `password`) VALUES
(21, 'rey', 'reeya6792@gmail.com', '9818232669', 'haugal', '97065a3f6bb3708842810b42214223d7'),
(26, 'menu', 'menu@gmail.com', '1234567890', 'Australia', 'ff620737c282c43f0a1c256cf95b22da'),
(29, 'ash_customer', 'praash47@gmail.com', '9813057360', 'Haugal, Lalitpur', 'dbc0f3a8cc39eda28a9f8ef326371f56'),
(30, 'ads', 'adsh@adsh.com', '9822342121', 'nepal', 'e5a8d50ed67e73637b7ef2f0645720eb');

-- --------------------------------------------------------

--
-- Table structure for table `menucats`
--

CREATE TABLE `menucats` (
  `id` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menucats`
--

INSERT INTO `menucats` (`id`, `catname`) VALUES
(6, 'Nepalese'),
(8, 'Chinese'),
(9, 'Indian'),
(10, 'Continental');

-- --------------------------------------------------------

--
-- Table structure for table `menucuis`
--

CREATE TABLE `menucuis` (
  `catname` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `cuiname` varchar(255) NOT NULL,
  `cuiid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menucuis`
--

INSERT INTO `menucuis` (`catname`, `catid`, `cuiname`, `cuiid`) VALUES
('Nepalese', 6, 'Momo', 2),
('Chinese', 8, 'chowmein', 12),
('Indian', 9, 'Dal Dhokli', 13),
('Nepalese', 6, 'Thakali Khana', 9),
('Indian', 9, 'Idli', 15),
('Continental', 10, 'Mediterrinean Beans', 16);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `img`) VALUES
(1, 'Service with Love', '5db825fb3b36d7.11925268.jpg'),
(2, 'Service with Purity', '5db8184d3612d4.90116997.jpg'),
(5, 'Peaceful Environment', '5db826efe01613.10748185.jpg'),
(6, 'Service with Amazingness', '5db8271ca5e2c1.61360556.jpg'),
(7, 'Heavenly Feeling', '5db827c60405b7.62380744.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`email`) VALUES
('laxmishilpakar@gmail.com'),
('nabinm504@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuisinecats`
--
ALTER TABLE `cuisinecats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cuisinecats`
--
ALTER TABLE `cuisinecats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
