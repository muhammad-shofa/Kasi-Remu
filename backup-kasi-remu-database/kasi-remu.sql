-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2025 at 03:52 AM
-- Server version: 8.0.42-0ubuntu0.24.04.1
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
(10, 1, 'Notebook', 7000, 458, '2025-04-15 22:24:12', '2025-05-02 23:29:31'),
(13, 1, 'Pen', 5000, 334, '2025-04-15 23:08:35', '2025-05-02 23:29:31'),
(14, 2, 'Mango', 7000, 514, '2025-04-15 23:08:35', '2025-05-02 08:24:30'),
(16, 2, 'Apple', 4000, 101, '2025-04-18 13:04:42', '2025-05-02 23:29:31'),
(18, 2, 'Orange', 4000, 435, '2025-04-20 11:57:13', '2025-05-02 08:24:30'),
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
(31, 12, 'TXN-dd1ac5ac-6b15-42f5-9260-f6f55f1fcfba', 50000, 100000, 50000, 'completed', '2025-05-02 02:08:11', '2025-05-02 02:08:11'),
(32, 12, 'TXN-06738796-463b-4375-8d76-ee1a72b0e27d', 50000, 100000, 50000, 'completed', '2025-05-02 02:08:12', '2025-05-02 02:08:12'),
(33, 12, 'TXN-e3523acc-ca25-4010-b8a0-a9024f135e74', 50000, 100000, 50000, 'completed', '2025-05-02 02:09:21', '2025-05-02 02:09:21'),
(34, 12, 'TXN-2b5c8a42-5e5e-4a47-bb5c-12f0795487df', 53000, 60000, 7000, 'completed', '2025-05-02 02:11:41', '2025-05-02 02:11:41'),
(35, 12, 'TXN-8aca8ef3-c00e-4a97-bd1c-68fbbceca0d5', 12000, 12000, 0, 'completed', '2025-05-02 02:18:00', '2025-05-02 02:18:00'),
(36, 13, 'TXN-f7d52495-31cf-417f-b7ed-91b559c83bd6', 41000, 50000, 9000, 'completed', '2025-05-02 06:15:11', '2025-05-02 06:15:11'),
(37, 13, 'TXN-74842ba2-2d08-4530-9eef-978daddb2034', 44000, 60000, 16000, 'completed', '2025-05-02 08:24:30', '2025-05-02 08:24:30'),
(38, 12, 'TXN-8feb6183-3be4-4333-bc31-a3a83d6aa2c5', 50000, 50000, 0, 'completed', '2025-05-02 23:29:31', '2025-05-02 23:29:31');

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
(46, 31, 14, 4, 28000, '2025-05-02 02:08:11', '2025-05-02 02:08:11'),
(47, 32, 14, 4, 28000, '2025-05-02 02:08:12', '2025-05-02 02:08:12'),
(48, 33, 14, 4, 28000, '2025-05-02 02:09:21', '2025-05-02 02:09:21'),
(49, 33, 13, 2, 10000, '2025-05-02 02:09:21', '2025-05-02 02:09:21'),
(50, 33, 18, 3, 12000, '2025-05-02 02:09:21', '2025-05-02 02:09:21'),
(51, 34, 10, 3, 21000, '2025-05-02 02:11:41', '2025-05-02 02:11:41'),
(52, 34, 13, 4, 20000, '2025-05-02 02:11:41', '2025-05-02 02:11:41'),
(53, 34, 16, 2, 8000, '2025-05-02 02:11:41', '2025-05-02 02:11:41'),
(54, 34, 18, 1, 4000, '2025-05-02 02:11:41', '2025-05-02 02:11:41'),
(55, 35, 14, 1, 7000, '2025-05-02 02:18:00', '2025-05-02 02:18:00'),
(56, 35, 13, 1, 5000, '2025-05-02 02:18:00', '2025-05-02 02:18:00'),
(57, 36, 13, 2, 10000, '2025-05-02 06:15:11', '2025-05-02 06:15:11'),
(58, 36, 14, 1, 7000, '2025-05-02 06:15:11', '2025-05-02 06:15:11'),
(59, 36, 18, 3, 12000, '2025-05-02 06:15:11', '2025-05-02 06:15:11'),
(60, 36, 16, 3, 12000, '2025-05-02 06:15:11', '2025-05-02 06:15:11'),
(61, 37, 14, 4, 28000, '2025-05-02 08:24:30', '2025-05-02 08:24:30'),
(62, 37, 16, 2, 8000, '2025-05-02 08:24:30', '2025-05-02 08:24:30'),
(63, 37, 18, 2, 8000, '2025-05-02 08:24:30', '2025-05-02 08:24:30'),
(64, 38, 13, 2, 10000, '2025-05-02 23:29:31', '2025-05-02 23:29:31'),
(65, 38, 16, 3, 12000, '2025-05-02 23:29:31', '2025-05-02 23:29:31'),
(66, 38, 10, 4, 28000, '2025-05-02 23:29:31', '2025-05-02 23:29:31');

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
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `txn_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
