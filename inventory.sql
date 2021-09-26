-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2021 pada 19.11
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `alamat_admin` text NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `nama_admin`, `alamat_admin`, `password`) VALUES
('A01', 'raihanrmdn7@gmail.com', 'Raihan Murtadha Ramadhan', 'Jl Kubang Raya Km 4', '$2y$10$Bo7y/ZuhCDtFtIzko0jVKuKpPBgJlbdQwa4SScEZ07J1a8Ca3lXDe'),
('A02', 'tomi@yahoo.com', 'tomi', '-', '$2y$10$BukjIwlzkmfYfYhP/LLUcuGPAyUoFeBucB/v6fVAYnkqhDBsrY8Lm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `merek`, `kategori`, `satuan`, `stok`, `harga_beli`, `harga_jual`) VALUES
('B000001', 'Rinso Cair 50ml', 'Deterjen', 'Btl', 0, 2400, 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_supplier` varchar(30) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `type`, `tanggal`, `nama_supplier`, `kategori`, `qty`, `satuan`, `keterangan`, `id_user`) VALUES
('St000001', 'B000001', 'in', '2021-09-24 23:59:10', '-', 'Deterjen', 80, 'Btl', 'haus', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_supplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_hp`, `alamat_supplier`) VALUES
('S01', '-', '0', '-'),
('S02', 'ALI (PT. Indomarco Prismatama)', '082234567456', 'Jl Kubang Raya'),
('S03', 'Yusuf (PT. Alam Jaya Sejahtera', '081938573452', 'Jl Kutilang Sakti');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
