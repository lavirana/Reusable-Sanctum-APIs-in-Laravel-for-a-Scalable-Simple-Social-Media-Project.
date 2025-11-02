-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 02, 2025 at 10:26 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_apis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'First Cat', '2025-10-14 06:29:27', '2025-10-14 06:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'first comment', '2025-10-19 04:13:58', '2025-10-19 04:13:58'),
(2, 1, 13, 'second comment', '2025-10-19 05:23:26', '2025-10-19 05:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"53fc394e-2730-4a0b-8b93-947b66c70068\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":16:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:18;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"sender\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761582027,\"delay\":null}', 0, NULL, 1761582027, 1761582027),
(2, 'default', '{\"uuid\":\"574c84c1-90cc-4e5f-b5ab-31833669baaf\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":16:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"sender\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761584415,\"delay\":null}', 0, NULL, 1761584415, 1761584415),
(3, 'default', '{\"uuid\":\"30500898-96e0-48e6-814f-a05af7cbb1e7\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":16:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:20;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"sender\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"},\"createdAt\":1761584419,\"delay\":null}', 0, NULL, 1761584419, 1761584419);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(7, 1, 13, '2025-10-19 08:37:47', '2025-10-19 08:37:47'),
(8, 2, 14, '2025-10-24 07:50:10', '2025-10-24 07:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'testing message', 0, '2025-10-25 06:44:25', '2025-10-25 06:44:25'),
(2, 1, 2, 'asdf', 0, '2025-10-26 06:01:49', '2025-10-26 06:01:49'),
(3, 1, 2, 'sdf', 0, '2025-10-26 06:01:52', '2025-10-26 06:01:52'),
(4, 1, 2, 'ff', 0, '2025-10-26 06:04:18', '2025-10-26 06:04:18'),
(5, 1, 2, 'hello ashish', 0, '2025-10-26 06:05:30', '2025-10-26 06:05:30'),
(6, 1, 3, 'test', 0, '2025-10-26 06:05:40', '2025-10-26 06:05:40'),
(7, 2, 1, 'hello ashish', 0, '2025-10-26 06:07:10', '2025-10-26 06:07:10'),
(8, 1, 2, 'asdfbn', 0, '2025-10-26 06:45:52', '2025-10-26 06:45:52'),
(9, 1, 2, 'sdfg', 0, '2025-10-26 06:45:55', '2025-10-26 06:45:55'),
(10, 2, 1, 'xvbn', 0, '2025-10-26 06:46:14', '2025-10-26 06:46:14'),
(11, 2, 1, 'sdfg', 0, '2025-10-26 06:46:48', '2025-10-26 06:46:48'),
(12, 1, 2, 'df', 0, '2025-10-26 06:46:56', '2025-10-26 06:46:56'),
(13, 1, 2, 'cvb', 0, '2025-10-26 06:47:05', '2025-10-26 06:47:05'),
(14, 2, 1, 'ccccc', 0, '2025-10-26 06:47:12', '2025-10-26 06:47:12'),
(15, 1, 2, 'hello', 0, '2025-10-26 08:49:55', '2025-10-26 08:49:55'),
(16, 1, 2, 'hello rahul, ashish this side', 0, '2025-10-26 08:54:14', '2025-10-26 08:54:14'),
(17, 2, 1, 'hi ashish', 0, '2025-10-26 08:54:36', '2025-10-26 08:54:36'),
(18, 1, 2, 'testing message', 0, '2025-10-27 10:50:27', '2025-10-27 10:50:27'),
(19, 1, 2, 'sadf', 0, '2025-10-27 11:30:15', '2025-10-27 11:30:15'),
(20, 1, 2, 'hello', 0, '2025-10-27 11:30:19', '2025-10-27 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_14_053041_create_personal_access_tokens_table', 1),
(5, '2025_10_14_055806_create_posts_table', 2),
(6, '2025_10_14_081635_create_comments_table', 3),
(7, '2025_10_14_094340_create_likes_table', 4),
(8, '2025_10_14_114253_create_categories_table', 5),
(9, '2025_10_14_114839_add_category_id_to_posts_table', 6),
(10, '2025_10_19_130322_create_user_followers_table', 7),
(11, '2025_10_19_134241_update_user_followers_table', 8),
(12, '2025_10_19_142524_update2_user_followers_table', 9),
(13, '2025_10_21_114049_create_profile_views_table', 10),
(14, '2025_10_23_063635_add_cover_photo_to_users_table', 11),
(15, '2025_10_24_070622_create_messages_table', 12),
(16, '2025_10_28_083331_create_user_social_links_table', 13);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api_token', 'dd64407f10e7ad9d60d92e097dfdea09ac10a0785a4cdc0558d42137297d65b6', '[\"*\"]', NULL, NULL, '2025-10-14 01:02:23', '2025-10-14 01:02:23'),
(2, 'App\\Models\\User', 1, 'api_token', 'de2ae002227062b4f2fe34a20a861e18b63da46d1c84ef8ec4fed766e08ffa74', '[\"*\"]', '2025-10-29 03:57:48', NULL, '2025-10-14 01:21:06', '2025-10-29 03:57:48'),
(3, 'App\\Models\\User', 1, 'api_token', 'f2a784e1832e4402fc4f50fcbf6cb00843c5cc108b445fcd676bd9fccd0e8deb', '[\"*\"]', '2025-10-16 02:36:11', NULL, '2025-10-16 02:08:32', '2025-10-16 02:36:11'),
(4, 'App\\Models\\User', 1, 'api_token', '082b8dcb0face1be4476d2a3cef21d46c069908232805c23c969a8742d5b6d71', '[\"*\"]', '2025-10-16 02:36:46', NULL, '2025-10-16 02:36:45', '2025-10-16 02:36:46'),
(5, 'App\\Models\\User', 1, 'api_token', '9ec83f393b58e95eb8a96fa7a5d9b5c0171da268c004347b5b7760b4dd956f85', '[\"*\"]', '2025-10-16 02:41:42', NULL, '2025-10-16 02:41:40', '2025-10-16 02:41:42'),
(6, 'App\\Models\\User', 1, 'api_token', '11f80f9a379e633160472c8093990009f681c42e1cb7393d06bff14516ee0273', '[\"*\"]', '2025-10-17 02:01:52', NULL, '2025-10-16 02:41:51', '2025-10-17 02:01:52'),
(7, 'App\\Models\\User', 1, 'api_token', '0505c8daf6a6611f038df6b4f9e6bb64040aff0d41e5ba19a4ae34c774a6f13c', '[\"*\"]', '2025-10-17 02:03:43', NULL, '2025-10-17 02:03:43', '2025-10-17 02:03:43'),
(8, 'App\\Models\\User', 1, 'api_token', '68a60704ece9a59b5e9a24bb61eeac51dbe02b9158c1002ce0eadb677f4dfe58', '[\"*\"]', '2025-10-17 04:55:08', NULL, '2025-10-17 02:17:31', '2025-10-17 04:55:08'),
(9, 'App\\Models\\User', 1, 'api_token', 'be6388bfc54ff20dcb6ecf95b503a356548c6701b0264fdc5d9a07992dc3459f', '[\"*\"]', '2025-10-20 02:49:41', NULL, '2025-10-17 05:11:25', '2025-10-20 02:49:41'),
(10, 'App\\Models\\User', 1, 'api_token', 'c1c15cdb72fa2662b594ae21d2f49f9b13d06f08b90213b29d3026e2ced98def', '[\"*\"]', '2025-10-21 04:52:02', NULL, '2025-10-20 02:56:31', '2025-10-21 04:52:02'),
(11, 'App\\Models\\User', 1, 'api_token', '69ed6d85dc098b08871bb762a2d34e471150fd56bd5da9072db3e25fea45abd8', '[\"*\"]', '2025-10-22 01:05:16', NULL, '2025-10-20 02:57:04', '2025-10-22 01:05:16'),
(12, 'App\\Models\\User', 2, 'api_token', '9bdb1346c577c411aee111b4de1e50525484616bdc6e09e49761bcb50ea69ec5', '[\"*\"]', '2025-10-21 06:59:50', NULL, '2025-10-21 04:54:18', '2025-10-21 06:59:50'),
(13, 'App\\Models\\User', 1, 'api_token', '4000575ed12136d3989dedb074e88e586607ff357bb41113cd7f19d848939f02', '[\"*\"]', '2025-10-21 08:30:10', NULL, '2025-10-21 07:00:07', '2025-10-21 08:30:10'),
(14, 'App\\Models\\User', 1, 'api_token', '6620fb3479d26807b172cff0c57c3542456c7685ac2f6a6a499abaa3a0f41104', '[\"*\"]', '2025-10-22 01:40:37', NULL, '2025-10-21 08:30:31', '2025-10-22 01:40:37'),
(15, 'App\\Models\\User', 3, 'api_token', 'aac0c0acfee07a5fe2c10a7506ed40db15a73240c48d8db415043ea6f0ca35fb', '[\"*\"]', NULL, NULL, '2025-10-21 09:39:18', '2025-10-21 09:39:18'),
(16, 'App\\Models\\User', 2, 'api_token', '35634ce049821734d129a0f2cfa482bd40d8c670958fd4e012d46286dc79a30d', '[\"*\"]', '2025-10-23 05:11:32', NULL, '2025-10-22 01:43:45', '2025-10-23 05:11:32'),
(17, 'App\\Models\\User', 1, 'api_token', '42e99b72885a76a39c2b80623cb82e1bc30397db13364a6a227f3494a432d9c3', '[\"*\"]', '2025-10-23 05:11:50', NULL, '2025-10-23 05:11:47', '2025-10-23 05:11:50'),
(18, 'App\\Models\\User', 2, 'api_token', 'e1c91bf611d1b4c8b292e2ce094256e1680d81e51fec0fb804b2fc8cad9bab93', '[\"*\"]', '2025-10-25 07:58:15', NULL, '2025-10-23 05:35:35', '2025-10-25 07:58:15'),
(19, 'App\\Models\\User', 1, 'api_token', '3f51afb203ad70c5b845779e4a25d3286ad6e7043201069dab18b4c483af9b2e', '[\"*\"]', '2025-10-25 08:05:28', NULL, '2025-10-25 08:05:26', '2025-10-25 08:05:28'),
(20, 'App\\Models\\User', 1, 'api_token', '27f89dbac87b051f2d8a46f561ec385b59379e1b33e188bcf9196612e7e297f8', '[\"*\"]', '2025-10-25 08:07:58', NULL, '2025-10-25 08:05:33', '2025-10-25 08:07:58'),
(21, 'App\\Models\\User', 1, 'api_token', '1f87eb13bf3c914871390e12ebceace340daafb2237df7fa4169ad4a3a9607cb', '[\"*\"]', '2025-10-25 08:08:10', NULL, '2025-10-25 08:08:02', '2025-10-25 08:08:10'),
(22, 'App\\Models\\User', 1, 'api_token', 'fdedef417c60a3a8a763f142638937b16debdf63f65ad6f798e3c8b70dbbf3cf', '[\"*\"]', '2025-10-25 08:45:43', NULL, '2025-10-25 08:44:30', '2025-10-25 08:45:43'),
(23, 'App\\Models\\User', 1, 'api_token', 'c3aecc041d5b9ded273f861a8f351152cc8619fa26b97a4fc407c78a4bd87065', '[\"*\"]', '2025-10-26 10:10:57', NULL, '2025-10-25 08:45:54', '2025-10-26 10:10:57'),
(24, 'App\\Models\\User', 2, 'api_token', '24278a3878feb5b014d6ce77f2908c8a1ffb5f7d47f85942461efb1c3a1757e0', '[\"*\"]', '2025-10-26 09:42:47', NULL, '2025-10-26 06:06:21', '2025-10-26 09:42:47'),
(25, 'App\\Models\\User', 1, 'api_token', 'a0afade394787cc3532af031394950ada8430bdcd15d22e4f55a909b6fc21707', '[\"*\"]', '2025-10-27 10:46:37', NULL, '2025-10-27 09:13:14', '2025-10-27 10:46:37'),
(26, 'App\\Models\\User', 2, 'api_token', 'bb5de1a34d1684396a52e0181f6fd0f198e296d525d57d5e1c539060c4e0fb21', '[\"*\"]', '2025-10-27 10:59:08', NULL, '2025-10-27 10:13:05', '2025-10-27 10:59:08'),
(27, 'App\\Models\\User', 1, 'api_token', '44971c6969cac25ba1a6da51945c5ff2139fa6810584c6036cfe08ebe111d483', '[\"*\"]', '2025-10-27 10:59:22', NULL, '2025-10-27 10:56:24', '2025-10-27 10:59:22'),
(28, 'App\\Models\\User', 1, 'api_token', '6b87273cd084a0362a034bdc6a85194c50bdb6dff28c0b19d34aa43c76ad45d9', '[\"*\"]', '2025-10-28 02:28:11', NULL, '2025-10-27 11:03:10', '2025-10-28 02:28:11'),
(29, 'App\\Models\\User', 2, 'api_token', '3874de90d4f47caa8ce5832bb9ae570c1978884a560d367fbb4abc20b531638e', '[\"*\"]', '2025-10-27 21:03:33', NULL, '2025-10-27 11:03:31', '2025-10-27 21:03:33'),
(30, 'App\\Models\\User', 1, 'api_token', '419f883440020be3ae7982d8de852eda55c7387f970791dc20ac9ed87ba72a0c', '[\"*\"]', '2025-10-30 06:05:22', NULL, '2025-10-28 02:28:40', '2025-10-30 06:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 1, 'Updated Title', 'Updated post content.', '2025-10-14 01:31:51', '2025-10-29 03:57:48', NULL),
(2, 1, 'Sample Post Title 1', 'This is the body content of post number 1. It includes sample text to represent post data.', '2025-10-17 02:22:44', '2025-10-17 02:22:44', NULL),
(3, 1, 'Sample Post Title 2', 'This is the body content of post number 2. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(4, 1, 'Sample Post Title 3', 'This is the body content of post number 3. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(5, 1, 'Sample Post Title 4', 'This is the body content of post number 4. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(6, 1, 'Sample Post Title 5', 'This is the body content of post number 5. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(7, 1, 'Sample Post Title 6', 'This is the body content of post number 6. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(8, 1, 'Sample Post Title 7', 'This is the body content of post number 7. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(9, 1, 'Sample Post Title 8', 'This is the body content of post number 8. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(10, 1, 'Sample Post Title 9', 'This is the body content of post number 9. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(11, 1, 'Sample Post Title 10', 'This is the body content of post number 10. It includes sample text to represent post data.', '2025-10-17 02:22:45', '2025-10-17 02:22:45', NULL),
(13, 1, 'Add post from frontend', 'Testing post description', '2025-10-17 03:59:37', '2025-10-17 03:59:37', NULL),
(14, 2, 'Rahul First Post', 'Post Description', '2025-10-21 04:55:15', '2025-10-21 04:55:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `viewer_id` bigint(20) UNSIGNED NOT NULL,
  `viewed_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fxxvRr5DoCUPRSbAhaGYwLAlHZVynSz5gB2xAErm', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmx4WFBHSkdWM25OTjlQazMxV0VXTUZ5WVZVN09DanZXbzZ5V0hXdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761824116);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `cover_photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ashish Rajput', 'ashishrana288@gmail.com', 'cover/1761644030_Screenshot 2025-10-28 at 12.23.53 AM.png', NULL, '$2y$12$Hyi0q6uZ8iGdBA5lqq.j4e4YmaAE6pOtOnnKLPdI/HQd.s0NBqjQG', NULL, '2025-10-14 01:02:22', '2025-10-28 04:03:50'),
(2, 'Rahul Rana', 'rahul@gmail.com', 'cover/1761215542_2150201875.jpg', NULL, '$2y$12$Hyi0q6uZ8iGdBA5lqq.j4e4YmaAE6pOtOnnKLPdI/HQd.s0NBqjQG', NULL, NULL, '2025-10-23 05:02:22'),
(3, 'rajat verma', 'rajat123@gmail.com', NULL, NULL, '$2y$12$Jd9ykSvptQh/v8B04Ja4vunujVORMBngF5pj8tEb3riPTxJr/PJoi', NULL, '2025-10-21 09:39:18', '2025-10-21 09:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_followers`
--

CREATE TABLE `user_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `followed_id` bigint(20) UNSIGNED NOT NULL,
  `follow_status` enum('followed','unfollowed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unfollowed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_followers`
--

INSERT INTO `user_followers` (`id`, `follower_id`, `followed_id`, `follow_status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'followed', '2025-10-24 01:14:03', '2025-10-24 01:14:03'),
(2, 2, 1, 'followed', '2025-10-24 01:14:23', '2025-10-24 01:14:23'),
(3, 1, 3, 'unfollowed', '2025-10-28 04:55:26', '2025-10-28 04:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_social_links`
--

CREATE TABLE `user_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `site_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `face_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insta_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_social_links`
--

INSERT INTO `user_social_links` (`id`, `user_id`, `site_link`, `face_link`, `insta_link`, `x_link`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://thetechinfo.net', 'https://www.facebook.com/ashish.rana.520', 'https://www.instagram.com/laviii.rajput', 'https://x.com/ashishrana288', '2025-10-28 08:46:12', '2025-10-28 08:46:18');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_views_viewer_id_foreign` (`viewer_id`),
  ADD KEY `profile_views_viewed_user_id_foreign` (`viewed_user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_followers`
--
ALTER TABLE `user_followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_followers_user_id_follower_id_unique` (`followed_id`,`follower_id`),
  ADD KEY `user_followers_follower_id_foreign` (`follower_id`);

--
-- Indexes for table `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_social_links_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profile_views`
--
ALTER TABLE `profile_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_followers`
--
ALTER TABLE `user_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_social_links`
--
ALTER TABLE `user_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD CONSTRAINT `profile_views_viewed_user_id_foreign` FOREIGN KEY (`viewed_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profile_views_viewer_id_foreign` FOREIGN KEY (`viewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_followers`
--
ALTER TABLE `user_followers`
  ADD CONSTRAINT `user_followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_followers_user_id_foreign` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD CONSTRAINT `user_social_links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
