-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2020 at 07:51 PM
-- Server version: 5.7.31-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `placehol_food_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `name` varchar(90) COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `category` varchar(60) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(2000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`name`, `price`, `available`, `category`, `id`, `image`, `description`) VALUES
('Escoveitch Fish', 400, 1, 'Native', 1, 'escoveitch fish.jpg', 'This fish is grilled under 75 degrees celsius for about 20 minutes. It seasoned with the finest of condiments and best of chef skills. Just the right amount of dry.'),
('Gbegiri Soup', 450, 1, 'Native', 2, 'gbegiri soup.jpg', 'Draws just as it should, showing a rich and colourful green and orange. This just tells you our Gbegiri soup is healthy for the body and soul. You\'d love it.'),
('Gizdodo Gizzard', 9080, 0, 'Western', 3, 'gizdodo gizzard.jpg', 'Diced in tiny little pieces just the way you\'d like it. Soft enough to be chewy and yummy. It goes well with whatever accompanying food. One bite and you can affirm yourself.'),
('Jellof Rice and Beans with Chicken', 4300, 1, 'Native', 4, 'jellof rice and beans with chicken.jpg', 'We don\'t need to say this but just so there\'s no doubt whatsoever, our jellof rice is the best, hands down... with chicken and beans to go with!! Eat and be satisfied.'),
('Native Rice', 2000, 1, 'Native', 5, 'native rice.jpg', 'Harvested from the best of farmers and their farms. Treated with intl\' processing standards. Enjoy the best our local farmers have to offer. You\'d order for more. We dare you!'),
('Rice Buffet', 400, 1, 'Western', 6, 'rice buffet.jpg', 'Heard of our native rice? How about our jellof rice? They\'re an amazing combo. A delight to try both of them. It\'s AWESOME + AMAZING>'),
('Salad Platter', 450, 1, 'Western', 7, 'salad platter.jpg', 'Have a rich fruit salad providing you with all the minerals and vitamins requirements for your body. It\'s fun and classy.'),
('Semo and Egusi with Fish', 4000, 1, 'Native', 8, 'semo and egusi with fish.jpg', 'Try this amazing soup combo. Goes well with any other accompanying solid food like semoline, eba, pounded yam, fufu, etc. Just about anything solid food.'),
('Vegetable Soup', 4500, 1, 'Native', 9, 'vegetable soup.jpg', 'Eat vegies and be healthy. We always advise our customers to add a bit of vegetables to their meals, and for kids too. And if you\'re a vegan... we\'re here for you too!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `customer_name` varchar(90) COLLATE utf8_bin NOT NULL,
  `quantity` int(15) NOT NULL,
  `address` varchar(90) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_of_food` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`customer_name`, `quantity`, `address`, `time`, `id_of_food`, `id`) VALUES
('Mr. Ossai', 5, 'Somewhere in Africa', '2020-10-31 14:56:49', 2, 1),
('Mr. Ossai', 5, 'Somewhere in Africa', '2020-10-31 15:29:36', 1, 2),
('Professor IBK', 56, 'Some where in Africa, Nigeria, Ibadan.', '2020-10-31 16:18:41', 1, 3),
('Prof Ossai', 10, 'Some where in Africa, Nigeria, Ibadan. or Europe', '2020-10-31 16:24:48', 2, 4),
('Prof Ossai', 10, 'Some where in Africa, Nigeria', '2020-10-31 16:25:42', 2, 5),
('Prof Ossai Nwachukwu', 10, 'Some where in Africa, Nigeria', '2020-10-31 16:30:23', 2, 6),
('Prof Ossai Nwachukwu', 10, 'Some where in Africa, Nigeria', '2020-10-31 16:53:54', 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Food_ID_in_Inventory` (`id_of_food`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Food_ID_in_Inventory` FOREIGN KEY (`id_of_food`) REFERENCES `inventory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
