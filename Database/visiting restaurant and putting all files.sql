-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2020 at 01:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_orders`
--

CREATE TABLE `current_orders` (
  `id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `items` varchar(200) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `items_amount` varchar(300) NOT NULL,
  `discount` int(11) NOT NULL,
  `waiter` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_num` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL,
  `join_date` varchar(255) NOT NULL,
  `leave_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `mobile_num`, `salary`, `roll`, `join_date`, `leave_date`) VALUES
(1, 'Ashraf', 'waiter1@gmail.com', '030303003', '20000', 1, '13-10-2020', ''),
(2, 'Asif', 'waiter2@gmail.com', '030303003', '20000', 1, '13-10-2020', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `cat_name`) VALUES
(1, 'Paratha'),
(2, 'Chai Karak'),
(3, 'BBQ'),
(4, 'Roll'),
(5, 'Karhai'),
(6, 'Broast'),
(7, 'Fast Food'),
(8, 'Fries'),
(9, 'Naan Roti'),
(10, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_image` varchar(1000) NOT NULL,
  `item_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `item_name`, `item_image`, `item_cat`) VALUES
(1, 'ALOO PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/1.jpg', 1),
(2, 'ALOO CHEESE PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/2.jpg', 1),
(3, 'CHICKEN PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/3.jpg', 1),
(4, 'CHICKEN CHEESE PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/4.jpg', 1),
(5, 'BBQ PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/5.jpg', 1),
(6, 'BBQ CHEESE PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/6.jpg', 1),
(7, 'FAJEETA PIZZA PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/7.jpg', 1),
(8, 'OMELET PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/8.jpg', 1),
(9, 'OMELET CHEESE PARATHA', 'http://127.0.0.1/Restaurant/assets/img/1/9.jpg', 1),
(10, 'PARATHA & KARAK SPECIAL', 'http://127.0.0.1/Restaurant/assets/img/1/10.jpg', 1),
(11, 'DOODH PATTI CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/11.jpg', 2),
(12, 'MATKA CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/12.jpg', 2),
(13, 'ELAICHI CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/13.jpg', 2),
(14, 'GINGER CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/14.jpg', 2),
(15, 'KASHMIRI CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/15.jpg', 2),
(16, 'SULEMANI CHAI', 'http://127.0.0.1/Restaurant/assets/img/2/16.jpg', 2),
(17, 'SABZ CHAI (QAHWA)', 'http://127.0.0.1/Restaurant/assets/img/2/17.jpg', 2),
(18, 'COFFEE ESPRESSO', 'http://127.0.0.1/Restaurant/assets/img/2/18.jpg', 2),
(19, 'CHICKEN TIKKA', 'http://127.0.0.1/Restaurant/assets/img/3/19.jpg', 3),
(20, 'CHICKEN GREEN TIKKA', 'http://127.0.0.1/Restaurant/assets/img/3/20.jpg', 3),
(21, 'CHICKEN BOTI (Boneless)', 'http://127.0.0.1/Restaurant/assets/img/3/21.jpg', 3),
(22, 'CHICKEN MALAI BOTI (Boneless)', 'http://127.0.0.1/Restaurant/assets/img/3/22.jpg', 3),
(23, 'CHICKEN BEHARI BOTI (Boneless)', 'http://127.0.0.1/Restaurant/assets/img/3/23.jpg', 3),
(24, 'CHICKEN GREEN BOTI (Boneless)', 'http://127.0.0.1/Restaurant/assets/img/3/24.jpg', 3),
(25, 'CHICKEN RESHMI KABAB', 'http://127.0.0.1/Restaurant/assets/img/3/25.jpg', 3),
(26, 'CHICKEN CHATNI ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/26.jpg', 4),
(27, 'CHICKEN BEHARI ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/27.jpg', 4),
(28, 'CHICKEN MALAI BOTI ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/28.jpg', 4),
(29, 'CHICKEN CHAPATI ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/29.jpg', 4),
(30, 'CHICKEN BROAST ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/30.jpg', 4),
(31, 'CHICKEN GARLIC MAYO ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/31.jpg', 4),
(32, 'VEGETABLE ROLL', 'http://127.0.0.1/Restaurant/assets/img/4/32.jpg', 4),
(33, 'CHICKEN KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/33.jpg', 5),
(34, 'CHICKEN BROWN KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/34.jpg', 5),
(35, 'CHICKEN WHITE KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/35.jpg', 5),
(36, 'MUTTON KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/36.jpg', 5),
(37, 'MUTTON BROWN KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/37.jpg', 5),
(38, 'MUTTON WHITE KARAHI', 'http://127.0.0.1/Restaurant/assets/img/5/38.jpg', 5),
(39, 'CRISPY BROAST', 'http://127.0.0.1/Restaurant/assets/img/6/39.jpg', 6),
(40, 'SPICY BROAST', 'http://127.0.0.1/Restaurant/assets/img/6/40.jpg', 6),
(41, 'GARLIC MAYO BROAST', 'http://127.0.0.1/Restaurant/assets/img/6/41.jpg', 6),
(42, 'CHICKEN BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/42.jpg', 7),
(43, 'CHICKEN CHEESE BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/43.jpg', 7),
(44, 'ZINGER BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/44.jpg', 7),
(45, 'ZINGER BURGER WITH CHEESE', 'http://127.0.0.1/Restaurant/assets/img/7/45.jpg', 7),
(46, 'EXTREME ZINGER BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/46.jpg', 7),
(47, 'CHICKEN BBQ BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/47.jpg', 7),
(48, 'CHICKEN MALAI BURGER', 'http://127.0.0.1/Restaurant/assets/img/7/48.jpg', 7),
(49, 'CHICKEN SANDWICH', 'http://127.0.0.1/Restaurant/assets/img/7/49.jpg', 7),
(50, 'CHICKEN CLUB SANDWICH', 'http://127.0.0.1/Restaurant/assets/img/7/50.jpg', 7),
(51, 'CHICKEN BBQ CLUB SANDWICH', 'http://127.0.0.1/Restaurant/assets/img/7/51.jpg', 7),
(52, 'BBQ MALAI CLUB SANDWICH', 'http://127.0.0.1/Restaurant/assets/img/7/52.jpg', 7),
(53, 'HOT JUMBO FRIES', 'http://127.0.0.1/Restaurant/assets/img/8/53.jpg', 8),
(54, 'SPICY FRIES', 'http://127.0.0.1/Restaurant/assets/img/8/54.jpg', 8),
(55, 'SPICY MAYO GARLIC FRIES', 'http://127.0.0.1/Restaurant/assets/img/8/55.jpg', 8),
(56, 'NAAN', 'http://127.0.0.1/Restaurant/assets/img/9/56.jpg', 9),
(57, 'GARLIC NAAN', 'http://127.0.0.1/Restaurant/assets/img/9/57.jpg', 9),
(58, 'ROGHANI NAAN', 'http://127.0.0.1/Restaurant/assets/img/9/58.jpg', 9),
(59, 'CHAPATI', 'http://127.0.0.1/Restaurant/assets/img/9/59.jpg', 9),
(60, 'SALAD', 'http://127.0.0.1/Restaurant/assets/img/9/60.jpg', 9),
(61, 'RAITA', 'http://127.0.0.1/Restaurant/assets/img/9/61.jpg', 9),
(62, 'REGULAR COLD DRINK', 'http://127.0.0.1/Restaurant/assets/img/10/62.jpg', 10),
(63, 'CAN', 'http://127.0.0.1/Restaurant/assets/img/10/63.jpg', 10),
(64, 'DISPOSABLE COLD DRINK', 'http://127.0.0.1/Restaurant/assets/img/10/64.jpg', 10),
(65, 'MINERAL WATER SMALL', 'http://127.0.0.1/Restaurant/assets/img/10/65.jpg', 10),
(66, 'MINERAL WATER LARGE', 'http://127.0.0.1/Restaurant/assets/img/10/66.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders_history`
--

CREATE TABLE `orders_history` (
  `id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `items` varchar(200) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `items_amount` varchar(300) NOT NULL,
  `discount` double NOT NULL,
  `waiter` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `item_id`, `size`, `price`) VALUES
(1, 1, '1', 120),
(2, 2, '1', 150),
(3, 3, '1', 200),
(4, 4, '1', 250),
(5, 5, '1', 250),
(6, 6, '1', 300),
(7, 7, '1', 300),
(8, 8, '1', 100),
(9, 9, '1', 120),
(10, 10, '1', 350),
(11, 11, '1', 40),
(12, 12, '1', 100),
(13, 13, '1', 50),
(14, 14, '1', 50),
(15, 15, '1', 80),
(16, 16, '1', 70),
(17, 17, '1', 40),
(18, 18, '1', 80),
(19, 19, '1', 190),
(20, 20, '1', 210),
(21, 21, '1', 350),
(22, 22, '1', 350),
(23, 23, '1', 350),
(24, 24, '1', 350),
(25, 25, '1', 350),
(30, 26, '1', 110),
(31, 27, '1', 110),
(32, 28, '1', 110),
(40, 29, '1', 110),
(41, 30, '1', 140),
(42, 31, '1', 130),
(43, 32, '1', 70),
(44, 33, 'HALF', 500),
(45, 33, 'FULL', 990),
(46, 34, 'HALF', 500),
(47, 34, 'FULL', 990),
(48, 35, 'HALF', 550),
(49, 35, 'FULL', 1050),
(50, 36, 'HALF', 950),
(51, 36, 'FULL', 1850),
(52, 37, 'HALF', 950),
(53, 37, 'FULL', 1850),
(54, 38, 'HALF', 950),
(55, 38, 'FULL', 1850),
(56, 39, '1', 230),
(57, 40, '1', 250),
(58, 41, '1', 270),
(59, 42, '1', 170),
(60, 43, '1', 200),
(61, 44, '1', 250),
(62, 45, '1', 270),
(63, 46, '1', 450),
(64, 47, '1', 190),
(65, 48, '1', 220),
(66, 49, '1', 150),
(67, 50, '1', 200),
(68, 51, '1', 220),
(69, 52, '1', 220),
(70, 53, '1', 120),
(71, 54, '1', 140),
(72, 55, '1', 170),
(73, 56, '1', 20),
(74, 57, '1', 30),
(75, 58, '1', 30),
(76, 59, '1', 20),
(77, 60, '1', 50),
(78, 61, '1', 50),
(79, 62, '1', 40),
(80, 63, '1', 80),
(81, 64, '1', 70),
(82, 65, '1', 40),
(83, 66, '1', 60);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_num` int(11) NOT NULL,
  `current_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_num`, `current_status`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0),
(11, 11, 0),
(12, 12, 0),
(13, 13, 0),
(14, 14, 0),
(15, 15, 0),
(16, 16, 0),
(17, 17, 0),
(18, 18, 0),
(19, 19, 0),
(20, 20, 0),
(21, 21, 0),
(22, 22, 0),
(23, 23, 0),
(24, 24, 0),
(25, 25, 0),
(26, 26, 0),
(27, 27, 0),
(28, 28, 0),
(29, 29, 0),
(30, 30, 0),
(31, 31, 0),
(32, 32, 0),
(33, 33, 0),
(34, 34, 0),
(35, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `roll`) VALUES
(1, 'admin', '123', 1),
(2, 'waiter1@gmail.com', '123', 2),
(3, 'waiter2@gmail.com', '123', 2),
(4, 'kitchen@gmail.com', '123', 3),
(5, 'counter@gmail.com', '123', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_orders`
--
ALTER TABLE `current_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_history`
--
ALTER TABLE `orders_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `current_orders`
--
ALTER TABLE `current_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414155;

--
-- AUTO_INCREMENT for table `orders_history`
--
ALTER TABLE `orders_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
