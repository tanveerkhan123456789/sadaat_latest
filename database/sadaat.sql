-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 11:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sadaat`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `purchase_id` int(255) DEFAULT NULL,
  `supplier_id` int(255) DEFAULT NULL,
  `pay_amount` varchar(255) DEFAULT '0',
  `due_amount` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `purchase_id`, `supplier_id`, `pay_amount`, `due_amount`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 12, '10', '870', '2022-07-04 12:46:58', '2022-07-04 12:46:58.000000');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', 'superadmin', NULL, '$2y$10$04D4VxiS5fbr8ll6towqjeTK21rP8MHxERjgpTeES5rdLD0c9bIsi', NULL, '2020-09-11 22:33:43', '2020-09-11 22:33:43'),
(5, 'hamza', 'hamza@gmail.com', 'hamza', NULL, '$2y$10$N.7z3nIzC9kEahsbhgKkEuiAmcQc9sfp3.kV.rxXI1WPKywypNV8G', NULL, '2022-07-04 05:24:49', '2022-07-04 05:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catagory_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_img`, `brand_status`, `created_at`, `updated_at`, `catagory_id`) VALUES
(16, 'saddat', '1655844525.jpg', 0, '2022-06-21 19:48:45', '2022-06-21 19:48:45', '12');

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catagory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `catagory_name`, `catagory_img`, `brand_status`, `created_at`, `updated_at`) VALUES
(10, 'as', '1654675178.jpg', 0, '2022-06-08 06:59:38', '2022-06-08 06:59:38'),
(12, 'Debra Terry', '1654667649.jpg', 0, '2022-06-08 04:52:45', '2022-06-08 04:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_group_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_group_id`, `name`, `company_name`, `tax_number`, `email`, `phone`, `address`, `city`, `state`, `p_code`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, '4', 'Chantale Pena', 'Calderon Webster Inc', '757', 'sylo@mailinator.com', '(158) 483-2805', 'Et rerum vel volupta', 'Aliquam dicta ex eni', 'Harum quia delectus', 'Deserunt iure volupt', 'Cillum molestiae con', '0', '2022-07-02 00:31:41', '2022-07-02 00:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `percentage`, `created_at`, `updated_at`) VALUES
(4, 'asa', '93', '2022-07-01 11:36:36', '2022-07-01 11:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2019_08_19_000000_create_failed_jobs_table', 1),
(32, '2020_07_24_184706_create_permission_tables', 1),
(33, '2020_09_12_043205_create_admins_table', 2),
(34, '2022_06_05_235112_create_warehouses_table', 3),
(35, '2022_06_06_005449_create_ware_houses_table', 4),
(36, '2022_06_06_062958_create_brands_table', 5),
(37, '2022_06_06_100115_create_suppliers_table', 6),
(38, '2022_06_07_075015_create_customer_groups_table', 7),
(39, '2022_06_07_075922_create_units_table', 7),
(40, '2022_06_07_102110_create_catagories_table', 8),
(41, '2022_06_07_100446_create_customers_table', 9),
(42, '2022_06_07_133628_create_products_table', 10),
(43, '2022_06_09_075322_create_products_table', 11),
(44, '2022_06_09_105734_add_pcq_to_products_table', 12),
(45, '2022_06_08_070710_create_purchases_table', 13),
(46, '2022_06_13_073952_create_sales_table', 14),
(47, '2022_06_15_121317_create_product_sales_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\Admin', 1),
(21, 'App\\Models\\Admin', 1),
(22, 'App\\Models\\Admin', 5);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(3, 'product.create', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(4, 'product.view', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(5, 'product.edit', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(6, 'product.delete', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(8, 'user.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(9, 'user.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(10, 'user.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(11, 'user.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(13, 'role.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(14, 'role.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(15, 'role.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(16, 'role.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(20, 'supplier.create', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(21, 'supplier.view', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(22, 'supplier.edit', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(23, 'supplier.delete', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(24, 'customer.create', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(25, 'customer.view', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(26, 'customer.edit', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(27, 'customer.delete', 'admin', 'people', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(28, 'warehouse.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(29, 'warehouse.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(30, 'warehouse.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(31, 'warehouse.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(32, 'brand.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(33, 'brand.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(34, 'brand.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(35, 'brand.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(36, 'customergroup.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(37, 'customergroup.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(38, 'customergroup.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(39, 'customergroup.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(40, 'unit.create', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(41, 'unit.view', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(42, 'unit.edit', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(43, 'unit.delete', 'admin', 'sitting', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(44, 'catagory.create', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(45, 'catagory.view', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(46, 'catagory.edit', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(47, 'catagory.delete', 'admin', 'product', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(48, 'sale.create', 'admin', 'sale', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(49, 'sale.view', 'admin', 'sale', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(50, 'sale.edit', 'admin', 'sale', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(51, 'sale.delete', 'admin', 'sale', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(52, 'salereport.view', 'admin', 'report', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(53, 'purchasereport.view', 'admin', 'report', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(54, 'purchase.create', 'admin', 'purchase', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(55, 'purchase.view', 'admin', 'purchase', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(56, 'purchase.edit', 'admin', 'purchase', '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(57, 'purchase.delete', 'admin', 'purchase', '2020-07-25 10:43:33', '2020-07-25 10:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sale_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_purchase_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_catagory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_feature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `product_different_warehouse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `product_add_warehouse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `product_detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_warehouse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_warehouse_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `product_promotional_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `product_promotional_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_promotional_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_code`, `product_img`, `product_unit`, `product_sale_unit`, `product_purchase_unit`, `product_brand`, `product_catagory`, `product_cost`, `product_price`, `product_method`, `product_feature`, `product_different_warehouse`, `product_add_warehouse`, `product_detail`, `product_warehouse`, `product_warehouse_price`, `product_promotional_price`, `product_promotional_start`, `product_promotional_end`, `created_at`, `updated_at`, `product_quantity`) VALUES
(4, 'Judith Oliver', 'dxXtmjS9', '1656012533.jpg', 'Cailin Walsh', 'Cailin Walsh', 'Cailin Walsh', '16', '15', 'Ipsa cillum eum ame', '233', 'Consectetur sit fa', 'dxXtmjS9', 'yes', 'yes', 'Odio quis aut sunt i.zx', '9', '260', '478', '2005-02-10', '2001-12-03', '2022-06-23 18:28:53', '2022-06-28 09:51:08', '397'),
(5, 'Ignatius Hood', 'F5XRGBTi', '1656414059.png', 'khan', 'khan', 'khan', '16', '10', 'Hic ratione occaecat', '102', 'Voluptatem molestiae', 'yes', 'yes', 'yes', NULL, '9', '234', '13', '2022-06-23', '2022-07-01', '2022-06-28 10:00:59', '2022-06-28 10:00:59', '108'),
(6, 'Jolene May', '0AaKJ4S3', '1656424208.PNG', 'Cailin Walsh', 'Cailin Walsh', 'Cailin Walsh', '16', '12', 'Sit quis fugiat qui', '486', 'Voluptatem facilis', 'yes', 'yes', 'yes', NULL, '9', '12', '206', '1997-10-04', '1982-11-12', '2022-06-28 12:50:08', '2022-06-28 12:50:08', '321');

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` bigint(255) NOT NULL,
  `sale_id` int(255) DEFAULT NULL,
  `product_id` int(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_qty` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_unit_price` varchar(255) DEFAULT NULL,
  `product_total_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) DEFAULT 0,
  `item` int(11) DEFAULT NULL,
  `total_qty` double DEFAULT NULL,
  `total_discount` double DEFAULT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `total_cost` double DEFAULT NULL,
  `order_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `due_ammount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_note` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `warehouse_id`, `type`, `supplier_id`, `item`, `total_qty`, `total_discount`, `customer_id`, `total_cost`, `order_discount`, `shipping_cost`, `grand_total`, `due_ammount`, `paid_amount`, `payment_status`, `document`, `note`, `staf_note`, `order_status`, `created_at`, `updated_at`) VALUES
(1, '1', 9, 'purchase', 12, 1, 176, NULL, NULL, 880, '1', '34', 871.2, '871.2', NULL, 2, '1656942418.jpg', 'Culpa dolor enim tem', NULL, NULL, '2022-07-04', '2022-07-04 12:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(255) DEFAULT NULL,
  `product_id` int(255) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_unit_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avaiable_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `purchase_id`, `product_id`, `name`, `code`, `qty`, `net_unit_cost`, `total`, `created_at`, `updated_at`, `avaiable_stock`, `sale_price`) VALUES
(1, 1, 5, 'Ignatius Hood', NULL, '176', '5', '880', '2022-07-04 12:46:58', '2022-07-04 12:46:58', '176', '480');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'Admin', 'admin', '2020-08-13 09:44:25', '2020-08-14 02:10:53'),
(7, 'Client', 'admin', '2020-09-20 10:44:27', '2020-09-20 10:44:27'),
(21, 'all', 'admin', '2022-07-01 13:37:27', '2022-07-01 13:37:27'),
(22, 'vendor', 'admin', '2022-07-01 23:27:46', '2022-07-04 05:27:52'),
(23, 'snasd', 'admin', '2022-07-01 23:38:46', '2022-07-01 23:38:46'),
(24, 'jjblk', 'admin', '2022-07-02 00:14:17', '2022-07-02 00:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 6),
(1, 7),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(3, 6),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(4, 6),
(4, 7),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(5, 6),
(5, 22),
(5, 23),
(5, 24),
(6, 6),
(6, 22),
(6, 23),
(6, 24),
(8, 6),
(8, 23),
(8, 24),
(9, 6),
(9, 23),
(9, 24),
(10, 6),
(10, 23),
(10, 24),
(11, 6),
(11, 23),
(11, 24),
(13, 6),
(13, 23),
(13, 24),
(14, 6),
(14, 7),
(14, 23),
(14, 24),
(15, 6),
(15, 23),
(15, 24),
(16, 6),
(16, 23),
(16, 24),
(20, 6),
(20, 22),
(20, 23),
(20, 24),
(21, 6),
(21, 22),
(21, 23),
(21, 24),
(22, 6),
(22, 22),
(22, 23),
(22, 24),
(23, 6),
(23, 22),
(23, 23),
(23, 24),
(24, 6),
(24, 23),
(24, 24),
(25, 6),
(25, 23),
(25, 24),
(26, 6),
(26, 23),
(26, 24),
(27, 6),
(27, 23),
(27, 24),
(28, 6),
(28, 23),
(28, 24),
(29, 6),
(29, 23),
(29, 24),
(30, 6),
(30, 23),
(30, 24),
(31, 6),
(31, 23),
(31, 24),
(32, 6),
(32, 23),
(32, 24),
(33, 6),
(33, 23),
(33, 24),
(34, 6),
(34, 23),
(34, 24),
(35, 6),
(35, 23),
(35, 24),
(36, 6),
(36, 23),
(36, 24),
(37, 6),
(37, 23),
(37, 24),
(38, 6),
(38, 23),
(38, 24),
(39, 6),
(39, 23),
(39, 24),
(40, 6),
(40, 23),
(40, 24),
(41, 6),
(41, 23),
(41, 24),
(42, 6),
(42, 23),
(42, 24),
(43, 6),
(43, 23),
(43, 24),
(44, 6),
(44, 22),
(44, 23),
(44, 24),
(45, 6),
(45, 22),
(45, 23),
(45, 24),
(46, 6),
(46, 22),
(46, 23),
(46, 24),
(47, 6),
(47, 21),
(47, 22),
(47, 23),
(47, 24),
(48, 6),
(48, 23),
(48, 24),
(49, 6),
(49, 23),
(49, 24),
(50, 6),
(50, 23),
(50, 24),
(51, 6),
(51, 23),
(51, 24),
(52, 6),
(52, 24),
(53, 6),
(53, 24),
(54, 6),
(55, 6),
(56, 6),
(57, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `total_qty` double DEFAULT NULL,
  `total_discount` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `total_cost` double DEFAULT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company_name`, `vat_number`, `email`, `phone`, `address`, `city`, `state`, `p_code`, `country`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Chaim Burt', 'Rollins Fuentes Traders', '864', 'mufon@mailinator.com', '16', 'Dolore qui consequun', 'Temporibus laboriosa', 'Non dignissimos ipsa', 'Esse rerum optio ar', 'Sint quo est vel sim', '1655845465.png', '2022-06-21 20:04:05', '2022-06-21 20:04:25'),
(6, 'Dustin Clark', 'Parrish Kim LLC', '781', 'dozyqafuqa@mailinator.com', '9', 'Voluptate ullam quid', 'Doloribus ipsum sed', 'Blanditiis natus et', 'Velit accusantium ar', 'Consequatur quia ip', '1656338664.PNG', '2022-06-27 13:04:24', '2022-06-27 13:04:24'),
(7, 'Ivan Wyatt', 'Fleming Bell Associates', '649', 'wovutajyw@mailinator.com', '53', 'Qui debitis at est m', 'Tempore sint persp', 'Rerum qui id occaeca', 'Nulla non ullamco in', 'Omnis quidem aut dol', '1656338727.png', '2022-06-27 13:05:27', '2022-06-27 13:05:27'),
(12, 'Nolan Travis', 'Robertson Pollard Inc', '990', 'sywi@mailinator.com', '67', 'Provident vitae vel', 'Consectetur iste se', 'Consectetur dolore', 'Eum facere sed lauda', 'Quibusdam commodo od', '1656400522.jpg', '2022-06-28 06:15:22', '2022-06-28 06:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `unit_status`, `created_at`, `updated_at`) VALUES
(3, 'Porro quis autem sun', 'khan', '0', '2022-06-07 09:08:14', '2022-06-07 09:08:14'),
(5, 'Possimus cillum bla', 'Leandra Gayd', '0', '2022-06-07 09:08:34', '2022-06-07 09:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maniruzzaman Akash', 'manirujjamanakash@gmail.com', NULL, '$2y$10$/WuShlzx6A2xlSdg521Uj./pHpEGB04rB/toeltFTQQnFsR6MY/eG', NULL, '2020-07-25 10:43:33', '2020-07-25 10:43:33'),
(3, 'test2', 'admin@akijfood.com', NULL, '$2y$10$/4YK7i2fVqdTfm0WAJM3lOnApbJx4w9vxUBZyjN3HqBTnV0zmcwO.', NULL, '2020-08-14 02:28:22', '2020-08-14 03:07:31'),
(8, 'admin@gmail.com', '12345678@gmail.com', NULL, '$2y$10$ZRWTIKwtLudwRI9XFwcPVuBhDtCt2GTGvhVPw.vQ0i07mV5lJ.Hsa', NULL, '2022-06-05 21:25:43', '2022-06-05 21:25:43'),
(9, 'admin@gmail.com', 'callcenter@gmail.com', NULL, '$2y$10$awqzwYjJ3gWgVxkKyPV1Ku2cxpUQMyI2iMBzeK5opYEBwbS7Zzmx2', NULL, '2022-06-05 21:32:34', '2022-06-05 21:38:41'),
(10, 'sa', 'calqwlcessssssssnter@gmail.com', NULL, '$2y$10$Nzad/ci/XsD2P6v..tsMAO69Y2e.gHuQujhAWBKH6rE5.wcic2saK', NULL, '2022-06-05 21:36:05', '2022-06-05 21:57:24'),
(11, 'qwq', 'wqwq@gmail.com', NULL, '$2y$10$gsj5HB2D01cIWw1HqS7z8uNycVg3clBQjxLIP4x4trkoGmDMr52P2', NULL, '2022-06-05 21:58:08', '2022-06-05 21:58:08'),
(12, 'asd', 'aa@gmail.com', NULL, '$2y$10$yUMjAsfz4v5v484Vp/NMfetrsj./kf1MTDfANOtgmgnTdWMiICyJq', NULL, '2022-06-05 22:10:10', '2022-06-05 22:10:10'),
(13, 'khanjee', 'superadmin@example.com', NULL, '$2y$10$1SFY4x1ObSQBUzQUQO3kWO.fd2mqXXnMgCJO/mGzAgpAc4qCzd2pG', NULL, '2022-06-05 22:20:25', '2022-06-05 22:20:25'),
(14, '123456@example.com', '123456@gmail.com', NULL, '$2y$10$RDXeBrqAo4MdWoe38JEWbuHtolpCDNrhyE3gVtZl3wQmBj4RyYdwq', NULL, '2022-06-05 22:25:26', '2022-06-05 22:26:05'),
(15, '123456@example.com', '12@gmailcom', NULL, '$2y$10$i50NPQxJcj8WuDo7kB2tfO7jHizwv6LhXXABm13tucKiexcpz98Eq', NULL, '2022-06-05 22:26:49', '2022-06-05 22:26:49'),
(16, '123456@example.com', '123456@example.com', NULL, '$2y$10$ZoA5xL2QWbQ4mmmPF2JGIOB1IdsqLi5jy.28ZRXO7c7Dt5OYjYCAi', NULL, '2022-06-05 22:32:22', '2022-06-05 22:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `ware_houses`
--

CREATE TABLE `ware_houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wareh_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wareh_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wareh_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wareh_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wareh_stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `wareh_quantiy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `wareh_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ware_houses`
--

INSERT INTO `ware_houses` (`id`, `wareh_name`, `wareh_email`, `wareh_phone`, `wareh_address`, `wareh_stock`, `wareh_quantiy`, `wareh_status`, `created_at`, `updated_at`) VALUES
(9, 'Penelope Willis', 'wikibug@mailinator.com', '+1 (995) 502-4046', 'Magnam doloribus aut', '38', 'hexasyla', 0, '2022-06-07 11:09:31', '2022-06-07 11:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `ware_houses`
--
ALTER TABLE `ware_houses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ware_houses_wareh_email_unique` (`wareh_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ware_houses`
--
ALTER TABLE `ware_houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
