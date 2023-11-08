-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2023 pada 07.25
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_masakan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_detail_order`, `id_order`, `id_masakan`, `qty`, `total`, `keterangan`) VALUES
(49, 19, 4, 1, 17000, 'selesai'),
(50, 19, 1, 1, 17000, 'selesai'),
(51, 19, 3, 4, 48000, 'selesai'),
(52, 20, 4, 1, 17000, 'selesai'),
(53, 20, 3, 16, 192000, 'selesai'),
(54, 21, 4, 1, 18000, 'selesai'),
(55, 21, 3, 1, 12000, 'selesai'),
(56, 21, 1, 1, 17000, 'selesai'),
(57, 22, 4, 6, 108000, 'selesai'),
(58, 22, 3, 1, 12000, 'selesai'),
(59, 22, 1, 1, 17000, 'selesai'),
(60, 23, 4, 1, 18000, 'selesai'),
(61, 26, 4, 1, 18000, 'selesai'),
(62, 24, 4, 1, 18000, 'selesai'),
(63, 25, 3, 1, 12000, 'selesai'),
(76, 33, 4, 3, 54000, 'selesai'),
(77, 33, 3, 1, 12000, 'selesai'),
(78, 33, 1, 1, 17000, 'selesai'),
(81, 37, 4, 1, 18000, 'selesai'),
(82, 39, 4, 1, 18000, 'selesai'),
(83, 41, 4, 1, 18000, 'selesai'),
(84, 42, 4, 1, 18000, 'selesai'),
(85, 42, 3, 1, 12000, 'selesai'),
(86, 38, 4, 7, 126000, 'diproses'),
(87, 38, 3, 1, 12000, 'diproses'),
(88, 36, 4, 3, 54000, 'diproses'),
(89, 36, 3, 3, 36000, 'diproses'),
(90, 36, 1, 3, 51000, 'diproses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Administrator'),
(2, 'Waiter'),
(3, 'Kasir'),
(4, 'Owner'),
(5, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masakan`
--

CREATE TABLE `masakan` (
  `id_masakan` int(11) NOT NULL,
  `nama_masakan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status_masakan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masakan`
--

INSERT INTO `masakan` (`id_masakan`, `nama_masakan`, `harga`, `status_masakan`) VALUES
(1, 'Rawon', 17000, 'Tersedia'),
(3, 'Soto Ayam', 12000, 'Tersedia'),
(4, 'Nasi Paru', 18000, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--
-- Kesalahan membaca struktur untuk tabel resto.menu: #1932 - Table &#039;resto.menu&#039; doesn&#039;t exist in engine
-- Kesalahan membaca data untuk tabel resto.menu: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `resto`.`menu`&#039; at line 1

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `no_meja`, `tanggal`, `id_user`, `keterangan`) VALUES
(19, 29, '2023-10-07', 6, 'sudah pesan'),
(20, 56, '2023-10-07', 6, 'sudah pesan'),
(21, 57, '2023-10-12', 6, 'sudah pesan'),
(22, 57, '2023-10-12', 6, 'sudah pesan'),
(23, 2, '2023-10-12', 6, 'sudah pesan'),
(24, 3, '2023-10-12', 6, 'sudah pesan'),
(25, 44, '2023-10-12', 6, 'sudah pesan'),
(26, 65, '2023-10-12', 6, 'sudah pesan'),
(27, 45, '2023-10-14', 6, 'sudah pesan'),
(28, 67, '2023-10-14', 6, 'sudah pesan'),
(29, 76, '2023-10-14', 6, 'sudah pesan'),
(30, 87, '2023-10-14', 6, 'sudah pesan'),
(31, 56, '2023-10-14', 6, 'sudah pesan'),
(32, 34, '2023-10-14', 6, 'sudah pesan'),
(33, 34, '2023-10-25', 6, 'sudah pesan'),
(34, 23, '2023-10-25', 6, 'sudah pesan'),
(35, 34, '2023-10-25', 6, 'belum pesan'),
(36, 200, '2023-10-25', 6, 'sudah pesan'),
(37, 23, '2023-10-25', 6, 'sudah pesan'),
(38, 2, '2023-10-26', 13, 'sudah pesan'),
(39, 3, '2023-10-26', 13, 'sudah pesan'),
(40, 23, '2023-10-26', 13, 'belum pesan'),
(41, 4, '2023-10-26', 13, 'sudah pesan'),
(42, 12, '2023-10-26', 13, 'sudah pesan'),
(43, 3, '2023-11-01', 6, 'belum pesan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nomeja` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `name`, `nama`, `nomeja`, `tanggal`, `total_bayar`) VALUES
(1, '0', 'Melany', 34, '2023-10-14', 47000),
(3, '0', 'Melany', 23, '2023-10-25', 42000),
(4, '0', 'Melany', 34, '2023-10-25', 83000),
(5, '0', 'Melany', 23, '2023-10-25', 18000),
(6, '0', 'Jeno', 3, '2023-10-26', 18000),
(7, '0', 'Jeno', 4, '2023-10-26', 18000),
(8, 'Melany ', 'Jeno', 12, '2023-10-27', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `id_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `id_level`) VALUES
(6, 'melany', '2005', 'Melany', 1),
(7, 'keysa', '2501', 'Keysalena', 4),
(11, 'maul', '123', 'Maulidya', 3),
(12, 'syin', '123', 'Syin', 2),
(13, 'jeno', '123', 'Jeno', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_masakan` (`id_masakan`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `masakan`
--
ALTER TABLE `masakan`
  ADD PRIMARY KEY (`id_masakan`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `masakan`
--
ALTER TABLE `masakan`
  MODIFY `id_masakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`id_masakan`) REFERENCES `masakan` (`id_masakan`);

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
