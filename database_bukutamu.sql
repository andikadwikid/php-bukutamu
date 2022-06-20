-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 06:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', '123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `kode_d` varchar(2) NOT NULL,
  `nama_d` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`kode_d`, `nama_d`) VALUES
('01', 'IT'),
('02', 'HR'),
('03', 'Marketing'),
('04', 'Accounting'),
('05', 'Housekeeping'),
('06', 'Internal Audit');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `no` int(15) NOT NULL,
  `no_antri` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `bertemu` varchar(255) NOT NULL,
  `janji` tinyint(1) NOT NULL,
  `suhu_tubuh` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`no`, `no_antri`, `nama`, `tanggal_masuk`, `tanggal_keluar`, `keperluan`, `bertemu`, `janji`, `suhu_tubuh`, `image`) VALUES
(452, '202104080001', 'Andika', '2021-04-08 11:09:48', '0000-00-00 00:00:00', 'Magang', 'HR', 0, 35, 'bendera-merah-putih.png'),
(455, '202104080003', 'Wahyu', '2021-04-08 11:14:29', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 36, 'bendera-merah-putih.png'),
(456, '202104080004', 'Budiman', '2021-04-08 11:14:52', '0000-00-00 00:00:00', 'Antar Barang', 'IT', 0, 36, 'bendera-merah-putih.png'),
(457, '202104080005', 'Dwiki', '2021-04-08 11:15:18', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 36.3, 'bendera-merah-putih.png'),
(458, '202104080006', 'Wahyudi', '2021-04-08 11:15:44', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 37, 'bendera-merah-putih.png'),
(459, '202104080007', 'Agus', '2021-04-08 11:16:08', '0000-00-00 00:00:00', 'Antar Barang', 'IT', 0, 36, 'bendera-merah-putih.png'),
(460, '202104080008', 'Bagas', '2021-04-08 11:16:40', '0000-00-00 00:00:00', 'Magang', 'HR', 0, 35, 'bendera-merah-putih.png'),
(461, '202104080009', 'Jamal', '2021-04-08 11:17:13', '0000-00-00 00:00:00', 'Antar Barang', 'Housekeeping', 0, 36, 'bendera-merah-putih.png'),
(462, '202104080010', 'Ahmad', '2021-04-08 11:18:02', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 35, 'bendera-merah-putih.png'),
(465, '202104080011', 'Bagus', '2021-04-08 11:27:47', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 35, 'bendera-merah-putih.png'),
(467, '202104080012', 'Andi', '2021-04-08 12:07:41', '0000-00-00 00:00:00', 'Interview', 'HR', 0, 36, 'bendera-merah-putih.png'),
(468, '202104080013', 'Asep', '2021-04-08 12:08:18', '0000-00-00 00:00:00', 'Antar Barang', 'Accounting', 0, 35, 'bendera-merah-putih.png'),
(469, '202104080014', 'Diki', '2021-04-08 14:58:44', '2021-04-12 11:20:11', 'Interview', 'HR', 0, 35.6, 'bendera-merah-putih.png'),
(470, '202104080015', 'asdsad', '2021-04-08 16:32:21', '2021-04-11 22:22:46', 'sadsa', 'IT', 0, 35, 'bendera-merah-putih.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`kode_d`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
