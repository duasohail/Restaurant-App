-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 09:30 AM
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
(1, 'Sea Food'),
(2, 'Local Food'),
(3, 'BBQ'),
(4, 'Chineese'),
(5, 'Salad'),
(6, 'Drinks');

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
(1, 'Tunna Fish', 'https://www.rajnisrecipe.com/wp-content/uploads/2016/10/smallseefish1.jpg', 1),
(2, 'Palo Fish', 'https://i.ytimg.com/vi/8wN3lNc2RIc/maxresdefault.jpg', 1),
(3, 'BBQ Beef', 'https://www.simplyrecipes.com/wp-content/uploads/2018/06/Grilled-Steak-LEAD-HORIZONTAL.jpg', 3),
(4, 'BBQ Chicken', 'https://food.fnr.sndimg.com/content/dam/images/food/fullset/2011/4/12/0/FN_Ultimate-BBQ-Chicken_s4x3.jpg.rend.hgtvcom.616.462.suffix/1384541159161.jpeg', 3),
(5, 'Tunna Fish', 'https://www.rajnisrecipe.com/wp-content/uploads/2016/10/smallseefish1.jpg', 1),
(6, 'Palo Fish', 'https://i.ytimg.com/vi/8wN3lNc2RIc/maxresdefault.jpg', 1),
(7, 'Tunna Fish', 'https://www.rajnisrecipe.com/wp-content/uploads/2016/10/smallseefish1.jpg', 1),
(8, 'Palo Fish', 'https://i.ytimg.com/vi/8wN3lNc2RIc/maxresdefault.jpg', 1),
(9, 'Tunna Fish', 'https://www.rajnisrecipe.com/wp-content/uploads/2016/10/smallseefish1.jpg', 1),
(10, 'Palo Fish', 'https://i.ytimg.com/vi/8wN3lNc2RIc/maxresdefault.jpg', 1),
(11, 'Tunna Fish', 'https://www.rajnisrecipe.com/wp-content/uploads/2016/10/smallseefish1.jpg', 1),
(12, 'Palo Fish', 'https://i.ytimg.com/vi/8wN3lNc2RIc/maxresdefault.jpg', 1);

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
(1, 1, '0.5kg', 250),
(2, 1, '1kg', 450),
(3, 2, '0.5kg', 250),
(4, 2, '1kg', 450),
(5, 5, 'half plate', 250),
(6, 5, 'full plate', 450),
(7, 6, '0.5 liter', 250),
(8, 6, '1 liter', 450);

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
(3, 3, 1),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 1),
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
(20, 20, 0);

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
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
