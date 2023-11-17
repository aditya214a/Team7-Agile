-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 05:28 AM
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

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `p_id`, `client_id`, `client_cart_qty`, `discount`, `total_amount`) VALUES
(3, 10, 33, '2', '10', '250');

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

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`contact_id`, `client_id`, `subject`, `message`, `created_on_date`) VALUES
(1, 33, 'hello world', 'hey there test 1 done.', '2023-11-02 11:14:35'),
(2, 33, 'hello world test 2', 'hey ther doing test 2.', '2023-11-02 11:15:04');

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

--
-- Dumping data for table `iws_card_details`
--

INSERT INTO `iws_card_details` (`iws_card_id`, `admin_id`, `waste_disposal_id`, `card_points`, `waste_weight`, `deposit_time`) VALUES
(1, 1, 3, 50, '2', '2023-11-02 07:51:37');

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

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`p_category_id`, `p_type_id`, `p_category_title`, `p_category_image`, `p_category_description`) VALUES
(1007, 101, 'Air Purifier Plants', 'Air Purifier Plants.jpg', '<p>Air purifying plants are a package of benefits. Planting them is the most cost-effective and healthy way to breathe pure and better air. It also helps improve the atmosphere and productivity around you.</p>\r\n'),
(1008, 101, 'Bonsai', 'Bonsai.jpg', '<p>Bonsai is a Japanese art form using miniature trees grown in containers</p>\r\n'),
(1010, 101, 'Flowering Plants', 'Flowering Plants.jpg', '<p>Flowering plants add an aesthetic appeal to your home garden taking it to the next level of nature&rsquo;s beauty. Today, it is a trend to include flowering house plants into your interior decoration plans.</p>\r\n'),
(1011, 101, 'The Work Desk', 'The Work Desk.jpg', '<p>Plants can transform your <strong>work Desk</strong>&nbsp;into a more peaceful, tranquil and engaging place, but if you&rsquo;re not very green-thumbed, your nice new desk plant could suffer an early demise.&nbsp;</p>\r\n'),
(1014, 102, 'Bamboo Seeds', 'Bamboo Seeds.jpg', '<p>One of the most commonly planted flowering plants in the gardening community is the bamboo. Bamboo seeds are some of the fastest-growing plants and have a substantial tolerance for marginal land.</p>\r\n'),
(1015, 102, 'Fruit Seeds', 'Fruit Seeds.jpg', '<p>If you have been drawn to plants, and more importantly, towards the fruit plants, then chances are it&rsquo;s your ancestral traits of the &ldquo;early man&rdquo; that has kicked in.</p>\r\n'),
(1016, 103, 'Fertilizers', 'fertilizers.jpg', '<p>The soil alone cannot provide the crops wholesome nutrients.</p>\r\n'),
(1017, 103, 'Soil', 'Soil.jpg', '<p>Give your garden its best chance to bloom with our range of soils that help you maintain a lush display of plants</p>\r\n'),
(1018, 104, 'Pruning  and Cutting Tools', 'Pruning and Cutting Tools.jpg', '<p>Every plant/tree needs to be pruned for a well-maintained look. Pruning is an art and can be done effectively only with an efficient set of tools.</p>\r\n'),
(1019, 104, 'Hand Tools', 'Hand Tools.jpg', '<p>Hand Tools are essential if you have a small garden or pot plant at home. Compact in size these tools offer various functionalities such as cultivating the soil, removing weeds, mixing soil with a trowel, etc.</p>\r\n');

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

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`p_id`, `p_type_id`, `p_category_id`, `p_name`, `p_price`, `p_sale_price`, `p_qty`, `p_image_1`, `p_image_2`, `p_image_3`, `p_image_4`, `p_details`, `p_benefits`, `p_video`, `p_date`, `product_view`, `counter`) VALUES
(6, 101, 1007, 'Spider Plant In Yellow Smiley Pot', '250', '180', '25', 'spider-plant-in-yellow-smiley-pot-with-plate_1.jpg', 'spider-plant-in-yellow-smiley-pot-with-plate_2.jpg', 'spider-plant-in-yellow-smiley-pot-with-plate_2.jpg', 'spider-plant-in-yellow-smiley-pot-with-plate_5.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Name- Spider Plant</li>\r\n	<li>Plant Type- Flowering/Airpurifying</li>\r\n	<li>Plant Placement- Indoor/Outdoor</li>\r\n	<li>Plant Height- Upto 4 Inches</li>\r\n	<li>One Yellow Smiley Conical Metal Pot with Plate- 3.5 Inches</li>\r\n</ul>\r\n\r\n<p><strong>Spider Plant Trivia:</strong></p>\r\n\r\n<ul>\r\n	<li>Origin- Spider plant is of South and West African origin and seems to have been introduced into Europe by the end of the 18th century.</li>\r\n	<li>High in vitamins and micronutrients, spider plant contributes to a healthy diet for many rural Africans with limited food budgets.</li>\r\n</ul>\r\n', '<p><strong>Care Instructions</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time.</li>\r\n</ul>\r\n', 'NULL', '2023-11-10', '2023-11-10', 10),
(7, 101, 1007, 'Nolina Palm Plant In  Brass pot', '260', '160', '25', 'nolina-palm-plant-in-beautiful-brass-pot_1.jpg', 'nolina-palm-plant-in-beautiful-brass-pot_2.jpg', 'nolina-palm-plant-in-beautiful-brass-pot_3.jpg', 'nolina-palm-plant-in-beautiful-brass-pot_4.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>One Nolina Palm Plant- Upto 7 Inches</li>\r\n	<li>Plant Type- Airpurifying Foliage</li>\r\n	<li>Plant Placement- Indoor/Outdoor</li>\r\n	<li>TPR Brass Coated Pot Hammered With Stand</li>\r\n	<li>This season of Love, spread happiness with this beautiful gift</li>\r\n</ul>\r\n', '<p><strong>Care Instructions:</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time.</li>\r\n</ul>\r\n', 'NULL', '2023-11-10', '2023-11-10', 4),
(8, 101, 1007, 'Ficus Compactat King and  Queen Pot', '150', '110', '25', 'ficus-compacta-plant-in-king-queen-pot-hand-delivery_1.jpg', 'set-of-2-ficus-compacta-in-king-queen-pots_2.jpg', 'set-of-2-ficus-compacta-in-king-queen-pots_4.jpg', 'set-of-2-ficus-compacta-in-king-queen-pots_6.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>2 Ficus Compacta Plants- Upto 4 Inches</li>\r\n	<li>Plant Type- Foliage/Airpurifying</li>\r\n	<li>Plant Placement- Indoor/Outdoor</li>\r\n	<li>One Resin King Pot- 3 Inches</li>\r\n	<li>One Resin Queen Pot- 3 Inches</li>\r\n</ul>\r\n\r\n<p><strong>Ficus Plant Trivia:</strong></p>\r\n\r\n<ul>\r\n	<li>Origin- Ficus benjamina, commonly known as weeping fig, or Ficus tree is native to Asia and Australia. It is the official tree of Bangkok.</li>\r\n	<li>The ficus plant is great at eliminating pollutants coming out from carpets and furniture like formaldehyde, benzene, and trichloroethylene.</li>\r\n</ul>\r\n', '<p><strong>Care Instructions:</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time</li>\r\n</ul>\r\n', 'NULL', '2023-11-10', '2021-11-10', 0),
(9, 101, 1008, 'Ficus Bonsai', '250', '200', '25', 'Ficus Bonsai.jpg', 'nurserylive-plants-ficus-bonsai-plant-16968858173580_600x600.jpg', 'nurserylive-plants-ficus-bonsai-plant-16968858206348_1140x1140.jpg', 'nurserylive-plants-ficus-bonsai-plant-16968858239116_600x600.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Name- Ficus Ginseng Bonsai</li>\r\n	<li>Plant Type- Bonsai/Air Purifying</li>\r\n	<li>Plant Placement- Indoors &amp; Outdoors</li>\r\n	<li>Plant Height- Upto 7 inches</li>\r\n	<li>One Resin Planter</li>\r\n	<li>Pot Colour- Blue &amp; White</li>\r\n	<li>Pot Dimensions- 4 x 5 inches</li>\r\n</ul>\r\n\r\n<p><strong>Ficus Ginseng Plant Trivia:</strong></p>\r\n\r\n<ul>\r\n	<li>Ficus Ginseng is a species of evergreen woody plant in the fig genus, native to the Malay Archipelago and Malesia floristic region.</li>\r\n	<li>The word &ldquo;ginseng&rdquo; means root in Chinese, and is attributed because of the magnificent aerial root, but its very shiny dark green leaves are equally appealing.</li>\r\n</ul>\r\n', '<p><strong>Care Instructions:</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time.</li>\r\n</ul>\r\n', 'NULL', '2023-11-12', '2023-11-12', 0),
(10, 101, 1008, 'Jade Plant In Sky Blue Ceramic Pot', '130', '125', '25', 'ornamental-jade-plant-in-brass-pot_1.jpg', 'ornamental-jade-plant-in-brass-pot_2.jpg', 'ornamental-jade-plant-in-brass-pot_3.jpg', 'ornamental-jade-plant-in-brass-pot_4.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Name- Jade Plant</li>\r\n	<li>Plant Type- Bonsai/Succulent</li>\r\n	<li>Plant Placement- Indoors/Outdoors</li>\r\n	<li>Plant Height- Upto 7 inches</li>\r\n	<li>Sky Blue Print Ceramic Pot- 5 x 5.75 inches</li>\r\n</ul>\r\n\r\n<p><strong>Plants Trivia:</strong></p>\r\n\r\n<ul>\r\n	<li>Jade Plant originates from South Africa, but it can be found in temperate regions all over the world today.</li>\r\n	<li>Jade plant is considered as a strong symbol of good luck and is often referred to as &ldquo;Money plant&rdquo;, &ldquo;Dollar Plant&rdquo; &amp; &ldquo;Friendship Plant.&rdquo;</li>\r\n</ul>\r\n', '<p><strong>Care Instructions:</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time.</li>\r\n</ul>\r\n', 'NULL', '2023-11-12', '2023-11-12', 1),
(26, 101, 1010, 'Orange Kalanchoe Plant ', '1999', '1700', '25', 'orange-kalanchoe-plant-in-yellow-pot-with-wooden-plate_1.jpg', 'orange-kalanchoe-plant-in-yellow-pot-with-wooden-plate_2.jpg', 'orange-kalanchoe-plant-in-yellow-pot-with-wooden-plate_3.jpg', 'orange-kalanchoe-plant-in-yellow-pot-with-wooden-plate_5.jpg', '<p><strong>Product Details:</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Name- Orange Kalanchoe Plant</li>\r\n	<li>Plant Type- Flowering/Succulent</li>\r\n	<li>Plant Placement- Outdoor</li>\r\n	<li>Plant Height- Upto 6 Inches</li>\r\n	<li>Grey Colour Triangular Shaped Ceramic Pot</li>\r\n	<li>Pot Dimensions- 5 x 6 Inches</li>\r\n</ul>\r\n\r\n<p><strong>Orange Kalanchoe Plant Trivia:</strong></p>\r\n\r\n<ul>\r\n	<li>This plant is known to the Chinese as thousands and millions of red and purple.</li>\r\n	<li>Some species contain toxins that can cause cardiac poisoning in grazing animals.</li>\r\n</ul>\r\n', '<p><strong>Care Instructions:</strong></p>\r\n\r\n<ul>\r\n	<li>Keep plants in medium light locations, out of direct sunlight.</li>\r\n	<li>Natural light is best, but some plants can also thrive in office fluorescent light.</li>\r\n	<li>Plant soil should be kept moist at all time.</li>\r\n	<li>Be careful to avoid overwatering.</li>\r\n	<li>Do not allow plants to stand in water.</li>\r\n	<li>Avoid wetting plant leaves excessively.</li>\r\n	<li>A spray of water should help in case of flowering plants.</li>\r\n	<li>Plants should be kept in a cool spot (between 18-28&deg;C).</li>\r\n	<li>Remove waste leaves and stems from time to time.</li>\r\n</ul>\r\n', 'NULL', '2023-11-13', '2023-11-13', 0);

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

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`p_type_id`, `p_type_title`, `p_type_image`, `p_type_description`) VALUES
(101, 'Plant', 'plant.png', '<p>We often don&#39;t think to buy plant online. But what if we tell you that you can now order the most beautiful plants right from home? InfiGreen presents a broad range of Live Plants that can be bought online in India.Our online nursery collection includes &nbsp;Aromatic and Aquatic Plants, Bonsai, Indoor and Outdoor Plants, Airpurify, Bamboo, etc.</p>\r\n'),
(102, 'Seeds', 'seed.png', '<p>There are numerous benefits of growing plants from organic seeds online. If you start your garden by planting seeds, then you have an extensive range of vegetables, herbs, and flowers to choose from, than if you go down to the nursery to pick up a few nursery-raised plants.</p>\r\n'),
(103, 'Soil and Fertilizers', 'soils-fertilizers.jpeg', '<p>Caring for both indoor and outdoor plants is of vital importance. Every garden needs good plant care supplies to help the plants thrive, grow properly and look visually appealing.</p>\r\n'),
(104, 'Tools  and Accessories', 'tools.jpg', '<p>Gardening is incomplete without maintaining plants. For maintaining plants, one needs excellent quality tools and accessories.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `waste_deposit`
--

CREATE TABLE `waste_deposit` (
  `waste_disposal_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `waste_uniq_id` bigint(20) NOT NULL,
  `waste_type` varchar(25) NOT NULL,
  `waste_details` text DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Not Approved',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waste_deposit`
--

INSERT INTO `waste_deposit` (`waste_disposal_id`, `client_id`, `waste_uniq_id`, `waste_type`, `waste_details`, `status`, `request_date`) VALUES
(2, 33, 1234567890, 'Household Waste, Agricult', 'NULL', 'Not Approved', '2023-10-31 09:53:15'),
(3, 33, 125789, 'Household Waste, Medical ', 'all waste.', 'Not Approved', '2023-11-02 11:37:36');

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
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `contact_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_details`
--
ALTER TABLE `coupon_details`
  MODIFY `coupon_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iws_card_details`
--
ALTER TABLE `iws_card_details`
  MODIFY `iws_card_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `p_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `p_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `p_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `waste_deposit`
--
ALTER TABLE `waste_deposit`
  MODIFY `waste_disposal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
