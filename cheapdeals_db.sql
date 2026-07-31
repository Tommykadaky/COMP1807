-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2026 at 09:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapdeals_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Open',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_reply` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `user_id`, `subject`, `message`, `status`, `created_at`, `admin_reply`) VALUES
(1, 3, 'Payment Error', 'Cant checkout the item in the cart', 'Replied', '2026-07-31 10:25:28', 'oke we will fix it');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `name`, `type`, `price`, `details`) VALUES
(1, 'iPhone 15 Pro (Device Only)', 'Device', 35.00, 'Unlocked Device, No SIM included'),
(2, '5G Smart Router', 'Device', 20.00, 'Hardware only, ready for any network'),
(3, 'Basic SIM Card', 'Data', 10.00, '10GB 4G Data, Unlimited Calls & Texts'),
(4, 'Unlimited SIM Card', 'Data', 25.00, 'Unlimited 5G Data, Unlimited Calls & Texts'),
(5, 'Apple AirPods Pro 2', 'Device', 15.00, 'Wireless Noise Cancelling Earbuds'),
(6, 'Samsung Galaxy Watch 6', 'Device', 18.00, 'Smartwatch with LTE connectivity'),
(7, 'International Roaming SIM', 'Data', 12.00, '5GB Data across 50+ countries worldwide'),
(8, 'Anker Power Bank 20000mAh', 'Device', 5.00, 'Fast charging portable battery for all devices');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Completed',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `discount`, `total_amount`, `status`, `created_at`) VALUES
(1, 3, 85.00, 21.25, 63.75, 'Completed', '2026-07-30 14:31:03'),
(2, 3, 30.00, 10.50, 19.50, 'Completed', '2026-07-30 14:48:03'),
(3, 3, 325.00, 113.75, 211.25, 'Completed', '2026-07-30 17:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sale_end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `type`, `description`, `price`, `is_active`, `sale_price`, `sale_end_date`) VALUES
(1, 'iPhone 15 Standard', 'MobileOnly', 'Brand new 128GB Smartphone (Device Only)', 699.00, 1, NULL, NULL),
(2, 'Smartphone Starter Combo', 'Combo', 'Basic Service Plan + 5G Data Bundle', 20.00, 1, NULL, NULL),
(3, 'Pixel 8 Pro Flagship', 'MobileOnly', 'Google Pixel 8 Pro 256GB (Device Only)', 799.00, 1, NULL, NULL),
(4, 'Wi-Fi 6 Home Router', 'BroadbandOnly', 'High-Speed Wireless Router Hardware Only', 89.00, 1, NULL, NULL),
(5, 'Family Mega Bundle', 'Combo', '4x Mobile Lines + 300Mbps Fiber Service', 65.00, 1, NULL, NULL),
(6, 'Samsung Galaxy S24', 'MobileOnly', 'Latest Flagship Samsung Device Only', 749.00, 1, NULL, NULL),
(7, 'Mesh Wi-Fi System', 'BroadbandOnly', 'Dual-Band Mesh Router Hardware Only', 120.00, 1, NULL, NULL),
(8, 'Enterprise Duo Combo', 'Combo', 'Business Phone Line + 1Gbps Fiber Plan', 89.00, 1, NULL, NULL),
(9, 'Budget Android Phone', 'MobileOnly', 'Entry-level Smartphone Device Only', 199.00, 1, NULL, NULL),
(10, 'Weekend Streamer Pack', 'Combo', 'Unlimited Weekend Data Service Plan', 15.00, 1, NULL, NULL),
(11, 'Smart Fiber Gateway', 'BroadbandOnly', 'Fiber Optic Modem & Gateway Hardware', 95.00, 1, NULL, NULL),
(12, 'Ultimate Gamer Combo', 'Combo', 'Low-Latency 300Mbps Fiber + Mobile Plan', 75.00, 1, NULL, NULL),
(13, 'Senior Easy Phone', 'MobileOnly', 'Large Button Simple Mobile Device Only', 79.00, 1, NULL, NULL),
(14, 'Global Roaming Pass', 'Combo', 'International Voice & Data Service Pass', 35.00, 1, NULL, NULL),
(15, 'Business Core Router', 'BroadbandOnly', 'Enterprise Grade Network Hardware Only', 250.00, 1, NULL, NULL),
(16, 'Budget Family Combo', 'Combo', '2x Mobile Lines + 150Mbps Fiber Plan', 50.00, 1, NULL, NULL),
(17, 'Flexi Data Booster', 'Combo', 'Extra 10GB High-Speed Data Add-on Plan', 7.00, 1, NULL, NULL),
(18, 'Gigabit Network Switch', 'BroadbandOnly', '8-Port High-Speed Switch Hardware Only', 45.00, 1, NULL, NULL),
(19, 'Flagship Phone & Net', 'Combo', 'Latest iPhone + Unlimited 5G Service Plan', 60.00, 1, NULL, NULL),
(20, 'Teens Social Pack', 'Combo', 'Unlimited Social Media Apps Service Plan', 10.00, 1, NULL, NULL),
(21, 'Suburban Fiber Modem', 'BroadbandOnly', 'Dedicated Fiber Terminal Hardware Only', 110.00, 1, NULL, NULL),
(22, 'Dual SIM Pro Combo', 'Combo', '2 Numbers Active + 50GB Shared Plan', 32.00, 1, NULL, NULL),
(23, 'Refurbished iPhone SE', 'MobileOnly', 'Certified Pre-owned Device Only', 249.00, 1, NULL, NULL),
(24, 'Outdoor Access Point', 'BroadbandOnly', 'Weatherproof Wi-Fi Extender Hardware Only', 140.00, 1, NULL, NULL),
(25, 'The Ultimate All-In-One', 'Combo', 'Full Enterprise Service + Hardware Bundle', 120.00, 1, NULL, NULL),
(26, '117 TR', '', 'nice', 399.00, 1, 299.00, '2026-08-01 14:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_percent`, `expiry_date`, `is_active`) VALUES
(1, 'SALE20', 20, '2026-12-31 23:59:59', 1),
(2, 'VIP10', 10, NULL, 1),
(3, 'LATE50', 50, '2023-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `credit_card` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `card_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `credit_card`, `address`, `card_number`, `created_at`, `role`) VALUES
(1, 'Le Van Tuan', 'levantuan@gmail.com', '$2y$10$o9GYAlLL1p6QUJP8cPlQVOO.4QJgQSL76aaOTL4RByyY9vAE6gQim', '0909060504', '', '20 Cong Hoa', '123456789', '2026-07-24 03:11:35', 'customer'),
(3, 'Lam VInh Thang', 'lamvinhthang@gmail.com', '$2y$10$oR89DehyJtixeSSqbooxIuf8RtQUGLd7LkZo9VG5wMs/KdQgSOYxa', '0123456789', '1758396846183725', '20 Cong hoa', '', '2026-07-29 12:44:33', 'customer'),
(8, 'System Admin', 'admin@cheapdeals.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0123456789', '', 'Admin Office', '', '2026-07-30 08:44:28', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
