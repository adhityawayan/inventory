-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2016 at 06:23 AM
-- Server version: 5.6.14-log
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode`, `nama`, `qty`, `harga`, `type_id`) VALUES
(1, NULL, 'Barang A', 15, 202020, 1),
(2, NULL, 'Barang B', 0, 8000, 1),
(3, NULL, 'Barang C', 0, 90000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `tersimpan` varchar(5) NOT NULL DEFAULT 'belum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `created_on`, `tanggal`, `customer_id`, `user_id`, `tersimpan`) VALUES
(1, '2016-11-22 22:41:44', '2016-11-16', 1, 1, 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar_detail`
--

CREATE TABLE IF NOT EXISTS `barang_keluar_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_keluar_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) DEFAULT NULL,
  `motif` varchar(100) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  `ket` text,
  `promo` varchar(5) DEFAULT 'tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `barang_keluar_detail`
--

INSERT INTO `barang_keluar_detail` (`id`, `barang_keluar_id`, `barang_id`, `nama`, `motif`, `qty`, `harga`, `subtotal`, `ket`, `promo`) VALUES
(1, 1, 1, 'Barang A', NULL, 5, 202020, 1010100, NULL, 'tidak'),
(2, 1, 1, 'Barang A', NULL, 1, 0, 0, 'PROMO', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `lampiran_surat_jalan` varchar(100) DEFAULT NULL,
  `tersimpan` varchar(5) NOT NULL DEFAULT 'belum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `created_on`, `tanggal`, `supplier_id`, `user_id`, `lampiran_surat_jalan`, `tersimpan`) VALUES
(1, '2016-11-22 22:39:57', '2016-11-15', 1, 1, 'a1d9f-tulips.jpg', 'sudah'),
(2, '2016-11-24 12:04:47', '2016-11-17', 1, 1, NULL, 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk_detail`
--

CREATE TABLE IF NOT EXISTS `barang_masuk_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_masuk_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `barang_masuk_detail`
--

INSERT INTO `barang_masuk_detail` (`id`, `barang_masuk_id`, `barang_id`, `nama`, `qty`, `harga`, `subtotal`, `ket`) VALUES
(1, 1, 1, 'Barang A', 11, 202020, 2222220, NULL),
(2, 2, 1, 'Barang A', 10, 202020, 2020200, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_motif`
--

CREATE TABLE IF NOT EXISTS `barang_motif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `motif_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `barang_motif`
--

INSERT INTO `barang_motif` (`id`, `barang_id`, `motif_id`) VALUES
(1, 3, 1),
(2, 1, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL DEFAULT '0',
  `provinsi` varchar(100) NOT NULL DEFAULT '0',
  `telepon` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL DEFAULT '0',
  `provinsi` varchar(100) NOT NULL DEFAULT '0',
  `telepon` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `kota`, `provinsi`, `telepon`, `email`) VALUES
(1, 'Customer A', 'jalan', 'Purwokerto', 'Jawa Tengah', '08999', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'administrator', 'Administrator'),
(2, 'Karyawan', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barang_keluar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `created_on`, `barang_keluar_id`, `user_id`) VALUES
(1, '2016-11-10 21:49:44', 2, 1),
(2, '2016-11-12 05:28:10', 1, 1),
(3, '2016-11-14 10:32:10', 3, 1),
(4, '2016-11-14 10:42:45', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `segment1` varchar(50) NOT NULL DEFAULT '0',
  `segment2` varchar(50) DEFAULT NULL,
  `segment3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `nama`, `segment1`, `segment2`, `segment3`) VALUES
(1, 'Master Barang', 'master', 'barang', '0'),
(2, 'Master Type', 'master', 'type', NULL),
(3, 'Master Motif', 'master', 'motif', NULL),
(4, 'Master Supplier', 'master', 'supplier', NULL),
(5, 'Master Customer', 'master', 'customer', NULL),
(7, 'Master Company', 'master', 'company', NULL),
(8, 'Master Promo', 'master', 'promo', NULL),
(9, 'Transaksi Barang Masuk', 'barang_masuk', NULL, NULL),
(10, 'Transaksi Barang Keluar', 'barang_keluar', NULL, NULL),
(11, 'Transaksi Return Barang', 'return_barang', NULL, NULL),
(12, 'Laporan', 'laporan', NULL, NULL),
(13, 'Stok Opname', 'stok_opname', NULL, NULL),
(14, 'Histori Pesanan Cust', 'histori', 'pesanan_cust', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `motif`
--

CREATE TABLE IF NOT EXISTS `motif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `ket` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `motif`
--

INSERT INTO `motif` (`id`, `nama`, `ket`) VALUES
(1, 'Motif A', '-'),
(2, 'Motif B', '');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `beli` int(11) NOT NULL DEFAULT '0',
  `gratis` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `barang_id`, `beli`, `gratis`) VALUES
(1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tersimpan` varchar(5) DEFAULT 'belum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `return_detail`
--

CREATE TABLE IF NOT EXISTS `return_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(5) NOT NULL DEFAULT '0',
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `return_out`
--

CREATE TABLE IF NOT EXISTS `return_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_opname`
--

CREATE TABLE IF NOT EXISTS `stok_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `stok_sebelum` int(11) NOT NULL DEFAULT '0',
  `stok_sesudah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `kota`, `provinsi`, `telepon`, `email`) VALUES
(1, 'Supplier A', '-', 'Purwokerto', 'Jateng', '0888', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_keluar_id` int(11) NOT NULL DEFAULT '0',
  `status_kirim` varchar(50) NOT NULL DEFAULT '0',
  `ship_to` varchar(100) NOT NULL DEFAULT '-',
  `nama_penerima` varchar(100) NOT NULL DEFAULT '-',
  `nama_customer` varchar(100) NOT NULL DEFAULT '-',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT '0',
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `nama`, `ket`) VALUES
(1, 'A', '<p>\r\n	ini tipe A</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1479960379, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'karyawan', '$2y$08$cvDIDO5y51ngpuo80qQoiOlmOm3cp.e2t23HNspeaxeAfgejc/LKa', NULL, 'karyawan@asda.com', NULL, NULL, NULL, NULL, 1478661265, 1478663271, 1, 'karyawan', '-', '-', '000');

-- --------------------------------------------------------

--
-- Table structure for table `users_access`
--

CREATE TABLE IF NOT EXISTS `users_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users_access`
--

INSERT INTO `users_access` (`id`, `user_id`, `menu_id`) VALUES
(3, 1, 1),
(11, 2, 12),
(12, 2, 1),
(13, 2, 9),
(14, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(13, 1, 1),
(18, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE IF NOT EXISTS `users_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `post_array` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `datetime`, `user_id`, `url`, `keterangan`, `post_array`) VALUES
(1, '2016-11-12 05:28:01', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","barang_keluar_id":"1","barang_id":"1","nama":"Barang A","qty":"8","harga":"20000","subtotal":"160000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"1","customer_id":"1"}'),
(2, '2016-11-12 05:44:43', 1, 'http://localhost:2808/inventory/barang_masuk/simpan', 'Admin istrator telah menambahkan barang masuk dengan supplier Supplier A', '{"barang_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","barang_masuk_id":"1","barang_id":"1","nama":"Barang A","qty":"9","harga":"20000","subtotal":"180000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_masuk_id":"1","supplier_id":"1"}'),
(3, '2016-11-12 06:13:24', 1, 'http://localhost:2808/inventory/master/promo/index/insert', 'ID User ''1'' telah menambahkan promo ''1''', '{"barang_id":"1","beli":"5","gratis":"1"}'),
(4, '2016-11-12 06:30:05', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"32","harga":"20000","subtotal":"600000","ket":null},{"id":"3","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"6","harga":"20000","subtotal":"600000","ket":"PROMO"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"2","customer_id":"1"}'),
(5, '2016-11-12 06:35:18', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"32","harga":"20000","subtotal":"600000","ket":null,"promo":"tidak"},{"id":"4","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"6","harga":"20000","subtotal":"600000","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"2","customer_id":"1"}'),
(6, '2016-11-12 06:36:35', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"32","harga":"20000","subtotal":"600000","ket":null,"promo":"tidak"},{"id":"5","barang_keluar_id":"2","barang_id":"1","nama":"Barang A","qty":"6","harga":"20000","subtotal":"120000","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"2","customer_id":"1"}'),
(7, '2016-11-14 10:31:15', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"6","barang_keluar_id":"3","barang_id":"1","nama":"Barang A","qty":"8","harga":"20000","subtotal":"160000","ket":null,"promo":"tidak"},{"id":"7","barang_keluar_id":"3","barang_id":"1","nama":"Barang A","qty":"2","harga":"0","subtotal":"0","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"3","customer_id":"1"}'),
(8, '2016-11-14 10:34:06', 1, 'http://localhost:2808/inventory/return_barang/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer ', '{"return_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","return_id":"1","barang_id":"1","nama":"Barang A","qty":"2","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"return_id":"1"}'),
(9, '2016-11-14 10:42:40', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"8","barang_keluar_id":"4","barang_id":"1","nama":"Barang A","qty":"14","harga":"20000","subtotal":"140000","ket":null,"promo":"tidak"},{"id":"9","barang_keluar_id":"4","barang_id":"1","nama":"Barang A","qty":"2","harga":"0","subtotal":"0","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"4","customer_id":"1"}'),
(10, '2016-11-14 11:04:01', 1, 'http://localhost:2808/inventory/return_barang/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"return_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","return_id":"2","barang_id":"1","nama":"Barang A","qty":"8","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"return_id":"2"}'),
(11, '2016-11-21 22:49:54', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"10","barang_keluar_id":"5","barang_id":"1","nama":"Barang A","motif":"Motif A","qty":"8","harga":"20000","subtotal":"160000","ket":"hjihjk","promo":"tidak"},{"id":"11","barang_keluar_id":"5","barang_id":"1","nama":"Barang A","motif":null,"qty":"1","harga":"0","subtotal":"0","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"5","customer_id":"1"}'),
(12, '2016-11-22 00:00:56', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"12","barang_keluar_id":"6","barang_id":"1","nama":"Barang A","motif":"Motif A","qty":"2","harga":"20000","subtotal":"40000","ket":null,"promo":"tidak"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"6","customer_id":"1"}'),
(13, '2016-11-22 20:55:19', 1, 'http://localhost:2808/inventory/master/barang/index/insert', 'Admin istrator telah menambahkan barang Barang B (2)', '{"nama":"Barang B","harga":"8000","type_id":"1","kode":"","qty":""}'),
(14, '2016-11-22 20:56:18', 1, 'http://localhost:2808/inventory/master/barang/index/insert', 'Admin istrator telah menambahkan barang Barang C (3)', '{"nama":"Barang C","harga":"1000000","type_id":"1","kode":"","qty":""}'),
(15, '2016-11-22 21:02:13', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"20000","type_id":"1","kode":"","qty":"1362"}'),
(16, '2016-11-22 21:06:39', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"90000","type_id":"1","kode":"","qty":"1362"}'),
(17, '2016-11-22 21:06:54', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"210000","type_id":"1","kode":"","qty":"1362"}'),
(18, '2016-11-22 21:07:09', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"90000","type_id":"1","kode":"","qty":"1362"}'),
(19, '2016-11-22 21:07:25', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"202020","type_id":"1","kode":"","qty":"1362"}'),
(20, '2016-11-22 21:09:18', 1, 'http://localhost:2808/inventory/master/motif/index/insert', 'Admin istrator telah menambahkan motif Motif B (2)', '{"nama":"Motif B","ket":""}'),
(21, '2016-11-22 21:10:03', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","harga":"202020","type_id":"1","kode":"","qty":"1362"}'),
(22, '2016-11-22 21:10:18', 1, 'http://localhost:2808/inventory/master/barang/index/update/3', 'Admin istrator telah mengedit barang Barang C (3)', '{"nama":"Barang C","harga":"90000","type_id":"1","kode":"","qty":"0"}'),
(23, '2016-11-22 21:41:27', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"13","barang_keluar_id":"7","barang_id":"3","nama":"Barang C","motif":null,"qty":"7","harga":"90000","subtotal":"630000","ket":null,"promo":"tidak"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"7","customer_id":"1"}'),
(24, '2016-11-22 22:30:21', 1, 'http://localhost:2808/inventory/barang_masuk/simpan', 'Admin istrator telah menambahkan barang masuk dengan supplier Supplier A', '{"barang_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","barang_masuk_id":"1","barang_id":"2","nama":"Barang B","qty":"10","harga":"8000","subtotal":"80000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_masuk_id":"1","supplier_id":"1"}'),
(25, '2016-11-22 22:38:38', 1, 'http://localhost:2808/inventory/barang_masuk/simpan', 'Admin istrator telah menambahkan barang masuk dengan supplier Supplier A', '{"barang_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","barang_masuk_id":"2","barang_id":"1","nama":"Barang A","qty":"18","harga":"202020","subtotal":"3636360","ket":null},{"id":"3","barang_masuk_id":"2","barang_id":"3","nama":"Barang C","qty":"20","harga":"90000","subtotal":"1800000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_masuk_id":"2","supplier_id":"1"}'),
(26, '2016-11-22 22:41:28', 1, 'http://localhost:2808/inventory/barang_masuk/simpan', 'Admin istrator telah menambahkan barang masuk dengan supplier Supplier A', '{"barang_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","barang_masuk_id":"1","barang_id":"1","nama":"Barang A","qty":"11","harga":"202020","subtotal":"2222220","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_masuk_id":"1","supplier_id":"1"}'),
(27, '2016-11-22 22:55:32', 1, 'http://localhost:2808/inventory/barang_keluar/simpan', 'Admin istrator telah menambahkan barang keluar dengan customer Customer A', '{"barang_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","barang_keluar_id":"1","barang_id":"1","nama":"Barang A","motif":null,"qty":"5","harga":"202020","subtotal":"1010100","ket":null,"promo":"tidak"},{"id":"2","barang_keluar_id":"1","barang_id":"1","nama":"Barang A","motif":null,"qty":"1","harga":"0","subtotal":"0","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_keluar_id":"1","customer_id":"1"}'),
(28, '2016-11-24 12:05:01', 1, 'http://localhost/inventory/barang_masuk/simpan', 'Admin istrator telah menambahkan barang masuk dengan supplier Supplier A', '{"barang_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","barang_masuk_id":"2","barang_id":"1","nama":"Barang A","qty":"10","harga":"202020","subtotal":"2020200","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"barang_masuk_id":"2","supplier_id":"1"}');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
