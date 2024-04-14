-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 07:51 PM
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
-- Database: `ecommerce_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` mediumtext NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `product_id`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'book9.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(2, 1, 'book7.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(3, 4, 'book2.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(4, 8, 'book9.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(5, 3, 'book1.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(6, 5, 'book5.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(7, 6, 'book4.png', 1, '2024-04-13 02:31:50', '2024-04-13 02:31:50'),
(8, 10, 'book8.png', 1, '2024-04-13 02:31:51', '2024-04-13 02:31:51'),
(9, 7, 'book4.png', 1, '2024-04-13 02:31:51', '2024-04-13 02:31:51'),
(10, 9, 'book7.png', 1, '2024-04-13 02:31:51', '2024-04-13 02:31:51'),
(11, 4, 'book9.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(12, 4, 'book1.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(13, 9, 'book2.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(14, 9, 'book9.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(15, 7, 'book7.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(16, 4, 'book7.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(17, 2, 'book4.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(18, 6, 'book1.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(19, 4, 'book3.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(20, 8, 'book3.png', 1, '2024-04-13 02:35:02', '2024-04-13 02:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2024_03_29_075308_create_products_table', 1),
(18, '2024_03_29_092353_create_galleries_table', 1),
(19, '2024_03_31_173854_create_purchased_products_table', 1),
(20, '2024_04_01_114916_add_slug_into_products_table', 1),
(21, '2024_04_03_055737_add_image_colum_into_purchasedproducts_table=purchased_products', 1),
(22, '2024_04_09_044955_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` text NOT NULL,
  `amount` bigint(20) NOT NULL,
  `currency` tinytext NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `amount`, `currency`, `product_name`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'cs_test_a19FcSJixsXqIPYXyRUivGpnkBmqamQgfhvnns0fQ6R9jQ2kwvjchPDgEF', 402, 'bdt', 'Book', 1, 'processed', '2024-04-13 04:43:32', '2024-04-13 04:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 'product39', 'product81bP', 23, 402, '2024-04-13 02:35:01', '2024-04-13 04:42:55'),
(2, 'product26', 'product4sb', 35, 277, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(3, 'product34', 'product234s', 79, 244, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(4, 'product32', 'product81gw', 45, 174, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(5, 'product95', 'product106H', 29, 453, '2024-04-13 02:35:02', '2024-04-13 04:57:53'),
(6, 'product9', 'product39qv', 27, 14, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(7, 'product83', 'product90cQ', 31, 485, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(8, 'product59', 'product36dl', 67, 206, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(9, 'product1', 'product36R', 69, 195, '2024-04-13 02:35:02', '2024-04-13 02:35:02'),
(10, 'product96', 'product627m', 71, 419, '2024-04-13 02:35:02', '2024-04-13 02:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_products`
--

CREATE TABLE `purchased_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchased_products`
--

INSERT INTO `purchased_products` (`id`, `user_id`, `name`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'product39', 1, 402, 'assets/site/img/book7.png', '2024-04-13 04:42:55', '2024-04-13 04:43:21'),
(2, 1, 'product95', 1, 453, 'assets/site/img/book5.png', '2024-04-13 04:57:53', '2024-04-13 04:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sagor Ali BD', 'mdsagorali033@gmail.com', NULL, '$2y$12$49E94ABG9J9ZIvcoooQpNuTr2fnN3UB15K/eWUL4sXxcNbLS.fuA2', NULL, '2024-04-13 04:27:31', '2024-04-13 04:27:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchased_products_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchased_products`
--
ALTER TABLE `purchased_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD CONSTRAINT `purchased_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
