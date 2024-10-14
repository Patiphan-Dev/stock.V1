-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 10:54 PM
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
-- Database: `stock`
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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `company_address` varchar(250) DEFAULT NULL COMMENT 'ที่อยู่บริษัท',
  `company_tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรบริษัท',
  `company_fax` varchar(10) DEFAULT NULL COMMENT 'แฟรกซ์',
  `company_taxpayer_number` varchar(10) DEFAULT NULL COMMENT 'เลขผู้เสียภาษี',
  `company_logo` varchar(255) DEFAULT NULL COMMENT 'โลโก้บริษัท',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2024_09_05_043123_create_product_lists_table', 1),
(5, '2024_09_05_043150_create_purchase_orders_table', 1),
(6, '2024_09_05_043204_create_purchase_lists_table', 1),
(7, '2024_09_05_043217_create_sales_orders_table', 1),
(8, '2024_09_05_043246_create_sales_lists_table', 1),
(9, '2024_09_10_020951_create_companies_table', 1);

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
-- Table structure for table `product_lists`
--

CREATE TABLE `product_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` varchar(20) DEFAULT NULL COMMENT 'รหัสใบสั่งซื้อ',
  `prod_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `prod_unit` varchar(255) DEFAULT NULL COMMENT 'หน่วย',
  `prod_length` double DEFAULT NULL COMMENT 'ความยาว',
  `prod_price_per_unit` double DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `prod_buy_qty` int(11) DEFAULT NULL COMMENT 'จำนวนสินค้าซื้อมา',
  `prod_sales_qty` int(11) DEFAULT NULL COMMENT 'จำนวนสินค้าที่ขายไป',
  `prod_min_qty` int(11) DEFAULT NULL COMMENT 'จำนวนสินค้าคงเหลือ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_lists`
--

INSERT INTO `product_lists` (`id`, `po_id`, `prod_name`, `prod_unit`, `prod_length`, `prod_price_per_unit`, `prod_buy_qty`, `prod_sales_qty`, `prod_min_qty`, `created_at`, `updated_at`) VALUES
(1, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.80mmx914mmxC', 'เมตร', NULL, 150, 100, 0, 100, '2024-10-14 13:22:13', '2024-10-14 13:22:13'),
(2, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.30mmx914mmxC', 'เมตร', NULL, 120, 100, 0, 100, '2024-10-14 13:22:13', '2024-10-14 13:22:13'),
(3, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.40mmx914mmxC', 'เมตร', NULL, 130, 100, 0, 100, '2024-10-14 13:22:13', '2024-10-14 13:22:13'),
(4, NULL, 'ตะปู', 'กิโลกรัม', NULL, 45, 50, 3, 47, '2024-10-14 13:22:52', '2024-10-14 13:26:30'),
(5, NULL, 'ค้อนเหล็ก', 'ด้าม', NULL, 115, 20, 1, 19, '2024-10-14 13:23:48', '2024-10-14 13:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_lists`
--

CREATE TABLE `purchase_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` varchar(20) DEFAULT NULL COMMENT 'รหัสใบสั่งซื้อ',
  `po_prod_name` varchar(250) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `po_prod_quantity` int(11) DEFAULT NULL COMMENT 'จำนวน',
  `po_prod_price_per_unit` double DEFAULT NULL COMMENT 'ราคา/หน่วย',
  `po_prod_price` double DEFAULT NULL COMMENT 'จำนวนเงิน',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_lists`
--

INSERT INTO `purchase_lists` (`id`, `po_id`, `po_prod_name`, `po_prod_quantity`, `po_prod_price_per_unit`, `po_prod_price`, `created_at`, `updated_at`) VALUES
(1, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.80mmx914mmxC', 100, 150, 15000, '2024-10-14 13:22:13', '2024-10-14 13:22:13'),
(2, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.30mmx914mmxC', 100, 120, 12000, '2024-10-14 13:22:13', '2024-10-14 13:22:13'),
(3, 'PO241014/1013', 'ม้วนอลูซิงค์ 0.40mmx914mmxC', 100, 130, 13000, '2024-10-14 13:22:13', '2024-10-14 13:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` varchar(20) DEFAULT NULL COMMENT 'รหัสใบสั่งซื้อ',
  `po_number1` varchar(20) DEFAULT NULL COMMENT 'เล่มที่',
  `po_number2` varchar(20) DEFAULT NULL COMMENT 'เลขที่',
  `po_date` date DEFAULT NULL COMMENT 'วันที่',
  `po_company_name` varchar(200) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `po_company_address` varchar(250) DEFAULT NULL COMMENT 'ที่อยู่บริษัท',
  `po_company_tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรบริษัท',
  `po_company_fax` varchar(10) DEFAULT NULL COMMENT 'แฟรกซ์',
  `po_company_taxpayer_number` varchar(13) DEFAULT NULL COMMENT 'เลขผู้เสียภาษี',
  `po_total_price` double DEFAULT NULL COMMENT 'รวมราคาสินค้า',
  `po_vat` double DEFAULT NULL COMMENT 'ภาษีมูลค่าเพิ่ม 7%',
  `po_net_price` double DEFAULT NULL COMMENT 'รวมเงินทั้งสิ้น',
  `po_note` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_id`, `po_number1`, `po_number2`, `po_date`, `po_company_name`, `po_company_address`, `po_company_tel`, `po_company_fax`, `po_company_taxpayer_number`, `po_total_price`, `po_vat`, `po_net_price`, `po_note`, `created_at`, `updated_at`) VALUES
(1, 'PO241014/1013', '001', '0014', '2024-10-15', 'บริษัท ศุภกิจโปรดัก จำกัด', 'aaaaaaaaaaaaaaaaa', '0879853883', '0987456123', '0105537128631', 40000, 2800, 42800, NULL, '2024-10-14 13:22:13', '2024-10-14 13:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales_lists`
--

CREATE TABLE `sales_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `so_id` varchar(20) DEFAULT NULL COMMENT 'รหัสใบสั่งขาย',
  `so_prod_name` varchar(250) DEFAULT NULL COMMENT 'รายการสินค้า',
  `so_prod_length` double DEFAULT NULL COMMENT 'ยาว(ม.)',
  `so_prod_quantity` int(11) DEFAULT NULL COMMENT 'จำนวน',
  `so_prod_total_length` double DEFAULT NULL COMMENT 'รวมยาว',
  `so_prod_price_per_unit` double DEFAULT NULL COMMENT 'ราคาหน่วยละ',
  `so_prod_price` double DEFAULT NULL COMMENT 'จำนวนเงิน',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_lists`
--

INSERT INTO `sales_lists` (`id`, `so_id`, `so_prod_name`, `so_prod_length`, `so_prod_quantity`, `so_prod_total_length`, `so_prod_price_per_unit`, `so_prod_price`, `created_at`, `updated_at`) VALUES
(3, 'SO241014/1053', 'ค้อนเหล็ก', 0, 1, 0, 115, 115, '2024-10-14 13:26:30', '2024-10-14 13:26:30'),
(4, 'SO241014/1053', 'ตะปู', 0, 3, 0, 45, 135, '2024-10-14 13:26:30', '2024-10-14 13:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `so_id` varchar(20) DEFAULT NULL COMMENT 'รหัสใบสั่งขาย',
  `so_number` varchar(30) DEFAULT NULL COMMENT 'เลขที่',
  `so_date` date DEFAULT NULL COMMENT 'วันที่',
  `so_customer_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อลูกค้า',
  `so_customer_address` varchar(250) DEFAULT NULL COMMENT 'ที่อยู่ลูกค้า',
  `so_customer_taxpayer_number` varchar(13) DEFAULT NULL COMMENT 'เลขประจำตัวผู้เสียภาษี',
  `so_total_price` double DEFAULT NULL COMMENT 'รวมราคาสินค้า',
  `so_vat` double DEFAULT NULL COMMENT 'ภาษีมูลค่าเพิ่ม 7%',
  `so_net_price` double DEFAULT NULL COMMENT 'รวมเงินทั้งสิ้น',
  `so_note` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `so_id`, `so_number`, `so_date`, `so_customer_name`, `so_customer_address`, `so_customer_taxpayer_number`, `so_total_price`, `so_vat`, `so_net_price`, `so_note`, `created_at`, `updated_at`) VALUES
(1, 'SO241014/1053', '001', '2024-10-15', 'บริษัท xxx จำกัด', 'aaaaaaaaaaa', '1234567890123', 250, 17.5, 267.5, NULL, '2024-10-14 13:24:53', '2024-10-14 13:26:30');

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
('1lv75QgaGGgkrAsR56sHDQL1gNzbeJessKNzsiTj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoienQ5R21YMWhncERvMjVlRU9QS0pITjAwanNVMEJ0M21LeEVTWmQ4biI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1728939168);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL COMMENT 'ชื่อ',
  `fullname` varchar(200) DEFAULT NULL COMMENT 'ชื่อเต็ม',
  `password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `status` varchar(20) DEFAULT NULL COMMENT 'สถานะ',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '$2y$12$QRgkwl09fk6dv.sAmBu4ROOdnxh4NBuCESDMsbEXHLZzkHIV9judi', 'admin', 'd8qyY9cbHc', '2024-10-14 13:20:04', '2024-10-14 13:20:04');

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `product_lists`
--
ALTER TABLE `product_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_lists`
--
ALTER TABLE `purchase_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_lists`
--
ALTER TABLE `sales_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_lists`
--
ALTER TABLE `product_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_lists`
--
ALTER TABLE `purchase_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_lists`
--
ALTER TABLE `sales_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
