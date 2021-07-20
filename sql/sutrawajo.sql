-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 07:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_polreswajo`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailperkara`
--

CREATE TABLE `detailperkara` (
  `id` int(11) NOT NULL,
  `idperkara` int(11) NOT NULL,
  `level` varchar(10) NOT NULL,
  `deskripsi` varchar(2408) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tanggalbuat` date NOT NULL,
  `terakhirdiubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `identitas` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isilaporan` varchar(1000) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'terkirim',
  `keterangan_status` varchar(1000) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `dilihat` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `perkara`
--

CREATE TABLE `perkara` (
  `id` int(11) NOT NULL,
  `nomorperkara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Super Admin'),
(2, 'Admin SP2HP'),
(3, 'Admin SKCK'),
(4, 'Admin Lapor');

-- --------------------------------------------------------

--
-- Table structure for table `skck`
--

CREATE TABLE `skck` (
  `id` int(11) NOT NULL,
  `pemohon` varchar(50) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `paspor` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `umur` int(3) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kedudukan` varchar(255) NOT NULL,
  `bapak` varchar(255) NOT NULL,
  `ibu` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `pasangan` varchar(255) NOT NULL,
  `bapak_pasangan` varchar(255) NOT NULL,
  `ibu_pasangan` varchar(255) NOT NULL,
  `alamat_pasangan` varchar(255) NOT NULL,
  `sanak` varchar(255) NOT NULL,
  `alamat_sanak` varchar(255) NOT NULL,
  `anak` varchar(255) NOT NULL,
  `rambut` varchar(255) NOT NULL,
  `muka` varchar(255) NOT NULL,
  `kulit` varchar(255) NOT NULL,
  `tinggi` varchar(255) NOT NULL,
  `tanda` varchar(255) NOT NULL,
  `sidik` varchar(255) NOT NULL,
  `sd` varchar(255) NOT NULL,
  `smp` varchar(255) NOT NULL,
  `sma` varchar(255) NOT NULL,
  `st` varchar(255) NOT NULL,
  `hobi` varchar(255) NOT NULL,
  `catatan_kriminal` varchar(255) NOT NULL,
  `keterangan_lain` varchar(255) NOT NULL,
  `progress` varchar(255) NOT NULL,
  `keterangan_progres` varchar(1000) NOT NULL,
  `terakhirupdate` datetime NOT NULL,
  `dilihat` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skck2`
--

CREATE TABLE `skck2` (
  `id` int(11) NOT NULL,
  `idskck` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) NOT NULL,
  `kebangsaan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `perkawinan` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `paspor` varchar(255) NOT NULL,
  `kitas` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `nama_pasangan` varchar(255) NOT NULL,
  `umur_pasangan` varchar(255) NOT NULL,
  `agama_pasangan` varchar(255) NOT NULL,
  `kebangsaan_pasangan` varchar(255) NOT NULL,
  `pekerjaan_pasangan` varchar(255) NOT NULL,
  `alamat_pasangan` varchar(255) NOT NULL,
  `nama_bapak` varchar(255) NOT NULL,
  `umur_bapak` varchar(255) NOT NULL,
  `agama_bapak` varchar(255) NOT NULL,
  `kebangsaan_bapak` varchar(255) NOT NULL,
  `pekerjaan_bapak` varchar(255) NOT NULL,
  `alamat_bapak` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `umur_ibu` varchar(255) NOT NULL,
  `agama_ibu` varchar(255) NOT NULL,
  `kebangsaan_ibu` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) NOT NULL,
  `alamat_ibu` varchar(255) NOT NULL,
  `saudara_kandung` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `pidana1` varchar(255) NOT NULL,
  `pidana2` varchar(255) NOT NULL,
  `pidana3` varchar(255) NOT NULL,
  `pidana4` varchar(255) NOT NULL,
  `pidana5` varchar(255) NOT NULL,
  `pelanggaran1` varchar(255) NOT NULL,
  `pelanggaran2` varchar(255) NOT NULL,
  `pelanggaran3` varchar(255) NOT NULL,
  `keterangan_lain1` varchar(255) NOT NULL,
  `keterangan_lain2` varchar(255) NOT NULL,
  `keterangan_lain3` varchar(255) NOT NULL,
  `sponsor1` varchar(255) NOT NULL,
  `sponsor2` varchar(255) NOT NULL,
  `sponsor3` varchar(255) NOT NULL,
  `sponsor4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `role`) VALUES
(8, 'Admin SP2HP', 'adminsp', 'e10adc3949ba59abbe56e057f20f883e', 2),
(9, 'Admin SKCK', 'adminskck', 'e10adc3949ba59abbe56e057f20f883e', 3),
(10, 'Super Admin', 'superadmin', 'e10adc3949ba59abbe56e057f20f883e', 1),
(11, 'Admin Lapor', 'adminlapor', 'e10adc3949ba59abbe56e057f20f883e', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailperkara`
--
ALTER TABLE `detailperkara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detailperkara_ibfk_1` (`idperkara`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perkara`
--
ALTER TABLE `perkara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skck`
--
ALTER TABLE `skck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skck2`
--
ALTER TABLE `skck2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skck2_ibfk_1` (`idskck`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `foreign_key` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailperkara`
--
ALTER TABLE `detailperkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perkara`
--
ALTER TABLE `perkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skck`
--
ALTER TABLE `skck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skck2`
--
ALTER TABLE `skck2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailperkara`
--
ALTER TABLE `detailperkara`
  ADD CONSTRAINT `detailperkara_ibfk_1` FOREIGN KEY (`idperkara`) REFERENCES `perkara` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skck2`
--
ALTER TABLE `skck2`
  ADD CONSTRAINT `skck2_ibfk_1` FOREIGN KEY (`idskck`) REFERENCES `skck` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
