-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2019 at 06:28 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queue`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `rules` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `telephone`, `rules`) VALUES
(11, 'chanisara', 'f15478148ee64990628825ac893cb067', 'chanisaramint@gmaill.com', 'sdsd', 'write'),
(12, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'test@gmail.com', '0881743803', 'read'),
(13, 'fon', '81dc9bdb52d04dc20036dbd8313ed055', 'fon@gmail.com', '0881743803', 'admin'),
(14, 'root', '81dc9bdb52d04dc20036dbd8313ed055', 'root@root.com', '0881743803', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_log`
--

CREATE TABLE `chatbot_log` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID_Customer` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Username` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Password` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT '10',
  `Name` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Telephone` varchar(20) COLLATE utf32_unicode_ci DEFAULT '10',
  `Address` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `name_line` text COLLATE utf32_unicode_ci NOT NULL,
  `image` text COLLATE utf32_unicode_ci NOT NULL,
  `status` text COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_Customer`, `Username`, `Password`, `Name`, `Email`, `Telephone`, `Address`, `name_line`, `image`, `status`) VALUES
('U0b3954deeb4456cce6599a10dbec8142', 'neoxbus', '03250325', 'สมศักดิ์ ชลปฐมพิกุเล', 'somsak@mfec.co.th', '11', '', 'NeoXbuS', 'https://profile.line-scdn.net/0hxoDHUUWlJ0B5MQ1YjutYF0V0KS0OHyEIAV9vJlU1cHNVBGlBQ1I_Jw41f3YAVjMVFgNtclphcHlX', 'The wheels on the NeoXbuS :: (I)(C)(E)(&)(E)(A)(R)(T)(H)'),
('U1edd58867ca0fc89f62fb769f01b81ea', 'Mtaro', '12345', 'M-Taro', '', '12', '', 'M-TaRo', 'https://profile.line-scdn.net/0h4pFStid8a197KkCLeMYUCEdvZTIMBG0XAx8mO1t9PWYEGyUAQBwgbF0oYWtSEyRZRR4iMFZ5N2YG', 'undefined'),
('U704206d0d42f6d9870de04dc66ff3c79', 'Pao', '1234', 'Bunjin', 'pao@mail.com', '13', 'Bangkok', 'Pao.bunjin', 'https://profile.line-scdn.net/0hnNQMyWI1MWFsNBytHaZONlBxPwwbGjcpFFErVR1jPFgVAHI2AAV_AUhjP1EVUSZlAwctAUE0OFBG', 'Stabilizer...'),
('Uae782cbe14f6e71e0f01daf8b5ffe1b2', '', '1659900825457', 'Mint', 'chanisaramint@hotmail.com', '0881743803', 'Ee', 'Mint Mint', 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg', '(Argh!)'),
('Uf7afd8a7737acf41d756a1ec218eed36', 'brfon', 'fjdjxj', 'Mj', 'difiwi@djrj.com', '15', 'เนำต้', 'fon', 'https://profile.line-scdn.net/0hTJ-TVEyZC2UQLSBF7s90MixoBQhnAw0taE4TBjctXFU9SRszfktMVjIvU1E4Hk46KUtBAjMuXAY0', '36 m ♡');

-- --------------------------------------------------------

--
-- Table structure for table `customer_queue`
--

CREATE TABLE `customer_queue` (
  `ID_Queue` int(50) NOT NULL,
  `ID_customer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `End_Time` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Status_Queue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Status_TypeQueue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Queue_Time` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Start_Time` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_queue`
--

INSERT INTO `customer_queue` (`ID_Queue`, `ID_customer`, `End_Time`, `Status_Queue`, `Status_TypeQueue`, `Date`, `Queue_Time`, `Start_Time`, `pic`) VALUES
(1210, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '15:31:22', 'Other', 'complete', '2019-11-19', '15:15:18', '15:31:21', 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1211, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '15:51:05', 'other', 'complete', '2019-11-19', '15:42:28', '15:50:52', 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1212, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '15:51:22', 'Other', 'complete', '2019-11-19', '15:51:18', '15:51:22', 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1213, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '', 'Other', 'Waiting', '2019-11-19', '15:51:33', NULL, 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1214, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '09:42:36', 'other', 'cancel', '2019-11-20', '09:42:27', NULL, 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1215, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '10:23:17', 'other', 'cancel', '2019-11-20', '10:22:56', NULL, 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg'),
(1216, 'Uae782cbe14f6e71e0f01daf8b5ffe1b2', '12:35:56', 'other', 'cancel', '2019-11-20', '12:35:43', NULL, 'https://profile.line-scdn.net/0h889qDi7XZxcECEyinmQYQDhNaXpzJmFffDkpIyMKaiEpMHRAPTstJnFaPyd8PyJDbGd8eShaaXQg');

-- --------------------------------------------------------

--
-- Table structure for table `skn`
--

CREATE TABLE `skn` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skn`
--

INSERT INTO `skn` (`name`, `Tel`, `ID`) VALUES
('สมศักดิ์ ชลปฐมพิกุเล', '11', 1),
('Bunjin', '13', 3),
('a', '14', 4),
('Mj', '15', 5),
('Mint', '15', 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chatbot_log`
--
ALTER TABLE `chatbot_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_Customer`);

--
-- Indexes for table `customer_queue`
--
ALTER TABLE `customer_queue`
  ADD PRIMARY KEY (`ID_Queue`),
  ADD KEY `ID_customer` (`ID_customer`) USING BTREE;

--
-- Indexes for table `skn`
--
ALTER TABLE `skn`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chatbot_log`
--
ALTER TABLE `chatbot_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_queue`
--
ALTER TABLE `customer_queue`
  MODIFY `ID_Queue` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1217;

--
-- AUTO_INCREMENT for table `skn`
--
ALTER TABLE `skn`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
