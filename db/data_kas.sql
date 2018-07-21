-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2018 at 04:13 PM
-- Server version: 10.0.35-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelg6171_tma`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kas`
--

CREATE TABLE `data_kas` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) UNSIGNED ZEROFILL NOT NULL,
  `org_id` int(11) NOT NULL,
  `jumlah` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kas`
--

INSERT INTO `data_kas` (`id`, `id_transaksi`, `org_id`, `jumlah`) VALUES
(13, 00000000007, 768, 200000000),
(14, 00000000008, 766, 200000000),
(15, 00000000009, 769, 200000000);

--
-- Triggers `data_kas`
--
DELIMITER $$
CREATE TRIGGER `krg_kas` AFTER DELETE ON `data_kas` FOR EACH ROW update orgs set orgs.jml_kas=orgs.jml_kas-old.jumlah WHERE orgs.id=old.org_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_kas` AFTER INSERT ON `data_kas` FOR EACH ROW update orgs set orgs.jml_kas=orgs.jml_kas+new.jumlah WHERE orgs.id=new.org_id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kas`
--
ALTER TABLE `data_kas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kas`
--
ALTER TABLE `data_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
