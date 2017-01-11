-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2017 at 07:55 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `ket`) VALUES
(1, 'Barang A', ''),
(2, 'Barang B', ''),
(3, 'Barang C', '');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL DEFAULT '0',
  `provinsi` varchar(100) NOT NULL DEFAULT '0',
  `telepon` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL DEFAULT '0',
  `provinsi` varchar(100) NOT NULL DEFAULT '0',
  `telepon` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `kota`, `provinsi`, `telepon`, `email`) VALUES
(1, 'Customer A', 'jalan', 'Purwokerto', 'Jawa Tengah', '08999', '');

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
(1, 'administrator', 'Administrator'),
(2, 'Karyawan', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `motif_keluar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `created_on`, `motif_keluar_id`, `user_id`) VALUES
(1, '2016-11-10 21:49:44', 2, 1),
(2, '2016-11-12 05:28:10', 1, 1),
(3, '2016-11-14 10:32:10', 3, 1),
(4, '2016-11-14 10:42:45', 4, 1);

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `segment1` varchar(50) NOT NULL DEFAULT '0',
  `segment2` varchar(50) DEFAULT NULL,
  `segment3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(9, 'Transaksi Mutasi Masuk', 'mutasi_masuk', NULL, NULL),
(10, 'Transaksi Mutasi Keluar', 'mutasi_keluar', NULL, NULL),
(11, 'Transaksi Return Mutasi', 'return_mutasi', NULL, NULL),
(12, 'Laporan', 'laporan', NULL, NULL),
(13, 'Stok Opname', 'stok_opname', NULL, NULL),
(14, 'Histori Pesanan Cust', 'histori', 'pesanan_cust', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `motif`
--

CREATE TABLE `motif` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `ket` text NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif`
--

INSERT INTO `motif` (`id`, `nama`, `qty`, `harga`, `ket`, `type_id`, `barang_id`) VALUES
(1, 'Motif A', 200, 0, '-', 0, 0),
(2, 'Motif B', 0, 0, '', 0, 0),
(3, 'Motif C', 78, 4000, '', 1, 0),
(4, 'Motif D', 5, 4000, 'adasdasd', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `motif_barang`
--

CREATE TABLE `motif_barang` (
  `id` int(11) NOT NULL,
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif_barang`
--

INSERT INTO `motif_barang` (`id`, `motif_id`, `barang_id`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 2, 3),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `motif_keluar`
--

CREATE TABLE `motif_keluar` (
  `id` int(11) NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `tersimpan` varchar(5) NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif_keluar`
--

INSERT INTO `motif_keluar` (`id`, `created_on`, `tanggal`, `customer_id`, `user_id`, `tersimpan`) VALUES
(1, '2017-01-11 10:18:06', '2017-01-02', 1, 1, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `motif_keluar_detail`
--

CREATE TABLE `motif_keluar_detail` (
  `id` int(11) NOT NULL,
  `motif_keluar_id` int(11) NOT NULL DEFAULT '0',
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) DEFAULT NULL,
  `motif` varchar(100) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  `ket` text,
  `promo` varchar(5) DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif_keluar_detail`
--

INSERT INTO `motif_keluar_detail` (`id`, `motif_keluar_id`, `motif_id`, `barang_id`, `type_id`, `nama`, `motif`, `qty`, `harga`, `subtotal`, `ket`, `promo`) VALUES
(1, 1, 1, 2, 1, 'Motif A', 'Motif A', 10, 0, 0, NULL, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `motif_masuk`
--

CREATE TABLE `motif_masuk` (
  `id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `lampiran_surat_jalan` varchar(100) DEFAULT NULL,
  `tersimpan` varchar(5) NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif_masuk`
--

INSERT INTO `motif_masuk` (`id`, `created_on`, `tanggal`, `supplier_id`, `user_id`, `lampiran_surat_jalan`, `tersimpan`) VALUES
(9, '2016-12-24 19:35:28', '2016-12-24', 1, 1, '7c0f5-dev.png', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `motif_masuk_detail`
--

CREATE TABLE `motif_masuk_detail` (
  `id` int(11) NOT NULL,
  `motif_masuk_id` int(11) NOT NULL DEFAULT '0',
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `subtotal` int(11) NOT NULL DEFAULT '0',
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motif_masuk_detail`
--

INSERT INTO `motif_masuk_detail` (`id`, `motif_masuk_id`, `motif_id`, `barang_id`, `type_id`, `nama`, `qty`, `harga`, `subtotal`, `ket`) VALUES
(13, 9, 1, 1, 1, 'Motif A', 100, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `beli` int(11) NOT NULL DEFAULT '0',
  `gratis` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `motif_id`, `beli`, `gratis`) VALUES
(1, 1, 5, 2),
(2, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tersimpan` varchar(5) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`id`, `created_on`, `tanggal`, `customer_id`, `user_id`, `tersimpan`) VALUES
(1, '2016-12-27 09:03:47', '2016-12-14', 1, 1, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `return_detail`
--

CREATE TABLE `return_detail` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `qty` int(5) NOT NULL DEFAULT '0',
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_out`
--

CREATE TABLE `return_out` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_out`
--

INSERT INTO `return_out` (`id`, `return_id`, `created_on`, `user_id`) VALUES
(1, 3, '2016-12-17 15:55:50', 1),
(2, 4, '2016-12-24 19:03:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stok_opname`
--

CREATE TABLE `stok_opname` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `stok_sebelum` int(11) NOT NULL DEFAULT '0',
  `stok_sesudah` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `kota`, `provinsi`, `telepon`, `email`) VALUES
(1, 'Supplier A', '-', 'Purwokerto', 'Jateng', '0888', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id` int(11) NOT NULL,
  `motif_keluar_id` int(11) NOT NULL DEFAULT '0',
  `status_kirim` varchar(50) NOT NULL DEFAULT '0',
  `ship_to` varchar(100) NOT NULL DEFAULT '-',
  `nama_penerima` varchar(100) NOT NULL DEFAULT '-',
  `nama_customer` varchar(100) NOT NULL DEFAULT '-',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id`, `motif_keluar_id`, `status_kirim`, `ship_to`, `nama_penerima`, `nama_customer`, `created_on`, `user_id`) VALUES
(1, 2, 'ship_to', 'gfjgfjhgh', 'kghgh', 'Customer A', '2016-12-17 15:49:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT '0',
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `nama`, `ket`) VALUES
(1, 'A', '<p>\r\n	ini tipe A</p>\r\n');

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
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1484104587, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'karyawan', '$2y$08$cvDIDO5y51ngpuo80qQoiOlmOm3cp.e2t23HNspeaxeAfgejc/LKa', NULL, 'karyawan@asda.com', NULL, NULL, NULL, NULL, 1478661265, 1478663271, 1, 'karyawan', '-', '-', '000');

-- --------------------------------------------------------

--
-- Table structure for table `users_access`
--

CREATE TABLE `users_access` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `post_array` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(28, '2016-12-17 13:17:55', 1, 'http://localhost:2808/inventory/master/barang/index/insert', 'Admin istrator telah menambahkan barang sfsdf (4)', '{"nama":"sfsdf","harga":"234234234","type_id":"1","kode":"","qty":""}'),
(29, '2016-12-17 13:18:15', 1, 'http://localhost:2808/inventory/master/barang/index/delete/4', 'Admin istrator telah menghapus barang 4 ()', '"4"'),
(30, '2016-12-17 14:35:39', 1, 'http://localhost:2808/inventory/master/motif/index/update/1', 'Admin istrator telah mengedit motif Motif A (1)', '{"nama":"Motif A","qty":"","harga":"","ket":"-"}'),
(31, '2016-12-17 14:38:17', 1, 'http://localhost:2808/inventory/master/barang/index/update/1', 'Admin istrator telah mengedit barang Barang A (1)', '{"nama":"Barang A","type_id":"1"}'),
(32, '2016-12-17 14:54:01', 1, 'http://localhost:2808/inventory/master/motif/index/insert', 'Admin istrator telah menambahkan motif Motif C (3)', '{"nama":"Motif C","harga":"4000","ket":"","type_id":"1"}'),
(33, '2016-12-17 15:07:25', 1, 'http://localhost:2808/inventory/master/promo/index/update/1', 'ID User ''1'''' telah mengedit promo ''1''', '{"motif_id":"1","beli":"5","gratis":"2"}'),
(34, '2016-12-17 15:14:03', 1, 'http://localhost:2808/inventory/stok_opname/stok/update/3', 'Admin istrator mengubah stok barang Barang C (3) dari  menjadi 80', '{"qty":"80"}'),
(35, '2016-12-17 15:26:44', 1, 'http://localhost:2808/inventory/master/promo/index/insert', 'ID User ''1'' telah menambahkan promo ''2''', '{"motif_id":"3","beli":"5","gratis":"1"}'),
(36, '2016-12-17 15:28:43', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier ', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":null,"supplier_id":null}'),
(37, '2016-12-17 15:34:58', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier ', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":null,"supplier_id":null}'),
(38, '2016-12-17 15:36:16', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"5","motif_masuk_id":"4","motif_id":"3","nama":"Motif C","qty":"5","harga":"4000","subtotal":"20000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"4","supplier_id":"1"}'),
(39, '2016-12-17 15:42:39', 1, 'http://localhost:2808/inventory/motif_keluar/simpan', 'Admin istrator telah menambahkan motif keluar dengan customer Customer A', '{"motif_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"3","motif_keluar_id":"2","motif_id":"3","nama":"Motif C","motif":"Motif C","qty":"6","harga":"4000","subtotal":"20000","ket":null,"promo":"tidak"},{"id":"4","motif_keluar_id":"2","motif_id":"3","nama":"Motif C","motif":null,"qty":"1","harga":"0","subtotal":"0","ket":"PROMO","promo":"ya"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_keluar_id":"2","customer_id":"1"}'),
(40, '2016-12-17 15:55:44', 1, 'http://localhost:2808/inventory/return_motif/simpan', 'Admin istrator telah menambahkan motif keluar dengan customer Customer A', '{"return_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"1","return_id":"3","motif_id":"3","nama":"Motif C","qty":"8","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"return_id":"3"}'),
(41, '2016-12-17 16:26:03', 1, 'http://localhost:2808/inventory/master/motif/index/insert', 'Admin istrator telah menambahkan motif Motif D (4)', '{"nama":"Motif D","harga":"4000","type_id":"1","barang_id":"2","ket":"adasdasd"}'),
(42, '2016-12-19 11:43:56', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"7","motif_masuk_id":"5","motif_id":"4","barang_id":"2","type_id":"1","nama":"Motif D","qty":"2","harga":"4000","subtotal":"8000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"5","supplier_id":"1"}'),
(43, '2016-12-19 11:44:04', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"8","motif_masuk_id":"6","motif_id":"4","barang_id":"2","type_id":"1","nama":"Motif D","qty":"4","harga":"4000","subtotal":"16000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"6","supplier_id":"1"}'),
(44, '2016-12-19 11:44:33', 1, 'http://localhost:2808/inventory/motif_keluar/simpan', 'Admin istrator telah menambahkan motif keluar dengan customer Customer A', '{"motif_keluar_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"5","motif_keluar_id":"3","motif_id":"4","barang_id":"2","type_id":"1","nama":"Motif D","motif":"Motif D","qty":"6","harga":"4000","subtotal":"24000","ket":null,"promo":"tidak"}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_keluar_id":"3","customer_id":"1"}'),
(45, '2016-12-21 08:11:31', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"11","motif_masuk_id":"7","motif_id":"4","barang_id":"2","type_id":"1","nama":"Motif D","qty":"5","harga":"4000","subtotal":"20000","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"7","supplier_id":"1"}'),
(46, '2016-12-24 19:03:15', 1, 'http://localhost:2808/inventory/return_motif/simpan', 'Admin istrator telah menambahkan motif keluar dengan customer Customer A', '{"return_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"2","return_id":"4","motif_id":"3","barang_id":"1","type_id":"1","nama":"Motif C","qty":"5","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"return_id":"4"}'),
(47, '2016-12-24 19:08:02', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"12","motif_masuk_id":"8","motif_id":"1","barang_id":"1","type_id":"1","nama":"Motif A","qty":"100","harga":"0","subtotal":"0","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"8","supplier_id":"1"}'),
(48, '2016-12-24 19:36:23', 1, 'http://localhost:2808/inventory/motif_masuk/simpan', 'Admin istrator telah menambahkan motif masuk dengan supplier Supplier A', '{"motif_masuk_detail":{"conn_id":{"affected_rows":null,"client_info":null,"client_version":null,"connect_errno":null,"connect_error":null,"errno":null,"error":null,"error_list":null,"field_count":null,"host_info":null,"info":null,"insert_id":null,"server_info":null,"server_version":null,"stat":null,"sqlstate":null,"protocol_version":null,"thread_id":null,"warning_count":null},"result_id":{"current_field":null,"field_count":null,"lengths":null,"num_rows":null,"type":null},"result_array":[],"result_object":[{"id":"13","motif_masuk_id":"9","motif_id":"1","barang_id":"1","type_id":"1","nama":"Motif A","qty":"100","harga":"0","subtotal":"0","ket":null}],"custom_result_object":[],"current_row":0,"num_rows":null,"row_data":null},"motif_masuk_id":"9","supplier_id":"1"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
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
-- Indexes for table `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motif_barang`
--
ALTER TABLE `motif_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motif_keluar`
--
ALTER TABLE `motif_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motif_keluar_detail`
--
ALTER TABLE `motif_keluar_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motif_masuk`
--
ALTER TABLE `motif_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motif_masuk_detail`
--
ALTER TABLE `motif_masuk_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_detail`
--
ALTER TABLE `return_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_out`
--
ALTER TABLE `return_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_access`
--
ALTER TABLE `users_access`
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
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `motif`
--
ALTER TABLE `motif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `motif_barang`
--
ALTER TABLE `motif_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `motif_keluar`
--
ALTER TABLE `motif_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `motif_keluar_detail`
--
ALTER TABLE `motif_keluar_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `motif_masuk`
--
ALTER TABLE `motif_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `motif_masuk_detail`
--
ALTER TABLE `motif_masuk_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `return_detail`
--
ALTER TABLE `return_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_out`
--
ALTER TABLE `return_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_access`
--
ALTER TABLE `users_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
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
