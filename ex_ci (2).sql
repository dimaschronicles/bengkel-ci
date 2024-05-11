-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 12:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `jenis` enum('sparepart','jasa') NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `jenis`, `stok`, `harga`, `diskon`, `foto`, `created_at`) VALUES
(1, 'Oli Garda', 'adasdasd', 'sparepart', 8, 200000, NULL, NULL, '2024-05-05 12:54:21'),
(2, 'Ganti Oli', 'asdasdasd', 'jasa', NULL, 30000, NULL, NULL, '2024-05-05 12:54:36'),
(3, 'Velg 17', 'asdasdwqe', 'sparepart', 5, 500000, NULL, 'produk_1714906662.jpg', '2024-05-05 12:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_pemesanan` varchar(128) NOT NULL,
  `jenis_pembayaran` enum('cash','qris') DEFAULT NULL,
  `total` bigint(11) NOT NULL,
  `status` enum('dipesan','diproses','selesai') DEFAULT NULL,
  `plat_nomor` varchar(128) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `no_pemesanan`, `jenis_pembayaran`, `total`, `status`, `plat_nomor`, `keterangan`, `tanggal_waktu`, `bukti_pembayaran`, `created_at`) VALUES
(4, 2, 'INV-20240506110616-5211', 'cash', 730000, 'selesai', 'r 1231 sa', 'asdasd', '2024-05-06 11:06:16', NULL, '2024-05-06 11:06:16'),
(5, 2, 'INV-20240507141044-9845', 'qris', 1200000, 'selesai', 'r 1231 sa', 'asdasdasd', '2024-05-07 14:10:44', NULL, '2024-05-07 14:10:44'),
(6, 2, 'INV-20240511164936-8614', 'qris', 400000, 'dipesan', 'r 1231 sa', 'ijojoijoijoijoi', '2024-05-11 16:49:36', NULL, '2024-05-11 16:49:36'),
(10, 3, 'INV-20240511171706-4941', 'cash', 30000, 'dipesan', 'r 1231 sa', NULL, '2024-05-11 17:17:06', NULL, '2024-05-11 17:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `produk_id`, `jumlah`, `total_harga`) VALUES
(7, 4, 1, 1, 200000),
(8, 4, 2, 1, 30000),
(9, 4, 3, 1, 500000),
(10, 5, 1, 1, 200000),
(11, 5, 3, 2, 1000000),
(12, 6, 1, 2, 400000),
(16, 10, 2, 1, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `no_hp` varchar(36) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `no_hp`, `alamat`, `password`, `role_id`, `is_active`, `created_at`) VALUES
(1, 'admin@gmail.com', 'Administrator', NULL, NULL, '$2y$10$CvOJGRXsl3FpzjRb2TbeTuurnqQ8wn/22.n9GPwTt/IbSnnI0lI9m', 1, 1, '2024-05-01 05:04:23'),
(2, 'dimas@gmail.com', 'Dimas', '081903304446', 'Purwokerto', '$2y$10$CvOJGRXsl3FpzjRb2TbeTuurnqQ8wn/22.n9GPwTt/IbSnnI0lI9m', 2, 1, '2024-05-01 05:05:43'),
(3, 'anggie@gmail.com', 'Anggie', '089412463322', 'Kebumen', '$2y$10$CvOJGRXsl3FpzjRb2TbeTuurnqQ8wn/22.n9GPwTt/IbSnnI0lI9m', 2, 1, '2024-05-05 02:10:03'),
(4, 'farhan@gmail.com', 'Farhan', '012364856974', 'Bumiayu', '$2y$10$vvpBBzGRR.S.vkAcWeZ10OOmCIFe/s3UBzcKhjEAgUwYOJpjyfOmy', 2, 1, '2024-05-11 10:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
