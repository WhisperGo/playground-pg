-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2024 pada 18.34
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playground_pg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `permainan_id` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `transaksi_id`, `permainan_id`, `durasi`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 12, 3, 2, '20000.00', '2024-02-21 00:30:41', NULL, NULL),
(18, 12, 2, 2, '50000.00', '2024-02-21 00:30:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2024-02-19 11:38:28', NULL, NULL),
(2, 'Ayunan', '2024-02-20 13:20:37', '2024-02-20 13:20:42', '2024-02-20 13:20:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` int(11) NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(15) NOT NULL,
  `NamaOrangtua` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `NamaOrangtua`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thomas', 'Perumahan Orchid', '084597651452', 'Orang Tua Thomas', '2024-02-01 21:32:30', '2024-02-02 18:15:04', NULL),
(2, 'Kevin', 'Perumahan Kevin', '08154722', 'Orang Tua Kevin', '2024-02-02 20:14:38', '2024-02-02 21:09:58', NULL),
(3, 'Doni', 'Perumahan Doni', '0147965', 'Orang tua Doni', '2024-02-19 18:32:08', '2024-02-19 18:34:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permainan`
--

CREATE TABLE `permainan` (
  `id_permainan` int(11) NOT NULL,
  `nama_permainan` varchar(255) NOT NULL,
  `harga_permainan` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permainan`
--

INSERT INTO `permainan` (`id_permainan`, `nama_permainan`, `harga_permainan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mandi Bola', '50000.00', '2024-02-20 11:38:52', NULL, NULL),
(2, 'Istana perosotan', '25000.00', '2024-02-20 11:38:52', NULL, NULL),
(3, 'Ayunan', '10000.00', '2024-02-20 13:24:40', '2024-02-20 13:27:09', NULL),
(4, 'Jungkat-jungkit', '10000.00', '2024-02-20 20:57:58', NULL, NULL),
(5, 'Tiang Gelantung', '10000.00', '2024-02-20 21:37:10', '2024-02-20 21:38:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `pelanggan_id`, `tanggal_transaksi`, `jam_mulai`, `jam_selesai`, `total_harga`, `user`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 1, '2024-02-21', '00:30:41', '02:30:41', '70000.00', 1, 1, '2024-02-21 00:30:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi2`
--

CREATE TABLE `transaksi2` (
  `id_transaksi` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL DEFAULT current_timestamp(),
  `permainan_id` int(11) NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'default.png', '2024-02-19 11:39:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo_website` text DEFAULT NULL,
  `logo_pdf` text DEFAULT NULL,
  `favicon_website` text DEFAULT NULL,
  `komplek` text DEFAULT NULL,
  `jalan` text DEFAULT NULL,
  `kelurahan` text DEFAULT NULL,
  `kecamatan` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id_website`, `nama_website`, `logo_website`, `logo_pdf`, `favicon_website`, `komplek`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GT Playground', 'logo_contoh.svg', 'logo_pdf_contoh.svg', 'favicon_contoh.svg', 'Komp. Pahlawan Mas', 'Jl. Raya Pahlawan No. 123', 'Kel. Sukajadi', 'Kec. Sukasari', 'Kota Batam', '29424', '2023-05-01 16:33:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`);

--
-- Indeks untuk tabel `permainan`
--
ALTER TABLE `permainan`
  ADD PRIMARY KEY (`id_permainan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi2`
--
ALTER TABLE `transaksi2`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `PelangganID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permainan`
--
ALTER TABLE `permainan`
  MODIFY `id_permainan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaksi2`
--
ALTER TABLE `transaksi2`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
