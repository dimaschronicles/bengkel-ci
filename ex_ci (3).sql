-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 10:43 AM
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
-- Table structure for table `krisar`
--

CREATE TABLE `krisar` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `no_hp` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `kritik` text NOT NULL,
  `saran` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krisar`
--

INSERT INTO `krisar` (`id`, `nama`, `no_hp`, `alamat`, `kritik`, `saran`, `tanggal`, `created_at`) VALUES
(1, 'Joko widodo', '012254400', 'Jakarta', 'hati hati', 'hati hati', '2024-05-14', '2024-05-14 03:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id` int(11) NOT NULL,
  `nama_montir` varchar(128) NOT NULL,
  `no_hp_montir` varchar(32) NOT NULL,
  `alamat_montir` text NOT NULL,
  `status_montir` enum('tersedia','tidak') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id`, `nama_montir`, `no_hp_montir`, `alamat_montir`, `status_montir`, `created_at`) VALUES
(2, 'Yanto yanti', '0213554665', 'aasdasdad', 'tersedia', '2024-05-14 05:01:32'),
(3, 'Lanang', '12312312312', 'Pasir', 'tersedia', '2024-05-14 08:49:10');

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
  `harga` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `jenis`, `stok`, `harga`, `diskon`, `foto`, `created_at`) VALUES
(1, 'Oli Garda', 'adasdasd', 'sparepart', 5, 200000, NULL, NULL, '2024-05-05 12:54:21'),
(2, 'Servis', 'asdasdasd', 'jasa', NULL, NULL, NULL, NULL, '2024-05-05 12:54:36'),
(3, 'Velg 17', 'asdasdwqe', 'sparepart', 3, 500000, NULL, 'produk_1714906662.jpg', '2024-05-05 12:57:42'),
(4, 'Servis asdsda', 'asdasdasd', 'jasa', NULL, NULL, NULL, NULL, '2024-05-14 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `montir_id` int(11) DEFAULT NULL,
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

INSERT INTO `transaksi` (`id`, `user_id`, `montir_id`, `no_pemesanan`, `jenis_pembayaran`, `total`, `status`, `plat_nomor`, `keterangan`, `tanggal_waktu`, `bukti_pembayaran`, `created_at`) VALUES
(1, 2, 3, 'INV-20240514143043-2245', 'cash', 235000, 'selesai', 'r 1231 sa', NULL, '2024-05-14 14:30:43', NULL, '2024-05-14 14:30:43');

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
(1, 1, 4, 1, 35000),
(2, 1, 1, 1, 200000);

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
(3, 'anggie@gmail.com', 'Anggie', '089412463322', 'Kebumen', '$2y$10$CvOJGRXsl3FpzjRb2TbeTuurnqQ8wn/22.n9GPwTt/IbSnnI0lI9m', 3, 1, '2024-05-05 02:10:03'),
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
(2, 'Customer'),
(3, 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `krisar`
--
ALTER TABLE `krisar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `krisar`
--
ALTER TABLE `krisar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
