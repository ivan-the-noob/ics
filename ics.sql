-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 11:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `ics`
--

CREATE TABLE `ics` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(50) NOT NULL DEFAULT 'unit',
  `unit_cost` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `inventory_item` varchar(100) NOT NULL,
  `estimated_life` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ics`
--

INSERT INTO `ics` (`id`, `quantity`, `unit`, `unit_cost`, `total_cost`, `description`, `inventory_item`, `estimated_life`, `created_at`, `image`, `email`) VALUES
(2, 3, '1', 1.00, 1.00, '1', '1', 'N/A', '2025-03-17 01:03:37', 'img_67e21013a75607.56060426.png', ''),
(3, 0, '1', 1.00, 2.00, 'dasdasds', '1', '5 years', '2025-03-17 03:04:09', 'img_67e215c2e267d1.78732467.jpg', ''),
(5, 0, 'AA', 1.00, 1.00, 'A', 'A', '', '2025-05-30 08:36:36', NULL, ''),
(6, 0, '1', 11.00, 121.00, '1', '1', '', '2025-05-30 08:40:24', NULL, 'admin@gmail.com'),
(7, 0, '1', 1.00, 1.00, '1', '1', '', '2025-05-30 08:47:23', NULL, '<br />\r\n<b>Warning</b>:  Undefined variable $UserEmail in <b>C:\\xampp\\htdocs\\ics\\features\\admin\\web\\semi-expandable.php</b> on line <b>155</b><br />\r\n'),
(8, 0, '1', 11.00, 11.00, '1', '1', '', '2025-05-30 08:50:36', 'img_6839717e4ffc16.04847527.jpg', 'admin@gmail.com');

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
  `in_charge` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `article`, `description`, `property_number`, `unit_measure`, `unit_value`, `qty_per_phy_count`, `quantity`, `value`, `remarks`, `in_charge`, `email`) VALUES
(10, 'ICT EQUIPMENT', 'Laptop, HP 242 Notebook (Batch no. 25)', '2014-05-03-0001-12', 'Package', 26000.00, 1, 1, 1.00, 'Serviceable', 'Mr. Manalo', ''),
(16, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', 'Laptop', '2014-05-03-0001-12', '33', 33.00, 33, 33, 33.00, '321', '12', ''),
(17, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', 'test', '2014-05-03-0001-12', '1', 1.00, 1, 1, 1.00, 'test', 'test', ''),
(18, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', '1', '1', '1', 1.00, 1, 1, 1.00, '1', '1', ''),
(19, 'SEMI-EXPENDABLE TECHNICAL & SCIENTIFIC EQUIPMENT', 'dasdasds', '1', '1', 1.00, 1, 2, 1.00, '1', '1', ''),
(20, 'SEMI-EXPENDABLE TECHNICAL & SCIENTIFIC EQUIPMENT', 'dsadas', 'd', '312', 312.00, 312, 12321, 12.00, '1232', '132', ''),
(21, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', 'A', 'A', 'AA', 1.00, 1, 1, 1.00, '1', '1', ''),
(22, 'SEMI-EXPENDABLE TECHNICAL & SCIENTIFIC EQUIPMENT', '1', '1', '1', 11.00, 1, 11, 1.00, '1', '1', ''),
(23, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', '1', '1', '1', 1.00, 1, 1, 1.00, '1', '1', '<br />\n<b>Warning</b>:  Undefined variable $UserEmail in <b>C:\\xampp\\htdocs\\ics\\features\\admin\\web\\semi-expandable.php</b> on line <b>155</b><br />\n'),
(24, 'SEMI-EXPENDABLE OFFICE EQUIPMENT', '1', '1', '1', 11.00, 1, 1, 1.00, '1', '1', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_info`
--

CREATE TABLE `pdf_info` (
  `id` int(11) NOT NULL,
  `accountable_officer` varchar(255) NOT NULL,
  `official_description` varchar(255) NOT NULL,
  `agency_office` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel_no` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_info`
--

INSERT INTO `pdf_info` (`id`, `accountable_officer`, `official_description`, `agency_office`, `year`, `address`, `email`, `tel_no`, `created_at`) VALUES
(1, 'Louie G. Vergaras', 'School Principal', 'Sangley Elementary School', 'January 2025', 'Riego De Dios Street, Sangley Point, Cavite City - 4100', 'sangleyelementaryschool@gmail.com', '(046) 431-7187', '2025-03-18 06:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `school_name`, `email`, `password`) VALUES
(1, 'CVSU', 'ejivancablanida@gmail.com', '$2y$10$u8iQQt.oaSGwWQ5uKvzJwuD534FzuNnPEt0bNV9zyh4wZRaIHfH5G'),
(2, 'Sangley ES', '109631@gmail.com', '$2y$10$oLO1Jn0OTdDREYtThUQdnuvX840H5JBjV4CgjHD9kVTn/dWZOtxfW'),
(3, 'admin', 'admin@gmail.com', '$2y$10$m/DxOJMWNigH5uFfqU5y6urL7EMGD0n41UzufZdVB6FBGj2/zBEJ.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ics`
--
ALTER TABLE `ics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_info`
--
ALTER TABLE `pdf_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ics`
--
ALTER TABLE `ics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pdf_info`
--
ALTER TABLE `pdf_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
