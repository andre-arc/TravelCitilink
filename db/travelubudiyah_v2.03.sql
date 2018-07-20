-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2018 at 07:54 AM
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
-- Database: `travelubudiyah_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara`
--

CREATE TABLE `bandara` (
  `id` int(30) NOT NULL,
  `nm_bandara` varchar(100) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_negara` int(50) NOT NULL,
  `id_provinsi` int(50) NOT NULL,
  `id_kota` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bandara`
--

INSERT INTO `bandara` (`id`, `nm_bandara`, `kode`, `keterangan`, `id_negara`, `id_provinsi`, `id_kota`) VALUES
(1, 'Sultan iskandar muda', 'BTJ', '11', 1, 1, 1),
(3, 'Bandar Udara Internasional Kuala Lumpur', 'KUL', 'ok', 2, 2, 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'operator', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menus`
--

CREATE TABLE `groups_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `akses` tinyint(1) UNSIGNED DEFAULT 1,
  `tambah` tinyint(1) UNSIGNED DEFAULT 0,
  `ubah` tinyint(1) UNSIGNED DEFAULT 0,
  `hapus` tinyint(1) UNSIGNED DEFAULT 0
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
(80, 1, 54, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'this is ID for menus',
  `parent_id` int(10) UNSIGNED DEFAULT 0,
  `path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT 'glyphicon glyphicon-tasks',
  `list_order` int(3) DEFAULT 0,
  `remark` text DEFAULT NULL,
  `flag` enum('draft','publish') DEFAULT 'draft'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `path`, `name`, `icon`, `list_order`, `remark`, `flag`) VALUES
(1, 0, '#', 'SETTINGS', 'fa fa-cogs', 18, 'Auth. Control List', 'publish'),
(2, 1, 'acl/orgs/', 'ORGS', 'fa fa-university', 2, 'Organisations', 'publish'),
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
(54, 53, 'transaksi/', 'DATA TRANSAKSI', 'fa fa-angle-right', 0, '', 'publish');

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
  `stock_tbg` varchar(50) NOT NULL,
  `description` text DEFAULT NULL COMMENT 'Desc. Org'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`id`, `parent_id`, `parent_name`, `name`, `no_reg`, `alamat_pkl`, `stock_tbg`, `description`) VALUES
(1, 0, '', 'Pusat', '1234', '', '0', 'PT. Taman Midi Anggun Pusat'),
(768, 1, 'Suwadaya GAS', 'Pangkalan Suwadaya GAS', '1212321312', 'Banda Aceh', '55', 'Suwadaya GAS');

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
  `kode_pnr` varchar(100) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `waktu` time NOT NULL,
  `dari` varchar(10) NOT NULL,
  `tujuan` varchar(10) NOT NULL,
  `maskapai` varchar(100) NOT NULL,
  `jml_seat` varchar(100) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `kode_pnr`, `tgl_berangkat`, `waktu`, `dari`, `tujuan`, `maskapai`, `jml_seat`, `harga`) VALUES
(2, 'UB123', '2018-07-19', '10:10:00', 'BTJ', 'KUL', 'Citilink[QGK]', '178', '1900000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(255) NOT NULL,
  `id_mitra` int(255) NOT NULL,
  `id_penumpang` int(255) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_hrg` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1532072144, 1, 'Admin', 'istrator', '', ''),
(2, '125.161.107.194', 'swadaya', '$2y$08$veXXS7c33RkaX7tmBxux3OREcBnbOP5AEHZ98JhZw8G2240z0twya', NULL, 'swadaya@gmail.com', NULL, NULL, NULL, NULL, 1523085329, 1524536188, 1, 'swadaya', '', '', '');

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
(13, 2, 2),
(4, 3, 3),
(6, 4, 2),
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
(12, 2, 768),
(4, 3, 1),
(6, 4, 1),
(8, 5, 766),
(9, 6, 769),
(10, 7, 768);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandara`
--
ALTER TABLE `bandara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `id_transaksi` (`id_transaksi`);

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
-- Indexes for table `keys`
--
ALTER TABLE `keys`
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
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

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
  ADD KEY `id_penumpang` (`id_penumpang`);

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
-- AUTO_INCREMENT for table `bandara`
--
ALTER TABLE `bandara`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups_menus`
--
ALTER TABLE `groups_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'this is ID for menus', AUTO_INCREMENT=55;

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
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=770;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id_penumpang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_orgs`
--
ALTER TABLE `users_orgs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
