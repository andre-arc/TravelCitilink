-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2018 at 10:52 AM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelubudiyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` int(12) NOT NULL,
  `id_pesan` int(12) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL,
  `umur_penumpang` varchar(10) NOT NULL,
  `nomor_id` varchar(25) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `id_pesan`, `nama_penumpang`, `umur_penumpang`, `nomor_id`, `created`) VALUES
(1, 1, 'hamdi Ubudiyah', '40', '1190875643', '2018-05-11 03:39:32'),
(20, 12, 'NURUL HAMDI', '40', '123456789', '2018-05-15 15:13:42'),
(22, 14, 'NURUL HAMDI', '40', '123456789', '2018-05-15 15:59:35'),
(23, 15, 'Zaid AlHafiizh', '13', '0122512204001', '2018-05-16 04:46:50'),
(24, 15, 'Putri Nury', '24', '001241190112', '2018-05-16 04:48:03'),
(25, 17, 'ASRA PRIMA TRAVEL UJI COBA', '20', 'B7895216', '2018-05-16 06:59:41'),
(26, 17, 'ASRA PRIMA TRAVEL UJI COBA 1', '40', 'A2648755', '2018-05-16 07:00:17'),
(27, 18, 'LILIS SEPTIA', '20', 'A123456', '2018-05-16 07:23:52'),
(28, 18, 'DEVI YANTI', '20', 'B451265', '2018-05-16 07:24:16'),
(29, 18, 'SARA FATMAWATI', '20', 'A565522', '2018-05-16 07:24:34'),
(30, 19, 'MARDHIAH', '25', 'A235874', '2018-05-16 07:48:23'),
(31, 19, 'SYAMSIDAR', '24', 'A247643', '2018-05-16 07:48:52'),
(32, 20, 'risna wati', '20', 'a271198', '2018-05-16 08:40:20'),
(33, 20, 'maisarah', '20', 'a281719', '2018-05-16 08:40:42'),
(34, 20, 'putra', '20', 'a291879', '2018-05-16 08:41:06'),
(35, 21, 'Aldi', '38', 'A23451', '2018-05-17 05:28:22'),
(36, 21, 'Ida', '30', 'A45231', '2018-05-17 05:29:56'),
(37, 22, 'Linda', '28', 'A12389', '2018-05-17 06:27:41'),
(38, 22, 'Nuraini', '30', 'A15432', '2018-05-17 06:30:51'),
(39, 22, 'SITI Rafikah', '38', 'A76531', '2018-05-17 06:31:31'),
(40, 22, 'Nelly', '40', 'A4328', '2018-05-17 06:31:59'),
(43, 23, 'SITI', '28', 'A75412', '2018-05-17 07:05:09'),
(44, 24, 'mu travel uji  coba', '25', 'a123456', '2018-05-17 08:00:39'),
(45, 24, 'mu travel', '20', 'a1245', '2018-05-17 08:01:02'),
(46, 25, 'mu travel', '25', 'a123456', '2018-05-17 08:23:18'),
(47, 25, 'mu wisata travel', '21', 'a1245', '2018-05-17 08:23:37'),
(48, 27, 'Fahri', '27', '4545454848', '2018-05-18 05:14:11'),
(49, 27, 'Reza', '22', '21656', '2018-05-18 05:14:24'),
(50, 28, 'desi', '32', 'a325678', '2018-05-18 10:14:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id_penumpang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
