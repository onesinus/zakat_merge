-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 07:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `description` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masters`
--

INSERT INTO `masters` (`id`, `code`, `description`) VALUES
(4, 'M01', 'Zakat Fitrah'),
(5, 'M05', 'Zakat Harta'),
(6, 'M06', 'Infak'),
(7, 'M07', 'Sedekah');

-- --------------------------------------------------------

--
-- Table structure for table `mustahik`
--

CREATE TABLE `mustahik` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mustahik`
--

INSERT INTO `mustahik` (`id`, `name`, `phone_number`, `address`) VALUES
(1, 'Bambang Skuy', '912092101920', 'Cakung Ajah'),
(3, 'Udin Penyok', '921873982173', 'Jagakarsa'),
(5, 'Oke', '0120391', 'Test'),
(6, 'Okelah kalau gitu', '231321', 'test'),
(7, 'Gaje', '123213213', 'TEst');

-- --------------------------------------------------------

--
-- Table structure for table `muzakki`
--

CREATE TABLE `muzakki` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `receive_type` varchar(25) NOT NULL,
  `receive_date` datetime DEFAULT NULL,
  `master_id` int(11) NOT NULL,
  `description` varchar(512) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(16,2) NOT NULL,
  `grand_total` decimal(16,2) NOT NULL,
  `is_validated` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `muzakki`
--

INSERT INTO `muzakki` (`id`, `name`, `phone_number`, `type`, `receive_type`, `receive_date`, `master_id`, `description`, `qty`, `total`, `grand_total`, `is_validated`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`, `is_deleted`) VALUES
(5, 'Ibnu Umar', '0895387836483', 'UANG', '1', NULL, 1, 'Pembayaran Zakat  Fitrah 1 keluarga', 2, '50000.00', '100000.00', 0, 'Open', 0, '2021-01-09 13:28:02', NULL, NULL, 1),
(6, 'test', '0912039210', 'Beras/Makanan/Barang/lain', 'Transfer', '2021-12-31 00:00:00', 4, 'Asoy', 24, '40000.00', '960000.00', 0, 'Open', 18, '2021-01-12 21:08:26', NULL, NULL, 1),
(7, 'Oke', '09120390213', 'Uang', 'Antar', '2021-12-31 00:00:00', 5, 'Zakat Sekeluarga Bray', 20, '150000.00', '3000000.00', 0, 'Closed', 18, '2021-01-14 20:22:19', 18, '2021-01-22 20:54:00', 0),
(8, 'Asikuy', '12321321', 'Makanan', 'Cash/Jemput', '2021-01-14 00:00:00', 7, 'Paboa Ma Jolo', 2, '10.00', '20.00', 0, 'Closed', 18, '2021-01-14 21:24:53', 18, '2021-01-24 12:35:14', 0),
(9, 'Boasa Dang Tibu', '081293891', 'Uang', 'Transfer', '2021-12-31 00:00:00', 5, 'Keluarga Boasa', 1, '20000000.00', '20000000.00', 0, 'Open', 0, '2021-01-14 21:34:38', NULL, NULL, 0),
(10, 'Hape ro Ma siboru', '12321321', 'Beras', 'Cash/Jemput', '2021-12-30 00:00:00', 7, 'Haduan', 2, '2500000.00', '5000000.00', 0, 'Closed', 0, '2021-01-14 21:38:47', 18, '2021-01-14 22:29:45', 0),
(11, 'Hape ro Ma siboru', '12321321', 'Beras', 'Cash/Jemput', '2021-12-30 00:00:00', 7, 'Haduan', 2, '2500000.00', '5000000.00', 0, 'Pickup', 0, '2021-01-14 21:38:56', NULL, NULL, 1),
(12, 'ABC', '123', 'Uang', 'Transfer', '2021-12-31 00:00:00', 5, 'AWWWWW', 1, '2000000.00', '2000000.00', 0, 'Open', 0, '2021-01-14 21:39:19', NULL, NULL, 1),
(13, 'test', '123', 'Uang', 'Transfer', '2021-12-31 00:00:00', 4, 'test', 1, '2.00', '2.00', 0, 'Open', 0, '2021-01-14 21:39:50', NULL, NULL, 0),
(14, 'asik', '12321', 'Beras', 'Cash/Jemput', '2021-12-31 00:00:00', 5, 'Test', 12, '23.00', '276.00', 0, 'Closed', 0, '2021-01-14 21:54:29', 18, '2021-01-16 14:34:34', 0),
(15, 'Test', 'Test', 'Uang', 'Transfer', '2021-01-15 00:00:00', 4, 'Zakat Transfer', 20, '50000.00', '1000000.00', 0, 'Open', 18, '2021-01-16 14:30:33', NULL, NULL, 0),
(16, 'Coba Beras', '0920392103', 'Beras', 'Antar', '2021-02-07 00:00:00', 7, 'Coba Beras Sedekah', 10, '15.00', '150.00', 0, 'Closed', 18, '2021-02-07 12:53:41', 18, '2021-02-07 12:53:53', 0),
(17, 'Sedekah Uang', '1232131', 'Uang', 'Transfer', '2021-02-07 00:00:00', 7, 'Sedekah uang', 10, '1500000.00', '15000000.00', 0, 'Closed', 18, '2021-02-07 12:55:51', 18, '2021-02-07 12:55:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `type` varchar(25) DEFAULT NULL,
  `total` decimal(16,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `approved_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `total`, `status`, `created_by`, `created_date`, `approved_date`, `updated_by`, `updated_date`, `is_deleted`) VALUES
(29, 'Pengeluaran', '1750000.00', 'Closed', 18, '2021-01-24 12:34:28', NULL, NULL, NULL, 0),
(30, 'Penyaluran', '250000.00', 'Open', 18, '2021-01-24 12:35:46', NULL, NULL, NULL, 0),
(31, 'Penyaluran', '150000.00', 'Open', 18, '2021-01-24 12:38:26', NULL, NULL, NULL, 0),
(32, 'Pengeluaran', '0.00', 'Open', 18, '2021-02-07 12:44:24', NULL, NULL, NULL, 1),
(33, 'Pengeluaran', '0.00', 'Open', 18, '2021-02-07 12:57:11', NULL, NULL, NULL, 1),
(34, 'Pengeluaran', '0.00', 'Open', 18, '2021-02-07 13:03:24', NULL, NULL, NULL, 1),
(35, 'Penyaluran', '50000.00', 'Closed', 18, '2021-02-07 13:08:38', NULL, NULL, NULL, 0),
(36, 'Pengeluaran', '0.00', 'Open', 18, '2021-02-07 13:09:07', NULL, NULL, NULL, 1),
(37, 'Pengeluaran', '0.00', 'Open', 18, '2021-02-07 13:11:12', NULL, NULL, NULL, 1),
(38, 'Pengeluaran', '14220000.00', 'Open', 18, '2021-02-07 13:12:55', NULL, NULL, NULL, 1),
(39, 'Pengeluaran', '13600000.00', 'Open', 18, '2021-02-07 13:14:17', NULL, NULL, NULL, 1),
(40, 'Pengeluaran', '160000.00', 'Open', 18, '2021-02-07 13:15:05', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `balance` decimal(16,2) NOT NULL,
  `remaining_balance` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `total_unit` int(11) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `note`, `balance`, `remaining_balance`, `amount`, `total_unit`, `type`, `is_deleted`) VALUES
(18, 29, 'Bayar Kebersihan', '3000000.00', '1250000.00', '1750000.00', 0, 'Uang', 0),
(19, 30, 'Bambang Skuy, Oke', '20.00', '13.00', '7.00', 2, 'Makanan', 0),
(20, 30, '', '5000276.00', '0.00', '0.00', 0, 'Beras', 0),
(21, 30, 'Bambang Skuy, Udin Penyok, Oke, Okelah kalau gitu, Gaje', '1250000.00', '1000000.00', '250000.00', 5, 'Uang', 0),
(22, 31, 'Udin Penyok', '13.00', '10.00', '3.00', 1, 'Makanan', 0),
(23, 31, 'Bambang Skuy, Oke', '5000276.00', '5000000.00', '276.00', 2, 'Beras', 0),
(24, 31, 'Bambang Skuy', '1000000.00', '850000.00', '150000.00', 1, 'Uang', 0),
(25, 32, 'Zakat Harta', '0.00', '850000.00', '840000.00', 0, 'Uang', 1),
(26, 33, 'Zakat Harta', '0.00', '850000.00', '800000.00', 0, 'Uang', 1),
(27, 33, 'Sedekah', '0.00', '12850000.00', '12350000.00', 0, 'Uang', 1),
(28, 34, 'Zakat Harta', '0.00', '850000.00', '800000.00', 0, 'Uang', 1),
(29, 34, 'Sedekah', '0.00', '12850000.00', '12350000.00', 0, 'Uang', 1),
(30, 35, 'Bambang Skuy', '10.00', '9.00', '1.00', 1, 'Makanan', 0),
(31, 35, 'Bambang Skuy', '5000150.00', '5000000.00', '150.00', 1, 'Beras', 0),
(32, 35, 'Udin Penyok, Okelah kalau gitu', '15850000.00', '15800000.00', '50000.00', 2, 'Uang', 0),
(33, 36, 'Zakat HartaOke 1', '800000.00', '790000.00', '10000.00', 0, 'Uang', 1),
(34, 36, 'SedekahOke 2', '12800000.00', '12750000.00', '50000.00', 0, 'Uang', 1),
(35, 37, 'Zakat HartaGoks', '740000.00', '730000.00', '10000.00', 0, 'Uang', 1),
(36, 37, 'SedekahGoks 2', '12740000.00', '12720000.00', '20000.00', 0, 'Uang', 1),
(37, 38, 'Zakat HartaGaje', '740000.00', '727888.00', '12112.00', 0, 'Uang', 1),
(38, 38, 'SedekahGaje 2', '12740000.00', '12739879.00', '121.00', 0, 'Uang', 1),
(39, 39, 'Zakat HartaCoba', '800000.00', '700000.00', '100000.00', 0, 'Uang', 1),
(40, 39, 'SedekahCoba 2', '12800000.00', '12650000.00', '150000.00', 0, 'Uang', 1),
(41, 40, 'Zakat HartaCoba', '800000.00', '790000.00', '10000.00', 0, 'Uang', 0),
(42, 40, 'SedekahCoba 2', '12800000.00', '12650000.00', '150000.00', 0, 'Uang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(25) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nik`, `jabatan`) VALUES
(18, 'it', '$2y$10$AoNFRLodB.EJHX4mrKzOLe4EpYjYdg1rQVVS9z2nhD16TFGkxlWFG', 'IT', '1601110069', 'IT Staf'),
(20, 'ketua', '$2y$10$nNN4e5fT1QEfeUOX58gjaeFgAsM0jSj6cLUaWG3qVyfcaYby61/bS', 'Ketua', '1601110080', 'Ketua');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masters`
--
ALTER TABLE `masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mustahik`
--
ALTER TABLE `mustahik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muzakki`
--
ALTER TABLE `muzakki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masters`
--
ALTER TABLE `masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mustahik`
--
ALTER TABLE `mustahik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `muzakki`
--
ALTER TABLE `muzakki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
