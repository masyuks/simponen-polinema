-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 11:24 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

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
(9, 'SLDR', 'solder', 'SLDR.jpg', 17, 'alat', '200000'),
(10, 'RST', 'Resistor', 'not_found.png', 2, 'komponen', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `id_peminjaman`, `id_barang`, `jumlah`) VALUES
(3, 9, 9, 2),
(4, 9, 10, 1),
(5, 10, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `kode_dosen` varchar(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_mk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `kode_dosen`, `nama_dosen`, `jabatan`, `id_mk`) VALUES
(2, '101', 'Supri', 'Staff', 3),
(3, '102', 'Yono', 'Staff', 4);

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
(4, 'WEB', 'Pemrograman Website');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `waktu_pinjam` datetime DEFAULT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `waktu_diajukan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `status`, `keterangan`, `waktu_pinjam`, `waktu_kembali`, `id_teknisi`, `id_pengguna`, `id_dosen`, `waktu_diajukan`) VALUES
(9, '2', NULL, '2022-06-09 13:37:00', '2022-06-09 14:37:00', NULL, 3, 2, '2022-06-09 13:37:09'),
(10, '1', NULL, '2022-06-09 13:52:00', '2022-06-09 14:53:00', NULL, 4, 3, '2022-06-09 13:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `kode_pengguna` varchar(10) DEFAULT NULL,
  `nama_pengguna` varchar(100) DEFAULT NULL,
  `username_pengguna` varchar(20) DEFAULT NULL,
  `password_pengguna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `kode_pengguna`, `nama_pengguna`, `username_pengguna`, `password_pengguna`) VALUES
(3, '1831710093', 'yuki', 'yuki', '8b72529ec356bfa60828b4da6c2cc610'),
(4, '1831710163', 'Iqbal', 'iqbal', 'eedae20fc3c7a6e9c5b1102098771c70');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mk`
--
ALTER TABLE `mk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
