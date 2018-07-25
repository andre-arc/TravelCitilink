-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2018 at 04:56 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelubudiyah_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE `orgs` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ID',
  `parent_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'PID',
  `parent_name` varchar(255) DEFAULT NULL,
  `name` tinytext NOT NULL COMMENT 'Nama Org',
  `no_reg` varchar(50) NOT NULL,
  `alamat_pkl` varchar(50) NOT NULL,
  `jml_kas` bigint(20) NOT NULL,
  `description` text COMMENT 'Desc. Org'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`id`, `parent_id`, `parent_name`, `name`, `no_reg`, `alamat_pkl`, `jml_kas`, `description`) VALUES
(1, 0, '', 'Pusat', '1234', '', 0, 'PT. Taman Midi Anggun Pusat'),
(768, 1, 'Pusat', 'Mitra Agen A', '1212321312', 'Banda Aceh', -1950000, 'Mitra Agen A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orgs`
--
ALTER TABLE `orgs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=770;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
