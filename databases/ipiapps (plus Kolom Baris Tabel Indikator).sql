-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 26, 2020 at 04:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipiapps_clone`
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
  `max_nilai` double NOT NULL DEFAULT 0,
  `min_nilai` double NOT NULL DEFAULT 0,
  `kode_sd` int(11) NOT NULL,
  `baris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kode_indikator`, `nama_indikator`, `status`, `max_nilai`, `min_nilai`, `kode_sd`, `baris`) VALUES
(1, 'Deflator PDRB', 1, 1.3566, 1.11446291560895, 1, 1),
(2, 'Deflator Sektor Pertanian', 1, 1.6621, 1.17013309245393, 1, 2),
(3, 'Deflator Sektor Pertambangan', 1, 1.34363526354956, 0.820265655823663, 1, 3),
(4, 'Deflator Sektor Industri', 1, 1.357, 1.11450635480815, 1, 4),
(5, 'Deflator Sektor Konstruksi', 1, 1.3926, 1.06818412475863, 1, 5),
(6, 'Deflator Sektor Perdagangan', 1, 1.4151, 1.08984482210607, 1, 6),
(7, 'Pertumbuhan PDRB harga konstan', 0, 7.04, 5.49, 2, 1),
(8, 'PDRB perkapita harga konstan', 0, 74110, 55499, 2, 2),
(9, 'Pertumbuhan PDRB riil per kapita', 0, 5.79083212884576, 4.29780848817176, 2, 3),
(10, 'Pertumbuhan Sektor Pertanian', 0, 6.25, -2.35, 2, 4),
(11, 'Pertumbuhan Sektor Industri', 0, 7.57636958843055, 4.21, 2, 5),
(12, 'Kontribusi Sektor Industri', 0, 49.22, 47.77, 2, 6),
(13, 'Pertumbuhan Pembentukan Modal Tetap Bruto', 0, 11.58, 4.59, 2, 7),
(14, 'Pertumbuhan Ekspor', 0, 7.91, 3.6, 2, 8),
(15, 'Indeks Pembangunan Manusia', 0, 75.28, 72.12, 3, 1),
(16, 'Indeks Pembangunan Gender', 0, 89.72, 75.28, 3, 2),
(17, 'Rata-rata Lama Sekolah', 0, 8.96, 8.41, 3, 3),
(18, 'Angka Harapan Lama Sekolah', 0, 13.71, 12.63, 3, 4),
(19, 'Angka Partisipasi Murni (APM) setingkat SD', 0, 98.98, 87.37, 3, 5),
(20, 'Angka Partisipasi Murni (APM) setingkat smp', 0, 87.7, 79.91, 3, 6),
(21, 'Angka Partisipasi Murni (APM) setingkat SMA', 0, 75.86, 57.72, 3, 7),
(22, 'Rasio Murid terhadap Guru SD', 1, 17.1648721399731, 14.8366164542294, 3, 8),
(23, 'Rasio Murid terhadap Guru SMP', 1, 17.162610046608, 11.5934684684685, 3, 9),
(24, 'Rasio Murid terhadap Guru SMA', 1, 16.9835924006908, 8.35547355473555, 3, 10),
(25, 'Rasio Murid terhadap Guru SMK', 1, 17.9656387665198, 11.2684246112238, 3, 11),
(26, 'Rasio Murid terhadap Jumah SD', 1, 174.353603603604, 169.669623059867, 3, 12),
(27, 'Rasio Murid terhadap Jumah SMP', 1, 325.722772277228, 298.567567567568, 3, 13),
(28, 'Rasio Murid terhadap Jumah SMA', 1, 378.211538461538, 8.35547355473555, 3, 14),
(29, 'Rasio Murid terhadap Jumah SMK', 1, 377.452380952381, 337.018867924528, 3, 15),
(30, 'Angka Harapan Hidup', 0, 72.46, 72.18, 3, 16),
(31, 'Persentase Bayi dengan Gizi Cukup (Berat Badan > 2.5 kg)', 0, 0.991074527693757, 0.972570612827572, 3, 17),
(32, 'Rasio Rumah Sakit per 1 juta Penduduk', 0, 16.1567170781885, 7.33435960039149, 3, 18),
(33, 'Rasio Puskesmas Umum dan Pembantu per 1 juta Penduduk', 0, 89.9572991682664, 81.5529528708563, 3, 19),
(34, 'Angka Kematian Bayi', 1, 20.95, 18.24, 3, 20),
(35, 'Angka Morbiditas', 1, 13.28, 9.84299052074796, 3, 21),
(36, 'Rasio Kasus Penyakit Utamas Masyarakat Gresik terhadap Penduduk', 1, 0.428804329134634, 0.080999474071228, 3, 22),
(37, 'Persentase Penduduk Miskin', 1, 14.35, 11.89, 4, 1),
(38, 'Indeks Keparahan Kemiskinan', 1, 2.58, 1.79, 4, 2),
(39, 'Indeks Kedalaman Kemiskinan', 1, 0.72, 0.45, 4, 3),
(40, 'Persentase tenaga kerja sektor industri', 0, 35.2232934563708, 25.5463717386828, 4, 4),
(41, 'Tingkat Pengangguran Terbuka', 1, 6.78, 4.54, 4, 5),
(42, 'Indeks Gini', 1, 0.43, 0.277550505050505, 5, 1),
(43, 'Persentase Rumah Tangga dengan Luas Lantai Hunian Lebih dari 50 m2', 0, 86.42, 82.36, 5, 2),
(44, 'Persentase Rumah Tangga dengan Lantai Bukan Tanah', 0, 97.91, 93.83, 5, 3),
(45, 'Persentase Rumah Tangga dengan Dinding Tembok', 0, 91.73, 85.02, 5, 4),
(46, 'Persentase Rumah Tangga dengan Atap Beton/Tembok', 0, 94.3, 89.615, 5, 5),
(47, 'Persentase Rumah Tangga dengan Sumber Air Minum Kemasan/Isi Ulang', 0, 88.67, 68.7, 5, 6),
(48, 'Persentase Rumah Tangga dengan Fasilitas BAB Sendiri', 0, 91, 86.35, 5, 7),
(49, 'Ruang Fiskal Daerah', 0, 69.96, 46.9, 6, 1),
(50, 'Derajat Desentralisasi Fiskal', 0, 32.92, 25.9, 6, 2),
(51, 'Rasio belanja pendidikan terhadap penduduk usia sekolah', 0, 2.25946514387607, 1.68814133317088, 6, 3),
(52, 'Rasio belanja kesehatan terhadap total penduduk', 0, 0.361737774173719, 0.153151906256241, 6, 4),
(53, 'Produktivitas Lahan Sawah (Ton/Ha)', 0, 65.55, 59.84, 7, 1),
(54, 'Ketersediaan air bersih perkapita (m3)', 0, 382.910449164954, 270.220202682263, 7, 2),
(55, 'Ketersedian listrik per kapita (Mwh)', 0, 7.01290884851516, 6.49818679417646, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ipi`
--

CREATE TABLE `ipi` (
  `id_nilai_ipi` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nilai_rescale` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipi`
--

INSERT INTO `ipi` (`id_nilai_ipi`, `tahun`, `nilai_rescale`) VALUES
(1, 2012, 4.19),
(2, 2013, 4.67),
(3, 2014, 4.77),
(4, 2015, 5.32),
(5, 2016, 5.37),
(6, 2017, 5.59),
(7, 2018, 5.72);

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

--
-- Dumping data for table `nilaidimensi`
--

INSERT INTO `nilaidimensi` (`id_nilai_d`, `tahun`, `nilai_rescale`, `kode_d`) VALUES
(1, 2012, 6, 1),
(2, 2013, 5.16, 1),
(3, 2014, 4.96, 1),
(4, 2015, 5.57, 1),
(5, 2016, 4.36, 1),
(6, 2017, 3.79, 1),
(7, 2018, 3.68, 1),
(8, 2012, 2.69, 2),
(9, 2013, 3.99, 2),
(10, 2014, 4.71, 2),
(11, 2015, 4.44, 2),
(12, 2016, 6.19, 2),
(13, 2017, 5.55, 2),
(14, 2018, 6.87, 2),
(15, 2012, 3.89, 3),
(16, 2013, 4.86, 3),
(17, 2014, 4.63, 3),
(18, 2015, 5.96, 3),
(19, 2016, 5.56, 3),
(20, 2017, 7.43, 3),
(21, 2018, 6.6, 3);

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

--
-- Dumping data for table `nilaiindikator`
--

INSERT INTO `nilaiindikator` (`id_nilai_i`, `tahun`, `nilai`, `nilai_rescale`, `kode_indikator`) VALUES
(1, 2012, 1.11446291560895, 10, 1),
(2, 2013, 1.16600941871793, 7.87, 1),
(3, 2014, 1.22874720560406, 5.28, 1),
(4, 2015, 1.2379945639046, 4.9, 1),
(5, 2016, 1.2568513727765, 4.12, 1),
(6, 2017, 1.30563472975284, 2.1, 1),
(7, 2018, 1.3566, 0, 1),
(8, 2012, 1.17013309245393, 10, 2),
(9, 2013, 1.26427980482948, 8.09, 2),
(10, 2014, 1.38272896554687, 5.68, 2),
(11, 2015, 1.48729065732995, 3.55, 2),
(12, 2016, 1.52918720085651, 2.7, 2),
(13, 2017, 1.58860420378594, 1.49, 2),
(14, 2018, 1.6621, 0, 2),
(15, 2012, 1.17709335136504, 3.18, 3),
(16, 2013, 1.31397561119732, 0.57, 3),
(17, 2014, 1.34363526354956, 0, 3),
(18, 2015, 0.970545684831712, 7.13, 3),
(19, 2016, 0.820265655823663, 10, 3),
(20, 2017, 0.939018022987739, 7.73, 3),
(21, 2018, 1.08811, 4.88, 3),
(22, 2012, 1.11450635480815, 10, 4),
(23, 2013, 1.14715609470269, 8.65, 4),
(24, 2014, 1.21334472861177, 5.92, 4),
(25, 2015, 1.25947423469939, 4.02, 4),
(26, 2016, 1.28160640137444, 3.11, 4),
(27, 2017, 1.31673947206437, 1.66, 4),
(28, 2018, 1.357, 0, 4),
(29, 2012, 1.06818412475863, 10, 5),
(30, 2013, 1.13361040240009, 7.98, 5),
(31, 2014, 1.22655511929288, 5.12, 5),
(32, 2015, 1.27917539005159, 3.5, 5),
(33, 2016, 1.34070634907808, 1.6, 5),
(34, 2017, 1.38226824234003, 0.32, 5),
(35, 2018, 1.3926, 0, 5),
(36, 2012, 1.08984482210607, 10, 6),
(37, 2013, 1.14167770425, 8.41, 6),
(38, 2014, 1.18822219037886, 6.98, 6),
(39, 2015, 1.2486454147873, 5.12, 6),
(40, 2016, 1.31538445353582, 3.07, 6),
(41, 2017, 1.36113754520087, 1.66, 6),
(42, 2018, 1.4151, 0, 6),
(43, 2012, 6.92, 9.23, 7),
(44, 2013, 6.05, 3.61, 7),
(45, 2014, 7.04, 10, 7),
(46, 2015, 6.61, 7.23, 7),
(47, 2016, 5.49, 0, 7),
(48, 2017, 5.83, 2.19, 7),
(49, 2018, 5.97, 3.1, 7),
(50, 2012, 55499, 0, 8),
(51, 2013, 58116, 1.41, 8),
(52, 2014, 61481.4, 3.21, 8),
(53, 2015, 64777.2, 4.99, 8),
(54, 2016, 67561.2, 6.48, 8),
(55, 2017, 70703.8, 8.17, 8),
(56, 2018, 74110, 10, 8),
(57, 2012, 5.57, 8.52, 9),
(58, 2013, 4.71540027748248, 2.8, 9),
(59, 2014, 5.79083212884576, 10, 9),
(60, 2015, 5.36064565868701, 7.12, 9),
(61, 2016, 4.29780848817176, 0, 9),
(62, 2017, 4.65148635607421, 2.37, 9),
(63, 2018, 4.81756284669282, 3.48, 9),
(64, 2012, 5.2, 8.78, 10),
(65, 2013, 5.42, 9.03, 10),
(66, 2014, 5.18, 8.76, 10),
(67, 2015, 6.07, 9.79, 10),
(68, 2016, 6.25, 10, 10),
(69, 2017, 4.46, 7.92, 10),
(70, 2018, -2.35, 0, 10),
(71, 2012, 6.63621730239055, 7.21, 11),
(72, 2013, 7.57636958843055, 10, 11),
(73, 2014, 6.98, 8.23, 11),
(74, 2015, 5.62, 4.19, 11),
(75, 2016, 4.21, 0, 11),
(76, 2017, 5.31, 3.27, 11),
(77, 2018, 6.45, 6.65, 11),
(78, 2012, 48.15, 2.62, 12),
(79, 2013, 48.06, 2, 12),
(80, 2014, 48.21, 3.03, 12),
(81, 2015, 49.22, 10, 12),
(82, 2016, 48.73, 6.62, 12),
(83, 2017, 47.95, 1.24, 12),
(84, 2018, 47.77, 0, 12),
(85, 2012, 6.32, 2.47, 13),
(86, 2013, 6.27, 2.4, 13),
(87, 2014, 4.59, 0, 13),
(88, 2015, 11.58, 10, 13),
(89, 2016, 5.52, 1.33, 13),
(90, 2017, 7.34, 3.93, 13),
(91, 2018, 6.65, 2.95, 13),
(92, 2012, 5.12, 3.53, 14),
(93, 2013, 6.15, 5.92, 14),
(94, 2014, 3.6, 0, 14),
(95, 2015, 3.7, 0.23, 14),
(96, 2016, 4.42, 1.9, 14),
(97, 2017, 6.69, 7.17, 14),
(98, 2018, 7.91, 10, 14),
(99, 2012, 72.12, 0, 15),
(100, 2013, 72.47, 1.11, 15),
(101, 2014, 72.84, 2.28, 15),
(102, 2015, 73.57, 4.59, 15),
(103, 2016, 74.46, 7.41, 15),
(104, 2017, 74.84, 8.61, 15),
(105, 2018, 75.28, 10, 15),
(106, 2012, 88.6, 9.22, 16),
(107, 2013, 88.88, 9.42, 16),
(108, 2014, 89.01, 9.51, 16),
(109, 2015, 89.31, 9.72, 16),
(110, 2016, 89.6705783849289, 9.97, 16),
(111, 2017, 75.28, 0, 16),
(112, 2018, 89.72, 10, 16),
(113, 2012, 8.41, 0, 17),
(114, 2013, 8.41, 0, 17),
(115, 2014, 8.42, 0.18, 17),
(116, 2015, 8.93, 9.45, 17),
(117, 2016, 8.94, 9.64, 17),
(118, 2017, 8.95, 9.82, 17),
(119, 2018, 8.96, 10, 17),
(120, 2012, 12.63, 0, 18),
(121, 2013, 12.85, 2.04, 18),
(122, 2014, 13.17, 5, 18),
(123, 2015, 13.19, 5.19, 18),
(124, 2016, 13.69, 9.81, 18),
(125, 2017, 13.7, 9.91, 18),
(126, 2018, 13.71, 10, 18),
(127, 2012, 91.47, 3.53, 19),
(128, 2013, 92.34, 4.28, 19),
(129, 2014, 95.04, 6.61, 19),
(130, 2015, 94.7, 6.31, 19),
(131, 2016, 98.72, 9.78, 19),
(132, 2017, 87.37, 0, 19),
(133, 2018, 98.98, 10, 19),
(134, 2012, 80.08, 0.22, 20),
(135, 2013, 79.91, 0, 20),
(136, 2014, 87.36, 9.56, 20),
(137, 2015, 87.7, 10, 20),
(138, 2016, 81.11, 1.54, 20),
(139, 2017, 82.19, 2.93, 20),
(140, 2018, 85.17, 6.75, 20),
(141, 2012, 64.3, 3.63, 21),
(142, 2013, 61.3, 1.97, 21),
(143, 2014, 57.72, 0, 21),
(144, 2015, 69.61, 6.55, 21),
(145, 2016, 71.01, 7.33, 21),
(146, 2017, 73.76, 8.84, 21),
(147, 2018, 75.86, 10, 21),
(148, 2012, 15.0755598831548, 8.97, 22),
(149, 2013, 15.2247544204322, 8.33, 22),
(150, 2014, 15.5547518585493, 6.92, 22),
(151, 2015, 14.8366164542294, 10, 22),
(152, 2016, 14.9495798319328, 9.51, 22),
(153, 2017, 16.5343560933449, 2.71, 22),
(154, 2018, 17.1648721399731, 0, 22),
(155, 2012, 11.5934684684685, 10, 23),
(156, 2013, 12.0143830431491, 9.24, 23),
(157, 2014, 12.7511627906977, 7.92, 23),
(158, 2015, 15.6837447601304, 2.66, 23),
(159, 2016, 15.8532836516069, 2.35, 23),
(160, 2017, 16.8966900702106, 0.48, 23),
(161, 2018, 17.162610046608, 0, 23),
(162, 2012, 10.2762364294331, 7.77, 24),
(163, 2013, 8.35547355473555, 10, 24),
(164, 2014, 10.4915356711004, 7.52, 24),
(165, 2015, 15.0601503759399, 2.23, 24),
(166, 2016, 15.2698282910875, 1.99, 24),
(167, 2017, 16.3868243243243, 0.69, 24),
(168, 2018, 16.9835924006908, 0, 24),
(169, 2012, 11.334092634776, 9.9, 25),
(170, 2013, 11.6910029498525, 9.37, 25),
(171, 2014, 11.2684246112238, 10, 25),
(172, 2015, 16.6158139534884, 2.02, 25),
(173, 2016, 17.3864253393665, 0.86, 25),
(174, 2017, 17.9656387665198, 0, 25),
(175, 2018, 17.0212765957447, 1.41, 25),
(176, 2012, 174.353603603604, 0, 26),
(177, 2013, 174.143820224719, 0.45, 26),
(178, 2014, 173.968539325843, 0.82, 26),
(179, 2015, 172.251121076233, 4.49, 26),
(180, 2016, 171.517937219731, 6.05, 26),
(181, 2017, 170.046666666667, 9.2, 26),
(182, 2018, 169.669623059867, 10, 26),
(183, 2012, 308.85, 6.21, 27),
(184, 2013, 314.277227722772, 4.21, 27),
(185, 2014, 325.722772277228, 0, 27),
(186, 2015, 320.695238095238, 1.85, 27),
(187, 2016, 321.103773584906, 1.7, 27),
(188, 2017, 311.962962962963, 5.07, 27),
(189, 2018, 298.567567567568, 10, 27),
(190, 2012, 10.2762364294331, 9.95, 28),
(191, 2013, 8.35547355473555, 10, 28),
(192, 2014, 10.4915356711004, 9.94, 28),
(193, 2015, 346.673076923077, 0.85, 28),
(194, 2016, 359.134615384615, 0.52, 28),
(195, 2017, 366.075471698113, 0.33, 28),
(196, 2018, 378.211538461538, 0, 28),
(197, 2012, 373.175, 1.06, 29),
(198, 2013, 377.452380952381, 0, 29),
(199, 2014, 370.355555555556, 1.76, 29),
(200, 2015, 337.018867924528, 10, 29),
(201, 2016, 362.490566037736, 3.7, 29),
(202, 2017, 357.736842105263, 4.88, 29),
(203, 2018, 352.542372881356, 6.16, 29),
(204, 2012, 72.18, 0, 30),
(205, 2013, 72.19, 0.36, 30),
(206, 2014, 72.2, 0.71, 30),
(207, 2015, 72.3, 4.29, 30),
(208, 2016, 72.33, 5.36, 30),
(209, 2017, 72.36, 6.43, 30),
(210, 2018, 72.46, 10, 30),
(211, 2012, 0.974983541803818, 1.3, 31),
(212, 2013, 0.972570612827572, 0, 31),
(213, 2014, 0.974424683511865, 1, 31),
(214, 2015, 0.978410883280757, 3.16, 31),
(215, 2016, 0.991074527693757, 10, 31),
(216, 2017, 0.973538585370762, 0.52, 31),
(217, 2018, 0.9878830063794, 8.28, 31),
(218, 2012, 7.42766690380181, 0.11, 32),
(219, 2013, 7.33435960039149, 0, 32),
(220, 2014, 8.05403938264177, 0.82, 32),
(221, 2015, 11.9396997404309, 5.22, 32),
(222, 2016, 12.5914651901075, 5.96, 32),
(223, 2017, 14.0075858859565, 7.56, 32),
(224, 2018, 16.1567170781885, 10, 32),
(225, 2012, 89.9572991682664, 10, 33),
(226, 2013, 88.8272440491859, 8.66, 33),
(227, 2014, 86.9836253325311, 6.46, 33),
(228, 2015, 85.9658381311027, 5.25, 33),
(229, 2016, 82.6314903100806, 1.28, 33),
(230, 2017, 81.7109176680794, 0.19, 33),
(231, 2018, 81.5529528708563, 0, 33),
(232, 2012, 20.95, 0, 34),
(233, 2013, 20.59, 1.33, 34),
(234, 2014, 20.34, 2.25, 34),
(235, 2015, 20.1, 3.14, 34),
(236, 2016, 19.88, 3.95, 34),
(237, 2017, 18.24, 10, 34),
(238, 2018, 20.2009099640565, 2.76, 34),
(239, 2012, 13.1, 0.52, 35),
(240, 2013, 11.95, 3.87, 35),
(241, 2014, 12.18, 3.2, 35),
(242, 2015, 13.2136621803149, 0.19, 35),
(243, 2016, 9.84299052074796, 10, 35),
(244, 2017, 11.3, 5.76, 35),
(245, 2018, 13.28, 0, 35),
(246, 2012, 0.363042900553444, 1.89, 36),
(247, 2013, 0.388702315457326, 1.15, 36),
(248, 2014, 0.080999474071228, 10, 36),
(249, 2015, 0.093456805748249, 9.64, 36),
(250, 2016, 0.211596424653459, 6.25, 36),
(251, 2017, 0.364871153555826, 1.84, 36),
(252, 2018, 0.428804329134634, 0, 36),
(253, 2012, 14.35, 0, 37),
(254, 2013, 13.94, 1.67, 37),
(255, 2014, 13.41, 3.82, 37),
(256, 2015, 13.63, 2.93, 37),
(257, 2016, 13.19, 4.72, 37),
(258, 2017, 12.8041426408507, 6.28, 37),
(259, 2018, 11.89, 10, 37),
(260, 2012, 2.48, 1.27, 38),
(261, 2013, 2.46, 1.52, 38),
(262, 2014, 2.36, 2.78, 38),
(263, 2015, 2.58, 0, 38),
(264, 2016, 2.19, 4.94, 38),
(265, 2017, 2.50553176544199, 0.94, 38),
(266, 2018, 1.79, 10, 38),
(267, 2012, 0.59, 4.81, 39),
(268, 2013, 0.72, 0, 39),
(269, 2014, 0.66, 2.22, 39),
(270, 2015, 0.67, 1.85, 39),
(271, 2016, 0.56, 5.93, 39),
(272, 2017, 0.707682641066046, 0.46, 39),
(273, 2018, 0.45, 10, 39),
(274, 2012, 35.2232934563708, 10, 40),
(275, 2013, 30.9794865379349, 5.61, 40),
(276, 2014, 29.3846512099175, 3.97, 40),
(277, 2015, 31.9196463385258, 6.59, 40),
(278, 2016, 29.9451898481029, 4.55, 40),
(279, 2017, 27.97073335768, 2.51, 40),
(280, 2018, 25.5463717386828, 0, 40),
(281, 2012, 6.78, 0, 41),
(282, 2013, 4.55, 9.96, 41),
(283, 2014, 5.06, 7.68, 41),
(284, 2015, 5.67, 4.96, 41),
(285, 2016, 4.81, 8.79, 41),
(286, 2017, 4.54, 10, 41),
(287, 2018, 5.82, 4.29, 41),
(288, 2012, 0.43, 0, 42),
(289, 2013, 0.36, 4.59, 42),
(290, 2014, 0.28, 9.84, 42),
(291, 2015, 0.31, 7.87, 42),
(292, 2016, 0.33, 6.56, 42),
(293, 2017, 0.29, 9.18, 42),
(294, 2018, 0.277550505050505, 10, 42),
(295, 2012, 84.6, 5.52, 43),
(296, 2013, 84.8, 6.01, 43),
(297, 2014, 85.3, 7.24, 43),
(298, 2015, 84.2, 4.53, 43),
(299, 2016, 86.42, 10, 43),
(300, 2017, 82.36, 0, 43),
(301, 2018, 82.5170645744019, 0.39, 43),
(302, 2012, 93.83, 0, 44),
(303, 2013, 94.23, 0.98, 44),
(304, 2014, 96.29, 6.03, 44),
(305, 2015, 96.83, 7.35, 44),
(306, 2016, 95.83, 4.9, 44),
(307, 2017, 97.91, 10, 44),
(308, 2018, 96.45, 6.42, 44),
(309, 2012, 85.02, 0, 45),
(310, 2013, 88.15, 4.66, 45),
(311, 2014, 88.055, 4.52, 45),
(312, 2015, 89.28, 6.35, 45),
(313, 2016, 90.95, 8.84, 45),
(314, 2017, 91.73, 10, 45),
(315, 2018, 89.49, 6.66, 45),
(316, 2012, 93.23, 7.72, 46),
(317, 2013, 94.3, 10, 46),
(318, 2014, 89.615, 0, 46),
(319, 2015, 90.05, 0.93, 46),
(320, 2016, 92.53, 6.22, 46),
(321, 2017, 90.92, 2.79, 46),
(322, 2018, 91.77, 4.6, 46),
(323, 2012, 72.27, 1.79, 47),
(324, 2013, 68.7, 0, 47),
(325, 2014, 73.14, 2.22, 47),
(326, 2015, 77.02, 4.17, 47),
(327, 2016, 77.55, 4.43, 47),
(328, 2017, 84.78, 8.05, 47),
(329, 2018, 88.67, 10, 47),
(330, 2012, 86.35, 0, 48),
(331, 2013, 87.89, 3.31, 48),
(332, 2014, 89.795, 7.41, 48),
(333, 2015, 90.1, 8.06, 48),
(334, 2016, 88.74, 5.14, 48),
(335, 2017, 90.71, 9.38, 48),
(336, 2018, 91, 10, 48),
(337, 2012, 46.9, 0, 49),
(338, 2013, 56.54, 4.18, 49),
(339, 2014, 58.99, 5.24, 49),
(340, 2015, 66.67, 8.57, 49),
(341, 2016, 62.35, 6.7, 49),
(342, 2017, 69.96, 10, 49),
(343, 2018, 69.96, 10, 49),
(344, 2012, 25.9, 0, 50),
(345, 2013, 27.17, 1.81, 50),
(346, 2014, 31.67, 8.22, 50),
(347, 2015, 32.92, 10, 50),
(348, 2016, 28.46, 3.65, 50),
(349, 2017, 31.75, 8.33, 50),
(350, 2018, 31.75, 8.33, 50),
(351, 2012, 1.68814133317088, 0, 51),
(352, 2013, 1.84404403211161, 2.73, 51),
(353, 2014, 1.97201652641522, 4.97, 51),
(354, 2015, 2.25946514387607, 10, 51),
(355, 2016, 2.15104144644959, 8.1, 51),
(356, 2017, 1.91054393115342, 3.89, 51),
(357, 2018, 1.79556822217108, 1.88, 51),
(358, 2012, 0.153151906256241, 0, 52),
(359, 2013, 0.225846762330892, 3.49, 52),
(360, 2014, 0.254688801880296, 4.87, 52),
(361, 2015, 0.308881223488892, 7.47, 52),
(362, 2016, 0.342165652100012, 9.06, 52),
(363, 2017, 0.350097426534103, 9.44, 52),
(364, 2018, 0.361737774173719, 10, 52),
(365, 2012, 65.27, 9.51, 53),
(366, 2013, 59.84, 0, 53),
(367, 2014, 60.79, 1.66, 53),
(368, 2015, 64.81, 8.7, 53),
(369, 2016, 63.66, 6.69, 53),
(370, 2017, 65.55, 10, 53),
(371, 2018, 59.97, 0.23, 53),
(372, 2012, 318.072060373669, 4.25, 54),
(373, 2013, 382.910449164954, 10, 54),
(374, 2014, 270.220202682263, 0, 54),
(375, 2015, 270.220202682263, 0, 54),
(376, 2016, 285.242216155761, 1.33, 54),
(377, 2017, 282.802109315384, 1.12, 54),
(378, 2018, 350.071359711627, 7.09, 54),
(379, 2012, 6.9890949366549, 9.54, 55),
(380, 2013, 7.01290884851516, 10, 55),
(381, 2014, 6.94129590599082, 8.61, 55),
(382, 2015, 6.49818679417646, 0, 55),
(383, 2016, 6.73784764017791, 4.66, 55),
(384, 2017, 6.99718382215642, 9.69, 55),
(385, 2018, 6.99267507891896, 9.61, 55);

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

--
-- Dumping data for table `nilaisubdimensi`
--

INSERT INTO `nilaisubdimensi` (`id_nilai_sd`, `tahun`, `nilai_rescale`, `kode_sd`) VALUES
(1, 2012, 8.8633333333333, 1),
(2, 2013, 6.9283333333333, 1),
(3, 2014, 4.83, 1),
(4, 2015, 4.7033333333333, 1),
(5, 2016, 4.1, 1),
(6, 2017, 2.4933333333333, 1),
(7, 2018, 0.81333333333333, 1),
(8, 2012, 5.295, 2),
(9, 2013, 4.64625, 2),
(10, 2014, 5.40375, 2),
(11, 2015, 6.69375, 2),
(12, 2016, 3.29125, 2),
(13, 2017, 4.5325, 2),
(14, 2018, 4.5225, 2),
(15, 2012, 3.8309090909091, 3),
(16, 2013, 3.8995454545455, 3),
(17, 2014, 4.6572727272727, 3),
(18, 2015, 5.3090909090909, 3),
(19, 2016, 5.68, 3),
(20, 2017, 4.3531818181818, 3),
(21, 2018, 5.6981818181818, 3),
(22, 2012, 3.216, 4),
(23, 2013, 3.752, 4),
(24, 2014, 4.094, 4),
(25, 2015, 3.266, 4),
(26, 2016, 5.786, 4),
(27, 2017, 4.038, 4),
(28, 2018, 6.858, 4),
(29, 2012, 2.1471428571429, 5),
(30, 2013, 4.2214285714286, 5),
(31, 2014, 5.3228571428571, 5),
(32, 2015, 5.6085714285714, 5),
(33, 2016, 6.5842857142857, 5),
(34, 2017, 7.0571428571429, 5),
(35, 2018, 6.8671428571429, 5),
(36, 2012, 0, 6),
(37, 2013, 3.0525, 6),
(38, 2014, 5.825, 6),
(39, 2015, 9.01, 6),
(40, 2016, 6.8775, 6),
(41, 2017, 7.915, 6),
(42, 2018, 7.5525, 6),
(43, 2012, 7.7666666666667, 7),
(44, 2013, 6.6666666666667, 7),
(45, 2014, 3.4233333333333, 7),
(46, 2015, 2.9, 7),
(47, 2016, 4.2266666666667, 7),
(48, 2017, 6.9366666666667, 7),
(49, 2018, 5.6433333333333, 7);

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

CREATE TABLE `status_user` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`id`, `menu`) VALUES
(0, 'Administrator'),
(1, 'Operator Pertumbuhan Ekonomi'),
(2, 'Operator Inklusifitas'),
(3, 'Operator Keberlanjutan');

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
(1, 'Indeks Inflasi', 1, 'admin/pertumbuhanEkonomi/ii'),
(2, 'Indeks Aktivitas Ekonomi', 1, 'admin/pertumbuhanEkonomi/iae'),
(3, 'Indeks Pembangunan Sumberdaya Manusia', 1, 'admin/pertumbuhanEkonomi/ipsdm'),
(4, 'Indeks Penanggulangan Kemiskinan', 2, 'admin/inklusifitas/ipk'),
(5, 'Indeks Pemerataan', 2, 'admin/inklusifitas/ip'),
(6, 'Indeks Keberlanjutan Keuangan', 3, 'admin/sustainability/ikk'),
(7, 'Indeks Keberlanjutan Infrastruktur', 3, 'admin/sustainability/iki');

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `tahun`) VALUES
(2012, 2012),
(2013, 2013),
(2014, 2014),
(2015, 2015),
(2016, 2016),
(2017, 2017),
(2018, 2018),
(2019, 2019),
(2020, 2020),
(2021, 2021),
(2022, 2022),
(2023, 2023),
(2024, 2024),
(2025, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status_user`) VALUES
(1, 'admin', '$2y$10$1l48vsGb4oVBk9AyQJovje/ImK8r4LlbKt4vhKBESlEFT2U4U6XMO', 0),
(4, 'Operator C', '$2y$10$I5PumD0zV5jA6R3OvwymZOp8jPA0CkBQH01mBxK0kkpLuu5Ey/D1W', 3),
(9, 'Operator A', '$2y$10$CLwmUagCYLLrvc7zV3S0T.pjzx02LJttncQHTiJFh6R3aiAjXs8mm', 1),
(10, 'admin2', '$2y$10$UYOabRPQooQsVb0ugqgVFO.XQt19J9OgbK9Q.RzdYMcyXYrNdhNuW', 2),
(11, 'OPD1', '$2y$10$e.O9XjeLVF2hgvy1DVQ0GOgzOZ7iEnrTGTM.ol9w9Z3V56iWvxPUq', 1),
(12, 'OPD2', '$2y$10$JZy9gU5GtTS4SzFGvd65heQ6OjNvEWAHIk5eg0Ol8f4NKlMJoz3Lu', 2),
(13, 'OPD3', '$2y$10$zXblJ8LuZ3Df1K6S9iWQTelOkM.bl/MzTfoOHMKe1DYQEJlOTtPGC', 3),
(14, 'admin123', '$2y$10$wLRwALUvfvG6hiDjLHsG1OjWvrBAJFXegC9Hz1fydNY.fG7yZwzYC', 0);

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
-- Indexes for table `ipi`
--
ALTER TABLE `ipi`
  ADD PRIMARY KEY (`id_nilai_ipi`);

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
  ADD KEY `nilaisubdimensi_ibfk_1` (`kode_sd`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_ibfk_1` (`status_user`);

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
  MODIFY `kode_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `ipi`
--
ALTER TABLE `ipi`
  MODIFY `id_nilai_ipi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  MODIFY `id_nilai_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  MODIFY `id_nilai_i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  MODIFY `id_nilai_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subdimensi`
--
ALTER TABLE `subdimensi`
  MODIFY `kode_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2026;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `nilaisubdimensi_ibfk_1` FOREIGN KEY (`kode_sd`) REFERENCES `subdimensi` (`kode_sd`);

--
-- Constraints for table `subdimensi`
--
ALTER TABLE `subdimensi`
  ADD CONSTRAINT `subdimensi_ibfk_1` FOREIGN KEY (`kode_d`) REFERENCES `dimensi` (`kode_d`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`status_user`) REFERENCES `status_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
