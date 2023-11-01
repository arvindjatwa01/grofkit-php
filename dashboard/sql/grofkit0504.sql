-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 03:25 PM
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
-- Database: `grofkit`
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
(2, 'Color', 1, 1, 0, 1, '2022-04-04 13:20:58', '0000-00-00 00:00:00'),
(3, 'Size', 0, 1, 0, 1, '2022-04-04 14:41:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributedtl`
--

CREATE TABLE `attributedtl` (
  `attd_id` bigint(20) NOT NULL,
  `attd_attid` bigint(20) NOT NULL,
  `attd_value` bigint(20) NOT NULL,
  `attd_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `attd_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributedtl`
--

INSERT INTO `attributedtl` (`attd_id`, `attd_attid`, `attd_value`, `attd_CreatedDate`, `attd_modifydate`) VALUES
(1, 2, 3, '2022-04-04 15:12:13', '0000-00-00 00:00:00'),
(2, 3, 5, '2022-04-04 15:12:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributeitem`
--

CREATE TABLE `attributeitem` (
  `iteAtt_id` bigint(20) NOT NULL,
  `iteAtt_attid` bigint(20) NOT NULL,
  `iteAtt_value` varchar(255) NOT NULL,
  `iteAtt_itemID` bigint(20) NOT NULL,
  `iteAtt_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `iteAtt_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeitem`
--

INSERT INTO `attributeitem` (`iteAtt_id`, `iteAtt_attid`, `iteAtt_value`, `iteAtt_itemID`, `iteAtt_CreatedDate`, `iteAtt_modifydate`) VALUES
(2, 3, '6', 2, '2022-04-04 16:07:49', '0000-00-00 00:00:00'),
(3, 2, '4', 1, '2022-04-04 16:08:14', '0000-00-00 00:00:00');

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
(2, 4, 2, 5, 2, '2022-04-04 18:16:11', '0000-00-00 00:00:00'),
(3, 2, 1, 5, 1, '2022-04-04 18:17:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cartdtl`
--

CREATE TABLE `cartdtl` (
  `cartDtl_Id` bigint(20) NOT NULL,
  `cartDtl_cartid` bigint(20) NOT NULL,
  `cartDtl_attid` bigint(20) NOT NULL,
  `cartDtl_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cartDtl_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartdtl`
--

INSERT INTO `cartdtl` (`cartDtl_Id`, `cartDtl_cartid`, `cartDtl_attid`, `cartDtl_CreatedDate`, `cartDtl_modifydate`) VALUES
(1, 3, 2, '2022-04-04 18:43:16', '0000-00-00 00:00:00'),
(2, 2, 3, '2022-04-04 18:44:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_Id` bigint(20) NOT NULL,
  `cat_Name` varchar(255) NOT NULL,
  `cat_UnderCatID` bigint(20) NOT NULL,
  `cat_IsMainCat` tinyint(1) NOT NULL,
  `cat_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `cat_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_Id`, `cat_Name`, `cat_UnderCatID`, `cat_IsMainCat`, `cat_CreatedDate`, `cat_modifydate`) VALUES
(2, 'Parle-G', 4, 0, '2022-04-01 16:44:26', '2022-04-01 17:34:06'),
(5, 'Parampara', 1, 0, '2022-04-05 16:59:43', '0000-00-00 00:00:00');

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
(2, 'Jaipur', 4, 3, 0, '2022-03-31 16:41:07', '2022-03-31 18:01:26'),
(3, 'Ajmer', 4, 3, 0, '2022-03-31 17:07:24', '2022-03-31 17:10:52'),
(4, 'Lucknow', 3, 3, 0, '2022-03-31 17:12:10', '0000-00-00 00:00:00'),
(6, 'Kota', 4, 8, 0, '2022-04-01 12:45:53', '0000-00-00 00:00:00');

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
(3, 'India', '+91', 1, '2022-03-31 12:19:52', '0000-00-00 00:00:00'),
(7, 'Nepal', '+977', 0, '2022-03-31 12:42:23', '0000-00-00 00:00:00'),
(8, 'Sri Lanka', '+94', 1, '2022-03-31 12:52:16', '0000-00-00 00:00:00'),
(21, 'Australia', '+61', 1, '2022-04-05 16:13:06', '2022-04-05 18:45:39');

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
(1, 2, 1, 2, '2022-04-04 17:35:24', '0000-00-00 00:00:00'),
(2, 1, 2, 1, '2022-04-04 17:37:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupen`
--

CREATE TABLE `coupen` (
  `Cp_ID` bigint(20) NOT NULL,
  `CP_Code` varchar(255) NOT NULL,
  `CP_Volumn` float NOT NULL,
  `CP_InAmount` float NOT NULL,
  `CP_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CP_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupen`
--

INSERT INTO `coupen` (`Cp_ID`, `CP_Code`, `CP_Volumn`, `CP_InAmount`, `CP_CreatedDate`, `CP_modifydate`) VALUES
(1, 'MB24RTYDF56', 6, 75.9, '2022-04-04 16:41:45', '0000-00-00 00:00:00'),
(2, 'MB24RTYDF45', 8, 85.25, '2022-04-04 16:43:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ite_Id` bigint(20) NOT NULL,
  `ite_Name` varchar(255) NOT NULL,
  `ite_sku` varchar(255) NOT NULL,
  `ite_Descripton` varchar(255) NOT NULL,
  `ite_BaseRate` float NOT NULL,
  `ite_Rate` float NOT NULL,
  `ite_MRP` float NOT NULL,
  `ite_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ite_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ite_Id`, `ite_Name`, `ite_sku`, `ite_Descripton`, `ite_BaseRate`, `ite_Rate`, `ite_MRP`, `ite_CreatedDate`, `ite_modifydate`) VALUES
(1, 'abc', 'MBC12NOP34', 'asdesf', 60, 55, 75, '2022-04-04 12:06:55', '0000-00-00 00:00:00'),
(2, 'xyzr', 'MBC12NOP67', 'asdesf', 70, 68, 87, '2022-04-04 12:08:45', '0000-00-00 00:00:00');

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
(6, 'http://localhost/grofkit/uploads/item_image/624be724c2642-w3.jpg', 0, 1, '2022-04-05 12:22:20', '0000-00-00 00:00:00'),
(7, 'http://localhost/grofkit/uploads/item_image/624bee142df56-w1.jpg', 0, 2, '2022-04-05 12:24:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

CREATE TABLE `maincategory` (
  `Mcat_Id` bigint(20) NOT NULL,
  `Mcat_Name` varchar(255) NOT NULL,
  `Mcat_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Mcat_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`Mcat_Id`, `Mcat_Name`, `Mcat_CreatedDate`, `Mcat_modifydate`) VALUES
(1, 'Oil', '2022-04-01 16:06:23', '0000-00-00 00:00:00'),
(2, 'Sugar', '2022-04-01 16:07:26', '2022-04-01 16:16:07'),
(4, 'Biscuit', '2022-04-01 16:18:29', '0000-00-00 00:00:00');

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
  `us_dob` datetime NOT NULL,
  `us_gender` varchar(255) NOT NULL,
  `us_active` tinyint(1) NOT NULL,
  `us_CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `us_modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstuser`
--

INSERT INTO `mstuser` (`us_Id`, `us_UserName`, `us_Password`, `us_EmailID`, `us_mobileNo`, `us_dob`, `us_gender`, `us_active`, `us_CreateDate`, `us_modifydate`) VALUES
(1, 'Rohan', '1234', 'r@gmail', '9876543201', '1997-03-19 00:00:00', 'male', 0, '2022-03-31 18:44:09', '0000-00-00 00:00:00'),
(2, 'Manisha', '1234', 'm@gmail.com', '9876543203', '1999-08-09 00:00:00', 'female', 0, '2022-03-31 18:58:53', '2022-04-01 15:06:07'),
(4, 'Mohan', '1234', 'm1@gmail.com', '9876543222', '2000-09-01 00:00:00', 'male', 0, '2022-04-01 15:16:10', '2022-04-01 15:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `pincode_onavailable`
--

CREATE TABLE `pincode_onavailable` (
  `Pin_Id` bigint(20) NOT NULL,
  `Pin_Name` varchar(255) NOT NULL,
  `Pin_PinCode` varchar(255) NOT NULL,
  `Pin_CityId` bigint(20) NOT NULL,
  `Pin_delivaryCost` float NOT NULL,
  `Pin_CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Pin_modifydate` datetime NOT NULL,
  `Pin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincode_onavailable`
--

INSERT INTO `pincode_onavailable` (`Pin_Id`, `Pin_Name`, `Pin_PinCode`, `Pin_CityId`, `Pin_delivaryCost`, `Pin_CreatedDate`, `Pin_modifydate`, `Pin_status`) VALUES
(1, 'abc', '234567', 3, 45.89, '2022-03-31 17:42:16', '0000-00-00 00:00:00', 0),
(2, 'xyz', '303245', 4, 80, '2022-03-31 17:54:23', '2022-03-31 18:01:03', 0),
(4, 'abc', '303246', 2, 45.89, '2022-04-01 09:50:06', '0000-00-00 00:00:00', 0);

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
(1, 'eas', 2, 'sf', '5tys', 0, 45.89, 1, '2022-04-04 10:13:51', '0000-00-00 00:00:00'),
(2, 'trft wdwe', 2, 'sfdsgfsd 3', 'styz sd', 1, 56.85, 1, '2022-04-04 10:32:38', '0000-00-00 00:00:00');

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
(1, 'Food Tax', 25, 35, 24.45, 27.23, 23.45, 1, '2022-04-04 11:25:11', '0000-00-00 00:00:00'),
(2, 'OilTax', 21, 27.48, 23, 26.67, 28, 2, '2022-04-04 11:31:28', '0000-00-00 00:00:00');

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
(5, 'Bagmati Pradesh', 7, 0, '2022-03-31 13:44:16', '0000-00-00 00:00:00'),
(7, 'Northland', 8, 0, '2022-03-31 15:26:27', '2022-04-01 09:47:49'),
(13, 'Panjab', 3, 0, '2022-04-01 11:52:58', '2022-04-01 13:37:36');

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
(1, 2, 1, 3, 1, 23, 1, '0000-00-00 00:00:00', '2022-04-05 10:25:53', '0000-00-00 00:00:00'),
(2, 2, 2, 2, 2, 56, 2, '0000-00-00 00:00:00', '2022-04-05 10:46:37', '0000-00-00 00:00:00');

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
(2, 'Liter', '2022-04-01 18:09:12', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

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
  ADD KEY `attd_attid` (`attd_attid`);

--
-- Indexes for table `attributeitem`
--
ALTER TABLE `attributeitem`
  ADD PRIMARY KEY (`iteAtt_id`),
  ADD KEY `iteAtt_attid` (`iteAtt_attid`),
  ADD KEY `iteAtt_itemID` (`iteAtt_itemID`);

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
  ADD UNIQUE KEY `cat_Name` (`cat_Name`),
  ADD KEY `cat_UnderCatID` (`cat_UnderCatID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ct_Id`),
  ADD UNIQUE KEY `ct_Name` (`ct_Name`),
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
  ADD KEY `CpDtl_itemID` (`CpDtl_itemID`),
  ADD KEY `CpDtl_UserID` (`CpDtl_UserID`);

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
  ADD UNIQUE KEY `ite_sku` (`ite_sku`),
  ADD UNIQUE KEY `ite_Name` (`ite_Name`);

--
-- Indexes for table `itemimage`
--
ALTER TABLE `itemimage`
  ADD PRIMARY KEY (`itImg_Id`),
  ADD KEY `itimg_itemID` (`itimg_itemID`);

--
-- Indexes for table `maincategory`
--
ALTER TABLE `maincategory`
  ADD PRIMARY KEY (`Mcat_Id`),
  ADD UNIQUE KEY `Mcat_Name` (`Mcat_Name`);

--
-- Indexes for table `mstuser`
--
ALTER TABLE `mstuser`
  ADD PRIMARY KEY (`us_Id`),
  ADD UNIQUE KEY `us_EmailID` (`us_EmailID`),
  ADD UNIQUE KEY `us_mobileNo` (`us_mobileNo`);

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
  ADD PRIMARY KEY (`prod_Id`),
  ADD KEY `prod_CatID` (`prod_CatID`),
  ADD KEY `prod_unitId` (`prod_unitId`);

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
  ADD UNIQUE KEY `st_Name` (`st_Name`),
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
-- Indexes for table `theme_setting`
--
ALTER TABLE `theme_setting`
  ADD PRIMARY KEY (`theme_setting_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`un_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `att_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attributedtl`
--
ALTER TABLE `attributedtl`
  MODIFY `attd_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributeitem`
--
ALTER TABLE `attributeitem`
  MODIFY `iteAtt_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cartdtl`
--
ALTER TABLE `cartdtl`
  MODIFY `cartDtl_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ct_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cu_Id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `coupandtl`
--
ALTER TABLE `coupandtl`
  MODIFY `CpDtl_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupen`
--
ALTER TABLE `coupen`
  MODIFY `Cp_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ite_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itemimage`
--
ALTER TABLE `itemimage`
  MODIFY `itImg_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maincategory`
--
ALTER TABLE `maincategory`
  MODIFY `Mcat_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mstuser`
--
ALTER TABLE `mstuser`
  MODIFY `us_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pincode_onavailable`
--
ALTER TABLE `pincode_onavailable`
  MODIFY `Pin_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `producttax`
--
ALTER TABLE `producttax`
  MODIFY `Prot_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `st_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stk_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theme_setting`
--
ALTER TABLE `theme_setting`
  MODIFY `theme_setting_id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `un_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributedtl`
--
ALTER TABLE `attributedtl`
  ADD CONSTRAINT `attributedtl_ibfk_1` FOREIGN KEY (`attd_attid`) REFERENCES `attribute` (`att_Id`);

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
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`cat_UnderCatID`) REFERENCES `maincategory` (`Mcat_Id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`ct_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `city_ibfk_2` FOREIGN KEY (`ct_StateId`) REFERENCES `state` (`st_Id`),
  ADD CONSTRAINT `cu_name` FOREIGN KEY (`ct_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `st_name` FOREIGN KEY (`ct_StateId`) REFERENCES `state` (`st_Id`);

--
-- Constraints for table `coupandtl`
--
ALTER TABLE `coupandtl`
  ADD CONSTRAINT `coupandtl_ibfk_1` FOREIGN KEY (`CpDtl_CPID`) REFERENCES `coupen` (`Cp_ID`),
  ADD CONSTRAINT `coupandtl_ibfk_2` FOREIGN KEY (`CpDtl_itemID`) REFERENCES `item` (`ite_Id`),
  ADD CONSTRAINT `coupandtl_ibfk_3` FOREIGN KEY (`CpDtl_UserID`) REFERENCES `mstuser` (`us_Id`);

--
-- Constraints for table `itemimage`
--
ALTER TABLE `itemimage`
  ADD CONSTRAINT `itemimage_ibfk_1` FOREIGN KEY (`itimg_itemID`) REFERENCES `item` (`ite_Id`);

--
-- Constraints for table `pincode_onavailable`
--
ALTER TABLE `pincode_onavailable`
  ADD CONSTRAINT `ct_Id` FOREIGN KEY (`Pin_CityId`) REFERENCES `city` (`ct_Id`),
  ADD CONSTRAINT `pincode_onavailable_ibfk_1` FOREIGN KEY (`Pin_CityId`) REFERENCES `city` (`ct_Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`prod_CatID`) REFERENCES `category` (`cat_Id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`prod_unitId`) REFERENCES `unit` (`un_ID`);

--
-- Constraints for table `producttax`
--
ALTER TABLE `producttax`
  ADD CONSTRAINT `producttax_ibfk_1` FOREIGN KEY (`Prot_ProdID`) REFERENCES `product` (`prod_Id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`st_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`st_CountryID`) REFERENCES `country` (`cu_Id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`stk_prodid`) REFERENCES `product` (`prod_Id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`stk_itemid`) REFERENCES `item` (`ite_Id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`stk_attributid`) REFERENCES `attribute` (`att_Id`),
  ADD CONSTRAINT `stock_ibfk_4` FOREIGN KEY (`stk_unitid`) REFERENCES `unit` (`un_ID`),
  ADD CONSTRAINT `stock_ibfk_5` FOREIGN KEY (`stk_UserID`) REFERENCES `mstuser` (`us_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
