-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2026 at 05:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` bigint UNSIGNED NOT NULL,
  `no_berkas` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_modul` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_modul` bigint UNSIGNED NOT NULL,
  `status` enum('draft','menunggu_verifikasi','diverifikasi','disetujui','ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `catatan_bendahara` text COLLATE utf8mb4_general_ci,
  `operator_id` int NOT NULL,
  `verified_by` int DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `no_berkas`, `jenis_modul`, `id_modul`, `status`, `catatan_bendahara`, `operator_id`, `verified_by`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 'PD-2026-0001', 'perjalanan_dinas', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 08:58:12', '2026-02-09 08:58:12'),
(2, 'PD-2026-0002', 'perjalanan_dinas', 2, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 12:54:18', '2026-02-09 12:54:18'),
(3, 'PD-2026-0003', 'perjalanan_dinas', 3, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 18:03:30', '2026-02-09 18:03:30'),
(4, 'PD-2026-0004', 'perjalanan_dinas', 4, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 18:09:18', '2026-02-09 18:09:18'),
(5, 'PD-2026-0005', 'perjalanan_dinas', 5, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 18:14:11', '2026-02-09 18:14:11'),
(6, 'PD-2026-0006', 'perjalanan_dinas', 6, 'diverifikasi', '', 1, NULL, NULL, '2026-02-09 18:17:18', '2026-02-09 22:41:53'),
(7, 'PD-2026-0007', 'perjalanan_dinas', 7, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-09 18:29:18', '2026-02-09 18:29:18'),
(8, 'PD-2026-0008', 'perjalanan_dinas', 8, 'diverifikasi', '', 1, NULL, NULL, '2026-02-09 18:34:10', '2026-02-09 22:40:54'),
(9, 'PD-2026-0009', 'perjalanan_dinas', 9, 'diverifikasi', '', 1, NULL, NULL, '2026-02-09 18:40:32', '2026-02-26 10:14:51'),
(10, 'PD-2026-0010', 'perjalanan_dinas', 10, 'diverifikasi', '', 1, NULL, NULL, '2026-02-09 18:47:46', '2026-02-09 22:48:52'),
(11, 'GI-2026-0001', 'gaji_induk', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-19 07:59:41', '2026-02-19 07:59:41'),
(12, 'GI-2026-0002', 'gaji_induk', 2, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 22:10:33', '2026-02-24 22:10:33'),
(13, 'TK-2026-0001', 'tunjangan_kinerja', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 22:12:18', '2026-02-24 22:12:18'),
(14, 'UM-2026-0001', 'uang_makan', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 22:37:14', '2026-02-24 22:37:14'),
(15, 'HO-2026-0001', 'honorarium', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 22:42:37', '2026-02-24 22:42:37'),
(16, 'KT-2026-0001', 'kontraktual', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 22:54:21', '2026-02-24 22:54:21'),
(17, 'GUP-2026-0001', 'gup', 1, 'menunggu_verifikasi', NULL, 1, NULL, NULL, '2026-02-24 23:35:36', '2026-02-24 23:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_induk`
--

CREATE TABLE `gaji_induk` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bruto` bigint NOT NULL DEFAULT '0',
  `total_netto` bigint NOT NULL DEFAULT '0',
  `pajak` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji_induk`
--

INSERT INTO `gaji_induk` (`id`, `uraian`, `no_akun`, `total_bruto`, `total_netto`, `pajak`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Gaji Bulanan Aris Mukti Presetyo', '7316.EBA.994.002.D.524112', 6000000, 5650000, 350000, 'TU', 1, '2026-02-19 07:59:41', '2026-02-19 07:59:41'),
(2, 'gaji induk', '11253536', 12000000, 0, 0, 'TU', 1, '2026-02-24 22:10:31', '2026-02-24 22:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `gup`
--

CREATE TABLE `gup` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gup`
--

INSERT INTO `gup` (`id`, `uraian`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'GUP', 'TU', 1, '2026-02-24 23:35:36', '2026-02-24 23:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `honorarium`
--

CREATE TABLE `honorarium` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bruto` bigint NOT NULL DEFAULT '0',
  `total_netto` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `honorarium`
--

INSERT INTO `honorarium` (`id`, `uraian`, `no_akun`, `total_bruto`, `total_netto`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'honor', '986531.9867452', 5000000, 0, 'TU', 1, '2026-02-24 22:42:37', '2026-02-24 22:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `kontraktual`
--

CREATE TABLE `kontraktual` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_uang_bruto` bigint NOT NULL DEFAULT '0',
  `total_uang_netto` bigint NOT NULL DEFAULT '0',
  `pajak` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontraktual`
--

INSERT INTO `kontraktual` (`id`, `uraian`, `no_akun`, `total_uang_bruto`, `total_uang_netto`, `pajak`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'kontraktual', '9y67465.98784r4', 2500000, 0, 150000, 'TU', 1, '2026-02-24 22:54:21', '2026-02-24 22:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-02-04-031306', 'App\\Database\\Migrations\\CreateBerkasTable', 'default', 'App', 1770365044, 1),
(2, '2026-02-04-161908', 'App\\Database\\Migrations\\CreateGupTable', 'default', 'App', 1770365045, 1),
(3, '2026-02-04-163115', 'App\\Database\\Migrations\\CreateGajiIndukTable', 'default', 'App', 1770365045, 1),
(4, '2026-02-04-163202', 'App\\Database\\Migrations\\CreateHonorariumTable', 'default', 'App', 1770365045, 1),
(5, '2026-02-04-163242', 'App\\Database\\Migrations\\CreateKontraktualTable', 'default', 'App', 1770365045, 1),
(6, '2026-02-04-163321', 'App\\Database\\Migrations\\CreateTunjanganKinerjaTable', 'default', 'App', 1770365045, 1),
(7, '2026-02-04-163406', 'App\\Database\\Migrations\\CreateUangMakanTable', 'default', 'App', 1770365045, 1),
(8, '2026-02-06-075632', 'App\\Database\\Migrations\\CreatePerjalananDinasTable', 'default', 'App', 1770365045, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perjalanan_dinas`
--

CREATE TABLE `perjalanan_dinas` (
  `id` bigint UNSIGNED NOT NULL,
  `no_surat_tugas` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sumber_dana` enum('RM','PNP') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `posisi_no_akun` enum('atas','bawah') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harian_perjalanan` bigint NOT NULL DEFAULT '0',
  `penginapan` bigint NOT NULL DEFAULT '0',
  `transport` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perjalanan_dinas`
--

INSERT INTO `perjalanan_dinas` (`id`, `no_surat_tugas`, `uraian`, `no_akun`, `sumber_dana`, `posisi_no_akun`, `harian_perjalanan`, `penginapan`, `transport`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'ST.274/BPDAS.BRT/PKDAS/DAS.04.03/10/2025', 'Melakukan perjalanan dinas dalam rangka Monitoring KBR Kabupaten Tapin dan Kabupaten Banjar', '7275.RBK.001.053.A.524111', 'PNP', 'atas', 3720000, 1254600, 900000, 'PKDAS', 1, '2026-02-09 08:58:11', '2026-02-19 07:38:08'),
(2, 'ST.274/BPDAS.BRT/RHL/DAS.04.03/10/2026', 'pemantauan lahan', '7275.RBK.002.053.524112', 'PNP', 'atas', 600000, 750000, 1200000, 'RHL', 1, '2026-02-09 12:54:18', '2026-02-19 07:37:52'),
(3, 'ST.3/BPDAS.BRT/1/2025', 'Biaya perjalanan dinas dalam rangka Mengantar Berkas Fisik Usulan UP RM 2025 di KPPN Banjarmasin', '7316.EBA.994.002.D.524111', 'RM', 'atas', 150000, 0, 0, 'TU', 1, '2026-02-09 18:03:29', '2026-02-12 17:30:28'),
(4, 'ST.15/BPDAS.BRT/TU/7/2025', 'Biaya perjalanan dinas dalam rangka belanja modal persemaian Liang Anggang di Banjarmasin tanggal 7 Juli 2025', '7316.EBA.994.002.D.524111', 'RM', 'atas', 150000, 0, 0, 'TU', 1, '2026-02-09 18:09:18', '2026-02-19 07:38:22'),
(5, 'ST.14/BPDAS.BRT/TU/2025', 'Biaya perjalanan dinas dalam rangka Konsultasi Pencatatan Hibah Persemaian Liang Anggang di Aplikasi SEHATI Kemenkeu di DJPB Banjarmasin tanggal 2 Juli 2025', '7316.EBA.994.002.D.524111', 'RM', 'atas', 150000, 0, 0, 'TU', 1, '2026-02-09 18:14:11', '2026-02-19 07:38:35'),
(6, 'ST.12/BPDAS.BRT/6/2025', 'Biaya perjalanan dinas dalam rangka Konsultasi Terkait Tutup Buku Modul GLP dan Persediaan di KPPN Banjarmasin tanggal 16 Juli 2025', '7316.EBA.994.002.D.524111', 'RM', 'atas', 150000, 0, 0, 'TU', 1, '2026-02-09 18:17:18', '2026-02-19 07:39:32'),
(7, 'S.16/BPDAS.BRT/TU/DAS.1/SPD/2025', 'Biaya perjalanan dinas dalam rangka Koordinasi dari Banjarbaru ke BPDAS Kahayan, Palangkaraya selama 2 hari mulai tanggal 6 s/d 7 Januari 2025', '7316.EBA.994.002.D.524111', 'PNP', 'atas', 720000, 197700, 1220114, 'PKDAS', 1, '2026-02-09 18:29:18', '2026-02-19 07:40:00'),
(8, 'S.32/BPDAS.BRT/TU/DAS.1/SPD/2025', 'Biaya perjalanan dinas dalam rangka konsultasi daari Banjarbaru ke Jakarta selama 3 (Tiga) hari mulai tanggal 9 s/d 11 Januari 2025', '7316.EBA.994.002.D.524111', 'PNP', 'atas', 1060000, 1650000, 3656116, 'PKDAS', 1, '2026-02-09 18:34:10', '2026-02-19 07:39:47'),
(9, 'S.108/BPDAS.BRT/TU/DAS.2/SPD/2025', 'Biaya perjalanan dalam rangka konsultasi Kegiatan Rehabilitasi DAS dari Banjarbaru ke Provinsi Kalimantan Timur selama 3 (Tiga) hari mulai tanggal 12 s/d 14 Februari 2025', '7316.EBA.994.002.D.524111', 'PNP', 'atas', 1290000, 819000, 1271959, 'PKDAS', 1, '2026-02-09 18:40:31', '2026-02-19 07:40:14'),
(10, 'S.107/BPDAS.BRT/TU/DAS.2/SPD/2025', 'Biaya perjalanan dinas dalam rangka Konsultasi Kegiatan RehabilitasiDAS dari Banjarbaru ke Provinsi kalimantan Timur selama 3 (TIGA) ', '7316.EBA.994.002.D.524111', 'RM', 'atas', 1290000, 819000, 0, 'TU', 1, '2026-02-09 18:47:45', '2026-02-19 07:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan_kinerja`
--

CREATE TABLE `tunjangan_kinerja` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bruto` bigint NOT NULL DEFAULT '0',
  `total_netto` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunjangan_kinerja`
--

INSERT INTO `tunjangan_kinerja` (`id`, `uraian`, `no_akun`, `total_bruto`, `total_netto`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'tunjangan kinerja', '253647.34242', 12000000, 0, 'TU', 1, '2026-02-24 22:12:18', '2026-02-24 22:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `uang_makan`
--

CREATE TABLE `uang_makan` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_akun` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bruto` bigint NOT NULL DEFAULT '0',
  `total_netto` bigint NOT NULL DEFAULT '0',
  `seksi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operator_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uang_makan`
--

INSERT INTO `uang_makan` (`id`, `uraian`, `no_akun`, `total_bruto`, `total_netto`, `seksi`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'uang makan', '895310098.787533', 500000, 0, 'TU', 1, '2026-02-24 22:37:14', '2026-02-24 22:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','bendahara','operator') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'operator', '$2y$10$LX7FldSR/dnBuIuwnbMKReettOxaudc4PWW6v58SSfvvkQUtn78zS', 'operator', '2025-12-05 15:32:40'),
(4, 'bendahara', '$2y$10$4ZQkyx0u5pUzUuxz8tLHuOPv/yd6kZ4YJM1axQJ2pDv4BtS8fOeXm', 'bendahara', '2025-12-14 14:36:16'),
(5, 'admin', '$2y$10$tF7fA8JOGNNsHJgnj9O4dOn/F6kNdCPiY6ex7eQ36tYtJ81TRaunu', 'admin', '2025-12-14 14:36:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_berkas` (`no_berkas`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_berkas_status` (`status`),
  ADD KEY `idx_berkas_jenis` (`jenis_modul`),
  ADD KEY `idx_berkas_operator` (`operator_id`),
  ADD KEY `idx_berkas_verified` (`verified_by`),
  ADD KEY `idx_berkas_created` (`created_at`),
  ADD KEY `idx_berkas_updated` (`updated_at`),
  ADD KEY `idx_berkas_verified_at` (`verified_at`),
  ADD KEY `idx_berkas_status_jenis` (`status`,`jenis_modul`),
  ADD KEY `idx_berkas_operator_status` (`operator_id`,`status`);

--
-- Indexes for table `gaji_induk`
--
ALTER TABLE `gaji_induk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_gaji_operator` (`operator_id`),
  ADD KEY `idx_gaji_created` (`created_at`),
  ADD KEY `idx_gaji_no_akun` (`no_akun`),
  ADD KEY `idx_gaji_seksi` (`seksi`);

--
-- Indexes for table `gup`
--
ALTER TABLE `gup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_gup_operator` (`operator_id`),
  ADD KEY `idx_gup_created` (`created_at`),
  ADD KEY `idx_gup_seksi` (`seksi`);

--
-- Indexes for table `honorarium`
--
ALTER TABLE `honorarium`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_honorarium_operator` (`operator_id`),
  ADD KEY `idx_honorarium_created` (`created_at`),
  ADD KEY `idx_honorarium_no_akun` (`no_akun`),
  ADD KEY `idx_honorarium_seksi` (`seksi`);

--
-- Indexes for table `kontraktual`
--
ALTER TABLE `kontraktual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_kontraktual_operator` (`operator_id`),
  ADD KEY `idx_kontraktual_created` (`created_at`),
  ADD KEY `idx_kontraktual_no_akun` (`no_akun`),
  ADD KEY `idx_kontraktual_seksi` (`seksi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perjalanan_dinas`
--
ALTER TABLE `perjalanan_dinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_perdinas_operator` (`operator_id`),
  ADD KEY `idx_perdinas_created` (`created_at`),
  ADD KEY `idx_perdinas_no_akun` (`no_akun`),
  ADD KEY `idx_perdinas_surat` (`no_surat_tugas`),
  ADD KEY `idx_perdinas_seksi` (`seksi`),
  ADD KEY `idx_perdinas_sumber` (`sumber_dana`);

--
-- Indexes for table `tunjangan_kinerja`
--
ALTER TABLE `tunjangan_kinerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_tunjangan_operator` (`operator_id`),
  ADD KEY `idx_tunjangan_created` (`created_at`),
  ADD KEY `idx_tunjangan_no_akun` (`no_akun`),
  ADD KEY `idx_tunjangan_seksi` (`seksi`);

--
-- Indexes for table `uang_makan`
--
ALTER TABLE `uang_makan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `idx_uangmakan_operator` (`operator_id`),
  ADD KEY `idx_uangmakan_created` (`created_at`),
  ADD KEY `idx_uangmakan_no_akun` (`no_akun`),
  ADD KEY `idx_uangmakan_seksi` (`seksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_users_created` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gaji_induk`
--
ALTER TABLE `gaji_induk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gup`
--
ALTER TABLE `gup`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `honorarium`
--
ALTER TABLE `honorarium`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kontraktual`
--
ALTER TABLE `kontraktual`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perjalanan_dinas`
--
ALTER TABLE `perjalanan_dinas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tunjangan_kinerja`
--
ALTER TABLE `tunjangan_kinerja`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uang_makan`
--
ALTER TABLE `uang_makan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `fk_berkas_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_berkas_verified_by` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_verified_by` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `gaji_induk`
--
ALTER TABLE `gaji_induk`
  ADD CONSTRAINT `fk_gaji_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `gup`
--
ALTER TABLE `gup`
  ADD CONSTRAINT `fk_gup_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `honorarium`
--
ALTER TABLE `honorarium`
  ADD CONSTRAINT `fk_honorarium_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `kontraktual`
--
ALTER TABLE `kontraktual`
  ADD CONSTRAINT `fk_kontraktual_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `perjalanan_dinas`
--
ALTER TABLE `perjalanan_dinas`
  ADD CONSTRAINT `fk_perdinas_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tunjangan_kinerja`
--
ALTER TABLE `tunjangan_kinerja`
  ADD CONSTRAINT `fk_tunjangan_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `uang_makan`
--
ALTER TABLE `uang_makan`
  ADD CONSTRAINT `fk_uangmakan_operator` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
