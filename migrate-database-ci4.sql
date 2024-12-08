-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 09:25 AM
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
-- Database: `ci4`
--
CREATE DATABASE IF NOT EXISTS `ci4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ci4`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular User'),
(3, 'agen', 'Agen IOM');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 8),
(2, 12),
(2, 13),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'sweeper@gmayl.com', 9, '2024-11-22 02:28:12', 1),
(2, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-22 03:52:52', 1),
(3, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-22 05:59:06', 1),
(4, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-22 09:24:43', 1),
(5, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-22 09:47:46', 1),
(6, '::1', 'satu@gmail.com', 12, '2024-11-23 08:36:51', 1),
(7, '::1', 'satu@gmail.com', 12, '2024-11-23 13:47:00', 1),
(8, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-23 14:19:12', 1),
(9, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-23 18:45:10', 1),
(10, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-23 23:26:44', 1),
(11, '::1', 'satu@gmail.com', 12, '2024-11-24 12:19:30', 1),
(12, '::1', 'satu@gmail.com', 12, '2024-11-24 12:38:12', 1),
(13, '::1', 'satu@gmail.com', 12, '2024-11-24 12:41:29', 1),
(14, '::1', 'dua@gmail.com', 13, '2024-11-24 12:48:24', 1),
(15, '::1', 'sweeper@gmayl.com', 9, '2024-11-24 18:26:45', 1),
(16, '::1', 'sweeper@gmayl.com', 9, '2024-11-24 20:04:09', 1),
(17, '::1', 'sweeper@gmayl.com', 9, '2024-11-24 23:01:48', 1),
(18, '::1', 'sweeper@gmayl.com', 9, '2024-11-25 08:53:32', 1),
(19, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-28 08:09:32', 1),
(20, '::1', 'superadmin', NULL, '2024-11-28 08:44:31', 0),
(21, '::1', 'flyingpiratecat@gmail.com', 8, '2024-11-28 08:44:41', 1),
(22, '::1', 'satu@gmail.com', 12, '2024-11-28 12:43:50', 1),
(23, '::1', 'satu@gmail.com', 12, '2024-11-28 14:03:07', 1),
(24, '::1', 'satu@gmail.com', 12, '2024-11-30 10:33:23', 1),
(25, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-03 05:41:05', 1),
(26, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-04 10:30:56', 1),
(27, '::1', 'sweeper@gmayl.com', 9, '2024-12-04 12:37:19', 1),
(28, '::1', 'satu@gmail.com', 12, '2024-12-04 13:42:22', 1),
(29, '::1', 'satu@gmail.com', 12, '2024-12-04 14:06:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-user', 'Manage All Users'),
(2, 'manage-profile', 'Manage User\'s Profile'),
(3, 'crud-product', 'Menambah, edit, dan delete produk');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732096155, 1),
(2, '2024-11-18-052106', 'App\\Database\\Migrations\\Tableproduct', 'default', 'App', 1732096720, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tableorder`
--

CREATE TABLE `tableorder` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tableproduct`
--

CREATE TABLE `tableproduct` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `postalcode` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `weight` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tableproduct`
--

INSERT INTO `tableproduct` (`id`, `cover`, `name`, `slug`, `type`, `description`, `postalcode`, `price`, `stock`, `weight`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'sample_pot.jpg', 'Pot Keramik', 'product01', '0', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi, sapiente.', 10250, 30000, 2, 1200, 8, '2024-02-14 00:00:00', '2024-11-22 06:27:46'),
(2, 'sample_tas_bambu.jpg', 'Tas Anyaman Bambu', 'product02', '0', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, necessitatibus?', 10250, 250000, 1, 400, 8, '2024-02-14 00:00:00', '2024-11-22 09:38:10'),
(3, 'sample_kain_tenun.jpg', 'Kain Tenun', 'product03', '0', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, repellendus!', 10250, 75000, 1, 0, 8, '2024-02-14 00:00:00', '2024-02-14 00:00:00'),
(4, 'sample_patung_garuda.jpg', 'Patung Garuda Kayu', 'product04', '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque tenetur ut animi amet dicta accusamus?', 10250, 2000000, 1, 0, 8, '2024-02-14 00:00:00', '2024-02-14 00:00:00'),
(5, 'sample_kalung_manik.jpg', 'Kalung Manik-manik', 'kalung-manik-manik', '0', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis placeat, laboriosam at corrupti beatae cumque!', 10250, 19550, 4, 0, 8, '2024-02-14 00:00:00', '2024-11-22 01:15:50'),
(6, 'sample_akuarium.jpg', 'Akuarium Kaca', 'product06', '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, optio.', 10250, 450000, 1, 0, 8, '2024-02-14 00:00:00', '2024-02-14 00:00:00'),
(11, 'sample_bawang_merah.jpg', 'Bawang Merah Brebes', '5aaaa0142-bawang-merah-brebes', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, molestias!', 10250, 28000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:46:42'),
(12, 'sample_beras_lampung.jpg', 'Beras Medium Lampung', '5aaaa018f-beras-medium-lampung', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, veniam! ', 10250, 13600, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:47:19'),
(13, 'sample_gabah_cianjur.jpg', 'Gabah Cianjur', '5aaaa0196-gabah-cianjur', '1', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse, corporis! ', 10250, 7000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:47:26'),
(14, 'sample_gabah_grobogan.jpg', 'Gabah Grobogan', '5aaaa019e-gabah-grobogan', '1', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, nihil. ', 10250, 7800, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:47:34'),
(15, 'sample_gabah_lampung.jpg', 'Gabah Lampung', '5aaaa01a5-gabah-lampung', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, laboriosam ratione fugiat reiciendis mollitia similique. ', 10250, 8000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:47:41'),
(16, 'sample_jagung_lampung.jpg', 'Jagung Lampung', 'product16', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, rem pariatur? Quidem suscipit dolorum iste, quod amet atque! ', 10250, 5100, 1, 0, 8, '2024-02-14 00:00:00', '2024-02-14 00:00:00'),
(17, 'sample_jagung_tasikmalaya.jpg', 'Jagung Tasikmalaya', '5aaaa0258-jagung-tasikmalaya', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, fuga. ', 10250, 4600, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:49:20'),
(18, 'sample_kakao_kendari.jpg', 'Kakao Kendari', '5aaaa024e-kakao-kendari', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, odio voluptatibus minus maiores ipsam suscipit ad beatae harum earum. ', 10250, 54000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:49:10'),
(21, 'sample_ikan_tuna.jpg', 'Ikan Tuna', '5aaaa0206-ikan-tuna', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor sapiente rerum ex culpa quasi numquam nisi tempore exercitationem placeat, nemo maiores quo laudantium labore omnis? ', 10250, 15000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:48:38'),
(22, 'sample_lobster.jpg', 'Lobster Laut Frozen', '5aaaa01ff-lobster-laut-frozen', '2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos ullam, quod unde nemo ratione quisquam, tempora eaque sapiente autem rerum repellat voluptates consequuntur ducimus nesciunt. ', 10250, 95000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:48:31'),
(23, 'sample_cumi.jpg', 'Cumi Sotong Kering', '5aaaa01f7-cumi-sotong-kering', '2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam dolor necessitatibus assumenda sequi error vitae quod laudantium nostrum nisi! Corporis ad maiores animi officia! Velit corrupti repellendus laudantium deserunt ab! ', 10250, 65000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:48:23'),
(24, 'sample_kerang_tahu.jpg', 'Kerang Tahu Hidup', '5aaaa01ef-kerang-tahu-hidup', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis quos deleniti explicabo. Ipsa maxime culpa delectus, quam laboriosam modi velit, soluta perferendis cum, optio neque. Aliquam ullam maiores error et! ', 10250, 22000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:48:15'),
(31, 'sample_batu_bara.jpg', 'Batu Bara', '5aaa9fb4a-batu-bara', '3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates ab quibusdam dolores dicta reprehenderit ad beatae nisi veniam quaerat tempore! ', 10250, 60790, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:31:14'),
(32, 'sample_nikel.jpg', 'Anoda Nikel 99%', '5aaa9fb62-anoda-nikel-99', '3', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam quam architecto et ipsam sed nulla a eum ut aut alias? ', 10250, 574900, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:31:38'),
(33, 'sample_plat_tembaga.jpg', 'Plat Tmbaga Busbar 15x60x100mm', '5aaa9fc1e-plat-tmbaga-busbar-15x60x100mm', '3', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit dolorum nostrum ad deserunt enim doloremque illum, esse voluptatem architecto tempore inventore veniam iste accusamus maiores a labore rem eum voluptatibus. ', 10250, 240000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:33:26'),
(34, 'sample_timah.jpg', 'Timah Lunak Batangan', '5aaa9fc6f-timah-lunak-batangan', '3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur maxime eius officiis aliquid expedita impedit, laborum deserunt nihil voluptatem ab. ', 10250, 40000, 1, 1000, 8, '2024-02-14 00:00:00', '2024-12-04 10:34:07'),
(37, '49a6361761f56940f15974f27220cc67.png', 'Gem', '91015630-gem', '0', 'Gem', NULL, 100000, 1, 100, 12, '2024-11-23 08:39:20', '2024-11-23 08:39:20'),
(38, '49a6361761f56940f15974f27220cc67.png', 'Gem2', '91016f2a-gem2', '0', 'aaaaa', 12780, 100000, 10, 100, 12, '2024-11-23 09:03:14', '2024-11-23 09:03:14'),
(39, '49a6361761f56940f15974f27220cc67.png', 'aaaab', '91017433-aaaaa', '0', '...', 12780, 10000, 1, 100, 12, '2024-11-23 09:16:03', '2024-11-23 10:31:41'),
(40, '49a6361761f56940f15974f27220cc67.png', 'aaa', '5aa021a13-aaa', '0', 'Gem Emas', 12780, 100000, 10, 100, 12, '2024-11-23 10:09:47', '2024-11-23 10:38:29'),
(48, '49a6361761f56940f15974f27220cc67.png', 'saaatu', '5aa4edac1-saaatu', '0', '122222', 12780, 1000, 10, 10, 12, '2024-11-28 13:10:09', '2024-11-28 13:10:09'),
(49, '828bc787fc46bc75dd43a5c71840e235.jpg', 'Capcay', '5aa6d4655-capcay', '4', 'Capcay sayuran', 12780, 10000, 10, 10, 12, '2024-11-30 10:34:34', '2024-11-30 12:46:29'),
(50, 'not-found.jpg', 'Bali', '9110245a-bali', '5', 'aaa', 10250, 720000, 1, 0, 8, '2024-12-03 05:42:02', '2024-12-03 05:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `gender` int(1) NOT NULL DEFAULT 0,
  `birthdate` date DEFAULT NULL,
  `ktp` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `shopname` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'profile_default.svg',
  `street_address` varchar(255) DEFAULT NULL,
  `postalcode` int(11) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `gender`, `birthdate`, `ktp`, `phone`, `shopname`, `user_image`, `street_address`, `postalcode`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'flyingpiratecat@gmail.com', 'Superadmin', 'Kampreto', 1, '2011-11-04', '1234567890123456', '122', 'Toko Piring Terbang', '49a6361761f56940f15974f27220cc67.png', 'Jl Antah Berantah', 10250, '$2y$10$z2xWvDcjn.ahJfjBErxWn.luBmdP6NfzaSYeZ64GwEg1Hpg3JYB7G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-20 15:31:25', '2024-11-20 15:31:25', NULL),
(9, 'sweeper@gmayl.com', 'Sweeper', 'Sweeper Gladioso', 1, '1992-11-12', '1233457889675679', '56564565445656', 'Toko Piring Terbang', 'bda0e84e857f2a7ad6943b69d2ac5377.png', 'Jalan Antah Berantah 2', 12880, '$2y$10$yJmiw6gA7Le6dOkrdkwpduafs15HL.SAhThtxuARSQ7QfYFSQOy1K', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-21 00:07:10', '2024-11-21 00:07:10', NULL),
(12, 'satu@gmail.com', 'Satu', 'Saaaa', 0, NULL, '1234567890123456', '123', 'Toko Kencana', 'profile_default.svg', 'Jl Antah Berantah 4', 12780, '$2y$10$QP8sMfnEad6jbIeT3927zu5OLqMXXjg0pckjyiTcs2hwwoI1/90NG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-23 08:36:42', '2024-11-23 08:36:42', NULL),
(13, 'dua@gmail.com', 'Dua', NULL, 0, NULL, NULL, NULL, NULL, 'profile_default.svg', NULL, NULL, '$2y$10$qgPtwxzw43/K/7t5.ukM8OZbEwj9Jiq2TXdwvrFw9wrtPyBVmlmiK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-24 12:48:12', '2024-11-24 12:48:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableorder`
--
ALTER TABLE `tableorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableproduct`
--
ALTER TABLE `tableproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tableorder`
--
ALTER TABLE `tableorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableproduct`
--
ALTER TABLE `tableproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'ci4sql', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"auth_activation_attempts\",\"auth_groups\",\"auth_groups_permissions\",\"auth_groups_users\",\"auth_logins\",\"auth_permissions\",\"auth_reset_attempts\",\"auth_tokens\",\"auth_users_permissions\",\"migrations\",\"tableorder\",\"tableproduct\",\"users\"],\"table_structure[]\":[\"auth_activation_attempts\",\"auth_groups\",\"auth_groups_permissions\",\"auth_groups_users\",\"auth_logins\",\"auth_permissions\",\"auth_reset_attempts\",\"auth_tokens\",\"auth_users_permissions\",\"migrations\",\"tableorder\",\"tableproduct\",\"users\"],\"table_data[]\":[\"auth_activation_attempts\",\"auth_groups\",\"auth_groups_permissions\",\"auth_groups_users\",\"auth_logins\",\"auth_permissions\",\"auth_reset_attempts\",\"auth_tokens\",\"auth_users_permissions\",\"migrations\",\"tableorder\",\"tableproduct\",\"users\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"ci4\",\"table\":\"auth_groups_users\"},{\"db\":\"ci4\",\"table\":\"users\"},{\"db\":\"ci4\",\"table\":\"auth_groups\"},{\"db\":\"ci4\",\"table\":\"auth_groups_permissions\"},{\"db\":\"ci4\",\"table\":\"auth_permissions\"},{\"db\":\"ci4\",\"table\":\"auth_logins\"},{\"db\":\"ci4\",\"table\":\"auth_activation_attempts\"},{\"db\":\"ci4\",\"table\":\"auth_reset_attempts\"},{\"db\":\"ci4\",\"table\":\"tableproduct\"},{\"db\":\"ci4\",\"table\":\"migrations\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-12-06 06:44:32', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
