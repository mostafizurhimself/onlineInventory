-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2019 at 10:00 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(15, 'China Shoe', 'active'),
(16, 'Bangladeshi Shoe', 'active'),
(17, 'Italy', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order`
--

CREATE TABLE `inventory_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `order_total` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) NOT NULL DEFAULT 'bKash',
  `cod` int(11) NOT NULL DEFAULT 0,
  `courier_charge` int(11) NOT NULL DEFAULT 0,
  `customer_name` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `order_from` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `shipping_charge` int(11) NOT NULL DEFAULT 0,
  `net_total` int(11) NOT NULL DEFAULT 0,
  `delivery_by` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order`
--

INSERT INTO `inventory_order` (`order_id`, `user_id`, `payment_status`, `order_date`, `order_total`, `payment_method`, `cod`, `courier_charge`, `customer_name`, `customer_mobile`, `customer_address`, `order_from`, `reference_no`, `shipping_charge`, `net_total`, `delivery_by`, `remarks`, `order_status`) VALUES
(36, 0, 'Pending', '2019-10-29', 9580, 'COD', 96, 0, 'Ahmed Shakil', '01834507645', '63/a, Ulon, Rampura, Dhaka-1219\n100/a, Ulon, Rampura, Dhaka-1219', 'Facebook', '', 100, 9484, 'Unbooked', '', 1),
(37, 0, 'Complete', '2019-10-28', 11320, 'Hand Cash', 0, 0, 'Ahmed Shakil', '01834507645', '63/a, Ulon, Rampura, Dhaka-1219\n100/a, Ulon, Rampura, Dhaka-1219', 'Online', '234', 0, 11320, 'Pathao', '', 1),
(38, 0, 'Pending', '2019-10-27', 5010, 'COD', 50, 0, 'As Graphic Solution', '01834507645', '63/a, Ulon, Rampura, Dhaka-1219\n100/a, Ulon, Rampura, Dhaka-1219', 'Facebook', '', 0, 4960, 'Unbooked', '', 1),
(40, 0, 'Pending', '2019-10-26', 800, 'Hand Cash', 0, 0, 'Dutch-Bangla LImited', '01834507645', '63/a, Ulon, Rampura, Dhaka-1219\n100/a, Ulon, Rampura, Dhaka-1219', 'Online', '', 0, 800, 'Unbooked', '', 1),
(41, 0, 'Complete', '2019-10-26', 650, 'Hand Cash', 0, 0, 'Fahim', '0843250824350', '3, qer, qe, 234', 'Facebook', '', 100, 650, 'Showroom', '', 1),
(42, 0, 'Complete', '2019-10-25', 10120, 'bKash', 0, 0, 'Mahim', '9275925`', '108 third avenue', 'Facebook', '', 0, 10120, 'Unbooked', '', 1),
(43, 0, 'Complete', '2019-10-24', 10900, 'SSL', 0, 0, 'Rafi', '7346396807', 'tst , aldjfa, asdfq2erewr, 5435', 'Facebook', '', 100, 10900, 'Unbooked', '', 1),
(44, 0, 'Pending', '2019-10-23', 24180, 'Hand Cash', 0, 0, 'Ahmed L. Shakil', '7346396807', '108 third avenue', 'Facebook', '', 0, 24180, 'Unbooked', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order_product`
--

CREATE TABLE `inventory_order_product` (
  `inventory_order_product_id` int(11) NOT NULL,
  `order_id_foreign` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `sale_status` int(11) NOT NULL DEFAULT 1,
  `sale_date` date DEFAULT NULL,
  `product_size` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order_product`
--

INSERT INTO `inventory_order_product` (`inventory_order_product_id`, `order_id_foreign`, `product_id`, `quantity`, `price`, `tax`, `product_code`, `sale_status`, `sale_date`, `product_size`, `product_name`, `product_price`, `discount`, `total`) VALUES
(82, 1, 0, 12, 0.00, 0.00, '490', 1, '2019-10-29', '', 'Bata', 790, 0, 9480),
(83, 37, 0, 7, 0.00, 0.00, 'CR234', 1, '2019-10-29', 'M', 'Craft', 400, 0, 2800),
(84, 37, 0, 4, 0.00, 0.00, 'AASDFADSF', 1, '2019-10-29', 'L', 'Loto', 2130, 0, 8520),
(85, 38, 0, 6, 0.00, 0.00, '490', 1, '2019-10-29', 'J', 'Bata', 790, 0, 4740),
(86, 38, 0, 9, 0.00, 0.00, 'DAFDFS', 1, '2019-10-29', '5', 'Ziels', 30, 0, 270),
(87, 38, 0, 6, 0.00, 0.00, '490', 1, '2019-10-29', 'J', 'Bata', 790, 0, 4740),
(88, 38, 0, 9, 0.00, 0.00, 'DAFDFS', 1, '2019-10-29', '5', 'Ziels', 30, 0, 270),
(89, 39, 0, 2, 0.00, 0.00, 'CR234', 1, '2019-10-29', '', 'Craft', 400, 0, 800),
(90, 41, 0, 1, 0.00, 0.00, 'CR234', 1, '2019-10-29', '', 'Craft', 400, 0, 400),
(91, 41, 0, 5, 0.00, 0.00, 'DAFDFS', 1, '2019-10-29', '', 'Ziels', 30, 0, 150),
(92, 42, 0, 4, 0.00, 0.00, 'AASDFADSF', 1, '2019-10-29', '', 'Loto', 2130, 0, 8520),
(93, 42, 0, 4, 0.00, 0.00, 'CR234', 1, '2019-10-29', '', 'Craft', 400, 0, 1600),
(94, 43, 0, 5, 0.00, 0.00, 'AASDFADSF', 1, '2019-10-29', '', 'Loto', 2130, 0, 10650),
(95, 43, 0, 5, 0.00, 0.00, 'DAFDFS', 1, '2019-10-29', '', 'Ziels', 30, 0, 150),
(96, 44, 0, 6, 0.00, 0.00, 'DAFDFS', 1, '2019-10-29', '', 'Ziels', 30, 0, 180),
(97, 44, 0, 8, 0.00, 0.00, 'EA78', 1, '2019-10-29', '', 'Easy', 3000, 0, 24000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_description` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_unit` varchar(150) NOT NULL,
  `product_base_price` double(10,2) NOT NULL,
  `product_tax` decimal(4,2) NOT NULL,
  `product_minimum_order` double(10,2) NOT NULL,
  `product_enter_by` int(11) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL,
  `product_date` date NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_stocks` int(11) NOT NULL DEFAULT 0,
  `product_returns` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `product_price` int(11) NOT NULL DEFAULT 0,
  `special_price` int(11) NOT NULL DEFAULT 0,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_description`, `product_quantity`, `product_unit`, `product_base_price`, `product_tax`, `product_minimum_order`, `product_enter_by`, `product_status`, `product_date`, `product_code`, `product_stocks`, `product_returns`, `discount`, `product_price`, `special_price`, `category`) VALUES
(25, 0, 0, 'Bata', '', 0, '', 0.00, '0.00', 0.00, 0, 'active', '0000-00-00', '490', 20, 0, 0, 790, 790, 'Bangladeshi Shoe'),
(26, 0, 0, 'Loto', '', 0, '', 0.00, '0.00', 0.00, 0, 'active', '0000-00-00', 'AASDFADSF', 60, 0, 0, 2130, 2130, 'China Shoe'),
(27, 0, 0, 'Ziels', '', 0, '', 0.00, '0.00', 0.00, 0, 'active', '0000-00-00', 'DAFDFS', 50, 0, 0, 30, 30, 'Bangladeshi Shoe'),
(28, 0, 0, 'Craft', '', 0, '', 0.00, '0.00', 0.00, 0, 'active', '0000-00-00', 'CR234', 30, 0, 0, 400, 400, 'China Shoe'),
(29, 0, 0, 'Easy', '', 0, '', 0.00, '0.00', 0.00, 0, 'active', '0000-00-00', 'EA78', 50, 0, 0, 3000, 3000, 'China Shoe');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_type` enum('master','user') NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_email`, `user_password`, `user_name`, `user_type`, `user_status`) VALUES
(1, '999itsolution@gmail.com', '$2y$10$cus3Uper8NGFKvkGKhbV2O1.TnJy1vw8gvgWp7HDxF1hm059l0zxy', 'Admin', 'master', 'Active'),
(11, 'asgraphicsolution@gmail.com', '$2y$10$QsIg5BtLXps3QqHzkZxVJeYS5gSYxOoSZG7ZXCz2OxI46R60.AKEW', 'Ahmed Shakil', 'user', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory_order`
--
ALTER TABLE `inventory_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  ADD PRIMARY KEY (`inventory_order_product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inventory_order`
--
ALTER TABLE `inventory_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  MODIFY `inventory_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
