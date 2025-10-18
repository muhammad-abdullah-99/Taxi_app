-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 03:10 PM
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
-- Database: `server_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alahdas`
--

CREATE TABLE `alahdas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `archive` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alahdas`
--

INSERT INTO `alahdas` (`id`, `name`, `description`, `count`, `archive`, `created_at`, `updated_at`, `user_name`) VALUES
(1, 'بنك الرياض', 'اجهزة نقاط بيع', '15', NULL, '2025-04-08 21:30:46', '2025-07-06 10:58:22', 'admin'),
(2, 'بنك الراجحي', 'اجهزة نقاط بيع', '19', NULL, '2025-04-11 17:01:45', '2025-07-06 10:54:54', 'admin'),
(3, 'البنك الاهلي', 'اجهزة نقاط بيع', '28', NULL, '2025-04-11 17:05:19', '2025-04-11 18:03:24', 'admin'),
(4, 'بنك الرياض', 'أجهزة نقاط بيع', '1', NULL, '2025-06-13 19:58:29', '2025-06-13 19:58:29', 'ابو طلال ');

-- --------------------------------------------------------

--
-- Table structure for table `alahda_counts`
--

CREATE TABLE `alahda_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alahda_id` bigint(20) UNSIGNED DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alahda_counts`
--

INSERT INTO `alahda_counts` (`id`, `alahda_id`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 1, '0000150410PT1027837', '2025-04-08 21:30:46', '2025-04-08 21:30:46'),
(2, 1, '0000150410PT1027838', '2025-04-08 21:30:46', '2025-04-08 21:30:46'),
(3, 1, '0000150410PT1027832', '2025-04-08 21:30:46', '2025-04-08 21:30:46'),
(4, 1, '0000150410PT1027844', '2025-04-08 21:30:46', '2025-04-08 21:30:46'),
(5, 1, '0000150410PT1033692', '2025-04-11 16:52:45', '2025-04-11 16:52:45'),
(6, 1, '0000150410PT1027846', '2025-04-11 16:52:45', '2025-04-11 16:52:45'),
(7, 1, '0000150410PT1027829', '2025-04-11 16:52:45', '2025-04-11 16:52:45'),
(8, 1, '0000150410PT1027831', '2025-04-11 16:52:45', '2025-04-11 16:52:45'),
(9, 1, '0000150410PT1033689', '2025-04-11 16:52:45', '2025-04-11 16:52:45'),
(10, 2, '63898233', '2025-04-11 17:01:45', '2025-04-11 17:01:45'),
(11, 2, '63898255', '2025-04-11 17:01:46', '2025-04-11 17:01:46'),
(12, 2, '63898241', '2025-04-11 17:01:46', '2025-04-11 17:01:46'),
(13, 2, '63898299', '2025-04-11 17:01:46', '2025-04-11 17:01:46'),
(14, 2, '63898263', '2025-04-11 17:01:46', '2025-04-11 17:01:46'),
(15, 3, 'N7A805322466', '2025-04-11 17:05:19', '2025-04-11 17:05:19'),
(16, 3, '00023815239', '2025-04-11 17:14:14', '2025-04-11 17:14:14'),
(17, 3, '00023819007', '2025-04-11 17:14:14', '2025-04-11 17:14:14'),
(18, 3, '00023815228', '2025-04-11 17:14:14', '2025-04-11 17:14:14'),
(19, 3, '00023819017', '2025-04-11 17:16:53', '2025-04-11 17:16:53'),
(20, 3, '00023819011', '2025-04-11 17:16:53', '2025-04-11 17:16:53'),
(21, 3, '00023818469', '2025-04-11 17:16:53', '2025-04-11 17:16:53'),
(22, 3, '00023819006', '2025-04-11 17:16:53', '2025-04-11 17:16:53'),
(23, 3, '00023818472', '2025-04-11 17:16:53', '2025-04-11 17:16:53'),
(24, 3, '00023818476', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(25, 3, '00023815230', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(26, 3, '00023815236', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(27, 3, '00023818856', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(28, 3, '00023815234', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(29, 3, '00023819021', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(30, 3, '00023819018', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(31, 3, '00023815229', '2025-04-11 17:28:58', '2025-04-11 17:28:58'),
(32, 3, 'N7A805322468', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(33, 3, '00023818466', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(34, 3, '00023818480', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(35, 3, '00023818479', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(36, 3, '00023818470', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(37, 3, 'N7A805326469', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(38, 3, '00023819012', '2025-04-11 17:41:33', '2025-04-11 17:41:33'),
(39, 3, '00023815241', '2025-04-11 18:03:24', '2025-04-11 18:03:24'),
(40, 3, '00023815231', '2025-04-11 18:03:24', '2025-04-11 18:03:24'),
(41, 3, '00023815240', '2025-04-11 18:03:24', '2025-04-11 18:03:24'),
(42, 3, '00023815235', '2025-04-11 18:03:24', '2025-04-11 18:03:24'),
(43, 2, '63898251', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(44, 2, '63898279', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(45, 2, '63898287', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(46, 2, '63898217', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(47, 2, '63898213', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(48, 2, '63898244', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(49, 2, '63898267', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(50, 2, '63898291', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(51, 2, '63898259', '2025-04-12 18:07:22', '2025-04-12 18:07:22'),
(52, 1, '0000150410PT1027845', '2025-04-19 15:32:48', '2025-04-19 15:32:48'),
(54, 1, '0000150410PT1027842', '2025-04-19 19:41:07', '2025-04-19 19:41:07'),
(55, 1, '0000150410PT1033693', '2025-04-19 19:51:47', '2025-04-19 19:51:47'),
(56, 1, '0000150410PT1033691', '2025-04-19 22:02:54', '2025-04-19 22:02:54'),
(57, 4, '11733543', '2025-06-13 19:58:29', '2025-06-13 19:58:29'),
(58, 1, '0000150410PT1027835', '2025-06-14 14:11:53', '2025-06-14 14:11:53'),
(59, 2, '63898295', '2025-07-06 10:54:54', '2025-07-06 10:54:54'),
(60, 2, '63898275', '2025-07-06 10:54:54', '2025-07-06 10:54:54'),
(61, 2, '63898227', '2025-07-06 10:54:54', '2025-07-06 10:54:54'),
(62, 2, '63898283', '2025-07-06 10:54:54', '2025-07-06 10:54:54'),
(63, 2, '63898271', '2025-07-06 10:54:54', '2025-07-06 10:54:54'),
(64, 1, '0000150410PT1027834', '2025-07-06 10:58:22', '2025-07-06 10:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `id_image` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `license_image_url` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `driving_license` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `otp_expires_at` varchar(255) DEFAULT NULL,
  `driver_image` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `accept_driver` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `email`, `image`, `mobile`, `user_type`, `id_image`, `id_number`, `license_image_url`, `status`, `address`, `country`, `otp`, `driving_license`, `bank_account`, `device_token`, `otp_expires_at`, `driver_image`, `city`, `created_at`, `updated_at`, `user_name`, `accept_driver`) VALUES
(1, 'guest', NULL, NULL, 'guest', 'Driver', NULL, 'guest', NULL, '1', NULL, NULL, '1853', NULL, NULL, NULL, '2025-10-14 08:26:16', NULL, NULL, '2025-03-08 13:14:28', '2025-10-14 05:17:11', NULL, NULL),
(32, 'ابو احمد 2', NULL, NULL, '050000000', 'Driver', 'drivers/ids/1748509742_id_scaled_1000333077.png', '011', 'drivers/licenses/1748509742_license_scaled_1000333076.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-06 16:48:21', 'drivers/driver/1748509742_driver_scaled_1000333076.png', NULL, '2025-05-29 09:09:02', '2025-09-06 16:44:45', 'ابو احمد', '2025-09-03 11:49:45'),
(40, 'عبدالحميد يحيى حكيم محمد', NULL, NULL, '0560022883', 'Driver', 'drivers/ids/1748942969_id_scaled_٢٠٢٥٠٦٠٣_١٢٢٩٠٥.jpg', '2222552255', 'drivers/licenses/1748942969_license_scaled_٢٠٢٥٠٦٠٣_١٢٢٩٠٥.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-08 22:35:37', 'drivers/driver/1748942969_driver_scaled_٢٠٢٥٠٦٠٣_١٢٢٩٠٥.jpg', NULL, '2025-06-03 09:29:29', '2025-08-23 18:48:23', 'ابو احمد', '2025-06-11 07:19:46'),
(58, 'عاصم محمد عبد الغني ارمان', NULL, NULL, '0562325561', 'Driver', 'drivers/ids/1749584948_id_scaled_IMG20250530172610.jpg', '2603288669', 'drivers/licenses/1749584948_license_scaled_Screenshot_2025-05-25-00-10-04-32_d6e10733512221ae97819594ecf602d6.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-01 19:27:49', 'drivers/driver/1749584948_driver_scaled_Screenshot_2025-06-10-22-31-25-15_e2d5b3f32b79de1d45acd1fad96fbb0f.jpg', NULL, '2025-06-10 19:49:08', '2025-09-01 19:18:03', 'ابو احمد', '2025-08-24 20:50:25'),
(62, 'Ahmed Tharwat😎', NULL, NULL, '0555428981', 'Driver', 'drivers/ids/1749664666_id_scaled_1000344389.png', '1234567890', 'drivers/licenses/1749664666_license_scaled_1000344389.png', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 09:09:39', 'drivers/driver/1749664666_driver_scaled_1000344389.png', NULL, '2025-06-11 17:57:46', '2025-08-25 09:00:01', 'ابو احمد', '2025-06-22 17:16:51'),
(65, 'Ahmed Tharwat😎', NULL, NULL, '0555428984', 'Driver', 'drivers/ids/1749665475_id_scaled_1000343946.jpg', '8806743440', 'drivers/licenses/1749665475_license_scaled_1000344389.png', '2', NULL, NULL, '2062', NULL, NULL, NULL, '2025-06-14 18:58:52', 'drivers/driver/1749665475_driver_scaled_1000344389.png', NULL, '2025-06-11 18:11:15', '2025-06-14 18:48:52', 'ابو احمد', '2025-06-14 15:34:49'),
(66, 'islam', NULL, NULL, '0512345678', 'Driver', NULL, '12345678', NULL, '2', NULL, NULL, '1111', NULL, NULL, NULL, '2025-09-18 07:16:11', NULL, NULL, '2025-06-11 19:04:37', '2025-09-18 07:06:11', 'ابو احمد', '2025-06-20 10:29:21'),
(67, 'ahmed', NULL, NULL, '0512345677', 'Driver', NULL, '12345677', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 19:04:37', '2025-06-11 19:04:37', NULL, NULL),
(68, 'عبدالله عريف محمد عريف', NULL, NULL, '0502562715', 'Driver', 'drivers/ids/1749756983_id_scaled_1000486383.jpg', '2400167678', 'drivers/licenses/1749756983_license_scaled_1000486323.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-05 18:07:05', 'drivers/driver/1749756983_driver_scaled_1000486326.jpg', NULL, '2025-06-12 19:36:23', '2025-09-05 17:57:14', 'ابو احمد', '2025-08-23 22:07:43'),
(69, 'Ahmed Tharwat😎', NULL, NULL, '0536404810', 'Driver', 'drivers/ids/1749760161_id_scaled_1000765402.jpg', '5661078445', 'drivers/licenses/1749760161_license_scaled_1000765405.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749760161_driver_scaled_1000670345.jpg', NULL, '2025-06-12 20:29:21', '2025-06-12 20:29:21', NULL, NULL),
(70, 'كامران خاشي محمد خاشي', NULL, NULL, '0537088904', 'Driver', 'drivers/ids/1749760731_id_scaled_1000029848.jpg', '2545963999', 'drivers/licenses/1749760731_license_scaled_1001543429.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:27:00', 'drivers/driver/1749760731_driver_scaled_1001463049.jpg', NULL, '2025-06-12 20:38:51', '2025-08-23 18:51:29', 'ابو احمد', '2025-06-14 15:49:40'),
(71, 'محمد اقبال التنس اقبال', NULL, NULL, '0560586213', 'Driver', 'drivers/ids/1749760923_id_scaled_1001383896.jpg', '2545029171', 'drivers/licenses/1749760923_license_scaled_1001246144.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 16:24:01', 'drivers/driver/1749760923_driver_scaled_1001246141.jpg', NULL, '2025-06-12 20:42:03', '2025-08-23 18:53:29', 'ابو احمد', '2025-06-14 16:02:09'),
(72, 'شاه زاب محمود خالد خالد', NULL, NULL, '0591789865', 'Driver', 'drivers/ids/1749762407_id_scaled_1000023294.jpg', '2540700370', 'drivers/licenses/1749762407_license_scaled_1000227200.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749762407_driver_scaled_1000463638.jpg', NULL, '2025-06-12 21:06:47', '2025-06-14 16:11:19', NULL, NULL),
(73, 'محمد زام غلام قدير', NULL, NULL, '0537524408', 'Driver', 'drivers/ids/1749763966_id_scaled_1000621048.jpg', '2546768280', 'drivers/licenses/1749763966_license_scaled_1001022587.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749763966_driver_scaled_1001022590.jpg', NULL, '2025-06-12 21:32:46', '2025-06-14 16:16:32', NULL, NULL),
(74, 'Ahmed Tharwat😎', NULL, NULL, '0549430219', 'Driver', 'drivers/ids/1749774782_id_scaled_1000039736.jpg', '7093873620', 'drivers/licenses/1749774782_license_scaled_4be29705-38e6-4ef9-a7ba-accd7a8a5532-1_all_29.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749774782_driver_scaled_1000064705.jpg', NULL, '2025-06-13 00:33:02', '2025-06-13 00:33:02', NULL, NULL),
(75, 'Ahmed Tharwat😎', NULL, NULL, '0563685825', 'Driver', 'drivers/ids/1749794279_id_scaled_1000190358.jpg', '3515787294', 'drivers/licenses/1749794279_license_scaled_1000525620.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749794279_driver_scaled_1000525625.jpg', NULL, '2025-06-13 05:57:59', '2025-06-13 05:57:59', NULL, NULL),
(76, 'طلعت محبوب محبوب خالد', NULL, NULL, '0580419242', 'Driver', 'drivers/ids/1749804969_id_scaled_1000565537.jpg', '2566734071', 'drivers/licenses/1749804969_license_scaled_1000725014.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749804969_driver_scaled_1000999815.jpg', NULL, '2025-06-13 08:56:09', '2025-06-14 16:55:56', NULL, NULL),
(77, 'برويز اختر فلك شير', NULL, NULL, '0582565938', 'Driver', 'drivers/ids/1749811465_id_scaled_1747329738612.jpg', '2526523713', 'drivers/licenses/1749811465_license_scaled_Screenshot_20241016-084803.png', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-23 21:28:57', 'drivers/driver/1749811465_driver_scaled_Screenshot_20250226-221853.png', NULL, '2025-06-13 10:44:25', '2025-08-23 21:19:22', 'ابو احمد', '2025-08-23 19:48:09'),
(78, 'برويز اختر فلك شير', NULL, NULL, '0539106300', 'Driver', 'drivers/ids/1749812348_id_scaled_1747329738612.jpg', '2526532713', 'drivers/licenses/1749812348_license_scaled_Screenshot_20241016-084803.png', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749812348_driver_scaled_Screenshot_20250226-221853.png', NULL, '2025-06-13 10:59:08', '2025-08-24 21:46:30', 'ابو احمد', '2025-08-24 21:46:30'),
(79, 'جنيد حسن فدا حسين', NULL, NULL, '0510932296', 'Driver', 'drivers/ids/1749815940_id_scaled_1000171178.jpg', '2422304515', 'drivers/licenses/1749815940_license_scaled_1000171179.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749815940_driver_scaled_1000171180.jpg', NULL, '2025-06-13 11:59:00', '2025-06-14 16:58:00', NULL, NULL),
(80, 'علي رازان يار احمد', NULL, NULL, '0553177291', 'Driver', 'drivers/ids/1749816070_id_scaled_1000505150.jpg', '2572575948', 'drivers/licenses/1749816070_license_scaled_1000505151.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749816070_driver_scaled_1000505152.jpg', NULL, '2025-06-13 12:01:10', '2025-06-14 19:01:21', NULL, NULL),
(81, 'غول فراز خان غولزار خان', NULL, NULL, '0581715582', 'Driver', 'drivers/ids/1749816234_id_scaled_1000280127.jpg', '2570667168', 'drivers/licenses/1749816234_license_scaled_1000090220.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749816234_driver_scaled_1000126718.jpg', NULL, '2025-06-13 12:03:54', '2025-06-18 15:33:52', NULL, NULL),
(82, 'محمد ذو القرنيين طاهر طاهر محمود', NULL, NULL, '0571745665', 'Driver', 'drivers/ids/1749816871_id_scaled_1000251830.png', '2519264234', 'drivers/licenses/1749816871_license_scaled_1000251831.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749816871_driver_scaled_1000250258.jpg', NULL, '2025-06-13 12:14:31', '2025-06-14 18:54:57', NULL, NULL),
(83, 'محمد اصف محمد كرم', NULL, NULL, '0538902116', 'Driver', 'drivers/ids/1749817201_id_scaled_1000000099.jpg', '2163556521', 'drivers/licenses/1749817201_license_scaled_1000019290.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-18 09:14:07', 'drivers/driver/1749817201_driver_scaled_1000108325.jpg', NULL, '2025-06-13 12:20:01', '2025-08-23 18:53:34', 'ابو طلال ', '2025-06-14 18:41:48'),
(84, 'Ahmed Tharwat😎', NULL, NULL, '0595224270', 'Driver', 'drivers/ids/1749817502_id_scaled_1000503927.jpg', '6464336588', 'drivers/licenses/1749817502_license_scaled_1000727587.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749817502_driver_scaled_1000727587.jpg', NULL, '2025-06-13 12:25:02', '2025-06-13 12:25:02', NULL, NULL),
(85, 'امتياز احمد شامير خان', NULL, NULL, '0568864221', 'Driver', 'drivers/ids/1749817638_id_scaled_1000665753.jpg', '2537927499', 'drivers/licenses/1749817638_license_scaled_1000744390.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749817638_driver_scaled_1001184600.jpg', NULL, '2025-06-13 12:27:18', '2025-06-14 18:32:42', NULL, NULL),
(86, 'سلمان محمد نعيم', NULL, NULL, '0508924204', 'Driver', 'drivers/ids/1749817686_id_scaled_1000022556.jpg', '2521895215', 'drivers/licenses/1749817686_license_scaled_1000022555.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749817686_driver_scaled_1000022561.jpg', NULL, '2025-06-13 12:28:06', '2025-08-23 18:54:15', 'ابو احمد', '2025-06-22 17:28:54'),
(87, 'سهيل شهزاد اشرف محمد', NULL, NULL, '0543751361', 'Driver', 'drivers/ids/1749817829_id_scaled_1000044460.jpg', '2489401089', 'drivers/licenses/1749817829_license_scaled_1000044461.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749817829_driver_scaled_1000113586.jpg', NULL, '2025-06-13 12:30:29', '2025-06-14 18:19:00', NULL, NULL),
(88, 'شعيب احمد سعيد احمد', NULL, NULL, '0593257263', 'Driver', 'drivers/ids/1749818496_id_scaled_1000369942.jpg', '2560766582', 'drivers/licenses/1749818496_license_scaled_1000369943.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749818496_driver_scaled_1000369943.jpg', NULL, '2025-06-13 12:41:36', '2025-06-14 18:28:01', NULL, NULL),
(89, 'بلال على على حسين', NULL, NULL, '0509573718', 'Driver', 'drivers/ids/1749819915_id_scaled_1000559436.jpg', '2490800527', 'drivers/licenses/1749819915_license_scaled_1000559436.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749819915_driver_scaled_1000559437.jpg', NULL, '2025-06-13 13:05:15', '2025-06-14 18:24:10', NULL, NULL),
(90, 'Ahmed Tharwat😎', NULL, NULL, '0581261342', 'Driver', 'drivers/ids/1749820451_id_scaled_1000362577.jpg', '9224354966', 'drivers/licenses/1749820451_license_scaled_1000362579.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749820451_driver_scaled_1000362575.jpg', NULL, '2025-06-13 13:14:11', '2025-06-13 13:14:11', NULL, NULL),
(91, 'اسعد رو ريمان محمد رمزان', NULL, NULL, '0562279980', 'Driver', 'drivers/ids/1749821002_id_scaled_1001063089.jpg', '2582180853', 'drivers/licenses/1749821002_license_scaled_1001063090.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749821002_driver_scaled_1001063091.jpg', NULL, '2025-06-13 13:23:22', '2025-06-14 18:49:17', NULL, NULL),
(92, 'فتيح الله خان عبد الحنان خان', NULL, NULL, '0538675918', 'Driver', 'drivers/ids/1749821544_id_scaled_1000396259.jpg', '2560765014', 'drivers/licenses/1749821544_license_scaled_1000396258.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749821544_driver_scaled_1000429703.jpg', NULL, '2025-06-13 13:32:24', '2025-06-14 18:13:04', NULL, NULL),
(93, 'محمد مالك نزير احمد', NULL, NULL, '0595302190', 'Driver', 'drivers/ids/1749822064_id_scaled_1001655938.jpg', '2255337202', 'drivers/licenses/1749822064_license_scaled_1001655938.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749822064_driver_scaled_1001723841.jpg', NULL, '2025-06-13 13:41:04', '2025-08-23 18:54:19', 'ابو طلال ', '2025-06-14 18:02:24'),
(94, 'محمد روخسار سعيد احمد', NULL, NULL, '0507060569', 'Driver', 'drivers/ids/1749822423_id_scaled_1000360145.jpg', '2531783153', 'drivers/licenses/1749822423_license_scaled_1000360146.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-23 09:30:41', 'drivers/driver/1749822423_driver_scaled_1000360143.jpg', NULL, '2025-06-13 13:47:03', '2025-08-23 18:54:22', 'ابو طلال ', '2025-06-14 17:55:14'),
(95, 'غلام قمر رجاء محمد اكتار', NULL, NULL, '0592771189', 'Driver', 'drivers/ids/1749827158_id_scaled_1002195968.jpg', '0', 'drivers/licenses/1749827158_license_scaled_1001380363.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-04 20:39:36', 'drivers/driver/1749827158_driver_scaled_1001206514.jpg', NULL, '2025-06-13 15:05:58', '2025-10-04 20:29:48', 'ابو طلال ', '2025-06-18 16:26:15'),
(96, 'Ahmed Tharwat😎', NULL, NULL, '0546185807', 'Driver', 'drivers/ids/1749838119_id_scaled_1000579134.jpg', '4030556518', 'drivers/licenses/1749838119_license_scaled_1000579372.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749838119_driver_scaled_1000579313.jpg', NULL, '2025-06-13 18:08:39', '2025-06-14 20:17:45', 'ابو احمد', '2025-06-14 20:17:45'),
(97, 'اقدس حسين محمد حسين ظفار', NULL, NULL, '0574896486', 'Driver', 'drivers/ids/1749845166_id_scaled_1000045117.jpg', '2590021859', 'drivers/licenses/1749845166_license_scaled_19cee665-b451-4582-9eb6-fb8a55345388-1_all_41.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749845166_driver_scaled_1000025217.png', NULL, '2025-06-13 20:06:06', '2025-06-14 17:26:59', NULL, NULL),
(98, 'خان سردار قمراباس', NULL, NULL, '0561962398', 'Driver', 'drivers/ids/1749845240_id_scaled_1001116267.jpg', '2079837072', 'drivers/licenses/1749845240_license_scaled_1000731058.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 12:39:41', 'drivers/driver/1749845240_driver_scaled_1001103039.jpg', NULL, '2025-06-13 20:07:20', '2025-08-23 18:54:26', 'ابو طلال ', '2025-06-14 17:16:20'),
(99, 'حفيظ محمد سلمان ظهور احمد', NULL, NULL, '0552477460', 'Driver', 'drivers/ids/1749848867_id_scaled_IMG_20250613_235921.jpg', '2571351358', 'drivers/licenses/1749848867_license_scaled_IMG_20250613_230052.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749848867_driver_scaled_IMG-20250522-WA0025.jpg', NULL, '2025-06-13 21:07:47', '2025-06-14 17:09:57', NULL, NULL),
(100, 'اشفاق احمد نور احمد', NULL, NULL, '0562947429', 'Driver', 'drivers/ids/1749874413_id_scaled_1000025251.jpg', '2427712837', 'drivers/licenses/1749874413_license_scaled_1000080740.jpg', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749874413_driver_scaled_1000081745.jpg', NULL, '2025-06-14 04:13:33', '2025-08-24 21:43:46', 'ابو احمد', '2025-08-24 21:43:46'),
(101, 'سيف الرحمن محمد سليم شهزاد', NULL, NULL, '0564402985', 'Driver', 'drivers/ids/1749912942_id_scaled_1000373938.jpg', '2584776047', 'drivers/licenses/1749912942_license_scaled_1000373941.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749912942_driver_scaled_1000074901.jpg', NULL, '2025-06-14 14:55:42', '2025-06-14 16:59:36', NULL, NULL),
(102, 'islam', NULL, NULL, '0560', 'Passenger', NULL, NULL, NULL, '1', 'any', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 16:41:04', '2025-06-14 16:41:04', NULL, NULL),
(107, 'islam', NULL, NULL, '05605', 'Passenger', NULL, NULL, NULL, '1', 'any', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 16:41:57', '2025-06-14 16:41:57', NULL, NULL),
(127, 'احمد', NULL, NULL, '555', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, '6808', NULL, NULL, NULL, '2025-06-14 17:23:38', NULL, NULL, '2025-06-14 16:55:05', '2025-06-14 17:13:38', NULL, NULL),
(128, 'اااا', NULL, NULL, '58885588', 'Passenger', NULL, NULL, NULL, '1', 'Madina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 16:57:33', '2025-06-14 16:57:33', NULL, NULL),
(129, 'تتتت', NULL, NULL, '22222', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 17:03:39', '2025-06-14 17:03:39', NULL, NULL),
(130, 'محمد', NULL, NULL, '055428985', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, '8137', NULL, NULL, NULL, '2025-06-14 17:28:22', NULL, NULL, '2025-06-14 17:17:21', '2025-06-14 17:18:22', NULL, NULL),
(131, 'عمر', NULL, NULL, '0555428985', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, '2038', NULL, NULL, NULL, '2025-07-06 16:21:12', NULL, NULL, '2025-06-14 17:30:08', '2025-07-06 16:11:12', NULL, NULL),
(132, 'كمال', NULL, NULL, '0555428980', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, '1589', NULL, NULL, NULL, '2025-08-25 07:30:41', NULL, NULL, '2025-06-14 17:32:47', '2025-08-25 07:20:41', NULL, NULL),
(133, 'محمد محمود', NULL, NULL, '0555428987', 'Passenger', NULL, NULL, NULL, '1', 'Madina', NULL, NULL, NULL, NULL, NULL, '2025-07-10 13:00:41', NULL, NULL, '2025-06-14 17:39:13', '2025-07-10 12:50:49', NULL, NULL),
(134, 'محمد', NULL, NULL, '66', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-14 18:03:07', '2025-06-14 18:03:07', NULL, NULL),
(135, 'Ahmed Tharwat😎', NULL, NULL, '0560028119', 'Driver', 'drivers/ids/1749926437_id_scaled_1000601844.jpg', '9173454663', 'drivers/licenses/1749926437_license_scaled_1000598408.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749926437_driver_scaled_1000601844.jpg', NULL, '2025-06-14 18:40:37', '2025-06-14 18:40:37', NULL, NULL),
(136, 'Ahmed Tharwat😎', NULL, NULL, '0567975310', 'Driver', 'drivers/ids/1749926441_id_scaled_1000001351.jpg', '7369475374', 'drivers/licenses/1749926441_license_scaled_1000001348.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749926441_driver_scaled_1000516985.jpg', NULL, '2025-06-14 18:40:41', '2025-06-14 18:40:41', NULL, NULL),
(137, 'Ahmed Tharwat😎', NULL, NULL, '0553108613', 'Driver', 'drivers/ids/1749926498_id_scaled_1003344931.jpg', '7908776204', 'drivers/licenses/1749926498_license_scaled_1003344946.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749926498_driver_scaled_1003344953.jpg', NULL, '2025-06-14 18:41:38', '2025-06-14 18:41:38', NULL, NULL),
(138, 'ناصر', NULL, NULL, '0555428988', 'Passenger', NULL, NULL, NULL, '1', 'Makki', NULL, NULL, NULL, NULL, NULL, '2025-06-18 07:28:13', NULL, NULL, '2025-06-14 18:49:25', '2025-06-18 07:18:44', NULL, NULL),
(139, 'Ahmed Tharwat😎', NULL, NULL, '0598312165', 'Driver', 'drivers/ids/1749927128_id_scaled_1000026773.jpg', '2860247372', 'drivers/licenses/1749927128_license_scaled_1000026772.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749927128_driver_scaled_1000026074.jpg', NULL, '2025-06-14 18:52:08', '2025-06-14 18:52:08', NULL, NULL),
(140, 'وسيم نيام نيام علي', NULL, NULL, '0547608705', 'Driver', 'drivers/ids/1749927268_id_scaled_1000033276.jpg', '2548360094', 'drivers/licenses/1749927268_license_scaled_1000033309.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749927268_driver_scaled_1000033289.jpg', NULL, '2025-06-14 18:54:28', '2025-06-18 15:38:09', NULL, NULL),
(141, 'غضنفرعباس فاروق محمد', NULL, NULL, '0593543143', 'Driver', 'drivers/ids/1749927431_id_scaled_1000063808.jpg', '2529908358', 'drivers/licenses/1749927431_license_scaled_1000064387.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749927431_driver_scaled_1000088239.jpg', NULL, '2025-06-14 18:57:11', '2025-06-18 15:41:49', NULL, NULL),
(142, 'أمجد سليم محمد أسلم', NULL, NULL, '0597373779', 'Driver', 'drivers/ids/1749927516_id_scaled_8624.jpg', '2553695574', 'drivers/licenses/1749927516_license_scaled_13945.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 06:51:12', 'drivers/driver/1749927516_driver_scaled_13946.jpg', NULL, '2025-06-14 18:58:36', '2025-09-14 06:41:32', 'ابو احمد', '2025-08-24 21:21:31'),
(143, 'محمد عبدالله محمد بلال', NULL, NULL, '0543148731', 'Driver', 'drivers/ids/1749927953_id_scaled_1000146551.jpg', '2540369317', 'drivers/licenses/1749927953_license_scaled_1000146552.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749927953_driver_scaled_1000146553.jpg', NULL, '2025-06-14 19:05:53', '2025-06-18 15:50:28', NULL, NULL),
(144, 'Ahmed Tharwat😎', NULL, NULL, '0591360760', 'Driver', 'drivers/ids/1749928049_id_scaled_1000088615.jpg', '4010016517', 'drivers/licenses/1749928049_license_scaled_1000088618.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749928049_driver_scaled_1000088635.heic', NULL, '2025-06-14 19:07:29', '2025-06-14 19:07:29', NULL, NULL),
(145, 'Ahmed Tharwat😎', NULL, NULL, '0531455734', 'Driver', 'drivers/ids/1749928325_id_scaled_1000041736.jpg', '8801385270', 'drivers/licenses/1749928325_license_scaled_1000041733.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749928325_driver_scaled_1000305485.jpg', NULL, '2025-06-14 19:12:05', '2025-06-14 19:12:05', NULL, NULL),
(146, 'Ahmed Tharwat😎', NULL, NULL, '0558203938', 'Driver', 'drivers/ids/1749928348_id_scaled_1000461078.jpg', '5090944723', 'drivers/licenses/1749928348_license_scaled_1000461081.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749928348_driver_scaled_1000461090.jpg', NULL, '2025-06-14 19:12:28', '2025-06-14 19:12:28', NULL, NULL),
(147, 'دانيش رصاف عبد ال رصاف', NULL, NULL, '0545717686', 'Driver', 'drivers/ids/1749928366_id_scaled_1000122678.jpg', '2581849284', 'drivers/licenses/1749928366_license_scaled_1000113518.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749928366_driver_scaled_1000010286.jpg', NULL, '2025-06-14 19:12:46', '2025-06-14 19:45:31', NULL, NULL),
(148, 'محمد ازهار خان  محمد صديق', NULL, NULL, '0592802627', 'Driver', 'drivers/ids/1749928629_id_scaled_1001947056.jpg', '2375877113', 'drivers/licenses/1749928629_license_scaled_1001908956.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-18 16:22:48', 'drivers/driver/1749928629_driver_scaled_1001980271.jpg', NULL, '2025-06-14 19:17:09', '2025-08-23 18:55:24', 'ابو طلال ', '2025-06-18 15:55:40'),
(149, 'وسيم الرحمن عبدالرحمن عبدالرحمن', NULL, NULL, '0597144974', 'Driver', 'drivers/ids/1749928635_id_scaled_1000217418.jpg', '2553696283', 'drivers/licenses/1749928635_license_scaled_1000217426.jpg', NULL, NULL, NULL, '2533', NULL, NULL, NULL, '2025-06-14 21:00:29', 'drivers/driver/1749928635_driver_scaled_1000217432.jpg', NULL, '2025-06-14 19:17:15', '2025-08-23 18:55:34', 'ابو طلال ', '2025-06-14 19:37:40'),
(150, 'بلال احمد نظير احمد', NULL, NULL, '0595547889', 'Driver', 'drivers/ids/1749928753_id_scaled_1001992603.jpg', '2533893703', 'drivers/licenses/1749928753_license_scaled_1001970284.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749928753_driver_scaled_1002017514.jpg', NULL, '2025-06-14 19:19:13', '2025-06-14 19:28:59', NULL, NULL),
(151, 'Ahmed Tharwat😎', NULL, NULL, '0591621120', 'Driver', 'drivers/ids/1749929326_id_scaled_1000005918.jpg', '4450435854', 'drivers/licenses/1749929326_license_scaled_1000005925.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749929326_driver_scaled_1000005925.jpg', NULL, '2025-06-14 19:28:46', '2025-06-14 19:28:46', NULL, NULL),
(152, 'Ahmed Tharwat😎', NULL, NULL, '0580877835', 'Driver', 'drivers/ids/1749929445_id_scaled_Screenshot_20250614_222550_sa.gov.moi.jpg', '2938672496', 'drivers/licenses/1749929445_license_scaled_Screenshot_20250614_222602_sa.gov.moi.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749929445_driver_scaled_IMG_20250614_222917.jpg', NULL, '2025-06-14 19:30:45', '2025-06-14 19:30:45', NULL, NULL),
(153, 'Ahmed Tharwat😎', NULL, NULL, '0593308754', 'Driver', 'drivers/ids/1749930434_id_scaled_1002498392.jpg', '3660263887', 'drivers/licenses/1749930434_license_scaled_1002498395.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749930434_driver_scaled_1002498392.jpg', NULL, '2025-06-14 19:47:14', '2025-06-14 19:47:14', NULL, NULL),
(154, 'Ahmed Tharwat😎', NULL, NULL, '0543238714', 'Driver', 'drivers/ids/1749930650_id_scaled_1000041736.jpg', '6762079403', 'drivers/licenses/1749930650_license_scaled_1000041733.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749930650_driver_scaled_1000286435.jpg', NULL, '2025-06-14 19:50:50', '2025-06-14 19:50:50', NULL, NULL),
(155, 'Ahmed Tharwat😎', NULL, NULL, '0594996264', 'Driver', 'drivers/ids/1749931280_id_scaled_1001525604.jpg', '0917007753', 'drivers/licenses/1749931280_license_scaled_1001525601.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749931280_driver_scaled_1001512377.jpg', NULL, '2025-06-14 20:01:20', '2025-06-14 20:01:20', NULL, NULL),
(156, 'محمد جنيد توفيل رفيق محمد', NULL, NULL, '0564620560', 'Driver', 'drivers/ids/1749931391_id_scaled_1000262022.jpg', '2486823145', 'drivers/licenses/1749931391_license_scaled_1000262025.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749931391_driver_scaled_1000262027.jpg', NULL, '2025-06-14 20:03:11', '2025-08-23 21:18:13', 'ابو احمد', '2025-08-23 21:18:13'),
(157, 'Ahmed Tharwat😎', NULL, NULL, '0562886030', 'Driver', 'drivers/ids/1749931663_id_scaled_1001325396.jpg', '5488240672', 'drivers/licenses/1749931663_license_scaled_1000983983.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749931663_driver_scaled_1000983983.jpg', NULL, '2025-06-14 20:07:43', '2025-06-14 20:07:43', NULL, NULL),
(158, 'معين موستاك كارافنا', NULL, NULL, '0552412706', 'Driver', 'drivers/ids/1749933822_id_scaled_1000038066.png', '2571349493', 'drivers/licenses/1749933822_license_scaled_1000038068.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749933822_driver_scaled_1000038067.png', NULL, '2025-06-14 20:43:42', '2025-06-18 16:05:07', NULL, NULL),
(159, 'Ahmed Tharwat😎', NULL, NULL, '0557515612', 'Driver', 'drivers/ids/1749934357_id_scaled_1000727835.jpg', '3157758919', 'drivers/licenses/1749934357_license_scaled_1000727836.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749934357_driver_scaled_1000727805.jpg', NULL, '2025-06-14 20:52:37', '2025-06-14 20:52:37', NULL, NULL),
(160, 'ارباب ارشد محمد ارشد جافيد', NULL, NULL, '0580074450', 'Driver', 'drivers/ids/1749938020_id_scaled_1001085309.jpg', '2341020028', 'drivers/licenses/1749938020_license_scaled_1001085584.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-24 21:46:46', 'drivers/driver/1749938020_driver_scaled_1001172016.jpg', NULL, '2025-06-14 21:53:40', '2025-08-24 21:37:02', 'ابو احمد', '2025-08-24 21:26:13'),
(161, 'محمد كامل محمد قطب الدين جمال الميمني', NULL, NULL, '0572491353', 'Driver', 'drivers/ids/1749963191_id_scaled_Screenshot_20250615_074944_WhatsAppBusiness.jpg', '2590161481', 'drivers/licenses/1749963191_license_scaled_Screenshot_20250615_075242_WhatsAppBusiness.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749963191_driver_scaled_Screenshot_20250615_075006_WhatsAppBusiness.jpg', NULL, '2025-06-15 04:53:11', '2025-08-23 18:55:41', 'ابو طلال ', '2025-06-18 16:13:25'),
(162, 'Ahmed Tharwat😎', NULL, NULL, '0591680712', 'Driver', 'drivers/ids/1749965718_id_scaled_1001353473.jpg', '6635487531', 'drivers/licenses/1749965718_license_scaled_1001337259.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749965718_driver_scaled_1001353473.jpg', NULL, '2025-06-15 05:35:18', '2025-06-15 05:35:18', NULL, NULL),
(163, 'راشد عمران رياست علي', NULL, NULL, '0556762405', 'Driver', 'drivers/ids/1749977315_id_scaled_1000427093.jpg', '2188384115', 'drivers/licenses/1749977315_license_scaled_1000427102.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-14 14:15:02', 'drivers/driver/1749977315_driver_scaled_1000427097.jpg', NULL, '2025-06-15 08:48:35', '2025-08-23 18:54:30', 'ابو طلال ', '2025-06-18 16:17:17'),
(164, 'علي عباس فرحت عباس', NULL, NULL, '0532218623', 'Driver', 'drivers/ids/1749980015_id_scaled_1000578949.jpg', '2566696445', 'drivers/licenses/1749980015_license_scaled_1000528173.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 08:29:57', 'drivers/driver/1749980015_driver_scaled_1000609196.jpg', NULL, '2025-06-15 09:33:35', '2025-08-25 08:20:13', 'ابو احمد', '2025-08-24 20:41:49'),
(165, 'غلام فمر رجاء محمد اكتار', NULL, NULL, '0536324829', 'Driver', 'drivers/ids/1749995357_id_scaled_1001400019.jpg', '2379380427', 'drivers/licenses/1749995357_license_scaled_1001295175.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1749995357_driver_scaled_1002141381.jpg', NULL, '2025-06-15 13:49:17', '2025-08-23 18:55:13', 'ابو طلال ', '2025-06-18 16:27:55'),
(166, 'محمد عمران غلام حسن', NULL, NULL, '0582590074', 'Driver', 'drivers/ids/1749998202_id_scaled_1001354572.jpg', '2389154093', 'drivers/licenses/1749998202_license_scaled_1001354569.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-03 19:24:31', 'drivers/driver/1749998202_driver_scaled_1001354563.jpg', NULL, '2025-06-15 14:36:42', '2025-08-23 18:55:38', 'ابو طلال ', '2025-06-18 16:31:21'),
(167, 'Ahmed Tharwat😎', NULL, NULL, '0568109776', 'Driver', 'drivers/ids/1750066360_id_scaled_1000415137.png', '5296125752', 'drivers/licenses/1750066360_license_scaled_1000185050.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750066360_driver_scaled_1000415146.jpg', NULL, '2025-06-16 09:32:40', '2025-06-16 09:32:40', NULL, NULL),
(168, 'محمد عبد الرشيد عبد الرشيد نديم', NULL, NULL, '0535933128', 'Driver', 'drivers/ids/1750067385_id_scaled_1000128743.jpg', '2586615128', 'drivers/licenses/1750067385_license_scaled_1000128654.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750067385_driver_scaled_1000131910.jpg', NULL, '2025-06-16 09:49:45', '2025-06-18 16:49:56', NULL, NULL),
(169, 'محمد بن أصف محمد افضل', NULL, NULL, '0537597801', 'Driver', 'drivers/ids/1750089831_id_scaled_1000363943.jpg', '2516529852', 'drivers/licenses/1750089831_license_scaled_1000000631.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750089831_driver_scaled_1000363974.jpg', NULL, '2025-06-16 16:03:51', '2025-06-18 16:54:04', NULL, NULL),
(170, 'راؤ بابر محمد اكبر علي', NULL, NULL, '0533929622', 'Driver', 'drivers/ids/1750096221_id_scaled_Screenshot_20250517-110330_Absher.jpg', '2570037784', 'drivers/licenses/1750096221_license_scaled_Screenshot_20250517-110330_Absher.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750096221_driver_scaled_Screenshot_20250517-110330_Absher.jpg', NULL, '2025-06-16 17:50:21', '2025-06-18 16:57:49', NULL, NULL),
(171, 'فاروق احمد احمد احمد دين', NULL, NULL, '0596118873', 'Driver', 'drivers/ids/1750096444_id_scaled_1000046722.jpg', '2331429924', 'drivers/licenses/1750096444_license_scaled_1000046724.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-23 17:46:39', 'drivers/driver/1750096444_driver_scaled_1000046723.jpg', NULL, '2025-06-16 17:54:04', '2025-08-23 21:06:39', 'ابو احمد', '2025-08-23 21:06:39'),
(172, 'محمد عزيز شريف', NULL, NULL, '0545254208', 'Driver', 'drivers/ids/1750149429_id_scaled_1000338894.jpg', '2527857557', 'drivers/licenses/1750149429_license_scaled_1000338896.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750149429_driver_scaled_1000338897.jpg', NULL, '2025-06-17 08:37:09', '2025-06-18 17:02:55', NULL, NULL),
(173, 'Ahmed Tharwat😎', NULL, NULL, '0508619931', 'Driver', 'drivers/ids/1750158242_id_scaled_1000262518.jpg', '8017319644', 'drivers/licenses/1750158242_license_scaled_1000277808.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750158242_driver_scaled_1000277809.jpg', NULL, '2025-06-17 11:04:02', '2025-06-17 11:04:02', NULL, NULL),
(174, 'Ahmed Tharwat😎', NULL, NULL, '0597257172', 'Driver', 'drivers/ids/1750564183_id_scaled_1000063203.jpg', '5433041074', 'drivers/licenses/1750564183_license_scaled_1000067313.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1750564183_driver_scaled_1000068057.jpg', NULL, '2025-06-22 03:49:43', '2025-06-22 03:49:43', NULL, NULL),
(175, 'john', NULL, NULL, '0560637609', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, '1111', NULL, NULL, NULL, '2025-10-08 23:02:12', NULL, NULL, '2025-06-23 02:41:52', '2025-10-08 22:52:12', NULL, NULL),
(176, 'امتياز احمد شامال خان', NULL, NULL, '0538237967', 'Driver', 'drivers/ids/1750971395_id_scaled_IMG-20250619-WA0024.jpg', '2563348109', 'drivers/licenses/1750971395_license_scaled_IMG-20240807-WA0021(1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-02 21:15:03', 'drivers/driver/1750971395_driver_scaled_IMG-20240807-WA0021(1).jpg', NULL, '2025-06-26 20:56:35', '2025-08-23 18:49:25', 'ابو طلال ', '2025-07-06 17:57:05'),
(177, 'Ahmed Tharwat😎', NULL, NULL, '0580345834', 'Driver', 'drivers/ids/1751103523_id_scaled_1003025948.jpg', '9639131312', 'drivers/licenses/1751103523_license_scaled_1003025948.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1751103523_driver_scaled_1003025949.jpg', NULL, '2025-06-28 09:38:43', '2025-06-28 09:38:43', NULL, NULL),
(178, 'ابراهيم عبدالعزيز', NULL, NULL, '0571362972', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, '2025-06-30 19:26:02', NULL, NULL, '2025-06-30 19:15:51', '2025-06-30 19:16:56', NULL, NULL),
(179, 'captain rose😎', NULL, NULL, '0597627128', 'Driver', 'drivers/ids/1751474381_id_scaled_1000000687.jpg', '4587668010', 'drivers/licenses/1751474381_license_scaled_1000000663.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1751474381_driver_scaled_1000000643.jpg', NULL, '2025-07-02 16:39:41', '2025-07-02 16:39:41', NULL, NULL),
(180, 'musawar', NULL, NULL, '0580614528', 'Passenger', NULL, NULL, NULL, '1', 'Makkah', NULL, NULL, NULL, NULL, NULL, '2025-07-10 13:43:04', NULL, NULL, '2025-07-10 13:32:57', '2025-07-10 13:33:16', NULL, NULL),
(181, 'captain rose😎', NULL, NULL, '0537062506', 'Driver', 'drivers/ids/1752168909_id_scaled_1000233615.jpg', '3742181120', 'drivers/licenses/1752168909_license_scaled_1000233616.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1752168909_driver_scaled_1000233614.jpg', NULL, '2025-07-10 17:35:09', '2025-07-10 17:35:09', NULL, NULL),
(182, 'ابو احمد  954', NULL, NULL, '0509040954', 'Unknown', NULL, NULL, NULL, '1', 'المدينه', NULL, '5025', NULL, NULL, NULL, '2025-09-09 23:36:31', NULL, NULL, '2025-07-19 16:21:17', '2025-09-09 23:26:31', NULL, NULL),
(183, 'Fayaz Ali', NULL, NULL, '0547453657', 'Passenger', NULL, NULL, NULL, '1', 'Madinah', NULL, NULL, NULL, NULL, NULL, '2025-08-23 20:30:23', NULL, NULL, '2025-08-15 14:43:31', '2025-08-23 20:20:41', NULL, NULL),
(184, 'حسن معاوية لالاعبدالستار', NULL, NULL, '0531687567', 'Driver', 'drivers/ids/1755472018_id_scaled_1000317043.jpg', '2559800210', 'drivers/licenses/1755472018_license_scaled_1000321828.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-28 08:40:13', 'drivers/driver/1755472018_driver_scaled_1000321832.jpg', NULL, '2025-08-17 23:06:58', '2025-09-28 08:30:28', 'ابو احمد', '2025-08-23 22:02:44'),
(185, 'محمد طاهر ولي محمد', NULL, NULL, '0508614577', 'Driver', NULL, '2188046508', NULL, '1', 'Makkah', NULL, NULL, NULL, NULL, NULL, '2025-09-30 08:49:32', NULL, NULL, '2025-08-18 00:07:42', '2025-09-30 08:39:44', 'اسلام ناصف  ', '2025-08-24 19:48:08'),
(186, 'محمد اقبال غلام محمد', NULL, NULL, '0580246933', 'Driver', 'drivers/ids/1755552759_id_scaled_1005353598.jpg', '2418680076', 'drivers/licenses/1755552759_license_scaled_1005353590.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-03 05:38:06', 'drivers/driver/1755552759_driver_scaled_1005353589.jpg', NULL, '2025-08-18 21:32:39', '2025-09-03 05:29:19', 'ابو احمد', '2025-08-24 21:11:13'),
(187, 'captain rose😎', NULL, NULL, '0546279294', 'Driver', 'drivers/ids/1755562816_id_scaled_1000792485.jpg', '7470393191', 'drivers/licenses/1755562816_license_scaled_1000792755.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1755562816_driver_scaled_1000792755.jpg', NULL, '2025-08-19 00:20:16', '2025-08-19 00:20:16', NULL, NULL),
(188, 'تجربة', NULL, NULL, '0551796056', 'Driver', 'drivers/ids/1755804071_id_scaled_1000083058.jpg', '002', 'drivers/licenses/1755804071_license_scaled_1000083058.jpg', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-04 18:23:17', 'drivers/driver/1755804071_driver_scaled_1000083058.jpg', NULL, '2025-08-21 19:21:11', '2025-10-04 18:13:30', 'ابو احمد', '2025-09-06 17:02:58'),
(189, 'captain rose😎', NULL, NULL, '0598173029', 'Driver', 'drivers/ids/1756068934_id_scaled_1000578949.jpg', '7496690846', 'drivers/licenses/1756068934_license_scaled_1000528173.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1756068934_driver_scaled_1000666902.jpg', NULL, '2025-08-24 20:55:34', '2025-08-24 20:55:34', NULL, NULL),
(190, 'captain rose😎', NULL, NULL, '0511506595', 'Driver', 'drivers/ids/1756660280_id_scaled_IMG_20250831_201024_055.jpg', '2616190566', 'drivers/licenses/1756660280_license_scaled_IMG_20250831_200946_179.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1756660280_driver_scaled_Screenshot_20250729-154707.png', NULL, '2025-08-31 17:11:20', '2025-08-31 17:11:20', NULL, NULL),
(191, 'ABDUL RASHEED', NULL, NULL, '0501902332', 'Passenger', NULL, NULL, NULL, '1', 'Madinah', NULL, NULL, NULL, NULL, NULL, '2025-09-01 18:01:52', NULL, NULL, '2025-09-01 17:51:22', '2025-09-01 17:52:07', NULL, NULL),
(192, 'جابر', NULL, NULL, '0553869692', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, '2025-09-04 09:58:31', NULL, NULL, '2025-09-02 09:18:43', '2025-09-04 09:48:48', NULL, NULL),
(193, 'Mohamed Tolba', NULL, NULL, '0575535387', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, '2025-10-15 12:05:12', NULL, NULL, '2025-09-03 07:00:48', '2025-10-15 08:58:01', NULL, NULL),
(194, 'Basma', NULL, NULL, '0539171348', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, NULL, NULL, NULL, NULL, '2025-09-10 09:22:50', NULL, NULL, '2025-09-08 20:45:04', '2025-09-10 09:13:44', NULL, NULL),
(195, 'Muhammad Abdullah', NULL, NULL, '0544833285', 'Passenger', NULL, NULL, NULL, '1', 'Madinah', NULL, NULL, NULL, NULL, NULL, '2025-10-08 15:15:15', NULL, NULL, '2025-09-15 10:25:28', '2025-10-08 15:05:24', NULL, NULL),
(196, 'captain rose😎', NULL, NULL, '05', 'Driver', 'drivers/ids/1758119786_id_scaled_1000528235.png', '2163003723', 'drivers/licenses/1758119786_license_scaled_1000528225.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758119786_driver_scaled_1000528223.png', NULL, '2025-09-17 14:36:26', '2025-09-17 14:36:26', NULL, NULL),
(201, 'Test', NULL, NULL, '5555555555', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 06:56:49', '2025-09-18 06:56:49', NULL, NULL),
(202, 'Test T', NULL, NULL, '555555555', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 06:58:37', '2025-09-18 06:58:37', NULL, NULL),
(205, 'Mo test', NULL, NULL, '55555555555', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 07:00:54', '2025-09-18 07:00:54', NULL, NULL),
(206, 'Mo Test', NULL, NULL, '0512355678', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 07:02:29', '2025-09-18 07:02:29', NULL, NULL),
(207, 'Test ٨٨٨٨٨', NULL, NULL, '0588888888', 'Passenger', NULL, NULL, NULL, '1', 'Makkah', NULL, '6831', NULL, NULL, NULL, '2025-09-18 14:53:21', NULL, NULL, '2025-09-18 08:09:35', '2025-09-18 14:43:21', NULL, NULL),
(224, 'captain rose😎', NULL, NULL, '0511111111', 'Driver', 'drivers/ids/1758186021_id_scaled_1000528231.png', '555', 'drivers/licenses/1758186021_license_scaled_1000528231.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758186021_driver_scaled_1000528231.png', NULL, '2025-09-18 09:00:21', '2025-09-18 09:00:21', NULL, NULL),
(230, 'captain rose😎', NULL, NULL, '0522222222', 'Driver', 'drivers/ids/1758187544_id_scaled_1000528225.png', '5888', 'drivers/licenses/1758187544_license_scaled_1000528225.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758187544_driver_scaled_1000528225.png', NULL, '2025-09-18 09:25:44', '2025-09-18 09:25:44', NULL, NULL),
(231, 'captain rose😎', NULL, NULL, '0533333333', 'Driver', 'drivers/ids/1758190494_id_scaled_1000528225.png', '55585', 'drivers/licenses/1758190494_license_scaled_1000528225.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758190494_driver_scaled_1000528225.png', NULL, '2025-09-18 10:14:54', '2025-09-18 10:14:54', NULL, NULL),
(232, 'captain rose😎', NULL, NULL, '0566666666', 'Driver', 'drivers/ids/1758191534_id_scaled_1000528231.png', '638288282', 'drivers/licenses/1758191534_license_scaled_1000528231.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758191534_driver_scaled_1000528231.png', NULL, '2025-09-18 10:32:14', '2025-09-18 10:32:14', NULL, NULL),
(233, 'Test ٥٥٥٥٥٥', NULL, NULL, '0555555555', 'Driver', 'drivers/ids/1758206283_id_scaled_1000528231.png', '484', 'drivers/licenses/1758206283_license_scaled_1000528231.png', NULL, NULL, NULL, '1037', NULL, NULL, NULL, '2025-09-18 14:53:02', 'drivers/driver/1758206283_driver_scaled_1000528231.png', NULL, '2025-09-18 14:38:03', '2025-09-18 14:43:02', NULL, NULL),
(234, 'Hi 9999', NULL, NULL, '0599999999', 'Passenger', NULL, NULL, NULL, '1', 'القصيم', NULL, '1809', NULL, NULL, NULL, '2025-09-18 15:27:16', NULL, NULL, '2025-09-18 15:11:14', '2025-09-18 15:17:16', NULL, NULL),
(235, 'Mohammed Test Passenger', NULL, NULL, '0580000000', 'Passenger', NULL, NULL, NULL, '1', 'الرياض', NULL, NULL, NULL, NULL, NULL, '2025-09-18 15:56:34', NULL, NULL, '2025-09-18 15:17:58', '2025-09-18 15:47:08', NULL, NULL),
(236, 'Mohammed mohammed', NULL, NULL, '0588000000', 'Passenger', NULL, NULL, NULL, '1', 'القصيم', NULL, '6948', NULL, NULL, NULL, '2025-09-20 06:17:59', NULL, NULL, '2025-09-18 22:07:15', '2025-09-20 06:07:59', NULL, NULL),
(237, 'Mohammed Tolba', NULL, NULL, '0588800000', 'Passenger', NULL, NULL, NULL, '1', 'جدة', NULL, NULL, NULL, NULL, NULL, '2025-09-20 07:20:15', NULL, NULL, '2025-09-20 06:53:22', '2025-09-20 07:10:29', NULL, NULL),
(238, 'MaZzen', NULL, NULL, '0588880000', 'Driver', 'drivers/ids/1758371580_id_scaled_1000528231.png', '151515353535', 'drivers/licenses/1758371580_license_scaled_1000528225.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758371580_driver_scaled_1000512211.jpg', NULL, '2025-09-20 12:33:00', '2025-09-20 12:33:00', NULL, NULL),
(239, 'Mohammed Tolba', NULL, NULL, '0558800000', 'Driver', 'drivers/ids/1758436301_id_scaled_1000528225.png', '301021312006', 'drivers/licenses/1758436301_license_scaled_1000530302.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758436301_driver_scaled_1000529784.jpg', NULL, '2025-09-21 06:31:41', '2025-09-21 06:31:41', NULL, NULL),
(240, 'Vfbrrrn', NULL, NULL, '0555888000', 'Driver', 'drivers/ids/1758436814_id_scaled_1000531079.jpg', '58585959929', 'drivers/licenses/1758436814_license_scaled_1000531079.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1758436814_driver_scaled_1000531079.jpg', NULL, '2025-09-21 06:40:14', '2025-09-21 06:40:14', NULL, NULL),
(241, 'MaZzen Emad', NULL, NULL, '0555888999', 'Passenger', NULL, NULL, NULL, '1', 'الدمام', NULL, '3209', NULL, NULL, NULL, '2025-09-27 07:45:12', NULL, NULL, '2025-09-25 20:30:36', '2025-09-27 07:35:12', NULL, NULL),
(242, 'Mohammed', NULL, NULL, '0511111222', 'Passenger', NULL, NULL, NULL, '1', 'القصيم', NULL, NULL, NULL, NULL, NULL, '2025-09-27 11:29:57', NULL, NULL, '2025-09-27 11:19:38', '2025-09-27 11:20:06', NULL, NULL),
(243, 'Mohammed Tolba', NULL, NULL, '0555333777', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, '1291', NULL, NULL, NULL, '2025-09-29 16:02:57', NULL, NULL, '2025-09-29 15:52:47', '2025-09-29 15:52:57', NULL, NULL),
(244, 'MOHAMEDBKG', NULL, NULL, '0577777775', 'Passenger', NULL, NULL, NULL, '1', 'القصيم', NULL, '4783', NULL, NULL, NULL, '2025-10-07 23:01:20', NULL, NULL, '2025-09-30 09:09:57', '2025-10-07 22:51:20', NULL, NULL),
(245, 'AbdelMenem', NULL, NULL, '0555999888', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, '2025-10-04 10:41:54', NULL, NULL, '2025-10-04 10:31:47', '2025-10-04 10:32:05', NULL, NULL),
(246, 'Mohamed Tolba', NULL, NULL, '0547537166', 'Passenger', NULL, NULL, NULL, '1', 'المدينة المنورة', NULL, NULL, NULL, NULL, NULL, '2025-10-06 12:38:36', NULL, NULL, '2025-10-06 10:57:20', '2025-10-06 12:28:50', NULL, NULL),
(247, 'Ahmed Ali', NULL, NULL, '0555555550', 'Passenger', NULL, NULL, NULL, '1', 'الدمام', NULL, NULL, NULL, NULL, NULL, '2025-10-06 11:33:18', NULL, NULL, '2025-10-06 11:16:16', '2025-10-06 11:23:54', NULL, NULL),
(248, 'Testc', NULL, NULL, '0511111110', 'Passenger', NULL, NULL, NULL, '1', 'الرياض', NULL, NULL, NULL, NULL, NULL, '2025-10-06 12:37:48', NULL, NULL, '2025-10-06 12:14:17', '2025-10-06 12:27:59', NULL, NULL),
(249, 'Mohamed Tolba', NULL, NULL, '0599999990', 'Driver', 'drivers/ids/1759924638_id_scaled_1000528231.png', '2610335456', 'drivers/licenses/1759924638_license_scaled_1000528225.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1759924638_driver_scaled_1000528231.png', NULL, '2025-10-08 11:57:18', '2025-10-08 11:57:18', NULL, NULL),
(250, 'Mohamed Tolba', NULL, NULL, '0565655656', 'Driver', 'drivers/ids/1759928807_id_scaled_1000000033.jpg', '2434321313', 'drivers/licenses/1759928807_license_scaled_1000000033.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1759928807_driver_scaled_1000000033.jpg', NULL, '2025-10-08 13:06:47', '2025-10-08 13:06:47', NULL, NULL),
(251, 'scecevfe', NULL, NULL, '0545454545', 'Driver', 'drivers/ids/1759928815_id_scaled_1000528225.png', '82828282882', 'drivers/licenses/1759928815_license_scaled_1000528231.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1759928815_driver_scaled_1000528225.png', NULL, '2025-10-08 13:06:55', '2025-10-08 13:06:55', NULL, NULL),
(252, 'Test => Tolba', NULL, NULL, '0565656565', 'Passenger', NULL, NULL, NULL, '1', 'الدمام', NULL, NULL, NULL, NULL, NULL, '2025-10-14 08:25:24', NULL, NULL, '2025-10-08 13:15:35', '2025-10-14 05:15:34', NULL, NULL),
(253, 'Ali', NULL, NULL, '0585858585', 'Passenger', NULL, NULL, NULL, '1', 'الرياض', NULL, NULL, NULL, NULL, NULL, '2025-10-15 12:04:47', NULL, NULL, '2025-10-08 14:52:31', '2025-10-15 08:57:00', NULL, NULL),
(254, 'Tolba Test Driver', NULL, NULL, '0575757575', 'Driver', 'drivers/ids/1759935593_id_scaled_1000541878.jpg', '54646464616', 'drivers/licenses/1759935593_license_scaled_1000528225.png', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-14 06:45:56', 'drivers/driver/1759935593_driver_scaled_1000512211.jpg', NULL, '2025-10-08 14:59:53', '2025-10-14 03:36:41', 'Abdullah', '2025-10-08 15:05:34'),
(255, 'Test Driver', NULL, NULL, '055555555', 'Passenger', NULL, NULL, NULL, '1', 'Test, KSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-14 04:36:55', '2025-10-14 04:36:55', NULL, NULL),
(256, 'MaZzen Mohamed', NULL, NULL, '0558855885', 'Passenger', NULL, NULL, NULL, '1', 'مكة المكرمة', NULL, '4429', NULL, NULL, NULL, '2025-10-16 08:39:03', NULL, NULL, '2025-10-14 05:15:58', '2025-10-16 05:29:03', NULL, NULL),
(257, 'MaZzen Mohamed', NULL, NULL, '0555555552', 'Driver', 'drivers/ids/1760429831_id_scaled_1000528231.png', '8682885852', 'drivers/licenses/1760429831_license_scaled_1000528231.png', '1', NULL, NULL, '8263', NULL, NULL, NULL, '2025-10-16 08:28:56', 'drivers/driver/1760429831_driver_scaled_1000528225.png', NULL, '2025-10-14 05:17:11', '2025-10-16 05:18:56', 'ابو احمد', '2025-10-14 08:33:13'),
(258, 'Test Driver Name', NULL, NULL, '0550000000', 'Driver', 'drivers/ids/1760604745_id_test.jpg', 'ID123456', 'drivers/licenses/1760604745_license_test.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'drivers/driver/1760604745_driver_test.jpg', NULL, '2025-10-16 05:52:25', '2025-10-16 05:52:25', NULL, NULL),
(261, 'Test Passenger', NULL, NULL, '0550880000', 'Passenger', NULL, NULL, NULL, '1', 'Riyadh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-16 06:08:57', '2025-10-16 06:08:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `between_cities`
--

CREATE TABLE `between_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_one` varchar(255) DEFAULT NULL,
  `city_two` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `office_commission` varchar(255) DEFAULT NULL,
  `passengers` varchar(255) DEFAULT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `between_cities`
--

INSERT INTO `between_cities` (`id`, `city_one`, `city_two`, `amount`, `created_at`, `updated_at`, `office_commission`, `passengers`, `car_type`, `code`) VALUES
(1, 'المدينة المنورة', 'مكة المكرمة', 400.00, '2025-06-28 09:57:24', '2025-07-10 12:47:59', '50', '12', NULL, NULL),
(2, 'مكة المكرمة', 'المدينة المنورة', 400.00, '2025-10-14 06:36:36', '2025-10-14 06:36:36', '10%', '12', 'Auto', 'TRIP-1760434596'),
(3, 'مكة المكرمة', 'المدينة المنورة', 400.00, NULL, NULL, '10', '4', 'Auto', 'MAK-MED-SED'),
(4, 'مكة المكرمة', 'المدينة المنورة', 400.00, NULL, NULL, '10', '4', 'Auto', 'MAK-MED-SED');

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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `archive` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `saer_expire_at` varchar(255) DEFAULT NULL,
  `tamen_expire_at` varchar(255) DEFAULT NULL,
  `fahs_expire_at` varchar(255) DEFAULT NULL,
  `cart_expire_at` varchar(255) DEFAULT NULL,
  `zaet_expire_at` varchar(255) DEFAULT NULL,
  `tafwed_expire_at` varchar(255) DEFAULT NULL,
  `type_price` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `type`, `plate_number`, `card_number`, `serial_number`, `color`, `status`, `archive`, `created_at`, `updated_at`, `user_name`, `saer_expire_at`, `tamen_expire_at`, `fahs_expire_at`, `cart_expire_at`, `zaet_expire_at`, `tafwed_expire_at`, `type_price`, `price`) VALUES
(1, '2019', 'هونداي النترا', 'أ ح د 4293', 'KMHD741F2KU849206', '483440710', 'اخضر', 'عاملة', NULL, '2025-03-04 09:22:39', '2025-10-11 09:51:36', NULL, '2027-11-28', '2025-11-01', '2026-01-29', '2025-12-24', '2025-10-18', NULL, 'يومي', '130'),
(2, '2021', 'هونداي فان', 'أ ص ح 2216', 'KMJWA37KBMU176922', '343629020', 'رصاصي', 'عاملة', NULL, '2025-03-04 09:23:52', '2025-10-11 09:15:39', NULL, '2027-05-09', '2026-06-20', '2026-04-03', '2026-07-20', NULL, '2025-01-01', 'شهري', '1000'),
(3, '2020', 'هونداي سوناتا', 'أ ر ك 8111', 'KMHL241B1LA061026', '710338810', 'اخضر', 'عاملة', NULL, '2025-03-04 09:26:09', '2025-10-09 08:51:34', NULL, '2020-01-01', '2020-01-01', '2020-01-01', '2025-11-18', '2025-11-04', NULL, 'يومي', '170'),
(4, '2019', 'هونداي النترا', 'أ د ك 5460', 'KMHD741F0KU918653', '922952710', 'اخضر', 'متعطلة', NULL, '2025-03-04 09:27:35', '2025-10-09 08:49:42', NULL, '2020-01-01', '2020-01-01', NULL, '2026-01-02', NULL, NULL, 'شهري', '130'),
(5, '2021', 'هونداي فان', 'أ ص ح 2212', 'KMJWA37KBMU158966', '953629020', 'رصاصي', 'عاملة', NULL, '2025-03-04 09:30:51', '2025-10-11 09:39:39', NULL, '2027-05-09', '2026-06-20', '2026-04-03', '2026-07-20', '2025-07-23', '2020-01-01', 'شهري', '1000'),
(6, '2021', 'هونداي سوناتا', 'أ ر ك 8726', 'KMHL24164MA129579', '954465810', 'اخضر', 'عاملة', NULL, '2025-03-04 09:31:40', '2025-10-09 08:48:32', NULL, '2020-01-01', '2020-01-01', '2020-01-01', '2026-01-11', '2025-10-29', NULL, 'يومي', '150'),
(7, '2020', 'هونداي ستاركس', 'أ س و 8513', 'KMJWA37KBLU133418', '301159020', 'ابيض', 'عاملة', NULL, '2025-03-04 10:55:08', '2025-10-11 09:18:52', NULL, '2027-05-25', '2026-07-10', '2026-06-04', '2026-07-20', NULL, '2020-01-01', 'شهري', '1000'),
(8, '2019', 'هونداي النترا', 'أ د ك 5767', '459741710', 'KMHD741F9KU866889', 'اخضر', 'عاملة', NULL, '2025-03-04 10:59:57', '2025-10-11 09:46:45', NULL, '2028-02-03', '2025-11-01', '2026-01-25', '2026-01-02', NULL, NULL, 'يومي', '160'),
(9, '2020', 'هونداي ستاركس', 'أ س و 8514', 'KMJWA37KBLU120506', '141159020', 'فضي', 'عاملة', NULL, '2025-03-04 11:01:52', '2025-10-11 09:24:23', NULL, '2027-05-25', '2026-07-08', '2026-06-04', '2026-07-20', NULL, '2020-01-01', 'يومي', '200'),
(10, '2019', 'هونداي النترا', 'أ د ك 5757', 'KMHD741F9KU866388', '549741710', 'اخضر', 'انتظار', NULL, '2025-03-04 11:02:40', '2025-10-09 08:54:27', NULL, '2020-01-01', NULL, '2020-01-01', '2026-01-02', NULL, NULL, 'يومي', '130'),
(11, '2019', 'هونداي النترا', 'أ د ك 5456', 'KMHD741F9KU918652', '842952710', 'اخضر', 'عاملة', NULL, '2025-03-04 11:03:27', '2025-10-11 09:49:01', NULL, '2028-04-09', '2025-11-01', '2026-01-30', '2026-01-02', '2025-07-17', NULL, 'يومي', '130'),
(12, '2020', 'هونداي ستاركس', 'أ س س 2850', 'KMJWA37KBLU124345', '172845020', 'ابيض', 'عاملة', NULL, '2025-03-04 11:04:57', '2025-10-11 09:09:51', NULL, '2027-01-03', '2026-07-08', '2026-01-30', '2026-07-20', NULL, NULL, 'شهري', '1000'),
(13, '2019', 'هونداي ستاركس', 'أ س س 1815', 'KMJWA37KBKU026555', '602774020', 'ابيض', 'عاملة', NULL, '2025-03-04 11:06:10', '2025-10-11 09:07:14', NULL, '2026-12-08', '2026-07-10', '2026-04-19', '2025-07-22', NULL, NULL, 'يومي', '200'),
(14, '2023', 'هونداي ستاريا', 'أ س س 1265', 'KMJYA3713PU108738', '663060020', 'اسود', 'عاملة', NULL, '2025-03-04 11:09:09', '2025-10-11 09:00:15', NULL, '2026-07-08', '2026-08-26', '2026-08-26', '2026-08-22', NULL, NULL, 'يومي', '200'),
(15, '2023', 'كيا كي 5', 'ا س ا 5066', 'KNAG24141P5200784', '631305910', 'اخضر', 'عاملة', NULL, '2025-03-04 11:10:55', '2025-10-09 08:45:31', NULL, '2020-01-01', '2020-01-01', '2020-01-01', '2025-11-04', '2025-10-18', NULL, 'يومي', '170'),
(16, '2023', 'هونداي ستاريا', 'ا س س 1253', 'KMJYA3711PU108897', '323060020', 'أسود', 'عاملة', NULL, '2025-03-04 11:13:24', '2025-10-11 09:02:22', NULL, '2026-07-08', '2026-08-25', '2026-08-28', '2026-08-22', NULL, NULL, 'شهري', '1000'),
(17, '2023', 'ميسوتبيشي اكسباندر', 'ا س ا 6581', 'MK2L6Y1Y6PN002898', '181636910', 'أخضر', 'عاملة', NULL, '2025-03-04 11:20:23', '2025-10-09 08:46:59', NULL, '2020-01-01', '2020-01-01', '2020-01-01', '2026-01-02', '2025-08-04', NULL, 'شهري', '1000'),
(18, '2023', 'ميسوتبيشي اكسباندر', 'ا س ا 6580', 'MK2L6Y1Y4PN001443', '61636910', 'اخضر', 'عاملة', NULL, '2025-03-04 11:45:24', '2025-10-09 08:53:09', NULL, '2020-01-01', '2020-01-01', '2020-01-01', '2026-01-02', '2025-08-08', NULL, 'يومي', '170'),
(19, '2017', 'كيا سيراتيو', 'أ د ك 6585', 'KNAFK417XH5963541', '371160610', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 11:48:36', '2025-05-10 17:32:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2021', 'هونداي فان', 'أ ص د 8719', 'KMJWA37KBMU159898', '372020120', 'رصاصي', 'عاملة', NULL, '2025-03-04 11:57:19', '2025-10-11 09:12:32', NULL, '2027-06-20', '2026-07-08', '2026-03-24', '2026-07-19', NULL, NULL, 'يومي', '200'),
(21, '2017', 'هونداي النترا', 'أ د ق 4605', 'KMHD741FXHU281554', '242767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:03:03', '2025-03-04 12:03:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2017', 'كيا سيراتيو', 'أ د ك 5662', 'KNAFK4170H5963788', '248202610', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:05:41', '2025-03-04 12:05:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '2017', 'هونداي النترا', 'أ د ق 4622', 'KMHD741F1HU281586', '622767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:06:38', '2025-05-10 17:32:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2017', 'هونداي اتش وان', 'أ د ق 4427', 'KMJWA37R2HU879853', '883159510', NULL, 'خارج عن الخدمة', NULL, '2025-03-04 12:07:21', '2025-03-04 12:07:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '2017', 'هونداي النترا', 'أ د ق 4619', 'KMHD741FXHU286642', '963767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:07:59', '2025-03-04 12:07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '2017', 'هونداي النترا', 'ر ص ر 8770', 'KMHD741F0HU284592', '803767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:09:26', '2025-03-04 12:09:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '2017', 'هونداي النترا', 'أ د ق 4623', 'KMHD741F8HU289765', '512767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-03-04 12:10:13', '2025-03-04 12:10:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '2023', 'تويوتا', 'أ س ع 6524', 'JTGHM9CP4P6048847', '326542020', 'ابيض', 'عاملة', NULL, '2025-03-16 11:19:54', '2025-10-11 09:04:55', NULL, '2026-09-13', '2026-07-10', '2025-11-23', '2026-07-20', NULL, NULL, 'يومي', '243'),
(29, 'هونداي النترا', '2017', 'ا د ق 4602', 'KMHD741F1HU284522', '843767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-05-07 19:59:52', '2025-05-10 17:33:08', 'new_user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'هونداي النترا', '2017', 'ر ق ه 7330', 'KMHD741FXHU281604', '432767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-05-07 20:06:57', '2025-05-10 17:33:28', 'new_user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'هونداي النترا', '2017', 'ا دق 4604', 'KMHD741F7HU183467', '992767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-05-07 20:08:44', '2025-05-10 17:33:43', 'new_user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'هونداي النترا', '2017', 'ا دق 4621', 'KMHD741F7HU286713', '782767510', 'ابيض', 'خارج عن الخدمة', NULL, '2025-05-07 20:11:09', '2025-05-10 17:34:10', 'new_user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '2019', 'هونداي ستاركس', 'ا ص و 6244', '1024111672', '810479120', 'ابيض', 'عاملة', NULL, '2025-05-29 16:01:04', '2025-10-11 08:57:40', 'ابو يحي ', '2027-07-16', '2026-07-10', '2025-12-11', '2026-07-18', NULL, NULL, 'شهري', '1000'),
(34, '2022', 'هيونداي', 'أ س س 9316', 'KMHYA811BNU003614', '477686120', 'ابيض', 'عاملة', NULL, '2025-10-04 08:45:49', '2025-10-11 09:42:12', 'محمد', '2028-01-22', '2026-09-29', '2025-09-19', '2026-09-28', NULL, NULL, 'شهري', '1000'),
(36, '2025', 'TESTName', 'ABC-123', '15555555555', '15555555555', 'Black', 'عاملة', 'archived', '2025-10-06 10:42:22', '2025-10-08 12:38:41', 'Abdullah', '2025-10-08', NULL, NULL, NULL, NULL, NULL, 'شهري', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car_documents`
--

CREATE TABLE `car_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_documents`
--

INSERT INTO `car_documents` (`id`, `car_id`, `type`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 7, 'tamen_expire_at', 'car_files/1753292084_68811d349f2d7.pdf', '2025-07-23 17:34:44', '2025-07-23 17:34:44'),
(2, 12, 'tamen_expire_at', 'car_files/1753292135_68811d67b7893.pdf', '2025-07-23 17:35:35', '2025-07-23 17:35:35'),
(3, 13, 'tamen_expire_at', 'car_files/1753292187_68811d9b3e739.pdf', '2025-07-23 17:36:27', '2025-07-23 17:36:27'),
(4, 33, 'tamen_expire_at', 'car_files/1753292267_68811deb68363.pdf', '2025-07-23 17:37:47', '2025-07-23 17:37:47'),
(5, 28, 'tamen_expire_at', 'car_files/1753292308_68811e148de0a.pdf', '2025-07-23 17:38:28', '2025-07-23 17:38:28'),
(6, 7, 'tamen_expire_at', 'car_files/1753292637_68811f5dad775.pdf', '2025-07-23 17:43:57', '2025-07-23 17:43:57'),
(7, 15, 'zaet_expire_at', 'car_files/1753532738_6884c9425a9d3.pdf', '2025-07-26 12:25:38', '2025-07-26 12:25:38'),
(8, 15, 'zaet_expire_at', 'car_files/1753537426_6884db9294368.pdf', '2025-07-26 13:43:46', '2025-07-26 13:43:46'),
(9, 15, 'zaet_expire_at', 'car_files/1753537465_6884dbb9753da.pdf', '2025-07-26 13:44:25', '2025-07-26 13:44:25'),
(10, 17, 'zaet_expire_at', 'car_files/1753537541_6884dc0538f6a.pdf', '2025-07-26 13:45:41', '2025-07-26 13:45:41'),
(11, 17, 'zaet_expire_at', 'car_files/1753537636_6884dc64abdca.pdf', '2025-07-26 13:47:16', '2025-07-26 13:47:16'),
(12, 15, 'zaet_expire_at', 'car_files/1753610262_6885f816baeb5.pdf', '2025-07-27 09:57:42', '2025-07-27 09:57:42'),
(13, 5, 'saer_expire_at', 'car_files/1753612830_6886021e6ac69.pdf', '2025-07-27 10:40:30', '2025-07-27 10:40:30'),
(14, 2, 'saer_expire_at', 'car_files/1753612890_6886025a9cca5.pdf', '2025-07-27 10:41:30', '2025-07-27 10:41:30'),
(15, 12, 'saer_expire_at', 'car_files/1753612937_68860289a308b.pdf', '2025-07-27 10:42:17', '2025-07-27 10:42:17'),
(16, 20, 'saer_expire_at', 'car_files/1753613216_688603a03a968.pdf', '2025-07-27 10:46:56', '2025-07-27 10:46:56'),
(17, 13, 'saer_expire_at', 'car_files/1753613247_688603bf9fbd3.pdf', '2025-07-27 10:47:27', '2025-07-27 10:47:27'),
(18, 33, 'saer_expire_at', 'car_files/1753613278_688603de5970a.pdf', '2025-07-27 10:47:58', '2025-07-27 10:47:58'),
(19, 28, 'saer_expire_at', 'car_files/1753613337_68860419c973e.pdf', '2025-07-27 10:48:57', '2025-07-27 10:48:57'),
(20, 7, 'saer_expire_at', 'car_files/1753613369_688604394edc1.pdf', '2025-07-27 10:49:29', '2025-07-27 10:49:29'),
(21, 9, 'saer_expire_at', 'car_files/1753613414_6886046646ab6.pdf', '2025-07-27 10:50:14', '2025-07-27 10:50:14'),
(22, 11, 'cart_expire_at', 'car_files/1753621223_688622e79f98a.pdf', '2025-07-27 13:00:23', '2025-07-27 13:00:23'),
(23, 8, 'saer_expire_at', 'car_files/1753621387_6886238bc009d.jpg', '2025-07-27 13:03:07', '2025-07-27 13:03:07'),
(24, 8, 'saer_expire_at', 'car_files/1753621444_688623c4c9ccd.jpg', '2025-07-27 13:04:04', '2025-07-27 13:04:04'),
(25, 20, 'cart_expire_at', 'car_files/1753718459_68879ebb447ed.pdf', '2025-07-28 16:00:59', '2025-07-28 16:00:59'),
(26, 28, 'cart_expire_at', 'car_files/1753768766_6888633e64183.pdf', '2025-07-29 05:59:26', '2025-07-29 05:59:26'),
(27, 5, 'tafwed_expire_at', 'car_files/1753781145_68889399c285b.pdf', '2025-07-29 09:25:45', '2025-07-29 09:25:45'),
(28, 2, 'tafwed_expire_at', 'car_files/1753781183_688893bfdc936.pdf', '2025-07-29 09:26:23', '2025-07-29 09:26:23'),
(29, 7, 'tafwed_expire_at', 'car_files/1753781608_6888956872f86.pdf', '2025-07-29 09:33:28', '2025-07-29 09:33:28'),
(30, 9, 'tafwed_expire_at', 'car_files/1753781646_6888958eca729.pdf', '2025-07-29 09:34:06', '2025-07-29 09:34:06'),
(31, 7, 'cart_expire_at', 'car_files/1753784346_6888a01a1ab2f.pdf', '2025-07-29 10:19:06', '2025-07-29 10:19:06'),
(32, 5, 'cart_expire_at', 'car_files/1753784405_6888a0558413a.pdf', '2025-07-29 10:20:05', '2025-07-29 10:20:05'),
(33, 2, 'cart_expire_at', 'car_files/1753784529_6888a0d1eaaf2.pdf', '2025-07-29 10:22:09', '2025-07-29 10:22:09'),
(34, 9, 'cart_expire_at', 'car_files/1753784591_6888a10f0049a.pdf', '2025-07-29 10:23:11', '2025-07-29 10:23:11'),
(35, 3, 'cart_expire_at', 'car_files/1753787801_6888ad99c09f8.pdf', '2025-07-29 11:16:41', '2025-07-29 11:16:41'),
(36, 12, 'cart_expire_at', 'car_files/1753787965_6888ae3dcd867.pdf', '2025-07-29 11:19:25', '2025-07-29 11:19:25'),
(37, 18, 'saer_expire_at', 'car_files/1754244674_688fa64228abd.jpg', '2025-08-03 18:11:14', '2025-08-03 18:11:14'),
(38, 18, 'cart_expire_at', 'car_files/1754246821_688faea5290d3.pdf', '2025-08-03 18:47:01', '2025-08-03 18:47:01'),
(39, 18, 'cart_expire_at', 'car_files/1754325056_6890e040d3a66.pdf', '2025-08-04 16:30:56', '2025-08-04 16:30:56'),
(40, 15, 'zaet_expire_at', 'car_files/1754849735_6898e1c74902f.pdf', '2025-08-10 18:15:35', '2025-08-10 18:15:35'),
(41, 3, 'zaet_expire_at', 'car_files/1754849799_6898e20733dac.pdf', '2025-08-10 18:16:39', '2025-08-10 18:16:39'),
(42, 16, 'cart_expire_at', 'car_files/1757421442_68c01f829fe4f.pdf', '2025-09-09 12:37:22', '2025-09-09 12:37:22'),
(43, 14, 'cart_expire_at', 'car_files/1757421478_68c01fa656130.pdf', '2025-09-09 12:37:58', '2025-09-09 12:37:58'),
(44, 3, 'zaet_expire_at', 'car_files/1757791877_68c5c68509d58.pdf', '2025-09-13 19:31:17', '2025-09-13 19:31:17'),
(45, 3, 'zaet_expire_at', 'car_files/1759877379_68e5990398d1f.jpeg', '2025-10-07 22:49:39', '2025-10-07 22:49:39'),
(46, 1, 'tamen_expire_at', 'car_files/1759877428_68e59934a4067.jpeg', '2025-10-07 22:50:28', '2025-10-07 22:50:28'),
(47, 1, 'zaet_expire_at', 'car_files/1759877493_68e5997580b56.jpeg', '2025-10-07 22:51:33', '2025-10-07 22:51:33'),
(48, 15, 'zaet_expire_at', 'car_files/1759877538_68e599a29e568.jpeg', '2025-10-07 22:52:18', '2025-10-07 22:52:18'),
(49, 6, 'zaet_expire_at', 'car_files/1759877631_68e599ffb6307.jpeg', '2025-10-07 22:53:51', '2025-10-07 22:53:51'),
(50, 36, 'saer_expire_at', 'car_files/1759926299_68e6581bbf3e8.jpg', '2025-10-08 12:24:59', '2025-10-08 12:24:59'),
(51, 1, 'cart_expire_at', 'car_files/1759997259_68e76d4b35d9a.pdf', '2025-10-09 08:07:39', '2025-10-09 08:07:39'),
(52, 2, 'cart_expire_at', 'car_files/1759997304_68e76d78b6b17.pdf', '2025-10-09 08:08:24', '2025-10-09 08:08:24'),
(53, 3, 'cart_expire_at', 'car_files/1759997345_68e76da1da0ca.pdf', '2025-10-09 08:09:05', '2025-10-09 08:09:05'),
(54, 4, 'cart_expire_at', 'car_files/1759997376_68e76dc0d5f01.pdf', '2025-10-09 08:09:36', '2025-10-09 08:09:36'),
(55, 5, 'cart_expire_at', 'car_files/1759997412_68e76de42a07f.pdf', '2025-10-09 08:10:12', '2025-10-09 08:10:12'),
(56, 6, 'cart_expire_at', 'car_files/1759997451_68e76e0b19654.pdf', '2025-10-09 08:10:51', '2025-10-09 08:10:51'),
(57, 11, 'cart_expire_at', 'car_files/1759997502_68e76e3e9a2d7.pdf', '2025-10-09 08:11:42', '2025-10-09 08:11:42'),
(58, 1, 'cart_expire_at', 'car_files/1759997522_68e76e528e9ae.jpg', '2025-10-09 08:12:02', '2025-10-09 08:12:02'),
(59, 33, 'cart_expire_at', 'car_files/1759997544_68e76e6881eb1.pdf', '2025-10-09 08:12:24', '2025-10-09 08:12:24'),
(60, 2, 'cart_expire_at', 'car_files/1759997577_68e76e89bb917.jpg', '2025-10-09 08:12:57', '2025-10-09 08:12:57'),
(61, 28, 'cart_expire_at', 'car_files/1759997578_68e76e8a69b13.pdf', '2025-10-09 08:12:58', '2025-10-09 08:12:58'),
(62, 20, 'cart_expire_at', 'car_files/1759997622_68e76eb6a56a6.pdf', '2025-10-09 08:13:42', '2025-10-09 08:13:42'),
(63, 3, 'cart_expire_at', 'car_files/1759997625_68e76eb9de5eb.jpg', '2025-10-09 08:13:45', '2025-10-09 08:13:45'),
(64, 18, 'cart_expire_at', 'car_files/1759997703_68e76f071a27c.pdf', '2025-10-09 08:15:03', '2025-10-09 08:15:03'),
(65, 7, 'cart_expire_at', 'car_files/1759997715_68e76f138af40.jpg', '2025-10-09 08:15:15', '2025-10-09 08:15:15'),
(66, 8, 'cart_expire_at', 'car_files/1759997742_68e76f2e14f08.jpg', '2025-10-09 08:15:42', '2025-10-09 08:15:42'),
(67, 17, 'cart_expire_at', 'car_files/1759997748_68e76f3430a00.pdf', '2025-10-09 08:15:48', '2025-10-09 08:15:48'),
(68, 9, 'cart_expire_at', 'car_files/1759997767_68e76f47d10db.jpg', '2025-10-09 08:16:07', '2025-10-09 08:16:07'),
(69, 16, 'cart_expire_at', 'car_files/1759997786_68e76f5a95669.pdf', '2025-10-09 08:16:26', '2025-10-09 08:16:26'),
(70, 10, 'cart_expire_at', 'car_files/1759997795_68e76f638bf86.jpg', '2025-10-09 08:16:35', '2025-10-09 08:16:35'),
(71, 15, 'cart_expire_at', 'car_files/1759997818_68e76f7a736fe.pdf', '2025-10-09 08:16:58', '2025-10-09 08:16:58'),
(72, 12, 'cart_expire_at', 'car_files/1759997822_68e76f7eb5ce1.jpg', '2025-10-09 08:17:02', '2025-10-09 08:17:02'),
(73, 14, 'cart_expire_at', 'car_files/1759997848_68e76f9899227.jpg', '2025-10-09 08:17:28', '2025-10-09 08:17:28'),
(74, 14, 'cart_expire_at', 'car_files/1759997851_68e76f9b494d2.pdf', '2025-10-09 08:17:31', '2025-10-09 08:17:31'),
(75, 33, 'saer_expire_at', 'car_files/1759997904_68e76fd01383f.pdf', '2025-10-09 08:18:24', '2025-10-09 08:18:24'),
(76, 1, 'saer_expire_at', 'car_files/1759997905_68e76fd15453f.jpg', '2025-10-09 08:18:25', '2025-10-09 08:18:25'),
(77, 2, 'saer_expire_at', 'car_files/1759997928_68e76fe8e5196.jpg', '2025-10-09 08:18:48', '2025-10-09 08:18:48'),
(78, 17, 'saer_expire_at', 'car_files/1759997940_68e76ff40b0a3.pdf', '2025-10-09 08:19:00', '2025-10-09 08:19:00'),
(79, 3, 'saer_expire_at', 'car_files/1759997956_68e77004a809c.jpg', '2025-10-09 08:19:16', '2025-10-09 08:19:16'),
(80, 28, 'saer_expire_at', 'car_files/1759997979_68e7701b61194.pdf', '2025-10-09 08:19:39', '2025-10-09 08:19:39'),
(81, 4, 'saer_expire_at', 'car_files/1759997982_68e7701e832cf.jpg', '2025-10-09 08:19:42', '2025-10-09 08:19:42'),
(82, 5, 'saer_expire_at', 'car_files/1759998007_68e77037dfb19.jpg', '2025-10-09 08:20:07', '2025-10-09 08:20:07'),
(83, 20, 'saer_expire_at', 'car_files/1759998013_68e7703d29a1f.pdf', '2025-10-09 08:20:13', '2025-10-09 08:20:13'),
(84, 6, 'saer_expire_at', 'car_files/1759998030_68e7704ee09cb.jpg', '2025-10-09 08:20:30', '2025-10-09 08:20:30'),
(85, 18, 'saer_expire_at', 'car_files/1759998045_68e7705dc1c1b.pdf', '2025-10-09 08:20:45', '2025-10-09 08:20:45'),
(86, 7, 'saer_expire_at', 'car_files/1759998058_68e7706a06d57.jpg', '2025-10-09 08:20:58', '2025-10-09 08:20:58'),
(87, 16, 'saer_expire_at', 'car_files/1759998081_68e770810d745.pdf', '2025-10-09 08:21:21', '2025-10-09 08:21:21'),
(88, 8, 'saer_expire_at', 'car_files/1759998087_68e77087c4ee0.jpg', '2025-10-09 08:21:27', '2025-10-09 08:21:27'),
(89, 9, 'saer_expire_at', 'car_files/1759998120_68e770a887f2a.jpg', '2025-10-09 08:22:00', '2025-10-09 08:22:00'),
(90, 10, 'saer_expire_at', 'car_files/1759998145_68e770c1d12cd.jpg', '2025-10-09 08:22:25', '2025-10-09 08:22:25'),
(91, 11, 'saer_expire_at', 'car_files/1759998172_68e770dc58649.jpg', '2025-10-09 08:22:52', '2025-10-09 08:22:52'),
(92, 15, 'saer_expire_at', 'car_files/1759998195_68e770f3417d0.pdf', '2025-10-09 08:23:15', '2025-10-09 08:23:15'),
(93, 12, 'saer_expire_at', 'car_files/1759998200_68e770f85b716.jpg', '2025-10-09 08:23:20', '2025-10-09 08:23:20'),
(94, 14, 'saer_expire_at', 'car_files/1759998211_68e7710328278.pdf', '2025-10-09 08:23:31', '2025-10-09 08:23:31'),
(95, 13, 'saer_expire_at', 'car_files/1759998226_68e7711291956.jpg', '2025-10-09 08:23:46', '2025-10-09 08:23:46'),
(96, 2, 'tamen_expire_at', 'car_files/1759998261_68e77135697e6.jpg', '2025-10-09 08:24:21', '2025-10-09 08:24:21'),
(97, 5, 'tamen_expire_at', 'car_files/1759998290_68e77152b637a.jpg', '2025-10-09 08:24:50', '2025-10-09 08:24:50'),
(98, 6, 'tamen_expire_at', 'car_files/1759998318_68e7716ec6f74.jpg', '2025-10-09 08:25:18', '2025-10-09 08:25:18'),
(99, 7, 'tamen_expire_at', 'car_files/1759998360_68e771983b26a.jpg', '2025-10-09 08:26:00', '2025-10-09 08:26:00'),
(100, 12, 'tamen_expire_at', 'car_files/1759998383_68e771af8b6d3.jpg', '2025-10-09 08:26:23', '2025-10-09 08:26:23'),
(101, 13, 'tamen_expire_at', 'car_files/1759998414_68e771cee5177.jpg', '2025-10-09 08:26:54', '2025-10-09 08:26:54'),
(102, 15, 'tamen_expire_at', 'car_files/1759998438_68e771e6cf171.jpg', '2025-10-09 08:27:18', '2025-10-09 08:27:18'),
(103, 17, 'tamen_expire_at', 'car_files/1759998463_68e771ff63567.jpg', '2025-10-09 08:27:43', '2025-10-09 08:27:43'),
(104, 18, 'tamen_expire_at', 'car_files/1759998486_68e77216b1125.jpg', '2025-10-09 08:28:06', '2025-10-09 08:28:06'),
(105, 20, 'tamen_expire_at', 'car_files/1759998511_68e7722feec5f.jpg', '2025-10-09 08:28:31', '2025-10-09 08:28:31'),
(106, 28, 'tamen_expire_at', 'car_files/1759998533_68e772458cb39.jpg', '2025-10-09 08:28:53', '2025-10-09 08:28:53'),
(107, 33, 'tamen_expire_at', 'car_files/1759998560_68e7726093f2f.jpg', '2025-10-09 08:29:20', '2025-10-09 08:29:20'),
(108, 1, 'fahs_expire_at', 'car_files/1759998584_68e77278d9c45.jpg', '2025-10-09 08:29:44', '2025-10-09 08:29:44'),
(109, 2, 'fahs_expire_at', 'car_files/1759998609_68e77291e352c.jpg', '2025-10-09 08:30:09', '2025-10-09 08:30:09'),
(110, 3, 'fahs_expire_at', 'car_files/1759998633_68e772a9864b6.jpg', '2025-10-09 08:30:33', '2025-10-09 08:30:33'),
(111, 5, 'fahs_expire_at', 'car_files/1759998654_68e772be2771f.jpg', '2025-10-09 08:30:54', '2025-10-09 08:30:54'),
(112, 6, 'fahs_expire_at', 'car_files/1759998676_68e772d46ad6c.jpg', '2025-10-09 08:31:16', '2025-10-09 08:31:16'),
(113, 2, 'tafwed_expire_at', 'car_files/1759998690_68e772e2de3ae.pdf', '2025-10-09 08:31:30', '2025-10-09 08:31:30'),
(114, 7, 'fahs_expire_at', 'car_files/1759998700_68e772ec30b05.jpg', '2025-10-09 08:31:40', '2025-10-09 08:31:40'),
(115, 5, 'tafwed_expire_at', 'car_files/1759998725_68e7730598a88.pdf', '2025-10-09 08:32:05', '2025-10-09 08:32:05'),
(116, 8, 'fahs_expire_at', 'car_files/1759998725_68e77305cba77.jpg', '2025-10-09 08:32:05', '2025-10-09 08:32:05'),
(117, 9, 'fahs_expire_at', 'car_files/1759998749_68e7731de554b.jpg', '2025-10-09 08:32:29', '2025-10-09 08:32:29'),
(118, 7, 'tafwed_expire_at', 'car_files/1759998750_68e7731e31a59.pdf', '2025-10-09 08:32:30', '2025-10-09 08:32:30'),
(119, 10, 'fahs_expire_at', 'car_files/1759998770_68e773323f39f.jpg', '2025-10-09 08:32:50', '2025-10-09 08:32:50'),
(120, 9, 'tafwed_expire_at', 'car_files/1759998787_68e7734302674.pdf', '2025-10-09 08:33:07', '2025-10-09 08:33:07'),
(121, 11, 'fahs_expire_at', 'car_files/1759998795_68e7734b0b63d.jpg', '2025-10-09 08:33:15', '2025-10-09 08:33:15'),
(122, 12, 'fahs_expire_at', 'car_files/1759998819_68e773637f4f3.jpg', '2025-10-09 08:33:39', '2025-10-09 08:33:39'),
(123, 13, 'fahs_expire_at', 'car_files/1759998843_68e7737bd55c2.jpg', '2025-10-09 08:34:03', '2025-10-09 08:34:03'),
(124, 15, 'fahs_expire_at', 'car_files/1759998864_68e77390ee1c3.jpg', '2025-10-09 08:34:24', '2025-10-09 08:34:24'),
(125, 1, 'tamen_expire_at', 'car_files/1759998879_68e7739fb4aa4.pdf', '2025-10-09 08:34:39', '2025-10-09 08:34:39'),
(126, 17, 'fahs_expire_at', 'car_files/1759998888_68e773a80c532.jpg', '2025-10-09 08:34:48', '2025-10-09 08:34:48'),
(127, 18, 'fahs_expire_at', 'car_files/1759998910_68e773beb28c3.jpg', '2025-10-09 08:35:10', '2025-10-09 08:35:10'),
(128, 20, 'fahs_expire_at', 'car_files/1759998936_68e773d853220.jpg', '2025-10-09 08:35:36', '2025-10-09 08:35:36'),
(129, 3, 'tamen_expire_at', 'car_files/1759998937_68e773d945319.pdf', '2025-10-09 08:35:37', '2025-10-09 08:35:37'),
(130, 28, 'fahs_expire_at', 'car_files/1759998959_68e773ef1cd01.jpg', '2025-10-09 08:35:59', '2025-10-09 08:35:59'),
(131, 4, 'tamen_expire_at', 'car_files/1759998980_68e77404672e0.pdf', '2025-10-09 08:36:20', '2025-10-09 08:36:20'),
(132, 33, 'fahs_expire_at', 'car_files/1759998983_68e774075281d.jpg', '2025-10-09 08:36:23', '2025-10-09 08:36:23'),
(133, 8, 'tamen_expire_at', 'car_files/1759999021_68e7742d74b76.pdf', '2025-10-09 08:37:01', '2025-10-09 08:37:01'),
(134, 11, 'tamen_expire_at', 'car_files/1759999068_68e7745c3bec6.pdf', '2025-10-09 08:37:48', '2025-10-09 08:37:48'),
(135, 15, 'cart_expire_at', 'car_files/1759999531_68e7762b34174.pdf', '2025-10-09 08:45:31', '2025-10-09 08:45:31'),
(136, 17, 'cart_expire_at', 'car_files/1759999619_68e7768398305.pdf', '2025-10-09 08:46:59', '2025-10-09 08:46:59'),
(137, 6, 'cart_expire_at', 'car_files/1759999712_68e776e022c05.pdf', '2025-10-09 08:48:32', '2025-10-09 08:48:32'),
(138, 4, 'cart_expire_at', 'car_files/1759999782_68e7772674fb4.pdf', '2025-10-09 08:49:42', '2025-10-09 08:49:42'),
(139, 3, 'cart_expire_at', 'car_files/1759999894_68e77796dc560.pdf', '2025-10-09 08:51:34', '2025-10-09 08:51:34'),
(140, 18, 'cart_expire_at', 'car_files/1759999989_68e777f538aa4.pdf', '2025-10-09 08:53:09', '2025-10-09 08:53:09'),
(141, 10, 'cart_expire_at', 'car_files/1760000067_68e778432a98e.pdf', '2025-10-09 08:54:27', '2025-10-09 08:54:27'),
(142, 8, 'cart_expire_at', 'car_files/1760000159_68e7789f194c4.pdf', '2025-10-09 08:55:59', '2025-10-09 08:55:59'),
(143, 1, 'cart_expire_at', 'car_files/1760000276_68e779141146c.pdf', '2025-10-09 08:57:56', '2025-10-09 08:57:56'),
(144, 11, 'cart_expire_at', 'car_files/1760000353_68e779619894c.pdf', '2025-10-09 08:59:13', '2025-10-09 08:59:13'),
(145, 7, 'cart_expire_at', 'car_files/1760000502_68e779f6bed75.pdf', '2025-10-09 09:01:42', '2025-10-09 09:01:42'),
(146, 16, 'cart_expire_at', 'car_files/1760000580_68e77a445d8bc.pdf', '2025-10-09 09:03:00', '2025-10-09 09:03:00'),
(147, 2, 'cart_expire_at', 'car_files/1760000643_68e77a83c1475.pdf', '2025-10-09 09:04:03', '2025-10-09 09:04:03'),
(148, 28, 'cart_expire_at', 'car_files/1760000765_68e77afd4c118.pdf', '2025-10-09 09:06:05', '2025-10-09 09:06:05'),
(149, 14, 'cart_expire_at', 'car_files/1760000838_68e77b46c31c9.pdf', '2025-10-09 09:07:18', '2025-10-09 09:07:18'),
(150, 5, 'cart_expire_at', 'car_files/1760000893_68e77b7dea297.pdf', '2025-10-09 09:08:13', '2025-10-09 09:08:13'),
(151, 20, 'cart_expire_at', 'car_files/1760000997_68e77be5c71a1.pdf', '2025-10-09 09:09:57', '2025-10-09 09:09:57'),
(152, 33, 'cart_expire_at', 'car_files/1760001076_68e77c34a67df.pdf', '2025-10-09 09:11:16', '2025-10-09 09:11:16'),
(153, 9, 'cart_expire_at', 'car_files/1760001137_68e77c717c451.pdf', '2025-10-09 09:12:17', '2025-10-09 09:12:17'),
(154, 12, 'cart_expire_at', 'car_files/1760001207_68e77cb731ad1.pdf', '2025-10-09 09:13:27', '2025-10-09 09:13:27'),
(155, 34, 'cart_expire_at', 'car_files/1760001374_68e77d5e30700.pdf', '2025-10-09 09:16:14', '2025-10-09 09:16:14'),
(156, 33, 'saer_expire_at', 'car_files/1760172773_68ea1ae59ac00.pdf', '2025-10-11 08:52:53', '2025-10-11 08:52:53'),
(157, 33, 'fahs_expire_at', 'car_files/1760173034_68ea1bea3713d.pdf', '2025-10-11 08:57:14', '2025-10-11 08:57:14'),
(158, 33, 'tamen_expire_at', 'car_files/1760173060_68ea1c04b394f.pdf', '2025-10-11 08:57:40', '2025-10-11 08:57:40'),
(159, 14, 'saer_expire_at', 'car_files/1760173137_68ea1c5196dba.pdf', '2025-10-11 08:58:57', '2025-10-11 08:58:57'),
(160, 14, 'fahs_expire_at', 'car_files/1760173187_68ea1c8399447.pdf', '2025-10-11 08:59:47', '2025-10-11 08:59:47'),
(161, 14, 'tamen_expire_at', 'car_files/1760173215_68ea1c9f4daf1.pdf', '2025-10-11 09:00:15', '2025-10-11 09:00:15'),
(162, 16, 'saer_expire_at', 'car_files/1760173276_68ea1cdc13f2a.pdf', '2025-10-11 09:01:16', '2025-10-11 09:01:16'),
(163, 16, 'fahs_expire_at', 'car_files/1760173311_68ea1cff8cbdd.pdf', '2025-10-11 09:01:51', '2025-10-11 09:01:51'),
(164, 16, 'tamen_expire_at', 'car_files/1760173342_68ea1d1e3013e.pdf', '2025-10-11 09:02:22', '2025-10-11 09:02:22'),
(165, 28, 'saer_expire_at', 'car_files/1760173420_68ea1d6c60d16.pdf', '2025-10-11 09:03:40', '2025-10-11 09:03:40'),
(166, 28, 'fahs_expire_at', 'car_files/1760173468_68ea1d9c1ccbd.pdf', '2025-10-11 09:04:28', '2025-10-11 09:04:28'),
(167, 28, 'tamen_expire_at', 'car_files/1760173495_68ea1db7e5645.pdf', '2025-10-11 09:04:55', '2025-10-11 09:04:55'),
(168, 13, 'saer_expire_at', 'car_files/1760173549_68ea1ded7edda.pdf', '2025-10-11 09:05:49', '2025-10-11 09:05:49'),
(169, 13, 'fahs_expire_at', 'car_files/1760173606_68ea1e26d93ae.pdf', '2025-10-11 09:06:46', '2025-10-11 09:06:46'),
(170, 13, 'tamen_expire_at', 'car_files/1760173634_68ea1e423de9c.pdf', '2025-10-11 09:07:14', '2025-10-11 09:07:14'),
(171, 12, 'saer_expire_at', 'car_files/1760173687_68ea1e770b603.pdf', '2025-10-11 09:08:07', '2025-10-11 09:08:07'),
(172, 12, 'fahs_expire_at', 'car_files/1760173760_68ea1ec04fbde.pdf', '2025-10-11 09:09:20', '2025-10-11 09:09:20'),
(173, 12, 'tamen_expire_at', 'car_files/1760173791_68ea1edf990aa.pdf', '2025-10-11 09:09:51', '2025-10-11 09:09:51'),
(174, 20, 'saer_expire_at', 'car_files/1760173868_68ea1f2cf339f.pdf', '2025-10-11 09:11:08', '2025-10-11 09:11:08'),
(175, 20, 'fahs_expire_at', 'car_files/1760173921_68ea1f610a11e.pdf', '2025-10-11 09:12:01', '2025-10-11 09:12:01'),
(176, 20, 'tamen_expire_at', 'car_files/1760173952_68ea1f80c2f8a.pdf', '2025-10-11 09:12:32', '2025-10-11 09:12:32'),
(177, 2, 'saer_expire_at', 'car_files/1760174057_68ea1fe9e5e52.pdf', '2025-10-11 09:14:17', '2025-10-11 09:14:17'),
(178, 2, 'fahs_expire_at', 'car_files/1760174114_68ea202216b1b.pdf', '2025-10-11 09:15:14', '2025-10-11 09:15:14'),
(179, 2, 'tamen_expire_at', 'car_files/1760174139_68ea203b16a59.pdf', '2025-10-11 09:15:39', '2025-10-11 09:15:39'),
(180, 7, 'saer_expire_at', 'car_files/1760174210_68ea2082043c4.pdf', '2025-10-11 09:16:50', '2025-10-11 09:16:50'),
(181, 7, 'fahs_expire_at', 'car_files/1760174282_68ea20caa92ee.pdf', '2025-10-11 09:18:02', '2025-10-11 09:18:02'),
(182, 7, 'tamen_expire_at', 'car_files/1760174332_68ea20fc4df89.pdf', '2025-10-11 09:18:52', '2025-10-11 09:18:52'),
(183, 9, 'saer_expire_at', 'car_files/1760174449_68ea2171dc804.pdf', '2025-10-11 09:20:49', '2025-10-11 09:20:49'),
(184, 9, 'fahs_expire_at', 'car_files/1760174544_68ea21d06db50.pdf', '2025-10-11 09:22:24', '2025-10-11 09:22:24'),
(185, 9, 'tamen_expire_at', 'car_files/1760174663_68ea22473bd81.pdf', '2025-10-11 09:24:23', '2025-10-11 09:24:23'),
(186, 5, 'saer_expire_at', 'car_files/1760175455_68ea255fd9d21.pdf', '2025-10-11 09:37:35', '2025-10-11 09:37:35'),
(187, 5, 'fahs_expire_at', 'car_files/1760175532_68ea25ac45df3.pdf', '2025-10-11 09:38:52', '2025-10-11 09:38:52'),
(188, 5, 'tamen_expire_at', 'car_files/1760175579_68ea25db3159f.pdf', '2025-10-11 09:39:39', '2025-10-11 09:39:39'),
(189, 34, 'saer_expire_at', 'car_files/1760175662_68ea262ec7eba.pdf', '2025-10-11 09:41:02', '2025-10-11 09:41:02'),
(190, 34, 'fahs_expire_at', 'car_files/1760175709_68ea265dcdbc9.pdf', '2025-10-11 09:41:49', '2025-10-11 09:41:49'),
(191, 34, 'tamen_expire_at', 'car_files/1760175732_68ea267411144.pdf', '2025-10-11 09:42:12', '2025-10-11 09:42:12'),
(192, 8, 'saer_expire_at', 'car_files/1760175937_68ea2741150b9.pdf', '2025-10-11 09:45:37', '2025-10-11 09:45:37'),
(193, 8, 'fahs_expire_at', 'car_files/1760175978_68ea276a37a2a.pdf', '2025-10-11 09:46:18', '2025-10-11 09:46:18'),
(194, 8, 'tamen_expire_at', 'car_files/1760176005_68ea27852b76b.pdf', '2025-10-11 09:46:45', '2025-10-11 09:46:45'),
(195, 11, 'saer_expire_at', 'car_files/1760176067_68ea27c31fbec.pdf', '2025-10-11 09:47:47', '2025-10-11 09:47:47'),
(196, 11, 'fahs_expire_at', 'car_files/1760176116_68ea27f487fec.pdf', '2025-10-11 09:48:36', '2025-10-11 09:48:36'),
(197, 11, 'tamen_expire_at', 'car_files/1760176141_68ea280d0c9a0.pdf', '2025-10-11 09:49:01', '2025-10-11 09:49:01'),
(198, 1, 'saer_expire_at', 'car_files/1760176221_68ea285d0d063.pdf', '2025-10-11 09:50:21', '2025-10-11 09:50:21'),
(199, 1, 'fahs_expire_at', 'car_files/1760176272_68ea2890839e1.pdf', '2025-10-11 09:51:12', '2025-10-11 09:51:12'),
(200, 1, 'tamen_expire_at', 'car_files/1760176296_68ea28a8c5d3c.pdf', '2025-10-11 09:51:36', '2025-10-11 09:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `car_drivers`
--

CREATE TABLE `car_drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `handover_date` varchar(255) DEFAULT NULL,
  `initial_meter_reading` decimal(8,2) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `final_meter_reading` decimal(8,2) DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_drivers`
--

INSERT INTO `car_drivers` (`id`, `handover_date`, `initial_meter_reading`, `return_date`, `final_meter_reading`, `car_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, '2025-02-25', 702282.00, '2025-05-10', 715523.00, 10, 17, '2025-03-04 12:36:45', '2025-05-10 21:35:48'),
(2, '2025-02-02', 575480.00, '2025-02-25', 585942.00, 4, 18, '2025-03-04 12:43:43', '2025-03-04 13:18:08'),
(3, '2024-10-19', 363274.00, NULL, NULL, 3, 19, '2025-03-04 13:35:27', '2025-03-04 13:35:27'),
(4, '2025-01-30', 564876.00, '2025-04-12', 573229.00, 11, 11, '2025-03-06 12:56:02', '2025-04-13 18:31:07'),
(5, '2025-04-13', 573229.00, '2025-04-13', 573229.00, 11, 30, '2025-04-13 18:31:49', '2025-04-13 19:43:39'),
(6, '2025-04-20', 372111.00, '2025-04-20', 372111.00, 6, 11, '2025-04-19 21:59:50', '2025-05-04 17:04:39'),
(7, '2025-05-04', 372111.00, NULL, NULL, 6, 44, '2025-05-04 17:05:20', '2025-05-04 17:05:20'),
(8, '2025-05-11', 573229.00, NULL, NULL, 11, 17, '2025-05-10 22:02:55', '2025-05-10 22:02:55'),
(9, '2024-01-01', 5000.00, '2025-08-03', 225162.00, 18, 24, '2025-05-27 20:12:46', '2025-08-03 17:44:57'),
(10, '2025-01-01', 50000.00, '2025-07-12', 224120.00, 17, 4, '2025-05-27 20:14:16', '2025-07-12 20:12:12'),
(11, '2025-05-01', 0.00, NULL, NULL, 1, 7, '2025-06-01 18:02:21', '2025-06-01 18:02:21'),
(12, '2025-05-01', 0.00, NULL, NULL, 8, 20, '2025-06-01 18:04:06', '2025-06-01 18:04:06'),
(13, '2025-05-01', 0.00, NULL, NULL, 13, 43, '2025-06-01 18:05:59', '2025-06-01 18:05:59'),
(14, '2025-05-01', 0.00, NULL, NULL, 7, 8, '2025-06-01 18:07:35', '2025-06-01 18:07:35'),
(15, '2025-05-01', 0.00, NULL, NULL, 9, 21, '2025-06-01 18:08:29', '2025-06-01 18:08:29'),
(16, '2025-05-01', 0.00, NULL, NULL, 12, 27, '2025-06-01 18:09:31', '2025-06-01 18:09:31'),
(17, '2025-05-01', 0.00, NULL, NULL, 2, 3, '2025-06-01 18:10:14', '2025-06-01 18:10:14'),
(18, '2025-05-01', 0.00, NULL, NULL, 5, 29, '2025-06-01 18:10:54', '2025-06-01 18:10:54'),
(19, '2025-05-01', 0.00, NULL, NULL, 20, 15, '2025-06-01 18:11:49', '2025-06-01 18:11:49'),
(20, '2025-05-01', 0.00, NULL, NULL, 14, 12, '2025-06-01 18:12:35', '2025-06-01 18:12:35'),
(21, '2025-05-01', 0.00, NULL, NULL, 15, 23, '2025-06-01 18:13:17', '2025-06-01 18:13:17'),
(22, '2025-05-01', 0.00, '2025-08-31', 0.00, 16, 5, '2025-06-01 18:14:16', '2025-09-07 21:27:00'),
(23, '2025-05-01', 0.00, '2025-08-15', 126533.00, 28, 28, '2025-06-01 18:15:12', '2025-08-15 21:43:40'),
(24, '2025-07-12', 224120.00, NULL, NULL, 17, 67, '2025-07-12 20:17:55', '2025-07-12 20:17:55'),
(25, '2025-08-03', 225162.00, NULL, NULL, 18, 4, '2025-08-03 17:45:29', '2025-08-03 17:45:29'),
(26, '2025-07-27', 0.00, NULL, NULL, 33, 66, '2025-08-05 18:31:39', '2025-08-05 18:31:39'),
(27, '2025-08-15', 126533.00, NULL, NULL, 28, 5, '2025-08-15 21:41:55', '2025-08-15 21:41:55'),
(28, '2025-08-16', 592011.00, NULL, NULL, 11, 74, '2025-08-16 22:54:10', '2025-08-16 22:54:10'),
(29, '2025-07-28', 0.00, NULL, NULL, 33, 66, '2025-09-07 21:25:10', '2025-09-07 21:25:10'),
(30, '2025-08-31', 0.00, NULL, NULL, 16, 72, '2025-09-07 21:27:31', '2025-09-07 21:27:31'),
(31, '2025-09-12', 232822.00, '2025-09-12', 232822.00, 18, 78, '2025-09-11 20:26:48', '2025-09-12 16:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `car_maintenances`
--

CREATE TABLE `car_maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `maintenance_type` varchar(255) NOT NULL,
  `odometer_reading` int(11) NOT NULL,
  `invoice_image` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_registration_number` varchar(255) NOT NULL,
  `company_type` varchar(255) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `license_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `company_name`, `company_registration_number`, `company_type`, `company_location`, `license_image`, `created_at`, `updated_at`) VALUES
(26, 32, 'شركة روز للنقل البري', '7949495999', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-05-29 09:09:02', '2025-06-09 18:48:46'),
(33, 40, 'شركة الجواب للنقل البري', '7003669004', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-03 09:29:29', '2025-06-11 07:18:32'),
(50, 58, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-10 19:49:08', '2025-08-24 20:45:42'),
(54, 62, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-11 17:57:46', '2025-06-11 17:57:46'),
(55, 65, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-11 18:11:15', '2025-06-11 18:11:15'),
(56, 68, 'Tech Transport', '7123456789', NULL, NULL, NULL, '2025-06-12 19:36:23', '2025-08-23 22:06:31'),
(57, 69, 'Tech Transport', '7123456789', NULL, NULL, NULL, '2025-06-12 20:29:21', '2025-06-24 17:35:35'),
(58, 70, 'موسسة الروض المربع التجاريه', '7037647430', 'النقل المتخصص', 'عقلة الصقور', NULL, '2025-06-12 20:38:51', '2025-06-14 15:44:14'),
(59, 71, 'شركة الطلب العالي للنقل البري', '7000102744', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-12 20:42:03', '2025-06-14 16:00:32'),
(60, 72, 'شركة قلوب الاخوان لتنظيم الرحلات', '7001715155', 'vip_transportation', 'al-riyadh', NULL, '2025-06-12 21:06:47', '2025-06-14 16:11:19'),
(61, 73, 'موسسة كروة المطار للنقل البري', '7022051689', 'vip_transportation', 'al-riyadh', NULL, '2025-06-12 21:32:46', '2025-06-14 16:16:32'),
(62, 74, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 00:33:02', '2025-06-13 00:33:02'),
(63, 75, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 05:57:59', '2025-06-13 05:57:59'),
(64, 76, 'موسسة لمار للنقليات', '7123456789', 'vip_transportation', 'مكة المكرمه', NULL, '2025-06-13 08:56:09', '2025-06-14 16:55:56'),
(65, 77, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', 'مكة', NULL, '2025-06-13 10:44:25', '2025-08-23 19:46:23'),
(66, 78, 'مؤسسة الجواب للنقل البري', '7003669004', 'النقل المتخصص', 'المدينة', NULL, '2025-06-13 10:59:08', '2025-06-18 17:08:43'),
(67, 79, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 11:59:00', '2025-06-13 11:59:00'),
(68, 80, 'موسسة رحله المروة للخدمات اللوجستية', '7000102744', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:01:10', '2025-06-14 19:01:21'),
(69, 81, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:03:54', '2025-06-13 12:03:54'),
(70, 82, 'شركة حافظ طيبة للنقليات', '7040480894', 'النقل المتخصص', 'عقلة الصقور', NULL, '2025-06-13 12:14:31', '2025-06-14 18:54:57'),
(71, 83, 'شركة الف سهم للنقل البري', '7035886782', 'النقل المتخصص', 'عقلة الصقور', NULL, '2025-06-13 12:20:01', '2025-06-14 18:38:55'),
(72, 84, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:25:02', '2025-06-13 12:25:02'),
(73, 85, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:27:18', '2025-06-13 12:27:18'),
(74, 86, 'موسسة وليد حمد بن كلاب', '7034553474', 'النقل المتخصص', 'مكة', NULL, '2025-06-13 12:28:06', '2025-06-14 17:45:33'),
(75, 87, 'موسسة تركي حسن احمد حتحوت للنقليات', '7036342744', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:30:29', '2025-06-14 18:19:00'),
(76, 88, 'موسسة كروة المطار للنقل البري', '7022051689', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 12:41:36', '2025-06-14 18:28:01'),
(77, 89, 'شركة درع الحجاز للنقليات', '7038189572', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 13:05:15', '2025-06-14 18:24:10'),
(78, 90, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 13:14:11', '2025-06-13 13:14:11'),
(79, 91, 'موسسة خطوط الحجاز للنقل البري', '7034440045', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 13:23:22', '2025-06-14 18:49:17'),
(80, 92, 'شركة حافظ طيبة للنقليات', '7123456789', 'النقل المتخصص', 'القصيم عقلة الصقور', NULL, '2025-06-13 13:32:24', '2025-06-14 18:13:04'),
(81, 93, 'موسسة تغريد المدينه للنقليات', '7043548200', 'النقل المتخصص', 'جدة', NULL, '2025-06-13 13:41:04', '2025-06-14 18:01:25'),
(82, 94, 'شركة محمد يحي سميح للاجرة العامه', '7012370602', 'نقل متخصص', 'مكه', NULL, '2025-06-13 13:47:03', '2025-06-14 17:54:43'),
(83, 95, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 15:05:58', '2025-06-13 15:05:58'),
(84, 96, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 18:08:39', '2025-06-13 18:08:39'),
(85, 97, 'موسسة همس مساعد ابن سعد', '7032741956', 'النقل المتخصص', 'مكة', NULL, '2025-06-13 20:06:06', '2025-06-14 17:26:59'),
(86, 98, 'شركة الطلب المميز للنقل', '7034782149', 'النقل المتخصص', 'مكة', NULL, '2025-06-13 20:07:20', '2025-08-24 21:50:04'),
(87, 99, 'موسسة ميم مميز للنقليات', '7034236484', 'vip_transportation', 'al-riyadh', NULL, '2025-06-13 21:07:47', '2025-06-14 17:09:57'),
(88, 100, 'موسسة قود كار للنقليات', '7038658725', 'النقل المتخصص', 'مكة المكرمه', NULL, '2025-06-14 04:13:33', '2025-06-14 17:06:20'),
(89, 101, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 14:55:42', '2025-06-14 14:55:42'),
(90, 135, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:40:37', '2025-06-14 18:40:37'),
(91, 136, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:40:41', '2025-06-14 18:40:41'),
(92, 137, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:41:38', '2025-06-14 18:41:38'),
(93, 139, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:52:08', '2025-06-14 18:52:08'),
(94, 140, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:54:28', '2025-06-14 18:54:28'),
(95, 141, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 18:57:11', '2025-06-14 18:57:11'),
(96, 142, 'الطلب المميز للنقل', '7034782149', 'النقل المتخصص', 'مكة', NULL, '2025-06-14 18:58:36', '2025-08-24 21:16:59'),
(97, 143, 'شركه الطلب العالي للنقل البري', '7005795195', 'النقل المتخصص', 'المدينة', NULL, '2025-06-14 19:05:53', '2025-06-18 15:50:28'),
(98, 144, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:07:29', '2025-06-14 19:07:29'),
(99, 145, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:12:05', '2025-06-14 19:12:05'),
(100, 146, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:12:28', '2025-06-14 19:12:28'),
(101, 147, 'موسسة الطلب العالي للنقل البري', '7000102744', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:12:46', '2025-06-14 19:45:31'),
(102, 148, 'مؤسسة كود كار للنقليات', '7038658725', 'النقل المتخصص', 'مكه', NULL, '2025-06-14 19:17:09', '2025-06-18 15:55:18'),
(103, 149, 'شركة الطلب العالي للنقل البري شركة شخص واحد', '7005795195', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-14 19:17:15', '2025-06-14 19:37:15'),
(104, 150, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:19:13', '2025-06-14 19:19:13'),
(105, 151, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:28:46', '2025-06-14 19:28:46'),
(106, 152, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:30:45', '2025-06-14 19:30:45'),
(107, 153, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:47:14', '2025-06-14 19:47:14'),
(108, 154, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 19:50:50', '2025-06-14 19:50:50'),
(109, 155, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 20:01:20', '2025-06-14 20:01:20'),
(110, 156, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', NULL, NULL, '2025-06-14 20:03:11', '2025-08-23 21:16:48'),
(111, 157, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 20:07:43', '2025-06-14 20:07:43'),
(112, 158, 'مؤسسة ميم مميز للنقليات', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 20:43:42', '2025-06-18 16:05:07'),
(113, 159, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-14 20:52:37', '2025-06-14 20:52:37'),
(114, 160, 'مؤسسة حمد سليمان بن محمد الوقداني للنقل البري', '7040861176', 'النقل المتخصص', 'مكة', NULL, '2025-06-14 21:53:40', '2025-08-24 21:24:40'),
(115, 161, 'مؤسسة محمد نثار عبد العزيز الراعي للنقل البري', '7041760211', 'النقل المتخصص', 'مكه', NULL, '2025-06-15 04:53:11', '2025-06-18 16:13:09'),
(116, 162, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-15 05:35:18', '2025-06-15 05:35:18'),
(117, 163, 'مؤسسة رابطة الزخرف للنقل البري', '7035877294', 'النقل المتخصص', 'محافظة جدة', NULL, '2025-06-15 08:48:35', '2025-06-18 16:17:05'),
(118, 164, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-15 09:33:35', '2025-08-24 20:38:59'),
(119, 165, 'مؤسسة قلوب الاخوان للنقل البري', '7011252843', 'النقل المتخصص', 'مكة', NULL, '2025-06-15 13:49:17', '2025-06-18 16:27:43'),
(120, 166, 'مؤسسة يروا للمواد الغذائية', '7023911543', 'النقل المتخصص', 'محافظة الليث', NULL, '2025-06-15 14:36:42', '2025-06-18 16:31:08'),
(121, 167, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-16 09:32:40', '2025-06-16 09:32:40'),
(122, 168, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-16 09:49:45', '2025-06-16 09:49:45'),
(123, 169, 'مؤسسة نايف بن عبدالله بن عبد ربه الهذلي للنقليات', '7025497616', 'النقل المتخصص', NULL, NULL, '2025-06-16 16:03:51', '2025-06-18 16:54:04'),
(124, 170, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-16 17:50:21', '2025-06-16 17:50:21'),
(125, 171, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-16 17:54:04', '2025-08-23 21:02:55'),
(126, 172, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-17 08:37:09', '2025-06-17 08:37:09'),
(127, 173, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-17 11:04:02', '2025-06-17 11:04:02'),
(128, 174, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-22 03:49:43', '2025-06-22 03:49:43'),
(129, 176, 'مؤسسة ابداعات العبور للنقليات', '7123456789', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-06-26 20:56:35', '2025-07-06 17:56:35'),
(130, 177, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-06-28 09:38:43', '2025-06-28 09:38:43'),
(131, 179, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-07-02 16:39:41', '2025-07-02 16:39:41'),
(132, 181, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-07-10 17:35:09', '2025-07-10 17:35:09'),
(133, 184, 'شركة الجواب للنقل البري', '7033114567', 'الاجرة الخاصة', 'المدينة المنورة', NULL, '2025-08-17 23:06:58', '2025-08-23 22:01:26'),
(134, 186, 'شركة الجواب للنقل البري', '7033114567', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-08-18 21:32:39', '2025-08-24 21:09:56'),
(135, 187, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-08-19 00:20:16', '2025-08-19 00:20:16'),
(136, 188, 'شركة الجواب للنقل البري', '123', 'النقل المتخصص', 'المدينة المنورة', NULL, '2025-08-21 19:21:11', '2025-09-06 16:52:40'),
(137, 185, 'مؤسسة قود كار للنقليات', '7038658725', 'النقل المتخصص', 'مكة', NULL, '2025-08-24 19:47:42', '2025-08-24 19:47:42'),
(138, 189, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-08-24 20:55:34', '2025-08-24 20:55:34'),
(139, 190, 'Tech Transport', '7123456789', 'vip_transportation', 'al-riyadh', NULL, '2025-08-31 17:11:20', '2025-08-31 17:11:20'),
(140, 196, 'Tech Transport', '7123456789', 'نقل متخصص', 'الرياض', NULL, '2025-09-17 14:36:26', '2025-09-17 14:36:26'),
(141, 224, 'Tech Transport', '7123456789', 'VIP Transportation', 'al-riyadh', NULL, '2025-09-18 09:00:21', '2025-09-18 09:00:21'),
(142, 230, 'Tech Transport', '7123456789', 'VIP Transportation', 'al-riyadh', NULL, '2025-09-18 09:25:44', '2025-09-18 09:25:44'),
(143, 231, 'Tech Transport', '7123456789', 'نقل متخصص', 'الرياض', NULL, '2025-09-18 10:14:54', '2025-09-18 10:14:54'),
(144, 232, 'Tech Transport', '7123456789', 'نقل متخصص', 'الرياض', NULL, '2025-09-18 10:32:14', '2025-09-18 10:32:14'),
(145, 233, 'ةةفو', '785828', NULL, 'الدمام', NULL, '2025-09-18 14:38:03', '2025-09-18 14:38:03'),
(146, 238, 'MTH', '796596589', 'نقل متخصص', 'القصيم', NULL, '2025-09-20 12:33:00', '2025-09-20 12:33:00'),
(147, 239, 'الجواب', '78388306306830', 'نقل متخصص', 'جدة', NULL, '2025-09-21 06:31:41', '2025-09-21 06:31:41'),
(148, 240, 'Gfg', '784574', 'نقل متخصص', 'المدينة المنورة', NULL, '2025-09-21 06:40:14', '2025-09-21 06:40:14'),
(149, 249, 'Aljawab', '7868686838383', 'الأجرة الخاصة', 'المدينة المنورة', NULL, '2025-10-08 11:57:18', '2025-10-08 11:57:18'),
(150, 250, '3435345', '7543543', 'الأجرة الخاصة', 'جدة', NULL, '2025-10-08 13:06:47', '2025-10-08 13:06:47'),
(151, 251, 'megrg5', '75555', 'سيارات خاصة للمواطنين', 'الرياض', NULL, '2025-10-08 13:06:55', '2025-10-08 13:06:55'),
(152, 254, 'AZ', '795646161', 'سيارات خاصة للمقيمين', 'الدمام', NULL, '2025-10-08 14:59:53', '2025-10-08 14:59:53'),
(153, 257, 'AAA', '78382882822', 'النقل المتخصص', 'الدمام', NULL, '2025-10-14 05:17:11', '2025-10-14 05:17:11'),
(154, 258, 'Test Company', 'COMP123', 'Transport', 'Riyadh', NULL, '2025-10-16 05:52:25', '2025-10-16 05:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Ali Gul Chandio', '0583276321', 'chandioaligul41@gmail.com', 'Good Transport service Company', '2025-08-31 19:33:17', '2025-08-31 19:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `deletion_audit_log`
--

CREATE TABLE `deletion_audit_log` (
  `id` int(11) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_by` varchar(255) DEFAULT NULL,
  `connection_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deletion_audit_log`
--

INSERT INTO `deletion_audit_log` (`id`, `table_name`, `record_id`, `deleted_at`, `deleted_by`, `connection_info`) VALUES
(1, 'users', 4, '2025-10-02 08:47:08', 'root@localhost', 'Connection: 5684 | Host: localhost'),
(2, 'users', 2, '2025-10-02 08:47:08', 'root@localhost', 'Connection: 5684 | Host: localhost'),
(3, 'users', 21, '2025-10-02 08:47:08', 'root@localhost', 'Connection: 5684 | Host: localhost'),
(4, 'users', 4, '2025-10-02 09:22:34', 'root@localhost', 'Connection: 5727 | Host: localhost'),
(5, 'users', 2, '2025-10-02 09:22:34', 'root@localhost', 'Connection: 5727 | Host: localhost'),
(6, 'users', 5, '2025-10-02 09:22:34', 'root@localhost', 'Connection: 5727 | Host: localhost');

-- --------------------------------------------------------

--
-- Table structure for table `docs_files`
--

CREATE TABLE `docs_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `docs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `docs_files`
--

INSERT INTO `docs_files` (`id`, `file`, `docs_id`, `created_at`, `updated_at`, `text`, `user_name`) VALUES
(2, 'documents/1740336379_1740226214_استمارة طلب وظيفة - Copy.pdf', 1, '2025-02-23 16:46:19', '2025-02-23 16:46:19', NULL, NULL),
(3, 'documents/1740488739_FB_IMG_1740412906902.jpg', 9, '2025-02-25 13:05:39', '2025-02-25 13:05:39', NULL, NULL),
(4, 'documents/1740595270_سجل تجاري الجواب.pdf', 4, '2025-02-26 18:41:10', '2025-02-26 18:41:10', NULL, NULL),
(5, 'documents/1740665341_رخصة البلدية نقل متخصص (1).pdf', 2, '2025-02-27 14:09:01', '2025-02-27 14:09:01', NULL, NULL),
(6, 'documents/1740666117_شهادة التسجيل في ضريبة القيمة المضافة.pdf', 27, '2025-02-27 14:21:57', '2025-02-27 14:21:57', NULL, NULL),
(7, 'documents/1740666240_الاشتراك في الغرفة التجارية.pdf', 28, '2025-02-27 14:24:00', '2025-02-27 14:24:00', NULL, NULL),
(8, 'documents/1740666617_العنوان الوطني لشركة الجواب للنقل البري.jfif', 29, '2025-02-27 14:30:17', '2025-02-27 14:30:17', NULL, NULL),
(9, 'documents/1740666790_عقد ايجار.pdf', 30, '2025-02-27 14:33:10', '2025-02-27 14:33:10', NULL, NULL),
(10, 'documents/1740864397_مخالصة محمد رشد 31-03-2025.pdf', 81, '2025-03-01 21:26:37', '2025-03-01 21:26:37', NULL, NULL),
(11, 'documents/1740864619_مخالصة ارشاد علي  31-03-2025.pdf', 82, '2025-03-01 21:30:19', '2025-03-01 21:30:19', NULL, NULL),
(12, 'documents/1740869407_مخالصة محمد عربي بخش حتى تاريخ 31-03-2025.pdf', 83, '2025-03-01 22:50:07', '2025-03-01 22:50:07', NULL, NULL),
(13, 'documents/1740949118_مخالصة اسحاق علي 31-03-2025.pdf', 25, '2025-03-02 20:58:38', '2025-03-02 20:58:38', NULL, NULL),
(14, 'documents/1740949170_مخالصة اسحاق علي 31-03-2025.pdf', 84, '2025-03-02 20:59:30', '2025-03-02 20:59:30', NULL, NULL),
(15, 'documents/1740960837_مخالصة جعفر 31-03-2025.pdf', 85, '2025-03-03 00:13:57', '2025-03-03 00:13:57', NULL, NULL),
(16, 'documents/1740960976_مخالصة برويز 31-03-2025.pdf', 86, '2025-03-03 00:16:16', '2025-03-03 00:16:16', NULL, NULL),
(17, 'documents/1740961089_مخالصة محمد كاشف 31-03-2025.pdf', 87, '2025-03-03 00:18:09', '2025-03-03 00:18:09', NULL, NULL),
(18, 'documents/1740961280_مخالصة علي عباس 31-03-2025.pdf', 88, '2025-03-03 00:21:20', '2025-03-03 00:21:20', NULL, NULL),
(19, 'documents/1741078700_مخالصة محمد اصف 31-03-2025.pdf', 89, '2025-03-04 08:58:20', '2025-03-04 08:58:20', NULL, NULL),
(20, 'documents/1741258064_مخالصة نائف محمد 31-03-2025.pdf', 119, '2025-03-06 10:47:44', '2025-03-06 10:47:44', NULL, NULL),
(21, 'documents/1741265404_مخالصة محمد جنيد 31-03-2025.pdf', 121, '2025-03-06 12:50:04', '2025-03-06 12:50:04', NULL, NULL),
(22, 'documents/1741265520_مخالصة سعيد احمد رازا 31-03-2025.pdf', 122, '2025-03-06 12:52:00', '2025-03-06 12:52:00', NULL, NULL),
(23, 'documents/1741700910_سند لامر  رقم 009 نبيل شنجند حمزة بمبلغ 30 الف.pdf', 190, '2025-03-11 13:48:30', '2025-03-11 13:48:30', NULL, NULL),
(24, 'documents/1741701149_سند لامر رقم 0014 سعيد احمد رازا بمبلغ 7422.pdf', 191, '2025-03-11 13:52:29', '2025-03-11 13:52:29', NULL, NULL),
(26, 'documents/1742212277_اقرار بصحة سند لامر نبيل بمبلغ 30000.pdf', 190, '2025-03-17 11:51:17', '2025-03-17 11:51:17', NULL, NULL),
(27, 'documents/1742212486_اقرار بصحة سند سعيد احمد رازا.pdf', 191, '2025-03-17 11:54:46', '2025-03-17 11:54:46', NULL, NULL),
(28, 'documents/1742227702_1.JPG', 13, '2025-03-17 16:08:22', '2025-03-17 16:08:22', NULL, NULL),
(29, 'documents/1742227839_2.JPG', 13, '2025-03-17 16:10:39', '2025-03-17 16:10:39', NULL, NULL),
(30, 'documents/1743593796_sara.pdf', 205, '2025-04-02 11:36:36', '2025-04-02 11:36:36', NULL, NULL),
(31, 'documents/1746644854_2216.pdf', 33, '2025-05-07 19:07:34', '2025-05-07 19:07:34', NULL, 'ابو يحي '),
(32, 'documents/1746644899_5066.pdf', 45, '2025-05-07 19:08:19', '2025-05-07 19:08:19', NULL, 'ابو يحي '),
(33, 'documents/1746644985_6580.pdf', 46, '2025-05-07 19:09:45', '2025-05-07 19:09:45', NULL, 'ابو يحي '),
(34, 'documents/1746645007_6581.pdf', 47, '2025-05-07 19:10:07', '2025-05-07 19:10:07', NULL, 'ابو يحي '),
(35, 'documents/1746645046_6524.pdf', 201, '2025-05-07 19:10:46', '2025-05-07 19:10:46', NULL, 'ابو يحي '),
(36, 'documents/1746645080_4293.pdf', 32, '2025-05-07 19:11:20', '2025-05-07 19:11:20', NULL, 'ابو يحي '),
(37, 'documents/1746645122_5456.pdf', 42, '2025-05-07 19:12:02', '2025-05-07 19:12:02', NULL, 'ابو يحي '),
(38, 'documents/1746645140_5460.pdf', 35, '2025-05-07 19:12:20', '2025-05-07 19:12:20', NULL, 'ابو يحي '),
(39, 'documents/1746645158_5757.pdf', 41, '2025-05-07 19:12:38', '2025-05-07 19:12:38', NULL, 'ابو يحي '),
(40, 'documents/1746645172_5767.pdf', 39, '2025-05-07 19:12:52', '2025-05-07 19:12:52', NULL, 'ابو يحي '),
(41, 'documents/1746645189_2850.pdf', 43, '2025-05-07 19:13:09', '2025-05-07 19:13:09', NULL, 'ابو يحي '),
(42, 'documents/1746645203_8514.pdf', 40, '2025-05-07 19:13:23', '2025-05-07 19:13:23', NULL, 'ابو يحي '),
(43, 'documents/1746645219_8719.pdf', 49, '2025-05-07 19:13:39', '2025-05-07 19:13:39', NULL, 'ابو يحي '),
(44, 'documents/1746645231_1815.pdf', 44, '2025-05-07 19:13:51', '2025-05-07 19:13:51', NULL, 'ابو يحي '),
(45, 'documents/1746645251_8513.pdf', 38, '2025-05-07 19:14:11', '2025-05-07 19:14:11', NULL, 'ابو يحي '),
(46, 'documents/1746645325_8111.pdf', 34, '2025-05-07 19:15:25', '2025-05-07 19:15:25', NULL, 'ابو يحي '),
(47, 'documents/1746645337_8726.pdf', 37, '2025-05-07 19:15:37', '2025-05-07 19:15:37', NULL, 'ابو يحي '),
(48, 'documents/1746645351_2212.pdf', 36, '2025-05-07 19:15:51', '2025-05-07 19:15:51', NULL, 'ابو يحي '),
(49, 'documents/1746645437_ﺑﺮﻭﻳﺰ ﺍﺧﺘﺮ ﻓﻠﻚ ﺷﻴﺮ.pdf', 53, '2025-05-07 19:17:17', '2025-05-07 19:17:17', NULL, 'ابو يحي '),
(50, 'documents/1746645463_ﺍﺳﺤﺎﻕ ﻋﻠﻲ ﻗﺎﺳﻢ ﻋﻠﻲ.pdf', 99, '2025-05-07 19:17:43', '2025-05-07 19:17:43', NULL, 'ابو يحي '),
(51, 'documents/1746645477_ﺟﻌﻔﺮ ﻋﺒﺪﺍﻟﻤﺆﻣﻦ ﻋﻤﺮ ﺳﻠﻴﻤﺎﻥ.pdf', 51, '2025-05-07 19:17:57', '2025-05-07 19:17:57', NULL, 'ابو يحي '),
(52, 'documents/1746645493_ﺣﻤﺰﺓ ﻣﺤﻤﻮﺩ ﻣﺤﻤﺪ ﻣﺤﻤﻮﺩ.pdf', 55, '2025-05-07 19:18:13', '2025-05-07 19:18:13', NULL, 'ابو يحي '),
(53, 'documents/1746645514_ﻋﻠﻲ ﻋﺒﺎﺱ.pdf', 59, '2025-05-07 19:18:34', '2025-05-07 19:18:34', NULL, 'ابو يحي '),
(54, 'documents/1746645568_ﻓﺎﺭﻭﻕ ﺍﺣﻤﺪ ﺍﺣﻤﺪ ﺃﺣﻤﺪ ﺩﻳﻦ.pdf', 52, '2025-05-07 19:19:28', '2025-05-07 19:19:28', NULL, 'ابو يحي '),
(55, 'documents/1746645593_ﻓﻬﺪ ﻣﻬﻴﺎ ﻣﻬﻴﺎ ﻣﻬﻴﺎ ﺍﻟﻠﻪ.pdf', 58, '2025-05-07 19:19:53', '2025-05-07 19:19:53', NULL, 'ابو يحي '),
(56, 'documents/1746645652_ﻣﺤﻤﺪ ﺟﻨﻴﺪ ﺗﻮﻓﻴﻞ ﺭﻓﻴﻖ ﻣﺤﻤﺪ.pdf', 54, '2025-05-07 19:20:52', '2025-05-07 19:20:52', NULL, 'ابو يحي '),
(57, 'documents/1746645721_محمد ﺭﺷﺪ.pdf', 56, '2025-05-07 19:22:01', '2025-05-07 19:22:01', NULL, 'ابو يحي '),
(58, 'documents/1746645738_ﻣﺤﻤﺪ ﻛﺎﺷﻒ ﻫﺒﺪ ﺍﻟﺮﺷﻴﺪ.pdf', 57, '2025-05-07 19:22:18', '2025-05-07 19:22:18', NULL, 'ابو يحي '),
(59, 'documents/1746645753_ﻣﺤﻤﺪ ﻭﻗﺎﺹ ﻣﺤﻤﺪ ﻧﻈﻴﺮ.pdf', 192, '2025-05-07 19:22:33', '2025-05-07 19:22:33', NULL, 'ابو يحي '),
(60, 'documents/1752947561_1.pdf', 172, '2025-07-19 17:52:41', '2025-07-19 17:52:41', NULL, 'اسلام ناصف  '),
(62, 'documents/1752947938_0.pdf', 168, '2025-07-19 17:58:58', '2025-07-19 17:58:58', NULL, 'اسلام ناصف  '),
(63, 'documents/1752948040_لوحه 6524.pdf', 200, '2025-07-19 18:00:40', '2025-07-19 18:00:40', NULL, 'اسلام ناصف  '),
(64, 'documents/1752948075_لوحه 6244.pdf', 257, '2025-07-19 18:01:15', '2025-07-19 18:01:15', NULL, 'اسلام ناصف  '),
(65, 'documents/1752948107_لوحه8513.pdf', 166, '2025-07-19 18:01:47', '2025-07-19 18:01:47', NULL, 'اسلام ناصف  '),
(66, 'documents/1752948150_لوحه8513.pdf', 173, '2025-07-19 18:02:30', '2025-07-19 18:02:30', NULL, 'اسلام ناصف  '),
(67, 'documents/1753531793_قوه.pdf', 297, '2025-07-26 12:09:53', '2025-07-26 12:09:53', NULL, 'اسلام ناصف  '),
(68, 'documents/1753706231_فاتوره تصليح مكيف الشركه.pdf', 299, '2025-07-28 12:37:11', '2025-07-28 12:37:11', NULL, 'اسلام ناصف  '),
(69, 'documents/1753781767_سداد فاتوره اربع سيارات سند.pdf', 300, '2025-07-29 09:36:07', '2025-07-29 09:36:07', NULL, 'اسلام ناصف  '),
(70, 'documents/1753781878_وصل سيارات حق الربط مستند.pdf', 301, '2025-07-29 09:37:58', '2025-07-29 09:37:58', NULL, 'اسلام ناصف  '),
(71, 'documents/1753781972_وصل سيارات حق الربط مستند-compressed.pdf', 302, '2025-07-29 09:39:32', '2025-07-29 09:39:32', NULL, 'اسلام ناصف  '),
(72, 'documents/1754148891_فاتوره مشتريات شركه الجواب.pdf', 303, '2025-08-02 15:34:51', '2025-08-02 15:34:51', NULL, 'اسلام ناصف  '),
(73, 'documents/1754242704_فاتوره الوان طابعه شركه الجواب.pdf', 304, '2025-08-03 17:38:24', '2025-08-03 17:38:24', NULL, 'اسلام ناصف  '),
(74, 'documents/1754244509_إمحمد كاشف قرار تسليم مركبه 6580.pdf', 306, '2025-08-03 18:08:29', '2025-08-03 18:08:29', NULL, 'اسلام ناصف  '),
(75, 'documents/1754244553_إقرار تسليم مركبه نبيل شنجنذ 5456.pdf', 307, '2025-08-03 18:09:13', '2025-08-03 18:09:13', NULL, 'اسلام ناصف  '),
(76, 'documents/1754244584_-حسن معاوية-إقرار تسليم مركبة.pdf', 308, '2025-08-03 18:09:44', '2025-08-03 18:09:44', NULL, 'اسلام ناصف  '),
(77, 'documents/1754244648_photo_2025-08-03_20-41-22.jpg', 309, '2025-08-03 18:10:48', '2025-08-03 18:10:48', NULL, 'اسلام ناصف  '),
(78, 'documents/1754320263_ارساد.jpg', 310, '2025-08-04 15:11:03', '2025-08-04 15:11:03', NULL, 'اسلام ناصف  '),
(79, 'documents/1754320291_برويز اختر.jpg', 311, '2025-08-04 15:11:31', '2025-08-04 15:11:31', NULL, 'اسلام ناصف  '),
(80, 'documents/1754320317_اسحاق عليjpg.jpg', 312, '2025-08-04 15:11:57', '2025-08-04 15:11:57', NULL, 'اسلام ناصف  '),
(81, 'documents/1754592960_فاتوره شركه الجواب.pdf', 313, '2025-08-07 18:56:00', '2025-08-07 18:56:00', NULL, 'اسلام ناصف  '),
(82, 'documents/1759930247_68e667875cc34_vice-city-1986-fan-casting-poster-371912-medium.jpg', 315, '2025-10-08 13:30:47', '2025-10-08 13:30:47', NULL, 'Abdullah'),
(83, 'documents/1760432919_68ee1317c61d8_test.jpg', 316, '2025-10-14 06:08:39', '2025-10-14 06:08:39', NULL, 'Abdullah');

-- --------------------------------------------------------

--
-- Table structure for table `docs_types`
--

CREATE TABLE `docs_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `docs_types`
--

INSERT INTO `docs_types` (`id`, `name`, `created_at`, `updated_at`, `user_name`) VALUES
(1, 'السجل التجاري', '2025-02-23 16:39:25', '2025-02-23 16:39:25', NULL),
(2, 'رخصة البلدية', '2025-02-23 16:42:34', '2025-02-23 16:42:34', NULL),
(3, 'شهادة الزكاة والدخل', '2025-02-24 20:54:29', '2025-02-24 20:54:29', NULL),
(4, 'التأمينات الاجتماعية', '2025-02-24 20:54:47', '2025-03-05 08:54:56', NULL),
(5, 'شهادة الاشتراك في الغرفة التجارية', '2025-02-24 20:55:11', '2025-02-24 20:55:11', NULL),
(6, 'شهادة تسجيل في ضريبة القيمة المضافة', '2025-02-24 20:55:31', '2025-02-24 20:55:31', NULL),
(7, 'ترخيص أجرة عامة', '2025-02-24 20:55:42', '2025-02-24 20:55:42', NULL),
(8, 'ترخيص النقل المتخصص', '2025-02-24 20:55:56', '2025-02-24 20:55:56', NULL),
(10, 'اشتراك منصة مقيم', '2025-02-24 20:56:32', '2025-02-24 20:56:32', NULL),
(13, 'اشتراك سيارات النقل المتخصص', '2025-02-24 20:57:50', '2025-02-24 20:57:50', NULL),
(14, 'رخصة السير', '2025-02-24 20:58:05', '2025-02-24 20:58:05', NULL),
(15, 'الفحص الدوري', '2025-02-24 20:58:14', '2025-02-24 20:58:14', NULL),
(16, 'تامين مركبات', '2025-02-24 20:58:29', '2025-02-24 20:58:29', NULL),
(17, 'بطاقة تشغيل صادرة من الهيئة العامة للنقل', '2025-02-24 20:58:57', '2025-02-24 20:58:57', NULL),
(18, 'هوية مقيم', '2025-02-24 20:59:09', '2025-02-24 20:59:09', NULL),
(19, 'بطاقة سائق صادرة من الهيئة العامة للنقل', '2025-02-24 20:59:51', '2025-02-24 20:59:51', NULL),
(20, 'عقد منصة إيجار', '2025-02-24 21:01:28', '2025-02-24 21:01:28', NULL),
(22, 'نقل خدمات', '2025-02-24 21:22:24', '2025-02-24 21:22:24', NULL),
(23, '111111111', '2025-02-27 14:28:55', '2025-06-27 08:12:31', NULL),
(24, 'مخالصة', '2025-03-01 21:20:53', '2025-03-01 21:20:53', NULL),
(25, 'تغيير زيت محرك المركبة', '2025-03-04 13:23:22', '2025-03-04 13:23:22', NULL),
(26, 'تمويل نقدي', '2025-03-05 08:16:55', '2025-03-05 08:16:55', NULL),
(27, 'تمويل سيارة', '2025-03-05 08:21:18', '2025-03-05 08:21:18', NULL),
(28, 'عقد أجير', '2025-03-05 12:30:23', '2025-03-05 12:30:23', NULL),
(29, 'التشييك الاسبوعي للسيارات', '2025-03-05 12:36:42', '2025-03-09 11:51:10', NULL),
(30, 'سند لأمر - لدى الاطلاع', '2025-03-10 14:42:15', '2025-03-10 14:42:15', NULL),
(31, 'ترخيص الدفاع المدني', '2025-03-11 20:39:17', '2025-03-11 20:39:17', NULL),
(32, 'تعديل المهنه', '2025-04-02 05:35:18', '2025-04-02 05:35:18', NULL),
(33, 'مخالفات الهية العامه للنقل', '2025-04-09 16:40:53', '2025-04-09 16:40:53', 'admin'),
(34, 'شركة الجواب', '2025-06-26 09:10:14', '2025-06-27 08:20:17', 'اسلام ناصف  '),
(35, '111111222222', '2025-06-27 08:02:06', '2025-06-27 08:12:55', 'ابو احمد'),
(36, 'اقرار تسليم مركبة', '2025-08-03 17:49:47', '2025-08-03 17:49:47', 'اسلام ناصف  '),
(37, 'اقرار اعاده مركبة', '2025-08-03 17:50:00', '2025-08-03 17:50:00', 'اسلام ناصف  '),
(38, 'حساب ال Iban', '2025-08-04 15:06:40', '2025-08-04 15:06:40', 'اسلام ناصف  ');

-- --------------------------------------------------------

--
-- Table structure for table `docs_updates`
--

CREATE TABLE `docs_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `docs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `docs_updates`
--

INSERT INTO `docs_updates` (`id`, `docs_id`, `created_at`, `updated_at`, `user_name`) VALUES
(1, 115, '2025-04-03 15:59:46', '2025-04-03 15:59:46', NULL),
(2, 104, '2025-04-05 14:35:06', '2025-04-05 14:35:06', NULL),
(3, 114, '2025-04-05 15:27:57', '2025-04-05 15:27:57', NULL),
(4, 101, '2025-04-05 16:32:06', '2025-04-05 16:32:06', 'admin'),
(5, 113, '2025-04-05 16:52:55', '2025-04-05 16:52:55', 'admin'),
(6, 109, '2025-04-06 14:52:52', '2025-04-06 14:52:52', 'admin'),
(7, 144, '2025-04-09 16:19:46', '2025-04-09 16:19:46', 'admin'),
(8, 142, '2025-04-09 16:20:11', '2025-04-09 16:20:11', 'admin'),
(9, 155, '2025-04-09 16:20:57', '2025-04-09 16:20:57', 'admin'),
(10, 147, '2025-04-09 16:21:28', '2025-04-09 16:21:28', 'admin'),
(11, 158, '2025-04-09 16:21:53', '2025-04-09 16:21:53', 'admin'),
(12, 143, '2025-04-09 16:22:39', '2025-04-09 16:22:39', 'admin'),
(13, 60, '2025-04-09 16:24:00', '2025-04-09 16:24:00', 'admin'),
(14, 187, '2025-04-09 19:37:21', '2025-04-09 19:37:21', 'admin'),
(15, 87, '2025-04-09 19:38:24', '2025-04-09 19:38:24', 'admin'),
(16, 186, '2025-04-10 14:43:22', '2025-04-10 14:43:22', 'admin'),
(17, 81, '2025-04-12 14:46:27', '2025-04-12 14:46:27', 'admin'),
(18, 85, '2025-04-12 16:27:04', '2025-04-12 16:27:04', 'ابو يحي '),
(19, 83, '2025-04-12 17:09:25', '2025-04-12 17:09:25', 'ابو يحي '),
(20, 133, '2025-04-13 14:30:26', '2025-04-13 14:30:26', 'ابو يحي '),
(21, 119, '2025-04-13 14:32:10', '2025-04-13 14:32:10', 'ابو يحي '),
(22, 118, '2025-04-19 15:54:03', '2025-04-19 15:54:03', 'ابو احمد'),
(23, 118, '2025-04-19 15:54:03', '2025-04-19 15:54:03', 'ابو احمد'),
(24, 107, '2025-04-19 19:38:56', '2025-04-19 19:38:56', 'ابو يحي '),
(25, 88, '2025-04-23 19:35:37', '2025-04-23 19:35:37', 'ابو يحي '),
(26, 115, '2025-04-27 13:53:53', '2025-04-27 13:53:53', 'ابو يحي '),
(27, 113, '2025-04-27 13:54:44', '2025-04-27 13:54:44', 'ابو يحي '),
(28, 91, '2025-04-27 15:24:55', '2025-04-27 15:24:55', 'ابو يحي '),
(29, 13, '2025-04-30 09:57:15', '2025-04-30 09:57:15', 'ابو احمد'),
(30, 81, '2025-05-03 15:21:42', '2025-05-03 15:21:42', 'ابو يحي '),
(31, 87, '2025-05-03 17:50:31', '2025-05-03 17:50:31', 'ابو يحي '),
(32, 120, '2025-05-03 18:01:36', '2025-05-03 18:01:36', 'ابو يحي '),
(33, 83, '2025-05-04 17:53:25', '2025-05-04 17:53:25', 'ابو يحي '),
(34, 86, '2025-05-07 14:14:07', '2025-05-07 14:14:07', 'ابو يحي '),
(35, 85, '2025-05-07 15:21:35', '2025-05-07 15:21:35', 'ابو يحي '),
(36, 101, '2025-05-07 15:26:03', '2025-05-07 15:26:03', 'ابو يحي '),
(37, 11, '2025-05-07 16:54:28', '2025-05-07 16:54:28', 'ابو يحي '),
(38, 90, '2025-05-08 19:33:37', '2025-05-08 19:33:37', 'ابو يحي '),
(39, 109, '2025-05-08 19:34:31', '2025-05-08 19:34:31', 'ابو يحي '),
(40, 90, '2025-05-08 19:35:06', '2025-05-08 19:35:06', 'ابو يحي '),
(41, 109, '2025-05-08 19:35:28', '2025-05-08 19:35:28', 'ابو يحي '),
(42, 187, '2025-05-08 19:37:30', '2025-05-08 19:37:30', 'ابو يحي '),
(43, 187, '2025-05-08 20:02:54', '2025-05-08 20:02:54', 'ابو يحي '),
(44, 121, '2025-05-08 20:05:02', '2025-05-08 20:05:02', 'ابو يحي '),
(45, 84, '2025-05-10 17:51:34', '2025-05-10 17:51:34', 'ابو يحي '),
(46, 117, '2025-05-10 19:08:59', '2025-05-10 19:08:59', 'ابو يحي '),
(47, 122, '2025-05-10 20:50:10', '2025-05-10 20:50:10', 'ابو احمد'),
(48, 18, '2025-05-11 15:12:45', '2025-05-11 15:12:45', 'ابو يحي '),
(49, 126, '2025-05-12 13:59:05', '2025-05-12 13:59:05', 'ابو يحي '),
(50, 132, '2025-05-12 14:09:18', '2025-05-12 14:09:18', 'ابو يحي '),
(51, 223, '2025-05-12 15:19:34', '2025-05-12 15:19:34', 'ابو يحي '),
(52, 223, '2025-05-12 15:20:58', '2025-05-12 15:20:58', 'ابو يحي '),
(53, 91, '2025-05-17 19:12:01', '2025-05-17 19:12:01', 'ابو يحي '),
(54, 71, '2025-05-17 20:13:18', '2025-05-17 20:13:18', 'new_user'),
(55, 78, '2025-05-17 20:17:38', '2025-05-17 20:17:38', 'new_user'),
(56, 101, '2025-05-17 20:20:46', '2025-05-17 20:20:46', 'ابو يحي '),
(57, 77, '2025-05-17 20:21:15', '2025-05-17 20:21:15', 'new_user'),
(58, 75, '2025-05-17 20:22:05', '2025-05-17 20:22:05', 'new_user'),
(59, 153, '2025-05-17 20:22:40', '2025-05-17 20:22:40', 'new_user'),
(60, 152, '2025-05-17 20:24:26', '2025-05-17 20:24:26', 'new_user'),
(61, 148, '2025-05-17 20:28:00', '2025-05-17 20:28:00', 'new_user'),
(62, 149, '2025-05-17 20:28:44', '2025-05-17 20:28:44', 'new_user'),
(63, 151, '2025-05-17 20:29:18', '2025-05-17 20:29:18', 'new_user'),
(64, 150, '2025-05-17 20:29:33', '2025-05-17 20:29:33', 'new_user'),
(65, 150, '2025-05-17 20:29:56', '2025-05-17 20:29:56', 'new_user'),
(66, 167, '2025-05-18 14:26:49', '2025-05-18 14:26:49', 'new_user'),
(67, 170, '2025-05-18 14:28:31', '2025-05-18 14:28:31', 'new_user'),
(68, 160, '2025-05-18 14:31:40', '2025-05-18 14:31:40', 'new_user'),
(69, 162, '2025-05-18 14:34:53', '2025-05-18 14:34:53', 'new_user'),
(70, 169, '2025-05-18 14:38:26', '2025-05-18 14:38:26', 'new_user'),
(71, 163, '2025-05-18 14:40:05', '2025-05-18 14:40:05', 'new_user'),
(72, 173, '2025-05-18 14:41:25', '2025-05-18 14:41:25', 'new_user'),
(73, 172, '2025-05-18 14:42:59', '2025-05-18 14:42:59', 'new_user'),
(74, 178, '2025-05-18 14:44:27', '2025-05-18 14:44:27', 'new_user'),
(75, 161, '2025-05-18 14:45:11', '2025-05-18 14:45:11', 'new_user'),
(76, 166, '2025-05-18 14:47:15', '2025-05-18 14:47:15', 'new_user'),
(77, 168, '2025-05-18 15:12:19', '2025-05-18 15:12:19', 'new_user'),
(78, 164, '2025-05-18 15:16:13', '2025-05-18 15:16:13', 'new_user'),
(79, 111, '2025-05-18 17:15:44', '2025-05-18 17:15:44', 'ابو يحي '),
(80, 111, '2025-05-18 17:16:27', '2025-05-18 17:16:27', 'ابو يحي '),
(81, 105, '2025-05-19 17:57:59', '2025-05-19 17:57:59', 'ابو يحي '),
(82, 122, '2025-05-20 16:43:08', '2025-05-20 16:43:08', 'ابو يحي '),
(83, 89, '2025-05-20 17:26:26', '2025-05-20 17:26:26', 'ابو يحي '),
(84, 105, '2025-05-20 19:00:18', '2025-05-20 19:00:18', 'ابو يحي '),
(85, 113, '2025-05-24 18:15:11', '2025-05-24 18:15:11', 'ابو يحي '),
(86, 117, '2025-05-25 18:49:40', '2025-05-25 18:49:40', 'ابو يحي '),
(87, 5, '2025-05-31 07:15:58', '2025-05-31 07:15:58', 'ابو يحي '),
(88, 255, '2025-06-01 18:25:17', '2025-06-01 18:25:17', 'ابو يحي ');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `expire_at` varchar(255) NOT NULL,
  `archive` varchar(255) DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `expire_at`, `archive`, `type_id`, `created_at`, `updated_at`, `user_name`) VALUES
(1, 'سجل تجاري مؤسسة الجواب للنقل البري 7003669004', '2025-03-01', 'archived', 1, '2025-02-23 16:41:59', '2025-06-18 08:41:42', NULL),
(2, 'رخصىة البلدية مؤسسة الجواب للنقل البري نقل متخصص 7003669004', '2025-07-14', 'archived', 2, '2025-02-23 16:44:30', '2025-06-18 08:45:42', NULL),
(3, 'احمد اسلام عبدالسلام 2437206887', '2025-06-15', 'archived', 18, '2025-02-24 21:06:17', '2025-06-22 08:58:26', NULL),
(4, 'السجل التجاري شركة الجواب للنقل البري 7033114567', '2025-08-18', 'archived', 1, '2025-02-24 21:09:04', '2025-06-18 08:40:34', NULL),
(5, 'قاسم علي عاشق  حسين /2530006903', '2025-11-12', 'archived', 18, '2025-02-24 21:23:31', '2025-09-02 18:31:12', NULL),
(6, 'islam', '2025-02-14', 'archived', 14, '2025-02-24 21:49:24', '2025-03-10 14:41:49', NULL),
(7, 'islam', '2025-02-06', 'archived', 14, '2025-02-25 12:22:49', '2025-03-10 14:06:34', NULL),
(8, 'islam', '2025-02-07', 'archived', 13, '2025-02-25 12:45:52', '2025-03-10 14:07:22', NULL),
(9, 'Islam', '2025-02-25', 'archived', 10, '2025-02-25 13:05:39', '2025-03-10 14:08:04', NULL),
(10, 'فاروق احمد احمد 2331429924', '2025-07-01', 'archived', 18, '2025-02-25 15:10:37', '2025-09-02 18:31:20', NULL),
(11, 'محمد كاشف عبدالرشيد2395965045', '2025-07-01', 'archived', 18, '2025-02-25 15:12:30', '2025-09-02 18:31:28', NULL),
(12, 'محمد اقبال غلام محمد 2418680076', '2026-04-21', 'archived', 18, '2025-02-25 15:14:13', '2025-09-02 18:31:36', NULL),
(13, 'جعفر عبدالمؤمن عمر سليمان 2446721751', '2025-07-27', 'archived', 18, '2025-02-25 15:16:43', '2025-09-02 18:31:46', NULL),
(14, 'محمد جنيد تيفيل محمد2486823145', '2026-03-24', 'archived', 18, '2025-02-25 15:18:51', '2025-09-02 18:31:51', NULL),
(15, 'محمد اصف عبدالمجيد 2493027219', '2025-06-05', 'archived', 18, '2025-02-25 15:21:04', '2025-09-02 18:31:57', NULL),
(16, 'نائف محمد علي مسمار 2527990234', '2024-01-03', 'archived', 18, '2025-02-25 15:22:06', '2025-09-02 18:32:05', NULL),
(17, 'سيرفاراز احمد شيخ محمد 2549796627', '2025-03-20', 'archived', 18, '2025-02-25 15:25:08', '2025-09-02 18:32:12', NULL),
(18, 'علي عباس فرهات عباس 2566696445', '2025-05-12', 'archived', 18, '2025-02-25 15:26:33', '2025-09-02 18:32:19', NULL),
(19, 'محمد مباشر احسان طالب حسين 2586884013', '2025-10-24', 'archived', 18, '2025-02-25 15:27:33', '2025-09-02 18:32:27', NULL),
(20, 'فهد الله مهيأ 2531169957', '2025-05-09', 'archived', 18, '2025-02-25 15:29:36', '2025-09-02 18:32:32', NULL),
(21, 'اسلام ناصف عبدالرؤف الشويمي 2594648046', '2025-04-14', 'archived', 18, '2025-02-25 16:21:27', '2025-06-22 09:06:10', NULL),
(22, 'محمد وقاص محمد نازير 2560509768', '2026-01-21', 'archived', 18, '2025-02-25 16:25:01', '2025-09-02 18:32:38', NULL),
(23, 'محمد رشد 2331742888', '2025-03-01', 'archived', 22, '2025-02-26 18:50:37', '2025-09-02 18:32:55', NULL),
(24, 'محمد عربي نبي بخش 2172453546', '2025-03-01', 'archived', 22, '2025-02-26 19:02:26', '2025-09-02 18:33:00', NULL),
(25, 'اسحاق علي قاسم علي 2019373410', '2025-03-01', 'archived', 22, '2025-02-26 19:10:15', '2025-09-02 18:33:05', NULL),
(26, 'برويز اختر فلك شير 2526523713', '2025-03-01', 'archived', 22, '2025-02-26 19:21:59', '2025-09-02 18:33:11', NULL),
(27, 'شهادة تسجيل في ضريبة القيمة المضافة 3124905772', '2025-12-31', 'archived', 6, '2025-02-27 14:21:57', '2025-06-18 08:51:02', NULL),
(28, 'شهادة الاشتراك في الغرفة التجارية4650259862', '2025-08-18', 'archived', 5, '2025-02-27 14:24:00', '2025-06-18 08:49:26', NULL),
(29, 'العنوان الوطني شركة الجواب للنقل البري 31327112822', '2025-07-06', 'archived', 23, '2025-02-27 14:30:17', '2025-09-02 18:33:43', NULL),
(30, 'عقد منصة  ايجار 202429680960', '2025-07-07', 'archived', 20, '2025-02-27 14:33:10', '2025-09-02 18:34:52', NULL),
(31, 'ثامن صديق 2145434904', '2025-03-01', 'archived', 22, '2025-02-27 14:44:10', '2025-09-02 18:35:00', NULL),
(32, 'هونداي النترا أ ح د 4293', '2025-12-24', 'archived', 17, '2025-02-27 19:12:17', '2025-09-02 18:35:09', NULL),
(33, 'فان هونداي أ ص ح 2216', '2025-07-23', 'archived', 17, '2025-02-27 19:12:55', '2025-09-02 18:35:14', NULL),
(34, 'هونداي سوناتا أ ر ك 8111', '2025-11-18', 'archived', 17, '2025-02-27 19:13:32', '2025-09-02 18:35:19', NULL),
(35, 'هونداي النترا أ د ك 5460', '2026-01-02', 'archived', 17, '2025-02-27 19:14:20', '2025-09-02 18:35:25', NULL),
(36, 'هونداي فان أ ص ح 2212', '2025-07-23', 'archived', 17, '2025-02-27 19:14:58', '2025-09-02 18:35:31', NULL),
(37, 'هونداي سوناتا أ رك 8726', '2025-06-24', 'archived', 17, '2025-02-27 19:16:05', '2025-09-02 18:35:36', NULL),
(38, 'هونداي ستاركس أ س و 8513', '2025-07-25', 'archived', 17, '2025-02-27 19:16:43', '2025-09-02 18:35:43', NULL),
(39, 'هونداي النترا أ د ك 5767', '2026-01-02', 'archived', 17, '2025-02-27 19:17:53', '2025-09-02 18:35:48', NULL),
(40, 'هونداي ستاركس 8514', '2025-07-23', 'archived', 17, '2025-02-27 19:18:24', '2025-09-02 18:35:53', NULL),
(41, 'هونداي النترا أ د ك 5757', '2026-01-02', 'archived', 17, '2025-02-27 19:19:04', '2025-09-02 18:35:58', NULL),
(42, 'هونداي النترا أ د ك 5456', '2026-01-02', 'archived', 17, '2025-02-27 19:20:42', '2025-09-02 18:36:04', NULL),
(43, 'هونداي ستاركس 2850', '2025-07-23', 'archived', 17, '2025-02-27 19:24:12', '2025-09-02 18:36:09', NULL),
(44, 'هونداي ستاركس أ س س 1815', '2025-07-22', 'archived', 17, '2025-02-27 19:24:49', '2025-09-02 18:36:15', NULL),
(45, 'كيا k 5  أ س س 5066', '2025-11-04', 'archived', 17, '2025-02-27 19:25:52', '2025-09-02 18:36:19', NULL),
(46, 'ميستوبيشي أ س أ 6580', '2026-01-02', 'archived', 17, '2025-02-27 19:26:27', '2025-09-02 18:36:25', NULL),
(47, 'ميستوبيشي أ س أ 6581', '2026-01-02', 'archived', 17, '2025-02-27 19:27:01', '2025-09-02 18:36:29', NULL),
(48, 'هونداي ستاريا أ س س 1265', '2025-08-05', 'archived', 17, '2025-02-27 19:28:03', '2025-09-02 18:36:34', NULL),
(49, 'هونداي ستاركس 8719', '2026-03-14', 'archived', 17, '2025-02-27 19:28:35', '2025-09-02 18:36:41', NULL),
(50, 'هونداي ستاريا 1253', '2025-08-05', 'archived', 17, '2025-02-27 19:29:03', '2025-09-02 18:36:46', NULL),
(51, 'جعفر عبدالمؤمن عمر سليمان 2446721751', '2025-06-25', 'archived', 19, '2025-02-27 19:31:45', '2025-09-02 18:36:52', NULL),
(52, 'فاروق احمد احمد 2331429924', '2025-10-24', 'archived', 19, '2025-02-27 19:32:04', '2025-09-02 18:36:57', NULL),
(53, 'برويز اختر فلك شير 2526523713', '2025-10-29', 'archived', 19, '2025-02-27 19:32:28', '2025-09-02 18:37:03', NULL),
(54, 'محمد جنيد تيفيل محمد2486823145', '2025-11-25', 'archived', 19, '2025-02-27 19:33:00', '2025-09-02 18:37:08', NULL),
(55, 'حمزة محمود محمد محمود 2482260870', '2025-11-30', 'archived', 19, '2025-02-27 19:36:44', '2025-09-02 18:37:13', NULL),
(56, 'محمد رشد 2331742888', '2025-05-11', 'archived', 19, '2025-02-27 19:37:21', '2025-09-02 18:37:18', NULL),
(57, 'محمد كاشف عبدالرشيد2395965045', '2025-06-25', 'archived', 19, '2025-02-27 19:38:15', '2025-09-02 18:37:23', NULL),
(58, 'فهد الله مهيأ 2531169957', '2025-07-29', 'archived', 19, '2025-02-27 19:38:44', '2025-09-02 18:37:28', NULL),
(59, 'علي عباس فرهات عباس 2566696445', '2025-10-17', 'archived', 19, '2025-02-27 19:40:16', '2025-09-02 18:37:33', NULL),
(60, 'ميستوبيشي أ س أ 6581 / محمد كاشف', '2026-04-21', 'archived', 15, '2025-02-27 19:47:47', '2025-09-02 18:37:49', NULL),
(61, 'هونداي سوناتا أ ر ك 8111', '2026-01-27', 'archived', 15, '2025-02-27 19:49:23', '2025-09-02 18:37:53', NULL),
(62, 'هونداي النترا أ د ك 5460', '2025-02-03', 'archived', 15, '2025-02-27 19:50:01', '2025-09-02 18:38:02', NULL),
(63, 'هونداي سوناتا أ رك 8726', '2026-01-27', 'archived', 15, '2025-02-27 19:56:19', '2025-09-02 18:38:10', NULL),
(64, 'هونداي النترا أ د ك 5767', '2026-01-25', 'archived', 15, '2025-02-27 19:58:29', '2025-09-02 18:38:15', NULL),
(65, 'هونداي النترا أ د ك 5757', '2026-03-19', 'archived', 15, '2025-02-27 20:00:48', '2025-09-02 18:38:23', NULL),
(66, 'هونداي النترا 5456', '2026-01-30', 'archived', 15, '2025-02-27 20:02:52', '2025-09-02 18:38:32', NULL),
(67, 'هونداي ستاركس 2850', '2026-01-30', 'archived', 15, '2025-02-27 20:08:15', '2025-09-02 18:38:40', NULL),
(68, 'هونداي النترا أ ح د 4293', '2027-11-28', 'archived', 14, '2025-02-27 20:12:11', '2025-09-02 18:38:52', NULL),
(69, 'فان هونداي أ ص ح 2216', '2027-05-09', 'archived', 14, '2025-02-27 20:14:06', '2025-09-02 18:38:58', NULL),
(70, 'هونداي سوناتا أ ر ك 8111', '2027-10-16', 'archived', 14, '2025-02-27 20:15:35', '2025-09-02 18:39:15', NULL),
(71, 'هونداي النترا أ د ك 5460', '2028-04-09', 'archived', 14, '2025-02-27 20:16:40', '2025-09-02 18:39:22', NULL),
(72, 'هونداي فان أ ص ح 2212', '2027-05-09', 'archived', 14, '2025-02-27 20:18:31', '2025-09-02 18:39:27', NULL),
(73, 'هونداي سوناتا أ رك 8726', '2027-06-01', 'archived', 14, '2025-02-27 20:20:38', '2025-09-02 18:39:33', NULL),
(74, 'هونداي ستاركس أ س و 8513', '2027-05-25', 'archived', 14, '2025-02-27 20:22:05', '2025-09-02 18:39:52', NULL),
(75, 'هونداي النترا أ د ك 5767', '2028-02-03', 'archived', 14, '2025-02-27 20:24:03', '2025-09-02 18:40:01', NULL),
(76, 'هونداي ستاركس 8514', '2027-05-25', 'archived', 14, '2025-02-27 20:25:55', '2025-09-02 18:40:10', NULL),
(77, 'هونداي النترا أ د ك 5757', '2028-02-03', 'archived', 14, '2025-02-27 20:27:13', '2025-09-02 18:40:14', NULL),
(78, 'هونداي النترا أ د ك 5456', '2028-04-09', 'archived', 14, '2025-02-27 20:30:49', '2025-09-02 18:40:18', NULL),
(79, 'هونداي ستاركس 2850', '2027-01-03', 'archived', 14, '2025-02-27 20:35:10', '2025-09-02 18:40:28', NULL),
(80, 'هونداي ستاركس أ س س 1815', '2026-12-08', 'archived', 14, '2025-02-27 20:36:45', '2025-09-02 18:39:10', NULL),
(81, 'مخالصة محمد رشد 31-03-2025', '2025-07-01', NULL, 24, '2025-03-01 21:26:37', '2025-05-31 18:52:54', NULL),
(82, 'مخالصة ارشاد علي حتى 31-03-2025', '2025-03-31', 'archived', 24, '2025-03-01 21:30:19', '2025-06-09 15:39:22', NULL),
(83, 'مخالصة محمد عربي بخش حتى 31-03-2025', '2025-07-01', NULL, 24, '2025-03-01 22:50:07', '2025-05-31 19:49:01', NULL),
(84, 'مخالصة اسحاق علي 2019373410', '2025-07-01', NULL, 24, '2025-03-02 20:58:01', '2025-05-31 18:54:47', NULL),
(85, 'مخالصة جعفر 2446721751', '2025-07-01', NULL, 24, '2025-03-03 00:13:57', '2025-05-31 19:39:26', NULL),
(86, 'مخالصة برويز 2526523713', '2025-07-01', NULL, 24, '2025-03-03 00:16:16', '2025-06-04 08:10:32', NULL),
(87, 'مخالصة محمد كاشف 2395965045', '2025-07-01', NULL, 24, '2025-03-03 00:18:09', '2025-05-31 18:54:15', NULL),
(88, 'مخالصة علي عباس 2566696445', '2025-07-01', NULL, 24, '2025-03-03 00:21:20', '2025-05-31 18:53:57', NULL),
(89, 'مخالصة محمد اصف عبدالمجيد 2493027219', '2025-07-01', NULL, 24, '2025-03-04 08:58:20', '2025-06-02 18:12:57', NULL),
(90, 'نبيل شنجند حمزة', '2025-05-04', NULL, 22, '2025-03-04 12:49:17', '2025-05-08 19:35:06', NULL),
(91, 'اسحاق علي قاسم أ ر ك  8111 /385833', '2025-07-05', NULL, 25, '2025-03-04 13:25:14', '2025-06-07 18:05:57', NULL),
(92, 'قرض / بنك الراجحي / 17797.20', '2025-02-25', NULL, 26, '2025-03-05 08:18:51', '2025-03-05 08:18:51', NULL),
(93, 'قرض / تمويل سيارة / 2189.51', '2025-03-10', NULL, 27, '2025-03-05 08:23:24', '2025-03-05 08:23:24', NULL),
(94, 'قرض / تمويل سيارة / 1973.25', '2025-03-10', NULL, 27, '2025-03-05 08:23:54', '2025-03-05 08:23:54', NULL),
(95, 'قرض / تمويل سيارة / 1973.25', '2025-03-10', NULL, 27, '2025-03-05 08:24:35', '2025-03-05 08:24:35', NULL),
(96, 'شركة الجواب / سداد فاتورة شهر فبراير', '2025-03-16', 'archived', 4, '2025-03-05 09:15:10', '2025-06-18 08:48:00', NULL),
(97, 'عقد أجير برويز', '2025-04-11', NULL, 28, '2025-03-05 12:34:51', '2025-03-11 19:55:19', NULL),
(98, 'أ ص ح 2216', '2025-03-08', 'archived', 29, '2025-03-05 12:37:27', '2025-03-10 13:23:36', NULL),
(99, 'بطاقة سائق اسحاق علي قاسم', '2026-01-11', NULL, 19, '2025-03-05 14:16:44', '2025-03-05 14:16:44', NULL),
(100, 'أ د ك 5460', '2025-03-08', NULL, 29, '2025-03-06 09:37:39', '2025-03-09 12:04:45', NULL),
(101, 'جعفر عبدالمؤمن /أ ح د 4293', '2025-06-16', NULL, 25, '2025-03-06 10:26:51', '2025-05-17 20:20:46', NULL),
(102, 'فاورق احمد /أ ص ح 2216', '2025-02-28', 'archived', 25, '2025-03-06 10:27:34', '2025-04-19 15:51:35', NULL),
(103, 'متوقف /أ د ك 5460', '2025-02-28', NULL, 25, '2025-03-06 10:29:19', '2025-03-06 10:29:19', NULL),
(104, 'برويز اختر /أ ص ح 2212', '2025-07-04', NULL, 25, '2025-03-06 10:30:13', '2025-06-04 08:06:46', NULL),
(105, 'ثامن صديق /أ ر ك 8726', '2025-06-20', NULL, 25, '2025-03-06 10:30:40', '2025-05-20 19:00:18', NULL),
(106, 'محمد جنيد /أ س و 8513', '2025-04-18', 'archived', 25, '2025-03-06 10:31:06', '2025-04-19 15:52:23', NULL),
(107, 'امير احمد بشير /أ د ك 5767', '2025-07-19', NULL, 25, '2025-03-06 10:31:37', '2025-06-21 18:30:43', NULL),
(108, 'ارشاد /أ س و 8514', '2025-04-29', NULL, 25, '2025-03-06 10:32:05', '2025-04-02 18:11:33', NULL),
(109, 'نبيل حمزة /أ د ك 5757', '2025-06-05', NULL, 25, '2025-03-06 10:32:45', '2025-05-08 19:35:28', NULL),
(110, 'نائف محمد /أ د ك 5456/564876', '2025-04-27', NULL, 25, '2025-03-06 10:33:27', '2025-04-02 20:26:55', NULL),
(111, 'محمد مباشر احسان -  /أ س س 2850', '2025-06-17', NULL, 25, '2025-03-06 10:34:07', '2025-05-18 17:16:27', NULL),
(112, 'قاسم /أ س س 1815', '2025-02-28', NULL, 25, '2025-03-06 10:34:35', '2025-03-06 10:34:35', NULL),
(113, 'محمد رشد / أ س س 5066', '2025-07-13', NULL, 25, '2025-03-06 10:34:59', '2025-06-14 16:25:30', NULL),
(114, 'محمد عربي نبي بخش /أ س أ 6580', '2025-07-01', NULL, 25, '2025-03-06 10:35:30', '2025-06-01 17:10:40', NULL),
(115, 'محمد كاشف /أ س أ 6581', '2025-07-10', NULL, 25, '2025-03-06 10:35:59', '2025-06-21 16:31:18', NULL),
(116, 'فهد مهيا /أ س س 1265', '2025-04-19', NULL, 25, '2025-03-06 10:36:27', '2025-04-02 17:59:07', NULL),
(117, 'علي عباس /أ ص د 8719', '2025-06-02', NULL, 25, '2025-03-06 10:36:54', '2025-05-25 18:49:40', NULL),
(118, 'محمد اقبال/ أ س س 1253', '2025-02-28', NULL, 25, '2025-03-06 10:37:18', '2025-04-19 15:54:03', NULL),
(119, 'مخالصة نائف محمد مسمار  /2527990234', '2025-05-01', NULL, 24, '2025-03-06 10:47:44', '2025-04-13 14:32:10', NULL),
(120, 'محمد مباشر /2586884013', '2025-07-01', NULL, 24, '2025-03-06 10:51:50', '2025-05-31 18:53:29', NULL),
(121, 'محمد جنيد 2486823145', '2025-07-01', NULL, 24, '2025-03-06 12:50:04', '2025-06-11 19:53:08', NULL),
(122, 'سعيد احمد رازا', '2025-03-01', 'archived', 24, '2025-03-06 12:52:00', '2025-06-07 12:10:44', NULL),
(123, 'امير احمد بشير /أ د ك 5767', '2025-03-21', NULL, 29, '2025-03-09 11:52:47', '2025-03-17 11:56:46', NULL),
(124, 'ارشاد /أ س و 8514', '2025-03-15', NULL, 29, '2025-03-09 11:53:49', '2025-03-09 11:53:49', NULL),
(125, 'محمد رشد / أ س س 5066', '2025-03-15', NULL, 29, '2025-03-09 11:54:12', '2025-03-09 11:54:12', NULL),
(126, 'جعفر عبدالمؤمن /أ ح د 4293', '2025-06-11', NULL, 29, '2025-03-09 11:54:44', '2025-05-12 13:59:05', NULL),
(127, 'اسحاق علي قاسم أ ر ك  8111', '2025-03-21', NULL, 29, '2025-03-09 11:55:10', '2025-03-17 11:55:54', NULL),
(128, 'محمد عربي نبي بخش /أ س أ 6580', '2025-03-15', NULL, 29, '2025-03-09 11:55:33', '2025-03-09 11:55:33', NULL),
(129, 'أ ص ح 2212', '2025-03-08', 'archived', 29, '2025-03-09 12:08:30', '2025-03-10 13:22:11', NULL),
(130, 'أ ر ك 8726', '2025-03-08', NULL, 29, '2025-03-09 12:09:09', '2025-03-09 12:09:09', NULL),
(131, 'أ س و 8513', '2025-03-08', 'archived', 29, '2025-03-09 12:11:04', '2025-03-10 13:24:49', NULL),
(132, 'أ د ك 5757', '2025-06-09', NULL, 29, '2025-03-09 12:11:25', '2025-05-12 14:09:18', NULL),
(133, 'أ د ك 5456', '2025-05-12', 'archived', 29, '2025-03-09 12:11:48', '2025-06-18 08:29:07', NULL),
(134, 'أ س س 2850', '2025-03-08', 'archived', 29, '2025-03-09 12:12:09', '2025-03-10 13:25:25', NULL),
(135, 'أ س س 1253', '2025-03-08', NULL, 29, '2025-03-09 12:13:59', '2025-03-09 12:31:10', NULL),
(136, 'أ س س 1815', '2025-03-08', NULL, 29, '2025-03-09 12:14:46', '2025-03-09 12:18:53', NULL),
(137, 'أ س أ 6581', '2025-03-08', NULL, 29, '2025-03-09 12:20:27', '2025-03-09 12:20:27', NULL),
(138, 'أ س س 1265', '2025-03-08', NULL, 29, '2025-03-09 12:20:45', '2025-03-09 12:20:45', NULL),
(139, 'أ ص د 8719', '2025-03-08', NULL, 29, '2025-03-09 12:21:11', '2025-03-09 12:21:11', NULL),
(140, 'أ س س 5066', '2026-01-16', NULL, 15, '2025-03-09 12:33:45', '2025-03-12 10:21:54', NULL),
(141, 'أ س أ 6580', '2026-03-12', NULL, 15, '2025-03-09 12:34:11', '2025-03-13 08:13:13', NULL),
(142, 'أ س س 1265', '2025-07-28', NULL, 15, '2025-03-09 12:35:32', '2025-04-09 16:20:11', NULL),
(143, 'أ ص د 8719', '2025-07-24', NULL, 15, '2025-03-09 12:36:16', '2025-04-09 16:22:39', NULL),
(144, 'أ س س 1253', '2025-07-28', NULL, 15, '2025-03-09 12:36:30', '2025-04-09 16:19:46', NULL),
(145, 'أ س و 8513', '2026-06-04', NULL, 15, '2025-03-09 12:39:45', '2025-06-04 20:36:05', NULL),
(146, 'أ س و 8514', '2026-06-04', NULL, 15, '2025-03-09 12:40:03', '2025-06-04 20:37:07', NULL),
(147, 'أ س س 1815', '2025-07-28', NULL, 15, '2025-03-09 12:40:22', '2025-04-09 16:21:28', NULL),
(148, 'أ س س 5066 كيا K5', '2025-12-28', NULL, 14, '2025-03-09 14:02:35', '2025-05-17 20:28:00', NULL),
(149, 'ميستوبيشي أ س أ 6580', '2025-12-28', NULL, 14, '2025-03-09 14:03:03', '2025-05-17 20:28:44', NULL),
(150, 'ميستوبيشي أ س أ 6581', '2025-12-28', NULL, 14, '2025-03-09 14:03:30', '2025-05-17 20:29:56', NULL),
(151, 'هونداي ستاريا  أ س س 1265', '2025-12-28', NULL, 14, '2025-03-09 14:03:52', '2025-05-17 20:29:18', NULL),
(152, 'هونداي ستاركس أ ص د 8719', '2028-05-07', NULL, 14, '2025-03-09 14:04:21', '2025-05-17 20:24:26', NULL),
(153, 'هونداي ستاريا أ س س 1253', '2025-12-01', NULL, 14, '2025-03-09 14:05:23', '2025-05-17 20:22:40', NULL),
(154, 'كيا سيراتيو أ د ك 6585', '2026-03-08', 'archived', 14, '2025-03-09 14:07:39', '2025-05-17 19:56:31', NULL),
(155, 'أ ص ح 2212', '2025-07-28', NULL, 15, '2025-03-10 12:59:31', '2025-04-09 16:20:57', NULL),
(156, 'أ د ك 6585', '2025-09-20', 'archived', 15, '2025-03-10 13:00:00', '2025-05-28 15:47:58', NULL),
(157, 'أ ح د 4293', '2026-01-29', NULL, 15, '2025-03-10 13:09:00', '2025-03-12 08:46:14', NULL),
(158, 'أ ص ح 2216', '2025-07-28', NULL, 15, '2025-03-10 13:09:17', '2025-04-09 16:21:53', NULL),
(159, 'نائف محمد علي مسمار 2527990234', '2025-02-28', NULL, 19, '2025-03-10 13:19:02', '2025-03-10 13:19:02', NULL),
(160, 'أ ح د  4293', '2025-11-01', NULL, 16, '2025-03-10 13:42:34', '2025-05-18 14:31:40', NULL),
(161, 'أ ص ح 2216', '2025-06-05', NULL, 16, '2025-03-10 13:42:53', '2025-05-18 14:45:11', NULL),
(162, 'أ ر ك 8111', '2025-11-01', NULL, 16, '2025-03-10 13:43:08', '2025-05-18 14:34:53', NULL),
(163, 'أ د ك 5460', '2025-11-01', NULL, 16, '2025-03-10 13:43:22', '2025-05-18 14:40:05', NULL),
(164, 'أ ص ح 2212', '2025-06-05', NULL, 16, '2025-03-10 13:43:35', '2025-05-18 15:16:13', NULL),
(165, 'أ ر ك 8726', '2025-02-28', NULL, 16, '2025-03-10 13:43:48', '2025-05-28 15:36:39', NULL),
(166, 'أ س و 8513', '2025-06-25', NULL, 16, '2025-03-10 13:44:00', '2025-05-18 14:47:15', NULL),
(167, 'أ د ك 5767', '2025-11-01', NULL, 16, '2025-03-10 13:44:12', '2025-05-18 14:26:49', NULL),
(168, 'أ س و 8514', '2025-06-25', NULL, 16, '2025-03-10 13:44:24', '2025-05-18 15:12:19', NULL),
(169, 'أ د ك 5757', '2025-07-12', NULL, 16, '2025-03-10 13:44:35', '2025-05-18 14:38:26', NULL),
(170, 'أ د ك 5456', '2025-11-01', NULL, 16, '2025-03-10 13:44:52', '2025-05-18 14:28:31', NULL),
(171, 'أ د ك 6585', '2025-02-28', 'archived', 16, '2025-03-10 13:45:05', '2025-05-28 15:44:37', NULL),
(172, 'أ س س 2850', '2025-06-23', NULL, 16, '2025-03-10 13:45:17', '2025-05-18 14:42:59', NULL),
(173, 'أ س س 1815', '2025-06-23', NULL, 16, '2025-03-10 13:45:28', '2025-05-18 14:41:25', NULL),
(174, 'أ س س 5066', '2025-11-28', NULL, 16, '2025-03-10 13:45:41', '2025-05-28 15:38:09', NULL),
(175, 'أ س أ 6580', '2025-11-28', NULL, 16, '2025-03-10 13:45:52', '2025-05-28 15:38:47', NULL),
(176, 'أ س أ 6581', '2025-11-28', NULL, 16, '2025-03-10 13:46:04', '2025-05-28 15:39:33', NULL),
(177, 'أ س س 1265', '2025-11-28', NULL, 16, '2025-03-10 13:46:17', '2025-05-28 15:40:18', NULL),
(178, 'أ ص د 8719', '2026-03-19', NULL, 16, '2025-03-10 13:46:33', '2025-05-18 14:44:27', NULL),
(179, 'أ س س 1253', '2025-11-28', NULL, 16, '2025-03-10 13:46:50', '2025-05-28 15:40:45', NULL),
(180, 'محمد اصف عبدالمجيد2493027219', '2026-02-06', NULL, 19, '2025-03-10 13:50:32', '2025-03-10 13:50:32', NULL),
(181, 'قاسم علي عاشق حسين', '2025-03-01', NULL, 22, '2025-03-11 07:39:53', '2025-03-11 08:38:46', NULL),
(182, 'سعيد احمد رازا', '2025-03-01', 'archived', 22, '2025-03-11 07:40:38', '2025-06-07 12:12:11', NULL),
(183, 'فهد مهيا مهيا', '2025-02-28', NULL, 24, '2025-03-11 10:25:13', '2025-03-11 10:25:13', NULL),
(184, 'حمزة محمود', '2025-02-28', 'archived', 24, '2025-03-11 10:25:38', '2025-06-09 15:41:06', NULL),
(185, 'سيرفاراز احمد شيخ محمد', '2025-02-28', 'archived', 24, '2025-03-11 10:25:58', '2025-05-10 20:52:24', NULL),
(186, 'فاروق احمد احمد', '2025-07-01', NULL, 24, '2025-03-11 10:26:14', '2025-06-11 16:58:22', NULL),
(187, 'نبيل شنجند حمزة', '2025-07-01', NULL, 24, '2025-03-11 10:27:11', '2025-06-08 15:38:44', NULL),
(188, 'قاسم علي عاشق حسين', '2025-02-28', NULL, 24, '2025-03-11 10:27:56', '2025-03-11 10:27:56', NULL),
(189, 'امير احمد بشير', '2025-02-28', 'archived', 24, '2025-03-11 10:28:15', '2025-05-10 20:48:20', NULL),
(190, 'سند لامررقم 009 نبيل شنجند حمزة 2522993430', '2025-05-25', NULL, 30, '2025-03-11 13:48:30', '2025-03-11 13:48:30', NULL),
(191, 'سند لامررقم 0014 سعيد احمد رازا  2578779288', '2025-06-10', NULL, 30, '2025-03-11 13:52:29', '2025-03-11 13:52:29', NULL),
(192, 'محمد وقاص محمد نظير 2560509768', '2026-02-06', NULL, 19, '2025-03-11 20:07:23', '2025-03-11 20:07:23', NULL),
(193, 'عقد اجير فهد مهيا', '2025-03-13', NULL, 28, '2025-03-11 20:20:12', '2025-03-11 20:20:12', NULL),
(194, 'عقد اجير علي عباس', '2025-03-13', NULL, 28, '2025-03-11 20:22:16', '2025-03-11 20:22:16', NULL),
(195, 'عقد اجير محمد اصف', '2025-03-13', NULL, 28, '2025-03-11 20:23:57', '2025-03-11 20:23:57', NULL),
(196, 'ترخيص النقل المتخصص شركة الجواب للنقل البري', '2025-04-28', NULL, 8, '2025-03-11 20:31:48', '2025-03-11 20:31:48', NULL),
(197, 'شهادة عضوية الاشتراك في الغرفة التجارية', '2025-08-18', 'archived', 5, '2025-03-11 20:34:08', '2025-06-18 08:49:53', NULL),
(198, 'ترخيص الدفاع المدني', '2025-07-14', NULL, 31, '2025-03-11 20:42:12', '2025-03-11 20:42:12', NULL),
(199, 'هونداي اتش وان  أ د ق 4427', '2025-12-19', NULL, 15, '2025-03-12 07:59:21', '2025-03-12 08:44:21', NULL),
(200, 'تامين سيارة رقم ا س ع 6524 ميكروباص', '2026-03-13', NULL, 16, '2025-03-16 11:20:58', '2025-03-16 11:20:58', NULL),
(201, 'ميكروبا ص سيارة رقم ا س ع 6524', '2026-03-09', NULL, 17, '2025-03-19 08:29:45', '2025-03-19 08:29:45', NULL),
(202, 'قاسم علي عاشق حسين', '2025-04-02', NULL, 32, '2025-04-02 05:39:24', '2025-04-02 05:39:24', NULL),
(203, 'راشد', '2025-04-02', NULL, 32, '2025-04-02 08:28:21', '2025-04-02 08:28:21', NULL),
(204, 'محمد رشاد', '2025-04-02', NULL, 32, '2025-04-02 11:28:39', '2025-04-02 11:28:39', NULL),
(205, 'محمد كاشف عبد الرشيد/سداد رخصه عمل /مرفق فاتوره السداد', '2025-04-02', 'archived', 18, '2025-04-02 11:32:36', '2025-04-19 15:48:48', NULL),
(206, 'قاسم علي عاشق حسين/انتظار سداد رسوم المهنة', '2025-04-02', NULL, 32, '2025-04-02 11:55:43', '2025-04-02 11:55:43', NULL),
(207, '2514894561182216/محمد موباسيا احسن طالب حسين/أ س س 2850 سعودي/عدم تأمين سائق مساعد في الرحلة الطويلة التي تبلغ مسافتها (400) كيلو متر وأكثر/2000.00', '2025-03-25', 'archived', 33, '2025-04-09 16:46:43', '2025-05-17 20:10:29', 'admin'),
(208, '2515864967130271/محمد موباسيا احسن طالب حسين/ أ س س 2850 سعودي/تشغيل حافلات غير مزودة بدورة مياه عند النقل بين مدن المملكة أو إلى خارجها/1000.00', '2025-03-25', 'archived', 33, '2025-04-09 16:56:20', '2025-05-17 20:11:06', 'admin'),
(209, '2512834740297115/امتياز احمد شامال خان/أ ص ح 2216 سعودي/عدم التزام السائق بالزي الوطني أو الزي المعتمد أثناء تأدية العمل/500.00', '2025-03-25', 'archived', 33, '2025-04-09 16:59:01', '2025-05-17 20:09:37', 'admin'),
(210, '2513823177785564/محمد موباسبا احسن/ أ س س 2850 سعودي/تشغيل حافلات غير مزودة بدورة مياه عند النقل بين مدن المملكة أو إلى خارجها/1000.00', '2025-03-23', 'archived', 33, '2025-04-09 17:05:22', '2025-05-17 20:09:57', 'admin'),
(211, '2514801786536255/  أ س ع 6524 سعودي/تشغيل حافلة دون الحصول على بطاقة تشغيل/5000.00', '2025-03-16', 'archived', 33, '2025-04-09 17:11:45', '2025-05-17 19:58:41', 'admin'),
(212, '2415605754297203/برويز اختر/ أ ص ح 2212 سعودي/عدم التزام السائق بالزي الوطني أو الزي المعتمد أثناء تأدية العمل/500', '2024-11-18', 'archived', 33, '2025-04-09 17:14:20', '2025-04-20 18:55:53', 'admin'),
(213, '2411653057491463/فاروق احمد/ أ ص ح 2216 سعودي/عدم التزام السائق بالزي الوطني أو الزي المعتمد أثناء تأدية العمل/500.00', '2024-11-04', 'archived', 33, '2025-04-09 17:16:28', '2025-04-20 18:54:38', 'admin'),
(214, '2412640193263967/محمد جنيد محمد/أ س و 8513 سعودي/عدم تأمين سائق مساعد في الرحلة الطويلة التي تبلغ مسافتها (400) كيلو متر وأكثر/2000.00', '2024-10-16', 'archived', 33, '2025-04-09 17:18:27', '2025-04-20 18:55:09', 'admin'),
(215, '2418568307258130/  أ د ك 6585 سعودي/تشغيل سيارة دون الحصول على بطاقة تشغيل/ ببطاقة تشغيل ملغيه/5000.00', '2024-09-22', 'archived', 33, '2025-04-09 17:20:34', '2025-04-20 18:56:25', 'admin'),
(216, ':  2418572175526420/محمد جنيد توفيل رفيق محمد/ أ س و 8513 سعودي/عدم التزام السائق بالزي الوطني أو الزي المعتمد أثناء تأدية العمل/500.00', '2024-08-11', 'archived', 33, '2025-04-09 17:22:14', '2025-05-17 20:10:48', 'admin'),
(217, '2419467844917223/أ س س 2850 سعودي/تشغيل حافلة دون الحصول على بطاقة تشغيل/5000.00', '2024-06-26', 'archived', 33, '2025-04-09 17:24:05', '2025-05-17 20:09:01', 'admin'),
(218, '2413485084365135/عادل رسول/  أ ح د 4293 سعودي/عدم التزام السائق بالزي المعتمد أثناء تأدية العمل/500.00', '2024-06-11', 'archived', 33, '2025-04-09 17:26:00', '2025-04-20 18:55:39', 'admin'),
(219, '2417484691529594/ محمد اسجد/ أ د ك 5456 سعودي/عدم العناية بالحالة الفنية للسيارة وصيانتها/2000.00', '2024-06-06', 'archived', 33, '2025-04-09 17:27:48', '2025-04-20 18:56:10', 'admin'),
(220, '2513863477785172/محمد موباسبا احسن/أ س س 2850 سعودي/عدم تأمين سائق مساعد في الرحلة الطويلة التي تبلغ مسافتها (400) كيلو متر وأكثر/2000.00', '2025-03-23', 'archived', 33, '2025-04-09 17:47:33', '2025-05-17 20:10:13', 'admin'),
(221, '2515883973779120/ محمد موباسبا احسن/أ س س 2850 سعودي/تشغيل حافلة لا يتوفر بها أي من المواصفات والشروط والتجهيزات الفنية المعتمدة/1000.00', '2025-03-23', 'archived', 33, '2025-04-09 17:52:38', '2025-05-17 20:11:22', 'admin'),
(222, 'محمد رشد', '2025-08-15', NULL, 18, '2025-04-26 19:50:44', '2025-04-26 19:50:44', 'ابو احمد'),
(223, 'عبدالله عبد المجيد /2522929161', '2026-04-23', NULL, 18, '2025-05-12 15:10:52', '2025-05-12 15:20:58', 'ابو يحي '),
(224, 'برويز اختر /2526523713', '2026-04-24', NULL, 18, '2025-05-12 15:16:25', '2025-05-12 15:16:25', 'ابو يحي '),
(225, 'ثامن صديق ابراهيم /2145434904', '2024-01-25', NULL, 18, '2025-05-12 15:23:57', '2025-05-12 15:23:57', 'ابو يحي '),
(226, 'محمد عربي نبي بخش', '2024-01-13', NULL, 18, '2025-05-12 15:27:22', '2025-05-12 15:27:22', 'ابو يحي '),
(227, 'اسحاق علي قاسم', '2025-06-28', 'archived', 18, '2025-05-12 15:29:25', '2025-06-22 08:59:09', 'ابو يحي '),
(228, 'عبد الله محب الله عبد الله', '2019-03-02', NULL, 18, '2025-05-12 15:34:30', '2025-05-12 15:34:30', 'ابو يحي '),
(229, 'تويوتا ميكرو باص أ س ع 6524', '2026-09-13', NULL, 14, '2025-05-17 20:07:39', '2025-05-17 20:07:39', 'new_user'),
(230, 'حمزة', '2025-06-18', NULL, 25, '2025-05-18 17:17:52', '2025-05-18 17:17:52', 'ابو يحي '),
(231, 'احمد اسلام عبد السلام', '2025-04-01', NULL, 24, '2025-05-20 15:27:22', '2025-05-20 15:27:22', 'ابو يحي '),
(232, 'اسلام ناصف بالرؤوف الشويمي', '2025-06-01', NULL, 24, '2025-05-20 15:31:08', '2025-05-20 15:31:08', 'ابو يحي '),
(233, 'ريان عبدالرحمن محمود', '2025-06-01', NULL, 24, '2025-05-20 15:32:01', '2025-05-20 15:32:01', 'ابو يحي '),
(234, 'عبد الله عبد المجيد /2522929161', '2025-06-01', NULL, 24, '2025-05-20 15:33:09', '2025-05-20 15:33:09', 'ابو يحي '),
(235, 'ماجد عبدالله عثمان', '2025-06-01', NULL, 24, '2025-05-20 15:34:11', '2025-05-20 15:34:11', 'ابو يحي '),
(236, 'محمد اقبال غلام محمد / 2418680076', '2025-05-01', NULL, 24, '2025-05-20 15:38:55', '2025-05-20 15:38:55', 'ابو يحي '),
(237, 'نواف عبدالفتاح داود', '2025-07-01', NULL, 24, '2025-05-20 15:40:08', '2025-06-09 15:56:58', 'ابو يحي '),
(238, 'عماد محمد اسماعيل العمري /1095200893', '2025-06-01', NULL, 24, '2025-05-20 15:42:19', '2025-05-20 15:42:19', 'ابو يحي '),
(239, 'عبد الله محب الله عبدالله', '2025-01-01', NULL, 24, '2025-05-20 16:07:23', '2025-05-20 16:07:23', 'ابو يحي '),
(240, 'ثامن صديق ابراهيم', '2025-07-01', NULL, 24, '2025-05-20 16:08:53', '2025-05-31 18:55:11', 'ابو يحي '),
(241, 'شبير حسين محمد/	2243029119', '2025-01-01', NULL, 24, '2025-05-20 16:10:44', '2025-05-20 16:10:44', 'ابو يحي '),
(242, 'محمد شاه', '2025-01-01', NULL, 24, '2025-05-20 16:11:26', '2025-05-20 16:11:26', 'ابو يحي '),
(243, 'محمد عاصف الدين', '2025-01-01', NULL, 24, '2025-05-20 16:11:47', '2025-05-20 16:11:47', 'ابو يحي '),
(244, 'مد معصوم مياه', '2025-01-01', NULL, 24, '2025-05-20 16:12:03', '2025-05-20 16:12:03', 'ابو يحي '),
(245, 'نزمول اسلام اسلام', '2025-01-01', NULL, 24, '2025-05-20 16:12:23', '2025-05-20 16:12:23', 'ابو يحي '),
(246, 'ريان عبدالرحمن محمود /1120750136', '2026-01-01', NULL, 18, '2025-05-31 07:20:30', '2025-05-31 07:20:30', 'ابو يحي '),
(247, 'عماد محمد اسماعيل العمري', '2026-01-01', NULL, 18, '2025-05-31 07:22:05', '2025-05-31 07:22:05', 'ابو يحي '),
(248, 'ماجد عبدالله عثمان', '2026-01-01', NULL, 18, '2025-05-31 07:22:25', '2025-05-31 07:22:25', 'ابو يحي '),
(249, 'نواف عبدالفتاح داود', '2026-01-01', NULL, 18, '2025-05-31 07:22:47', '2025-05-31 07:22:47', 'ابو يحي '),
(250, 'شبير حسين محمد', '2018-07-23', NULL, 18, '2025-05-31 07:46:04', '2025-05-31 07:46:04', 'ابو يحي '),
(251, 'محمد شاه', '2024-12-20', NULL, 18, '2025-05-31 07:47:04', '2025-05-31 07:47:04', 'ابو يحي '),
(252, 'محمد عاصف الدين', '2023-12-05', NULL, 18, '2025-05-31 07:48:08', '2025-05-31 07:48:08', 'ابو يحي '),
(253, 'مد معصوم مياه', '2023-03-27', NULL, 18, '2025-05-31 07:49:12', '2025-05-31 07:49:12', 'ابو يحي '),
(254, 'نزمول اسلام اسلام', '2023-09-05', NULL, 18, '2025-05-31 07:50:25', '2025-05-31 07:50:25', 'ابو يحي '),
(255, 'ستاركس ا ص و 6244', '2028-05-01', NULL, 14, '2025-06-01 18:20:55', '2025-06-01 18:25:17', 'ابو يحي '),
(256, 'استاركس اص و 6244', '2026-05-24', NULL, 17, '2025-06-01 18:27:11', '2025-06-01 18:27:11', 'ابو يحي '),
(257, 'استاركس اص و 6244', '2026-05-28', NULL, 16, '2025-06-01 18:28:15', '2025-06-01 18:28:15', 'ابو يحي '),
(258, 'استاركس اص و 6244', '2026-05-22', NULL, 15, '2025-06-01 18:31:43', '2025-06-01 18:31:43', 'ابو يحي '),
(259, 'استاركس اص و 6244', '2025-07-01', NULL, 25, '2025-06-01 18:35:44', '2025-06-01 18:35:44', 'ابو يحي '),
(260, 'محمد جنيد /أ س و 8513', '2025-07-07', NULL, 25, '2025-06-01 18:56:23', '2025-06-09 06:57:05', 'ابو يحي '),
(261, 'فاروق ا ص ح 2216', '2025-05-01', NULL, 25, '2025-06-01 19:00:00', '2025-06-01 19:00:00', 'ابو يحي '),
(262, 'محمد موباسيا  احسان طالب حسين', '2025-12-11', NULL, 19, '2025-06-04 06:34:06', '2025-06-04 06:34:06', 'ابو يحي '),
(263, 'احمد اسلام عبد السلام', '2025-05-01', NULL, 19, '2025-06-04 06:40:21', '2025-06-04 06:40:21', 'ابو يحي '),
(264, 'اسلام ناصف عبدالرؤوف الشويمي', '2025-05-01', NULL, 19, '2025-06-04 06:40:45', '2025-06-04 06:40:45', 'ابو يحي '),
(265, 'ريان عبدالرحمن محمود', '2025-05-01', NULL, 19, '2025-06-04 06:41:07', '2025-06-04 06:41:07', 'ابو يحي '),
(266, 'عبدالله عبد المجيد /2522929161', '2025-05-01', NULL, 19, '2025-06-04 06:41:37', '2025-06-04 06:41:37', 'ابو يحي '),
(267, 'عماد محمد اسماعيل العمري', '2025-05-01', NULL, 19, '2025-06-04 06:42:03', '2025-06-04 06:42:03', 'ابو يحي '),
(268, 'قاسم علي عاشق  حسين', '2025-05-01', NULL, 19, '2025-06-04 06:43:04', '2025-06-04 06:43:04', 'ابو يحي '),
(269, 'ماجد عبدالله عثمان', '2025-05-01', NULL, 19, '2025-06-04 06:43:25', '2025-06-04 06:43:25', 'ابو يحي '),
(270, 'محمد اقبال غلام محمد', '2025-05-01', NULL, 19, '2025-06-04 06:44:05', '2025-06-04 06:44:05', 'ابو يحي '),
(271, 'نبيل شنجند حمزة', '2025-05-01', NULL, 19, '2025-06-04 06:44:42', '2025-06-04 06:44:42', 'ابو يحي '),
(272, 'نواف عبدالفتاح داود', '2025-05-01', NULL, 19, '2025-06-04 06:44:57', '2025-06-04 06:44:57', 'ابو يحي '),
(273, 'عبدالله محب الله عبدالله', '2025-05-01', NULL, 19, '2025-06-04 06:47:35', '2025-06-04 06:47:35', 'ابو يحي '),
(274, 'ثامن صديق', '2025-05-01', NULL, 19, '2025-06-04 06:48:02', '2025-06-04 06:48:02', 'ابو يحي '),
(275, 'محمد عربي نبي بخش', '2025-05-01', NULL, 19, '2025-06-04 06:48:27', '2025-06-04 06:48:27', 'ابو يحي '),
(276, 'شبير حسين محمد', '2025-05-01', NULL, 19, '2025-06-04 06:48:55', '2025-06-04 06:48:55', 'ابو يحي '),
(277, 'محمد شاه', '2025-05-01', NULL, 19, '2025-06-04 06:49:14', '2025-06-04 06:49:14', 'ابو يحي '),
(278, 'محمد عاصف الدين', '2025-05-01', NULL, 19, '2025-06-04 06:49:35', '2025-06-04 06:49:35', 'ابو يحي '),
(279, 'مد معصوم مياه', '2025-05-01', NULL, 19, '2025-06-04 06:50:53', '2025-06-04 06:50:53', 'ابو يحي '),
(280, 'نزمول اسلام اسلام', '2025-05-01', NULL, 19, '2025-06-04 06:51:17', '2025-06-04 06:51:17', 'ابو يحي '),
(281, 'خالد عبدالمحسن  محمد الكحيلاني', '2025-07-01', NULL, 24, '2025-06-09 15:50:01', '2025-06-09 15:50:01', 'ابو يحي '),
(282, 'احمد ثروات محمد عبدالغني', '2025-07-01', NULL, 24, '2025-06-09 15:53:30', '2025-06-09 15:53:30', 'ابو يحي '),
(283, 'عبدالحميد يحي حكيم', '2025-07-01', NULL, 24, '2025-06-09 15:55:37', '2025-06-09 15:55:37', 'ابو يحي '),
(284, 'نادر عبيدالله العمري', '2026-07-01', NULL, 18, '2025-06-21 06:34:49', '2025-06-21 06:42:08', 'ابو يحي '),
(285, 'خالد عبدالمحسن  محمد الكحيلاني', '2026-07-01', NULL, 18, '2025-06-21 06:35:45', '2025-06-21 06:41:56', 'ابو يحي '),
(286, 'نادر عبيدالله العمري', '2026-01-01', NULL, 18, '2025-06-21 06:39:58', '2025-06-21 06:39:58', 'ابو يحي '),
(287, 'نادر عبيدالله العمري', '2025-05-01', NULL, 19, '2025-06-21 06:46:49', '2025-06-21 06:46:49', 'ابو يحي '),
(288, 'احمد ثروات محمد عبدالغني', '2025-05-01', NULL, 19, '2025-06-21 07:05:50', '2025-06-21 07:05:50', 'ابو يحي '),
(289, 'عبدالحميد يحي حكيم', '2025-05-01', NULL, 19, '2025-06-21 07:07:24', '2025-06-21 07:07:24', 'ابو يحي '),
(290, 'السجل التجاري', '2025-08-18', 'archived', 35, '2025-06-27 08:06:40', '2025-06-27 08:17:12', 'ابو احمد'),
(291, 'السجل التجاري', '2026-08-18', NULL, 34, '2025-06-27 08:18:09', '2025-09-09 12:52:20', 'ابو احمد'),
(292, 'رخصة البلدية', '2026-08-18', NULL, 34, '2025-06-27 08:22:22', '2025-09-09 12:53:13', 'ابو احمد'),
(293, 'ترخيص الدفاع المدني', '2026-08-18', NULL, 34, '2025-06-27 08:24:40', '2025-09-09 12:52:44', 'ابو احمد'),
(294, 'شهادة عضوية الغرفة التجارية', '2026-08-18', NULL, 34, '2025-06-27 08:28:26', '2025-09-09 12:53:00', 'ابو احمد'),
(295, 'اشتراك منصة قوى', '2026-07-20', NULL, 34, '2025-06-27 08:33:31', '2025-07-26 12:07:15', 'ابو احمد'),
(296, 'اشتراك منصة مقيم', '2026-06-14', NULL, 34, '2025-06-27 08:37:48', '2025-06-27 08:37:48', 'ابو احمد'),
(297, 'سداد فاتورة قوي مع خدمات المكتب', '2026-07-20', NULL, 10, '2025-07-26 12:09:53', '2025-07-26 12:09:53', 'اسلام ناصف  '),
(298, 'تغيير comproser المكيف تبع الشركة', '2027-07-28', 'archived', 34, '2025-07-28 12:36:38', '2025-09-02 18:30:57', 'اسلام ناصف  '),
(299, 'فاتوره تصليح مكيف الشركه', '2028-07-30', 'archived', 34, '2025-07-28 12:37:11', '2025-09-26 15:54:38', 'اسلام ناصف  '),
(300, 'سداد فاتوره اربع سيارات سند', '2026-06-26', NULL, 34, '2025-07-29 09:36:07', '2025-07-29 09:36:07', 'اسلام ناصف  '),
(301, 'وصل سيارات حق الربط مستند', '2026-06-23', NULL, 34, '2025-07-29 09:37:58', '2025-07-29 09:37:58', 'اسلام ناصف  '),
(302, 'وصل سيارات حق الربط مستند-compressed', '2026-06-26', NULL, 34, '2025-07-29 09:39:32', '2025-07-29 09:39:32', 'اسلام ناصف  '),
(303, 'فاتوره مشتريات شركه الجواب', '2030-07-21', NULL, 34, '2025-08-02 15:34:51', '2025-08-02 15:34:51', 'اسلام ناصف  '),
(304, 'فاتوره الوان طابعه شركه الجواب', '2030-08-03', NULL, 34, '2025-08-03 17:38:24', '2025-08-03 17:38:24', 'اسلام ناصف  '),
(305, 'إمحمد كاشف قرار تسليم مركبه 6580', '2025-12-31', NULL, 36, '2025-08-03 18:08:14', '2025-08-03 18:08:14', 'اسلام ناصف  '),
(306, 'محمد كاشف قرار تسليم مركبه 6580', '2025-12-31', NULL, 36, '2025-08-03 18:08:29', '2025-08-03 18:08:29', 'اسلام ناصف  '),
(307, 'إقرار تسليم مركبه نبيل شنجنذ 5456', '2025-12-31', NULL, 36, '2025-08-03 18:09:13', '2025-08-03 18:09:13', 'اسلام ناصف  '),
(308, '-حسن معاوية-إقرار تسليم مركبة', '2025-12-31', NULL, 36, '2025-08-03 18:09:44', '2025-08-03 18:09:44', 'اسلام ناصف  '),
(309, 'رخصه سير  6580 ا س ا', '2025-12-03', NULL, 14, '2025-08-03 18:10:48', '2025-08-03 18:10:48', 'اسلام ناصف  '),
(310, 'حساب ارساد', '2030-11-30', NULL, 38, '2025-08-04 15:11:03', '2025-08-04 15:11:03', 'اسلام ناصف  '),
(311, 'برويز اختر', '2030-11-30', NULL, 38, '2025-08-04 15:11:31', '2025-08-04 15:11:31', 'اسلام ناصف  '),
(312, 'اسحاق علي', '2030-11-30', NULL, 38, '2025-08-04 15:11:57', '2025-08-04 15:11:57', 'اسلام ناصف  '),
(313, 'فاتوره تصويرشركه الجواب', '2030-03-31', NULL, 34, '2025-08-07 18:56:00', '2025-08-07 18:56:00', 'اسلام ناصف  '),
(314, 'Test', '2025-10-18', 'archived', 1, '2025-10-05 17:42:22', '2025-10-08 13:31:25', 'Abdullah'),
(315, 'Test', '2025-10-23', 'archived', 35, '2025-10-08 13:30:47', '2025-10-08 13:31:32', 'Abdullah'),
(316, 'Tolba Test', '2025-10-17', NULL, 14, '2025-10-14 06:08:39', '2025-10-14 06:08:39', 'Abdullah');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `archive` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `moqem_expire_at` varchar(255) DEFAULT NULL,
  `mokhalsa_expire_at` varchar(255) DEFAULT NULL,
  `cart_expire_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `nationality`, `identity_number`, `joining_date`, `job_title`, `archive`, `created_at`, `updated_at`, `user_name`, `company`, `phone`, `moqem_expire_at`, `mokhalsa_expire_at`, `cart_expire_at`) VALUES
(1, 'عيدروس ابراهيم عيدروس احمد', 'اليمن', '2286565011', '2024-11-17', 'سائق', NULL, '2025-03-04 11:18:41', '2025-10-07 15:26:33', NULL, 'العملاء', NULL, NULL, NULL, NULL),
(2, 'اسلام', 'سوداني', '210450621', '2025-02-21', 'سائق حافله', NULL, '2025-03-04 11:32:55', '2025-10-11 07:21:08', NULL, 'شركة الجواب للنقل البري', '050000000', '2025-04-14', NULL, '2030-01-01'),
(3, 'فاروق احمد احمد الدين', 'باكستان', '2331429924', '2024-08-01', 'سائق حافله', NULL, '2025-03-04 11:33:47', '2025-10-11 07:11:03', NULL, 'شركة الجواب للنقل البري', '0596118873', '2025-09-29', NULL, '2026-07-18'),
(4, 'محمد كاشف عبدالرشيد', 'باكستان', '23959650450', '2024-01-01', 'سائق', NULL, '2025-03-04 11:34:47', '2025-10-09 10:17:34', NULL, 'شركة الجواب للنقل البري', '0583437452', NULL, NULL, '2026-01-11'),
(5, 'محمد اقبال غلام محمد', 'باكستان', '2418680076', '2024-10-01', 'سائق حافله', NULL, '2025-03-04 11:35:27', '2025-10-11 07:06:49', NULL, 'شركة الجواب للنقل البري', '0586246933', '2026-05-01', '2025-09-01', '2026-08-07'),
(6, 'احمد اسلام عبدالسلام', 'باكستان', '2437206887', '2024-07-01', 'مشرف السائقين', NULL, '2025-03-04 11:36:40', '2025-10-07 15:26:33', NULL, 'العملاء', NULL, '2025-06-15', NULL, NULL),
(7, 'جعفر عبدالمؤمن عمر سليمان', 'السودان', '2446721751', '2025-01-12', 'سائق سيارة أجرة', NULL, '2025-03-04 11:37:26', '2025-10-11 07:00:51', NULL, 'شركة الجواب للنقل البري', '0576873115', '2025-10-25', '2025-12-31', '2026-01-11'),
(8, 'محمد جنيد تيفيل محمد', 'باكستان', '2486823145', '2024-06-26', 'سائق حافلة', NULL, '2025-03-04 11:38:01', '2025-10-09 10:24:58', NULL, 'شركة الجواب للنقل البري', '0564620560', '2026-03-24', '2025-12-31', '2026-07-21'),
(9, 'محمد اصف عبد ال خوشي محمد', 'باكستان', '2493027219', '2024-11-10', 'سائق حافله', NULL, '2025-03-04 11:38:26', '2025-10-07 15:26:33', NULL, 'شركة الجواب للنقل البري', '0563685825', '2025-06-04', NULL, NULL),
(10, 'عبدالله عبدالحميد', 'باكستان', '2522929161', '2025-02-20', 'مبرمج', NULL, '2025-03-04 11:39:29', '2025-10-07 15:26:33', NULL, 'العملاء', NULL, '2026-03-23', NULL, '2030-01-01'),
(11, 'نائف محمد علي مسمار', 'اليمن', '2527990234', '2025-01-06', 'سائق سيارة أجرة', NULL, '2025-03-04 11:40:38', '2025-10-07 15:26:33', NULL, 'شركة الجواب للنقل البري', '0559350507', '2024-01-03', NULL, NULL),
(12, 'فهد الله مهيأ', 'باكستان', '2531169957', '2024-06-11', 'سائق حافله', NULL, '2025-03-04 11:41:17', '2025-10-07 15:26:33', NULL, 'شركة الجواب للنقل البري', '0566457158', '2025-08-07', '2025-12-31', '2025-07-29'),
(13, 'سيرفاراز احمد شيخ محمد', 'باكستان', '2549796627', '2024-01-01', 'سائق', NULL, '2025-03-04 11:41:40', '2025-10-09 10:15:43', NULL, 'العملاء', NULL, NULL, NULL, NULL),
(14, 'محمد وقاص محمد نازير', 'باكستان', '2560509768', '2025-02-14', 'سائق حافله', NULL, '2025-03-04 11:42:20', '2025-10-09 10:03:43', NULL, 'شركة الجواب للنقل البري', NULL, '2026-01-21', NULL, '2026-07-21'),
(15, 'علي عباس فرهات عباس', 'باكستان', '2566696445', '2024-09-01', 'سائق حافله', NULL, '2025-03-04 11:42:49', '2025-10-09 10:01:41', NULL, 'شركة الجواب للنقل البري', '0593002638', '2025-04-22', NULL, '2020-01-02'),
(16, 'محمد مباشر احسان طالب حسين', 'باكستان', '0010', '2024-01-01', 'سائق', NULL, '2025-03-04 11:43:19', '2025-10-11 07:03:33', NULL, 'شركة الجواب للنقل البري', NULL, '2025-10-24', NULL, '2026-07-18'),
(17, 'نبيل شنجنذ حمزة', 'هندي', '2522993480', '2025-03-18', 'سائق سيارة أجرة', NULL, '2025-03-04 12:19:20', '2025-10-09 10:23:22', NULL, 'شركة الجواب للنقل البري', '0574625702', '2025-11-18', '2025-12-31', '2026-01-11'),
(18, 'محمد ارشد محمد شاديك', 'باكستان', '2459163636', '2025-02-02', 'سائق', NULL, '2025-03-04 12:41:21', '2025-10-07 15:26:33', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'اسحاق علي قاسم', 'الهند', '2019373410', '2024-01-01', 'سائق', NULL, '2025-03-04 13:34:37', '2025-10-09 10:10:20', NULL, 'مؤسسة الجواب للنقل البري', '0502766562', '2026-06-19', '2025-12-31', '2026-01-11'),
(20, 'امير احمد بشير محمود', 'السودان', '2207128063', '2025-01-01', 'سائق سيارة أجرة', NULL, '2025-04-12 17:49:00', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0592849192', NULL, NULL, NULL),
(21, 'ارساد علي غلام عبادي', 'باكستان', '2556222632', '2025-01-01', 'سائق حافله', NULL, '2025-04-12 18:21:01', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0543281034', NULL, NULL, NULL),
(22, 'سعيد احمد رازا', 'باكستان', '0000', '2025-01-01', 'سائق سيارة أجرة', NULL, '2025-04-12 18:35:18', '2025-10-07 15:26:33', 'ابو يحي ', NULL, NULL, NULL, NULL, NULL),
(23, 'محمد رشد', 'باكستان', '2331742888', '2025-01-01', 'سائق سيارة أجرة', NULL, '2025-04-12 18:50:08', '2025-10-09 10:19:47', 'ابو يحي ', 'رواسي التل للمقاولات العامة', '0594815767', '2025-11-04', '2025-09-01', '2026-01-11'),
(24, 'محمد عربي نبي بخش', 'باكستان', '2172453546', '2025-01-01', 'سائق سيارة أجرة', NULL, '2025-04-12 18:53:37', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0596645044', NULL, '2025-12-31', NULL),
(25, 'محمد كاشف عبدالرشيد', 'باكستان', '2395965045', '2024-08-01', 'سائق سيارة أجرة', NULL, '2025-04-12 19:03:28', '2025-10-11 07:18:02', 'ابو يحي ', 'العملاء', '0583437452', '2025-12-28', '2025-12-31', '2026-01-11'),
(26, 'قاسم', 'باكستان', '111', '2025-01-01', 'سائق حافله', NULL, '2025-04-12 19:25:33', '2025-10-07 15:26:33', 'ابو يحي ', NULL, NULL, NULL, NULL, NULL),
(27, 'محمد موباسيا احسن طالب حسين', 'باكستان', '2586884013', '2025-01-01', 'سائق حافله', NULL, '2025-04-12 19:35:14', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '05444577617', '2025-10-24', NULL, '2026-08-17'),
(28, 'حمزة', 'باكستان', '2482260870', '2025-01-01', 'سائق حافله', NULL, '2025-04-12 19:44:33', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0568631389', NULL, NULL, NULL),
(29, 'برويز اختر', 'باكستان', '2526523713', '2025-01-01', 'سائق حافله', NULL, '2025-04-12 19:48:13', '2025-10-09 10:07:59', 'ابو يحي ', 'مؤسسة سميرة', '0580326107', '2025-10-17', NULL, '2026-07-20'),
(30, 'محمد عمران محمد عزيز بهتي', 'باكستان', '2546289105', '2025-04-13', 'سائق سيارة أجرة', NULL, '2025-04-13 18:28:33', '2025-10-07 15:26:33', 'ابو يحي ', NULL, NULL, NULL, NULL, NULL),
(31, 'سعيد احمد رازا', 'باكستان', '22', '2025-01-01', 'سائق سيارة أجرة', NULL, '2025-04-14 16:01:20', '2025-10-07 15:26:33', 'ابو يحي ', NULL, NULL, NULL, NULL, NULL),
(32, 'شمس الدين شلقامي العريان محمد', 'مصر', '20000', '2024-01-01', 'سائق خاص', NULL, '2025-04-19 19:57:03', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(33, 'عادل رسول', 'باكستان', '211111', '2024-01-01', 'سائق', NULL, '2025-04-19 20:08:31', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(34, 'محمد عسجد بشير احمد', 'باكستان', '00010', '2024-01-01', 'سائق', NULL, '2025-04-19 20:13:46', '2025-10-09 10:16:18', 'ابو احمد', 'العملاء', NULL, NULL, NULL, NULL),
(35, 'عبد الله عريف محمد عريف', 'باكستان', '2400167678', '2018-07-23', 'تنفيذ', NULL, '2025-04-20 17:23:56', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(36, 'ماجد مثنى مسعد الوجيه', 'يمني', '2267174684', '2020-03-15', 'تنفيذ', NULL, '2025-04-20 17:47:59', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(37, 'محمد فرهد محمد علي', 'بنغالي', '2254391598', '2020-08-17', 'تنفيذ', NULL, '2025-04-20 17:55:46', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(38, ': وليد محمد عباس الأمين', 'السودان', '2318204423', '2020-08-31', 'تنفيذ', NULL, '2025-04-20 18:10:43', '2025-10-07 15:26:33', 'ابو احمد', 'العملاء', '0560022883', '2020-01-28', NULL, NULL),
(39, 'محمد حسن غلام ديوايا', 'باكستان', '2190961595', '2020-08-14', 'تنفيذ', NULL, '2025-04-20 18:16:21', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(40, 'محمد ضياء الحق عبدالرشيد', 'بنغالي', '2110086713', '2020-09-30', 'تنفيذ', NULL, '2025-04-20 18:20:08', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(41, 'وليد عبدالرحمن عبدالجلال', 'افغاني', '2123214419', '2020-03-19', 'تنفيذ', NULL, '2025-04-20 18:24:23', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(42, 'ابراهيم عبدالرحمن عبدالجلال', 'افغاني', '2129944936', '2020-03-08', 'تنفيذ', NULL, '2025-04-20 18:28:49', '2025-10-07 15:26:33', 'ابو احمد', 'العملاء', NULL, NULL, NULL, NULL),
(43, 'قاسم علي عاشق  حسين', 'باكستان', '2530006903', '2025-03-02', 'سائق حافله', NULL, '2025-04-26 20:53:56', '2025-10-07 15:26:33', 'ابو يحي ', 'شركة الجواب للنقل البري', NULL, '2025-11-12', NULL, NULL),
(44, 'ثامن صديق', 'نيجيري', '2145434904', '2024-12-12', 'سائق', NULL, '2025-04-28 09:47:04', '2025-10-11 07:13:57', 'ابو احمد', 'رواسي التل للمقاولات العامة', '0582661630', NULL, '2025-12-31', NULL),
(45, 'محمد ريفاي بيسزت', 'سري لنكا', '2503044774', '2024-12-12', 'سائق', NULL, '2025-04-28 09:51:14', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(46, 'فياض كريم كريم', 'باكستان', '2588812806', '2024-12-04', 'سائق', NULL, '2025-04-28 10:06:30', '2025-10-07 15:26:33', 'ابو احمد', NULL, NULL, NULL, NULL, NULL),
(47, 'عماد محمد اسماعيل العمري', 'السعودية', '1095200893', '2025-01-01', 'مساعد اداري', NULL, '2025-05-04 19:22:43', '2025-10-11 07:11:28', 'ابو احمد', 'شركة الجواب للنقل البري', NULL, '2026-10-10', NULL, '2030-01-01'),
(48, 'ميار ماجد بن ناصر عزي', 'سعوديه', '1131884999', '2025-01-01', 'مساعد اداري', NULL, '2025-05-04 19:24:43', '2025-10-09 10:17:46', 'ابو احمد', 'العملاء', NULL, NULL, NULL, NULL),
(49, 'عبدالله محب الله عبدالله', 'باكستان', '2074077120', '2019-01-01', 'سائق', NULL, '2025-05-10 19:51:33', '2025-10-11 07:17:05', 'ابو احمد', 'مؤسسة الجواب للنقل البري', NULL, '2019-01-01', NULL, NULL),
(50, 'ماجد عبدالله عثمان', 'سعودي', '1107215814', '2025-05-08', 'مساعد اداري', NULL, '2025-05-19 19:12:40', '2025-10-11 07:21:39', 'ابو يحي ', 'مؤسسة سميرة', NULL, '2030-01-01', NULL, '2030-01-01'),
(51, 'نواف عبدالفتاح داود', 'سعودي', '1096861024', '2025-05-08', 'مدير اداري', NULL, '2025-05-19 19:14:32', '2025-10-11 07:22:50', 'ابو يحي ', 'شركة الجواب للنقل البري', NULL, '2026-10-10', NULL, '2030-01-01'),
(52, 'ريان عبدالرحمن محمود', 'سعودي', '1120750136', '2025-05-08', 'مساعد اداري', NULL, '2025-05-19 19:15:19', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, '2026-10-10', NULL, '2030-01-01'),
(53, 'محمد عاصف الدين', 'باكستان', '2515676191', '2022-08-11', 'سائق سيارة أجرة', NULL, '2025-05-19 19:50:59', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, NULL),
(54, 'شبير حسين محمد', 'باكستان', '2243029119', '2022-10-03', 'فني تدفئة وتهوية وتكييف', NULL, '2025-05-19 19:55:33', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, '2030-01-01'),
(55, 'مد معصوم مياه', 'بنجلادشي', '2525100919', '2023-01-09', 'عامل تحميل وتنزيل', NULL, '2025-05-19 20:00:49', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, NULL),
(56, 'محمد شاه', 'بنجلادشي', '2108795382', '2022-11-12', 'عامل نظافة', NULL, '2025-05-19 20:02:45', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, '2030-01-01'),
(57, 'نزمول اسلام اسلام', 'بنجلادشي', '2515491328', '2022-08-29', 'عامل عادي', NULL, '2025-05-19 20:04:22', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, NULL),
(58, 'احمد انور حامد محمد', 'مصر', '2493988212', '2025-05-25', 'سائق سيارة أجرة', NULL, '2025-05-25 19:03:30', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', NULL, NULL, NULL, NULL),
(59, 'محمد ناصر حنيف', 'سيرلانكا', '00000', '2025-05-01', 'سائق', NULL, '2025-06-04 07:40:16', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0543319011', NULL, NULL, NULL),
(60, 'التكافل الراجحي', '0', '01', '2025-05-01', '2', NULL, '2025-06-07 18:51:34', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0', NULL, NULL, NULL),
(61, 'شركة ملاذ للتامين', 'اا', 'اااااا', '2025-05-01', '4', NULL, '2025-06-07 18:53:13', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', 'اا', NULL, NULL, NULL),
(62, 'عبدالحميد يحيى حكيم محمد', 'سعودي', '3', '2025-04-01', 'مساعد اداري', NULL, '2025-06-07 19:53:43', '2025-10-07 15:26:33', 'ابو احمد', 'العملاء', '0560022883', NULL, NULL, NULL),
(63, 'خالد عبدالمحسن  محمد الكحيلاني', 'سعودي', '1098153636', '2025-06-09', 'مساعد اداري', NULL, '2025-06-09 15:49:19', '2025-10-11 07:23:32', 'ابو يحي ', 'شركة الجواب للنقل البري', '0595196154', '2026-10-10', NULL, '2030-01-01'),
(64, 'احمد', 'بنجلاديش', '1204501', '2025-05-28', 'سائق حافله', NULL, '2025-06-09 15:52:17', '2025-10-11 07:24:10', 'ابو يحي ', 'شركة الجواب للنقل البري', '0551796056', '2025-08-20', NULL, '2030-01-01'),
(65, 'نادر عبيدالله العمري', 'سعودي', '1106434382', '2025-06-09', 'مساعد اداري', NULL, '2025-06-21 06:38:28', '2025-10-07 15:26:33', 'ابو يحي ', 'العملاء', '0560022883', '2026-10-10', NULL, '2030-01-01'),
(66, 'عاصم محمد عبدالغني ارمان', 'باكستان', '2603288669', '2025-06-25', 'سائق حافله', NULL, '2025-06-26 08:28:07', '2025-10-09 10:01:14', 'ابو يحي', 'شركة الجواب للنقل البري', '0562325561', '2026-06-17', NULL, '2026-07-18'),
(67, 'رانا ارباز خان عبدالله خان', 'باكستان', '2428025999', '2025-06-26', 'سائق حافله', NULL, '2025-06-26 08:35:38', '2025-10-07 15:26:33', 'ابو يحي', 'شركة الجواب للنقل البري', '0540663305', '2025-09-27', '2025-12-31', NULL),
(68, 'عبدالله مهيوب قاسم سعيد', 'اليمن', '2183338694', '2020-01-01', 'سائق سيارة أجرة', NULL, '2025-07-06 08:42:49', '2025-10-07 15:26:33', 'ابو احمد', 'العملاء', '0509951723', '2020-02-29', NULL, NULL),
(69, 'محمود على مصطفى كشه', 'السودان', '2359947724', '2020-01-01', 'سائق سيارة أجرة', NULL, '2025-07-06 08:48:02', '2025-10-07 15:26:33', 'ابو احمد', 'العملاء', '0561484476', '2017-12-30', NULL, NULL),
(70, 'محمد شكيل لهب دين', 'باكستان', '2417260110', '2025-06-26', 'طاهي', NULL, '2025-07-06 08:52:47', '2025-10-11 07:24:41', 'ابو احمد', 'شركة الجواب للنقل البري', '0509403723', '2024-08-27', NULL, '2030-01-01'),
(71, 'محمد اقبال فضل الدين فضل الدين', 'باكستان', '2556148381', '2025-07-17', 'سائق', NULL, '2025-07-17 18:59:35', '2025-10-07 15:26:33', 'ابو طلال ', 'العملاء', '0505636653', NULL, NULL, NULL),
(72, 'حسن معاوية لا لا عبد الستار', 'باكستاني', '2559800210', '1983-08-06', 'سائق حافلة', NULL, '2025-07-20 18:55:54', '2025-10-09 10:06:09', 'اسلام ناصف  ', 'شركة الجواب للنقل البري', '0531687567', '2026-12-27', NULL, '2026-08-13'),
(73, 'أصف جامشيد محمد جامشيد', 'باكستان', '2437555945', '2025-07-23', 'سائق', NULL, '2025-07-23 18:24:12', '2025-10-07 15:26:33', 'ابو طلال ', 'العملاء', '0561379677', NULL, NULL, NULL),
(74, 'محمد أجمل عبدالغني', 'باكستان', '2530696505', '2025-08-14', 'سائق', NULL, '2025-08-16 22:03:15', '2025-10-09 10:14:28', 'ابو طلال ', 'رواسي التل للمقاولات العامة', '0582548539', '2025-08-31', '2025-09-17', '2026-01-11'),
(75, 'نبيل احمد عامر عبدالعظيم', 'سعودي', '1108020619', '2025-08-01', '000', NULL, '2025-09-04 15:45:52', '2025-10-11 07:26:49', 'ابو احمد', 'شركة الجواب للنقل البري', '00', '2026-09-09', NULL, '2030-01-01'),
(76, 'ماجد عبدالله عثمان', 'سعودي', '11072158140', '2025-08-13', '00', 'archived', '2025-09-04 15:46:43', '2025-10-11 07:16:00', 'ابو احمد', 'شركة الجواب للنقل البري', '0001', '2026-09-09', NULL, '2020-01-01'),
(77, 'محمد طلبه حسن عبدالحليم', 'مصري', '2610335495', '2026-11-11', 'مبرمج', NULL, '2025-09-09 12:50:22', '2025-10-11 07:25:04', 'ابو احمد', 'شركة الجواب للنقل البري', '0000000000', '2026-01-11', NULL, '2030-01-01'),
(78, 'محمد ذو الفقار علي', 'باكستان', '2566745648', '2025-09-12', 'سائق سيارة أجرة', NULL, '2025-09-11 20:25:10', '2025-10-09 10:08:48', 'ابو يحي ', 'شركة الجواب للنقل البري', '0511270652', '2026-03-24', NULL, '2025-12-12'),
(79, 'Test Name', 'Test Nationality', '123456789', '2025-10-17', 'Test Job', 'archived', '2025-10-08 12:20:56', '2025-10-08 12:38:17', 'Abdullah', 'شركة الجواب للنقل البري', '123456789', '2026-02-20', '2025-10-02', '2025-10-02'),
(80, 'محمد فيصل دخيل الله الجهني', 'سعودي', '1130587379', '2025-09-29', 'أخصائي قانوني', NULL, '2025-10-11 06:44:02', '2025-10-11 06:48:47', 'محمد', 'شركة الجواب للنقل البري', '0559212188', '2030-10-15', NULL, '2030-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `employee_documents`
--

CREATE TABLE `employee_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_documents`
--

INSERT INTO `employee_documents` (`id`, `employee_id`, `type`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 7, 'mokhalsa', 'employee_files/1753292709_68811fa556345.pdf', '2025-07-23 17:45:09', '2025-07-23 17:45:09'),
(2, 7, 'mokhalsa', 'employee_files/1753292739_68811fc32f453.pdf', '2025-07-23 17:45:39', '2025-07-23 17:45:39'),
(3, 8, 'mokhalsa', 'employee_files/1753296537_68812e99692a7.pdf', '2025-07-23 18:48:57', '2025-07-23 18:48:57'),
(4, 12, 'mokhalsa', 'employee_files/1753296590_68812ece08b80.pdf', '2025-07-23 18:49:50', '2025-07-23 18:49:50'),
(5, 17, 'mokhalsa', 'employee_files/1753296613_68812ee5a5ea7.pdf', '2025-07-23 18:50:13', '2025-07-23 18:50:13'),
(6, 19, 'mokhalsa', 'employee_files/1753296630_68812ef672af6.pdf', '2025-07-23 18:50:30', '2025-07-23 18:50:30'),
(7, 23, 'mokhalsa', 'employee_files/1753296643_68812f037bf80.pdf', '2025-07-23 18:50:43', '2025-07-23 18:50:43'),
(8, 24, 'mokhalsa', 'employee_files/1753296659_68812f13bb62a.pdf', '2025-07-23 18:50:59', '2025-07-23 18:50:59'),
(9, 44, 'mokhalsa', 'employee_files/1753296672_68812f20389f8.pdf', '2025-07-23 18:51:12', '2025-07-23 18:51:12'),
(10, 67, 'mokhalsa', 'employee_files/1753296682_68812f2abf748.pdf', '2025-07-23 18:51:22', '2025-07-23 18:51:22'),
(11, 7, 'moqem', 'employee_files/1753610436_6885f8c4a78ab.jpg', '2025-07-27 10:00:36', '2025-07-27 10:00:36'),
(12, 27, 'card', 'employee_files/1753614318_688607ee1d6fe.pdf', '2025-07-27 11:05:18', '2025-07-27 11:05:18'),
(13, 17, 'card', 'employee_files/1753621280_68862320eb102.pdf', '2025-07-27 13:01:20', '2025-07-27 13:01:20'),
(14, 3, 'card', 'employee_files/1753768668_688862dc3105c.pdf', '2025-07-29 05:57:48', '2025-07-29 05:57:48'),
(15, 8, 'card', 'employee_files/1753783818_68889e0a74f97.pdf', '2025-07-29 10:10:18', '2025-07-29 10:10:18'),
(16, 29, 'card', 'employee_files/1753783939_68889e8321220.pdf', '2025-07-29 10:12:19', '2025-07-29 10:12:19'),
(17, 19, 'card', 'employee_files/1753787851_6888adcb68317.pdf', '2025-07-29 11:17:31', '2025-07-29 11:17:31'),
(18, 8, 'card', 'employee_files/1754148742_688e2f862f2b3.pdf', '2025-08-02 15:32:22', '2025-08-02 15:32:22'),
(19, 14, 'card', 'employee_files/1754148778_688e2faa3673e.pdf', '2025-08-02 15:32:58', '2025-08-02 15:32:58'),
(20, 64, 'moqem', 'employee_files/1754233649_688f7b31ca555.pdf', '2025-08-03 15:07:29', '2025-08-03 15:07:29'),
(21, 23, 'moqem', 'employee_files/1754319725_6890cb6d87dfc.jpg', '2025-08-04 15:02:05', '2025-08-04 15:02:05'),
(22, 66, 'card', 'employee_files/1754337941_68911295ee34a.pdf', '2025-08-04 20:05:41', '2025-08-04 20:05:41'),
(23, 64, 'moqem', 'employee_files/1754833362_6898a1d2a5dca.pdf', '2025-08-10 13:42:42', '2025-08-10 13:42:42'),
(24, 5, 'mokhalsa', 'employee_files/1755449594_68a208fa723b8.pdf', '2025-08-17 16:53:14', '2025-08-17 16:53:14'),
(25, 5, 'mokhalsa', 'employee_files/1755449799_68a209c7ab6ea.pdf', '2025-08-17 16:56:39', '2025-08-17 16:56:39'),
(26, 74, 'moqem', 'employee_files/1755450196_68a20b5413e3f.pdf', '2025-08-17 17:03:16', '2025-08-17 17:03:16'),
(27, 74, 'mokhalsa', 'employee_files/1755450440_68a20c480b263.pdf', '2025-08-17 17:07:20', '2025-08-17 17:07:20'),
(28, 74, 'card', 'employee_files/1755450741_68a20d754fad2.pdf', '2025-08-17 17:12:21', '2025-08-17 17:12:21'),
(29, 64, 'moqem', 'employee_files/1755506160_68a2e5f099850.pdf', '2025-08-18 08:36:00', '2025-08-18 08:36:00'),
(30, 76, 'card', 'employee_files/1757420359_68c01b4706ce8.pdf', '2025-09-09 12:19:19', '2025-09-09 12:19:19'),
(31, 75, 'card', 'employee_files/1757420391_68c01b678a5ed.pdf', '2025-09-09 12:19:51', '2025-09-09 12:19:51'),
(32, 76, 'moqem', 'employee_files/1757420424_68c01b882c7f6.pdf', '2025-09-09 12:20:24', '2025-09-09 12:20:24'),
(33, 75, 'moqem', 'employee_files/1757420445_68c01b9dc6abe.pdf', '2025-09-09 12:20:45', '2025-09-09 12:20:45'),
(34, 72, 'card', 'employee_files/1757421286_68c01ee697719.pdf', '2025-09-09 12:34:46', '2025-09-09 12:34:46'),
(35, 72, 'card', 'employee_files/1757421316_68c01f042e2a3.pdf', '2025-09-09 12:35:16', '2025-09-09 12:35:16'),
(36, 72, 'moqem', 'employee_files/1757421582_68c0200ef018c.jpeg', '2025-09-09 12:39:42', '2025-09-09 12:39:42'),
(37, 77, 'moqem', 'employee_files/1757422274_68c022c2d223d.jpg', '2025-09-09 12:51:14', '2025-09-09 12:51:14'),
(38, 77, 'card', 'employee_files/1757422295_68c022d75492c.jpg', '2025-09-09 12:51:35', '2025-09-09 12:51:35'),
(39, 25, 'mokhalsa', 'employee_files/1757624049_68c336f179423.jpeg', '2025-09-11 20:54:09', '2025-09-11 20:54:09'),
(40, 78, 'moqem', 'employee_files/1758013836_68c9298ce44d5.pdf', '2025-09-16 09:10:36', '2025-09-16 09:10:36'),
(41, 79, 'moqem', 'employee_files/1759927070_68e65b1eb1277.jpg', '2025-10-08 12:37:50', '2025-10-08 12:37:50'),
(42, 2, 'card', 'employee_files/1760003393_68e7854198bca.pdf', '2025-10-09 09:49:53', '2025-10-09 09:49:53'),
(43, 77, 'card', 'employee_files/1760003431_68e785674a66a.pdf', '2025-10-09 09:50:31', '2025-10-09 09:50:31'),
(44, 76, 'card', 'employee_files/1760003466_68e7858aa5264.pdf', '2025-10-09 09:51:06', '2025-10-09 09:51:06'),
(45, 75, 'card', 'employee_files/1760003508_68e785b46a5bf.pdf', '2025-10-09 09:51:48', '2025-10-09 09:51:48'),
(46, 72, 'card', 'employee_files/1760003542_68e785d62ddc8.pdf', '2025-10-09 09:52:22', '2025-10-09 09:52:22'),
(47, 66, 'card', 'employee_files/1760003579_68e785fbc4312.pdf', '2025-10-09 09:52:59', '2025-10-09 09:52:59'),
(48, 64, 'card', 'employee_files/1760003611_68e7861bc8ca2.pdf', '2025-10-09 09:53:31', '2025-10-09 09:53:31'),
(49, 63, 'card', 'employee_files/1760003650_68e7864255c7f.pdf', '2025-10-09 09:54:10', '2025-10-09 09:54:10'),
(50, 51, 'card', 'employee_files/1760003688_68e7866815a7b.pdf', '2025-10-09 09:54:48', '2025-10-09 09:54:48'),
(51, 25, 'card', 'employee_files/1760003729_68e7869123c2c.pdf', '2025-10-09 09:55:29', '2025-10-09 09:55:29'),
(52, 17, 'card', 'employee_files/1760003770_68e786ba689bf.pdf', '2025-10-09 09:56:10', '2025-10-09 09:56:10'),
(53, 14, 'card', 'employee_files/1760003820_68e786ec3f6dd.pdf', '2025-10-09 09:57:00', '2025-10-09 09:57:00'),
(54, 8, 'card', 'employee_files/1760003862_68e78716b364c.pdf', '2025-10-09 09:57:42', '2025-10-09 09:57:42'),
(55, 78, 'card', 'employee_files/1760003876_68e78724190f1.pdf', '2025-10-09 09:57:56', '2025-10-09 09:57:56'),
(56, 7, 'card', 'employee_files/1760003905_68e78741aadb3.pdf', '2025-10-09 09:58:25', '2025-10-09 09:58:25'),
(57, 78, 'card', 'employee_files/1760003940_68e787641ece4.pdf', '2025-10-09 09:59:00', '2025-10-09 09:59:00'),
(58, 5, 'card', 'employee_files/1760003988_68e787944b3d5.pdf', '2025-10-09 09:59:48', '2025-10-09 09:59:48'),
(59, 8, 'card', 'employee_files/1760003990_68e78796c360c.pdf', '2025-10-09 09:59:50', '2025-10-09 09:59:50'),
(60, 3, 'card', 'employee_files/1760004021_68e787b503b5f.pdf', '2025-10-09 10:00:21', '2025-10-09 10:00:21'),
(61, 8, 'card', 'employee_files/1760004047_68e787cf9f916.pdf', '2025-10-09 10:00:47', '2025-10-09 10:00:47'),
(62, 66, 'card', 'employee_files/1760004074_68e787ea20ce0.pdf', '2025-10-09 10:01:14', '2025-10-09 10:01:14'),
(63, 15, 'card', 'employee_files/1760004101_68e78805712c1.pdf', '2025-10-09 10:01:41', '2025-10-09 10:01:41'),
(64, 14, 'card', 'employee_files/1760004223_68e7887f09149.pdf', '2025-10-09 10:03:43', '2025-10-09 10:03:43'),
(65, 5, 'card', 'employee_files/1760004303_68e788cf0af2b.pdf', '2025-10-09 10:05:03', '2025-10-09 10:05:03'),
(66, 72, 'card', 'employee_files/1760004369_68e78911ef3d8.pdf', '2025-10-09 10:06:09', '2025-10-09 10:06:09'),
(67, 3, 'card', 'employee_files/1760004469_68e78975e055e.pdf', '2025-10-09 10:07:49', '2025-10-09 10:07:49'),
(68, 78, 'card', 'employee_files/1760004528_68e789b00be67.pdf', '2025-10-09 10:08:48', '2025-10-09 10:08:48'),
(69, 19, 'card', 'employee_files/1760004684_68e78a4cd4ede.pdf', '2025-10-09 10:11:24', '2025-10-09 10:11:24'),
(70, 74, 'card', 'employee_files/1760004933_68e78b452e573.pdf', '2025-10-09 10:15:33', '2025-10-09 10:15:33'),
(71, 7, 'card', 'employee_files/1760005000_68e78b88e2627.pdf', '2025-10-09 10:16:40', '2025-10-09 10:16:40'),
(72, 4, 'card', 'employee_files/1760005054_68e78bbec8bde.pdf', '2025-10-09 10:17:34', '2025-10-09 10:17:34'),
(73, 23, 'card', 'employee_files/1760005319_68e78cc7f0903.pdf', '2025-10-09 10:21:59', '2025-10-09 10:21:59'),
(74, 5, 'moqem', 'employee_files/1760005355_68e78cebe9830.pdf', '2025-10-09 10:22:35', '2025-10-09 10:22:35'),
(75, 7, 'moqem', 'employee_files/1760005394_68e78d1240aa7.pdf', '2025-10-09 10:23:14', '2025-10-09 10:23:14'),
(76, 17, 'card', 'employee_files/1760005402_68e78d1a23020.pdf', '2025-10-09 10:23:22', '2025-10-09 10:23:22'),
(77, 8, 'card', 'employee_files/1760005498_68e78d7a1b275.pdf', '2025-10-09 10:24:58', '2025-10-09 10:24:58'),
(78, 16, 'card', 'employee_files/1760005686_68e78e36a6081.pdf', '2025-10-09 10:28:06', '2025-10-09 10:28:06'),
(79, 25, 'card', 'employee_files/1760005784_68e78e98e34ce.pdf', '2025-10-09 10:29:44', '2025-10-09 10:29:44'),
(80, 80, 'moqem', 'employee_files/1760165235_68e9fd73861d8.pdf', '2025-10-11 06:47:15', '2025-10-11 06:47:15'),
(81, 80, 'card', 'employee_files/1760165327_68e9fdcfdd9ad.pdf', '2025-10-11 06:48:47', '2025-10-11 06:48:47'),
(82, 77, 'moqem', 'employee_files/1760165690_68e9ff3ab7839.pdf', '2025-10-11 06:54:50', '2025-10-11 06:54:50'),
(83, 7, 'moqem', 'employee_files/1760166051_68ea00a359e29.pdf', '2025-10-11 07:00:51', '2025-10-11 07:00:51'),
(84, 25, 'moqem', 'employee_files/1760166175_68ea011f8f4cd.pdf', '2025-10-11 07:02:55', '2025-10-11 07:02:55'),
(85, 16, 'moqem', 'employee_files/1760166213_68ea0145b20ed.pdf', '2025-10-11 07:03:33', '2025-10-11 07:03:33'),
(86, 5, 'moqem', 'employee_files/1760166409_68ea0209e0a43.pdf', '2025-10-11 07:06:49', '2025-10-11 07:06:49'),
(87, 25, 'moqem', 'employee_files/1760166582_68ea02b64d7db.pdf', '2025-10-11 07:09:42', '2025-10-11 07:09:42'),
(88, 50, 'moqem', 'employee_files/1760167217_68ea05315b9a1.pdf', '2025-10-11 07:20:17', '2025-10-11 07:20:17'),
(89, 2, 'card', 'employee_files/1760167268_68ea056418c5a.pdf', '2025-10-11 07:21:08', '2025-10-11 07:21:08'),
(90, 50, 'card', 'employee_files/1760167299_68ea0583c2a77.pdf', '2025-10-11 07:21:39', '2025-10-11 07:21:39'),
(91, 51, 'card', 'employee_files/1760167370_68ea05caeb087.pdf', '2025-10-11 07:22:50', '2025-10-11 07:22:50'),
(92, 63, 'card', 'employee_files/1760167412_68ea05f471e8a.pdf', '2025-10-11 07:23:32', '2025-10-11 07:23:32'),
(93, 64, 'card', 'employee_files/1760167450_68ea061a6ab8b.pdf', '2025-10-11 07:24:10', '2025-10-11 07:24:10'),
(94, 70, 'card', 'employee_files/1760167481_68ea0639cde11.pdf', '2025-10-11 07:24:41', '2025-10-11 07:24:41'),
(95, 77, 'card', 'employee_files/1760167504_68ea06501f47d.pdf', '2025-10-11 07:25:04', '2025-10-11 07:25:04'),
(96, 75, 'card', 'employee_files/1760167609_68ea06b972369.pdf', '2025-10-11 07:26:49', '2025-10-11 07:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `employee_files`
--

CREATE TABLE `employee_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_files`
--

INSERT INTO `employee_files` (`id`, `file`, `employee_id`, `created_at`, `updated_at`) VALUES
(6, '1751261557_اقبال.jpeg', 5, '2025-06-30 05:32:37', '2025-06-30 05:32:37'),
(7, '1751261661_صورة اقبال.jpeg', 5, '2025-06-30 05:34:21', '2025-06-30 05:34:21'),
(9, '1751263920_مخالصة محمد اقبال.jpeg', 5, '2025-06-30 06:12:00', '2025-06-30 06:12:00'),
(14, '1753023364_محمد رشد.pdf', 23, '2025-07-20 14:56:04', '2025-07-20 14:56:04'),
(15, '1753023793_اسحاق علي قاسم-compressed.pdf', 19, '2025-07-20 15:03:13', '2025-07-20 15:03:13'),
(16, '1753023935_ثامن صديق-compressed.pdf', 44, '2025-07-20 15:05:35', '2025-07-20 15:05:35'),
(17, '1753024502_جعفر عبد المؤمن عمر سليمان-compressed.pdf', 7, '2025-07-20 15:15:02', '2025-07-20 15:15:02'),
(18, '1753024528_رانا ارباز خان عبدالله خان-compressed.pdf', 67, '2025-07-20 15:15:28', '2025-07-20 15:15:28'),
(19, '1753024554_فهد الله مهيأ-compressed.pdf', 12, '2025-07-20 15:15:54', '2025-07-20 15:15:54'),
(20, '1753024586_محمد جنيد تيفيل محمد-compressed.pdf', 8, '2025-07-20 15:16:26', '2025-07-20 15:16:26'),
(21, '1753024627_محمد عربي نبي-compressed.pdf', 24, '2025-07-20 15:17:07', '2025-07-20 15:17:07'),
(22, '1753024656_محمد كاشف عبد الرشيد-compressed.pdf', 25, '2025-07-20 15:17:36', '2025-07-20 15:17:36'),
(23, '1753024682_نبيل شنجنذ حمزة-compressed.pdf', 17, '2025-07-20 15:18:02', '2025-07-20 15:18:02'),
(24, '1753041511_إقرار تسليم مركبة.pdf', 72, '2025-07-20 19:58:31', '2025-07-20 19:58:31'),
(25, '1753537919_رقم اللوحة1253 ا س س.pdf', 9, '2025-07-26 13:51:59', '2025-07-26 13:51:59'),
(26, '1753538202_لوحة 5757.pdf', 17, '2025-07-26 13:56:42', '2025-07-26 13:56:42'),
(27, '1753620773_إقرار تسليم مركبه نبيل شنجنذ 5456.pdf', 17, '2025-07-27 12:52:53', '2025-07-27 12:52:53'),
(28, '1753770732_فاتوره_نبيل_شنجنذ_حمزة_تركيب_قاعده_+حساس-compressed.pdf', 17, '2025-07-29 06:32:12', '2025-07-29 06:32:12'),
(29, '1753787481_WhatsApp Image 2025-07-29 at 14.08.53_3a853201.jpg', 3, '2025-07-29 11:11:21', '2025-07-29 11:11:21'),
(30, '1753787530_WhatsApp Image 2025-07-29 at 14.08.53_81ae1460.jpg', 27, '2025-07-29 11:12:10', '2025-07-29 11:12:10'),
(31, '1753787567_WhatsApp Image 2025-07-29 at 14.08.54_3d4bd658.jpg', 14, '2025-07-29 11:12:47', '2025-07-29 11:12:47'),
(32, '1753787593_WhatsApp Image 2025-07-29 at 14.08.54_784675ed.jpg', 66, '2025-07-29 11:13:13', '2025-07-29 11:13:13'),
(33, '1754415905_WhatsApp Image 2025-07-29 at 14.08.53_3a853201.jpg', 3, '2025-08-05 17:45:05', '2025-08-05 17:45:05'),
(34, '1754415958_WhatsApp Image 2025-07-29 at 14.08.53_81ae1460.jpg', 27, '2025-08-05 17:45:58', '2025-08-05 17:45:58'),
(35, '1754415986_WhatsApp Image 2025-08-05 at 20.42.42_0c1a625d.jpg', 15, '2025-08-05 17:46:26', '2025-08-05 17:46:26'),
(36, '1754415986_WhatsApp Image 2025-08-05 at 20.42.42_fb70b312.jpg', 15, '2025-08-05 17:46:26', '2025-08-05 17:46:26'),
(37, 'employee_files/1757422222_اقامة محمد ط.jpg', 77, '2025-09-09 12:50:22', '2025-09-09 12:50:22'),
(38, 'employee_files/1757622310_محمد ذو.jpeg', 78, '2025-09-11 20:25:10', '2025-09-11 20:25:10'),
(39, 'employee_files/1759926056_68e65728f0ae3_images.jpg', 79, '2025-10-08 12:20:56', '2025-10-08 12:20:56');

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
-- Table structure for table `food_boxes`
--

CREATE TABLE `food_boxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_box_stations`
--

CREATE TABLE `food_box_stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food_type` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_prices`
--

CREATE TABLE `food_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `food_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_prices`
--

INSERT INTO `food_prices` (`id`, `size`, `price`, `food_type_id`, `created_at`, `updated_at`) VALUES
(1, 'صغير', 3.00, 1, '2025-06-12 22:14:36', '2025-06-12 22:14:36'),
(2, 'وسط', NULL, 1, '2025-06-12 22:14:36', '2025-06-12 22:14:36'),
(3, 'كبير', 6.00, 1, '2025-06-12 22:14:36', '2025-06-12 22:14:36'),
(4, 'صغير', 3.00, 2, '2025-06-12 22:17:35', '2025-06-12 22:17:35'),
(5, 'وسط', NULL, 2, '2025-06-12 22:17:35', '2025-06-12 22:17:35'),
(6, 'كبير', 6.00, 2, '2025-06-12 22:17:35', '2025-06-12 22:17:35'),
(7, 'صغير', NULL, 3, '2025-06-12 22:22:19', '2025-06-12 22:22:19'),
(8, 'وسط', NULL, 3, '2025-06-12 22:22:19', '2025-06-12 22:22:19'),
(9, 'كبير', NULL, 3, '2025-06-12 22:22:19', '2025-06-12 22:22:19'),
(10, 'صغير', NULL, 4, '2025-06-12 22:23:12', '2025-06-12 22:23:12'),
(11, 'وسط', NULL, 4, '2025-06-12 22:23:12', '2025-06-12 22:23:12'),
(12, 'كبير', NULL, 4, '2025-06-12 22:23:12', '2025-06-12 22:23:12'),
(13, 'صغير', NULL, 5, '2025-06-12 22:24:00', '2025-06-12 22:24:00'),
(14, 'وسط', NULL, 5, '2025-06-12 22:24:00', '2025-06-12 22:24:00'),
(15, 'كبير', NULL, 5, '2025-06-12 22:24:00', '2025-06-12 22:24:00'),
(16, 'صغير', NULL, 6, '2025-06-12 22:24:24', '2025-06-12 22:24:24'),
(17, 'وسط', NULL, 6, '2025-06-12 22:24:24', '2025-06-12 22:24:24'),
(18, 'كبير', NULL, 6, '2025-06-12 22:24:24', '2025-06-12 22:24:24'),
(19, 'صغير', NULL, 7, '2025-06-12 22:25:07', '2025-06-12 22:25:07'),
(20, 'وسط', NULL, 7, '2025-06-12 22:25:07', '2025-06-12 22:25:07'),
(21, 'كبير', NULL, 7, '2025-06-12 22:25:07', '2025-06-12 22:25:07'),
(22, 'صغير', NULL, 8, '2025-06-12 22:25:32', '2025-06-12 22:25:32'),
(23, 'وسط', NULL, 8, '2025-06-12 22:25:32', '2025-06-12 22:25:32'),
(24, 'كبير', NULL, 8, '2025-06-12 22:25:32', '2025-06-12 22:25:32'),
(25, 'صغير', 10.00, 9, '2025-06-12 22:30:46', '2025-06-12 22:30:46'),
(26, 'وسط', NULL, 9, '2025-06-12 22:30:46', '2025-06-12 22:30:46'),
(27, 'كبير', 15.00, 9, '2025-06-12 22:30:46', '2025-06-12 22:30:46'),
(28, 'صغير', 6.00, 10, '2025-06-12 22:31:31', '2025-06-12 22:31:31'),
(29, 'وسط', NULL, 10, '2025-06-12 22:31:31', '2025-06-12 22:31:31'),
(30, 'كبير', 12.00, 10, '2025-06-12 22:31:31', '2025-06-12 22:31:31'),
(31, 'صغير', 5.00, 11, '2025-06-12 22:32:08', '2025-06-12 22:32:08'),
(32, 'وسط', NULL, 11, '2025-06-12 22:32:08', '2025-06-12 22:32:08'),
(33, 'كبير', 8.00, 11, '2025-06-12 22:32:08', '2025-06-12 22:32:08'),
(34, 'صغير', 5.00, 12, '2025-06-12 22:32:41', '2025-06-12 22:32:41'),
(35, 'وسط', NULL, 12, '2025-06-12 22:32:41', '2025-06-12 22:32:41'),
(36, 'كبير', 10.00, 12, '2025-06-12 22:32:41', '2025-06-12 22:32:41'),
(37, 'صغير', 10.00, 13, '2025-06-12 22:33:17', '2025-06-12 22:33:17'),
(38, 'وسط', NULL, 13, '2025-06-12 22:33:17', '2025-06-12 22:33:17'),
(39, 'كبير', 20.00, 13, '2025-06-12 22:33:17', '2025-06-12 22:33:17'),
(40, 'صغير', 8.00, 14, '2025-06-12 22:34:42', '2025-06-12 22:34:42'),
(41, 'وسط', NULL, 14, '2025-06-12 22:34:42', '2025-06-12 22:34:42'),
(42, 'كبير', 15.00, 14, '2025-06-12 22:34:42', '2025-06-12 22:34:42'),
(43, 'صغير', NULL, 15, '2025-06-12 22:35:08', '2025-06-12 22:35:08'),
(44, 'وسط', NULL, 15, '2025-06-12 22:35:08', '2025-06-12 22:35:08'),
(45, 'كبير', 15.00, 15, '2025-06-12 22:35:08', '2025-06-12 22:35:08'),
(46, 'صغير', 8.00, 16, '2025-06-12 22:35:40', '2025-06-12 22:35:40'),
(47, 'وسط', NULL, 16, '2025-06-12 22:35:40', '2025-06-12 22:35:40'),
(48, 'كبير', 15.00, 16, '2025-06-12 22:35:40', '2025-06-12 22:35:40'),
(49, 'صغير', 7.00, 17, '2025-06-12 22:36:20', '2025-06-12 22:36:20'),
(50, 'وسط', NULL, 17, '2025-06-12 22:36:20', '2025-06-12 22:36:20'),
(51, 'كبير', 14.00, 17, '2025-06-12 22:36:20', '2025-06-12 22:36:20'),
(52, 'صغير', 5.00, 18, '2025-06-12 22:37:10', '2025-06-12 22:37:10'),
(53, 'وسط', NULL, 18, '2025-06-12 22:37:10', '2025-06-12 22:37:10'),
(54, 'كبير', 10.00, 18, '2025-06-12 22:37:10', '2025-06-12 22:37:10'),
(55, 'صغير', 6.00, 19, '2025-06-12 22:37:43', '2025-06-12 22:37:43'),
(56, 'وسط', NULL, 19, '2025-06-12 22:37:43', '2025-06-12 22:37:43'),
(57, 'كبير', 12.00, 19, '2025-06-12 22:37:43', '2025-06-12 22:37:43'),
(58, 'صغير', 5.00, 20, '2025-06-12 22:43:16', '2025-06-12 22:43:16'),
(59, 'وسط', 6.00, 20, '2025-06-12 22:43:16', '2025-06-13 18:28:21'),
(60, 'كبير', 8.00, 20, '2025-06-12 22:43:16', '2025-06-12 22:43:16'),
(61, 'صغير', 10.00, 21, '2025-06-12 22:43:54', '2025-06-12 22:43:54'),
(62, 'وسط', 12.00, 21, '2025-06-12 22:43:54', '2025-06-13 18:26:55'),
(63, 'كبير', 15.00, 21, '2025-06-12 22:43:54', '2025-06-12 22:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'افطار', 'حمص', '2025-06-12 22:14:36', '2025-06-12 22:14:36'),
(2, 'غداء', 'عدس', '2025-06-12 22:17:35', '2025-06-12 22:17:35'),
(3, 'افطار', 'مشكل', '2025-06-12 22:22:19', '2025-06-12 22:22:19'),
(4, 'افطار', 'خبز بطاطس', '2025-06-12 22:23:12', '2025-06-12 22:23:12'),
(5, 'افطار', 'فطيرة بطاطس', '2025-06-12 22:24:00', '2025-06-12 22:24:00'),
(6, 'افطار', 'شاهي', '2025-06-12 22:24:24', '2025-06-12 22:24:24'),
(7, 'افطار', 'ماء', '2025-06-12 22:25:07', '2025-06-12 22:25:07'),
(8, 'افطار', 'كوارع', '2025-06-12 22:25:32', '2025-06-12 22:25:32'),
(9, 'غداء', 'لحم غنم', '2025-06-12 22:30:46', '2025-06-12 22:30:46'),
(10, 'غداء', 'مرق دجاج', '2025-06-12 22:31:31', '2025-06-12 22:31:31'),
(11, 'غداء', 'عدس', '2025-06-12 22:32:08', '2025-06-12 22:32:08'),
(12, 'غداء', 'باميه', '2025-06-12 22:32:41', '2025-06-12 22:32:41'),
(13, 'غداء', 'رز برياني دجاج', '2025-06-12 22:33:17', '2025-06-12 22:33:17'),
(14, 'غداء', 'رز برياني لحم', '2025-06-12 22:34:42', '2025-06-12 22:34:42'),
(15, 'غداء', 'دجاج مقلي', '2025-06-12 22:35:08', '2025-06-12 22:35:08'),
(16, 'غداء', 'كباب', '2025-06-12 22:35:40', '2025-06-12 22:35:40'),
(17, 'غداء', 'مفروم لحم', '2025-06-12 22:36:20', '2025-06-12 22:36:20'),
(18, 'غداء', 'كاري', '2025-06-12 22:37:10', '2025-06-12 22:37:10'),
(19, 'غداء', 'كبده دجاج', '2025-06-12 22:37:43', '2025-06-12 22:37:43'),
(20, 'عشاء', 'عدس', '2025-06-12 22:43:16', '2025-06-12 22:43:16'),
(21, 'عشاء', 'لحم غنم', '2025-06-12 22:43:54', '2025-06-12 22:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `gehas`
--

CREATE TABLE `gehas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gehas`
--

INSERT INTO `gehas` (`id`, `name`, `number`, `user_name`, `created_at`, `updated_at`) VALUES
(1, 'حساب تجديد الاقامات', '0', 'ابو احمد', '2025-04-19 13:50:33', '2025-04-19 13:50:33'),
(2, 'المخالفات المرورية', NULL, 'ابو احمد', '2025-04-19 14:31:52', '2025-06-05 17:13:14'),
(3, 'مخالفات الهيئة العامة للنقل', '02', 'ابو احمد', '2025-04-19 14:49:15', '2025-04-19 14:49:15'),
(4, 'مخالفات المواقف', '03', 'ابو احمد', '2025-04-19 15:07:12', '2025-04-19 15:07:12'),
(5, 'ضريبة القيمه المضافه', NULL, 'ابو احمد', '2025-04-19 15:33:11', '2025-06-05 19:18:57'),
(6, 'بنك الرياض ( تجميع نقاط البيع )', NULL, 'ابو احمد', '2025-04-19 15:33:51', '2025-06-05 17:12:14'),
(7, 'مؤسسة روبا طيبة', NULL, 'ابو احمد', '2025-04-19 15:34:24', '2025-04-19 15:34:24'),
(8, 'شركة الجواب للنقل البري', NULL, 'ابو احمد', '2025-04-19 15:35:10', '2025-04-19 15:35:10'),
(9, 'محكمة التنفيذ', NULL, 'ابو احمد', '2025-04-20 17:24:19', '2025-04-20 17:24:19'),
(10, 'مطالبات الحوادث المرورية', NULL, 'ابو احمد', '2025-04-20 18:53:52', '2025-04-20 18:53:52'),
(11, 'سند لأمر قيد الانتظار', NULL, 'ابو احمد', '2025-04-28 08:38:36', '2025-04-28 08:38:36'),
(12, 'اصدار تصريح دخول مكه', NULL, 'ابو يحي ', '2025-05-18 15:42:33', '2025-05-18 15:42:33'),
(13, 'المطالبات الحوادث المروريه', NULL, 'ابو يحي ', '2025-05-26 08:02:38', '2025-05-26 08:02:38'),
(14, 'حساب وسيط من الحوادث المرورية الى المستفيد', NULL, 'ابو يحي ', '2025-05-26 08:03:49', '2025-05-26 08:03:49'),
(15, 'تجميع مطالبات الحوادث ( ابوطلال)', NULL, 'ابو احمد', '2025-06-08 12:14:41', '2025-06-08 12:14:41'),
(16, 'عمليات بنك الرياض غير معروفة', NULL, 'اسلام ناصف  ', '2025-07-17 19:38:38', '2025-07-17 19:38:38'),
(17, 'الهيئة العامة للنقل', NULL, 'اسلام ناصف  ', '2025-07-28 16:16:14', '2025-07-28 16:16:14'),
(18, 'بوابة تم', NULL, 'اسلام ناصف  ', '2025-07-28 16:16:53', '2025-07-28 16:16:53');

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
-- Table structure for table `mandubs`
--

CREATE TABLE `mandubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `spent` decimal(10,2) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `percentage` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `archive` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 2, '2025-06-04 13:28:40', '2025-06-04 13:28:40'),
(2, 'السلام عليكم', 2, '2025-06-06 18:39:16', '2025-06-06 18:39:16'),
(3, 'تم استلام مبلغ 1300 ريال \r\nتاريخ 08/6/2025', 21, '2025-06-08 15:07:05', '2025-06-08 15:07:05'),
(4, 'تم استلام 1400 ريال', 15, '2025-06-08 17:24:58', '2025-06-08 17:24:58'),
(5, 'تم استلام 1100', 44, '2025-06-08 17:42:06', '2025-06-08 17:42:06'),
(6, 'تم الاستلام 1000 ريال', 25, '2025-06-08 17:49:29', '2025-06-08 17:49:29'),
(7, 'تم استلام 460 ريال', 24, '2025-06-09 07:29:01', '2025-06-09 07:29:01'),
(8, 'تم استلام 500 ريال', 29, '2025-06-09 18:58:49', '2025-06-09 18:58:49'),
(9, 'تم استلام 60', 17, '2025-06-10 17:28:24', '2025-06-10 17:28:24'),
(10, 'تم استلام 1500 ريال', 3, '2025-06-11 17:07:28', '2025-06-11 17:07:28'),
(11, 'تم استلام 500 ريال', 25, '2025-06-12 18:20:35', '2025-06-12 18:20:35'),
(12, 'تم استلام 1190 ريال', 23, '2025-06-14 16:28:52', '2025-06-14 16:28:52'),
(13, 'تم استلام 1190 ريال', 23, '2025-06-14 16:30:12', '2025-06-14 16:30:12'),
(14, 'تم استلام 500 ريال', 24, '2025-06-14 17:34:59', '2025-06-14 17:34:59'),
(15, 'تم استلام 825 ريال', 19, '2025-06-14 17:43:33', '2025-06-14 17:43:33'),
(16, 'تم استلام 200 ريال', 20, '2025-06-14 18:05:12', '2025-06-14 18:05:12'),
(17, 'تم استلام 1400 ريال', 21, '2025-06-14 18:30:44', '2025-06-14 18:30:44'),
(18, 'تم استلام 1400 ريال', 15, '2025-06-14 19:32:52', '2025-06-14 19:32:52'),
(19, 'تم استلام 800 ريال', 44, '2025-06-17 19:03:43', '2025-06-17 19:03:43'),
(20, 'تم استلام 120 ريال', 17, '2025-06-18 18:20:58', '2025-06-18 18:20:58'),
(21, 'مرحبا', 62, '2025-06-19 08:19:23', '2025-06-19 08:19:23'),
(22, 'تم استلام 200 ريال', 20, '2025-06-19 17:43:58', '2025-06-19 17:43:58'),
(23, 'تم استلام 800 ريال', 25, '2025-06-21 16:43:17', '2025-06-21 16:43:17'),
(24, 'تم استلام 1010 ريال', 7, '2025-06-21 16:53:13', '2025-06-21 16:53:13'),
(25, 'تم استلام 1400 ريال', 15, '2025-06-21 17:58:43', '2025-06-21 17:58:43'),
(26, 'تم استلام 600 ريال', 19, '2025-06-21 18:14:20', '2025-06-21 18:14:20'),
(27, 'تم استلام 500 ريال', 24, '2025-06-21 18:18:58', '2025-06-21 18:18:58'),
(28, 'تم استلام 200 ريال', 20, '2025-06-21 18:33:58', '2025-06-21 18:33:58'),
(29, 'تم استلام مبلغ 120', 17, '2025-06-22 18:40:25', '2025-06-22 18:40:25'),
(30, 'تم استلام 800 ريال', 44, '2025-06-22 18:48:00', '2025-06-22 18:48:00'),
(31, 'تم استلام 70 ريال', 20, '2025-06-22 19:01:18', '2025-06-22 19:01:18'),
(32, 'تم استلام 1400 ريال', 21, '2025-06-23 08:21:41', '2025-06-23 08:21:41'),
(33, 'تم تسليم 500 ريال', 25, '2025-06-23 17:32:38', '2025-06-23 17:32:38'),
(34, 'تم تسليم 200 ريال', 23, '2025-06-23 17:34:53', '2025-06-23 17:34:53'),
(35, 'تم استلام 120 ريال', 20, '2025-06-23 19:04:22', '2025-06-23 19:04:22'),
(36, 'تم استلام 2000 ريال', 19, '2025-06-24 18:15:43', '2025-06-24 18:15:43'),
(37, 'تم استلام 70 ريال', 20, '2025-06-25 06:37:36', '2025-06-25 06:37:36'),
(38, 'تم استلام 150 بتاريخ 21/6', 17, '2025-06-25 07:42:48', '2025-06-25 07:42:48'),
(39, 'تم استلام 200', 25, '2025-06-26 18:15:37', '2025-06-26 18:15:37'),
(40, 'تم استلام 250', 24, '2025-06-26 18:16:05', '2025-06-26 18:16:05'),
(41, 'تم استلام 250', 24, '2025-06-27 17:11:27', '2025-06-27 17:11:27'),
(42, 'تم استلام 1400', 21, '2025-06-28 17:18:18', '2025-06-28 17:18:18'),
(43, 'تم استلام 250', 24, '2025-06-28 17:18:55', '2025-06-28 17:18:55'),
(44, 'تم استلام 800', 19, '2025-06-28 18:11:13', '2025-06-28 18:11:13'),
(45, 'تم استلام 905', 19, '2025-06-28 18:11:56', '2025-06-28 18:11:56'),
(46, 'تم استلام 900', 44, '2025-06-28 18:58:07', '2025-06-28 18:58:07'),
(47, 'تم استلام 400 ريال', 25, '2025-06-29 16:28:22', '2025-06-29 16:28:22'),
(48, 'تم استلام 250', 24, '2025-06-29 19:32:25', '2025-06-29 19:32:25'),
(49, 'تم استلام 1400 ريال بتاريخ 28/6/2025', 15, '2025-06-30 05:20:19', '2025-06-30 05:20:19'),
(50, 'تم استلام 200 ريال بتاريخ 28/6/2025', 17, '2025-06-30 18:57:30', '2025-06-30 18:57:30'),
(51, 'تم استلام 300 ريال', 24, '2025-06-30 19:00:17', '2025-06-30 19:00:17'),
(52, 'تم استلام 80ريال', 17, '2025-06-30 19:04:45', '2025-06-30 19:04:45'),
(53, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-07-05.\nرقم السند: 714', 44, '2025-07-05 18:17:26', '2025-07-05 18:17:26'),
(54, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-07-05.\nرقم السند: 715', 7, '2025-07-05 18:28:56', '2025-07-05 18:28:56'),
(55, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 920.00 بتاريخ 2025-07-05.\nرقم السند: 716', 19, '2025-07-05 18:32:40', '2025-07-05 18:32:40'),
(56, 'عزيزي المستفيد حمزة،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-07-05.\nرقم السند: 717', 28, '2025-07-05 19:00:18', '2025-07-05 19:00:18'),
(57, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-07-05.\nرقم السند: 718', 27, '2025-07-05 19:03:28', '2025-07-05 19:03:28'),
(58, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-07-06.\nرقم السند: 771', 23, '2025-07-06 09:10:29', '2025-07-06 09:10:29'),
(59, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 200.00 بتاريخ 2025-07-06.\nرقم السند: 774', 25, '2025-07-06 09:13:24', '2025-07-06 09:13:24'),
(60, 'عزيزي المستفيد ارساد،\nتم استلام مبلغ 1,400.00 بتاريخ 2025-07-06.\nرقم السند: 823', 21, '2025-07-06 14:52:32', '2025-07-06 14:52:32'),
(61, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 400.00 بتاريخ 2025-07-06.\nرقم السند: 824', 24, '2025-07-06 17:02:03', '2025-07-06 17:02:03'),
(62, 'عزيزي المستفيد علي،\nتم استلام مبلغ 1,400.00 بتاريخ 2025-07-06.\nرقم السند: 825', 15, '2025-07-06 18:35:06', '2025-07-06 18:35:06'),
(63, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 450.00 بتاريخ 2025-07-06.\nرقم السند: 826', 17, '2025-07-06 20:34:21', '2025-07-06 20:34:21'),
(64, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 300.00 بتاريخ 2025-07-08.\nرقم السند: 1019', 24, '2025-07-08 16:18:11', '2025-07-08 16:18:11'),
(65, 'Please attend the office — it\'s important', 17, '2025-07-09 13:26:02', '2025-07-09 13:26:02'),
(66, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-09.\nرقم السند: 1020', 24, '2025-07-09 16:45:54', '2025-07-09 16:45:54'),
(67, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 200.00 بتاريخ 2025-07-09.\nرقم السند: 1021', 25, '2025-07-09 16:46:34', '2025-07-09 16:46:34'),
(68, 'براہ کرم ابھی کمپنی میں تشریف لائیں، یہ بہت ضروری ہے۔\r\nPlease come to the company now, it is important.', 17, '2025-07-10 08:42:41', '2025-07-10 08:42:41'),
(69, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 200.00 بتاريخ 2025-07-10.\nرقم السند: 1022', 25, '2025-07-10 17:40:16', '2025-07-10 17:40:16'),
(70, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 375.00 بتاريخ 2025-07-11.\nرقم السند: 1023', 24, '2025-07-11 17:24:33', '2025-07-11 17:24:33'),
(71, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 360.00 بتاريخ 2025-07-11.\nرقم السند: 1024', 17, '2025-07-11 17:29:57', '2025-07-11 17:29:57'),
(72, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 140.00 بتاريخ 2025-07-11.\nرقم السند: 1025', 25, '2025-07-11 18:12:58', '2025-07-11 18:12:58'),
(73, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 200.00 بتاريخ 2025-07-12.\nرقم السند: 1038', 25, '2025-07-12 15:27:50', '2025-07-12 15:27:50'),
(74, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,190.00 بتاريخ 2025-07-12.\nرقم السند: 1039', 23, '2025-07-12 17:33:34', '2025-07-12 17:33:34'),
(75, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 950.00 بتاريخ 2025-07-12.\nرقم السند: 1040', 19, '2025-07-12 18:26:13', '2025-07-12 18:26:13'),
(76, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 130.00 بتاريخ 2025-07-12.\nرقم السند: 1041', 17, '2025-07-12 18:32:42', '2025-07-12 18:32:42'),
(77, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-12.\nرقم السند: 1042', 24, '2025-07-12 18:39:09', '2025-07-12 18:39:09'),
(78, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 910.00 بتاريخ 2025-07-12.\nرقم السند: 1043', 7, '2025-07-12 20:23:26', '2025-07-12 20:23:26'),
(79, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 170.00 بتاريخ 2025-07-13.\nرقم السند: 1044', 24, '2025-07-14 17:47:28', '2025-07-14 17:47:28'),
(80, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 90.00 بتاريخ 2025-07-13.\nرقم السند: 1045', 17, '2025-07-14 17:48:04', '2025-07-14 17:48:04'),
(81, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-14.\nرقم السند: 1046', 24, '2025-07-14 19:22:37', '2025-07-14 19:22:37'),
(82, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 120.00 بتاريخ 2025-07-14.\nرقم السند: 1048', 17, '2025-07-14 20:11:18', '2025-07-14 20:11:18'),
(83, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 700.00 بتاريخ 2025-07-15.\nرقم السند: 1072', 44, '2025-07-15 17:16:56', '2025-07-15 17:16:56'),
(84, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 90.00 بتاريخ 2025-07-15.\nرقم السند: 1073', 24, '2025-07-15 17:32:25', '2025-07-15 17:32:25'),
(85, 'تم استلام 1000', 12, '2025-07-15 19:01:41', '2025-07-15 19:01:41'),
(86, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-16.\nرقم السند: 1075', 24, '2025-07-16 17:43:24', '2025-07-16 17:43:24'),
(87, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 200.00 بتاريخ 2025-07-17.\nرقم السند: 1091', 71, '2025-07-17 19:02:16', '2025-07-17 19:02:16'),
(88, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,190.00 بتاريخ 2025-07-19.\nرقم السند: 1113\nرصيدك المتبقي: -8,953.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل عبر واتساب على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 23, '2025-07-19 15:07:18', '2025-07-19 15:07:18'),
(89, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 870.00 بتاريخ 2025-07-19.\nرقم السند: 1130\nرصيدك الحالي : -1,895.15\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 7, '2025-07-19 17:50:45', '2025-07-19 17:50:45'),
(90, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 230.00 بتاريخ 2025-07-19.\nرقم السند: 1131\nرصيدك الحالي : -7,762.19\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 24, '2025-07-19 17:55:40', '2025-07-19 17:55:40'),
(91, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 700.00 بتاريخ 2025-07-19.\nرقم السند: 1132\nرصيدك الحالي : -4,616.22\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 19, '2025-07-19 18:09:40', '2025-07-19 18:09:40'),
(92, 'عزيزي المستفيد نبيل،\nتم استلام مبلغ 600.00 بتاريخ 2025-07-19.\nرقم السند: 1133\nرصيدك الحالي : -30,157.95\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 17, '2025-07-19 20:17:17', '2025-07-19 20:17:17'),
(93, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-20.\nرقم السند: 1150\nرصيدك الحالي : -7,612.19\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 24, '2025-07-20 17:37:04', '2025-07-20 17:37:04'),
(94, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 800.00 بتاريخ 2025-07-20.\nرقم السند: 1158\nرصيدك الحالي : -12,219.97\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 44, '2025-07-20 18:44:11', '2025-07-20 18:44:11'),
(95, 'عزيزي المستفيد حسن،\nتم استلام مبلغ 40,000.00 بتاريخ 2025-07-20.\nرقم السند: 1162\nرصيدك الحالي : -60,000.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 72, '2025-07-20 19:51:07', '2025-07-20 19:51:07'),
(96, 'عزيزي المستفيد أصف،\nتم استلام مبلغ 3,000.00 بتاريخ 2025-07-23.\nرقم السند: 1171', 73, '2025-07-23 18:25:19', '2025-07-23 18:25:19'),
(97, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 150.00 بتاريخ 2025-07-21.\nرقم السند: 1172\nرصيدك الحالي : -7,462.19\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 24, '2025-07-23 20:01:11', '2025-07-23 20:01:11'),
(98, 'عزيزي المستفيد حسن،\nتم استلام مبلغ 10,000.00 بتاريخ 2025-07-22.\nرقم السند: 1173\nرصيدك الحالي : -50,000.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 72, '2025-07-23 20:03:23', '2025-07-23 20:03:23'),
(99, 'عزيزي السائق \r\nيرجى المسارعة بسداد المديونية المترتبة عليكم بمبلغ وقدره  28,012.19 ريال خلال 10 ايام من تاريخه وفي حال تجاوز المده المحدده سيتم اتخاذ الاجراءات النظامية', 24, '2025-07-24 11:00:56', '2025-07-24 11:00:56'),
(100, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,190.00 بتاريخ 2025-08-02.\nرقم السند: 1454\nرصيدك الحالي : -7,763.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 23, '2025-08-02 15:46:52', '2025-08-02 15:46:52'),
(101, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 2,500.00 بتاريخ 2025-08-02.\nرقم السند: 1455\nرصيدك الحالي : -5,263.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 23, '2025-08-02 15:48:12', '2025-08-02 15:48:12'),
(102, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 1,100.00 بتاريخ 2025-08-02.\nرقم السند: 1469\nرصيدك الحالي : -11,119.97\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 44, '2025-08-02 16:41:36', '2025-08-02 16:41:36'),
(103, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 410.00 بتاريخ 2025-08-02.\nرقم السند: 1478\nرصيدك الحالي : -3,943.10\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 19, '2025-08-02 16:59:46', '2025-08-02 16:59:46'),
(104, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 1,060.00 بتاريخ 2025-08-02.\nرقم السند: 1485\nرصيدك الحالي : -763.02\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 7, '2025-08-02 17:06:11', '2025-08-02 17:06:11'),
(105, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 750.00 بتاريخ 2025-07-26.\nرقم السند: 1488\nرصيدك الحالي : -13.02\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 7, '2025-08-02 17:08:53', '2025-08-02 17:08:53'),
(106, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 600.00 بتاريخ 2025-07-26.\nرقم السند: 1489\nرصيدك الحالي : -3,343.10\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 19, '2025-08-02 17:12:10', '2025-08-02 17:12:10'),
(107, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 1,025.00 بتاريخ 2025-08-09.\nرقم السند: 1605\nرصيدك الحالي : -1,943.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 19, '2025-08-09 19:16:56', '2025-08-09 19:16:56'),
(108, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,190.00 بتاريخ 2025-08-09.\nرقم السند: 1606\nرصيدك الحالي : -6,773.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 23, '2025-08-09 20:48:41', '2025-08-09 20:48:41'),
(109, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 600.00 بتاريخ 2025-08-09.\nرقم السند: 1607\nرصيدك الحالي : -8,505.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 25, '2025-08-09 20:50:07', '2025-08-09 20:50:07'),
(110, 'عزيزي المستفيد ارساد،\nتم استلام مبلغ 1,400.00 بتاريخ 2025-08-10.\nرقم السند: 1608\nرصيدك الحالي : -11,580.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 21, '2025-08-10 20:08:15', '2025-08-10 20:08:15'),
(111, 'عزيزي المستفيد علي،\nتم استلام مبلغ 100.00 بتاريخ 2025-08-13.\nرقم السند: 1609\nرصيدك الحالي : -12,600.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 15, '2025-08-13 15:36:56', '2025-08-13 15:36:56'),
(112, 'عزيزي المستفيد محمد،\nتم استلام مبلغ 1,190.00 بتاريخ 2025-08-15.\nرقم السند: 1610\nرصيدك الحالي : -5,583.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 23, '2025-08-15 19:57:42', '2025-08-15 19:57:42'),
(113, 'عزيزي المستفيد جعفر،\nتم استلام مبلغ 1,120.00 بتاريخ 2025-08-16.\nرقم السند: 1611\nرصيدك الحالي : -2,923.02\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 7, '2025-08-16 17:42:10', '2025-08-16 17:42:10'),
(114, 'عزيزي المستفيد اسحاق،\nتم استلام مبلغ 985.00 بتاريخ 2025-08-16.\nرقم السند: 1612\nرصيدك الحالي : -958.56\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 19, '2025-08-16 19:04:51', '2025-08-16 19:04:51'),
(115, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-08-16.\nرقم السند: 1613\nرصيدك الحالي : -10,107.31\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 44, '2025-08-16 19:50:27', '2025-08-16 19:50:27'),
(116, 'عزيزي المستفيد ثامن،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-08-16.\nرقم السند: 1614\nرصيدك الحالي : -9,107.31\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 44, '2025-08-16 19:50:27', '2025-08-16 19:50:27'),
(117, 'عزيزي المستفيد علي،\nتم استلام مبلغ 1,000.00 بتاريخ 2025-08-16.\nرقم السند: 1615\nرصيدك الحالي : -11,600.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 15, '2025-08-16 20:00:09', '2025-08-16 20:00:09'),
(118, 'عزيزي المستفيد علي،\nتم استلام مبلغ 6,400.00 بتاريخ 2025-08-16.\nرقم السند: 1616\nرصيدك الحالي : -5,200.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 15, '2025-08-16 20:01:25', '2025-08-16 20:01:25'),
(119, 'عزيزي المستفيد ارساد،\nتم استلام مبلغ 1,400.00 بتاريخ 2025-08-17.\nرقم السند: 1617\nرصيدك الحالي : -10,180.00\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.', 21, '2025-08-17 17:53:12', '2025-08-17 17:53:12'),
(120, '.', 64, '2025-10-05 09:04:49', '2025-10-05 09:04:49'),
(121, 'انذار نهائي بالفصل..\r\nالموضوع: إنذار غياب\r\n الموظف/ محمد كاشف عبدالرشيد  المحترم ، السلام عليكم ورحمة الله وبركاته وبعد\r\n بعد الاطلاع على تقرير إدارة المتابعة تبين انقطاعكم عن الحضور لمقر العمل لمدة تجاوزت ال 30 يوم متصلة. وعليه تم توجيه هذا الإنذار الكتابي، و في حال عدم التجاوب والالتزام بالحضور سيتم اتخاذ الإجراءات النظامية\r\n\r\n شركة الجواب للنقل البري 0551796056', 4, '2025-10-05 09:13:43', '2025-10-05 09:13:43'),
(122, 'انذار نهائي بالفصل..\r\nالموضوع: إنذار غياب\r\n الموظف/ نائف محمد علي مسمار   المحترم ، السلام عليكم ورحمة الله وبركاته وبعد\r\n بعد الاطلاع على تقرير إدارة المتابعة تبين انقطاعكم عن الحضور لمقر العمل لمدة تجاوزت ال 30 يوم متصلة. وعليه تم توجيه هذا الإنذار الكتابي، و في حال عدم التجاوب والالتزام بالحضور سيتم اتخاذ الإجراءات النظامية\r\n\r\n شركة الجواب للنقل البري 0551796056', 11, '2025-10-05 09:18:54', '2025-10-05 09:18:54'),
(123, 'انذار نهائي بالفصل.. الموضوع: إنذار غياب الموظف/ محمد كاشف عبدالرشيد ، السلام عليكم ورحمة الله وبركاته وبعد بعد الاطلاع على تقرير إدارة المتابعة تبين انقطاعكم عن الحضور لمقر العمل لمدة تجاوزت ال 30 يوم متصلة. وعليه تم توجيه هذا الإنذار الكتابي، و في حال عدم التجاوب والالتزام بالحضور سيتم اتخاذ الإجراءات النظامية شركة الجواب للنقل البري 0551796056', 4, '2025-10-09 10:36:26', '2025-10-09 10:36:26');

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
(4, '2024_03_25_111225_create_personal_access_tokens_table', 1),
(5, '2024_03_25_194408_create_providers_table', 1),
(6, '2024_04_10_012246_create_user_otps_table', 1),
(7, '2024_05_06_124055_create_categories_table', 1),
(8, '2024_05_06_124111_create_sub_categories_table', 1),
(9, '2024_06_12_121157_create_vendors_table', 1),
(10, '2024_06_13_124649_create_products_table', 1),
(11, '2025_02_21_142543_create_docs_types_table', 1),
(12, '2025_02_21_201840_create_documents_table', 1),
(13, '2025_02_21_202056_create_docs_files_table', 1),
(14, '2025_02_24_150243_create_cars_table', 2),
(15, '2025_02_24_223630_create_employees_table', 2),
(16, '2025_02_24_223824_create_employee_files_table', 2),
(17, '2025_02_26_194434_create_car_drivers_table', 2),
(18, '2025_03_01_212229_create_car_maintenances_table', 2),
(19, '2025_03_04_002730_create_app_users_table', 3),
(20, '2025_03_04_003926_create_vehicles_table', 3),
(21, '2025_03_04_003939_create_companies_table', 3),
(22, '2025_03_09_112718_create_passengers_table', 4),
(23, '2025_03_09_112836_create_passenger_lists_table', 4),
(24, '2025_03_11_115615_create_package_types_table', 5),
(27, '2025_03_15_203618_create_purchases_table', 6),
(28, '2025_03_16_210945_create_wallets_table', 6),
(29, '2025_03_20_114035_create_subscriptions_table', 7),
(30, '2025_03_25_115523_add_otp_columns_to_users_table', 8),
(31, '2025_04_02_184404_add_text_columns_to_docs_files_table', 9),
(32, '2025_04_02_190947_modify_file_column_nullable_in_docs_files', 9),
(33, '2025_04_02_202823_create_docs_updates_table', 9),
(34, '2025_04_03_164348_add_user_name_columns_to_docs_updates_table', 10),
(35, '2025_04_03_164745_add_user_name_columns_to_documents_table', 10),
(36, '2025_04_03_164840_add_user_name_columns_to_docs_types_table', 10),
(37, '2025_04_03_201927_add_user_name_columns_to_docs_files_table', 10),
(38, '2025_04_05_172018_add_user_name_columns_to_cars_table', 11),
(39, '2025_04_05_172334_add_user_name_columns_to_employees_table', 11),
(40, '2025_04_07_202209_create_alahdas_table', 11),
(41, '2025_04_07_202257_create_alahda_counts_table', 11),
(42, '2025_04_08_155900_add_user_name_columns_to_alahdas_table', 11),
(43, '2025_04_10_163624_create_snds_table', 12),
(44, '2025_04_13_200040_create_gehas_table', 13),
(45, '2025_04_14_183248_add_geha_id_columns_to_snds_table', 13),
(46, '2025_04_19_144951_add_bank_columns_to_snds_table', 14),
(47, '2025_05_01_145249_add_company_columns_to_employees_table', 15),
(48, '2025_05_30_170751_modify_company_registration_number_in_companies_table', 16),
(49, '2025_05_31_063503_add_column_to_passenger_lists_table', 17),
(50, '2025_05_31_173118_create_wallet_details_table', 18),
(51, '2025_06_01_143928_create_package_sub_details_table', 18),
(52, '2025_06_02_141803_create_mandubs_table', 19),
(53, '2025_06_03_142409_add_column_to_snds_table', 20),
(54, '2025_06_03_164726_add_column_to_employees_table', 20),
(55, '2025_06_03_175033_create_messages_table', 20),
(56, '2025_06_09_150830_add_column_to_app_users_table', 21),
(57, '2025_06_09_155156_add_column_to_mandubs_table', 21),
(58, '2025_06_12_074616_create_travel_table', 22),
(59, '2025_06_12_152553_create_food_types_table', 23),
(60, '2025_06_12_152622_create_food_prices_table', 23),
(61, '2025_06_12_154142_create_food_boxes_table', 23),
(62, '2025_06_12_174259_create_food_box_stations_table', 23),
(63, '2025_06_14_150209_create_between_cities_table', 24),
(64, '2025_06_14_160309_add_column_to_travel_table', 25),
(65, '2025_06_14_180033_create_station_wallets_table', 25),
(66, '2025_06_21_072104_add_column_to_travel_table', 25),
(67, '2025_06_21_082732_add_column_to_employees_table', 25),
(68, '2025_06_22_171441_add_column_to_between_cities_table', 26),
(69, '2025_06_24_063857_add_column_to_between_cities_table', 27),
(70, '2025_06_24_082907_add_column_to_travel_table', 28),
(71, '2025_06_24_143908_add_column_to_cars_table', 29),
(72, '2025_06_25_074235_add_column_to_travel_table', 30),
(73, '2025_07_01_054358_add_column_to_travel_table', 31),
(74, '2025_07_20_142908_create_employee_documents_table', 32),
(75, '2025_07_20_143139_create_car_documents_table', 32),
(76, '2025_07_22_172129_create_supports_table', 32),
(77, '2025_07_22_172408_create_support_notes_table', 32),
(78, '2025_08_04_164225_add_column_to_cars_table', 33),
(79, '2025_08_28_163512_create_contacts_table', 34),
(80, '2025_09_01_145930_add_column_to_between_cities_table', 35),
(81, '2025_09_01_162557_add_column_to_travel_table', 35),
(83, '2025_10_03_195442_add_status_to_users_table', 36),
(84, '2025_10_11_113852_add_payment_columns_to_station_wallets_table', 37),
(85, '2025_10_11_131959_remove_unused_columns_from_station_wallets', 37),
(87, '2025_10_14_110010_add_travel_id_transaction_date_to_wallet_details', 38),
(88, '2025_10_15_102236_appusers_convert_user_type_to_string_values', 39);

-- --------------------------------------------------------

--
-- Table structure for table `package_sub_details`
--

CREATE TABLE `package_sub_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_sub_details`
--

INSERT INTO `package_sub_details` (`id`, `count`, `amount`, `package_id`, `created_at`, `updated_at`) VALUES
(5, 13, 897.00, 1, '2025-06-25 22:58:26', '2025-10-14 09:15:39'),
(6, 4, 2000.00, 2, '2025-10-08 16:19:21', '2025-10-14 06:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `package_types`
--

CREATE TABLE `package_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_types`
--

INSERT INTO `package_types` (`id`, `name`, `type`, `days`, `cost`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'كشف ركاب', 'شهري', 28, 69.00, 1, '2025-06-25 22:55:24', '2025-06-25 22:55:24'),
(2, 'بين المدن', 'شهري', 365, 500.00, 1, '2025-06-25 22:55:24', '2025-06-25 22:55:24');

--
-- Triggers `package_types`
--
DELIMITER $$
CREATE TRIGGER `prevent_package_delete` BEFORE DELETE ON `package_types` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Direct deletion from package_types table is not allowed! Use soft delete instead.';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `from`, `to`, `count`, `user_id`, `created_at`, `updated_at`) VALUES
(212, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 05:33:18', '2025-10-14 05:33:18'),
(213, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 06:35:37', '2025-10-14 06:35:37'),
(214, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 06:36:22', '2025-10-14 06:36:22'),
(215, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-14 06:36:36', '2025-10-14 06:36:36'),
(216, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-14 06:38:41', '2025-10-14 06:38:41'),
(217, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 06:58:17', '2025-10-14 06:58:17'),
(218, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 07:04:47', '2025-10-14 07:04:47'),
(219, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-14 07:07:25', '2025-10-14 07:07:25'),
(220, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 07:20:42', '2025-10-14 07:20:42'),
(221, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 08:55:44', '2025-10-14 08:55:44'),
(222, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-14 09:14:39', '2025-10-14 09:14:39'),
(223, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-15 03:30:23', '2025-10-15 03:30:23'),
(224, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-15 03:36:57', '2025-10-15 03:36:57'),
(225, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-15 03:59:45', '2025-10-15 03:59:45'),
(226, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-15 03:59:52', '2025-10-15 03:59:52'),
(227, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-15 04:51:05', '2025-10-15 04:51:05'),
(228, 'المدينة المنورة/', 'مكة المكرمة/', '12', NULL, '2025-10-15 08:41:07', '2025-10-15 08:41:07'),
(229, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-15 08:41:16', '2025-10-15 08:41:16'),
(230, 'مكة المكرمة/', 'المدينة المنورة/', '12', NULL, '2025-10-15 08:41:43', '2025-10-15 08:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `passenger_lists`
--

CREATE TABLE `passenger_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Phone_number` varchar(255) DEFAULT NULL,
  `passenger_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passenger_lists`
--

INSERT INTO `passenger_lists` (`id`, `name`, `nationality`, `id_number`, `Gender`, `Phone_number`, `passenger_id`, `created_at`, `updated_at`) VALUES
(1, 'AHMED AHMED', NULL, '2331429924', NULL, 'null', 1, '2025-06-25 20:02:11', '2025-06-25 20:02:11'),
(2, 'RESIDENT IOAsMEO AHMED DIN FAROOQ', NULL, '2331429924', NULL, 'null', 2, '2025-06-25 20:35:45', '2025-06-25 20:35:45'),
(3, 'FAROOQ AHMED AHMED DIN', NULL, '29924', NULL, 'null', 3, '2025-06-25 20:40:18', '2025-06-25 20:40:18'),
(4, 'AHMED SAAL KAAN ARARIA', NULL, '2563347109', NULL, 'null', 4, '2025-07-06 18:04:58', '2025-07-06 18:04:58'),
(5, 'MOHAMMED ABDULLAH MOHAMMED ALMUTAIRI', NULL, '1065597318', NULL, 'null', 5, '2025-07-06 18:43:07', '2025-07-06 18:43:07'),
(6, 'ABRAS aRAS', NULL, '2566696445', NULL, 'null', 6, '2025-07-06 18:45:07', '2025-07-06 18:45:07'),
(7, 'ABDULLAH ARIF-MUHAMMAD ARIF', NULL, '2400167670', NULL, 'null', 7, '2025-07-06 19:22:35', '2025-07-06 19:22:35'),
(8, 'ALIABBAS', NULL, '2566696445', NULL, 'null', 7, '2025-07-06 19:22:35', '2025-07-06 19:22:35'),
(9, 'imtiaz SARML KAAN', NULL, '2563347109', NULL, 'null', 7, '2025-07-06 19:22:35', '2025-07-06 19:22:35'),
(10, 'ABDULLAH ARIF MUHAMMAD ARIE', NULL, '2400167678', NULL, 'null', 8, '2025-07-06 19:25:28', '2025-07-06 19:25:28'),
(11, 'AHMED SAMAL KHAN', NULL, '21549464679', NULL, 'null', 8, '2025-07-06 19:25:28', '2025-07-06 19:25:28'),
(12, 'Imtiaz', NULL, '5154949596', NULL, 'null', 8, '2025-07-06 19:25:28', '2025-07-06 19:25:28'),
(13, 'AHMED SHAMAL KAAN', NULL, '25', NULL, 'null', 9, '2025-07-06 19:29:11', '2025-07-06 19:29:11'),
(14, 'Katda Ahmed Saanaan', NULL, '2', NULL, 'null', 9, '2025-07-06 19:29:11', '2025-07-06 19:29:11'),
(15, 'MDAHMED SAAN', NULL, '6', NULL, 'null', 9, '2025-07-06 19:29:11', '2025-07-06 19:29:11'),
(16, 'ali', NULL, '1234564848', NULL, 'null', 10, '2025-07-06 20:17:26', '2025-07-06 20:17:26'),
(41, 'AHMED THARWAT MORAMED ABDELGHANY', NULL, '0371311480', NULL, 'null', 13, '2025-07-23 20:06:44', '2025-07-23 20:06:44'),
(42, 'JAVED AKHTAR FALIK SHER', NULL, '2487931111', NULL, 'null', 14, '2025-08-05 18:59:36', '2025-08-05 18:59:36'),
(43, 'محمد', NULL, '08', NULL, 'null', 15, '2025-08-05 20:22:59', '2025-08-05 20:22:59'),
(44, 'ABDULLAH ARIF MUHAMMAD ARIF', NULL, '2400167678', NULL, 'null', 16, '2025-08-05 20:28:45', '2025-08-05 20:28:45'),
(45, 'ABDULLAH ARIF MUHAMMAD ARIF', NULL, '2400167678', NULL, 'null', 17, '2025-08-05 20:30:44', '2025-08-05 20:30:44'),
(46, 'HATEM MOHAMED ZAKY AL', NULL, '2602605715', NULL, 'null', 18, '2025-08-06 13:54:48', '2025-08-06 13:54:48'),
(47, 'HATEM MOHAMED ZAKY AL', NULL, '2602605715', NULL, 'null', 19, '2025-08-06 13:57:07', '2025-08-06 13:57:07'),
(48, 'فياز عيلي', NULL, '2607381015', NULL, '054745657', 20, '2025-08-15 14:35:09', '2025-08-15 14:35:09'),
(61, 'HASSAN MUAVIA LALA ABDUL SATTAR', NULL, '2559800210', NULL, 'null', 22, '2025-08-18 00:02:29', '2025-08-18 00:02:29'),
(62, 'ABDULLAH ARIFMUHAMMAD ARIE', NULL, '2400167678', NULL, 'null', 23, '2025-08-18 00:16:53', '2025-08-18 00:16:53'),
(63, 'AMINA SYED', NULL, '665337773', NULL, 'null', 23, '2025-08-18 00:16:53', '2025-08-18 00:16:53'),
(64, 'yv yv. f', NULL, '90', NULL, 'null', 23, '2025-08-18 00:16:53', '2025-08-18 00:16:53'),
(65, 'abdullah arif', NULL, '2400167678', NULL, 'null', 24, '2025-08-20 20:48:14', '2025-08-20 20:48:14'),
(66, 'ASHRAF AHMED ZAKI AHMED', NULL, '2554826280', NULL, '1', 25, '2025-08-21 20:29:46', '2025-08-21 20:29:46'),
(67, 'ASHRAF AHMED ZAKI AHMEC', NULL, '2554876280', NULL, '1', 26, '2025-08-21 21:17:15', '2025-08-21 21:17:15'),
(68, 'اشرف احمد زكي', NULL, '2554876280', NULL, 'null', 27, '2025-08-21 21:21:27', '2025-08-21 21:21:27'),
(69, 'أشرف احمد زكي', NULL, '2554876280', NULL, '1', 28, '2025-08-21 21:34:33', '2025-08-21 21:34:33'),
(70, 'أشرف أحمد', NULL, '2554876280', NULL, '0', 29, '2025-08-21 21:43:56', '2025-08-21 21:43:56'),
(71, 'أشرف احمد', NULL, '2554876280', NULL, '1', 30, '2025-08-21 21:47:38', '2025-08-21 21:47:38'),
(72, 'HASSAN MUAVIA LALA ABD', NULL, '2559800210', NULL, 'null', 31, '2025-08-23 22:33:55', '2025-08-23 22:33:55'),
(73, 'Ali', NULL, '2565123654', NULL, 'null', 32, '2025-08-24 09:07:18', '2025-08-24 09:07:18'),
(74, 'Hassan', NULL, '2559800210', NULL, 'null', 32, '2025-08-24 09:07:18', '2025-08-24 09:07:18'),
(75, 'M yousf', NULL, '2610251033', NULL, 'null', 32, '2025-08-24 09:07:18', '2025-08-24 09:07:18'),
(76, 'hassan', NULL, '2556800210', NULL, '0531687567', 33, '2025-08-24 13:33:09', '2025-08-24 13:33:09'),
(77, 'yousaf', NULL, '3310657890', NULL, '058945321', 33, '2025-08-24 13:33:09', '2025-08-24 13:33:09'),
(78, 'Tahir', NULL, '2188046508', NULL, '0508614577', 33, '2025-08-24 13:33:09', '2025-08-24 13:33:09'),
(79, 'احمد', NULL, '00', NULL, 'null', 34, '2025-08-24 14:20:28', '2025-08-24 14:20:28'),
(80, 'tahir', NULL, '2188046508', NULL, '0508614577', 35, '2025-08-24 19:55:18', '2025-08-24 19:55:18'),
(81, 'ASIM MUHAMMAD ABDUL GHANI ARMAN', NULL, '2603288669', NULL, 'null', 36, '2025-08-25 05:32:43', '2025-08-25 05:32:43'),
(82, 'ASIM MUHAMMAD ABDUL GHANI ARMAN', NULL, '0260328669', NULL, 'null', 37, '2025-08-25 05:44:35', '2025-08-25 05:44:35'),
(83, 'tahir', NULL, '2188046508', NULL, '0508614577', 38, '2025-08-25 20:09:21', '2025-08-25 20:09:21'),
(84, 'ABDULLAH ARIF MUHAMMAD ARIF', NULL, '2400167678', NULL, 'null', 39, '2025-08-26 14:43:34', '2025-08-26 14:43:34'),
(85, 'Muhammad  hassan', NULL, '2540578206', NULL, 'null', 40, '2025-08-27 05:54:38', '2025-08-27 05:54:38'),
(86, 'khadija', NULL, '4692862685', NULL, 'null', 40, '2025-08-27 05:54:38', '2025-08-27 05:54:38'),
(87, 'abu abaida', NULL, '4692862099', NULL, 'null', 40, '2025-08-27 05:54:38', '2025-08-27 05:54:38'),
(88, 'shama mohd', NULL, '4692849682', NULL, 'null', 40, '2025-08-27 05:54:38', '2025-08-27 05:54:38'),
(89, 'Maryam mihd', NULL, '4692848700', NULL, 'null', 40, '2025-08-27 05:54:38', '2025-08-27 05:54:38'),
(90, 'MMAbdullah', NULL, '6147868677', NULL, 'null', 41, '2025-08-28 22:07:02', '2025-08-28 22:07:02'),
(91, 'mohammad fowaz', NULL, '6125121990', NULL, 'null', 41, '2025-08-28 22:07:02', '2025-08-28 22:07:02'),
(92, 'Nasir', NULL, '2343968802', NULL, '0583213340', 42, '2025-08-28 22:09:15', '2025-08-28 22:09:15'),
(93, 'mohammad fowaz', NULL, '6125121990', NULL, 'null', 42, '2025-08-28 22:09:15', '2025-08-28 22:09:15'),
(94, 'shahid bashir', NULL, '6147179426', NULL, 'null', 43, '2025-08-28 22:11:49', '2025-08-28 22:11:49'),
(95, 'fatima', NULL, '6147179449', NULL, 'null', 43, '2025-08-28 22:11:49', '2025-08-28 22:11:49'),
(96, 'Nasir', NULL, '2343968802', NULL, 'null', 43, '2025-08-28 22:11:49', '2025-08-28 22:11:49'),
(97, 'ibrahim', NULL, '784198498054686', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(98, 'alawia', NULL, '784195458243656', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(99, 'abdlah', NULL, '61464301137', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(100, 'nouf', NULL, '6146430144', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(101, 'noor', NULL, '6146430163', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(102, 'ibrahim', NULL, '6147659350', NULL, 'null', 44, '2025-08-30 15:19:44', '2025-08-30 15:19:44'),
(103, 'inaya', NULL, '6147663726', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(104, 'syda arifa', NULL, '6147663724', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(105, 'khalid', NULL, '6147663692', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(106, 'zanib', NULL, '4149217940', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(107, 'khateja', NULL, '6145217940', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(108, 'ghazala', NULL, '.6144815568', NULL, 'null', 45, '2025-08-31 12:28:29', '2025-08-31 12:28:29'),
(109, 'sohail', NULL, '6147636694', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(110, 'Farah', NULL, '6147636695', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(111, 'aima sohail', NULL, '6147636702', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(112, 'mubashra', NULL, '6147636701', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(113, 'zainab', NULL, '6147636705', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(114, 'moha musa', NULL, '6147636704', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(115, 'ayesha', NULL, '6147636703', NULL, 'null', 46, '2025-09-01 13:49:19', '2025-09-01 13:49:19'),
(116, 'Umer Chaudhary', NULL, '673757683', NULL, 'null', 47, '2025-09-01 14:06:35', '2025-09-01 14:06:35'),
(117, 'Shahida butt', NULL, '680593113', NULL, 'null', 47, '2025-09-01 14:06:35', '2025-09-01 14:06:35'),
(118, 'Amna Attart', NULL, '6147610505', NULL, 'null', 48, '2025-09-02 09:17:27', '2025-09-02 09:17:27'),
(119, 'Sakina Tehseen Attari', NULL, '6147610486', NULL, 'null', 48, '2025-09-02 09:17:27', '2025-09-02 09:17:27'),
(120, 'Hina Tehseen Attarl', NULL, '6147610487', NULL, 'null', 48, '2025-09-02 09:17:27', '2025-09-02 09:17:27'),
(121, 'Tahseen Attari', NULL, '6147610450', NULL, 'null', 48, '2025-09-02 09:17:27', '2025-09-02 09:17:27'),
(122, 'Zainab Tehseen Attari', NULL, '6147610507', NULL, 'null', 48, '2025-09-02 09:17:27', '2025-09-02 09:17:27'),
(123, 'Qazi khaja shaker', NULL, '6147114670', NULL, 'null', 49, '2025-09-02 09:39:01', '2025-09-02 09:39:01'),
(124, 'al anoud ahmed', NULL, '29663402085', NULL, 'null', 49, '2025-09-02 09:39:01', '2025-09-02 09:39:01'),
(125, 'Amir', NULL, '6147577693', NULL, 'null', 50, '2025-09-02 19:46:17', '2025-09-02 19:46:17'),
(126, 'saif', NULL, '6147577684', NULL, 'null', 50, '2025-09-02 19:46:17', '2025-09-02 19:46:17'),
(127, 'fateh jabban', NULL, '6147883633', NULL, '0545628841', 51, '2025-09-03 10:31:50', '2025-09-03 10:31:50'),
(128, 'omar jabban', NULL, '6147883640', NULL, '0547939131', 51, '2025-09-03 10:31:50', '2025-09-03 10:31:50'),
(129, 'rima yaldani', NULL, '6147883687', NULL, '0545478837', 51, '2025-09-03 10:31:50', '2025-09-03 10:31:50'),
(130, 'Mahenoor Taher Ahmed Kapa', NULL, '1161022011', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(131, 'Taher Ahmed Mohammed Husaln Kapada', NULL, '6148037621', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(132, 'Mudassir Taher Ahmed Kapadia', NULL, '6148037624', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(133, 'Mohd Mustufa Taher Ahmed Kapadia', NULL, '6148037625', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(134, 'Moazzam Taher Ahemed Kapada', NULL, '6148037625', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(135, 'Mahdilya Farooq Soorya', NULL, '6148121798', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(136, 'Faroog Mohamed Soorya', NULL, '0010042025', NULL, 'null', 52, '2025-09-03 12:15:08', '2025-09-03 12:15:08'),
(137, 'MD PIARU', NULL, '6148159653', NULL, 'null', 53, '2025-09-04 10:26:45', '2025-09-04 10:26:45'),
(138, 'Soieb Akhtar', NULL, '6148159708', NULL, 'null', 53, '2025-09-04 10:26:45', '2025-09-04 10:26:45'),
(139, 'Sagufta Ara', NULL, '6148159757', NULL, 'null', 53, '2025-09-04 10:26:45', '2025-09-04 10:26:45'),
(140, 'BABI NISHA', NULL, '6148159767', NULL, 'null', 53, '2025-09-04 10:26:45', '2025-09-04 10:26:45'),
(141, 'Tahira Parveen', NULL, '7001402903', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(142, 'Maryam Sharif', NULL, '61466830901', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(143, 'SAEEDA PARVEN', NULL, '6147151085', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(144, 'SANAA AKBAR', NULL, '0560228565', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(145, 'haer', NULL, '2559800210', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(146, 'u97y06u', NULL, '32', NULL, 'null', 54, '2025-09-05 10:14:12', '2025-09-05 10:14:12'),
(147, 'Ali hussain', NULL, '2613039052', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(148, 'Asif', NULL, '2606295307', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(149, 'Noor', NULL, '2612153583', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(150, 'danish', NULL, '2607232507', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(151, 'Azhar', NULL, '2583769712', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(152, 'Buhari', NULL, '850447554', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(153, 'Abdurehman', NULL, '2604581567', NULL, 'null', 55, '2025-09-05 17:29:08', '2025-09-05 17:29:08'),
(154, 'Abdul khaliq', NULL, '0194991136', NULL, 'null', 56, '2025-09-06 06:37:31', '2025-09-06 06:37:31'),
(155, 'Muhammad Arshad Iqbal', NULL, '6146671154', NULL, 'null', 56, '2025-09-06 06:37:31', '2025-09-06 06:37:31'),
(156, 'Mohi Jabeen Arshad', NULL, '6146671151', NULL, 'null', 56, '2025-09-06 06:37:31', '2025-09-06 06:37:31'),
(157, 'Riyadi', NULL, '6144866778', NULL, 'null', 57, '2025-09-08 10:41:33', '2025-09-08 10:41:33'),
(158, 'sugyati', NULL, '6144820504', NULL, 'null', 57, '2025-09-08 10:41:33', '2025-09-08 10:41:33'),
(159, 'sri muryani', NULL, '6144866781', NULL, 'null', 57, '2025-09-08 10:41:33', '2025-09-08 10:41:33'),
(160, 'sudaish', NULL, '6144820501', NULL, 'null', 57, '2025-09-08 10:41:33', '2025-09-08 10:41:33'),
(161, 'Ramlan', NULL, '6144820498', NULL, 'null', 57, '2025-09-08 10:41:33', '2025-09-08 10:41:33'),
(162, 'ramlan', NULL, '6144082498', NULL, 'null', 58, '2025-09-08 10:46:09', '2025-09-08 10:46:09'),
(163, 'sudaish', NULL, '6144820501', NULL, 'null', 58, '2025-09-08 10:46:09', '2025-09-08 10:46:09'),
(164, 'maryani', NULL, '6144866781', NULL, 'null', 58, '2025-09-08 10:46:09', '2025-09-08 10:46:09'),
(165, 'sugayti', NULL, '6144820504', NULL, 'null', 58, '2025-09-08 10:46:09', '2025-09-08 10:46:09'),
(166, 'Riyadi', NULL, '6144866778', NULL, 'null', 58, '2025-09-08 10:46:09', '2025-09-08 10:46:09'),
(167, 'abdur rehaman', NULL, '6148148677', NULL, 'null', 59, '2025-09-09 11:01:50', '2025-09-09 11:01:50'),
(168, 'ali raza', NULL, '614814685', NULL, 'null', 59, '2025-09-09 11:01:50', '2025-09-09 11:01:50'),
(169, 'khalida', NULL, '6148148708', NULL, 'null', 59, '2025-09-09 11:01:50', '2025-09-09 11:01:50'),
(170, 'yasmin sabir', NULL, '6148148707', NULL, 'null', 59, '2025-09-09 11:01:50', '2025-09-09 11:01:50'),
(171, 'Afnan Mohammed Saad Almutairi', NULL, '1099167479', NULL, 'null', 60, '2025-09-10 06:22:20', '2025-09-10 06:22:20'),
(172, 'NOOR US SABAH', NULL, '6124909443', NULL, 'null', 60, '2025-09-10 06:22:20', '2025-09-10 06:22:20'),
(173, 'nawaz', NULL, '2595647407', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(174, 'arbab', NULL, '6147649252', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(175, 'shugran', NULL, '6147649272', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(176, 'mehar ali', NULL, '6147642025', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(177, 'wazairan', NULL, '6147649274', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(178, 'shafiq', NULL, '2542112624', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(179, 'hassina bibi', NULL, '6146779584', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(180, 'khan blocha', NULL, '416665411', NULL, 'null', 61, '2025-09-10 06:26:34', '2025-09-10 06:26:34'),
(181, 'Maryam Sharif', NULL, '1263417046', NULL, 'null', 62, '2025-09-10 11:04:18', '2025-09-10 11:04:18'),
(182, 'Maryam Sharif', NULL, '7001402903', NULL, 'null', 62, '2025-09-10 11:04:18', '2025-09-10 11:04:18'),
(183, 'Maryam Sharif', NULL, '6146830901', NULL, 'null', 62, '2025-09-10 11:04:18', '2025-09-10 11:04:18'),
(184, 'omar', NULL, '6146299551', NULL, 'null', 63, '2025-09-12 11:56:36', '2025-09-12 11:56:36'),
(185, 'beena', NULL, '6146299550', NULL, 'null', 63, '2025-09-12 11:56:36', '2025-09-12 11:56:36'),
(186, 'Rizwan', NULL, '6147974331', NULL, 'null', 64, '2025-09-13 10:42:56', '2025-09-13 10:42:56'),
(187, 'ammara', NULL, '6147974362', NULL, 'null', 64, '2025-09-13 10:42:56', '2025-09-13 10:42:56'),
(188, 'Bushra', NULL, '6147973968', NULL, 'null', 64, '2025-09-13 10:42:56', '2025-09-13 10:42:56'),
(189, 'Shaista', NULL, '6147973969', NULL, 'null', 64, '2025-09-13 10:42:56', '2025-09-13 10:42:56'),
(190, 'HESHAM SALAH YOUSSEF MOHAMED RADWAN', NULL, '2485188920', NULL, 'null', 65, '2025-09-13 11:58:38', '2025-09-13 11:58:38'),
(191, 'Doha Mohamed', NULL, '2558356818', NULL, 'null', 65, '2025-09-13 11:58:38', '2025-09-13 11:58:38'),
(192, 'Marad AKCHA', NULL, '7001402903', NULL, 'null', 66, '2025-09-13 17:22:42', '2025-09-13 17:22:42'),
(193, 'FRAKHADIJ A<RANAD', NULL, '0019692830', NULL, 'null', 66, '2025-09-13 17:22:42', '2025-09-13 17:22:42'),
(194, 'Irfan Ilyas Andhi', NULL, '2556206684', NULL, '0563836525', 67, '2025-09-14 06:09:14', '2025-09-14 06:09:14'),
(195, 'osama Elmudaw', NULL, '2242148910', NULL, 'null', 67, '2025-09-14 06:09:14', '2025-09-14 06:09:14'),
(196, 'sadam', NULL, '2602038503', NULL, 'null', 68, '2025-09-14 06:51:21', '2025-09-14 06:51:21'),
(197, 'shafiq', NULL, '2536115947', NULL, 'null', 68, '2025-09-14 06:51:21', '2025-09-14 06:51:21'),
(198, 'Akhtar', NULL, '1854458109', NULL, 'null', 68, '2025-09-14 06:51:21', '2025-09-14 06:51:21'),
(199, 'Riefy mauritza', NULL, '6148014507', NULL, '6281293618000', 69, '2025-09-14 14:48:40', '2025-09-14 14:48:40'),
(200, 'riefy mauritza', NULL, '6148014507', NULL, '6281293618000', 69, '2025-09-14 14:48:40', '2025-09-14 14:48:40'),
(201, 'Riefy Mauritza', NULL, '0011044722', NULL, 'null', 69, '2025-09-14 14:48:40', '2025-09-14 14:48:40'),
(202, 'sibia', NULL, '2255687480', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(203, 'Nadeem', NULL, '353278622', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(204, 'fatima', NULL, '4393965452', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(205, 'Abdullah', NULL, '43932861', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(206, 'nehat', NULL, '6148340018', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(207, 'hira noor', NULL, '9944823780', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(208, 'zuha', NULL, '980974251', NULL, 'null', 70, '2025-09-15 09:51:18', '2025-09-15 09:51:18'),
(233, 'Afia ishfaq', NULL, '6149121298', NULL, 'null', 73, '2025-09-17 09:17:59', '2025-09-17 09:17:59'),
(234, 'Faiza', NULL, '6449121301', NULL, 'null', 73, '2025-09-17 09:17:59', '2025-09-17 09:17:59'),
(235, 'Muhammad  ishfaq', NULL, '6449121288', NULL, 'null', 73, '2025-09-17 09:17:59', '2025-09-17 09:17:59'),
(236, 'AYAT ABDELKAREEM AWAD BALA', NULL, '0003605734', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(237, 'YAHYA YAGOUB DAOUD', NULL, '2191896811', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(238, 'SUMIA HABIB MUSA ISHAG', NULL, '21916665283', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(239, 'ABDELRAHMAN KHATIR SHTAYA', NULL, '2192129788', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(240, 'DARABA Ibrahim', NULL, '4815757416', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(241, 'omar Abdulrahman', NULL, '21978924619', NULL, 'null', 74, '2025-09-17 12:25:51', '2025-09-17 12:25:51'),
(242, 'ABBA HASSAN OTUJT', NULL, '0003117132', NULL, 'null', 75, '2025-09-18 06:11:15', '2025-09-18 06:11:15'),
(243, 'AISHATU HASSAN MUHAMMAD', NULL, '5884889407', NULL, 'null', 75, '2025-09-18 06:11:15', '2025-09-18 06:11:15'),
(244, 'MARYAM ABBA HASSAN', NULL, '04718197', NULL, 'null', 75, '2025-09-18 06:11:15', '2025-09-18 06:11:15'),
(245, 'hossame', NULL, '229616412', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(246, 'sameer', NULL, '2486820624', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(247, 'samir', NULL, '418181298', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(248, 'eman', NULL, '318321945', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(249, 'asma', NULL, '33359580', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(250, 'Abir', NULL, '418181975', NULL, 'null', 76, '2025-09-18 09:04:57', '2025-09-18 09:04:57'),
(251, 'ahmad', NULL, '2269134223', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(252, 'Wala', NULL, '6146955518', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(253, 'abdul rehman', NULL, '2499687693', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(254, 'rajib', NULL, '2518369869', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(255, 'ismail', NULL, '2565139298', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(256, 'Fokhar', NULL, '255682352', NULL, 'null', 77, '2025-09-19 07:15:42', '2025-09-19 07:15:42'),
(257, 'Earna', NULL, '2547336630', NULL, 'null', 78, '2025-09-19 16:55:21', '2025-09-19 16:55:21'),
(258, 'Mubrak', NULL, '232094495', NULL, 'null', 79, '2025-09-20 12:40:53', '2025-09-20 12:40:53'),
(343, 'Mohamed Tolba', NULL, '301021312078', NULL, '050968413687', 87, '2025-09-27 08:36:56', '2025-09-27 08:36:56'),
(344, 'Mohamed Tolba', NULL, '1355685', NULL, '2566485255', 88, '2025-09-27 08:38:16', '2025-09-27 08:38:16'),
(357, 'Mohamed Tolba', NULL, '8282525', NULL, '828522', 90, '2025-09-27 12:17:23', '2025-09-27 12:17:23'),
(358, 'Mohammed developer', NULL, '3333333', NULL, '3333333', 91, '2025-09-27 12:21:38', '2025-09-27 12:21:38'),
(359, 'Mohammed mohammed', NULL, '222222', NULL, '2222222', 91, '2025-09-27 12:21:38', '2025-09-27 12:21:38'),
(360, 'Jgg', NULL, '066', NULL, 'null', 91, '2025-09-27 12:21:38', '2025-09-27 12:21:38'),
(361, 'Mohammed', NULL, '9565', NULL, '65688', 92, '2025-09-27 12:24:24', '2025-09-27 12:24:24'),
(362, 'Jhyjh', NULL, '8569', NULL, '9598', 92, '2025-09-27 12:24:24', '2025-09-27 12:24:24'),
(363, 'Jgg', NULL, '066', NULL, 'null', 92, '2025-09-27 12:24:24', '2025-09-27 12:24:24'),
(364, 'Mooo', NULL, '658555', NULL, '95', 93, '2025-09-27 12:26:08', '2025-09-27 12:26:08'),
(365, 'Nhgh', NULL, '8668', NULL, 'null', 93, '2025-09-27 12:26:08', '2025-09-27 12:26:08'),
(366, 'Jgg', NULL, '066', NULL, 'null', 93, '2025-09-27 12:26:08', '2025-09-27 12:26:08'),
(367, 'Mohamed', NULL, '9286', NULL, 'null', 94, '2025-09-27 12:33:48', '2025-09-27 12:33:48'),
(368, 'Jhhh', NULL, '8555', NULL, '85685', 94, '2025-09-27 12:33:48', '2025-09-27 12:33:48'),
(369, 'Bhvv', NULL, '885', NULL, 'null', 94, '2025-09-27 12:33:48', '2025-09-27 12:33:48'),
(370, 'Mohammed developer', NULL, '96688', NULL, 'null', 95, '2025-09-27 12:49:50', '2025-09-27 12:49:50'),
(371, 'Mohammed Tolba', NULL, '999999', NULL, 'null', 95, '2025-09-27 12:49:50', '2025-09-27 12:49:50'),
(372, 'Same', NULL, '998853', NULL, 'null', 95, '2025-09-27 12:49:50', '2025-09-27 12:49:50'),
(373, 'Mohamed Tolba', NULL, '911542', NULL, 'null', 96, '2025-09-27 12:53:47', '2025-09-27 12:53:47'),
(374, 'Need of their', NULL, '855', NULL, 'null', 96, '2025-09-27 12:53:47', '2025-09-27 12:53:47'),
(375, 'Bvh', NULL, '858', NULL, 'null', 96, '2025-09-27 12:53:47', '2025-09-27 12:53:47'),
(376, 'Mohammed mohammed developer', NULL, '95895', NULL, 'null', 97, '2025-09-27 12:56:59', '2025-09-27 12:56:59'),
(377, 'Business headlines', NULL, '95585', NULL, 'null', 97, '2025-09-27 12:56:59', '2025-09-27 12:56:59'),
(378, 'Mohamed AbdelMenem', NULL, '96552', NULL, 'null', 98, '2025-09-27 12:57:29', '2025-09-27 12:57:29'),
(379, 'Mhbjh', NULL, '9666', NULL, 'null', 99, '2025-09-27 12:58:33', '2025-09-27 12:58:33'),
(380, 'Mknj', NULL, '9555', NULL, 'null', 100, '2025-09-27 13:00:06', '2025-09-27 13:00:06'),
(381, 'Nnhh', NULL, '68555', NULL, 'null', 101, '2025-09-27 13:00:39', '2025-09-27 13:00:39'),
(382, 'Nnhh', NULL, '68555', NULL, 'null', 102, '2025-09-27 13:01:40', '2025-09-27 13:01:40'),
(383, 'Nnhh', NULL, '68555', NULL, 'null', 103, '2025-09-27 13:02:06', '2025-09-27 13:02:06'),
(384, 'Nnhh', NULL, '68555', NULL, 'null', 104, '2025-09-27 13:02:22', '2025-09-27 13:02:22'),
(385, 'Nnhh', NULL, '68555', NULL, 'null', 105, '2025-09-27 13:03:06', '2025-09-27 13:03:06'),
(386, 'Mohammed mohammed', NULL, '6552', NULL, 'null', 106, '2025-09-27 13:03:43', '2025-09-27 13:03:43'),
(387, 'Bhhg', NULL, '6555', NULL, 'null', 106, '2025-09-27 13:03:43', '2025-09-27 13:03:43'),
(388, 'Mohammed mohammed mohammed', NULL, '8555', NULL, 'null', 107, '2025-09-27 13:15:10', '2025-09-27 13:15:10'),
(389, 'Get your own', NULL, '54555', NULL, 'null', 108, '2025-09-27 13:21:03', '2025-09-27 13:21:03'),
(390, 'Mohammed', NULL, '555', NULL, 'null', 109, '2025-09-27 13:22:43', '2025-09-27 13:22:43'),
(391, 'Mohammed', NULL, '622655', NULL, 'null', 110, '2025-09-27 13:24:36', '2025-09-27 13:24:36'),
(392, 'Vg', NULL, '55', NULL, 'null', 111, '2025-09-27 13:24:54', '2025-09-27 13:24:54'),
(393, 'Name is not', NULL, '92855', NULL, '85584', 112, '2025-09-27 14:30:41', '2025-09-27 14:30:41'),
(394, 'Cdvf', NULL, '555', NULL, 'null', 112, '2025-09-27 14:30:41', '2025-09-27 14:30:41'),
(395, 'Gmail can also a', NULL, '88555', NULL, 'null', 113, '2025-09-27 14:39:23', '2025-09-27 14:39:23'),
(396, 'Gg', NULL, '55', NULL, 'null', 113, '2025-09-27 14:39:23', '2025-09-27 14:39:23'),
(397, 'Vv', NULL, '885', NULL, 'null', 113, '2025-09-27 14:39:23', '2025-09-27 14:39:23'),
(398, 'SAAD SALEH SAAD ALSALEH', NULL, '1048115304', NULL, 'null', 114, '2025-09-27 14:46:31', '2025-09-27 14:46:31'),
(399, 'ABDULLAH MOHAMMED ALSHIHRI', NULL, '1088231848', NULL, 'null', 114, '2025-09-27 14:46:31', '2025-09-27 14:46:31'),
(400, 'Ccf', NULL, '54', NULL, 'null', 114, '2025-09-27 14:46:31', '2025-09-27 14:46:31'),
(401, 'Mkjkj', NULL, '96655', NULL, 'null', 115, '2025-09-27 15:34:25', '2025-09-27 15:34:25'),
(402, 'Hhgjgg', NULL, '8898853', NULL, 'null', 115, '2025-09-27 15:34:25', '2025-09-27 15:34:25'),
(403, 'Mmmm', NULL, '9999', NULL, 'null', 115, '2025-09-27 15:34:25', '2025-09-27 15:34:25'),
(404, 'Mohamed AbdelMenem', NULL, '9369323556', NULL, 'null', 116, '2025-09-27 15:58:53', '2025-09-27 15:58:53'),
(405, 'خالد ابراهيم محمد عبدالعزيز', NULL, '1085305990', NULL, 'null', 116, '2025-09-27 15:58:53', '2025-09-27 15:58:53'),
(406, 'M💕Mmmmm', NULL, '9538568288', NULL, 'null', 116, '2025-09-27 15:58:53', '2025-09-27 15:58:53'),
(407, 'Hatem Mohammed Zaky Ali', NULL, '1087147356', NULL, 'null', 117, '2025-09-27 15:59:53', '2025-09-27 15:59:53'),
(408, 'Information for', NULL, '5555555555', NULL, 'null', 117, '2025-09-27 15:59:53', '2025-09-27 15:59:53'),
(409, 'Mohammed', NULL, '676467879677', NULL, '658688', 118, '2025-09-27 16:21:17', '2025-09-27 16:21:17'),
(410, 'Mohammed', NULL, '65595555555', NULL, 'null', 118, '2025-09-27 16:21:17', '2025-09-27 16:21:17'),
(411, 'Mohamed AbdelMenem', NULL, '954646461616', NULL, 'null', 119, '2025-09-28 08:16:03', '2025-09-28 08:16:03'),
(412, 'ABDULLAH SALIM ALLAAH ALHARBI', NULL, '1089193586', NULL, 'null', 119, '2025-09-28 08:16:03', '2025-09-28 08:16:03'),
(413, 'Name and', NULL, '8855655888', NULL, 'null', 119, '2025-09-28 08:16:03', '2025-09-28 08:16:03'),
(414, 'Need help', NULL, '855655854455', NULL, 'null', 120, '2025-09-28 08:23:51', '2025-09-28 08:23:51'),
(415, 'Mihihibim', NULL, '939383892858', NULL, 'null', 120, '2025-09-28 08:23:51', '2025-09-28 08:23:51'),
(416, 'Cgf', NULL, '6852752485', NULL, 'null', 121, '2025-09-28 08:24:28', '2025-09-28 08:24:28'),
(417, 'Mohamed AbdelMenem', NULL, '42755475245', NULL, 'null', 122, '2025-09-28 08:26:02', '2025-09-28 08:26:02'),
(418, 'Get your', NULL, '25445845445', NULL, 'null', 123, '2025-09-28 08:30:45', '2025-09-28 08:30:45'),
(419, 'Gmail', NULL, '52554485477', NULL, 'null', 124, '2025-09-28 08:31:34', '2025-09-28 08:31:34'),
(420, 'Hassan', NULL, '845874555555', NULL, 'null', 125, '2025-09-28 08:31:57', '2025-09-28 08:31:57'),
(421, 'B💕f💕g💕', NULL, '8855555555', NULL, 'null', 126, '2025-09-28 08:32:38', '2025-09-28 08:32:38'),
(422, 'V💕Vddv', NULL, '8282388383', NULL, 'null', 127, '2025-09-28 08:33:53', '2025-09-28 08:33:53'),
(423, 'Mohammed developer', NULL, '7555524554', NULL, 'null', 128, '2025-09-28 08:36:35', '2025-09-28 08:36:35'),
(424, 'Name is the', NULL, '5495926291', NULL, 'null', 129, '2025-09-28 08:37:05', '2025-09-28 08:37:05'),
(425, 'Mohammed mohammed', NULL, '848161616551', NULL, 'null', 130, '2025-09-28 08:37:46', '2025-09-28 08:37:46'),
(426, 'Ggyvvtvrvtv', NULL, '7555485455', NULL, 'null', 131, '2025-09-28 08:38:46', '2025-09-28 08:38:46'),
(427, 'Heg', NULL, '1515151510', NULL, 'null', 132, '2025-09-28 08:39:28', '2025-09-28 08:39:28'),
(428, 'ABDULLAH ABDULRAHMAN ALSHAMMARI', NULL, '1089764321', NULL, 'null', 133, '2025-09-28 09:05:07', '2025-09-28 09:05:07'),
(429, 'From your browser', NULL, '8855745574', NULL, 'null', 134, '2025-09-28 09:11:31', '2025-09-28 09:11:31'),
(430, 'Business headlines to', NULL, '84915151515', NULL, 'null', 135, '2025-09-28 09:13:38', '2025-09-28 09:13:38'),
(431, 'Bg hb', NULL, '685058200550', NULL, 'null', 136, '2025-09-28 09:18:34', '2025-09-28 09:18:34'),
(432, 'Can also the', NULL, '555658458425', NULL, 'null', 137, '2025-09-28 09:20:44', '2025-09-28 09:20:44'),
(433, 'Nfjfhrh', NULL, '5151518115', NULL, 'null', 138, '2025-09-28 09:23:09', '2025-09-28 09:23:09'),
(434, 'Mohamed AbdelMenem headlines', NULL, '848484515151', NULL, 'null', 139, '2025-09-28 09:23:54', '2025-09-28 09:23:54'),
(435, 'Ggyvvtvrvtv', NULL, '8484848451', NULL, 'null', 140, '2025-09-28 09:24:53', '2025-09-28 09:24:53'),
(436, 'Mohammed mohammed', NULL, '8259464661', NULL, 'null', 141, '2025-09-28 09:27:48', '2025-09-28 09:27:48'),
(437, 'Mohammed developer', NULL, '886838822828', NULL, 'null', 142, '2025-09-28 09:28:59', '2025-09-28 09:28:59'),
(438, 'For a few days', NULL, '774818191981', NULL, 'null', 142, '2025-09-28 09:28:59', '2025-09-28 09:28:59'),
(439, 'Mohamed Tolba ggyvvtvrvtv', NULL, '82838335838', NULL, 'null', 143, '2025-09-28 09:29:16', '2025-09-28 09:29:16'),
(440, 'Mohammed developer and', NULL, '748585882828', NULL, 'null', 144, '2025-09-28 09:30:08', '2025-09-28 09:30:08'),
(441, 'Vffgt', NULL, '557481881881', NULL, 'null', 145, '2025-09-28 10:36:16', '2025-09-28 10:36:16'),
(442, 'fvdbdbdbr', NULL, '818151818181', NULL, 'null', 145, '2025-09-28 10:36:16', '2025-09-28 10:36:16'),
(443, 'Mohammed developer', NULL, '6838252528', NULL, '575535387', 146, '2025-09-28 10:41:12', '2025-09-28 10:41:12'),
(444, 'Mgbbynyjynyyn', NULL, '85929295959', NULL, 'null', 146, '2025-09-28 10:41:12', '2025-09-28 10:41:12'),
(529, 'Mohammed Tolba', NULL, '12545845745', NULL, 'null', 162, '2025-10-02 12:33:30', '2025-10-02 12:33:30'),
(530, 'Mohammed Tolba', NULL, '124854554854', NULL, NULL, 163, '2025-10-02 13:13:58', '2025-10-02 13:13:58'),
(531, 'Mohammed Tolba', NULL, '124854554854', NULL, NULL, 164, '2025-10-02 13:14:19', '2025-10-02 13:14:19'),
(532, 'Mohammed Tolba', NULL, '124854554854', NULL, NULL, 165, '2025-10-02 13:14:33', '2025-10-02 13:14:33'),
(533, 'Mohammed Tolba', NULL, '15455558558', NULL, 'null', 166, '2025-10-02 13:32:46', '2025-10-02 13:32:46'),
(534, 'Mohammed', NULL, '485485554554', NULL, 'null', 166, '2025-10-02 13:32:46', '2025-10-02 13:32:46'),
(535, 'Mohammed', NULL, '94958282882', NULL, 'null', 167, '2025-10-02 13:36:22', '2025-10-02 13:36:22'),
(536, 'From', NULL, '4516226266', NULL, 'null', 167, '2025-10-02 13:36:22', '2025-10-02 13:36:22'),
(537, 'Mohammed Tolba', NULL, '868685855757', NULL, 'null', 168, '2025-10-04 13:51:27', '2025-10-04 13:51:27'),
(538, 'Mohammed', NULL, '9858855858', NULL, 'null', 169, '2025-10-05 13:40:23', '2025-10-05 13:40:23'),
(539, 'AbdelMenem', NULL, '8686868383', NULL, 'null', 169, '2025-10-05 13:40:23', '2025-10-05 13:40:23'),
(540, 'Mohammed Tolba Hassan', NULL, '6856856859', NULL, '0575535387', 170, '2025-10-05 13:47:01', '2025-10-05 13:47:01'),
(541, 'AbdelMenem', NULL, '83735283525', NULL, '0583738373', 170, '2025-10-05 13:47:01', '2025-10-05 13:47:01'),
(542, 'Browser o', NULL, '68373476443', NULL, '0583743435', 170, '2025-10-05 13:47:01', '2025-10-05 13:47:01'),
(543, 'Ahmed Sowidan', NULL, '8686686868', NULL, NULL, 170, '2025-10-05 13:47:01', '2025-10-05 13:47:01'),
(544, 'Mohammed', NULL, '6683535588', NULL, '0583737387', 171, '2025-10-05 14:13:44', '2025-10-05 14:13:44'),
(545, 'Ggyvvtvrvtv', NULL, '1286868686', NULL, '0573738373', 171, '2025-10-05 14:13:44', '2025-10-05 14:13:44'),
(546, 'Vcjccyyc', NULL, '86868686868', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(547, 'Mcjci', NULL, '86868377337', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(548, 'Vjvjcucucu', NULL, '86868686868', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(549, 'Very well', NULL, '05867673699', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(550, 'Icuccu', NULL, '8575768868', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(551, 'Vjvjchchhc', NULL, '6868838837', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(552, 'Vjcjcucuccuuc', NULL, '8686868888', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(553, 'Jcjcuxyxyxhxhxxg', NULL, '8686868684', NULL, 'null', 172, '2025-10-05 14:53:04', '2025-10-05 14:53:04'),
(554, 'Mohammed mohammed', NULL, '838383838282', NULL, 'null', 173, '2025-10-05 16:27:13', '2025-10-05 16:27:13'),
(555, 'AbdelMenem', NULL, '83538282828', NULL, '0583828258', 174, '2025-10-05 16:40:10', '2025-10-05 16:40:10'),
(556, 'Browser and other', NULL, '8355353553', NULL, '0586853838', 174, '2025-10-05 16:40:10', '2025-10-05 16:40:10'),
(557, 'Mohammed Tolba', NULL, '86835252728', NULL, '0583838727', 174, '2025-10-05 16:40:10', '2025-10-05 16:40:10'),
(558, 'Mohammed mohammed', NULL, '837242442442', NULL, 'null', 175, '2025-10-05 16:41:42', '2025-10-05 16:41:42'),
(559, 'Hassan', NULL, '85272272772', NULL, 'null', 175, '2025-10-05 16:41:42', '2025-10-05 16:41:42'),
(560, 'Name', NULL, '86868555685', NULL, 'null', 175, '2025-10-05 16:41:42', '2025-10-05 16:41:42'),
(561, 'MOHAMEDBKG', NULL, '85868356676', NULL, 'null', 175, '2025-10-05 16:41:42', '2025-10-05 16:41:42'),
(562, 'Developer', NULL, '86868576896', NULL, 'null', 175, '2025-10-05 16:41:42', '2025-10-05 16:41:42'),
(563, 'Mohammed Tolba', NULL, '754854845245', NULL, 'null', 176, '2025-10-05 16:52:38', '2025-10-05 16:52:38'),
(564, 'Mohammed', NULL, '686838306838', NULL, 'null', 177, '2025-10-05 17:21:04', '2025-10-05 17:21:04'),
(565, 'Name', NULL, '668383838383', NULL, 'null', 177, '2025-10-05 17:21:04', '2025-10-05 17:21:04'),
(566, 'Mohammed mohammed', NULL, '83838382828', NULL, 'null', 178, '2025-10-05 17:21:18', '2025-10-05 17:21:18'),
(567, 'Mohammed', NULL, '85757272828', NULL, '0585757272', 179, '2025-10-05 17:23:28', '2025-10-05 17:23:28'),
(568, 'Mohammed Tolba', NULL, '828386868886', NULL, '0578383438', 179, '2025-10-05 17:23:28', '2025-10-05 17:23:28'),
(569, 'MOHAMEDBKG', NULL, '5152828282', NULL, 'null', 180, '2025-10-05 17:36:14', '2025-10-05 17:36:14'),
(570, 'Ali Mohamed', NULL, '3264656345', NULL, 'null', 183, '2025-10-06 11:53:58', '2025-10-06 11:53:58'),
(571, 'Ibrahim Ahmed', NULL, '4723473864', NULL, 'null', 183, '2025-10-06 11:53:58', '2025-10-06 11:53:58'),
(572, 'Mazzen Mohamed', NULL, '73867483654', NULL, 'null', 183, '2025-10-06 11:53:58', '2025-10-06 11:53:58'),
(573, 'Mohamed Tolba', NULL, '7345784758', NULL, 'null', 184, '2025-10-06 11:59:44', '2025-10-06 11:59:44'),
(574, 'Ahmed', NULL, '4785487585', NULL, 'null', 184, '2025-10-06 11:59:44', '2025-10-06 11:59:44'),
(575, 'Mohamed Ali', NULL, '8998989898', NULL, 'null', 185, '2025-10-06 12:00:39', '2025-10-06 12:00:39'),
(576, 'Mohamed Ali', NULL, '23121321312', NULL, 'null', 188, '2025-10-06 13:30:15', '2025-10-06 13:30:15'),
(577, 'Aj', NULL, '3213213122', NULL, 'null', 188, '2025-10-06 13:30:15', '2025-10-06 13:30:15'),
(605, 'Mohamed Tolba', NULL, '83535355255', NULL, '0553535353', 204, '2025-10-09 12:03:11', '2025-10-09 12:03:11'),
(606, 'Ahmed Ali', NULL, '86838838828', NULL, '0573446558', 204, '2025-10-09 12:03:11', '2025-10-09 12:03:11'),
(607, 'The only', NULL, '8383833553', NULL, '0576556823', 205, '2025-10-09 12:04:11', '2025-10-09 12:04:11'),
(608, 'Fari', NULL, '838383883685', NULL, '0578658655', 205, '2025-10-09 12:04:11', '2025-10-09 12:04:11'),
(609, 'AZ', NULL, '0683838833', NULL, 'null', 205, '2025-10-09 12:04:11', '2025-10-09 12:04:11');

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
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `avater` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
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
('5rTPXbCoEUv8SOZH9vA4Bf7pe6gpPCASnaAY0gzG', 3, '192.168.8.103', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVWRpRnN0Ulp0enFQNkNmcnI3MmF0SWRhd1ZDaGdkVXhJQmhrc2R1YiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1ODoiaHR0cDovLzE5Mi4xNjguOC4xMDM6ODAwMC9kYXNoYm9hcmQvdHJhbnNwb3J0L3RyYXZlbHMvc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoxMzoidmVyaWZpZWRfdXNlciI7aTozO3M6MTI6ImNvbXBhbnlfdHlwZSI7czo5OiJ0cmFuc3BvcnQiO30=', 1760611217);

-- --------------------------------------------------------

--
-- Table structure for table `snds`
--

CREATE TABLE `snds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `client_type` varchar(255) DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `geha_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `snds`
--

INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(1, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 3900.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 17:30:48', '2025-04-12 17:30:48', NULL, NULL, NULL),
(2, 'تحويل داخلي', 'سيارة', 17, 10, NULL, 3900.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 17:39:36', '2025-04-12 17:39:36', NULL, NULL, NULL),
(3, 'تحويل داخلي', 'سيارة', 11, 11, NULL, 3900.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 17:41:11', '2025-04-12 17:41:11', NULL, NULL, NULL),
(4, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 4800.00, 'غير خاضع للضريبة', 'استحقاق مركبة لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 17:51:09', '2025-04-12 17:51:09', NULL, NULL, NULL),
(5, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:24:27', '2025-04-12 18:24:27', NULL, NULL, NULL),
(6, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'دفعه من استحقاق مركبه لشهر ابريل لعام 2025 /0294', '2025-04-12', '2025-04-12 18:26:25', '2025-04-12 18:26:25', NULL, NULL, NULL),
(7, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 170.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:32:27', '2025-04-12 18:32:27', NULL, NULL, NULL),
(8, 'تحويل داخلي', 'سيارة', 22, NULL, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:36:55', '2025-04-12 18:36:55', NULL, NULL, NULL),
(9, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:51:50', '2025-04-12 18:51:50', NULL, NULL, NULL),
(10, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 4930.00, 'غير خاضع للضريبة', 'متبقي استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:55:40', '2025-04-12 18:55:40', NULL, NULL, NULL),
(11, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 18:59:19', '2025-04-12 18:59:19', NULL, NULL, NULL),
(12, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:05:35', '2025-04-12 19:05:35', NULL, NULL, NULL),
(13, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:16:48', '2025-04-12 19:16:48', NULL, NULL, NULL),
(14, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:19:26', '2025-04-12 19:19:26', NULL, NULL, NULL),
(15, 'تحويل داخلي', 'سيارة', 12, 13, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:22:10', '2025-04-12 19:22:10', NULL, NULL, NULL),
(16, 'تحويل داخلي', 'سيارة', 26, 13, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:32:26', '2025-04-12 19:32:26', NULL, NULL, NULL),
(17, 'تحويل داخلي', 'سيارة', 27, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:37:25', '2025-04-12 19:37:25', NULL, NULL, NULL),
(18, 'تحويل داخلي', 'سيارة', 28, 28, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:46:31', '2025-04-12 19:46:31', NULL, NULL, NULL),
(19, 'تحويل داخلي', 'سيارة', 29, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:49:32', '2025-04-12 19:49:32', NULL, NULL, NULL),
(20, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:52:21', '2025-04-12 19:52:21', NULL, NULL, NULL),
(21, 'تحويل داخلي', 'سيارة', 14, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 19:55:31', '2025-04-12 19:55:31', NULL, NULL, NULL),
(22, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لشهر ابريل لعام 2025', '2025-04-01', '2025-04-12 20:00:44', '2025-04-12 20:00:44', NULL, NULL, NULL),
(23, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'دفعه من استحقاق مركبه لشهر ابريل لعام 2025  / 0297', '2025-04-12', '2025-04-13 14:39:20', '2025-04-13 14:39:20', NULL, NULL, NULL),
(24, 'قبض', 'موظف', 11, NULL, 'كاش', 1030.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 / 0296', '2025-04-12', '2025-04-13 14:42:08', '2025-04-13 14:42:08', NULL, NULL, NULL),
(25, 'قبض', 'موظف', 23, NULL, 'كاش', 940.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0291', '2025-04-12', '2025-04-13 14:43:38', '2025-04-13 14:43:38', NULL, NULL, NULL),
(26, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0292', '2025-04-12', '2025-04-13 14:44:38', '2025-04-13 14:44:38', NULL, NULL, NULL),
(27, 'قبض', 'موظف', 24, NULL, 'كاش', 900.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0293', '2025-04-12', '2025-04-13 14:45:37', '2025-04-13 14:45:37', NULL, NULL, NULL),
(28, 'قبض', 'موظف', 20, NULL, 'كاش', 850.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0295', '2025-04-12', '2025-04-13 14:47:26', '2025-04-13 14:47:26', NULL, NULL, NULL),
(29, 'قبض', 'موظف', 19, NULL, 'كاش', 1075.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0298', '2025-04-13', '2025-04-13 15:44:31', '2025-04-13 15:44:31', NULL, NULL, NULL),
(30, 'قبض', 'موظف', 25, NULL, 'كاش', 1100.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 / 0299', '2025-04-13', '2025-04-13 19:07:44', '2025-04-13 19:07:44', NULL, NULL, NULL),
(31, 'قبض', 'موظف', 31, NULL, 'كاش', 400.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0300', '2025-04-14', '2025-04-14 16:03:52', '2025-04-14 16:03:52', NULL, NULL, NULL),
(32, 'قبض', 'موظف', 17, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لشهر ابريل لعام 2025 /0301', '2025-04-15', '2025-04-15 20:45:04', '2025-04-15 20:45:04', NULL, NULL, NULL),
(33, 'قبض', 'موظف', 24, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'دفعه من استحقاق مركبه لشهر ابريل لعام 2025 /0302', '2025-04-16', '2025-04-16 20:03:08', '2025-04-16 20:03:08', NULL, NULL, NULL),
(34, 'قبض', 'موظف', NULL, NULL, 'كاش', 1110.00, 'غير خاضع للضريبة', 'دفعه من استحقاق مركبه لشهر ابريل لعام /2025 /0303', '2025-04-19', '2025-04-19 14:25:52', '2025-04-19 14:25:52', NULL, NULL, NULL),
(35, 'تحويل داخلي', 'موظف', 25, 17, NULL, 5100.00, 'غير خاضع للضريبة', 'استرداد استحقاق مركبه لشهر ابريل لعام 2025 تم اضافته بالخطأ ( مكرر )', '2025-04-01', '2025-04-19 15:19:23', '2025-04-19 15:19:23', NULL, NULL, NULL),
(36, 'قبض', 'موظف', 19, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'دفعه من استحقاق مركبه لشهر ابريل لعام 2025 / 0305', '2025-04-19', '2025-04-19 15:22:52', '2025-04-19 15:22:52', NULL, NULL, NULL),
(37, 'قبض', 'موظف', 4, NULL, 'كاش', 300.00, 'غير خاضع للضريبة', 'دفعه من استحاق لشهر ابريل لعام 2025 /0304', '2025-04-19', '2025-04-19 15:25:22', '2025-04-19 15:25:22', NULL, NULL, NULL),
(38, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 2000.00, 'غير خاضع للضريبة', 'عدم تأمين سائق اضافي / 2514894561182216', '2025-03-25', '2025-04-19 16:10:41', '2025-04-19 16:10:41', 3, NULL, NULL),
(39, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'تشغيل حافلة غير مزودة بدورة مياه / 2515864967130271', '2025-03-25', '2025-04-19 16:17:07', '2025-04-19 16:17:07', 3, NULL, NULL),
(40, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق بالزي / 2512834740297115', '2025-03-23', '2025-04-19 16:22:05', '2025-04-19 16:22:05', 3, NULL, NULL),
(41, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'تشغيل حافلة لايتوفر بها اي من المواصفات والشروط والتجهيزات الفنية المهتمدة / 2515883973779120', '2025-03-21', '2025-04-19 16:24:38', '2025-04-19 16:24:38', 3, NULL, NULL),
(42, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 2000.00, 'غير خاضع للضريبة', 'عدم تأمين سائق اضافي / 2513863477785172', '2025-03-21', '2025-04-19 16:26:33', '2025-04-19 16:26:33', 3, NULL, NULL),
(43, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'تشغيل حافلة غير مزودة بدورة مياه / 2513823177785564', '2025-03-21', '2025-04-19 16:34:23', '2025-04-19 16:34:23', 3, NULL, NULL),
(44, 'تحويل داخلي', 'جهة', 28, NULL, NULL, 5000.00, 'غير خاضع للضريبة', 'تشغيل حافلة دون الحصول على بطاقة تشغيل / 2514801786536255', '2025-03-16', '2025-04-19 16:36:39', '2025-04-19 16:36:39', 3, NULL, NULL),
(45, 'تحويل داخلي', 'جهة', 29, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق يالزي / 2415605754297203', '2024-11-18', '2025-04-19 16:39:04', '2025-04-19 16:39:04', 3, NULL, NULL),
(46, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق بالزي / 2411653057491463', '2024-11-04', '2025-04-19 16:40:49', '2025-04-19 16:40:49', 3, NULL, NULL),
(47, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 2000.00, 'غير خاضع للضريبة', 'عدم تأمين سائق اضافي / 2412640193263967', '2024-10-16', '2025-04-19 16:42:19', '2025-04-19 16:42:19', 3, NULL, NULL),
(48, 'قبض', 'موظف', NULL, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'دفعه من استحاق لشهر ابريل لعام 2025 /0306', '2025-04-19', '2025-04-19 16:57:48', '2025-04-19 16:57:48', NULL, NULL, NULL),
(49, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'مدفعه من استحاق لشهر ابريل لعام 2025 / 0307', '2025-04-19', '2025-04-19 18:04:56', '2025-04-19 18:04:56', NULL, NULL, NULL),
(50, 'قبض', 'موظف', 24, NULL, 'كاش', 990.00, 'غير خاضع للضريبة', 'دفعه من استحاق لشهر ابريل لعام 2025 /0309', '2025-04-19', '2025-04-19 19:25:33', '2025-04-19 19:25:33', NULL, NULL, NULL),
(51, 'قبض', 'موظف', 20, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'دفعه من استحاق لشهر ابريل لعام 2025 / 0310', '2025-04-19', '2025-04-19 19:36:52', '2025-04-19 19:36:52', NULL, NULL, NULL),
(52, 'تحويل داخلي', 'جهة', 32, NULL, NULL, 5000.00, 'غير خاضع للضريبة', 'تشغيل السيارة دون الحصول على بطاقة تشغيل / 2418568307258130', '2024-09-22', '2025-04-19 20:00:16', '2025-04-19 20:00:16', 3, NULL, NULL),
(53, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق بالزي / 2418572175526420', '2024-08-11', '2025-04-19 20:01:53', '2025-04-19 20:01:53', 3, NULL, NULL),
(54, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 5000.00, 'غير خاضع للضريبة', 'تشغيل حافلة دون الحصول على بطاقة تشغيل / 2419467844917223', '2024-06-26', '2025-04-19 20:06:15', '2025-04-19 20:06:15', 3, NULL, NULL),
(55, 'تحويل داخلي', 'جهة', 33, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق بالزي / 2413485084365135', '2024-06-11', '2025-04-19 20:11:07', '2025-04-19 20:11:07', 3, NULL, NULL),
(56, 'تحويل داخلي', 'جهة', 34, NULL, NULL, 2000.00, 'غير خاضع للضريبة', 'عدم العناية بالحالة الفنية للسيارة وصيانتها / 2417484691529594', '2024-06-06', '2025-04-19 20:17:25', '2025-04-19 20:17:25', 3, NULL, NULL),
(57, 'تحويل داخلي', 'جهة', 15, NULL, NULL, 225.00, 'غير خاضع للضريبة', 'مخالفة مرورية رقم 3112167476 بتاريخ 27-09-1446هـ', '2025-03-27', '2025-04-19 20:22:31', '2025-04-19 20:22:31', 2, NULL, NULL),
(58, 'تحويل داخلي', 'جهة', 15, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'مخالفة مرورية 3112833251 بتاريخ 12-10-1446هـ', '2025-04-10', '2025-04-19 20:25:11', '2025-04-19 20:25:11', 2, NULL, NULL),
(59, 'تحويل داخلي', 'جهة', 15, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'مخالفة مرورية 3113113697 بتاريخ 17-10-1446هـ', '2025-04-15', '2025-04-19 20:27:22', '2025-04-19 20:27:22', 2, NULL, NULL),
(60, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'مخالفة مرورية 3113113697 بتاريخ 12-09-1446هـ', '2025-03-12', '2025-04-19 20:29:29', '2025-04-19 20:29:29', 2, NULL, NULL),
(61, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6511286648 بتاريخ 14-09-1446هـ', '2025-03-14', '2025-04-19 20:32:20', '2025-04-19 20:32:20', 2, NULL, NULL),
(62, 'تحويل داخلي', 'جهة', 31, NULL, NULL, 225.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6511933473 بتاريخ 17-09-1446هـ', '2025-03-17', '2025-04-19 20:34:27', '2025-04-19 20:34:27', 2, NULL, NULL),
(63, 'تحويل داخلي', 'جهة', 15, NULL, NULL, 1125.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6513590448 بتاريخ 24-09-1446هـ', '2025-03-24', '2025-04-19 20:36:25', '2025-04-19 20:36:25', 2, NULL, NULL),
(64, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6515986600 بتاريخ 03-10-1446هـ', '2025-04-01', '2025-04-19 20:38:34', '2025-04-19 20:38:34', 2, NULL, NULL),
(65, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6515988473 بتاريخ 03-10-1446هـ', '2025-04-01', '2025-04-19 20:40:03', '2025-04-19 20:40:03', 2, NULL, NULL),
(66, 'تحويل داخلي', 'جهة', 31, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'مخالفة مرورية 6518812158 بتاريخ 10-10-1446هـ', '2025-04-08', '2025-04-19 20:41:46', '2025-04-19 20:41:46', 2, NULL, NULL),
(67, 'قبض', 'موظف', 7, NULL, 'كاش', 2700.00, 'غير خاضع للضريبة', 'تجديد اقامه', '2025-04-19', '2025-04-19 20:52:01', '2025-04-19 20:52:01', NULL, NULL, NULL),
(68, 'قبض', 'موظف', 25, NULL, 'كاش', 75.00, 'غير خاضع للضريبة', 'مخالفة مرورية', '2025-04-05', '2025-04-20 15:40:35', '2025-04-20 15:40:35', NULL, NULL, NULL),
(69, 'قبض', 'موظف', 29, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'سداد مستحقات المركبة لشهر مارس تم دفعها بتاريخ 2025-04-05', '2025-03-31', '2025-04-20 15:42:26', '2025-05-28 17:17:17', NULL, NULL, NULL),
(70, 'قبض', 'موظف', 8, NULL, 'كاش', 1500.00, 'غير خاضع للضريبة', 'سداد مستحقات المركبة لشهر مارس / سائق اضافي', '2025-04-05', '2025-04-20 15:46:18', '2025-04-20 15:46:18', NULL, NULL, NULL),
(71, 'تحويل داخلي', 'سيارة', 29, 5, NULL, 1000.00, 'غير خاضع للضريبة', 'سداد مستحقات المركبة لشهر مارس لعام 2025م', '2025-03-01', '2025-04-20 15:50:10', '2025-04-20 15:50:10', NULL, NULL, NULL),
(72, 'قبض', 'موظف', 19, NULL, 'كاش', 810.00, 'غير خاضع للضريبة', 'دفعه استحقاق لمركبه  لعام 2025 / 0279', '2025-04-05', '2025-04-20 15:55:55', '2025-04-20 15:55:55', NULL, NULL, NULL),
(73, 'تحويل داخلي', 'موظف', 22, 6, NULL, 5100.00, 'غير خاضع للضريبة', 'استرداد مستحقاق لشهر ابريل تم تحويله بخطا', '2025-04-01', '2025-04-20 16:00:59', '2025-04-20 16:00:59', NULL, NULL, NULL),
(74, 'تحويل داخلي', 'سيارة', 31, 6, NULL, 5100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025 /', '2025-04-01', '2025-04-20 16:07:55', '2025-04-20 16:07:55', NULL, NULL, NULL),
(75, 'تحويل داخلي', 'موظف', 11, 11, NULL, 1430.00, 'غير خاضع للضريبة', 'استرداد جزء من استحقاق مركبه بسبب تبديل السياره لسائق نايف', '2025-04-19', '2025-04-20 17:05:31', '2025-04-20 17:05:31', NULL, NULL, NULL),
(76, 'تحويل داخلي', 'سيارة', 11, 6, NULL, 1540.00, 'غير خاضع للضريبة', 'استحقاق مركبه ل11 يوم من شهر ابريل اليومية 140 ريال', '2025-04-19', '2025-04-20 17:12:21', '2025-04-20 17:12:21', NULL, NULL, NULL),
(77, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 900.00, 'غير خاضع للضريبة', 'استحقاق تجديد الاقامه لشهر ابريل لعام 2025', '2025-04-01', '2025-04-20 17:17:31', '2025-04-20 17:17:31', 1, NULL, NULL),
(78, 'تحويل داخلي', 'جهة', 35, NULL, NULL, 30900.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 17:26:34', '2025-04-20 17:26:34', 9, NULL, NULL),
(79, 'تحويل داخلي', 'جهة', 36, NULL, NULL, 18363.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 17:51:44', '2025-04-20 17:51:44', 9, NULL, NULL),
(80, 'تحويل داخلي', 'جهة', 37, NULL, NULL, 3700.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 17:57:59', '2025-04-20 17:57:59', 9, NULL, NULL),
(81, 'تحويل داخلي', 'جهة', 37, NULL, NULL, 3700.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 18:07:02', '2025-04-20 18:07:02', 9, NULL, NULL),
(82, 'تحويل داخلي', 'جهة', 38, NULL, NULL, 26185.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 18:12:56', '2025-04-20 18:12:56', 9, NULL, NULL),
(83, 'تحويل داخلي', 'جهة', 39, NULL, NULL, 14667.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 18:17:44', '2025-04-20 18:17:44', 9, NULL, NULL),
(84, 'تحويل داخلي', 'جهة', 40, NULL, NULL, 24457.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2024-12-01', '2025-04-20 18:21:48', '2025-04-20 18:21:48', 9, NULL, NULL),
(85, 'تحويل داخلي', NULL, 41, NULL, NULL, 15120.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2020-12-01', '2025-04-20 18:25:45', '2025-04-20 18:25:45', NULL, NULL, NULL),
(86, 'تحويل داخلي', 'جهة', 42, NULL, NULL, 21881.00, 'غير خاضع للضريبة', 'امر تنفيذ', '2020-12-01', '2025-04-20 18:30:30', '2025-04-20 18:30:30', 9, NULL, NULL),
(87, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 100.00, 'غير خاضع للضريبة', 'طباعة اقامة', '2025-04-01', '2025-04-20 19:29:36', '2025-04-20 19:29:36', 8, NULL, NULL),
(88, 'قبض', 'موظف', 29, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه شهر ابريل لعام 2025 /0311', '2025-04-20', '2025-04-23 13:45:29', '2025-04-23 13:45:29', NULL, NULL, NULL),
(89, 'قبض', 'موظف', 7, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 / 0312', '2025-04-20', '2025-04-23 13:48:01', '2025-04-23 13:48:01', NULL, NULL, NULL),
(90, 'قبض', 'موظف', 25, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0313', '2025-04-20', '2025-04-23 13:50:20', '2025-04-23 13:50:20', NULL, NULL, NULL),
(91, 'قبض', 'موظف', 25, NULL, 'كاش', 550.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0314', '2025-04-26', '2025-04-26 18:00:15', '2025-04-26 22:33:19', NULL, '1', NULL),
(92, 'قبض', 'موظف', 25, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'طباعة بطاقة اقامه', '2025-04-26', '2025-04-26 18:02:21', '2025-04-26 22:33:03', NULL, '1', NULL),
(93, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0316', '2025-04-26', '2025-04-26 18:03:26', '2025-04-26 22:32:39', NULL, '1', NULL),
(94, 'قبض', 'موظف', 23, NULL, 'كاش', 1015.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0317', '2025-04-26', '2025-04-26 18:05:03', '2025-04-26 22:30:57', NULL, '1', NULL),
(95, 'قبض', 'موظف', 7, NULL, 'كاش', 720.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0319', '2025-04-26', '2025-04-26 18:08:02', '2025-04-26 22:29:55', NULL, '1', NULL),
(96, 'قبض', 'موظف', 20, NULL, 'كاش', 450.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0320', '2025-04-26', '2025-04-26 18:10:24', '2025-04-26 22:28:46', NULL, '1', NULL),
(97, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0321', '2025-04-26', '2025-04-26 18:22:52', '2025-04-26 22:27:54', NULL, '1', NULL),
(98, 'قبض', 'موظف', 24, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0322', '2025-04-26', '2025-04-26 18:24:18', '2025-04-26 22:27:00', NULL, '1', NULL),
(99, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 345.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2024-09-03', '2025-04-26 20:35:42', '2025-04-26 20:35:42', 4, NULL, NULL),
(100, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 345.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2025-01-08', '2025-04-26 20:39:39', '2025-04-26 20:39:39', 4, NULL, NULL),
(101, 'تحويل داخلي', 'جهة', 16, NULL, NULL, 1265.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2024-10-14', '2025-04-26 20:41:58', '2025-04-26 20:41:58', 4, NULL, NULL),
(102, 'تحويل داخلي', 'جهة', 9, NULL, NULL, 1092.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2025-01-01', '2025-04-26 20:45:56', '2025-04-26 20:45:56', 4, NULL, NULL),
(103, 'تحويل داخلي', 'جهة', 43, NULL, NULL, 826.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2024-11-30', '2025-04-26 20:56:24', '2025-04-26 20:56:24', 4, NULL, NULL),
(104, 'تحويل داخلي', 'جهة', 28, NULL, NULL, 690.00, 'غير خاضع للضريبة', 'الوقوف في موقف محظور', '2025-04-08', '2025-04-26 21:00:13', '2025-04-26 21:00:13', 4, NULL, NULL),
(105, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2700.00, 'غير خاضع للضريبة', 'تجديد الاقامه لمدد 3اشهور', '2025-04-22', '2025-04-26 22:19:07', '2025-04-26 22:19:07', 1, NULL, NULL),
(106, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'مقابل خدمات اصدار تاشيرات خروج وعودة', '2025-04-25', '2025-04-26 22:20:27', '2025-04-26 22:20:27', 8, NULL, NULL),
(107, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 9700.00, 'غير خاضع للضريبة', 'كرت عمل', '2025-04-26', '2025-04-26 22:22:55', '2025-04-26 22:22:55', 8, NULL, NULL),
(108, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 1650.00, 'غير خاضع للضريبة', 'رسوم تجديد سنه +رسوم تاخير', '2025-04-26', '2025-04-26 22:24:50', '2025-04-26 22:24:50', 1, NULL, NULL),
(109, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 300.00, 'غير خاضع للضريبة', 'تامين طبي', '2025-04-26', '2025-04-26 22:25:47', '2025-04-26 22:25:47', 1, NULL, NULL),
(110, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 690.00, 'غير خاضع للضريبة', 'الوقوف ضمن حرم الطريق ومرور السيارات', '2024-03-19', '2025-04-27 15:39:43', '2025-04-27 15:39:43', 4, NULL, NULL),
(111, 'قبض', 'موظف', 19, NULL, 'كاش', 1055.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابربل  لعام 2025 / 0318', '2025-04-27', '2025-04-27 15:43:58', '2025-04-27 15:43:58', NULL, NULL, NULL),
(112, 'قبض', 'موظف', 23, NULL, 'كاش', 7000.00, 'غير خاضع للضريبة', 'مدفعات حكوميه', '2025-04-27', '2025-04-27 20:26:57', '2025-04-27 20:26:57', NULL, NULL, NULL),
(113, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 4970.00, 'غير خاضع للضريبة', 'سند امر رقم 0015', '2025-03-16', '2025-04-28 09:39:25', '2025-04-28 09:39:25', 11, NULL, NULL),
(114, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 10000.00, 'غير خاضع للضريبة', 'سند  امر', '2025-04-20', '2025-04-28 09:42:21', '2025-04-28 09:42:21', 11, NULL, NULL),
(115, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 400.00, 'شامل الضريبة', 'مرجعة الجوازات وتعديل المهنة', '2025-04-25', '2025-04-28 09:44:40', '2025-04-28 09:44:40', 8, NULL, NULL),
(116, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 9000.00, 'غير خاضع للضريبة', 'سند امر برقم 006', '2024-12-12', '2025-04-28 09:48:37', '2025-04-28 09:48:37', 11, NULL, NULL),
(117, 'تحويل داخلي', 'جهة', 45, NULL, NULL, 3000.00, 'غير خاضع للضريبة', 'سند امر برقم 007', '2024-12-12', '2025-04-28 09:52:42', '2025-04-28 09:52:42', 11, NULL, NULL),
(118, 'تحويل داخلي', 'جهة', 18, NULL, NULL, 30000.00, 'غير خاضع للضريبة', 'سند امر برقم 005', '2024-12-10', '2025-04-28 10:00:20', '2025-04-28 10:00:20', 11, NULL, NULL),
(119, 'تحويل داخلي', 'جهة', 46, NULL, NULL, 65400.00, 'غير خاضع للضريبة', 'سند امر برقم 003', '2024-12-04', '2025-04-28 10:07:51', '2025-04-28 10:07:51', 11, NULL, NULL),
(120, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'سند امر برقم 005', '2025-12-09', '2025-04-28 10:51:30', '2025-04-28 10:51:30', 11, NULL, NULL),
(121, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 65400.00, 'غير خاضع للضريبة', 'سند لامر', '2025-12-09', '2025-04-28 10:53:04', '2025-04-28 10:53:04', 11, NULL, NULL),
(122, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'عدم التزام السائق بالزي الوطني أو الزي المعتمد أثناء تأدية العمل / 2517819466803305', '2025-04-28', '2025-04-30 10:43:56', '2025-04-30 10:43:56', 3, NULL, NULL),
(123, 'تحويل داخلي', 'موظف', 27, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'تم قبول الاغتراض علي المعارضه / 2515864967130271', '2025-04-30', '2025-04-30 10:46:55', '2025-04-30 10:46:55', 3, NULL, NULL),
(124, 'قبض', 'موظف', 17, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'دفعه من استحقاق لمركبه لشهر ابريل لعام 2025 /0323', '2025-05-02', '2025-05-01 21:38:55', '2025-05-01 21:38:55', NULL, NULL, NULL),
(125, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'استحقاق لمركبه لشهر ابريل اعام / 2025    /0325', '2025-05-03', '2025-05-03 17:00:32', '2025-05-03 17:00:32', NULL, NULL, NULL),
(126, 'قبض', 'موظف', 23, NULL, 'كاش', 750.00, 'غير خاضع للضريبة', 'استحقاق لمركبه لشهر ابريل لعام /2025 /0324', '2025-05-03', '2025-05-03 17:02:09', '2025-05-03 17:02:09', NULL, NULL, NULL),
(127, 'قبض', 'موظف', 17, NULL, 'كاش', 115.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025 /0326', '2025-05-03', '2025-05-03 17:24:53', '2025-05-03 17:24:53', NULL, NULL, NULL),
(128, 'قبض', 'موظف', 20, NULL, 'كاش', 470.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025 /0327', '2025-05-03', '2025-05-03 17:45:55', '2025-05-03 17:45:55', NULL, NULL, NULL),
(129, 'قبض', 'موظف', 25, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025 /0328', '2025-05-03', '2025-05-03 17:51:47', '2025-05-03 17:51:47', NULL, NULL, NULL),
(130, 'قبض', 'موظف', 15, NULL, 'كاش', 1500.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل لعام 2025 /0330', '2025-05-03', '2025-05-03 18:35:26', '2025-05-03 18:35:26', NULL, NULL, NULL),
(131, 'قبض', 'موظف', 24, NULL, 'كاش', 560.00, 'غير خاضع للضريبة', 'استحقاق لمركبه لشهر ابريل لعام 2025 / 0329', '2025-05-04', '2025-05-04 17:51:42', '2025-05-04 17:51:42', NULL, NULL, NULL),
(132, 'قبض', 'موظف', 19, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'استحاق لمركبه لشهر ابريل لعام 2025 / 0035', '2025-05-04', '2025-05-04 19:36:03', '2025-05-04 19:36:03', NULL, NULL, NULL),
(133, 'قبض', 'موظف', 7, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'دفعه استحقاق لمركبه لشهر ابريل لعام 2025 /0036', '2025-05-07', '2025-05-07 15:45:44', '2025-05-07 15:45:44', NULL, NULL, NULL),
(134, 'قبض', 'موظف', 8, NULL, 'كاش', 1500.00, 'غير خاضع للضريبة', 'استحقاق لمركبه لشهر مايو لعام 2025 /0037', '2025-05-08', '2025-05-08 20:08:27', '2025-05-08 20:08:27', NULL, NULL, NULL),
(135, 'قبض', 'موظف', 8, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تصريح حج', '2025-05-08', '2025-05-08 20:09:27', '2025-05-08 20:09:27', NULL, NULL, NULL),
(136, 'قبض', 'موظف', 28, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025 /0038', '2025-05-08', '2025-05-08 20:28:40', '2025-05-08 20:28:40', NULL, NULL, NULL),
(137, 'قبض', 'موظف', 27, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025 /0038', '2025-05-08', '2025-05-08 20:31:41', '2025-05-08 20:31:41', NULL, NULL, NULL),
(138, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025 / 0039', '2025-05-10', '2025-05-10 16:31:04', '2025-05-10 16:31:04', NULL, NULL, NULL),
(139, 'قبض', 'موظف', 19, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-10', '2025-05-10 17:57:42', '2025-05-10 17:57:42', NULL, NULL, NULL),
(140, 'قبض', 'موظف', 20, NULL, 'كاش', 260.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-10', '2025-05-10 17:58:51', '2025-05-10 17:58:51', NULL, NULL, NULL),
(141, 'قبض', 'موظف', 23, NULL, 'كاش', 925.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025 /0042', '2025-05-10', '2025-05-10 18:06:00', '2025-05-10 18:06:00', NULL, NULL, NULL),
(142, 'قبض', 'موظف', 25, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-10', '2025-05-10 18:08:31', '2025-05-10 18:08:31', NULL, NULL, NULL),
(143, 'قبض', 'موظف', 15, NULL, 'كاش', 1300.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025 /0044', '2025-05-10', '2025-05-10 18:25:04', '2025-05-10 18:25:04', NULL, NULL, NULL),
(144, 'تحويل داخلي', 'موظف', 27, NULL, NULL, 1000.00, 'غير خاضع للضريبة', 'تم قبول طاب الاعتراض', '2025-05-10', '2025-05-11 13:58:52', '2025-05-11 13:58:52', 3, NULL, NULL),
(145, 'قبض', 'موظف', 7, NULL, 'كاش', 930.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025', '2025-05-11', '2025-05-11 16:35:32', '2025-06-05 16:40:02', NULL, '1', NULL),
(146, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'استرجاع مبلغ من مخالفة تمت اضافتها بالغلط', '2025-05-11', '2025-05-11 17:28:29', '2025-06-05 16:40:02', 2, '1', NULL),
(147, 'تحويل داخلي', 'جهة', 31, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'اضافة علي مخالفة مرورية موجوده / 6511933473', '2025-05-11', '2025-05-11 17:45:29', '2025-06-05 16:40:02', 2, '1', NULL),
(148, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 37.00, 'غير خاضع للضريبة', 'اضافة علي مخالفة سابقة /6511286648', '2025-05-11', '2025-05-11 17:46:30', '2025-06-05 16:40:02', 2, '1', NULL),
(149, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'عدم وجود تأمين سار للمركبة - رصد آلي / 6525274095', '2025-05-04', '2025-05-11 17:52:19', '2025-05-11 17:52:19', 2, NULL, NULL),
(150, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 113.00, 'غير خاضع للضريبة', 'تجاوز السرعة المحددة بأكثر من 10 الى 20 كم/س - رصد آلي  / 6521009836', '2025-04-17', '2025-05-11 17:54:46', '2025-05-11 17:54:46', 2, NULL, NULL),
(151, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'تجاوز السرعة المحددة بأكثر من 10 الى 20 كم/س - رصد آلي / 6510984192', '2025-03-11', '2025-05-11 17:57:40', '2025-05-11 17:57:40', 2, NULL, NULL),
(152, 'قبض', 'موظف', 7, NULL, 'كاش', 930.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025 /0045', '2025-05-11', '2025-05-11 18:06:30', '2025-06-05 16:40:02', NULL, '1', NULL),
(153, 'قبض', 'موظف', 44, NULL, 'كاش', 1260.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025 /0046', '2025-05-11', '2025-05-11 18:07:35', '2025-06-05 16:40:02', NULL, '1', NULL),
(154, 'قبض', 'موظف', 24, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو  لعام 2025 /0047', '2025-05-11', '2025-05-11 18:13:31', '2025-06-05 16:40:02', NULL, '1', NULL),
(155, 'صرف', 'موظف', 7, NULL, 'كاش', 930.00, 'غير خاضع للضريبة', 'تصحيح بيانات بمبلغ  930 ريال', '2025-05-11', '2025-05-11 18:55:08', '2025-06-05 16:40:02', NULL, '1', NULL),
(156, 'قبض', 'موظف', 17, NULL, 'كاش', 130.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025 / 0048', '2025-05-12', '2025-05-12 16:25:54', '2025-06-05 16:39:12', NULL, '1', NULL),
(157, 'قبض', 'موظف', 17, NULL, 'كاش', 80.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025/0049', '2025-05-13', '2025-05-13 21:01:00', '2025-06-05 16:35:56', NULL, '1', NULL),
(158, 'قبض', 'موظف', 17, NULL, 'كاش', 145.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025/ 0050', '2025-05-14', '2025-05-14 20:03:54', '2025-06-05 16:35:05', NULL, '1', NULL),
(159, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'وقوف مركبه في اماكن غير مخصصة للوقوف /3114628432', '2025-05-15', '2025-05-15 16:49:00', '2025-06-05 16:33:12', 2, '1', NULL),
(160, 'قبض', 'موظف', 28, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'سداد مستحقات', '2025-05-15', '2025-05-15 19:41:15', '2025-06-05 16:33:12', NULL, '1', NULL),
(161, 'قبض', 'موظف', 17, NULL, 'كاش', 70.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025 / 0052', '2025-05-15', '2025-05-15 20:23:59', '2025-06-05 16:33:12', NULL, '1', NULL),
(162, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 5000.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم / 2419467844917223', '2025-05-13', '2025-05-17 14:05:38', '2025-06-05 17:18:40', 3, '1', 'الراجحي - ابو طلال'),
(163, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم / 2415605754297203', '2025-05-13', '2025-05-17 14:09:02', '2025-06-05 17:21:36', 3, '1', 'الراجحي - ابو طلال'),
(164, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم / 2411653057491463', '2025-05-13', '2025-05-17 14:11:16', '2025-06-05 17:22:13', 3, '1', 'الراجحي - ابو طلال'),
(165, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 2000.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم / 2412640193263967', '2025-05-13', '2025-05-17 14:13:31', '2025-06-05 17:22:57', 3, '1', 'الراجحي - ابو طلال'),
(166, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم /  2413485084365135', '2025-05-13', '2025-05-17 14:17:03', '2025-06-05 17:23:24', 3, '1', 'الراجحي - ابو طلال'),
(167, 'صرف', 'جهة', NULL, NULL, 'كاش', 2000.00, 'غير خاضع للضريبة', 'سداد مخالفة رقم / 2417484691529594', '2025-05-13', '2025-05-17 14:19:10', '2025-06-05 16:35:56', 3, '1', NULL),
(168, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'عدم وجود تامين سار للمركبة', '2025-05-15', '2025-05-17 14:47:05', '2025-06-05 16:33:12', 2, '1', NULL),
(169, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 5000.00, 'غير خاضع للضريبة', 'سداد مخالفة / 2418568307258130', '2025-05-13', '2025-05-17 15:38:59', '2025-06-05 17:23:53', 3, '1', 'الراجحي - ابو طلال'),
(170, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة / 2418572175526420', '2025-05-13', '2025-05-17 15:42:06', '2025-06-05 17:26:25', 3, '1', 'الراجحي - ابو طلال'),
(171, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 2210.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:18:51', '2025-05-17 16:18:51', NULL, NULL, NULL),
(172, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 2720.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:20:52', '2025-05-17 16:20:52', NULL, NULL, NULL),
(173, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 2100.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:37:34', '2025-05-17 16:37:34', NULL, NULL, NULL),
(174, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 2890.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:40:46', '2025-05-17 16:40:46', NULL, NULL, NULL),
(175, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 2890.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:45:11', '2025-05-17 16:45:11', NULL, NULL, NULL),
(176, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 2890.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:56:01', '2025-05-17 16:56:01', NULL, NULL, NULL),
(177, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 2890.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:58:08', '2025-05-17 16:58:08', NULL, NULL, NULL),
(178, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 2890.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 16:59:19', '2025-05-17 16:59:19', NULL, NULL, NULL),
(179, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 3400.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 17:03:17', '2025-05-17 17:03:17', NULL, NULL, NULL),
(180, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 3400.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 17:08:01', '2025-05-17 17:08:01', NULL, NULL, NULL),
(181, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 2210.00, 'غير خاضع للضريبة', 'ستحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 17:14:21', '2025-05-17 17:14:21', NULL, NULL, NULL),
(182, 'قبض', 'موظف', 24, NULL, 'كاش', 590.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0053', '2025-05-17', '2025-05-17 17:19:08', '2025-06-05 16:24:35', NULL, '1', NULL),
(183, 'قبض', 'موظف', 44, NULL, 'كاش', 1260.00, 'غير خاضع للضريبة', 'استحقاق مركبه /0055', '2025-05-17', '2025-05-17 17:33:01', '2025-06-05 16:24:35', NULL, '1', NULL),
(184, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'سداد مخالفة /3114628432', '2025-05-17', '2025-05-17 17:35:42', '2025-06-05 16:24:35', 2, '1', NULL),
(185, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه /0056', '2025-05-17', '2025-05-17 17:38:32', '2025-06-05 16:24:35', NULL, '1', NULL),
(186, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 420.00, 'غير خاضع للضريبة', 'استحقاق تجديد الاقامة لمدة 14 يوم من تاريح 04-05-2025 الى تاريخ 17-05-2025م', '2025-05-04', '2025-05-17 17:49:50', '2025-05-17 17:49:50', 1, NULL, NULL),
(187, 'قبض', 'موظف', 20, NULL, 'كاش', 175.00, 'غير خاضع للضريبة', 'استحقاق مركبه /0057', '2025-05-17', '2025-05-17 17:50:49', '2025-06-05 16:24:35', NULL, '1', NULL),
(188, 'قبض', 'موظف', 23, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0058', '2025-05-17', '2025-05-17 17:54:24', '2025-06-05 16:24:35', NULL, '1', NULL),
(189, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 75.00, 'غير خاضع للضريبة', 'استرداد مخالفة تم اعادتها للموظف عن طريق الخطأ', '2025-05-17', '2025-05-17 18:01:51', '2025-06-05 16:24:35', 2, '1', NULL),
(190, 'قبض', 'موظف', 44, NULL, 'كاش', 75.00, 'غير خاضع للضريبة', 'سداد مخالفة مرورية رقم 3114628432', '2025-05-17', '2025-05-17 18:03:14', '2025-06-05 16:24:35', NULL, '1', NULL),
(191, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'استحاق مركبه / 0059', '2025-05-17', '2025-05-17 18:09:29', '2025-06-05 16:24:35', NULL, '1', NULL),
(192, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 2890.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:25:07', '2025-05-17 18:25:07', NULL, NULL, NULL),
(193, 'قبض', 'موظف', 19, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'استحقاق مركبة / 0060', '2025-05-17', '2025-05-17 18:34:57', '2025-06-05 16:24:35', NULL, '1', NULL),
(194, 'تحويل داخلي', 'سيارة', 28, 28, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:47:27', '2025-05-17 18:47:27', NULL, NULL, NULL),
(195, 'تحويل داخلي', 'سيارة', 16, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:49:00', '2025-05-17 18:49:00', NULL, NULL, NULL),
(196, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:51:32', '2025-05-17 18:51:32', NULL, NULL, NULL),
(197, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 3400.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:53:28', '2025-05-17 18:53:28', NULL, NULL, NULL),
(198, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 3400.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 18:58:15', '2025-05-17 18:58:15', NULL, NULL, NULL),
(199, 'تحويل داخلي', 'سيارة', 29, 5, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 19:01:07', '2025-05-17 19:01:07', NULL, NULL, NULL),
(200, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 3400.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 19:05:24', '2025-05-17 19:05:24', NULL, NULL, NULL),
(201, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق  مركبه لشهر مايو لعام 2025', '2025-05-01', '2025-05-17 19:09:01', '2025-05-17 19:09:01', NULL, NULL, NULL),
(202, 'قبض', 'موظف', 17, NULL, 'كاش', 70.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0061', '2025-05-17', '2025-05-17 19:47:40', '2025-06-05 16:24:35', NULL, '1', NULL),
(203, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0062', '2025-05-17', '2025-05-17 20:18:48', '2025-06-05 16:24:35', NULL, '1', NULL),
(204, 'تحويل داخلي', 'موظف', 23, 15, NULL, 2890.00, 'غير خاضع للضريبة', 'استرداد استحقاق المركبة الى تاريخ 17-05-2025م تم تحويله مرتين من حساب الموظف عن طريق الخطأ', '2025-05-01', '2025-05-18 15:07:25', '2025-05-18 15:07:25', NULL, NULL, NULL),
(205, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'تصريح دخول مكه', '2025-05-18', '2025-05-18 15:44:11', '2025-06-05 16:29:26', 12, '1', NULL),
(206, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 500.00, 'غير خاضع للضريبة', 'مقابل تسجيل سائق اضافي', '2025-05-01', '2025-05-18 15:46:21', '2025-05-18 15:46:21', NULL, NULL, NULL),
(207, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'خدمات / مقابل اصدار تأشيرة خروج وعودة', '2025-04-23', '2025-05-18 15:52:36', '2025-05-18 15:52:36', 8, NULL, NULL),
(208, 'تحويل داخلي', 'موظف', 8, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'استرداد مبلغ خدمات / مقابل اصدار تأشيرة خروج وعودة	تم تحويلها من حساب الموظف مرتين عن طريق الخطأ', '2025-04-23', '2025-05-18 16:00:10', '2025-05-18 16:00:10', 8, NULL, NULL),
(209, 'تحويل داخلي', 'جهة', 29, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'اصدار تصريح دخول مكه', '2025-05-01', '2025-05-18 16:06:07', '2025-05-18 16:06:07', 12, NULL, NULL),
(210, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'اصدار تصريح دخول مكه', '2025-04-29', '2025-05-18 16:41:55', '2025-05-18 16:41:55', 12, NULL, NULL),
(211, 'تحويل داخلي', 'جهة', 12, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'اصدار تصريح دخول مكه', '2025-04-29', '2025-05-18 16:51:21', '2025-05-18 16:51:21', 12, NULL, NULL),
(212, 'قبض', 'موظف', 25, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0063', '2025-05-18', '2025-05-18 18:46:48', '2025-06-05 16:29:26', NULL, '1', NULL),
(213, 'قبض', 'موظف', 20, NULL, 'كاش', 95.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0064', '2025-05-19', '2025-05-19 17:30:29', '2025-06-05 16:18:15', NULL, '1', NULL),
(214, 'قبض', 'موظف', 28, NULL, 'كاش', 50.00, 'غير خاضع للضريبة', 'سداد مستحقات /0065', '2025-05-19', '2025-05-19 20:36:11', '2025-06-05 16:18:15', NULL, '1', NULL),
(215, 'قبض', 'موظف', 20, NULL, 'كاش', 50.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0066', '2025-05-20', '2025-05-20 16:54:14', '2025-06-05 16:19:15', NULL, '1', NULL),
(216, 'قبض', 'موظف', 8, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'اصدار تصريح دخول مكه', '2025-05-20', '2025-05-20 19:12:42', '2025-06-05 16:19:15', NULL, '1', NULL),
(217, 'تحويل داخلي', 'جهة', 28, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'مقابل تصديق مشهد تملك سياره من الغرفة التجاريه', '2025-05-19', '2025-05-21 15:42:07', '2025-06-05 16:18:15', 8, '1', NULL),
(218, 'تحويل داخلي', 'موظف', 14, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استرداد استحقاق مركبه لشهر ابريل واضافة الاستحقاق على السائق الاضافي محمد جنيد', '2025-04-01', '2025-05-21 15:53:42', '2025-05-21 15:53:42', NULL, NULL, NULL),
(219, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق مركبه +استحقاق سائق اضافي', '2025-04-01', '2025-05-21 15:55:23', '2025-05-21 15:55:23', NULL, NULL, NULL),
(220, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق مركبه +استحقاق سائق اضافي لشهر مارس 2025', '2025-03-01', '2025-05-21 15:58:30', '2025-05-21 15:58:30', NULL, NULL, NULL),
(221, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 500.00, 'غير خاضع للضريبة', 'اصدار تصريح دخول (وقاص)', '2025-05-21', '2025-05-21 16:09:02', '2025-05-21 16:09:02', 12, NULL, NULL),
(222, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مارس', '2025-03-01', '2025-05-21 16:22:45', '2025-05-21 16:22:45', NULL, NULL, NULL),
(223, 'تحويل داخلي', 'موظف', 16, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استرداد استحقاق مركبه لشهر مايو / تم اضافة الاستحقاق في الحساب اخر لى نفس السائق', '2025-05-01', '2025-05-21 16:52:07', '2025-05-21 16:52:07', NULL, NULL, NULL),
(224, 'تحويل داخلي', 'موظف', 16, NULL, NULL, 1265.00, 'غير خاضع للضريبة', 'استرداد مخالفة موقف / تم اضافتها في الحساب الاخر لى الموظف', '2024-10-14', '2025-05-21 17:00:06', '2025-05-21 17:00:06', 4, NULL, NULL),
(225, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 1265.00, 'غير خاضع للضريبة', 'مخالفة موقف', '2024-10-14', '2025-05-21 17:14:10', '2025-05-21 17:14:10', 4, NULL, NULL),
(226, 'قبض', 'موظف', 20, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0068', '2025-05-21', '2025-05-21 17:33:04', '2025-05-21 17:33:04', NULL, NULL, NULL),
(227, 'تحويل داخلي', 'موظف', 26, 13, NULL, 6000.00, 'غير خاضع للضريبة', 'استرداد استحقاق مركبه / تم اضافة الاستحقاق في الحساب الاخر لى السائق', '2025-04-01', '2025-05-21 17:41:43', '2025-05-21 17:41:43', NULL, NULL, NULL),
(228, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 6000.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر ابريل', '2025-04-01', '2025-05-21 17:44:26', '2025-05-21 17:44:26', NULL, NULL, NULL),
(229, 'تحويل داخلي', 'موظف', 25, 17, NULL, 2890.00, 'غير خاضع للضريبة', 'استرداد استحقاق مركبه لشهر مايو لمدد 14 يوم', '2025-05-01', '2025-05-21 17:52:06', '2025-05-21 17:52:06', NULL, NULL, NULL),
(230, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 100.00, 'غير خاضع للضريبة', 'مقابل طباعة اقامه', '2025-04-26', '2025-05-21 17:54:41', '2025-05-21 17:54:41', 8, NULL, NULL),
(231, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 930.00, 'غير خاضع للضريبة', 'استحقاق تجديد الاقامه لشهر مايو', '2025-05-01', '2025-05-21 17:58:32', '2025-05-21 17:58:32', 1, NULL, NULL),
(232, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 4030.00, 'غير خاضع للضريبة', 'استحقاق مركبه لشهر مار س', '2025-03-01', '2025-05-21 18:13:54', '2025-05-21 18:13:54', NULL, NULL, NULL),
(233, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 2700.00, 'غير خاضع للضريبة', 'مقابل تجديد الاقامه', '2025-04-01', '2025-05-21 18:17:26', '2025-05-21 18:17:26', 1, NULL, NULL),
(234, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:40:50', '2025-06-05 16:14:11', NULL, '1', NULL),
(235, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:47:34', '2025-06-05 16:14:11', NULL, '1', NULL),
(236, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:49:35', '2025-06-05 16:14:11', NULL, '1', NULL),
(237, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:51:21', '2025-06-05 16:14:11', NULL, '1', NULL),
(238, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامه  من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:52:46', '2025-06-05 16:14:11', 1, '1', NULL),
(239, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:53:56', '2025-06-05 16:14:11', NULL, '1', NULL),
(240, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:55:21', '2025-06-05 16:14:11', NULL, '1', NULL),
(241, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:56:22', '2025-06-05 16:14:11', NULL, '1', NULL),
(242, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:57:50', '2025-06-05 16:14:11', NULL, '1', NULL),
(243, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 15:59:03', '2025-06-05 16:14:11', NULL, '1', NULL),
(244, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 16:00:22', '2025-06-05 16:14:11', NULL, '1', NULL),
(245, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 16:01:44', '2025-06-05 16:14:11', NULL, '1', NULL),
(246, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 5/18الى تاريخ 5/24', '2025-05-24', '2025-05-24 16:02:42', '2025-06-05 16:14:11', NULL, '1', NULL),
(247, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبه / 0070', '2025-05-24', '2025-05-24 16:22:46', '2025-06-05 16:14:11', NULL, '1', NULL),
(248, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0071', '2025-05-24', '2025-05-24 17:00:40', '2025-06-05 16:14:11', NULL, '1', NULL),
(249, 'قبض', 'موظف', 20, NULL, 'كاش', 175.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0072', '2025-05-24', '2025-05-24 17:15:08', '2025-06-05 16:14:11', NULL, '1', NULL),
(250, 'قبض', 'موظف', 44, NULL, 'كاش', 1100.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0073', '2025-05-24', '2025-05-24 18:07:01', '2025-06-05 16:14:11', NULL, '1', NULL),
(251, 'قبض', 'موظف', 23, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0047', '2025-05-24', '2025-05-24 18:12:33', '2025-06-05 16:14:11', NULL, '1', NULL),
(252, 'قبض', 'موظف', 19, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0075', '2025-05-24', '2025-05-24 18:31:59', '2025-06-05 16:14:11', NULL, '1', NULL),
(253, 'قبض', 'موظف', 15, NULL, 'كاش', 1300.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0067', '2025-05-24', '2025-05-24 18:33:52', '2025-06-05 16:14:11', NULL, '1', NULL),
(254, 'قبض', 'موظف', 17, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0077 +0078', '2025-05-24', '2025-05-24 20:15:34', '2025-06-05 16:14:11', NULL, '1', NULL),
(255, 'قبض', 'موظف', 24, NULL, 'كاش', 590.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0080', '2025-05-25', '2025-05-25 17:15:48', '2025-06-05 16:13:20', NULL, '1', NULL),
(256, 'قبض', 'موظف', 58, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'سداد مخالفات /0081', '2025-05-25', '2025-05-25 19:05:07', '2025-06-05 16:13:20', NULL, '1', NULL),
(257, 'قبض', 'موظف', 25, NULL, 'كاش', 500.00, 'شامل الضريبة', 'تحصيل مركبه /0082', '2025-05-25', '2025-05-25 19:08:09', '2025-06-05 16:13:20', NULL, '1', NULL),
(258, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 0.00, 'غير خاضع للضريبة', 'تجربه', '2025-05-26', '2025-05-26 07:55:35', '2025-05-26 07:55:35', 8, NULL, NULL),
(259, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 0.00, 'غير خاضع للضريبة', 'تجربه', '2025-05-26', '2025-05-26 08:00:23', '2025-05-26 08:00:23', 8, NULL, NULL),
(260, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 10793.79, 'شامل الضريبة', 'حادث مروري (رقم اللوحه ا س س 2850) اسم السائق (محمد موباسيا) رقم الحادث (MC27022516) نسبة المسؤولية (0%) من جهة المطالبات الحوادث المرورية', '2025-03-01', '2025-05-26 09:02:51', '2025-05-26 09:02:51', 14, NULL, NULL),
(261, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 5091.60, 'غير شامل الضريبة', 'حادث مروري (ا ص ح 2216)اسم السائق (فاروق احمد احمد دين )رقم الحادث (MC02032569)نسبة المسوولية (0%) من جهة المطالبات الحوداث المرورية', '2025-03-05', '2025-05-26 17:01:28', '2025-05-26 17:01:28', 14, NULL, NULL),
(262, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 2909.43, 'غير شامل الضريبة', 'حادث مروري (ا ح د 4293)اسم السائق (جعفر عبدالمومن عمر  )رقم الحادث (MD170225144)نسبة المسوولية (0%) من جهة المطالبات الحوداث المرورية', '2025-03-24', '2025-05-26 17:05:42', '2025-05-26 17:05:42', 14, NULL, NULL),
(263, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 8810.80, 'غير شامل الضريبة', 'حادث مروري (ا ر ك 8726)اسم السائق (سعيد احمد )رقم الحادث (MD15122473)نسبة المسوولية (0%) من جهة المطالبات الحوداث المرورية', '2024-12-18', '2025-05-26 17:09:39', '2025-05-26 17:09:39', 14, NULL, NULL),
(264, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 8810.80, 'غير شامل الضريبة', 'حادث مروري (ا ر ك 8726)اسم السائق (سعيد احمد )رقم الحادث (MD15122473)نسبة المسوولية (0%) من جهة المطالبات الحوداث المرورية', '2024-12-18', '2025-05-26 17:09:39', '2025-05-26 17:09:39', 14, NULL, NULL),
(265, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 8810.80, 'غير شامل الضريبة', 'استردات حادث مروري (ا ر ك 8726)اسم السائق (سعيد احمد )رقم الحادث (MD15122473)نسبة المسوولية (0%) من جهة وسيط الحوادث المرويه', '2024-12-18', '2025-05-26 17:21:09', '2025-05-26 17:21:09', 13, NULL, NULL),
(266, 'قبض', 'موظف', 25, NULL, 'كاش', 510.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0083', '2025-05-28', '2025-05-28 16:12:22', '2025-06-05 16:11:49', NULL, '1', NULL);
INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(267, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 5000.00, 'غير خاضع للضريبة', 'سداد مخالفة /2514801786536255', '2025-05-27', '2025-05-28 17:58:04', '2025-06-05 17:25:56', 3, NULL, 'الراجحي - ابو طلال'),
(268, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 2000.00, 'غير خاضع للضريبة', 'سداد مخالفة /2514894561182216', '2025-05-27', '2025-05-28 17:59:17', '2025-06-05 17:28:09', 3, NULL, 'الراجحي - ابو طلال'),
(269, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'سداد مخالفة / 2515883973779120', '2025-05-27', '2025-05-28 18:00:35', '2025-06-05 17:28:40', 3, NULL, 'الراجحي - ابو طلال'),
(270, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 500.00, 'غير خاضع للضريبة', 'سداد المخالفة / 2512834740297115', '2025-05-27', '2025-05-28 18:01:25', '2025-06-05 17:29:40', 3, NULL, 'الراجحي - ابو طلال'),
(271, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 2000.00, 'غير خاضع للضريبة', 'سداد المخالفة / 2513863477785172', '2025-05-27', '2025-05-28 18:02:24', '2025-06-05 17:29:10', 3, NULL, 'الراجحي - ابو طلال'),
(272, 'قبض', 'موظف', 3, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة هيئه النقل تم دفعه بتاريخ 28/5/2025 م', '2025-03-30', '2025-05-28 18:35:32', '2025-05-28 18:35:32', NULL, NULL, NULL),
(273, 'قبض', 'موظف', 3, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'سداد مخالفة هيئه النقل تم دفعه بتاريخ 28/5/2025 م', '2025-04-30', '2025-05-28 18:39:01', '2025-05-28 18:39:01', NULL, NULL, NULL),
(274, 'قبض', 'موظف', 23, NULL, 'كاش', 1140.00, 'غير خاضع للضريبة', 'تحصيل مركبة /0085', '2025-05-31', '2025-05-31 15:56:13', '2025-06-05 16:11:20', NULL, '1', NULL),
(275, 'قبض', 'موظف', 23, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'تحصيل مركبة /0086', '2025-05-31', '2025-05-31 15:59:02', '2025-06-05 16:11:20', NULL, '1', NULL),
(276, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبه من تاريخ 25-05-2025 الى تاريخ31-05-2025', '2025-05-31', '2025-05-31 16:25:19', '2025-06-05 16:11:20', NULL, '1', NULL),
(277, 'صرف', 'موظف', 23, NULL, 'كاش', 240.00, 'غير خاضع للضريبة', 'خصم 240 ريال من شهر مايو و اضافتها في شهر ابريل', '2025-05-03', '2025-05-31 16:33:06', '2025-05-31 16:33:06', NULL, NULL, NULL),
(278, 'قبض', 'موظف', 23, NULL, 'كاش', 240.00, 'غير خاضع للضريبة', 'اضافة  240 ريال تم خصمها من شهر مايو', '2025-04-30', '2025-05-31 16:34:37', '2025-05-31 16:34:37', NULL, NULL, NULL),
(279, 'قبض', 'موظف', 25, NULL, 'كاش', 900.00, 'غير خاضع للضريبة', 'تحصيل مركبه / 0087', '2025-05-31', '2025-05-31 17:27:27', '2025-06-05 16:11:20', NULL, '1', NULL),
(280, 'قبض', 'موظف', 44, NULL, 'كاش', 1150.00, 'غير خاضع للضريبة', 'تحصيل مركبة/0088', '2025-05-31', '2025-05-31 18:03:00', '2025-06-05 16:11:20', NULL, '1', NULL),
(281, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحاق مركبه من 5/25 الى 5/31', '2025-05-31', '2025-05-31 18:11:42', '2025-06-05 16:11:20', NULL, '1', NULL),
(282, 'صرف', 'موظف', 25, NULL, 'كاش', 190.00, 'غير خاضع للضريبة', 'خصم استحقاق مركبه من شهر مايو واضافته في شهر ابريل', '2025-05-03', '2025-05-31 18:16:01', '2025-05-31 18:16:01', NULL, NULL, NULL),
(283, 'قبض', 'موظف', 25, NULL, 'كاش', 190.00, 'غير خاضع للضريبة', 'اضافة استحقاق مركبه تم خصم من مايو', '2025-04-30', '2025-05-31 18:17:45', '2025-05-31 18:17:45', NULL, NULL, NULL),
(284, 'قبض', 'موظف', 27, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0089', '2025-05-31', '2025-05-31 18:30:44', '2025-06-05 16:11:20', NULL, '1', NULL),
(285, 'قبض', 'موظف', 28, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبة /0089', '2025-05-31', '2025-05-31 18:32:31', '2025-06-05 16:11:20', NULL, '1', NULL),
(286, 'قبض', 'موظف', 15, NULL, 'كاش', 1500.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0090', '2025-05-31', '2025-05-31 18:39:11', '2025-06-05 16:11:20', NULL, '1', NULL),
(287, 'قبض', 'موظف', 19, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0091', '2025-05-31', '2025-05-31 18:42:23', '2025-06-05 16:11:20', NULL, '1', NULL),
(288, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0092', '2025-05-31', '2025-05-31 19:42:15', '2025-06-05 16:11:20', NULL, '1', NULL),
(289, 'قبض', 'موظف', 24, NULL, 'كاش', 870.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0093', '2025-05-31', '2025-05-31 19:48:43', '2025-06-05 16:11:20', NULL, '1', NULL),
(290, 'قبض', 'موظف', 17, NULL, 'كاش', 400.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0049', '2025-05-31', '2025-06-01 14:25:08', '2025-06-05 16:11:20', NULL, '1', NULL),
(291, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0095    \r\nتم دفعه تاريخ م 6/1/', '2025-05-31', '2025-06-01 17:14:18', '2025-06-05 16:11:20', NULL, '1', NULL),
(292, 'قبض', 'موظف', 21, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0095', '2025-06-01', '2025-06-01 17:15:21', '2025-06-05 16:10:32', NULL, '1', NULL),
(293, 'قبض', 'موظف', 29, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0096 تم دفعه تاريخ م 6/1/', '2025-05-31', '2025-06-01 18:45:38', '2025-06-05 16:11:20', NULL, '1', NULL),
(294, 'قبض', 'موظف', 59, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'خدمات', '2025-06-04', '2025-06-04 07:41:27', '2025-06-05 16:00:48', NULL, '1', NULL),
(295, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-02', '2025-06-05 19:08:29', '2025-06-21 18:50:27', 6, '1', 'شركة الجواب - بنك الرياض'),
(296, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.33, 'غير خاضع للضريبة', 'عموله بنكيه لى جهاز رقم مبلغ البيع 14.62', '2025-06-02', '2025-06-05 19:16:54', '2025-06-21 07:33:49', 8, '1', 'الراجحي - ابو احمد'),
(297, 'صرف', 'جهة', NULL, NULL, 'كاش', 0.05, 'غير خاضع للضريبة', 'ضريبه عموله بنكيه لى جهاز رقم مبلغ البيع 14.62 - ومبلغ العموله 0.33', '2025-06-02', '2025-06-05 19:22:16', '2025-06-07 20:33:38', 5, '1', NULL),
(298, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-06', '2025-06-07 14:26:44', '2025-06-21 18:49:53', 6, '1', 'شركة الجواب - بنك الرياض'),
(299, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-06', '2025-06-07 14:28:46', '2025-06-21 18:51:00', 6, '1', 'شركة الجواب - بنك الرياض'),
(300, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-06', '2025-06-07 14:30:52', '2025-06-21 18:56:00', 6, '1', 'شركة الجواب - بنك الرياض'),
(301, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-05', '2025-06-07 14:33:22', '2025-06-21 18:56:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(302, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.10, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-05', '2025-06-07 14:38:03', '2025-06-21 07:40:47', 8, NULL, 'الراجحي - ابو احمد'),
(303, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.10, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-06-05', '2025-06-07 14:40:46', '2025-06-21 07:35:59', 8, NULL, 'الراجحي - ابو احمد'),
(304, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.01, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره  0.10', '2025-06-05', '2025-06-07 14:45:05', '2025-06-21 07:36:08', 5, NULL, 'الراجحي - ابو احمد'),
(305, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.33, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733547', '2025-06-02', '2025-06-07 14:53:07', '2025-06-21 07:41:01', 8, '1', 'الراجحي - ابو احمد'),
(306, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-04', '2025-06-07 15:02:06', '2025-06-21 18:57:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(307, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.33, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-04', '2025-06-07 15:05:40', '2025-06-21 07:41:10', 8, NULL, 'الراجحي - ابو احمد'),
(308, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.33, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-04', '2025-06-07 15:07:41', '2025-06-21 07:36:19', 8, NULL, 'الراجحي - ابو احمد'),
(309, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.05, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره  0.33', '2025-06-04', '2025-06-07 15:10:32', '2025-06-21 07:36:28', 5, NULL, 'الراجحي - ابو احمد'),
(310, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-04', '2025-06-07 15:14:18', '2025-06-21 18:51:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(311, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.55, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733547', '2025-06-04', '2025-06-07 15:17:29', '2025-06-21 07:41:24', 8, NULL, 'الراجحي - ابو احمد'),
(312, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.55, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733547', '2025-06-04', '2025-06-07 15:19:50', '2025-06-21 07:36:37', 8, NULL, 'الراجحي - ابو احمد'),
(313, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.08, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733547 بمبلغ وقدره 0.55', '2025-06-04', '2025-06-07 15:22:36', '2025-06-21 07:36:46', 5, NULL, 'الراجحي - ابو احمد'),
(314, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733548 نبيل', '2025-06-04', '2025-06-07 15:25:13', '2025-06-21 19:02:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(315, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733548', '2025-06-04', '2025-06-07 15:27:56', '2025-06-21 07:41:32', 8, NULL, 'الراجحي - ابو احمد'),
(316, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733548', '2025-06-04', '2025-06-07 15:30:02', '2025-06-21 07:36:59', 8, NULL, 'الراجحي - ابو احمد'),
(317, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.01, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733548 بمبلغ وقدره 0.07', '2025-06-04', '2025-06-07 15:32:47', '2025-06-21 07:37:08', 5, NULL, 'الراجحي - ابو احمد'),
(318, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 18.86, 'غير خاضع للضريبة', '11733548 نبيل', '2025-06-03', '2025-06-07 15:37:40', '2025-06-21 19:03:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(319, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.12, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733548', '2025-06-03', '2025-06-07 15:39:41', '2025-06-21 07:42:41', 8, NULL, 'الراجحي - ابو احمد'),
(320, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.12, 'غير خاضع للضريبة', 'صرف عمولة بنكية للجهاز رقم 11733548', '2025-06-03', '2025-06-07 15:42:07', '2025-06-21 07:37:20', 8, NULL, 'الراجحي - ابو احمد'),
(321, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.02, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733548 بمبلغ وقدره 0.12', '2025-06-03', '2025-06-07 15:44:43', '2025-06-21 07:37:32', 5, NULL, 'الراجحي - ابو احمد'),
(322, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 94.29, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-02', '2025-06-07 15:46:59', '2025-06-21 18:57:48', 6, '1', 'شركة الجواب - بنك الرياض'),
(323, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.62, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-02', '2025-06-07 15:49:21', '2025-06-21 07:42:29', 8, '1', 'الراجحي - ابو احمد'),
(324, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.62, 'غير خاضع للضريبة', 'صرف عمولة بنكية للجهاز رقم 11733543', '2025-06-02', '2025-06-07 15:52:21', '2025-06-21 07:35:36', 8, '1', 'الراجحي - ابو احمد'),
(325, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.09, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره 0.62', '2025-06-02', '2025-06-07 15:54:23', '2025-06-21 07:37:52', 5, '1', 'الراجحي - ابو احمد'),
(326, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 16:32:33', '2025-06-07 20:00:08', NULL, '1', NULL),
(327, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق شهر (6) 1000 مقابل السيارة + 500 سائق اضافي', '2025-06-01', '2025-06-07 16:36:03', '2025-06-07 16:36:03', NULL, NULL, NULL),
(328, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحاق مركبة لشهر ( 6 )', '2025-06-01', '2025-06-07 16:39:22', '2025-06-07 16:39:22', NULL, NULL, NULL),
(329, 'تحويل داخلي', 'سيارة', 29, 5, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة لشهر (6)', '2025-06-01', '2025-06-07 16:41:47', '2025-06-07 16:41:47', NULL, NULL, NULL),
(330, 'تحويل داخلي', 'سيارة', 28, 28, NULL, 1000.00, 'غير خاضع للضريبة', 'استحاق مركبة لشهر (6)', '2025-06-01', '2025-06-07 16:44:42', '2025-06-07 16:44:42', NULL, NULL, NULL),
(331, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 16:46:55', '2025-06-07 20:00:08', NULL, '1', NULL),
(332, 'تحويل داخلي', 'سيارة', 27, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة لشهر (6)', '2025-06-01', '2025-06-07 16:50:22', '2025-06-07 16:50:22', NULL, NULL, NULL),
(333, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:18:57', '2025-06-07 20:00:08', NULL, '1', NULL),
(334, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:21:50', '2025-06-07 20:00:08', NULL, '1', NULL),
(335, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:23:57', '2025-06-07 20:00:08', NULL, '1', NULL),
(336, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:26:18', '2025-06-07 20:00:08', NULL, '1', NULL),
(337, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:28:10', '2025-06-07 20:00:08', NULL, '1', NULL),
(338, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:29:50', '2025-06-07 20:00:08', NULL, '1', NULL),
(339, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:31:37', '2025-06-07 20:00:08', NULL, '1', NULL),
(340, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:34:36', '2025-06-07 20:00:08', 1, '1', NULL),
(341, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:37:31', '2025-06-07 20:00:08', NULL, '1', NULL),
(342, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:43:34', '2025-06-07 20:00:08', NULL, '1', NULL),
(343, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:45:41', '2025-06-07 20:00:08', NULL, '1', NULL),
(344, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 17:47:42', '2025-06-07 20:00:08', NULL, '1', NULL),
(345, 'تحويل داخلي', 'جهة', 21, NULL, NULL, 15.00, 'غير خاضع للضريبة', 'رسوم حجز موعد للفحص الدوري', '2025-06-07', '2025-06-07 17:50:39', '2025-06-07 20:00:08', 8, '1', NULL),
(346, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 15.00, 'غير خاضع للضريبة', 'رسوم حجز موعد للفحص الدوري', '2025-06-07', '2025-06-07 17:52:31', '2025-06-07 20:00:08', 8, '1', NULL),
(347, 'قبض', 'موظف', 7, NULL, 'كاش', 1010.00, 'شامل الضريبة', 'تحصيل مركبه /0091', '2025-06-07', '2025-06-07 18:10:47', '2025-06-07 20:00:08', NULL, '1', NULL),
(348, 'قبض', 'موظف', 23, NULL, 'كاش', 1200.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0098', '2025-06-07', '2025-06-07 18:11:51', '2025-06-07 20:00:08', NULL, '1', NULL),
(349, 'قبض', 'موظف', 19, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'تحصيل مركبه /0099', '2025-06-07', '2025-06-07 18:12:48', '2025-06-07 20:00:08', NULL, '1', NULL),
(350, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 188.57, 'غير خاضع للضريبة', 'ايرادات نقاط البيع من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 18:21:02', '2025-06-07 20:00:08', 6, '1', NULL),
(351, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 28.28, 'غير خاضع للضريبة', 'ضريبة الدخل لنقاط البيع بمبلغ 188.57 من تاريخ 1/6/2025 الى تاريخ7/6/2025', '2025-06-07', '2025-06-07 18:25:12', '2025-06-07 20:00:08', 5, '1', NULL),
(352, 'صرف', 'موظف', 62, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'جزء من راتب شهر مايو / 2025', '2025-06-07', '2025-06-07 19:57:42', '2025-06-07 20:00:08', NULL, '1', NULL),
(353, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.05, 'غير خاضع للضريبة', 'ضريبه عموله بنكيه لى جهاز رقم مبلغ البيع 14.62 - ومبلغ العموله 0.33', '2025-06-02', '2025-06-07 20:27:05', '2025-06-21 07:38:04', 5, '1', 'الراجحي - ابو احمد'),
(354, 'قبض', 'جهة', NULL, NULL, 'كاش', 0.05, 'غير خاضع للضريبة', 'اعادة ضريبه عموله بنكيه لى جهاز رقم مبلغ البيع 14.62 - ومبلغ العموله 0.33 تم صرفه عن طريق الخطأ', '2025-06-02', '2025-06-07 20:32:33', '2025-06-07 20:33:38', 5, '1', NULL),
(355, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.31, 'غير خاضع للضريبة', 'تسوية ايرادات نقاط البيع من تاريخ 1/6/2025 الى تاريخ 7/6/2025 لمطابقة الحساب', '2025-06-07', '2025-06-07 20:36:45', '2025-06-21 16:28:12', 8, '1', 'الراجحي - ابو احمد'),
(356, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 28.78, 'غير خاضع للضريبة', 'ايرادات نقاط البيع من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 20:55:44', '2025-06-07 21:02:40', 6, '1', NULL),
(357, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 4.31, 'غير خاضع للضريبة', 'ضريبة الدخل لنقاط البيع بمبلغ 28.78 من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-07 20:59:49', '2025-06-07 21:02:40', 5, '1', NULL),
(358, 'قبض', 'موظف', 17, NULL, 'كاش', 350.00, 'غير خاضع للضريبة', 'تحصيل مركبة', '2025-06-07', '2025-06-07 21:02:07', '2025-06-07 21:02:40', NULL, '1', NULL),
(359, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733553', '2025-05-30', '2025-06-08 12:37:24', '2025-07-06 06:25:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(360, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.20, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733553', '2025-06-08', '2025-06-08 12:39:57', '2025-06-21 07:42:14', 8, NULL, 'الراجحي - ابو احمد'),
(361, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.20, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733553', '2025-06-08', '2025-06-08 12:47:52', '2025-06-21 07:38:14', 8, NULL, 'الراجحي - ابو احمد'),
(362, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.03, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733553 بمبلغ وقدره 0.20', '2025-06-08', '2025-06-08 12:50:16', '2025-06-21 07:38:38', 5, NULL, 'الراجحي - ابو احمد'),
(363, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733553', '2025-05-30', '2025-06-08 13:35:16', '2025-06-08 13:35:16', 6, NULL, NULL),
(364, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.66, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز 11733553', '2025-05-30', '2025-06-08 13:36:49', '2025-06-08 13:36:49', 8, NULL, NULL),
(365, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.66, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733553', '2025-05-30', '2025-06-08 13:38:09', '2025-06-08 13:38:09', 8, NULL, NULL),
(366, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.10, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733553 بمبلغ وقدره 0.66', '2025-05-30', '2025-06-08 13:40:16', '2025-06-08 13:40:16', 5, NULL, NULL),
(367, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548', '2025-05-31', '2025-06-08 13:45:14', '2025-06-08 13:45:14', 6, NULL, NULL),
(368, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733548', '2025-05-31', '2025-06-08 13:47:02', '2025-06-08 13:47:02', 8, NULL, NULL),
(369, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733548', '2025-05-31', '2025-06-08 13:48:39', '2025-06-08 13:48:39', 8, NULL, NULL),
(370, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.02, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733548 بمبلغ وقدره 0.13', '2025-05-31', '2025-06-08 13:50:39', '2025-06-08 13:50:39', 5, NULL, NULL),
(371, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548', '2025-05-30', '2025-06-08 13:54:49', '2025-06-08 13:54:49', 6, NULL, NULL),
(372, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733548', '2025-05-30', '2025-06-08 13:56:31', '2025-06-08 13:56:31', 8, NULL, NULL),
(373, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733548', '2025-05-30', '2025-06-08 13:58:04', '2025-06-08 13:58:04', 8, NULL, NULL),
(374, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.02, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733548 بمبلغ وقدره 0.13', '2025-05-30', '2025-06-08 14:00:02', '2025-06-08 14:00:02', 5, NULL, NULL),
(375, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733547', '2025-05-31', '2025-06-08 14:02:53', '2025-06-08 14:02:53', 6, NULL, NULL),
(376, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.44, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733547', '2025-05-31', '2025-06-08 14:04:20', '2025-06-08 14:04:20', 8, NULL, NULL),
(377, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.44, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733547', '2025-05-31', '2025-06-08 14:06:07', '2025-06-08 14:06:07', 8, NULL, NULL),
(378, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733547 بمبلغ وقدره 0.44', '2025-05-31', '2025-06-08 14:08:09', '2025-06-08 14:08:09', 5, NULL, NULL),
(379, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733543', '2025-05-31', '2025-06-08 14:14:21', '2025-06-08 14:14:21', 6, NULL, NULL),
(380, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-05-31', '2025-06-08 14:16:02', '2025-06-08 14:16:02', 8, NULL, NULL),
(381, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-05-31', '2025-06-08 14:17:30', '2025-06-08 14:17:30', 8, NULL, NULL),
(382, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.01, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره 0.07', '2025-05-31', '2025-06-08 14:19:31', '2025-06-08 14:19:31', 5, NULL, NULL),
(383, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733543', '2025-05-26', '2025-06-08 14:22:37', '2025-06-08 14:22:37', 6, NULL, NULL),
(384, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.66, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-05-26', '2025-06-08 14:24:16', '2025-06-08 14:24:16', 8, NULL, NULL),
(385, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.66, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-05-26', '2025-06-08 14:26:10', '2025-06-08 14:26:10', 8, NULL, NULL),
(386, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.10, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره 0.66', '2025-05-26', '2025-06-08 14:28:04', '2025-06-08 14:28:04', 5, NULL, NULL),
(387, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543', '2025-05-26', '2025-06-08 14:31:10', '2025-06-08 14:31:10', 6, NULL, NULL),
(388, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-05-26', '2025-06-08 14:32:23', '2025-06-08 14:32:23', 8, NULL, NULL),
(389, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-05-26', '2025-06-08 14:34:05', '2025-06-08 14:34:05', 8, NULL, NULL),
(390, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.02, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره 0.13', '2025-05-26', '2025-06-08 14:35:50', '2025-06-08 14:35:50', 5, NULL, NULL),
(391, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 56.57, 'غير خاضع للضريبة', '11733558', '2025-05-25', '2025-06-08 14:40:34', '2025-06-08 14:40:34', 6, NULL, NULL),
(392, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.37, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733558', '2025-05-25', '2025-06-08 14:42:11', '2025-06-08 14:42:11', 8, NULL, NULL),
(393, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.37, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733558', '2025-05-25', '2025-06-08 14:43:42', '2025-06-08 14:43:42', 8, NULL, NULL),
(394, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.06, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733558 بمبلغ وقدره 0.37', '2025-05-25', '2025-06-08 14:45:25', '2025-06-08 14:45:25', 5, NULL, NULL),
(395, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733550', '2025-05-25', '2025-06-08 14:53:35', '2025-06-08 14:53:35', 6, NULL, NULL),
(396, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.20, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733550', '2025-05-25', '2025-06-08 14:55:40', '2025-06-08 14:55:40', 8, NULL, NULL),
(397, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.20, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733550', '2025-05-25', '2025-06-08 15:10:19', '2025-06-08 15:10:19', 8, NULL, NULL),
(398, 'قبض', 'موظف', 21, NULL, 'كاش', 1300.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-08', '2025-06-08 15:11:16', '2025-06-08 15:11:16', NULL, NULL, NULL),
(399, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-08', '2025-06-08 17:26:19', '2025-06-08 17:26:19', NULL, NULL, NULL),
(400, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.03, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733550 بمبلغ وقدره 0.20', '2025-05-25', '2025-06-08 17:28:02', '2025-06-08 17:28:02', 5, NULL, NULL),
(401, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.99, 'غير خاضع للضريبة', '11733560', '2025-05-25', '2025-06-08 17:31:02', '2025-06-08 17:31:02', 6, NULL, NULL),
(402, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.03, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733560', '2025-05-25', '2025-06-08 17:32:40', '2025-06-08 17:32:40', 8, NULL, NULL),
(403, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.03, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733560', '2025-05-25', '2025-06-08 17:34:04', '2025-06-08 17:34:04', 8, NULL, NULL),
(404, 'قبض', 'موظف', 44, NULL, 'كاش', 1100.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-08', '2025-06-08 17:40:38', '2025-06-08 17:40:38', NULL, NULL, NULL),
(405, 'تحويل داخلي', 'جهة', 60, NULL, NULL, 3345.84, 'غير خاضع للضريبة', 'مطالبة حادث مروري للسائق جعفر عبدالمؤمن تم تقديم المطالبة بتاريخ 30/4/2025', '2025-04-30', '2025-06-08 17:43:00', '2025-06-08 17:43:00', 15, NULL, NULL),
(406, 'تحويل داخلي', 'جهة', 60, NULL, NULL, 10132.42, 'غير خاضع للضريبة', 'مطالبة حادث للسائق سعيد رازا بتاريخ 18/12/2024', '2025-04-30', '2025-06-08 17:46:11', '2025-06-08 17:46:11', 15, NULL, NULL),
(407, 'قبض', 'موظف', 25, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-08', '2025-06-08 17:48:22', '2025-06-08 17:48:22', NULL, NULL, NULL),
(408, 'تحويل داخلي', 'جهة', 61, NULL, NULL, 10793.79, 'غير خاضع للضريبة', 'مطالبة حادث للسائق محمد موباسيا بتاريخ 1/3/2025', '2025-03-01', '2025-06-08 17:48:22', '2025-06-08 17:48:22', 15, NULL, NULL),
(409, 'قبض', 'موظف', 24, NULL, 'كاش', 460.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-09', '2025-06-09 07:27:33', '2025-06-09 07:27:33', NULL, NULL, NULL),
(410, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 98.10, 'غير خاضع للضريبة', 'ايرادات نقاط البيع من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-09 07:50:50', '2025-06-09 07:50:50', 6, NULL, NULL),
(411, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 14.71, 'غير خاضع للضريبة', 'ضريبة الدخل لنقاط البيع بمبلغ 98.1 من تاريخ 1/6/2025 الى تاريخ 7/6/2025', '2025-06-07', '2025-06-09 07:53:27', '2025-06-09 07:53:27', 5, NULL, NULL),
(412, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-07', '2025-06-09 08:09:34', '2025-06-21 18:55:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(413, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.49, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-07', '2025-06-09 08:12:11', '2025-06-21 07:42:02', 8, NULL, 'الراجحي - ابو احمد'),
(414, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.49, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-06-07', '2025-06-09 08:13:41', '2025-06-21 07:38:48', 8, NULL, 'الراجحي - ابو احمد'),
(415, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.07, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 بمبلغ وقدره 0.49', '2025-06-07', '2025-06-09 08:15:31', '2025-06-21 07:38:57', 5, NULL, 'الراجحي - ابو احمد'),
(416, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733553 محمد رشد', '2025-06-07', '2025-06-09 08:17:06', '2025-06-21 19:05:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(417, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 1.32, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733553', '2025-06-07', '2025-06-09 08:18:32', '2025-06-21 07:43:33', 8, NULL, 'الراجحي - ابو احمد'),
(418, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 1.32, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733553', '2025-06-07', '2025-06-09 08:20:21', '2025-06-21 07:39:08', 8, NULL, 'الراجحي - ابو احمد'),
(419, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.20, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733553 بمباغ وقدره 1.32', '2025-06-07', '2025-06-09 08:22:14', '2025-06-21 07:39:19', 5, NULL, 'الراجحي - ابو احمد'),
(420, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 57.56, 'غير خاضع للضريبة', '11733553 محمد رشد', '2025-06-07', '2025-06-09 08:23:42', '2025-06-21 19:05:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(421, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.38, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733553', '2025-06-07', '2025-06-09 08:25:12', '2025-06-21 07:43:19', 8, NULL, 'الراجحي - ابو احمد'),
(422, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.38, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733553', '2025-06-07', '2025-06-09 08:26:36', '2025-06-21 07:39:32', 8, NULL, 'الراجحي - ابو احمد'),
(423, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.06, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733553 بمبلغ وقدره 0.38', '2025-06-07', '2025-06-09 08:28:51', '2025-06-21 07:39:41', 5, NULL, 'الراجحي - ابو احمد'),
(424, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-07', '2025-06-09 08:30:13', '2025-06-21 18:58:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(425, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.77, 'غير خاضع للضريبة', 'عمولة بنكية للجهاز رقم 11733543', '2025-06-07', '2025-06-09 08:31:37', '2025-06-21 07:43:09', 8, NULL, 'الراجحي - ابو احمد'),
(426, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.77, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733543', '2025-06-07', '2025-06-09 08:33:16', '2025-06-21 07:39:52', 8, NULL, 'الراجحي - ابو احمد'),
(427, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.12, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733543 يمبلغ وقدره 0.77', '2025-06-07', '2025-06-09 08:35:06', '2025-06-21 07:40:02', 5, NULL, 'الراجحي - ابو احمد'),
(428, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548 نبيل', '2025-06-07', '2025-06-09 08:38:26', '2025-06-21 19:03:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(429, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'عمولو بنكية للجهاز رقم 11733548', '2025-06-07', '2025-06-09 08:40:19', '2025-06-21 07:43:00', 8, NULL, 'الراجحي - ابو احمد'),
(430, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.13, 'غير خاضع للضريبة', 'خصم عمولة بنكية للجهاز رقم 11733548', '2025-06-07', '2025-06-09 08:41:42', '2025-06-21 07:40:17', 8, NULL, 'الراجحي - ابو احمد'),
(431, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 0.02, 'غير خاضع للضريبة', 'صرف ضريبة العمولة البنكية للجهاز رقم 11733548 بمبلغ وقدره 0.13', '2025-06-07', '2025-06-09 08:43:47', '2025-06-21 07:40:26', 5, NULL, 'الراجحي - ابو احمد'),
(432, 'صرف', 'موظف', 1, NULL, 'تحويل بنكي', 276.13, 'غير خاضع للضريبة', 'مستحقات', '2025-05-25', '2025-06-09 08:55:18', '2025-06-09 08:55:18', NULL, NULL, NULL),
(433, 'قبض', 'موظف', 29, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل مركبه تم دفعه 09/06', '2025-04-30', '2025-06-09 18:56:45', '2025-06-09 18:56:45', NULL, NULL, NULL),
(434, 'قبض', 'موظف', 60, NULL, 'تحويل بنكي', 2909.43, 'غير خاضع للضريبة', 'تعويض حادث مروري', '2025-05-30', '2025-06-10 11:16:17', '2025-06-10 11:16:17', NULL, NULL, NULL),
(435, 'قبض', 'موظف', 3, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-05-31', '2025-06-10 11:28:50', '2025-06-10 11:40:38', NULL, NULL, 'مؤسسة الجواب - بنك الراجحي'),
(436, 'قبض', 'موظف', 11, NULL, 'تحويل بنكي', 600.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-04-30', '2025-06-10 11:29:59', '2025-06-10 11:42:55', NULL, NULL, 'مؤسسة الجواب - بنك الراجحي'),
(437, 'صرف', 'موظف', 58, NULL, 'تحويل بنكي', 700.00, 'غير خاضع للضريبة', 'الغاء طلب واسترجاع مبلغ بتاريخ 09-06-2025', '2025-05-31', '2025-06-10 11:31:30', '2025-06-25 18:41:12', NULL, NULL, 'الراجحي - ابو طلال'),
(438, 'قبض', 'موظف', 8, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'تحصيل كركبه', '2025-03-31', '2025-06-10 11:33:40', '2025-06-10 11:42:04', NULL, NULL, 'مؤسسة الجواب - بنك الراجحي'),
(439, 'قبض', 'موظف', 17, NULL, 'كاش', 60.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-10', '2025-06-10 17:30:18', '2025-06-11 07:27:39', NULL, '1', NULL),
(440, 'قبض', 'موظف', 3, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه تم دفعه بتاريخ 11/6/2025', '2025-04-30', '2025-06-12 17:05:18', '2025-06-12 17:05:18', NULL, NULL, NULL),
(441, 'قبض', 'موظف', 3, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'اصدار تصريح', '2025-06-12', '2025-06-12 17:10:52', '2025-06-12 17:10:52', NULL, NULL, NULL),
(442, 'قبض', 'موظف', 25, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل ماتبقى من استحقاق الدفعه اولى  190 ريال +210 تجديد اقامه  + تجديد بطاقة سائق تم دفع 100 ومتبقي 50', '2025-06-12', '2025-06-12 18:19:29', '2025-06-12 18:19:29', NULL, NULL, NULL),
(443, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:19:07', '2025-06-14 14:19:07', NULL, NULL, NULL),
(444, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:21:13', '2025-06-14 14:21:13', NULL, NULL, NULL),
(445, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:22:02', '2025-06-14 14:22:02', NULL, NULL, NULL),
(446, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:22:45', '2025-06-14 14:22:45', NULL, NULL, NULL),
(447, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:23:34', '2025-06-14 14:23:34', NULL, NULL, NULL),
(448, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:26:17', '2025-06-14 14:26:17', 1, NULL, NULL),
(449, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:27:12', '2025-06-14 14:27:12', NULL, NULL, NULL),
(450, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:28:27', '2025-06-14 14:28:27', NULL, NULL, NULL),
(451, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:29:14', '2025-06-14 14:29:14', NULL, NULL, NULL),
(452, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من اريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:30:06', '2025-06-14 14:30:06', 1, NULL, NULL),
(453, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:30:41', '2025-06-14 14:30:41', NULL, NULL, NULL),
(454, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:31:36', '2025-06-14 14:31:36', NULL, NULL, NULL),
(455, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:32:44', '2025-06-14 14:32:44', NULL, NULL, NULL),
(456, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:33:28', '2025-06-14 14:33:28', NULL, NULL, NULL),
(457, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 8/6/2025 الى تاريخ 14/6/2025', '2025-06-14', '2025-06-14 14:34:03', '2025-06-14 14:34:03', NULL, NULL, NULL),
(458, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 16:28:20', '2025-06-14 16:28:20', NULL, NULL, NULL),
(459, 'قبض', 'موظف', 24, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 17:33:32', '2025-06-14 17:33:32', NULL, NULL, NULL),
(460, 'قبض', 'موظف', 19, NULL, 'كاش', 825.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 17:42:13', '2025-06-14 17:42:13', NULL, NULL, NULL),
(461, 'قبض', 'موظف', 20, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 18:04:01', '2025-06-14 18:04:01', NULL, NULL, NULL),
(462, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 18:29:56', '2025-06-14 18:29:56', NULL, NULL, NULL),
(463, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-14', '2025-06-14 19:31:54', '2025-06-14 19:31:54', NULL, NULL, NULL),
(464, 'صرف', 'موظف', 50, NULL, 'كاش', 850.00, 'غير خاضع للضريبة', 'صرف راتب', '2025-06-14', '2025-06-14 21:12:38', '2025-06-14 21:12:38', NULL, NULL, NULL),
(465, 'صرف', 'موظف', 52, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'صرف راتب', '2025-06-14', '2025-06-14 21:13:19', '2025-06-14 21:13:19', NULL, NULL, NULL),
(466, 'صرف', 'موظف', 62, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'صرف راتب', '2025-06-14', '2025-06-14 21:14:09', '2025-06-14 21:14:09', NULL, NULL, NULL),
(467, 'صرف', 'جهة', NULL, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'صرف ابو طلال', '2025-06-14', '2025-06-14 21:15:15', '2025-06-14 21:15:15', 8, NULL, NULL),
(468, 'قبض', 'موظف', 44, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-17', '2025-06-17 19:04:51', '2025-06-17 19:04:51', NULL, NULL, NULL),
(469, 'قبض', 'موظف', 17, NULL, 'كاش', 120.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-18', '2025-06-18 18:21:50', '2025-06-18 18:21:50', NULL, NULL, NULL),
(470, 'قبض', 'موظف', 20, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-19', '2025-06-19 17:42:48', '2025-06-19 17:42:48', NULL, NULL, NULL),
(471, 'قبض', 'موظف', 25, NULL, 'كاش', 550.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-19', '2025-06-19 18:55:24', '2025-06-19 18:55:24', NULL, NULL, NULL),
(472, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:37:44', '2025-06-21 08:37:44', NULL, NULL, NULL),
(473, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:38:25', '2025-06-21 08:38:25', NULL, NULL, NULL),
(474, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:39:01', '2025-06-21 08:39:01', NULL, NULL, NULL),
(475, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:39:48', '2025-06-21 08:39:48', NULL, NULL, NULL),
(476, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:41:09', '2025-06-21 08:41:09', NULL, NULL, NULL),
(477, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:42:01', '2025-06-21 08:42:01', 1, NULL, NULL),
(478, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:42:54', '2025-06-21 08:42:54', NULL, NULL, NULL),
(479, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:43:35', '2025-06-21 08:43:35', NULL, NULL, NULL),
(480, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:44:30', '2025-06-21 08:44:30', NULL, NULL, NULL),
(481, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:45:02', '2025-06-21 08:45:02', 1, NULL, NULL),
(482, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:46:34', '2025-06-21 08:46:34', NULL, NULL, NULL),
(483, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:46:58', '2025-06-21 08:46:58', NULL, NULL, NULL),
(484, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:47:47', '2025-06-21 08:47:47', NULL, NULL, NULL),
(485, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:48:24', '2025-06-21 08:48:24', NULL, NULL, NULL),
(486, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 15/6/2025 الى تاريخ 21/6/2025', '2025-06-21', '2025-06-21 08:48:57', '2025-06-21 08:48:57', NULL, NULL, NULL),
(487, 'قبض', 'موظف', 17, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 09:12:53', '2025-06-21 09:12:53', NULL, NULL, NULL),
(488, 'قبض', 'موظف', 25, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 16:34:30', '2025-06-21 16:34:30', NULL, NULL, NULL),
(489, 'قبض', 'موظف', 7, NULL, 'كاش', 1010.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 16:51:18', '2025-06-21 16:51:18', NULL, NULL, NULL),
(490, 'قبض', 'موظف', 23, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 16:58:38', '2025-06-21 16:58:38', NULL, NULL, NULL),
(491, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 37.71, 'غير خاضع للضريبة', '11733553 محمد رشد', '2025-06-08', '2025-06-21 17:09:28', '2025-06-21 19:06:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(492, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733548 نبيل', '2025-06-08', '2025-06-21 17:24:32', '2025-06-21 19:07:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(493, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-09', '2025-06-21 17:26:02', '2025-06-21 18:59:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(494, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-10', '2025-06-21 17:27:50', '2025-06-21 19:00:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(495, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 33.14, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-10', '2025-06-21 17:28:40', '2025-06-21 18:52:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(496, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-11', '2025-06-21 17:36:18', '2025-06-21 18:53:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(497, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-12', '2025-06-21 17:37:44', '2025-06-21 19:00:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(498, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 16.87, 'غير خاضع للضريبة', '11733548 نبيل', '2025-06-13', '2025-06-21 17:39:51', '2025-06-21 19:04:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(499, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733547 محمد عربي', '2025-06-14', '2025-06-21 17:41:07', '2025-06-21 18:54:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(500, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 27.29, 'غير خاضع للضريبة', '11733543 اسحاق علي', '2025-06-17', '2025-06-21 17:42:25', '2025-06-21 19:01:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(501, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 17:58:15', '2025-06-21 17:58:15', NULL, NULL, NULL),
(502, 'قبض', 'موظف', 19, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 18:13:54', '2025-06-21 18:13:54', NULL, NULL, NULL),
(503, 'قبض', 'موظف', 24, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 18:18:13', '2025-06-21 18:18:13', NULL, NULL, NULL),
(504, 'قبض', 'موظف', 20, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-21', '2025-06-21 18:33:26', '2025-06-21 18:33:26', NULL, NULL, NULL),
(505, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 2700.00, 'غير خاضع للضريبة', 'تامين شامل', '2025-06-22', '2025-06-22 08:30:58', '2025-06-22 19:26:21', 8, '1', NULL),
(506, 'تحويل داخلي', 'جهة', 29, NULL, NULL, 2700.00, 'غير خاضع للضريبة', 'تامين شامل', '2025-06-22', '2025-06-22 08:33:21', '2025-06-22 19:26:21', 8, '1', NULL),
(507, 'تحويل داخلي', 'جهة', 12, NULL, NULL, 3187.00, 'غير خاضع للضريبة', '2425 كرت عمل -350تامين طبي -412 رسوم جوازات', '2025-06-22', '2025-06-22 08:40:11', '2025-06-22 19:26:21', 1, '1', NULL),
(508, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733550 أمير احمد بشير', '2025-06-20', '2025-06-22 17:45:13', '2025-06-22 18:04:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(509, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 38.99, 'غير خاضع للضريبة', 'نقاط بيع امير احمد', '2025-06-20', '2025-06-22 18:18:07', '2025-06-22 18:22:45', 6, NULL, NULL),
(510, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 5.84, 'غير خاضع للضريبة', 'ضريبة نقاط البيع امير احمد', '2025-06-20', '2025-06-22 18:19:56', '2025-06-22 18:23:56', 5, NULL, NULL),
(511, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 27.29, 'غير خاضع للضريبة', 'نقاط بيع اسحاق علي', '2025-06-17', '2025-06-22 18:29:06', '2025-06-22 18:29:06', 6, NULL, NULL),
(512, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.09, 'غير خاضع للضريبة', 'ضريبة نقاط البيع  اسحاق علي', '2025-06-17', '2025-06-22 18:30:33', '2025-06-22 18:30:33', 5, NULL, NULL),
(513, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 24.82, 'غير خاضع للضريبة', 'نقاط بيع محمد عربي', '2025-06-14', '2025-06-22 18:36:48', '2025-06-22 18:36:48', 6, NULL, NULL),
(514, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 3.72, 'غير خاضع للضريبة', 'ضريبة نقاط البيع محمد عربي', '2025-06-14', '2025-06-22 18:38:39', '2025-06-22 18:38:39', 5, NULL, NULL),
(515, 'قبض', 'موظف', 17, NULL, 'كاش', 70.00, 'غير خاضع للضريبة', 'تجصيل مركبة', '2025-06-22', '2025-06-22 18:39:45', '2025-06-22 19:26:21', NULL, '1', NULL),
(516, 'قبض', 'موظف', 17, NULL, 'كاش', 50.00, 'غير خاضع للضريبة', 'تحصيل مركبة', '2025-06-22', '2025-06-22 18:41:33', '2025-06-22 19:26:21', NULL, '1', NULL),
(517, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 16.87, 'غير خاضع للضريبة', 'نقاط بيخ نبيل', '2025-06-13', '2025-06-22 18:44:54', '2025-06-22 18:44:54', 6, NULL, NULL),
(518, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.53, 'غير خاضع للضريبة', 'ضريبة نقاط البيع نبيل', '2025-06-13', '2025-06-22 18:45:58', '2025-06-22 18:45:58', 5, NULL, NULL),
(519, 'قبض', 'موظف', 44, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-22', '2025-06-22 18:47:35', '2025-06-22 19:26:21', NULL, '1', NULL),
(520, 'قبض', 'موظف', 20, NULL, 'كاش', 70.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-22', '2025-06-22 19:00:54', '2025-06-22 19:26:21', NULL, '1', NULL),
(521, 'صرف', 'جهة', NULL, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تامين طبي اسلام ناصف مصري', '2025-06-21', '2025-06-22 19:30:53', '2025-06-22 19:30:53', 1, NULL, NULL),
(522, 'صرف', 'جهة', NULL, NULL, 'كاش', 288.00, 'غير خاضع للضريبة', 'رسوم الجوازات / تجديد اقامة اسلام ناصف مصري', '2025-06-21', '2025-06-22 19:32:08', '2025-06-22 19:32:08', 1, NULL, NULL),
(523, 'صرف', 'جهة', NULL, NULL, 'كاش', 2425.00, 'غير خاضع للضريبة', 'كرت عمل / اسلام ناصف مصري', '2025-06-21', '2025-06-22 19:33:14', '2025-06-22 19:33:14', 1, NULL, NULL),
(524, 'قبض', 'موظف', 3, NULL, 'كاش', 2700.00, 'غير خاضع للضريبة', 'تامين شامل', '2025-06-22', '2025-06-22 20:17:24', '2025-06-22 20:17:47', NULL, '1', NULL),
(525, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-23', '2025-06-23 08:19:41', '2025-06-23 08:19:41', NULL, NULL, NULL),
(526, 'قبض', 'موظف', 25, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-23', '2025-06-23 18:01:21', '2025-06-23 18:01:21', NULL, NULL, NULL),
(527, 'قبض', 'موظف', 23, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-23', '2025-06-23 18:02:42', '2025-06-25 17:25:33', NULL, NULL, NULL),
(528, 'قبض', 'موظف', 20, NULL, 'كاش', 120.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-23', '2025-06-23 19:03:42', '2025-06-23 19:03:42', NULL, NULL, NULL),
(529, 'قبض', 'موظف', 29, NULL, 'كاش', 2300.00, 'غير خاضع للضريبة', 'تامين شامل سيارة', '2025-06-24', '2025-06-23 22:32:29', '2025-06-23 22:52:44', NULL, '1', NULL),
(530, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.49, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-12', '2025-06-24 17:08:42', '2025-06-24 17:08:42', 6, NULL, NULL),
(531, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.92, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-12', '2025-06-24 17:10:35', '2025-06-24 17:10:35', 5, NULL, NULL),
(532, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 69.47, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-11', '2025-06-24 17:11:39', '2025-06-24 17:11:39', 6, NULL, NULL),
(533, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 10.42, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-11', '2025-06-24 17:13:08', '2025-06-24 17:13:08', 5, NULL, NULL);
INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(534, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 33.14, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-10', '2025-06-24 17:14:05', '2025-06-24 17:14:05', 6, NULL, NULL),
(535, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 4.97, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-10', '2025-06-24 17:15:00', '2025-06-24 17:15:00', 5, NULL, NULL),
(536, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-10', '2025-06-24 17:15:52', '2025-06-24 17:15:52', 6, NULL, NULL),
(537, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.97, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-10', '2025-06-24 17:16:44', '2025-06-24 17:16:44', 5, NULL, NULL),
(538, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 24.82, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-09', '2025-06-24 17:17:35', '2025-06-24 17:17:35', 6, NULL, NULL),
(539, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 3.72, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-09', '2025-06-24 17:18:40', '2025-06-24 17:18:40', 5, NULL, NULL),
(540, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 39.70, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-08', '2025-06-24 17:19:26', '2025-06-24 17:19:26', 6, NULL, NULL),
(541, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 5.95, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-08', '2025-06-24 17:20:18', '2025-06-24 17:20:18', 5, NULL, NULL),
(542, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 37.71, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-08', '2025-06-24 17:21:17', '2025-06-24 17:21:17', 6, NULL, NULL),
(543, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 5.65, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-08', '2025-06-24 17:22:03', '2025-06-24 17:22:03', 5, NULL, NULL),
(544, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 19.85, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-07', '2025-06-24 17:22:53', '2025-06-24 17:22:53', 6, NULL, NULL),
(545, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.97, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-07', '2025-06-24 17:23:32', '2025-06-24 17:23:32', 5, NULL, NULL),
(546, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 34.11, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-07', '2025-06-24 17:24:14', '2025-06-24 17:24:14', 6, NULL, NULL),
(547, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.11, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-07', '2025-06-24 17:24:53', '2025-06-24 17:24:53', 5, NULL, NULL),
(548, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 57.56, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-07', '2025-06-24 17:25:42', '2025-06-24 17:25:42', 6, NULL, NULL),
(549, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.63, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-07', '2025-06-24 17:26:24', '2025-06-24 17:26:24', 5, NULL, NULL),
(550, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 58.48, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-07', '2025-06-24 17:27:22', '2025-06-24 17:27:22', 6, NULL, NULL),
(551, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.77, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-07', '2025-06-24 17:28:05', '2025-06-24 17:28:05', 5, NULL, NULL),
(552, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 74.44, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-07', '2025-06-24 17:28:51', '2025-06-24 17:28:51', 6, NULL, NULL),
(553, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 11.16, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-07', '2025-06-24 17:29:38', '2025-06-24 17:29:38', 5, NULL, NULL),
(554, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 94.29, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-02', '2025-06-24 17:30:51', '2025-06-24 17:30:51', 6, NULL, NULL),
(555, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 14.14, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-02', '2025-06-24 17:31:40', '2025-06-24 17:31:40', 5, NULL, NULL),
(556, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 18.86, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-03', '2025-06-24 17:32:36', '2025-06-24 17:32:36', 6, NULL, NULL),
(557, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.82, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-03', '2025-06-24 17:33:20', '2025-06-24 17:33:20', 5, NULL, NULL),
(558, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 9.92, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-04', '2025-06-24 17:34:09', '2025-06-24 17:34:09', 6, NULL, NULL),
(559, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 1.48, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-04', '2025-06-24 17:34:54', '2025-06-24 17:34:54', 5, NULL, NULL),
(560, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 24.37, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-04', '2025-06-24 17:35:46', '2025-06-24 17:35:46', 6, NULL, NULL),
(561, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 3.65, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-04', '2025-06-24 17:36:40', '2025-06-24 17:36:40', 5, NULL, NULL),
(562, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 49.62, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-04', '2025-06-24 17:37:54', '2025-06-24 17:37:54', 6, NULL, NULL),
(563, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.44, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-04', '2025-06-24 17:38:51', '2025-06-24 17:38:51', 5, NULL, NULL),
(564, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 14.89, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-05', '2025-06-24 17:39:28', '2025-06-24 17:39:28', 6, NULL, NULL),
(565, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.23, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-05', '2025-06-24 17:40:08', '2025-06-24 17:40:08', 5, NULL, NULL),
(566, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-06', '2025-06-24 17:41:15', '2025-06-24 17:41:15', 6, NULL, NULL),
(567, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.46, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-06', '2025-06-24 17:41:55', '2025-06-24 17:41:55', 5, NULL, NULL),
(568, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 34.74, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-06', '2025-06-24 17:42:46', '2025-06-24 17:42:46', 6, NULL, NULL),
(569, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 5.21, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-06', '2025-06-24 17:43:44', '2025-06-24 17:43:44', 5, NULL, NULL),
(570, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 24.37, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-06', '2025-06-24 17:44:43', '2025-06-24 17:44:43', 6, NULL, NULL),
(571, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 3.65, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-06', '2025-06-24 17:45:28', '2025-06-24 17:45:28', 5, NULL, NULL),
(572, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 14.62, 'غير خاضع للضريبة', 'نقاط بيع', '2025-06-02', '2025-06-24 17:46:15', '2025-06-24 17:46:15', 6, NULL, NULL),
(573, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 2.19, 'غير خاضع للضريبة', 'ضريبة نقاط البيع', '2025-06-02', '2025-06-24 17:46:57', '2025-06-24 17:46:57', 5, NULL, NULL),
(574, 'قبض', 'موظف', 19, NULL, 'كاش', 2000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-24', '2025-06-24 18:15:20', '2025-06-24 18:15:20', NULL, NULL, NULL),
(575, 'صرف', 'موظف', 62, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'صرف جزء من الراتب', '2025-06-24', '2025-06-24 18:51:46', '2025-06-24 18:51:46', NULL, NULL, NULL),
(576, 'صرف', 'موظف', 2, NULL, 'كاش', 500.00, 'غير خاضع للضريبة', 'صرف جزء من الراتب', '2025-05-24', '2025-06-24 18:52:30', '2025-06-24 18:52:30', NULL, NULL, NULL),
(577, 'قبض', 'موظف', 20, NULL, 'كاش', 70.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-25', '2025-06-25 06:38:29', '2025-06-25 06:38:29', NULL, NULL, NULL),
(578, 'قبض', 'موظف', 17, NULL, 'كاش', 50.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-25', '2025-06-25 17:19:54', '2025-06-25 17:19:54', NULL, NULL, NULL),
(579, 'قبض', 'موظف', 19, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-25', '2025-06-25 17:47:14', '2025-06-25 17:47:14', NULL, NULL, NULL),
(580, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 188.57, 'غير خاضع للضريبة', 'تم التحويل بالخطأ  ( مكرر )', '2025-06-07', '2025-06-25 18:09:28', '2025-06-25 18:09:28', 6, NULL, NULL),
(581, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 28.28, 'غير خاضع للضريبة', 'استرداد ضريبة ( مكررة )', '2025-06-07', '2025-06-25 18:15:00', '2025-06-25 18:15:00', 5, NULL, NULL),
(582, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 98.10, 'غير خاضع للضريبة', 'تم التحويل بالخطأ ( مكرر )', '2025-06-07', '2025-06-25 18:17:23', '2025-06-25 18:17:23', 6, NULL, NULL),
(583, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 14.71, 'غير خاضع للضريبة', 'استرداد ضريبة مكررة', '2025-06-07', '2025-06-25 18:18:27', '2025-06-25 18:18:27', 5, NULL, NULL),
(584, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 28.78, 'غير خاضع للضريبة', 'تم التحويل بالخطأ مكرر', '2025-06-07', '2025-06-25 18:23:37', '2025-06-25 18:23:37', 6, NULL, NULL),
(585, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 4.31, 'غير خاضع للضريبة', 'استرداد ضريبة مكررة', '2025-06-07', '2025-06-25 18:24:42', '2025-06-25 18:24:42', 5, NULL, NULL),
(586, 'قبض', 'موظف', 3, NULL, 'كاش', 2700.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-25', '2025-06-25 19:52:30', '2025-06-25 19:52:30', NULL, NULL, NULL),
(587, 'قبض', 'موظف', 25, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل مركبة', '2025-06-26', '2025-06-26 18:29:36', '2025-06-26 18:29:36', NULL, NULL, NULL),
(588, 'قبض', 'موظف', 24, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل مركبة', '2025-06-26', '2025-06-26 18:30:15', '2025-06-26 18:30:15', NULL, NULL, NULL),
(589, 'قبض', 'موظف', 24, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-27', '2025-06-27 17:09:41', '2025-06-27 17:09:41', NULL, NULL, NULL),
(590, 'قبض', 'موظف', 24, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 17:13:01', '2025-06-28 17:13:01', NULL, NULL, NULL),
(591, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 17:17:05', '2025-06-28 17:17:05', NULL, NULL, NULL),
(592, 'قبض', 'موظف', 17, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 17:49:22', '2025-06-28 17:49:22', NULL, NULL, NULL),
(593, 'قبض', 'موظف', 23, NULL, 'كاش', 900.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 17:50:44', '2025-06-28 17:50:44', NULL, NULL, NULL),
(594, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 18:04:54', '2025-06-28 18:04:54', NULL, NULL, NULL),
(595, 'قبض', 'موظف', 19, NULL, 'كاش', 905.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 18:06:33', '2025-06-28 18:06:33', NULL, NULL, NULL),
(596, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 18:08:08', '2025-06-28 18:08:08', NULL, NULL, NULL),
(597, 'قبض', 'موظف', 44, NULL, 'كاش', 900.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-28', '2025-06-28 18:56:13', '2025-06-28 18:56:13', NULL, NULL, NULL),
(598, 'قبض', 'موظف', 25, NULL, 'كاش', 400.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-29', '2025-06-29 17:05:45', '2025-06-29 17:05:45', NULL, NULL, NULL),
(599, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:46:42', '2025-06-29 18:46:42', NULL, NULL, NULL),
(600, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:47:42', '2025-06-29 18:47:42', NULL, NULL, NULL),
(601, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:53:39', '2025-06-29 18:53:39', NULL, NULL, NULL),
(602, 'تحويل داخلي', 'سيارة', 29, 5, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:55:19', '2025-06-29 18:55:19', NULL, NULL, NULL),
(603, 'تحويل داخلي', 'سيارة', 28, 28, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:56:51', '2025-06-29 18:56:51', NULL, NULL, NULL),
(604, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:58:05', '2025-06-29 18:58:05', NULL, NULL, NULL),
(605, 'تحويل داخلي', 'سيارة', 27, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 18:59:08', '2025-06-29 18:59:08', NULL, NULL, NULL),
(606, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:00:34', '2025-06-29 19:00:34', NULL, NULL, NULL),
(607, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:01:28', '2025-06-29 19:01:28', NULL, NULL, NULL),
(608, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:02:36', '2025-06-29 19:02:36', NULL, NULL, NULL),
(609, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:03:43', '2025-06-29 19:03:43', NULL, NULL, NULL),
(610, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:04:46', '2025-06-29 19:04:46', 1, NULL, NULL),
(611, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:05:43', '2025-06-29 19:05:43', NULL, NULL, NULL),
(612, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:07:53', '2025-06-29 19:07:53', NULL, NULL, NULL),
(613, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:08:51', '2025-06-29 19:08:51', NULL, NULL, NULL),
(614, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق اقامة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:09:54', '2025-06-29 19:09:54', 1, NULL, NULL),
(615, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:10:29', '2025-06-29 19:10:29', NULL, NULL, NULL),
(616, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:11:16', '2025-06-29 19:11:16', NULL, NULL, NULL),
(617, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:12:40', '2025-06-29 19:12:40', NULL, NULL, NULL),
(618, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 22/6/2025 الى تاريخ 28/6/2025', '2025-06-28', '2025-06-29 19:13:30', '2025-06-29 19:13:30', NULL, NULL, NULL),
(619, 'قبض', 'موظف', 24, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-29', '2025-06-29 19:31:44', '2025-06-29 19:31:44', NULL, NULL, NULL),
(620, 'قبض', 'موظف', 24, NULL, 'كاش', 300.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-30', '2025-06-30 18:57:51', '2025-06-30 18:57:51', NULL, NULL, NULL),
(621, 'قبض', 'موظف', 17, NULL, 'كاش', 80.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-06-30', '2025-06-30 19:04:58', '2025-06-30 19:04:58', NULL, NULL, NULL),
(622, 'قبض', 'موظف', 17, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل', '2025-06-01', '2025-07-01 19:48:54', '2025-07-01 19:48:54', NULL, NULL, NULL),
(623, 'قبض', 'موظف', 25, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-07-01', '2025-07-01 20:38:26', '2025-07-01 20:38:26', NULL, NULL, NULL),
(624, 'قبض', 'موظف', 25, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-07-01', '2025-07-01 20:39:38', '2025-07-01 20:39:38', NULL, NULL, NULL),
(625, 'قبض', 'موظف', 25, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-07-01', '2025-07-01 20:45:57', '2025-07-01 20:45:57', NULL, NULL, NULL),
(626, 'قبض', 'موظف', 24, NULL, 'كاش', 400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-03', '2025-07-03 20:18:36', '2025-07-03 20:18:36', NULL, NULL, NULL),
(627, 'قبض', 'موظف', 24, NULL, 'كاش', 250.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-04', '2025-07-05 07:49:55', '2025-07-05 07:49:55', NULL, NULL, NULL),
(628, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 16.87, 'غير خاضع للضريبة', 'نقاط بيع / امير احمد / 11733550', '2025-06-23', '2025-07-05 09:02:56', '2025-07-05 09:12:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(629, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733548/ نبيل /نقاط بيع', '2025-06-23', '2025-07-05 09:10:45', '2025-07-05 09:10:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(630, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 79.40, 'غير خاضع للضريبة', '11733553 / محمد رشد /نقاط بيع', '2025-06-25', '2025-07-05 09:14:17', '2025-07-05 09:15:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(631, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733560 / نقاط بيع', '2025-06-26', '2025-07-05 09:17:26', '2025-07-05 09:17:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(632, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-06-28', '2025-07-05 09:19:39', '2025-07-05 09:19:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(633, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-06-28', '2025-07-05 09:21:34', '2025-07-05 09:21:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(634, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 56.00, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-06-27', '2025-07-05 09:23:55', '2025-07-05 09:23:55', 6, NULL, 'شركة الجواب - بنك الرياض'),
(635, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.72, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-06-29', '2025-07-05 09:25:03', '2025-07-05 09:25:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(636, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-01', '2025-07-05 09:50:28', '2025-07-05 09:50:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(637, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-01', '2025-07-05 09:53:53', '2025-07-05 10:13:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(638, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 63.36, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-01', '2025-07-05 10:02:47', '2025-07-05 10:02:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(639, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 82.38, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-01', '2025-07-05 10:04:15', '2025-07-05 10:04:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(640, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-04-01', '2025-07-05 10:06:17', '2025-07-05 10:06:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(641, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 28.78, 'غير خاضع للضريبة', '11733559 / نقاط بيع', '2025-04-02', '2025-07-05 10:11:10', '2025-07-05 10:11:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(642, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-02', '2025-07-05 10:15:15', '2025-07-05 10:15:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(643, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 112.09, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-02', '2025-07-05 10:17:49', '2025-07-05 10:17:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(644, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 413.00, 'غير خاضع للضريبة', '2437206887', '2025-04-02', '2025-07-05 10:22:56', '2025-07-05 10:22:56', 1, NULL, 'شركة الجواب - بنك الرياض'),
(645, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 6000.00, 'غير خاضع للضريبة', 'حوالة مالية صادرة\r\nسريعة', '2025-04-02', '2025-07-05 10:29:05', '2025-07-05 10:29:05', 7, NULL, 'شركة الجواب - بنك الرياض'),
(646, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 2425.00, 'غير خاضع للضريبة', '18461010576025', '2025-04-02', '2025-07-05 10:30:33', '2025-07-05 10:30:33', 1, NULL, 'شركة الجواب - بنك الرياض'),
(647, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 1.15, 'غير خاضع للضريبة', 'رسوم حوالة سريعة', '2025-04-02', '2025-07-05 10:41:32', '2025-07-05 10:41:32', 7, NULL, 'شركة الجواب - بنك الرياض'),
(648, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733559', '2025-04-03', '2025-07-05 10:44:56', '2025-07-05 10:44:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(649, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 31.19, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-03', '2025-07-05 10:47:37', '2025-07-05 10:47:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(650, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-03', '2025-07-05 10:49:42', '2025-07-05 10:49:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(651, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-03', '2025-07-05 10:51:53', '2025-07-05 10:51:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(652, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 148.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-03', '2025-07-05 10:54:08', '2025-07-05 10:54:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(653, 'قبض', 'جهة', NULL, NULL, 'كاش', 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-05', '2025-07-05 10:56:20', '2025-07-05 10:56:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(654, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-05', '2025-07-05 11:04:08', '2025-07-05 11:04:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(655, 'قبض', 'جهة', NULL, NULL, 'كاش', 34.74, 'غير خاضع للضريبة', '11733559', '2025-04-05', '2025-07-05 11:05:42', '2025-07-05 11:05:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(656, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733559', '2025-04-04', '2025-07-05 11:07:57', '2025-07-05 11:07:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(657, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 47.64, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-04', '2025-07-05 11:10:13', '2025-07-05 11:10:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(658, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-04', '2025-07-05 11:12:01', '2025-07-05 11:12:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(659, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-04', '2025-07-05 11:20:49', '2025-07-05 11:20:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(660, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733558', '2025-04-04', '2025-07-05 11:22:28', '2025-07-05 11:22:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(661, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-05', '2025-07-05 11:24:26', '2025-07-05 11:24:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(662, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 162.00, 'غير خاضع للضريبة', '2395965045', '2025-04-05', '2025-07-05 11:29:08', '2025-07-05 11:29:08', 1, NULL, 'شركة الجواب - بنك الرياض'),
(663, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 75.00, 'غير خاضع للضريبة', '2395965045', '2025-04-05', '2025-07-05 11:31:49', '2025-07-05 11:31:49', 2, NULL, 'شركة الجواب - بنك الرياض'),
(664, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543/ اسحاق علي', '2025-04-06', '2025-07-05 11:39:19', '2025-07-05 11:39:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(665, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733559', '2025-04-07', '2025-07-05 11:41:16', '2025-07-05 11:41:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(666, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-07', '2025-07-05 11:49:50', '2025-07-05 11:49:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(667, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-07', '2025-07-05 11:52:19', '2025-07-05 11:52:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(668, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 77.98, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-07', '2025-07-05 11:53:54', '2025-07-05 11:53:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(669, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-08', '2025-07-05 11:56:16', '2025-07-05 11:56:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(670, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733556 / ثامن الصديق', '2025-04-09', '2025-07-05 11:58:47', '2025-07-05 11:58:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(671, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-12', '2025-07-05 12:01:10', '2025-07-05 12:01:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(672, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-09', '2025-07-05 12:05:49', '2025-07-05 12:05:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(673, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 22.83, 'غير خاضع للضريبة', '11733559', '2025-04-12', '2025-07-05 12:09:16', '2025-07-05 12:09:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(674, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-12', '2025-07-05 12:11:32', '2025-07-05 12:11:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(675, 'قبض', 'جهة', NULL, NULL, 'كاش', 50.69, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-12', '2025-07-05 12:16:33', '2025-07-05 12:21:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(676, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 66.28, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-13', '2025-07-05 12:19:05', '2025-07-05 12:21:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(677, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-14', '2025-07-05 12:25:40', '2025-07-05 12:25:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(678, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-15', '2025-07-05 12:30:02', '2025-07-05 12:30:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(679, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-05 12:33:57', '2025-07-05 12:33:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(680, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-05 12:34:51', '2025-07-05 12:34:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(681, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-17', '2025-07-05 12:36:30', '2025-07-05 12:36:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(682, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733550/ امير احمد', '2025-04-17', '2025-07-05 12:46:42', '2025-07-06 10:44:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(683, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.07, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-18', '2025-07-05 12:50:41', '2025-07-06 10:45:12', 6, NULL, 'شركة الجواب - بنك الرياض'),
(684, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-17', '2025-07-05 12:54:44', '2025-07-05 12:54:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(685, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.07, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-18', '2025-07-05 12:57:21', '2025-07-05 12:57:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(686, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-19', '2025-07-05 13:06:31', '2025-07-05 13:06:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(687, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 158.80, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-19', '2025-07-05 13:08:06', '2025-07-05 13:08:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(688, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-05 13:14:25', '2025-07-05 13:16:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(689, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-05 13:15:44', '2025-07-05 13:15:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(690, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 79.40, 'غير خاضع للضريبة', '11733553 / اسحاق علي', '2025-04-20', '2025-07-05 13:18:02', '2025-07-05 13:18:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(691, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 101.24, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-20', '2025-07-05 13:20:11', '2025-07-05 13:20:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(692, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-21', '2025-07-05 13:26:03', '2025-07-05 13:26:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(693, 'قبض', 'جهة', NULL, NULL, 'كاش', 29.77, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-04-21', '2025-07-05 13:27:41', '2025-07-05 13:27:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(694, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 43.86, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-21', '2025-07-05 13:28:49', '2025-07-05 13:28:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(695, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-22', '2025-07-05 13:30:05', '2025-07-05 13:30:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(696, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 77.98, 'غير خاضع للضريبة', '11733547 / محمد  عربي', '2025-04-22', '2025-07-05 13:32:24', '2025-07-05 13:32:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(697, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-24', '2025-07-05 13:39:09', '2025-07-05 13:39:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(698, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-26', '2025-07-05 13:40:39', '2025-07-05 13:40:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(699, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-26', '2025-07-05 13:41:34', '2025-07-05 13:41:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(700, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-26', '2025-07-05 13:42:53', '2025-07-05 13:42:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(701, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 37.71, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-25', '2025-07-05 13:44:06', '2025-07-05 13:44:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(702, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-26', '2025-07-05 13:46:16', '2025-07-05 13:46:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(703, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.28, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-27', '2025-07-05 13:47:55', '2025-07-05 13:47:55', 6, NULL, 'شركة الجواب - بنك الرياض'),
(704, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-27', '2025-07-05 13:50:28', '2025-07-05 13:50:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(705, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-28', '2025-07-05 13:51:27', '2025-07-05 13:51:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(706, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-28', '2025-07-05 13:53:29', '2025-07-05 13:53:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(707, 'قبض', 'جهة', NULL, NULL, 'كاش', 138.50, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-29', '2025-07-05 13:55:10', '2025-07-05 13:55:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(708, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-04-30', '2025-07-05 13:56:08', '2025-07-05 13:56:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(709, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-30', '2025-07-05 13:57:20', '2025-07-05 13:57:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(710, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-30', '2025-07-05 13:58:29', '2025-07-05 13:58:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(711, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-30', '2025-07-05 13:59:29', '2025-07-05 13:59:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(712, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733543  / اسحاق علي', '2025-05-01', '2025-07-05 14:42:32', '2025-07-05 14:42:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(713, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733543  / اسحاق علي', '2025-05-02', '2025-07-05 14:42:32', '2025-07-05 14:44:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(714, 'قبض', 'موظف', 44, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-05', '2025-07-05 18:17:26', '2025-07-05 18:17:26', NULL, NULL, NULL),
(715, 'قبض', 'موظف', 7, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-05', '2025-07-05 18:28:56', '2025-07-05 18:28:56', NULL, NULL, NULL),
(716, 'قبض', 'موظف', 19, NULL, 'كاش', 920.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-05', '2025-07-05 18:32:40', '2025-07-05 18:32:40', NULL, NULL, NULL),
(717, 'قبض', 'موظف', 28, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-07-05', '2025-07-05 19:00:18', '2025-07-05 19:00:18', NULL, NULL, NULL),
(718, 'قبض', 'موظف', 27, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل مركبه', '2025-07-05', '2025-07-05 19:03:28', '2025-07-05 19:03:28', NULL, NULL, NULL),
(719, 'قبض', 'جهة', NULL, NULL, 'كاش', 116.96, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-05-01', '2025-07-06 05:45:03', '2025-07-06 05:45:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(720, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733558', '2025-05-02', '2025-07-06 05:47:23', '2025-07-06 05:47:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(721, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-03', '2025-07-06 05:48:44', '2025-07-06 05:48:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(722, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 12.91, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-03', '2025-07-06 05:50:31', '2025-07-06 05:50:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(723, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-03', '2025-07-06 05:53:16', '2025-07-06 05:53:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(724, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-03', '2025-07-06 05:54:54', '2025-07-06 05:54:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(725, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-03', '2025-07-06 06:00:44', '2025-07-06 06:00:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(726, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733558', '2025-05-03', '2025-07-06 06:01:55', '2025-07-06 06:01:55', 6, NULL, 'شركة الجواب - بنك الرياض'),
(727, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 92.60, 'غير خاضع للضريبة', '11733553 /  محمد رشد', '2025-05-03', '2025-07-06 06:03:11', '2025-07-06 06:03:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(728, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-04', '2025-07-06 06:04:37', '2025-07-06 06:04:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(729, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-04', '2025-07-06 06:05:36', '2025-07-06 06:05:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(730, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 54.59, 'غير خاضع للضريبة', '11733558', '2025-05-04', '2025-07-06 06:07:09', '2025-07-06 06:07:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(731, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 79.40, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-04', '2025-07-06 06:08:05', '2025-07-06 06:08:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(732, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-05', '2025-07-06 06:09:08', '2025-07-06 06:09:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(733, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 17.86, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-05', '2025-07-06 06:10:22', '2025-07-06 06:10:22', 6, NULL, 'شركة الجواب - بنك الرياض'),
(734, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 54.59, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-05', '2025-07-06 06:11:24', '2025-07-06 06:11:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(735, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 129.02, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-05-05', '2025-07-06 06:12:33', '2025-07-06 06:12:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(736, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-07', '2025-07-06 06:16:11', '2025-07-06 06:16:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(737, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-07', '2025-07-06 06:17:19', '2025-07-06 06:17:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(738, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733550/ امير احمد', '2025-05-07', '2025-07-06 06:18:27', '2025-07-06 06:18:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(739, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-10', '2025-07-06 06:19:49', '2025-07-06 06:19:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(740, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 45.31, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-09', '2025-07-06 06:21:26', '2025-07-06 06:21:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(741, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.45, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-11', '2025-07-06 06:22:39', '2025-07-06 06:22:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(742, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.97, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-12', '2025-07-06 06:23:37', '2025-07-06 06:23:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(743, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-13', '2025-07-06 06:24:45', '2025-07-06 06:24:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(744, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.45, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-15', '2025-07-06 06:27:19', '2025-07-06 06:27:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(745, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-05-17', '2025-07-06 06:30:23', '2025-07-06 06:30:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(746, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-17', '2025-07-06 06:33:16', '2025-07-06 06:33:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(747, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-05-18', '2025-07-06 06:34:39', '2025-07-06 06:34:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(748, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-19', '2025-07-06 06:36:06', '2025-07-06 06:36:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(749, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-21', '2025-07-06 06:37:41', '2025-07-06 06:37:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(750, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 46.78, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-21', '2025-07-06 06:38:51', '2025-07-06 06:38:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(751, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-24', '2025-07-06 06:40:36', '2025-07-06 06:40:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(752, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 56.57, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-24', '2025-07-06 06:41:45', '2025-07-06 06:41:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(753, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 08:38:09', '2025-07-06 08:38:09', NULL, NULL, NULL),
(754, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 08:40:00', '2025-07-06 08:40:00', NULL, NULL, NULL),
(755, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 1500.00, 'غير خاضع للضريبة', 'استحقاق شهر (7)', '2025-07-01', '2025-07-06 08:43:27', '2025-07-06 08:43:27', NULL, NULL, NULL),
(756, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق شهر (7)', '2025-07-01', '2025-07-06 08:47:30', '2025-07-06 08:47:30', NULL, NULL, NULL),
(757, 'تحويل داخلي', 'سيارة', 29, 5, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق شهر (7)', '2025-07-01', '2025-07-06 08:50:07', '2025-07-06 08:50:07', NULL, NULL, NULL),
(758, 'تحويل داخلي', 'سيارة', 28, 28, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق شهر (7)', '2025-07-01', '2025-07-06 08:52:17', '2025-07-06 08:52:17', NULL, NULL, NULL),
(759, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 08:53:33', '2025-07-06 08:53:33', NULL, NULL, NULL),
(760, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 08:54:10', '2025-07-06 08:54:10', NULL, NULL, NULL),
(761, 'تحويل داخلي', 'سيارة', 27, 12, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق شهر (7)', '2025-07-01', '2025-07-06 08:55:31', '2025-07-06 08:55:31', NULL, NULL, NULL),
(762, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 08:56:33', '2025-07-06 08:56:33', NULL, NULL, NULL),
(763, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 08:57:26', '2025-07-06 08:57:26', NULL, NULL, NULL),
(764, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 08:59:46', '2025-07-06 08:59:46', NULL, NULL, NULL),
(765, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:00:45', '2025-07-06 09:00:45', NULL, NULL, NULL),
(766, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:01:57', '2025-07-06 09:01:57', NULL, NULL, NULL),
(767, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:02:53', '2025-07-06 09:02:53', NULL, NULL, NULL),
(768, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 340.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:06:16', '2025-07-06 09:06:16', NULL, NULL, NULL),
(769, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 850.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:07:06', '2025-07-06 09:07:06', NULL, NULL, NULL),
(770, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 60.00, 'غير خاضع للضريبة', 'استحقاق تجديد اقامة  من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:09:42', '2025-07-06 09:09:42', 1, NULL, NULL),
(771, 'قبض', 'موظف', 23, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 09:10:29', '2025-07-06 09:10:29', NULL, NULL, NULL),
(772, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'استحقاق تجديد اقامة  من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:10:49', '2025-07-06 09:10:49', 1, NULL, NULL),
(773, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 340.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:12:35', '2025-07-06 09:12:35', NULL, NULL, NULL),
(774, 'قبض', 'موظف', 25, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 09:13:24', '2025-07-06 09:13:24', NULL, NULL, NULL),
(775, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 850.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:13:26', '2025-07-06 09:13:26', NULL, NULL, NULL),
(776, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 340.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:19:25', '2025-07-06 09:19:25', NULL, NULL, NULL),
(777, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 850.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:40:31', '2025-07-06 09:40:31', NULL, NULL, NULL),
(778, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 300.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:42:17', '2025-07-06 09:42:17', NULL, NULL, NULL),
(779, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 750.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:42:55', '2025-07-06 09:42:55', NULL, NULL, NULL),
(780, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 60.00, 'غير خاضع للضريبة', 'استحقاق تجديد اقامة  من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:48:15', '2025-07-06 09:48:15', 1, NULL, NULL),
(781, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'استحقاق اقامة  من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:53:33', '2025-07-06 09:53:33', 1, NULL, NULL),
(782, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 340.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:54:30', '2025-07-06 09:54:30', NULL, NULL, NULL),
(783, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 850.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:55:07', '2025-07-06 09:55:07', NULL, NULL, NULL),
(784, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 260.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:57:00', '2025-07-06 09:57:00', NULL, NULL, NULL),
(785, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 650.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:58:30', '2025-07-06 09:58:30', NULL, NULL, NULL),
(786, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 260.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 09:59:13', '2025-07-06 09:59:13', NULL, NULL, NULL),
(787, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 650.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 09:59:47', '2025-07-06 09:59:47', NULL, NULL, NULL),
(788, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 320.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 28/6/2025 الى تاريخ 30/6/2025', '2025-06-30', '2025-07-06 10:00:54', '2025-07-06 10:00:54', NULL, NULL, NULL),
(789, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 1/7/2025 الى تاريخ 5/7/2025', '2025-07-05', '2025-07-06 10:01:39', '2025-07-06 10:01:39', NULL, NULL, NULL),
(790, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-07-01', '2025-07-06 10:36:24', '2025-07-06 10:36:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(791, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733558', '2025-07-02', '2025-07-06 10:38:31', '2025-07-06 10:38:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(792, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-02', '2025-07-06 10:39:14', '2025-07-06 10:39:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(793, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733560', '2025-07-05', '2025-07-06 10:40:27', '2025-07-06 10:40:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(794, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 165.70, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-05', '2025-07-06 10:41:22', '2025-07-06 10:41:22', 6, NULL, 'شركة الجواب - بنك الرياض'),
(795, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733543', '2025-07-01', '2025-07-06 10:51:29', '2025-07-06 10:51:29', 6, NULL, NULL),
(796, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733543', '2025-07-02', '2025-07-06 10:52:43', '2025-07-06 10:52:43', 6, NULL, NULL),
(797, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 165.70, 'غير خاضع للضريبة', '11733553', '2025-07-05', '2025-07-06 10:53:56', '2025-07-06 10:53:56', 6, NULL, NULL),
(798, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.39, 'غير خاضع للضريبة', '11733543', '2025-07-01', '2025-07-06 10:57:59', '2025-07-06 10:57:59', 5, NULL, NULL),
(799, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.31, 'غير خاضع للضريبة', '11733543', '2025-07-02', '2025-07-06 10:59:52', '2025-07-06 10:59:52', 5, NULL, NULL),
(800, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 24.86, 'غير خاضع للضريبة', '11733553', '2025-07-05', '2025-07-06 11:01:19', '2025-07-06 11:01:19', 5, NULL, NULL),
(801, 'تحويل داخلي', 'جهة', NULL, NULL, NULL, 36.72, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-06-29', '2025-07-06 11:22:43', '2025-07-06 11:22:43', 6, NULL, NULL),
(802, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733543 /  اسحاق علي', '2025-06-28', '2025-07-06 11:32:46', '2025-07-06 11:33:49', 6, NULL, NULL),
(803, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-06-28', '2025-07-06 11:38:11', '2025-07-06 11:38:11', 6, NULL, NULL),
(804, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 56.00, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-06-27', '2025-07-06 11:40:50', '2025-07-06 11:40:50', 6, NULL, NULL),
(805, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 79.40, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-06-25', '2025-07-06 11:47:43', '2025-07-06 11:47:43', 6, NULL, NULL),
(806, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 16.87, 'غير خاضع للضريبة', 'نقاط بيع / امير احمد / 11733550', '2025-06-23', '2025-07-06 11:51:30', '2025-07-06 11:51:30', 6, NULL, NULL),
(807, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733548/ نبيل /نقاط بيع', '2025-06-23', '2025-07-06 11:52:35', '2025-07-06 11:52:35', 6, NULL, NULL);
INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(808, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 73.44, 'غير خاضع للضريبة', 'اسحاق علي / مكرر', '2025-06-29', '2025-07-06 12:03:18', '2025-07-06 12:03:18', 6, NULL, NULL),
(809, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733548', '2025-05-31', '2025-07-06 12:21:43', '2025-07-06 12:21:43', 6, NULL, NULL),
(810, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 19.49, 'غير خاضع للضريبة', '11733547', '2025-05-31', '2025-07-06 12:24:46', '2025-07-06 12:24:46', 6, NULL, NULL),
(811, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733543', '2025-05-31', '2025-07-06 12:27:52', '2025-07-06 12:27:52', 6, NULL, NULL),
(812, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733553', '2025-05-30', '2025-07-06 12:32:10', '2025-07-06 12:32:10', 6, NULL, NULL),
(813, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733553', '2025-05-30', '2025-07-06 12:34:57', '2025-07-06 12:34:57', 6, NULL, NULL),
(814, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733548', '2025-05-30', '2025-07-06 12:37:42', '2025-07-06 12:37:42', 6, NULL, NULL),
(815, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733543', '2025-05-26', '2025-07-06 12:48:22', '2025-07-06 12:48:22', 6, NULL, NULL),
(816, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543', '2025-05-26', '2025-07-06 12:49:18', '2025-07-06 12:49:18', 6, NULL, NULL),
(817, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733550', '2025-05-25', '2025-07-06 12:56:19', '2025-07-06 12:56:19', 6, NULL, NULL),
(818, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-24', '2025-07-06 13:21:38', '2025-07-06 13:21:38', 6, NULL, NULL),
(819, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 56.57, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-24', '2025-07-06 13:31:12', '2025-07-06 13:31:12', 6, NULL, NULL),
(820, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-21', '2025-07-06 13:52:31', '2025-07-06 13:52:31', 6, NULL, NULL),
(821, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 46.78, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-21', '2025-07-06 13:53:36', '2025-07-06 13:53:36', 6, NULL, NULL),
(822, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-19', '2025-07-06 13:56:52', '2025-07-06 13:56:52', 6, NULL, NULL),
(823, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 14:52:32', '2025-07-06 14:52:32', NULL, NULL, NULL),
(824, 'قبض', 'موظف', 24, NULL, 'كاش', 400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 17:02:03', '2025-07-06 17:02:03', NULL, NULL, NULL),
(825, 'قبض', 'موظف', 15, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 18:35:06', '2025-07-06 18:35:06', NULL, NULL, NULL),
(826, 'قبض', 'موظف', 17, NULL, 'كاش', 450.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-06', '2025-07-06 20:34:21', '2025-07-06 20:34:21', NULL, NULL, NULL),
(827, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-18', '2025-07-07 06:31:28', '2025-07-07 06:31:28', 6, NULL, NULL),
(828, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-17', '2025-07-07 06:46:43', '2025-07-07 06:46:43', 6, NULL, NULL),
(829, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-17', '2025-07-07 06:47:30', '2025-07-07 06:47:30', 6, NULL, NULL),
(830, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 21.45, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-15', '2025-07-07 06:48:54', '2025-07-07 06:48:54', 6, NULL, NULL),
(831, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-13', '2025-07-07 06:53:05', '2025-07-07 06:53:05', 6, NULL, NULL),
(832, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 4.97, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-12', '2025-07-07 06:54:22', '2025-07-07 06:54:22', 6, NULL, NULL),
(833, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 21.45, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-11', '2025-07-07 06:55:37', '2025-07-07 06:55:37', 6, NULL, NULL),
(834, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-10', '2025-07-07 06:56:23', '2025-07-07 06:56:23', 6, NULL, NULL),
(835, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 45.31, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-09', '2025-07-07 06:57:40', '2025-07-07 06:57:40', 6, NULL, NULL),
(836, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-07', '2025-07-07 07:03:38', '2025-07-07 07:03:38', 6, NULL, NULL),
(837, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 34.11, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-07', '2025-07-07 07:05:03', '2025-07-07 07:05:03', 6, NULL, NULL),
(838, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733550/ امير احمد', '2025-05-07', '2025-07-07 07:06:47', '2025-07-07 07:06:47', 6, NULL, NULL),
(839, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 116.96, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-01', '2025-07-07 07:16:18', '2025-07-07 07:16:18', 6, NULL, NULL),
(840, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-01', '2025-07-07 07:17:13', '2025-07-07 07:17:13', 6, NULL, NULL),
(841, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-02', '2025-07-07 07:19:26', '2025-07-07 07:19:26', 6, NULL, NULL),
(842, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 129.02, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-05-05', '2025-07-07 07:21:31', '2025-07-07 07:21:31', 6, NULL, NULL),
(843, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 54.59, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-05', '2025-07-07 07:23:06', '2025-07-07 07:23:06', 6, NULL, NULL),
(844, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 17.86, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-05', '2025-07-07 07:24:02', '2025-07-07 07:24:02', 6, NULL, NULL),
(845, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-05', '2025-07-07 07:24:47', '2025-07-07 07:24:47', 6, NULL, NULL),
(846, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 24.37, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-04', '2025-07-07 07:26:11', '2025-07-07 07:26:11', 6, NULL, NULL),
(847, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 24.82, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-04', '2025-07-07 07:27:22', '2025-07-07 07:27:22', 6, NULL, NULL),
(848, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 79.40, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-04', '2025-07-07 07:28:31', '2025-07-07 07:28:31', 6, NULL, NULL),
(849, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 92.60, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-03', '2025-07-07 07:29:41', '2025-07-07 07:29:41', 6, NULL, NULL),
(850, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-03', '2025-07-07 07:30:29', '2025-07-07 07:30:29', 6, NULL, NULL),
(851, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-03', '2025-07-07 07:31:14', '2025-07-07 07:31:14', 6, NULL, NULL),
(852, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-03', '2025-07-07 07:31:47', '2025-07-07 07:31:47', 6, NULL, NULL),
(853, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 12.91, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-03', '2025-07-07 07:32:34', '2025-07-07 07:32:34', 6, NULL, NULL),
(854, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-03', '2025-07-07 07:33:24', '2025-07-07 07:33:24', 6, NULL, NULL),
(855, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 14.92, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-04-01', '2025-07-07 07:46:42', '2025-07-07 07:46:42', 6, NULL, NULL),
(856, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 0.30, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-04-01', '2025-07-07 07:49:48', '2025-07-07 07:49:48', 6, NULL, NULL),
(857, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 82.38, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-01', '2025-07-07 07:54:40', '2025-07-07 07:54:40', 6, NULL, NULL),
(858, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 63.36, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-01', '2025-07-07 07:56:13', '2025-07-07 07:56:13', 6, NULL, NULL),
(859, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 44.67, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-01', '2025-07-07 07:57:18', '2025-07-07 07:57:18', 6, NULL, NULL),
(860, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 4.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-01', '2025-07-07 07:57:53', '2025-07-07 07:57:53', 6, NULL, NULL),
(861, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 112.09, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-02', '2025-07-07 08:14:45', '2025-07-07 08:14:45', 6, NULL, NULL),
(862, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-02', '2025-07-07 08:15:47', '2025-07-07 08:15:47', 6, NULL, NULL),
(863, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 31.19, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-03', '2025-07-07 08:18:08', '2025-07-07 08:18:08', 6, NULL, NULL),
(864, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 34.11, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-03', '2025-07-07 08:18:48', '2025-07-07 08:18:48', 6, NULL, NULL),
(865, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 34.74, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-03', '2025-07-07 08:19:36', '2025-07-07 08:19:36', 6, NULL, NULL),
(866, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 148.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-03', '2025-07-07 08:20:35', '2025-07-07 08:20:35', 6, NULL, NULL),
(867, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 47.64, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-04', '2025-07-07 08:22:21', '2025-07-07 08:22:21', 6, NULL, NULL),
(868, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-04', '2025-07-07 08:23:09', '2025-07-07 08:23:09', 6, NULL, NULL),
(869, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 68.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-04', '2025-07-07 08:23:56', '2025-07-07 08:23:56', 6, NULL, NULL),
(870, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-05', '2025-07-07 08:25:26', '2025-07-07 08:25:26', 6, NULL, NULL),
(871, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 34.74, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-05', '2025-07-07 08:28:57', '2025-07-07 08:28:57', 6, NULL, NULL),
(872, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 74.44, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-05', '2025-07-07 08:29:44', '2025-07-07 08:29:44', 6, NULL, NULL),
(873, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543/ اسحاق علي', '2025-04-06', '2025-07-07 08:31:52', '2025-07-07 08:31:52', 6, NULL, NULL),
(874, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-07', '2025-07-07 08:33:53', '2025-07-07 08:33:53', 6, NULL, NULL),
(875, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-04-07', '2025-07-07 08:35:41', '2025-07-07 08:35:41', 6, NULL, NULL),
(876, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 77.98, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-07', '2025-07-07 08:38:08', '2025-07-07 08:38:08', 6, NULL, NULL),
(877, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-08', '2025-07-07 08:39:32', '2025-07-07 08:39:32', 6, NULL, NULL),
(878, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 38.99, 'غير خاضع للضريبة', '11733556 / ثامن الصديق', '2025-04-09', '2025-07-07 08:41:29', '2025-07-07 08:41:29', 6, NULL, NULL),
(879, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-09', '2025-07-07 08:42:39', '2025-07-07 08:42:39', 6, NULL, NULL),
(880, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 14.62, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-12', '2025-07-07 08:44:54', '2025-07-07 08:44:54', 6, NULL, NULL),
(881, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-12', '2025-07-07 08:45:54', '2025-07-07 08:45:54', 6, NULL, NULL),
(882, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 50.69, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-12', '2025-07-07 08:46:29', '2025-07-07 08:46:29', 6, NULL, NULL),
(883, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 66.28, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-13', '2025-07-07 08:47:32', '2025-07-07 08:47:32', 6, NULL, NULL),
(884, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-14', '2025-07-07 08:48:27', '2025-07-07 08:48:27', 6, NULL, NULL),
(885, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 44.67, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-15', '2025-07-07 08:49:21', '2025-07-07 08:49:21', 6, NULL, NULL),
(886, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 74.44, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-07 08:50:02', '2025-07-07 08:50:02', 6, NULL, NULL),
(887, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 97.47, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-07 08:50:57', '2025-07-07 08:50:57', 6, NULL, NULL),
(888, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-17', '2025-07-07 08:52:53', '2025-07-07 08:52:53', 6, NULL, NULL),
(889, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733550/ امير احمد', '2025-04-17', '2025-07-07 08:53:57', '2025-07-07 08:53:57', 6, NULL, NULL),
(890, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-17', '2025-07-07 08:54:50', '2025-07-07 08:54:50', 6, NULL, NULL),
(891, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 36.07, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-18', '2025-07-07 08:56:22', '2025-07-07 08:56:22', 6, NULL, NULL),
(892, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 36.07, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-18', '2025-07-07 08:56:48', '2025-07-07 08:57:34', 6, NULL, NULL),
(893, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 68.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-19', '2025-07-07 09:04:56', '2025-07-07 09:04:56', 6, NULL, NULL),
(894, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 158.80, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-19', '2025-07-07 09:05:46', '2025-07-07 09:05:46', 6, NULL, NULL),
(895, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-07 09:07:15', '2025-07-07 09:07:15', 6, NULL, NULL),
(896, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 24.37, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-07 09:08:02', '2025-07-07 09:08:02', 6, NULL, NULL),
(897, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 79.40, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-07 09:08:42', '2025-07-07 09:08:42', 6, NULL, NULL),
(898, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 101.24, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-20', '2025-07-07 09:09:36', '2025-07-07 09:10:55', 6, NULL, NULL),
(899, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-21', '2025-07-07 09:18:59', '2025-07-07 09:18:59', 6, NULL, NULL),
(900, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-04-21', '2025-07-07 09:19:40', '2025-07-07 09:19:40', 6, NULL, NULL),
(901, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 43.86, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-21', '2025-07-07 09:20:25', '2025-07-07 09:20:25', 6, NULL, NULL),
(902, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 58.48, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-22', '2025-07-07 09:21:36', '2025-07-07 09:21:36', 6, NULL, NULL),
(903, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 77.98, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-22', '2025-07-07 09:22:16', '2025-07-07 09:22:16', 6, NULL, NULL),
(904, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-24', '2025-07-07 09:23:39', '2025-07-07 09:23:39', 6, NULL, NULL),
(905, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 37.71, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-25', '2025-07-07 09:24:57', '2025-07-07 09:24:57', 6, NULL, NULL),
(906, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-26', '2025-07-07 09:31:15', '2025-07-07 09:31:15', 6, NULL, NULL),
(907, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-26', '2025-07-07 09:31:55', '2025-07-07 09:31:55', 6, NULL, NULL),
(908, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-26', '2025-07-07 09:32:45', '2025-07-07 09:32:45', 6, NULL, NULL),
(909, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-26', '2025-07-07 09:33:25', '2025-07-07 09:33:25', 6, NULL, NULL),
(910, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 24.28, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-27', '2025-07-07 09:35:17', '2025-07-07 09:35:17', 6, NULL, NULL),
(911, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-27', '2025-07-07 09:36:26', '2025-07-07 09:36:26', 6, NULL, NULL),
(912, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 34.74, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-28', '2025-07-07 09:39:23', '2025-07-07 09:39:23', 6, NULL, NULL),
(913, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 38.99, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-28', '2025-07-07 09:40:18', '2025-07-07 09:40:18', 6, NULL, NULL),
(914, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 138.50, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-29', '2025-07-07 09:41:21', '2025-07-07 09:41:21', 6, NULL, NULL),
(915, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 14.62, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-30', '2025-07-07 09:42:15', '2025-07-07 09:42:15', 6, NULL, NULL),
(916, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-30', '2025-07-07 09:42:54', '2025-07-07 09:42:54', 6, NULL, NULL),
(917, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-30', '2025-07-07 09:43:27', '2025-07-07 09:43:27', 6, NULL, NULL),
(918, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-30', '2025-07-07 09:44:13', '2025-07-07 09:44:13', 6, NULL, NULL),
(919, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 0.73, 'غير خاضع للضريبة', '11733543 / اسحاق علي / ضريبة نقاط بيع', '2025-04-01', '2025-07-08 06:38:42', '2025-07-08 06:38:42', 5, NULL, NULL),
(920, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 6.70, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-01', '2025-07-08 06:40:03', '2025-07-08 06:40:03', 5, NULL, NULL),
(921, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 9.50, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-01', '2025-07-08 06:41:39', '2025-07-08 06:41:39', 5, NULL, NULL),
(922, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 12.36, 'غير خاضع للضريبة', '11733553 / محمد رشد / نقاط بيع', '2025-04-01', '2025-07-08 06:43:06', '2025-07-08 06:43:06', 5, NULL, NULL),
(923, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.19, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-04-01', '2025-07-08 06:44:48', '2025-07-08 06:44:48', 5, NULL, NULL),
(924, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 16.81, 'غير خاضع للضريبة', '11733553 / محمد رشد/ نقاط بيع', '2025-04-02', '2025-07-08 06:47:03', '2025-07-08 06:47:03', 5, NULL, NULL),
(925, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 5.96, 'غير خاضع للضريبة', '11733556 / ثامن صديق / نقاط البيع', '2025-04-02', '2025-07-08 06:53:40', '2025-07-08 06:53:40', 5, NULL, NULL),
(926, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 4.68, 'غير خاضع للضريبة', '11733553 / محمد رشد / نقاط بيع', '2025-04-03', '2025-07-08 06:56:25', '2025-07-08 06:56:25', 5, NULL, NULL),
(927, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 5.12, 'غير خاضع للضريبة', '11733550 / امير احمد / نقاط البيع', '2025-04-03', '2025-07-08 06:58:33', '2025-07-08 06:58:33', 5, NULL, NULL),
(928, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 5.20, 'غير خاضع للضريبة', '11733556 / ثامن صديق / نقاط البيع', '2025-04-03', '2025-07-08 06:59:57', '2025-07-08 06:59:57', 5, NULL, NULL),
(929, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 22.33, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط البيع', '2025-04-03', '2025-07-08 07:01:45', '2025-07-08 07:01:45', 5, NULL, NULL),
(930, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 7.15, 'غير خاضع للضريبة', '11733556 / ثامن صديق /  نقاط بيع', '2025-04-04', '2025-07-08 07:07:54', '2025-07-08 07:07:54', 5, NULL, NULL),
(931, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.44, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-04', '2025-07-08 07:12:48', '2025-07-08 07:12:48', 5, NULL, NULL),
(932, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 10.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-04', '2025-07-08 07:25:53', '2025-07-08 07:25:53', 5, NULL, NULL),
(933, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733550 / امير احمد / نقاط بيع', '2025-04-05', '2025-07-08 07:35:06', '2025-07-08 07:35:06', 5, NULL, NULL),
(934, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 5.15, 'غير خاضع للضريبة', '11733547 / محمد عربي / نقاط البيع', '2025-04-05', '2025-07-08 07:36:32', '2025-07-08 07:36:32', 5, NULL, NULL),
(935, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 11.17, 'غير خاضع للضريبة', '11733556 / ثامن صديق /نقاط البيع', '2025-04-05', '2025-07-08 07:38:13', '2025-07-08 07:38:13', 5, NULL, NULL),
(936, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543/ اسحاق علي / نقاط بيع', '2025-04-06', '2025-07-08 07:41:07', '2025-07-08 07:41:47', 5, NULL, NULL),
(937, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.96, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط البيع', '2025-04-07', '2025-07-08 07:44:01', '2025-07-08 07:44:01', 5, NULL, NULL),
(938, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 7.31, 'غير خاضع للضريبة', '11733556 / ثامن صديق / نقاط بيع', '2025-04-07', '2025-07-08 07:45:20', '2025-07-08 07:45:20', 5, NULL, NULL),
(939, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 11.70, 'غير خاضع للضريبة', '11733553 / محمد رشد / نقاط البيع', '2025-04-07', '2025-07-08 07:46:52', '2025-07-08 07:46:52', 5, NULL, NULL),
(940, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.92, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقاط بيع', '2025-04-08', '2025-07-08 07:56:23', '2025-07-08 07:56:23', 5, NULL, NULL),
(941, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 5.85, 'غير خاضع للضريبة', '11733556 / ثامن الصديق / نقاطالبيع', '2025-04-09', '2025-07-08 08:11:00', '2025-07-08 08:11:00', 5, NULL, NULL),
(942, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.20, 'غير خاضع للضريبة', '11733543 / اسحاق علي / نقا بيع', '2025-04-09', '2025-07-08 08:13:14', '2025-07-08 08:13:14', 5, NULL, NULL),
(943, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.19, 'غير خاضع للضريبة', '11733550 / امير احمد / نقاط البيع', '2025-04-12', '2025-07-08 08:38:13', '2025-07-08 08:38:13', 5, NULL, NULL),
(944, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.19, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-30', '2025-07-08 08:41:12', '2025-07-08 08:42:54', 5, NULL, NULL),
(945, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 15.05, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-12', '2025-07-08 08:48:09', '2025-07-08 08:49:14', 5, NULL, NULL),
(946, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 9.94, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-13', '2025-07-08 08:51:10', '2025-07-08 08:51:10', 5, NULL, NULL),
(947, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-14', '2025-07-08 08:52:40', '2025-07-08 08:52:40', 5, NULL, NULL),
(948, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 6.70, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-15', '2025-07-08 08:54:48', '2025-07-08 08:54:48', 5, NULL, NULL),
(949, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 11.17, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-08 08:55:57', '2025-07-08 08:56:40', 5, NULL, NULL),
(950, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 14.62, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-15', '2025-07-08 08:57:46', '2025-07-08 08:57:46', 5, NULL, NULL),
(951, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.44, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-17', '2025-07-08 08:59:58', '2025-07-08 08:59:58', 5, NULL, NULL),
(952, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 17.87, 'غير خاضع للضريبة', '11733550/ امير احمد', '2025-04-17', '2025-07-08 09:01:50', '2025-07-08 09:01:50', 5, NULL, NULL),
(953, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 11.12, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-18', '2025-07-08 09:06:30', '2025-07-08 09:06:30', 5, NULL, NULL),
(954, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 34.05, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-19', '2025-07-08 09:08:39', '2025-07-08 09:08:39', 5, NULL, NULL),
(955, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 16.01, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-20', '2025-07-08 09:13:09', '2025-07-08 09:13:09', 5, NULL, NULL),
(956, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 15.18, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-20', '2025-07-08 09:16:09', '2025-07-08 09:16:09', 5, NULL, NULL),
(957, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 4.39, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-21', '2025-07-08 09:24:27', '2025-07-08 09:24:27', 5, NULL, NULL),
(958, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-04-21', '2025-07-08 09:25:45', '2025-07-08 09:25:45', 5, NULL, NULL),
(959, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 6.58, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-21', '2025-07-08 09:28:17', '2025-07-08 09:28:17', 5, NULL, NULL),
(960, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.78, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-22', '2025-07-08 09:30:15', '2025-07-08 09:30:15', 5, NULL, NULL),
(961, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 11.70, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-22', '2025-07-08 09:31:51', '2025-07-08 09:31:51', 5, NULL, NULL),
(962, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 7.44, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-24', '2025-07-08 09:33:26', '2025-07-08 09:33:26', 5, NULL, NULL),
(963, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 5.66, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-04-25', '2025-07-08 09:35:17', '2025-07-08 09:35:17', 5, NULL, NULL),
(964, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-30', '2025-07-08 09:54:05', '2025-07-08 09:54:05', 5, NULL, NULL),
(965, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-30', '2025-07-08 09:54:55', '2025-07-08 09:54:55', 5, NULL, NULL),
(966, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 5.96, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-30', '2025-07-08 09:55:50', '2025-07-08 09:55:50', 5, NULL, NULL),
(967, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 20.78, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-29', '2025-07-08 09:56:53', '2025-07-08 09:56:53', 5, NULL, NULL),
(968, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.21, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-28', '2025-07-08 10:03:36', '2025-07-08 10:03:36', 5, NULL, NULL),
(969, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 5.85, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-28', '2025-07-08 10:04:27', '2025-07-08 10:04:27', 5, NULL, NULL),
(970, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 3.64, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-27', '2025-07-08 10:06:21', '2025-07-08 10:06:21', 5, NULL, NULL),
(971, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-27', '2025-07-08 10:07:38', '2025-07-08 10:07:38', 5, NULL, NULL),
(972, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.90, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-04-26', '2025-07-08 10:09:26', '2025-07-08 10:09:26', 5, NULL, NULL),
(973, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-04-26', '2025-07-08 10:11:46', '2025-07-08 10:11:46', 5, NULL, NULL),
(974, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 5.96, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-04-26', '2025-07-08 10:12:40', '2025-07-08 10:12:40', 5, NULL, NULL),
(975, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 26.48, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-01', '2025-07-08 10:35:29', '2025-07-08 10:35:29', 5, NULL, NULL),
(976, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 8.93, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-02', '2025-07-08 10:37:13', '2025-07-08 10:37:13', 5, NULL, NULL),
(977, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 21.20, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-03', '2025-07-08 10:42:16', '2025-07-08 10:42:16', 5, NULL, NULL),
(978, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-03', '2025-07-08 10:44:54', '2025-07-08 10:44:54', 5, NULL, NULL),
(979, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-03', '2025-07-08 10:45:47', '2025-07-08 10:45:47', 5, NULL, NULL),
(980, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 1.94, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-03', '2025-07-08 10:46:45', '2025-07-08 10:46:45', 5, NULL, NULL),
(981, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-03', '2025-07-08 10:47:44', '2025-07-08 10:47:44', 5, NULL, NULL),
(982, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 3.66, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-04', '2025-07-08 10:52:52', '2025-07-08 10:52:52', 5, NULL, NULL),
(983, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 3.72, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-04', '2025-07-08 10:54:34', '2025-07-08 10:54:34', 5, NULL, NULL),
(984, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 11.91, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-04', '2025-07-08 10:55:36', '2025-07-08 10:56:28', 5, NULL, NULL),
(985, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-05', '2025-07-08 10:59:10', '2025-07-08 10:59:10', 5, NULL, NULL),
(986, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 2.68, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-05', '2025-07-08 11:00:17', '2025-07-08 11:00:17', 5, NULL, NULL),
(987, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.19, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-05', '2025-07-08 11:01:38', '2025-07-08 11:01:38', 5, NULL, NULL),
(988, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 19.35, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-05-05', '2025-07-08 11:02:40', '2025-07-08 11:02:40', 5, NULL, NULL),
(989, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-07', '2025-07-08 11:12:02', '2025-07-08 11:12:02', 5, NULL, NULL),
(990, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 12.56, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-07', '2025-07-08 11:13:02', '2025-07-08 11:13:02', 5, NULL, NULL),
(991, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 6.80, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-09', '2025-07-08 11:14:02', '2025-07-08 11:14:02', 5, NULL, NULL),
(992, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-10', '2025-07-08 11:15:12', '2025-07-08 11:15:12', 6, NULL, NULL),
(993, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-10', '2025-07-08 11:17:59', '2025-07-08 11:17:59', 5, NULL, NULL),
(994, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 3.22, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-11', '2025-07-08 11:27:55', '2025-07-08 11:27:55', 5, NULL, NULL),
(995, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 0.74, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-12', '2025-07-08 11:29:00', '2025-07-08 11:29:00', 5, NULL, NULL),
(996, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-13', '2025-07-08 11:30:26', '2025-07-08 11:30:26', 5, NULL, NULL),
(997, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 3.22, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-15', '2025-07-08 11:31:37', '2025-07-08 11:31:37', 5, NULL, NULL),
(998, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 8.80, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-17', '2025-07-08 11:40:30', '2025-07-08 11:40:30', 5, NULL, NULL),
(999, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-18', '2025-07-08 11:41:34', '2025-07-08 11:41:34', 5, NULL, NULL),
(1000, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.44, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-19', '2025-07-08 11:42:35', '2025-07-08 11:42:35', 5, NULL, NULL),
(1001, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-21', '2025-07-08 11:51:40', '2025-07-08 11:51:40', 5, NULL, NULL),
(1002, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 7.02, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-21', '2025-07-08 11:52:43', '2025-07-08 11:52:43', 5, NULL, NULL),
(1003, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.21, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-24', '2025-07-08 11:59:31', '2025-07-08 11:59:31', 5, NULL, NULL),
(1004, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.49, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-24', '2025-07-08 12:00:39', '2025-07-08 12:00:39', 5, NULL, NULL),
(1005, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-05-25', '2025-07-08 12:02:09', '2025-07-08 12:02:09', 5, NULL, NULL),
(1006, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.36, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-26', '2025-07-08 12:03:56', '2025-07-08 12:03:56', 5, NULL, NULL),
(1007, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.86, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-05-30', '2025-07-08 12:07:22', '2025-07-08 12:07:22', 5, NULL, NULL),
(1008, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-30', '2025-07-08 12:09:12', '2025-07-08 12:09:12', 5, NULL, NULL),
(1009, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-05-31', '2025-07-08 12:11:21', '2025-07-08 12:11:21', 5, NULL, NULL),
(1010, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733548 / نبيل', '2025-05-31', '2025-07-08 12:13:06', '2025-07-08 12:13:06', 5, NULL, NULL),
(1011, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 2.92, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-05-31', '2025-07-08 12:14:31', '2025-07-08 12:14:31', 5, NULL, NULL),
(1012, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.51, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-06-29', '2025-07-08 13:23:42', '2025-07-08 13:23:42', 5, NULL, NULL),
(1013, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-06-28', '2025-07-08 13:29:53', '2025-07-08 13:29:53', 5, NULL, NULL),
(1014, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-06-28', '2025-07-08 13:31:25', '2025-07-08 13:31:25', 5, NULL, NULL),
(1015, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.40, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-06-27', '2025-07-08 13:33:47', '2025-07-08 13:33:47', 5, NULL, NULL),
(1016, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 11.91, 'غير خاضع للضريبة', '11733553 / محمد رشد /نقاط بيع', '2025-06-25', '2025-07-08 13:36:21', '2025-07-08 13:36:21', 5, NULL, NULL),
(1017, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 2.53, 'غير خاضع للضريبة', 'نقاط بيع / امير احمد / 11733550', '2025-06-23', '2025-07-08 13:37:45', '2025-07-08 13:37:45', 5, NULL, NULL),
(1018, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 5.96, 'غير خاضع للضريبة', '11733548/ نبيل /نقاط بيع', '2025-06-23', '2025-07-08 13:39:20', '2025-07-08 13:39:20', 5, NULL, NULL),
(1019, 'قبض', 'موظف', 24, NULL, 'كاش', 300.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-08', '2025-07-08 16:18:11', '2025-07-08 16:18:11', NULL, NULL, NULL),
(1020, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-09', '2025-07-09 16:45:54', '2025-07-09 16:45:54', NULL, NULL, NULL),
(1021, 'قبض', 'موظف', 25, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-09', '2025-07-09 16:46:34', '2025-07-09 16:46:34', NULL, NULL, NULL),
(1022, 'قبض', 'موظف', 25, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-10', '2025-07-10 17:40:16', '2025-07-10 17:40:16', NULL, NULL, NULL),
(1023, 'قبض', 'موظف', 24, NULL, 'كاش', 375.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-11', '2025-07-11 17:24:33', '2025-07-11 17:24:33', NULL, NULL, NULL),
(1024, 'قبض', 'موظف', 17, NULL, 'كاش', 360.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-11', '2025-07-11 17:29:57', '2025-07-11 17:29:57', NULL, NULL, NULL),
(1025, 'قبض', 'موظف', 25, NULL, 'كاش', 140.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-11', '2025-07-11 18:12:58', '2025-07-11 18:12:58', NULL, NULL, NULL),
(1026, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-06', '2025-07-12 08:43:21', '2025-07-12 08:43:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1027, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-06', '2025-07-12 08:45:48', '2025-07-12 08:45:48', 6, NULL, NULL),
(1028, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-06', '2025-07-12 08:47:27', '2025-07-12 08:47:27', 5, NULL, NULL),
(1029, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-08', '2025-07-12 08:49:29', '2025-07-12 08:49:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1030, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-09', '2025-07-12 08:54:04', '2025-07-12 08:54:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1031, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-08', '2025-07-12 08:57:02', '2025-07-12 08:57:02', 6, NULL, NULL),
(1032, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-09', '2025-07-12 08:57:41', '2025-07-12 08:57:41', 6, NULL, NULL),
(1033, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-08', '2025-07-12 08:58:13', '2025-07-12 08:58:13', 5, NULL, NULL),
(1034, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-09', '2025-07-12 08:59:34', '2025-07-12 08:59:34', 5, NULL, NULL),
(1035, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 55.56, 'غير خاضع للضريبة', '11733553 /  محمد رشد', '2025-07-09', '2025-07-12 09:00:35', '2025-07-12 09:00:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1036, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 55.56, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-09', '2025-07-12 09:01:32', '2025-07-12 09:01:32', 6, NULL, NULL),
(1037, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 8.33, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-09', '2025-07-12 09:09:39', '2025-07-12 09:09:39', 5, NULL, NULL),
(1038, 'قبض', 'موظف', 25, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 15:27:50', '2025-07-12 15:27:50', NULL, NULL, NULL),
(1039, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 17:33:34', '2025-07-12 17:33:34', NULL, NULL, NULL),
(1040, 'قبض', 'موظف', 19, NULL, 'كاش', 950.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 18:26:13', '2025-07-12 18:26:13', NULL, NULL, NULL),
(1041, 'قبض', 'موظف', 17, NULL, 'كاش', 130.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 18:32:42', '2025-07-12 18:32:42', NULL, NULL, NULL),
(1042, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 18:39:09', '2025-07-12 18:39:09', NULL, NULL, NULL),
(1043, 'قبض', 'موظف', 7, NULL, 'كاش', 910.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-12', '2025-07-12 20:23:26', '2025-07-12 20:23:26', NULL, NULL, NULL),
(1044, 'قبض', 'موظف', 24, NULL, 'كاش', 170.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-13', '2025-07-14 17:47:28', '2025-07-14 17:47:28', NULL, NULL, NULL),
(1045, 'قبض', 'موظف', 17, NULL, 'كاش', 90.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-13', '2025-07-14 17:48:04', '2025-07-14 17:48:04', NULL, NULL, NULL),
(1046, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-14', '2025-07-14 19:22:37', '2025-07-14 19:22:37', NULL, NULL, NULL),
(1047, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 19:51:54', '2025-07-14 19:51:54', NULL, NULL, NULL),
(1048, 'قبض', 'موظف', 17, NULL, 'كاش', 120.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-14', '2025-07-14 20:11:18', '2025-07-14 20:11:18', NULL, NULL, NULL),
(1049, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:40:20', '2025-07-14 20:40:20', NULL, NULL, NULL),
(1050, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:41:29', '2025-07-14 20:41:29', NULL, NULL, NULL),
(1051, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:42:12', '2025-07-14 20:42:12', NULL, NULL, NULL),
(1052, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 1400.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:43:05', '2025-07-14 20:43:05', NULL, NULL, NULL),
(1053, 'تحويل داخلي', 'سيارة', 25, 17, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:44:53', '2025-07-14 20:44:53', NULL, NULL, NULL),
(1054, 'تحويل داخلي', 'جهة', 25, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق تجديد اقامة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:45:56', '2025-07-14 20:45:56', 1, NULL, NULL),
(1055, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:48:56', '2025-07-14 20:48:56', NULL, NULL, NULL),
(1056, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:55:59', '2025-07-14 20:55:59', NULL, NULL, NULL),
(1057, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 1050.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:56:50', '2025-07-14 20:56:50', NULL, NULL, NULL),
(1058, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 210.00, 'غير خاضع للضريبة', 'استحقاق تجيد اقامة  من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:57:47', '2025-07-14 20:57:47', 1, NULL, NULL),
(1059, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 1190.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 20:58:56', '2025-07-14 20:58:56', NULL, NULL, NULL),
(1060, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 21:00:40', '2025-07-14 21:00:40', NULL, NULL, NULL),
(1061, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 910.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 21:01:43', '2025-07-14 21:01:43', NULL, NULL, NULL),
(1062, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 21:02:55', '2025-07-14 21:02:55', NULL, NULL, NULL),
(1063, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 1120.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 5/7/2025 الى تاريخ 12/7/2025', '2025-07-12', '2025-07-14 21:02:58', '2025-07-14 21:02:58', NULL, NULL, NULL),
(1064, 'تحويل داخلي', 'سيارة', 67, 17, NULL, 70000.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 12/7/2025', '2025-07-12', '2025-07-14 21:05:28', '2025-07-14 21:05:28', NULL, NULL, NULL),
(1065, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 94.29, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-13', '2025-07-14 21:09:03', '2025-07-14 21:09:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1066, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 94.29, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-13', '2025-07-14 21:10:21', '2025-07-14 21:10:21', 6, NULL, NULL),
(1067, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 14.14, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-13', '2025-07-14 21:13:21', '2025-07-14 21:13:21', 5, NULL, NULL),
(1068, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-12', '2025-07-14 21:15:02', '2025-07-14 21:15:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1069, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 24.82, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-12', '2025-07-14 21:16:39', '2025-07-14 21:16:39', 6, NULL, NULL),
(1070, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 3.72, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-12', '2025-07-14 21:17:52', '2025-07-14 21:17:52', 5, NULL, NULL),
(1071, 'قبض', 'موظف', 67, NULL, 'تحويل بنكي', 20000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-09', '2025-07-15 15:31:18', '2025-07-15 15:31:18', NULL, NULL, 'شركة الجواب - بنك الرياض'),
(1072, 'قبض', 'موظف', 44, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-15', '2025-07-15 17:16:56', '2025-07-15 17:16:56', NULL, NULL, NULL),
(1073, 'قبض', 'موظف', 24, NULL, 'كاش', 90.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-15', '2025-07-15 17:32:25', '2025-07-15 17:32:25', NULL, NULL, NULL),
(1074, 'قبض', 'موظف', 12, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'خدمات', '2025-07-15', '2025-07-15 19:00:04', '2025-07-15 19:00:04', NULL, NULL, NULL),
(1075, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-16', '2025-07-16 17:43:24', '2025-07-16 17:43:24', NULL, NULL, NULL),
(1076, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-14', '2025-07-17 17:46:52', '2025-07-17 17:46:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1077, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-14', '2025-07-17 17:48:21', '2025-07-17 17:48:21', 6, NULL, NULL),
(1078, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733548 /نبيل', '2025-07-14', '2025-07-17 17:50:42', '2025-07-17 17:50:42', 5, NULL, NULL),
(1079, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-14', '2025-07-17 17:52:48', '2025-07-17 17:52:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1080, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-14', '2025-07-17 17:54:32', '2025-07-17 17:54:32', 6, NULL, NULL),
(1081, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 8.93, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-14', '2025-07-17 17:55:53', '2025-07-17 17:55:53', 5, NULL, NULL),
(1082, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-15', '2025-07-17 17:56:50', '2025-07-17 17:56:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1083, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 4.87, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-15', '2025-07-17 17:58:18', '2025-07-17 17:58:18', 6, NULL, NULL),
(1084, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 0.73, 'غير خاضع للضريبة', '11733543 / اسحاق علي', '2025-07-15', '2025-07-17 17:59:24', '2025-07-17 17:59:24', 5, NULL, NULL),
(1085, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 57.56, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-15', '2025-07-17 18:07:06', '2025-07-17 18:07:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1086, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 57.56, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-15', '2025-07-17 18:07:43', '2025-07-17 18:07:43', 6, NULL, NULL),
(1087, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 8.63, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-07-15', '2025-07-17 18:10:52', '2025-07-17 18:10:52', 5, NULL, NULL),
(1088, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-16', '2025-07-17 18:12:27', '2025-07-17 18:12:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1089, 'تحويل داخلي', 'موظف', 23, NULL, NULL, 68.23, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-16', '2025-07-17 18:13:29', '2025-07-17 18:13:29', 6, NULL, NULL),
(1090, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 10.23, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-07-16', '2025-07-17 18:15:22', '2025-07-17 18:15:22', 5, NULL, NULL),
(1091, 'قبض', 'موظف', 71, NULL, 'كاش', 200.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-17', '2025-07-17 19:02:16', '2025-07-17 19:02:16', NULL, NULL, NULL),
(1092, 'تحويل داخلي', 'سيارة', 15, 20, NULL, 3800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 13:55:25', '2025-07-19 13:55:25', NULL, NULL, NULL),
(1093, 'تحويل داخلي', 'سيارة', 21, 9, NULL, 3800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 13:59:55', '2025-07-19 13:59:55', NULL, NULL, NULL),
(1094, 'تحويل داخلي', 'سيارة', 43, 13, NULL, 3800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:01:58', '2025-07-19 14:01:58', NULL, NULL, NULL),
(1095, 'تحويل داخلي', 'سيارة', 12, 14, NULL, 3800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:02:52', '2025-07-19 14:02:52', NULL, NULL, NULL),
(1096, 'تحويل داخلي', 'سيارة', 5, 16, NULL, 3800.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:06:19', '2025-07-19 14:06:19', NULL, NULL, NULL);
INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(1097, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 3230.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:09:04', '2025-07-19 14:09:04', NULL, NULL, NULL),
(1098, 'تحويل داخلي', 'سيارة', 23, 15, NULL, 3230.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:10:00', '2025-07-19 14:10:00', NULL, NULL, NULL),
(1099, 'تحويل داخلي', 'سيارة', 44, 6, NULL, 2850.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:13:43', '2025-07-19 14:13:43', NULL, NULL, NULL),
(1100, 'تحويل داخلي', 'سيارة', 19, 3, NULL, 3230.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:15:01', '2025-07-19 14:15:01', NULL, NULL, NULL),
(1101, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 2470.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:16:42', '2025-07-19 14:16:42', NULL, NULL, NULL),
(1102, 'تحويل داخلي', 'سيارة', 20, 8, NULL, 3040.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:18:57', '2025-07-19 14:18:57', NULL, NULL, NULL),
(1103, 'تحويل داخلي', 'سيارة', 7, 1, NULL, 2470.00, 'غير خاضع للضريبة', 'استحقاق مركبة من تاريخ 13/7/2025 الى تاريخ 31/7/2025', '2025-07-31', '2025-07-19 14:20:09', '2025-07-19 14:20:09', NULL, NULL, NULL),
(1104, 'تحويل داخلي', 'جهة', 67, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'رسوم خدمه نقل كفالة مقيم', '2025-07-19', '2025-07-19 14:38:45', '2025-07-19 14:38:45', 8, NULL, NULL),
(1105, 'تحويل داخلي', 'جهة', 67, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'تعديل مهنة', '2025-07-19', '2025-07-19 14:42:13', '2025-07-19 14:42:13', 8, NULL, NULL),
(1106, 'تحويل داخلي', 'جهة', 67, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'تعديل مهنة', '2025-07-19', '2025-07-19 14:43:52', '2025-07-19 14:43:52', 8, NULL, NULL),
(1107, 'تحويل داخلي', 'جهة', 67, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'بطاقة تشغيل', '2025-07-19', '2025-07-19 14:46:20', '2025-07-19 14:46:20', 8, NULL, NULL),
(1108, 'تحويل داخلي', 'جهة', 67, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'بطاقة سائق', '2025-07-19', '2025-07-19 14:47:26', '2025-07-19 14:47:26', 8, NULL, NULL),
(1109, 'تحويل داخلي', 'جهة', 66, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'رسوم نقل كفالة', '2025-07-19', '2025-07-19 14:50:06', '2025-07-19 14:50:06', 8, NULL, NULL),
(1110, 'تحويل داخلي', 'جهة', 66, NULL, NULL, 150.00, 'غير خاضع للضريبة', 'تعديل المهنة', '2025-07-19', '2025-07-19 14:51:23', '2025-07-19 14:51:23', 8, NULL, NULL),
(1111, 'تحويل داخلي', 'جهة', 66, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'بطاقة تشغيل', '2025-07-19', '2025-07-19 14:52:28', '2025-07-19 14:52:28', 8, NULL, NULL),
(1112, 'تحويل داخلي', 'جهة', 66, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'بطاقة سائق', '2025-07-19', '2025-07-19 14:53:14', '2025-07-19 14:53:14', 8, NULL, NULL),
(1113, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-19', '2025-07-19 15:07:18', '2025-07-19 15:07:18', NULL, NULL, NULL),
(1114, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 10860.00, 'غير خاضع للضريبة', 'إيداع نقدي - صياف', '2025-04-06', '2025-07-19 15:11:06', '2025-07-19 15:11:06', 16, NULL, NULL),
(1115, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 8000.00, 'غير خاضع للضريبة', 'تحويل من حساب جاري - صياف', '2025-04-06', '2025-07-19 15:16:03', '2025-07-19 15:16:03', 16, NULL, NULL),
(1116, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'سداد فواتيـر خدمات عامة', '2025-04-07', '2025-07-19 15:18:53', '2025-07-19 15:18:53', 16, NULL, NULL),
(1117, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'عيدروس - حواله', '2025-04-09', '2025-07-19 15:24:16', '2025-07-19 15:24:16', 16, NULL, NULL),
(1118, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 17797.00, 'غير خاضع للضريبة', 'حواله - صادرة', '2025-04-09', '2025-07-19 15:25:42', '2025-07-19 17:48:56', 16, NULL, NULL),
(1119, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 1000.00, 'غير خاضع للضريبة', 'سداد فواتيـر خدمات عامة - مقيميين', '2025-04-20', '2025-07-19 15:27:35', '2025-07-19 15:27:35', 16, NULL, NULL),
(1120, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 1500.00, 'غير خاضع للضريبة', 'حواله  - احمد رازالله مهيا', '2025-05-07', '2025-07-19 15:29:53', '2025-07-19 15:29:53', 16, NULL, NULL),
(1121, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 3625.82, 'غير خاضع للضريبة', 'حوالة صادر - صيلف', '2025-05-11', '2025-07-19 15:31:14', '2025-07-19 15:31:14', 16, NULL, NULL),
(1122, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 62.76, 'غير خاضع للضريبة', 'خدمات الشركة - صياف', '2025-05-17', '2025-07-19 15:34:47', '2025-07-19 15:34:47', 16, NULL, NULL),
(1123, 'قبض', 'جهة', NULL, NULL, 'تحويل بنكي', 276.13, 'غير خاضع للضريبة', 'محكمة التنفيذ', '2025-05-25', '2025-07-19 15:37:23', '2025-07-19 15:37:41', 16, NULL, NULL),
(1124, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 9.92, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-06-26', '2025-07-19 16:04:46', '2025-07-19 16:04:46', 6, NULL, NULL),
(1125, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 1.49, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-06-26', '2025-07-19 16:06:48', '2025-07-19 16:06:48', 5, NULL, NULL),
(1126, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 4.99, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-05-25', '2025-07-19 16:08:08', '2025-07-19 16:08:08', 6, NULL, NULL),
(1127, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 0.75, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-05-25', '2025-07-19 16:11:03', '2025-07-19 16:11:03', 5, NULL, NULL),
(1128, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 49.62, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-07-05', '2025-07-19 16:13:52', '2025-07-19 16:13:52', 6, NULL, NULL),
(1129, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 7.44, 'غير خاضع للضريبة', '11733560 / نقاط بيع / جعفر', '2025-07-05', '2025-07-19 16:18:55', '2025-07-19 16:18:55', 5, NULL, NULL),
(1130, 'قبض', 'موظف', 7, NULL, 'كاش', 870.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-19', '2025-07-19 17:50:45', '2025-07-19 17:50:45', NULL, NULL, NULL),
(1131, 'قبض', 'موظف', 24, NULL, 'كاش', 230.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-19', '2025-07-19 17:55:40', '2025-07-19 17:55:40', NULL, NULL, NULL),
(1132, 'قبض', 'موظف', 19, NULL, 'كاش', 700.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-19', '2025-07-19 18:09:40', '2025-07-19 18:09:40', NULL, NULL, NULL),
(1133, 'قبض', 'موظف', 17, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-19', '2025-07-19 20:17:17', '2025-07-19 20:17:17', NULL, NULL, NULL),
(1134, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 28.78, 'غير خاضع للضريبة', '11733559', '2025-01-01', '2025-07-20 15:50:41', '2025-07-20 15:50:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1135, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-01', '2025-07-20 15:53:44', '2025-07-20 15:53:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1136, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 47.76, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-01', '2025-07-20 15:54:57', '2025-07-20 15:54:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1137, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733552', '2025-01-01', '2025-07-20 16:06:48', '2025-07-20 16:06:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1138, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733543', '2025-01-01', '2025-07-20 16:23:53', '2025-07-20 16:23:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1139, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733550', '2025-01-01', '2025-07-20 16:32:54', '2025-07-20 16:32:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1140, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733552', '2025-01-02', '2025-07-20 16:41:30', '2025-07-20 16:41:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1141, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-01-02', '2025-07-20 16:43:47', '2025-07-20 16:43:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1142, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-01-02', '2025-07-20 16:50:56', '2025-07-20 16:50:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1143, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733552', '2025-01-02', '2025-07-20 16:51:58', '2025-07-20 16:51:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1144, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-07-20 16:56:15', '2025-07-20 16:56:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1145, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 57.56, 'غير خاضع للضريبة', '11733559', '2025-01-02', '2025-07-20 17:14:46', '2025-07-20 17:14:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1146, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733540', '2025-01-02', '2025-07-20 17:27:00', '2025-07-20 17:27:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1147, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733550 /  امير احمد', '2025-01-02', '2025-07-20 17:28:43', '2025-07-20 17:28:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1148, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733558', '2025-01-02', '2025-07-20 17:30:24', '2025-07-20 17:30:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1149, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 99.42, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-07-20 17:33:22', '2025-07-20 17:33:22', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1150, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-20', '2025-07-20 17:37:04', '2025-07-20 17:37:04', NULL, NULL, NULL),
(1151, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 0.01, 'غير خاضع للضريبة', '11733558', '2025-01-03', '2025-07-20 17:39:27', '2025-07-20 17:39:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1152, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-04', '2025-07-20 17:43:17', '2025-07-20 17:43:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1153, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-03', '2025-07-20 17:50:33', '2025-07-20 17:50:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1154, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733558', '2025-01-04', '2025-07-20 17:51:44', '2025-07-20 17:51:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1155, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-01-04', '2025-07-20 17:53:13', '2025-07-20 17:53:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1156, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733540', '2025-01-04', '2025-07-20 17:55:32', '2025-07-20 17:55:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1157, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 62.53, 'غير خاضع للضريبة', '11733550', '2025-01-04', '2025-07-20 18:40:04', '2025-07-20 18:40:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1158, 'قبض', 'موظف', 44, NULL, 'كاش', 800.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-20', '2025-07-20 18:44:11', '2025-07-20 18:44:11', NULL, NULL, NULL),
(1159, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 81.39, 'غير خاضع للضريبة', '11733558', '2025-01-04', '2025-07-20 19:29:14', '2025-07-20 19:29:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1160, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.56, 'غير خاضع للضريبة', '11733558', '2025-01-04', '2025-07-20 19:30:07', '2025-07-20 19:30:07', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1161, 'تحويل داخلي', 'سيارة', 72, 16, NULL, 100000.00, 'غير خاضع للضريبة', 'استحقاق مركبة', '2025-07-20', '2025-07-20 19:50:16', '2025-07-20 19:50:16', NULL, NULL, NULL),
(1162, 'قبض', 'موظف', 72, NULL, 'كاش', 40000.00, 'غير خاضع للضريبة', 'دفعة مقدمة', '2025-07-20', '2025-07-20 19:51:07', '2025-07-20 19:51:07', NULL, NULL, NULL),
(1163, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733552', '2025-01-05', '2025-07-20 19:54:24', '2025-07-20 19:54:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1164, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 53.61, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-05', '2025-07-20 20:00:08', '2025-07-20 20:00:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1165, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733558', '2025-01-05', '2025-07-20 20:01:14', '2025-07-20 20:01:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1166, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 67.49, 'غير خاضع للضريبة', '11733543', '2025-01-05', '2025-07-20 20:11:05', '2025-07-20 20:11:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1167, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 27.79, 'غير خاضع للضريبة', '11733552', '2025-01-06', '2025-07-20 20:16:00', '2025-07-20 20:16:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1168, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733553', '2025-01-06', '2025-07-20 20:20:19', '2025-07-20 20:20:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1169, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733547', '2025-01-06', '2025-07-20 20:21:49', '2025-07-20 20:21:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1170, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 92.31, 'غير خاضع للضريبة', '11733558', '2025-01-06', '2025-07-20 20:23:54', '2025-07-20 20:23:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1171, 'قبض', 'موظف', 73, NULL, 'كاش', 3000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-23', '2025-07-23 18:25:19', '2025-07-23 18:25:19', NULL, NULL, NULL),
(1172, 'قبض', 'موظف', 24, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تحصيل', '2025-07-21', '2025-07-23 20:01:11', '2025-07-23 20:01:11', NULL, NULL, NULL),
(1173, 'قبض', 'موظف', 72, NULL, 'كاش', 10000.00, 'غير خاضع للضريبة', 'دفعة', '2025-07-22', '2025-07-23 20:03:23', '2025-07-23 20:03:23', NULL, NULL, NULL),
(1174, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 14550.00, 'غير خاضع للضريبة', 'مديونية رخصة العمل', '2025-07-24', '2025-07-24 10:54:02', '2025-07-24 10:54:02', 1, NULL, NULL),
(1175, 'تحويل داخلي', 'سيارة', 24, 18, NULL, 6000.00, 'غير خاضع للضريبة', 'رسوم استهلاك مركبة', '2025-07-24', '2025-07-24 10:55:55', '2025-07-24 10:55:55', NULL, NULL, NULL),
(1176, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733551', '2025-01-07', '2025-07-26 08:21:59', '2025-07-26 08:21:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1177, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.84, 'غير خاضع للضريبة', '11733547', '2025-01-07', '2025-07-26 08:23:21', '2025-07-26 08:23:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1178, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.90, 'غير خاضع للضريبة', '11733551', '2025-01-05', '2025-07-26 08:26:51', '2025-07-26 08:26:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1179, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733552', '2025-01-07', '2025-07-26 08:28:08', '2025-07-26 08:28:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1180, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-01-07', '2025-07-26 08:28:49', '2025-07-26 08:28:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1181, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733543', '2025-01-07', '2025-07-26 08:29:38', '2025-07-26 08:29:38', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1182, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 749.36, 'غير خاضع للضريبة', '11733551', '2025-01-07', '2025-07-26 08:31:33', '2025-07-26 08:31:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1183, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 16.87, 'غير خاضع للضريبة', '11733547', '2025-01-08', '2025-07-26 08:33:01', '2025-07-26 08:33:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1184, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.45, 'غير خاضع للضريبة', '11733551', '2025-01-08', '2025-07-26 08:34:13', '2025-07-26 08:34:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1185, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 741.41, 'غير خاضع للضريبة', '11733551', '2025-01-08', '2025-07-26 08:36:45', '2025-07-26 08:36:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1186, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.45, 'غير خاضع للضريبة', '11733551', '2025-01-09', '2025-07-26 08:38:46', '2025-07-26 08:38:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1187, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 46.64, 'غير خاضع للضريبة', '11733552', '2025-01-09', '2025-07-26 08:42:35', '2025-07-26 08:42:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1188, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543', '2025-01-09', '2025-07-26 09:03:57', '2025-07-26 09:03:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1189, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733558', '2025-01-09', '2025-07-26 09:06:00', '2025-07-26 09:06:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1190, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733553', '2025-01-09', '2025-07-26 09:06:43', '2025-07-26 09:06:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1191, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 2703.65, 'غير خاضع للضريبة', '11733551', '2025-01-09', '2025-07-26 09:07:35', '2025-07-26 09:07:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1192, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 22.83, 'غير خاضع للضريبة', '11733550', '2025-01-11', '2025-07-26 09:08:59', '2025-07-26 09:08:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1193, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 28.78, 'غير خاضع للضريبة', '11733547', '2025-01-11', '2025-07-26 09:16:37', '2025-07-26 09:16:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1194, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.25, 'غير خاضع للضريبة', '11733550', '2025-01-10', '2025-07-26 09:17:52', '2025-07-26 09:18:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1195, 'قبض', 'جهة', NULL, NULL, 'كاش', 35.73, 'غير خاضع للضريبة', '11733559', '2025-01-11', '2025-07-26 09:19:31', '2025-07-26 09:19:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1196, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733543', '2025-01-11', '2025-07-26 09:21:39', '2025-07-26 09:21:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1197, 'قبض', 'جهة', NULL, NULL, 'كاش', 2129.96, 'غير خاضع للضريبة', '11733551', '2025-01-10', '2025-07-26 09:22:35', '2025-07-26 09:22:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1198, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733543', '2025-01-12', '2025-07-26 09:49:04', '2025-07-26 09:49:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1199, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733558', '2025-01-12', '2025-07-26 09:53:21', '2025-07-26 09:53:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1200, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 65.51, 'غير خاضع للضريبة', '11733559', '2025-01-12', '2025-07-26 09:55:23', '2025-07-26 09:55:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1201, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 121.84, 'غير خاضع للضريبة', '11733543', '2025-01-12', '2025-07-26 09:56:32', '2025-07-26 09:56:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1202, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 23.82, 'غير خاضع للضريبة', '11733552', '2025-01-12', '2025-07-26 09:58:23', '2025-07-26 09:58:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1203, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733553', '2025-01-14', '2025-07-26 09:59:42', '2025-07-26 09:59:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1204, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 109.17, 'غير خاضع للضريبة', '11733543', '2025-01-14', '2025-07-26 10:00:40', '2025-07-26 10:00:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1205, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733556', '2025-01-14', '2025-07-26 10:04:52', '2025-07-26 10:04:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1206, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 35.73, 'غير خاضع للضريبة', '11733553', '2025-01-15', '2025-07-26 10:07:52', '2025-07-26 10:07:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1207, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733553', '2025-01-15', '2025-07-26 10:13:27', '2025-07-26 10:13:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1208, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733552', '2025-01-15', '2025-07-26 10:14:35', '2025-07-26 10:14:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1209, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733552', '2025-01-16', '2025-07-26 10:16:53', '2025-07-26 10:16:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1210, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543', '2025-01-16', '2025-07-26 10:17:36', '2025-07-26 10:17:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1211, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 119.10, 'غير خاضع للضريبة', '11733556', '2025-01-16', '2025-07-26 10:19:45', '2025-07-26 10:19:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1212, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733547', '2025-01-18', '2025-07-26 10:22:10', '2025-07-26 10:22:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1213, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 31.76, 'غير خاضع للضريبة', '11733552', '2025-01-18', '2025-07-26 10:23:40', '2025-07-26 10:23:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1214, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733552', '2025-01-17', '2025-07-26 10:29:01', '2025-07-26 10:29:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1215, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733559', '2025-01-18', '2025-07-26 10:29:46', '2025-07-26 10:32:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1216, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733543', '2025-01-18', '2025-07-26 10:35:44', '2025-07-26 10:35:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1217, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 78.41, 'غير خاضع للضريبة', '11733553', '2025-01-18', '2025-07-26 10:36:37', '2025-07-26 10:36:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1218, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 99.25, 'غير خاضع للضريبة', '11733558', '2025-01-18', '2025-07-26 10:38:34', '2025-07-26 10:38:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1219, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.83, 'غير خاضع للضريبة', '11733543', '2025-01-19', '2025-07-26 10:39:53', '2025-07-26 10:40:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1220, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733550', '2025-01-19', '2025-07-26 10:41:17', '2025-07-26 10:41:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1221, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 83.37, 'غير خاضع للضريبة', '11733550', '2025-01-20', '2025-07-26 10:42:15', '2025-07-26 10:42:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1222, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 23.82, 'غير خاضع للضريبة', '11733559', '2025-01-21', '2025-07-26 10:43:31', '2025-07-26 10:43:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1223, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 27.29, 'غير خاضع للضريبة', '11733550', '2025-01-21', '2025-07-26 10:47:29', '2025-07-26 10:47:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1224, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 55.59, 'غير خاضع للضريبة', '11733550', '2025-01-21', '2025-07-26 10:49:16', '2025-07-26 10:49:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1225, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 65.31, 'غير خاضع للضريبة', '11733553', '2025-01-21', '2025-07-26 10:50:24', '2025-07-26 10:50:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1226, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 16.57, 'غير خاضع للضريبة', '11733550', '2025-01-22', '2025-07-26 10:54:45', '2025-07-26 10:54:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1227, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 25.80, 'غير خاضع للضريبة', '11733553', '2025-01-22', '2025-07-26 10:55:51', '2025-07-26 10:55:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1228, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 66.28, 'غير خاضع للضريبة', '11733543', '2025-01-22', '2025-07-26 10:56:49', '2025-07-26 10:56:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1229, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 126.71, 'غير خاضع للضريبة', '11733543', '2025-01-22', '2025-07-26 10:58:21', '2025-07-26 10:58:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1230, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-01-23', '2025-07-26 10:59:31', '2025-07-26 10:59:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1231, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.75, 'غير خاضع للضريبة', '11733552', '2025-01-25', '2025-07-26 11:03:48', '2025-07-26 11:03:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1232, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 22.83, 'غير خاضع للضريبة', '11733553', '2025-01-24', '2025-07-26 11:05:44', '2025-07-26 11:05:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1233, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733559', '2025-01-24', '2025-07-26 11:12:45', '2025-07-26 11:12:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1234, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543', '2025-01-25', '2025-07-26 11:14:50', '2025-07-26 11:14:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1235, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733547', '2025-01-25', '2025-07-26 11:16:32', '2025-07-26 11:16:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1236, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 87.72, 'غير خاضع للضريبة', '11733553', '2025-01-25', '2025-07-26 11:17:19', '2025-07-26 11:17:19', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1237, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 106.20, 'غير خاضع للضريبة', '11733559', '2025-01-25', '2025-07-26 11:19:16', '2025-07-26 11:19:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1238, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 113.07, 'غير خاضع للضريبة', '11733558', '2025-01-24', '2025-07-26 11:21:22', '2025-07-26 11:21:22', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1239, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733553', '2025-01-26', '2025-07-26 11:29:01', '2025-07-26 11:29:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1240, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.31, 'غير خاضع للضريبة', '11733543', '2025-01-26', '2025-07-26 11:29:47', '2025-07-26 11:29:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1241, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 129.02, 'غير خاضع للضريبة', '11733543', '2025-01-26', '2025-07-26 11:31:37', '2025-07-26 11:31:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1242, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-01-27', '2025-07-26 11:32:52', '2025-07-26 11:32:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1243, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733550', '2025-01-28', '2025-07-26 11:39:26', '2025-07-26 11:39:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1244, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733543', '2025-01-28', '2025-07-26 11:40:42', '2025-07-26 11:40:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1245, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 124.07, 'غير خاضع للضريبة', '11733543', '2025-01-28', '2025-07-26 11:41:47', '2025-07-26 11:41:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1246, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733543', '2025-01-29', '2025-07-26 11:43:47', '2025-07-26 11:43:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1247, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733560', '2025-01-30', '2025-07-26 11:46:29', '2025-07-26 11:46:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1248, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733552', '2025-01-30', '2025-07-26 11:47:36', '2025-07-26 11:47:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1249, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543', '2025-01-30', '2025-07-26 11:50:23', '2025-07-26 11:50:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1250, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733553', '2025-01-30', '2025-07-26 11:51:06', '2025-07-26 11:51:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1251, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733552', '2025-01-31', '2025-07-26 11:52:24', '2025-07-26 11:52:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1252, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733553', '2025-01-31', '2025-07-26 11:54:53', '2025-07-26 11:54:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1253, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543', '2025-01-31', '2025-07-26 11:56:59', '2025-07-26 11:56:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1254, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733556', '2025-02-01', '2025-07-26 12:37:02', '2025-07-26 12:37:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1255, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 31.19, 'غير خاضع للضريبة', '11733556', '2025-02-01', '2025-07-26 12:41:41', '2025-07-26 12:41:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1256, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733558', '2025-02-01', '2025-07-26 12:43:50', '2025-07-26 12:43:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1257, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 52.63, 'غير خاضع للضريبة', '11733553', '2025-02-01', '2025-07-26 12:47:59', '2025-07-26 12:47:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1258, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 66.49, 'غير خاضع للضريبة', '11733559', '2025-02-01', '2025-07-26 12:54:13', '2025-07-26 12:54:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1259, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733543', '2025-02-01', '2025-07-26 12:58:16', '2025-07-26 12:58:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1260, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733552', '2025-02-02', '2025-07-26 13:13:26', '2025-07-26 13:13:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1261, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-02-18', '2025-07-27 09:59:26', '2025-07-27 10:02:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1262, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 94.29, 'غير خاضع للضريبة', '11733543', '2025-07-17', '2025-07-27 10:05:35', '2025-07-27 10:05:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1263, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 94.29, 'غير خاضع للضريبة', '11733543', '2025-07-17', '2025-07-27 10:07:32', '2025-07-27 10:07:32', 6, NULL, NULL),
(1264, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 14.14, 'غير خاضع للضريبة', '11733543', '2025-07-17', '2025-07-27 10:11:34', '2025-07-27 10:11:34', 5, NULL, NULL),
(1265, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733560', '2025-07-18', '2025-07-27 10:13:02', '2025-07-27 10:13:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1266, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733560', '2025-07-18', '2025-07-27 10:15:19', '2025-07-27 10:15:19', 6, NULL, NULL),
(1267, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 2.20, 'غير خاضع للضريبة', '11733560', '2025-07-18', '2025-07-27 10:18:03', '2025-07-27 10:18:03', 5, NULL, NULL),
(1268, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543', '2025-07-19', '2025-07-27 10:22:09', '2025-07-27 10:22:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1269, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733543', '2025-07-19', '2025-07-27 10:25:20', '2025-07-27 10:25:20', 6, NULL, NULL),
(1270, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543', '2025-07-19', '2025-07-27 10:27:22', '2025-07-27 10:27:22', 6, NULL, NULL),
(1271, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543 (تحويل خطا )', '2025-07-19', '2025-07-27 10:29:47', '2025-07-27 10:29:47', 6, NULL, NULL),
(1272, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733543', '2025-07-19', '2025-07-27 10:31:17', '2025-07-27 10:31:17', 5, NULL, NULL),
(1273, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.75, 'غير خاضع للضريبة', '11733543', '2025-07-20', '2025-07-27 10:40:09', '2025-07-27 10:40:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1274, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 9.75, 'غير خاضع للضريبة', '11733543', '2025-07-20', '2025-07-27 10:41:17', '2025-07-27 10:41:17', 6, NULL, NULL),
(1275, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 1.46, 'غير خاضع للضريبة', '11733543', '2025-07-20', '2025-07-27 10:42:10', '2025-07-27 10:42:10', 5, NULL, NULL),
(1276, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733547', '2025-07-20', '2025-07-27 10:45:40', '2025-07-27 10:45:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1277, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733547', '2025-07-20', '2025-07-27 10:48:35', '2025-07-27 10:48:35', 6, NULL, NULL),
(1278, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733547', '2025-07-20', '2025-07-27 10:49:39', '2025-07-27 10:49:39', 5, NULL, NULL),
(1279, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733560', '2025-07-20', '2025-07-27 10:51:56', '2025-07-27 10:51:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1280, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 39.70, 'غير خاضع للضريبة', '11733560', '2025-07-20', '2025-07-27 10:52:56', '2025-07-27 10:52:56', 6, NULL, NULL),
(1281, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 5.56, 'غير خاضع للضريبة', '11733560', '2025-07-20', '2025-07-27 10:53:52', '2025-07-27 10:53:52', 5, NULL, NULL),
(1282, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548', '2025-07-21', '2025-07-27 10:54:49', '2025-07-27 10:54:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1283, 'تحويل داخلي', 'موظف', 17, NULL, NULL, 19.85, 'غير خاضع للضريبة', '11733548', '2025-07-21', '2025-07-27 10:55:48', '2025-07-27 10:55:48', 6, NULL, NULL),
(1284, 'تحويل داخلي', 'جهة', 17, NULL, NULL, 2.98, 'غير خاضع للضريبة', '11733548', '2025-07-21', '2025-07-27 10:56:39', '2025-07-27 10:56:39', 5, NULL, NULL),
(1285, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.87, 'غير خاضع للضريبة', '11733547', '2025-07-22', '2025-07-27 10:58:35', '2025-07-27 10:58:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1286, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 4.87, 'غير خاضع للضريبة', '11733547', '2025-07-22', '2025-07-27 11:01:00', '2025-07-27 11:01:00', 6, NULL, NULL),
(1287, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 0.73, 'غير خاضع للضريبة', '11733547', '2025-07-22', '2025-07-27 11:03:15', '2025-07-27 11:03:15', 5, NULL, NULL),
(1288, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733560', '2025-07-22', '2025-07-27 11:04:03', '2025-07-27 11:04:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1289, 'تحويل داخلي', 'موظف', 7, NULL, NULL, 29.77, 'غير خاضع للضريبة', '11733560', '2025-07-22', '2025-07-27 11:05:22', '2025-07-27 11:05:22', 6, NULL, NULL),
(1290, 'تحويل داخلي', 'جهة', 7, NULL, NULL, 4.47, 'غير خاضع للضريبة', '11733560', '2025-07-22', '2025-07-27 11:06:45', '2025-07-27 11:06:45', 5, NULL, NULL),
(1291, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-07-23', '2025-07-27 11:08:58', '2025-07-27 11:08:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1292, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733543', '2025-07-23', '2025-07-27 11:10:11', '2025-07-27 11:10:11', 6, NULL, NULL),
(1293, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.30, 'غير خاضع للضريبة', '11733543', '2025-07-23', '2025-07-27 11:13:04', '2025-07-27 11:13:04', 5, NULL, NULL),
(1294, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:14:24', '2025-07-27 11:14:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1295, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:14:54', '2025-07-27 11:14:54', 6, NULL, NULL),
(1296, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:15:37', '2025-07-27 11:15:37', 5, NULL, NULL),
(1297, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 63.36, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:17:21', '2025-07-27 11:17:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1298, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 63.36, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:18:00', '2025-07-27 11:18:00', 6, NULL, NULL),
(1299, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 9.50, 'غير خاضع للضريبة', '11733543', '2025-07-24', '2025-07-27 11:19:58', '2025-07-27 11:19:58', 5, NULL, NULL),
(1300, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-07-26', '2025-07-27 11:20:47', '2025-07-27 11:20:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1301, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 48.73, 'غير خاضع للضريبة', '11733543', '2025-07-26', '2025-07-27 11:22:04', '2025-07-27 11:22:04', 6, NULL, NULL),
(1302, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 7.30, 'غير خاضع للضريبة', '11733543', '2025-07-26', '2025-07-27 11:23:22', '2025-07-27 11:23:22', 5, NULL, NULL),
(1303, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733550', '2025-02-02', '2025-07-27 11:42:51', '2025-07-27 11:42:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1304, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.72, 'غير خاضع للضريبة', '11733558', '2025-02-02', '2025-07-27 11:47:20', '2025-07-27 11:47:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1305, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733550', '2025-02-02', '2025-07-27 11:48:50', '2025-07-27 11:48:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1306, 'قبض', 'جهة', NULL, NULL, 'كاش', 58.48, 'غير خاضع للضريبة', '11733553', '2025-02-02', '2025-07-27 11:52:08', '2025-07-27 11:52:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1307, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 175.45, 'غير خاضع للضريبة', '11733558', '2025-02-02', '2025-07-27 11:53:01', '2025-07-27 11:53:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1308, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 51.61, 'غير خاضع للضريبة', '11733550', '2025-02-03', '2025-07-27 11:56:04', '2025-07-27 11:56:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1309, 'قبض', 'جهة', NULL, NULL, 'كاش', 22.83, 'غير خاضع للضريبة', '11733558', '2025-02-04', '2025-07-27 12:04:13', '2025-07-27 12:04:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1310, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543', '2025-02-05', '2025-07-27 12:18:18', '2025-07-27 12:18:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1311, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733543', '2025-02-06', '2025-07-27 12:19:16', '2025-07-27 12:19:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1312, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 53.60, 'غير خاضع للضريبة', '11733558', '2025-02-06', '2025-07-27 12:22:02', '2025-07-27 12:22:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1313, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733552', '2025-02-07', '2025-07-27 12:24:51', '2025-07-27 12:24:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1314, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733553', '2025-02-07', '2025-07-27 12:27:14', '2025-07-27 12:27:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1315, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 27.79, 'غير خاضع للضريبة', '11733547', '2025-02-07', '2025-07-27 12:40:18', '2025-07-27 12:40:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1316, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543', '2025-02-07', '2025-07-27 12:41:30', '2025-07-27 12:41:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1317, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 40.94, 'غير خاضع للضريبة', '11733550', '2025-02-07', '2025-07-27 12:43:04', '2025-07-27 12:43:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1318, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 77.98, 'غير خاضع للضريبة', '11733543', '2025-02-08', '2025-07-27 12:44:51', '2025-07-27 12:44:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1319, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 124.07, 'غير خاضع للضريبة', '11733543', '2025-02-08', '2025-07-27 12:46:41', '2025-07-27 12:46:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1320, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 17.86, 'غير خاضع للضريبة', '11733553', '2025-02-09', '2025-07-27 12:48:31', '2025-07-27 12:48:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1321, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.48, 'غير خاضع للضريبة', '11733556', '2025-02-09', '2025-07-27 12:50:20', '2025-07-27 12:50:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1322, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733556', '2025-02-10', '2025-07-27 12:51:50', '2025-07-27 12:51:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1323, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543', '2025-02-10', '2025-07-27 12:53:01', '2025-07-27 12:53:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1324, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733547', '2025-02-10', '2025-07-27 12:53:49', '2025-07-27 12:53:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1325, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 37.03, 'غير خاضع للضريبة', '11733553', '2025-02-10', '2025-07-27 12:54:23', '2025-07-27 12:54:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1326, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 42.68, 'غير خاضع للضريبة', '11733559', '2025-02-10', '2025-07-27 12:55:14', '2025-07-27 12:55:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1327, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733560', '2025-02-10', '2025-07-27 12:55:50', '2025-07-27 12:55:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1328, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733553', '2025-02-10', '2025-07-27 12:57:03', '2025-07-27 12:57:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1329, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543', '2025-02-11', '2025-07-27 13:14:42', '2025-07-27 13:14:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1330, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733552', '2025-02-10', '2025-07-27 13:15:33', '2025-07-27 13:15:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1331, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733556', '2025-02-11', '2025-07-27 13:17:02', '2025-07-27 13:17:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1332, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 53.89, 'غير خاضع للضريبة', '11733547', '2025-02-11', '2025-07-27 13:17:49', '2025-07-27 13:17:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1333, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.97, 'غير خاضع للضريبة', '11733556', '2025-02-12', '2025-07-27 13:19:12', '2025-07-27 13:19:12', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1334, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 32.16, 'غير خاضع للضريبة', '11733553', '2025-02-12', '2025-07-27 13:20:31', '2025-07-27 13:20:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1335, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733556', '2025-02-13', '2025-07-27 13:23:21', '2025-07-27 13:23:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1336, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 26.79, 'غير خاضع للضريبة', '11733559', '2025-02-13', '2025-07-27 13:24:53', '2025-07-27 13:24:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1337, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 16.87, 'غير خاضع للضريبة', '11733553', '2025-02-15', '2025-07-27 13:25:46', '2025-07-27 13:25:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1338, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 21.84, 'غير خاضع للضريبة', '11733547', '2025-02-14', '2025-07-27 13:27:14', '2025-07-27 13:27:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1339, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 23.82, 'غير خاضع للضريبة', '11733559', '2025-02-15', '2025-07-27 13:38:58', '2025-07-27 13:38:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1340, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733556', '2025-02-15', '2025-07-27 13:41:36', '2025-07-27 13:41:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1341, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733559', '2025-02-14', '2025-07-27 13:42:52', '2025-07-27 13:42:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1342, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733556', '2025-02-15', '2025-07-27 13:44:15', '2025-07-27 13:44:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1343, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733550', '2025-02-14', '2025-07-27 13:45:58', '2025-07-27 13:45:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1344, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733560', '2025-02-16', '2025-07-28 08:58:40', '2025-07-28 08:58:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1345, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733559', '2025-02-16', '2025-07-28 09:04:50', '2025-07-28 09:04:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1346, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 51.66, 'غير خاضع للضريبة', '11733553', '2025-02-16', '2025-07-28 09:07:42', '2025-07-28 09:07:42', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1347, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733543', '2025-02-16', '2025-07-28 09:15:38', '2025-07-28 09:15:38', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1348, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 82.85, 'غير خاضع للضريبة', '11733558', '2025-02-16', '2025-07-28 09:24:17', '2025-07-28 09:24:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1349, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733550', '2025-02-17', '2025-07-28 09:47:32', '2025-07-28 09:47:32', 6, NULL, NULL),
(1350, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733558', '2025-02-17', '2025-07-28 09:49:28', '2025-07-28 09:49:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1351, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733556', '2025-02-17', '2025-07-28 09:51:21', '2025-07-28 09:51:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1352, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 43.21, 'غير خاضع للضريبة', '11733550', '2025-02-17', '2025-07-28 09:52:36', '2025-07-28 09:52:36', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1353, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733560', '2025-02-17', '2025-07-28 09:55:01', '2025-07-28 09:55:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1354, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733550', '2025-02-18', '2025-07-28 09:56:53', '2025-07-28 09:56:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1355, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 106.24, 'غير خاضع للضريبة', '11733556', '2025-02-18', '2025-07-28 09:57:46', '2025-07-28 09:57:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1356, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 27.79, 'غير خاضع للضريبة', '11733550', '2025-02-19', '2025-07-28 09:58:41', '2025-07-28 09:58:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1357, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733543', '2025-02-20', '2025-07-28 10:01:01', '2025-07-28 10:01:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1358, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.48, 'غير خاضع للضريبة', '11733559', '2025-02-20', '2025-07-28 10:12:51', '2025-07-28 10:12:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1359, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733553', '2025-02-20', '2025-07-28 10:14:44', '2025-07-28 10:14:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1360, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733550', '2025-02-22', '2025-07-28 10:16:44', '2025-07-28 10:44:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1361, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733543', '2025-02-21', '2025-07-28 10:45:27', '2025-07-28 10:45:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1362, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-02-22', '2025-07-28 10:46:32', '2025-07-28 10:46:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1363, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543', '2025-02-22', '2025-07-28 10:48:16', '2025-07-28 10:48:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1364, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 57.51, 'غير خاضع للضريبة', '11733553', '2025-02-21', '2025-07-28 10:49:05', '2025-07-28 10:49:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1365, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 198.50, 'غير خاضع للضريبة', '11733543', '2025-02-21', '2025-07-28 10:50:52', '2025-07-28 10:50:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1366, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 37.71, 'غير خاضع للضريبة', '11733550', '2025-02-23', '2025-07-28 10:52:34', '2025-07-28 10:52:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1367, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733543', '2025-02-24', '2025-07-28 10:54:54', '2025-07-28 10:54:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1368, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 53.60, 'غير خاضع للضريبة', '11733559', '2025-02-24', '2025-07-28 10:56:46', '2025-07-28 10:56:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1369, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 110.96, 'غير خاضع للضريبة', '11733550', '2025-02-24', '2025-07-28 10:57:32', '2025-07-28 10:57:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1370, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733552', '2025-02-25', '2025-07-28 11:00:05', '2025-07-28 11:00:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1371, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 33.75, 'غير خاضع للضريبة', '11733553', '2025-02-25', '2025-07-28 11:00:57', '2025-07-28 11:00:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1372, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733550', '2025-02-25', '2025-07-28 12:33:06', '2025-07-28 12:33:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1373, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 109.17, 'غير خاضع للضريبة', '11733543', '2025-02-25', '2025-07-28 12:33:48', '2025-07-28 12:33:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1374, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 126.05, 'غير خاضع للضريبة', '11733559', '2025-02-25', '2025-07-28 12:36:03', '2025-07-28 12:36:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1375, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543', '2025-02-26', '2025-07-28 12:36:47', '2025-07-28 12:36:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1376, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733560', '2025-02-26', '2025-07-28 12:37:24', '2025-07-28 12:37:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1377, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 33.63, 'غير خاضع للضريبة', '11733556', '2025-02-27', '2025-07-28 12:57:36', '2025-07-28 12:57:36', 6, NULL, 'شركة الجواب - بنك الرياض');
INSERT INTO `snds` (`id`, `type`, `client_type`, `employee_id`, `car_id`, `payment_method`, `amount`, `tax`, `description`, `date`, `created_at`, `updated_at`, `geha_id`, `bank`, `bank_account`) VALUES
(1378, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733556', '2025-02-27', '2025-07-28 12:59:53', '2025-07-28 12:59:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1379, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.72, 'غير خاضع للضريبة', '11733543', '2025-02-27', '2025-07-28 13:02:16', '2025-07-28 13:02:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1380, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.56, 'غير خاضع للضريبة', '11733559', '2025-02-27', '2025-07-28 13:04:33', '2025-07-28 13:04:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1381, 'تحويل داخلي', 'جهة', 15, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-28', '2025-07-28 16:21:02', '2025-07-28 16:21:02', 17, NULL, NULL),
(1382, 'تحويل داخلي', 'جهة', 28, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 05:58:23', '2025-07-29 05:58:23', 17, NULL, NULL),
(1383, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 05:59:50', '2025-07-29 05:59:50', 17, NULL, NULL),
(1384, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 06:00:24', '2025-07-29 06:00:24', 17, NULL, NULL),
(1385, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 42.68, 'غير خاضع للضريبة', '11733556- خطا وتم معالجتها', '2025-03-01', '2025-07-29 06:10:25', '2025-07-29 06:18:07', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1386, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733543', '2025-02-28', '2025-07-29 06:11:22', '2025-07-29 06:11:22', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1387, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 70.18, 'غير خاضع للضريبة', '11733558', '2025-02-28', '2025-07-29 06:12:39', '2025-07-29 06:12:39', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1388, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 94.75, 'غير خاضع للضريبة', '11733550', '2025-03-01', '2025-07-29 06:13:56', '2025-07-29 06:13:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1389, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 85.36, 'غير خاضع للضريبة', '11733556 - (تصحيح الخطا)', '2025-03-01', '2025-07-29 06:17:14', '2025-07-29 06:19:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1390, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 105.21, 'غير خاضع للضريبة', '11733559', '2025-03-01', '2025-07-29 06:32:51', '2025-07-29 06:32:51', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1391, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733543', '2025-03-02', '2025-07-29 06:33:37', '2025-07-29 06:33:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1392, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733553', '2025-03-02', '2025-07-29 06:34:25', '2025-07-29 06:34:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1393, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 46.78, 'غير خاضع للضريبة', '11733543', '2025-03-03', '2025-07-29 06:35:24', '2025-07-29 06:35:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1394, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 55.56, 'غير خاضع للضريبة', '11733558', '2025-03-03', '2025-07-29 06:37:47', '2025-07-29 06:37:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1395, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 56.53, 'غير خاضع للضريبة', '11733553', '2025-03-03', '2025-07-29 06:38:50', '2025-07-29 06:38:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1396, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733559', '2025-03-03', '2025-07-29 06:39:45', '2025-07-29 06:39:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1397, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733543', '2025-03-03', '2025-07-29 06:41:12', '2025-07-29 06:41:12', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1398, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 22.41, 'غير خاضع للضريبة', '11733556', '2025-03-04', '2025-07-29 06:42:23', '2025-07-29 06:42:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1399, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.01, 'غير خاضع للضريبة', '11733543', '2025-03-04', '2025-07-29 06:43:31', '2025-07-29 06:43:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1400, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733543', '2025-03-04', '2025-07-29 07:20:04', '2025-07-29 07:20:04', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1401, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 148.87, 'غير خاضع للضريبة', '11733550', '2025-03-04', '2025-07-29 07:21:40', '2025-07-29 07:21:40', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1402, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543', '2025-03-05', '2025-07-29 07:23:25', '2025-07-29 07:23:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1403, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 33.63, 'غير خاضع للضريبة', '11733556', '2025-03-05', '2025-07-29 07:24:06', '2025-07-29 07:24:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1404, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-03-05', '2025-07-29 07:25:10', '2025-07-29 07:25:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1405, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543', '2025-03-06', '2025-07-29 07:25:55', '2025-07-29 07:25:55', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1406, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.97, 'غير خاضع للضريبة', '11733547', '2025-03-06', '2025-07-29 07:26:49', '2025-07-29 07:26:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1407, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.65, 'غير خاضع للضريبة', '11733543', '2025-03-06', '2025-07-29 07:27:33', '2025-07-29 07:27:33', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1408, 'تحويل داخلي', 'سيارة', 29, 9, NULL, 345.00, 'غير خاضع للضريبة', 'اشتراكات تتبع سنوية', '2025-07-29', '2025-07-29 08:00:01', '2025-07-29 08:00:01', NULL, NULL, NULL),
(1409, 'تحويل داخلي', 'سيارة', 3, 2, NULL, 345.00, 'غير خاضع للضريبة', 'اشتراكات تتببع سنوية', '2025-07-29', '2025-07-29 08:03:35', '2025-07-29 08:03:35', NULL, NULL, NULL),
(1410, 'تحويل داخلي', 'سيارة', 8, 7, NULL, 345.00, 'غير خاضع للضريبة', 'اشتراكات تتبع سنوية', '2025-07-29', '2025-07-29 08:10:41', '2025-07-29 08:10:41', NULL, NULL, NULL),
(1411, 'تحويل داخلي', 'سيارة', 21, 5, NULL, 345.00, 'غير خاضع للضريبة', 'اشتراكات تتبع سنوية', '2025-07-29', '2025-07-29 08:12:52', '2025-07-29 08:12:52', NULL, NULL, NULL),
(1412, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733543', '2025-03-08', '2025-07-29 09:00:03', '2025-07-29 09:00:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1413, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733553', '2025-03-07', '2025-07-29 09:00:34', '2025-07-29 09:00:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1414, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.55, 'غير خاضع للضريبة', '11733556', '2025-03-08', '2025-07-29 09:01:25', '2025-07-29 09:01:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1415, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733550', '2025-03-07', '2025-07-29 09:05:17', '2025-07-29 09:05:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1416, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 126.71, 'غير خاضع للضريبة', '11733543', '2025-03-07', '2025-07-29 09:14:25', '2025-07-29 09:14:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1417, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733559', '2025-03-09', '2025-07-29 09:18:20', '2025-07-29 09:18:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1418, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733543', '2025-03-09', '2025-07-29 09:19:46', '2025-07-29 09:19:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1419, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733556', '2025-03-09', '2025-07-29 09:22:10', '2025-07-29 09:22:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1420, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733543', '2025-03-09', '2025-07-29 09:22:44', '2025-07-29 09:22:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1421, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 112.63, 'غير خاضع للضريبة', '11733553', '2025-03-09', '2025-07-29 09:25:28', '2025-07-29 09:25:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1422, 'صرف', 'جهة', NULL, NULL, 'كاش', 625.00, 'غير خاضع للضريبة', 'شراء كمبروزر للمكيف', '2025-07-28', '2025-07-29 10:04:23', '2025-07-29 10:04:23', 8, NULL, NULL),
(1423, 'صرف', 'جهة', NULL, NULL, 'كاش', 150.00, 'غير خاضع للضريبة', 'تصليح مكيف', '2025-07-28', '2025-07-29 10:07:00', '2025-07-29 10:07:00', 8, NULL, NULL),
(1424, 'تحويل داخلي', 'سيارة', 17, 11, NULL, 230.00, 'غير خاضع للضريبة', 'حساسات مقاعد وقاعدة شاشة  5456', '2025-07-28', '2025-07-29 10:09:45', '2025-07-29 10:09:45', NULL, NULL, NULL),
(1425, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 10:12:05', '2025-07-29 10:12:05', 17, NULL, NULL),
(1426, 'تحويل داخلي', 'جهة', 29, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة التشغيل', '2025-07-29', '2025-07-29 10:16:17', '2025-07-29 10:16:17', 17, NULL, NULL),
(1427, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 10:17:20', '2025-07-29 10:17:20', 17, NULL, NULL),
(1428, 'تحويل داخلي', 'جهة', 21, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة تشغيل', '2025-07-29', '2025-07-29 10:18:35', '2025-07-29 10:18:35', 17, NULL, NULL),
(1429, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733556', '2025-03-10', '2025-07-29 10:38:56', '2025-07-29 10:38:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1430, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 15.88, 'غير خاضع للضريبة', '11733556', '2025-03-11', '2025-07-29 10:45:03', '2025-07-29 10:45:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1431, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543', '2025-03-11', '2025-07-29 11:48:45', '2025-07-29 11:48:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1432, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733556', '2025-03-11', '2025-07-29 11:50:13', '2025-07-29 11:50:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1433, 'تحويل داخلي', 'جهة', 66, NULL, NULL, 20.00, 'غير خاضع للضريبة', '20 ريال تفويض تم', '2025-07-29', '2025-07-29 12:00:19', '2025-07-29 12:00:19', 18, NULL, NULL),
(1434, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733553', '2025-03-11', '2025-07-30 06:04:50', '2025-07-30 06:06:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1435, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733556', '2025-03-12', '2025-07-30 06:06:10', '2025-07-30 06:06:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1436, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 62.38, 'غير خاضع للضريبة', '11733543', '2025-03-12', '2025-07-30 06:07:45', '2025-07-30 06:07:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1437, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733553', '2025-03-12', '2025-07-30 06:09:01', '2025-07-30 06:09:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1438, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 17.86, 'غير خاضع للضريبة', '11733547', '2025-03-12', '2025-07-30 06:09:58', '2025-07-30 06:09:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1439, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733543', '2025-03-13', '2025-07-31 17:18:01', '2025-07-31 17:18:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1440, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 22.41, 'غير خاضع للضريبة', '11733553', '2025-03-13', '2025-07-31 17:23:23', '2025-07-31 17:23:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1441, 'تحويل داخلي', 'جهة', 14, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاق سائق', '2025-07-31', '2025-08-01 11:06:15', '2025-08-01 11:06:15', 17, NULL, NULL),
(1442, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 200.00, 'غير خاضع للضريبة', 'اصدار بطاقة سائق', '2025-07-31', '2025-08-01 11:07:37', '2025-08-01 11:07:37', 17, NULL, NULL),
(1443, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 26.79, 'غير خاضع للضريبة', '11733550', '2025-03-13', '2025-08-02 12:59:23', '2025-08-02 12:59:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1444, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 26.79, 'غير خاضع للضريبة', '11733559', '2025-03-13', '2025-08-02 14:05:00', '2025-08-02 14:05:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1445, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 46.64, 'غير خاضع للضريبة', '11733556', '2025-03-13', '2025-08-02 14:06:45', '2025-08-02 14:06:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1446, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 79.93, 'غير خاضع للضريبة', '11733556', '2025-03-13', '2025-08-02 14:12:11', '2025-08-02 14:12:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1447, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733556', '2025-03-14', '2025-08-02 14:14:52', '2025-08-02 14:14:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1448, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 17.86, 'غير خاضع للضريبة', '11733547', '2025-03-15', '2025-08-02 14:16:34', '2025-08-02 14:16:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1449, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 18.86, 'غير خاضع للضريبة', '11733543', '2025-03-14', '2025-08-02 14:21:45', '2025-08-02 14:21:45', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1450, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733543', '2025-03-15', '2025-08-02 15:10:09', '2025-08-02 15:10:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1451, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.74, 'غير خاضع للضريبة', '11733553', '2025-03-14', '2025-08-02 15:11:28', '2025-08-02 15:11:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1452, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733543', '2025-03-15', '2025-08-02 15:13:09', '2025-08-02 15:13:09', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1453, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 7.02, 'غير خاضع للضريبة', 'مشترايات (اسطنبه , تصوير)', '2025-07-30', '2025-08-02 15:20:42', '2025-08-02 15:20:42', 8, NULL, 'شركة الجواب - بنك الرياض'),
(1454, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 15:46:52', '2025-08-02 15:46:52', NULL, NULL, NULL),
(1455, 'قبض', 'موظف', 23, NULL, 'كاش', 2500.00, 'غير خاضع للضريبة', 'رسوم خدمات اقامة', '2025-08-02', '2025-08-02 15:48:12', '2025-08-02 15:48:12', NULL, NULL, NULL),
(1456, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733550', '2025-03-16', '2025-08-02 15:51:20', '2025-08-02 15:53:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1457, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 39.70, 'غير خاضع للضريبة', '11733558', '2025-03-14', '2025-08-02 15:51:50', '2025-08-02 15:51:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1458, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733559', '2025-03-15', '2025-08-02 15:56:18', '2025-08-02 15:56:18', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1459, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733556', '2025-03-14', '2025-08-02 15:58:48', '2025-08-02 15:58:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1460, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733553', '2025-03-14', '2025-08-02 15:59:50', '2025-08-02 15:59:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1461, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733556', '2025-03-15', '2025-08-02 16:00:41', '2025-08-02 16:00:41', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1462, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733556', '2025-03-16', '2025-08-02 16:04:15', '2025-08-02 16:04:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1463, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 43.86, 'غير خاضع للضريبة', '11733543', '2025-03-16', '2025-08-02 16:07:37', '2025-08-02 16:07:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1464, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 87.72, 'غير خاضع للضريبة', '11733556', '2025-03-16', '2025-08-02 16:09:47', '2025-08-02 16:09:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1465, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 180.64, 'غير خاضع للضريبة', '11733553', '2025-03-16', '2025-08-02 16:11:26', '2025-08-02 16:11:26', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1466, 'قبض', 'جهة', NULL, NULL, 'كاش', 14.89, 'غير خاضع للضريبة', '11733556', '2025-03-17', '2025-08-02 16:13:06', '2025-08-02 16:13:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1467, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 20.84, 'غير خاضع للضريبة', '11733560', '2025-03-17', '2025-08-02 16:40:13', '2025-08-02 16:40:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1468, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733543', '2025-03-17', '2025-08-02 16:40:58', '2025-08-02 16:40:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1469, 'قبض', 'موظف', 44, NULL, 'كاش', 1100.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 16:41:36', '2025-08-02 16:41:36', NULL, NULL, NULL),
(1470, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733556', '2025-03-17', '2025-08-02 16:41:43', '2025-08-02 16:41:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1471, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733559', '2025-03-17', '2025-08-02 16:42:29', '2025-08-02 16:42:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1472, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 64.52, 'غير خاضع للضريبة', '11733553', '2025-03-17', '2025-08-02 16:43:55', '2025-08-02 16:43:55', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1473, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 66.28, 'غير خاضع للضريبة', '11733553', '2025-03-17', '2025-08-02 16:45:10', '2025-08-02 16:45:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1474, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733547', '2025-03-17', '2025-08-02 16:45:48', '2025-08-02 16:45:48', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1475, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.62, 'غير خاضع للضريبة', '11733556', '2025-03-18', '2025-08-02 16:48:01', '2025-08-02 16:48:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1476, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733556', '2025-03-18', '2025-08-02 16:51:21', '2025-08-02 16:51:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1477, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733550', '2025-03-18', '2025-08-02 16:59:11', '2025-08-02 16:59:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1478, 'قبض', 'موظف', 19, NULL, 'كاش', 410.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 16:59:46', '2025-08-02 16:59:46', NULL, NULL, NULL),
(1479, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 34.11, 'غير خاضع للضريبة', '11733550', '2025-03-18', '2025-08-02 17:00:02', '2025-08-02 17:00:02', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1480, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733553', '2025-03-18', '2025-08-02 17:01:00', '2025-08-02 17:01:00', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1481, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733559', '2025-03-19', '2025-08-02 17:03:29', '2025-08-02 17:03:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1482, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733556', '2025-03-19', '2025-08-02 17:04:05', '2025-08-02 17:04:05', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1483, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733543', '2025-03-19', '2025-08-02 17:04:43', '2025-08-02 17:04:43', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1484, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 4.97, 'غير خاضع للضريبة', '11733548', '2025-03-20', '2025-08-02 17:05:52', '2025-08-02 17:05:52', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1485, 'قبض', 'موظف', 7, NULL, 'كاش', 1060.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 17:06:11', '2025-08-02 17:06:11', NULL, NULL, NULL),
(1486, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733550', '2025-03-20', '2025-08-02 17:06:34', '2025-08-02 17:06:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1487, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.37, 'غير خاضع للضريبة', '11733543', '2025-03-20', '2025-08-02 17:07:44', '2025-08-02 17:07:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1488, 'قبض', 'موظف', 7, NULL, 'كاش', 750.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 17:08:53', '2025-08-03 16:23:32', NULL, NULL, NULL),
(1489, 'قبض', 'موظف', 19, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-02', '2025-08-02 17:12:10', '2025-08-03 16:25:00', NULL, NULL, NULL),
(1490, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733553', '2025-03-20', '2025-08-02 17:25:14', '2025-08-02 17:30:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1491, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 63.52, 'غير خاضع للضريبة', '11733556', '2025-03-20', '2025-08-02 17:25:59', '2025-08-02 17:25:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1492, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733548', '2025-03-21', '2025-08-02 17:26:50', '2025-08-02 17:26:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1493, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733543', '2025-03-21', '2025-08-02 17:27:29', '2025-08-02 17:29:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1494, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 24.82, 'غير خاضع للضريبة', '11733559', '2025-03-22', '2025-08-02 17:28:35', '2025-08-02 17:28:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1495, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 28.26, 'غير خاضع للضريبة', '11733553', '2025-03-22', '2025-08-02 17:34:01', '2025-08-02 17:34:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1496, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 28.26, 'غير خاضع للضريبة', '11733556', '2025-03-22', '2025-08-02 17:35:29', '2025-08-02 17:35:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1497, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 36.72, 'غير خاضع للضريبة', '11733543', '2025-03-21', '2025-08-02 17:36:56', '2025-08-02 17:36:56', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1498, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 66.49, 'غير خاضع للضريبة', '11733556', '2025-03-22', '2025-08-02 17:38:01', '2025-08-02 17:38:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1499, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 74.44, 'غير خاضع للضريبة', '11733543', '2025-03-22', '2025-08-02 17:39:03', '2025-08-02 17:39:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1500, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 163.77, 'غير خاضع للضريبة', '11733559', '2025-03-21', '2025-08-02 17:40:01', '2025-08-02 17:40:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1501, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733556', '2025-03-23', '2025-08-03 14:57:34', '2025-08-03 14:57:34', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1502, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733559', '2025-03-23', '2025-08-03 14:58:37', '2025-08-03 14:58:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1503, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 18.52, 'غير خاضع للضريبة', '11733556', '2025-03-23', '2025-08-03 14:59:15', '2025-08-03 14:59:15', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1504, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.54, 'غير خاضع للضريبة', '11733543', '2025-03-23', '2025-08-03 15:08:47', '2025-08-03 15:08:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1505, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733550', '2025-03-23', '2025-08-03 15:11:11', '2025-08-03 15:11:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1506, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 73.10, 'غير خاضع للضريبة', '11733543', '2025-03-23', '2025-08-03 15:12:12', '2025-08-03 15:12:12', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1507, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733543', '2025-03-24', '2025-08-03 15:13:24', '2025-08-03 15:13:24', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1508, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733543', '2025-03-23', '2025-08-03 15:14:28', '2025-08-03 15:14:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1509, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 119.09, 'غير خاضع للضريبة', '11733556', '2025-03-24', '2025-08-03 15:17:06', '2025-08-03 15:17:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1510, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 14.89, 'غير خاضع للضريبة', '11733548', '2025-03-25', '2025-08-03 15:17:58', '2025-08-03 15:17:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1511, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.49, 'غير خاضع للضريبة', '11733556', '2025-03-25', '2025-08-03 15:19:14', '2025-08-03 15:19:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1512, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 23.39, 'غير خاضع للضريبة', '11733553', '2025-03-25', '2025-08-03 15:19:53', '2025-08-03 15:19:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1513, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 44.67, 'غير خاضع للضريبة', '11733543', '2025-03-25', '2025-08-03 15:20:31', '2025-08-03 15:20:31', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1514, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.49, 'غير خاضع للضريبة', '11733559', '2025-03-25', '2025-08-03 15:21:16', '2025-08-03 15:21:16', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1515, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 81.39, 'غير خاضع للضريبة', '11733556', '2025-03-25', '2025-08-03 15:21:53', '2025-08-03 15:21:53', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1516, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 87.72, 'غير خاضع للضريبة', '11733558', '2025-03-25', '2025-08-03 15:22:30', '2025-08-03 15:22:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1517, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 89.32, 'غير خاضع للضريبة', '11733553', '2025-03-25', '2025-08-03 15:23:08', '2025-08-03 15:23:08', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1518, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733558', '2025-03-25', '2025-08-03 15:23:54', '2025-08-03 15:23:54', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1519, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 119.09, 'غير خاضع للضريبة', '11733547', '2025-03-25', '2025-08-03 15:24:35', '2025-08-03 15:24:35', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1520, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 243.67, 'غير خاضع للضريبة', '11733543', '2025-03-25', '2025-08-03 15:25:29', '2025-08-03 15:25:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1521, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548', '2025-03-26', '2025-08-03 15:26:14', '2025-08-03 15:26:14', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1522, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733547', '2025-03-26', '2025-08-03 15:26:49', '2025-08-03 15:26:49', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1523, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 58.48, 'غير خاضع للضريبة', '11733556', '2025-03-26', '2025-08-03 15:27:28', '2025-08-03 15:27:28', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1524, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733556', '2025-03-26', '2025-08-03 15:38:52', '2025-08-03 15:54:37', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1525, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733556', '2025-03-27', '2025-08-03 15:42:55', '2025-08-03 15:48:27', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1526, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733556', '2025-03-26', '2025-08-03 15:47:01', '2025-08-03 15:47:01', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1527, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 93.30, 'غير خاضع للضريبة', '11733559', '2025-03-26', '2025-08-03 15:47:44', '2025-08-03 15:47:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1528, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 43.67, 'غير خاضع للضريبة', '11733559', '2025-03-27', '2025-08-03 15:50:38', '2025-08-03 15:50:38', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1529, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 49.62, 'غير خاضع للضريبة', '11733556', '2025-03-27', '2025-08-03 15:52:11', '2025-08-03 15:52:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1530, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 62.38, 'غير خاضع للضريبة', '11733556', '2025-03-27', '2025-08-03 15:52:47', '2025-08-03 15:52:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1531, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 97.47, 'غير خاضع للضريبة', '11733547', '2025-03-27', '2025-08-03 15:54:03', '2025-08-03 15:54:03', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1532, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 59.55, 'غير خاضع للضريبة', '11733556 -(خطا مكرر)', '2025-03-26', '2025-08-03 15:57:06', '2025-08-03 15:57:06', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1533, 'صرف', 'جهة', NULL, NULL, 'كاش', 65.00, 'غير خاضع للضريبة', 'شراء حبر', '2025-07-05', '2025-08-03 16:22:49', '2025-08-03 16:22:49', 8, NULL, 'شركة الجواب - بنك الرياض'),
(1534, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 25.31, 'غير خاضع للضريبة', '11733550', '2025-03-29', '2025-08-03 16:45:59', '2025-08-03 16:45:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1535, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.24, 'غير خاضع للضريبة', '11733556', '2025-03-29', '2025-08-03 16:48:46', '2025-08-03 16:48:46', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1536, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 29.77, 'غير خاضع للضريبة', '11733559', '2025-03-29', '2025-08-03 16:49:21', '2025-08-03 16:49:21', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1537, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 35.73, 'غير خاضع للضريبة', '11733558', '2025-03-28', '2025-08-03 16:49:57', '2025-08-03 16:49:57', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1538, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 48.73, 'غير خاضع للضريبة', '11733543', '2025-03-29', '2025-08-03 16:54:29', '2025-08-03 16:54:29', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1539, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 64.52, 'غير خاضع للضريبة', '11733556', '2025-03-28', '2025-08-03 16:56:25', '2025-08-03 16:56:25', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1540, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 64.52, 'غير خاضع للضريبة', '11733556', '2025-03-28', '2025-08-03 16:57:50', '2025-08-03 16:57:50', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1541, 'صرف', 'جهة', NULL, NULL, 'نقاط بيع', 64.52, 'غير خاضع للضريبة', '11733556 --(خطا مكرر)', '2025-03-28', '2025-08-03 17:00:02', '2025-08-03 17:00:58', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1542, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 68.23, 'غير خاضع للضريبة', '11733553', '2025-03-28', '2025-08-03 17:02:38', '2025-08-03 17:02:38', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1543, 'قبض', 'جهة', NULL, NULL, 'كاش', 69.47, 'غير خاضع للضريبة', '11733547', '2025-03-29', '2025-08-03 17:04:07', '2025-08-03 17:04:07', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1544, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 72.46, 'غير خاضع للضريبة', '11733559', '2025-03-28', '2025-08-03 17:26:47', '2025-08-03 17:26:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1545, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 89.32, 'غير خاضع للضريبة', '11733543', '2025-03-28', '2025-08-03 17:32:20', '2025-08-03 17:32:20', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1546, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 336.27, 'غير خاضع للضريبة', '11733556', '2025-03-28', '2025-08-03 17:36:13', '2025-08-03 17:36:13', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1547, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 38.99, 'غير خاضع للضريبة', '11733553', '2025-03-30', '2025-08-03 17:37:47', '2025-08-03 17:37:47', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1548, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 77.98, 'غير خاضع للضريبة', '11733543', '2025-03-31', '2025-08-03 17:38:23', '2025-08-03 17:38:23', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1549, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 9.92, 'غير خاضع للضريبة', '11733550', '2025-03-31', '2025-08-03 17:39:17', '2025-08-03 17:39:17', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1550, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 19.85, 'غير خاضع للضريبة', '11733548', '2025-03-31', '2025-08-03 17:39:59', '2025-08-03 17:39:59', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1551, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 69.47, 'غير خاضع للضريبة', '11733543', '2025-03-31', '2025-08-03 17:40:30', '2025-08-03 17:40:30', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1552, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 87.34, 'غير خاضع للضريبة', '11733559', '2025-03-31', '2025-08-03 17:41:11', '2025-08-03 17:41:11', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1553, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 93.36, 'غير خاضع للضريبة', '11733553', '2025-03-31', '2025-08-03 17:41:44', '2025-08-03 17:41:44', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1554, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 158.80, 'غير خاضع للضريبة', '11733556', '2025-03-31', '2025-08-03 17:42:32', '2025-08-03 17:42:32', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1555, 'قبض', 'جهة', NULL, NULL, 'نقاط بيع', 341.14, 'غير خاضع للضريبة', '11733558', '2025-03-31', '2025-08-03 17:44:10', '2025-08-03 17:44:10', 6, NULL, 'شركة الجواب - بنك الرياض'),
(1556, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-01', '2025-08-03 20:02:48', '2025-08-03 20:02:48', 6, NULL, NULL),
(1557, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.39, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-01', '2025-08-03 20:02:48', '2025-08-03 20:02:48', 5, NULL, NULL),
(1558, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 29.24, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-01-02', '2025-08-03 20:02:50', '2025-08-03 20:05:05', 6, NULL, NULL),
(1559, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 4.39, 'غير خاضع للضريبة', '11733553 / محمد رشد', '2025-01-02', '2025-08-03 20:02:50', '2025-08-03 20:05:59', 5, NULL, NULL),
(1560, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 47.76, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-01', '2025-08-03 20:08:58', '2025-08-03 20:08:58', 6, NULL, NULL),
(1561, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 7.16, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-01', '2025-08-03 20:08:58', '2025-08-03 20:08:58', 5, NULL, NULL),
(1562, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 58.48, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-01', '2025-08-03 20:13:05', '2025-08-03 20:13:05', 6, NULL, NULL),
(1563, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 8.77, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-01', '2025-08-03 20:13:05', '2025-08-03 20:13:05', 5, NULL, NULL),
(1564, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 59.55, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-01', '2025-08-03 20:15:16', '2025-08-03 20:15:16', 6, NULL, NULL),
(1565, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 8.93, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-01', '2025-08-03 20:15:16', '2025-08-03 20:15:16', 5, NULL, NULL),
(1566, 'تحويل داخلي', 'موظف', 44, NULL, NULL, 14.89, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-01-02', '2025-08-03 20:31:36', '2025-08-03 20:31:36', 6, NULL, NULL),
(1567, 'تحويل داخلي', 'جهة', 44, NULL, NULL, 2.23, 'غير خاضع للضريبة', '11733556 / ثامن صديق', '2025-01-02', '2025-08-03 20:31:36', '2025-08-03 20:31:36', 5, NULL, NULL),
(1568, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 44.67, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-08-03 20:34:03', '2025-08-03 20:34:03', 6, NULL, NULL),
(1569, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 6.70, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-08-03 20:34:03', '2025-08-03 20:34:03', 5, NULL, NULL),
(1570, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 68.23, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-02', '2025-08-04 15:08:16', '2025-08-04 15:08:16', 6, NULL, NULL),
(1571, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 10.23, 'غير خاضع للضريبة', '11733550 / امير احمد', '2025-01-02', '2025-08-04 15:08:16', '2025-08-04 15:08:16', 5, NULL, NULL),
(1572, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 99.42, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-08-04 15:10:30', '2025-08-04 15:10:30', 6, NULL, NULL),
(1573, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 14.91, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-02', '2025-08-04 15:10:30', '2025-08-04 15:10:30', 5, NULL, NULL),
(1574, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 19.49, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-04', '2025-08-04 15:11:46', '2025-08-04 15:11:46', 6, NULL, NULL),
(1575, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 2.92, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-04', '2025-08-04 15:11:46', '2025-08-04 15:11:46', 5, NULL, NULL),
(1576, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 38.99, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-03', '2025-08-04 15:13:17', '2025-08-04 15:13:49', 6, NULL, NULL),
(1577, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 5.85, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-04', '2025-08-04 15:13:17', '2025-08-04 15:13:17', 5, NULL, NULL),
(1578, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 38.90, 'غير خاضع للضريبة', 'خطا', '2025-01-04', '2025-08-04 15:24:26', '2025-08-04 15:26:08', 6, NULL, NULL),
(1579, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 5.84, 'غير خاضع للضريبة', 'خطا', '2025-01-04', '2025-08-04 15:24:26', '2025-08-04 15:27:36', 5, NULL, NULL),
(1580, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 38.90, 'غير خاضع للضريبة', 'خطا مكرر', '2025-01-04', '2025-08-04 15:29:04', '2025-08-04 15:29:04', 6, NULL, NULL),
(1581, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 5.84, 'غير خاضع للضريبة', 'خطا مكرر', '2025-01-04', '2025-08-04 15:30:10', '2025-08-04 15:30:10', 5, NULL, NULL),
(1582, 'تحويل داخلي', 'موظف', 24, NULL, NULL, 44.67, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-01-04', '2025-08-04 15:35:10', '2025-08-04 15:35:10', 6, NULL, NULL),
(1583, 'تحويل داخلي', 'جهة', 24, NULL, NULL, 6.70, 'غير خاضع للضريبة', '11733547 / محمد عربي', '2025-01-04', '2025-08-04 15:35:10', '2025-08-04 15:35:10', 5, NULL, NULL),
(1584, 'تحويل داخلي', 'موظف', 20, NULL, NULL, 62.53, 'غير خاضع للضريبة', '11733550', '2025-01-04', '2025-08-04 15:36:43', '2025-08-04 15:36:43', 6, NULL, NULL),
(1585, 'تحويل داخلي', 'جهة', 20, NULL, NULL, 9.38, 'غير خاضع للضريبة', '11733550', '2025-01-04', '2025-08-04 15:36:43', '2025-08-04 15:36:43', 5, NULL, NULL),
(1586, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 53.61, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-05', '2025-08-04 15:37:57', '2025-08-04 15:37:57', 6, NULL, NULL),
(1587, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 8.04, 'غير خاضع للضريبة', '11733543 /اسحاق علي', '2025-01-05', '2025-08-04 15:37:57', '2025-08-04 15:37:57', 5, NULL, NULL),
(1588, 'تحويل داخلي', 'موظف', 19, NULL, NULL, 67.49, 'غير خاضع للضريبة', '11733543', '2025-01-05', '2025-08-04 15:45:14', '2025-08-04 15:45:14', 6, NULL, NULL),
(1589, 'تحويل داخلي', 'جهة', 19, NULL, NULL, 10.12, 'غير خاضع للضريبة', '11733543', '2025-01-05', '2025-08-04 15:45:14', '2025-08-04 15:45:14', 5, NULL, NULL),
(1590, 'تحويل داخلي', 'جهة', 23, NULL, NULL, 2700.00, 'غير خاضع للضريبة', 'تجديد اقامة 3 اشهر , محمد رشد', '2025-08-04', '2025-08-04 16:09:07', '2025-08-04 16:09:07', 1, NULL, NULL),
(1591, 'تحويل داخلي', 'جهة', 29, NULL, NULL, 20.00, 'غير خاضع للضريبة', 'تفويض تم', '2025-08-05', '2025-08-04 21:26:34', '2025-08-04 21:26:34', 18, NULL, NULL),
(1592, 'تحويل داخلي', 'جهة', 21, NULL, NULL, 20.00, 'غير خاضع للضريبة', 'تفويض تم', '2025-08-05', '2025-08-04 21:28:13', '2025-08-04 21:28:13', 18, NULL, NULL),
(1593, 'صرف', 'جهة', NULL, NULL, 'تحويل بنكي', 760.00, 'غير خاضع للضريبة', 'ملاحظه حماية الأجور مؤسسة رواسي التل', '2025-08-05', '2025-08-05 14:47:12', '2025-08-05 14:47:12', 8, NULL, 'شركة الجواب - بنك الرياض'),
(1594, 'تحويل داخلي', 'سيارة', 7, 1, 'آلي', 4030.00, NULL, 'استحقاق سيارة', '2025-08-05 17:57:04', '2025-08-05 17:57:04', '2025-08-05 17:57:04', NULL, NULL, NULL),
(1595, 'تحويل داخلي', 'سيارة', 66, 33, 'آلي', 1000.00, NULL, 'استحقاق سيارة', '2025-08-05 18:34:10', '2025-08-05 18:34:10', '2025-08-05 18:34:10', NULL, NULL, NULL),
(1596, 'تحويل داخلي', 'سيارة', 21, 9, 'آلي', 6200.00, NULL, 'استحقاق سيارة', '2025-08-05 18:38:32', '2025-08-05 18:38:32', '2025-08-05 18:38:32', NULL, NULL, NULL),
(1597, 'تحويل داخلي', 'سيارة', 27, 12, 'آلي', 1000.00, NULL, 'استحقاق سيارة', '2025-08-05 18:42:56', '2025-08-05 18:42:56', '2025-08-05 18:42:56', NULL, NULL, NULL),
(1598, 'تحويل داخلي', 'سيارة', 29, 5, 'آلي', 1000.00, NULL, 'استحقاق سيارة', '2025-08-05 18:45:38', '2025-08-05 18:45:38', '2025-08-05 18:45:38', NULL, NULL, NULL),
(1599, 'تحويل داخلي', 'سيارة', 15, 20, 'آلي', 6200.00, NULL, 'استحقاق سيارة', '2025-08-05 18:48:17', '2025-08-05 18:48:17', '2025-08-05 18:48:17', NULL, NULL, NULL),
(1600, 'تحويل داخلي', 'سيارة', 3, 2, 'آلي', 1000.00, NULL, 'استحقاق سيارة', '2025-08-05 18:53:45', '2025-08-05 18:53:45', '2025-08-05 18:53:45', NULL, NULL, NULL),
(1601, 'تحويل داخلي', 'سيارة', 8, 7, 'آلي', 1000.00, NULL, 'استحقاق سيارة', '2025-08-05 18:57:03', '2025-08-05 18:57:03', '2025-08-05 18:57:03', NULL, NULL, NULL),
(1602, 'تحويل داخلي', 'جهة', 27, NULL, NULL, 20.00, 'غير خاضع للضريبة', 'تفويض تم', '2025-08-06', '2025-08-05 21:30:28', '2025-08-05 21:30:28', 18, NULL, NULL),
(1603, 'تحويل داخلي', 'جهة', 3, NULL, NULL, 20.00, 'غير خاضع للضريبة', 'تفويض تم', '2025-08-05', '2025-08-06 20:32:38', '2025-08-06 20:32:38', 18, NULL, NULL),
(1604, 'تحويل داخلي', 'جهة', 8, NULL, NULL, 20.00, 'غير خاضع للضريبة', 'تفويض تم', '2025-08-05', '2025-08-06 20:33:05', '2025-08-06 20:33:05', 18, NULL, NULL),
(1605, 'قبض', 'موظف', 19, NULL, 'كاش', 1025.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-09', '2025-08-09 19:16:56', '2025-08-09 19:16:56', NULL, NULL, NULL),
(1606, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-09', '2025-08-09 20:48:41', '2025-08-09 20:48:41', NULL, NULL, NULL),
(1607, 'قبض', 'موظف', 25, NULL, 'كاش', 600.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-09', '2025-08-09 20:50:07', '2025-08-09 20:50:07', NULL, NULL, NULL),
(1608, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-10', '2025-08-10 20:08:15', '2025-08-10 20:08:15', NULL, NULL, NULL),
(1609, 'قبض', 'موظف', 15, NULL, 'كاش', 100.00, 'غير خاضع للضريبة', 'رسوم خدمات', '2025-08-13', '2025-08-13 15:36:56', '2025-08-13 15:36:56', NULL, NULL, NULL),
(1610, 'قبض', 'موظف', 23, NULL, 'كاش', 1190.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-15', '2025-08-15 19:57:42', '2025-08-15 19:57:42', NULL, NULL, NULL),
(1611, 'قبض', 'موظف', 7, NULL, 'كاش', 1120.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-16', '2025-08-16 17:42:10', '2025-08-16 17:42:10', NULL, NULL, NULL),
(1612, 'قبض', 'موظف', 19, NULL, 'كاش', 985.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-16', '2025-08-16 19:04:51', '2025-08-16 19:04:51', NULL, NULL, NULL),
(1613, 'قبض', 'موظف', 44, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-16', '2025-08-16 19:50:27', '2025-08-16 19:50:27', NULL, NULL, NULL),
(1614, 'قبض', 'موظف', 44, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-16', '2025-08-16 19:50:27', '2025-08-16 19:50:27', NULL, NULL, NULL),
(1615, 'قبض', 'موظف', 15, NULL, 'كاش', 1000.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-16', '2025-08-16 20:00:09', '2025-08-16 20:00:09', NULL, NULL, NULL),
(1616, 'قبض', 'موظف', 15, NULL, 'كاش', 6400.00, 'غير خاضع للضريبة', 'سداد رسوم مخالفات مرورية', '2025-08-16', '2025-08-16 20:01:25', '2025-08-16 20:01:25', NULL, NULL, NULL),
(1617, 'قبض', 'موظف', 21, NULL, 'كاش', 1400.00, 'غير خاضع للضريبة', 'تحصيل', '2025-08-17', '2025-08-17 17:53:12', '2025-08-17 17:53:12', NULL, NULL, NULL),
(1618, 'قبض', 'جهة', NULL, NULL, 'بوابة الدفع', 70.00, 'غير خاضع للضريبة', 'شحن رصيد عبر بوابة ميسر', '2025-08-23', '2025-08-23 22:24:06', '2025-08-23 22:24:06', NULL, NULL, NULL),
(1619, 'قبض', 'جهة', NULL, NULL, 'بوابة الدفع', 70.00, 'غير خاضع للضريبة', 'شحن رصيد عبر بوابة ميسر', '2025-08-24', '2025-08-24 13:28:31', '2025-08-24 13:28:31', NULL, NULL, NULL),
(1620, 'تحويل داخلي', 'سيارة', 4, 18, 'آلي', 5100.00, NULL, 'استحقاق سيارة', '2025-09-11 20:27:11', '2025-09-11 20:27:11', '2025-09-11 20:27:11', NULL, NULL, NULL),
(1621, 'قبض', 'جهة', NULL, NULL, 'بوابة الدفع', 70.00, 'غير خاضع للضريبة', 'شحن رصيد عبر بوابة ميسر', '2025-09-20', '2025-09-20 12:35:56', '2025-09-20 12:35:56', NULL, NULL, NULL),
(1622, 'قبض', 'جهة', NULL, NULL, 'بوابة الدفع', 70.00, 'غير خاضع للضريبة', 'شحن رصيد عبر بوابة ميسر', '2025-10-04', '2025-10-04 17:20:34', '2025-10-04 17:20:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `station_wallets`
--

CREATE TABLE `station_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `travel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `driver_status` varchar(255) DEFAULT NULL,
  `client_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station_wallets`
--

INSERT INTO `station_wallets` (`id`, `travel_id`, `amount`, `driver_status`, `client_status`, `created_at`, `updated_at`, `payment_status`) VALUES
(1, 2, 0.00, 'confirmed', 'confirmed', '2025-06-21 18:45:55', '2025-06-22 08:31:50', NULL),
(2, 2, 0.00, 'pending', 'pending', '2025-06-21 18:46:48', '2025-06-21 18:46:48', NULL),
(3, 2, 0.00, 'pending', 'pending', '2025-06-21 18:51:15', '2025-06-21 18:51:15', NULL),
(4, 2, 0.00, 'pending', 'pending', '2025-06-21 18:57:14', '2025-06-21 18:57:14', NULL),
(5, 2, 0.00, 'pending', 'pending', '2025-06-21 18:57:19', '2025-06-21 18:57:19', NULL),
(6, 12, 0.00, 'confirmed', 'confirmed', '2025-06-21 18:58:41', '2025-10-15 03:29:58', 'released'),
(7, 12, 0.00, 'pending', 'pending', '2025-06-21 19:11:03', '2025-06-21 19:11:03', NULL),
(9, 13, 0.00, 'confirmed', 'confirmed', '2025-06-21 19:14:14', '2025-10-14 09:17:15', 'released'),
(13, 15, 0.00, 'confirmed', 'confirmed', '2025-06-21 19:15:37', '2025-10-15 03:45:32', 'released'),
(14, 16, 0.00, 'confirmed', 'confirmed', '2025-06-21 19:15:41', '2025-10-15 04:23:30', 'released'),
(15, 18, 100.00, 'confirmed', 'confirmed', '2025-06-22 06:19:04', '2025-10-15 08:40:45', 'released'),
(16, 19, 100.00, 'pending', 'pending', '2025-06-22 06:26:06', '2025-06-22 06:26:06', NULL),
(17, 26, 100.00, 'confirmed', 'pending', '2025-06-22 07:15:04', '2025-06-22 14:52:36', NULL),
(18, 26, 100.00, 'pending', 'pending', '2025-06-22 07:15:09', '2025-06-22 07:15:09', NULL),
(19, 27, 100.00, 'confirmed', 'pending', '2025-06-22 07:29:47', '2025-06-22 14:52:38', NULL),
(20, 28, 100.00, 'confirmed', 'pending', '2025-06-22 08:04:23', '2025-06-22 09:35:21', NULL),
(21, 29, 100.00, 'confirmed', 'pending', '2025-06-22 08:13:41', '2025-06-22 15:09:29', NULL),
(22, 28, 100.00, 'pending', 'pending', '2025-06-22 09:34:37', '2025-06-22 09:34:37', NULL),
(23, 32, 100.00, 'confirmed', 'pending', '2025-06-22 15:19:40', '2025-06-22 15:20:00', NULL),
(24, 33, 100.00, 'confirmed', 'pending', '2025-06-22 15:21:17', '2025-06-22 15:21:24', NULL),
(25, 34, 100.00, 'confirmed', 'pending', '2025-06-22 15:25:13', '2025-06-22 15:25:25', NULL),
(26, 35, 100.00, 'confirmed', 'pending', '2025-06-22 15:29:40', '2025-06-22 15:29:51', NULL),
(27, 36, 100.00, 'confirmed', 'confirmed', '2025-06-22 15:37:55', '2025-06-22 15:39:33', NULL),
(28, 45, 100.00, 'pending', 'pending', '2025-06-24 08:40:30', '2025-06-24 08:40:30', NULL),
(29, 47, 55.00, 'confirmed', 'pending', '2025-06-25 07:09:03', '2025-06-25 07:32:45', NULL),
(30, 48, 55.00, 'pending', 'pending', '2025-06-25 07:13:20', '2025-06-25 07:13:20', NULL),
(31, 49, 81.00, 'pending', 'pending', '2025-06-25 12:12:15', '2025-06-25 12:12:15', NULL),
(32, 50, 100.00, 'pending', 'pending', '2025-06-25 12:12:18', '2025-06-25 12:12:18', NULL),
(33, 1, 0.00, 'pending', 'pending', '2025-06-25 12:32:38', '2025-06-25 12:32:38', NULL),
(34, 3, 400.00, 'pending', 'confirmed', '2025-10-09 16:45:15', '2025-10-09 16:47:42', NULL),
(35, 4, 400.00, 'confirmed', 'confirmed', '2025-10-09 16:57:17', '2025-10-09 16:59:02', NULL),
(39, 7, 400.00, 'confirmed', 'confirmed', '2025-10-14 06:36:36', '2025-10-14 06:42:42', 'released'),
(40, 7, 400.00, 'pending', 'hold', '2025-10-14 06:38:42', '2025-10-14 06:38:42', 'hold'),
(45, 12, 400.00, 'pending', 'hold', '2025-10-14 08:55:45', '2025-10-14 08:55:45', 'hold'),
(46, 13, 400.00, 'pending', 'hold', '2025-10-14 09:14:39', '2025-10-14 09:14:39', 'hold'),
(48, 15, 400.00, 'pending', 'hold', '2025-10-15 03:36:57', '2025-10-15 03:36:57', 'hold'),
(49, 16, 400.00, 'pending', 'hold', '2025-10-15 03:59:45', '2025-10-15 03:59:45', 'hold'),
(51, 18, 400.00, 'pending', 'hold', '2025-10-15 04:51:05', '2025-10-15 04:51:05', 'hold'),
(52, 19, 400.00, 'pending', 'hold', '2025-10-15 08:41:08', '2025-10-15 08:41:08', 'hold'),
(53, 20, 400.00, 'pending', 'hold', '2025-10-15 08:41:16', '2025-10-15 08:41:16', 'hold'),
(54, 20, 400.00, 'pending', 'hold', '2025-10-15 08:41:43', '2025-10-15 08:41:43', 'hold');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expire_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `package_id`, `expire_at`, `created_at`, `updated_at`) VALUES
(15, 193, 2, '2026-10-14', '2025-10-14 04:57:44', '2025-10-14 04:57:44'),
(16, 257, 2, '2026-10-14', '2025-10-14 06:38:07', '2025-10-14 06:38:07'),
(17, 257, 1, '2025-11-11', '2025-10-14 09:15:39', '2025-10-14 09:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `app_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `user_id`, `app_user_id`, `status`, `image`, `text`, `created_at`, `updated_at`) VALUES
(2, NULL, 193, NULL, 'supports/1758026062_1000527815.jpg', 'Test', '2025-09-16 12:34:22', '2025-09-16 12:34:22'),
(3, NULL, 193, NULL, 'supports/1758831912_1000528225.png', 'Hello World Test Issuse Description', '2025-09-25 20:25:12', '2025-09-25 20:25:12'),
(4, NULL, 193, NULL, NULL, 'Mohammed mohammed mohammed developer rights reserved worldwide', '2025-09-29 07:39:28', '2025-09-29 07:39:28'),
(5, NULL, 193, NULL, NULL, 'Ggyvvtvrvtv', '2025-09-30 08:34:50', '2025-09-30 08:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `support_notes`
--

CREATE TABLE `support_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `passengers` varchar(255) DEFAULT NULL,
  `passenger_id` bigint(20) UNSIGNED DEFAULT NULL,
  `longitude_from` varchar(255) DEFAULT NULL,
  `latitude_from` varchar(255) DEFAULT NULL,
  `longitude_to` varchar(255) DEFAULT NULL,
  `latitude_to` varchar(255) DEFAULT NULL,
  `between_city_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `from`, `to`, `date`, `time`, `status`, `user_id`, `created_at`, `updated_at`, `client_id`, `amount`, `passengers`, `passenger_id`, `longitude_from`, `latitude_from`, `longitude_to`, `latitude_to`, `between_city_id`) VALUES
(1, 'المدينة المنورة', 'مكة المكرمة', '2025-10-09', '10:00', 'منتهيه', 193, NULL, '2025-10-09 12:46:00', NULL, 100.00, '4', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-09', '07:42 PM', 'انتظار', 193, '2025-10-09 16:42:42', '2025-10-09 16:43:17', 193, 400.00, '12', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-09', '07:44 PM', 'انتظار', 193, '2025-10-09 16:45:14', '2025-10-09 16:47:18', 193, 400.00, '12', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-09', '07:44 PM', 'منتهيه', 193, '2025-10-09 16:57:17', '2025-10-09 16:59:43', 193, 400.00, '12', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'مكة المكرمة/', 'المدينة المنورة/', '2025-10-15', '11:50 AM', 'Finished', 257, '2025-10-14 06:36:36', '2025-10-14 07:01:19', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 2),
(12, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-15', '02:52 PM', 'Confirmed', 257, '2025-10-14 08:55:45', '2025-10-15 03:29:58', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(13, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-15', '03:12 PM', 'Finished', 257, '2025-10-14 09:14:39', '2025-10-14 09:20:09', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(15, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-16', '09:30 AM', 'Finished', 193, '2025-10-15 03:36:57', '2025-10-15 04:10:12', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(16, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-16', '09:30 AM', 'Finished', 193, '2025-10-15 03:59:45', '2025-10-15 06:06:44', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(18, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-16', '10:50 AM', 'Ongoing', 193, '2025-10-15 04:51:05', '2025-10-15 08:44:36', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(19, 'المدينة المنورة/', 'مكة المكرمة/', '2025-10-15', '09:10 PM', 'Waiting', NULL, '2025-10-15 08:41:08', '2025-10-15 08:41:08', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 1),
(20, 'مكة المكرمة/', 'المدينة المنورة/', '2025-10-15', '09:10 PM', 'Waiting', NULL, '2025-10-15 08:41:16', '2025-10-15 08:41:16', 253, 400.00, '12', NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'موظف',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`, `otp`, `otp_expires_at`) VALUES
(2, 'Abu Ahmed', 'admin@admin.com', '0551796056', '2025-10-02 09:54:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مسؤول', 'active', NULL, '2025-10-02 09:54:56', '2025-10-11 06:33:21', NULL, NULL),
(3, 'Abdullah', 'dev@admin.com', '0544833285', '2025-10-02 09:56:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مسؤول', 'active', NULL, '2025-10-02 09:56:41', '2025-10-16 07:07:17', NULL, NULL),
(5, 'abdullah', 'devtest@admin.com', '0560779878', '2025-10-02 09:54:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'تحديث البيانات', 'active', NULL, '2025-10-02 09:54:30', '2025-10-03 20:24:35', NULL, NULL),
(22, 'محمد', 'A@gmail.com', '0559212188', NULL, '$2y$12$XZrNITxd/B2o.F05.Bf.BOFRuxzm14YyQLEvr/DIIwsN0C4/sNGG2', 'موظف', 'active', NULL, '2025-10-03 16:56:18', '2025-10-11 06:34:05', NULL, NULL),
(23, 'كمال', 'ASAS@gmail.com', '0552040356', NULL, '$2y$12$v.EuQlGKa3hhVma5lkpO7.N/66jyy2eTAr0.r2dGRDjHrXZ5cHWZG', 'تحديث البيانات', 'active', NULL, '2025-10-04 06:22:46', '2025-10-11 23:06:36', NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `block_users_delete` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
    
    INSERT INTO deletion_audit_log 
    (table_name, record_id, deleted_by, connection_info)
    VALUES ('users', OLD.id, USER(), 
            CONCAT('BLOCKED ATTEMPT - Connection: ', CONNECTION_ID()));
    
    
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'ERROR: Direct deletion not allowed. Use stored procedure.';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `otp` varchar(255) NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_type` varchar(255) NOT NULL,
  `number_of_passengers` int(10) UNSIGNED NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `car_color` varchar(255) DEFAULT NULL,
  `licence_plate_number` varchar(255) NOT NULL,
  `car_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `user_id`, `car_type`, `number_of_passengers`, `car_model`, `car_color`, `licence_plate_number`, `car_image`, `created_at`, `updated_at`) VALUES
(27, 32, 'كيا k5', 4, '2022', 'اسود', 'sbbshshdhdhhhhhhhe', 'vehicles/images/1748509742_car_scaled_1000333077.png', '2025-05-29 09:09:02', '2025-09-06 16:44:45'),
(34, 40, 'ستاريا', 6, '2025', 'اسود', 'أ د ق 4601', 'vehicles/images/1748942969_car_scaled_٢٠٢٥٠٦٠٣_١٢٢٩٠٥.jpg', '2025-06-03 09:29:29', '2025-06-08 15:26:57'),
(51, 58, 'هيونداي H1', 12, '2019', 'ابيض', 'ا ص و 6244', 'vehicles/images/1749584948_car_scaled_IMG20250525185800.jpg', '2025-06-10 19:49:08', '2025-08-24 20:49:09'),
(55, 62, 'K5', 11, '2018', 'white', 'EX AFR 2091', 'vehicles/images/1749664666_car_scaled_1000343946.jpg', '2025-06-11 17:57:46', '2025-06-11 17:57:46'),
(57, 65, 'K5', 11, '2018', 'white', 'LJ KMG 3603', 'vehicles/images/1749665475_car_scaled_1000343946.jpg', '2025-06-11 18:11:15', '2025-06-11 18:11:15'),
(58, 68, 'K5', 11, '2018', 'white', 'ZZ AZG 4491', 'vehicles/images/1749756983_car_scaled_1000486477.jpg', '2025-06-12 19:36:23', '2025-06-12 19:36:23'),
(59, 69, 'K5', 13, '2018', 'white', 'EY UCX 5133', 'vehicles/images/1749760161_car_scaled_1000761627.jpg', '2025-06-12 20:29:21', '2025-06-24 17:35:35'),
(60, 70, 'هونداي فان', 11, '2022', 'اسود', 'ا س ا 8300', 'vehicles/images/1749760731_car_scaled_1001510545.jpg', '2025-06-12 20:38:51', '2025-06-14 15:44:14'),
(61, 71, 'تويوتا هاي ايس', 11, '2023', 'ابيض', 'ا س س 7566', 'vehicles/images/1749760923_car_scaled_1001241252.jpg', '2025-06-12 20:42:03', '2025-06-14 16:00:32'),
(62, 72, 'تويوتا هاي ايس', 11, '2020', 'ابيض', 'ا ر ص 7494', 'vehicles/images/1749762407_car_scaled_1000442751.jpg', '2025-06-12 21:06:47', '2025-06-14 16:11:19'),
(63, 73, 'هونداي فان', 11, '2022', 'رصاصي غامق', 'ا س ص 4113', 'vehicles/images/1749763966_car_scaled_1000728343.jpg', '2025-06-12 21:32:46', '2025-06-14 16:16:32'),
(64, 74, 'K5', 11, '2018', 'white', 'BC ILX 5767', 'vehicles/images/1749774782_car_scaled_1000064705.jpg', '2025-06-13 00:33:02', '2025-06-13 00:33:02'),
(65, 75, 'K5', 11, '2018', 'white', 'EB XZP 7355', 'vehicles/images/1749794279_car_scaled_1000190362.jpg', '2025-06-13 05:57:59', '2025-06-13 05:57:59'),
(66, 76, 'K5', 11, '2018', 'white', 'OY FGG 7791', 'vehicles/images/1749804969_car_scaled_1000294817.jpg', '2025-06-13 08:56:09', '2025-06-13 08:56:09'),
(67, 77, 'هونداي فان', 12, '2021', 'رصاصي', 'ا ص ح 2212', 'vehicles/images/1749811465_car_scaled_IMG_20250319_210008.jpg', '2025-06-13 10:44:25', '2025-08-23 19:46:23'),
(68, 78, 'هونداي فان', 11, '2021', 'رصاصي', 'أ ص ح 2212', 'vehicles/images/1749812348_car_scaled_IMG_20250319_210008.jpg', '2025-06-13 10:59:08', '2025-06-18 17:10:13'),
(69, 79, 'K5', 11, '2018', 'white', 'SK FTL 4350', 'vehicles/images/1749815940_car_scaled_1000171182.jpg', '2025-06-13 11:59:00', '2025-06-13 11:59:00'),
(70, 80, 'تويوتا هاي ايس', 11, '2025', 'ابيض', 'ا ص ن 6697', 'vehicles/images/1749816070_car_scaled_1000448569.jpg', '2025-06-13 12:01:10', '2025-06-14 19:01:21'),
(71, 81, 'K5', 11, '2018', 'white', 'SL ZHA 5364', 'vehicles/images/1749816234_car_scaled_1000298950.jpg', '2025-06-13 12:03:54', '2025-06-13 12:03:54'),
(72, 82, 'K5', 11, '2018', 'white', 'ON ZDM 3388', 'vehicles/images/1749816871_car_scaled_1000259807.jpg', '2025-06-13 12:14:31', '2025-06-13 12:14:31'),
(73, 83, 'تويوتا هاي ايس', 11, '2025', 'ابيض', 'ا ص س 7773', 'vehicles/images/1749817201_car_scaled_1000020644.jpg', '2025-06-13 12:20:01', '2025-06-14 18:38:55'),
(74, 84, 'K5', 11, '2018', 'white', 'XK FGY 9616', 'vehicles/images/1749817502_car_scaled_1000731779.jpg', '2025-06-13 12:25:02', '2025-06-13 12:25:02'),
(75, 85, 'K5', 11, '2018', 'white', 'PT GSD 0850', 'vehicles/images/1749817638_car_scaled_1000802113.jpg', '2025-06-13 12:27:18', '2025-06-13 12:27:18'),
(76, 86, 'هواندي ستار اكس', 11, '2019', 'رصاصي', 'ا س ل 6565', 'vehicles/images/1749817686_car_scaled_1000022562.jpg', '2025-06-13 12:28:06', '2025-06-22 17:27:36'),
(77, 87, 'هيونداي ستاريا', 11, '2025', 'اسود', 'ر ن ر 4774', 'vehicles/images/1749817829_car_scaled_1000113588.jpg', '2025-06-13 12:30:29', '2025-06-14 18:19:00'),
(78, 88, 'K5', 11, '2018', 'white', 'VX CDE 5140', 'vehicles/images/1749818496_car_scaled_1000271225.jpg', '2025-06-13 12:41:36', '2025-06-13 12:41:36'),
(79, 89, 'هيونداي ستاريا', 11, '2022', 'ازرق غامق', 'ا ص ح 2246', 'vehicles/images/1749819915_car_scaled_1000263606.jpg', '2025-06-13 13:05:15', '2025-06-14 18:24:10'),
(80, 90, 'K5', 11, '2018', 'white', 'LX LMN 0860', 'vehicles/images/1749820451_car_scaled_1000362101.jpg', '2025-06-13 13:14:11', '2025-06-13 13:14:11'),
(81, 91, 'هيونداي ستاريا', 11, '2022', 'اسود', 'ا ص ح 2697', 'vehicles/images/1749821002_car_scaled_1000384691.webp', '2025-06-13 13:23:22', '2025-06-14 18:49:17'),
(82, 92, 'K5', 11, '2018', 'white', 'DH LTH 1090', 'vehicles/images/1749821544_car_scaled_1000135842.jpg', '2025-06-13 13:32:24', '2025-06-13 13:32:24'),
(83, 93, 'تويوتا هاي ايس', 11, '2022', 'ابيض', 'ا ا ط 5786', 'vehicles/images/1749822064_car_scaled_1001616709.jpg', '2025-06-13 13:41:04', '2025-06-14 18:01:25'),
(84, 94, 'تويوتا هاي ايس', 11, '2023', 'ابيض', 'ا س ع 9682', 'vehicles/images/1749822423_car_scaled_1000360147.jpg', '2025-06-13 13:47:03', '2025-06-14 17:54:43'),
(85, 95, 'K5', 11, '2018', 'white', 'QQ XOM 0629', 'vehicles/images/1749827158_car_scaled_1002194196.jpg', '2025-06-13 15:05:58', '2025-06-13 15:05:58'),
(86, 96, 'K5', 11, '2018', 'white', 'JB BHJ 4050', 'vehicles/images/1749838119_car_scaled_1000579370.jpg', '2025-06-13 18:08:39', '2025-06-13 18:08:39'),
(87, 97, 'K5', 11, '2018', 'white', 'UC WNF 2984', 'vehicles/images/1749845166_car_scaled_1000041212.jpg', '2025-06-13 20:06:06', '2025-06-13 20:06:06'),
(88, 98, 'هيونداي ستاريا', 11, '2024', 'رصاصي', 'ا س س 2934', 'vehicles/images/1749845240_car_scaled_1000948681.jpg', '2025-06-13 20:07:20', '2025-06-14 17:16:01'),
(89, 99, 'جاي ايه سي ميكروباص', 11, '2023', 'ابيض', 'ا س س 1485', 'vehicles/images/1749848867_car_scaled_IMG_20241111_150251.jpg', '2025-06-13 21:07:47', '2025-06-14 17:09:57'),
(90, 100, 'K5', 11, '2018', 'white', 'ST PQR 8077', 'vehicles/images/1749874413_car_scaled_1000007962.jpg', '2025-06-14 04:13:33', '2025-06-14 04:13:33'),
(91, 101, 'K5', 11, '2018', 'white', 'VM XWG 6816', 'vehicles/images/1749912942_car_scaled_1000191246.jpg', '2025-06-14 14:55:42', '2025-06-14 14:55:42'),
(92, 135, 'K5', 11, '2018', 'white', 'VV FRX 2033', 'vehicles/images/1749926437_car_scaled_1000614883.jpg', '2025-06-14 18:40:37', '2025-06-14 18:40:37'),
(93, 136, 'K5', 11, '2018', 'white', 'CN ZXF 0345', 'vehicles/images/1749926441_car_scaled_1000560714.jpg', '2025-06-14 18:40:41', '2025-06-14 18:40:41'),
(94, 137, 'K5', 11, '2018', 'white', 'GT XKD 4651', 'vehicles/images/1749926498_car_scaled_1002517140.jpg', '2025-06-14 18:41:38', '2025-06-14 18:41:38'),
(95, 139, 'K5', 11, '2018', 'white', 'AH VHS 9310', 'vehicles/images/1749927128_car_scaled_1000026771.jpg', '2025-06-14 18:52:08', '2025-06-14 18:52:08'),
(96, 140, 'K5', 11, '2018', 'white', 'GY JNA 7747', 'vehicles/images/1749927268_car_scaled_1000020740.jpg', '2025-06-14 18:54:28', '2025-06-14 18:54:28'),
(97, 141, 'K5', 11, '2018', 'white', 'RV ARN 6095', 'vehicles/images/1749927431_car_scaled_1000088218.jpg', '2025-06-14 18:57:11', '2025-06-14 18:57:11'),
(98, 142, 'هونداي ستاريا', 11, '2022', 'فضي', 'أ س و 8547', 'vehicles/images/1749927516_car_scaled_6054.jpg', '2025-06-14 18:58:36', '2025-06-18 15:45:29'),
(99, 143, 'K5', 11, '2018', 'white', 'OP DCW 6314', 'vehicles/images/1749927953_car_scaled_1000136498.jpg', '2025-06-14 19:05:53', '2025-06-14 19:05:53'),
(100, 144, 'K5', 11, '2018', 'white', 'FZ ACA 4283', 'vehicles/images/1749928049_car_scaled_1000084693.jpg', '2025-06-14 19:07:29', '2025-06-14 19:07:29'),
(101, 145, 'K5', 11, '2018', 'white', 'PV KRA 4811', 'vehicles/images/1749928325_car_scaled_1000270547.jpg', '2025-06-14 19:12:05', '2025-06-14 19:12:05'),
(102, 146, 'K5', 11, '2018', 'white', 'XW QIC 6605', 'vehicles/images/1749928348_car_scaled_1000461084.jpg', '2025-06-14 19:12:28', '2025-06-14 19:12:28'),
(103, 147, 'هيونداي ستاريا', 11, '2023', 'رصاصي فاتح', 'ا س ا 3043', 'vehicles/images/1749928366_car_scaled_1000007044.jpg', '2025-06-14 19:12:46', '2025-06-14 19:45:31'),
(104, 148, 'هونداي ستاريا', 11, '2022', 'رصاصي', 'أ ص د 3181', 'vehicles/images/1749928629_car_scaled_1001931065.jpg', '2025-06-14 19:17:09', '2025-06-18 15:55:18'),
(105, 149, 'هيونداي فان', 11, '2019', 'فضي', 'ا س د 8881', 'vehicles/images/1749928635_car_scaled_1000217423.jpg', '2025-06-14 19:17:15', '2025-06-14 19:37:15'),
(106, 150, 'K5', 11, '2018', 'white', 'KJ ROQ 8124', 'vehicles/images/1749928753_car_scaled_1001921446.jpg', '2025-06-14 19:19:13', '2025-06-14 19:19:13'),
(107, 151, 'K5', 11, '2018', 'white', 'MZ TGG 0858', 'vehicles/images/1749929326_car_scaled_1000000959.jpg', '2025-06-14 19:28:46', '2025-06-14 19:28:46'),
(108, 152, 'K5', 11, '2018', 'white', 'ZF RGT 0163', 'vehicles/images/1749929445_car_scaled_IMG_20250614_222637.jpg', '2025-06-14 19:30:45', '2025-06-14 19:30:45'),
(109, 153, 'K5', 11, '2018', 'white', 'OK IGW 8251', 'vehicles/images/1749930434_car_scaled_1002548072.jpg', '2025-06-14 19:47:14', '2025-06-14 19:47:14'),
(110, 154, 'K5', 11, '2018', 'white', 'VO LZK 1112', 'vehicles/images/1749930650_car_scaled_1000270547.jpg', '2025-06-14 19:50:50', '2025-06-14 19:50:50'),
(111, 155, 'K5', 11, '2018', 'white', 'DV RIG 0516', 'vehicles/images/1749931280_car_scaled_1001110203.jpg', '2025-06-14 20:01:20', '2025-06-14 20:01:20'),
(112, 156, 'هونداي ستار اكس', 12, '2020', 'ابيض', 'أ س و 8513', 'vehicles/images/1749931391_car_scaled_1000258815.jpg', '2025-06-14 20:03:11', '2025-08-23 21:16:48'),
(113, 157, 'K5', 11, '2018', 'white', 'KO VLF 3081', 'vehicles/images/1749931663_car_scaled_1000000041.jpg', '2025-06-14 20:07:43', '2025-06-14 20:07:43'),
(114, 158, 'K5', 11, '2018', 'white', 'CO MMV 1631', 'vehicles/images/1749933822_car_scaled_1000032198.jpg', '2025-06-14 20:43:42', '2025-06-14 20:43:42'),
(115, 159, 'K5', 11, '2018', 'white', 'TH CAV 1027', 'vehicles/images/1749934357_car_scaled_1000700399.jpg', '2025-06-14 20:52:37', '2025-06-14 20:52:37'),
(116, 160, 'هونداي فان', 11, '2022', 'اسود', 'ا ص ح 2710', 'vehicles/images/1749938020_car_scaled_1001048984.jpg', '2025-06-14 21:53:40', '2025-06-18 16:09:39'),
(117, 161, 'هونداي فان', 11, '2019', 'ابيض', 'ا س س 9260', 'vehicles/images/1749963191_car_scaled_20250614_212640.heic', '2025-06-15 04:53:11', '2025-06-18 16:13:09'),
(118, 162, 'K5', 11, '2018', 'white', 'ZW BQA 9506', 'vehicles/images/1749965718_car_scaled_1001372380.jpg', '2025-06-15 05:35:18', '2025-06-15 05:35:18'),
(119, 163, 'تويوتا ميكروباص', 11, '2025', 'ابيض', 'ا س ك 2648', 'vehicles/images/1749977315_car_scaled_1000427100.jpg', '2025-06-15 08:48:35', '2025-06-18 16:17:05'),
(120, 164, 'هونداي فان', 12, '2021', 'رصاصي', 'ا ص د 8719', 'vehicles/images/1749980015_car_scaled_1000503731.jpg', '2025-06-15 09:33:35', '2025-08-24 20:38:59'),
(121, 165, 'هونداي ستاريا', 11, '2023', 'ابيض', 'ا س ح 7360', 'vehicles/images/1749995357_car_scaled_1002194196.jpg', '2025-06-15 13:49:17', '2025-06-18 16:27:43'),
(122, 166, 'هونداي ستاريا', 11, '2025', 'رصاصي فاتح', 'ا ص ع 2890', 'vehicles/images/1749998202_car_scaled_1001202520.jpg', '2025-06-15 14:36:42', '2025-06-18 16:31:08'),
(123, 167, 'K5', 11, '2018', 'white', 'AT IXR 6158', 'vehicles/images/1750066360_car_scaled_1000310560.jpg', '2025-06-16 09:32:40', '2025-06-16 09:32:40'),
(124, 168, 'K5', 11, '2018', 'white', 'WR DKY 2144', 'vehicles/images/1750067385_car_scaled_1000138806.jpg', '2025-06-16 09:49:45', '2025-06-16 09:49:45'),
(125, 169, 'تويوتا هايز', 11, '2025', 'ابيض', 'ا ص س 8508', 'vehicles/images/1750089831_car_scaled_1000022300.jpg', '2025-06-16 16:03:51', '2025-06-18 16:54:05'),
(126, 170, 'K5', 11, '2018', 'white', 'VK PIN 4855', 'vehicles/images/1750096221_car_scaled_20240523_133017.jpg', '2025-06-16 17:50:21', '2025-06-16 17:50:21'),
(127, 171, 'هونداي فان', 12, '2021', 'رصاصي', 'ا ص ح 2216', 'vehicles/images/1750096444_car_scaled_1000007353.jpg', '2025-06-16 17:54:04', '2025-08-23 21:05:07'),
(128, 172, 'K5', 11, '2018', 'white', 'CT HXY 6027', 'vehicles/images/1750149429_car_scaled_1000250131.jpg', '2025-06-17 08:37:09', '2025-06-17 08:37:09'),
(129, 173, 'K5', 11, '2018', 'white', 'IX FWO 0816', 'vehicles/images/1750158242_car_scaled_1000142980.jpg', '2025-06-17 11:04:02', '2025-06-17 11:04:02'),
(130, 174, 'K5', 11, '2018', 'white', 'IX BZK 1369', 'vehicles/images/1750564183_car_scaled_1000068142.jpg', '2025-06-22 03:49:43', '2025-06-22 03:49:43'),
(131, 176, 'هيونداي فان', 11, '2019', 'ابيض', 'ا س س 9193', 'vehicles/images/1750971395_car_scaled_IMG_20250626_234012.jpg', '2025-06-26 20:56:35', '2025-07-06 17:56:35'),
(132, 177, 'K5', 11, '2018', 'white', 'RR FVD 5312', 'vehicles/images/1751103523_car_scaled_1003025951.jpg', '2025-06-28 09:38:43', '2025-06-28 09:38:43'),
(133, 179, 'K5', 11, '2018', 'white', 'ZW HWI 8399', 'vehicles/images/1751474381_car_scaled_1000000629.jpg', '2025-07-02 16:39:41', '2025-07-02 16:39:41'),
(134, 181, 'K5', 11, '2018', 'white', 'GL XDB 9414', 'vehicles/images/1752168909_car_scaled_1000233038.jpg', '2025-07-10 17:35:09', '2025-07-10 17:35:09'),
(135, 184, 'ستاريا', 11, '2023', 'اسود', 'ا س س 1253', 'vehicles/images/1755472018_car_scaled_1000297331.jpg', '2025-08-17 23:06:58', '2025-08-23 22:01:26'),
(136, 186, 'تويوتا ميكروباص', 13, '2023', 'ابيض', 'ا س ع 6524', 'vehicles/images/1755552759_car_scaled_1005353595.jpg', '2025-08-18 21:32:39', '2025-08-24 21:09:56'),
(137, 187, 'K5', 11, '2018', 'white', 'PF OIM 4573', 'vehicles/images/1755562816_car_scaled_1000792485.jpg', '2025-08-19 00:20:16', '2025-08-19 00:20:16'),
(138, 188, 'هايس', 11, '2025', 'اسود', 'YT TCR 4504', 'vehicles/images/1755804071_car_scaled_1000083058.jpg', '2025-08-21 19:21:11', '2025-09-06 16:52:40'),
(139, 185, 'ستاريا', 11, '2022', 'رصاصي', 'ا ص ل 7416', NULL, '2025-08-24 19:47:42', '2025-08-24 19:47:42'),
(140, 189, 'K5', 11, '2018', 'white', 'CP LFO 9850', 'vehicles/images/1756068934_car_scaled_1000411019.jpg', '2025-08-24 20:55:34', '2025-08-24 20:55:34'),
(141, 190, 'K5', 11, '2018', 'white', 'PD YFE 0550', 'vehicles/images/1756660280_car_scaled_IMG-20250831-WA0465.jpg', '2025-08-31 17:11:20', '2025-08-31 17:11:20'),
(142, 196, 'ستار اكس', 11, '2018', 'ابيض', 'US GFB 6992', 'vehicles/images/1758119786_car_scaled_1000528231.png', '2025-09-17 14:36:26', '2025-09-17 14:36:26'),
(143, 224, 'K5', 11, '2018', 'White', 'Fcv', 'vehicles/images/1758186021_car_scaled_1000528231.png', '2025-09-18 09:00:21', '2025-09-18 09:00:21'),
(144, 230, 'K5', 11, '2018', 'White', 'Cfgg', 'vehicles/images/1758187544_car_scaled_1000528225.png', '2025-09-18 09:25:44', '2025-09-18 09:25:44'),
(145, 231, 'ستار اكس', 11, '2018', 'ابيض', 'اياا', 'vehicles/images/1758190494_car_scaled_1000528225.png', '2025-09-18 10:14:54', '2025-09-18 10:14:54'),
(146, 232, 'ستار اكس', 11, '2018', 'ابيض', 'ىفىغةة', 'vehicles/images/1758191534_car_scaled_1000528231.png', '2025-09-18 10:32:14', '2025-09-18 10:32:14'),
(147, 233, 'ستار اكس', 14, '2023', 'اخضر', 'و', 'vehicles/images/1758206283_car_scaled_1000528231.png', '2025-09-18 14:38:03', '2025-09-18 14:38:03'),
(148, 238, 'هايس', 11, '2023', 'ابيض', 'HHJ - 6556', 'vehicles/images/1758371580_car_scaled_1000529784.jpg', '2025-09-20 12:33:00', '2025-09-20 12:33:00'),
(149, 239, 'سوناتا', 12, '2023', 'اسود', 'TTT - 1321', 'vehicles/images/1758436301_car_scaled_1000528231.png', '2025-09-21 06:31:41', '2025-09-21 06:31:41'),
(150, 240, 'هايس', 16, '2019', 'اخضر', 'DFF - 1252', 'vehicles/images/1758436814_car_scaled_1000531079.jpg', '2025-09-21 06:40:14', '2025-09-21 06:40:14'),
(151, 249, 'سوناتا', 4, '2025', 'اسود', 'DDD - 8888', 'vehicles/images/1759924638_car_scaled_1000528225.png', '2025-10-08 11:57:18', '2025-10-08 11:57:18'),
(152, 250, 'هايس', 7, '2022', 'اسود', 'FST - 4353', 'vehicles/images/1759928807_car_scaled_1000000033.jpg', '2025-10-08 13:06:47', '2025-10-08 13:06:47'),
(153, 251, 'ستاريا', 7, '2019', 'اسود', 'SSF - 2222', 'vehicles/images/1759928815_car_scaled_1000528231.png', '2025-10-08 13:06:55', '2025-10-08 13:06:55'),
(154, 254, 'ستاريا', 6, '2025', 'اسود', 'HHZ - 3333', 'vehicles/images/1759935593_car_scaled_1000528231.png', '2025-10-08 14:59:53', '2025-10-08 14:59:53'),
(155, 257, 'هايس', 11, '2025', 'اسود', 'FDD - 6777', 'vehicles/images/1760429831_car_scaled_1000528225.png', '2025-10-14 05:17:11', '2025-10-14 05:17:11'),
(156, 258, 'Sedan', 4, 'Toyota Camry', 'White', 'ABC123', 'vehicles/images/1760604745_car_test.jpg', '2025-10-16 05:52:25', '2025-10-16 05:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `wattsapp` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL,
  `total_recharge` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `current_balance`, `total_recharge`, `created_at`, `updated_at`) VALUES
(1, 193, 8700.00, 9100.00, '2025-10-10 14:08:44', '2025-10-15 08:40:45'),
(2, 253, 5800.00, 9100.00, '2025-10-10 14:08:44', '2025-10-15 08:41:16'),
(3, 257, 9291.00, 9100.00, '2025-10-10 14:08:44', '2025-10-15 03:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_details`
--

CREATE TABLE `wallet_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `travel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_details`
--

INSERT INTO `wallet_details` (`id`, `name`, `wallet_id`, `amount`, `details`, `created_at`, `updated_at`, `travel_id`, `transaction_date`) VALUES
(29, 'صرف', 1, 500.00, 'شحن باقة بين المدن شهري', '2025-10-14 04:57:44', '2025-10-14 04:57:44', NULL, NULL),
(32, 'Payment Hold', 2, -400.00, 'رحلة من مكة المكرمة/ إلى المدينة المنورة/', '2025-10-14 06:36:36', '2025-10-14 06:36:36', 7, '2025-10-14'),
(33, 'صرف', 3, 500.00, 'شحن باقة بين المدن شهري', '2025-10-14 06:38:07', '2025-10-14 06:38:07', NULL, NULL),
(34, 'Payment Received', 3, 400.00, 'رحلة من مكة المكرمة/ إلى المدينة المنورة/', '2025-10-14 06:42:42', '2025-10-14 06:42:42', 7, '2025-10-14'),
(45, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-14 08:55:45', '2025-10-14 08:55:45', 12, '2025-10-14'),
(46, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-14 09:14:39', '2025-10-14 09:14:39', 13, '2025-10-14'),
(47, 'صرف', 3, 69.00, 'شحن باقة كشف ركاب شهري', '2025-10-14 09:15:39', '2025-10-14 09:15:39', NULL, NULL),
(48, 'Payment Received', 3, 0.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-14 09:17:15', '2025-10-14 09:17:15', 13, '2025-10-14'),
(49, 'Payment Received', 3, 0.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 03:29:58', '2025-10-15 03:29:58', 12, '2025-10-15'),
(52, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 03:36:57', '2025-10-15 03:36:57', 15, '2025-10-15'),
(53, 'Payment Received', 1, 0.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 03:45:32', '2025-10-15 03:45:32', 15, '2025-10-15'),
(54, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 03:59:45', '2025-10-15 03:59:45', 16, '2025-10-15'),
(57, 'Payment Received', 1, 0.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 04:23:30', '2025-10-15 04:23:30', 16, '2025-10-15'),
(58, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 04:51:05', '2025-10-15 04:51:05', 18, '2025-10-15'),
(59, 'Payment Received', 1, 100.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 08:40:45', '2025-10-15 08:40:45', 18, '2025-10-15'),
(60, 'Payment Hold', 2, -400.00, 'رحلة من المدينة المنورة/ إلى مكة المكرمة/', '2025-10-15 08:41:08', '2025-10-15 08:41:08', 19, '2025-10-15'),
(61, 'Payment Hold', 2, -400.00, 'رحلة من مكة المكرمة/ إلى المدينة المنورة/', '2025-10-15 08:41:16', '2025-10-15 08:41:16', 20, '2025-10-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alahdas`
--
ALTER TABLE `alahdas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alahda_counts`
--
ALTER TABLE `alahda_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alahda_counts_alahda_id_foreign` (`alahda_id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `app_users_id_number_unique` (`id_number`);

--
-- Indexes for table `between_cities`
--
ALTER TABLE `between_cities`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_documents`
--
ALTER TABLE `car_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_documents_car_id_foreign` (`car_id`);

--
-- Indexes for table `car_drivers`
--
ALTER TABLE `car_drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_drivers_car_id_foreign` (`car_id`),
  ADD KEY `car_drivers_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `car_maintenances`
--
ALTER TABLE `car_maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_maintenances_car_id_foreign` (`car_id`),
  ADD KEY `car_maintenances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deletion_audit_log`
--
ALTER TABLE `deletion_audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docs_files`
--
ALTER TABLE `docs_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docs_files_docs_id_foreign` (`docs_id`);

--
-- Indexes for table `docs_types`
--
ALTER TABLE `docs_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `docs_types_name_unique` (`name`);

--
-- Indexes for table `docs_updates`
--
ALTER TABLE `docs_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docs_updates_docs_id_foreign` (`docs_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_type_id_foreign` (`type_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_identity_number_unique` (`identity_number`);

--
-- Indexes for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_documents_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_files`
--
ALTER TABLE `employee_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_files_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_boxes`
--
ALTER TABLE `food_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_box_stations`
--
ALTER TABLE `food_box_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_prices`
--
ALTER TABLE `food_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_prices_food_type_id_foreign` (`food_type_id`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gehas`
--
ALTER TABLE `gehas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mandubs`
--
ALTER TABLE `mandubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_sub_details`
--
ALTER TABLE `package_sub_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_sub_details_package_id_foreign` (`package_id`);

--
-- Indexes for table `package_types`
--
ALTER TABLE `package_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passengers_user_id_foreign` (`user_id`);

--
-- Indexes for table `passenger_lists`
--
ALTER TABLE `passenger_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passenger_lists_passenger_id_foreign` (`passenger_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `providers_email_unique` (`email`),
  ADD UNIQUE KEY `providers_phone_unique` (`phone`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `snds`
--
ALTER TABLE `snds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `snds_employee_id_foreign` (`employee_id`),
  ADD KEY `snds_car_id_foreign` (`car_id`),
  ADD KEY `snds_geha_id_foreign` (`geha_id`);

--
-- Indexes for table `station_wallets`
--
ALTER TABLE `station_wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `station_wallets_travel_id_foreign` (`travel_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `subscriptions_package_id_foreign` (`package_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supports_user_id_foreign` (`user_id`),
  ADD KEY `supports_app_user_id_foreign` (`app_user_id`);

--
-- Indexes for table `support_notes`
--
ALTER TABLE `support_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_notes_support_id_foreign` (`support_id`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_user_id_foreign` (`user_id`),
  ADD KEY `travel_client_id_foreign` (`client_id`),
  ADD KEY `travel_passenger_id_foreign` (`passenger_id`),
  ADD KEY `travel_between_city_id_foreign` (`between_city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_otps_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_licence_plate_number_unique` (`licence_plate_number`),
  ADD KEY `vehicles_user_id_foreign` (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_details`
--
ALTER TABLE `wallet_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_details_wallet_id_foreign` (`wallet_id`),
  ADD KEY `idx_travel_id` (`travel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alahdas`
--
ALTER TABLE `alahdas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alahda_counts`
--
ALTER TABLE `alahda_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `between_cities`
--
ALTER TABLE `between_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `car_documents`
--
ALTER TABLE `car_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `car_drivers`
--
ALTER TABLE `car_drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `car_maintenances`
--
ALTER TABLE `car_maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deletion_audit_log`
--
ALTER TABLE `deletion_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `docs_files`
--
ALTER TABLE `docs_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `docs_types`
--
ALTER TABLE `docs_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `docs_updates`
--
ALTER TABLE `docs_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `employee_documents`
--
ALTER TABLE `employee_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `employee_files`
--
ALTER TABLE `employee_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_boxes`
--
ALTER TABLE `food_boxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_box_stations`
--
ALTER TABLE `food_box_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_prices`
--
ALTER TABLE `food_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gehas`
--
ALTER TABLE `gehas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandubs`
--
ALTER TABLE `mandubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `package_sub_details`
--
ALTER TABLE `package_sub_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_types`
--
ALTER TABLE `package_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `passenger_lists`
--
ALTER TABLE `passenger_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `snds`
--
ALTER TABLE `snds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1623;

--
-- AUTO_INCREMENT for table `station_wallets`
--
ALTER TABLE `station_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `support_notes`
--
ALTER TABLE `support_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wallet_details`
--
ALTER TABLE `wallet_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alahda_counts`
--
ALTER TABLE `alahda_counts`
  ADD CONSTRAINT `alahda_counts_alahda_id_foreign` FOREIGN KEY (`alahda_id`) REFERENCES `alahdas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `car_documents`
--
ALTER TABLE `car_documents`
  ADD CONSTRAINT `car_documents_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `car_drivers`
--
ALTER TABLE `car_drivers`
  ADD CONSTRAINT `car_drivers_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_drivers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `car_maintenances`
--
ALTER TABLE `car_maintenances`
  ADD CONSTRAINT `car_maintenances_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_maintenances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `docs_files`
--
ALTER TABLE `docs_files`
  ADD CONSTRAINT `docs_files_docs_id_foreign` FOREIGN KEY (`docs_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `docs_updates`
--
ALTER TABLE `docs_updates`
  ADD CONSTRAINT `docs_updates_docs_id_foreign` FOREIGN KEY (`docs_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `docs_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD CONSTRAINT `employee_documents_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `employee_files`
--
ALTER TABLE `employee_files`
  ADD CONSTRAINT `employee_files_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `food_prices`
--
ALTER TABLE `food_prices`
  ADD CONSTRAINT `food_prices_food_type_id_foreign` FOREIGN KEY (`food_type_id`) REFERENCES `food_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `package_sub_details`
--
ALTER TABLE `package_sub_details`
  ADD CONSTRAINT `package_sub_details_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `passenger_lists`
--
ALTER TABLE `passenger_lists`
  ADD CONSTRAINT `passenger_lists_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `snds`
--
ALTER TABLE `snds`
  ADD CONSTRAINT `snds_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `snds_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `snds_geha_id_foreign` FOREIGN KEY (`geha_id`) REFERENCES `gehas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `station_wallets`
--
ALTER TABLE `station_wallets`
  ADD CONSTRAINT `station_wallets_travel_id_foreign` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supports`
--
ALTER TABLE `supports`
  ADD CONSTRAINT `supports_app_user_id_foreign` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `support_notes`
--
ALTER TABLE `support_notes`
  ADD CONSTRAINT `support_notes_support_id_foreign` FOREIGN KEY (`support_id`) REFERENCES `supports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `travel_between_city_id_foreign` FOREIGN KEY (`between_city_id`) REFERENCES `between_cities` (`id`),
  ADD CONSTRAINT `travel_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `travel_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD CONSTRAINT `user_otps_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `wallet_details`
--
ALTER TABLE `wallet_details`
  ADD CONSTRAINT `wallet_details_ibfk_1` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wallet_details_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
