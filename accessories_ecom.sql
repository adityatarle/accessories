-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accessories_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `description`, `website`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Brand', 'luxury-brand', NULL, 'Premium luxury accessories and cosmetics', 'https://luxurybrand.com', 1, 1, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(2, 'Beauty Plus', 'beauty-plus', NULL, 'Professional beauty and cosmetic products', 'https://beautyplus.com', 1, 2, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(3, 'Style Co', 'style-co', NULL, 'Trendy fashion accessories', 'https://styleco.com', 1, 3, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(4, 'Elegant', 'elegant', NULL, 'Elegant jewelry and accessories', 'https://elegant.com', 1, 4, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(5, 'Modern Style', 'modern-style', NULL, 'Modern and contemporary fashion items', 'https://modernstyle.com', 1, 5, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(6, 'Classic Collection', 'classic-collection', NULL, 'Timeless classic accessories', 'https://classiccollection.com', 1, 6, '2025-10-13 05:48:00', '2025-10-13 05:48:00');

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `price`, `session_id`, `created_at`, `updated_at`) VALUES
(3, 3, 9, 1, 29999.00, NULL, '2025-10-14 04:01:11', '2025-10-14 04:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Accessories', 'accessories', 'Fashion accessories for men and women', NULL, 1, 1, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(2, 'Cosmetics', 'cosmetics', 'Beauty and cosmetic products', NULL, 1, 2, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(3, 'Jewelry', 'jewelry', 'Elegant jewelry pieces', NULL, 1, 3, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(4, 'Bags & Purses', 'bags-purses', 'Handbags, purses, and wallets', NULL, 1, 4, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(5, 'Watches', 'watches', 'Luxury and casual watches', NULL, 1, 5, '2025-10-13 05:47:59', '2025-10-13 05:47:59'),
(6, 'Sunglasses', 'sunglasses', 'Stylish sunglasses and eyewear', NULL, 1, 6, '2025-10-13 05:47:59', '2025-10-13 05:47:59');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_13_104457_create_categories_table', 1),
(5, '2025_10_13_104505_create_brands_table', 1),
(6, '2025_10_13_104510_create_products_table', 1),
(7, '2025_10_13_104515_create_carts_table', 1),
(8, '2025_10_13_104519_create_orders_table', 1),
(9, '2025_10_13_104524_create_order_items_table', 1),
(10, '2025_10_13_104531_create_wishlists_table', 1),
(11, '2025_10_13_104537_create_reviews_table', 1),
(12, '2025_10_13_104541_create_notifications_table', 1),
(13, '2025_10_13_105434_add_is_admin_to_users_table', 1),
(14, '2025_10_13_151840_add_profile_fields_to_users_table', 2),
(15, '2025_10_20_062327_create_product_images_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `shipping_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`shipping_address`)),
  `billing_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`billing_address`)),
  `tracking_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `subtotal`, `tax_amount`, `shipping_amount`, `discount_amount`, `total_amount`, `payment_status`, `order_status`, `payment_method`, `payment_id`, `shipping_address`, `billing_address`, `tracking_number`, `notes`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`) VALUES
(1, 'ORD-3XZXYGGX', 2, 3599.00, 647.82, 0.00, 0.00, 4246.82, 'pending', 'shipped', 'cod', NULL, '{\"first_name\":\"Admin User\",\"last_name\":\"something\",\"email\":\"admin@example.com\",\"phone\":\"9096551170\",\"address\":\"nashik\",\"city\":\"nashik\",\"state\":\"maharashtra\",\"postal_code\":\"422101\",\"country\":\"India\"}', '{\"first_name\":\"Admin User\",\"last_name\":\"something\",\"email\":\"admin@example.com\",\"phone\":\"9096551170\",\"address\":\"nashik\",\"city\":\"nashik\",\"state\":\"mahashtra\",\"postal_code\":\"422101\",\"country\":\"India\"}', NULL, NULL, NULL, NULL, '2025-10-13 09:34:43', '2025-10-13 10:03:14'),
(2, 'ORD-FKOSNX0C', 3, 4500.00, 810.00, 0.00, 0.00, 5310.00, 'pending', 'pending', 'upi', NULL, '{\"first_name\":\"Bhushan Pagare\",\"last_name\":\"Pagare\",\"email\":\"bhushan@gmail.com\",\"phone\":\"9096551170\",\"address\":\"Nashikroad\",\"city\":\"Nashik\",\"state\":\"Maharashtra\",\"postal_code\":\"422101\",\"country\":\"India\"}', '{\"first_name\":\"Bhushan Pagare\",\"last_name\":\"Pagare\",\"email\":\"bhushan@gmail.com\",\"phone\":\"09096551170\",\"address\":\"2, Satimata Appart., Gurudatta Nagar, Jailroad, Nashikroad\\r\\nNashik\",\"city\":\"Nashik\",\"state\":\"Maharashtra\",\"postal_code\":\"422101\",\"country\":\"India\"}', NULL, NULL, NULL, NULL, '2025-10-14 02:31:44', '2025-10-14 02:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_sku`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Luxury Lipstick Set', 'SKU-RXC0ZGP6', 1, 3599.00, 3599.00, '2025-10-13 09:34:43', '2025-10-13 09:34:43'),
(2, 2, 8, 'Crossbody Purse', 'SKU-QTTKH7WI', 1, 4500.00, 4500.00, '2025-10-14 02:31:44', '2025-10-14 02:31:44');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `main_image` varchar(255) DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `weight` decimal(8,2) DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `review_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `stock`, `sku`, `images`, `main_image`, `attributes`, `weight`, `dimensions`, `is_featured`, `is_active`, `sort_order`, `rating`, `review_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Premium Leather Wallet', 'premium-leather-wallet', 'Genuine leather wallet with multiple card slots and cash compartment', 'Premium leather wallet for everyday use', 2500.00, 1999.00, 50, 'SKU-KHKT9X8L', NULL, NULL, '{\"material\":\"Genuine Leather\",\"color\":\"Brown\",\"closure\":\"Zipper\",\"compartments\":\"Multiple\"}', 0.20, '10x7x2 cm', 1, 1, 1, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(2, 6, 3, 'Designer Sunglasses', 'designer-sunglasses', 'UV protection sunglasses with polarized lenses and stylish frame', 'Stylish sunglasses with UV protection', 3500.00, NULL, 30, 'SKU-OC0BDLBZ', NULL, NULL, '{\"lens_type\":\"Polarized\",\"frame_material\":\"Acetate\",\"uv_protection\":\"100%\",\"color\":\"Black\"}', 0.10, '14x5x3 cm', 1, 1, 2, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(3, 2, 2, 'Luxury Lipstick Set', 'luxury-lipstick-set', 'Set of 6 premium lipsticks in different shades for all occasions', '6-piece luxury lipstick set', 4500.00, 3599.00, 25, 'SKU-RXC0ZGP6', NULL, NULL, '{\"finish\":\"Matte\",\"shades\":6,\"longevity\":\"12 hours\",\"cruelty_free\":true}', 0.30, '12x8x3 cm', 1, 1, 3, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(4, 2, 2, 'Professional Makeup Brush Set', 'professional-makeup-brush-set', 'Complete set of 12 professional makeup brushes for flawless application', '12-piece professional brush set', 3200.00, NULL, 40, 'SKU-YD4HJLTN', NULL, NULL, '{\"bristle_type\":\"Synthetic\",\"handles\":\"Wooden\",\"brush_count\":12,\"case_included\":true}', 0.50, '20x15x5 cm', 0, 1, 4, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(5, 3, 4, 'Elegant Pearl Necklace', 'elegant-pearl-necklace', 'Beautiful pearl necklace with sterling silver clasp', 'Elegant pearl necklace', 8500.00, 6999.00, 15, 'SKU-MYNFDNMR', NULL, NULL, '{\"material\":\"Freshwater Pearls\",\"clasp\":\"Sterling Silver\",\"length\":\"40cm\",\"pearl_size\":\"8mm\"}', 0.30, '40x2x1 cm', 1, 1, 5, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(6, 3, 4, 'Diamond Stud Earrings', 'diamond-stud-earrings', 'Classic diamond stud earrings in 14k gold setting', 'Diamond stud earrings in gold', 25000.00, NULL, 8, 'SKU-VWIU8CTS', NULL, NULL, '{\"metal\":\"14k Gold\",\"diamond_carat\":\"0.25\",\"clarity\":\"VS1\",\"cut\":\"Round Brilliant\"}', 0.10, '1x1x0.5 cm', 1, 1, 6, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(7, 4, 1, 'Designer Handbag', 'designer-handbag', 'Luxury handbag made from premium leather with gold hardware', 'Luxury leather handbag', 15000.00, 12999.00, 20, 'SKU-NYFRA0RG', NULL, NULL, '{\"material\":\"Premium Leather\",\"hardware\":\"Gold\",\"style\":\"Tote\",\"interior_pockets\":3}', 0.80, '30x20x10 cm', 1, 1, 7, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(8, 4, 5, 'Crossbody Purse', 'crossbody-purse', 'Compact crossbody purse perfect for evening events', 'Elegant crossbody purse', 4500.00, NULL, 35, 'SKU-QTTKH7WI', NULL, NULL, '{\"material\":\"Satin\",\"chain_length\":\"Adjustable\",\"closure\":\"Magnetic\",\"color\":\"Black\"}', 0.30, '20x15x5 cm', 0, 1, 8, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(9, 5, 1, 'Luxury Watch', 'luxury-watch', 'Premium automatic watch with leather strap and sapphire crystal', 'Luxury automatic watch', 35000.00, 29999.00, 12, 'SKU-XU560RX7', NULL, NULL, '{\"movement\":\"Automatic\",\"crystal\":\"Sapphire\",\"strap\":\"Leather\",\"water_resistance\":\"50m\"}', 0.20, '4x4x1 cm', 1, 1, 9, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00'),
(10, 5, 5, 'Smart Watch', 'smart-watch', 'Modern smartwatch with fitness tracking and notifications', 'Fitness tracking smartwatch', 12000.00, NULL, 25, 'SKU-8RRJYNIY', NULL, NULL, '{\"display\":\"AMOLED\",\"battery_life\":\"7 days\",\"fitness_features\":\"Heart rate, GPS\",\"compatibility\":\"iOS, Android\"}', 0.30, '4x4x1.5 cm', 0, 1, 10, 0.00, 0, '2025-10-13 05:48:00', '2025-10-13 05:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_verified_purchase` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8HmYkWACZrJGzrgkixjy662Mu4QOJeFXCxz1xYCd', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMkhFakFwSnVIZkl6dGM4SHY0dXBNbUpJeWYyMUNwbms5anNPUVAwQSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcHJvZHVjdHMvcHJlbWl1bS1sZWF0aGVyLXdhbGxldC9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1760941851),
('onLiHJz6A1Yx5dJjTV50S6zaFaYTIplVIScU6Cfu', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTlR1bWJoRDRmdHBta0JOY3drQmc1SkJidU9QRGZjRElkZ3dnODE4dyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1760434328),
('SCJI3Fyg4Qkr4Wdvywrj9ynR6yragsWWW6pVRSnu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzdJNnBVS2M0YTJTTkxMdEtyalU4cVNacnVnbDk2d0RJZUhzRjk3VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1760941192);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `date_of_birth`, `gender`, `address`, `city`, `state`, `country`, `postal_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Test User', 'test@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-13 05:47:59', '$2y$12$Y7HrPKzYjBW3Y.bBSmaFo.JqAjRvvNwNgar5a0U2hKp0KNYkGk7Hi', 'aqPsNYKym9', '2025-10-13 05:47:59', '2025-10-13 05:47:59', 0),
(2, 'Admin User', 'admin@example.com', '9096551170', '2000-03-28', 'male', '2, Satimata Appart., Gurudatta Nagar, Jailroad, Nashikroad\r\nNashik', 'Nashik', 'Maharashtra', 'India', '422101', '2025-10-13 05:47:59', '$2y$12$Y7HrPKzYjBW3Y.bBSmaFo.JqAjRvvNwNgar5a0U2hKp0KNYkGk7Hi', '3ThFGlkqUCjwj39g5SlXHOCMaReEDJ8yyLHuDEQ990trQbdH9XHvJjRuByMT', '2025-10-13 05:47:59', '2025-10-13 09:52:38', 1),
(3, 'Bhushan Pagare', 'bhushan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$PUnfWO.FuzFUgVj6ki8sMeKDGGE5Xs94ds5a8nQbnaCoiZUIvJ032', NULL, '2025-10-14 02:30:32', '2025-10-14 02:30:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

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
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
