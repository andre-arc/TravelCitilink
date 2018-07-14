-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2018 at 10:53 AM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `mitra` int(12) NOT NULL,
  `no_identitas` varchar(15) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` tinytext NOT NULL,
  `hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `mitra`, `no_identitas`, `nama_customer`, `jenis_kelamin`, `alamat`, `hp`, `email`) VALUES
(1, 1, '117104470800001', 'Muhammad Iqbal', 'Laki-laki', 'Ie masen Kayee Adang, Ulee Kareng, Banda Aceh', '085288539336', 'alfatha49@gmail.com'),
(10, 1, '110108261175000', 'NURUL HAMDI', 'Laki-laki', 'TIBANG SYIAH KUALA', '08116841122', 'nurulhamdi@uui.ac.id'),
(11, 1, '0011711850002', 'NANDA GIARISMA', 'Perempuan', 'Lingke Banda Aceh', '08116841222', '-'),
(12, 1, '1236666879', 'Syaikh Fatih', 'Laki-laki', 'Lingke Banda Aceh', '08125567980', 'syaikh23@gmail.com'),
(13, 2, '110614600696000', 'ASRA PRIMA TRAVEL UJI COBA', 'Perempuan', 'blower,banda aceh', '082165078861', 'alfisyahril64@gmail.com'),
(15, 4, '012', 'tara travel uji coba', 'Perempuan', 'peunayong', '082365516551', 'taratravel07@yahoo.com'),
(16, 3, '123456', 'travel cendana uji coba', 'Perempuan', 'lingke  banda aceh', '08116855511', 'cendanatour@yahoo.co.id'),
(17, 6, '123456', 'Dzaki Travel Uji Coba', 'Laki-laki', 'Jalan T Hasan dek Jambo Tape', '081360140856', 'dzakiwisata@gmail.com'),
(18, 9, '001', 'Alam tari travel Ujicoba', 'Perempuan', 'jalan T iskandar no.20', '08126957000', 'alamtari70@gmail.com'),
(19, 9, '002', 'ALAMTARI UJI COBA 2', 'Perempuan', 'JLN T ISKANDAR NO 20', '085207614024', 'ALAMTARI70@GMAIL.COM'),
(22, 1, '1254555', 'Fahri', 'Laki-laki', 'Lingke', '08522222226', '0'),
(23, 7, '001', 'YALMALAM UJI COBA', 'Perempuan', 'LAMSEUPENG', '08116809077', 'deasy_deasy2002@yahoo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
