-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2024 at 11:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.18

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
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Intel', 'intel', 1, '2024-04-25 20:30:53', '2024-04-25 20:30:53'),
(2, 'Gigabyte', 'gigabyte', 0, '2024-04-25 20:31:30', '2024-04-25 20:31:30'),
(3, 'I phone', 'i-phone', 0, '2024-04-25 20:32:04', '2024-04-25 20:32:04'),
(4, 'sbd Sagor', 'sbd-sagor', 1, '2024-04-25 21:20:02', '2024-04-25 21:20:02'),
(5, 'ddsfsf', 'ddsfsf', 1, '2024-04-25 21:30:19', '2024-04-25 21:30:19'),
(6, 'effffffffffff', 'effffffffffff', 1, '2024-04-25 21:31:43', '2024-04-25 21:31:43'),
(7, 'sfeadfsa', 'sfeadfsa', 1, '2024-04-25 21:34:17', '2024-04-25 21:34:17'),
(8, 'tttttt', 'tttttt', 1, '2024-04-25 21:34:34', '2024-04-25 21:34:34'),
(9, 'dfsfdsdf', 'dfsfdsdf', 1, '2024-04-25 21:35:40', '2024-04-25 21:35:40'),
(10, 'ffdsafdsf', 'ffdsafdsf', 1, '2024-04-25 21:37:03', '2024-04-25 21:37:03'),
(11, 'sfefsafdsfdsdf', 'sfefsafdsfdsdf', 1, '2024-04-25 21:37:14', '2024-04-25 21:37:14'),
(12, 'sfjsadlkf', 'sfjsadlkf', 1, '2024-04-26 02:46:51', '2024-04-26 02:46:51'),
(13, 'notun', 'notun', 1, '2024-04-26 03:29:58', '2024-04-26 03:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Boods', 'books', NULL, 1, '2024-04-16 07:47:28', '2024-04-16 07:47:28'),
(2, 'New Cloths', 'new-cloths', NULL, 1, '2024-04-17 05:58:05', '2024-04-17 05:58:05'),
(3, 'Three Pice', 'three-pice', NULL, 0, '2024-04-17 07:12:20', '2024-04-17 07:12:20'),
(5, 'Dejon Welch', 'Philip Klein', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(6, 'Miss Margarete Koepp PhD', 'Sophia Lemke', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(7, 'Virginie Kshlerin V', 'Dr. Zelma Zieme III', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(9, 'Sincere Anderson', 'Madelyn Boyle', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(10, 'Tania Hill', 'Mr. Ricardo Jerde Jr.', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(11, 'Eudora Herzog V', 'Charlene Tromp', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(12, 'Austen Terry', 'Hazel Feil', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(13, 'Aiden Kassulke', 'Miss Delphia Pollich', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(14, 'Prof. Bret Kris', 'Grace Willms', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(15, 'Miss Audreanne Welch', 'Misael Bechtelar IV', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(16, 'Marlee Baumbach', 'Mr. Darrell Dickens Sr.', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(17, 'Fletcher O\'Kon', 'Prof. Antwon Rogahn', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(18, 'Cortney Sipes', 'Christa Conn', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(19, 'Arvel Sawayn', 'Mr. Roscoe Nader', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(20, 'Prof. Yoshiko Brakus', 'Randy Skiles', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(21, 'Alycia Cummings', 'Ms. Nikita Greenholt', NULL, 1, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(22, 'Kaley DuBuque', 'Marcos Cummings', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(23, 'Lessie Armstrong', 'Maeve Macejkovic', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(24, 'Ms. Leta Vandervort', 'Mr. Pierce Heller Sr.', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(25, 'Gaetano Marquardt V', 'Amaya Rodriguez', NULL, 0, '2024-04-17 07:53:43', '2024-04-17 07:53:43'),
(26, 'Lyric Aufderhar', 'Anais Will', NULL, 0, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(27, 'Miss Arlie Hermann', 'Marjolaine Runolfsson', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(28, 'Shirley Bednar', 'Janick Eichmann', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(29, 'Prof. Emmett Crona', 'Mr. Branson Leannon', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(30, 'Taylor Dickens', 'Dr. Junius Ruecker', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(31, 'Dr. Angel Kihn Sr.', 'Jarvis King', NULL, 0, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(32, 'Vella Paucek DDS', 'Lonie Gleason', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(33, 'Ken Waters', 'Prof. Clifton Wiza DDS', NULL, 1, '2024-04-17 07:53:44', '2024-04-17 07:53:44'),
(34, 'Bangla Book', 'bangla-book', NULL, 1, '2024-04-17 09:27:05', '2024-04-17 09:27:05'),
(35, 'Electornic', 'electornic', NULL, 1, '2024-04-17 09:32:39', '2024-04-17 09:32:39'),
(36, 'english book', 'english-book', NULL, 1, '2024-04-17 09:36:34', '2024-04-17 09:36:34'),
(37, 'Math Book', 'math-book', NULL, 1, '2024-04-17 09:39:29', '2024-04-17 09:39:29'),
(38, 'Family', 'family', NULL, 1, '2024-04-17 10:51:08', '2024-04-17 10:51:08'),
(39, 'new collections', 'new-collections', '39.jpg', 1, '2024-04-17 21:25:04', '2024-04-17 21:25:04'),
(40, 'Siter Kapor', 'siter-kapor', NULL, 1, '2024-04-18 01:11:03', '2024-04-18 01:11:03'),
(41, 'new books', 'new-books', NULL, 1, '2024-04-18 02:52:01', '2024-04-18 02:52:01'),
(42, 'new bookss', 'new-bookss', NULL, 1, '2024-04-18 02:53:15', '2024-04-18 02:53:15'),
(43, 'New Clothsasdfsf', 'new-clothsasdfsf', NULL, 1, '2024-04-18 02:54:40', '2024-04-18 02:54:40'),
(44, 'slkdafsa', 'slkdafsa', NULL, 1, '2024-04-18 02:59:04', '2024-04-18 02:59:04'),
(45, 'safsafsafs', 'safsafsafs', NULL, 1, '2024-04-18 03:02:53', '2024-04-18 03:02:53'),
(46, 'safedd33', 'safedd33', NULL, 1, '2024-04-18 03:03:38', '2024-04-18 03:03:38'),
(47, 'sdfsfdsafdsdafsdadfsa', 'sdfsfdsafdsdafsdadfsa', NULL, 1, '2024-04-18 03:09:45', '2024-04-18 03:09:45'),
(48, 'dsfsadfsfsfsadf', 'dsfsadfsfsfsadf', NULL, 1, '2024-04-18 03:19:06', '2024-04-18 03:19:06'),
(49, 'sdfsdfs', 'sdfsdfs', NULL, 1, '2024-04-18 03:20:05', '2024-04-18 03:20:05'),
(50, 'dfsafsfsdf', 'dfsafsfsdf', NULL, 1, '2024-04-18 03:24:16', '2024-04-18 03:24:16'),
(51, 'sdfwefsfsafs', 'sdfwefsfsafs', NULL, 1, '2024-04-18 03:25:37', '2024-04-18 03:25:37'),
(52, 'sdfsaf afsaf', 'sdfsaf-afsaf', NULL, 1, '2024-04-18 03:44:54', '2024-04-18 03:44:54'),
(53, 'fsaffsfafsafsfjlskjflk', 'fsaffsfafsafsfjlskjflk', NULL, 1, '2024-04-18 03:56:15', '2024-04-18 03:56:15'),
(54, '65d4f65sa', '65d4f65sa', NULL, 1, '2024-04-18 03:58:40', '2024-04-18 03:58:40'),
(55, 'fsafsafsafsf', 'fsafsafsafsf', '55.png', 1, '2024-04-18 03:59:28', '2024-04-18 03:59:28'),
(56, 'sdajflksjf', 'sdajflksjf', NULL, 1, '2024-04-18 04:14:41', '2024-04-18 04:14:41'),
(57, 'kjsdfsalkfjlksjflksafd', 'kjsdfsalkfjlksjflksafd', NULL, 1, '2024-04-18 05:59:12', '2024-04-18 05:59:12'),
(58, '6565365135', '6565365135', NULL, 1, '2024-04-18 06:07:41', '2024-04-18 06:07:41'),
(59, '6454654654', '6454654654', NULL, 1, '2024-04-18 06:14:21', '2024-04-18 06:14:21'),
(60, 'sadfsafsfdsfsdfsfds', 'sadfsafsfdsfsdfsfds', NULL, 1, '2024-04-18 06:15:46', '2024-04-18 06:15:46'),
(61, 'sdfs', 'sdfs', NULL, 1, '2024-04-18 06:18:17', '2024-04-18 06:18:17'),
(62, 'poikjk', 'poikjk', NULL, 1, '2024-04-18 07:19:40', '2024-04-18 07:19:40'),
(63, '434343434343535', '434343434343535', NULL, 1, '2024-04-18 07:25:21', '2024-04-18 07:25:21'),
(64, '৩৫৫৩৪৫৩৫৪', '355345354', NULL, 1, '2024-04-18 07:36:54', '2024-04-18 07:36:54'),
(65, 'fdsafsfdsfd', 'fdsafsfdsfd', NULL, 1, '2024-04-18 07:38:20', '2024-04-18 07:38:20'),
(66, 'rweafsdfsf', 'rweafsdfsf', NULL, 1, '2024-04-18 07:39:51', '2024-04-18 07:39:51'),
(67, 'sdfksfd', 'sdfksfd', NULL, 1, '2024-04-18 07:51:59', '2024-04-18 07:51:59'),
(68, 'lksfjskjfkas', 'lksfjskjfkas', NULL, 1, '2024-04-18 07:58:25', '2024-04-18 07:58:25'),
(69, '65654646', '65654646', NULL, 1, '2024-04-18 08:01:02', '2024-04-18 08:01:02'),
(70, 'skfslkjfslkjflkjsa', 'skfslkjfslkjflkjsa', NULL, 1, '2024-04-18 08:02:44', '2024-04-18 08:02:44'),
(71, 'slkfsalfdjl', 'slkfsalfdjl', NULL, 1, '2024-04-18 08:06:29', '2024-04-18 08:06:29'),
(72, 'lksfjskafjksjfklsafjsafjlsaf', 'lksfjskafjksjfklsafjsafjlsaf', NULL, 1, '2024-04-18 08:08:01', '2024-04-18 08:08:01'),
(73, 'sdafsadfsf', 'sdafsadfsf', NULL, 1, '2024-04-18 08:15:59', '2024-04-18 08:15:59'),
(74, 'fsfsfljfj', 'fsfsfljfj', NULL, 1, '2024-04-18 08:22:03', '2024-04-18 08:22:03'),
(75, 'sdlkjsdjlk', 'sdlkjsdjlk', NULL, 1, '2024-04-18 08:23:31', '2024-04-18 08:23:31'),
(76, 'jsdfkfsdkj', 'jsdfkfsdkj', NULL, 1, '2024-04-18 08:30:40', '2024-04-18 08:30:40'),
(77, 'sdfsfsfsfsa', 'sdfsfsfsfsa', NULL, 1, '2024-04-18 08:34:31', '2024-04-18 08:34:31'),
(78, 'skfsfljsfkjal', 'skfsfljsfkjal', NULL, 1, '2024-04-18 08:49:25', '2024-04-18 08:49:25'),
(79, 'kjo', 'kjo', NULL, 1, '2024-04-18 08:53:25', '2024-04-18 08:53:25'),
(80, 'safdsafsdfsad', 'safdsafsdfsad', NULL, 1, '2024-04-18 08:54:16', '2024-04-18 08:54:16'),
(81, 'eafsdfsaf', 'eafsdfsaf', NULL, 1, '2024-04-18 09:07:14', '2024-04-18 09:07:14'),
(83, 'sdfsfsfsfds', 'sdfsfsfsfds', '83.png', 1, '2024-04-18 10:18:23', '2024-04-18 10:18:23'),
(84, 'sfefasdf', 'sfefasdf', '84.jpg', 1, '2024-04-18 10:28:58', '2024-04-18 10:28:58'),
(85, 'ikjsdlkjsdkj', 'ikjsdlkjsdkj', NULL, 1, '2024-04-18 10:42:31', '2024-04-18 10:42:31'),
(86, 'easdfsfsf', 'easdfsfsf', NULL, 1, '2024-04-18 10:45:57', '2024-04-18 10:45:57'),
(88, 'Summer Collection', 'summer-collection', NULL, 1, '2024-04-18 10:53:24', '2024-04-18 10:53:24'),
(89, 'my book', 'my-book', NULL, 1, '2024-04-18 18:18:39', '2024-04-18 18:18:39'),
(90, 'fsdfsadfsfd', 'fsdfsadfsfd', NULL, 1, '2024-04-18 18:54:11', '2024-04-18 18:54:11'),
(91, 'sdfsa', 'sdfsa', NULL, 1, '2024-04-18 18:57:25', '2024-04-18 18:57:25'),
(92, 'sfaksfjlkajf', 'sfaksfjlkajf', NULL, 1, '2024-04-18 19:00:04', '2024-04-18 19:00:04'),
(93, 'sdfjskafjlksajf', 'sdfjskafjlksajf', NULL, 1, '2024-04-18 19:14:15', '2024-04-18 19:14:15'),
(94, 'sjdfsfldjs', 'sjdfsfldjs', NULL, 1, '2024-04-18 19:22:15', '2024-04-18 19:22:15'),
(95, 'tty', 'tty', '95.jpg', 0, '2024-04-18 21:12:30', '2024-04-18 21:12:30'),
(96, 'new category', 'new-category', NULL, 1, '2024-04-18 21:32:48', '2024-04-18 21:32:48'),
(97, 'new1', 'new1', NULL, 1, '2024-04-18 21:36:01', '2024-04-18 21:36:01'),
(98, 'uuuu', 'uuuu', 'C:\\xampp\\htdocs\\ecommerce.shop\\public/uploads/category/thumb/98.jpg', 1, '2024-04-18 21:38:38', '2024-04-18 21:38:38'),
(99, 'jj', 'jj', 'C:\\xampp\\htdocs\\ecommerce.shop\\public/uploads/category/thumb/99.png', 1, '2024-04-18 21:45:16', '2024-04-18 21:45:17'),
(101, 'Vegetable', 'vegetable', 'C:\\xampp\\htdocs\\ecommerce.shop\\public/uploads/category/thumb/101.jpg', 1, '2024-04-19 11:44:10', '2024-04-19 11:44:11'),
(102, 'new summer', 'new-summer', NULL, 1, '2024-04-19 19:09:02', '2024-04-19 19:09:02'),
(103, 'fsdafsdfs', 'fsdafsdfs', NULL, 1, '2024-04-19 19:09:44', '2024-04-19 19:09:44'),
(104, 'sdfasdfs', 'sdfasdfs', NULL, 1, '2024-04-19 19:10:30', '2024-04-19 19:10:30'),
(105, 'sdfsadf', 'sdfsadf', 'C:\\xampp\\htdocs\\ecommerce.shop\\public/uploads/category/thumb/105.png', 1, '2024-04-19 19:12:18', '2024-04-19 19:12:18'),
(106, 'sdjfsafkls', 'sdjfsafkls', NULL, 1, '2024-04-19 19:34:12', '2024-04-19 19:34:12'),
(107, 'dfsfsfsafs', 'dfsfsfsafs', NULL, 1, '2024-04-19 19:34:37', '2024-04-19 19:34:37'),
(111, 'Ladies Collection', 'ladies-collection', '111-time().jpeg', 1, '2024-04-22 07:14:52', '2024-04-23 05:21:02'),
(117, 'sdfsafdsafdsfsad12', 'sdfsafdsafdsfsad12', NULL, 1, '2024-04-24 02:44:14', '2024-04-24 02:44:14'),
(118, 'rere', 'rere', NULL, 1, '2024-04-24 02:44:55', '2024-04-24 02:44:55'),
(119, 'sdfsalkfjslkf', 'sdfsalkfjslkf', NULL, 1, '2024-04-24 03:06:39', '2024-04-24 03:06:39'),
(120, '45', '45', '_thumbnail.jpg', 1, '2024-04-24 03:15:42', '2024-04-24 03:15:42'),
(121, 'efsf', 'efsf', '_thumbnail.jpg', 1, '2024-04-24 03:20:51', '2024-04-24 03:20:51'),
(122, 'fasfjlasf21', 'fasfjlasf21', '_thumbnail.jpg', 1, '2024-04-24 03:38:48', '2024-04-24 03:38:48'),
(123, 'child dresh', 'child-dresh', '123_thumbnail.jpeg', 1, '2024-04-24 03:46:02', '2024-04-24 05:23:03'),
(125, 'girls dresh', 'girls-dresh', '_thumbnail.jpeg', 1, '2024-04-24 04:54:23', '2024-04-24 04:54:23'),
(126, 'Boys dresh', 'boys-dresh', '_thumbnail.jpg', 1, '2024-04-24 04:56:31', '2024-04-24 04:56:31'),
(127, 'my dresh', 'my-dresh', '_thumbnail.jpg', 1, '2024-04-24 05:22:25', '2024-04-24 05:22:25'),
(128, 'Man collection1', 'man-collection1', '128_thumbnail.jpg', 1, '2024-04-24 05:25:23', '2024-04-24 05:39:43'),
(129, 'Ym', 'ym', '_thumbnail.jpg', 1, '2024-04-24 05:40:21', '2024-04-24 05:40:21'),
(131, 'Boys collections', 'boys-collections', '131-.time()._thumbnail.jpeg', 1, '2024-04-24 05:46:07', '2024-04-24 05:49:14'),
(132, 'myboy', 'myboy', '-.time()._thumbnail.jpg', 1, '2024-04-24 05:47:19', '2024-04-24 05:47:19'),
(135, 'tttt1', 'tttt1', '135-.time()._thumbnail.jpg', 1, '2024-04-25 12:06:43', '2024-04-25 12:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `product_id`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'book1.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(2, 4, 'book9.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(3, 1, 'book9.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(4, 1, 'book3.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(5, 4, 'book5.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(6, 3, 'book2.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(7, 10, 'book1.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(8, 2, 'book6.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(9, 1, 'book6.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35'),
(10, 6, 'book8.png', 1, '2024-04-15 22:26:35', '2024-04-15 22:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_29_075308_create_products_table', 1),
(7, '2024_03_29_092353_create_galleries_table', 1),
(8, '2024_03_31_173854_create_purchased_products_table', 1),
(9, '2024_04_01_114916_add_slug_into_products_table', 1),
(10, '2024_04_03_055737_add_image_colum_into_purchasedproducts_table=purchased_products', 1),
(11, '2024_04_09_044955_create_payments_table', 1),
(12, '2024_04_16_083935_create_categories_table', 2),
(13, '2024_04_17_163807_create_temp_images_table', 3),
(14, '2024_04_23_114700_create_sub_categories_table', 4),
(15, '2024_04_25_184419_create_brands_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint NOT NULL,
  `currency` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `amount`, `currency`, `product_name`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'cs_test_a1WY8xwW5PsK7IyfBsruOcoOx2seLvWcSGjbGDwXc6UCpdVPqqt3vkrgx4', 586, 'bdt', 'Book', 1, 'in-active', '2024-04-15 23:25:26', '2024-04-15 23:25:26'),
(2, 1, 'cs_test_a1dbCoGBJi8JEira6VQdB7oEtoewNt0HRqrFxMLj19hu848B2Xw5GmjBgV', 1247, 'bdt', 'Book', 1, 'in-active', '2024-04-15 23:31:58', '2024-04-15 23:31:58'),
(3, 1, 'cs_test_a1C9xsbeE9ilqK0mNNl5AY1eJDYrGUTk1TCXYaYckMEI7RulUjjUOek9ff', 1247, 'bdt', 'Book', 1, 'in-active', '2024-04-15 23:32:41', '2024-04-15 23:32:41'),
(4, 1, 'cs_test_a1FY4grATNDxnhPeHsWdPTOBAz9JsiBCYsc0hnn6JuxlohCi0rOcSLVMVc', 586, 'bdt', 'Book', 1, 'in-active', '2024-04-18 10:00:29', '2024-04-18 10:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint NOT NULL,
  `price` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 'product80', 'product51sR', 64, 96, '2024-04-15 22:26:34', '2024-04-16 00:22:50'),
(2, 'product55', 'product36GX', 77, 391, '2024-04-15 22:26:34', '2024-04-18 09:51:52'),
(3, 'product89', 'product69tq', 16, 107, '2024-04-15 22:26:34', '2024-04-15 22:26:34'),
(4, 'product4', 'product67wv', 19, 245, '2024-04-15 22:26:34', '2024-04-16 00:22:52'),
(5, 'product4', 'product28co', 49, 460, '2024-04-15 22:26:34', '2024-04-15 23:31:39'),
(6, 'product99', 'product58jL', 29, 201, '2024-04-15 22:26:34', '2024-04-15 23:31:41'),
(7, 'product68', 'product86o9', 49, 426, '2024-04-15 22:26:34', '2024-04-15 22:26:34'),
(8, 'product42', 'product79Mr', 22, 189, '2024-04-15 22:26:34', '2024-04-15 22:26:34'),
(9, 'product94', 'product28PU', 37, 456, '2024-04-15 22:26:34', '2024-04-15 22:26:34'),
(10, 'product92', 'product29Hw', 27, 176, '2024-04-15 22:26:35', '2024-04-15 22:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_products`
--

CREATE TABLE `purchased_products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint NOT NULL,
  `price` bigint NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchased_products`
--

INSERT INTO `purchased_products` (`id`, `user_id`, `name`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'product80', 1, 96, 'assets/site/img/book1.png', '2024-04-15 23:25:04', '2024-04-15 23:25:04'),
(2, 1, 'product4', 2, 245, 'assets/site/img/book9.png', '2024-04-15 23:25:06', '2024-04-15 23:25:14'),
(5, 2, 'product80', 1, 96, 'assets/site/img/book1.png', '2024-04-16 00:22:50', '2024-04-16 00:22:50'),
(6, 2, 'product4', 1, 245, 'assets/site/img/book9.png', '2024-04-16 00:22:52', '2024-04-16 00:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 'abc vegetable', 'abc-vegetable', 1, 101, '2024-04-25 06:39:24', '2024-04-25 06:39:24'),
(7, '5555', '5555', 1, 54, '2024-04-25 11:03:25', '2024-04-25 11:25:00'),
(8, 'sadfsafdsf', 'sadfsafdsf', 1, 19, '2024-04-25 11:03:32', '2024-04-25 11:03:32'),
(9, 'fsdfdsf', 'fsdfdsf', 1, 59, '2024-04-25 11:11:54', '2024-04-25 11:11:54'),
(10, 'sdfsfdsafdsa', 'sdfsfdsafdsa', 1, 13, '2024-04-25 11:12:11', '2024-04-25 11:12:11'),
(12, 'sdfefsfsfsfds', 'sdfefsfsfsfds', 1, 12, '2024-04-25 11:12:32', '2024-04-25 11:12:32'),
(13, 'dsfsadfsdfsadfsafd', 'dsfsadfsdfsadfsafd', 1, 126, '2024-04-25 11:12:43', '2024-04-25 11:12:43'),
(14, 'dfesfsfsfsf', 'dfesfsfsfsf', 1, 126, '2024-04-25 11:13:00', '2024-04-25 11:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1713372981.jpg', '2024-04-17 10:56:21', '2024-04-17 10:56:21'),
(2, '1713373315.png', '2024-04-17 11:01:55', '2024-04-17 11:01:55'),
(3, '1713373480.png', '2024-04-17 11:04:40', '2024-04-17 11:04:40'),
(4, '1713373585.jpg', '2024-04-17 11:06:25', '2024-04-17 11:06:25'),
(5, '1713373598.jpg', '2024-04-17 11:06:38', '2024-04-17 11:06:38'),
(6, '1713373982.jpg', '2024-04-17 11:13:02', '2024-04-17 11:13:02'),
(7, '1713375623.jpg', '2024-04-17 11:40:23', '2024-04-17 11:40:23'),
(8, '1713376055.png', '2024-04-17 11:47:35', '2024-04-17 11:47:35'),
(9, '1713406028.jpg', '2024-04-17 20:07:08', '2024-04-17 20:07:08'),
(10, '1713406167.jpg', '2024-04-17 20:09:27', '2024-04-17 20:09:27'),
(11, '1713409767.png', '2024-04-17 21:09:27', '2024-04-17 21:09:27'),
(12, '1713409899.png', '2024-04-17 21:11:39', '2024-04-17 21:11:39'),
(13, '1713410578.jpg', '2024-04-17 21:22:58', '2024-04-17 21:22:58'),
(14, '1713424259.jpg', '2024-04-18 01:10:59', '2024-04-18 01:10:59'),
(15, '1713430317.png', '2024-04-18 02:51:57', '2024-04-18 02:51:57'),
(16, '1713430375.png', '2024-04-18 02:52:55', '2024-04-18 02:52:55'),
(17, '1713430478.png', '2024-04-18 02:54:38', '2024-04-18 02:54:38'),
(18, '1713430742.png', '2024-04-18 02:59:02', '2024-04-18 02:59:02'),
(19, '1713430971.png', '2024-04-18 03:02:51', '2024-04-18 03:02:51'),
(20, '1713431012.jpg', '2024-04-18 03:03:32', '2024-04-18 03:03:32'),
(21, '1713431378.png', '2024-04-18 03:09:38', '2024-04-18 03:09:38'),
(22, '1713431921.png', '2024-04-18 03:18:41', '2024-04-18 03:18:41'),
(23, '1713432002.png', '2024-04-18 03:20:02', '2024-04-18 03:20:02'),
(24, '1713432254.png', '2024-04-18 03:24:14', '2024-04-18 03:24:14'),
(25, '1713432334.png', '2024-04-18 03:25:34', '2024-04-18 03:25:34'),
(26, '1713433490.png', '2024-04-18 03:44:50', '2024-04-18 03:44:50'),
(27, '1713434172.png', '2024-04-18 03:56:12', '2024-04-18 03:56:12'),
(28, '1713434318.png', '2024-04-18 03:58:38', '2024-04-18 03:58:38'),
(29, '1713434367.png', '2024-04-18 03:59:27', '2024-04-18 03:59:27'),
(30, '1713435277.png', '2024-04-18 04:14:37', '2024-04-18 04:14:37'),
(31, '1713441544.jpg', '2024-04-18 05:59:04', '2024-04-18 05:59:04'),
(32, '1713442057.png', '2024-04-18 06:07:37', '2024-04-18 06:07:37'),
(33, '1713442460.png', '2024-04-18 06:14:20', '2024-04-18 06:14:20'),
(34, '1713442543.png', '2024-04-18 06:15:43', '2024-04-18 06:15:43'),
(35, '1713442694.png', '2024-04-18 06:18:14', '2024-04-18 06:18:14'),
(36, '1713446369.jpg', '2024-04-18 07:19:29', '2024-04-18 07:19:29'),
(37, '1713446719.jpg', '2024-04-18 07:25:19', '2024-04-18 07:25:19'),
(38, '1713447406.png', '2024-04-18 07:36:46', '2024-04-18 07:36:46'),
(39, '1713447497.png', '2024-04-18 07:38:17', '2024-04-18 07:38:17'),
(40, '1713447589.jpg', '2024-04-18 07:39:49', '2024-04-18 07:39:49'),
(41, '1713448316.jpg', '2024-04-18 07:51:56', '2024-04-18 07:51:56'),
(42, '1713448704.jpg', '2024-04-18 07:58:24', '2024-04-18 07:58:24'),
(43, '1713448861.png', '2024-04-18 08:01:01', '2024-04-18 08:01:01'),
(44, '1713448960.png', '2024-04-18 08:02:40', '2024-04-18 08:02:40'),
(45, '1713449187.png', '2024-04-18 08:06:27', '2024-04-18 08:06:27'),
(46, '1713449278.png', '2024-04-18 08:07:58', '2024-04-18 08:07:58'),
(47, '1713449758.jpg', '2024-04-18 08:15:58', '2024-04-18 08:15:58'),
(48, '1713450120.jpg', '2024-04-18 08:22:00', '2024-04-18 08:22:00'),
(49, '1713450210.png', '2024-04-18 08:23:30', '2024-04-18 08:23:30'),
(50, '1713450638.jpg', '2024-04-18 08:30:38', '2024-04-18 08:30:38'),
(51, '1713450869.png', '2024-04-18 08:34:29', '2024-04-18 08:34:29'),
(52, '1713451763.png', '2024-04-18 08:49:23', '2024-04-18 08:49:23'),
(53, '1713452004.jpg', '2024-04-18 08:53:24', '2024-04-18 08:53:24'),
(54, '1713452055.png', '2024-04-18 08:54:15', '2024-04-18 08:54:15'),
(55, '1713452829.png', '2024-04-18 09:07:09', '2024-04-18 09:07:09'),
(56, '1713457051.jpg', '2024-04-18 10:17:32', '2024-04-18 10:17:32'),
(57, '1713457101.png', '2024-04-18 10:18:21', '2024-04-18 10:18:21'),
(58, '1713457736.jpg', '2024-04-18 10:28:56', '2024-04-18 10:28:56'),
(59, '1713458548.jpg', '2024-04-18 10:42:28', '2024-04-18 10:42:28'),
(60, '1713458755.png', '2024-04-18 10:45:55', '2024-04-18 10:45:55'),
(61, '1713459119.jpg', '2024-04-18 10:51:59', '2024-04-18 10:51:59'),
(62, '1713459179.jpg', '2024-04-18 10:52:59', '2024-04-18 10:52:59'),
(63, '1713485913.png', '2024-04-18 18:18:33', '2024-04-18 18:18:33'),
(64, '1713488047.jpg', '2024-04-18 18:54:07', '2024-04-18 18:54:07'),
(65, '1713488243.png', '2024-04-18 18:57:23', '2024-04-18 18:57:23'),
(66, '1713488402.jpg', '2024-04-18 19:00:02', '2024-04-18 19:00:02'),
(67, '1713489253.png', '2024-04-18 19:14:13', '2024-04-18 19:14:13'),
(68, '1713489733.png', '2024-04-18 19:22:13', '2024-04-18 19:22:13'),
(69, '1713496346.jpg', '2024-04-18 21:12:26', '2024-04-18 21:12:26'),
(70, '1713497565.jpg', '2024-04-18 21:32:45', '2024-04-18 21:32:45'),
(71, '1713497759.png', '2024-04-18 21:35:59', '2024-04-18 21:35:59'),
(72, '1713497907.jpg', '2024-04-18 21:38:27', '2024-04-18 21:38:27'),
(73, '1713498313.png', '2024-04-18 21:45:13', '2024-04-18 21:45:13'),
(74, '1713501645.png', '2024-04-18 22:40:45', '2024-04-18 22:40:45'),
(75, '1713506648.png', '2024-04-19 00:04:08', '2024-04-19 00:04:08'),
(76, '1713548649.jpg', '2024-04-19 11:44:09', '2024-04-19 11:44:09'),
(77, '1713575339.png', '2024-04-19 19:08:59', '2024-04-19 19:08:59'),
(78, '1713575382.png', '2024-04-19 19:09:42', '2024-04-19 19:09:42'),
(79, '1713575429.png', '2024-04-19 19:10:29', '2024-04-19 19:10:29'),
(80, '1713575537.png', '2024-04-19 19:12:17', '2024-04-19 19:12:17'),
(81, '1713576850.png', '2024-04-19 19:34:10', '2024-04-19 19:34:10'),
(82, '1713576869.png', '2024-04-19 19:34:29', '2024-04-19 19:34:29'),
(83, '1713577037.png', '2024-04-19 19:37:17', '2024-04-19 19:37:17'),
(84, '1713577830.png', '2024-04-19 19:50:30', '2024-04-19 19:50:30'),
(85, '1713585472.jpg', '2024-04-19 21:57:52', '2024-04-19 21:57:52'),
(86, '1713600189.png', '2024-04-20 02:03:09', '2024-04-20 02:03:09'),
(87, '1713693158.jpg', '2024-04-21 03:52:38', '2024-04-21 03:52:38'),
(88, '1713693294.png', '2024-04-21 03:54:54', '2024-04-21 03:54:54'),
(89, '1713694504.png', '2024-04-21 04:15:04', '2024-04-21 04:15:04'),
(90, '1713782323.png', '2024-04-22 04:38:43', '2024-04-22 04:38:43'),
(91, '1713785031.png', '2024-04-22 05:23:51', '2024-04-22 05:23:51'),
(92, '1713785362.png', '2024-04-22 05:29:22', '2024-04-22 05:29:22'),
(93, '1713786021.png', '2024-04-22 05:40:21', '2024-04-22 05:40:21'),
(94, '1713788025.png', '2024-04-22 06:13:45', '2024-04-22 06:13:45'),
(95, '1713789592.png', '2024-04-22 06:39:52', '2024-04-22 06:39:52'),
(96, '1713789627.png', '2024-04-22 06:40:27', '2024-04-22 06:40:27'),
(97, '1713790779.png', '2024-04-22 06:59:39', '2024-04-22 06:59:39'),
(98, '1713791064.png', '2024-04-22 07:04:24', '2024-04-22 07:04:24'),
(99, '1713791109.png', '2024-04-22 07:05:09', '2024-04-22 07:05:09'),
(100, '1713791641.png', '2024-04-22 07:14:01', '2024-04-22 07:14:01'),
(101, '1713791683.png', '2024-04-22 07:14:43', '2024-04-22 07:14:43'),
(102, '1713792918.png', '2024-04-22 07:35:18', '2024-04-22 07:35:18'),
(103, '1713793027.jpg', '2024-04-22 07:37:07', '2024-04-22 07:37:07'),
(104, '1713793412.png', '2024-04-22 07:43:32', '2024-04-22 07:43:32'),
(105, '1713793871.png', '2024-04-22 07:51:11', '2024-04-22 07:51:11'),
(106, '1713794119.png', '2024-04-22 07:55:19', '2024-04-22 07:55:19'),
(107, '1713794254.png', '2024-04-22 07:57:34', '2024-04-22 07:57:34'),
(108, '1713794483.png', '2024-04-22 08:01:23', '2024-04-22 08:01:23'),
(109, '1713798139.png', '2024-04-22 09:02:19', '2024-04-22 09:02:19'),
(110, '1713798198.png', '2024-04-22 09:03:18', '2024-04-22 09:03:18'),
(111, '1713798313.png', '2024-04-22 09:05:13', '2024-04-22 09:05:13'),
(112, '1713838802.png', '2024-04-22 20:20:02', '2024-04-22 20:20:02'),
(113, '1713844128.jpg', '2024-04-22 21:48:48', '2024-04-22 21:48:48'),
(114, '1713844988.jpg', '2024-04-22 22:03:08', '2024-04-22 22:03:08'),
(115, '1713845031.jpeg', '2024-04-22 22:03:51', '2024-04-22 22:03:51'),
(116, '1713845081.jpg', '2024-04-22 22:04:41', '2024-04-22 22:04:41'),
(117, '1713845140.jpg', '2024-04-22 22:05:40', '2024-04-22 22:05:40'),
(118, '1713845195.jpg', '2024-04-22 22:06:35', '2024-04-22 22:06:35'),
(119, '1713871190.jpg', '2024-04-23 05:19:50', '2024-04-23 05:19:50'),
(120, '1713871260.jpeg', '2024-04-23 05:21:00', '2024-04-23 05:21:00'),
(121, '1713872571.jpg', '2024-04-23 05:42:51', '2024-04-23 05:42:51'),
(122, '1713948294.png', '2024-04-24 02:44:54', '2024-04-24 02:44:54'),
(123, '1713950140.jpg', '2024-04-24 03:15:40', '2024-04-24 03:15:40'),
(124, '1713950449.jpg', '2024-04-24 03:20:49', '2024-04-24 03:20:49'),
(125, '1713951527.jpg', '2024-04-24 03:38:47', '2024-04-24 03:38:47'),
(126, '1713951960.png', '2024-04-24 03:46:00', '2024-04-24 03:46:00'),
(127, '1713953987.jpg', '2024-04-24 04:19:47', '2024-04-24 04:19:47'),
(128, '1713955803.jpeg', '2024-04-24 04:50:03', '2024-04-24 04:50:03'),
(129, '1713955879.jpeg', '2024-04-24 04:51:19', '2024-04-24 04:51:19'),
(130, '1713955936.jpeg', '2024-04-24 04:52:16', '2024-04-24 04:52:16'),
(131, '1713956062.jpeg', '2024-04-24 04:54:22', '2024-04-24 04:54:22'),
(132, '1713956189.jpg', '2024-04-24 04:56:29', '2024-04-24 04:56:29'),
(133, '1713957715.jpeg', '2024-04-24 05:21:55', '2024-04-24 05:21:55'),
(134, '1713957743.jpg', '2024-04-24 05:22:23', '2024-04-24 05:22:23'),
(135, '1713957782.jpeg', '2024-04-24 05:23:02', '2024-04-24 05:23:02'),
(136, '1713957906.jpg', '2024-04-24 05:25:06', '2024-04-24 05:25:06'),
(137, '1713958270.jpg', '2024-04-24 05:31:10', '2024-04-24 05:31:10'),
(138, '1713958652.jpg', '2024-04-24 05:37:32', '2024-04-24 05:37:32'),
(139, '1713958716.jpg', '2024-04-24 05:38:36', '2024-04-24 05:38:36'),
(140, '1713958758.jpg', '2024-04-24 05:39:18', '2024-04-24 05:39:18'),
(141, '1713958790.jpg', '2024-04-24 05:39:50', '2024-04-24 05:39:50'),
(142, '1713958819.jpg', '2024-04-24 05:40:19', '2024-04-24 05:40:19'),
(143, '1713958841.jpg', '2024-04-24 05:40:41', '2024-04-24 05:40:41'),
(144, '1713959051.jpg', '2024-04-24 05:44:11', '2024-04-24 05:44:11'),
(145, '1713959146.jpg', '2024-04-24 05:45:46', '2024-04-24 05:45:46'),
(146, '1713959233.jpg', '2024-04-24 05:47:13', '2024-04-24 05:47:13'),
(147, '1713959353.jpeg', '2024-04-24 05:49:13', '2024-04-24 05:49:13'),
(148, '1714027134.jpg', '2024-04-25 00:38:54', '2024-04-25 00:38:54'),
(149, '1714027157.jpg', '2024-04-25 00:39:17', '2024-04-25 00:39:17'),
(150, '1714027204.jpg', '2024-04-25 00:40:04', '2024-04-25 00:40:04'),
(151, '1714027248.jpg', '2024-04-25 00:40:48', '2024-04-25 00:40:48'),
(152, '1714027315.jpg', '2024-04-25 00:41:55', '2024-04-25 00:41:55'),
(153, '1714027342.jpg', '2024-04-25 00:42:22', '2024-04-25 00:42:22'),
(154, '1714068402.jpg', '2024-04-25 12:06:42', '2024-04-25 12:06:42'),
(155, '1714068457.jpg', '2024-04-25 12:07:37', '2024-04-25 12:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', 'admin', '2024-04-15 22:26:33', '$2y$12$lPmcVKz/Cz2rc377dPd9gOnnigluWOBYIqGJXfiLWmRiCS1zRDKT6', 'J2I6Hs7d2utecMoAUh7GPZrSAL74Idk036h8b3IRv7b3NIr40Mhc8U2enRC0', '2024-04-15 22:26:34', '2024-04-15 22:26:34'),
(2, 'Sanzida Hahar', 'sanzidanaharbd@gmail.com', 'user', NULL, '$2y$12$Un45aSLvlIvX.xgryJ9i.ufxH4BIgD/YeoID4aCS5J.Ku1WIdecWO', NULL, '2024-04-16 00:21:17', '2024-04-16 00:21:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchased_products`
--
ALTER TABLE `purchased_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
