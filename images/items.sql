-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 03:16 AM
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
  `description` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `likes` int(100) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `type`, `price`, `link`, `likes`, `gender`) VALUES
(1, 'Kara Nylon Backpack', 'Major Material: Recycled Plastic Nylon\r\nLining Material: Ultra-microfiber Vegan leather\r\nDimensions: 12.2”W × 7.5”D × 15″H (31cm x 19cm x 38cm)\r\nHandle drop: 3.1‘’(8cm)\r\nFits for MacBook Pro 15.5\" and all laptops which are smaller than it', 'B', 69.98, 'https://www.jwpei.com/collections/backpacks/products/kara-nylon-backpack-bag-burgundy', 0, 'F'),
(2, 'The Drawstring Backpack', 'This gorgeous backpack is made with our signature ultra-microfiber luxury vegan leather, which offers a soft touch, superior durability and luxurious texture. The backpack is also super lightweight. It weighs only 750g (approx. 1.6lbs.), about 40% lighter than similar leather bags. Like all our other products, this backpack?is 100% cruelty-free.', 'B', 90.99, 'https://www.jwpei.com/collections/backpacks/products/the-drawstring-backpack-yellow', 0, 'F'),
(3, 'Lydia Nylon Tote', 'Major Material: Nylon & Croc Vegan leather \r\nLining Material: 100% Recycled Plastic Bottle \r\nDimensions: 16.9\"W × 11.4”H ×5.5″D (43cm x 29cm x 14cm)\r\nHandle drop: 11\'\' (28cm)\r\nFits for MacBook Pro 15.5\" and all laptops which are smaller than it\r\n4 inner pockets\r\n- one front pocket fits for water bottle\r\n- one front pocket fits for card holder & lipstick\r\n- one central zipper pocket\r\n- one back pocket for notebook', 'B', 70.00, 'https://www.jwpei.com/collections/totes/products/lydia-tote-burgundy', 0, 'F'),
(4, 'Stella Top Handle Bag', 'Major Material: Lizard-Embossed Vegan leather\r\nLining Material: 100% Recycled Plastic Bottle \r\nDimensions: 7.5\"W × 4.8”H × 3.1″D (19cm x 12.2cm x 8cm)\r\nShoulder strap drop: 20.5\'\' ~ 23.4\'\' (52 ~ 59.5cm)\r\nHandle drop:  3.5\'\' (9cm)', 'B', 59.99, 'https://www.jwpei.com/collections/top-handles/products/stella-top-handle-bag-ice-lizard', 0, 'F'),
(5, 'Mini Flap Bag', 'Croc-Embossed Vegan Leather\r\n100% Recycled Plastic Lining\r\n7.9\'\' W × 6.1\'\' D × 3.1\'\' H (20cm x 15.5cm x 8cm)\r\n(16.9× 2.54cm）Handle Drop\r\nDetachable Strap (Unadjustable)\r\nGold Hardware\r\nPush-Lock Closure\r\n2 Interior Pockets\r\n1 Zipping Pocket\r\nImported', 'B', 54.99, 'https://www.jwpei.com/collections/mini-flap-bag/products/mini-flap-bag-dark-green-croc', 0, 'F'),
(6, 'Jared', 'Backpack with two-way metal zip closure that extends to bottom, top handle to hand carry, and padded adjustable back straps.\r\n\r\nInterior: 15” laptop pocket, zipper pocket, smartphone pocket, and slip pocket. 100% recycled nylon lining.\r\n\r\nDimensions: 13”L x 16.5”H x 5.75”D\r\nHandle Drop: 3”\r\nAdjustable Back Straps: 33” (fully extended)', 'B', 225.00, 'https://www.gunasthebrand.com/collections/mens/products/jared-mens-backpack-1', 10, 'M'),
(7, 'Doshi Classic Large Brief 2', 'A classic briefcase with a microfiber shell, this briefcase offers a distinctive, yet nostalgic shape and a great deal of organization with three separate zippered compartments.', 'B', 158.00, 'https://doshi.shop/collections/mens-briefcases/products/doshi-classic-large-brief-men-vegan', 7, 'M'),
(8, 'Doshi Pro Sport+ Backpack', 'Unique but familiar at the same time, this handsome backpack crafted with our fine textured vegan leather is a reminiscence of the classic Japanese backpack combined with efficient modern design. Equal parts rugged and refined, it fits a laptop up to 15 inch in the main compartment and a good amount of space for bits and bobs. Whether you’re hiking, riding your bike, headed to school or commuting to the office, our the Imari backpack is designed to be a sturdy vessel for your journey.', 'B', 199.00, 'https://doshi.shop/collections/mens-backpacks/products/doshi-pro-sport-backpack-vegan-1', 0, 'M'),
(9, 'Doshi Lux Ribbed Backpack', 'Our Ribbed Backpack is for the bold and fashion forward.  Made from high quality Microfiber PU vegan leather, the ribs are debossed into the material.', 'B', 159.00, 'https://doshi.shop/collections/mens-backpacks/products/doshi-lux-ribbed-backpack-vegan', 0, 'M'),
(10, 'Doshi Slim Pebbled Brief', ' slim briefcase with a classic pebbled microfiber leather shell, this briefcase is so soft and supple, you won\'t be able to keep your hands off of it.', 'B', 99.99, 'https://doshi.shop/collections/mens-briefcases/products/doshi-slim-pebbled-brief-mens-vegan', 0, 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
