-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 08:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(6) UNSIGNED NOT NULL,
  `article` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `property_number` varchar(255) NOT NULL,
  `unit_measure` varchar(50) NOT NULL,
  `unit_value` decimal(10,2) NOT NULL,
  `qty_per_phy_count` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `remarks` text DEFAULT NULL,
  `in_charge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `article`, `description`, `property_number`, `unit_measure`, `unit_value`, `qty_per_phy_count`, `quantity`, `value`, `remarks`, `in_charge`) VALUES
(10, 'ICT EQUIPMENT', 'Laptop, HP 242 Notebook (Batch no. 25)', '2014-05-03-0001-12', 'Package', '26000.00', 1, 1, '1.00', 'Serviceable', 'Mr. Manalo'),
(16, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', 'Laptop', '2014-05-03-0001-12', '33', '33.00', 33, 33, '33.00', '321', '12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
