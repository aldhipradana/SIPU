-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 06:36 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipu`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsurans`
--

CREATE TABLE `angsurans` (
  `idAngsuran` int(10) UNSIGNED NOT NULL,
  `idPinjaman` int(10) UNSIGNED NOT NULL,
  `jmlAngsuran` decimal(9,3) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `angsurans`
--

INSERT INTO `angsurans` (`idAngsuran`, `idPinjaman`, `jmlAngsuran`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, 5, '30000.000', 'b', NULL, NULL),
(10, 6, '10000.000', 'wewe', '2019-12-17 09:26:08', '2019-12-17 09:27:48');

--
-- Triggers `angsurans`
--
DELIMITER $$
CREATE TRIGGER `UpdateSisaPinjaman` AFTER INSERT ON `angsurans` FOR EACH ROW BEGIN
   UPDATE `pinjamans`
   INNER JOIN angsurans ON angsurans.idPinjaman = pinjamans.idPinjaman
   SET pinjamans.sisaPinjam = pinjamans.jmlPinjam - (SELECT SUM(jmlAngsuran) FROM `angsurans` WHERE angsurans.idPinjaman = pinjamans.idPinjaman)
   WHERE pinjamans.idPinjaman = angsurans.idPinjaman;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateSisaPinjaman2` AFTER UPDATE ON `angsurans` FOR EACH ROW BEGIN
   UPDATE `pinjamans`
   INNER JOIN angsurans ON angsurans.idPinjaman = pinjamans.idPinjaman
   SET pinjamans.sisaPinjam = pinjamans.jmlPinjam - (SELECT SUM(jmlAngsuran) FROM `angsurans` WHERE angsurans.idPinjaman = pinjamans.idPinjaman)
   WHERE pinjamans.idPinjaman = angsurans.idPinjaman;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateSisaPinjaman3` AFTER DELETE ON `angsurans` FOR EACH ROW BEGIN
   UPDATE `pinjamans`
   INNER JOIN angsurans ON angsurans.idPinjaman = pinjamans.idPinjaman
   SET pinjamans.sisaPinjam = pinjamans.jmlPinjam - (SELECT SUM(jmlAngsuran) FROM `angsurans` WHERE angsurans.idPinjaman = pinjamans.idPinjaman)
   WHERE pinjamans.idPinjaman = angsurans.idPinjaman;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_12_01_070746_create_nasabahs_table', 1),
(11, '2019_12_15_133112_add_photo_to_nasabahs_table', 1),
(12, '2019_12_16_065239_create_pinjamen_table', 1),
(13, '2019_12_16_070735_create_angsurans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nasabahs`
--

CREATE TABLE `nasabahs` (
  `idNasabah` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nasabahs`
--

INSERT INTO `nasabahs` (`idNasabah`, `firstname`, `lastname`, `email`, `phone`, `alamat`, `created_at`, `updated_at`, `deleted_at`, `photo`) VALUES
(1, 'Aldhi', 'Pradana', 'aldhipradana@gmail.com', '082247970603', 'jl taman sekar vi e no. 5', '2019-12-16 06:12:59', '2019-12-16 08:01:37', NULL, '/upload/photo/aldhi.jpg'),
(3, 'Dede', 'de', 'dedemahayana@gmail.com', '123123123', 'bulan', '2019-12-16 08:49:00', '2019-12-16 08:49:00', NULL, '/upload/photo/dede.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjamans`
--

CREATE TABLE `pinjamans` (
  `idPinjaman` int(10) UNSIGNED NOT NULL,
  `idNasabah` int(10) UNSIGNED NOT NULL,
  `bunga` double(8,2) NOT NULL,
  `jmlPinjam` decimal(9,3) NOT NULL,
  `sisaPinjam` decimal(9,3) NOT NULL,
  `status` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pinjamans`
--

INSERT INTO `pinjamans` (`idPinjaman`, `idNasabah`, `bunga`, `jmlPinjam`, `sisaPinjam`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3.00, '250000.000', '250000.000', 'aktif', '2019-12-16 07:20:43', '2019-12-16 08:05:23'),
(5, 3, 125.00, '100000.000', '70000.000', 'aktif', '2019-12-16 09:12:37', '2019-12-17 08:12:32'),
(6, 1, 100.00, '20000.000', '10000.000', 'nonaktif', '2019-12-17 08:08:48', '2019-12-17 09:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$eIooXSLBWghJ2/Fefzjk6.Xl659Jqa4goRs3ANtnLC2lYIIdyH9fG', 'K5X96h0xPU5e0wPExGQIZCNiwVXImG7lwu6GViCApvaLG5SfSoWjEZTMM1cp', '2019-12-16 06:11:58', '2019-12-16 06:11:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsurans`
--
ALTER TABLE `angsurans`
  ADD PRIMARY KEY (`idAngsuran`),
  ADD KEY `angsurans_idpinjaman_foreign` (`idPinjaman`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD PRIMARY KEY (`idNasabah`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pinjamans`
--
ALTER TABLE `pinjamans`
  ADD PRIMARY KEY (`idPinjaman`),
  ADD KEY `pinjamans_idnasabah_foreign` (`idNasabah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsurans`
--
ALTER TABLE `angsurans`
  MODIFY `idAngsuran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nasabahs`
--
ALTER TABLE `nasabahs`
  MODIFY `idNasabah` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pinjamans`
--
ALTER TABLE `pinjamans`
  MODIFY `idPinjaman` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsurans`
--
ALTER TABLE `angsurans`
  ADD CONSTRAINT `angsurans_idpinjaman_foreign` FOREIGN KEY (`idPinjaman`) REFERENCES `pinjamans` (`idPinjaman`) ON DELETE CASCADE;

--
-- Constraints for table `pinjamans`
--
ALTER TABLE `pinjamans`
  ADD CONSTRAINT `pinjamans_idnasabah_foreign` FOREIGN KEY (`idNasabah`) REFERENCES `nasabahs` (`idNasabah`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
