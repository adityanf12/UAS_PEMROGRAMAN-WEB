-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 06:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perunggu`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'tesaagri', 'holdutight00@gmail.com', 'aku cinta perunggu ', '2025-12-09 08:03:21'),
(2, 'chewes', 'raditya.0037@mhs.unesa.ac.id', 'tertarik untuk kolaborasi', '2025-12-09 09:12:44'),
(8, 'adifa depati', 'tesaagri@gmail.com', 'aa', '2025-12-09 12:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`id`, `nama`, `deskripsi`, `harga`, `gambar`) VALUES
(1, 'Hoodie Perunggu', 'Hoodie official dengan desain Perunggu', 150000, 'Hoodie.png'),
(2, 'T-shirt Perunggu', 'Kaos original Perunggu', 120000, 'T-shirt.png'),
(3, 'Cap Perunggu', 'Topi dengan logo Perunggu', 90000, 'Cap.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product`, `price`, `name`, `email`, `phone`, `address`, `city`, `province`, `postal_code`, `payment_method`, `total`, `created_at`) VALUES
(1, 'Hoodie Perunggu', 150000, 'adifa depati', 'tesaagri@gmail.com', '081399768117', 'Indonesia, Surabaya\r\nKec Wonokromo\r\nJln Satria, NO 33A', 'Surabaya', 'Jawa timur', '33608', 'bank_transfer', 165000, '2025-12-09 11:08:37'),
(3, 'T-shirt Perunggu', 120000, 'alika chewee', 'cheweas@gmail.com', '08139976861', 'Indonesia, Surabaya\r\nKec Wonokromo\r\nJln Satria, NO 33A', 'Surabaya', 'Jawa timur', '33608', 'bank_transfer', 135000, '2025-12-09 11:39:19'),
(7, 'Cap Perunggu', 90000, 'adifa depati', 'tesaagri@gmail.com', '081399768117', 'Indonesia, Surabaya\r\nKec Wonokromo\r\nJln Satria, NO 33A', 'Surabaya', 'Jawa timur', '33608', 'bank_transfer', 105000, '2025-12-09 11:53:56'),
(8, 'Hoodie Perunggu', 150000, 'adifa depati', 'tesaagri@gmail.com', '081399768117', 'Indonesia, Surabaya\r\nKec Wonokromo\r\nJln Satria, NO 33A', 'Surabaya', 'Jawa timur', '33608', 'bank_transfer', 165000, '2025-12-09 12:51:03'),
(9, 'Cap Perunggu', 90000, 'adifa depati', 'tesaagri@gmail.com', '081399768117', 'Indonesia, Surabaya\r\nKec Wonokromo\r\nJln Satria, NO 33A', 'Surabaya', 'Jawa timur', '33608', 'bank_transfer', 105000, '2025-12-09 12:58:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
