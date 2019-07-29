-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2019 at 06:44 AM
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
  `max_nilai` double NOT NULL DEFAULT '0',
  `min_nilai` double NOT NULL DEFAULT '0',
  `kode_sd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kode_indikator`, `nama_indikator`, `status`, `max_nilai`, `min_nilai`, `kode_sd`) VALUES
(1, 'Deflator PDRB', 1, 1.30563473, 1.114462916, 1),
(2, 'Deflator Sektor Pertanian', 1, 1.588604204, 1.170133092, 1),
(3, 'Deflator Sektor Pertambangan', 1, 1.343635264, 0.820265656, 1),
(4, 'Deflator Sektor Industri', 1, 1.316739472, 1.114506355, 1),
(5, 'Deflator Sektor Konstruksi', 1, 1.382268242, 1.068184125, 1),
(6, 'Deflator Sektor Perdagangan', 1, 1.361137545, 1.089844822, 1),
(7, 'Pertumbuhan PDRB harga konstan', 0, 7.04, 5.49, 2),
(8, 'PDRB perkapita harga konstan', 0, 70703.8, 55499, 2),
(9, 'Pertumbuhan PDRB riil per kapita', 0, 11.48843483, 5.755846473, 2),
(10, 'Pertumbuhan Sektor Pertanian', 0, 6.25, 4.46, 2),
(11, 'Pertumbuhan Sektor Industri', 0, 7.576369588, 4.21, 2),
(12, 'Kontribusi Sektor Industri', 0, 49.39004464, 47.54319065, 2),
(13, 'Pertumbuhan Pembentukan Modal Tetap Bruto', 0, 11.58, 4.59, 2),
(14, 'Pertumbuhan Ekspor', 0, 6.69, 3.6, 2),
(15, 'Persentase tenaga kerja sektor industri', 0, 35.22329346, 27.97073336, 3),
(16, 'Rata-rata Lama Sekolah', 0, 8.95, 8.41, 3),
(17, 'Angka Harapan Lama Sekolah', 0, 13.7, 12.63, 3),
(18, 'Angka Partisipasi Murni (APM) setingkat sekolah dasar', 0, 98.73, 91.47, 3),
(19, 'Angka Partisipasi Murni (APM) setingkat sekolah menengah pertama', 0, 90.61, 79.91, 3),
(20, 'Angka Partisipasi Murni (APM) setingkat sekolah menengah atas', 0, 79.27, 61.3, 3),
(21, 'Angka Harapan Hidup', 0, 72.36, 72.18, 3),
(22, 'Rasio Murid terhadap Guru SD', 1, 15.58678021, 15.07555988, 3),
(23, 'Rasio Murid terhadap Guru SMP', 1, 12.75116279, 11.59346847, 3),
(24, 'Rasio Murid terhadap Guru SMA', 1, 11.49681529, 8.355473555, 3),
(25, 'Rasio Murid terhadap Guru SMK', 1, 12.55679812, 11.26842461, 3),
(26, 'Rasio Murid terhadap Jumah SD', 1, 174.3536036, 170.8764045, 3),
(27, 'Rasio Murid terhadap Jumah SMP', 1, 326.0873786, 308.85, 3),
(28, 'Rasio Murid terhadap Jumah SMA', 1, 11.49681529, 8.355473555, 3),
(29, 'Rasio Murid terhadap Jumah SMK', 1, 402.5283019, 352.8653846, 3),
(30, 'Angka Kematian Bayi', 1, 20.95, 18.24, 3),
(31, 'Angka Morbiditas', 1, 13.21, 9.35, 3),
(32, 'Rasio Kasus Penyakit Utamas Masyarakat Gresik terhadap Penduduk', 1, 0.388702315, 0.080999474, 3),
(33, 'Persentase Bayi dengan Gizi Cukup (Berat Badan > 2.5 kg)', 0, 0.991074528, 0.972570613, 3),
(34, 'Rasio Rumah Sakit per Penduduk', 0, 0.74276669, 0.700379294, 3),
(35, 'Rasio Puskesmas Umum dan Pembantu per Penduduk', 0, 8.995729917, 8.171091767, 3),
(36, 'Persentase Penduduk Miskin', 1, 14.35, 12.8, 4),
(37, 'Indeks Keparahan Kemiskinan', 1, 2.58, 2.19, 4),
(38, 'Indeks Kedalaman Kemiskinan', 1, 0.72, 0.56, 4),
(39, 'Tingkat Pengangguran Terbuka', 1, 6.78, 4.54, 4),
(40, 'Indeks Pemberdayaan Gender', 0, 66.21, 62.26, 5),
(41, 'Persentase Rumah Tangga dengan Luas Lantai Hunian ? 50 m2', 2, 86.42, 82.36, 5),
(42, 'Persentase Rumah Tangga dengan Lantai Bukan Tanah', 2, 97.91, 93.83, 5),
(43, 'Persentase Rumah Tangga dengan Dinding Tembok', 2, 91.73, 85.02, 5),
(44, 'Persentase Rumah Tangga dengan Atap Beton/Tembok', 2, 94.66, 90.05, 5),
(45, 'Persentase Rumah Tangga dengan Sumber Air Minum Kemasan/Isi Ulang', 2, 84.78, 68.7, 5),
(46, 'Persentase Rumah Tangga dengan Fasilitas BAB Sendiri', 2, 91.8, 86.35, 5),
(47, 'Ruang Fiskal Daerah', 0, 0.683071642, 0.558244311, 6),
(48, 'Derajat Desentralisasi Fiskal', 0, 0.310386692, 0.240590091, 6),
(49, 'Rasio belanja pendidikan terhadap penduduk usia sekolah', 0, 2.259465144, 1.688141333, 6),
(50, 'Rasio belanja kesehatan terhadap total penduduk', 0, 0.350097427, 0.153151906, 6),
(51, 'Produktivitas Lahan Sawah', 0, 65.5, 61.55, 7),
(52, 'Ketersediaan air bersih perkapita', 0, 0.070404524, 0.050192935, 7),
(53, 'Ketersedian listrik per kapita', 0, 0.000739032, 0.000612356, 7);

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
(1, 2012, 4.602932816),
(2, 2013, 4.421491323),
(3, 2014, 5.010218013),
(4, 2015, 5.235269278),
(5, 2016, 5.499953218),
(6, 2017, 5.045918603);

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
(1, 2012, 6.23, 1),
(2, 2013, 5.4, 1),
(3, 2014, 4.36, 1),
(4, 2015, 4.72, 1),
(5, 2016, 3.68, 1),
(6, 2017, 3.39, 1),
(7, 2012, 2.59, 2),
(8, 2013, 4.37, 2),
(9, 2014, 5.37, 2),
(10, 2015, 3.86, 2),
(11, 2016, 7.74, 2),
(12, 2017, 5.85, 2),
(13, 2012, 4.98, 3),
(14, 2013, 3.5, 3),
(15, 2014, 5.3, 3),
(16, 2015, 7.13, 3),
(17, 2016, 5.08, 3),
(18, 2017, 5.9, 3);

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
(1, 2012, 1.114462916, 10, 1),
(2, 2013, 1.166009419, 7.303655702, 1),
(3, 2014, 1.228747206, 4.021906916, 1),
(4, 2015, 1.237994564, 3.538187162, 1),
(5, 2016, 1.256851373, 2.55180698, 1),
(6, 2017, 1.30563473, 0, 1),
(7, 2012, 1.170133092, 10, 2),
(8, 2013, 1.264279805, 7.750221943, 2),
(9, 2014, 1.382728966, 4.919700134, 2),
(10, 2015, 1.487290657, 2.421040395, 2),
(11, 2016, 1.529187201, 1.419859133, 2),
(12, 2017, 1.588604204, 0, 2),
(13, 2012, 1.177093351, 3.182108967, 3),
(14, 2013, 1.313975611, 0.566705669, 3),
(15, 2014, 1.343635264, 0, 3),
(16, 2015, 0.970545685, 7.128606117, 3),
(17, 2016, 0.820265656, 10, 3),
(18, 2017, 0.939018023, 7.731003761, 3),
(19, 2012, 1.114506355, 10, 4),
(20, 2013, 1.147156095, 8.385539404, 4),
(21, 2014, 1.213344729, 5.112651422, 4),
(22, 2015, 1.259474235, 2.831644893, 4),
(23, 2016, 1.281606401, 1.737256052, 4),
(24, 2017, 1.316739472, 0, 4),
(25, 2012, 1.068184125, 10, 5),
(26, 2013, 1.133610402, 7.916918622, 5),
(27, 2014, 1.226555119, 4.95768854, 5),
(28, 2015, 1.27917539, 3.282332551, 5),
(29, 2016, 1.340706349, 1.323272682, 5),
(30, 2017, 1.382268242, 0, 5),
(31, 2012, 1.089844822, 10, 6),
(32, 2013, 1.141677704, 8.089411262, 6),
(33, 2014, 1.18822219, 6.37375573, 6),
(34, 2015, 1.248645415, 4.146522219, 6),
(35, 2016, 1.315384454, 1.686484294, 6),
(36, 2017, 1.361137545, 0, 6),
(37, 2012, 6.92, 9.225806452, 7),
(38, 2013, 6.05, 3.612903226, 7),
(39, 2014, 7.04, 10, 7),
(40, 2015, 6.61, 7.225806452, 7),
(41, 2016, 5.49, 0, 7),
(42, 2017, 5.83, 2.193548387, 7),
(43, 2012, 55499, 0, 8),
(44, 2013, 58116, 1.721167, 8),
(45, 2014, 61481.4, 3.934546985, 8),
(46, 2015, 64777.2, 6.102151952, 8),
(47, 2016, 67561.2, 7.933152689, 8),
(48, 2017, 70703.8, 10, 8),
(49, 2012, 9.971268353, 7.353435514, 9),
(50, 2013, 9.556382967, 6.629704173, 9),
(51, 2014, 11.48843483, 10, 9),
(52, 2015, 6.255691685, 0.871936343, 9),
(53, 2016, 5.755846473, 0, 9),
(54, 2017, 8.739224976, 5.204243386, 9),
(55, 2012, 5.2, 4.134078212, 10),
(56, 2013, 5.42, 5.363128492, 10),
(57, 2014, 5.18, 4.022346369, 10),
(58, 2015, 6.07, 8.994413408, 10),
(59, 2016, 6.25, 10, 10),
(60, 2017, 4.46, 0, 10),
(61, 2012, 6.636217302, 7.20722202, 11),
(62, 2013, 7.576369588, 10, 11),
(63, 2014, 6.98, 8.228448859, 11),
(64, 2015, 5.62, 4.188488409, 11),
(65, 2016, 4.21, 0, 11),
(66, 2017, 5.31, 3.26761507, 11),
(67, 2012, 49.39004464, 10, 12),
(68, 2013, 48.85255492, 7.089701082, 12),
(69, 2014, 48.81528174, 6.887881221, 12),
(70, 2015, 48.37712433, 4.515428302, 12),
(71, 2016, 47.77938205, 1.278885088, 12),
(72, 2017, 47.54319065, 0, 12),
(73, 2012, 6.32, 2.474964235, 13),
(74, 2013, 6.27, 2.403433476, 13),
(75, 2014, 4.59, 0, 13),
(76, 2015, 11.58, 10, 13),
(77, 2016, 5.52, 1.330472103, 13),
(78, 2017, 7.34, 3.934191702, 13),
(79, 2012, 5.12, 4.919093851, 14),
(80, 2013, 6.15, 8.252427184, 14),
(81, 2014, 3.6, 0, 14),
(82, 2015, 3.7, 0.323624595, 14),
(83, 2016, 4.42, 2.653721683, 14),
(84, 2017, 6.69, 10, 14),
(85, 2012, 35.22329346, 10, 15),
(86, 2013, 30.97948654, 4.148539466, 15),
(87, 2014, 29.38465121, 1.949543103, 15),
(88, 2015, 31.91964634, 5.444853855, 15),
(89, 2016, 29.94518985, 2.722426927, 15),
(90, 2017, 27.97073336, 0, 15),
(91, 2012, 8.41, 0, 16),
(92, 2013, 8.41, 0, 16),
(93, 2014, 8.42, 0.185185185, 16),
(94, 2015, 8.93, 9.62962963, 16),
(95, 2016, 8.94, 9.814814815, 16),
(96, 2017, 8.95, 10, 16),
(97, 2012, 12.63, 0, 17),
(98, 2013, 12.85, 2.056074766, 17),
(99, 2014, 13.17, 5.046728972, 17),
(100, 2015, 13.19, 5.23364486, 17),
(101, 2016, 13.69, 9.906542056, 17),
(102, 2017, 13.7, 10, 17),
(103, 2012, 91.47, 0, 18),
(104, 2013, 92.34, 1.198347107, 18),
(105, 2014, 93.55, 2.865013774, 18),
(106, 2015, 95.78, 5.936639118, 18),
(107, 2016, 96.59, 7.052341598, 18),
(108, 2017, 98.73, 10, 18),
(109, 2012, 80.08, 0.158878505, 19),
(110, 2013, 79.91, 0, 19),
(111, 2014, 84.31, 4.112149533, 19),
(112, 2015, 90.61, 10, 19),
(113, 2016, 85.57, 5.289719626, 19),
(114, 2017, 81.99, 1.943925234, 19),
(115, 2012, 64.3, 1.669449082, 20),
(116, 2013, 61.3, 0, 20),
(117, 2014, 69.73, 4.69115192, 20),
(118, 2015, 77.16, 8.825820812, 20),
(119, 2016, 76.93, 8.697829716, 20),
(120, 2017, 79.27, 10, 20),
(121, 2012, 72.18, 0, 21),
(122, 2013, 72.19, 0.555555556, 21),
(123, 2014, 72.2, 1.111111111, 21),
(124, 2015, 72.3, 6.666666667, 21),
(125, 2016, 72.33, 8.333333333, 21),
(126, 2017, 72.36, 10, 21),
(127, 2012, 15.07555988, 10, 22),
(128, 2013, 15.22475442, 7.081600062, 22),
(129, 2014, 15.55475186, 0.626507801, 22),
(130, 2015, 15.58678021, 0, 22),
(131, 2016, 15.28442211, 5.914438138, 22),
(132, 2017, 15.28442211, 5.914438138, 22),
(133, 2012, 11.59346847, 10, 23),
(134, 2013, 12.01438304, 6.364199369, 23),
(135, 2014, 12.75116279, 0, 23),
(136, 2015, 12.68870419, 0.539508539, 23),
(137, 2016, 12.40484805, 2.991417836, 23),
(138, 2017, 12.40484805, 2.991417836, 23),
(139, 2012, 10.27623643, 3.885533512, 24),
(140, 2013, 8.355473555, 10, 24),
(141, 2014, 10.49153567, 3.20016, 24),
(142, 2015, 10.77686989, 2.291840414, 24),
(143, 2016, 11.49681529, 0, 24),
(144, 2017, 11.49681529, 0, 24),
(145, 2012, 11.33409263, 9.490302903, 25),
(146, 2013, 11.69100295, 6.720063422, 25),
(147, 2014, 11.26842461, 10, 25),
(148, 2015, 11.47529706, 8.394313073, 25),
(149, 2016, 12.55679812, 0, 25),
(150, 2017, 12.55679812, 0, 25),
(151, 2012, 174.3536036, 0, 26),
(152, 2013, 174.1438202, 0.603311379, 26),
(153, 2014, 173.9685393, 1.107397839, 26),
(154, 2015, 172.7505618, 4.610152469, 26),
(155, 2016, 170.8764045, 10, 26),
(156, 2017, 170.8764045, 10, 26),
(157, 2012, 308.85, 10, 27),
(158, 2013, 314.2772277, 6.851477341, 27),
(159, 2014, 325.7227723, 0.211520772, 27),
(160, 2015, 326.0873786, 0, 27),
(161, 2016, 320.4392523, 3.276673572, 27),
(162, 2017, 320.4392523, 3.276673572, 27),
(163, 2012, 10.27623643, 3.885533512, 28),
(164, 2013, 8.355473555, 10, 28),
(165, 2014, 10.49153567, 3.20016, 28),
(166, 2015, 10.77686989, 2.291840414, 28),
(167, 2016, 11.49681529, 0, 28),
(168, 2017, 11.49681529, 0, 28),
(169, 2012, 373.175, 5.910506974, 29),
(170, 2013, 377.452381, 5.049224313, 29),
(171, 2014, 370.3555556, 6.478223209, 29),
(172, 2015, 352.8653846, 10, 29),
(173, 2016, 402.5283019, 0, 29),
(174, 2017, 402.5283019, 0, 29),
(175, 2012, 20.95, 0, 30),
(176, 2013, 20.59, 1.328413284, 30),
(177, 2014, 20.34, 2.250922509, 30),
(178, 2015, 20.1, 3.136531365, 30),
(179, 2016, 19.88, 3.948339483, 30),
(180, 2017, 18.24, 10, 30),
(181, 2012, 13.1, 0.284974093, 31),
(182, 2013, 11.95, 3.264248705, 31),
(183, 2014, 12.18, 2.668393782, 31),
(184, 2015, 13.21, 0, 31),
(185, 2016, 9.84, 8.730569948, 31),
(186, 2017, 9.35, 10, 31),
(187, 2012, 0.363042901, 0.833902436, 32),
(188, 2013, 0.388702315, 0, 32),
(189, 2014, 0.080999474, 10, 32),
(190, 2015, 0.093456806, 9.59515058, 32),
(191, 2016, 0.211596425, 5.755744406, 32),
(192, 2017, 0.364871154, 0.774486248, 32),
(193, 2012, 0.974983542, 1.304009986, 33),
(194, 2013, 0.972570613, 0, 33),
(195, 2014, 0.974424684, 1.001988335, 33),
(196, 2015, 0.978410883, 3.156235043, 33),
(197, 2016, 0.991074528, 10, 33),
(198, 2017, 0.973538585, 0.523117702, 33),
(199, 2012, 0.74276669, 10, 34),
(200, 2013, 0.73343596, 7.798701689, 34),
(201, 2014, 0.724863544, 5.776304374, 34),
(202, 2015, 0.716381984, 3.775341636, 34),
(203, 2016, 0.708269917, 1.861549275, 34),
(204, 2017, 0.700379294, 0, 34),
(205, 2012, 8.995729917, 10, 35),
(206, 2013, 8.882724405, 8.629635169, 35),
(207, 2014, 8.698362533, 6.393965237, 35),
(208, 2015, 8.596583813, 5.159742443, 35),
(209, 2016, 8.263149031, 1.116335258, 35),
(210, 2017, 8.171091767, 0, 35),
(211, 2012, 14.35, 0, 36),
(212, 2013, 13.94, 2.64516129, 36),
(213, 2014, 13.41, 6.064516129, 36),
(214, 2015, 13.63, 4.64516129, 36),
(215, 2016, 13.19, 7.483870968, 36),
(216, 2017, 12.8, 10, 36),
(217, 2012, 2.48, 2.564102564, 37),
(218, 2013, 2.46, 3.076923077, 37),
(219, 2014, 2.36, 5.641025641, 37),
(220, 2015, 2.58, 0, 37),
(221, 2016, 2.19, 10, 37),
(222, 2017, 2.51, 1.794871795, 37),
(223, 2012, 0.59, 8.125, 38),
(224, 2013, 0.72, 0, 38),
(225, 2014, 0.66, 3.75, 38),
(226, 2015, 0.67, 3.125, 38),
(227, 2016, 0.56, 10, 38),
(228, 2017, 0.71, 0.625, 38),
(229, 2012, 6.78, 0, 39),
(230, 2013, 4.55, 9.955357143, 39),
(231, 2014, 5.06, 7.678571429, 39),
(232, 2015, 5.67, 4.955357143, 39),
(233, 2016, 5.105, 7.477678571, 39),
(234, 2017, 4.54, 10, 39),
(235, 2012, 63.44, 2.987341772, 40),
(236, 2013, 66.21, 10, 40),
(237, 2014, 62.26, 0, 40),
(238, 2015, 62.79, 1.341772152, 40),
(239, 2016, 63.22941839, 2.454223763, 40),
(240, 2017, 63.35, 2.759493671, 40),
(241, 2012, 84.6, 5.517241379, 41),
(242, 2013, 84.8, 6.009852217, 41),
(243, 2014, 85.3, 7.24137931, 41),
(244, 2015, 84.2, 4.532019704, 41),
(245, 2016, 86.42, 10, 41),
(246, 2017, 82.36, 0, 41),
(247, 2012, 93.83, 0, 42),
(248, 2013, 94.23, 0.980392157, 42),
(249, 2014, 96.23, 5.882352941, 42),
(250, 2015, 96.83, 7.352941176, 42),
(251, 2016, 95.83, 4.901960784, 42),
(252, 2017, 97.91, 10, 42),
(253, 2012, 85.02, 0, 43),
(254, 2013, 88.15, 4.664679583, 43),
(255, 2014, 88.03, 4.485842027, 43),
(256, 2015, 89.36, 6.467958271, 43),
(257, 2016, 91.01, 8.926974665, 43),
(258, 2017, 91.73, 10, 43),
(259, 2012, 93.23, 6.898047722, 44),
(260, 2013, 94.3, 9.219088937, 44),
(261, 2014, 94.66, 10, 44),
(262, 2015, 90.05, 0, 44),
(263, 2016, 92.53, 5.379609544, 44),
(264, 2017, 90.92, 1.887201735, 44),
(265, 2012, 72.27, 2.220149254, 45),
(266, 2013, 68.7, 0, 45),
(267, 2014, 75.04, 3.94278607, 45),
(268, 2015, 77.02, 5.174129353, 45),
(269, 2016, 77.56, 5.509950249, 45),
(270, 2017, 84.78, 10, 45),
(271, 2012, 86.35, 0, 46),
(272, 2013, 87.89, 2.825688073, 46),
(273, 2014, 88.04, 3.100917431, 46),
(274, 2015, 90.1, 6.880733945, 46),
(275, 2016, 91.8, 10, 46),
(276, 2017, 90.71, 8, 46),
(277, 2012, 0.558244311, 0, 47),
(278, 2013, 0.60394102, 3.66079358, 47),
(279, 2014, 0.628332481, 5.614809613, 47),
(280, 2015, 0.648651454, 7.242575973, 47),
(281, 2016, 0.637380319, 6.339637898, 47),
(282, 2017, 0.683071642, 10, 47),
(283, 2012, 0.244148117, 0.509770644, 48),
(284, 2013, 0.240590091, 0, 48),
(285, 2014, 0.293664749, 7.60418947, 48),
(286, 2015, 0.302225088, 8.830658707, 48),
(287, 2016, 0.271063079, 4.365970087, 48),
(288, 2017, 0.310386692, 10, 48),
(289, 2012, 1.688141333, 0, 49),
(290, 2013, 1.844044032, 2.728797505, 49),
(291, 2014, 1.972016526, 4.968726805, 49),
(292, 2015, 2.259465144, 10, 49),
(293, 2016, 2.151041446, 8.102237376, 49),
(294, 2017, 1.910543931, 3.892759129, 49),
(295, 2012, 0.153151906, 0, 50),
(296, 2013, 0.225846762, 3.691114983, 50),
(297, 2014, 0.254688802, 5.155582898, 50),
(298, 2015, 0.308881223, 7.907228203, 50),
(299, 2016, 0.342165652, 9.59726048, 50),
(300, 2017, 0.350097427, 10, 50),
(301, 2012, 65.31, 9.518987342, 51),
(302, 2013, 61.55, 0, 51),
(303, 2014, 63.71, 5.46835443, 51),
(304, 2015, 65.25, 9.367088608, 51),
(305, 2016, 63.66, 5.341772152, 51),
(306, 2017, 65.5, 10, 51),
(307, 2012, 0.070404524, 10, 52),
(308, 2013, 0.062452147, 6.065436981, 52),
(309, 2014, 0.057915943, 3.821079259, 52),
(310, 2015, 0.052967092, 1.372557409, 52),
(311, 2016, 0.051175443, 0.486110786, 52),
(312, 2017, 0.050192935, 0, 52),
(313, 2012, 0.000739032, 10, 53),
(314, 2013, 0.000705822, 7.378334271, 53),
(315, 2014, 0.000675874, 5.01420039, 53),
(316, 2015, 0.000695332, 6.550245659, 53),
(317, 2016, 0.000654812, 3.35154094, 53),
(318, 2017, 0.000612356, 0, 53);

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
(1, 2012, 8.863684828, 1),
(2, 2013, 6.6687421, 1),
(3, 2014, 4.230950457, 1),
(4, 2015, 3.891388889, 1),
(5, 2016, 3.119779857, 1),
(6, 2017, 1.288500627, 1),
(7, 2012, 5.664325035, 2),
(8, 2013, 5.634058079, 2),
(9, 2014, 5.384152929, 2),
(10, 2015, 5.277731183, 2),
(11, 2016, 2.899528945, 2),
(12, 2017, 4.324949818, 2),
(13, 2012, 4.163004333, 3),
(14, 2013, 3.888066268, 3),
(15, 2014, 3.470306069, 3),
(16, 2015, 4.985138615, 3),
(17, 2016, 5.019622666, 3),
(18, 2017, 4.544002797, 3),
(19, 2012, 2.672275641, 4),
(20, 2013, 3.919360378, 4),
(21, 2014, 5.7835283, 4),
(22, 2015, 3.181379608, 4),
(23, 2016, 8.740387385, 4),
(24, 2017, 5.604967949, 4),
(25, 2012, 2.517540018, 5),
(26, 2013, 4.814242995, 5),
(27, 2014, 4.950468254, 5),
(28, 2015, 4.535650657, 5),
(29, 2016, 6.738959858, 5),
(30, 2017, 6.092385058, 5),
(31, 2012, 0.127442661, 6),
(32, 2013, 2.520176517, 6),
(33, 2014, 5.835827197, 6),
(34, 2015, 8.495115721, 6),
(35, 2016, 7.10127646, 6),
(36, 2017, 8.473189782, 6),
(37, 2012, 9.839662447, 7),
(38, 2013, 4.481257084, 7),
(39, 2014, 4.767878026, 7),
(40, 2015, 5.763297225, 7),
(41, 2016, 3.059807959, 7),
(42, 2017, 3.333333333, 7);

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
  ADD PRIMARY KEY (`id_tahun`);

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
  MODIFY `kode_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `ipi`
--
ALTER TABLE `ipi`
  MODIFY `id_nilai_ipi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilaidimensi`
--
ALTER TABLE `nilaidimensi`
  MODIFY `id_nilai_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nilaiindikator`
--
ALTER TABLE `nilaiindikator`
  MODIFY `id_nilai_i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `nilaisubdimensi`
--
ALTER TABLE `nilaisubdimensi`
  MODIFY `id_nilai_sd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
