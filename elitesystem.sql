-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2018 at 10:22 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elitesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `member_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 9, 0, '2018-08-30 20:06:49', '2018-08-31 12:31:46'),
(2, 12, 0, '2018-08-30 20:17:58', '2018-08-31 08:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

CREATE TABLE `bar` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `init` int(11) NOT NULL,
  `actual` int(11) NOT NULL,
  `countable` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`id`, `name`, `price`, `init`, `actual`, `countable`, `created_at`, `updated_at`) VALUES
(1, 'Uje 0.5', 50, 10, 0, 1, '2018-08-05 13:00:52', '2018-08-23 12:51:37'),
(3, 'Uje me vitamina 0.33', 70, 60, 57, 1, '2018-08-05 13:18:45', '2018-09-01 18:28:32'),
(4, 'uje 0.75', 70, 2, 1, 1, '2018-08-05 13:20:29', '2018-08-11 08:59:16'),
(5, 'Kafe', 50, 70, 65, 1, '2018-08-05 13:21:42', '2018-09-01 18:29:21'),
(6, 'Peshqir', 50, 800, 800, 0, '2018-08-05 13:25:44', '2018-08-11 07:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `cycles`
--

CREATE TABLE `cycles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `months` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cycles`
--

INSERT INTO `cycles` (`id`, `name`, `months`, `created_at`, `updated_at`) VALUES
(1, 'mujor', 1, '2018-07-31 19:51:13', '2018-07-31 19:51:13'),
(2, '3 mujor', 3, '2018-07-31 19:52:05', '2018-07-31 19:52:05'),
(3, '6 mujor', 6, '2018-07-31 19:52:17', '2018-07-31 19:52:17'),
(4, '2 mujor', 2, '2018-07-31 19:52:30', '2018-07-31 19:52:30'),
(5, '4 mujor', 4, '2018-07-31 19:52:42', '2018-07-31 19:52:42'),
(6, 'vjecar', 12, '2018-07-31 19:52:59', '2018-07-31 19:52:59'),
(7, 'ditor', 0, '2018-07-31 19:53:05', '2018-07-31 19:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `subscription_id`, `price`, `payed`, `created_at`, `updated_at`) VALUES
(2, 4, '25200', '2000', '2018-08-28 18:58:33', '2018-08-28 18:59:00'),
(3, 5, '23100', '20000', '2018-08-28 19:33:57', '2018-09-01 18:52:26'),
(4, 7, '25200', '10000', '2018-09-01 18:45:08', '2018-09-01 18:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(9, 'Emil', 'Kadilli', 'm', 'kadilli.emil@gmail.com', '0683129804', '1618599_708631792500724_1864998542_n_1533567834.jpg', '2018-08-06 13:03:54', '2018-08-06 13:03:54'),
(12, 'Lenci', 'Sejdaras', 'm', 'lencisejdaras@gmail.com', NULL, '', '2018-08-28 19:33:23', '2018-08-28 19:33:23'),
(13, 'Olsi', 'Dragoi', 'm', NULL, NULL, '', '2018-08-31 08:53:59', '2018-08-31 08:53:59'),
(16, 'Kamela', 'Sejdaras', 'f', NULL, NULL, '', '2018-08-31 19:14:51', '2018-08-31 19:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2018_07_30_220140_create_services_table', 2),
(10, '2018_07_31_212843_create_cycles_table', 3),
(11, '2018_08_03_140040_create_packages_table', 4),
(12, '2018_08_04_125307_create_members_table', 5),
(13, '2018_08_05_135625_create_bar_table', 6),
(14, '2018_08_07_114708_create_purchases_table', 7),
(15, '2018_08_11_233638_create_subscriptions_table', 8),
(16, '2018_08_25_140643_create_installments_table', 9),
(17, '2018_08_28_155555_create_activites_table', 10),
(18, '2018_08_31_142334_create_targets_table', 11),
(19, '2018_09_01_134414_create_turns_table', 12),
(20, '2018_09_01_141853_add_active_column_in_turns_table', 13),
(21, '2018_09_01_213028_add_months_field_to_cycles_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `all_sessions` int(11) NOT NULL,
  `week_sessions` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `service_id`, `cycle_id`, `all_sessions`, `week_sessions`, `time`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, 3, 1, '2500', '2018-08-03 13:02:24', '2018-08-03 13:02:24'),
(2, 1, 1, 16, 4, 1, '3500', '2018-08-03 13:10:18', '2018-08-03 13:10:18'),
(3, 1, 1, 24, 6, 1, '4500', '2018-08-03 13:14:04', '2018-08-03 13:14:04'),
(4, 1, 2, 36, 3, 1, '6000', '2018-08-03 13:15:53', '2018-08-03 13:15:53'),
(5, 1, 2, 48, 4, 1, '8400', '2018-08-03 13:29:38', '2018-08-03 13:29:38'),
(6, 1, 2, 72, 6, 1, '10800', '2018-08-03 13:30:43', '2018-08-03 13:30:43'),
(7, 1, 6, 144, 3, 1, '18000', '2018-08-03 13:31:52', '2018-08-03 13:31:52'),
(8, 1, 6, 192, 4, 1, '25200', '2018-08-03 13:33:28', '2018-08-03 13:33:28'),
(9, 1, 6, 288, 6, 1, '32400', '2018-08-03 13:34:22', '2018-08-03 13:34:22'),
(10, 2, 1, 12, 3, 2, '3500', '2018-08-03 13:37:52', '2018-08-03 13:37:52'),
(11, 2, 1, 16, 4, 2, '4500', '2018-08-03 13:38:59', '2018-08-03 13:38:59'),
(12, 2, 1, 24, 6, 2, '5500', '2018-08-03 13:40:25', '2018-08-03 13:40:25'),
(13, 2, 2, 36, 3, 3, '8400', '2018-08-03 13:41:43', '2018-08-03 13:41:43'),
(14, 2, 2, 48, 4, 3, '10800', '2018-08-03 13:43:18', '2018-08-03 13:43:18'),
(15, 2, 2, 72, 6, 3, '13200', '2018-08-03 13:44:16', '2018-08-03 13:44:16'),
(16, 2, 3, 72, 3, 3, '14700', '2018-08-03 13:45:08', '2018-08-03 13:45:08'),
(17, 2, 3, 96, 4, 3, '18900', '2018-08-03 13:46:14', '2018-08-03 13:46:14'),
(18, 2, 3, 144, 6, 3, '23100', '2018-08-03 13:46:51', '2018-08-03 13:46:51'),
(19, 2, 6, 144, 3, 3, '25200', '2018-08-03 13:52:30', '2018-08-03 13:52:30'),
(20, 2, 6, 192, 4, 3, '32400', '2018-08-03 13:53:15', '2018-08-03 13:53:15'),
(21, 2, 6, 288, 6, 3, '39600', '2018-08-03 13:54:42', '2018-08-03 13:54:42'),
(22, 3, 1, 12, 3, 2, '4000', '2018-08-03 13:56:33', '2018-08-03 13:56:33'),
(23, 1, 3, 72, 3, 1, '10500', '2018-08-03 13:57:24', '2018-08-03 13:57:24'),
(24, 1, 3, 72, 3, 1, '14700', '2018-08-03 13:57:51', '2018-08-03 13:57:51'),
(25, 4, 2, 72, 6, 3, '11000', '2018-08-03 13:58:52', '2018-08-03 13:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `buyer_id`, `buyer_type`, `product_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'App\\Member', 1, 1, '50', 'paguar', '2018-08-08 13:11:05', '2018-08-08 13:11:05'),
(2, 2, 'App\\User', 5, 2, '75', 'paguar', '2018-08-08 13:11:28', '2018-08-08 13:11:28'),
(3, 9, 'App\\Member', 4, 2, '140', 'paguar', '2018-08-10 19:42:32', '2018-08-10 19:42:32'),
(4, 4, 'App\\User', 3, 2, '105', 'papaguar', '2018-08-10 20:04:36', '2018-08-10 20:04:36'),
(5, 9, 'App\\Member', 1, 3, '150', 'paguar', '2018-08-10 20:08:34', '2018-08-10 20:08:34'),
(6, 7, 'App\\Member', 1, 2, '100', 'paguar', '2018-08-11 07:50:56', '2018-08-11 07:50:56'),
(7, 9, 'App\\Member', 1, 5, '250', 'papaguar', '2018-08-11 07:51:37', '2018-08-11 07:51:37'),
(8, 5, 'App\\User', 5, 2, '75', 'papaguar', '2018-08-11 07:52:07', '2018-08-11 07:52:07'),
(9, 1, 'App\\User', 6, 3, '112', 'paguar', '2018-08-11 07:52:24', '2018-08-11 07:52:24'),
(10, 7, 'App\\Member', 1, 4, '50', 'paguar', '2018-08-23 12:51:37', '2018-08-23 12:51:37'),
(11, 7, 'App\\Member', 6, 1, '50', 'paguar', '2018-08-25 10:21:11', '2018-08-25 10:21:11'),
(12, 7, 'App\\Member', 6, 1, '50', 'paguar', '2018-08-25 10:21:32', '2018-08-25 10:21:32'),
(13, 12, 'App\\Member', 3, 2, '140', 'paguar', '2018-09-01 18:28:32', '2018-09-01 18:28:32'),
(14, 12, 'App\\Member', 5, 2, '100', 'papaguar', '2018-09-01 18:29:21', '2018-09-01 18:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Abonim Paradite', '2018-07-30 20:35:37', '2018-07-30 20:35:37'),
(2, 'Abonim Mbasdite', '2018-07-30 20:36:42', '2018-07-30 20:36:42'),
(3, 'Zumba', '2018-07-30 20:36:52', '2018-07-30 20:36:52'),
(4, 'Oferta 2+1', '2018-07-30 20:37:19', '2018-07-30 20:37:19'),
(5, 'Oferta 4 + 2', '2018-07-30 20:37:29', '2018-07-30 20:37:29'),
(6, 'Oferta 6 + 6', '2018-07-30 20:37:59', '2018-07-30 20:37:59'),
(7, 'Ditore', '2018-07-30 20:38:09', '2018-07-30 20:38:09'),
(8, '8 javore', '2018-07-30 20:38:17', '2018-07-30 20:38:17'),
(9, 'Summer 3 + 1', '2018-07-30 20:39:24', '2018-07-30 20:39:24'),
(10, 'Summer 4 + 2', '2018-07-30 20:39:36', '2018-07-30 20:39:36'),
(11, '6 mujore Olsi', '2018-07-30 20:39:48', '2018-07-30 20:39:48'),
(12, 'Summer 3 muaj', '2018-07-30 20:40:07', '2018-07-30 20:40:07'),
(13, 'Summer 6 muaj', '2018-07-30 20:40:14', '2018-07-30 20:40:14'),
(14, 'Summer 12 muaj', '2018-07-30 20:40:22', '2018-07-30 20:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `payed_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` date NOT NULL,
  `expires_at` date NOT NULL,
  `sessions_left` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `member_id`, `package_id`, `payed_price`, `starts_at`, `expires_at`, `sessions_left`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(4, 10, 19, 'installment', '2018-08-28', '2019-08-28', 144, '1', 0, '2018-08-28 18:58:33', '2018-08-28 18:58:33'),
(5, 12, 18, 'installment', '2018-08-28', '2019-02-28', 138, '1', 0, '2018-08-28 19:33:57', '2018-08-30 21:04:29'),
(6, 13, 8, 'payed', '2018-09-03', '2019-09-03', 192, '1', 0, '2018-08-31 08:54:49', '2018-08-31 08:54:49'),
(7, 16, 19, 'installment', '2018-09-24', '2019-09-24', 144, '1', 0, '2018-09-01 18:45:08', '2018-09-01 18:45:08'),
(8, 9, 23, 'payed', '2018-09-03', '2019-03-03', 72, '0', 1, '2018-09-01 18:46:04', '2018-09-01 19:45:24'),
(9, 9, 1, 'payed', '2018-09-01', '2018-10-01', 12, '1', 0, '2018-09-01 19:50:38', '2018-09-01 19:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `target` int(11) NOT NULL,
  `accomplished` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `targets`
--

INSERT INTO `targets` (`id`, `target`, `accomplished`, `active`, `created_at`, `updated_at`) VALUES
(1, 100, 2, 1, '2018-08-31 12:52:45', '2018-08-31 19:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `turns`
--

CREATE TABLE `turns` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turns`
--

INSERT INTO `turns` (`id`, `user_id`, `total`, `active`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 0, '2018-09-01 12:16:37', '2018-09-01 12:16:37'),
(2, 4, 0, 0, '2018-09-01 12:22:29', '2018-09-01 12:35:44'),
(3, 4, 0, 0, '2018-09-01 12:35:44', '2018-09-01 12:35:44'),
(4, 4, 0, 0, '2018-09-01 12:36:35', '2018-09-01 12:36:35'),
(5, 4, 0, 0, '2018-09-01 12:36:38', '2018-09-01 12:36:38'),
(6, 4, 23140, 1, '2018-09-01 12:44:07', '2018-09-01 19:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `activated` int(11) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `permissions`, `activated`, `last_login`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'superuser', 1, '2018-09-01 20:58:24', 'admin@elitesystem.com', '$2y$10$Zkh0rwEaqapmWJie3YTkw.QeXFsm4JQvwOfRFMLpBjPHsa2dv9tjq', 'YhOflCfzt43zvA52Sp3oTklQA36vbxPeRhGu2ozU4uAA11tVgyTtMQoYsNXe', NULL, '2018-09-01 18:58:24'),
(4, 'Recepsion', NULL, 'recepsion', 1, '2018-09-01 20:53:08', 'recepsion@elitesystem.com', '$2y$10$nQlXEtk8QqiLSv/jQZjOb.S5WOFbnZ9CstXbQaT1zrhPsk1//i9Pu', 'zHhOZBwdUmjbgMCejdQjXKrLDmN15yUesafUf1Mi4Nf1vzh3hHj38lzgakB7', '2018-07-30 11:14:22', '2018-09-01 18:53:08'),
(5, 'Bar', NULL, 'bar', 1, '2018-08-28 12:58:03', 'bar@elitesystem.com', '$2y$10$sWc0JCOK2441gN9PGT1q4uAp1azeUpONz.Q4Cft6zVwW/qBBIUvxi', 'YgxRqMSDPOFqJE07bwKiujJmKhwNcLf68ai6W3eFJVB895pJqcvcv5z6yGcX', '2018-08-05 13:23:19', '2018-08-28 10:58:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turns`
--
ALTER TABLE `turns`
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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cycles`
--
ALTER TABLE `cycles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `turns`
--
ALTER TABLE `turns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
