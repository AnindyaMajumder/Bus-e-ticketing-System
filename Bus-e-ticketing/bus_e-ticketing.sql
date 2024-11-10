-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 08:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_e-ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(100) NOT NULL DEFAULT '1',
  `Username` varchar(100) NOT NULL DEFAULT 'admin',
  `NID` int(100) NOT NULL,
  `Coach_No` int(199) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT 'Admin',
  `Password` varchar(100) NOT NULL DEFAULT 'adminadmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `NID`, `Coach_No`, `Name`, `Password`) VALUES
('1', 'admin', 0, 0, 'Admin', 'adminadmin');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `NID` int(20) DEFAULT NULL,
  `Coach_No` int(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Trx_ID` varchar(15) NOT NULL,
  `Phone` int(20) NOT NULL,
  `No_of_Person` int(20) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`NID`, `Coach_No`, `Email`, `Trx_ID`, `Phone`, `No_of_Person`, `Date`, `Time`) VALUES
(2346899, 2, 'ashfaqsaad10@gmail.com', '657609c147d94', 1724465562, 2, '0000-00-00', '20:00:00'),
(34567890, 2, 'khanmdshahnewaz0@gmail.com', 'H2NCN437NVB3CS', 1724465562, 2, '0000-00-00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `Coach_No` int(199) NOT NULL,
  `Start` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Driver` varchar(100) NOT NULL,
  `Seat` int(100) NOT NULL,
  `Time` time(6) NOT NULL,
  `Admin_ID` varchar(100) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`Coach_No`, `Start`, `Destination`, `Driver`, `Seat`, `Time`, `Admin_ID`, `Date`) VALUES
(1, 'Dhaka', 'Chittagong', 'Ruhul Mia', 6, '20:00:00.000000', '1', '2023-12-20'),
(2, 'Dhaka', 'Sylhet', 'Anwar Rahman', 7, '20:00:00.000000', '1', '2023-12-20'),
(3, 'Chittagong', 'Dhaka', 'Ruhul Mia', 2, '20:00:00.000000', '1', '2023-12-20'),
(4, 'Sylhet', 'Dhaka', 'Anwar Rahman', 4, '20:00:00.000000', '1', '2023-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `NID` int(20) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `AdminID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`NID`, `Phone`, `Username`, `Name`, `Password`, `AdminID`) VALUES
(2346899, 894739827, 'abcdef', 'Alpha', 'alpha', '1'),
(34567890, 1615791025, 'anindya54', 'Anindya Majumder', 'anindya', '1'),
(1234567890, 1724465562, 'abcd', 'Harry Potter', 'harryharry', '1'),
(2147483647, 1724465562, 'sujit', 'Sujit Majumder', 'sujit', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `AdminID` (`AdminID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Trx_ID`),
  ADD UNIQUE KEY `NID` (`NID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`Coach_No`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`NID`) REFERENCES `customer` (`NID`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
