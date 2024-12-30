-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 08:17 AM
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
(29, '::1', 'satu@gmail.com', 12, '2024-12-04 14:06:16', 1),
(30, '::1', 'satu', NULL, '2024-12-06 09:22:14', 0),
(31, '::1', 'satu@gmail.com', 12, '2024-12-06 09:22:24', 1),
(32, '::1', 'dua@gmail.com', 13, '2024-12-06 09:23:01', 1),
(33, '::1', 'satu@gmail.com', 12, '2024-12-07 10:19:45', 1),
(34, '::1', 'satu@gmail.com', 12, '2024-12-07 15:06:08', 1),
(35, '::1', 'satu@gmail.com', 12, '2024-12-07 15:06:25', 1),
(36, '::1', 'dua@gmail.com', 13, '2024-12-07 15:31:35', 1),
(37, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-08 07:58:22', 1),
(38, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-08 13:02:11', 1),
(39, '::1', 'dua@gmail.com', 13, '2024-12-08 13:03:32', 1),
(40, '::1', 'superadmin', NULL, '2024-12-08 13:09:19', 0),
(41, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-08 13:11:37', 1),
(42, '::1', 'dua@gmail.com', 13, '2024-12-08 14:58:18', 1),
(43, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-08 16:10:22', 1),
(44, '::1', 'dua@gmail.com', 13, '2024-12-08 16:17:35', 1),
(45, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-08 16:49:18', 1),
(46, '::1', 'dua@gmail.com', 13, '2024-12-09 03:14:09', 1),
(47, '::1', 'dua@gmail.com', 13, '2024-12-17 08:09:01', 1),
(48, '::1', 'satu@gmail.com', 12, '2024-12-17 22:50:11', 1),
(49, '::1', 'dua@gmail.com', 13, '2024-12-21 14:28:26', 1),
(50, '::1', 'dua@gmail.com', 13, '2024-12-21 22:06:07', 1),
(51, '::1', 'dua@gmail.com', 13, '2024-12-22 14:33:09', 1),
(52, '::1', 'dua', NULL, '2024-12-25 06:04:32', 0),
(53, '::1', 'dua', NULL, '2024-12-25 06:04:40', 0),
(54, '::1', 'dua@gmail.com', 13, '2024-12-25 06:04:51', 1),
(55, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-25 08:23:25', 1),
(56, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-25 12:47:20', 1),
(57, '::1', 'dua@gmail.com', 13, '2024-12-27 04:12:01', 1),
(58, '::1', 'flyingpiratecat@gmail.com', 8, '2024-12-27 06:31:54', 1),
(59, '::1', 'dua@gmail.com', 13, '2024-12-27 07:05:06', 1);

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
  `ordercode` varchar(255) NOT NULL,
  `id_buyer` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `data_product` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tableorder`
--

INSERT INTO `tableorder` (`id`, `ordercode`, `id_buyer`, `id_seller`, `data_product`, `status`, `payment_proof`, `created_at`, `updated_at`) VALUES
(2, '24351145537', 13, 12, '24351145537-13-12', 'Verifikasi', '85e2364e29019125672a74fcbf6afede.png', '2024-12-21 15:06:01', '2024-12-27 07:15:01'),
(3, '24351145537', 13, 9, '24351145537-13-9', 'Verifikasi', '85e2364e29019125672a74fcbf6afede.png', '2024-12-21 15:06:01', '2024-12-27 07:15:01'),
(4, '24351145537', 13, 8, '24351145537-13-8', 'Verifikasi', '85e2364e29019125672a74fcbf6afede.png', '2024-12-21 15:06:01', '2024-12-27 07:15:01'),
(5, '24355150522', 13, 8, '24355150522-13-8', 'Belum Dibayar', NULL, '2024-12-21 15:06:01', '2024-12-21 15:06:01'),
(6, '24355150601', 13, 8, '24355150601-13-8', 'Belum Dibayar', NULL, '2024-12-21 15:06:01', '2024-12-21 15:06:01'),
(7, '2435961113', 13, 8, '2435961113-13-8', 'Belum Dibayar', NULL, '2024-12-25 06:11:13', '2024-12-25 06:11:13'),
(8, '2435961113', 13, 9, '2435961113-13-9', 'Belum Dibayar', NULL, '2024-12-25 06:11:13', '2024-12-25 06:11:13');

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
(6, 'sample_akuarium.jpg', 'Akuarium Kaca', 'product06', '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, optio.', 10550, 450000, 12, 3000, 9, '2024-02-14 00:00:00', '2024-12-08 17:07:15'),
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
(8, 'flyingpiratecat@gmail.com', 'Superadmin', 'Kampreto', 1, '2011-11-04', '1234567890123456', '122', 'Toko Piring Terbang', '49a6361761f56940f15974f27220cc67.png', 'Jl Antah Berantah', 16416, '$2y$10$z2xWvDcjn.ahJfjBErxWn.luBmdP6NfzaSYeZ64GwEg1Hpg3JYB7G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-20 15:31:25', '2024-11-20 15:31:25', NULL),
(9, 'sweeper@gmayl.com', 'Sweeper', 'Sweeper Gladioso', 1, '1992-11-12', '1233457889675679', '56564565445656', 'Toko Piring Terbang', 'bda0e84e857f2a7ad6943b69d2ac5377.png', 'Jalan Antah Berantah 2', 10550, '$2y$10$yJmiw6gA7Le6dOkrdkwpduafs15HL.SAhThtxuARSQ7QfYFSQOy1K', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-21 00:07:10', '2024-11-21 00:07:10', NULL),
(12, 'satu@gmail.com', 'Satu', 'Saaaa', 0, NULL, '1234567890123456', '123', 'Toko Kencana', 'profile_default.svg', 'Jl Antah Berantah 4', 12780, '$2y$10$QP8sMfnEad6jbIeT3927zu5OLqMXXjg0pckjyiTcs2hwwoI1/90NG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-23 08:36:42', '2024-11-23 08:36:42', NULL),
(13, 'dua@gmail.com', 'Dua', 'User', 0, NULL, NULL, '1243331', NULL, 'profile_default.svg', 'Jalan Antah Berantah 4 RT3 RW7', 10130, '$2y$10$qgPtwxzw43/K/7t5.ukM8OZbEwj9Jiq2TXdwvrFw9wrtPyBVmlmiK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-11-24 12:48:12', '2024-11-24 12:48:12', NULL);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
