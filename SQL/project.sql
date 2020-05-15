-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 12:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('B','S','W') NOT NULL,
  `price` float(10,2) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `likes` int(100) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `type`, `price`, `link`, `likes`, `gender`) VALUES
(1, 'Kara Nylon Backpack', 'B', 69.98, 'https://www.jwpei.com/collections/backpacks/products/kara-nylon-backpack-bag-burgundy', 39, 'F'),
(2, 'The Drawstring Backpack', 'B', 90.99, 'https://www.jwpei.com/collections/backpacks/products/the-drawstring-backpack-yellow', 74, 'F'),
(3, 'Lydia Nylon Tote', 'B', 70.00, 'https://www.jwpei.com/collections/totes/products/lydia-tote-burgundy', 48, 'F'),
(4, 'Stella Top Handle Bag', 'B', 59.99, 'https://www.jwpei.com/collections/top-handles/products/stella-top-handle-bag-ice-lizard', 53, 'F'),
(5, 'Mini Flap Bag', 'B', 54.99, 'https://www.jwpei.com/collections/mini-flap-bag/products/mini-flap-bag-dark-green-croc', 47, 'F'),
(6, 'Jared', 'B', 225.00, 'https://www.gunasthebrand.com/collections/mens/products/jared-mens-backpack-1', 53, 'M'),
(7, 'Doshi Classic Large Brief 2', 'B', 158.00, 'https://doshi.shop/collections/mens-briefcases/products/doshi-classic-large-brief-men-vegan', 52, 'M'),
(8, 'Doshi Pro Sport+ Backpack', 'B', 199.00, 'https://doshi.shop/collections/mens-backpacks/products/doshi-pro-sport-backpack-vegan-1', 45, 'M'),
(9, 'Doshi Lux Ribbed Backpack', 'B', 159.00, 'https://doshi.shop/collections/mens-backpacks/products/doshi-lux-ribbed-backpack-vegan', 45, 'M'),
(10, 'Doshi Slim Pebbled Brief', 'B', 99.99, 'https://doshi.shop/collections/mens-briefcases/products/doshi-slim-pebbled-brief-mens-vegan', 47, 'M'),
(11, 'ALPHABOOST PARLEY SHOES', 'S', 60.00, 'https://www.adidas.com/us/alphaboost-parley-shoes/EF1162.html', 56, 'M'),
(12, 'ULTRABOOST SHOES', 'S', 180.00, 'https://www.adidas.com/us/ultraboost-shoes/G28999.html', 56, 'M'),
(13, 'STYCON SHOES', 'S', 140.00, 'https://www.adidas.com/us/stycon-shoes/EG1484.html', 51, 'M'),
(14, 'Nike Air VaporMax Flyknit 3', 'S', 167.97, 'https://www.nike.com/t/air-vapormax-flyknit-3-womens-shoe-QwH0qQ/AJ6910-600', 97, 'F'),
(15, 'Nike Joyride Run Flyknit', 'S', 153.99, 'https://www.nike.com/t/joyride-run-flyknit-womens-running-shoes-HcfnJd/CU4832-001', 79, 'F'),
(16, 'Nike Odyssey React Flyknit 2', 'S', 83.97, 'https://www.nike.com/t/odyssey-react-flyknit-2-womens-running-shoe-nHFzTK/AH1016-600', 78, 'F'),
(17, 'QUESTAR FLOW PARLEY SHOES', 'S', 75.00, 'https://www.adidas.com/us/questar-flow-parley-shoes/EE9542.html', 79, 'F'),
(18, 'KAPTIR SHOES', 'S', 85.00, 'https://www.adidas.com/us/kaptir-shoes/EH1700.html', 77, 'M'),
(19, 'Nike Epic React Flyknit 2', 'S', 99.97, 'https://www.nike.com/t/epic-react-flyknit-2-big-kids-running-shoe-14P7S9/AQ3243-012', 358, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `phone` char(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_add_items`
--

CREATE TABLE `users_add_items` (
  `user_id` int(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `item_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_like_items`
--

CREATE TABLE `users_like_items` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_add_items`
--
ALTER TABLE `users_add_items`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_like_items`
--
ALTER TABLE `users_like_items`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_like_items`
--
ALTER TABLE `users_like_items`
  ADD CONSTRAINT `users_like_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `users_like_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
