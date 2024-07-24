-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 02:08 PM
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
-- Database: `stationarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `adminMail` varchar(225) NOT NULL,
  `adminPass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`adminMail`, `adminPass`) VALUES
('pasan@gmail.com', '7bfffb47b36e7678a3d7680b7b2b6bf0'),
('adithya@gmail.com', 'f0a6a25f106b578af653d4190d285716'),
('sadeepa@gmail.com', 'b9bce4f1f5c794f0b5c217adc5721b40');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `pId` int(225) NOT NULL,
  `pName` varchar(225) NOT NULL,
  `pQuantity` int(225) NOT NULL,
  `pDesc` text NOT NULL,
  `pPrice` int(225) NOT NULL,
  `pOption` varchar(225) NOT NULL,
  `pImg` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`pId`, `pName`, `pQuantity`, `pDesc`, `pPrice`, `pOption`, `pImg`) VALUES
(24, 'Note book', 80, ' Note books ,80 pages', 40, 'Old stuff', 'book1.png'),
(31, 'CR Books', 498, 'CR Books for kids under 5', 350, 'Featured Stationery Items', 'crbooks.jpg'),
(32, 'White Boards', 97, '  brand new white board  ', 8800, 'Featured Stationery Items', 'board.jpg'),
(33, 'Glue Sticks', 599, 'glue sticks for kids', 420, 'Featured Stationery Items', 'glue.jpg'),
(34, 'School Bags', 1000, 'school bag for kids', 3750, 'Featured Stationery Items', 'schoolbag.png'),
(35, 'Scissors', 500, 'red color scissors for kids', 350, 'Featured Stationery Items', 'scissor.jpg'),
(36, 'Carrom Board', 200, 'brand new carrom board', 6650, 'Featured Stationery Items', 'carrom.jpg'),
(37, 'Pencil packs', 1997, 'Pencil packs for kids', 540, 'Featured Stationery Items', 'pencils.jpg'),
(38, 'Crayons Pack', 300, 'Crayons Pack for kids', 500, 'Featured Stationery Items', 'crayons.jpg'),
(41, 'Backpack', 300, 'Backpack for kids', 5700, 'New Arrivals', 'backpack.jpeg'),
(42, 'Natural Clay', 200, 'Natural Clay for kids', 160, 'New Arrivals', 'clay.jpg'),
(43, 'Black Board', 400, 'Black Board for teachers', 8000, 'New Arrivals', 'blackboard.jpg'),
(44, 'Lunch Box Pack', 300, 'Lunch Box Pack for kids', 1200, 'New Arrivals', 'lunchbox.jpg'),
(45, 'Hole Puncher', 200, 'Hole Puncher for kids', 430, 'New Arrivals', 'puncher.jpg'),
(46, 'Sidebags', 300, 'Sidebags for kids', 2850, 'New Arrivals', 'sidebag.png'),
(47, 'Desk & Chair', 300, 'Desk & Chair for kids', 5200, 'New Arrivals', 'desk.jpg'),
(48, 'Marker Pens', 300, 'Marker Pens for teachers', 120, 'New Arrivals', 'marker.jpg'),
(49, 'Water Bottles', 400, 'Water Bottles for kids', 780, 'New Arrivals', 'bottle.jpg'),
(50, 'Toy Car', 50, 'Toy Car for kids', 3400, 'New Arrivals', 'toys.jpg'),
(51, 'Desk Organizer', 400, 'Desk Organizer for kids', 870, 'New Arrivals', 'deskorganizer.jpg'),
(52, 'Atlas Book', 400, 'Atlas Book for kids', 640, 'New Arrivals', 'atlas.jpg'),
(53, 'calculator', 50, 'simple calculator ', 400, 'Old stuff', 'calculator.jpg'),
(54, 'insBox', 40, 'insBox FOR KIDS', 200, 'Old stuff', 'insBox.png'),
(55, 'Pens', 40, 'pen red', 20, 'Old stuff', 'pen.png'),
(56, 'pencil case', 50, ' pencil case for kids', 200, 'Old stuff', 'pencilcase.png'),
(57, 'School Bags', 40, 'school bag for kids', 500, 'Old stuff', 'schoolbag.png'),
(58, 'atlas pen', 400, 'red atlas pens', 25, 'Old stuff', 'pen.png'),
(59, 'blue pen', 300, '      blue rotomac pens  ', 35, 'Old stuff', 'pen.png'),
(61, 'red marker pen', 1200, 'Marker Pens for teachers', 400, 'New Arrivals', 'marker.jpg'),
(62, 'Pen case', 120, 'brand new Pen case', 120, 'Old stuff', 'pencilcase.png');

-- --------------------------------------------------------

--
-- Table structure for table `payorders`
--

CREATE TABLE `payorders` (
  `orderId` int(225) NOT NULL,
  `userId` int(225) NOT NULL,
  `pId` int(225) NOT NULL,
  `pName` text NOT NULL,
  `quantity` int(225) NOT NULL,
  `price` int(225) NOT NULL,
  `order` text NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `arrivedDate` varchar(255) DEFAULT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `selectcart`
--

CREATE TABLE `selectcart` (
  `userId` int(225) NOT NULL,
  `pId` int(225) NOT NULL,
  `quantity` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_info`
--

CREATE TABLE `superadmin_info` (
  `superemail` text NOT NULL,
  `superpassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin_info`
--

INSERT INTO `superadmin_info` (`superemail`, `superpassword`) VALUES
('adithya@gmail.com', 'f0a6a25f106b578af653d4190d285716');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userId` int(225) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `userEmail` varchar(225) NOT NULL,
  `userPassword` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userName`, `userEmail`, `userPassword`) VALUES
(1, 'saman', 'saman@gmail.com', '154764725b4bf51b66df135acefa985f'),
(2, 'kasun', 'kasun@gmail.com', 'a0b2efc19595953af353750d03624457'),
(3, 'pasan', 'pasan@gmail.com', '7bfffb47b36e7678a3d7680b7b2b6bf0'),
(4, 'ranil', 'ranil@gmail.com', 'd7622bd287735d82c73dc8e6f853d5f9'),
(5, 'taniya', 'taniya@gmail.com', 'b0d01443815154291a540d60be6691ad'),
(6, 'gayan', 'gayan@gmail.com', 'e33f9ce82dc152b373d230215864f804'),
(7, 'sanka', 'sanka@gmail.com', '745b1efde33dcc62cea8ac838eab870e'),
(8, 'bimal', 'bimal@gmail.com', '9d5fa18a22d28f0eff14262669d52dca'),
(9, 'danuka', 'danuka@gmail.com', '5f4dd0bf552c8c310fd9725c1290b6af'),
(10, 'janaka', 'janaka@gmail.com', '78d8e0222fe59e439b7bea44a668b210'),
(11, 'lakshan', 'lakshan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(12, ' adithya', 'adithya@gmail.com', 'f0a6a25f106b578af653d4190d285716'),
(14, 'sadeepa', 'sadeepa@gmail.com', 'b9bce4f1f5c794f0b5c217adc5721b40'),
(15, '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(16, 'sumudu', 'sumudu@gmail.com', '977325a66521e3862347e1ae6a5a17d7');

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `userId` int(225) NOT NULL,
  `userName` text NOT NULL,
  `review` text NOT NULL,
  `star` int(20) NOT NULL,
  `rId` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`userId`, `userName`, `review`, `star`, `rId`) VALUES
(3, 'pasan', 'This shop is a creative haven! As a writer, I find inspiration in the carefully curated selection of notebooks and pens. \r\n                                I m amazed at how this place manages to ignite my imagination every time I visit.', 4, 5),
(1, 'saman', 'I stumbled upon this stationery shop while wandering around town, and it\'s now my go-to place for gifts.\r\n                                From adorable journals to fun office gadgets, you are sure to find something that brings a smile to your face.', 4, 6),
(7, 'sanka', 'The shop has a decent selection, but the customer service can be hit or miss.\r\n                                 Some of the staff are helpful and knowledgeable, while others seem disinterested.', 4, 7),
(6, 'gayan', 'This shop is a creative haven! As a writer, I find inspiration in the carefully curated selection of notebooks and pens. \r\n                                I am amazed at how this place manages to ignite my imagination every time I visit.', 4, 8),
(5, 'taniya', 'This stationery shop is a paradise for stationary addicts like me.\r\n                                 From elegant fountain pens to cute washi tapes, they have it all. I am amazed at how this palce manages.', 4, 9),
(10, 'janaka', 'The products are pretty standard, and I did not find anything that stood out as unique or exceptional.\r\n                                 Prices are reasonable, though, so it might still be worth a visit if you\'re in need of basic supplies.', 5, 10),
(9, 'danuka', 'This stationery shop is a paradise for stationary addicts like me. \r\n                                From elegant fountain pens to cute washi tapes, they have it all. This palce is worth to shop.', 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `userId` int(225) NOT NULL,
  `pId` int(225) NOT NULL,
  `quantity` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`userId`, `pId`, `quantity`) VALUES
(1, 8, 1),
(1, 27, 1),
(0, 32, 1),
(11, 37, 1),
(11, 54, 1),
(0, 31, 1),
(3, 43, 1),
(0, 34, 1),
(0, 33, 1),
(12, 33, 1),
(12, 34, 1),
(12, 24, 1),
(12, 53, 1),
(12, 63, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `payorders`
--
ALTER TABLE `payorders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`rId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `pId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `payorders`
--
ALTER TABLE `payorders`
  MODIFY `orderId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `rId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
