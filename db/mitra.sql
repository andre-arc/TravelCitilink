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
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(12) NOT NULL,
  `no_izin` int(25) NOT NULL,
  `nama_mitra` varchar(100) NOT NULL,
  `alamat_mitra` varchar(100) NOT NULL,
  `telp_mitra` varchar(20) NOT NULL,
  `email_mitra` varchar(30) NOT NULL,
  `miname` varchar(50) NOT NULL,
  `mipass` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `no_izin`, `nama_mitra`, `alamat_mitra`, `telp_mitra`, `email_mitra`, `miname`, `mipass`, `created`) VALUES
(1, 0, 'Ubudiyah Travel', 'Jln. Alue Naga, Desa Tibang, Kec. Syiahkuala-Banda Acceh', '(0651) - 7555750', '', 'ubtravel', '$2y$10$HiQWseKPjJZ0TIsOB.pb8OvO.dz1KQid3ymYr75P8p3M9BrAJTF4S', '2018-05-02 10:00:00'),
(2, 1, 'Asra Prima', 'Sri Ratu Syafiatuddin No. 7 Peunayong, Banda Aceh', '(0651) 35226', 'alfisyahril64@gmail.com', 'asraprima', '$2y$10$C7VbCBxMXwB/6jMXo4uJ9uuJFpnpNg6.NJlw1n03VCzwTnieEMl0y', '2018-05-09 14:48:10'),
(3, 2, 'PT Cendana Tour & Travel', 'Jl. T. Hasan Dek No. 31 Kec. Kuta Alam, Banda Aceh', '0811681031', 'cendanatour@yahoo.co.id', 'cendanatravel', '$2y$10$RBulSMosYoV/QMvozGoqjO/FKTcMKFUUKo77eiQPuJKhvBAd9KMKK', '2018-05-09 14:52:52'),
(4, 3, 'Tara Travel', 'Jl. Sri Ratu Syafiatuddin No. 38 Peunayong, Banda Aceh', '082365516551', 'taratravel07@yahoo.com', 'idtara05', '$2y$10$zfhokxPvWU7llos5WStm0uy4fyueBuCL//DGSTKNlcADpJ9WSbiyS', '2018-05-09 14:55:26'),
(5, 4, 'PT Kana Tour & Travel', 'Jl. Sri Ratu Safiatuddin No.5 Peunayong, Banda Aceh', '(0651) 635700', 'kanatour_nad@yahoo.com', 'kanatour', '$2y$10$UBWicxKKLzyOoED55XyHheNtEJ5DLb4cFwxGsGOYGc7X.62IcOfda', '2018-05-09 14:58:08'),
(6, 5, 'Dzaki Tour & Travel', 'Jl. T. Hasan Dek No. 232 Jambo Tape, Banda Aceh', '085260085299', '-', 'dzakitravel', '$2y$10$Rg0nqZ8e09NSHZa/sW/CE.4NPUuuhdop5SgfrDFl4aKPYDtSAIwja', '2018-05-09 15:00:25'),
(7, 6, 'PT Yalamlam Wisata', 'Jl. Tgk. Imuem Lueng Bata No. 01 Lamseupeung, Banda Aceh', '08116809033', 'deasy_deasy2002@yahoo.com', 'yalamlam', '$2y$10$rAr5dUUHiedj.mytCxAyAO8tzgud2xWHyfUJDuowHFvXizvXvLao2', '2018-05-09 15:02:58'),
(8, 7, 'PT Nuansa Tour & Travel', 'Jl. Tgk. Chik Ditiro No. 99 Simpang Surabaya, Banda Aceh', '(0651) 23480', 'nuansawisatanusa@yahoo.co.id', 'nuansatravel', '$2y$10$e8qFxchf6KOCfsF64rOYSezaAbMByJbZwhAubNY.Tlo4AerzT/FJS', '2018-05-09 15:06:17'),
(9, 8, 'PT Alam Tari Tour & Travel', 'Jl. T. Iskandar No. 20 Beurawe, Banda Aceh', '08126957000', 'alamtari70@gmail.com', 'alamtari', '$2y$10$x1tZW9zENUu4/Nwnh40/ZO4LgXlSHTHTz9dgo5a.esrcCF03.cOAK', '2018-05-09 15:11:50'),
(10, 9, 'PT Mangat Usaha Wisata', 'Jl. Cut Nyak Dhien No. 511 Lamteumen Timur, Banda Aceh', '(0651) 47259', 'muholiday2013@gmail.com', 'muwisata', '$2y$10$uxzi42avRQzPRoh.Xcqr8.k3zJ5xtiBbOqE/HW3q/VgezseLxtC4G', '2018-05-09 15:14:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
