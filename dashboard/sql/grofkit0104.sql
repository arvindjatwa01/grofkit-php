-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 03:30 PM
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
(3, 'Parampara', 1, 0, '2022-04-01 16:45:17', '2022-04-01 17:34:03');

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
(6, 'Kota', 4, 8, 0, '2022-04-01 12:45:53', '0000-00-00 00:00:00'),
(8, 'Karauli', 4, 3, 0, '2022-04-01 13:39:25', '0000-00-00 00:00:00');

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
(8, 'Sri Lanka', '+94', 1, '2022-03-31 12:52:16', '0000-00-00 00:00:00');

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
(13, 'Panjab', 3, 0, '2022-04-01 11:52:58', '2022-04-01 13:37:36'),
(14, 'Panjab 2', 8, 0, '2022-04-01 12:10:05', '2022-04-01 12:11:51');

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_Id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ct_Id`),
  ADD UNIQUE KEY `ct_Name` (`ct_Name`),
  ADD KEY `st_name` (`ct_StateId`),
  ADD KEY `cu_name` (`ct_CountryID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`cu_Id`),
  ADD UNIQUE KEY `cu_Name` (`cu_Name`),
  ADD UNIQUE KEY `cu_Code` (`cu_Code`);

--
-- Indexes for table `maincategory`
--
ALTER TABLE `maincategory`
  ADD PRIMARY KEY (`Mcat_Id`);

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
  ADD KEY `ct_Id` (`Pin_CityId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_Id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`st_Id`),
  ADD UNIQUE KEY `st_Name` (`st_Name`),
  ADD KEY `fk_cat` (`st_CountryID`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ct_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cu_Id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `prod_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `st_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `theme_setting`
--
ALTER TABLE `theme_setting`
  MODIFY `theme_setting_id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `un_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `cu_name` FOREIGN KEY (`ct_CountryID`) REFERENCES `country` (`cu_Id`),
  ADD CONSTRAINT `st_name` FOREIGN KEY (`ct_StateId`) REFERENCES `state` (`st_Id`);

--
-- Constraints for table `pincode_onavailable`
--
ALTER TABLE `pincode_onavailable`
  ADD CONSTRAINT `ct_Id` FOREIGN KEY (`Pin_CityId`) REFERENCES `city` (`ct_Id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`st_CountryID`) REFERENCES `country` (`cu_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
