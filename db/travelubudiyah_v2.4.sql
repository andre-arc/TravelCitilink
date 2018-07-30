-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2018 at 03:41 PM
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
(23, 7, '001', 'YALMALAM UJI COBA', 'Perempuan', 'LAMSEUPENG', '08116809077', 'deasy_deasy2002@yahoo.com'),
(26, 1, '', 'haha1', '', '', '45803953', 'haha@gmail.com');

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

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `hrg_tiket` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_tiket`, `id_transaksi`, `hrg_tiket`) VALUES
(1, 2, 1, 0),
(2, 2, 2, 1900000),
(3, 2, 3, 1900000),
(4, 2, 4, 1900000);

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
(80, 1, 54, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
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
  `jml_kas` bigint(20) NOT NULL,
  `description` text COMMENT 'Desc. Org'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`id`, `parent_id`, `parent_name`, `name`, `no_reg`, `alamat_pkl`, `jml_kas`, `description`) VALUES
(1, 0, '', 'Pusat', '1234', '', 0, 'PT. Taman Midi Anggun Pusat'),
(768, 1, 'Pusat', 'Mitra Agen A', '1212321312', 'Banda Aceh', -1950000, 'Mitra Agen A');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` int(12) NOT NULL,
  `id_transaksi` int(12) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `kewarganegaraan` int(5) NOT NULL,
  `no_passport` int(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `id_transaksi`, `nama_penumpang`, `tgl_lahir`, `nik`, `kewarganegaraan`, `no_passport`, `created`) VALUES
(1, 4, 'haha1', '04-07-2018', '234234', 1, 234234, '2018-07-27 09:32:26');

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
  `id_customer` int(255) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_hrg` bigint(20) NOT NULL,
  `konfirmasi_bayar` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_mitra`, `id_customer`, `tgl_transaksi`, `total_hrg`, `konfirmasi_bayar`) VALUES
(1, 1, 1, '2018-07-22 14:37:31', 1950000, 0),
(2, 1, 24, '2018-07-27 09:27:33', 1900000, 0),
(3, 1, 25, '2018-07-27 09:28:04', 1900000, 0),
(4, 1, 26, '2018-07-27 09:32:26', 1900000, 0);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `konfirmasi_bayar` AFTER UPDATE ON `transaksi` FOR EACH ROW if (new.konfirmasi_bayar = 1) THEN
update orgs set orgs.jml_kas=orgs.jml_kas-new.total_hrg WHERE orgs.id=new.id_mitra;
end if
$$
DELIMITER ;

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
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1532788815, 1, 'Admin', 'istrator', '', ''),
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
-- Indexes for table `data_kas`
--
ALTER TABLE `data_kas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bandara`
--
ALTER TABLE `bandara`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_kas`
--
ALTER TABLE `data_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=770;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id_penumpang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
