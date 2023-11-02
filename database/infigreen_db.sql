-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 04:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infigreen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `admin_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `power` varchar(50) NOT NULL,
  `dob` text NOT NULL,
  `password` text NOT NULL,
  `created_on_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `username`, `email`, `image`, `contact_no`, `gender`, `power`, `dob`, `password`, `created_on_date`) VALUES
(1, 'Tessy', 'tessy@infigreen.com', 'Screenshot (2).png', '9293456587', 'Female', 'Root User', '06/22/1999', '1e05e3ce607becbc7d5c53fa41cc1494', '2023-10-17 09:34:11'),
(2, 'testuser', 'testuser@gmail.com', 'Screenshot (5).png', '1234567896', 'Male', 'General User', '10/11/2023', '11055975f856b0b7fe95f3a12986e7f1', '2023-10-17 09:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `client_cart_qty` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_details`
--

CREATE TABLE `client_details` (
  `client_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `residential_address` mediumtext NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `image` text NOT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `activate_code` varchar(20) DEFAULT NULL,
  `reset_code` varchar(20) DEFAULT NULL,
  `created_on_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_details`
--

INSERT INTO `client_details` (`client_id`, `username`, `email`, `contact_no`, `residential_address`, `city`, `state`, `image`, `password`, `status`, `activate_code`, `reset_code`, `created_on_date`) VALUES
(33, 'dhwaniltest', 'dhwanil@test.com', '9456876123', '122 Graham St', 'Jersey City', 'NJ', 'profile.jpg', '111cddd7d2457c126edac3960206fb7d', 1, NULL, NULL, '2023-10-17'),
(34, 'adityatest', 'aditya@test.com', '1548795268', '546 North st', 'Jersey City', 'NJ', 'profile.jpg', 'c2d5000465bbd132dccecb32e13fa6e0', 0, NULL, NULL, '2023-10-17'),
(35, 'infigreentest', 'infigreen@test.com', '9845496318', '45 Hague St', 'Dallas', 'TX', 'krishnaa.jpg', 'bf269f5a791cc5ed7d0bfdeea44f6358', 1, NULL, NULL, '2023-10-17'),
(39, 'Jaishreeram', 'jaishreeram@abcd.com', 'Null', 'Null', 'Null', 'Null', 'profile.jpg', '3db66ceb605c1bcb779c63e180c4f2d0', 0, '2nMSRXWYckFZ', 'Null', '2023-10-19'),
(40, 'Testuser2', 'testuser2@infigreen.com', 'Null', 'Null', 'Null', 'Null', 'profile.jpg', '4159a0a75b2f427763067baf4cd7b9ef', 1, 'qdZS4zioE26U', 'Null', '2023-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `client_orders`
--

CREATE TABLE `client_orders` (
  `order_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `order_status_id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `order_qty` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `coupon_discount` varchar(255) NOT NULL,
  `order_total_amt` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_delivered_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `contact_id` int(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_on_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_details`
--

CREATE TABLE `coupon_details` (
  `coupon_id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iws_card_details`
--

CREATE TABLE `iws_card_details` (
  `iws_card_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `waste_disposal_id` bigint(20) NOT NULL,
  `card_points` int(20) NOT NULL,
  `waste_weight` decimal(10,0) NOT NULL,
  `deposit_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` bigint(20) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `payment_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_status` text NOT NULL DEFAULT 'Not Paid',
  `amount_paid` varchar(255) NOT NULL,
  `payment_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `p_category_id` bigint(20) NOT NULL,
  `p_type_id` bigint(20) NOT NULL,
  `p_category_title` varchar(255) NOT NULL,
  `p_category_image` text NOT NULL,
  `p_category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `p_id` bigint(20) NOT NULL,
  `p_type_id` bigint(20) NOT NULL,
  `p_category_id` bigint(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `p_sale_price` varchar(255) DEFAULT '0',
  `p_qty` longtext NOT NULL,
  `p_image_1` text NOT NULL,
  `p_image_2` text NOT NULL,
  `p_image_3` text NOT NULL,
  `p_image_4` text NOT NULL,
  `p_details` longtext NOT NULL,
  `p_benefits` longtext NOT NULL,
  `p_video` longtext DEFAULT 'NULL',
  `p_date` date NOT NULL DEFAULT current_timestamp(),
  `product_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `p_type_id` bigint(20) NOT NULL,
  `p_type_title` varchar(255) NOT NULL,
  `p_type_image` text NOT NULL,
  `p_type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waste_deposit`
--

CREATE TABLE `waste_deposit` (
  `waste_disposal_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `passport_photo` text NOT NULL,
  `passport_number` int(20) NOT NULL,
  `waste_deposit_type` varchar(25) NOT NULL,
  `waste_details` text DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Not Approved',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waste_deposit`
--

INSERT INTO `waste_deposit` (`waste_disposal_id`, `client_id`, `passport_photo`, `passport_number`, `waste_deposit_type`, `waste_details`, `status`, `request_date`) VALUES
(2, 33, 'Screenshot (6).png', 1234567890, 'Household Waste, Agricult', 'NULL', 'Not Approved', '2023-10-31 09:53:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_details`
--
ALTER TABLE `client_details`
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `client_orders`
--
ALTER TABLE `client_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contact_details_fbk` (`client_id`);

--
-- Indexes for table `coupon_details`
--
ALTER TABLE `coupon_details`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `iws_card_details`
--
ALTER TABLE `iws_card_details`
  ADD PRIMARY KEY (`iws_card_id`),
  ADD KEY `iws_card_fbk` (`admin_id`),
  ADD KEY `iws_card_fbk2` (`waste_disposal_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`p_category_id`),
  ADD KEY `p_type_id` (`p_type_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_type_id` (`p_type_id`),
  ADD KEY `p_category_id` (`p_category_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`p_type_id`);

--
-- Indexes for table `waste_deposit`
--
ALTER TABLE `waste_deposit`
  ADD PRIMARY KEY (`waste_disposal_id`),
  ADD KEY `waste_disposal_details_fbk` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_details`
--
ALTER TABLE `client_details`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `client_orders`
--
ALTER TABLE `client_orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `contact_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_details`
--
ALTER TABLE `coupon_details`
  MODIFY `coupon_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iws_card_details`
--
ALTER TABLE `iws_card_details`
  MODIFY `iws_card_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `payment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `p_category_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `p_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `p_type_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste_deposit`
--
ALTER TABLE `waste_deposit`
  MODIFY `waste_disposal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`client_id`);

--
-- Constraints for table `client_orders`
--
ALTER TABLE `client_orders`
  ADD CONSTRAINT `client_orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`client_id`),
  ADD CONSTRAINT `client_orders_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`),
  ADD CONSTRAINT `client_orders_ibfk_3` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`);

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_fbk` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`client_id`);

--
-- Constraints for table `coupon_details`
--
ALTER TABLE `coupon_details`
  ADD CONSTRAINT `coupon_details_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_details` (`p_id`);

--
-- Constraints for table `iws_card_details`
--
ALTER TABLE `iws_card_details`
  ADD CONSTRAINT `iws_card_fbk` FOREIGN KEY (`admin_id`) REFERENCES `admin_details` (`admin_id`),
  ADD CONSTRAINT `iws_card_fbk2` FOREIGN KEY (`waste_disposal_id`) REFERENCES `waste_deposit` (`waste_disposal_id`);

--
-- Constraints for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD CONSTRAINT `payment_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `client_orders` (`order_id`),
  ADD CONSTRAINT `payment_status_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`client_id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`p_type_id`) REFERENCES `product_type` (`p_type_id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`p_type_id`) REFERENCES `product_type` (`p_type_id`),
  ADD CONSTRAINT `product_details_ibfk_2` FOREIGN KEY (`p_category_id`) REFERENCES `product_category` (`p_category_id`);

--
-- Constraints for table `waste_deposit`
--
ALTER TABLE `waste_deposit`
  ADD CONSTRAINT `waste_disposal_details_fbk` FOREIGN KEY (`client_id`) REFERENCES `client_details` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
