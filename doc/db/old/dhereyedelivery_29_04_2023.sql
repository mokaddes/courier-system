-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 02:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_merchant` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `is_merchant`) VALUES
(1, 'Supper Admin', 'arobil@gmail.com', '2022-07-25 05:09:47', '$2y$10$Laz2DSdsyM450qqqbemg5OGZ2c774Lw/fHIvWBezYZtPE8QC13mbO', 'uploads/admin/1681723077_643d0ec5861e2.jpg', 'wArU8bg7sIvacA4XN3oHVijlS7yXn2Jy6Aew70dhQ1pcTUFYqGXkF7oOWDWe', '2022-07-25 05:09:47', '2023-04-17 04:02:59', 0),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$01oYcZkmzqM75bMZ4XpUnOoyerMbFeUUrft0ikNqxnTuCGYiLC0DK', 'uploads/admin/1681724455_643d142729607.jpg', NULL, '2022-08-22 05:56:33', '2023-04-17 03:40:55', 0),
(12, 'Merchant', 'merchant@gmail.com', NULL, '$2y$10$CcHe7orBSi5VZtfy/jrnqeaez2kEEf5wS4brnsBr.DrGlTjsl//Bi', 'uploads/admin/1681724104_643d12c8b399d.jpeg', NULL, '2023-04-17 00:16:51', '2023-04-17 03:35:04', 1),
(13, 'Merchant2', 'merchnat2@gmail.com', NULL, '$2y$10$qMrXGdyc2XNR1/3SQJ3tnOjsNJ3ugcGZ7bvyOD1PjTGiH1izsbFDq', 'uploads/admin/1681724085_643d12b5064b2.jpg', NULL, '2023-04-17 00:23:18', '2023-04-17 03:34:45', 1),
(14, 'Moshiur Rahman', 'moshiur2187@gmail.com', NULL, '$2y$10$tPCj5qRLis8qIbeRM1cI..G.8wRA8cZyBojuRLW8mc.TkZsBwZR86', 'uploads/admin/1681791201_643e18e191796.jpg', NULL, '2023-04-17 22:13:22', '2023-04-29 02:38:24', 1),
(15, 'Atik Khan', 'atik@gmail.com', NULL, '$2y$10$fJXaE/RWaG951woTyrfquORjNaHaVs34CoTi.QseDUCsDhBjTvPZW', 'uploads/admin/1681791557_643e1a455def7.jpg', NULL, '2023-04-17 22:19:17', '2023-04-17 22:19:17', 0),
(16, 'Rofiqul Isalm', 'rofiqul@gmail.com', NULL, '$2y$10$yth3BnBkrfJa3XlWUQaE1eH.i8a5NeX68VpXE9i7TAFbFs3Mx2D9e', NULL, NULL, '2023-04-17 22:24:30', '2023-04-17 22:24:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) UNSIGNED NOT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `is_main_city` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `region_id`, `country_id`, `latitude`, `longitude`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_main_city`) VALUES
(2790952, 3889, 191, NULL, NULL, 'City1', '2023-04-15 10:34:27', NULL, '2023-04-15 10:34:27', NULL, 0),
(2790953, 3889, 191, NULL, NULL, 'joy Land', '2023-04-16 09:04:49', NULL, '2023-04-16 09:04:49', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `config_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `config_value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'DhereyeDelivery', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(2, 'currency', 'USD', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(3, 'timezone', 'Asia/Dhaka', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(4, 'paypal_mode', 'sandbox', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(5, 'paypal_client_id', 'Aa8_7OJaxmCZQpkx3hbzdySDz7haM0Wu6c6MmzX5JQsaywY1i8HMJo2ddnr9-pEEoRP3qvjflrxOVoXL', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(6, 'paypal_secret', 'ELMx8Z_ddA0Z597lD-dDPssM4VxBbnWvvoxb1mjuIiMCHLRSzbSN6owESivW4moqRPPYOTyl1J9QxSx0', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(7, 'razorpay_key', 'YOUR_RAZORPAY_KEY', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(8, 'razorpay_secret', 'YOUR_RAZORPAY_SECRET', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(9, 'term', 'monthly', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(10, 'stripe_publishable_key', 'pk_test_51M9pqYBIRmXVjgUGW3b1i91X0uTNeU6umRaoD9UprcFLotiHpfdBwgr4MnkbZoPuKKPFmdWJFVzWTwvUgxBrcl1d00OcqJU0Ta', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(11, 'stripe_secret', 'sk_test_51M9pqYBIRmXVjgUG4VjKaH21Jm0s6KvLTcIZ6fgTqpvfIbfuVocHbjn4vOeVHX6yrJekPPw4xfphkU4EN7ItAqr500Q3kUMHc8', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(12, 'app_theme', 'blue', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(13, 'primary_image', '/frontend/assets/elements/home.gif', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(14, 'secondary_image', '/frontend/assets/elements/home.svg', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(15, 'tax_type', 'exclusive', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(16, 'invoice_prefix', 'INV-', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(17, 'invoice_name', 'mtgpro', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(18, 'invoice_email', 'sales@mtgpro.me', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(19, 'invoice_phone', '+88 01767671133', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(20, 'invoice_address', '123, lorem ipsum', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(21, 'invoice_city', 'dhaka', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(22, 'invoice_state', 'dhaka', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(23, 'invoice_zipcode', '1212', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(24, 'invoice_country', 'Bangaldesh', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(25, 'tax_name', 'Goods and Service Tax', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(26, 'tax_value', '0', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(27, 'tax_number', '0', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(28, 'email_heading', 'Thanks for using mtgpro.me. This is an invoice for your recent purchase.', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(29, 'email_footer', 'If you’re having trouble with the button above, please login into your web browser.', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(30, 'invoice_footer', 'Thank you very much for doing business with us. We look forward to working with you again!', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(31, 'share_content', 'Welcome to { business_name }, Here is my digital Digital Business Card, { business_url } \r\nPowered by: { appName }', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(32, 'bank_transfer', 'Bank: FARM CREDIT BANK DN P&I\r\nBank Account Number: 18539734757                     \r\nRouting Number: 21054734\r\nIBAN: IN94769888520201207044719366\r\n\r\nBank: FARM CREDIT BANK DN P&I\r\nBank Account Number: 18539734757                     \r\nRouting Number: 21054734\r\nIBAN: IN94769888520201207044719366', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
(33, 'stripe_endpoint_secret', 'whsec_akol6QZWkkwjhIsX5crV0PwYNGyLnRcx', '2022-06-28 16:41:12', '2022-06-28 16:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) NOT NULL DEFAULT '0',
  `message` text NOT NULL DEFAULT 0,
  `status` int(3) NOT NULL DEFAULT 0 COMMENT '0 = inactive,\r\n1 = Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `reason`, `message`, `status`, `created_at`, `updated_at`) VALUES
(2, 'test', 'test@gmail.com', 1798194412, '0', 'testttt', 0, '2023-02-13 05:22:39', '2023-02-13 05:22:39'),
(3, 'Md Mridul', 'mdmridul6088@gmail.com', 0, '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus. Maecenas consectetur libero non velit laoreet posuere. Nulla sit amet volutpat augue. Quisque malesuada vulputate ligula, non vehicula eros porttitor ut. Etiam mattis, leo vel ornare tincidunt, mi mauris aliquam magna, sit amet consectetur nibh tortor sed leo. In vel sollicitudin urna. Duis in lectus vel ipsum laoreet cursus ut sit amet orci. Aenean tincidunt elementum nunc, nec efficitur risus consectetur consequat.', 0, '2023-04-29 06:02:37', '2023-04-29 06:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `updated_at`, `created_at`) VALUES
(191, 'Somalia', 'so', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `priority` int(11) NOT NULL,
  `iso_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subunit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subunit_to_unit` int(11) NOT NULL,
  `symbol_first` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_entity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal_mark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thousands_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_numeric` int(11) NOT NULL,
  `is_default` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `priority`, `iso_code`, `name`, `symbol`, `subunit`, `subunit_to_unit`, `symbol_first`, `html_entity`, `decimal_mark`, `thousands_separator`, `iso_numeric`, `is_default`) VALUES
(1, 100, 'AED', 'United Arab Emirates Dirham', 'د.إ', 'Fils', 100, 'true', '', '.', ',', 784, 0),
(2, 100, 'AFN', 'Afghan Afghani', '؋', 'Pul', 100, 'false', '', '.', ',', 971, 0),
(3, 100, 'ALL', 'Albanian Lek', 'L', 'Qintar', 100, 'false', '', '.', ',', 8, 0),
(4, 100, 'AMD', 'Armenian Dram', 'դր.', 'Luma', 100, 'false', '', '.', ',', 51, 0),
(5, 100, 'ANG', 'Netherlands Antillean Gulden', 'ƒ', 'Cent', 100, 'true', '&#x0192;', ',', '.', 532, 0),
(6, 100, 'AOA', 'Angolan Kwanza', 'Kz', 'Cêntimo', 100, 'false', '', '.', ',', 973, 0),
(7, 100, 'ARS', 'Argentine Peso', '$', 'Centavo', 100, 'true', '&#x20B1;', ',', '.', 32, 0),
(8, 4, 'AUD', 'Australian Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 36, 0),
(9, 100, 'AWG', 'Aruban Florin', 'ƒ', 'Cent', 100, 'false', '&#x0192;', '.', ',', 533, 0),
(10, 100, 'AZN', 'Azerbaijani Manat', 'null', 'Qəpik', 100, 'true', '', '.', ',', 944, 0),
(11, 100, 'BAM', 'Bosnia and Herzegovina Convertible Mark', 'КМ', 'Fening', 100, 'true', '', '.', ',', 977, 0),
(12, 100, 'BBD', 'Barbadian Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 52, 0),
(13, 100, 'BDT', 'Bangladeshi Taka', '৳', 'Paisa', 100, 'true', '', '.', ',', 50, 0),
(14, 100, 'BGN', 'Bulgarian Lev', 'лв', 'Stotinka', 100, 'false', '', '.', ',', 975, 0),
(15, 100, 'BHD', 'Bahraini Dinar', 'ب.د', 'Fils', 1000, 'true', '', '.', ',', 48, 0),
(16, 100, 'BIF', 'Burundian Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 108, 0),
(17, 100, 'BMD', 'Bermudian Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 60, 0),
(18, 100, 'BND', 'Brunei Dollar', '$', 'Sen', 100, 'true', '$', '.', ',', 96, 0),
(19, 100, 'BOB', 'Bolivian Boliviano', 'Bs.', 'Centavo', 100, 'true', '', '.', ',', 68, 0),
(20, 100, 'BRL', 'Brazilian Real', 'R$', 'Centavo', 100, 'true', 'R$', ',', '.', 986, 0),
(21, 100, 'BSD', 'Bahamian Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 44, 0),
(22, 100, 'BTN', 'Bhutanese Ngultrum', 'Nu.', 'Chertrum', 100, 'false', '', '.', ',', 64, 0),
(23, 100, 'BWP', 'Botswana Pula', 'P', 'Thebe', 100, 'true', '', '.', ',', 72, 0),
(24, 100, 'BYR', 'Belarusian Ruble', 'Br', 'Kapyeyka', 100, 'false', '', '.', ',', 974, 0),
(25, 100, 'BZD', 'Belize Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 84, 0),
(26, 5, 'CAD', 'Canadian Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 124, 0),
(27, 100, 'CDF', 'Congolese Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 976, 0),
(28, 100, 'CHF', 'Swiss Franc', 'Fr', 'Rappen', 100, 'true', '', '.', ',', 756, 0),
(29, 100, 'CLF', 'Unidad de Fomento', 'UF', 'Peso', 1, 'true', '&#x20B1;', ',', '.', 990, 0),
(30, 100, 'CLP', 'Chilean Peso', '$', 'Peso', 1, 'true', '&#36;', ',', '.', 152, 0),
(31, 100, 'CNY', 'Chinese Renminbi Yuan', '¥', 'Fen', 100, 'true', '&#20803;', '.', ',', 156, 0),
(32, 100, 'COP', 'Colombian Peso', '$', 'Centavo', 100, 'true', '&#x20B1;', ',', '.', 170, 0),
(33, 100, 'CRC', 'Costa Rican Colón', '₡', 'Céntimo', 100, 'true', '&#x20A1;', ',', '.', 188, 0),
(34, 100, 'CUC', 'Cuban Convertible Peso', '$', 'Centavo', 100, 'false', '', '.', ',', 931, 0),
(35, 100, 'CUP', 'Cuban Peso', '$', 'Centavo', 100, 'true', '&#x20B1;', '.', ',', 192, 0),
(36, 100, 'CVE', 'Cape Verdean Escudo', '$', 'Centavo', 100, 'false', '', '.', ',', 132, 0),
(37, 100, 'CZK', 'Czech Koruna', 'Kč', 'Haléř', 100, 'true', '', ',', '.', 203, 0),
(38, 100, 'DJF', 'Djiboutian Franc', 'Fdj', 'Centime', 100, 'false', '', '.', ',', 262, 0),
(39, 100, 'DKK', 'Danish Krone', 'kr', 'Øre', 100, 'false', '', ',', '.', 208, 0),
(40, 100, 'DOP', 'Dominican Peso', '$', 'Centavo', 100, 'true', '&#x20B1;', '.', ',', 214, 0),
(41, 100, 'DZD', 'Algerian Dinar', 'د.ج', 'Centime', 100, 'false', '', '.', ',', 12, 0),
(42, 100, 'EGP', 'Egyptian Pound', 'ج.م', 'Piastre', 100, 'true', '&#x00A3;', '.', ',', 818, 0),
(43, 100, 'ERN', 'Eritrean Nakfa', 'Nfk', 'Cent', 100, 'false', '', '.', ',', 232, 0),
(44, 100, 'ETB', 'Ethiopian Birr', 'Br', 'Santim', 100, 'false', '', '.', ',', 230, 0),
(45, 2, 'EUR', 'Euro', '€', 'Cent', 100, 'true', '&#x20AC;', ',', '.', 978, 0),
(46, 100, 'FJD', 'Fijian Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 242, 0),
(47, 100, 'FKP', 'Falkland Pound', '£', 'Penny', 100, 'false', '&#x00A3;', '.', ',', 238, 0),
(48, 3, 'GBP', 'British Pound', '£', 'Penny', 100, 'true', '&#x00A3;', '.', ',', 826, 0),
(49, 100, 'GEL', 'Georgian Lari', 'ლ', 'Tetri', 100, 'false', '', '.', ',', 981, 0),
(50, 100, 'GHS', 'Ghanaian Cedi', '₵', 'Pesewa', 100, 'true', '&#x20B5;', '.', ',', 936, 0),
(51, 100, 'GIP', 'Gibraltar Pound', '£', 'Penny', 100, 'true', '&#x00A3;', '.', ',', 292, 0),
(52, 100, 'GMD', 'Gambian Dalasi', 'D', 'Butut', 100, 'false', '', '.', ',', 270, 0),
(53, 100, 'GNF', 'Guinean Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 324, 0),
(54, 100, 'GTQ', 'Guatemalan Quetzal', 'Q', 'Centavo', 100, 'true', '', '.', ',', 320, 0),
(55, 100, 'GYD', 'Guyanese Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 328, 0),
(56, 100, 'HKD', 'Hong Kong Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 344, 0),
(57, 100, 'HNL', 'Honduran Lempira', 'L', 'Centavo', 100, 'true', '', '.', ',', 340, 0),
(58, 100, 'HRK', 'Croatian Kuna', 'kn', 'Lipa', 100, 'true', '', ',', '.', 191, 0),
(59, 100, 'HTG', 'Haitian Gourde', 'G', 'Centime', 100, 'false', '', '.', ',', 332, 0),
(60, 100, 'HUF', 'Hungarian Forint', 'Ft', 'Fillér', 100, 'false', '', ',', '.', 348, 0),
(61, 100, 'IDR', 'Indonesian Rupiah', 'Rp', 'Sen', 100, 'true', '', ',', '.', 360, 0),
(62, 100, 'ILS', 'Israeli New Sheqel', '₪', 'Agora', 100, 'true', '&#x20AA;', '.', ',', 376, 0),
(63, 100, 'INR', 'Indian Rupee', '₹', 'Paisa', 100, 'true', '&#x20b9;', '.', ',', 356, 0),
(64, 100, 'IQD', 'Iraqi Dinar', 'ع.د', 'Fils', 1000, 'false', '', '.', ',', 368, 0),
(65, 100, 'IRR', 'Iranian Rial', '﷼', 'Dinar', 100, 'true', '&#xFDFC;', '.', ',', 364, 0),
(66, 100, 'ISK', 'Icelandic Króna', 'kr', 'Eyrir', 100, 'true', '', ',', '.', 352, 0),
(67, 100, 'JMD', 'Jamaican Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 388, 0),
(68, 100, 'JOD', 'Jordanian Dinar', 'د.ا', 'Piastre', 100, 'true', '', '.', ',', 400, 0),
(69, 6, 'JPY', 'Japanese Yen', '¥', 'null', 1, 'true', '&#x00A5;', '.', ',', 392, 0),
(70, 100, 'KES', 'Kenyan Shilling', 'KSh', 'Cent', 100, 'true', '', '.', ',', 404, 0),
(71, 100, 'KGS', 'Kyrgyzstani Som', 'som', 'Tyiyn', 100, 'false', '', '.', ',', 417, 0),
(72, 100, 'KHR', 'Cambodian Riel', '៛', 'Sen', 100, 'false', '&#x17DB;', '.', ',', 116, 0),
(73, 100, 'KMF', 'Comorian Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 174, 0),
(74, 100, 'KPW', 'North Korean Won', '₩', 'Chŏn', 100, 'false', '&#x20A9;', '.', ',', 408, 0),
(75, 100, 'KRW', 'South Korean Won', '₩', 'null', 1, 'true', '&#x20A9;', '.', ',', 410, 0),
(76, 100, 'KWD', 'Kuwaiti Dinar', 'د.ك', 'Fils', 1000, 'true', '', '.', ',', 414, 0),
(77, 100, 'KYD', 'Cayman Islands Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 136, 0),
(78, 100, 'KZT', 'Kazakhstani Tenge', '〒', 'Tiyn', 100, 'false', '', '.', ',', 398, 0),
(79, 100, 'LAK', 'Lao Kip', '₭', 'Att', 100, 'false', '&#x20AD;', '.', ',', 418, 0),
(80, 100, 'LBP', 'Lebanese Pound', 'ل.ل', 'Piastre', 100, 'true', '&#x00A3;', '.', ',', 422, 0),
(81, 100, 'LKR', 'Sri Lankan Rupee', '₨', 'Cent', 100, 'false', '&#x0BF9;', '.', ',', 144, 0),
(82, 100, 'LRD', 'Liberian Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 430, 0),
(83, 100, 'LSL', 'Lesotho Loti', 'L', 'Sente', 100, 'false', '', '.', ',', 426, 0),
(84, 100, 'LTL', 'Lithuanian Litas', 'Lt', 'Centas', 100, 'false', '', '.', ',', 440, 0),
(85, 100, 'LVL', 'Latvian Lats', 'Ls', 'Santīms', 100, 'true', '', '.', ',', 428, 0),
(86, 100, 'LYD', 'Libyan Dinar', 'ل.د', 'Dirham', 1000, 'false', '', '.', ',', 434, 0),
(87, 100, 'MAD', 'Moroccan Dirham', 'د.م.', 'Centime', 100, 'false', '', '.', ',', 504, 0),
(88, 100, 'MDL', 'Moldovan Leu', 'L', 'Ban', 100, 'false', '', '.', ',', 498, 0),
(89, 100, 'MGA', 'Malagasy Ariary', 'Ar', 'Iraimbilanja', 5, 'true', '', '.', ',', 969, 0),
(90, 100, 'MKD', 'Macedonian Denar', 'ден', 'Deni', 100, 'false', '', '.', ',', 807, 0),
(91, 100, 'MMK', 'Myanmar Kyat', 'K', 'Pya', 100, 'false', '', '.', ',', 104, 0),
(92, 100, 'MNT', 'Mongolian Tögrög', '₮', 'Möngö', 100, 'false', '&#x20AE;', '.', ',', 496, 0),
(93, 100, 'MOP', 'Macanese Pataca', 'P', 'Avo', 100, 'false', '', '.', ',', 446, 0),
(94, 100, 'MRO', 'Mauritanian Ouguiya', 'UM', 'Khoums', 5, 'false', '', '.', ',', 478, 0),
(95, 100, 'MUR', 'Mauritian Rupee', '₨', 'Cent', 100, 'true', '&#x20A8;', '.', ',', 480, 0),
(96, 100, 'MVR', 'Maldivian Rufiyaa', 'MVR', 'Laari', 100, 'false', '', '.', ',', 462, 0),
(97, 100, 'MWK', 'Malawian Kwacha', 'MK', 'Tambala', 100, 'false', '', '.', ',', 454, 0),
(98, 100, 'MXN', 'Mexican Peso', '$', 'Centavo', 100, 'true', '$', '.', ',', 484, 0),
(99, 100, 'MYR', 'Malaysian Ringgit', 'RM', 'Sen', 100, 'true', '', '.', ',', 458, 0),
(100, 100, 'MZN', 'Mozambican Metical', 'MTn', 'Centavo', 100, 'true', '', ',', '.', 943, 0),
(101, 100, 'NAD', 'Namibian Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 516, 0),
(102, 100, 'NGN', 'Nigerian Naira', '₦', 'Kobo', 100, 'false', '&#x20A6;', '.', ',', 566, 0),
(103, 100, 'NIO', 'Nicaraguan Córdoba', 'C$', 'Centavo', 100, 'false', '', '.', ',', 558, 0),
(104, 100, 'NOK', 'Norwegian Krone', 'kr', 'Øre', 100, 'true', 'kr', ',', '.', 578, 0),
(105, 100, 'NPR', 'Nepalese Rupee', '₨', 'Paisa', 100, 'true', '&#x20A8;', '.', ',', 524, 0),
(106, 100, 'NZD', 'New Zealand Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 554, 0),
(107, 100, 'OMR', 'Omani Rial', 'ر.ع.', 'Baisa', 1000, 'true', '&#xFDFC;', '.', ',', 512, 0),
(108, 100, 'PAB', 'Panamanian Balboa', 'B/.', 'Centésimo', 100, 'false', '', '.', ',', 590, 0),
(109, 100, 'PEN', 'Peruvian Nuevo Sol', 'S/.', 'Céntimo', 100, 'true', 'S/.', '.', ',', 604, 0),
(110, 100, 'PGK', 'Papua New Guinean Kina', 'K', 'Toea', 100, 'false', '', '.', ',', 598, 0),
(111, 100, 'PHP', 'Philippine Peso', '₱', 'Centavo', 100, 'true', '&#x20B1;', '.', ',', 608, 0),
(112, 100, 'PKR', 'Pakistani Rupee', '₨', 'Paisa', 100, 'true', '&#x20A8;', '.', ',', 586, 0),
(113, 100, 'PLN', 'Polish Złoty', 'zł', 'Grosz', 100, 'false', 'z&#322;', ',', '', 985, 0),
(114, 100, 'PYG', 'Paraguayan Guaraní', '₲', 'Céntimo', 100, 'true', '&#x20B2;', '.', ',', 600, 0),
(115, 100, 'QAR', 'Qatari Riyal', 'ر.ق', 'Dirham', 100, 'false', '&#xFDFC;', '.', ',', 634, 0),
(116, 100, 'RON', 'Romanian Leu', 'Lei', 'Bani', 100, 'true', '', ',', '.', 946, 0),
(117, 100, 'RSD', 'Serbian Dinar', 'РСД', 'Para', 100, 'true', '', '.', ',', 941, 0),
(118, 100, 'RUB', 'Russian Ruble', 'р.', 'Kopek', 100, 'false', '&#x0440;&#x0443;&#x0431;', ',', '.', 643, 0),
(119, 100, 'RWF', 'Rwandan Franc', 'FRw', 'Centime', 100, 'false', '', '.', ',', 646, 0),
(120, 100, 'SAR', 'Saudi Riyal', 'ر.س', 'Hallallah', 100, 'true', '&#xFDFC;', '.', ',', 682, 0),
(121, 100, 'SBD', 'Solomon Islands Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 90, 0),
(122, 100, 'SCR', 'Seychellois Rupee', '₨', 'Cent', 100, 'false', '&#x20A8;', '.', ',', 690, 0),
(123, 100, 'SDG', 'Sudanese Pound', '£', 'Piastre', 100, 'true', '', '.', ',', 938, 0),
(124, 100, 'SEK', 'Swedish Krona', 'kr', 'Öre', 100, 'false', '', ',', '', 752, 0),
(125, 100, 'SGD', 'Singapore Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 702, 0),
(126, 100, 'SHP', 'Saint Helenian Pound', '£', 'Penny', 100, 'false', '&#x00A3;', '.', ',', 654, 0),
(127, 100, 'SKK', 'Slovak Koruna', 'Sk', 'Halier', 100, 'true', '', '.', ',', 703, 0),
(128, 100, 'SLL', 'Sierra Leonean Leone', 'Le', 'Cent', 100, 'false', '', '.', ',', 694, 0),
(129, 100, 'SOS', 'Somali Shilling', 'Sh', 'Cent', 100, 'false', '', '.', ',', 706, 0),
(130, 100, 'SRD', 'Surinamese Dollar', '$', 'Cent', 100, 'false', '', '.', ',', 968, 0),
(131, 100, 'SSP', 'South Sudanese Pound', '£', 'piaster', 100, 'false', '&#x00A3;', '.', ',', 728, 0),
(132, 100, 'STD', 'São Tomé and Príncipe Dobra', 'Db', 'Cêntimo', 100, 'false', '', '.', ',', 678, 0),
(133, 100, 'SVC', 'Salvadoran Colón', '₡', 'Centavo', 100, 'true', '&#x20A1;', '.', ',', 222, 0),
(134, 100, 'SYP', 'Syrian Pound', '£S', 'Piastre', 100, 'false', '&#x00A3;', '.', ',', 760, 0),
(135, 100, 'SZL', 'Swazi Lilangeni', 'L', 'Cent', 100, 'true', '', '.', ',', 748, 0),
(136, 100, 'THB', 'Thai Baht', '฿', 'Satang', 100, 'true', '&#x0E3F;', '.', ',', 764, 0),
(137, 100, 'TJS', 'Tajikistani Somoni', 'ЅМ', 'Diram', 100, 'false', '', '.', ',', 972, 0),
(138, 100, 'TMT', 'Turkmenistani Manat', 'T', 'Tenge', 100, 'false', '', '.', ',', 934, 0),
(139, 100, 'TND', 'Tunisian Dinar', 'د.ت', 'Millime', 1000, 'false', '', '.', ',', 788, 0),
(140, 100, 'TOP', 'Tongan Paʻanga', 'T$', 'Seniti', 100, 'true', '', '.', ',', 776, 0),
(141, 100, 'TRY', 'Turkish Lira', 'TL', 'kuruş', 100, 'false', '', ',', '.', 949, 0),
(142, 100, 'TTD', 'Trinidad and Tobago Dollar', '$', 'Cent', 100, 'false', '$', '.', ',', 780, 0),
(143, 100, 'TWD', 'New Taiwan Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 901, 0),
(144, 100, 'TZS', 'Tanzanian Shilling', 'Sh', 'Cent', 100, 'true', '', '.', ',', 834, 0),
(145, 100, 'UAH', 'Ukrainian Hryvnia', '₴', 'Kopiyka', 100, 'false', '&#x20B4;', '.', ',', 980, 0),
(146, 100, 'UGX', 'Ugandan Shilling', 'USh', 'Cent', 100, 'false', '', '.', ',', 800, 0),
(147, 1, 'USD', 'United States Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 840, 0),
(148, 100, 'UYU', 'Uruguayan Peso', '$', 'Centésimo', 100, 'true', '&#x20B1;', ',', '.', 858, 0),
(149, 100, 'UZS', 'Uzbekistani Som', 'null', 'Tiyin', 100, 'false', '', '.', ',', 860, 0),
(150, 100, 'VEF', 'Venezuelan Bolívar', 'Bs F', 'Céntimo', 100, 'true', '', ',', '.', 937, 0),
(151, 100, 'VND', 'Vietnamese Đồng', '₫', 'Hào', 10, 'true', '&#x20AB;', ',', '.', 704, 0),
(152, 100, 'VUV', 'Vanuatu Vatu', 'Vt', 'null', 1, 'true', '', '.', ',', 548, 0),
(153, 100, 'WST', 'Samoan Tala', 'T', 'Sene', 100, 'false', '', '.', ',', 882, 0),
(154, 100, 'XAF', 'Central African Cfa Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 950, 0),
(155, 100, 'XAG', 'Silver (Troy Ounce)', 'oz t', 'oz', 1, 'false', '', '.', ',', 961, 0),
(156, 100, 'XAU', 'Gold (Troy Ounce)', 'oz t', 'oz', 1, 'false', '', '.', ',', 959, 0),
(157, 100, 'XCD', 'East Caribbean Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 951, 0),
(158, 100, 'XDR', 'Special Drawing Rights', 'SDR', '', 1, 'false', '$', '.', ',', 960, 0),
(159, 100, 'XOF', 'West African Cfa Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 952, 0),
(160, 100, 'XPF', 'Cfp Franc', 'Fr', 'Centime', 100, 'false', '', '.', ',', 953, 0),
(161, 100, 'YER', 'Yemeni Rial', '﷼', 'Fils', 100, 'false', '&#xFDFC;', '.', ',', 886, 0),
(162, 100, 'ZAR', 'South African Rand', 'R', 'Cent', 100, 'true', '&#x0052;', '.', ',', 710, 0),
(163, 100, 'ZMK', 'Zambian Kwacha', 'ZK', 'Ngwee', 100, 'false', '', '.', ',', 894, 0),
(164, 100, 'ZMW', 'Zambian Kwacha', 'ZK', 'Ngwee', 100, 'false', '', '.', ',', 967, 0),
(165, 1, 'USD', 'United States Dollar', '$', 'Cent', 100, 'true', '$', '.', ',', 840, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_services`
--

CREATE TABLE `ecommerce_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order_id` int(11) NOT NULL DEFAULT 1,
  `update_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `body`, `is_active`, `order_id`, `update_by`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(3, 'What are Digital Business Cards?', 'Digital business cards are a modern way of exchanging a limitless amount contact information. They are digital versions of traditional paper business cards and provide a more efficient way to share every platform you utilize to maintian your brand.  Digital business cards are typically shared via text message, email, or other digital communication platforms. They are also often used with QR codes and today more commonly with NFC (Near Field Communication) technology to quickly and easily share contact.', 0, 1, NULL, 1, '2023-01-14 11:24:58', '2023-04-18 07:29:15', 1),
(4, 'What does NFC mean?', 'Near Field Communication (NFC) technology is a wireless technology that allows two devices to communicate with each other when they are close together. NFC tags can be used to store digital business cards, allowing users to quickly and easily share their contact information with others.', 1, 2, NULL, 1, '2023-01-15 05:15:20', '2023-04-09 10:16:43', 1),
(5, 'What are digital business cards?', 'Digital business cards are a modern way of exchanging a limitless amount contact information. They are digital versions of traditional paper business cards and provide a more efficient way to share every platform you utilize to maintain your brand.  Digital business cards are typically shared via text message, email, or other digital communication platforms. They are also often used with QR codes and today more commonly with NFC (Near Field Communication) technology to quickly and easily share contact information.', 1, 3, NULL, 1, '2023-01-16 10:36:48', '2023-01-20 10:10:09', 1),
(7, 'What are QR Codes', 'Those weird looking boxes that look like a funky art piece is really a QR code. A two-dimensional barcode that can be scanned using a smartphone camera. They can be used to quickly and easily share digital business cards with others. QR codes can be printed on traditional paper business cards or displayed on digital devices, such as tablets or laptops.', 1, 4, NULL, 73, '2023-01-27 06:14:35', NULL, NULL),
(8, 'Why MTGPRO.ME?', 'MTGPRO.ME is the number 1 digital business card solution tailored specifically to mortgage professionals. With industry features like a mortgage calculator on your PROfile, the ability to keep compliant displaying your NMLS ID and Equal Housing logo, and free marketing material with select plans, MTGPRO.ME will not only save you money but also make it easy to scale your business.', 1, 5, NULL, 73, '2023-01-27 06:27:03', '2023-01-28 08:25:03', 73),
(15, 'test', 'test', 1, 6, NULL, 1, '2023-02-13 06:55:00', '2023-02-13 06:55:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'flag-icon-gb', 'ltr', '2022-08-19 23:31:12', '2022-08-19 23:31:12'),
(2, 'Chinese', 'zh', 'flag-icon-cn', 'ltr', '2022-12-20 09:15:21', '2022-12-21 09:46:38'),
(3, 'French', 'fr', 'flag-icon-fr', 'ltr', '2022-12-20 12:47:11', '2022-12-20 12:47:11'),
(4, 'Bislama', 'bi', 'flag-icon-vu', 'ltr', '2022-12-22 07:37:24', '2022-12-22 07:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `status` int(3) NOT NULL DEFAULT 0 COMMENT '0 = inactive,\r\n1 = Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_owner_name` varchar(100) NOT NULL,
  `business_owner_phone` varchar(16) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `city` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_branch_name` varchar(100) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `account_holder_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `id_type` varchar(10) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `id_font_image` varchar(100) NOT NULL,
  `id_back_image` varchar(100) NOT NULL,
  `agree` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `business_name`, `business_owner_name`, `business_owner_phone`, `business_email`, `address_line`, `street_address`, `city`, `state`, `zip_code`, `bank_name`, `bank_branch_name`, `account_type`, `account_holder_name`, `account_number`, `id_type`, `id_number`, `profile_pic`, `id_font_image`, `id_back_image`, `agree`, `status`, `updated_at`, `created_at`) VALUES
(1, 'test', 'test', '01794798227', 'test@gmail.com', 'test', 'test', 2790952, 3889, '1740', 'test', 'test', 'current', 'test', 'test', 'current', 'test', 'uploads/merchant/prfile_pic/1681816373_643e7b352181b.jpg', 'uploads/merchant/id_card/1681816369_643e7b318b8ec.jpg', 'uploads/merchant/id_card/1681816372_643e7b34e200b.jpg', 1, 0, '2023-04-26 01:47:53', '2023-04-17 23:12:53'),
(2, 'Arobil', 'Arobil', '01794798228', 'mdmridul6088@gmail.com', 'zinda park', 'test', 2790952, 3889, '1740', 'asds', 'dasdasd', 'current', 'asdas', 'asdas', 'savings', '12345', 'uploads/merchant/prfile_pic/1682497366_6448df5673519.jpg', 'uploads/merchant/id_card/1682497362_6448df5292b0a.jpg', 'uploads/merchant/id_card/1682497365_6448df55e4930.jpg', 1, 0, '2023-04-26 02:22:46', '2023-04-26 02:22:46'),
(3, 'sadasd', 'asdasdas', '12121', 'asdad@gmail.com', 'test', 'test', 2790952, 3889, 'test', 'asds', 'dasdasd', 'savings', 'asdas', 'asdas', 'savings', '12345', 'uploads/merchant/prfile_pic/1682576995_644a1663067e5.jpg', 'uploads/merchant/id_card/1682576994_644a16625485d.jpg', 'uploads/merchant/id_card/1682576994_644a1662a7e1a.jpg', 1, 0, '2023-04-27 00:29:55', '2023-04-27 00:29:55'),
(4, 'Arobil', 'Arobil', '01794798222', 'mdmridul6088q@gmail.com', 'zinda park', 'test', 2790952, 3889, '1740', 'asds', 'dasdasd', 'current', 'asdas', 'asdas', 'current', '12345', 'uploads/merchant/prfile_pic/1682592774_644a5406bdb68.jpg', 'uploads/merchant/id_card/1682592768_644a5400032ad.jpg', 'uploads/merchant/id_card/1682592771_644a54035f256.jpg', 1, 0, '2023-04-27 04:52:54', '2023-04-27 04:52:54'),
(5, 'Arobil', 'Arobil', '017947982221', 'mdmridul6088q1@gmail.com', 'zinda park', 'test', 2790952, 3889, '1740', 'asds', 'dasdasd', 'current', 'asdas', 'asdas', 'savings', '12345', 'uploads/merchant/prfile_pic/1682592915_644a5493b090a.jpg', 'uploads/merchant/id_card/1682592915_644a5493079a7.jpg', 'uploads/merchant/id_card/1682592915_644a54935e7f6.jpg', 1, 0, '2023-04-27 04:55:15', '2023-04-27 04:55:15'),
(6, 'Arobil', 'Arobil', '0179479822211', 'mdmridul6088q11@gmail.com', 'zinda park', 'test', 2790952, 3889, '1740', 'asds', 'dasdasd', 'current', 'asdas', 'asdas', 'savings', '12345', 'uploads/merchant/prfile_pic/1682592980_644a54d4e79e1.jpg', 'uploads/merchant/id_card/1682592980_644a54d43b4a9.jpg', 'uploads/merchant/id_card/1682592980_644a54d4931a2.jpg', 1, 0, '2023-04-27 04:56:20', '2023-04-27 04:56:20');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_18_050842_create_roles_table', 1);

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
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\User', 7),
(2, 'App\\Models\\Admin', 2),
(2, 'App\\Models\\Admin', 4),
(2, 'App\\Models\\Admin', 5),
(2, 'App\\Models\\Admin', 7),
(19, 'App\\Models\\Admin', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount` float(14,2) DEFAULT 0.00,
  `coupon_discount` float(14,2) NOT NULL DEFAULT 0.00,
  `total_price` float(14,2) DEFAULT 0.00,
  `payment_fee` float(14,2) NOT NULL DEFAULT 0.00,
  `vat` float(14,2) DEFAULT 0.00,
  `grand_total` float DEFAULT 0,
  `discount_percentage` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1=Photo Frame,2=gift card'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `our_services`
--

CREATE TABLE `our_services` (
  `id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_services`
--

INSERT INTO `our_services` (`id`, `icon`, `title`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'fab fa-bitcoin', 'Big Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 1, '2023-04-26 05:36:53', '2023-04-26 05:36:53'),
(3, 'fab fa-behance-square', 'title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 2, '2023-04-26 05:44:21', '2023-04-26 05:44:45'),
(4, 'fab fa-bitcoin', 'Big Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 1, '2023-04-26 05:36:53', '2023-04-26 05:36:53'),
(5, 'fab fa-behance-square', 'title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 2, '2023-04-26 05:44:21', '2023-04-26 05:44:45'),
(6, 'fab fa-bitcoin', 'Big Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 1, '2023-04-26 05:36:53', '2023-04-26 05:36:53'),
(7, 'fab fa-behance-square', 'title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 2, '2023-04-26 05:44:21', '2023-04-26 05:44:45'),
(10, 'fab fa-bitcoin', 'Big Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 1, '2023-04-26 05:36:53', '2023-04-26 05:36:53'),
(12, 'fab fa-bitcoin', 'Big Store', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus.', 1, '2023-04-26 05:36:53', '2023-04-26 05:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` int(11) NOT NULL,
  `about_us` text NOT NULL,
  `privacy_policy` text DEFAULT NULL,
  `terms_condition` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `about_us`, `privacy_policy`, `terms_condition`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus. Maecenas consectetur libero non velit laoreet posu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus. Maecenas consectetur libero non velit laoreet posuere.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus. Maecenas consectetur libero non velit laoreet posuere.', '2023-04-26 23:08:55', '2023-04-26 23:09:04');

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
  `name` varchar(124) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(124) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.user.index', 'admin', 'admin', '2023-01-24 01:52:41', '2023-01-24 01:52:41'),
(2, 'admin.user.create', 'admin', 'admin', '2023-01-24 01:52:50', '2023-01-24 01:52:50'),
(3, 'admin.user.edit', 'admin', 'admin', NULL, NULL),
(4, 'admin.user.destroy', 'admin', 'admin', NULL, NULL),
(5, 'admin.cpage.index', 'custom-page', 'admin', NULL, NULL),
(6, 'admin.cpage.create', 'custom-page', 'admin', NULL, NULL),
(7, 'admin.cpage.store', 'custom-page', 'admin', NULL, NULL),
(8, 'admin.cpage.edit', 'custom-page', 'admin', NULL, NULL),
(9, 'admin.cpage.view', 'custom-page', 'admin', NULL, NULL),
(10, 'admin.cpage.update', 'custom-page', 'admin', NULL, NULL),
(11, 'admin.cpage.delete', 'custom-page', 'admin', NULL, NULL),
(16, 'admin.faq.index', 'faq', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(17, 'admin.faq.create', 'faq', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(18, 'admin.faq.store', 'faq', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(19, 'admin.faq.edit', 'faq', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(20, 'admin.faq.view', 'faq', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(21, 'admin.faq.update', 'faq', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(29, 'admin.blog-post.index', 'blog-post', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(30, 'admin.blog-post.create', 'blog-post', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(31, 'admin.blog-post.store', 'blog-post', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(32, 'admin.blog-post.edit', 'blog-post', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(33, 'admin.blog-post.view', 'blog-post', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(34, 'admin.blog-post.update', 'blog-post', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(35, 'admin.blog-post.delete', 'blog-post', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(36, 'admin.contact.index', 'contact', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(37, 'admin.contact.create', 'contact', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(38, 'admin.contact.store', 'contact', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(39, 'admin.contact.edit', 'contact', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(40, 'admin.contact.view', 'contact', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(41, 'admin.contact.update', 'contact', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(42, 'admin.contact.delete', 'contact', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(57, 'admin.faq.delete', 'faq', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(58, 'admin.customer.index', 'customer', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(59, 'admin.customer.create', 'customer', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(60, 'admin.customer.store', 'customer', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(61, 'admin.customer.edit', 'customer', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(62, 'admin.customer.view', 'customer', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(63, 'admin.customer.update', 'customer', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(64, 'admin.customer.delete', 'customer', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(65, 'admin.country.index', 'country', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(66, 'admin.country.create', 'country', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(67, 'admin.country.store', 'country', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(68, 'admin.country.edit', 'country', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(69, 'admin.country.view', 'country', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(70, 'admin.country.update', 'country', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(71, 'admin.country.delete', 'country', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(72, 'admin.region.index', 'region', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(73, 'admin.region.create', 'region', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(74, 'admin.region.store', 'region', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(75, 'admin.region.edit', 'region', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(76, 'admin.region.view', 'region', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(77, 'admin.region.update', 'region', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(78, 'admin.region.delete', 'region', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(79, 'admin.cities.index', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(80, 'admin.cities.create', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(81, 'admin.cities.store', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(82, 'admin.cities.edit', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(83, 'admin.cities.view', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(84, 'admin.cities.update', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(85, 'admin.cities.delete', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(90, 'admin.merchant.edit', 'merchant', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(91, 'admin.merchant.view', 'merchant', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(92, 'admin.merchant.create', 'merchant', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(93, 'admin.merchant.delete', 'merchant', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(94, 'admin.pickup-request.edit', 'pickup-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(95, 'admin.pickup-request.view', 'pickup-request', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(96, 'admin.pickup-request.create', 'pickup-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(97, 'admin.pickup-request.delete', 'pickup-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(98, 'admin.price-group.edit', 'price-group', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(99, 'admin.price-group.view', 'price-group', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(100, 'admin.price-group.create', 'price-group', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(101, 'admin.price-group.delete', 'price-group', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(102, 'admin.price.edit', 'price', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(103, 'admin.price.view', 'price', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(104, 'admin.price.create', 'price', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(105, 'admin.price.delete', 'price', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(106, 'admin.weights.edit', 'weights', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(107, 'admin.weights.view', 'weights', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(108, 'admin.weights.create', 'weights', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(109, 'admin.weights.delete', 'weights', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(110, 'admin.cms.ourservice.edit', 'ourservice', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(111, 'admin.cms.ourservice.view', 'ourservice', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(112, 'admin.cms.ourservice.create', 'ourservice', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(113, 'admin.cms.ourservice.destroy', 'ourservice', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(114, 'admin.cms.ecommerceService.edit', 'ecommerceService', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(115, 'admin.cms.ecommerceService.view', 'ecommerceService', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(116, 'admin.cms.ecommerceService.create', 'ecommerceService', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(117, 'admin.cms.ecommerceService.destroy', 'ecommerceService', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(118, 'admin.settings.general_store', 'settings', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(119, 'admin.settings.general', 'settings', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(120, 'admin.settings.language', 'settings', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(121, 'admin.cms.get.pages', 'pages', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(122, 'admin.merchant.index', 'merchant', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(123, 'admin.merchant-request.index', 'merchant-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(124, 'admin.merchant-request.show', 'merchant-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(125, 'admin.merchant-request.approved', 'merchant-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(126, 'admin.roles.index', 'Roles', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(127, 'admin.roles.create', 'Roles', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(128, 'admin.roles.show', 'Roles', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(129, 'admin.roles.update', 'Roles', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(130, 'admin.roles.destroy', 'Roles', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(131, 'admin.permissions.index', 'Permissions', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(132, 'admin.permissions.create', 'Permissions', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(133, 'admin.permissions.show', 'Permissions', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(134, 'admin.Permissions.update', 'Permissions', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(135, 'admin.permissions.destroy', 'Permissions', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(136, 'admin.pickup-request.index', 'pickup-request', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(137, 'admin.price-group.index', 'price-group', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(138, 'admin.price.index', 'price', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(139, 'admin.cms.ourservice.index', 'ourservice', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(140, 'admin.cms.ecommerceService.index', 'ecommerceService', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` int(11) NOT NULL,
  `traking_number` varchar(50) NOT NULL,
  `pickup_name` varchar(255) DEFAULT NULL,
  `pickup_contact_name` varchar(255) DEFAULT NULL,
  `pickup_address` varchar(255) DEFAULT NULL,
  `pickup_street_address` varchar(255) DEFAULT NULL,
  `pickup_city` varchar(255) DEFAULT NULL,
  `pickup_zip` varchar(255) DEFAULT NULL,
  `pickup_mobile` varchar(255) DEFAULT NULL,
  `pickup_email` varchar(255) DEFAULT NULL,
  `delivery_name` varchar(255) DEFAULT NULL,
  `delivery_contact_name` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_street_address` varchar(255) DEFAULT NULL,
  `delivery_city` varchar(255) DEFAULT NULL,
  `pricing_group_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `delivery_zip` varchar(50) DEFAULT NULL,
  `delivery_mobile` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `cod_amount` varchar(50) DEFAULT NULL,
  `amount` float(8,2) DEFAULT 0.00,
  `description` varchar(255) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 0 COMMENT '0 = inactive,\r\n1 = Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`id`, `traking_number`, `pickup_name`, `pickup_contact_name`, `pickup_address`, `pickup_street_address`, `pickup_city`, `pickup_zip`, `pickup_mobile`, `pickup_email`, `delivery_name`, `delivery_contact_name`, `delivery_address`, `delivery_street_address`, `delivery_city`, `pricing_group_id`, `merchant_id`, `delivery_zip`, `delivery_mobile`, `quantity`, `weight`, `cod_amount`, `amount`, `description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'SDJUAU75AJH', 'Md Mridul', 'Md MRidul', 'mawna', 'Sreepur', '2790953', '1740', '01794798227', 'mdmridul608@gmail.com', 'jone Doye', 'Doye', 'Dhaka', 'Bonani', '2790953', 1, NULL, '1740', '01794798227', 10, '4', '20', 80.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu egestas tellus. Maecenas consectetur libero non velit laoreet posuere.', 0, '2023-04-26 23:55:40', '2023-04-26 23:59:02', NULL, NULL),
(2, 'RCHVNSNA', 'dasdasd', 'asdasd', 'asdasd', 'asdasd', '2790952', 'asdasd', 'asdasd', NULL, 'asdasdas', 'asdasdas', 'asdasdas', 'asdasdas', '2790952', 1, NULL, 'asdasdas', 'asdasdad', 121, '3', '121221', 50.00, 'asdasda', 0, '2023-04-27 02:56:44', '2023-04-27 02:56:44', NULL, NULL),
(3, 'PW4P73TF', 'Md Mridul', 'Md Mridul', 'zinda park', 'test', '2790952', '1740', '01794798227', 'mdmridul6088@gmail.com', 'Md Mridul', 'Md Mridul', 'zinda park', 'test', '2790952', 1, NULL, '1740', '01794798227', 10, '3', '10', 50.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 0, '2023-04-27 04:10:50', '2023-04-27 04:10:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` int(11) NOT NULL,
  `pricing_group_id` int(10) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `weight_id` int(11) DEFAULT NULL,
  `products_weight` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `inside_main_city_price` float(13,2) NOT NULL DEFAULT 0.00,
  `inter_city_price` float(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `pricing_group_id`, `item_name`, `weight_id`, `products_weight`, `status`, `order_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `inside_main_city_price`, `inter_city_price`) VALUES
(14, 1, 'All Item', 3, NULL, 1, 1, '2023-04-18 09:03:01', NULL, '2023-04-18 09:03:01', NULL, 50.00, 40.00),
(15, 1, 'All Item', 4, NULL, 1, 2, '2023-04-18 09:03:22', NULL, '2023-04-18 09:03:22', NULL, 80.00, 70.00),
(16, 1, 'All Item', 5, NULL, 1, 3, '2023-04-18 09:03:42', NULL, '2023-04-18 09:03:42', NULL, 110.00, 100.00),
(17, 1, 'All Item', 6, NULL, 1, 4, '2023-04-18 09:04:03', NULL, '2023-04-18 09:04:03', NULL, 140.00, 130.00),
(18, 1, 'All Item', 7, NULL, 1, 5, '2023-04-18 09:04:29', NULL, '2023-04-18 09:04:29', NULL, 160.00, 150.00),
(19, 1, 'All Item', 8, NULL, 1, 6, '2023-04-18 09:04:54', NULL, '2023-04-18 09:04:54', NULL, 180.00, 170.00),
(20, 1, 'All Item', 9, NULL, 1, 7, '2023-04-18 09:05:16', NULL, '2023-04-18 09:05:16', NULL, 200.00, 190.00),
(21, 1, 'All Item', 10, NULL, 1, 8, '2023-04-18 09:05:49', NULL, '2023-04-18 09:05:49', NULL, 220.00, 210.00),
(22, 1, 'All Item', 11, NULL, 1, 9, '2023-04-18 09:06:12', NULL, '2023-04-18 09:06:12', NULL, 240.00, 230.00),
(23, 1, 'All Item', 12, NULL, 1, 10, '2023-04-18 09:06:35', NULL, '2023-04-18 09:06:35', NULL, 260.00, 250.00),
(24, 2, 'All Item', 3, NULL, 1, 1, '2023-04-18 09:09:23', NULL, '2023-04-18 09:09:23', NULL, 150.00, 120.00),
(25, 2, 'All Item', 4, NULL, 1, 2, '2023-04-18 09:09:57', NULL, '2023-04-18 09:09:57', NULL, 170.00, 140.00),
(26, 2, 'All Item', 5, NULL, 1, 3, '2023-04-18 09:10:19', NULL, '2023-04-18 09:10:19', NULL, 190.00, 160.00),
(27, 2, 'All Item', 6, NULL, 1, 4, '2023-04-18 09:10:45', NULL, '2023-04-18 09:10:45', NULL, 210.00, 180.00),
(28, 2, 'All Item', 7, NULL, 1, 5, '2023-04-18 09:11:08', NULL, '2023-04-18 09:11:08', NULL, 230.00, 200.00),
(29, 2, 'All Item', 8, NULL, 1, 6, '2023-04-18 09:11:32', NULL, '2023-04-18 09:11:32', NULL, 250.00, 220.00),
(30, 2, 'All Item', 9, NULL, 1, 7, '2023-04-18 09:11:53', NULL, '2023-04-18 09:11:53', NULL, 270.00, 240.00),
(31, 2, 'All Item', 10, NULL, 1, 8, '2023-04-18 09:12:50', NULL, '2023-04-18 09:12:50', NULL, 290.00, 260.00),
(32, 2, 'All Item', 11, NULL, 1, 9, '2023-04-18 09:13:14', NULL, '2023-04-18 09:13:14', NULL, 310.00, 280.00),
(33, 3, 'All Item', 3, NULL, 1, 1, '2023-04-18 09:13:51', NULL, '2023-04-18 09:13:51', NULL, 180.00, 160.00),
(34, 3, 'All Item', 4, NULL, 1, 2, '2023-04-18 09:14:12', NULL, '2023-04-18 09:14:12', NULL, 210.00, 190.00),
(35, 3, 'All Item', 5, NULL, 1, 3, '2023-04-18 09:14:39', NULL, '2023-04-18 09:14:39', NULL, 240.00, 220.00),
(36, 3, 'All Item', 6, NULL, 1, 4, '2023-04-18 09:15:17', NULL, '2023-04-18 09:15:17', NULL, 270.00, 250.00),
(37, 3, 'All Item', 7, NULL, 1, 5, '2023-04-18 09:15:47', NULL, '2023-04-18 09:15:47', NULL, 300.00, 280.00),
(38, 3, 'All Item', 8, NULL, 1, 6, '2023-04-18 09:16:31', NULL, '2023-04-18 09:16:31', NULL, 330.00, 310.00),
(39, 3, 'All Item', 9, NULL, 1, 7, '2023-04-18 09:17:19', NULL, '2023-04-27 06:34:07', NULL, 360.00, 340.00);

-- --------------------------------------------------------

--
-- Table structure for table `pricing_group`
--

CREATE TABLE `pricing_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_group`
--

INSERT INTO `pricing_group` (`id`, `name`, `status`, `order_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Regular Delivery', 1, 1, '2023-04-16 00:00:00', NULL, NULL, NULL),
(2, 'Express Rate Inside City', 1, 2, NULL, NULL, '2023-04-16 09:15:32', NULL),
(3, 'Time Definite Delivery', 1, 3, NULL, NULL, '2023-04-16 09:15:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `code`, `country_id`, `created_at`, `updated_at`) VALUES
(3889, 'Somalia Land', '10', 191, '2023-04-15 10:29:45', '2023-04-15 10:29:45'),
(3890, 'State 2', '2', 191, '2023-04-15 10:30:03', '2023-04-15 10:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2023-01-17 23:50:17', NULL),
(2, 'admin', 'admin', '2023-01-17 23:50:17', NULL),
(16, 'manager', 'admin', '2023-04-17 22:37:58', '2023-04-17 22:37:58'),
(17, 'Writer', 'admin', '2023-04-17 22:39:02', '2023-04-17 22:39:02'),
(19, 'merchant', 'admin', '2023-04-25 23:37:51', '2023-04-25 23:37:51');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(8, 2),
(9, 1),
(10, 1),
(11, 1),
(16, 1),
(16, 17),
(17, 1),
(17, 17),
(18, 1),
(18, 17),
(19, 1),
(19, 17),
(20, 1),
(20, 17),
(21, 1),
(21, 17),
(29, 1),
(29, 16),
(30, 1),
(30, 16),
(31, 1),
(31, 16),
(32, 1),
(32, 16),
(33, 1),
(33, 16),
(34, 1),
(34, 16),
(35, 1),
(35, 16),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(57, 1),
(57, 17),
(58, 1),
(58, 17),
(59, 1),
(59, 17),
(60, 1),
(60, 17),
(61, 1),
(61, 17),
(62, 1),
(62, 17),
(63, 1),
(63, 17),
(64, 1),
(64, 17),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(72, 16),
(73, 1),
(73, 16),
(74, 1),
(74, 16),
(75, 1),
(75, 16),
(76, 1),
(76, 16),
(77, 1),
(77, 16),
(78, 1),
(78, 16),
(79, 1),
(79, 16),
(80, 1),
(80, 16),
(81, 1),
(81, 16),
(82, 1),
(82, 16),
(83, 1),
(83, 16),
(84, 1),
(84, 16),
(85, 1),
(85, 16),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 19),
(95, 1),
(95, 19),
(96, 1),
(96, 19),
(97, 1),
(97, 19),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `page_slug`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Find the Perfect Vanuturental for Sale | Vanuturental Available Now ', 'Looking vanuturantal for sale? We have hundreds of options available. Find something that matches your interests and lifestyle and budget.', 'uploads/seos/1680412310_64290e96ae286.png', '2023-04-01 23:11:50', '2023-04-01 23:11:50'),
(2, 'about', 'About', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', NULL, '2022-07-25 05:09:47', '2023-01-14 09:44:05'),
(3, 'contact', 'Contact us', 'We have hundreds of options available. Find something that matches your interests and lifestyle, and budget', NULL, '2022-07-25 05:09:47', '2023-03-23 05:38:36'),
(4, 'privacy-policy', 'Privacy Policy', 'Best Franchises: Privacy Policy, can I get some franchises', NULL, '2022-07-25 05:09:47', '2022-07-25 05:09:47'),
(5, 'faq', 'Faq', 'Best Franchises: Privacy Policy, can I get some franchises', NULL, '2022-07-25 05:09:47', '2022-07-25 05:09:47'),
(6, 'terms-and-conditions', 'Terms and Conditions', 'Best Franchises: Privacy Policy, can I get some franchises', NULL, '2022-07-25 05:09:47', '2022-07-25 05:09:47'),
(7, 'survices', 'Survices', 'Best Franchises: Privacy Policy, can I get some franchises', NULL, '2022-07-25 05:09:47', '2022-07-25 05:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `google_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_analytics_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keywords` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tawk_chat_bot_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `encryption` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `application_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_mode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'local/live',
  `facebook_client_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_client_secret` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_client_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_client_secret` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(124) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_app_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_app_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_enable` tinyint(4) NOT NULL DEFAULT 0,
  `recapcha_site_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `google_key`, `google_analytics_id`, `site_name`, `site_logo`, `favicon`, `seo_meta_description`, `seo_keywords`, `seo_image`, `tawk_chat_bot_key`, `name`, `address`, `driver`, `host`, `port`, `encryption`, `username`, `password`, `status`, `created_at`, `updated_at`, `application_type`, `app_mode`, `facebook_client_id`, `facebook_client_secret`, `google_client_id`, `google_client_secret`, `copyright_text`, `office_address`, `facebook_url`, `youtube_url`, `twitter_url`, `linkedin_url`, `telegram_url`, `whatsapp_number`, `ios_app_url`, `android_app_url`, `email`, `phone_no`, `support_email`, `instagram_url`, `recaptcha_enable`, `recapcha_site_key`) VALUES
(1, NULL, NULL, 'Dhereye Delivery', '/uploads/logo/logo-64339ffa1fad6.png', '/uploads/icon/favicon-64339ffa1f5ed.png', 'Welcome to LetsConnect. It’s more than a digital business card, it’s a networking sales generator.', 'keyword 1, keyword 2', '/uploads/logo/banner-64339ffa200f4.png', NULL, '', '', '', 'smtp.mailtrap.io', 2525, 'tls', 'maidul@gmailc.om', '123456', '1', '2022-03-12 14:54:38', '2023-04-25 23:43:03', NULL, NULL, '495920045706830', 'dcbac5562d862384bce2918bf025eeaf', NULL, NULL, 'Copyright © LetsConnect. All rights reserved.', 'Dhaka, Bangaldesh', 'https://www.facebook.com', 'https://www.youtube.com', 'https://twitter.com/dhereyedelivery', 'https://www.linkedin.com/dhereyedelivery', '8801515262626', '8801515262626', NULL, NULL, 'infodhereye@delivery.com', '+8801777777777', 'support2@gmail.com', 'https://www.instagram.com/dhereyedelivery', 0, NULL);

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
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(1) DEFAULT 1 COMMENT '1=active,0=inactive',
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `image`, `remember_token`, `created_at`, `updated_at`, `status`, `provider`, `provider_id`) VALUES
(1, 'User', 'arobil@gmail.com', NULL, '$2y$10$2dL7R/ze5t3ONTwcvy5sve.gIQnk1xoOqzMI0Abpn.oicSACEvdHi', NULL, NULL, NULL, NULL, '2023-01-17 23:50:17', NULL, 1, NULL, NULL),
(2, 'User', 'user@gmail.com', NULL, '$2y$10$Ft9K9HiPn3xff3NT8ujxkeV5XkqyBZ0eMtKTHk1B2c.DyFvxdCJvq', NULL, NULL, NULL, 'TlVMA2R5kLgiEBvt7i9DdBrpVVF4FVz9JuHIfjkCn9SrLl8d5M1PDOr9GRQT', '2023-01-17 23:50:17', '2023-04-10 01:23:05', 1, NULL, NULL),
(4, 'User', 'manager@gmail.com', NULL, '$2y$10$2dL7R/ze5t3ONTwcvy5sve.gIQnk1xoOqzMI0Abpn.oicSACEvdHi', NULL, NULL, NULL, NULL, '2023-01-17 23:50:17', NULL, 1, NULL, NULL),
(5, 'Kamal', 'kamal@gmail.com', NULL, '$2y$10$gRvScj179oVDvKh9cHGEu.WfT4mhlcmnnmmhutDbWSWFKpdzii4tG', NULL, NULL, NULL, NULL, '2023-01-24 06:16:46', '2023-01-24 06:16:46', 1, NULL, NULL),
(6, 'Jamal', 'jamal@gmail.com', NULL, '$2y$10$ZbRkZK8NgPCJ9pO3m4vENeT2My2/q45Cge2ZWB.gy5gRbk9lvvWn6', NULL, NULL, NULL, NULL, '2023-01-24 06:17:44', '2023-01-24 06:17:44', 1, NULL, NULL),
(7, 'Sakil', 'sakil@gmail.com', NULL, '$2y$10$ET7lfcXuc.NEKSesm.N0l.6WjsuZbXCfqYHlmJ43qjofyVXqX6kia', NULL, NULL, NULL, NULL, '2023-01-24 06:18:18', '2023-01-24 06:18:18', 1, NULL, NULL),
(8, 'ami', 'amit@mail.com', NULL, '$2y$10$BMNDvZlUXP9RyseyAWiH/OGT10XNOrBhxEjf8plZ7AjXaBxSodlaS', NULL, NULL, NULL, NULL, '2023-04-10 00:22:13', '2023-04-10 00:22:13', 1, NULL, NULL),
(9, 'Md Maidul', 'maidul.tech@gmail.com', NULL, '6437beccc44cd', NULL, NULL, 'https://lh3.googleusercontent.com/a/AGNmyxbbSxuSUJn4FrjHOHGaiZ-8iE7WLstTqE_UGHDz=s96-c', NULL, '2023-04-13 02:35:24', '2023-04-13 02:35:24', 1, 'google', '107639191533203099239'),
(10, 'Cassidy Patton', 'maduti@mailinator.com', NULL, '$2y$10$xdBvDF1JXC5ffMnEQlKlmuWLMz.NYIqRek5AHK.TWzXLZN7wWPyeS', NULL, NULL, NULL, NULL, '2023-04-15 05:42:41', '2023-04-15 05:42:41', 1, NULL, NULL),
(11, 'Moshiur Rahman', 'moshiur2187@gmail.com', NULL, '$2y$10$bArqZpWunw/HwLWcRZM9GekCnb3wrKmViEzKYSMgO4Ew.g2Ggu9KW', '01770802154', NULL, '1681732799.jpg', NULL, '2023-04-17 05:59:28', '2023-04-17 06:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `name`, `status`, `order_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 'Up to 1.0 kg', 1, 1, '2023-04-18 08:53:59', NULL, '2023-04-18 08:53:59', NULL),
(4, 'Up to 2.0 kg', 1, 2, '2023-04-18 08:54:09', NULL, '2023-04-18 08:54:09', NULL),
(5, 'Up to 3.0 kg', 1, 3, '2023-04-18 08:54:21', NULL, '2023-04-18 08:54:21', NULL),
(6, 'Up to 4.0 kg', 1, 4, '2023-04-18 08:54:32', NULL, '2023-04-18 08:54:32', NULL),
(7, 'Up to 5.0 kg', 1, 5, '2023-04-18 08:54:41', NULL, '2023-04-18 08:54:41', NULL),
(8, 'Up to 6.0 kg', 1, 7, '2023-04-18 08:54:51', NULL, '2023-04-18 08:54:51', NULL),
(9, 'Up to 7.0 kg', 1, 8, '2023-04-18 08:54:59', NULL, '2023-04-18 08:54:59', NULL),
(10, 'Up to 8.0 kg', 1, 9, '2023-04-18 08:55:08', NULL, '2023-04-18 08:55:08', NULL),
(11, 'Up to 9.0 kg', 1, 10, '2023-04-18 08:55:19', NULL, '2023-04-18 08:55:19', NULL),
(12, 'Up to 10.0 kg', 1, 11, '2023-04-18 08:55:28', NULL, '2023-04-18 08:55:28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `country_region_name` (`country_id`,`region_id`,`name`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_services`
--
ALTER TABLE `ecommerce_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD UNIQUE KEY `languages_icon_unique` (`icon`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`);

--
-- Indexes for table `our_services`
--
ALTER TABLE `our_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_group`
--
ALTER TABLE `pricing_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `country_name` (`country_id`,`name`);

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
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2790954;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `ecommerce_services`
--
ALTER TABLE `ecommerce_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `our_services`
--
ALTER TABLE `our_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pricing_group`
--
ALTER TABLE `pricing_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3891;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
