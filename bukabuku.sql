-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2022 at 09:24 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukabuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(5) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_jenis` int(3) DEFAULT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `id_jenis`, `id_pegawai`) VALUES
('B0001', 'POLITIK', 75000, 15, 2, 'P0001'),
('B0002', 'MITOS SISIFUS', 50000, 35, 1, 'P0001'),
('B0003', 'DUNIA SOPHIE', 100000, 50, 3, 'P0001'),
('B0004', 'REPUBLIK', 80000, 15, 1, 'P0001'),
('B0005', 'KEHENDAK BERKUASA', 70000, 30, 2, 'P0001'),
('B0006', 'SAPIENS', 115000, 30, 4, NULL),
('B0007', '21 LESSONS', 105000, 34, 4, NULL),
('B0008', 'BUMI MANUSIA', 150000, 100, 3, NULL),
('B0009', 'FILSAFAT NIETZSCHE', 66000, 22, 1, 'P0001'),
('B0010', 'ISLAM SOSIALISME', 45000, 70, 2, NULL),
('B0011', 'ZARATHUSTRA', 120000, 200, 1, NULL),
('B0012', 'HOMO DEUS', 80000, 90, 4, 'P0001'),
('B0013', 'JEJAK LANGKAH', 95000, 30, 3, 'P0003'),
('B0014', 'CANTIK ITU LUKA', 128000, 50, 3, 'P0001'),
('B0015', 'GOD DELUSION', 80000, 75, 2, 'P0001'),
('B0020', 'BROTHER KARAMAZOV', 9000, 90, 1, 'P0001'),
('B0021', '1984', 80000, 80, 3, 'P0001');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(3) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `id_pegawai`) VALUES
(1, 'FILSAFAT', 'P0001'),
(2, 'SOSIAL', NULL),
(3, 'NOVEL', NULL),
(4, 'SEJARAH', 'P0001'),
(5, 'SAINS', 'P0001');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(5) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `pass`, `nama_pegawai`, `telepon`, `alamat`) VALUES
('admin', '*161959ED38D1EC5E58962E6B9D50661C2A9C4B17', 'admin', '', ''),
('P0001', '*58D24DFDC5B5D55D6F6A25496AB51B74AA0FF7C9', 'Ujang Khrushchev', '089678678876', 'Leuwi Panjang'),
('P0002', '*45F2C3B4476FFF9AE3E6335C54339C17B96DB83B', 'Ading Stalin', '081181767567', 'Rancaekek'),
('P0003', '*5123B8EB86D02AD7E83D62C32CF127D04050CB69', 'Didin Chavez', '0896789871', 'Cicaheum'),
('P0004', '*3917ADBD4035C1227D2C71118B98632914CFCFC0', 'Udin The World', '0811777991', 'Buah Batu'),
('P0005', '*CB11E912F85906221A2EF381D5F529BE470F461D', 'Jaka Khadafi', '0811777922', 'Cimahi'),
('P0006', '*CA152FE89A4802A433254162E1AF06A16FB2531D', 'Gugun Guevara', '08181789654', 'Cibiru'),
('P0007', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Jauhari Bin Laden', '0811818991', 'Bojong Soang');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` varchar(5) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `telepon`, `alamat`, `id_pegawai`) VALUES
('T0001', 'Winda Vision', '089567765678', 'Cibiru', 'P0001'),
('T0002', 'Silvyanto', '082316149255', 'Banjaran', 'P0001'),
('T0003', 'Rifa Anime', '087678657765', 'Sekeloa', 'P0001'),
('T0004', 'Daffa Holland', '081189987657', 'Bale Endah', 'P0001'),
('T0005', 'Wayan Wibu', '0877897654569', 'Lampung', 'P0001');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` varchar(30) DEFAULT NULL,
  `id_barang` varchar(5) NOT NULL,
  `id_pembeli` varchar(5) NOT NULL,
  `id_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `deskripsi`, `id_barang`, `id_pembeli`, `id_pegawai`) VALUES
(1, '2022-07-09', '', 'B0001', 'T0002', 'P0001'),
(2, '2022-07-15', '', 'B0005', 'T0003', 'admin'),
(3, '2022-07-11', '', 'B0002', 'T0003', 'P0001'),
(4, '2022-07-12', '', 'B0007', 'T0004', 'P0001'),
(5, '2022-07-12', '', 'B0020', 'T0005', 'P0001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_pegawai_2` (`id_pegawai`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `jenis`
--
ALTER TABLE `jenis`
  ADD CONSTRAINT `jenis_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD CONSTRAINT `pembeli_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
