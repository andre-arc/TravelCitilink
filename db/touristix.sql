-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 06, 2020 at 10:49 AM
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
-- Database: `touristix`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `mitra` int(12) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `mitra`, `nik`, `nama_customer`, `alamat`, `hp`, `email`) VALUES
(1, 777, '', 'qwerw', '', '2343', 'dfs@sdf.com'),
(2, 777, '', 'qwerw', '', '2343', 'dfs@sdf.com'),
(3, 777, '', 'qwerw', '', '3424234', 'dfs@sdf.com');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tiket`
--

CREATE TABLE `detail_tiket` (
  `id` int(255) NOT NULL,
  `id_tiket` int(255) NOT NULL,
  `jenis_penumpang` int(5) NOT NULL,
  `hrg_tiket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_tiket`
--

INSERT INTO `detail_tiket` (`id`, `id_tiket`, `jenis_penumpang`, `hrg_tiket`) VALUES
(1, 4, 1, '30000'),
(2, 4, 2, '10000'),
(3, 4, 3, '5000');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'operator', ''),
(3, 'umum', 'umum');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menus`
--

CREATE TABLE `groups_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `akses` tinyint(1) UNSIGNED DEFAULT '1',
  `tambah` tinyint(1) UNSIGNED DEFAULT '0',
  `ubah` tinyint(1) UNSIGNED DEFAULT '0',
  `hapus` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menus`
--

INSERT INTO `groups_menus` (`id`, `group_id`, `menu_id`, `akses`, `tambah`, `ubah`, `hapus`) VALUES
(1, 1, 4, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 5, 1, 1, 1, 1),
(5, 1, 6, 1, 1, 1, 1),
(6, 1, 11, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1, 1),
(10, 1, 22, 1, 1, 1, 1),
(13, 1, 25, 1, 1, 1, 1),
(68, 1, 42, 1, 1, 1, 1),
(76, 1, 49, 1, 1, 1, 1),
(75, 1, 51, 1, 1, 1, 1),
(77, 1, 50, 1, 1, 1, 1),
(64, 1, 39, 1, 1, 1, 1),
(78, 1, 52, 1, 1, 1, 1),
(79, 1, 53, 1, 1, 1, 1),
(74, 1, 48, 1, 1, 1, 1),
(80, 1, 54, 1, 1, 1, 1),
(81, 1, 55, 1, 1, 1, 1),
(82, 1, 56, 1, 1, 1, 1),
(83, 2, 25, 1, 1, 1, 1),
(84, 2, 51, 1, 0, 0, 0),
(85, 2, 39, 1, 1, 1, 1),
(86, 2, 42, 1, 0, 0, 0),
(88, 2, 53, 1, 1, 1, 1),
(89, 2, 54, 1, 1, 1, 1),
(90, 2, 55, 1, 1, 1, 1),
(91, 2, 1, 1, 1, 1, 1),
(92, 2, 6, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_penumpang`
--

CREATE TABLE `jenis_penumpang` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_penumpang`
--

INSERT INTO `jenis_penumpang` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Dewasa', 'Usia 12+'),
(2, 'Anak', 'Usia 2-11'),
(3, 'Bayi', 'Di bawah 2');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tiket`
--

CREATE TABLE `jenis_tiket` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_tiket`
--

INSERT INTO `jenis_tiket` (`id`, `nama`, `deskripsi`) VALUES
(1, 'ekonomi', 'Kelas Ekonomi'),
(2, 'vip', 'Kelas VIP');

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE `kapal` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`id`, `nama`, `logo`, `deskripsi`) VALUES
(1, 'Express Bahari F5', 'expressbahari.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `id` int(11) NOT NULL,
  `bank_tujuan` varchar(50) NOT NULL,
  `bank_anda` varchar(100) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `metode` varchar(100) NOT NULL,
  `tgl_tranfers` date NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `id_transaksi` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(15) NOT NULL,
  `nm_kota` varchar(50) NOT NULL,
  `id_prov` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nm_kota`, `id_prov`) VALUES
(1, 'Banda Aceh', 1),
(2, 'Sepang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'this is ID for menus',
  `parent_id` int(10) UNSIGNED DEFAULT '0',
  `path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT 'glyphicon glyphicon-tasks',
  `list_order` int(3) DEFAULT '0',
  `remark` text,
  `flag` enum('draft','publish') DEFAULT 'draft'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `path`, `name`, `icon`, `list_order`, `remark`, `flag`) VALUES
(1, 0, '#', 'SETTINGS', 'fa fa-cogs', 18, 'Auth. Control List', 'publish'),
(2, 1, 'acl/orgs/', 'MITRA', 'fa fa-university', 2, 'Organisations', 'publish'),
(3, 1, 'acl/groups/', 'GROUPS', 'fa fa-tags', 3, 'Groups Authentifications', 'publish'),
(4, 1, 'acl/groups_menu/', 'GROUPS MENUS', 'fa fa-list-alt', 4, 'Groups Menus', 'publish'),
(5, 1, 'acl/menus/', 'MENUS', 'fa fa-list', 5, 'Menus', 'publish'),
(6, 1, 'acl/users/', 'USERS', 'fa fa-users', 6, 'Users Application', 'publish'),
(11, 1, 'acl/config/', 'CONFIG', 'fa fa-cog', 7, 'Main Configuration App', 'publish'),
(22, 0, 'lookbook/report/', 'LAPORAN', 'fa fa-area-chart', 11, '', 'publish'),
(25, 0, 'dashboard/', 'DASHBOARD', 'fa fa-dashboard', 8, 'Panel Dashboard', 'publish'),
(39, 0, '#', 'PEMBELI', 'fa fa-group', 9, '', 'publish'),
(42, 39, 'pembeli/', 'DATA PEMBELI', 'fa fa-database', 13, '', 'publish'),
(51, 0, 'tiket/', 'TIKET PESAWAT', 'fa fa-fighter-jet', 10, '', 'publish'),
(49, 48, 'bandara/', 'BANDARA', 'fa fa-arrows-alt', 9, '', 'publish'),
(43, 42, 'laporan/', 'Laporan Pangkalan', 'fa fa-file-pdf-o', 15, 'Laporan', 'publish'),
(53, 0, 'transaksi/', 'TRANSAKSI', 'fa fa-cart-plus', 11, '', 'publish'),
(48, 0, '#', 'DATA MASTER', 'fa fa-align-justify', 16, '', 'publish'),
(54, 53, 'transaksi/', 'DATA TRANSAKSI', 'fa fa-angle-right', 0, '', 'publish'),
(55, 53, 'transaksi/konfirmasi/', 'KONFIRMASI PEMBAYARAN', 'fa fa-bitbucket', 10, '', 'publish'),
(56, 48, 'kas/', 'KAS', 'fa fa-dollar', 11, '', 'publish');

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

-- --------------------------------------------------------

--
-- Table structure for table `m_config`
--

CREATE TABLE `m_config` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `config_var` text NOT NULL,
  `config_val` text NOT NULL,
  `config_group` varchar(255) DEFAULT NULL,
  `config_type` varchar(255) DEFAULT 'text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_config`
--

INSERT INTO `m_config` (`id`, `config_var`, `config_val`, `config_group`, `config_type`) VALUES
(27, 'APP_NAME_LOGO', '-', 'GENERAL', 'text'),
(9, 'NAME', 'PT. Ubudiyah Aviation Indonesia', 'OFFICE', 'text'),
(10, 'ADDRESS', 'Banda Aceh -Indonesia', 'OFFICE', 'text'),
(11, 'PHONE', '', 'OFFICE', 'text'),
(12, 'FAX', '', 'OFFICE', 'text'),
(13, 'CITY', 'Banda Aceh', 'OFFICE', 'text'),
(14, 'POST_CODE', '23115', 'OFFICE', 'text'),
(15, 'MAIL', '', 'OFFICE', 'text'),
(16, 'URL', '-', 'OFFICE', 'text'),
(28, 'DISCLAIMER', '', 'GENERAL', 'text'),
(23, 'PENGUMUMAN', '', 'GENERAL', 'text'),
(24, 'APP_NAME', 'Travel Ubudiyah', 'GENERAL', 'text'),
(25, 'APP_NAME_LONG', '', 'GENERAL', 'text'),
(26, 'APP_NAME_CITY', 'Banda Aceh', 'GENERAL', 'text'),
(29, 'VERSION', '', 'GENERAL', 'text'),
(30, 'APP_NAME_ICON', 'fa fa-newspaper-o', 'GENERAL', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `name`) VALUES
(1, 'Indonesia'),
(2, 'Malaysia');

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
  `description` text COMMENT 'Desc. Org'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`id`, `parent_id`, `parent_name`, `name`, `no_reg`, `alamat_pkl`, `description`) VALUES
(1, 0, '', 'Pusat', '1234', '', 'PT. Ubudiyah Travel Aviation'),
(777, 1, 'PT. Ubudiyah Travel Aviation', 'UMUM', '', '', 'UMUM'),
(770, 1, 'PT. Ubudiyah Travel Aviation', 'Asra Prima', '', '', 'Asra Prima'),
(771, 1, 'PT. Ubudiyah Travel Aviation', 'PT Kana Tour & Travel', '', '', 'PT Kana Tour & Travel'),
(772, 1, 'PT. Ubudiyah Travel Aviation', 'Dzaki Tour & Travel', '', '', 'Dzaki Tour & Travel'),
(773, 1, 'PT. Ubudiyah Travel Aviation', 'PT Yalamlam Wisata', '', '', 'PT Yalamlam Wisata'),
(774, 1, 'PT. Ubudiyah Travel Aviation', 'PT Nuansa Tour & Travel', '', '', 'PT Nuansa Tour & Travel'),
(775, 1, 'PT. Ubudiyah Travel Aviation', 'PT Alam Tari Tour & Travel', '', '', 'PT Alam Tari Tour & Travel'),
(776, 1, 'PT. Ubudiyah Travel Aviation', 'PT Mangat Usaha Wisata', '', '', 'PT Mangat Usaha Wisata');

-- --------------------------------------------------------

--
-- Table structure for table `pelabuhan`
--

CREATE TABLE `pelabuhan` (
  `id` int(30) NOT NULL,
  `nm_bandara` varchar(100) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_negara` int(50) NOT NULL,
  `id_provinsi` int(50) NOT NULL,
  `id_kota` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelabuhan`
--

INSERT INTO `pelabuhan` (`id`, `nm_bandara`, `kode`, `keterangan`, `id_negara`, `id_provinsi`, `id_kota`) VALUES
(1, 'Ulee Lheue', 'BANDA ACEH', 'ok', 1, 1, 1),
(3, 'Balohan', 'SABANG', 'ok', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` int(12) NOT NULL,
  `id_transaksi` int(12) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL,
  `jenis_penumpang` int(5) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `id_transaksi`, `nama_penumpang`, `jenis_penumpang`, `created`) VALUES
(1, 1, 'qwerw', 1, '2020-01-06 08:27:39'),
(2, 1, 'tjgj', 2, '2020-01-06 08:27:39'),
(3, 2, 'qwerw', 1, '2020-01-06 08:33:33'),
(4, 2, 'tjgj', 2, '2020-01-06 08:33:33'),
(5, 3, 'qwerw', 1, '2020-01-06 10:39:51'),
(6, 3, 'tjgj', 2, '2020-01-06 10:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(15) NOT NULL,
  `nm_provinsi` varchar(50) NOT NULL,
  `id_negara` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nm_provinsi`, `id_negara`) VALUES
(1, 'Aceh', 1),
(2, 'Selangor', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(50) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `waktu` time NOT NULL,
  `dari` varchar(10) NOT NULL,
  `tujuan` varchar(10) NOT NULL,
  `id_kapal` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `kode`, `tgl_berangkat`, `waktu`, `dari`, `tujuan`, `id_kapal`) VALUES
(4, 'UB125', '2020-01-23', '08:00:00', 'KUL', 'BTJ', 1),
(5, 'UB126', '2019-12-28', '10:30:00', 'KUL', 'BTJ', 1),
(6, 'UB127', '2019-12-23', '10:40:00', 'BTJ', 'KUL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(255) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `id_mitra` int(255) NOT NULL,
  `id_customer` int(255) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_hrg` bigint(20) NOT NULL,
  `url_bayar` text NOT NULL,
  `tipe_bayar` varchar(255) NOT NULL,
  `status_bayar` enum('success','pending','challenge','settlement','denied','expired') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode`, `id_mitra`, `id_customer`, `tgl_transaksi`, `total_hrg`, `url_bayar`, `tipe_bayar`, `status_bayar`) VALUES
(1, 'IB0Q3P', 777, 1, '2020-01-06 08:27:39', 40000, '', '', 'pending'),
(2, 'FN5FMK', 777, 2, '2020-01-06 08:33:33', 40000, '', '', 'pending'),
(3, 'HLKNWT', 777, 3, '2020-01-06 10:39:51', 40000, '', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1577775065, 1, 'Admin', 'istrator', '', ''),
(3, '::1', 'kanatour1', '$2y$08$094tMSZdU.hxJ8CrWys9feD.vbzbQWwFtE3qLL8tNgsCruSHnELTu', NULL, 'kanatour12@gmail.com', NULL, NULL, NULL, NULL, 1534687046, 1535380566, 1, 'kanatour', 'kanatour', '', ''),
(4, '::1', 'umum', '$2y$08$P8swppweLL.70S0Rf7Jgs.8IddlHYOG1rrViBMVkG0LTXPMhWp2w6', NULL, 'umum@gmail.com', NULL, NULL, NULL, NULL, 1535387336, 1535387344, 1, 'umum', 'umum', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 1),
(14, 2, 2),
(17, 3, 2),
(6, 4, 2),
(18, 4, 3),
(8, 5, 4),
(9, 6, 4),
(10, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_orgs`
--

CREATE TABLE `users_orgs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_orgs`
--

INSERT INTO `users_orgs` (`id`, `user_id`, `org_id`) VALUES
(2, 1, 1),
(13, 2, 768),
(15, 3, 771),
(6, 4, 1),
(16, 4, 770),
(8, 5, 766),
(9, 6, 769),
(10, 7, 768);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_tiket`
--
ALTER TABLE `detail_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_menus`
--
ALTER TABLE `groups_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `jenis_penumpang`
--
ALTER TABLE `jenis_penumpang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `m_config`
--
ALTER TABLE `m_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orgs`
--
ALTER TABLE `orgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelabuhan`
--
ALTER TABLE `pelabuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`),
  ADD KEY `jenis_penumpang` (`jenis_penumpang`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_mitra` (`id_mitra`),
  ADD KEY `id_penumpang` (`id_customer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_orgs`
--
ALTER TABLE `users_orgs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`org_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`org_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_tiket`
--
ALTER TABLE `detail_tiket`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups_menus`
--
ALTER TABLE `groups_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `jenis_penumpang`
--
ALTER TABLE `jenis_penumpang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_tiket`
--
ALTER TABLE `jenis_tiket`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kapal`
--
ALTER TABLE `kapal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'this is ID for menus', AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_config`
--
ALTER TABLE `m_config`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=778;

--
-- AUTO_INCREMENT for table `pelabuhan`
--
ALTER TABLE `pelabuhan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id_penumpang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_orgs`
--
ALTER TABLE `users_orgs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
