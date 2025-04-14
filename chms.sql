-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 02:41 PM
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
-- Database: `chms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `date` date NOT NULL,
  `category` varchar(150) NOT NULL,
  `location` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `image`, `date`, `category`, `location`, `created_at`, `updated_at`) VALUES
(3, 'Kingdom Youth Choir', 'Cluster Youth Choir Workshop', 'event_images/XxjQgKYdtfuKvyMc0EeOVbDnt51SPAQN0pa5PH4w.jpg', '2024-12-25', 'Workshop', 'Calinan', NULL, '2024-12-02 18:51:39'),
(4, 'Kingdom Youth Gathering', 'Join together with the youths of the Kingdom in exercising talents and skills.', 'event_images\\event 2.jpg', '2024-11-28', 'Youth gathering', 'Digos city', NULL, NULL),
(5, 'Tree Planting', 'One Tree, One Nation', 'event_images/4zpdl2uJVrnExVLaXpyYFEd8UxwzQ5zl11hXDxsD.jpg', '2024-11-16', 'Community Service', 'Buda, Bukidnon', '2024-11-17 17:47:47', '2024-11-17 17:47:47'),
(9, 'Music Extravaganza', 'Showcasing youths talent in singing and playing musical instruments', 'event_images/rlK6QFBqafo3Tpl8AyXzIKEeOU6BgIE5C3BPj1Wc.jpg', '2025-01-13', 'Music Contest', 'Cathedral KOJC compound', '2024-11-29 21:34:23', '2024-11-29 21:34:23'),
(10, 'Workers Camp', 'International Sports Competition', 'event_images/BPLlWw1Nf8b569OVmB1ze4o0fx1M7qD8KLv2nkO7.jpg', '0225-02-12', 'Sports fest', 'KOJC compound', '2024-11-29 21:35:16', '2024-11-29 21:35:16'),
(11, 'Irish Caffe Grand Opening', 'Celebration for the grand opening of Irish cafe!', 'event_images/c2pasFWg6EXAAoWADwyvYswapkbeN9oUwQFMovfB.jpg', '2025-01-02', 'Thanks Giving', 'Digos city', '2024-12-02 18:55:23', '2024-12-02 18:55:39'),
(12, 'Christmas Party', 'Everyone should participate', 'event_images/BnEfrXau2yqbIrqzPlLoRYpiuHwSZGjrOnli4gBg.jpg', '2024-12-31', 'Party', 'Digos city', '2024-12-30 03:23:04', '2024-12-30 03:23:04'),
(13, 'Elections', 'k;EFWIUaFCJK;aBSDJ', 'event_images/6q0s4C5TKFgo34j58F2ukXmE8dRKXRLkbN7WGcLk.jpg', '2025-09-24', 'Voting', 'Philippines', '2025-01-11 02:20:46', '2025-01-11 02:20:46'),
(14, 'Valentines Day', 'igat-igat', 'event_images/DhJ06ueKjDxYIQXfRxtMPpsn2e3BFEvIJaUSnhLo.jpg', '2025-02-14', 'Day of hearts', 'Phillipines', '2025-01-11 02:22:20', '2025-01-11 02:22:20'),
(15, '2025 Fun Fest', 'dagan dagan', 'event_images/3YSChDf90ITM8iemxPbAC5Z95dChMLIcEpN21Goz.jpg', '2025-01-31', 'Marathon', 'Digos park', '2025-01-11 02:23:13', '2025-01-11 02:23:13'),
(18, 'Kadya', ';hRIOWEIRHWERT', 'event_images/XWdrr8Demh8KwB09qPZ3u1t4DtTuMJ4AvYKjGCbG.jpg', '2025-02-02', 'Festival', 'Davao city', '2025-04-11 22:19:11', '2025-04-11 22:19:11'),
(19, '/lsakjfc\'lhdfvlksdh', 'ahsf;kerhigqhergf', 'event_images/gq8b2ziTTQAUjPQBPhG5iW3XKOWqiNaf7puScMwR.jpg', '2029-03-30', 'Festival', 'Davao city', '2025-04-11 23:54:53', '2025-04-12 00:00:15');

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
-- Table structure for table `feedback_ratings`
--

CREATE TABLE `feedback_ratings` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `events_id` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(5) NOT NULL,
  `feedback_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback_ratings`
--

INSERT INTO `feedback_ratings` (`id`, `users_id`, `events_id`, `rating`, `feedback_text`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 4, 'pangit kaayu.', '2024-12-20 22:52:55', '2024-12-20 22:52:55'),
(2, 3, 5, 5, 'Goods ra', '2024-12-21 00:06:39', '2024-12-21 00:06:39'),
(3, 3, 3, 5, 'k;asdjafksnf', '2025-01-31 00:31:35', '2025-01-31 00:31:35'),
(4, 8, 3, 4, 'gooodsset', '2025-03-16 19:07:28', '2025-03-16 19:07:28'),
(5, 8, 4, 4, 'yfWEDGWEHJV', '2025-03-16 19:12:02', '2025-03-16 19:12:02'),
(6, 8, 5, 5, 'YOWWWW', '2025-03-16 19:13:14', '2025-03-16 19:13:14'),
(7, 3, 11, 1, 'pangitt kaayu', '2025-03-29 21:23:46', '2025-03-29 21:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '0001_01_01_000000_create_users_table.php', 1),
(9, '0001_01_01_000001_create_cache_table', 3),
(10, '0001_01_01_000002_create_jobs_table', 3),
(11, '2024_10_23_044800_create_events_table', 3),
(12, '2024_10_23_091230_add_role_to_users_table', 3),
(16, '2024_10_30_115006_create_sessions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `event_id`, `name`, `date_time`, `message`, `created_at`, `updated_at`) VALUES
(1, 5, 11, 'New Business Opening', '2025-01-10 19:43:33', 'every one should join and participate in the business opening!!!', '2024-12-04 11:45:29', '2024-12-04 11:45:29'),
(2, 5, 5, 'Planting trees', '2024-12-25 09:00:00', 'all of you should join!, else committee matik!', '2024-12-04 04:49:55', '2024-12-04 04:49:55'),
(3, 5, 9, 'party party', '2025-03-04 08:50:00', 'apil mo', '2024-12-04 04:51:04', '2024-12-04 04:51:04'),
(4, 5, NULL, 'Ambot', '2025-01-01 14:38:00', 'gana na intawn', '2024-12-27 21:40:00', '2024-12-27 21:40:00'),
(5, 4, 12, 'Christmas Party', '2024-12-31 20:00:00', 'iuw;heufciEFUBBKUEARKJVNSAERJKVGNKEAR', '2024-12-30 03:24:12', '2024-12-30 03:24:12'),
(6, 5, 5, 'Christmas Party', '2025-03-18 15:24:00', '.gjkgjkjjkjkfydfhj', '2025-03-17 23:35:38', '2025-03-17 23:35:38'),
(7, 4, 9, 'Music Extravaganza', '2025-04-12 16:17:00', 'lyfgkjfkjf', '2025-04-11 23:17:56', '2025-04-11 23:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

CREATE TABLE `participations` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `events_id` int(20) UNSIGNED NOT NULL,
  `status` enum('pending','rejected','approved','cancel') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `participations`
--

INSERT INTO `participations` (`id`, `users_id`, `events_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 'approved', '2024-12-16 19:40:50', '2024-12-16 20:28:48'),
(4, 3, 4, 'approved', '2024-12-16 19:41:12', '2024-12-20 21:29:16'),
(5, 3, 5, 'approved', '2024-12-16 19:41:22', '2024-12-20 21:48:54'),
(6, 3, 9, 'approved', '2024-12-20 21:48:32', '2024-12-20 21:48:55'),
(7, 3, 10, 'rejected', '2024-12-20 21:48:36', '2024-12-20 21:50:34'),
(8, 3, 11, 'approved', '2024-12-20 21:48:41', '2024-12-20 21:48:56'),
(9, 8, 12, 'approved', '2024-12-30 03:24:47', '2024-12-30 03:25:44'),
(10, 3, 12, 'approved', '2025-01-06 23:28:22', '2025-03-10 18:31:34'),
(11, 3, 13, 'approved', '2025-01-19 19:15:56', '2025-01-19 19:16:05'),
(12, 3, 14, 'approved', '2025-03-10 18:37:22', '2025-03-10 18:38:21'),
(13, 3, 15, 'approved', '2025-03-10 18:37:24', '2025-03-10 18:48:12'),
(14, 8, 3, 'approved', '2025-03-10 18:47:37', '2025-03-10 19:00:03'),
(15, 8, 5, 'approved', '2025-03-10 18:47:40', '2025-03-10 19:18:37'),
(16, 8, 4, 'approved', '2025-03-10 18:47:42', '2025-03-10 19:20:42'),
(17, 8, 9, 'approved', '2025-03-10 18:47:44', '2025-04-11 23:18:53'),
(18, 10, 12, 'approved', '2025-03-21 23:15:37', '2025-03-21 23:16:17'),
(19, 10, 13, 'approved', '2025-03-21 23:15:45', '2025-03-21 23:18:51'),
(20, 8, 13, 'pending', '2025-03-29 21:10:33', '2025-03-29 21:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payload` varchar(255) NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `remember_token`) VALUES
(3, 'Drex Rom', 'drexrom@gmail.com', '$2y$12$cKX2r0Kwm9TIkp7GDIjPMeqMZb56FA.u.xLe/D.5Vecy94RtsIoIa', 'user', '2024-10-27 03:48:13', '2025-04-12 07:07:16', 'uPjtpo7Q6YEjq83AFYpKrZumQU0m370tFWMBvEvlrwtbZYWtVS2cmg2LrAPY'),
(4, 'Daniel Fuentes', 'danielfuentesm@gmail.com', '$2y$12$erwp/0Jtx/SGgpRs1qP5UOaEPh9phlFBFRjC8pEm56Scmtozi6/di', 'superadmin', '2024-10-27 03:50:16', '2025-04-12 07:19:27', 'aT03uAjEONgE9mC7bSoVUMRfSQJOwsl39t5N0sASw00PiCEYGjcw1jxwOrAy'),
(5, 'Arnel Baclayon', 'arnelwalker2nd0143@gmail.com', '$2y$12$jV3IBo9BK24gUezqxPiU8eWTVutJhNlp0LQF2u7WeHq8cWMrK4Z0a', 'admin', '2024-11-03 02:22:17', '2025-04-12 07:07:02', 'pUSHyng3Gd9YWggCPVSaZz1asAetlpOngHGIfLm04EkzEx9KDtjql2CQa2Ox'),
(7, 'KielJay', 'arnel.baclayon@dssc.edu.ph', '$2y$12$/2m9StPJDIHjnnYz/cAtHejx1fOWxY9zvC6dsD7up3gXbOj3sQAju⏎', 'user', '2024-12-05 11:47:03', '2024-12-05 11:47:03', NULL),
(8, 'Kiel', 'kel0143walker@gmail.com', '$2y$10$4Q4Sbw45kcMhBfCASpVDkeKeADVKhns/qv4X7eLRY68bTC3xp6LvS', 'user', '2024-12-05 12:07:02', '2025-03-30 05:12:35', 'RmExcNHqJ7xaTe61znpj4c0mBUb3SUMNH1rLGFbOpXwhvY6Dhe29fVLa3Mkg'),
(10, 'Xai Daniel D. Cardenas', 'XaidanielCardenas@gmail.com', '$2y$12$kFiIBvJ8EQV.JJqFD9SumumfW.Lf6GNH3FlFKpxTyCmj0WJyE6.MC', 'user', '2025-03-21 23:14:28', '2025-03-21 23:14:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `action` varchar(225) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `users_id`, `action`, `ip_address`, `created_at`, `updated_at`) VALUES
(51, 4, 'Logged_out', '127.0.0.1', '2025-01-30 23:45:27', '2025-01-31 00:29:34'),
(52, 3, 'Logged_out', '127.0.0.1', '2025-01-31 00:29:40', '2025-01-31 00:34:27'),
(53, 5, 'Logged_out', '127.0.0.1', '2025-03-06 18:20:30', '2025-03-06 18:22:37'),
(54, 4, 'Logged_out', '127.0.0.1', '2025-03-06 18:22:49', '2025-03-10 18:22:18'),
(55, 4, 'Logged_out', '127.0.0.1', '2025-03-10 18:22:22', '2025-03-10 18:37:07'),
(56, 3, 'Logged_out', '127.0.0.1', '2025-03-10 18:37:12', '2025-03-10 18:37:27'),
(57, 4, 'Logged_out', '127.0.0.1', '2025-03-10 18:37:34', '2025-03-10 18:47:26'),
(58, 8, 'Logged_out', '127.0.0.1', '2025-03-10 18:47:32', '2025-03-10 18:47:54'),
(59, 4, 'Logged_out', '127.0.0.1', '2025-03-10 18:48:01', '2025-03-10 19:54:42'),
(60, 5, 'Logged_out', '127.0.0.1', '2025-03-10 21:31:15', '2025-03-11 00:38:51'),
(61, 4, 'Logged_out', '127.0.0.1', '2025-03-11 00:38:58', '2025-03-11 00:40:15'),
(62, 5, 'Logged_out', '127.0.0.1', '2025-03-11 00:40:20', '2025-03-11 00:40:41'),
(63, 4, 'Logged_out', '127.0.0.1', '2025-03-11 00:40:48', '2025-03-11 00:41:27'),
(64, 5, 'Logged_out', '127.0.0.1', '2025-03-11 00:41:34', '2025-03-11 00:42:09'),
(65, 3, 'Logged_out', '127.0.0.1', '2025-03-11 00:42:15', '2025-03-11 18:16:39'),
(66, 5, 'Logged_out', '127.0.0.1', '2025-03-11 18:16:44', '2025-03-11 18:16:50'),
(67, 4, 'Logged_out', '127.0.0.1', '2025-03-11 18:16:55', '2025-03-11 18:17:48'),
(68, 5, 'Logged_out', '127.0.0.1', '2025-03-11 18:17:57', '2025-03-11 18:18:16'),
(69, 3, 'Logged_out', '127.0.0.1', '2025-03-11 18:18:21', '2025-03-11 18:38:01'),
(70, 5, 'Logged_out', '127.0.0.1', '2025-03-11 18:38:06', '2025-03-11 18:38:11'),
(71, 4, 'Logged_out', '127.0.0.1', '2025-03-11 18:38:16', '2025-03-11 18:38:38'),
(72, 4, 'Logged_out', '127.0.0.1', '2025-03-11 18:38:46', '2025-03-11 18:38:49'),
(73, 5, 'Logged_out', '127.0.0.1', '2025-03-11 18:38:52', '2025-03-11 18:39:07'),
(74, 4, 'Logged_out', '127.0.0.1', '2025-03-11 18:39:11', '2025-03-11 18:39:21'),
(75, 5, 'Logged_out', '127.0.0.1', '2025-03-11 18:39:26', '2025-03-11 18:51:55'),
(76, 3, 'Logged_out', '127.0.0.1', '2025-03-11 18:52:00', '2025-03-11 18:52:08'),
(77, 8, 'Logged_out', '127.0.0.1', '2025-03-11 18:52:12', '2025-03-11 18:54:42'),
(78, 3, 'Logged_out', '127.0.0.1', '2025-03-11 18:54:57', '2025-03-13 00:04:23'),
(79, 5, 'Logged_out', '127.0.0.1', '2025-03-13 00:04:28', '2025-03-13 00:05:36'),
(80, 4, 'Logged_out', '127.0.0.1', '2025-03-13 00:05:42', '2025-03-13 00:16:29'),
(81, 5, 'Logged_out', '127.0.0.1', '2025-03-13 00:16:33', '2025-03-14 19:11:52'),
(82, 5, 'Logged_out', '127.0.0.1', '2025-03-14 19:11:55', '2025-03-16 19:06:53'),
(83, 8, 'Logged_out', '127.0.0.1', '2025-03-16 19:06:59', '2025-03-16 19:13:18'),
(84, 5, 'Logged_out', '127.0.0.1', '2025-03-16 19:13:22', '2025-03-17 21:32:32'),
(85, 4, 'Logged_out', '127.0.0.1', '2025-03-17 21:32:40', '2025-03-17 21:32:52'),
(86, 3, 'Logged_out', '127.0.0.1', '2025-03-17 21:32:58', '2025-03-17 21:33:32'),
(87, 5, 'Logged_out', '127.0.0.1', '2025-03-17 21:33:38', '2025-03-21 20:46:54'),
(88, 5, 'Logged_out', '127.0.0.1', '2025-03-21 20:46:58', '2025-03-21 22:52:09'),
(89, 5, 'Logged_out', '127.0.0.1', '2025-03-21 22:52:14', '2025-03-21 23:14:52'),
(90, 10, 'Logged_out', '127.0.0.1', '2025-03-21 23:15:19', '2025-03-21 23:15:57'),
(91, 5, 'Logged_out', '127.0.0.1', '2025-03-21 23:16:05', '2025-03-21 23:18:57'),
(92, 5, 'Logged_out', '127.0.0.1', '2025-03-29 21:05:51', '2025-03-29 21:10:07'),
(93, 8, 'Logged_out', '127.0.0.1', '2025-03-29 21:10:19', '2025-03-29 21:12:34'),
(94, 5, 'Logged_out', '127.0.0.1', '2025-03-29 21:12:40', '2025-03-29 21:20:49'),
(95, 3, 'Logged_out', '127.0.0.1', '2025-03-29 21:20:55', '2025-03-29 21:24:02'),
(96, 4, 'Logged_out', '127.0.0.1', '2025-03-29 21:24:08', '2025-03-29 21:27:43'),
(97, 3, 'Logged_out', '127.0.0.1', '2025-03-29 21:27:51', '2025-03-29 21:33:21'),
(98, 5, 'Logged_out', '127.0.0.1', '2025-03-29 21:33:27', '2025-03-29 21:38:04'),
(99, 3, 'Logged_out', '127.0.0.1', '2025-03-29 21:38:10', '2025-04-11 23:07:16'),
(100, 5, 'Logged_out', '127.0.0.1', '2025-04-07 04:02:34', '2025-04-11 22:42:41'),
(101, 4, 'Logged_out', '127.0.0.1', '2025-04-11 22:43:34', '2025-04-11 22:43:51'),
(102, 4, 'Logged_out', '127.0.0.1', '2025-04-11 22:49:21', '2025-04-11 22:58:16'),
(103, 4, 'Logged_out', '127.0.0.1', '2025-04-11 22:59:19', '2025-04-11 23:00:26'),
(104, 4, 'Logged_out', '127.0.0.1', '2025-04-11 23:06:36', '2025-04-11 23:06:44'),
(105, 5, 'Logged_out', '127.0.0.1', '2025-04-11 23:06:54', '2025-04-11 23:07:02'),
(106, 4, 'Logged_out', '127.0.0.1', '2025-04-11 23:08:52', '2025-04-11 23:19:27'),
(107, 3, 'Logged_in', '127.0.0.1', '2025-04-11 23:19:33', '2025-04-11 23:19:33'),
(108, 5, 'Logged_in', '127.0.0.1', '2025-04-11 23:51:22', '2025-04-11 23:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suffix` enum('N/A','Jr.','Sr.','I','II','III','IV','V') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('Male','Female','Non-binary','Other','Prefer_not_to_say') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `age_group` enum('Child(0-12)','Teen(13-19)','Young_Adult(20-29)','Adult(30-59)','Senior(60+)') NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `invitation_source` enum('Friend','Social_Media','Website','Flyer') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_preference` enum('Email','Phone','No_Preference') NOT NULL,
  `interaction_history` enum('Event','Church_Service','Online','In_Person') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `first_name`, `last_name`, `suffix`, `birth_date`, `gender`, `age`, `age_group`, `address`, `invitation_source`, `phone_number`, `interests`, `email`, `contact_preference`, `interaction_history`, `created_at`, `updated_at`, `user_id`) VALUES
(7, 'Rajz Azor', 'Sasing', 'N/A', '2010-09-12', 'Male', 15, 'Teen(13-19)', 'Palili, Padada, Davao del Sur', 'Website', '09237461111', 'singing, playing drums', 'rajzazorsasing@gmail.com', 'Email', 'Church_Service', '2024-11-25 20:38:32', '2025-03-21 22:52:56', NULL),
(11, 'Lharyl', 'Panares', 'III', '2000-11-09', 'Male', 24, 'Young_Adult(20-29)', 'New Baclayon, Malalag, Davao del Sur', 'Website', '09284604371', 'eating', 'lharylpanares@gmail.com', 'Email', 'Online', '2024-11-25 20:45:08', '2024-11-28 05:43:45', NULL),
(12, 'Cyril Ann', 'Cardenas', 'N/A', '2001-09-22', 'Female', 23, 'Young_Adult(20-29)', 'Roscom village, Almendras, Padada, Davao del Sur', 'Friend', '09351288463', 'eating, reading', 'cyrilanncardenas22@gmail.com', 'No_Preference', 'Church_Service', '2024-11-25 20:47:17', '2024-11-25 20:47:17', NULL),
(13, 'Joan', 'Betsosa', 'N/A', '2002-06-27', 'Female', 22, 'Young_Adult(20-29)', 'Care, Sulop, Davao del Sur', 'Friend', '09351280852', 'sleeping', 'joanbetsosa@gmail.com', 'Phone', 'Event', '2024-11-25 20:48:56', '2024-11-25 20:48:56', NULL),
(14, 'Shirlxien', 'Paradero', 'N/A', '2004-12-25', 'Male', 20, 'Young_Adult(20-29)', 'Palili, Padada, Davao del Sur', 'Friend', '09237461713', 'singing, playing drums', 'shirlxienparadero@gmail.com', 'No_Preference', 'In_Person', '2024-11-25 21:05:59', '2024-11-25 21:05:59', NULL),
(15, 'Mark Phillip', 'Baclayon', 'N/A', '2002-03-04', 'Male', 22, 'Young_Adult(20-29)', 'Palili, Padada, Davao del Sur', 'Friend', '09351280809', 'singing, drawing, planting, reading', 'markphillipwalker@gmail.com', 'Email', 'In_Person', '2024-11-27 19:36:07', '2024-11-27 19:36:07', NULL),
(16, 'Jake', 'Dela Calzada', 'III', '2001-07-16', 'Male', 23, 'Young_Adult(20-29)', 'Talas, Sulop, Davao del Sur', 'Friend', '09237364826', 'playing trumpet and guitar', 'jakedelacalzada04@gmail.com', 'Email', 'In_Person', '2024-11-28 05:43:12', '2024-11-28 05:43:12', NULL),
(17, 'Michelle', 'Mooc', 'N/A', '2004-09-12', 'Female', 20, 'Young_Adult(20-29)', 'digos,city', 'Friend', '09351288490', 'singing, playing drums', 'michelle@gmail.com', 'Email', 'In_Person', '2024-12-03 01:21:38', '2024-12-03 01:21:38', NULL),
(18, 'Hill', 'Vargas', 'V', '2002-05-21', 'Non-binary', 22, 'Young_Adult(20-29)', 'Palili, Padada, Davao del Sur', 'Social_Media', '09237835274', 'watching k-drama, hiking, and playing guitar', 'hillvargas123@gmail.com', 'Email', 'Online', '2024-12-29 21:09:05', '2024-12-29 21:09:05', NULL),
(19, 'Moira', 'Dela Torre', 'N/A', '1993-11-04', 'Female', 29, 'Young_Adult(20-29)', 'Bonifacio Global city', 'Friend', '092377395625', 'singing, and composing', 'moiradelatorre@gmail.com', 'No_Preference', 'Church_Service', '2024-12-29 22:54:45', '2024-12-29 22:54:45', NULL),
(20, 'John Mark', 'Egos', 'N/A', '2000-01-07', 'Male', 25, 'Young_Adult(20-29)', 'Brgy. Mati, Digos city', 'Friend', '0972347676', 'eating, reading', 'johnmarkegos@gmail.com', 'Phone', 'Event', '2025-01-07 07:28:35', '2025-01-07 07:28:35', NULL),
(21, 'kendra', 'devila', 'N/A', '2000-01-12', 'Female', 22, 'Young_Adult(20-29)', 'davao', 'Website', '09356712891', 'eating', 'kendradevila@gmail.com', 'Email', 'In_Person', '2025-01-20 23:17:51', '2025-01-20 23:17:51', NULL),
(22, 'moneva', 'ramel', 'N/A', '2000-01-12', 'Prefer_not_to_say', 25, 'Young_Adult(20-29)', 'sulop davao del sur', 'Flyer', '0967567464', 'sleeping', 'ramelmoneva@gmail.com', 'Email', 'In_Person', '2025-04-11 22:16:28', '2025-04-11 22:16:28', NULL),
(23, 'John Mark', 'Egos', 'I', '2001-03-04', 'Male', 24, 'Young_Adult(20-29)', 'Brgy. Mati, Digos city', 'Website', '972347676', 'singing, playing drums', 'johnmarkegos@gmail.com', 'Phone', 'Church_Service', '2025-04-11 22:17:47', '2025-04-11 22:17:47', NULL),
(24, 'John Mark', 'Egos', 'III', '2002-09-09', 'Male', 23, 'Young_Adult(20-29)', 'Brgy. Mati, Digos city', 'Website', '0972347676', 'eating, reading', 'johnmarkegos@gmail.com', 'Email', 'Online', '2025-04-11 22:41:31', '2025-04-11 22:41:31', NULL),
(25, 'testing', 'testing', 'N/A', '2001-03-30', 'Male', 24, 'Young_Adult(20-29)', 'Brgy. Mati, Digos city', 'Friend', '0972347676', 'eating, reading', 'johnmarkegos@gmail.com', 'Email', 'Event', '2025-04-11 22:50:31', '2025-04-11 22:50:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback_ratings`
--
ALTER TABLE `feedback_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_id` (`users_id`) USING BTREE,
  ADD KEY `fk_events_id` (`events_id`) USING BTREE;

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `participations`
--
ALTER TABLE `participations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `events_id` (`events_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_ratings`
--
ALTER TABLE `feedback_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback_ratings`
--
ALTER TABLE `feedback_ratings`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participations`
--
ALTER TABLE `participations`
  ADD CONSTRAINT `participations_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `participations_ibfk_2` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
