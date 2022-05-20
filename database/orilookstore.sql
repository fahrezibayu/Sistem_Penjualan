-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2022 pada 13.02
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orilookstore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_session`
--

CREATE TABLE `log_session` (
  `id_session` int(100) NOT NULL,
  `id` bigint(100) NOT NULL,
  `tanggal_in` date DEFAULT NULL,
  `jamin` time DEFAULT NULL,
  `tanggal_out` date DEFAULT NULL,
  `jamout` time DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_session`
--

INSERT INTO `log_session` (`id_session`, `id`, `tanggal_in`, `jamin`, `tanggal_out`, `jamout`, `status`) VALUES
(1, 18, '2022-04-14', '20:40:27', '2022-05-20', '17:23:16', 'Offline'),
(2, 18, '2022-04-15', '01:53:33', '2022-05-20', '17:23:16', 'Offline'),
(3, 18, '2022-04-15', '15:26:41', '2022-05-20', '17:23:16', 'Offline'),
(4, 18, '2022-04-15', '22:32:46', '2022-05-20', '17:23:16', 'Offline'),
(5, 18, '2022-04-16', '00:22:44', '2022-05-20', '17:23:16', 'Offline'),
(6, 18, '2022-04-16', '00:55:25', '2022-05-20', '17:23:16', 'Offline'),
(7, 18, '2022-04-16', '04:13:11', '2022-05-20', '17:23:16', 'Offline'),
(8, 18, '2022-04-16', '05:18:09', '2022-05-20', '17:23:16', 'Offline'),
(9, 18, '2022-04-16', '05:20:59', '2022-05-20', '17:23:16', 'Offline'),
(10, 18, '2022-04-16', '11:38:48', '2022-05-20', '17:23:16', 'Offline'),
(11, 18, '2022-04-16', '15:01:48', '2022-05-20', '17:23:16', 'Offline'),
(12, 20, '2022-04-16', '15:03:47', '2022-04-16', '15:05:36', 'Offline'),
(13, 18, '2022-04-16', '15:05:06', '2022-05-20', '17:23:16', 'Offline'),
(14, 20, '2022-04-16', '15:05:15', '2022-04-16', '15:05:36', 'Offline'),
(15, 18, '2022-04-19', '13:11:01', '2022-05-20', '17:23:16', 'Offline'),
(16, 18, '2022-05-20', '16:37:04', '2022-05-20', '17:23:16', 'Offline'),
(17, 18, '2022-05-20', '17:26:47', NULL, NULL, 'Online');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(10) NOT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `id_merk` int(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_merk`
--

CREATE TABLE `tbl_merk` (
  `id_merk` int(20) NOT NULL,
  `nama_merk` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` varchar(50) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `total` int(20) NOT NULL,
  `bayar` int(20) NOT NULL,
  `kembalian` int(20) NOT NULL,
  `tgl_penjualan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_temp`
--

CREATE TABLE `tbl_penjualan_temp` (
  `id` int(20) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_trn`
--

CREATE TABLE `tbl_penjualan_trn` (
  `id` int(20) NOT NULL,
  `id_penjualan` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga_barang` int(20) NOT NULL,
  `total` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profile_app`
--

CREATE TABLE `tbl_profile_app` (
  `nama` varchar(100) NOT NULL,
  `nama_aplikasi` varchar(100) NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_profile_app`
--

INSERT INTO `tbl_profile_app` (`nama`, `nama_aplikasi`, `photo`, `created_at`, `updated_at`) VALUES
('Wisnu Herlambang', 'Orilookstore', 'Orilookstore.png', '2022-02-12 06:20:06', '2022-04-15 22:09:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `password`, `role`, `foto`, `created_at`, `updated_at`) VALUES
(18, 'Fahrezi Bayu Prabowo', 'bayu', '$2y$10$afxBhhr52FppddmiDpYO.eongAanA6U.u45k./x95saHp08ag.Czu', 'Admin', NULL, '2022-04-14 13:38:19', '2022-05-20 09:44:43'),
(20, 'Kasir', 'kasir', '$2y$10$XdwL7si5F647DfRFreoCFuGZtIzEzxMSifrD0GpZ9NYk8R6Vtn.v.', 'Kasir', NULL, '2022-04-16 08:03:35', '2022-04-16 08:03:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `log_session`
--
ALTER TABLE `log_session`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_merk` (`id_merk`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_merk`
--
ALTER TABLE `tbl_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_penjualan_temp`
--
ALTER TABLE `tbl_penjualan_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tbl_penjualan_trn`
--
ALTER TABLE `tbl_penjualan_trn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`,`id_penjualan`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log_session`
--
ALTER TABLE `log_session`
  MODIFY `id_session` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_merk`
--
ALTER TABLE `tbl_merk`
  MODIFY `id_merk` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan_temp`
--
ALTER TABLE `tbl_penjualan_temp`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan_trn`
--
ALTER TABLE `tbl_penjualan_trn`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log_session`
--
ALTER TABLE `log_session`
  ADD CONSTRAINT `log_session_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`id_merk`) REFERENCES `tbl_merk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD CONSTRAINT `tbl_penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penjualan_temp`
--
ALTER TABLE `tbl_penjualan_temp`
  ADD CONSTRAINT `tbl_penjualan_temp_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penjualan_trn`
--
ALTER TABLE `tbl_penjualan_trn`
  ADD CONSTRAINT `tbl_penjualan_trn_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_penjualan_trn_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `tbl_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
