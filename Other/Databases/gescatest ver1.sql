-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 05, 2023 at 11:45 AM
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
  `Type` set('A','B','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Name ID` int(10) UNSIGNED NOT NULL,
  `User ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field names`
--

INSERT INTO `field names` (`ID`, `Field Name`, `Type`, `Name ID`, `User ID`) VALUES
(146, 'Super5', 'A', 26, 10),
(147, 'Super5', 'A', 26, 10),
(148, 'Super5', 'B', 26, 10),
(149, 'sdsd', 'A', 27, 10),
(150, 'sdsd', 'A', 27, 10),
(151, 'sdsd', 'A', 27, 10),
(152, 'sdsd', 'A', 32, 10),
(153, 'sdsd', 'A', 32, 10),
(154, 'sdsd', 'A', 32, 10),
(155, 'sdsd', 'A', 32, 10),
(156, 'Super5', 'A', 33, 10),
(157, 'Super5', 'A', 33, 10),
(158, 'Super5', 'A', 33, 10),
(159, 'Super5', 'A', 33, 10),
(160, 'Super5', 'A', 33, 10),
(161, 'Super5', 'A', 33, 10),
(162, 'Super5', 'A', 35, 10),
(163, 'Super5', 'A', 35, 10),
(164, 'Super5', 'A', 35, 10),
(165, 'Super5', 'B', 36, 10),
(166, 'Super5', 'B', 36, 10),
(167, 'Super5', 'B', 36, 10),
(168, 'Super4', 'B', 36, 10),
(169, 'Super4434', 'B', 36, 10),
(170, 'Super44342', 'B', 36, 10);

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
(26, 'Test', 10),
(27, 'Test', 10),
(28, 'Test', 10),
(29, 'Test', 10),
(30, 'Test', 10),
(31, 'Test', 10),
(32, 'Test', 10),
(33, 'asas', 10),
(34, '', 10),
(35, 'asas', 10),
(36, 'asas', 10);

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
(11, 'Anty1000', '$2y$10$Yni6Bce6t86SzRGAH/Fmh.LsnEdAL1wnBmTOGYGli/p7NHNfvvxBW');

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
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `names`
--
ALTER TABLE `names`
  ADD CONSTRAINT `names_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
