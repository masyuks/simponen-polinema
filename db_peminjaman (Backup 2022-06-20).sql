-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 12:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `path`, `stok`, `jenis`, `harga`) VALUES
(9, 'SLDR', 'solder', 'SLDR.jpg', 30, 'alat', '200000'),
(10, 'RST', 'Resistor', 'not_found.png', 20, 'komponen', '10000'),
(11, 'CNT', 'Connector', 'CNT.jpg', 10, 'komponen', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `id_peminjaman`, `id_barang`, `jumlah`, `keterangan`) VALUES
(7, 12, 9, 1, NULL),
(8, 13, 10, 1, '1 komponen rusak'),
(9, 13, 9, 2, ''),
(10, 14, 9, 1, 'solder rusak'),
(11, 14, 10, 1, NULL),
(12, 14, 11, 1, NULL),
(14, 16, 11, 1, NULL),
(15, 17, 9, 1, NULL),
(16, 17, 10, 1, NULL),
(17, 17, 11, 1, 'mengganti');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `kode_dosen` varchar(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `kode_dosen`, `nama_dosen`, `jabatan`) VALUES
(2, '101', 'Supri', 'Staff'),
(3, '102', 'Yono', 'Staff'),
(4, '103', 'Yusron', 'Dosen');

-- --------------------------------------------------------

--
-- Table structure for table `mk`
--

CREATE TABLE `mk` (
  `id` int(11) NOT NULL,
  `kode_mk` varchar(50) NOT NULL,
  `nama_mk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mk`
--

INSERT INTO `mk` (`id`, `kode_mk`, `nama_mk`) VALUES
(3, 'JAR', 'Jaringan'),
(4, 'WEB', 'Pemrograman Website'),
(5, 'K3', 'Keselamatan & Kesehatan Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `waktu_pinjam` datetime DEFAULT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `waktu_diajukan` datetime DEFAULT NULL,
  `email_push` datetime DEFAULT NULL,
  `id_mk` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `status`, `waktu_pinjam`, `waktu_kembali`, `id_teknisi`, `id_pengguna`, `id_dosen`, `waktu_diajukan`, `email_push`, `id_mk`, `kelas`, `semester`) VALUES
(12, '4', '2022-06-14 10:44:00', '2022-06-14 11:44:00', 3, 3, 4, '2022-06-14 10:43:56', NULL, 3, '4A', '7'),
(13, '4', '2022-06-15 11:21:00', '2022-06-15 12:21:00', 3, 4, 2, '2022-06-14 11:21:34', NULL, 4, '1D', '6'),
(14, '4', '2022-06-16 14:13:00', '2022-06-16 15:13:00', 3, 4, 2, '2022-06-15 14:13:32', NULL, 5, '2C', '3'),
(16, '4', '2022-06-15 16:39:00', '2022-06-15 16:38:00', 3, 5, 2, '2022-06-15 16:36:25', NULL, 4, '4A', '8'),
(17, '4', '2022-06-15 16:37:00', '2022-06-15 18:42:00', 3, 5, 3, '2022-06-15 16:37:26', NULL, 3, '1B', '7');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `kode_pengguna` varchar(10) DEFAULT NULL,
  `nama_pengguna` varchar(100) DEFAULT NULL,
  `username_pengguna` varchar(100) DEFAULT NULL,
  `password_pengguna` varchar(255) DEFAULT NULL,
  `email_pengguna` varchar(100) DEFAULT NULL,
  `jurusan_pengguna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `kode_pengguna`, `nama_pengguna`, `username_pengguna`, `password_pengguna`, `email_pengguna`, `jurusan_pengguna`) VALUES
(3, '1831710093', 'yuki', 'D3 Manajemen Informatika', '8b72529ec356bfa60828b4da6c2cc610', 'myukimiftakhurrizqi21@gmail.com', 'Teknik Informatika'),
(4, '1831710163', 'Iqbal', 'D3 Manajemen Informatika', 'eedae20fc3c7a6e9c5b1102098771c70', 'iqbal@gmail.com', 'Teknik Informatika'),
(5, '1841160077', 'Cindy Dwi Puspita Sari', 'D4 Jaringan Telekomunikasi Digital', 'cc4b2066cfef89f2475de1d4da4b29c7', 'cindy@gmail.com', 'Teknik Elektro');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `kode_teknisi` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nama_teknisi` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username_teknisi` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `password_teknisi` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `kode_teknisi`, `nama_teknisi`, `username_teknisi`, `password_teknisi`) VALUES
(3, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mk`
--
ALTER TABLE `mk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mk`
--
ALTER TABLE `mk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
