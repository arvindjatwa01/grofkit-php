-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 03:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grofkitstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_phone` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_full_name` varchar(100) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_image`, `admin_phone`, `admin_email`, `admin_full_name`, `admin_address`) VALUES
(2, 'admin', '123', 'logo.png', '1234567890', 'demo@gmail.com', 'ADMIN', 'jaipur Rajasthan');

-- --------------------------------------------------------

--
-- Table structure for table `appsetting`
--

CREATE TABLE `appsetting` (
  `appSetting_Id` bigint(20) NOT NULL,
  `appSetting_Name` varchar(50) NOT NULL,
  `appSetting_desc` varchar(255) NOT NULL,
  `appSetting_Action` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appsetting`
--

INSERT INTO `appsetting` (`appSetting_Id`, `appSetting_Name`, `appSetting_desc`, `appSetting_Action`) VALUES
(1, 'AnyOneCanReview', 'if appSetting_Action is true then any one give review ', 1),
(2, 'Approved', 'if appSetting_Action is true then user review show on same time when user give the review about the item. it depends on user when user login in then this data always goes with user login session data. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `att_Id` bigint(20) NOT NULL,
  `att_Name` varchar(255) NOT NULL,
  `att_IsMultiple` tinyint(1) NOT NULL,
  `att_IsonView` tinyint(1) NOT NULL,
  `att_isSingalChoise` tinyint(1) NOT NULL,
  `att_IsStockAtt` tinyint(1) NOT NULL,
  `att_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `att_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`att_Id`, `att_Name`, `att_IsMultiple`, `att_IsonView`, `att_isSingalChoise`, `att_IsStockAtt`, `att_CreatedDate`, `att_modifydate`) VALUES
(2, 'Color', 1, 0, 0, 1, '2022-04-04 13:20:58', '0000-00-00 00:00:00'),
(3, 'Size', 0, 0, 1, 0, '2022-04-04 14:41:59', '0000-00-00 00:00:00'),
(9, 'sdvd', 0, 0, 1, 1, '2022-04-07 14:52:10', '0000-00-00 00:00:00'),
(19, 'Kaju', 1, 0, 0, 1, '2022-05-06 03:15:48', '0000-00-00 00:00:00'),
(21, 'xcv', 0, 0, 1, 0, '2022-05-09 04:04:44', '0000-00-00 00:00:00'),
(22, 'color2', 1, 0, 0, 1, '2022-05-25 06:21:18', '0000-00-00 00:00:00'),
(23, 'Size2', 0, 0, 1, 1, '2022-05-25 06:21:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributedtl`
--

CREATE TABLE `attributedtl` (
  `attd_id` bigint(20) NOT NULL,
  `attd_attid` bigint(20) NOT NULL,
  `attd_value` varchar(255) NOT NULL,
  `attd_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `attd_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributedtl`
--

INSERT INTO `attributedtl` (`attd_id`, `attd_attid`, `attd_value`, `attd_CreatedDate`, `attd_modifydate`) VALUES
(2, 3, 'xl', '2022-04-04 15:12:32', '0000-00-00 00:00:00'),
(6, 3, 'L', '2022-04-21 15:58:10', '0000-00-00 00:00:00'),
(16, 2, 'Yellow', '2022-04-21 18:58:02', '0000-00-00 00:00:00'),
(36, 3, 'XXL', '2022-04-22 10:04:22', '0000-00-00 00:00:00'),
(37, 2, 'Pink', '2022-04-22 10:11:01', '0000-00-00 00:00:00'),
(38, 2, 'green', '2022-04-22 10:12:36', '0000-00-00 00:00:00'),
(43, 19, 'Regular', '2022-05-06 03:37:23', '0000-00-00 00:00:00'),
(44, 19, 'Premium', '2022-05-06 05:32:52', '0000-00-00 00:00:00'),
(45, 9, 'fdsf', '2022-05-08 22:40:47', '0000-00-00 00:00:00'),
(47, 21, 'sfce', '2022-05-09 04:05:30', '0000-00-00 00:00:00'),
(48, 21, 'dssfgdg', '2022-05-10 02:48:56', '0000-00-00 00:00:00'),
(57, 23, 'm', '2022-05-25 06:22:53', '0000-00-00 00:00:00'),
(60, 23, 'xxxl', '2022-05-25 06:23:42', '0000-00-00 00:00:00'),
(61, 22, 'black', '2022-05-25 06:24:02', '0000-00-00 00:00:00'),
(62, 22, 'Blue', '2022-05-25 06:24:10', '0000-00-00 00:00:00'),
(63, 23, 'xl', '2022-05-25 21:45:47', '0000-00-00 00:00:00'),
(66, 22, 'Pink', '2022-05-25 21:46:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributeitem`
--

CREATE TABLE `attributeitem` (
  `iteAtt_id` bigint(20) NOT NULL,
  `iteAtt_attid` bigint(20) NOT NULL,
  `iteAtt_value` bigint(20) NOT NULL,
  `iteAtt_itemID` bigint(20) NOT NULL,
  `iteAtt_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `iteAtt_modifydate` datetime NOT NULL,
  `isdefault` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeitem`
--

INSERT INTO `attributeitem` (`iteAtt_id`, `iteAtt_attid`, `iteAtt_value`, `iteAtt_itemID`, `iteAtt_CreatedDate`, `iteAtt_modifydate`, `isdefault`) VALUES
(36, 19, 44, 31, '2022-05-06 06:00:26', '0000-00-00 00:00:00', 0),
(37, 19, 43, 31, '2022-05-06 06:00:31', '0000-00-00 00:00:00', 0),
(42, 2, 16, 29, '2022-05-09 00:34:24', '0000-00-00 00:00:00', 0),
(43, 2, 38, 32, '2022-05-09 03:20:40', '0000-00-00 00:00:00', 0),
(44, 2, 37, 32, '2022-05-09 03:21:00', '0000-00-00 00:00:00', 0),
(45, 3, 2, 32, '2022-05-09 20:51:51', '0000-00-00 00:00:00', 0),
(46, 3, 6, 32, '2022-05-09 20:51:53', '0000-00-00 00:00:00', 0),
(50, 2, 16, 32, '2022-05-19 20:53:48', '0000-00-00 00:00:00', 0),
(51, 22, 61, 39, '2022-05-25 06:24:35', '0000-00-00 00:00:00', 1),
(52, 22, 62, 39, '2022-05-25 06:24:53', '0000-00-00 00:00:00', 1),
(53, 23, 57, 39, '2022-05-25 06:25:02', '0000-00-00 00:00:00', 0),
(54, 23, 60, 39, '2022-05-25 06:25:10', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attributeprice`
--

CREATE TABLE `attributeprice` (
  `attPrice_Id` bigint(20) NOT NULL,
  `attPrice_itemId` bigint(20) NOT NULL,
  `attPrice_attvaluesId` varchar(255) NOT NULL,
  `attPrice_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeprice`
--

INSERT INTO `attributeprice` (`attPrice_Id`, `attPrice_itemId`, `attPrice_attvaluesId`, `attPrice_Price`) VALUES
(8, 39, '57,62', 50),
(9, 39, '60,62', 3.98),
(10, 39, '60,61,62', 225.5),
(11, 39, '57,61', 52.8),
(12, 32, '2,16', 300),
(13, 32, '2,37', 50),
(14, 32, '6,38', 230),
(15, 32, '38', 33.33),
(16, 32, '2,38', 500);

-- --------------------------------------------------------

--
-- Table structure for table `cancellationrequest`
--

CREATE TABLE `cancellationrequest` (
  `cancelResq_Id` bigint(20) NOT NULL,
  `cancelResq_OderId` bigint(20) NOT NULL,
  `cancelResq_userId` bigint(20) NOT NULL,
  `cancelResq_Iscancel` tinyint(1) DEFAULT NULL,
  `cancelResq_ApprovedDate` datetime NOT NULL,
  `cancelResq_DeclineDate` datetime NOT NULL,
  `cancelResq_createDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cancelResq_modifyDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancellationrequest`
--

INSERT INTO `cancellationrequest` (`cancelResq_Id`, `cancelResq_OderId`, `cancelResq_userId`, `cancelResq_Iscancel`, `cancelResq_ApprovedDate`, `cancelResq_DeclineDate`, `cancelResq_createDate`, `cancelResq_modifyDate`) VALUES
(11, 39, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-13 03:24:00', '0000-00-00 00:00:00'),
(12, 40, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-16 22:57:58', '0000-00-00 00:00:00'),
(13, 40, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-16 22:58:09', '0000-00-00 00:00:00'),
(14, 43, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 00:35:48', '0000-00-00 00:00:00'),
(15, 43, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 00:35:58', '0000-00-00 00:00:00'),
(16, 40, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 00:36:26', '0000-00-00 00:00:00'),
(17, 50, 13, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 06:43:33', '0000-00-00 00:00:00'),
(18, 50, 13, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 06:43:44', '0000-00-00 00:00:00'),
(24, 9, 16, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-17 22:46:36', '0000-00-00 00:00:00'),
(25, 40, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 04:23:17', '0000-00-00 00:00:00'),
(26, 43, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 04:23:28', '0000-00-00 00:00:00'),
(27, 52, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 06:08:48', '0000-00-00 00:00:00'),
(28, 0, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 06:10:09', '0000-00-00 00:00:00'),
(29, 51, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 06:10:14', '0000-00-00 00:00:00'),
(30, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 08:05:10', '0000-00-00 00:00:00'),
(31, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 08:05:16', '0000-00-00 00:00:00'),
(32, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 08:05:31', '0000-00-00 00:00:00'),
(34, 54, 18, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-18 08:18:00', '0000-00-00 00:00:00'),
(36, 56, 18, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 04:10:18', '0000-00-00 00:00:00'),
(37, 57, 2, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 04:21:44', '0000-00-00 00:00:00'),
(38, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 09:17:05', '0000-00-00 00:00:00'),
(39, 52, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 09:17:12', '0000-00-00 00:00:00'),
(40, 56, 18, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 09:24:15', '0000-00-00 00:00:00'),
(41, 56, 18, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 18:36:31', '0000-00-00 00:00:00'),
(42, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-19 23:52:58', '0000-00-00 00:00:00'),
(47, 53, 13, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-24 01:37:32', '0000-00-00 00:00:00'),
(49, 126, 29, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-05-24 23:30:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_Id` bigint(20) NOT NULL,
  `cart_UserID` bigint(20) NOT NULL,
  `cart_itemId` bigint(20) NOT NULL,
  `cart_volume` float NOT NULL,
  `cart_UnitId` bigint(20) NOT NULL,
  `cart_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cart_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_Id`, `cart_UserID`, `cart_itemId`, `cart_volume`, `cart_UnitId`, `cart_CreatedDate`, `cart_modifydate`) VALUES
(210, 5, 29, 1, 8, '2022-04-27 05:13:25', '0000-00-00 00:00:00'),
(212, 5, 27, 1, 8, '2022-04-27 05:13:28', '0000-00-00 00:00:00'),
(224, 14, 29, 1, 8, '2022-05-05 04:49:15', '0000-00-00 00:00:00'),
(260, 19, 26, 2, 8, '2022-05-07 02:23:21', '0000-00-00 00:00:00'),
(261, 19, 27, 6, 8, '2022-05-07 02:23:22', '0000-00-00 00:00:00'),
(270, 21, 32, 9, 8, '2022-05-09 03:37:08', '0000-00-00 00:00:00'),
(276, 25, 31, 1, 1, '2022-05-10 11:04:16', '0000-00-00 00:00:00'),
(278, 25, 29, 1, 8, '2022-05-10 11:04:19', '0000-00-00 00:00:00'),
(328, 25, 32, 7, 8, '2022-05-16 21:22:15', '0000-00-00 00:00:00'),
(478, 2, 29, 1, 8, '2022-05-20 01:10:36', '0000-00-00 00:00:00'),
(479, 27, 29, 1, 8, '2022-05-20 01:11:34', '0000-00-00 00:00:00'),
(483, 18, 23, 1, 1, '2022-05-20 03:01:44', '0000-00-00 00:00:00'),
(484, 18, 25, 1, 1, '2022-05-20 03:01:44', '0000-00-00 00:00:00'),
(485, 18, 24, 1, 8, '2022-05-20 03:01:45', '0000-00-00 00:00:00'),
(487, 18, 32, 1, 8, '2022-05-20 03:01:46', '0000-00-00 00:00:00'),
(489, 15, 29, 1, 8, '2022-05-20 03:45:03', '0000-00-00 00:00:00'),
(490, 13, 34, 1, 1, '2022-05-20 23:57:04', '0000-00-00 00:00:00'),
(494, 28, 29, 1, 8, '2022-05-21 07:57:53', '0000-00-00 00:00:00'),
(495, 28, 22, 1, 8, '2022-05-21 07:57:59', '0000-00-00 00:00:00'),
(543, 13, 12, 1, 1, '2022-05-23 21:57:34', '0000-00-00 00:00:00'),
(560, 13, 24, 1, 8, '2022-05-25 15:54:18', '0000-00-00 00:00:00'),
(561, 13, 23, 1, 1, '2022-05-25 15:54:35', '0000-00-00 00:00:00'),
(600, 16, 39, 1, 8, '2022-06-13 18:50:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cartdtl`
--

CREATE TABLE `cartdtl` (
  `cartDtl_Id` bigint(20) NOT NULL,
  `cartDtl_cartid` bigint(20) NOT NULL,
  `cartDtl_attid` bigint(20) NOT NULL,
  `cartDtl_attvalue` bigint(20) NOT NULL,
  `cartDtl_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cartDtl_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartdtl`
--

INSERT INTO `cartdtl` (`cartDtl_Id`, `cartDtl_cartid`, `cartDtl_attid`, `cartDtl_attvalue`, `cartDtl_CreatedDate`, `cartDtl_modifydate`) VALUES
(98, 600, 22, 61, '2022-06-13 18:50:37', '0000-00-00 00:00:00'),
(99, 600, 22, 62, '2022-06-13 18:50:37', '0000-00-00 00:00:00'),
(100, 600, 23, 60, '2022-06-13 18:50:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_Id` bigint(20) NOT NULL,
  `cat_Name` varchar(255) NOT NULL,
  `cat_UnderCatID` bigint(20) NOT NULL,
  `cat_Image` varchar(255) NOT NULL,
  `cat_IsMainCat` tinyint(1) NOT NULL,
  `cat_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cat_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_Id`, `cat_Name`, `cat_UnderCatID`, `cat_Image`, `cat_IsMainCat`, `cat_CreatedDate`, `cat_modifydate`) VALUES
(2, 'Parle-G', 0, 'cookies-biscuits-cracked-chocolate-logo-ico-vector-23402860-removebg-preview.png', 0, '2022-04-01 16:44:26', '2022-04-15 18:53:12'),
(7, 'Oil', 0, '000921-Free-healthy-oil-Logo-Maker-01-removebg-preview.png', 0, '2022-04-07 18:24:41', '2022-04-15 18:51:32'),
(8, 'Chocklate', 0, 'chocklate.png', 0, '2022-04-13 17:27:11', '2022-04-15 18:58:26'),
(9, 'Fruits', 0, 'fruit-icon-logo.jpg', 0, '2022-04-13 17:28:39', '2022-04-15 18:57:24'),
(10, 'Ice-Cream', 0, 'ice-cream-logo.png', 0, '2022-04-13 17:29:44', '2022-04-15 18:56:34'),
(11, 'Headphones', 0, 'headphone.png', 0, '2022-04-13 17:33:32', '2022-04-15 18:50:55'),
(13, 'Cadbury', 8, 'cadbury-dairy-milk-logo.png', 0, '2022-04-15 17:22:06', '2022-05-06 12:54:29'),
(19, 'Cashew', 0, 'cashew.jpg', 0, '2022-05-06 02:48:32', '2022-05-06 15:20:03'),
(20, 'Rajasthani ', 19, 'rajasthani-kaaju.jpg', 0, '2022-05-06 02:52:55', '0000-00-00 00:00:00'),
(21, 'Marwadi', 19, 'marwadi-kaju.jpg', 0, '2022-05-06 02:54:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `ct_Id` bigint(20) NOT NULL,
  `ct_Name` varchar(255) NOT NULL,
  `ct_StateId` bigint(20) NOT NULL,
  `ct_CountryID` bigint(20) NOT NULL,
  `ct_status` tinyint(1) NOT NULL,
  `ct_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ct_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`ct_Id`, `ct_Name`, `ct_StateId`, `ct_CountryID`, `ct_status`, `ct_CreatedDate`, `ct_modifydate`) VALUES
(2, 'Ayagama', 7, 8, 0, '2022-03-31 16:41:07', '2022-04-07 15:57:16'),
(3, 'Amritsar', 20, 26, 0, '2022-03-31 17:07:24', '2022-04-07 15:54:40'),
(4, 'Ramechhap', 5, 7, 0, '2022-03-31 17:12:10', '2022-04-07 15:54:11'),
(6, 'Kota', 4, 3, 0, '2022-04-01 12:45:53', '2022-04-06 10:55:33'),
(14, 'Amritsar', 13, 3, 0, '2022-04-07 15:49:36', '0000-00-00 00:00:00'),
(17, 'muzaffarpur', 22, 30, 0, '2022-05-09 02:59:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `cu_Id` bigint(60) NOT NULL,
  `cu_Name` varchar(255) NOT NULL,
  `cu_Code` varchar(255) NOT NULL,
  `cu_active` tinyint(1) NOT NULL,
  `cu_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cu_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`cu_Id`, `cu_Name`, `cu_Code`, `cu_active`, `cu_CreatedDate`, `cu_modifydate`) VALUES
(3, 'India', '91', 0, '2022-03-31 12:19:52', '0000-00-00 00:00:00'),
(7, 'Nepal', '977', 0, '2022-03-31 12:42:23', '0000-00-00 00:00:00'),
(8, 'Sri Lanka', '94', 1, '2022-03-31 12:52:16', '0000-00-00 00:00:00'),
(21, 'Australia', '61', 0, '2022-04-05 16:13:06', '0000-00-00 00:00:00'),
(26, 'Pakistan', '92', 0, '2022-04-07 15:25:33', '0000-00-00 00:00:00'),
(29, 'Bangla', '31', 0, '2022-05-06 05:20:19', '2022-05-06 17:50:25'),
(30, 'india1', '911', 0, '2022-05-09 02:57:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupandtl`
--

CREATE TABLE `coupandtl` (
  `CpDtl_Id` bigint(20) NOT NULL,
  `CpDtl_CPID` bigint(20) NOT NULL,
  `CpDtl_itemID` bigint(20) NOT NULL,
  `CpDtl_UserID` bigint(20) NOT NULL,
  `CpDtl_Createddate` datetime NOT NULL DEFAULT current_timestamp(),
  `CpDtl_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupandtl`
--

INSERT INTO `coupandtl` (`CpDtl_Id`, `CpDtl_CPID`, `CpDtl_itemID`, `CpDtl_UserID`, `CpDtl_Createddate`, `CpDtl_modifydate`) VALUES
(13, 1, 22, 2, '2022-04-18 16:55:46', '0000-00-00 00:00:00'),
(15, 2, 26, 0, '2022-04-18 17:04:07', '0000-00-00 00:00:00'),
(21, 9, 31, 20, '2022-05-06 05:28:51', '0000-00-00 00:00:00'),
(22, 10, 32, 0, '2022-05-09 03:24:36', '0000-00-00 00:00:00'),
(23, 11, 24, 29, '2022-05-23 23:01:45', '0000-00-00 00:00:00'),
(24, 12, 39, 0, '2022-05-25 06:33:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupen`
--

CREATE TABLE `coupen` (
  `Cp_ID` bigint(20) NOT NULL,
  `CP_Code` varchar(255) NOT NULL,
  `CP_Volumn` float NOT NULL,
  `cp_Minamount` float NOT NULL,
  `cp_Maxamount` float NOT NULL,
  `CP_IsInAmount` tinyint(1) NOT NULL,
  `CP_description` varchar(255) NOT NULL,
  `CP_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CP_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupen`
--

INSERT INTO `coupen` (`Cp_ID`, `CP_Code`, `CP_Volumn`, `cp_Minamount`, `cp_Maxamount`, `CP_IsInAmount`, `CP_description`, `CP_CreatedDate`, `CP_modifydate`) VALUES
(1, 'MB24RTYDF56', 25, 0, 0, 1, 'Please redeeem this coupan code on any productbefor may 31 to receive an insetant 20% off while purchase premium subscription', '2022-04-04 16:41:45', '0000-00-00 00:00:00'),
(2, 'MB24RTYDF45', 50.25, 0, 0, 0, 'Please redeeem this coupan code on any productbefor may 31 to receive an insetant 20% off while purchase premium subscription', '2022-04-04 16:43:21', '0000-00-00 00:00:00'),
(3, 'MB24RTYDF50', 5.5, 0, 0, 0, 'Please redeeem this coupan code on any productbefor may 31 to receive an insetant 20% off while purchase premium subscription', '2022-04-06 15:17:16', '0000-00-00 00:00:00'),
(5, 'MB24RTYDF5056', 25.5, 0, 0, 0, 'Please redeeem this coupan code on any productbefor may 31 to receive an insetant 20% off while purchase premium subscription', '2022-04-07 14:53:13', '0000-00-00 00:00:00'),
(6, 'MB24RTYDF59', 15, 0, 0, 1, 'Please redeeem this coupan code on any productbefor may 31 to receive an insetant 20% off while purchase premium subscription', '2022-04-20 18:20:10', '0000-00-00 00:00:00'),
(8, 'estgfv', 45, 5, 56, 1, '5464  vfg', '2022-05-06 02:26:24', '0000-00-00 00:00:00'),
(9, 'RK30', 30, 0, 0, 0, '30 discounrt in my naME', '2022-05-06 05:27:43', '0000-00-00 00:00:00'),
(10, 'Bingo30', 10, 0, 1000, 0, 'Bingo30 Get 10% discount on Chips purchase', '2022-05-09 03:23:38', '0000-00-00 00:00:00'),
(11, 'AASHIRVAAD', 10, 10, 0, 1, '10 rupay discount in Aashirvaad Aata', '2022-05-23 23:00:39', '0000-00-00 00:00:00'),
(12, 'SHIRTDIS10', 10, 0, 0, 1, 'SHIRTDIS10', '2022-05-25 06:33:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ite_Id` bigint(20) NOT NULL,
  `ite_Name` varchar(255) NOT NULL,
  `ite_sku` varchar(255) NOT NULL,
  `ite_Descripton` varchar(255) NOT NULL,
  `ite_ProdId` bigint(20) NOT NULL,
  `ite_BaseRate` float NOT NULL,
  `ite_Rate` float NOT NULL,
  `ite_MRP` float NOT NULL,
  `ite_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ite_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ite_Id`, `ite_Name`, `ite_sku`, `ite_Descripton`, `ite_ProdId`, `ite_BaseRate`, `ite_Rate`, `ite_MRP`, `ite_CreatedDate`, `ite_modifydate`) VALUES
(11, 'Dairy Milk', 'MBC12NOP34', 'Dairy Milk', 7, 44, 50, 60, '2022-04-13 17:42:28', '0000-00-00 00:00:00'),
(12, 'Grapes', 'MBC12NOP35', 'Grapes', 8, 40, 50, 60, '2022-04-13 17:43:19', '0000-00-00 00:00:00'),
(22, 'Chocklate', 'MBC12NOP36', 'Dairy Milk', 7, 44, 50, 60, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(23, 'TOMATO', 'MBC12NOP37', 'Dairy Milk', 14, 44, 50, 60, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(24, 'AASHIRVAAD CHAKKI AATA', 'MBC12NOP38', 'Dairy Milk', 16, 44, 50, 60, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(25, 'POMEGRANATE', 'MBC12NOP39', 'Dairy Milk', 15, 44, 50, 60, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(26, 'CORNETTO ICECREAM', 'MBC12NOP40', 'Dairy Milk', 9, 44, 50, 50, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(27, 'CADBURY FUSE', 'MBC12NOP41', 'Dairy Milk', 9, 44, 50, 60, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(28, 'CADBURY DAIRY MILK', 'MBC12NOP42', 'Dairy Milk', 7, 44, 50, 50, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(29, 'DAIRY MILK SILK', 'MBC12NOP43', 'Dairy Milk', 7, 44, 50, 80, '2022-04-13 17:48:45', '0000-00-00 00:00:00'),
(31, 'KAju desi Raqjsthani', '65ydsfg4565', 'KAju desi Raqjsthani f4tg KAju desi Raqjsthani', 18, 20, 40, 50, '2022-05-06 03:06:46', '0000-00-00 00:00:00'),
(32, 'bingo', '', 'pure tomato chips', 20, 8, 10, 12, '2022-05-09 03:15:11', '0000-00-00 00:00:00'),
(34, 'Desi Banaa', 'sfdb ', 'Desi Indian Pure Banana From kerla', 11, 25, 35, 40, '2022-05-15 23:15:29', '0000-00-00 00:00:00'),
(39, 'Men Tshirt', 'dfsdf', ' Clipart Library Free Cartoon Shirt Png, Download Free Cartoon Shirt Png png images, Free ClipArts on Clipart Library', 21, 100, 199, 299, '2022-05-25 06:14:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `itemimage`
--

CREATE TABLE `itemimage` (
  `itImg_Id` bigint(20) NOT NULL,
  `itimg_path` varchar(255) NOT NULL,
  `itimg_IsMainImage` tinyint(1) NOT NULL,
  `itimg_itemID` bigint(20) NOT NULL,
  `itemimg_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `itemimg_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemimage`
--

INSERT INTO `itemimage` (`itImg_Id`, `itimg_path`, `itimg_IsMainImage`, `itimg_itemID`, `itemimg_CreatedDate`, `itemimg_modifydate`) VALUES
(25, '6256c0b4cd1a5-dairymilk.jpg', 1, 29, '2022-04-13 17:53:16', '0000-00-00 00:00:00'),
(26, '6256c0cf4b97d-crispello.jpg', 1, 28, '2022-04-13 17:53:43', '0000-00-00 00:00:00'),
(27, '6256c0f043a51-cadfuse.jpg', 1, 27, '2022-04-13 17:54:16', '0000-00-00 00:00:00'),
(28, '6256c104af4b7-cornetto.jpg', 1, 26, '2022-04-13 17:54:36', '0000-00-00 00:00:00'),
(30, '6256c119a97cc-aashrvaad.jpg', 1, 24, '2022-04-13 17:54:57', '0000-00-00 00:00:00'),
(31, '6256c122e3c39-tomato.jpg', 1, 23, '2022-04-13 17:55:06', '0000-00-00 00:00:00'),
(32, '6256c12b5789f-crispello.jpg', 1, 22, '2022-04-13 17:55:15', '0000-00-00 00:00:00'),
(33, '6256c13e0a223-grapes.jpg', 1, 12, '2022-04-13 17:55:34', '0000-00-00 00:00:00'),
(34, '6256c1465c4c7-dairymilk.jpg', 1, 11, '2022-04-13 17:55:42', '0000-00-00 00:00:00'),
(41, '6274f39625277-item kaju.jpg', 1, 31, '2022-05-06 03:08:22', '0000-00-00 00:00:00'),
(43, '6281ec2a74210-banana.jpg', 1, 34, '2022-05-15 23:16:10', '0000-00-00 00:00:00'),
(46, '62823e2a856a2-anar.jpg', 1, 25, '2022-05-16 05:06:02', '0000-00-00 00:00:00'),
(47, '6282448ce6991-yellow-diamond-cream-n-onion-chips-200x200.png', 0, 32, '2022-05-16 05:33:16', '0000-00-00 00:00:00'),
(48, '6282448ce6d8e-yellow-diamond-magic-masala-chips-200x200.png', 0, 32, '2022-05-16 05:33:16', '0000-00-00 00:00:00'),
(49, '6282448ce712d-yellow-diamond-nimbu-masala-chips-200x200.png', 0, 32, '2022-05-16 05:33:16', '0000-00-00 00:00:00'),
(50, '6282448ce74b0-yellow-diamond-palin-salted-chips-200x200.png', 0, 32, '2022-05-16 05:33:16', '0000-00-00 00:00:00'),
(51, '6282448ce7805-yellow-diamond-tom-chi-chips-200x200.png', 1, 32, '2022-05-16 05:33:16', '0000-00-00 00:00:00'),
(52, '628e2d124ddc6-images.jpg', 1, 39, '2022-05-25 06:20:18', '0000-00-00 00:00:00'),
(53, '628e2d124de63-download.png', 0, 39, '2022-05-25 06:20:18', '0000-00-00 00:00:00'),
(54, '628e2d124debd-shirt.png', 0, 39, '2022-05-25 06:20:18', '0000-00-00 00:00:00'),
(55, '628e2d124def6-tshirt.png', 0, 39, '2022-05-25 06:20:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_reviews`
--

CREATE TABLE `item_reviews` (
  `itemRev_id` bigint(20) NOT NULL,
  `itemRev_itemId` bigint(20) NOT NULL,
  `itemRev_userId` bigint(20) NOT NULL,
  `itemRev_Rating` float NOT NULL,
  `itemRev_desc` text NOT NULL,
  `itemRev_isRemove` tinyint(1) DEFAULT NULL,
  `itemRev_isApproved` tinyint(1) DEFAULT NULL,
  `itemRev_Time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_reviews`
--

INSERT INTO `item_reviews` (`itemRev_id`, `itemRev_itemId`, `itemRev_userId`, `itemRev_Rating`, `itemRev_desc`, `itemRev_isRemove`, `itemRev_isApproved`, `itemRev_Time`) VALUES
(3, 39, 45, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate dolores, quod perspiciatis incidunt placeat pariatur unde dolore fuga facilis dignissimos tenetur officiis esse atque libero accusantium rem iure quis ducimus laboriosam dolorem blanditiis molestias consectetur!\n', 0, NULL, '2022-05-19'),
(4, 39, 45, 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate dolores, quod perspiciatis incidunt placeat pariatur unde dolore fuga facilis dignissimos tenetur officiis esse atque libero accusantium rem iure quis ducimus laboriosam dolorem blanditiis molestias consectetur!\n', 1, NULL, '2022-05-27'),
(5, 39, 2, 4, 'I got a defective piece. Since I was not at my home during the delivery period, I couldn\'t ask for replacement. I\'m trying to claim warranty, but I didn\'t get any assistance.', NULL, NULL, '2022-05-27'),
(6, 39, 1, 3, 'My son asks for one every Christmas, he doesn’t wear any other make. I’m sure he would give you full marks but I would too as customer service is so helpful and delivery excellent. Gwyn December 2021', NULL, NULL, '2022-05-27'),
(7, 39, 4, 2, 'Everything was great, from ordering to wearing!! And my previous t-shirt washes and irons beautifully and is a pleasure to wear. The ordering system is easy, delivery is speedy and the parcel is beautifully and sustainably wrapped. Thank you! Tessa Dec 21', NULL, NULL, '2022-05-27'),
(8, 39, 11, 5, 'one of my very favourite companies;I have never been disappointed with any purchase; thelast one was exactly as expected,beautifully packaged and very well made. I wear bodysuits every day in winter as an extra warming layer; for me they are an essential and I hae bought all of mine from your company. They are long wearing, wash well, and represent very good value for money. Ditto for the T-Shirts that I purchase from you. Madeline Nov 21', NULL, NULL, '2022-05-27'),
(9, 39, 12, 3, 'Hello. My boyfriend and I love the White T Shirt company. The quality is amazing and so comfortable to wear. Super smart and long lasting. Thanks for a great product. Kate Oct 202', NULL, NULL, '2022-05-27'),
(10, 39, 13, 4, 'Hi guys, Really like the t-shirts. The weight and fit are excellent, and knowing they\'re responsibly produced is great. The packaging was on point, I particularly liked that the tags were held in place with wood based string, no corners cut, great to see. Rory Sept 2021\n', 1, NULL, '2022-05-27'),
(11, 39, 22, 5, 'Thank you - I am very pleased with my recent order. I love your T-shirts and I think you are a very important company. Please keep doing what you are doing for many years to come :) Stephen Sept 21', 1, 1, '2022-05-27'),
(12, 39, 26, 5, 'I’m very pleased with my t-shirt. After it’s first wash, it feels and looks great. Although I initially felt it was expensive, at the moment it feels like good value for money!\nThe service from your company has been outstanding - easy to order, excellent communication and efficient returns and replacement. The lady I spoke to was friendly and helpful too. Thank you! I shall order again and recommend you', 1, 1, '2022-05-27'),
(13, 32, 45, 5, 'My partner finds the new t-shirt very satisfactory. More to the point, I like the feel of it when he is wearing it, it is very tactile! Gabriela', 1, NULL, '2022-05-27'),
(14, 39, 16, 5, 'Really 100% right Good quality product\nWe are happy that you had a good experience overall\na five-star rating product service', 1, NULL, '2022-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

CREATE TABLE `maincategory` (
  `Mcat_Id` bigint(20) NOT NULL,
  `Mcat_Name` varchar(255) NOT NULL,
  `Mcat_Image` varchar(255) NOT NULL,
  `Mcat_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Mcat_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`Mcat_Id`, `Mcat_Name`, `Mcat_Image`, `Mcat_CreatedDate`, `Mcat_modifydate`) VALUES
(1, 'Oil', 'http://localhost/grofkit/dashboard/uploads/category_icon_image/oil.png', '2022-04-01 16:06:23', '0000-00-00 00:00:00'),
(2, 'Sugar', 'http://localhost/grofkit/dashboard/uploads/category_icon_image/sugur.png', '2022-04-01 16:07:26', '2022-04-01 16:16:07'),
(4, 'Biscuit', 'http://localhost/grofkit/dashboard/uploads/category_icon_image/biscuit.png', '2022-04-01 16:18:29', '0000-00-00 00:00:00'),
(10, 'Food', 'http://localhost/grofkit/dashboard/uploads/category_icon_image/food.png', '2022-04-13 17:26:58', '0000-00-00 00:00:00'),
(11, 'Phone', 'http://localhost/grofkit/dashboard/uploads/item_image/phone.png', '2022-04-15 15:24:43', '0000-00-00 00:00:00'),
(12, 'Headphones', 'http://localhost/grofkit/dashboard/uploads/item_image/headphone.png', '2022-04-15 15:40:56', '2022-04-15 15:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `mstaddress`
--

CREATE TABLE `mstaddress` (
  `ad_ID` bigint(20) NOT NULL,
  `ad_UserID` bigint(20) NOT NULL,
  `ad_name` varchar(255) NOT NULL,
  `ad_EmailID` varchar(255) NOT NULL,
  `ad_MobileNo` varchar(255) NOT NULL,
  `ad_PhoneNo` varchar(255) NOT NULL,
  `ad_address1` varchar(255) NOT NULL,
  `ad_address2` varchar(255) NOT NULL,
  `ad_addressType` tinyint(1) NOT NULL,
  `ad_postalCode` varchar(255) NOT NULL,
  `ad_City` varchar(255) NOT NULL,
  `ad_StateName` varchar(255) NOT NULL,
  `ad_country` varchar(255) NOT NULL,
  `ad_Remark` varchar(255) NOT NULL,
  `ad_CountyID` bigint(20) NOT NULL,
  `ad_StateID` bigint(20) NOT NULL,
  `ad_CityID` bigint(20) NOT NULL,
  `ad_CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ad_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstaddress`
--

INSERT INTO `mstaddress` (`ad_ID`, `ad_UserID`, `ad_name`, `ad_EmailID`, `ad_MobileNo`, `ad_PhoneNo`, `ad_address1`, `ad_address2`, `ad_addressType`, `ad_postalCode`, `ad_City`, `ad_StateName`, `ad_country`, `ad_Remark`, `ad_CountyID`, `ad_StateID`, `ad_CityID`, `ad_CreateDate`, `ad_modifydate`) VALUES
(12, 2, 'Rohan test', 'test@gmail.com', '9876543221', '', 'Sanaganer Thana', 'Jaipur(Raj)', 1, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-04-27 05:59:20', '0000-00-00 00:00:00'),
(13, 2, 'Rohan Sharma', 'test2@gmail.com', '9889898989', '', 'Tonk Phatak', 'Jaipur', 0, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-04-27 06:00:19', '0000-00-00 00:00:00'),
(14, 2, 'rohan test', 'test@gmail.com', '987654322', '', 'test', 'test', 1, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-04-27 06:35:39', '0000-00-00 00:00:00'),
(16, 20, 'Rohit', 'Rohit@gmail', '1234522332', '', 'restesr', '654623 ', 1, '110016', 'South West Delhi', 'Delhi', 'India', '', 0, 0, 0, '2022-05-06 05:52:51', '0000-00-00 00:00:00'),
(17, 21, 'shaiselk', 'shaileshstar123@gmail.com', '7549127503', '', 'balughat muzx', '', 1, '842001', 'Muzaffarpur', 'Bihar', 'India', '', 0, 0, 0, '2022-05-09 03:30:09', '0000-00-00 00:00:00'),
(18, 25, 'Arvind Tester', 'arvind@gmail.com', '9876543210', '', 'Mangal Marg', 'Bapu Nagar', 0, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-10 11:06:38', '0000-00-00 00:00:00'),
(19, 2, 'Arvind', 'akjatwa2001@gmail.com', '9546456332', '', 'Mangal Marg', 'Bapu Nagar', 0, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-11 21:59:52', '0000-00-00 00:00:00'),
(20, 13, 'Aditya kumar ', 'grofkit@gmail.com', '8603079079', '', 'Balughat', 'Muzaffarpur', 1, '842001', 'Muzaffarpur', 'Bihar', 'India', '', 0, 0, 0, '2022-05-16 22:57:22', '0000-00-00 00:00:00'),
(21, 26, 'Narendra', 'Nsbamlash@gmail.com', '8290611795', '', 'Hukumpura', '', 1, '333022', 'Jhujhunu', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-17 00:34:05', '0000-00-00 00:00:00'),
(22, 18, 'Ankit', 'ankit29tdm@gmail.com', '8804108980', '', 'Muzaffarpur', 'Balughat', 1, '842001', 'Muzaffarpur', 'Bihar', 'India', '', 0, 0, 0, '2022-05-18 08:16:04', '0000-00-00 00:00:00'),
(23, 27, 'tester Name', 'fomoya7411@roxoas.com', '8787564343', '', 'Mangal Marg', 'Bapu Nagar', 1, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-19 03:06:43', '0000-00-00 00:00:00'),
(25, 15, 'ads', 'sads', '7685675', '', '4564', '4564', 0, '302015', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-20 03:45:25', '0000-00-00 00:00:00'),
(26, 15, 'sxf', 'sdfsd', '5675645454', '', 'sdfsd', 'sdfsd', 1, '302017', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-20 03:46:16', '0000-00-00 00:00:00'),
(27, 16, 'tests', 'akjatwa2001@akapple.com', '4534543344', '', 'BApu Nagar', 'Mangal Marg', 0, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-20 04:18:51', '0000-00-00 00:00:00'),
(28, 29, 'tester31', 'copsulirta@vusra.com', '7457347474', '', 'Mangal Marg', 'Bapu Nagar', 1, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-23 23:15:15', '0000-00-00 00:00:00'),
(29, 30, 'tetset', 'fexiwe3278@runchet.com', '9784854784', '', 'Mangal Marg', 'Bapu', 1, '302029', 'Jaipur', 'Rajasthan', 'India', '', 0, 0, 0, '2022-05-25 06:34:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mstuser`
--

CREATE TABLE `mstuser` (
  `us_Id` bigint(20) NOT NULL,
  `us_UserName` varchar(255) NOT NULL,
  `us_Password` varchar(255) NOT NULL,
  `us_EmailID` varchar(255) NOT NULL,
  `us_mobileNo` varchar(255) NOT NULL,
  `us_postalCode` varchar(255) DEFAULT NULL,
  `us_dob` datetime NOT NULL,
  `us_gender` varchar(255) NOT NULL,
  `us_active` tinyint(1) NOT NULL,
  `us_block` tinyint(1) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `us_CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `us_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstuser`
--

INSERT INTO `mstuser` (`us_Id`, `us_UserName`, `us_Password`, `us_EmailID`, `us_mobileNo`, `us_postalCode`, `us_dob`, `us_gender`, `us_active`, `us_block`, `token`, `us_CreateDate`, `us_modifydate`) VALUES
(1, 'Ram', '1234', 'rk@gmail', '7340576658', '302029', '1997-03-19 00:00:00', 'male', 0, NULL, '', '2022-03-31 18:44:09', '0000-00-00 00:00:00'),
(2, 'Manisha', '1234', 'm@gmail.com', '7340576657', '302029', '1999-08-09 00:00:00', 'female', 0, NULL, '', '2022-03-31 18:58:53', '2022-04-01 15:06:07'),
(4, 'Mohan', '12342', 'm1@gmail.com2', '7340576656', '302029', '2000-09-01 00:00:00', 'male', 0, NULL, '', '2022-04-01 15:16:10', '2022-04-07 14:43:02'),
(5, 'Rohan', '123', 'rohan@gmail.com', '7340576655', '', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-04-13 15:09:06', '0000-00-00 00:00:00'),
(9, 'Rohit', '123', 'ro@gmail.com', '7340576654', '', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-04-13 15:14:44', '0000-00-00 00:00:00'),
(11, 'Tester', '123', 'abc@gmail.com', '1234567876', '302029', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-04-27 20:37:12', '0000-00-00 00:00:00'),
(12, 'Sumit', 'Sumit@21', 'sumitkunarsrivastava05@gmail.com', '7549127503', '842001', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-01 12:30:21', '0000-00-00 00:00:00'),
(13, 'Aditya', 'aditya1234@', 'grofkit@gmail.com', '8521985288', '842001', '0000-00-00 00:00:00', '', 0, NULL, '790520', '2022-05-04 06:13:49', '0000-00-00 00:00:00'),
(14, 'Rohan Sharma', '123', 'rohan1@gmail.com', '8521985289', '', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-05 04:41:16', '0000-00-00 00:00:00'),
(15, '', '1234', 'roh@gmail.com', '5645634545', '302015', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-05 04:41:58', '0000-00-00 00:00:00'),
(16, 'Rahul Sharma ', '123', 'rahul@gmail.com', '8777667767', '302029', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-05 05:00:04', '0000-00-00 00:00:00'),
(17, '', 'Ankitkr29', 'An29tdm@gmail.com', '8804108980', '', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-05 08:36:30', '0000-00-00 00:00:00'),
(18, 'Ankit Singh', 'Ankitkr29', 'Ankit29tdm@gmail.com', '8804108980', '842001', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-05 08:38:03', '0000-00-00 00:00:00'),
(19, 'Aditya', 'aditya1111@', 'kumaraditya871@gmail.com', '8603079079', '', '0000-00-00 00:00:00', 'male', 0, NULL, '', '2022-05-06 04:19:34', '2022-05-06 18:00:42'),
(20, 'Rohit', '123', 'rohit@gmail.com', '987987987', '', '0000-00-00 00:00:00', 'male', 0, NULL, '', '2022-05-06 05:31:44', '0000-00-00 00:00:00'),
(21, 'Aditya', '123', 'lovama1729@dmosoft.com', '7295067040', '', '0000-00-00 00:00:00', '', 0, NULL, '475958', '2022-05-09 02:24:57', '2022-05-09 15:56:35'),
(22, 'Qazim Hussian', '123', 'qazimhussain36@gmail.com', '4545434234', '234567', '0000-00-00 00:00:00', '', 0, NULL, '334791', '2022-05-09 06:22:14', '0000-00-00 00:00:00'),
(25, 'Arvind Jatwa', '1234', 'akjatwa2001@gmail.com', '8778878877', '842001', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-10 11:00:50', '0000-00-00 00:00:00'),
(26, 'Narendra', 'narendra', 'nsbamlash@gmail.com', '8290611795', '842001', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-17 00:31:51', '0000-00-00 00:00:00'),
(27, '', '11', 'fomoya7411@roxoas.com', '7567456454', '302029', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-19 01:02:05', '0000-00-00 00:00:00'),
(28, '', '12345', 'avhaysikarwar786@gmail.com', '7691879923', '842001', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-19 09:28:26', '0000-00-00 00:00:00'),
(29, '', '111', 'copsulirta@vusra.com', '4564564564', '302029', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-23 22:54:21', '0000-00-00 00:00:00'),
(30, '', '111', 'fexiwe3278@runchet.com', '9858478474', '302029', '0000-00-00 00:00:00', '', 0, NULL, '', '2022-05-25 06:32:33', '0000-00-00 00:00:00'),
(45, 'Rohan Singh ', '123', 'rijilip837@steamoh.com', '6755545675', '302029', '0000-00-00 00:00:00', '', 0, 0, '', '2022-05-27 13:04:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `ord_id` bigint(20) NOT NULL,
  `ord_userid` bigint(20) NOT NULL,
  `ord_userName` varchar(255) NOT NULL,
  `ord_emailid` varchar(255) NOT NULL,
  `ord_invoiceNo` varchar(255) DEFAULT NULL,
  `ord_OrderNo` varchar(255) NOT NULL,
  `ord_mobilNo` bigint(20) NOT NULL,
  `ord_AddressLine1` varchar(255) NOT NULL,
  `ord_AddressLine2` varchar(255) NOT NULL,
  `ord_country` varchar(255) NOT NULL,
  `ord_City` varchar(255) NOT NULL,
  `ord_State` varchar(255) NOT NULL,
  `ord_postalcode` varchar(255) NOT NULL,
  `ord_Remark` varchar(255) NOT NULL,
  `OrderStatusID` bigint(20) NOT NULL,
  `OrderTotalAmount` float NOT NULL,
  `OrderTotalBftAmount` float NOT NULL,
  `OrdertaxAmount` float NOT NULL,
  `ord_TotalDiscount` float NOT NULL,
  `ord_DeliveryCost` float NOT NULL,
  `ord_paymentMethod` tinyint(1) NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL,
  `razorpay_signature` varchar(255) NOT NULL,
  `razorpay_payment_id` varchar(255) NOT NULL,
  `ord_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `ord_DeliverDate` date NOT NULL,
  `ord_deliveredTimeFrom` time NOT NULL,
  `ord_deliveredTimeTo` time NOT NULL,
  `ord_invoiceDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`ord_id`, `ord_userid`, `ord_userName`, `ord_emailid`, `ord_invoiceNo`, `ord_OrderNo`, `ord_mobilNo`, `ord_AddressLine1`, `ord_AddressLine2`, `ord_country`, `ord_City`, `ord_State`, `ord_postalcode`, `ord_Remark`, `OrderStatusID`, `OrderTotalAmount`, `OrderTotalBftAmount`, `OrdertaxAmount`, `ord_TotalDiscount`, `ord_DeliveryCost`, `ord_paymentMethod`, `razorpay_order_id`, `razorpay_signature`, `razorpay_payment_id`, `ord_Date`, `ord_DeliverDate`, `ord_deliveredTimeFrom`, `ord_deliveredTimeTo`, `ord_invoiceDate`) VALUES
(1, 1, 'Rohan', 'rohan@gmail.com', 'RST2x4501', '168945WYTM01', 9876543021, 'Rajat Path, Mansarovar, Jaipur', 'Rajat Path, Mansarovar, Jaipur', 'India', 'Jaipur', 'Rajasthan', '302022', 'New Order', 1, 550, 600, 35, 25, 50, 0, '', '', '', '2022-04-08 11:10:08', '2022-04-10', '00:00:00', '00:00:00', '2022-04-10 00:00:00'),
(2, 4, 'Mohan', 'mohan@gmail.com', 'RST2x4505', '168945WYTM78', 9876543045, 'Agarwal Farm, Mansarovar, Jaipur', 'Agarwal Farm, Mansarovar, Jaipur', 'India', 'Jaipur', 'Rajasthan', '302021', 'New Order', 1, 500, 650, 35, 25, 50, 0, '', '', '', '2022-04-08 11:10:58', '2022-04-10', '00:00:00', '00:00:00', '2022-04-10 00:00:00'),
(9, 16, 'tester', 'lovama1729@dmosoft.com', NULL, '9652022', 8765675656, 'Jaipur', 'Jaipur', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 90, 0, 0, 0, 0, 0, '', '', '', '2022-05-05 21:14:21', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(10, 20, 'Rohity', 'Rohit@gmail', NULL, '10652022', 1234522332, 'restesr', '654623 ', 'India', 'South West Delhi', 'Delhi', '110016', '', 1, 1510, 0, 0, 0, 0, 0, '', '', '', '2022-05-06 05:53:08', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(11, 2, 'tester 2', 'test2@gmail.com', NULL, '11952022', 9889898989, 'Tonk Phatak', 'Jaipur', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 265, 0, 0, 0, 0, 0, '', '', '', '2022-05-09 00:55:35', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(12, 21, 'Shail', 'shaileshstar123@gmail.com', NULL, '12952022', 7549127503, 'balughat muzx', '', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 30, 0, 0, 0, 0, 0, '', '', '', '2022-05-09 03:30:20', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(13, 2, 'Rohan test', 'test@gmail.com', NULL, '131252022', 9876543221, 'Sanaganer Thana', 'Jaipur(Raj)', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 174, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 20:46:09', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(14, 2, 'Arvind', 'akjatwa2001@gmail.com', NULL, '141252022', 9546456332, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 83, 0, 0, 5, 0, 0, '', '', '', '2022-05-11 22:00:15', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(39, 2, 'Arvind', 'akjatwa2001@gmail.com', NULL, '391252022', 9546456332, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 3, 190, 1, 0, 1, 0, 0, '', '', '', '2022-05-11 23:49:57', '2022-05-17', '06:30:00', '14:30:00', '0000-00-00 00:00:00'),
(40, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '401752022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 190.2, 0, 0, 0, 0, 0, '', '', '', '2022-05-16 22:57:28', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(41, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '411752022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 190.2, 0, 0, 0, 0, 0, '', '', '', '2022-05-16 22:57:28', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(42, 26, 'Narendra', 'Nsbamlash@gmail.com', NULL, '421752022', 8290611795, 'Hukumpura', '', 'India', 'Jhujhunu', 'Rajasthan', '333022', '', 1, 64.2, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 00:34:09', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(43, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '431752022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 74, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 00:35:19', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(48, 2, 'Arvind', 'akjatwa2001@gmail.com', NULL, '481752022', 9546456332, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 4, 243, 0, 0, 2, 0, 0, '', '', '', '2022-05-17 04:09:32', '2022-05-26', '09:00:00', '18:00:00', '0000-00-00 00:00:00'),
(49, 2, 'Arvind', 'akjatwa2001@gmail.com', NULL, '491752022', 9546456332, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 4, 47, 0, 0, 3, 0, 0, '', '', '', '2022-05-17 04:14:13', '2022-05-18', '10:25:00', '12:25:00', '0000-00-00 00:00:00'),
(50, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '501752022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 410, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 06:43:23', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(51, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '511852022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 70, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 04:23:04', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(52, 13, 'Aditya kumar ', 'grofkit@gmail.com', NULL, '521852022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 167.6, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 06:08:39', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(53, 13, 'Aditya kumar ', 'grofkit@gmail.com', 'sdfssdd', '531852022', 8603079079, 'Balughat', 'Muzaffarpur', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 228.4, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:05:00', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(54, 18, 'Ankit', 'ankit29tdm@gmail.com', 'dsfsdffsdssdsdssdds', '541852022', 8804108980, 'Muzaffarpur', 'Balughat', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 3, 523.4, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:17:15', '2022-05-22', '09:54:00', '21:54:00', '0000-00-00 00:00:00'),
(55, 27, 'tester Name', 'fomoya7411@roxoas.com', NULL, '551952022', 8787564343, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 151.6, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 03:24:15', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(56, 18, 'Ankit', 'ankit29tdm@gmail.com', NULL, '561952022', 8804108980, 'Muzaffarpur', 'Balughat', 'India', 'Muzaffarpur', 'Bihar', '842001', '', 1, 94, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 04:10:00', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(57, 2, 'Arvind', 'akjatwa2001@gmail.com', NULL, '571952022', 9546456332, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 110, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 04:21:20', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(58, 16, 'Rohan', 'lovama1729@dmosoft.com', NULL, '581952022', 8765675656, 'Jaipur', 'Jaipur', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 68.4, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 05:25:05', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(122, 16, 'tests', 'akjatwa2001@akapple.com', NULL, '1222452022', 4534543344, 'BApu Nagar', 'Mangal Marg', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 275, 155, 16.8, 5, 108.2, 1, 'order_JYwEPw2DIISPji', 'af9fb5e7395c2fe531a69e53a2780b2cc9835b8ea877493155384004d8746c76', 'pay_JYwEjAPx29NSm0', '2022-05-23 21:48:22', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(123, 29, 'tester3', 'copsulirta@vusra.com', NULL, '1232452022', 7457347474, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 5, 78, 70, 0, 2, 10, 1, 'order_JYxnr4rIwkVLFG', '92537f99960c701ca15b687db485bc4620d284aacae2015f7abdb60ada1c7e3a', 'pay_JYxoYX9z7EZ3yA', '2022-05-23 23:21:01', '2022-05-25', '03:51:00', '22:20:00', '0000-00-00 00:00:00'),
(124, 29, 'tester3', 'copsulirta@vusra.com', NULL, '1242452022', 7457347474, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 5, 20, 10, 0, 0, 10, 1, 'order_JYy3myuGEV2dgV', '083c8fe0b5f932d9c0b2cf1817318620a14fc6b81fe837cc90cc2024774298b2', 'pay_JYy3xZnX8RfsG3', '2022-05-23 23:35:33', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(125, 29, 'tester31', 'copsulirta@vusra.com', NULL, '1252452022', 7457347474, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 4, 85, 60, 0, 10, 35, 1, 'order_JZ2aoTaatOjHvi', '2beafb839bdcb49aae046ca4511455dab697751dfef5c0d9ce958cbf5faf01b2', 'pay_JZ2bLE9v21qyuL', '2022-05-24 04:01:56', '2022-05-24', '14:02:00', '14:02:00', '0000-00-00 00:00:00'),
(126, 29, 'tester31', 'copsulirta@vusra.com', NULL, '1262452022', 7457347474, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 3, 50, 60, 0, 10, 0, 1, 'order_JZ45dEoVybKqEi', '52ac0fcbf37a696eb1c47ce03205d61c419f17b60a68332ea4748d1ae92ce3dd', 'pay_JZ45xfhuxLAWJe', '2022-05-24 05:29:36', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(127, 29, 'tester31', 'copsulirta@vusra.com', '64sdfssfdfsdf', '1272552022', 7457347474, 'Mangal Marg', 'Bapu Nagar', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 206, 170, 21, 0, 15, 0, '', '', '', '2022-05-25 03:26:50', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(128, 30, 'tetset', 'fexiwe3278@runchet.com', NULL, '1282552022', 9784854784, 'Mangal Marg', 'Bapu', 'India', 'Jaipur', 'Rajasthan', '302029', '', 2, 189, 199, 0, 10, 0, 0, '', '', '', '2022-05-25 06:35:15', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00'),
(129, 16, 'tests', 'akjatwa2001@akapple.com', NULL, '1291362022', 4534543344, 'BApu Nagar', 'Mangal Marg', 'India', 'Jaipur', 'Rajasthan', '302029', '', 1, 225.5, 225.5, 0, 0, 0, 1, 'order_JgytE4icD4PqBP', 'b82e95e3f52db752cbf5a8f9f85d905fcc8e947baf0d7f9252d444ea8df6d31e', 'pay_JgytUBVuup5hIx', '2022-06-13 18:06:28', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderdtl`
--

CREATE TABLE `orderdtl` (
  `ordDtl_id` bigint(20) NOT NULL,
  `ordDtl_OrderId` bigint(20) NOT NULL,
  `ordDtl_itemID` bigint(20) NOT NULL,
  `OrdDtlUnitId` bigint(20) NOT NULL,
  `OrdDtl_itemName` varchar(255) NOT NULL,
  `OrdDtl_UnitName` varchar(255) NOT NULL,
  `OrdDtl_Volumen` float NOT NULL,
  `OrdDtl_Rate` float NOT NULL,
  `OrdDtl_Igst` float NOT NULL,
  `OrdDtl_sgst` float NOT NULL,
  `OrdDDtl_Cgst` float NOT NULL,
  `OrdDtl_IgstPre` float NOT NULL,
  `OrdDtl_sgstPre` float NOT NULL,
  `OrdDDtl_CgstPre` float NOT NULL,
  `OrdDtl_DIscountAmount` float NOT NULL,
  `OrdDtl_DIscountCode` varchar(255) NOT NULL,
  `OrdDtl_Sku` varchar(255) NOT NULL,
  `OrdDtl_GstN` varchar(255) NOT NULL,
  `OrdDtl_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `OrdDtl_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdtl`
--

INSERT INTO `orderdtl` (`ordDtl_id`, `ordDtl_OrderId`, `ordDtl_itemID`, `OrdDtlUnitId`, `OrdDtl_itemName`, `OrdDtl_UnitName`, `OrdDtl_Volumen`, `OrdDtl_Rate`, `OrdDtl_Igst`, `OrdDtl_sgst`, `OrdDDtl_Cgst`, `OrdDtl_IgstPre`, `OrdDtl_sgstPre`, `OrdDDtl_CgstPre`, `OrdDtl_DIscountAmount`, `OrdDtl_DIscountCode`, `OrdDtl_Sku`, `OrdDtl_GstN`, `OrdDtl_CreatedDate`, `OrdDtl_modifydate`) VALUES
(1, 1, 1, 1, 'xyz', 'Kg', 2, 25, 25, 25, 25, 25, 25, 25, 5, '2', 'MB24RTYDF5045', 'MB24RTYDF5043', '2022-04-08 11:32:40', '0000-00-00 00:00:00'),
(2, 2, 2, 1, 'xyz', 'Kg', 2, 25, 25, 25, 25, 25, 25, 25, 5, '2', 'MB24RTYDF5045', 'MB24RTYDF5043', '2022-04-08 11:33:09', '2022-04-10 00:00:00'),
(12, 9, 29, 8, 'DAIRY MILK SILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-05 21:14:21', '0000-00-00 00:00:00'),
(13, 10, 31, 1, 'KAju desi Raqjsthani', 'Kg', 35, 1400, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-06 05:53:08', '0000-00-00 00:00:00'),
(14, 11, 28, 8, 'CADBURY DAIRY MILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-09 00:55:35', '0000-00-00 00:00:00'),
(15, 11, 27, 8, 'CADBURY FUSE', 'Packet', 2, 100, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-09 00:55:35', '0000-00-00 00:00:00'),
(16, 12, 32, 8, 'bingo', 'Packet', 3, 30, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-09 03:30:20', '0000-00-00 00:00:00'),
(17, 13, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 20:46:09', '0000-00-00 00:00:00'),
(18, 13, 29, 8, 'DAIRY MILK SILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 5, '', '', '', '2022-05-11 20:46:09', '0000-00-00 00:00:00'),
(19, 14, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 5, 'Bingo30', '', '', '2022-05-11 22:00:15', '0000-00-00 00:00:00'),
(20, 14, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 5, 'Bingo30', '', '', '2022-05-11 22:00:15', '0000-00-00 00:00:00'),
(47, 32, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:22:26', '0000-00-00 00:00:00'),
(48, 33, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:24:38', '0000-00-00 00:00:00'),
(49, 33, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:24:38', '0000-00-00 00:00:00'),
(50, 34, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:26:26', '0000-00-00 00:00:00'),
(51, 35, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:28:36', '0000-00-00 00:00:00'),
(52, 36, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:32:01', '0000-00-00 00:00:00'),
(53, 37, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:39:58', '0000-00-00 00:00:00'),
(54, 38, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:41:02', '0000-00-00 00:00:00'),
(55, 38, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-11 23:41:02', '0000-00-00 00:00:00'),
(56, 39, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 10, 'Bingo30', '', '', '2022-05-11 23:49:57', '0000-00-00 00:00:00'),
(57, 39, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 10, 'Bingo30', '', '', '2022-05-11 23:49:57', '0000-00-00 00:00:00'),
(58, 39, 29, 8, 'DAIRY MILK SILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 10, 'Bingo30', '', '', '2022-05-11 23:49:57', '0000-00-00 00:00:00'),
(59, 40, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-16 22:57:28', '0000-00-00 00:00:00'),
(60, 40, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-16 22:57:28', '0000-00-00 00:00:00'),
(61, 40, 32, 8, 'bingo', 'Packet', 6, 60, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-16 22:57:28', '0000-00-00 00:00:00'),
(62, 42, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 00:34:09', '0000-00-00 00:00:00'),
(63, 42, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 00:34:09', '0000-00-00 00:00:00'),
(64, 43, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 00:35:19', '0000-00-00 00:00:00'),
(65, 44, 29, 8, 'DAIRY MILK SILK', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:04:49', '0000-00-00 00:00:00'),
(66, 45, 29, 8, 'DAIRY MILK SILK', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:05:59', '0000-00-00 00:00:00'),
(67, 46, 29, 8, 'DAIRY MILK SILK', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:06:14', '0000-00-00 00:00:00'),
(68, 47, 29, 8, 'DAIRY MILK SILK', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:07:32', '0000-00-00 00:00:00'),
(69, 48, 29, 8, 'DAIRY MILK SILK', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:09:32', '0000-00-00 00:00:00'),
(70, 48, 32, 8, 'bingo', 'Packet', 2, 20, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-17 04:09:32', '0000-00-00 00:00:00'),
(71, 49, 32, 8, 'bingo', 'Packet', 3, 30, 0, 0, 0, 0, 0, 0, 3, 'Bingo30', '', '', '2022-05-17 04:14:13', '0000-00-00 00:00:00'),
(72, 50, 27, 8, 'CADBURY FUSE', 'Packet', 3, 150, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 06:43:23', '0000-00-00 00:00:00'),
(73, 50, 12, 1, 'Grapes', 'Kg', 3, 150, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-17 06:43:23', '0000-00-00 00:00:00'),
(74, 51, 32, 8, 'bingo', 'Packet', 6, 60, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 04:23:04', '0000-00-00 00:00:00'),
(75, 52, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 06:08:39', '0000-00-00 00:00:00'),
(76, 52, 29, 8, 'DAIRY MILK SILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 06:08:39', '0000-00-00 00:00:00'),
(77, 53, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:05:00', '0000-00-00 00:00:00'),
(78, 53, 28, 8, 'CADBURY DAIRY MILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:05:00', '0000-00-00 00:00:00'),
(79, 53, 22, 8, 'Chocklate', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:05:00', '0000-00-00 00:00:00'),
(80, 54, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:17:15', '0000-00-00 00:00:00'),
(81, 54, 29, 8, 'DAIRY MILK SILK', 'Packet', 6, 300, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:17:15', '0000-00-00 00:00:00'),
(82, 54, 26, 8, 'CORNETTO ICECREAM', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-18 08:17:15', '0000-00-00 00:00:00'),
(83, 55, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 03:24:15', '0000-00-00 00:00:00'),
(84, 56, 31, 1, 'KAju desi Raqjsthani', 'Kg', 1, 40, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 04:10:00', '0000-00-00 00:00:00'),
(85, 57, 29, 8, 'DAIRY MILK SILK', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 04:21:20', '0000-00-00 00:00:00'),
(86, 58, 34, 1, 'Desi Banaa', 'Kg', 1, 35, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-19 05:25:05', '0000-00-00 00:00:00'),
(153, 122, 34, 1, 'Desi Banaa', 'Kg', 3, 105, 0, 0, 0, 0, 0, 0, 5, 'Bingo30', '', '', '2022-05-23 21:48:22', '0000-00-00 00:00:00'),
(154, 122, 32, 8, 'bingo', 'Packet', 5, 50, 0, 0, 0, 0, 0, 0, 5, 'Bingo30', '', '', '2022-05-23 21:48:22', '0000-00-00 00:00:00'),
(155, 123, 24, 8, 'AASHIRVAAD CHAKKI AATA', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-23 23:21:01', '0000-00-00 00:00:00'),
(156, 123, 32, 8, 'bingo', 'Packet', 2, 20, 0, 0, 0, 0, 0, 0, 2, 'Bingo30', '', '', '2022-05-23 23:21:01', '0000-00-00 00:00:00'),
(157, 124, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-23 23:35:33', '0000-00-00 00:00:00'),
(158, 125, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 10, 'AASHIRVAAD', '', '', '2022-05-24 04:01:56', '0000-00-00 00:00:00'),
(159, 125, 24, 8, 'AASHIRVAAD CHAKKI AATA', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 10, 'AASHIRVAAD', '', '', '2022-05-24 04:01:56', '0000-00-00 00:00:00'),
(160, 126, 24, 8, 'AASHIRVAAD CHAKKI AATA', 'Packet', 1, 50, 0, 0, 0, 0, 0, 0, 10, 'AASHIRVAAD', '', '', '2022-05-24 05:29:36', '0000-00-00 00:00:00'),
(161, 126, 32, 8, 'bingo', 'Packet', 1, 10, 0, 0, 0, 0, 0, 0, 10, 'AASHIRVAAD', '', '', '2022-05-24 05:29:36', '0000-00-00 00:00:00'),
(162, 127, 34, 1, 'Desi Banaa', 'Kg', 2, 70, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-25 03:26:50', '0000-00-00 00:00:00'),
(163, 127, 24, 8, 'AASHIRVAAD CHAKKI AATA', 'Packet', 2, 100, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-05-25 03:26:50', '0000-00-00 00:00:00'),
(164, 128, 39, 8, 'Men Tshirt', 'Packet', 1, 199, 0, 0, 0, 0, 0, 0, 10, 'SHIRTDIS10', '', '', '2022-05-25 06:35:15', '0000-00-00 00:00:00'),
(165, 129, 39, 8, 'Men Tshirt', 'Packet', 1, 199, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2022-06-13 18:06:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderdtl_att`
--

CREATE TABLE `orderdtl_att` (
  `orderdtl_attId` bigint(20) NOT NULL,
  `orderdtl_att_itemId` bigint(20) NOT NULL,
  `orderdtl_att_AttId` bigint(20) NOT NULL,
  `orderdtl_att_AttValue` bigint(20) NOT NULL,
  `orderdtl_att_orddtlId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdtl_att`
--

INSERT INTO `orderdtl_att` (`orderdtl_attId`, `orderdtl_att_itemId`, `orderdtl_att_AttId`, `orderdtl_att_AttValue`, `orderdtl_att_orddtlId`) VALUES
(74, 32, 2, 38, 154),
(75, 32, 2, 16, 154),
(76, 32, 3, 2, 154),
(77, 32, 2, 38, 157),
(78, 32, 3, 6, 157),
(79, 32, 2, 37, 161),
(80, 32, 3, 2, 161),
(81, 39, 22, 61, 164),
(82, 39, 23, 57, 164),
(83, 39, 22, 61, 165),
(84, 39, 22, 62, 165),
(85, 39, 23, 60, 165);

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `Os_Id` bigint(20) NOT NULL,
  `Os_Name` varchar(255) NOT NULL,
  `Os_isOrderViewDefault` tinyint(1) NOT NULL,
  `Os_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Os_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`Os_Id`, `Os_Name`, `Os_isOrderViewDefault`, `Os_CreatedDate`, `Os_modifydate`) VALUES
(1, 'New Order', 0, '2022-04-08 12:39:18', '2022-04-09 00:00:00'),
(2, 'Accept Order', 0, '2022-04-08 13:02:49', '2022-04-08 00:00:00'),
(3, 'Dispatch Order', 0, '2022-05-05 21:22:16', '0000-00-00 00:00:00'),
(4, 'Delivered', 0, '2022-05-05 21:24:28', '0000-00-00 00:00:00'),
(5, 'Canceled', 0, '2022-05-05 21:24:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderstaustime`
--

CREATE TABLE `orderstaustime` (
  `ordTime_id` bigint(20) NOT NULL,
  `ordTime_ordId` bigint(20) NOT NULL,
  `ordTime_statusId` bigint(20) NOT NULL,
  `ordTime_statusCode` varchar(255) NOT NULL,
  `ordTime_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstaustime`
--

INSERT INTO `orderstaustime` (`ordTime_id`, `ordTime_ordId`, `ordTime_statusId`, `ordTime_statusCode`, `ordTime_time`) VALUES
(1, 48, 2, '', '2022-05-17 04:12:04'),
(2, 49, 4, '', '2022-05-18 05:56:30'),
(3, 54, 2, '', '2022-05-18 20:47:02'),
(4, 54, 3, '', '2022-05-18 21:24:21'),
(5, 48, 4, '', '2022-05-18 21:34:33'),
(6, 123, 2, '', '2022-05-23 23:22:31'),
(7, 123, 3, '', '2022-05-23 23:27:32'),
(8, 123, 3, '', '2022-05-23 23:27:37'),
(9, 123, 3, '', '2022-05-23 23:27:41'),
(10, 123, 3, '', '2022-05-23 23:27:42'),
(11, 123, 3, '', '2022-05-23 23:27:42'),
(12, 123, 3, '', '2022-05-23 23:27:42'),
(13, 123, 4, '', '2022-05-23 23:30:11'),
(14, 123, 5, '', '2022-05-23 23:32:42'),
(15, 124, 2, '', '2022-05-23 23:38:10'),
(16, 124, 3, '', '2022-05-23 23:59:51'),
(17, 124, 5, '', '2022-05-24 00:43:28'),
(18, 124, 5, '', '2022-05-24 00:49:28'),
(19, 124, 5, '', '2022-05-24 02:14:27'),
(20, 124, 5, '', '2022-05-24 02:16:52'),
(21, 126, 2, '', '2022-05-24 05:31:04'),
(22, 126, 5, '', '2022-05-24 05:33:33'),
(23, 125, 2, '', '2022-05-24 05:36:32'),
(24, 125, 3, '', '2022-05-24 05:36:56'),
(25, 125, 4, '', '2022-05-24 05:37:06'),
(26, 126, 3, '', '2022-05-24 23:24:10'),
(27, 128, 2, '', '2022-05-25 06:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `pincode_onavailable`
--

CREATE TABLE `pincode_onavailable` (
  `Pin_Id` bigint(20) NOT NULL,
  `Pin_Name` varchar(255) NOT NULL,
  `Pin_PinCode` varchar(255) NOT NULL,
  `Pin_CountryId` bigint(20) NOT NULL,
  `Pin_StateId` bigint(20) NOT NULL,
  `Pin_CityId` bigint(20) NOT NULL,
  `Pin_delivaryCost` float NOT NULL,
  `pin_MinCartValue` float NOT NULL,
  `Pin_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Pin_modifydate` datetime NOT NULL,
  `Pin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincode_onavailable`
--

INSERT INTO `pincode_onavailable` (`Pin_Id`, `Pin_Name`, `Pin_PinCode`, `Pin_CountryId`, `Pin_StateId`, `Pin_CityId`, `Pin_delivaryCost`, `pin_MinCartValue`, `Pin_CreatedDate`, `Pin_modifydate`, `Pin_status`) VALUES
(15, 'abc', '234567', 3, 13, 14, 45, 500, '2022-04-07 17:18:37', '0000-00-00 00:00:00', 0),
(16, 'xyz', '302029', 7, 5, 4, 10, 40, '2022-04-07 17:19:23', '2022-05-24 17:57:29', 0),
(18, 'balughat', '842001', 30, 22, 17, 20, 500, '2022-05-09 03:01:15', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_Id` bigint(20) NOT NULL,
  `prod_Name` varchar(255) NOT NULL,
  `prod_CatID` bigint(20) NOT NULL,
  `prod_description` varchar(255) NOT NULL,
  `prod_HSNCode` varchar(255) NOT NULL,
  `prod_active` tinyint(1) NOT NULL,
  `prod_DeliveryCost` float NOT NULL,
  `prod_unitId` bigint(20) NOT NULL,
  `prod_CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `prod_modifiDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_Id`, `prod_Name`, `prod_CatID`, `prod_description`, `prod_HSNCode`, `prod_active`, `prod_DeliveryCost`, `prod_unitId`, `prod_CreateDate`, `prod_modifiDate`) VALUES
(7, 'Chocklate', 8, 'chockalte', '12CFXTV34', 0, 20, 8, '2022-04-13 17:28:08', '0000-00-00 00:00:00'),
(8, 'Grapes', 9, 'Fruits', '12CFXTV35', 0, 25, 1, '2022-04-13 17:29:06', '0000-00-00 00:00:00'),
(9, 'Ice-Cream', 10, 'Ice-Cream', '12CFXTV36', 1, 10, 8, '2022-04-13 17:30:19', '0000-00-00 00:00:00'),
(10, 'Eateen Oil', 7, 'Eating Oil', '12CFXTV37', 1, 35, 2, '2022-04-13 17:31:54', '0000-00-00 00:00:00'),
(11, 'Banana', 9, 'Banana Fruit', '12CFXTV38', 1, 15, 1, '2022-04-13 17:32:29', '0000-00-00 00:00:00'),
(12, 'GRAM FLOUR', 11, 'GRAM FLOUR', '12CFXTV39', 0, 25, 8, '2022-04-13 17:34:03', '0000-00-00 00:00:00'),
(13, 'Dairy Milk', 8, 'Dairy Milk', '12CFXTV40', 0, 8, 8, '2022-04-13 17:34:56', '0000-00-00 00:00:00'),
(14, 'Tomato', 9, 'Tomato', '12CFXTV41', 0, 12, 1, '2022-04-13 17:35:33', '0000-00-00 00:00:00'),
(15, 'POMEGRANATE', 9, 'POMEGRANATE', '12CFXTV42', 0, 18, 1, '2022-04-13 17:36:14', '0000-00-00 00:00:00'),
(16, 'AASHIRVAAD CHAKKI AATA ', 11, 'AASHIRVAAD CHAKKI AATA ', '12CFXTV43', 0, 0, 8, '2022-04-13 17:37:01', '0000-00-00 00:00:00'),
(18, 'Desi Rajasthani Kaju', 20, 'Desi RAjasathani Kaju  description csxzfvsdf ', '5656se56456', 0, 30, 1, '2022-05-06 02:58:07', '0000-00-00 00:00:00'),
(20, 'bingp', 20, 'pure tomato chips', '4545', 0, 0, 8, '2022-05-09 03:12:22', '0000-00-00 00:00:00'),
(21, 'Shirt', 20, 'Men Wear', 'MEX2356745', 0, 0, 8, '2022-05-25 06:09:45', '0000-00-00 00:00:00'),
(22, 'test', 7, 'sd', '45assdf', 0, 2, 7, '2022-05-30 14:52:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `producttax`
--

CREATE TABLE `producttax` (
  `Prot_Id` bigint(20) NOT NULL,
  `Prot_Name` varchar(255) NOT NULL,
  `Prot_RateFrom` float NOT NULL,
  `Prot_RateTo` float NOT NULL,
  `Prot_Cgst` float NOT NULL,
  `Prot_Sgst` float NOT NULL,
  `Prot_Lgst` float NOT NULL,
  `Prot_ProdID` bigint(20) NOT NULL,
  `Prot_CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Prot_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttax`
--

INSERT INTO `producttax` (`Prot_Id`, `Prot_Name`, `Prot_RateFrom`, `Prot_RateTo`, `Prot_Cgst`, `Prot_Sgst`, `Prot_Lgst`, `Prot_ProdID`, `Prot_CreateDate`, `Prot_modifydate`) VALUES
(71, 'Food Tax', 25, 30, 5, 5, 12, 7, '2022-04-13 17:37:23', '0000-00-00 00:00:00'),
(72, 'Food Tax', 25, 30, 4, 6, 9, 8, '2022-04-13 17:37:31', '0000-00-00 00:00:00'),
(73, 'Food Tax', 25, 30, 5, 5, 8, 9, '2022-04-13 17:37:34', '0000-00-00 00:00:00'),
(74, 'Food Tax', 25, 30, 2, 2, 8, 10, '2022-04-13 17:37:38', '0000-00-00 00:00:00'),
(75, 'Food Tax', 25, 30, 5, 7, 10, 11, '2022-04-13 17:37:48', '0000-00-00 00:00:00'),
(76, 'Food Tax', 25, 30, 23, 27, 28, 12, '2022-04-13 17:37:57', '0000-00-00 00:00:00'),
(77, 'Food Tax', 25, 30, 5, 5, 8, 14, '2022-04-13 17:38:01', '0000-00-00 00:00:00'),
(78, 'Food Tax (chocklate)', 20, 25, 5, 4, 5, 13, '2022-04-20 15:36:18', '0000-00-00 00:00:00'),
(80, 'die fruit tax', 45, 50, 2, 3, 23, 18, '2022-05-06 03:03:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `st_Id` bigint(20) NOT NULL,
  `st_Name` varchar(255) NOT NULL,
  `st_CountryID` bigint(20) NOT NULL,
  `st_status` tinyint(1) NOT NULL,
  `st_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `st_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`st_Id`, `st_Name`, `st_CountryID`, `st_status`, `st_CreatedDate`, `st_modifydate`) VALUES
(3, 'Uttar Pradesh', 3, 0, '2022-03-31 13:38:48', '2022-03-31 17:13:06'),
(4, 'Rajasthan', 3, 0, '2022-03-31 13:43:02', '0000-00-00 00:00:00'),
(5, 'Janakpur', 7, 0, '2022-03-31 13:44:16', '2022-04-07 15:53:33'),
(7, 'Ratnapura', 8, 0, '2022-03-31 15:26:27', '2022-04-07 15:56:03'),
(13, 'Panjab', 3, 0, '2022-04-01 11:52:58', '2022-04-01 13:37:36'),
(15, 'Delhi', 3, 0, '2022-04-06 10:33:01', '2022-04-06 10:43:35'),
(20, 'Panjab', 26, 0, '2022-04-07 15:42:06', '2022-04-07 15:43:24'),
(21, 'Dhanka', 29, 0, '2022-05-06 05:21:01', '2022-05-06 17:51:09'),
(22, 'bihar', 30, 0, '2022-05-09 02:58:30', '2022-05-09 15:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stk_Id` bigint(20) NOT NULL,
  `stk_prodid` bigint(20) NOT NULL,
  `stk_itemid` bigint(20) NOT NULL,
  `stk_attributid` bigint(20) NOT NULL,
  `stk_unitid` bigint(20) NOT NULL,
  `stl_Volumns` float NOT NULL,
  `stk_UserID` bigint(20) NOT NULL,
  `stk_Date` datetime NOT NULL,
  `stk_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `stk_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stk_Id`, `stk_prodid`, `stk_itemid`, `stk_attributid`, `stk_unitid`, `stl_Volumns`, `stk_UserID`, `stk_Date`, `stk_CreatedDate`, `stk_modifydate`) VALUES
(11, 20, 32, 0, 8, 5, 0, '0000-00-00 00:00:00', '2022-05-15 23:08:01', '0000-00-00 00:00:00'),
(12, 18, 31, 0, 1, -6, 0, '0000-00-00 00:00:00', '2022-05-15 23:10:39', '0000-00-00 00:00:00'),
(13, 16, 24, 0, 8, 2, 0, '0000-00-00 00:00:00', '2022-05-15 23:10:48', '0000-00-00 00:00:00'),
(14, 15, 25, 0, 1, 10, 0, '0000-00-00 00:00:00', '2022-05-15 23:11:02', '0000-00-00 00:00:00'),
(15, 14, 23, 0, 1, 15, 0, '0000-00-00 00:00:00', '2022-05-15 23:11:22', '0000-00-00 00:00:00'),
(16, 9, 26, 0, 8, 19, 0, '0000-00-00 00:00:00', '2022-05-15 23:11:53', '0000-00-00 00:00:00'),
(17, 9, 27, 0, 8, 22, 0, '0000-00-00 00:00:00', '2022-05-15 23:12:04', '0000-00-00 00:00:00'),
(18, 8, 12, 0, 1, 5, 0, '0000-00-00 00:00:00', '2022-05-15 23:12:15', '0000-00-00 00:00:00'),
(19, 7, 11, 0, 8, 6, 0, '0000-00-00 00:00:00', '2022-05-15 23:12:36', '0000-00-00 00:00:00'),
(20, 7, 22, 0, 8, 13, 0, '0000-00-00 00:00:00', '2022-05-15 23:12:48', '0000-00-00 00:00:00'),
(21, 7, 28, 0, 8, -1, 0, '0000-00-00 00:00:00', '2022-05-15 23:12:58', '0000-00-00 00:00:00'),
(22, 7, 29, 0, 8, 7, 0, '0000-00-00 00:00:00', '2022-05-15 23:13:09', '0000-00-00 00:00:00'),
(23, 11, 34, 0, 1, 4, 0, '0000-00-00 00:00:00', '2022-05-15 23:16:25', '0000-00-00 00:00:00'),
(25, 21, 39, 0, 8, 13, 0, '0000-00-00 00:00:00', '2022-05-25 06:28:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stockattributedtl`
--

CREATE TABLE `stockattributedtl` (
  `std_Id` bigint(20) NOT NULL,
  `std_AttId` bigint(20) NOT NULL,
  `std_stkId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `theme_setting`
--

CREATE TABLE `theme_setting` (
  `theme_setting_id` bigint(60) NOT NULL,
  `theme_setting_logo` varchar(255) NOT NULL,
  `theme_setting_favicon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theme_setting`
--

INSERT INTO `theme_setting` (`theme_setting_id`, `theme_setting_logo`, `theme_setting_favicon`) VALUES
(1, '1647409935-favicon.ico', '1647409935-favicon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `un_ID` bigint(20) NOT NULL,
  `un_Code` varchar(255) NOT NULL,
  `un_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `un_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`un_ID`, `un_Code`, `un_CreatedDate`, `un_modifydate`) VALUES
(1, 'Kg', '2022-04-01 18:02:51', '0000-00-00 00:00:00'),
(2, 'Liter', '2022-04-01 18:09:12', '0000-00-00 00:00:00'),
(7, 'rgbgt', '2022-04-07 14:45:25', '0000-00-00 00:00:00'),
(8, 'Packet', '2022-04-13 17:30:28', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appsetting`
--
ALTER TABLE `appsetting`
  ADD PRIMARY KEY (`appSetting_Id`),
  ADD UNIQUE KEY `appSetting_Name` (`appSetting_Name`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`att_Id`),
  ADD UNIQUE KEY `att_Name` (`att_Name`);

--
-- Indexes for table `attributedtl`
--
ALTER TABLE `attributedtl`
  ADD PRIMARY KEY (`attd_id`),
  ADD UNIQUE KEY `attd_attid_2` (`attd_attid`,`attd_value`);

--
-- Indexes for table `attributeitem`
--
ALTER TABLE `attributeitem`
  ADD PRIMARY KEY (`iteAtt_id`);

--
-- Indexes for table `attributeprice`
--
ALTER TABLE `attributeprice`
  ADD PRIMARY KEY (`attPrice_Id`),
  ADD UNIQUE KEY `attribute_price` (`attPrice_itemId`,`attPrice_attvaluesId`);

--
-- Indexes for table `cancellationrequest`
--
ALTER TABLE `cancellationrequest`
  ADD PRIMARY KEY (`cancelResq_Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_Id`),
  ADD KEY `cart_UserID` (`cart_UserID`),
  ADD KEY `cart_itemId` (`cart_itemId`),
  ADD KEY `cart_UnitId` (`cart_UnitId`);

--
-- Indexes for table `cartdtl`
--
ALTER TABLE `cartdtl`
  ADD PRIMARY KEY (`cartDtl_Id`),
  ADD KEY `cartDtl_cartid` (`cartDtl_cartid`),
  ADD KEY `cartDtl_attid` (`cartDtl_attid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_Id`),
  ADD UNIQUE KEY `cat_Name` (`cat_Name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ct_Id`),
  ADD UNIQUE KEY `unique_city` (`ct_Name`,`ct_StateId`,`ct_CountryID`),
  ADD KEY `ct_CountryID` (`ct_CountryID`),
  ADD KEY `ct_StateId` (`ct_StateId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`cu_Id`),
  ADD UNIQUE KEY `cu_Name` (`cu_Name`),
  ADD UNIQUE KEY `cu_Code` (`cu_Code`);

--
-- Indexes for table `coupandtl`
--
ALTER TABLE `coupandtl`
  ADD PRIMARY KEY (`CpDtl_Id`),
  ADD KEY `CpDtl_CPID` (`CpDtl_CPID`),
  ADD KEY `CpDtl_itemID` (`CpDtl_itemID`);

--
-- Indexes for table `coupen`
--
ALTER TABLE `coupen`
  ADD PRIMARY KEY (`Cp_ID`),
  ADD UNIQUE KEY `CP_Code` (`CP_Code`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ite_Id`),
  ADD UNIQUE KEY `ite_Name` (`ite_Name`);

--
-- Indexes for table `itemimage`
--
ALTER TABLE `itemimage`
  ADD PRIMARY KEY (`itImg_Id`),
  ADD KEY `itimg_itemID` (`itimg_itemID`);

--
-- Indexes for table `item_reviews`
--
ALTER TABLE `item_reviews`
  ADD PRIMARY KEY (`itemRev_id`);

--
-- Indexes for table `maincategory`
--
ALTER TABLE `maincategory`
  ADD PRIMARY KEY (`Mcat_Id`);

--
-- Indexes for table `mstaddress`
--
ALTER TABLE `mstaddress`
  ADD PRIMARY KEY (`ad_ID`);

--
-- Indexes for table `mstuser`
--
ALTER TABLE `mstuser`
  ADD PRIMARY KEY (`us_Id`),
  ADD UNIQUE KEY `us_EmailID` (`us_EmailID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `orderdtl`
--
ALTER TABLE `orderdtl`
  ADD PRIMARY KEY (`ordDtl_id`);

--
-- Indexes for table `orderdtl_att`
--
ALTER TABLE `orderdtl_att`
  ADD PRIMARY KEY (`orderdtl_attId`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`Os_Id`);

--
-- Indexes for table `orderstaustime`
--
ALTER TABLE `orderstaustime`
  ADD PRIMARY KEY (`ordTime_id`) USING BTREE;

--
-- Indexes for table `pincode_onavailable`
--
ALTER TABLE `pincode_onavailable`
  ADD PRIMARY KEY (`Pin_Id`),
  ADD UNIQUE KEY `Pin_PinCode` (`Pin_PinCode`),
  ADD KEY `Pin_CityId` (`Pin_CityId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_Id`);

--
-- Indexes for table `producttax`
--
ALTER TABLE `producttax`
  ADD PRIMARY KEY (`Prot_Id`),
  ADD KEY `Prot_ProdID` (`Prot_ProdID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`st_Id`),
  ADD UNIQUE KEY `unique_state` (`st_Name`,`st_CountryID`),
  ADD KEY `st_CountryID` (`st_CountryID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stk_Id`),
  ADD KEY `stk_prodid` (`stk_prodid`),
  ADD KEY `stk_itemid` (`stk_itemid`),
  ADD KEY `stk_attributid` (`stk_attributid`),
  ADD KEY `stk_unitid` (`stk_unitid`),
  ADD KEY `stk_UserID` (`stk_UserID`);

--
-- Indexes for table `stockattributedtl`
--
ALTER TABLE `stockattributedtl`
  ADD PRIMARY KEY (`std_Id`),
  ADD UNIQUE KEY `stkAtt_info` (`std_AttId`,`std_stkId`);

--
-- Indexes for table `theme_setting`
--
ALTER TABLE `theme_setting`
  ADD PRIMARY KEY (`theme_setting_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`un_ID`),
  ADD UNIQUE KEY `un_Code` (`un_Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `appSetting_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `att_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `attributedtl`
--
ALTER TABLE `attributedtl`
  MODIFY `attd_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `attributeitem`
--
ALTER TABLE `attributeitem`
  MODIFY `iteAtt_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `attributeprice`
--
ALTER TABLE `attributeprice`
  MODIFY `attPrice_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cancellationrequest`
--
ALTER TABLE `cancellationrequest`
  MODIFY `cancelResq_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601;

--
-- AUTO_INCREMENT for table `cartdtl`
--
ALTER TABLE `cartdtl`
  MODIFY `cartDtl_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ct_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cu_Id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coupandtl`
--
ALTER TABLE `coupandtl`
  MODIFY `CpDtl_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `coupen`
--
ALTER TABLE `coupen`
  MODIFY `Cp_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ite_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `itemimage`
--
ALTER TABLE `itemimage`
  MODIFY `itImg_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `item_reviews`
--
ALTER TABLE `item_reviews`
  MODIFY `itemRev_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `maincategory`
--
ALTER TABLE `maincategory`
  MODIFY `Mcat_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mstaddress`
--
ALTER TABLE `mstaddress`
  MODIFY `ad_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mstuser`
--
ALTER TABLE `mstuser`
  MODIFY `us_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `ord_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `orderdtl`
--
ALTER TABLE `orderdtl`
  MODIFY `ordDtl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `orderdtl_att`
--
ALTER TABLE `orderdtl_att`
  MODIFY `orderdtl_attId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `Os_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderstaustime`
--
ALTER TABLE `orderstaustime`
  MODIFY `ordTime_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pincode_onavailable`
--
ALTER TABLE `pincode_onavailable`
  MODIFY `Pin_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `producttax`
--
ALTER TABLE `producttax`
  MODIFY `Prot_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `st_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stk_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stockattributedtl`
--
ALTER TABLE `stockattributedtl`
  MODIFY `std_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_setting`
--
ALTER TABLE `theme_setting`
  MODIFY `theme_setting_id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `un_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributedtl`
--
ALTER TABLE `attributedtl`
  ADD CONSTRAINT `attributedtl_ibfk_1` FOREIGN KEY (`attd_attid`) REFERENCES `attribute` (`att_Id`),
  ADD CONSTRAINT `attributedtl_ibfk_2` FOREIGN KEY (`attd_attid`) REFERENCES `attribute` (`att_Id`);

--
-- Constraints for table `attributeitem`
--
ALTER TABLE `attributeitem`
  ADD CONSTRAINT `attributeitem_ibfk_1` FOREIGN KEY (`iteAtt_attid`) REFERENCES `attribute` (`att_Id`),
  ADD CONSTRAINT `attributeitem_ibfk_2` FOREIGN KEY (`iteAtt_itemID`) REFERENCES `item` (`ite_Id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_UserID`) REFERENCES `mstuser` (`us_Id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_itemId`) REFERENCES `item` (`ite_Id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`cart_UnitId`) REFERENCES `unit` (`un_ID`);

--
-- Constraints for table `cartdtl`
--
ALTER TABLE `cartdtl`
  ADD CONSTRAINT `cartdtl_ibfk_1` FOREIGN KEY (`cartDtl_cartid`) REFERENCES `cart` (`cart_Id`),
  ADD CONSTRAINT `cartdtl_ibfk_2` FOREIGN KEY (`cartDtl_attid`) REFERENCES `attribute` (`att_Id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`ct_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `city_ibfk_2` FOREIGN KEY (`ct_StateId`) REFERENCES `state` (`st_Id`),
  ADD CONSTRAINT `cu_name` FOREIGN KEY (`ct_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `st_name` FOREIGN KEY (`ct_StateId`) REFERENCES `state` (`st_Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`prod_unitId`) REFERENCES `unit` (`un_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
