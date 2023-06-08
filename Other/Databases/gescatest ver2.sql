-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 06, 2023 at 10:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gescatest`
--

-- --------------------------------------------------------

--
-- Table structure for table `field names`
--

CREATE TABLE `field names` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Field Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Type` set('text','password','date','checkbox') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Name ID` int(10) UNSIGNED NOT NULL,
  `User ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field names`
--

INSERT INTO `field names` (`ID`, `Field Name`, `Type`, `Name ID`, `User ID`) VALUES
(182, 'pole 1', 'text', 41, 12),
(183, 'pole 2', 'text', 41, 12),
(184, 'pole 3', 'text', 41, 12),
(185, 'pole 4', 'text', 41, 12),
(186, 'pole 5', 'password', 41, 12),
(195, 'Name', 'text', 44, 15),
(196, 'Surname', 'text', 44, 15),
(197, 'Name', 'text', 45, 15),
(198, 'isStupid', 'checkbox', 45, 15),
(199, 'created', 'date', 45, 15),
(200, 'a', 'text', 46, 10),
(201, 'b', 'text', 46, 10),
(202, 'c', 'text', 46, 10),
(203, 'd', 'password', 46, 10),
(204, 'saasasas', 'password', 47, 10),
(205, 'saasasas', 'password', 47, 10),
(206, 'saasasas', 'password', 47, 10),
(207, 'saasasas', 'password', 47, 10),
(208, 'saasasas', 'password', 47, 10),
(209, 'saasasas', 'password', 47, 10),
(210, 'saasasas', 'password', 47, 10),
(211, 'saasasas', 'password', 47, 10);

-- --------------------------------------------------------

--
-- Table structure for table `fills`
--

CREATE TABLE `fills` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Content` longtext NOT NULL,
  `Time_Created` date NOT NULL DEFAULT current_timestamp(),
  `User_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fills`
--

INSERT INTO `fills` (`ID`, `Name`, `Content`, `Time_Created`, `User_ID`) VALUES
(13, '', 'Fill Name: \nNo field names found.: \n', '2023-06-06', 10),
(14, '', 'Fill Name: \nNo field names found.: \n', '2023-06-06', 10),
(15, '', 'Fill Name: \nNo field names found.: \n', '2023-06-06', 10),
(16, '', 'Fill Name: \nNo field names found.: \n', '2023-06-06', 10);

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `User ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`ID`, `Name`, `User ID`) VALUES
(41, 'dokument 1', 12),
(44, 'Document 1', 15),
(45, 'Document 2', 15),
(46, 'Testowiec', 10),
(47, 'sdsd', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `User_Name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `User_Name`, `Password`) VALUES
(6, 'Anty1', '$2y$10$Ka77iIemJUKidynARt9RpefIvb4N4W/Qx5FXIHoeb0uozp.o4etDC'),
(7, 'user123', '$2y$10$3EBl9O5gB8ck2GPJN6uAmuTOL9jtoZC1v.p8wEyvhGZYSuyT6dicS'),
(8, 'user321', '$2y$10$Sw4PEANfZMsly0.2mgsu/ey1XPmUn4wWbfRxSuuSYNQT8P/lxOvK.'),
(9, 'mamale1', '$2y$10$hjj2bJi5FEJBUCYQjKZ68.s0eWUuc9qr.DDkS1aW1mesjDZ.SizJC'),
(10, 'super', '$2y$10$A0P1EU1TvA9BToi3zakJEuM.sn0AG1ZpBa9QB27P2DBEB/yda.U2e'),
(11, 'Anty1000', '$2y$10$Yni6Bce6t86SzRGAH/Fmh.LsnEdAL1wnBmTOGYGli/p7NHNfvvxBW'),
(12, 'konto', '$2y$10$wXs9JU0XUz.gzzcQZJjxsOxuN1poNwZxGGhAqSmsCs9CGlv7uuUMa'),
(13, 'konto200', '$2y$10$gklTeeJSx1QZxaFIQKuKPOKQiWpJmi2/WVPjmTIWZCvMWKXQjQ6YS'),
(14, 'marcin', '$2y$10$IXRVUEHdiNH86WnNB2IE8.2ICZSxoyr/HVltYyP/nQ5IvmoF.hrAy'),
(15, 'martin', '$2y$10$BcGLjC.pfbwSDKVCG1h4HO.tBanwzhHEo/MvEkbKATMyymWVPlVR.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `field names`
--
ALTER TABLE `field names`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Name ID` (`Name ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indexes for table `fills`
--
ALTER TABLE `fills`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field names`
--
ALTER TABLE `field names`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `fills`
--
ALTER TABLE `fills`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field names`
--
ALTER TABLE `field names`
  ADD CONSTRAINT `field names_ibfk_1` FOREIGN KEY (`Name ID`) REFERENCES `names` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `field names_ibfk_2` FOREIGN KEY (`User ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fills`
--
ALTER TABLE `fills`
  ADD CONSTRAINT `fills_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `names`
--
ALTER TABLE `names`
  ADD CONSTRAINT `names_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
