-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2023 at 04:05 AM
-- Server version: 8.0.32
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `is_paid` tinyint DEFAULT '0',
  `invoice` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(14,4) NOT NULL,
  `currency` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `phone`, `name`, `email`, `address`, `status`, `is_paid`, `invoice`, `product`, `description`, `amount`, `currency`, `created_at`, `updated_at`) VALUES
(2, 'aa6a6328-68af-4373-bc88-52c87b00ce19', '01711122212', 'Carol Welch', 'jyseku@mailinator.com', 'Sunt reprehenderit ', 0, 0, NULL, 'Shelly Wright', 'Odit minim nisi adip', 67.0000, 'BDT', '2023-05-14 01:13:19', '2023-05-14 04:01:44'),
(3, '88fd71b0-648e-461a-adf7-4be40ce5e340', '01711122212', 'Carol Welch', 'jyseku@mailinator.com', 'Sunt reprehenderit ', 0, 0, NULL, 'Shelly Wright', 'Odit minim nisi adip', 67.0000, 'BDT', '2023-05-14 01:13:36', '2023-05-14 04:01:47'),
(4, 'c0128873-5944-4b04-bf27-e2d2772c8b10', '01711122212', 'Ferdinand Shaffer', 'wovirewu@mailinator.com', 'Sed similique volupt', 0, 0, NULL, 'Amber Meyers', 'Vero amet cumque su', 16.0000, 'BDT', '2023-05-14 01:13:53', '2023-05-14 04:01:49'),
(5, '78e6c6dc-4183-4f7d-9195-2b438d2fef51', '01711122212', 'John Berger', 'zozynu@mailinator.com', 'Aut cillum non offic', 0, 0, '864601244BCAA101', 'Leslie Fletcher', 'Ut et perferendis no', 56.0000, 'BDT', '2023-05-14 01:47:02', '2023-05-14 10:05:08'),
(6, '46f7eae7-2e8c-4bf9-864b-6f222d874f63', '01749798111', 'asda', 'sfsf@sdf.fooo', 'Doloribus quae ab re', 0, 0, NULL, 'Mohammad Bass', 'Vel eiusmod accusant', 33.0000, 'BDT', '2023-05-14 05:55:03', '2023-05-14 05:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int NOT NULL,
  `order_id` varchar(256) NOT NULL,
  `invoice` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `invoice`, `response`) VALUES
(263, '78e6c6dc-4183-4f7d-9195-2b438d2fef51', '864601244BCAA101', '{\"source\":\"\",\"transactions\":\"\"}'),
(264, '46f7eae7-2e8c-4bf9-864b-6f222d874f63', '8646023DE4BCA074', NULL),
(265, 'aa6a6328-68af-4373-bc88-52c87b00ce19', '864605D5B676A274', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Romesh', 'rom@gmail.com', '$2y$10$07uT/Z02Ct8Fmw1AcUPfAudX.KJ8DyopDDJoO57GBtgaB/adajOCu', '2023-05-13 18:27:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
