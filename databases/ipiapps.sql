-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2019 at 11:10 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipiapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `dimensi`
--

CREATE TABLE `dimensi` (
  `kode_d` int(11) NOT NULL,
  `nama_dimensi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dimensi`
--

INSERT INTO `dimensi` (`kode_d`, `nama_dimensi`) VALUES
(1, 'Indeks Pertumbuhan Ekonomi'),
(2, 'Indeks Inklusifitas'),
(3, 'Indeks Keberlanjutan');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `kode_indikator` int(11) NOT NULL,
  `nama_indikator` varchar(128) NOT NULL,
  `status` int(11) NOT NULL,
  `max_nilai` int(11) NOT NULL DEFAULT '0',
  `min_nilai` int(11) NOT NULL DEFAULT '0',
  `kode_sd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kode_indikator`, `nama_indikator`, `status`, `max_nilai`, `min_nilai`, `kode_sd`) VALUES
(1, 'Inflasi Sektoral', 1, 0, 0, 1),
(2, 'Pertumbuhan PDRB harga konstan', 0, 0, 0, 1),
(3, 'PDRB perkapita harga konstan', 0, 0, 0, 1),
(4, 'Pertumbuhan PDRB riil per kapita', 0, 0, 0, 1),
(5, 'Pertumbuhan Sektor Pertanian', 0, 0, 0, 1),
(6, 'Pertumbuhan Sektor Industri', 0, 0, 0, 1),
(7, 'Kontribusi Sektor Industri', 0, 0, 0, 1),
(8, 'Pertumbuhan Pembentukan Modal Tetap Bruto', 0, 0, 0, 1),
(9, 'Pertumbuhan Ekspor', 0, 0, 0, 1),
(10, 'Persentase tenaga kerja sektor industri', 0, 0, 0, 2),
(11, 'Rata-rata Lama Sekolah', 0, 0, 0, 2),
(12, 'Angka Harapan Lama Sekolah', 0, 0, 0, 2),
(13, 'Angka Partisipasi Murni (APM) setingkat sekolah dasar', 0, 0, 0, 2),
(14, 'Angka Partisipasi Murni (APM) setingkat sekolah menengah pertama', 0, 0, 0, 2),
(15, 'Angka Partisipasi Murni (APM) setingkat sekolah menengah atas', 0, 0, 0, 2),
(16, 'Rasio Murid terhadap Guru SD', 1, 0, 0, 2),
(17, 'Rasio Murid terhadap Guru SMP', 1, 0, 0, 2),
(18, 'Rasio Murid terhadap Guru SMA', 1, 0, 0, 2),
(19, 'Rasio Murid terhadap Guru SMK', 1, 0, 0, 2),
(20, 'Rasio Murid terhadap Jumah SD', 1, 0, 0, 2),
(21, 'Rasio Murid terhadap Jumah SMP', 1, 0, 0, 2),
(22, 'Rasio Murid terhadap Jumah SMA', 1, 0, 0, 2),
(23, 'Rasio Murid terhadap Jumah SMK', 1, 0, 0, 2),
(24, 'Angka Harapan Hidup', 0, 0, 0, 2),
(25, 'Angka Kematian Bayi', 1, 0, 0, 2),
(26, 'Angka Morbiditas', 1, 0, 0, 2),
(27, 'Persentase Bayi dengan Gizi Cukup (Berat Badan > 2.5 kg)', 0, 0, 0, 2),
(28, 'Rasio Rumah Sakit per Penduduk', 0, 0, 0, 2),
(29, 'Rasio Puskesmas Umum dan Pembantu per Penduduk', 0, 0, 0, 2),
(30, 'Rasio Kasus Penyakit Utamas Masyarakat Gresik terhadap Penduduk', 1, 0, 0, 2),
(31, 'Persentase Penduduk Miskin', 1, 0, 0, 3),
(32, 'Indeks Keparahan Kemiskinan', 1, 0, 0, 3),
(33, 'Indeks Kedalaman Kemiskinan', 1, 0, 0, 3),
(34, 'Tingkat Pengangguran Terbuka', 1, 0, 0, 3),
(35, 'Indeks Pemberdayaan Gender', 0, 0, 0, 4),
(36, 'Persentase Rumah Tangga dengan Luas Lantai Hunian ? 50 m2', 2, 0, 0, 4),
(37, 'Persentase Rumah Tangga dengan Lantai Bukan Tanah', 2, 0, 0, 4),
(38, 'Persentase Rumah Tangga dengan Dinding Tembok', 2, 0, 0, 4),
(39, 'Persentase Rumah Tangga dengan Atap Beton/Tembok', 2, 0, 0, 4),
(40, 'Persentase Rumah Tangga dengan Sumber Air Minum Kemasan/Isi Ulang', 2, 0, 0, 4),
(41, 'Persentase Rumah Tangga dengan Fasilitas BAB Sendiri', 2, 0, 0, 4),
(42, 'Ruang Fiskal Daerah', 2, 0, 0, 5),
(43, 'Derajat Desentralisasi Fiskal', 2, 0, 0, 5),
(44, 'Rasio belanja pendidikan terhadap penduduk usia sekolah', 0, 0, 0, 5),
(45, 'Rasio belanja kesehatan terhadap total penduduk', 0, 0, 0, 5),
(46, 'Produktivitas Lahan Sawah', 0, 0, 0, 6),
(47, 'Water Supply Consumption ', 2, 0, 0, 6),
(48, 'Electricity Supply Consumption ', 2, 0, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `nilaidimensi`
--

CREATE TABLE `nilaidimensi` (
  `id_nilai_d` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilaiindikator`
--

CREATE TABLE `nilaiindikator` (
  `id_nilai_i` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_indikator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilaisubdimensi`
--

CREATE TABLE `nilaisubdimensi` (
  `id_nilai_sd` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL,
  `kode_sd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subdimensi`
--

CREATE TABLE `subdimensi` (
  `kode_sd` int(11) NOT NULL,
  `nama_sub_dimensi` varchar(128) NOT NULL,
  `kode_d` int(11) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subdimensi`
--

INSERT INTO `subdimensi` (`kode_sd`, `nama_sub_dimensi`, `kode_d`, `link`) VALUES
(1, 'IAE', 1, 'admin/iae'),
(2, 'IPSDM', 1, 'admin/ipsm'),
(3, 'IPK', 2, 'admin/ipk'),
(4, 'IP', 2, 'admin/ip'),
(5, 'IKK', 3, 'admin/ikk'),
(6, 'IKI', 3, 'admin/iki'),
(7, 'II', 1, 'admin/ii');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `kode_tahun` int(11) NOT NULL,
  `detail_tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`kode_tahun`, `detail_tahun`) VALUES
(1, 2012),
(2, 2013),
(3, 2014),
(4, 2015),
(5, 2016),
(6, 2017),
(7, 2018),
(8, 2019),
(9, 2020),
(10, 2021),
(11, 2021),
(12, 2022),
(13, 2023),
(14, 2024),
(15, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '$2y$10$I5PumD0zV5jA6R3OvwymZOp8jPA0CkBQH01mBxK0kkpLuu5Ey/D1W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dimensi`
--
ALTER TABLE `dimensi`
  ADD PRIMARY KEY (`kode_d`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`kode_indikator`),
  ADD KEY `kode_sd` (`kode_sd`);

--
-- Indexes for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  ADD PRIMARY KEY (`id_nilai_d`),
  ADD KEY `kode_d` (`kode_d`);

--
-- Indexes for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  ADD PRIMARY KEY (`id_nilai_i`),
  ADD KEY `kode_indikator` (`kode_indikator`);

--
-- Indexes for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  ADD PRIMARY KEY (`id_nilai_sd`),
  ADD KEY `kode_sd` (`kode_sd`);

--
-- Indexes for table `subdimensi`
--
ALTER TABLE `subdimensi`
  ADD PRIMARY KEY (`kode_sd`),
  ADD KEY `kode_d` (`kode_d`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`kode_tahun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dimensi`
--
ALTER TABLE `dimensi`
  MODIFY `kode_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `kode_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  MODIFY `id_nilai_d` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  MODIFY `id_nilai_i` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  MODIFY `id_nilai_sd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subdimensi`
--
ALTER TABLE `subdimensi`
  MODIFY `kode_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `kode_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`kode_sd`) REFERENCES `subdimensi` (`kode_sd`);

--
-- Constraints for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  ADD CONSTRAINT `nilaidimensi_ibfk_1` FOREIGN KEY (`kode_d`) REFERENCES `dimensi` (`kode_d`);

--
-- Constraints for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  ADD CONSTRAINT `nilaiindikator_ibfk_1` FOREIGN KEY (`kode_indikator`) REFERENCES `indikator` (`kode_indikator`);

--
-- Constraints for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  ADD CONSTRAINT `nilaisubdimensi_ibfk_1` FOREIGN KEY (`kode_sd`) REFERENCES `nilaisubdimensi` (`id_nilai_sd`);

--
-- Constraints for table `subdimensi`
--
ALTER TABLE `subdimensi`
  ADD CONSTRAINT `subdimensi_ibfk_1` FOREIGN KEY (`kode_d`) REFERENCES `dimensi` (`kode_d`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
