-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 06:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_depo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `total_price`, `image`, `category_id`, `category_name`) VALUES
(1, 26, 6, 'rose4', 250, 2, 500, 'red rose.jpg', 4, 'Valentine'),
(2, 3, 7, 'background', 2000, 1, 2000, 'back1.jpeg', 3, 'Background'),
(3, 4, 2, 'bouquet', 150, 1, 0, 'beach florist.jpg', NULL, NULL),
(6, 3, 10, 'rose22', 100, 1, 100, 'fun bloomnation.jpg', 2, 'Wedding'),
(7, 17, 1, 'rose', 100, 2, 200, 'download.jpeg', 1, 'Programming'),
(8, 17, 2, 'friction', 150, 3, 450, 'scifric.jpeg', 2, 'Science fiction'),
(9, 17, 5, 'java', 1000, 1, 1000, 'java.jpeg', 1, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `categ`
--

CREATE TABLE `categ` (
  `ID` int(20) NOT NULL,
  `cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categ`
--

INSERT INTO `categ` (`ID`, `cat`) VALUES
(1, 'Birthday'),
(2, 'Wedding'),
(3, 'occasion'),
(4, 'Sorry'),
(5, 'congra'),
(6, 'Thanks'),
(7, 'Sympathy'),
(8, 'Best Sells');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(12) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`) VALUES
(1, 'Programming'),
(2, 'Science fiction'),
(3, 'Fantasy'),
(4, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(17, 25, 'divya', 'divya2@gmail.com', '09898989898', 'hellooo'),
(18, 25, 'divya', 'divya2@gmail.com', '09898989898', 'hello i need flower'),
(19, 17, 'vidit', 'vidit@gmail.com', '09898989898', 'i need books');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(29, 17, 'Mrudul Hrushikesh Thite', '7878787878', 'mrudul.rajhans@gmail.com', '', 'flat no. B-1203,palash plus,wakad, pink city road, , Pune, India - 411057', 'rose (2) ', 200, '18-Sep-2024', 'completed'),
(30, 17, 'Mrudul Hrushikesh Thite', '7722005553', 'mrudul.rajhans@gmail.com', '', 'flat no. B-1203,palash plus,wakad, pink city road, , Pune, India - 411057', 'rose (2) , friction (3) , java (1) ', 1650, '18-Sep-2024', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(50) NOT NULL,
  `expiration_date` varchar(10) DEFAULT NULL,
  `cvc` varchar(10) DEFAULT NULL,
  `upi_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `payment_method`, `total_amount`, `payment_date`, `card_number`, `name_on_card`, `expiration_date`, `cvc`, `upi_id`) VALUES
(1, 26, 'upi', '500.00', '2024-04-16', '', '', '', '', 'ok@hdfc'),
(2, 27, 'credit_debit_card', '2000.00', '2024-04-17', '98776', 'Mrudul Thite', '11/12', '234', ''),
(3, 28, 'upi', '2100.00', '2024-04-18', '', '', '', '', 'ok@sbi'),
(4, 29, 'credit_debit_card', '200.00', '2024-09-18', '', '', '', '', ''),
(5, 29, 'credit_debit_card', '200.00', '2024-09-18', '', '', '', '', ''),
(6, 29, 'credit_debit_card', '200.00', '2024-09-18', '', '', '', '', ''),
(7, 30, 'upi', '1650.00', '2024-09-19', '', '', '', '', 'ok@sbi');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `cate_id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cate_id`, `name`, `details`, `price`, `image`) VALUES
(1, 1, 'c programming', 'c ', 500, 'download.jpeg'),
(2, 2, 'friction', 'zsxs', 150, 'scifric.jpeg'),
(4, 4, 'horror', 'horror', 300, 'horror.jpeg'),
(5, 1, 'java', 'details of java', 1000, 'java.jpeg'),
(6, 4, 'php', 'PHP in detail', 600, 'php.jpeg'),
(7, 3, 'fantsy', 'fantasy', 2000, 'fantsy.jpeg'),
(8, 2, 'friction1', 'tells about friction', 400, 'friction1.jpeg'),
(9, 4, 'horror', 'collection of horror ', 400, 'horror1.jpeg'),
(10, 4, 'horror2', 'dangerous stories of draculla', 1000, 'horror2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `review`) VALUES
(1, 'rohit Pande', 3, 'sdcsdf'),
(2, 'MRUDULA', 3, 'wda'),
(3, 'mrudul', 1, 'really nice');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `bdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `password`, `user_type`, `bdate`, `address`, `mobile`) VALUES
(1, 'admin', 'admin2@gmail.com', 30, '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2010-11-12', 'admin vila', '9898989898'),
(3, 'mrudul', 'mrudul.rajhans@gmail.com', 0, '81dc9bdb52d04dc20036dbd8313ed055', 'user', '1982-11-12', 'palash', '9890989090'),
(4, 'Pradya', 'pradya@gmail.com', 0, '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2024-04-17', 'pradya patil,Ahmednagar', '09898989898');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_ibfk_1` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
