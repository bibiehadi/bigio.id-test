-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2020 at 04:23 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `surveyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komoditas`
--

CREATE TABLE `tbl_komoditas` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `satuan` enum('/kg','/gram','/liter','/buah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_komoditas`
--

INSERT INTO `tbl_komoditas` (`id`, `nama`, `satuan`) VALUES
(1, 'Beras', '/kg'),
(2, 'Telur', '/kg'),
(3, 'Minyak', '/liter'),
(4, 'Tomat', '/kg'),
(5, 'Cabai', '/kg'),
(6, 'Daging', '/kg'),
(7, 'Gula', '/kg'),
(8, 'Garam', '/kg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasar`
--

CREATE TABLE `tbl_pasar` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pasar`
--

INSERT INTO `tbl_pasar` (`id`, `nama`, `alamat`) VALUES
(1, 'Pasar Gondanglegi', 'Jl. Soekarno-Hatta, Gondanglegi.'),
(2, 'Pasar Bululawang', 'Jl. Patimura, Bululawang.a'),
(6, 'Pasar Gadang', 'Jl. Raya Gadang, Kota Malang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` varchar(3) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
('adm', 'Admin'),
('srv', 'Surveyor'),
('vst', 'Visitor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey`
--

CREATE TABLE `tbl_survey` (
  `id` int(11) NOT NULL,
  `id_komoditas` int(5) NOT NULL,
  `harga` varchar(24) NOT NULL,
  `id_pasar` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_survey`
--

INSERT INTO `tbl_survey` (`id`, `id_komoditas`, `harga`, `id_pasar`, `id_user`, `date`, `status`) VALUES
(1, 2, '20000', '2', 2, '2020-02-12', 'Menunggu'),
(3, 4, '15000', '6', 3, '2020-02-18', 'Menunggu'),
(4, 2, '12000', '1', 2, '2020-01-27', 'Menunggu'),
(5, 3, '129000', '1', 2, '2020-01-27', 'Menunggu'),
(6, 4, '13000', '2', 2, '2020-02-18', 'Menunggu'),
(7, 5, '4000', '2', 2, '2020-02-18', 'Menunggu'),
(8, 3, '12000', '2', 2, '2020-02-18', 'Menunggu'),
(9, 4, '13000', '2', 3, '2020-02-18', 'Menunggu'),
(10, 5, '4000', '2', 2, '2020-02-18', 'Menunggu'),
(11, 3, '12000', '2', 2, '2020-02-18', 'Menunggu'),
(12, 3, '12000', '6', 3, '2020-02-03', 'Menunggu'),
(13, 2, '12000', '6', 2, '2020-02-03', 'Menunggu'),
(14, 3, '12000', '6', 2, '2020-02-03', 'Menunggu'),
(15, 2, '12000', '6', 2, '2020-02-03', 'Menunggu'),
(16, 4, '13000', '1', 2, '2020-02-10', 'Menunggu'),
(17, 7, '10500', '1', 2, '2020-02-03', 'Menunggu'),
(18, 3, '40000', '1', 3, '2020-02-05', 'Menunggu'),
(19, 3, '11400', '2', 3, '2020-01-27', 'Menunggu'),
(20, 4, '5000', '2', 3, '2020-01-27', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('vst','srv','adm') NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `email`, `password`, `role`, `status`) VALUES
(2, 'bibie', 'bibie.hadi22@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'adm', 1),
(3, 'surveyor', 'surveyor@surveyio.id', '108b973b479d0fccbe63143f8904c180', 'srv', 1),
(4, 'visitor', 'visitor@surveyio.id', '127870930d65c57ee65fcc47f2170d38', 'vst', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_komoditas`
--
ALTER TABLE `tbl_komoditas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pasar`
--
ALTER TABLE `tbl_pasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey`
--
ALTER TABLE `tbl_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_komoditas`
--
ALTER TABLE `tbl_komoditas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pasar`
--
ALTER TABLE `tbl_pasar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_survey`
--
ALTER TABLE `tbl_survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;