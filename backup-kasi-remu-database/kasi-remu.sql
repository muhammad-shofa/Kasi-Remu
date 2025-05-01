-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2025 at 09:43 AM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasi-remu`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'School and Office', '2025-04-15 22:21:07', '2025-04-15 22:21:07'),
(2, 'Fruits', '2025-04-15 22:21:07', '2025-04-15 22:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(10, 1, 'Notebook', 7000, 465, '2025-04-15 22:24:12', '2025-04-15 22:24:12'),
(13, 1, 'Pen', 5000, 345, '2025-04-15 23:08:35', '2025-04-15 23:08:35'),
(14, 2, 'Mango', 7000, 524, '2025-04-15 23:08:35', '2025-04-15 23:08:35'),
(16, 2, 'Apple', 4000, 111, '2025-04-18 13:04:42', '2025-04-18 13:04:42'),
(18, 2, 'Orange', 4000, 444, '2025-04-20 11:57:13', '2025-04-20 11:57:13'),
(19, 2, 'Watermelon', 27000, 525, '2025-04-24 14:48:58', '2025-04-24 14:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_transactions`
--

CREATE TABLE `tmp_transactions` (
  `tmp_txn_id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `user_id` int NOT NULL,
  `txn_code` varchar(50) NOT NULL,
  `total_amount` int NOT NULL,
  `cash_received` int NOT NULL,
  `change_returned` int NOT NULL,
  `status` enum('completed','cancelled') DEFAULT 'completed',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `txn_code`, `total_amount`, `cash_received`, `change_returned`, `status`, `created_at`, `updated_at`) VALUES
(27, 12, 'TXN-173b4f11-86e9-4721-9f67-d6822b5849fb', 41000, 50000, 9000, 'completed', '2025-05-01 08:57:28', '2025-05-01 08:57:28'),
(28, 12, 'TXN-9b96901a-891f-449d-9c94-f021031cebd4', 24000, 40000, 16000, 'completed', '2025-05-01 09:40:00', '2025-05-01 09:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `txn_detail_id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`txn_detail_id`, `transaction_id`, `item_id`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(35, 27, 13, 1, 5000, '2025-05-01 08:57:28', '2025-05-01 08:57:28'),
(36, 27, 14, 3, 21000, '2025-05-01 08:57:28', '2025-05-01 08:57:28'),
(37, 27, 18, 2, 8000, '2025-05-01 08:57:28', '2025-05-01 08:57:28'),
(38, 27, 10, 1, 7000, '2025-05-01 08:57:28', '2025-05-01 08:57:28'),
(39, 28, 13, 1, 5000, '2025-05-01 09:40:00', '2025-05-01 09:40:00'),
(40, 28, 14, 1, 7000, '2025-05-01 09:40:00', '2025-05-01 09:40:00'),
(41, 28, 18, 3, 12000, '2025-05-01 09:40:00', '2025-05-01 09:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('M','W') NOT NULL,
  `role` enum('admin','cashier','manager') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `email`, `gender`, `role`, `created_at`, `updated_at`) VALUES
(11, 'Wyxli', 'wyxli', '$2y$10$WDHHPvr6D/dzVQe6uwApbun7nxFZ//hL4Dm.33z0qBRGLmK0fUv2K', 'wyxli@gmail.com', 'M', 'manager', '2025-04-13 05:42:55', '2025-04-13 05:43:23'),
(12, 'Admin', 'admin', '$2y$10$nySugSgqZAUOW8Yyhi6QaODmwjADiioyO6fB6plN.AWu49hna0Sve', 'admin@gmail.com', 'M', 'admin', '2025-04-13 05:43:17', '2025-04-13 05:43:17'),
(13, 'Andreas', 'andreas', '$2y$10$7.NgVVSO/i05PlyU3hSzruTF1hoIv.s2cM20nsiTArZoqLE4EkiJW', 'andreas@gmail.com', 'M', 'cashier', '2025-04-13 05:45:28', '2025-04-13 05:45:28'),
(14, 'test 2', 'test', '$2y$10$IGW0UY6DVMHLjtW0GLKz6u2eRLn9JgCD57jxwFVwJaNdsBatYyy6S', 'test@gmail.com', 'W', 'manager', '2025-04-14 12:02:10', '2025-04-15 08:33:38'),
(15, 'anjay', 'anjay', '$2y$10$4Nq3ekggN5EVIe2C4ez8Ru7OJJnZ6PwQ5MZ3n64SuF5aTwU5EAEVW', 'anjay@gmail.com', 'M', 'cashier', '2025-04-15 08:33:58', '2025-04-15 08:33:58'),
(18, 'anjay mabar', 'anjaymabar', '$2y$10$aEOmUszYGBOZhNo7ebpw/eoytyOtdQ1dcdzEoJwjWLTgkG1WJ5lo6', 'anjaymabar@gmail.com', 'W', 'manager', '2025-04-18 12:39:10', '2025-04-18 12:39:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `tmp_transactions`
--
ALTER TABLE `tmp_transactions`
  ADD PRIMARY KEY (`tmp_txn_id`),
  ADD KEY `tmp_transactions_ibfk_1` (`user_id`),
  ADD KEY `tmp_transactions_ibfk_2` (`item_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`txn_detail_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tmp_transactions`
--
ALTER TABLE `tmp_transactions`
  MODIFY `tmp_txn_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `txn_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_transactions`
--
ALTER TABLE `tmp_transactions`
  ADD CONSTRAINT `tmp_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_transactions_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
