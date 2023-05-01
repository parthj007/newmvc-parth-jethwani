-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 01:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmvc-parth-jethwani`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(11) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(30, 'bhargav.cybercom@gmail.com', '123', 2, '2023-04-27 09:39:26', NULL),
(31, 'rohan@gmail.com', 'abc123', 2, '2023-04-30 10:32:11', '2023-04-30 10:32:49'),
(32, 'parth@gmail.com', '456654', 2, '2023-04-30 10:32:28', '2023-04-30 10:33:01'),
(37, 'admin@gmail.com', '12321321', 1, '2023-04-30 10:48:21', NULL),
(38, 'bhargav123.cybercom@gmail.com', '123', 2, '2023-05-01 11:47:57', NULL),
(39, 'rohan123@gmail.com', 'abc123', 2, '2023-05-01 11:47:57', NULL),
(40, 'parth123@gmail.com', '456654', 2, '2023-05-01 11:47:57', NULL),
(41, 'admin123@gmail.com', '12321321', 1, '2023-05-01 11:47:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(4, 'abcd', '321311', NULL, '2023-04-25 18:01:46', NULL),
(5, '', '', NULL, '2023-04-26 14:40:27', NULL),
(6, '', '', NULL, '2023-04-26 14:40:30', NULL),
(7, '', '', NULL, '2023-04-26 14:40:32', NULL),
(8, '', '', NULL, '2023-04-26 14:40:35', NULL),
(9, '', '', NULL, '2023-04-26 14:40:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `shipping_method_id` int NOT NULL,
  `shipping_amount` decimal(10,2) NOT NULL,
  `tax_percent` int NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `item_id` int NOT NULL,
  `product_id` int NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `parent_id` int NOT NULL DEFAULT '1',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `path`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, '1', 'Root', '2', '', '2023-04-02 19:26:27', NULL),
(36, 1, '1=36', 'Sports', '2', '', '2023-04-30 10:42:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_decimal`
--

CREATE TABLE `category_decimal` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_int`
--

CREATE TABLE `category_int` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_varchar`
--

CREATE TABLE `category_varchar` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint NOT NULL,
  `gender` enum('1','2') NOT NULL,
  `status` enum('1','2') NOT NULL,
  `shipping_address_id` int DEFAULT NULL,
  `billing_address_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `attribute_id` int NOT NULL,
  `entity_type_id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `backend_type` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `backend_model` varchar(255) NOT NULL,
  `input_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `backend_model`, `input_type`) VALUES
(55, 6, 'company', 'varchar', 'Company', 1, '', 'textbox'),
(64, 1, 'gender', 'int', 'Gender', 1, '', 'radio');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

CREATE TABLE `eav_attribute_option` (
  `option_id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `attribute_id` int NOT NULL,
  `position` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`) VALUES
(136, 'male', 64, 1),
(137, 'female', 64, 2);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entity_type_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `entity_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'category', ''),
(3, 'customer', ''),
(4, 'vendor', ''),
(5, 'salesman', ''),
(6, 'item', '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(46, 'item98', 1, '2023-04-18 13:07:24', '2023-04-19 01:27:05'),
(48, 'abc', 1, '2023-04-18 19:46:58', '2023-04-19 00:01:26'),
(51, 'abc123', 1, '2023-04-19 00:09:29', '2023-04-19 00:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `item_datetime`
--

CREATE TABLE `item_datetime` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_decimal`
--

CREATE TABLE `item_decimal` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_int`
--

CREATE TABLE `item_int` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_text`
--

CREATE TABLE `item_text` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_varchar`
--

CREATE TABLE `item_varchar` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_varchar`
--

INSERT INTO `item_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(45, 51, 55, 'esparkbiz'),
(69, 46, 55, '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(126, 'net banking', '2', '2023-04-24 10:22:36', NULL),
(128, 'debit card', '2', '2023-04-24 10:23:06', NULL),
(129, 'credit card', '2', '2023-04-24 10:23:16', NULL),
(130, 'UPI', '2', '2023-04-24 14:30:40', '2023-04-24 14:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT '100',
  `status` enum('1','2') NOT NULL,
  `base_id` int DEFAULT NULL,
  `small_id` int DEFAULT NULL,
  `thumb_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `status`, `base_id`, `small_id`, `thumb_id`, `created_at`, `updated_at`) VALUES
(77, 'abc', '132', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(90, 'abcd', 'abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(93, 'abcde', '1abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(94, 'abcdf', '2abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(95, 'abcdg', '3abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(96, 'abcdh', '4abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(97, 'abcdi', '5abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(98, 'abcdj', '6abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(99, 'abcdk', '7abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(100, 'abcdl', '8abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(101, 'abcdm', '9abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(102, 'abcdn', '10abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(103, 'abcdo', '11abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(104, 'abcdp', '12abc123', '654.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(105, 'abcdq', '13abc123', '555555.00', '654.00', 100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL),
(155, 'bhargav', '14abc123', '654.00', '654.00', 111100, '1', NULL, NULL, NULL, '2023-04-30 13:15:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_decimal`
--

CREATE TABLE `product_decimal` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_int`
--

CREATE TABLE `product_int` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `media_id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gallery` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_text`
--

CREATE TABLE `product_text` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_varchar`
--

CREATE TABLE `product_varchar` (
  `value_id` int NOT NULL,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `quote_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `shipping_method_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quote_billing_id` int DEFAULT NULL,
  `quote_shipping_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`quote_id`, `customer_id`, `total`, `status`, `payment_method_id`, `shipping_method_id`, `created_at`, `updated_at`, `quote_billing_id`, `quote_shipping_id`) VALUES
(16, 136, NULL, NULL, 128, 28, '2023-04-20 12:38:44', NULL, 22, 23),
(17, 143, NULL, NULL, 126, 20, '2023-04-20 12:38:47', NULL, 18, 19),
(18, 144, NULL, NULL, 122, 12, '2023-04-20 12:38:53', NULL, 20, 21),
(19, 145, NULL, NULL, 124, NULL, '2023-04-20 15:05:06', NULL, 24, 25),
(20, 146, NULL, NULL, 126, 18, '2023-04-20 23:47:26', NULL, 26, 27),
(21, 148, NULL, NULL, NULL, NULL, '2023-05-01 10:04:37', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quote_address`
--

CREATE TABLE `quote_address` (
  `address_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote_address`
--

INSERT INTO `quote_address` (`address_id`, `customer_id`, `address`, `city`, `zipcode`, `state`, `country`, `created_at`, `updated_at`) VALUES
(18, 143, 'abcabc8777', 'amreli', '98988', 'gujarat', 'india', '2023-04-20 22:45:59', NULL),
(19, 143, 'abcabc8777', 'amreli', '98988', 'gujarat', 'india', '2023-04-20 22:45:59', NULL),
(20, 144, 'abc', 'Ahmedabad', '878787', 'Gujarat', 'India', '2023-04-20 22:51:57', '2023-04-20 22:52:39'),
(21, 144, 'abc', 'Ahmedabad', '878787', 'Gujarat', 'India', '2023-04-20 22:51:57', '2023-04-20 22:52:39'),
(22, 136, '833, Gunatitnagar Society, \r\nMahila College', 'Ahmedabad', '878787', 'Gujarat', 'India', '2023-04-20 22:55:31', '2023-04-20 22:56:32'),
(23, 136, 'The First, next to ITC narmada', 'Ahmedabad', '878787', 'Gujarat', 'India', '2023-04-20 22:55:31', '2023-04-20 22:56:32'),
(24, 145, 'The First, next to ITC narmada', 'Ahmedabad', '878787', 'Gujarat', 'India', '2023-04-20 23:09:32', '2023-04-20 23:27:29'),
(25, 145, '', '', '', '', '', '2023-04-20 23:09:33', '2023-04-20 23:27:29'),
(26, 146, '833, Gunatitnagar Society, \r\nMahila College', 'Bhavnagar', '364001', 'Gujarat', 'India', '2023-04-20 23:47:48', '2023-04-21 09:51:39'),
(27, 146, '833, Gunatitnagar Society, \r\nMahila College', 'Bhavnagar', '364001', 'Gujarat', 'India', '2023-04-20 23:47:48', '2023-04-21 09:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'abc@gmai.com',
  `gender` enum('1','2') NOT NULL,
  `mobile` bigint NOT NULL,
  `status` enum('1','2') NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `fname`, `lname`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(23, 'thor', 'ragnarok', 's2@gmail.com', '1', 8787878787, '1', 'cybercom', '2023-04-19 14:20:28', '2023-04-24 14:41:56'),
(24, 'abcd', 'abcd', 'acbd@gmail.com', '1', 8787878787, '2', '', '2023-04-24 14:42:35', NULL),
(25, 'Xyz', 'xyz', 'xyz@gmail.com', '1', 9999999999, '2', 'Motadata', '2023-05-01 02:02:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int NOT NULL,
  `salesman_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `salesman_id`, `address`, `city`, `zipcode`, `state`, `country`) VALUES
(16, 23, 'abc123', 'abc', '456654', 'abcabc', 'abcabc'),
(17, 24, '', '', '', '', ''),
(18, 25, 'The Second, next to ITC narmada', 'Ahmedabad', '878787', 'Gujarat', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int NOT NULL,
  `salesman_id` int NOT NULL,
  `product_id` int NOT NULL,
  `salesman_price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`) VALUES
(50, 23, 94, 465),
(102, 24, 95, 66),
(110, 23, 77, 7888),
(122, 24, 93, 99),
(123, 25, 77, 777);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `method_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(28, 'ABCD', '32354654.00', '2', '2023-04-27 01:06:49', '2023-04-27 01:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint DEFAULT NULL,
  `gender` enum('1','2') DEFAULT NULL,
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `fname`, `lname`, `email`, `mobile`, `gender`, `status`, `company`, `created_at`, `updated_at`) VALUES
(69, 'Bhargav', 'Gohel', 'bhargav.cybercom@gmail.com', 8460595238, '1', '2', '', '2023-04-30 11:11:28', NULL),
(70, 'abc', 'xyz', 'abab@cdcd', 9898989898, '1', '2', 'Cybercom', '2023-04-30 11:11:34', NULL),
(71, 'Bhargav', 'Gohel', 'bhargav.cybercom@gmail.com', 8460595238, '1', '2', '', '2023-04-30 11:11:39', NULL),
(72, 'abc', 'xyz', 'abab@cdcd', 9898989898, '1', '2', 'Cybercom', '2023-04-30 11:11:44', NULL),
(73, 'Bhargav', 'Gohel', 'bhargav.cybercom@gmail.com', 8460595238, '1', '2', '', '2023-04-30 11:11:49', NULL),
(74, 'abc', 'xyz', 'abab@cdcd', 9898989898, '1', '2', 'Cybercom', '2023-04-30 11:11:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` bigint DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `zipcode`, `state`, `country`) VALUES
(46, 69, '833, Gunatitnagar Society, \r\nMahila College', 'Bhavnagar', 364001, 'Gujarat', 'India'),
(47, 70, 'The First, next to ITC narmada', 'Ahmedabad', 878787, 'Gujarat', 'India'),
(48, 71, '833, Gunatitnagar Society, \r\nMahila College', 'Bhavnagar', 364001, 'Gujarat', 'India'),
(49, 72, 'The First, next to ITC narmada', 'Ahmedabad', 878787, 'Gujarat', 'India'),
(50, 73, '833, Gunatitnagar Society, \r\nMahila College', 'Bhavnagar', 364001, 'Gujarat', 'India'),
(51, 74, 'The First, next to ITC narmada', 'Ahmedabad', 878787, 'Gujarat', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `category_int`
--
ALTER TABLE `category_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `category_int_ibfk_1` (`attribute_id`);

--
-- Indexes for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `entity_id` (`entity_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `shipping_address_id` (`shipping_address_id`),
  ADD KEY `billing_address_id` (`billing_address_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entity_type_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_datetime`
--
ALTER TABLE `item_datetime`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_decimal`
--
ALTER TABLE `item_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_int`
--
ALTER TABLE `item_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_text`
--
ALTER TABLE `item_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_varchar`
--
ALTER TABLE `item_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `base_id` (`base_id`),
  ADD KEY `small_id` (`small_id`),
  ADD KEY `thumb_id` (`thumb_id`);

--
-- Indexes for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_int`
--
ALTER TABLE `product_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `media_product_id` (`product_id`);

--
-- Indexes for table `product_text`
--
ALTER TABLE `product_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `quote_address`
--
ALTER TABLE `quote_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD UNIQUE KEY `salesman_id` (`salesman_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category_decimal`
--
ALTER TABLE `category_decimal`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_int`
--
ALTER TABLE `category_int`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_varchar`
--
ALTER TABLE `category_varchar`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `item_datetime`
--
ALTER TABLE `item_datetime`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_decimal`
--
ALTER TABLE `item_decimal`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_int`
--
ALTER TABLE `item_int`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `item_text`
--
ALTER TABLE `item_text`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `item_varchar`
--
ALTER TABLE `item_varchar`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `method_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `product_decimal`
--
ALTER TABLE `product_decimal`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_int`
--
ALTER TABLE `product_int`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `media_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `product_text`
--
ALTER TABLE `product_text`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_varchar`
--
ALTER TABLE `product_varchar`
  MODIFY `value_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `quote_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `quote_address`
--
ALTER TABLE `quote_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `method_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD CONSTRAINT `category_decimal_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_decimal_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_int`
--
ALTER TABLE `category_int`
  ADD CONSTRAINT `category_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_int_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD CONSTRAINT `category_varchar_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_varchar_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`shipping_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`billing_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD CONSTRAINT `eav_attribute_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_datetime`
--
ALTER TABLE `item_datetime`
  ADD CONSTRAINT `item_datetime_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_datetime_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_decimal`
--
ALTER TABLE `item_decimal`
  ADD CONSTRAINT `item_decimal_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_decimal_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_int`
--
ALTER TABLE `item_int`
  ADD CONSTRAINT `item_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_int_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_text`
--
ALTER TABLE `item_text`
  ADD CONSTRAINT `item_text_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_text_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_varchar`
--
ALTER TABLE `item_varchar`
  ADD CONSTRAINT `item_varchar_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_varchar_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`base_id`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`small_id`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`thumb_id`) REFERENCES `product_media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD CONSTRAINT `product_decimal_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_decimal_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_text`
--
ALTER TABLE `product_text`
  ADD CONSTRAINT `product_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD CONSTRAINT `product_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
