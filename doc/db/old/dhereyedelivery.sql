-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 10:58 AM
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
-- Database: `dhereyedelivery`
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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default-user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Supper Admin', 'arobil@gmail.com', '2022-07-25 05:09:47', '$2y$10$QdH0Eddpv4eihc252wgsnesL.h6Blb4dOHMoKzYBcyqMIk6FxHENS', 'uploads/admin/1681100128_64338d60487b5.jpg', 'wArU8bg7sIvacA4XN3oHVijlS7yXn2Jy6Aew70dhQ1pcTUFYqGXkF7oOWDWe', '2022-07-25 05:09:47', '2023-04-09 22:15:28'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$/iBkG/TQacrA2KOj9l7XoeE85CQm6oKVCswEzsb13Mj7k2hELCcBe', 'backend/image/default-user.png', NULL, '2022-08-22 05:56:33', '2022-08-22 05:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) UNSIGNED NOT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `region_id`, `country_id`, `latitude`, `longitude`, `name`) VALUES
(1, 1, 1, '42.48333330', '1.46666670', 'Aixàs'),
(2, 1, 1, '42.46666670', '1.50000000', 'Aixirivali'),
(3, 1, 1, '42.46666670', '1.50000000', 'Aixirivall'),
(4, 1, 1, '42.46666670', '1.50000000', 'Aixirvall'),
(5, 1, 1, '42.46666670', '1.48333330', 'Aixovall'),
(6, 2, 1, '42.50000000', '1.51666670', 'Andorra'),
(7, 2, 1, '42.50000000', '1.51666670', 'Andorra la Vella'),
(8, 2, 1, '42.50000000', '1.51666670', 'Andorra-Vieille'),
(9, 2, 1, '42.50000000', '1.51666670', 'Andorre'),
(10, 2, 1, '42.50000000', '1.51666670', 'Andorre-la-Vieille'),
(11, 2, 1, '42.50000000', '1.51666670', 'Andorre-Vieille'),
(12, 3, 1, '42.56666670', '1.51666670', 'Ansalonga'),
(13, 4, 1, '42.53333330', '1.53333330', 'Anyós'),
(14, 3, 1, '42.58333330', '1.51666670', 'Arans'),
(15, 3, 1, '42.56666670', '1.48333330', 'Arinsal'),
(16, 1, 1, '42.45000000', '1.50000000', 'Aubinyà'),
(17, 1, 1, '42.45000000', '1.50000000', 'Auvinya'),
(18, 1, 1, '42.48333330', '1.46666670', 'Biçisarri'),
(19, 1, 1, '42.48333330', '1.46666670', 'Bixessarri'),
(20, 1, 1, '42.48333330', '1.46666670', 'Bixisarri'),
(21, 5, 1, '42.56666670', '1.60000000', 'Canillo'),
(22, 6, 1, '42.53333330', '1.56666670', 'Casas Vila'),
(23, 1, 1, '42.46666670', '1.50000000', 'Certers'),
(24, 1, 1, '42.46666670', '1.50000000', 'Certés'),
(25, 1, 1, '42.46666670', '1.50000000', 'Eixirivall'),
(26, 3, 1, '42.55000000', '1.51666670', 'El Pui'),
(27, 6, 1, '42.53333330', '1.58333330', 'Els Bons'),
(28, 3, 1, '42.61666670', '1.55000000', 'El Serrat'),
(29, 5, 1, '42.58333330', '1.63333330', 'Els Plans'),
(30, 5, 1, '42.58333330', '1.65000000', 'El Tarter'),
(31, 6, 1, '42.55000000', '1.58333330', 'El Tremat'),
(32, 5, 1, '42.56666670', '1.60000000', 'El Vilar'),
(33, 6, 1, '42.53333330', '1.58333330', 'Encamp'),
(34, 7, 1, '42.51666670', '1.55000000', 'Engordany'),
(35, 3, 1, '42.56666670', '1.50000000', 'Ercs'),
(36, 3, 1, '42.56666670', '1.50000000', 'Ercz'),
(37, 3, 1, '42.56666670', '1.50000000', 'Erez'),
(38, 3, 1, '42.56666670', '1.50000000', 'Erts'),
(39, 7, 1, '42.50000000', '1.53333330', 'Escaldas'),
(40, 7, 1, '42.50000000', '1.53333330', 'Escaldes'),
(41, 3, 1, '42.55000000', '1.51666670', 'Escàs'),
(42, 1, 1, '42.45000000', '1.46666670', 'Fontaneda'),
(43, 1, 1, '42.43333330', '1.50000000', 'Juberri'),
(44, 1, 1, '42.43333330', '1.50000000', 'Juverri'),
(45, 3, 1, '42.56666670', '1.51666670', 'La Cortinada'),
(46, 5, 1, '42.58333330', '1.63333330', 'La Costa'),
(47, 5, 1, '42.58333330', '1.63333330', 'L\'Aldosa'),
(48, 4, 1, '42.55000000', '1.53333330', 'L\'Aldosa'),
(49, 3, 1, '42.55000000', '1.51666670', 'La Maçana'),
(50, 3, 1, '42.55000000', '1.51666670', 'La Massana'),
(51, 7, 1, '42.50000000', '1.53333330', 'Las Escadas'),
(52, 2, 1, '42.50000000', '1.51666670', 'la Vieja'),
(53, 6, 1, '42.53333330', '1.58333330', 'Les Bons'),
(54, 7, 1, '42.50000000', '1.53333330', 'Les Escaldes'),
(55, 3, 1, '42.60000000', '1.53333330', 'Llors'),
(56, 3, 1, '42.60000000', '1.53333330', 'Llorta'),
(57, 3, 1, '42.60000000', '1.53333330', 'Llorts'),
(58, 1, 1, '42.46666670', '1.51666670', 'Llumeneres'),
(59, 3, 1, '42.60000000', '1.53333330', 'Lors'),
(60, 3, 1, '42.61666670', '1.55000000', 'Lo Serrat'),
(61, 1, 1, '42.43333330', '1.45000000', 'Mas d\'Alins'),
(62, 3, 1, '42.56666670', '1.48333330', 'Mas de Ribafeta'),
(63, 5, 1, '42.55000000', '1.60000000', 'Meritxell'),
(64, 6, 1, '42.55000000', '1.58333330', 'Molleres'),
(65, 6, 1, '42.55000000', '1.58333330', 'Mosquera'),
(66, 1, 1, '42.46666670', '1.50000000', 'Nagol'),
(67, 4, 1, '42.55000000', '1.53333330', 'Ordino'),
(68, 3, 1, '42.55000000', '1.48333330', 'Pal'),
(69, 5, 1, '42.55000000', '1.73333330', 'Pas de la Casa'),
(70, 5, 1, '42.56666670', '1.60000000', 'Prats'),
(71, 3, 1, '42.56666670', '1.50000000', 'Puiol del Piu'),
(72, 5, 1, '42.58333330', '1.63333330', 'Ransol'),
(73, 5, 1, '42.55000000', '1.60000000', 'Sanctuaire de Meritxeli'),
(74, 5, 1, '42.55000000', '1.60000000', 'Sanctuaire de Meritxell'),
(75, 5, 1, '42.56666670', '1.61666670', 'San Joan de Casettas'),
(76, 1, 1, '42.46666670', '1.50000000', 'San Juliá'),
(77, 2, 1, '42.50000000', '1.50000000', 'Santa Coloma'),
(78, 1, 1, '42.46666670', '1.50000000', 'Santa Juliá de Loria'),
(79, 5, 1, '42.56666670', '1.61666670', 'Sant Joan de Casellas'),
(80, 5, 1, '42.56666670', '1.61666670', 'Sant Joan de Caselles'),
(81, 1, 1, '42.46666670', '1.50000000', 'Sant Julià de Lòria'),
(82, 1, 1, '42.46666670', '1.50000000', 'Sant Juliá'),
(83, 5, 1, '42.58333330', '1.65000000', 'Sant Pere'),
(84, 5, 1, '42.55000000', '1.60000000', 'Santuari de Meritxell'),
(85, 4, 1, '42.55000000', '1.53333330', 'Segudet'),
(86, 1, 1, '42.46666670', '1.50000000', 'Sertes'),
(87, 3, 1, '42.53333330', '1.51666670', 'Sispony'),
(88, 5, 1, '42.58333330', '1.66666670', 'Soldeu'),
(89, 4, 1, '42.56666670', '1.53333330', 'Sornàs'),
(90, 6, 1, '42.53333330', '1.56666670', 'Vila'),
(91, 1, 1, '42.48333330', '1.46666670', 'Vixesarri'),
(92, 3, 1, '42.55000000', '1.48333330', 'Xixerella'),
(93, 8, 2, '25.43833330', '56.19138890', '`Abadilah'),
(94, 9, 2, '24.46666670', '54.36666670', 'Abu Dabi'),
(95, 9, 2, '24.46666670', '54.36666670', 'Abu Dhabi'),
(96, 10, 2, '25.27916670', '55.32222220', 'Abu Hail'),
(97, 10, 2, '25.27916670', '55.32222220', 'Abu Hayl'),
(98, 9, 2, '24.46666670', '54.36666670', 'Abu Zabi'),
(99, 9, 2, '24.46666670', '54.36666670', 'Abu Zaby'),
(100, 9, 2, '24.46666670', '54.36666670', 'Abu Zabye');

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
(3, 'timezone', 'America/New_York', '2022-03-12 14:54:38', '2022-03-12 14:54:38'),
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
(2, 'test', 'test@gmail.com', 1798194412, '0', 'testttt', 0, '2023-02-13 05:22:39', '2023-02-13 05:22:39');

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
(1, 'Andorra', 'ad', NULL, NULL),
(2, 'United Arab Emirates', 'ae', NULL, NULL),
(3, 'Afghanistan', 'af', NULL, NULL),
(4, 'Antigua and Barbuda', 'ag', NULL, NULL),
(5, 'Anguilla', 'ai', NULL, NULL),
(6, 'Albania', 'al', NULL, NULL),
(7, 'Armenia', 'am', NULL, NULL),
(8, 'Netherlands Antilles', 'an', NULL, NULL),
(9, 'Angola', 'ao', NULL, NULL),
(10, 'Argentina', 'ar', NULL, NULL),
(11, 'Austria', 'at', NULL, NULL),
(12, 'Australia', 'au', NULL, NULL),
(13, 'Aruba', 'aw', NULL, NULL),
(14, 'Azerbaijan', 'az', NULL, NULL),
(15, 'Bosnia and Herzegovina', 'ba', NULL, NULL),
(16, 'Barbados', 'bb', NULL, NULL),
(17, 'Bangladesh', 'bd', NULL, NULL),
(18, 'Belgium', 'be', NULL, NULL),
(19, 'Burkina Faso', 'bf', NULL, NULL),
(20, 'Bulgaria', 'bg', NULL, NULL),
(21, 'Bahrain', 'bh', NULL, NULL),
(22, 'Burundi', 'bi', NULL, NULL),
(23, 'Benin', 'bj', NULL, NULL),
(24, 'Bermuda', 'bm', NULL, NULL),
(25, 'Brunei Darussalam', 'bn', NULL, NULL),
(26, 'Bolivia', 'bo', NULL, NULL),
(27, 'Brazil', 'br', NULL, NULL),
(28, 'Bahamas', 'bs', NULL, NULL),
(29, 'Bhutan', 'bt', NULL, NULL),
(30, 'Botswana', 'bw', NULL, NULL),
(31, 'Belarus', 'by', NULL, NULL),
(32, 'Belize', 'bz', NULL, NULL),
(33, 'Canada', 'ca', NULL, NULL),
(34, 'Cocos (Keeling) Islands', 'cc', NULL, NULL),
(35, 'Democratic Republic of the Congo', 'cd', NULL, NULL),
(36, 'Central African Republic', 'cf', NULL, NULL),
(37, 'Congo', 'cg', NULL, NULL),
(38, 'Switzerland', 'ch', NULL, NULL),
(39, 'Cote D\'Ivoire (Ivory Coast)', 'ci', NULL, NULL),
(40, 'Cook Islands', 'ck', NULL, NULL),
(41, 'Chile', 'cl', NULL, NULL),
(42, 'Cameroon', 'cm', NULL, NULL),
(43, 'China', 'cn', NULL, NULL),
(44, 'Colombia', 'co', NULL, NULL),
(45, 'Costa Rica', 'cr', NULL, NULL),
(46, 'Cuba', 'cu', NULL, NULL),
(47, 'Cape Verde', 'cv', NULL, NULL),
(48, 'Christmas Island', 'cx', NULL, NULL),
(49, 'Cyprus', 'cy', NULL, NULL),
(50, 'Czech Republic', 'cz', NULL, NULL),
(51, 'Germany', 'de', NULL, NULL),
(52, 'Djibouti', 'dj', NULL, NULL),
(53, 'Denmark', 'dk', NULL, NULL),
(54, 'Dominica', 'dm', NULL, NULL),
(55, 'Dominican Republic', 'do', NULL, NULL),
(56, 'Algeria', 'dz', NULL, NULL),
(57, 'Ecuador', 'ec', NULL, NULL),
(58, 'Estonia', 'ee', NULL, NULL),
(59, 'Egypt', 'eg', NULL, NULL),
(60, 'Western Sahara', 'eh', NULL, NULL),
(61, 'Eritrea', 'er', NULL, NULL),
(62, 'Spain', 'es', NULL, NULL),
(63, 'Ethiopia', 'et', NULL, NULL),
(64, 'Finland', 'fi', NULL, NULL),
(65, 'Fiji', 'fj', NULL, NULL),
(66, 'Falkland Islands (Malvinas)', 'fk', NULL, NULL),
(67, 'Federated States of Micronesia', 'fm', NULL, NULL),
(68, 'Faroe Islands', 'fo', NULL, NULL),
(69, 'France', 'fr', NULL, NULL),
(70, 'Gabon', 'ga', NULL, NULL),
(71, 'Great Britain (UK)', 'gb', NULL, NULL),
(72, 'Grenada', 'gd', NULL, NULL),
(73, 'Georgia', 'ge', NULL, NULL),
(74, 'French Guiana', 'gf', NULL, NULL),
(75, 'NULL', 'gg', NULL, NULL),
(76, 'Ghana', 'gh', NULL, NULL),
(77, 'Gibraltar', 'gi', NULL, NULL),
(78, 'Greenland', 'gl', NULL, NULL),
(79, 'Gambia', 'gm', NULL, NULL),
(80, 'Guinea', 'gn', NULL, NULL),
(81, 'Guadeloupe', 'gp', NULL, NULL),
(82, 'Equatorial Guinea', 'gq', NULL, NULL),
(83, 'Greece', 'gr', NULL, NULL),
(84, 'S. Georgia and S. Sandwich Islands', 'gs', NULL, NULL),
(85, 'Guatemala', 'gt', NULL, NULL),
(86, 'Guinea-Bissau', 'gw', NULL, NULL),
(87, 'Guyana', 'gy', NULL, NULL),
(88, 'Hong Kong', 'hk', NULL, NULL),
(89, 'Honduras', 'hn', NULL, NULL),
(90, 'Croatia (Hrvatska)', 'hr', NULL, NULL),
(91, 'Haiti', 'ht', NULL, NULL),
(92, 'Hungary', 'hu', NULL, NULL),
(93, 'Indonesia', 'id', NULL, NULL),
(94, 'Ireland', 'ie', NULL, NULL),
(95, 'Israel', 'il', NULL, NULL),
(96, 'India', 'in', NULL, NULL),
(97, 'Iraq', 'iq', NULL, NULL),
(98, 'Iran', 'ir', NULL, NULL),
(99, 'Iceland', 'is', NULL, NULL),
(100, 'Italy', 'it', NULL, NULL),
(101, 'Jamaica', 'jm', NULL, NULL),
(102, 'Jordan', 'jo', NULL, NULL),
(103, 'Japan', 'jp', NULL, NULL),
(104, 'Kenya', 'ke', NULL, NULL),
(105, 'Kyrgyzstan', 'kg', NULL, NULL),
(106, 'Cambodia', 'kh', NULL, NULL),
(107, 'Kiribati', 'ki', NULL, NULL),
(108, 'Comoros', 'km', NULL, NULL),
(109, 'Saint Kitts and Nevis', 'kn', NULL, NULL),
(110, 'Korea (North)', 'kp', NULL, NULL),
(111, 'Korea (South)', 'kr', NULL, NULL),
(112, 'Kuwait', 'kw', NULL, NULL),
(113, 'Cayman Islands', 'ky', NULL, NULL),
(114, 'Kazakhstan', 'kz', NULL, NULL),
(115, 'Laos', 'la', NULL, NULL),
(116, 'Lebanon', 'lb', NULL, NULL),
(117, 'Saint Lucia', 'lc', NULL, NULL),
(118, 'Liechtenstein', 'li', NULL, NULL),
(119, 'Sri Lanka', 'lk', NULL, NULL),
(120, 'Liberia', 'lr', NULL, NULL),
(121, 'Lesotho', 'ls', NULL, NULL),
(122, 'Lithuania', 'lt', NULL, NULL),
(123, 'Luxembourg', 'lu', NULL, NULL),
(124, 'Latvia', 'lv', NULL, NULL),
(125, 'Libya', 'ly', NULL, NULL),
(126, 'Morocco', 'ma', NULL, NULL),
(127, 'Monaco', 'mc', NULL, NULL),
(128, 'Moldova', 'md', NULL, NULL),
(129, 'Madagascar', 'mg', NULL, NULL),
(130, 'Marshall Islands', 'mh', NULL, NULL),
(131, 'Macedonia', 'mk', NULL, NULL),
(132, 'Mali', 'ml', NULL, NULL),
(133, 'Myanmar', 'mm', NULL, NULL),
(134, 'Mongolia', 'mn', NULL, NULL),
(135, 'Macao', 'mo', NULL, NULL),
(136, 'Northern Mariana Islands', 'mp', NULL, NULL),
(137, 'Martinique', 'mq', NULL, NULL),
(138, 'Mauritania', 'mr', NULL, NULL),
(139, 'Montserrat', 'ms', NULL, NULL),
(140, 'Malta', 'mt', NULL, NULL),
(141, 'Mauritius', 'mu', NULL, NULL),
(142, 'Maldives', 'mv', NULL, NULL),
(143, 'Malawi', 'mw', NULL, NULL),
(144, 'Mexico', 'mx', NULL, NULL),
(145, 'Malaysia', 'my', NULL, NULL),
(146, 'Mozambique', 'mz', NULL, NULL),
(147, 'Namibia', 'na', NULL, NULL),
(148, 'New Caledonia', 'nc', NULL, NULL),
(149, 'Niger', 'ne', NULL, NULL),
(150, 'Norfolk Island', 'nf', NULL, NULL),
(151, 'Nigeria', 'ng', NULL, NULL),
(152, 'Nicaragua', 'ni', NULL, NULL),
(153, 'Netherlands', 'nl', NULL, NULL),
(154, 'Norway', 'no', NULL, NULL),
(155, 'Nepal', 'np', NULL, NULL),
(156, 'Nauru', 'nr', NULL, NULL),
(157, 'Niue', 'nu', NULL, NULL),
(158, 'New Zealand (Aotearoa)', 'nz', NULL, NULL),
(159, 'Oman', 'om', NULL, NULL),
(160, 'Panama', 'pa', NULL, NULL),
(161, 'Peru', 'pe', NULL, NULL),
(162, 'French Polynesia', 'pf', NULL, NULL),
(163, 'Papua New Guinea', 'pg', NULL, NULL),
(164, 'Philippines', 'ph', NULL, NULL),
(165, 'Pakistan', 'pk', NULL, NULL),
(166, 'Poland', 'pl', NULL, NULL),
(167, 'Saint Pierre and Miquelon', 'pm', NULL, NULL),
(168, 'Pitcairn', 'pn', NULL, NULL),
(169, 'Palestinian Territory', 'ps', NULL, NULL),
(170, 'Portugal', 'pt', NULL, NULL),
(171, 'Palau', 'pw', NULL, NULL),
(172, 'Paraguay', 'py', NULL, NULL),
(173, 'Qatar', 'qa', NULL, NULL),
(174, 'Reunion', 're', NULL, NULL),
(175, 'Romania', 'ro', NULL, NULL),
(176, 'Russian Federation', 'ru', NULL, NULL),
(177, 'Rwanda', 'rw', NULL, NULL),
(178, 'Saudi Arabia', 'sa', NULL, NULL),
(179, 'Solomon Islands', 'sb', NULL, NULL),
(180, 'Seychelles', 'sc', NULL, NULL),
(181, 'Sudan', 'sd', NULL, NULL),
(182, 'Sweden', 'se', NULL, NULL),
(183, 'Singapore', 'sg', NULL, NULL),
(184, 'Saint Helena', 'sh', NULL, NULL),
(185, 'Slovenia', 'si', NULL, NULL),
(186, 'Svalbard and Jan Mayen', 'sj', NULL, NULL),
(187, 'Slovakia', 'sk', NULL, NULL),
(188, 'Sierra Leone', 'sl', NULL, NULL),
(189, 'San Marino', 'sm', NULL, NULL),
(190, 'Senegal', 'sn', NULL, NULL),
(191, 'Somalia', 'so', NULL, NULL),
(192, 'Suriname', 'sr', NULL, NULL),
(193, 'Sao Tome and Principe', 'st', NULL, NULL),
(194, 'El Salvador', 'sv', NULL, NULL),
(195, 'Syria', 'sy', NULL, NULL),
(196, 'Swaziland', 'sz', NULL, NULL),
(197, 'Turks and Caicos Islands', 'tc', NULL, NULL),
(198, 'Chad', 'td', NULL, NULL),
(199, 'French Southern Territories', 'tf', NULL, NULL),
(200, 'Togo', 'tg', NULL, NULL),
(201, 'Thailand', 'th', NULL, NULL),
(202, 'Tajikistan', 'tj', NULL, NULL),
(203, 'Tokelau', 'tk', NULL, NULL),
(204, 'Turkmenistan', 'tm', NULL, NULL),
(205, 'Tunisia', 'tn', NULL, NULL),
(206, 'Tonga', 'to', NULL, NULL),
(207, 'Turkey', 'tr', NULL, NULL),
(208, 'Trinidad and Tobago', 'tt', NULL, NULL),
(209, 'Tuvalu', 'tv', NULL, NULL),
(210, 'Taiwan', 'tw', NULL, NULL),
(211, 'Tanzania', 'tz', NULL, NULL),
(212, 'Ukraine', 'ua', NULL, NULL),
(213, 'Uganda', 'ug', NULL, NULL),
(214, 'Uruguay', 'uy', NULL, NULL),
(215, 'Uzbekistan', 'uz', NULL, NULL),
(216, 'Saint Vincent and the Grenadines', 'vc', NULL, NULL),
(217, 'Venezuela', 've', NULL, NULL),
(218, 'Virgin Islands (British)', 'vg', NULL, NULL),
(219, 'Virgin Islands (U.S.)', 'vi', NULL, NULL),
(220, 'Viet Nam', 'vn', NULL, NULL),
(221, 'Vanuatu', 'vu', NULL, NULL),
(222, 'Wallis and Futuna', 'wf', NULL, NULL),
(223, 'Samoa', 'ws', NULL, NULL),
(224, 'Yemen', 'ye', NULL, NULL),
(225, 'Mayotte', 'yt', NULL, NULL),
(226, 'South Africa', 'za', NULL, NULL),
(227, 'Zambia', 'zm', NULL, NULL),
(228, 'Zaire (former)', 'zr', NULL, NULL),
(229, 'Zimbabwe', 'zw', NULL, NULL),
(230, 'United States of America', 'us', NULL, NULL);

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
(3, 'What are Digital Business Cards?', 'Digital business cards are a modern way of exchanging a limitless amount contact information. They are digital versions of traditional paper business cards and provide a more efficient way to share every platform you utilize to maintian your brand.  Digital business cards are typically shared via text message, email, or other digital communication platforms. They are also often used with QR codes and today more commonly with NFC (Near Field Communication) technology to quickly and easily share contact.', 1, 1, NULL, 1, '2023-01-14 11:24:58', '2023-02-13 07:18:16', 1),
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
(2, 'App\\Models\\Admin', 7);

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
(79, 'admin.city.index', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(80, 'admin.city.create', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(81, 'admin.city.store', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(82, 'admin.city.edit', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(83, 'admin.city.view', 'city', 'admin', '2023-01-23 19:52:41', '2023-01-23 19:52:41'),
(84, 'admin.city.update', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50'),
(85, 'admin.city.delete', 'city', 'admin', '2023-01-23 19:52:50', '2023-01-23 19:52:50');

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
(1, 'Sant Julia de Loria', '06', 1, NULL, NULL),
(2, 'Andorra la Vella', '07', 1, NULL, NULL),
(3, 'La Massana', '04', 1, NULL, NULL),
(4, 'Ordino', '05', 1, NULL, NULL),
(5, 'Canillo', '02', 1, NULL, NULL),
(6, 'Encamp', '03', 1, NULL, NULL),
(7, 'Escaldes-Engordany', '08', 1, NULL, NULL),
(8, 'Fujairah', '04', 2, NULL, NULL),
(9, 'Abu Dhabi', '01', 2, NULL, NULL),
(10, 'Dubai', '03', 2, NULL, NULL),
(11, 'Ras Al Khaimah', '05', 2, NULL, NULL),
(12, 'Umm Al Quwain', '07', 2, NULL, NULL),
(13, 'Sharjah', '06', 2, NULL, NULL),
(14, 'Ajman', '02', 2, NULL, NULL),
(15, 'Paktika', '29', 3, NULL, NULL),
(16, 'Farah', '06', 3, NULL, NULL),
(17, 'Helmand', '10', 3, NULL, NULL),
(18, 'Kondoz', '24', 3, NULL, NULL),
(19, 'Bamian', '05', 3, NULL, NULL),
(20, 'Ghowr', '09', 3, NULL, NULL),
(21, 'Laghman', '35', 3, NULL, NULL),
(23, 'Ghazni', '08', 3, NULL, NULL),
(24, 'Vardak', '27', 3, NULL, NULL),
(25, 'Oruzgan', '39', 3, NULL, NULL),
(26, 'Zabol', '28', 3, NULL, NULL),
(27, 'Badghis', '02', 3, NULL, NULL),
(28, 'Badakhshan', '01', 3, NULL, NULL),
(29, 'Faryab', '07', 3, NULL, NULL),
(30, 'Takhar', '26', 3, NULL, NULL),
(31, 'Lowgar', '17', 3, NULL, NULL),
(32, 'Herat', '11', 3, NULL, NULL),
(33, 'Daykondi', '41', 3, NULL, NULL),
(34, 'Sar-e Pol', '33', 3, NULL, NULL),
(35, 'Balkh', '30', 3, NULL, NULL),
(36, 'Kabol', '13', 3, NULL, NULL),
(37, 'Nimruz', '19', 3, NULL, NULL),
(38, 'Kandahar', '23', 3, NULL, NULL),
(39, 'Khowst', '37', 3, NULL, NULL),
(41, 'Kapisa', '14', 3, NULL, NULL),
(42, 'Nangarhar', '18', 3, NULL, NULL),
(43, 'Samangan', '32', 3, NULL, NULL),
(44, 'Paktia', '36', 3, NULL, NULL),
(45, 'Baghlan', '03', 3, NULL, NULL),
(46, 'Jowzjan', '31', 3, NULL, NULL),
(47, 'Konar', '34', 3, NULL, NULL),
(48, 'Nurestan', '38', 3, NULL, NULL),
(52, 'Panjshir', '42', 3, NULL, NULL),
(53, 'Saint John', '04', 4, NULL, NULL),
(54, 'Saint Paul', '06', 4, NULL, NULL),
(55, 'Saint George', '03', 4, NULL, NULL),
(56, 'Saint Peter', '07', 4, NULL, NULL),
(57, 'Saint Mary', '05', 4, NULL, NULL),
(58, 'Barbuda', '01', 4, NULL, NULL),
(59, 'Saint Philip', '08', 4, NULL, NULL),
(61, 'Vlore', '51', 6, NULL, NULL),
(62, 'Korce', '46', 6, NULL, NULL),
(63, 'Shkoder', '49', 6, NULL, NULL),
(64, 'Durres', '42', 6, NULL, NULL),
(65, 'Elbasan', '43', 6, NULL, NULL),
(66, 'Kukes', '47', 6, NULL, NULL),
(67, 'Fier', '44', 6, NULL, NULL),
(68, 'Berat', '40', 6, NULL, NULL),
(69, 'Gjirokaster', '45', 6, NULL, NULL),
(70, 'Tirane', '50', 6, NULL, NULL),
(71, 'Lezhe', '48', 6, NULL, NULL),
(72, 'Diber', '41', 6, NULL, NULL),
(73, 'Aragatsotn', '01', 7, NULL, NULL),
(74, 'Ararat', '02', 7, NULL, NULL),
(75, 'Kotayk\'', '05', 7, NULL, NULL),
(76, 'Tavush', '09', 7, NULL, NULL),
(77, 'Syunik\'', '08', 7, NULL, NULL),
(78, 'Geghark\'unik\'', '04', 7, NULL, NULL),
(79, 'Vayots\' Dzor', '10', 7, NULL, NULL),
(80, 'Lorri', '06', 7, NULL, NULL),
(81, 'Armavir', '03', 7, NULL, NULL),
(82, 'Yerevan', '11', 7, NULL, NULL),
(83, 'Shirak', '07', 7, NULL, NULL),
(85, 'Benguela', '01', 9, NULL, NULL),
(86, 'Uige', '15', 9, NULL, NULL),
(87, 'Bengo', '19', 9, NULL, NULL),
(88, 'Cuanza Norte', '05', 9, NULL, NULL),
(89, 'Malanje', '12', 9, NULL, NULL),
(90, 'Cuanza Sul', '06', 9, NULL, NULL),
(91, 'Huambo', '08', 9, NULL, NULL),
(92, 'Moxico', '14', 9, NULL, NULL),
(93, 'Cuando Cubango', '04', 9, NULL, NULL),
(94, 'Bie', '02', 9, NULL, NULL),
(95, 'Huila', '09', 9, NULL, NULL),
(96, 'Lunda Sul', '18', 9, NULL, NULL),
(98, 'Zaire', '16', 9, NULL, NULL),
(99, 'Cunene', '07', 9, NULL, NULL),
(100, 'Lunda Norte', '17', 9, NULL, NULL);

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
(2, 'admin', 'admin', '2023-01-17 23:50:17', NULL);

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
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1);

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
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `google_key`, `google_analytics_id`, `site_name`, `site_logo`, `favicon`, `seo_meta_description`, `seo_keywords`, `seo_image`, `tawk_chat_bot_key`, `name`, `address`, `driver`, `host`, `port`, `encryption`, `username`, `password`, `status`, `created_at`, `updated_at`, `application_type`, `app_mode`, `facebook_client_id`, `facebook_client_secret`, `google_client_id`, `google_client_secret`, `copyright_text`, `office_address`, `facebook_url`, `youtube_url`, `twitter_url`, `linkedin_url`, `telegram_url`, `whatsapp_number`, `ios_app_url`, `android_app_url`, `email`, `phone_no`, `support_email`, `instagram_url`) VALUES
(1, NULL, NULL, 'Dhereye Delivery', '/uploads/logo/logo-64339ffa1fad6.png', '/uploads/icon/favicon-64339ffa1f5ed.png', 'Welcome to LetsConnect. It’s more than a digital business card, it’s a networking sales generator.', 'keyword 1, keyword 2', '/uploads/logo/banner-64339ffa200f4.png', NULL, '', '', '', 'smtp.mailtrap.io', 2525, 'tls', 'maidul@gmailc.om', '123456', '1', '2022-03-12 14:54:38', '2023-04-10 00:50:44', NULL, NULL, '495920045706830', 'dcbac5562d862384bce2918bf025eeaf', NULL, NULL, 'Copyright © LetsConnect. All rights reserved.', 'Banani, Dhaka, Bangaldesh', 'https://www.facebook.com', 'https://www.youtube.com', 'https://twitter.com/Mr_LetsConnect', 'https://www.linkedin.com/feed', '8801515262626', '8801515262626', NULL, NULL, 'infodhereye@delivery.com', '01478523690', 'support@gmail.com', 'https://www.instagram .com/');

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
  `status` int(1) DEFAULT 1 COMMENT '1=active,0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `image`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'User', 'arobil@gmail.com', NULL, '$2y$10$2dL7R/ze5t3ONTwcvy5sve.gIQnk1xoOqzMI0Abpn.oicSACEvdHi', NULL, NULL, NULL, NULL, '2023-01-17 23:50:17', NULL, 1),
(2, 'User', 'user@gmail.com', NULL, '$2y$10$Ft9K9HiPn3xff3NT8ujxkeV5XkqyBZ0eMtKTHk1B2c.DyFvxdCJvq', NULL, NULL, NULL, 'TlVMA2R5kLgiEBvt7i9DdBrpVVF4FVz9JuHIfjkCn9SrLl8d5M1PDOr9GRQT', '2023-01-17 23:50:17', '2023-04-10 01:23:05', 1),
(4, 'User', 'manager@gmail.com', NULL, '$2y$10$2dL7R/ze5t3ONTwcvy5sve.gIQnk1xoOqzMI0Abpn.oicSACEvdHi', NULL, NULL, NULL, NULL, '2023-01-17 23:50:17', NULL, 1),
(5, 'Kamal', 'kamal@gmail.com', NULL, '$2y$10$gRvScj179oVDvKh9cHGEu.WfT4mhlcmnnmmhutDbWSWFKpdzii4tG', NULL, NULL, NULL, NULL, '2023-01-24 06:16:46', '2023-01-24 06:16:46', 1),
(6, 'Jamal', 'jamal@gmail.com', NULL, '$2y$10$ZbRkZK8NgPCJ9pO3m4vENeT2My2/q45Cge2ZWB.gy5gRbk9lvvWn6', NULL, NULL, NULL, NULL, '2023-01-24 06:17:44', '2023-01-24 06:17:44', 1),
(7, 'Sakil', 'sakil@gmail.com', NULL, '$2y$10$ET7lfcXuc.NEKSesm.N0l.6WjsuZbXCfqYHlmJ43qjofyVXqX6kia', NULL, NULL, NULL, NULL, '2023-01-24 06:18:18', '2023-01-24 06:18:18', 1),
(8, 'ami', 'amit@mail.com', NULL, '$2y$10$BMNDvZlUXP9RyseyAWiH/OGT10XNOrBhxEjf8plZ7AjXaBxSodlaS', NULL, NULL, NULL, NULL, '2023-04-10 00:22:13', '2023-04-10 00:22:13', 1);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2790952;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3889;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
