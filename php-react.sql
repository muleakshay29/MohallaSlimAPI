-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 02:35 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-react`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Smartphone', 'Not a stupid phone', '2015-08-02 23:56:46', '2016-12-20 06:51:25'),
(2, 'Tablet', 'A small smartphone-laptop mix', '2015-08-02 23:56:46', '2016-12-20 06:51:42'),
(3, 'Ultrabook', 'Ultra portable and powerful laptop', '2016-12-20 13:51:15', '2016-12-20 06:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE `city_master` (
  `City_id` int(11) NOT NULL,
  `Country_id` int(11) NOT NULL,
  `State_id` int(11) NOT NULL,
  `City_name` varchar(25) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`City_id`, `Country_id`, `State_id`, `City_name`, `created`) VALUES
(1, 1, 3, 'Mumbai', '2018-07-31 13:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `city_master_old`
--

CREATE TABLE `city_master_old` (
  `City_id` int(11) NOT NULL,
  `Country_id` int(11) NOT NULL,
  `State_id` int(11) NOT NULL,
  `City_name` varchar(25) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_master_old`
--

INSERT INTO `city_master_old` (`City_id`, `Country_id`, `State_id`, `City_name`, `created`) VALUES
(1, 1, 2, 'Ichalkaranji', '2018-06-12 13:45:52'),
(2, 1, 1, 'Noida', '2018-06-12 13:48:31'),
(3, 1, 2, 'Satara', '2018-06-12 13:49:55'),
(5, 1, 2, 'Kolhapur', '2018-07-11 11:51:09'),
(6, 1, 2, 'Sangli', '2018-07-11 11:51:07'),
(7, 1, 2, 'Miraj', '2018-07-11 11:40:49'),
(8, 1, 2, 'Solapur', '2018-07-11 10:14:40'),
(9, 1, 3, 'Pune', '2018-07-12 11:30:50'),
(13, 1, 3, 'Nashik', '2018-07-12 13:51:57'),
(14, 1, 3, 'Latur', '2018-07-12 14:09:54'),
(17, 1, 3, 'Karad', '2018-07-12 14:04:03'),
(19, 1, 3, 'Wai', '2018-07-12 14:06:53'),
(20, 1, 3, 'Mahabaleshwar', '2018-07-13 08:01:14'),
(21, 1, 6, 'Gurgaon', '2018-07-16 08:25:09'),
(22, 1, 6, 'Rohtak', '2018-07-16 08:25:21'),
(23, 1, 6, 'Faridabad', '2018-07-16 08:25:34'),
(24, 1, 6, 'Jhajjhar', '2018-07-16 08:25:52'),
(25, 1, 6, 'Mewat', '2018-07-16 08:26:06'),
(26, 1, 6, 'Sonepat', '2018-07-16 08:26:27'),
(27, 1, 6, 'Palwal', '2018-07-16 08:26:40'),
(28, 1, 6, 'Rewari', '2018-07-16 08:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE `country_master` (
  `Country_id` int(11) NOT NULL,
  `Country_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`Country_id`, `Country_name`) VALUES
(1, 'India'),
(2, 'USA'),
(3, 'Australia'),
(4, 'Brazil'),
(5, 'Canada'),
(6, 'Denmark'),
(7, 'Egypt'),
(8, 'Germany'),
(9, 'Hong Kong'),
(10, 'Japan'),
(11, 'Kenya'),
(12, 'Liberia'),
(13, 'Mexico'),
(14, 'Nepal'),
(15, 'Oman'),
(16, 'Philippines'),
(17, 'Qatar'),
(18, 'Russia'),
(19, 'South Africa'),
(20, 'Taiwan'),
(21, 'Vietnam'),
(22, 'Yemen');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modified`) VALUES
(32, 'ASUS Zenbook 3', 'The most powerful and ultraportable Zenbook ever', 1799, 3, '2016-12-20 13:53:00', '2016-12-20 06:53:00'),
(33, 'Dell XPS 13', 'Super powerful and portable ultrabook with ultra thin bezel infinity display', 2199, 3, '2016-12-20 13:53:34', '2016-12-20 06:53:34'),
(34, 'Samsung Galaxy S7', 'Define what a phone can do', 649, 1, '2016-12-20 13:54:16', '2016-12-20 06:54:16'),
(35, 'Samsung Galaxy Tab S2', 'Latest Generation of Samsung Galaxy Tab Series tablet', 599, 2, '2016-12-20 13:54:43', '2016-12-20 06:54:43'),
(36, 'Apple iPad Pro', 'Powerful, thin, and light tablet from Apple', 899, 2, '2016-12-20 13:55:02', '2016-12-20 06:55:02'),
(37, 'Google Pixel', 'World\'s leading smartphone camera, first phone by Google.', 649, 1, '2016-12-20 13:55:23', '2016-12-20 06:55:23'),
(38, 'Oneplus 3T', 'Never Settle', 439, 1, '2016-12-20 13:59:06', '2016-12-20 06:59:06'),
(39, 'Asus Zenfone 3 Deluxe', 'Super powerful and gorgeously designed phablet', 799, 1, '2016-12-20 13:59:37', '2016-12-20 06:59:37'),
(40, 'Xiaomi Mi Mix', 'Bezelless. Powerful. Gorgeous.', 699, 1, '2016-12-20 14:00:20', '2016-12-20 07:00:20'),
(41, 'Huawei P9', 'First Leica Branded Dual-camera Smartphone', 499, 1, '2016-12-20 14:00:45', '2016-12-20 07:00:45'),
(42, 'Xiaomi Mi 5S', 'First Xiaomi smartphone to come with light-sensitive camera', 349, 1, '2016-12-20 14:01:40', '2016-12-20 07:10:14'),
(43, 'LG V20', 'Superb dual camera, Space-grade Aluminum build, fantastic sound quality', 749, 1, '2016-12-20 14:02:28', '2016-12-20 07:02:28'),
(44, 'Moto G6', 'Moto G6 smartphone', 14999, 2, '2018-06-12 11:37:31', '2018-06-12 09:37:31'),
(46, '1', 'Kolhapur', 13999, 2, '2018-06-12 12:24:52', '2018-06-12 10:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `State_id` int(11) NOT NULL,
  `Country_id` int(11) NOT NULL,
  `State_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`State_id`, `Country_id`, `State_name`) VALUES
(1, 1, 'Delhi'),
(2, 1, 'Punjab'),
(3, 1, 'Maharashtra'),
(4, 1, 'Karnataka'),
(5, 1, 'Haryana'),
(6, 1, 'Uttar Pradesh'),
(7, 1, 'Rajasthan'),
(8, 1, 'Goa'),
(9, 1, 'Tamilnadu'),
(10, 1, 'Andhra Pradesh'),
(11, 2, 'Washington'),
(12, 2, 'Texas'),
(13, 2, 'New York'),
(14, 2, 'New Mexico'),
(15, 2, 'Florida'),
(16, 2, 'California'),
(17, 2, 'Alaska');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin@react-crud.com', '$2y$10$98uieNukRl.w8dY3O.sTiegbcCuXueuDX9Df174wjaUBO4uTFQ91S', '2016-12-23 02:54:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
  ADD PRIMARY KEY (`City_id`);

--
-- Indexes for table `city_master_old`
--
ALTER TABLE `city_master_old`
  ADD PRIMARY KEY (`City_id`);

--
-- Indexes for table `country_master`
--
ALTER TABLE `country_master`
  ADD PRIMARY KEY (`Country_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`State_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
  MODIFY `City_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city_master_old`
--
ALTER TABLE `city_master_old`
  MODIFY `City_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `country_master`
--
ALTER TABLE `country_master`
  MODIFY `Country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `State_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
