-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 06:28 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmso_holiday_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`id`, `name`, `contact_person`, `phone_number`, `email_address`, `country`, `product`, `created_at`, `updated_at`) VALUES
(1, 'Sup-Company-Name', 'Sup-Contact-Person', '0123456789', 'xyz@gmail.com', '2', 'Visa, Package, AirTicket', '2020-01-15 05:15:25', '2020-01-15 05:15:25'),
(2, 'Suplier2', 'kklklq', '12345688', 'sdf@gmail.com', '5', 'Visa, Package, AirTicket', '2020-01-15 23:46:17', '2020-01-15 23:46:17'),
(3, 'suplier3', 'maikel', '3245555', 'noormoy6@gmail.com', '4', 'Visa, Package, AirTicket', '2020-01-15 23:47:11', '2020-01-15 23:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `airtickets`
--

CREATE TABLE `airtickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sell_person` int(10) UNSIGNED NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_qty` int(11) NOT NULL,
  `adult_price` decimal(8,2) NOT NULL,
  `adult_total_price` decimal(8,2) NOT NULL,
  `child_qty` int(11) DEFAULT NULL,
  `child_price` decimal(8,2) DEFAULT NULL,
  `child_total_price` decimal(8,2) DEFAULT NULL,
  `infant_qty` int(11) DEFAULT NULL,
  `infant_price` decimal(8,2) DEFAULT NULL,
  `infant_total_price` decimal(8,2) DEFAULT NULL,
  `ssr_qty` int(11) DEFAULT NULL,
  `ssr_price` decimal(8,2) DEFAULT NULL,
  `ssr_total_price` decimal(8,2) DEFAULT NULL,
  `service_amount` decimal(8,2) DEFAULT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `total_net_price` decimal(8,2) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `selling_to` int(10) UNSIGNED NOT NULL,
  `word` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `journey_date` date NOT NULL,
  `return_date` date NOT NULL,
  `ticket_class` tinyint(4) NOT NULL,
  `food_rules` tinyint(4) NOT NULL,
  `date_change` tinyint(4) NOT NULL DEFAULT '1',
  `narration` text COLLATE utf8mb4_unicode_ci,
  `ticket_type` tinyint(4) NOT NULL,
  `ticket_rules` tinyint(4) NOT NULL,
  `luggages_rules` tinyint(4) DEFAULT NULL,
  `luggages_rules_description` text COLLATE utf8mb4_unicode_ci,
  `hand_luggages_rules` tinyint(4) DEFAULT NULL,
  `hand_luggages_rules_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `air_lines`
--

CREATE TABLE `air_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `air_lines`
--

INSERT INTO `air_lines` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'US Bangla', '2019-09-04 04:17:25', '2019-09-04 04:17:25'),
(3, 'BG', '2019-10-15 03:41:08', '2019-12-17 06:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `created_at`, `updated_at`) VALUES
(2, 'DBBL', '2019-10-22 03:13:21', '2019-10-22 03:13:21'),
(3, 'Brac', '2019-10-22 04:54:18', '2019-10-22 04:54:18'),
(4, 'City Bank', '2019-10-22 04:55:31', '2019-10-22 04:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `bank_books`
--

CREATE TABLE `bank_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `expence_id` int(10) DEFAULT NULL,
  `incentive_id` tinyint(10) DEFAULT NULL,
  `salary_id` tinyint(10) DEFAULT NULL,
  `contra_id` int(10) UNSIGNED DEFAULT NULL,
  `cheque_id` int(10) UNSIGNED DEFAULT NULL,
  `loan_id` int(10) UNSIGNED DEFAULT NULL,
  `installment_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_name` int(10) UNSIGNED NOT NULL,
  `bank_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_cheque_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_bank_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_bank_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` float(20,2) NOT NULL DEFAULT '0.00',
  `bank_blance` float(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_books`
--

CREATE TABLE `cash_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `expence_id` int(10) UNSIGNED DEFAULT NULL,
  `incentive_id` tinyint(10) DEFAULT NULL,
  `salary_id` tinyint(10) DEFAULT NULL,
  `contra_id` int(10) UNSIGNED DEFAULT NULL,
  `cheque_id` int(10) UNSIGNED DEFAULT NULL,
  `loan_id` int(10) UNSIGNED DEFAULT NULL,
  `installment_id` int(10) UNSIGNED DEFAULT NULL,
  `cash_date` date DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_cash_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_cash_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` float(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_books`
--

CREATE TABLE `cheque_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_id` int(10) UNSIGNED NOT NULL,
  `cheque_bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_type` tinyint(4) NOT NULL,
  `cheque_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_amount` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contras`
--

CREATE TABLE `contras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contra_type` tinyint(4) NOT NULL,
  `contra_date` date NOT NULL,
  `contra_amount` decimal(8,2) NOT NULL,
  `from_bank_name` tinyint(4) DEFAULT NULL,
  `to_bank_name` tinyint(4) DEFAULT NULL,
  `bank_name` tinyint(4) DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `slug`, `department_name`, `created_at`, `updated_at`) VALUES
(3, 'air-ticket', 'Air Ticket', '2019-08-25 00:17:27', '2019-08-25 00:17:27'),
(4, 'visa', 'VISA', '2019-08-25 00:17:38', '2019-08-25 00:17:38'),
(5, 'package', 'Package', '2019-08-25 00:17:48', '2019-08-25 00:17:48'),
(6, 'accounts', 'Accounts', '2019-10-19 23:14:18', '2019-10-19 23:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `money_receipt_id` bigint(20) UNSIGNED NOT NULL,
  `discount_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expences`
--

CREATE TABLE `expences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expence_date` date NOT NULL,
  `expence_head` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(1) DEFAULT NULL,
  `cheque` tinyint(1) DEFAULT NULL,
  `total_expence_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expence_heads`
--

CREATE TABLE `expence_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expence_heads`
--

INSERT INTO `expence_heads` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Office Rent', '2019-12-03 03:19:27', '2019-12-03 03:19:27'),
(2, 'Electicity Bill', '2019-12-04 03:36:51', '2019-12-04 03:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `follow_u_pto_guests`
--

CREATE TABLE `follow_u_pto_guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `flw_up_to_guest_date` date NOT NULL,
  `guest_reaction` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_u_pto_guests`
--

INSERT INTO `follow_u_pto_guests` (`id`, `package_id`, `flw_up_to_guest_date`, `guest_reaction`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-01-24', 1, '2020-01-24', '2020-01-23 00:06:34', '2020-01-23 00:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `follow_u_p_to_supliers`
--

CREATE TABLE `follow_u_p_to_supliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `flw_up_to_suplier_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_u_p_to_supliers`
--

INSERT INTO `follow_u_p_to_supliers` (`id`, `package_id`, `flw_up_to_suplier_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-01-24', 'sdfasd', '2020-01-23 00:06:16', '2020-01-23 00:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch` tinyint(4) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_type` int(10) UNSIGNED NOT NULL,
  `designation` int(10) UNSIGNED NOT NULL,
  `rf_staff` int(10) UNSIGNED NOT NULL,
  `rf_guest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `branch`, `name`, `guest_type`, `designation`, `rf_staff`, `rf_guest`, `email_address`, `alt_email_address`, `phone_number`, `alt_phone_number`, `address`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Noormoy Faisal1', 22, 5, 3, 'Monsur Ali Bapari', 'noormoy@gmail.com', 'xyz@gmail.com', '01682814443', '01622666666', 'sdfgsegdf', 0, 0, '2019-08-20 23:00:55', '2019-08-20 23:53:21'),
(3, 1, 'Abdul Kalam', 17, 7, 3, 'Monsur Ali Bapari', 'xyz@gmail.com', 'asdfsa@gmail.com', '019464556565', '013565953500', 'this si the address bar text-area', 0, 1, '2019-08-23 22:57:29', '2019-08-23 22:57:29'),
(5, 1, 'Kala Jahangir', 18, 9, 3, 'sdfsd', 'noormoy@gmail.com', 'xyz@gmail.com', '01708808363', '01622666666', 'sdfasdfasdfsd', 0, 1, '2019-08-27 01:54:44', '2019-08-27 01:54:44'),
(6, 1, 'Noormoy Faisal 55', 16, 9, 3, 'sdfsd', 'acc.cosmosbd@gmail.com', 'xyz3@gmail.com', '01778889141', '016226666666', 'sdfasdfasdfsd', 0, 1, '2019-09-03 06:48:27', '2019-09-03 06:48:27'),
(7, 1, 'Noormoy Faisal2', 14, 9, 3, 'sdfsd', 'sdf@gmail.com', 'xyz@gmail.com', '01682814448', '01622666666', 'sdfasdfasdfsd', 0, 1, '2019-09-11 23:18:59', '2019-09-11 23:18:59'),
(8, 1, 'Kabila Razib', 16, 8, 3, 'sdfsd', 'sdfsd@gmail.com', 'xyz2@gmail.com', '017788891412', '01622666666', 'sdfasdfasdfsd', 1, 1, '2019-10-09 23:36:42', '2019-10-19 00:58:02'),
(9, 1, 'Kala Jahangir2', 13, 8, 3, 'after auto search option', 'noormoy6@gmail.com', 'asdfsa@gmail.com', '019126211933', '016226666666', 'sdfasdfasdfsd', 0, 1, '2019-11-10 23:11:45', '2019-11-10 23:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `guest_designations`
--

CREATE TABLE `guest_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_designations`
--

INSERT INTO `guest_designations` (`id`, `slug`, `guest_designation`, `created_at`, `updated_at`) VALUES
(5, 'designation-1', 'Designation 1', '2019-07-30 02:02:14', '2019-08-25 00:25:32'),
(7, 'designation-2', 'Designation 2', '2019-07-30 04:36:04', '2019-08-25 00:25:46'),
(8, 'designation-3', 'Designation 3', '2019-08-25 00:25:56', '2019-08-25 00:25:56'),
(9, 'designaiton-4', 'Designaiton 4', '2019-08-25 00:26:04', '2019-08-25 00:27:31'),
(10, 'designation-5', 'Designation 5', '2019-08-25 00:26:13', '2019-08-25 00:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `guest_queries`
--

CREATE TABLE `guest_queries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_query` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_up` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_queries`
--

INSERT INTO `guest_queries` (`id`, `guest_id`, `staff_id`, `subject`, `guest_query`, `follow_up`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 'subject 2', 'dfgfgd', 'sd;fkj', 0, '2019-08-21 05:54:00', '2019-08-22 00:20:58'),
(4, 1, 3, 'Guest Query Subject', 'The Daily Star is the largest circulating daily English-language newspaper in Bangladesh. Founded by Syed Mohammed Ali on 14 January 1991, as Bangladesh transitioned and restored parliamentary democracy, The Daily Star emerged as a leading and influential national newspaper of record.', 'The Daily Star is the largest circulating daily English-language newspaper in Bangladesh. Founded by Syed Mohammed Ali on 14 January 1991, as Bangladesh transitioned and restored parliamentary democracy, The Daily Star emerged as a leading and influential national newspaper of record.', 1, '2019-08-21 06:08:30', '2019-09-03 04:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `guest_titles`
--

CREATE TABLE `guest_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_titles`
--

INSERT INTO `guest_titles` (`id`, `slug`, `guest_title`, `created_at`, `updated_at`) VALUES
(6, 'v-i-p', 'V I P', '2019-07-29 04:11:10', '2019-07-29 04:11:10'),
(7, 'govt-hi-officer', 'Govt. Hi. Officer', '2019-07-29 04:11:41', '2019-07-29 04:11:41'),
(8, 'govt-officer', 'Govt. Officer', '2019-07-29 04:11:57', '2019-07-29 04:11:57'),
(9, 'police-hi-officer', 'Police Hi. Officer', '2019-07-29 04:12:47', '2019-07-29 04:12:47'),
(10, 'police-officer', 'Police Officer', '2019-07-29 04:12:59', '2019-07-29 04:12:59'),
(11, 'defence-officer', 'Defence Officer', '2019-07-29 04:13:24', '2019-07-29 04:13:24'),
(12, 'journalist', 'Journalist', '2019-07-29 04:13:52', '2019-07-29 04:13:52'),
(13, 'army-officer', 'Army Officer', '2019-07-29 04:14:14', '2019-07-29 04:14:14'),
(14, 'business-man', 'Business Man', '2019-07-29 04:14:28', '2019-07-29 04:14:28'),
(15, 'corporate', 'Corporate', '2019-07-29 04:14:49', '2019-07-29 04:14:49'),
(16, 'private-job', 'Private Job', '2019-07-29 04:15:47', '2019-07-29 04:15:47'),
(17, 'retired-officer', 'Retired Officer', '2019-07-29 04:16:46', '2019-07-29 04:16:46'),
(18, 'student', 'Student', '2019-07-29 04:16:57', '2019-07-29 04:16:57'),
(19, 'back-packer', 'Back Packer', '2019-07-29 04:17:13', '2019-07-29 04:17:13'),
(22, 'others-update', 'Others update', '2019-07-29 04:47:07', '2019-09-02 02:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_booking_id` int(10) UNSIGNED NOT NULL,
  `hotel_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_of_persons` int(11) NOT NULL,
  `number_of_room` int(11) NOT NULL,
  `hotel_booking_ref` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_price` decimal(8,2) NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `room_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `king_size` int(11) DEFAULT NULL,
  `couple` int(11) DEFAULT NULL,
  `twin` int(11) DEFAULT NULL,
  `triple` int(11) DEFAULT NULL,
  `quared` int(11) DEFAULT NULL,
  `king_size_price` decimal(8,2) DEFAULT NULL,
  `couple_price` decimal(8,2) DEFAULT NULL,
  `twin_price` decimal(8,2) DEFAULT NULL,
  `triple_price` decimal(8,2) DEFAULT NULL,
  `quared_price` decimal(8,2) DEFAULT NULL,
  `room_qty` int(11) NOT NULL,
  `room_total_price` decimal(8,2) NOT NULL,
  `extra_bed_qty` int(11) DEFAULT NULL,
  `extra_bed_price` decimal(8,2) DEFAULT NULL,
  `extra_bed_total_price` decimal(8,2) DEFAULT NULL,
  `breakfast_qty` int(11) DEFAULT NULL,
  `breakfast_price` decimal(8,2) DEFAULT NULL,
  `breakfast_total_price` decimal(8,2) DEFAULT NULL,
  `early_check_in_qty` int(11) DEFAULT NULL,
  `early_check_in_price` decimal(8,2) DEFAULT NULL,
  `early_check_in_total_price` decimal(8,2) DEFAULT NULL,
  `late_check_out_qty` int(11) DEFAULT NULL,
  `late_check_out_price` decimal(8,2) DEFAULT NULL,
  `late_check_out_total_price` decimal(8,2) DEFAULT NULL,
  `total_hotel_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bookings`
--

CREATE TABLE `hotel_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_net_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `client` int(10) UNSIGNED NOT NULL,
  `sell_person` int(10) UNSIGNED NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incentives`
--

CREATE TABLE `incentives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `incentive_date` date NOT NULL,
  `staff` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(1) DEFAULT NULL,
  `cheque` tinyint(1) DEFAULT NULL,
  `total_incentive_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `loan_id`, `cash`, `cheque`, `narration`, `total_amount`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 1, 'installment er jonno narraion', '3600.00', '2019-11-21 00:09:43', '2019-11-21 00:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_date` date NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `name`, `narration`, `loan_date`, `amount`, `created_at`, `updated_at`) VALUES
(3, 'Lanka-Bangla', 'Loan er jonno narration dilam', '2019-11-21', '120000.00', '2019-11-20 23:17:50', '2019-11-21 00:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_25_091704_create_guest_titles_table', 1),
(4, '2019_07_25_093904_create_guest_titles_table', 2),
(5, '2019_07_30_050346_create_guest_designations_table', 3),
(6, '2019_07_31_091650_create_staff_designations_table', 4),
(7, '2019_08_01_061249_create_departments_table', 5),
(8, '2019_08_05_044913_create_staff_table', 6),
(9, '2019_08_08_124226_create_guests_table', 7),
(10, '2019_08_21_103531_create_guest_queries_table', 8),
(11, '2019_08_21_104142_create_guest_queries_table', 9),
(13, '2019_09_04_093458_create_air_lines_table', 11),
(14, '2019_09_05_075537_create_visa_categories_table', 12),
(15, '2019_09_07_073523_create_visa_agencies_table', 13),
(16, '2019_09_11_044130_create_visa_countries_table', 14),
(17, '2019_09_11_115056_create_visas_table', 15),
(18, '2019_09_11_124451_create_visas_table', 16),
(19, '2019_09_14_055312_create_visas_table', 17),
(27, '2019_10_10_074313_create_sub_airtickets_table', 22),
(30, '2019_10_22_084119_create_banks_table', 24),
(33, '2019_10_22_121805_create_cash_books_table', 26),
(35, '2019_10_23_051111_create_bank_books_table', 27),
(37, '2019_10_23_053222_create_cheque_books_table', 28),
(38, '2019_10_23_054906_create_others_table', 28),
(40, '2019_10_23_090757_create_money_receiveds_table', 29),
(41, '2019_10_24_081525_create_payments_table', 30),
(42, '2019_10_28_064549_create_contras_table', 31),
(43, '2019_11_11_063556_create_loans_table', 32),
(45, '2019_11_19_062703_create_installments_table', 33),
(47, '2019_11_25_042337_create_profits_table', 34),
(48, '2019_11_28_075809_create_transjactions_table', 35),
(49, '2019_12_03_090808_create_expence_heads_table', 36),
(52, '2019_12_04_043116_create_expences_table', 37),
(53, '2019_12_07_091725_create_incentives_table', 38),
(54, '2019_12_08_051327_create_salaries_table', 39),
(56, '2019_12_10_045901_create_passports_table', 41),
(57, '2019_10_10_073200_create_airtickets_table', 42),
(58, '2019_12_22_105700_create_paxes_table', 43),
(59, '2019_12_09_120832_create_visa_updateds_table', 44),
(60, '2019_10_16_070038_create_hotel_bookings_table', 45),
(61, '2019_10_16_073052_create_hotels_table', 45),
(63, '2020_01_06_050710_create_package_days_table', 47),
(64, '2020_01_06_051549_create_follow_u_p_to_supliers_table', 48),
(65, '2020_01_06_052650_create_follow_u_pto_guests_table', 49),
(66, '2020_01_06_054100_create_package_supliers_table', 50),
(67, '2019_09_24_075228_create_packages_table', 51),
(68, '2020_01_12_111107_create_package_net_prices_table', 52),
(69, '2019_09_04_054449_create_agencies_table', 53),
(70, '2020_01_16_062908_create_suplier_transactions_table', 54),
(71, '2020_01_23_093528_create_discounts_table', 55);

-- --------------------------------------------------------

--
-- Table structure for table `money_receiveds`
--

CREATE TABLE `money_receiveds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest` int(10) UNSIGNED NOT NULL,
  `staff` int(10) UNSIGNED NOT NULL,
  `bill_amount` decimal(8,2) NOT NULL,
  `total_received_amount` decimal(8,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `bank` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `other` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_id` int(10) UNSIGNED NOT NULL,
  `others_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest` int(10) UNSIGNED NOT NULL,
  `staff` int(10) UNSIGNED NOT NULL,
  `package_type` int(10) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `query_date` date NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult_qty` int(11) DEFAULT NULL,
  `child_qty` int(11) DEFAULT NULL,
  `infant_qty` int(11) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `hotel_cat` int(11) NOT NULL,
  `room_qty` int(11) NOT NULL DEFAULT '0',
  `room_cat` int(11) NOT NULL,
  `king_size` int(11) DEFAULT NULL,
  `couple_size` int(11) DEFAULT NULL,
  `twin_size` int(11) DEFAULT NULL,
  `triple_size` int(11) DEFAULT NULL,
  `quared_size` int(11) DEFAULT NULL,
  `total_bed_qty` int(11) DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `iti_submit_to_guest_date` date DEFAULT NULL,
  `adult_service` text COLLATE utf8mb4_unicode_ci,
  `child_service` text COLLATE utf8mb4_unicode_ci,
  `infant_service` text COLLATE utf8mb4_unicode_ci,
  `total_net_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `adult_price` decimal(8,2) DEFAULT NULL,
  `child_price` decimal(8,2) DEFAULT NULL,
  `infant_price` decimal(8,2) DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `adult_total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `child_total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `infant_total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `ex_night_qty` int(11) DEFAULT NULL,
  `ex_night_net_price` decimal(8,2) DEFAULT NULL,
  `ex_night_price` decimal(8,2) DEFAULT NULL,
  `ex_night_total_price` decimal(8,2) DEFAULT NULL,
  `ex_night_note` text COLLATE utf8mb4_unicode_ci,
  `ex_site_seeing_qty` int(11) DEFAULT NULL,
  `ex_site_seeing_net_price` decimal(8,2) DEFAULT NULL,
  `ex_site_seeing_price` decimal(8,2) DEFAULT NULL,
  `ex_site_seeing_total_price` decimal(8,2) DEFAULT NULL,
  `ex_site_seeing_note` text COLLATE utf8mb4_unicode_ci,
  `airport_rd_qty` int(11) DEFAULT NULL,
  `airport_rd_net_price` decimal(8,2) DEFAULT NULL,
  `airport_rd_price` decimal(8,2) DEFAULT NULL,
  `airport_rd_total_price` decimal(8,2) DEFAULT NULL,
  `airport_rd_note` text COLLATE utf8mb4_unicode_ci,
  `others_qty` int(11) DEFAULT NULL,
  `others_net_price` decimal(8,2) DEFAULT NULL,
  `others_price` decimal(8,2) DEFAULT NULL,
  `others_total_price` decimal(8,2) DEFAULT NULL,
  `others_note` text COLLATE utf8mb4_unicode_ci,
  `grand_total_net_price` decimal(8,2) DEFAULT NULL,
  `grand_total_price` decimal(8,2) DEFAULT NULL,
  `journey_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `visa_submit_to_us` date DEFAULT NULL,
  `visa_submit_to_em` date DEFAULT NULL,
  `visa_done_date` date DEFAULT NULL,
  `visa_delivery_to_guest` date DEFAULT NULL,
  `visa_confirmation` tinyint(4) DEFAULT NULL,
  `ticket_date` date DEFAULT NULL,
  `ticket_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_ready_date` date DEFAULT NULL,
  `document_delivery_date` date DEFAULT NULL,
  `state` int(11) NOT NULL,
  `extra_note` text COLLATE utf8mb4_unicode_ci,
  `first_qty` int(10) DEFAULT NULL,
  `first_price` decimal(10,2) DEFAULT NULL,
  `first_total_price` decimal(10,2) DEFAULT NULL,
  `second_qty` int(10) DEFAULT NULL,
  `second_price` decimal(10,2) DEFAULT NULL,
  `second_total_price` decimal(10,2) DEFAULT NULL,
  `third_qty` int(10) DEFAULT NULL,
  `third_price` decimal(10,2) DEFAULT NULL,
  `third_total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_days`
--

CREATE TABLE `package_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `day` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_date` date NOT NULL,
  `over_night` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_itinerary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `breakfast` tinyint(4) NOT NULL,
  `lunch` tinyint(4) NOT NULL,
  `dinner` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_net_prices`
--

CREATE TABLE `package_net_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pack_id` int(10) UNSIGNED NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_net_prices`
--

INSERT INTO `package_net_prices` (`id`, `pack_id`, `suplier`, `amount`, `created_at`, `updated_at`) VALUES
(7, 1, 1, '1500.00', '2020-01-23 02:07:34', '2020-01-23 02:07:34'),
(8, 1, 1, '2000.00', '2020-01-23 02:07:34', '2020-01-23 02:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `package_supliers`
--

CREATE TABLE `package_supliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `suplier_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passports`
--

CREATE TABLE `passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa_updated_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_books` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `expire_date` date NOT NULL,
  `type` tinyint(4) NOT NULL,
  `country` int(10) UNSIGNED NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `net_price` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `old_passport` text COLLATE utf8mb4_unicode_ci,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paxes`
--

CREATE TABLE `paxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pax_title` tinyint(4) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pp_issue_date` date NOT NULL,
  `pp_expire_date` date NOT NULL,
  `airticket_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `debit_voucher_date` date NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `total_payment_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profits`
--

CREATE TABLE `profits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `air_id` int(10) UNSIGNED DEFAULT NULL,
  `pack_id` int(10) UNSIGNED DEFAULT NULL,
  `visa_id` int(10) UNSIGNED DEFAULT NULL,
  `hotel_id` int(10) UNSIGNED DEFAULT NULL,
  `profit_date` date DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_date` date NOT NULL,
  `staff` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(1) DEFAULT NULL,
  `bank` tinyint(1) DEFAULT NULL,
  `cheque` tinyint(1) DEFAULT NULL,
  `total_salary_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` tinyint(4) NOT NULL,
  `staff_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` tinyint(4) NOT NULL,
  `location` tinyint(4) NOT NULL,
  `start_date` date NOT NULL,
  `salary` double(10,2) NOT NULL,
  `first_person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_person_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_person_relationship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_person_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_person_relationship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `email_address`, `date_of_birth`, `phone_number`, `alt_phone_number`, `address`, `nid`, `passport`, `blood_group`, `image`, `designation`, `staff_id`, `department`, `location`, `start_date`, `salary`, `first_person_name`, `first_person_phone_number`, `first_person_relationship`, `second_person_name`, `second_person_phone_number`, `second_person_relationship`, `user_type`, `password`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Noormoy', 'Faisal', 'noormoy@gmail.com', '2019-08-06', '01682814443', '01912621193', 'sddfsdfsdf', '15455555555', '123456', 'O+', '/cosmosHoliday/uploadImage/staff/1565252410.jpeg', 7, '12345566', 3, 1, '2019-08-08', 4545645.00, 'asdflkjj', '1531313', 'reafssdfasf', 'sdfasdf', '01215152', 'sfasdf', 'super-admin', '$2y$10$pMhp5m2k/zXzd.p13oxZiuFfj3wErGf.htSWd9kNe9wTlQ8xV7.rC', '1', '2019-08-08 02:20:11', '2019-10-19 01:50:32'),
(4, 'Visa', 'User', 'noormoy_visa@gmail.com', '2019-11-25', '016828144499', '016226666858', 'sdfasfdasdf', '194411545', '123456', 'O+', '/cosmosHoliday/uploadImage/staff/1574662004.jpeg', 8, '12345566', 4, 1, '2019-11-25', 18000.00, 'asdflkjj', '1531313', 'hhhkjhkjhk', 'sdfasdf', '01215152', 'ggjhkjh', 'user', '$2y$10$Zwok4NE8aAcOWrRESmAgdOIRs3pHlVMS6tLXakZbhHHd1vIJCujp6', '1', '2019-11-25 00:06:48', '2019-11-25 00:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designations`
--

CREATE TABLE `staff_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_designations`
--

INSERT INTO `staff_designations` (`id`, `slug`, `staff_designation`, `created_at`, `updated_at`) VALUES
(3, 'st-designaiton-1', 'st. Designaiton 1', '2019-07-31 22:18:17', '2019-08-25 00:28:46'),
(4, 'st-designation-2', 'st. Designation 2', '2019-08-01 05:23:20', '2019-08-25 00:28:55'),
(5, 'st-designation-3', 'st. Designation 3', '2019-08-01 05:23:30', '2019-08-25 00:29:05'),
(6, 'st-designation-5', 'st. Designation 5', '2019-08-01 05:23:45', '2019-08-25 00:29:16'),
(7, 'st-designation-4', 'st. Designation 4', '2019-08-01 05:23:59', '2019-08-25 00:29:24'),
(8, 'st-designation-6', 'st. Designation 6', '2019-08-06 00:17:55', '2019-08-25 00:29:40'),
(13, 'st-designaiton-7', 'st. Designaiton 7', '2019-09-02 03:51:43', '2019-09-02 03:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `sub_airtickets`
--

CREATE TABLE `sub_airtickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airticket_id` int(10) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `return_date` date NOT NULL,
  `air_lines` int(10) UNSIGNED NOT NULL,
  `pnr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_price` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_airtickets`
--

INSERT INTO `sub_airtickets` (`id`, `airticket_id`, `issue_date`, `departure_date`, `return_date`, `air_lines`, `pnr`, `sector`, `net_price`, `price`, `suplier`, `created_at`, `updated_at`) VALUES
(24, 6, '2020-01-23', '2020-01-17', '2020-01-23', 3, 'sfjkasjkldf', 'Dhaka-kalkata-Dhaka', '15000.00', '20000.00', 1, '2020-01-22 23:43:48', '2020-01-22 23:43:48'),
(25, 6, '2020-01-17', '2020-01-22', '2020-01-24', 2, 'sfjkasjkldf', 'Dhaka-kalkata-Dhaka', '14000.00', '20000.00', 1, '2020-01-22 23:43:48', '2020-01-22 23:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `suplier_transactions`
--

CREATE TABLE `suplier_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `air_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pack_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hotel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `debit_voucher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci,
  `debit_amount` decimal(8,2) DEFAULT NULL,
  `credit_amount` decimal(8,2) DEFAULT NULL,
  `balance` decimal(8,2) NOT NULL,
  `suplier_balance` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transjactions`
--

CREATE TABLE `transjactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `air_id` int(10) UNSIGNED DEFAULT NULL,
  `pack_id` int(10) UNSIGNED DEFAULT NULL,
  `visa_id` int(10) UNSIGNED DEFAULT NULL,
  `hotel_id` int(10) UNSIGNED DEFAULT NULL,
  `received_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_id` int(10) UNSIGNED DEFAULT NULL,
  `transjaction_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` decimal(8,2) NOT NULL,
  `guest_blance` decimal(8,2) NOT NULL,
  `staff_blance` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visas`
--

CREATE TABLE `visas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pp_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_books` int(11) NOT NULL,
  `pp_issue_date` date NOT NULL,
  `pp_expire_date` date NOT NULL,
  `country` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `suplier` tinyint(4) NOT NULL,
  `reference` tinyint(4) NOT NULL,
  `net_price` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `advance` decimal(8,2) NOT NULL,
  `sales_person` tinyint(4) NOT NULL,
  `received_date` date NOT NULL,
  `work_by` tinyint(4) DEFAULT NULL,
  `work_date` date DEFAULT NULL,
  `notary_by` tinyint(4) DEFAULT NULL,
  `notary_date` date DEFAULT NULL,
  `checked_by_asst` tinyint(4) DEFAULT NULL,
  `checked_by_asst_date` date DEFAULT NULL,
  `checked_by_officer` tinyint(4) DEFAULT NULL,
  `checked_by_officer_date` date DEFAULT NULL,
  `submit_by` tinyint(4) DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `collected_by` tinyint(4) DEFAULT NULL,
  `collected_date` date DEFAULT NULL,
  `call_and_sms_by` tinyint(4) DEFAULT NULL,
  `call_and_sms_date` date DEFAULT NULL,
  `delevered_by` tinyint(4) DEFAULT NULL,
  `delevered_date` date DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci,
  `payment_status` tinyint(4) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visa_agencies`
--

CREATE TABLE `visa_agencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_agencies`
--

INSERT INTO `visa_agencies` (`id`, `name`, `company_name`, `email_address`, `phone_number`, `address`, `alt_phone_number`, `website`, `created_at`, `updated_at`) VALUES
(2, 'Noormoy Faisal updated', 'Company Name', 'noormoy@gmail.com', '01682814443', 'sdfasdfasdfsd', NULL, NULL, '2019-09-07 23:59:23', '2019-09-08 00:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `visa_categories`
--

CREATE TABLE `visa_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_categories`
--

INSERT INTO `visa_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Business', '2019-09-05 03:20:49', '2019-09-05 03:20:49'),
(3, 'Tour', '2019-12-11 06:36:41', '2019-12-11 06:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `visa_countries`
--

CREATE TABLE `visa_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_countries`
--

INSERT INTO `visa_countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Bangladesh', '2019-09-10 23:16:57', '2019-12-11 06:36:55'),
(3, 'Pakistan', '2019-12-11 06:37:05', '2019-12-11 06:37:05'),
(4, 'India', '2019-12-11 06:37:12', '2019-12-11 06:37:12'),
(5, 'Srilanka', '2019-12-11 06:37:22', '2019-12-11 06:37:22'),
(6, 'Maldeep', '2019-12-11 06:37:43', '2019-12-11 06:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `visa_updateds`
--

CREATE TABLE `visa_updateds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urgent_qty` int(11) DEFAULT NULL,
  `urgent_price` decimal(8,2) DEFAULT NULL,
  `online_visa_qty` int(11) DEFAULT NULL,
  `online_visa_price` decimal(8,2) DEFAULT NULL,
  `notary_qty` int(11) DEFAULT NULL,
  `notary_price` decimal(8,2) DEFAULT NULL,
  `invitation_letter_qty` int(11) DEFAULT NULL,
  `invitation_letter_price` decimal(8,2) DEFAULT NULL,
  `land_valuation_qty` int(11) DEFAULT NULL,
  `land_valuation_price` decimal(8,2) DEFAULT NULL,
  `lawyer_qty` int(11) DEFAULT NULL,
  `lawyer_price` decimal(8,2) DEFAULT NULL,
  `total_net_price` decimal(8,2) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `total_others_price` decimal(8,2) NOT NULL,
  `grand_total_price` decimal(8,2) NOT NULL,
  `received_date` date NOT NULL,
  `client` int(10) UNSIGNED NOT NULL,
  `sell_person` int(10) UNSIGNED NOT NULL,
  `invoice_narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `word` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` bigint(20) NOT NULL,
  `work_by` int(10) UNSIGNED DEFAULT NULL,
  `work_date` date DEFAULT NULL,
  `notary_by` int(10) UNSIGNED DEFAULT NULL,
  `notary_date` date DEFAULT NULL,
  `checked_by_asst` int(10) UNSIGNED DEFAULT NULL,
  `checked_by_asst_date` date DEFAULT NULL,
  `checked_by_officer` int(10) UNSIGNED DEFAULT NULL,
  `checked_by_officer_date` date DEFAULT NULL,
  `submit_by` int(10) UNSIGNED DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `collected_by` int(10) UNSIGNED DEFAULT NULL,
  `collected_date` date DEFAULT NULL,
  `call_and_sms_by` int(10) UNSIGNED DEFAULT NULL,
  `call_and_sms_date` date DEFAULT NULL,
  `delevered_by` int(10) UNSIGNED DEFAULT NULL,
  `delevered_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airtickets`
--
ALTER TABLE `airtickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `air_lines`
--
ALTER TABLE `air_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_books`
--
ALTER TABLE `bank_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_books`
--
ALTER TABLE `cash_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheque_books`
--
ALTER TABLE `cheque_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contras`
--
ALTER TABLE `contras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expence_heads`
--
ALTER TABLE `expence_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_u_pto_guests`
--
ALTER TABLE `follow_u_pto_guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_u_p_to_supliers`
--
ALTER TABLE `follow_u_p_to_supliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_designations`
--
ALTER TABLE `guest_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_queries`
--
ALTER TABLE `guest_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_titles`
--
ALTER TABLE `guest_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incentives`
--
ALTER TABLE `incentives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_receiveds`
--
ALTER TABLE `money_receiveds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_days`
--
ALTER TABLE `package_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_net_prices`
--
ALTER TABLE `package_net_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_supliers`
--
ALTER TABLE `package_supliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passports`
--
ALTER TABLE `passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paxes`
--
ALTER TABLE `paxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profits`
--
ALTER TABLE `profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_email_address_unique` (`email_address`),
  ADD UNIQUE KEY `staff_phone_number_unique` (`phone_number`);

--
-- Indexes for table `staff_designations`
--
ALTER TABLE `staff_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_airtickets`
--
ALTER TABLE `sub_airtickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier_transactions`
--
ALTER TABLE `suplier_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transjactions`
--
ALTER TABLE `transjactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visas`
--
ALTER TABLE `visas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_agencies`
--
ALTER TABLE `visa_agencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_categories`
--
ALTER TABLE `visa_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_countries`
--
ALTER TABLE `visa_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_updateds`
--
ALTER TABLE `visa_updateds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `airtickets`
--
ALTER TABLE `airtickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `air_lines`
--
ALTER TABLE `air_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_books`
--
ALTER TABLE `bank_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cash_books`
--
ALTER TABLE `cash_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cheque_books`
--
ALTER TABLE `cheque_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contras`
--
ALTER TABLE `contras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expence_heads`
--
ALTER TABLE `expence_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `follow_u_pto_guests`
--
ALTER TABLE `follow_u_pto_guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follow_u_p_to_supliers`
--
ALTER TABLE `follow_u_p_to_supliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guest_designations`
--
ALTER TABLE `guest_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guest_queries`
--
ALTER TABLE `guest_queries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guest_titles`
--
ALTER TABLE `guest_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incentives`
--
ALTER TABLE `incentives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `money_receiveds`
--
ALTER TABLE `money_receiveds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_days`
--
ALTER TABLE `package_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_net_prices`
--
ALTER TABLE `package_net_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_supliers`
--
ALTER TABLE `package_supliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passports`
--
ALTER TABLE `passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paxes`
--
ALTER TABLE `paxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profits`
--
ALTER TABLE `profits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_airtickets`
--
ALTER TABLE `sub_airtickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `suplier_transactions`
--
ALTER TABLE `suplier_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transjactions`
--
ALTER TABLE `transjactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visas`
--
ALTER TABLE `visas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visa_agencies`
--
ALTER TABLE `visa_agencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visa_categories`
--
ALTER TABLE `visa_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visa_countries`
--
ALTER TABLE `visa_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visa_updateds`
--
ALTER TABLE `visa_updateds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
