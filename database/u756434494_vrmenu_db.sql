-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2024 at 02:47 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u756434494_vrmenu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `restaurant_id`, `name`, `image`) VALUES
(15, 130, 'Fried RIce', '1702862166.jpeg'),
(16, 130, 'Burger', '1702922388.jpg'),
(17, 130, 'noodles', '1702954803.jpeg'),
(22, 138, 'Food', ''),
(23, 138, 'Beverage ', '1703174473.png'),
(25, 140, 'Fried Rice', '1703180191.jpg'),
(26, 140, 'Noodles', '1703209494.jpeg'),
(27, 130, 'A', '6584efb9dd0cd_1703210938.jpeg'),
(28, 140, 'Apetizers', '6584fc8f55082_1703214223.jpg'),
(31, 143, 'Cupcakes ', '658a54f1b549c_1703564530.jpg'),
(32, 143, 'Chocolate and Ganache Cakes ', '658a583cc44cb_1703565373.jpg'),
(33, 143, 'Fondant Cakes ', '658a5b46cf097_1703566151.jpg'),
(35, 143, 'Coffee Cakes', '658a5fd054cf9_1703567312.jpg'),
(36, 143, 'Buttercream Cakes ', '658a62eedaa19_1703568111.jpg'),
(37, 143, 'Letter Birthday Cakes', '658a64b684eda_1703568567.jpg'),
(38, 143, 'Wedding Cake Piece ', '658a675272e8c_1703569234.jpg'),
(39, 143, 'Cartoon Theme Cakes ', '658a68a757997_1703569575.jpg'),
(40, 144, 'Rice', '658ba0b83cc99_1703649464.jpg'),
(41, 144, 'Beverages', '658ba8e2de913_1703651555.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `db_admin`
--

CREATE TABLE `db_admin` (
  `firstName` varchar(16) NOT NULL,
  `lastName` varchar(16) NOT NULL,
  `userName` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_admin`
--

INSERT INTO `db_admin` (`firstName`, `lastName`, `userName`, `password`) VALUES
('Thevindu', 'Rathnaweera', 'ttr@admin.vrm', 'Admin@nexcodia.Thevindu2003'),
('Devindi', 'Amarasinghe', 'rvdca@admin.vrm', 'Admin@nexcodia.Devindi2002');

-- --------------------------------------------------------

--
-- Table structure for table `registered_restaurants`
--

CREATE TABLE `registered_restaurants` (
  `restaurant_id` int(5) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `whatsappNumber` int(10) NOT NULL,
  `businessName` varchar(24) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(20) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_restaurants`
--

INSERT INTO `registered_restaurants` (`restaurant_id`, `firstName`, `lastName`, `phoneNumber`, `whatsappNumber`, `businessName`, `email`, `password`, `reg_date`, `logo`) VALUES
(130, 'test', '01', 1, 1, 'test 01', 'test01', 'test', '2023-12-14', '130.png'),
(138, 'Devinda', 'Vidanapathirana', 714186838, 714186838, 'Devinda', 'devinda.vidanapathirana@gmail.com', '20000603', '2023-12-21', NULL),
(140, 'Sajeeve', 'Ranasinghe', 712345678, 704567890, 'Leng Keng Restaurant', 'lengkeng@gmail.com', 'test', '2023-12-21', '140.png'),
(143, 'Janitha', 'Eshwarage', 728531664, 728531664, 'Jani Cake &amp; Bake', 'janithaeshwarage73@gmail.com', 'janitha73', '2023-12-26', '143.jpg'),
(144, 'Devindi', 'Amarasinghe', 703963508, 703963508, 'Master Kitchen', 'test@gmail.com', 'test', '2023-12-27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size1` varchar(100) DEFAULT NULL,
  `size2` varchar(100) DEFAULT NULL,
  `size3` varchar(100) DEFAULT NULL,
  `price1` decimal(10,2) DEFAULT NULL,
  `price2` decimal(10,2) DEFAULT NULL,
  `price3` decimal(10,2) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `size1`, `size2`, `size3`, `price1`, `price2`, `price3`, `image`, `restaurant_id`) VALUES
(24, 15, 'Chicken', 'L', 'M', 'S', 1800.00, 1350.00, 900.00, '1702862166.jpg', 130),
(25, 15, 'Mixed', 'L', 'M', '', 2000.00, 1600.00, 0.00, '1702862166.jpeg', 130),
(26, 15, 'Pork', 'L', 'R', '', 1950.00, 1600.00, 0.00, '1702862166.jpg', 130),
(27, 16, 'Chicken', 'L', 'M', '', 500.00, 160.00, 0.00, '1702922388.jpeg', 130),
(28, 16, 'Pork B', 'L', 'M', '', 9040.00, 123.00, 0.00, 'download.jpeg', 130),
(30, 17, 'Next', 'R', '', '', 1500.00, 0.00, 0.00, 'Pizza 2.jpg', 130),
(36, 22, 'Chicken ', 'regular ', 'L', '', 600.00, 1200.00, 0.00, '', 138),
(37, 22, 'MIX', 'regular ', 'L', '', 800.00, 1500.00, 0.00, '', 138),
(38, 23, 'Lime', '1', '', '', 200.00, 0.00, 0.00, '', 138),
(40, 25, 'Vegetable Rice', 'F', 'R', '', 750.00, 500.00, 0.00, 'veg-pulao-featured.jpg', 140),
(41, 25, 'Egg Rice', 'F', 'R', '', 900.00, 750.00, 0.00, 'download (2).jpeg', 140),
(42, 25, 'Chicken Rice', 'F', 'R', '', 1450.00, 1200.00, 0.00, 'chicken-and-rice-15.jpg', 140),
(43, 25, 'Fish Rice', 'F', 'R', '', 1600.00, 1300.00, 0.00, 'download (3).jpeg', 140),
(44, 25, 'Seafood Rice', 'F', 'R', '', 1950.00, 1650.00, 0.00, 'download (4).jpeg', 140),
(45, 25, 'Mixed RIce', 'F', 'R', '', 1950.00, 1650.00, 0.00, 'download (5).jpeg', 140),
(46, 25, 'Chicken Chop Suey Rice', 'F', 'R', '', 2400.00, 1900.00, 0.00, '428655-0b717c65875845a2880e9ac4b84e0409.jpg', 140),
(47, 26, 'Vegetable ', 'F', 'R', '', 680.00, 500.00, 0.00, 'images (2).jpeg', 140),
(48, 26, 'Chicken', 'F', 'R', '', 950.00, 700.00, 0.00, 'download (7).jpeg', 140),
(49, 26, 'Prawns ', 'F', 'R', '', 1150.00, 900.00, 0.00, 'images.jpeg', 140),
(50, 26, 'Mixed', 'F', 'R', '', 1400.00, 1250.00, 0.00, 'images (1).jpeg', 140),
(51, 27, 'A', '1', '', '', 1.00, 0.00, 0.00, '6584efb9dd3bc_1703210938.jpeg', 130),
(52, 27, 'B', '2', '', '', 2.00, 0.00, 0.00, '6584efb9dd573_1703210938.jpg', 130),
(53, 27, 'C', '3', '', '', 3.00, 0.00, 0.00, '6584efb9dd720_1703210938.jpg', 130),
(54, 26, 'Seafood', 'F', 'R', '', 2600.00, 2150.00, 0.00, '6584f1392134a_1703211321.jpeg', 140),
(55, 28, 'Mushroom Burger', 'R', '', '', 1800.00, 0.00, 0.00, '6584fc8f55316_1703214223.jpg', 140),
(56, 28, 'Crispy Fried Chicken', 'R', '', '', 1950.00, 0.00, 0.00, '6584fc8f5552b_1703214223.jpeg', 140),
(57, 28, 'Hotdog Sandwich ', 'R', '', '', 1600.00, 0.00, 0.00, '6584fc8f5565c_1703214223.jpeg', 140),
(58, 28, 'Meatballs', 'R', '', '', 900.00, 0.00, 0.00, '6584fc8f55792_1703214223.jpeg', 140),
(59, 28, 'Fruit and vegetable Salad  ', 'R', '', '', 900.00, 0.00, 0.00, '6584fc8f558a4_1703214223.jpeg', 140),
(62, 31, 'Vanilla Cupcakes ', '1', '', '', 150.00, 0.00, 0.00, 'FB_IMG_1703563723117.jpg', 143),
(63, 31, 'Chocolate Cupcakes ', '1', '', '', 250.00, 0.00, 0.00, '658a54f1b62c7_1703564530.jpg', 143),
(64, 31, 'Fondant Cupcakes ', '1', '', '', 300.00, 0.00, 0.00, '658a54f1b6923_1703564530.jpg', 143),
(65, 32, 'Ganache Cakes', '1kg', '', '', 6500.00, 0.00, 0.00, '658a583cc4f09_1703565373.jpg', 143),
(66, 32, 'With Strawberries ', '1kg', '', '', 7000.00, 0.00, 0.00, '658a583cc50c5_1703565373.jpg', 143),
(67, 32, 'Chocolate Cakes', '1kg', '', '', 6000.00, 0.00, 0.00, '658a583cc5231_1703565373.jpg', 143),
(68, 33, 'Fondant Cakes ', '3kg', '', '', 20000.00, 0.00, 0.00, '658a5b46cf8a6_1703566151.jpg', 143),
(69, 33, 'Fondant Cakes ', '1kg', '', '', 6500.00, 0.00, 0.00, '658a5b46cfc46_1703566151.jpg', 143),
(70, 33, 'Fondant Cakes', '1.5kg ', '', '', 9000.00, 0.00, 0.00, '658a5b46cfe15_1703566151.jpg', 143),
(71, 33, 'Fondant Cakes ', '2kg', '', '', 13000.00, 0.00, 0.00, '658a5b46d0096_1703566151.jpg', 143),
(74, 35, 'Without Cashew', '1kg', '', '', 6000.00, 0.00, 0.00, '658a5fd055761_1703567312.jpg', 143),
(75, 35, 'With Cashew ', '1kg', '', '', 6500.00, 0.00, 0.00, '658a5fd055998_1703567312.jpg', 143),
(76, 35, 'Coffee Cakes', '2kg', '', '', 12000.00, 0.00, 0.00, '658a5fd055b96_1703567312.jpg', 143),
(77, 36, 'With Macaroons ', '1.5kg', '', '', 9000.00, 0.00, 0.00, '658a62eedb8cf_1703568111.jpg', 143),
(78, 36, 'With Birthday Toppers ', '1kg ', '', '', 6750.00, 0.00, 0.00, '658a62eedbb1a_1703568111.jpg', 143),
(79, 36, 'With age toppers ', '1kg ', '', '', 6500.00, 0.00, 0.00, '658a62eedbd50_1703568111.jpg', 143),
(80, 36, 'Square Shape Cakes', '1kg', '', '', 7000.00, 0.00, 0.00, '658a62eedc0dc_1703568111.jpg', 143),
(81, 37, 'Buttercream ', '1kg ', '', '', 6000.00, 0.00, 0.00, 'IMG_20231226_105446.jpg', 143),
(82, 37, 'With Macaroons ', '2kg', '', '', 8000.00, 0.00, 0.00, '658a64b686116_1703568567.jpg', 143),
(83, 38, 'Cake Piece', '1', '', '', 350.00, 0.00, 0.00, '658a675273b44_1703569234.jpg', 143),
(84, 39, 'With toppers ', '1kg ', '', '', 10000.00, 0.00, 0.00, '658a68a75852c_1703569575.jpg', 143),
(85, 39, 'Buttercream ', '1kg ', '', '', 6000.00, 0.00, 0.00, '658a68a75881a_1703569575.jpg', 143),
(86, 40, 'Chicken Fried Rice', 'S', 'L', '', 500.00, 1000.00, 0.00, '658ba0b83d03f_1703649464.jpg', 144),
(87, 40, 'Seafood Rice', 'S', 'L', '', 750.00, 1400.00, 0.00, '658ba0b83d1f5_1703649464.jpg', 144),
(88, 40, 'Nasiguran Rice', 'S', 'L', '', 800.00, 1600.00, 0.00, '658ba0b83d353_1703649464.jpg', 144),
(89, 40, 'Mix Rice', 'S', 'L', '', 800.00, 1900.00, 0.00, '658ba0b83d488_1703649464.jpg', 144),
(90, 40, 'Biriyani', 'S', 'L', '', 750.00, 1400.00, 0.00, '658ba0b83d61c_1703649464.jpg', 144),
(91, 41, 'Lime Juice', '1', '', '', 250.00, 0.00, 0.00, '658ba8e2dec89_1703651555.jpg', 144),
(92, 41, 'Orange Juice', '1', '', '', 250.00, 0.00, 0.00, '658ba901e0e73_1703651586.jpg', 144),
(95, 41, 'Chocolate Milkshake', '1', '', '', 300.00, 0.00, 0.00, '658ba9cf3d49d_1703651791.jpg', 144),
(96, 41, 'Vanila Milkshake', '1', '', '', 300.00, 0.00, 0.00, '658ba9cf3dd75_1703651791.jpg', 144),
(97, 41, 'Banana Milkshake', '1', '', '', 300.00, 0.00, 0.00, '658ba9cf3df24_1703651791.jpg', 144),
(98, 41, 'Hot coffee', '1', '', '', 450.00, 0.00, 0.00, '658ba9cf3e098_1703651791.jpg', 144),
(99, 41, 'Faluda ', '1', '', '', 300.00, 0.00, 0.00, '658ba9cf3e20f_1703651791.jpg', 144),
(100, 41, 'Orange Juice', '1', '', '', 500.00, 0.00, 0.00, '', 144);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `restaurant_id` int(11) NOT NULL,
  `selected_theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`restaurant_id`, `selected_theme`) VALUES
(130, 'theme01'),
(138, 'theme01'),
(140, 'theme03'),
(143, 'theme02'),
(144, 'theme02');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `restaurant_id`, `token`) VALUES
(6, 138, 'd9a9f190dc7c5a85d927e3c38a573512'),
(7, 140, '9756bcb9dd1615d8fa3550078997c0fa'),
(11, 143, 'fd4257dea3975cc8f0b84e9e0c2d41a4'),
(12, 144, '984d9b4210aec402ec85fca827091618'),
(13, 130, 'cdda5a4a950815208dc39828a47197e9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `registered_restaurants`
--
ALTER TABLE `registered_restaurants`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD UNIQUE KEY `businessName` (`businessName`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_token` (`token`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `registered_restaurants`
--
ALTER TABLE `registered_restaurants`
  MODIFY `restaurant_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `registered_restaurants` (`restaurant_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `theme_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `registered_restaurants` (`restaurant_id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `registered_restaurants` (`restaurant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
