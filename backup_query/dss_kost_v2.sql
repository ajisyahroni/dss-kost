-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2020 at 07:30 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dss_kost_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `dss_fasilitas_kamar`
--

CREATE TABLE `dss_fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dss_fasilitas_kamar`
--

INSERT INTO `dss_fasilitas_kamar` (`id`, `nama`, `nilai`) VALUES
(1, 'kasur', 0),
(2, 'kasur, lemari', 0.25),
(3, 'kasur, lemari, wifi', 0.5),
(4, 'kasur, lemari, wifi, meja belajar', 0.75),
(5, 'kasur, lemari, wifi, meja belajar,ac', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dss_fasilitas_lingkungan`
--

CREATE TABLE `dss_fasilitas_lingkungan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dss_fasilitas_lingkungan`
--

INSERT INTO `dss_fasilitas_lingkungan` (`id`, `nama`, `nilai`) VALUES
(6, 'rumah makan', 0),
(7, 'rumah makan, masjid', 0.25),
(8, 'rumah makan, masjid, coffe break', 0.5),
(9, 'rumah makan, masjid, coffe break, photo copy', 0.75),
(10, 'rumah makan, masjid, coffe break, photo copy,warnet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dss_fasilitas_penunjang`
--

CREATE TABLE `dss_fasilitas_penunjang` (
  `id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dss_fasilitas_penunjang`
--

INSERT INTO `dss_fasilitas_penunjang` (`id`, `nama`, `nilai`) VALUES
(1, 'wifi', 0),
(2, 'wifi, ac', 0.25),
(3, 'wifi, ac, laundry', 0.5),
(4, 'wifi, ac, laundry, karpet', 0.75),
(5, 'wifi, ac, laundry, karpet,TV', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dss_kost`
--

CREATE TABLE `dss_kost` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `luas_kamar` int(11) NOT NULL,
  `jarak` int(11) NOT NULL,
  `id_fasilitas_kamar` int(11) NOT NULL,
  `id_fasilitas_penunjang` int(11) NOT NULL,
  `id_fasilitas_lingkungan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dss_kost_kriteria`
--

CREATE TABLE `dss_kost_kriteria` (
  `id` int(11) NOT NULL,
  `id_kost` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dss_kriteria`
--

CREATE TABLE `dss_kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `tipe` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dss_fasilitas_kamar`
--
ALTER TABLE `dss_fasilitas_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dss_fasilitas_lingkungan`
--
ALTER TABLE `dss_fasilitas_lingkungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dss_fasilitas_penunjang`
--
ALTER TABLE `dss_fasilitas_penunjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dss_kost`
--
ALTER TABLE `dss_kost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_fasilitas_kamar` (`id_fasilitas_kamar`),
  ADD KEY `fk_fasilitas_penunjang` (`id_fasilitas_penunjang`),
  ADD KEY `fk_fasilitas_lingkungan` (`id_fasilitas_lingkungan`);

--
-- Indexes for table `dss_kost_kriteria`
--
ALTER TABLE `dss_kost_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kriteria` (`id_kriteria`),
  ADD KEY `fk_kost` (`id_kost`);

--
-- Indexes for table `dss_kriteria`
--
ALTER TABLE `dss_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dss_fasilitas_kamar`
--
ALTER TABLE `dss_fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dss_fasilitas_lingkungan`
--
ALTER TABLE `dss_fasilitas_lingkungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dss_fasilitas_penunjang`
--
ALTER TABLE `dss_fasilitas_penunjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dss_kost`
--
ALTER TABLE `dss_kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dss_kost_kriteria`
--
ALTER TABLE `dss_kost_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dss_kriteria`
--
ALTER TABLE `dss_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dss_kost`
--
ALTER TABLE `dss_kost`
  ADD CONSTRAINT `fk_fasilitas_lingkungan` FOREIGN KEY (`id_fasilitas_lingkungan`) REFERENCES `dss_fasilitas_lingkungan` (`id`),
  ADD CONSTRAINT `fk_fasilitas_penunjang` FOREIGN KEY (`id_fasilitas_penunjang`) REFERENCES `dss_fasilitas_penunjang` (`id`),
  ADD CONSTRAINT `fk_id_fasilitas_kamar` FOREIGN KEY (`id_fasilitas_kamar`) REFERENCES `dss_fasilitas_kamar` (`id`);

--
-- Constraints for table `dss_kost_kriteria`
--
ALTER TABLE `dss_kost_kriteria`
  ADD CONSTRAINT `fk_kost` FOREIGN KEY (`id_kost`) REFERENCES `dss_kost` (`id`),
  ADD CONSTRAINT `fk_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `dss_kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
