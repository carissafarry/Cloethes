-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2020 pada 10.02
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloethes_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_us`
--

CREATE TABLE `about_us` (
  `id_page` int(11) NOT NULL,
  `pagename` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc_page` varchar(200) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `about_us`
--

INSERT INTO `about_us` (`id_page`, `pagename`, `title`, `desc_page`, `link`) VALUES
(7, 'about_us', 'Hayooo', 'desc_page', 'http://cloethes.co.id/aboutus.php'),
(8, 'about_us2', 'Hayo', 'desc_page', 'http://cloethes.co.id/aboutus.php'),
(10, 'about_us3', 'About Cloethes', 'About our company', 'http://cloethes.co.id/aboutus.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `mata_uang` varchar(10) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `username`, `email`, `password`, `foto`, `nama`, `tgl_lahir`, `alamat`, `negara`, `mata_uang`, `no_telp`, `usertype`, `status`) VALUES
(31, 'carissafarry', 'carissafarry@gmail.com', 'carissafarry', '5ecbec54c4739.jpg', 'Carissa Farry', '2001-07-31', 'Tulungagung', 'ID', 'Rupiah', '085784166229', 'user', 0),
(35, 'farryhilmi', 'farryhilmi@gmail.com', 'farryhilmi', '5ee80028f28ee.jpg', 'Carissa Farry', '2000-07-31', 'Jl Recobarong No. 86, Ngunut, Tulungagung', 'ID', 'Rupiah', '085784166229', 'user', 0),
(36, 'triaelvafizani', 'triaelvafizani@gmail.com', 'tria', '5ee8299484048.jpg', 'Tria Elvafizani', '2000-03-01', 'Bendilwungu, Tulungagung', 'ID', 'Rupiah', '081359797929', 'user', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `country`
--

CREATE TABLE `country` (
  `id_country` int(11) NOT NULL,
  `inisial` varchar(10) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `country`
--

INSERT INTO `country` (`id_country`, `inisial`, `currency`, `nama`, `deskripsi`) VALUES
(1, 'ID', 'IDR', 'Indonesia', 'Domestic'),
(3, 'SG', 'SGD', 'Singapore', 'International\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_order`
--

CREATE TABLE `invoice_order` (
  `id_invoice` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `paid` varchar(30) NOT NULL DEFAULT 'pending',
  `shipping_num` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice_order`
--

INSERT INTO `invoice_order` (`id_invoice`, `id_order`, `id_produk`, `quantity`, `total_bayar`, `paid`, `shipping_num`) VALUES
(38, 145, 28, 1, '230000', 'pending', ''),
(39, 145, 2, 2, '215000', 'pending', ''),
(40, 146, 28, 1, '230000', 'pending', ''),
(41, 146, 2, 1, '215000', 'pending', ''),
(42, 146, 44, 2, '210000', 'pending', ''),
(43, 147, 28, 1, '230000', 'goods sent', 'AB12345678910'),
(44, 147, 29, 2, '190000', 'goods sent', 'AB12345678910'),
(45, 148, 28, 3, '230000', 'canceled', ''),
(46, 148, 2, 1, '215000', 'canceled', ''),
(47, 149, 27, 1, '100000', 'paid', ''),
(48, 150, 27, 2, '100000', 'in confirmation', ''),
(49, 151, 29, 3, '190000', 'goods sent', '121212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_cat` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_cat`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'now trending', 'paling laku'),
(2, 'new arrivals', 'paling baru'),
(7, 'special prices', 'diskon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `id_metode` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `detail_metode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_data`
--

CREATE TABLE `order_data` (
  `id_order` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `total_payment` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_data`
--

INSERT INTO `order_data` (`id_order`, `username`, `tgl_order`, `waktu`, `alamat`, `total_payment`, `status`) VALUES
(145, 'farryhilmi', '2020-06-16', '08:48:10', 'Jl Recobarong No. 86, Ngunut, Tulungagung', '660000', 0),
(146, 'triaelvafizani', '2020-06-16', '09:10:06', 'Bendilwungu, Tulungagung', '865000', 0),
(147, 'farryhilmi', '2020-06-16', '09:46:30', 'Jl Recobarong No. 86, Ngunut, Tulungagung', '610000', 0),
(148, 'cazzahra82@gmail.com', '2020-06-17', '07:08:29', '', '905000', 0),
(149, 'cazzahra82@gmail.com', '2020-06-17', '15:23:47', '', '100000', 0),
(150, 'cazzahra82@gmail.com', '2020-06-17', '15:45:47', '', '200000', 0),
(151, 'cazzahra82@gmail.com', '2020-06-17', '15:51:23', 'Bismillah', '570000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `about_us` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(20) NOT NULL,
  `id_order` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `atas_nama` varchar(200) NOT NULL,
  `total_payment` varchar(100) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `tgl_payment` date NOT NULL,
  `time_payment` time NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id_payment`, `id_order`, `username`, `atas_nama`, `total_payment`, `bank`, `tgl_payment`, `time_payment`, `payment_proof`, `status`) VALUES
(10, 147, 'farryhilmi', 'Carissa Farry', '610000', 'Mandiri', '2020-06-16', '13:23:29', '5ee865716a3f6.png', 0),
(11, 148, 'cazzahra82@gmail.com', 'Cazzahra', '905000', 'Mandiri', '2020-06-17', '07:17:18', '5ee96135a9d25.jpg', 0),
(12, 147, 'farryhilmi', 'Carissa Farry', '610000', 'Mandiri', '2020-06-17', '10:28:49', '5ee98e1213bc6.png', 0),
(13, 149, 'cazzahra82@gmail.com', 'Carissa', '100000', 'Mandiri', '2020-06-17', '15:25:35', '5ee9d3b1c197c.png', 0),
(14, 150, 'cazzahra82@gmail.com', 'Carissa Hilmi', '200000', 'Mandiri', '2020-06-17', '15:46:00', '5ee9d8cf0faad.png', 0),
(15, 151, 'cazzahra82@gmail.com', 'Carissa Farry Hilmi A Z', '570000', 'Mandiri', '2020-06-17', '15:51:33', '5ee9d9b0d3f75.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` bigint(11) NOT NULL,
  `deskripsi_produk` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `foto`, `warna`, `ukuran`, `stok`, `harga`, `deskripsi_produk`, `status`) VALUES
(2, '1', 'Domini Blazer', '5ec48eec41b04.jpg', 'Beige', 'Fit Size', 95, 215000, 'Blazer + Rok ', 0),
(27, '1', 'Coastal Shirt', '5ec4c4ddb20e5.jpg', 'White', 'Fit Size', 100, 100000, '  Paradise  ', 0),
(28, '1', 'Cora Jacket', '5ec4d96f9ad40.jpg', 'Blue', 'Fit Size', 100, 230000, 'Jacket\r\n', 0),
(29, '2', 'Distant Hoodie White', '5ec4dbe1bb673.jpg', 'White', 'Fit Size', 100, 190000, 'Hoodie', 0),
(44, '1', 'Beatrix Shirt', '5ecd18dc237b7.jpg', 'White', 'Fit Size', 100, 210000, '', 0),
(46, '1', 'Memo Top in Beige', '5ecf28f1e1942.jpg', 'Beige', 'Fit Size', 100, 150000, 'Beige Blouse', 0),
(50, '2', 'General Trousers in Dusk', '5ecf2d1149635.jpg', 'Blue', 'Fit Size', 100, 210000, 'Material: Cotton Polyester\r\nTrousers with front pleats.\r\nS-Waist: 68 cm | Hips: 96 cm | Length: 102 cm\r\nM-Waist: 72 cm | Hips: 98 cm | Length: 102 cm\r\nL-Waist: 76 cm | Hips: 102 cm | Length: 102 cm\r\nWeight: 0,3 kg', 0),
(54, '7', 'Sia Shirt Black', '5eeae14bafa3f.jpg', 'Black', 'Fit Size', 100, 99000, 'Black Top Shirt Long', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_admin`
--

CREATE TABLE `user_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_admin`
--

INSERT INTO `user_admin` (`id_admin`, `username`, `password`, `usertype`) VALUES
(10, 'carissa', '$2y$10$eJDkv/3rM3N4djppEGAAcuf0tgFKkrd1ciGcztfKGHyc/xhxHGgF.', 'admin'),
(11, 'farry', '$2y$10$Obr1GKWol9JSx6WtniPZHexP4ZB2S0Yp5WG4W4kt9LiV6fOacDxti', 'admin'),
(16, 'carissafarry', '$2y$10$LMru2jLCLsEPfkheAl0UVOpJS.pw4LFtXFnbrP5TlKtte1X/Paj.u', 'admin'),
(18, 'haha', '$2y$10$Y4wK0G2P/uPQ0ENsUcsTUOJAxgoKJjPCYRAJwT3JdlH93XZ4aNBg6', 'admin'),
(20, 'ditaaudi', '$2y$10$kllGJUwyAn4FXV/tBa1ceucHJDtLRQyom/TD24P4uk2knoVBLuwbC', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id_page`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- Indeks untuk tabel `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indeks untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_data`
--
ALTER TABLE `order_data`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
