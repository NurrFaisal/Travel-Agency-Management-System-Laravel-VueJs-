-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 09:02 AM
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
(3, 'suplier3', 'maikel', '3245555', 'noormoy6@gmail.com', '4', 'Visa, Package, AirTicket', '2020-01-15 23:47:11', '2020-01-15 23:47:11'),
(4, 'CTIA', 'Priotosh Sarkar', '01749252001', 'ctia@gmail.com', '4', 'Package, Hotel Booking, Air-Ticket', '2020-02-24 05:40:59', '2020-02-24 05:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `airtickets`
--

CREATE TABLE `airtickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
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
  `print` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airtickets`
--

INSERT INTO `airtickets` (`id`, `invoice_date`, `sell_person`, `destination`, `adult_qty`, `adult_price`, `adult_total_price`, `child_qty`, `child_price`, `child_total_price`, `infant_qty`, `infant_price`, `infant_total_price`, `ssr_qty`, `ssr_price`, `ssr_total_price`, `service_amount`, `total_amount`, `total_net_price`, `total_price`, `selling_to`, `note`, `journey_date`, `return_date`, `ticket_class`, `food_rules`, `date_change`, `narration`, `ticket_type`, `ticket_rules`, `luggages_rules`, `luggages_rules_description`, `hand_luggages_rules`, `hand_luggages_rules_description`, `print`, `created_at`, `updated_at`) VALUES
(10, '2020-02-27', 3, 'Dhaka-Kalkata-Dhaka', 1, '2000.00', '2000.00', NULL, NULL, '0.00', NULL, NULL, '0.00', NULL, NULL, '0.00', NULL, '2000.00', '1500.00', '2000.00', 3, 'sdfasd', '2020-02-27', '2020-02-20', 1, 0, 0, 'Narration Dilam', 1, 0, 7, 'description', 40, '2 pack', 7, '2020-02-27 04:01:08', '2020-03-03 00:47:23');

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
(3, 'BG', '2019-10-15 03:41:08', '2019-12-17 06:06:34'),
(4, 'Deepjol Paribahan', '2020-03-01 02:57:14', '2020-03-01 02:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `air_ticket_refunds`
--

CREATE TABLE `air_ticket_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `refund_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `air_ticket_refunds`
--

INSERT INTO `air_ticket_refunds` (`id`, `ticket_id`, `refund_date`, `amount`, `suplier`, `created_at`, `updated_at`) VALUES
(9, 93, '2020-03-01', '2000.00', 1, '2020-02-29 22:36:03', '2020-02-29 22:36:03');

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
  `payment_loan_id` int(10) UNSIGNED DEFAULT NULL,
  `ins_payment_id` bigint(10) UNSIGNED DEFAULT NULL,
  `received_loan_id` int(10) DEFAULT NULL,
  `rl_installment_id` int(10) UNSIGNED DEFAULT NULL,
  `pl_installment_id` bigint(10) UNSIGNED DEFAULT NULL,
  `bank_name` int(10) UNSIGNED NOT NULL,
  `bank_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_cheque_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_bank_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_bank_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `bank_blance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_books`
--

INSERT INTO `bank_books` (`id`, `received_id`, `payment_id`, `expence_id`, `incentive_id`, `salary_id`, `contra_id`, `cheque_id`, `payment_loan_id`, `ins_payment_id`, `received_loan_id`, `rl_installment_id`, `pl_installment_id`, `bank_name`, `bank_date`, `narration`, `bank_cheque_number`, `debit_bank_amount`, `credit_bank_amount`, `blance`, `bank_blance`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2020-02-01', 'Narration Dilam', NULL, '0.00', '1000.00', '-1000.00', '-1000.00', '2020-02-26 00:23:22', '2020-02-26 00:23:22'),
(4, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2020-02-03', 'Narration Dilam', NULL, '2000.00', '0.00', '1000.00', '2000.00', '2020-02-26 00:23:53', '2020-02-26 00:23:53');

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
  `payment_loan_id` int(10) UNSIGNED DEFAULT NULL,
  `pl_installment_id` bigint(10) UNSIGNED DEFAULT NULL,
  `received_loan_id` int(10) DEFAULT NULL,
  `rl_installment_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `cash_date` date DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_cash_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_cash_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `branch_blance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_books`
--

INSERT INTO `cash_books` (`id`, `received_id`, `payment_id`, `expence_id`, `incentive_id`, `salary_id`, `contra_id`, `cheque_id`, `payment_loan_id`, `pl_installment_id`, `received_loan_id`, `rl_installment_id`, `branch_id`, `cash_date`, `narration`, `debit_cash_amount`, `credit_cash_amount`, `blance`, `branch_blance`, `created_at`, `updated_at`) VALUES
(149, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-25', 'Narration Dilam', '5000.00', '0.00', '4000.00', '4000.00', '2020-02-25 22:38:07', '2020-02-26 00:23:53'),
(152, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-02', 'Narration Dilam', '0.00', '4000.00', '2200.00', '2200.00', '2020-02-25 23:12:50', '2020-02-26 05:08:26'),
(155, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-01', 'Narration Dilam', '1000.00', '0.00', '1000.00', '1000.00', '2020-02-26 00:23:23', '2020-02-26 00:23:23'),
(156, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-03', 'Narration Dilam', '0.00', '2000.00', '-1000.00', '-1000.00', '2020-02-26 00:23:53', '2020-02-26 00:23:53'),
(158, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-29', 'Narration Dilam', '0.00', '3000.00', '6200.00', '6200.00', '2020-02-26 02:17:40', '2020-02-26 05:08:27'),
(160, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-26', 'Narration Dilam', '0.00', '1000.00', '3000.00', '3000.00', '2020-02-26 02:32:01', '2020-02-26 02:32:01'),
(163, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-26', 'Narration Dilam', '0.00', '2000.00', '1000.00', '1000.00', '2020-02-26 02:44:49', '2020-02-26 02:44:49'),
(165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, '2020-02-26', 'Narration Dilam', '10000.00', '0.00', '11000.00', '11000.00', '2020-02-26 02:56:52', '2020-02-26 02:56:52'),
(169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, '2020-02-26', 'Narration Dilam', '4000.00', '0.00', '15000.00', '15000.00', '2020-02-26 03:15:40', '2020-02-26 03:15:40'),
(171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-02-26', 'Narration Dilam', '0.00', '3000.00', '12000.00', '12000.00', '2020-02-26 03:24:37', '2020-02-26 03:24:37'),
(173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, '2020-02-26', 'Narration Dilam', '0.00', '4000.00', '8000.00', '8000.00', '2020-02-26 03:42:50', '2020-02-26 03:42:50'),
(175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2020-02-26', 'Narration Dilam', '500.00', '0.00', '8500.00', '8500.00', '2020-02-26 04:05:29', '2020-02-26 04:05:29'),
(176, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2020-02-26', 'Cheque To Cash', '700.00', '0.00', '9200.00', '9200.00', '2020-02-26 05:08:26', '2020-02-26 05:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_books`
--

CREATE TABLE `cheque_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_id` int(10) UNSIGNED DEFAULT NULL,
  `received_loan_id` int(10) DEFAULT NULL,
  `pl_installment_id` bigint(10) UNSIGNED DEFAULT NULL,
  `cheque_bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_type` tinyint(4) NOT NULL,
  `cheque_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_amount` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `location` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cheque_books`
--

INSERT INTO `cheque_books` (`id`, `received_id`, `received_loan_id`, `pl_installment_id`, `cheque_bank_name`, `cheque_type`, `cheque_number`, `cheque_date`, `cheque_amount`, `status`, `location`, `created_at`, `updated_at`) VALUES
(1, 88, NULL, NULL, 'One Bank', 1, '12345678', '2020-02-26', '3300.00', 0, 1, '2020-02-26 04:24:52', '2020-02-26 04:24:52'),
(2, NULL, 3, NULL, 'One Bank 2', 1, '456789', '2020-02-26', '4400.00', 0, 1, '2020-02-26 04:27:10', '2020-02-26 04:27:10'),
(3, NULL, NULL, 2, 'One Bank 3', 1, '123456', '2020-02-26', '700.00', 1, 1, '2020-02-26 04:59:59', '2020-02-26 05:08:27');

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
  `location` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contras`
--

INSERT INTO `contras` (`id`, `contra_type`, `contra_date`, `contra_amount`, `from_bank_name`, `to_bank_name`, `bank_name`, `narration`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-02-03', '2000.00', NULL, NULL, 2, 'Narration Dilam', 1, '2020-02-26 00:09:05', '2020-02-26 00:23:53'),
(2, 2, '2020-02-01', '1000.00', NULL, NULL, 3, 'Narration Dilam', 1, '2020-02-26 00:12:59', '2020-02-26 00:23:22');

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
(6, 'accounts', 'Accounts', '2019-10-19 23:14:18', '2019-10-19 23:14:18'),
(7, 'hotel-booking', 'Hotel Booking', '2020-02-16 02:35:05', '2020-02-16 02:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `received_id` bigint(20) UNSIGNED NOT NULL,
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
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expences`
--

INSERT INTO `expences` (`id`, `expence_date`, `expence_head`, `cash`, `cheque`, `total_expence_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '2020-02-29', 2, 1, 0, '3000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 01:44:05', '2020-02-26 02:17:39');

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
(1, 1, '2020-01-24', 1, '2020-01-24', '2020-01-23 00:06:34', '2020-01-23 00:06:34'),
(2, 1, '2020-02-16', 1, '2020-02-13', '2020-02-12 03:57:48', '2020-02-12 03:57:48'),
(3, 3, '2020-02-12', 1, '2020-02-12', '2020-02-12 05:32:28', '2020-02-12 05:32:28'),
(4, 4, '2020-02-13', 1, '2020-02-13', '2020-02-12 23:02:37', '2020-02-12 23:02:37'),
(5, 5, '2020-02-13', 1, '2020-02-14', '2020-02-13 05:02:07', '2020-02-13 05:02:07'),
(6, 5, '2020-02-19', 1, '2020-02-15', '2020-02-19 06:29:58', '2020-02-19 06:29:58'),
(7, 4, '2020-02-19', 2, '2020-02-12', '2020-02-19 06:34:19', '2020-02-19 06:34:19'),
(8, 4, '2020-02-20', 1, '2020-02-20', '2020-02-19 22:18:38', '2020-02-19 22:18:38'),
(9, 4, '2020-02-20', 1, '2020-02-13', '2020-02-19 22:19:59', '2020-02-19 22:19:59'),
(10, 4, '2020-02-22', 1, 'sdfasd', '2020-02-22 00:18:47', '2020-02-22 00:18:47'),
(11, 6, '2020-03-02', 4, 'sdfasd', '2020-03-01 23:38:37', '2020-03-01 23:38:37');

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
(4, 4, '2020-02-13', 'sdfasd', '2020-02-12 23:01:54', '2020-02-12 23:01:54'),
(5, 5, '2020-02-14', 'sdfasd', '2020-02-13 04:58:07', '2020-02-13 04:58:07'),
(6, 5, '2020-02-19', 'Note: For 50 years, WWF has been protecting 50 years, WWF has been protecting 50 years', '2020-02-19 06:29:09', '2020-02-19 06:29:09'),
(7, 4, '2020-02-19', 'sdfasd', '2020-02-19 06:33:54', '2020-02-19 06:33:54'),
(8, 4, '2020-02-20', 'sdfasd', '2020-02-19 22:14:12', '2020-02-19 22:14:12'),
(9, 4, '2020-02-20', 'sdfasd', '2020-02-19 22:15:17', '2020-02-19 22:15:17'),
(10, 4, '2020-02-20', 'sdfasd', '2020-02-19 22:16:22', '2020-02-19 22:16:22'),
(11, 6, '2020-03-10', 'sdfasd', '2020-03-01 23:13:10', '2020-03-01 23:13:10');

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
(3, 1, 'Abdul Kalam', 17, 7, 3, 'Monsur Ali Bapari', 'xyz@gmail.com', 'asdfsa@gmail.com', '019464556565', '013565953500', 'this si the address bar text-area', 0, 1, '2019-08-23 22:57:29', '2020-02-18 03:40:42'),
(5, 1, 'Kala Jahangir', 18, 9, 3, 'sdfsd', 'noormoy@gmail.com', 'xyz@gmail.com', '01708808363', '01622666666', 'sdfasdfasdfsd', 0, 1, '2019-08-27 01:54:44', '2019-08-27 01:54:44'),
(6, 1, 'Noormoy Faisal 55', 16, 9, 3, 'sdfsd', 'acc.cosmosbd@gmail.com', 'xyz3@gmail.com', '01778889141', '016226666666', 'sdfasdfasdfsd', 0, 1, '2019-09-03 06:48:27', '2019-09-03 06:48:27'),
(7, 1, 'Noormoy Faisal2', 14, 9, 3, 'sdfsd', 'sdf@gmail.com', 'xyz@gmail.com', '01682814448', '01622666666', 'sdfasdfasdfsd', 0, 1, '2019-09-11 23:18:59', '2019-09-11 23:18:59'),
(8, 1, 'Kabila Razib', 16, 8, 3, 'sdfsd', 'sdfsd@gmail.com', 'xyz2@gmail.com', '017788891412', '01622666666', 'sdfasdfasdfsd', 1, 1, '2019-10-09 23:36:42', '2019-10-19 00:58:02'),
(9, 1, 'Baker Vai', 13, 9, 32, 'Chan Mia', 'bakervai420@gmail.com', 'bakervai420@gmail.com', '01912222222', '01919999989', 'Shonir Akhra', 0, 1, '2020-03-01 02:30:13', '2020-03-01 02:30:13');

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

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_booking_id`, `hotel_name`, `check_in`, `check_out`, `number_of_persons`, `number_of_room`, `hotel_booking_ref`, `net_price`, `suplier`, `room_category`, `note`, `address`, `king_size`, `couple`, `twin`, `triple`, `quared`, `king_size_price`, `couple_price`, `twin_price`, `triple_price`, `quared_price`, `room_qty`, `room_total_price`, `extra_bed_qty`, `extra_bed_price`, `extra_bed_total_price`, `breakfast_qty`, `breakfast_price`, `breakfast_total_price`, `early_check_in_qty`, `early_check_in_price`, `early_check_in_total_price`, `late_check_out_qty`, `late_check_out_price`, `late_check_out_total_price`, `total_hotel_price`, `created_at`, `updated_at`) VALUES
(8, 6, 'Ruposhi Bangla', '2020-02-13', '2020-02-14', 5, 2, 'sdfsda', '3550.00', 1, 'Stander', 'sdfasd', 'Dhaka, Bangladesh', 1, 2, 3, 4, 5, '100.00', '200.00', '300.00', '400.00', '500.00', 15, '5500.00', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5500.00', '2020-02-11 23:16:09', '2020-02-11 23:16:09'),
(9, 6, 'Sea Gull', '2020-02-12', '2020-02-15', 2, 1, 'sdfsdaaa', '2520.00', 1, 'Stander', 'sdfasd', 'Cox\'s Bazaar.', 1, 2, 3, 4, 6, '100.00', '200.00', '300.00', '400.00', '500.00', 16, '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6000.00', '2020-02-11 23:16:09', '2020-02-11 23:16:09');

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
  `print` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_bookings`
--

INSERT INTO `hotel_bookings` (`id`, `customer_name`, `total_net_price`, `total_price`, `client`, `sell_person`, `narration`, `print`, `created_at`, `updated_at`) VALUES
(6, 'Rofiq, Salam, Borkot, Jabbar etc....', '6070.00', '11500.00', 3, 3, 'Narration Dilam update', 8, '2020-02-11 23:02:39', '2020-02-19 04:04:12');

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
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incentives`
--

INSERT INTO `incentives` (`id`, `incentive_date`, `staff`, `cash`, `cheque`, `total_incentive_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(2, '2020-02-26', 27, 1, 0, '2000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 02:44:30', '2020-02-26 02:44:49');

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
(71, '2020_01_23_093528_create_discounts_table', 55),
(72, '2020_02_05_053042_create_received_loan_heads_table', 56),
(73, '2020_02_05_062906_create_received_loans_table', 57),
(74, '2020_02_05_091626_create_received_loan_transactions_table', 58),
(75, '2020_02_06_081308_create_r_l_installments_table', 59),
(78, '2020_02_09_061957_create_payment_loan_transactions_table', 61),
(79, '2020_02_09_051548_create_payment_loans_table', 62),
(80, '2020_02_10_050604_create_p_l_installments_table', 63),
(81, '2020_02_25_051440_create_air_ticket_refunds_table', 64);

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
  `print` bigint(20) NOT NULL DEFAULT '0',
  `location` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `money_receiveds`
--

INSERT INTO `money_receiveds` (`id`, `guest`, `staff`, `bill_amount`, `total_received_amount`, `discount`, `due_amount`, `narration`, `cash`, `bank`, `cheque`, `other`, `print`, `location`, `created_at`, `updated_at`) VALUES
(87, 3, 25, '5000.00', '5000.00', NULL, '0.00', 'Narration Dilam', 1, NULL, NULL, NULL, 0, 1, '2020-02-25 05:59:48', '2020-02-25 05:59:48'),
(88, 6, 23, '12000.00', '3300.00', NULL, '8700.00', 'Narration Dilam', 0, NULL, 1, NULL, 0, 1, '2020-02-26 04:24:52', '2020-02-26 04:24:52');

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

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `received_id`, `others_name`, `others_amount`, `created_at`, `updated_at`) VALUES
(18, 65, 'Other Name Two', '500.00', '2020-01-29 06:17:40', '2020-01-29 06:17:40'),
(19, 66, 'Other Name Two', '500.00', '2020-01-29 06:17:44', '2020-01-29 06:17:44'),
(20, 67, 'Other Name Two', '500.00', '2020-01-29 06:17:46', '2020-01-29 06:17:46'),
(21, 68, 'Other Name Two', '500.00', '2020-01-29 06:17:49', '2020-01-29 06:17:49'),
(22, 69, 'Other Name Two', '1000.00', '2020-01-29 06:21:54', '2020-01-29 06:21:54'),
(24, 71, 'Other Name Two', '1000.00', '2020-01-29 06:22:01', '2020-01-29 06:22:01'),
(25, 72, 'Other Name Two', '1000.00', '2020-01-29 06:22:05', '2020-01-29 06:22:05'),
(27, 70, 'Other Name Two', '1000.00', '2020-02-27 00:29:44', '2020-01-30 00:29:44');

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
  `confirm_date` date DEFAULT NULL,
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
  `print` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `guest`, `staff`, `package_type`, `country`, `query_date`, `destination`, `duration`, `adult_qty`, `child_qty`, `infant_qty`, `total_qty`, `hotel_cat`, `room_qty`, `room_cat`, `king_size`, `couple_size`, `twin_size`, `triple_size`, `quared_size`, `total_bed_qty`, `narration`, `iti_submit_to_guest_date`, `adult_service`, `child_service`, `infant_service`, `total_net_price`, `adult_price`, `child_price`, `infant_price`, `total_price`, `adult_total_price`, `child_total_price`, `infant_total_price`, `total_total_price`, `ex_night_qty`, `ex_night_net_price`, `ex_night_price`, `ex_night_total_price`, `ex_night_note`, `ex_site_seeing_qty`, `ex_site_seeing_net_price`, `ex_site_seeing_price`, `ex_site_seeing_total_price`, `ex_site_seeing_note`, `airport_rd_qty`, `airport_rd_net_price`, `airport_rd_price`, `airport_rd_total_price`, `airport_rd_note`, `others_qty`, `others_net_price`, `others_price`, `others_total_price`, `others_note`, `grand_total_net_price`, `grand_total_price`, `confirm_date`, `journey_date`, `return_date`, `visa_submit_to_us`, `visa_submit_to_em`, `visa_done_date`, `visa_delivery_to_guest`, `visa_confirmation`, `ticket_date`, `ticket_type`, `document_ready_date`, `document_delivery_date`, `state`, `extra_note`, `first_qty`, `first_price`, `first_total_price`, `second_qty`, `second_price`, `second_total_price`, `third_qty`, `third_price`, `third_total_price`, `print`, `created_at`, `updated_at`) VALUES
(4, 3, 3, 1, 'India-Bangladesh-Nepal', '2020-02-13', 'Kashmir-Sikkim', '25 Days', 2, NULL, NULL, 2, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, 'Narration Dilam', '2020-02-22', 'adult service', NULL, NULL, '0.00', '200.00', NULL, NULL, '0.00', '400.00', '0.00', '0.00', '400.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4000.00', '400.00', '2020-02-16', '2020-02-15', '2020-02-16', '2020-02-13', '2020-02-19', '2020-02-27', '2020-02-21', NULL, '2020-02-22', 'Air', '2020-02-22', '2020-02-22', 10, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2020-02-26 22:59:00', '2020-02-22 00:23:14'),
(5, 8, 3, 1, 'India-Bangladesh-Nepal', '2020-02-14', 'Kashmir-Sikkim', '6 Days | 5 Nights', 2, NULL, NULL, 2, 1, 1, 10, NULL, NULL, NULL, NULL, NULL, 0, 'Narration Dilam', '2020-02-19', 'adult service', NULL, NULL, '0.00', '500.00', NULL, NULL, '0.00', '1000.00', '0.00', '0.00', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123.00', '1000.00', '2020-02-22', '2020-02-23', '2020-02-24', '2020-02-21', '2020-02-23', '2020-02-24', '2020-02-25', NULL, '2020-02-19', 'Air', '2020-02-26', '2020-02-19', 10, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2020-02-13 04:33:22', '2020-02-21 23:31:21'),
(6, 3, 18, 4, 'Bangladesh-India-Pakistan', '2020-03-10', 'Dhaka-Delhe-Korachi', '25 Days', 2, NULL, NULL, 2, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, 'Narrartion', '2020-03-02', 'adult service', NULL, NULL, '0.00', '15000.00', NULL, NULL, '0.00', '30000.00', '0.00', '0.00', '30000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2500.00', '30000.00', '2020-03-02', '2020-03-25', '2020-03-28', '2020-03-02', '2020-03-04', '2020-03-09', '2020-03-12', NULL, '2020-03-02', 'Air', '2020-03-17', '2020-03-02', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-03-01 22:53:25', '2020-03-02 00:41:18');

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

--
-- Dumping data for table `package_days`
--

INSERT INTO `package_days` (`id`, `package_id`, `day`, `day_date`, `over_night`, `tour_itinerary`, `breakfast`, `lunch`, `dinner`, `created_at`, `updated_at`) VALUES
(44, 5, 'Day-1', '2020-02-14', 'Kalkata', 'tour itinerary note', 1, 1, 1, '2020-02-19 06:30:33', '2020-02-19 06:30:33'),
(45, 4, 'Day-1', '2020-02-13', 'Kalkata', 'safasdf', 1, 1, 1, '2020-02-19 06:33:46', '2020-02-19 06:33:46'),
(54, 6, 'Day-1', '2020-03-11', 'Dhaka', 'asdfasdfasdf', 1, 1, 1, '2020-03-02 00:41:10', '2020-03-02 00:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `package_net_prices`
--

CREATE TABLE `package_net_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pack_id` int(10) UNSIGNED NOT NULL,
  `suplier` int(10) UNSIGNED NOT NULL,
  `net_price_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_net_prices`
--

INSERT INTO `package_net_prices` (`id`, `pack_id`, `suplier`, `net_price_date`, `amount`, `created_at`, `updated_at`) VALUES
(8, 4, 1, '2020-02-18', '300.00', '2020-02-13 03:36:18', '2020-02-13 03:36:18'),
(18, 5, 1, '2020-02-29', '600.00', '2020-02-19 05:56:04', '2020-02-19 05:56:04'),
(19, 5, 2, '2020-02-12', '123.00', '2020-02-19 06:31:37', '2020-02-19 06:31:37'),
(20, 4, 1, '2020-02-19', '5000.00', '2020-02-19 06:43:46', '2020-02-19 06:43:46'),
(21, 4, 2, '2020-02-13', '1500.00', '2020-02-19 06:44:47', '2020-02-19 06:44:47'),
(22, 4, 2, '2020-02-07', '4000.00', '2020-02-19 06:45:57', '2020-02-19 06:45:57'),
(23, 4, 3, '2020-02-26', '4000.00', '2020-02-19 22:28:29', '2020-02-19 22:28:29'),
(26, 6, 1, '2020-03-18', '2500.00', '2020-03-02 00:41:10', '2020-03-02 00:41:10');

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

--
-- Dumping data for table `passports`
--

INSERT INTO `passports` (`id`, `visa_updated_id`, `name`, `passport_number`, `no_of_books`, `date_of_birth`, `expire_date`, `type`, `country`, `suplier`, `net_price`, `price`, `old_passport`, `narration`, `created_at`, `updated_at`) VALUES
(32, 6, 'Noormoy Faisal', '7890123', 4, '2020-02-05', '2020-02-14', 2, 5, 1, '1500.00', '2000.00', '0112225,45444', 'Narration Dilam', '2020-03-01 05:46:04', '2020-03-01 05:46:04'),
(33, 6, 'Kala Jahangir', '123456789', 6, '2020-02-02', '2020-02-29', 3, 6, 2, '2500.00', '3400.00', '0112225,45444', 'Narration Dilam', '2020-03-01 05:46:05', '2020-03-01 05:46:05'),
(35, 7, 'visa Name', '123456', 4, '2020-03-01', '2020-03-05', 3, 5, 1, '1500.00', '2500.00', '0112225,45444', 'Narration Dilam', '2020-03-01 05:47:41', '2020-03-01 05:47:41');

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

--
-- Dumping data for table `paxes`
--

INSERT INTO `paxes` (`id`, `pax_title`, `name`, `date_of_birth`, `gender`, `phone_number`, `passport_number`, `pp_issue_date`, `pp_expire_date`, `airticket_id`, `created_at`, `updated_at`) VALUES
(28, 1, 'Noormoy Faisal', '2020-02-19', 1, '01682814443', '7890123', '2020-01-29', '2020-02-18', 10, '2020-02-27 04:01:09', '2020-02-27 04:01:09');

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
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `debit_voucher_date`, `suplier`, `cash`, `cheque`, `total_payment_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(2, '2020-03-02', 1, 1, NULL, '4000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-25 23:04:52', '2020-02-25 23:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `payment_loans`
--

CREATE TABLE `payment_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pl_date` date NOT NULL,
  `pl_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `total_payment_loan_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_loans`
--

INSERT INTO `payment_loans` (`id`, `pl_date`, `pl_name`, `cash`, `cheque`, `total_payment_loan_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '2020-02-26', 'Suhel Rana', 1, NULL, '4000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 03:32:21', '2020-02-26 03:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `payment_loan_transactions`
--

CREATE TABLE `payment_loan_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pl_installment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ins_payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `loan_blance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_loan_transactions`
--

INSERT INTO `payment_loan_transactions` (`id`, `payment_loan_id`, `pl_installment_id`, `ins_payment_id`, `transaction_date`, `narration`, `debit_amount`, `credit_amount`, `blance`, `loan_blance`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL, '2020-02-26', 'Narration Dilam', '4000.00', '0.00', '4000.00', '4000.00', '2020-02-26 03:42:51', '2020-02-26 03:42:51'),
(4, NULL, 1, 1, '2020-02-26', 'Narration Dilam', '0.00', '500.00', '3500.00', '3500.00', '2020-02-26 04:05:30', '2020-02-26 04:05:30'),
(5, NULL, 2, 1, '2020-02-26', 'Narration Dilam', '0.00', '700.00', '2800.00', '2800.00', '2020-02-26 04:59:59', '2020-02-26 04:59:59');

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

--
-- Dumping data for table `profits`
--

INSERT INTO `profits` (`id`, `staff_id`, `guest_id`, `air_id`, `pack_id`, `visa_id`, `hotel_id`, `profit_date`, `amount`, `created_at`, `updated_at`) VALUES
(26, 3, 8, 8, NULL, NULL, NULL, '2020-02-14', '1000.00', '2020-02-11 05:21:01', '2020-02-11 05:21:01'),
(33, 3, 3, NULL, NULL, NULL, 6, '2020-02-15', '5430.00', '2020-02-11 23:16:09', '2020-02-11 23:16:09'),
(35, 3, 8, NULL, NULL, 6, NULL, '2020-02-12', '1400.00', '2020-02-12 02:50:10', '2020-02-12 02:50:10'),
(42, 3, 3, NULL, 4, NULL, NULL, '2020-02-16', '100.00', '2020-02-13 03:36:18', '2020-02-13 03:36:18'),
(52, 3, 8, NULL, 5, NULL, NULL, '2020-02-24', '400.00', '2020-02-19 05:56:04', '2020-02-19 05:56:04'),
(53, 3, 8, NULL, 5, NULL, NULL, '2020-02-24', '877.00', '2020-02-19 06:31:37', '2020-02-19 06:31:37'),
(54, 3, 3, NULL, 4, NULL, NULL, '2020-02-16', '-4600.00', '2020-02-19 06:43:47', '2020-02-19 06:43:47'),
(55, 3, 3, NULL, 4, NULL, NULL, '2020-02-16', '-1100.00', '2020-02-19 06:44:47', '2020-02-19 06:44:47'),
(56, 3, 3, NULL, 4, NULL, NULL, '2020-02-16', '-3600.00', '2020-02-19 06:45:58', '2020-02-19 06:45:58'),
(57, 3, 3, NULL, 4, NULL, NULL, '2020-02-16', '-3600.00', '2020-02-19 22:28:30', '2020-02-19 22:28:30'),
(58, 3, 3, 9, NULL, NULL, NULL, '2020-02-27', '500.00', '2020-02-27 03:56:11', '2020-02-27 03:56:11'),
(59, 3, 3, 10, NULL, NULL, NULL, '2020-02-20', '500.00', '2020-02-27 04:01:09', '2020-02-27 04:01:09'),
(62, 18, 3, NULL, 6, NULL, NULL, '2020-03-28', '27500.00', '2020-03-02 00:41:10', '2020-03-02 00:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `p_l_installments`
--

CREATE TABLE `p_l_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pl_installment_date` date NOT NULL,
  `loan_id` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `bank` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `total_payment_loan_installment_amount` decimal(10,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p_l_installments`
--

INSERT INTO `p_l_installments` (`id`, `pl_installment_date`, `loan_id`, `cash`, `bank`, `cheque`, `total_payment_loan_installment_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '2020-02-26', 1, 1, NULL, NULL, '500.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 03:59:33', '2020-02-26 04:05:29'),
(2, '2020-02-26', 1, 0, NULL, 1, '700.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 04:59:59', '2020-02-26 04:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `received_loans`
--

CREATE TABLE `received_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rl_date` date NOT NULL,
  `rl_head` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `bank` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `total_received_loan_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_loans`
--

INSERT INTO `received_loans` (`id`, `rl_date`, `rl_head`, `cash`, `bank`, `cheque`, `total_received_loan_amount`, `narration`, `location`, `created_at`, `updated_at`) VALUES
(1, '2020-02-26', 'Lanka-Bangla', 1, NULL, NULL, '10000.00', 'Narration Dilam', 1, '2020-02-26 02:55:03', '2020-02-26 02:56:52'),
(2, '2020-02-26', 'Datch-Banka', 1, NULL, NULL, '4000.00', 'Narration Dilam', 1, '2020-02-26 03:06:46', '2020-02-26 03:15:39'),
(3, '2020-02-26', 'Lanka-Bangla', 0, NULL, 1, '4400.00', 'Narration Dilam', 1, '2020-02-26 04:27:09', '2020-02-26 04:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `received_loan_transactions`
--

CREATE TABLE `received_loan_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `received_loan_id` int(10) UNSIGNED DEFAULT NULL,
  `rl_installment_id` int(10) UNSIGNED DEFAULT NULL,
  `ins_loan_id` bigint(10) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blance` decimal(8,2) NOT NULL,
  `loan_blance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_loan_transactions`
--

INSERT INTO `received_loan_transactions` (`id`, `received_loan_id`, `rl_installment_id`, `ins_loan_id`, `transaction_date`, `narration`, `debit_amount`, `credit_amount`, `blance`, `loan_blance`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL, '2020-02-26', 'Narration Dilam', '0.00', '10000.00', '-10000.00', '-10000.00', '2020-02-26 02:56:53', '2020-02-26 02:56:53'),
(6, 2, NULL, NULL, '2020-02-26', 'Narration Dilam', '0.00', '4000.00', '-14000.00', '-4000.00', '2020-02-26 03:15:40', '2020-02-26 03:15:40'),
(8, NULL, 1, 2, '2020-02-26', 'Narration Dilam', '3000.00', '0.00', '-11000.00', '-1000.00', '2020-02-26 03:24:38', '2020-02-26 03:24:38'),
(9, 3, NULL, NULL, '2020-02-26', 'Narration Dilam', '0.00', '4400.00', '-15400.00', '-4400.00', '2020-02-26 04:27:09', '2020-02-26 04:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `r_l_installments`
--

CREATE TABLE `r_l_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `rl_installment_date` date NOT NULL,
  `cash` tinyint(4) DEFAULT NULL,
  `cheque` tinyint(4) DEFAULT NULL,
  `total_received_loan_installment_amount` decimal(8,2) NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_l_installments`
--

INSERT INTO `r_l_installments` (`id`, `loan_id`, `rl_installment_date`, `cash`, `cheque`, `total_received_loan_installment_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-02-26', 1, NULL, '3000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 03:21:19', '2020-02-26 03:24:36');

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
  `location` tinyint(4) NOT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `salary_date`, `staff`, `cash`, `bank`, `cheque`, `total_salary_amount`, `narration`, `location`, `received_by`, `paid_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '2020-02-26', 25, 1, 0, 0, '1000.00', 'Narration Dilam', 1, 'Pichchi Hannan', 'Sunvy', 'Suhel Rana', '2020-02-26 02:28:07', '2020-02-26 02:32:01');

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
(3, 'aaNoormoy', 'Faisal', 'noormoy@gmail.com', '2019-08-06', '01682814443', '01912621193', 'sddfsdfsdf', '15455555555', '123456', 'O+', '/cosmosHoliday/uploadImage/staff/1565252410.jpeg', 7, '12345566', 3, 1, '2019-08-08', 20000.00, 'asdflkjj', '1531313', 'reafssdfasf', 'sdfasdf', '01215152', 'sfasdf', 'super-admin', '$2y$10$pMhp5m2k/zXzd.p13oxZiuFfj3wErGf.htSWd9kNe9wTlQ8xV7.rC', '1', '2019-08-08 02:20:11', '2020-02-16 23:37:56'),
(4, 'Nafees', 'Imtiaz', 'ticketcosmos04@gmail.com', '1988-12-01', '01778222804', '01778222804', '1097 East Shaqrapara, Miirpur, Dhaka, Bangladesh', '6855975451', '00000', 'B+', '/cosmosHoliday/uploadImage/staff/1581843875.jpeg', 19, '026', 3, 1, '2017-03-10', 9999.00, 'Saddid Rahman', '01712245469', 'Friend', 'Saddid Rahman', '01712245469', 'Friend', 'user', '$2y$10$Zwok4NE8aAcOWrRESmAgdOIRs3pHlVMS6tLXakZbhHHd1vIJCujp6', '1', '2019-11-25 00:06:48', '2020-02-16 03:04:35'),
(5, 'Rumman', 'Al Mahfuz', 'sales.cosmosbd@gmail.com', '1993-02-11', '01778889205', '01737352939', 'Bagan Bari, Mollikpur, Sunamganj, Sylet.', '19939028906000014', '000000', 'B-', '/cosmosHoliday/uploadImage/staff/1581843260.jpeg', 19, '015', 5, 1, '2019-02-02', 15000.00, 'Foysal Ahmed', '01723414408', 'Brother', 'Foysal Ahmed', '01723414408', 'Brother', 'user', '$2y$10$16tQAUF/Er1mvIYhTYFtuOFYxSyNs36aS/asJrA20ZXCCf5i9r9te', '1', '2020-02-16 02:54:22', '2020-02-16 02:54:22'),
(6, 'Md. Abu Nayem', 'Khan', 'cosmoseticket07@gmail.com', '1984-06-05', '01708808360', '01627091461', 'Jigatola Post Office , Dhanmondi , Dhaka, Bangladesh.', '4218454450997', '0000', 'B+', '/cosmosHoliday/uploadImage/staff/1581844567.jpeg', 19, '360', 3, 1, '2019-01-01', 12000.00, 'Md. Soaib Khan', '01712002462', 'Brother', 'Md. Soaib Khan', '01712002462', 'Brother', 'user', '$2y$10$p3QvWXl210DIbDqmEF7.Ru3QYkVi1it5vlf6olWDjLdbBZa630NyS', '1', '2020-02-16 03:16:07', '2020-02-16 03:16:07'),
(7, 'Aminur', 'Rahman', 'visa.cosmosholiday03@gmail.com', '1987-07-01', '01686247880', '01799787414', 'Paril,Singair, Manikgonj', '8668727848', '0000', 'B+', '/cosmosHoliday/uploadImage/staff/1581845349.jpeg', 19, '032', 4, 1, '2017-10-02', 13000.00, 'Jahangir Alam', '01630848599', 'Brother', 'Jahangir Alam', '01630848599', 'Brother', 'user', '$2y$10$OfI8jJZlant5H/kT.teOoukLVAboZlisJ4W/GXzAwcDXuqzZSorTy', '1', '2020-02-16 03:29:09', '2020-02-16 05:14:36'),
(8, 'Sharmin Sultana', 'Sara', 'cosmosholidayvisa001@gmail.com', '1991-10-26', '01708808377', '01676621148', 'House No-01,Road No-03, Mohammad Ali Bari , Bosila Garden City , Dhaka.', '4203583135', '000', 'A+', '/cosmosHoliday/uploadImage/staff/1581846189.jpeg', 19, '063', 4, 1, '2018-11-17', 15000.00, 'Al Mahmud Hasan', '01923585353', 'Husband', 'Nasreen Geeti', '01819020539', 'Sister', 'user', '$2y$10$p7xR0.xslHDpVvqatXvRB.5HFwCzmRJ9Yx6QwmIUrog2U1Xk/XzBq', '1', '2020-02-16 03:43:09', '2020-02-16 03:43:09'),
(9, 'Sabrina', 'Easmin', 'cosmosholidayvisa02@gmail.com', '1993-10-30', '01777435566', '01736370795', '47/48 Probal Housing ,Mohammadpur , Dhaka, Bangladesh.', '0000', '000', 'O+', '/cosmosHoliday/uploadImage/staff/1581846767.jpeg', 19, '084', 4, 1, '2019-06-10', 12000.00, 'Razu Ahmed', '01673722049', 'Brother', 'Parvin', '01921023635', 'Sister', 'user', '$2y$10$s14ZGWjlObw43Ao0TNP2a.Mk.gbOjwVbNqyahavPti0pJVWRFisUK', '1', '2020-02-16 03:52:47', '2020-02-16 03:52:47'),
(10, 'Kamruzzaman', 'Kajol', 'cosmosholiday05@gmail.com', '1994-11-15', '01708808368', '01635356494', 'Sardarpara, ulipur, Kurigram, Rangpur.', '8690625341', '000', 'O-', '/cosmosHoliday/uploadImage/staff/1581847398.jpeg', 19, '077', 4, 1, '2019-02-02', 14000.00, 'Abdur Rahim', '01743584644', 'Father', 'Abdur Rahim', '01743584644', 'Father', 'user', '$2y$10$q.JyZSUZff75kfVqp2gUQuCwoh602pzQbdOSbqgm9WFepxZMG528C', '1', '2020-02-16 04:03:18', '2020-02-16 04:03:18'),
(11, 'Md', 'Rabbi', 'rabbi01@gmail.com', '1997-01-01', '01779257826', '01313437894', 'Gopalpur , Konabari, Tangail.', '19979323803000055', '0', 'n/a', '/cosmosHoliday/uploadImage/staff/1581847893.jpeg', 4, '022', 4, 1, '2016-07-01', 12000.00, 'Md. Abu Hanif', '01782654216', 'Father', 'Md. Anwer hossain', '01714587419', 'Brother', 'user', '$2y$10$T8Cnyj3hIQMcebz7e5lwgOau8Z9zjXHRxudmombZEegyLNgPG1utO', '1', '2020-02-16 04:11:33', '2020-02-16 04:11:33'),
(12, 'Md. Zayed Hasan', 'Chowdhury', 'cosmosholidayvisa07@gmail.com', '1995-10-08', '01313437888', '01675688129', 'Fuldighi, Bogra sadar, Bogra.', '5075212927', 'BW0605367', 'A+', '/cosmosHoliday/uploadImage/staff/1581848428.jpeg', 19, '080', 4, 1, '2019-04-20', 9999.00, 'Nazma Chowdhury', '01727337012', 'Mother', 'Nazma Chowdhury', '01727337012', 'Mother', 'user', '$2y$10$vaJawFnn77fdYi4oXb01NuDDVESq31.jVifCbp.ISSySTWnwXkv/2', '1', '2020-02-16 04:20:28', '2020-02-16 04:20:28'),
(13, 'MD. Sojib', 'Ahmed', 'visa.cosmos02@gmail.com', '1997-01-27', '01749900604', '01747766662', 'Killa-Zuari, Boraigram, Natore.', '19976911547000188', 'BP0553544', 'B+', '/cosmosHoliday/uploadImage/staff/1581848764.jpeg', 19, '009', 4, 1, '2016-10-01', 9999.00, 'Sohel Rana', '01708808389', 'Brother', 'Sohel Rana', '01708808389', 'Brother', 'user', '$2y$10$61RQ8sZwvDgDliDmts16dO9rJFd3vIdgIMnaE1lMDkC4Ev0XRMB82', '1', '2020-02-16 04:26:04', '2020-02-16 04:26:04'),
(14, 'Marzia Ferdous', 'Tonny', 'tonnymarzia01@gmail.com', '1996-11-22', '01708808367', '01741922240', 'Purano Bus Stand , Kanaikhali. Natore.', '5988098181', '000', 'B+', '/cosmosHoliday/uploadImage/staff/1581849280.jpeg', 19, '000', 4, 1, '2019-10-24', 12000.00, 'Md. Mazidul Islam', '01713741488', 'Father', 'Dawdur Rahman', '01730704704', 'Brother', 'user', '$2y$10$9lQjKe/epbJhJssGkNpISOI5yHAbEhsRh9LCuUK67B8VJzSXiHXnK', '1', '2020-02-16 04:34:40', '2020-02-16 04:34:40'),
(15, 'Bipasha Akter', 'Jui', 'cosmosholiday01@gmail.com', '1993-08-01', '01708808385', '01722302311', 'Par-Naogaon,Rojakpur.Naogaon.', '1451383358', '000', 'A+', '/cosmosHoliday/uploadImage/staff/1581849867.jpeg', 19, '030', 4, 2, '2017-10-08', 17000.00, 'Sufia Bibi', '01753391306', 'Mother', 'Nahid Hasan', '01723525204', 'Brother', 'user', '$2y$10$3YHw53hZFRciYNqMSKEZG.91q7qu6WHZGRNWxhAfKqokZQAyTilIO', '1', '2020-02-16 04:44:28', '2020-02-16 04:44:28'),
(16, 'Zahid', 'Hossain', 'recosmosbd@gmail.com', '1995-03-28', '01778889141', '01683607939', 'House:168/c, Road: Green Road, Newmarket -1205,Dhanmondi, Dhaka.', '6874946194', '000', 'O+', '/cosmosHoliday/uploadImage/staff/1581850205.jpeg', 8, '006', 5, 1, '2017-04-01', 20000.00, 'Mr. Zakir Hossain', '01720279211', 'Father', 'Mr. Zakir Hossain', '01720279211', 'Father', 'user', '$2y$10$X5.N5fQWL6Ns04/IUxaTLeYFuJ0SKv8FFxh6NhRtBrJOJkNjKFq1y', '1', '2020-02-16 04:50:05', '2020-02-16 04:50:05'),
(17, 'Ayman Ahmed', 'Fahim', 'cosmosbd.sales6@gmail.com', '1996-09-17', '01708808374', '01870217651', '9/C. Horonath Ghosh Road, Lalbag-1212, Dhaka.', '9155229256', 'EA0740133', 'O+', '/cosmosHoliday/uploadImage/staff/1581850613.jpeg', 19, '066', 5, 1, '2018-07-01', 14000.00, 'Sinthia Rumpa', '01531763212', 'Wife', 'Md. Iqbal Ahmed', '01914898891', 'Father', 'user', '$2y$10$MfPruYx8LRzmVo8U.qqG4uVEo/zj2ZoVE4wTWFWIZXGQRG1kZFRPe', '1', '2020-02-16 04:56:53', '2020-02-16 04:56:53'),
(18, 'Rojlin', 'Rojario', 'info@cosmosholiday.com.bd', '1992-09-07', '01778119922', '0000', '02 no. Sonatonggor, Tenarimor, Jigatala,Dhaka.', '19922692534051518', '0000', 'A+', '/cosmosHoliday/uploadImage/staff/1581850943.jpeg', 13, '004', 5, 1, '2014-03-11', 40000.00, 'Ms.Sumitra Rojario', '01682512480', 'Mother', 'Ms.Sumitra Rojario', '01682512480', 'Mother', 'operation', '$2y$10$mngAuTOamB2SF6ZQLERO/OeIOA4JPho4X4ZFotbc95DxexNUGlceO', '1', '2020-02-16 05:02:23', '2020-03-01 22:44:06'),
(19, 'Sonia', 'Farzana', 'cosmosbd.sales3@gmail.com', '1993-10-24', '01708808373', '01701005264', '8/19, Kacharipara, Kushtia', '19935021505000030', 'BT0252885', '0+', '/cosmosHoliday/uploadImage/staff/1581851613.jpeg', 19, '036', 5, 1, '2017-10-01', 17000.00, 'Syed Shadmun Sakib', '01701005274', 'Husband', 'Mst Fahima Sultana', '01996491117', 'Mother', 'user', '$2y$10$FKN.VBBNMRdmdmGkTRC97OoLKNsxAo6ZjY2/HYrrfftM74G5QcnS.', '1', '2020-02-16 05:13:33', '2020-02-16 05:13:33'),
(20, 'Sharmin Akter', 'Dola', 'cosmosholidaybd@gmail.com', '1995-10-20', '01708808375', '01764681141', 'Otra, Uzirpur, Barisal', '1945151379', '000', 'O+', '/cosmosHoliday/uploadImage/staff/1581852233.jpeg', 19, '053', 5, 1, '2018-03-10', 17000.00, 'Mr. Ariful Islam', '01740370294', 'Husband', 'Mr. Ariful Islam', '01740370294', 'Husband', 'user', '$2y$10$1elAzrzc2GEFj5EacMozfOfyud4FBD7LFv.Bu9sTsNGOtd0TsAQve', '1', '2020-02-16 05:23:53', '2020-02-16 05:23:53'),
(21, 'Tumpa Afrin', 'Dola', 'cosmosbd.sales2@gmail.com', '1997-12-16', '01708808372', '01780923058', 'Bosila, Mohammadpur.', '0000', 'N/A', 'O+', '/cosmosHoliday/uploadImage/staff/1581852560.jpeg', 19, '035', 5, 1, '2017-10-02', 14500.00, 'Nishi', '01956148383', 'Elder Sister', 'Nishi', '01956148383', 'Elder Sister', 'user', '$2y$10$8rAs8A9NXawTSOeLqeOL6Ov4NmAwJVZJnR04wLFG5BW7zP9WZadx6', '1', '2020-02-16 05:29:20', '2020-02-16 05:29:20'),
(22, 'Kazi Umme Tabassum', 'Islam', 'tabassum81115@gmail.com', '1997-11-15', '01629211125', '01730306879', '1/D, 4/25, Mirpur-1, Dhaka.', '9152250115', 'BX0938294', 'B+', '/cosmosHoliday/uploadImage/staff/1581852856.jpeg', 19, '050', 5, 1, '2018-03-10', 17000.00, 'Kazi Eshtekharul Islam', '01730306879', 'Brother', 'Rozina Islam', '01683973787', 'Mother', 'user', '$2y$10$XOEoI5Dn6SvP4UiL3Eudtu.ByLbCVaPyEjA5MnRNa9CKkGmsZ86hO', '1', '2020-02-16 05:34:16', '2020-02-16 05:34:16'),
(23, 'Jamila Khandokar', 'Toma', 'cosmosbd.sales1@gmail.com', '1993-12-05', '01708808371', '01779577539', '#234, Shahid Nagar, #3 Road, Lalbagh.', '7319748096', 'N/A', 'O+', '/cosmosHoliday/uploadImage/staff/1581853136.jpeg', 19, '073', 5, 1, '2019-01-10', 15000.00, 'Topon Khandokar', '01718270065', 'Father', 'Jerin Khandokar', '01675953090', 'Sister', 'user', '$2y$10$3sswNMoepHOp9aowJ4KvYOHZ94FeC4PxfkyTY4IopmGFiBAuKmk6C', '1', '2020-02-16 05:38:56', '2020-02-16 05:38:56'),
(24, 'Shahera', 'Khatun', 'cosmosbd.sales8@gmail.com', '1990-12-24', '01708808378', '01994782987', '#616 Manikde Bazar, Dhaka-Cant: , Dhaka-1206', '19902690815000439', 'N/A', 'N/A', '/cosmosHoliday/uploadImage/staff/1581853494.jpeg', 19, '074', 5, 1, '2019-01-15', 15000.00, 'Razia Solaiman', '01749416820', 'Mother', 'Md. Solaiman', '01843065866', 'Father', 'user', '$2y$10$4cjxCXx7kAvHY4jjUtP4t.HpcmJAwmVB.PLYnjatwbqoOrmxepftu', '1', '2020-02-16 05:44:54', '2020-02-16 05:44:54'),
(25, 'Afroza', 'Akter', 'cosmosbd.sales4@gmail.com', '1989-10-20', '01708808370', '019045112379', '43/A, Sukrabad, Dhaka-1207', '5072525628', '000', 'O+', '/cosmosHoliday/uploadImage/staff/1581854037.jpeg', 19, '065', 5, 1, '2018-10-01', 14500.00, 'Farzana Akter', '01939378190', 'sister', 'Farzana Akter', '01939378190', 'sister', 'user', '$2y$10$arMnAruQqtMAt7BC2bvZseH4YU/q8w38vCvP7c9tBATCcdpnZLFfm', '1', '2020-02-16 05:53:57', '2020-02-16 05:53:57'),
(26, 'Md. Masudur', 'Rahman', 'eticketcosmos3@gmail.com', '1982-01-10', '01708808361', '01732461062', 'Savar Bus Stand, Savar, Dhaka.', '2693624772708', 'EB0161313', 'A+', '/cosmosHoliday/uploadImage/staff/1581854360.jpeg', 19, '028', 3, 1, '2017-10-01', 17000.00, 'Marufa Yesmin Shumi', '01984781939', 'Wife', 'Marufa Yesmin Shumi', '01984781939', 'Wife', 'user', '$2y$10$3qVm3PYgd0tgIw7VsZH.C.PN3W1FrcjFgd0Pt8EJcLMHjYTm0tb/6', '1', '2020-02-16 05:59:20', '2020-02-16 05:59:20'),
(27, 'Abdul', 'Baten', 'visa.cosmosbd@gmail.com', '1986-01-02', '01778222976', '01817533163', 'Paril imam Para, Paril Nowadha, Singair, Manikgong.', '1009279678', '000', 'O+', '/cosmosHoliday/uploadImage/staff/1581854682.jpeg', 7, '010', 4, 1, '2016-06-01', 17000.00, 'Abu Bokor', '01710850692', 'Father', 'Suborna Yeasmin', '01670117616', 'Wife', 'user', '$2y$10$uDZj60spWE8Omqcfv9mYBezYql9Os4m4asRclHbtDX5R.bWpwMd1O', '1', '2020-02-16 06:04:42', '2020-02-16 06:04:42'),
(28, 'Mst. Sabera Islam', 'Borsha', 'visa.cosmosholiday@gmail.com', '1985-10-27', '01778222669', '01960168565', 'Holding-35, Gorchapra, Munshigonj, Alamdanga, Chuadanga.', '19851018556653710', '000', 'B+', '/cosmosHoliday/uploadImage/staff/1581855090.jpeg', 7, '017', 4, 1, '2017-09-01', 23000.00, 'Md. Darul Islam', '01970969315', 'Father', 'Md.Shahjir Ahmed', '01920696171', 'Brother', 'operation', '$2y$10$WWG/O1Pl6iwNlWGxw2eogOmCnQOwDJDUYQwILq9clES7eT8UEv3Z.', '1', '2020-02-16 06:11:30', '2020-03-01 05:15:24'),
(29, 'Md. Azizul Islam', 'Sujon', 'visa.cosmos01@gmail.com', '1998-06-15', '01738385642', '01780722873', 'Nababganj, Joldhaka, Nilphamari.', '330447737', '000', 'O-', '/cosmosHoliday/uploadImage/staff/1581855397.jpeg', 19, '020', 4, 1, '2016-12-10', 15000.00, 'Md. Niruzzaman', '01710822307', 'Brother', 'Mrs. Moyna', '01302842557', 'Sister', 'user', '$2y$10$cQpy5PjTewaKfobED9O6fuW5ehz7DR.fxMYCg6o9ZK9OHNJFxBj6W', '1', '2020-02-16 06:16:37', '2020-02-16 06:16:37'),
(30, 'Sharmin Reza', 'Shampa', 'sharminshampa02@gmail.com', '1995-03-09', '01983321663', '000', 'Khanderpur , Goripur , Mymansingh.', '0000', '00', 'O+', '/cosmosHoliday/uploadImage/staff/1581855792.jpeg', 19, '031', 4, 1, '2017-10-02', 12500.00, 'Asaduzzaman shalim', '01967124856', 'Father', 'Alaya Begum', '01937926951', 'Mother', 'user', '$2y$10$WJaZi.PbPg7HGVGxeM8T5u91bpLKAcNjAQPpx0Jl1v0gaYCse371W', '1', '2020-02-16 06:23:12', '2020-02-16 06:23:12'),
(31, 'Asif Ahmed', 'Zaman', 'cosmosholidayvisa@gmail.com', '1994-12-07', '01677331281', '000', '1092, Haji Fajlur Rahman sarak, Khilbabirtek, Vatara, Gulshan , Dhaka-1212', '6892259760', 'EF0073044', 'A+', '/cosmosHoliday/uploadImage/staff/1581856131.jpeg', 19, '048', 4, 1, '2018-02-22', 15000.00, 'Md. Akramuzzaman', '01718722893', 'Father', 'Abir Ahmed Zaman', '01912045510', 'Brother', 'user', '$2y$10$JV22//cf8tuKP1ud8nlrduinlDasykBWgYShA6hT/aDDVVWOEf07y', '1', '2020-02-16 06:28:51', '2020-02-16 06:28:51'),
(32, 'Md.Wahidur Rahman', 'Tonmoy', 'eticketcosmos02@gmail.com', '1990-02-07', '01778222203', '01923171651', '13/1, Palashpur, East Dania, Dhaka.', '1991263235000496', '123456', 'A+', '/cosmosHoliday/uploadImage/staff/1581856474.jpeg', 5, '013', 3, 1, '2014-12-10', 20000.00, 'Tushar', '01670959656', 'Brother', 'Mahamudun Nesha', '01922424384', 'Wife', 'operation', '$2y$10$TUxTsKziI6La3RrNiZ5ogeFXJuCTSFYsRE5b56vz8Vmre8cBa39lu', '1', '2020-02-16 06:34:34', '2020-03-01 00:47:46'),
(33, 'Saddam Hossain', 'Bappy', 'cosmosholidayvisa06@gmail.com', '1996-05-10', '01708808386', '01619770930', 'New Market, Sherpur Town, Sherpur .', '7338790996', 'BJ0739587', 'B+', '/cosmosHoliday/uploadImage/staff/1581856771.jpeg', 19, '000', 4, 2, '2019-08-17', 12000.00, 'Deluar Hossain', '01716770930', 'Father', 'Fuad Chowdhury', '01618346182', 'Friend', 'user', '$2y$10$/n3DyjkDYB8GpVb34l8nqOn5hZyLBwxuBVcXS2MpHIcyIwVZ6F5iS', '1', '2020-02-16 06:39:31', '2020-02-16 06:39:31'),
(34, 'Md. Sohel', 'Rana', 'acc.cosmosbd@gmail.com', '1992-04-08', '01708808389', '01723106199', 'Bildahar Bazar, Singra, Natore.', '3713919243', '0', 'O+', '/cosmosHoliday/uploadImage/staff/1581915772.jpeg', 6, '012', 6, 2, '2017-02-01', 25000.00, 'Md. Buddu Sheikh', '01797931486', 'Father', 'Mr. Robin Ahmed', '01781481629', 'Brother', 'operation', '$2y$10$aR4kQ3ZnBPU7fKuSVsT8D.L3WFLldPOhUQTtk4BM.hNoqgXNecuR.', '1', '2020-02-16 06:47:55', '2020-03-02 02:19:20');

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
(3, 'manager', 'Manager', '2019-07-31 22:18:17', '2020-02-16 02:36:10'),
(4, 'asst-visa-officer', 'Asst. Visa Officer', '2019-08-01 05:23:20', '2020-02-16 02:37:47'),
(5, 'reservation-officer', 'Reservation Officer', '2019-08-01 05:23:30', '2020-02-16 02:37:32'),
(6, 'account-officer', 'Account Officer', '2019-08-01 05:23:45', '2020-02-16 02:37:07'),
(7, 'senior-executive', 'Senior Executive', '2019-08-01 05:23:59', '2020-02-16 02:36:55'),
(8, 'executive-officer', 'Executive officer', '2019-08-06 00:17:55', '2020-02-16 02:36:36'),
(13, 'asst-manager', 'Asst. Manager', '2019-09-02 03:51:43', '2020-02-16 02:36:24'),
(14, 'asst-accounts-officer', 'Asst. Accounts Officer', '2020-02-16 02:38:03', '2020-02-16 02:38:03'),
(15, 'jr-visa-officer', 'Jr. Visa officer', '2020-02-16 02:38:27', '2020-02-16 02:39:54'),
(16, 'junior-sales-officer', 'Junior Sales Officer', '2020-02-16 02:38:41', '2020-02-16 02:38:41'),
(17, 'sroffice-assistant', 'Sr.Office Assistant', '2020-02-16 02:39:10', '2020-02-16 02:39:10'),
(18, 'jroffice-assistant', 'Jr.Office Assistant', '2020-02-16 02:39:22', '2020-02-16 02:39:22'),
(19, 'jr-executive-officer', 'Jr. Executive officer', '2020-02-16 02:43:41', '2020-02-16 02:43:41');

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
  `refund` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_airtickets`
--

INSERT INTO `sub_airtickets` (`id`, `airticket_id`, `issue_date`, `departure_date`, `return_date`, `air_lines`, `pnr`, `sector`, `net_price`, `price`, `suplier`, `refund`, `created_at`, `updated_at`) VALUES
(93, 10, '2020-02-12', '2020-02-19', '2020-02-20', 3, 'sfjkasjkldf', 'Dhaka-kalkata-Dhaka', '1500.00', '2000.00', 1, 1, '2020-02-27 04:01:09', '2020-02-29 22:36:03');

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
  `air_ticket_refund_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci,
  `debit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `credit_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(8,2) NOT NULL,
  `suplier_balance` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suplier_transactions`
--

INSERT INTO `suplier_transactions` (`id`, `suplier_id`, `air_id`, `pack_id`, `visa_id`, `hotel_id`, `debit_voucher_id`, `air_ticket_refund_id`, `transaction_date`, `narration`, `debit_amount`, `credit_amount`, `balance`, `suplier_balance`, `created_at`, `updated_at`) VALUES
(114, 1, 90, NULL, NULL, NULL, NULL, NULL, '2020-02-11', 'Dhaka-kalkata-Dhaka', '0.00', '2500.00', '-6500.00', '-2500.00', '2020-02-11 05:21:00', '2020-02-19 06:45:57'),
(115, 1, 91, NULL, NULL, NULL, NULL, NULL, '2020-02-11', 'Dhaka-kalkata-Dhaka update', '0.00', '3000.00', '-9500.00', '-5500.00', '2020-02-11 05:21:01', '2020-02-19 06:45:57'),
(123, 1, NULL, NULL, NULL, 8, NULL, NULL, '2020-02-13', 'sdfasd', '0.00', '3550.00', '-21193.00', '-14570.00', '2020-02-11 23:16:09', '2020-03-01 05:46:05'),
(124, 1, NULL, NULL, NULL, 9, NULL, NULL, '2020-02-12', 'sdfasd', '0.00', '2520.00', '-12020.00', '-8020.00', '2020-02-11 23:16:09', '2020-02-19 06:45:57'),
(161, 1, NULL, 4, NULL, NULL, NULL, NULL, '2020-02-18', 'Package Net Price P-4', '0.00', '300.00', '-22993.00', '-14870.00', '2020-02-13 03:36:18', '2020-03-01 05:46:05'),
(171, 1, NULL, 5, NULL, NULL, NULL, NULL, '2020-02-29', 'Package Net Price P-5', '0.00', '600.00', '-28093.00', '-15970.00', '2020-02-19 05:56:04', '2020-03-01 05:46:05'),
(172, 2, NULL, 5, NULL, NULL, NULL, NULL, '2020-02-12', 'Package Net Price P-5', '0.00', '123.00', '-12143.00', '-4123.00', '2020-02-19 06:31:37', '2020-03-01 05:46:03'),
(173, 1, NULL, 4, NULL, NULL, NULL, NULL, '2020-02-19', 'Package Net Price P-4', '0.00', '5000.00', '-27993.00', '-19870.00', '2020-02-19 06:43:46', '2020-03-01 05:46:05'),
(174, 2, NULL, 4, NULL, NULL, NULL, NULL, '2020-02-13', 'Package Net Price P-4', '0.00', '1500.00', '-22693.00', '-8123.00', '2020-02-19 06:44:47', '2020-03-01 05:46:05'),
(175, 2, NULL, 4, NULL, NULL, NULL, NULL, '2020-02-07', 'Package Net Price P-4', '0.00', '4000.00', '-4000.00', '-4000.00', '2020-02-19 06:45:57', '2020-02-19 06:45:57'),
(176, 3, NULL, 4, NULL, NULL, NULL, NULL, '2020-02-26', 'Package Net Price P-4', '0.00', '4000.00', '-27993.00', '-4000.00', '2020-02-19 22:28:30', '2020-03-01 05:46:05'),
(177, 1, NULL, NULL, NULL, NULL, 4, NULL, '2020-02-21', 'Narration Dilam shohel vai dekhte chaise..', '2000.00', '0.00', '-25993.00', '-17870.00', '2020-02-23 03:33:30', '2020-03-01 05:46:05'),
(180, 1, NULL, NULL, NULL, NULL, NULL, 7, '2020-03-01', 'This sfjkasjkldk (A-91) Refunded', '1000.00', '0.00', '-27093.00', '-14970.00', '2020-02-25 02:54:41', '2020-03-01 05:46:05'),
(182, 1, NULL, NULL, NULL, NULL, NULL, 8, '2020-02-25', 'This sfjkasjkldf (A-90) Refunded', '2000.00', '0.00', '-23993.00', '-15870.00', '2020-02-25 03:00:40', '2020-03-01 05:46:05'),
(183, 1, NULL, NULL, NULL, NULL, 1, NULL, '2020-02-26', 'Narration Dilam', '2000.00', '0.00', '-25993.00', '-13870.00', '2020-02-25 23:00:43', '2020-03-01 05:46:05'),
(185, 1, NULL, NULL, NULL, NULL, 2, NULL, '2020-03-02', 'Narration Dilam', '4000.00', '0.00', '-22593.00', '-10470.00', '2020-02-25 23:12:51', '2020-03-01 05:47:41'),
(186, 1, 92, NULL, NULL, NULL, NULL, NULL, '2020-02-27', 'sfre', '0.00', '1500.00', '-27493.00', '-15370.00', '2020-02-27 03:56:11', '2020-03-01 05:46:05'),
(187, 1, 93, NULL, NULL, NULL, NULL, NULL, '2020-02-12', 'Dhaka-kalkata-Dhaka', '0.00', '1500.00', '-13643.00', '-9520.00', '2020-02-27 04:01:09', '2020-03-01 05:46:03'),
(188, 1, NULL, NULL, NULL, NULL, NULL, 9, '2020-03-01', 'This sfjkasjkldf (A-93) Refunded', '2000.00', '0.00', '-25093.00', '-12970.00', '2020-02-29 22:36:03', '2020-03-01 05:46:05'),
(190, 1, NULL, NULL, 32, NULL, NULL, NULL, '2020-02-12', 'Narration Dilam', '0.00', '1500.00', '-15143.00', '-11020.00', '2020-03-01 05:46:04', '2020-03-01 05:46:04'),
(191, 2, NULL, NULL, 33, NULL, NULL, NULL, '2020-02-12', 'Narration Dilam', '0.00', '2500.00', '-17643.00', '-6623.00', '2020-03-01 05:46:05', '2020-03-01 05:46:05'),
(193, 1, NULL, NULL, 35, NULL, NULL, NULL, '2020-03-01', 'Narration Dilam', '0.00', '1500.00', '-26593.00', '-14470.00', '2020-03-01 05:47:41', '2020-03-01 05:47:41'),
(196, 1, NULL, 6, NULL, NULL, NULL, NULL, '2020-03-18', 'Package Net Price P-6', '0.00', '2500.00', '-25093.00', '-12970.00', '2020-03-02 00:41:10', '2020-03-02 00:41:10');

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

--
-- Dumping data for table `transjactions`
--

INSERT INTO `transjactions` (`id`, `guest_id`, `staff_id`, `air_id`, `pack_id`, `visa_id`, `hotel_id`, `received_id`, `discount_id`, `transjaction_date`, `narration`, `debit_amount`, `credit_amount`, `blance`, `guest_blance`, `staff_blance`, `created_at`, `updated_at`) VALUES
(144, 3, 25, NULL, NULL, NULL, NULL, 87, NULL, '2020-02-25', 'Narration Dilam', '0.00', '5000.00', '-5000.00', '-5000.00', '-5000.00', '2020-02-25 22:38:08', '2020-02-25 22:38:08'),
(145, 6, 23, NULL, NULL, NULL, NULL, 88, NULL, '2020-02-26', 'Narration Dilam', '0.00', '3300.00', '-8300.00', '-3300.00', '-3300.00', '2020-02-26 04:24:52', '2020-02-26 04:24:52'),
(146, 3, 3, 10, NULL, NULL, NULL, NULL, NULL, '2020-02-27', 'Narration Dilam', '2000.00', '0.00', '-6300.00', '-3000.00', '2000.00', '2020-02-27 04:01:09', '2020-02-27 04:01:09'),
(149, 3, 3, NULL, NULL, 7, NULL, NULL, NULL, '2020-03-01', 'invoice narration', '2500.00', '0.00', '-3800.00', '-500.00', '4500.00', '2020-03-01 05:47:41', '2020-03-01 05:47:41'),
(155, 3, 18, NULL, 6, NULL, NULL, NULL, NULL, '2020-03-02', 'Narrartion', '30000.00', '0.00', '26200.00', '29500.00', '30000.00', '2020-03-02 00:41:11', '2020-03-02 00:41:11');

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
  `print` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_updateds`
--

INSERT INTO `visa_updateds` (`id`, `urgent_qty`, `urgent_price`, `online_visa_qty`, `online_visa_price`, `notary_qty`, `notary_price`, `invitation_letter_qty`, `invitation_letter_price`, `land_valuation_qty`, `land_valuation_price`, `lawyer_qty`, `lawyer_price`, `total_net_price`, `total_price`, `total_others_price`, `grand_total_price`, `received_date`, `client`, `sell_person`, `invoice_narration`, `special_note`, `state`, `work_by`, `work_date`, `notary_by`, `notary_date`, `checked_by_asst`, `checked_by_asst_date`, `checked_by_officer`, `checked_by_officer_date`, `submit_by`, `submit_date`, `collected_by`, `collected_date`, `call_and_sms_by`, `call_and_sms_date`, `delevered_by`, `delevered_date`, `print`, `created_at`, `updated_at`) VALUES
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1500.00', '2500.00', '0.00', '2500.00', '2020-03-12', 3, 28, 'invoice narration', 'asdfasdf', 5, 11, '2020-03-26', 29, '2020-03-24', 30, '2020-03-18', 31, '2020-03-19', 11, '2020-03-25', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-03-01 05:17:40', '2020-03-01 05:47:51');

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
-- Indexes for table `air_ticket_refunds`
--
ALTER TABLE `air_ticket_refunds`
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
-- Indexes for table `payment_loans`
--
ALTER TABLE `payment_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_loan_transactions`
--
ALTER TABLE `payment_loan_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profits`
--
ALTER TABLE `profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_l_installments`
--
ALTER TABLE `p_l_installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `received_loans`
--
ALTER TABLE `received_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `received_loan_transactions`
--
ALTER TABLE `received_loan_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_l_installments`
--
ALTER TABLE `r_l_installments`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `airtickets`
--
ALTER TABLE `airtickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `air_lines`
--
ALTER TABLE `air_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `air_ticket_refunds`
--
ALTER TABLE `air_ticket_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_books`
--
ALTER TABLE `bank_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cash_books`
--
ALTER TABLE `cash_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `cheque_books`
--
ALTER TABLE `cheque_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contras`
--
ALTER TABLE `contras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `follow_u_p_to_supliers`
--
ALTER TABLE `follow_u_p_to_supliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `incentives`
--
ALTER TABLE `incentives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `money_receiveds`
--
ALTER TABLE `money_receiveds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_days`
--
ALTER TABLE `package_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `package_net_prices`
--
ALTER TABLE `package_net_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `package_supliers`
--
ALTER TABLE `package_supliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passports`
--
ALTER TABLE `passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `paxes`
--
ALTER TABLE `paxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_loans`
--
ALTER TABLE `payment_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_loan_transactions`
--
ALTER TABLE `payment_loan_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profits`
--
ALTER TABLE `profits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `p_l_installments`
--
ALTER TABLE `p_l_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `received_loans`
--
ALTER TABLE `received_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `received_loan_transactions`
--
ALTER TABLE `received_loan_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `r_l_installments`
--
ALTER TABLE `r_l_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sub_airtickets`
--
ALTER TABLE `sub_airtickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `suplier_transactions`
--
ALTER TABLE `suplier_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `transjactions`
--
ALTER TABLE `transjactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
