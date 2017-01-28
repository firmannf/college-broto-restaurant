-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Jan 2017 pada 22.20
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_resto_broto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanbaku`
--

CREATE TABLE `bahanbaku` (
  `id_bahanbaku` int(11) NOT NULL,
  `nik` varchar(21) NOT NULL,
  `nama_bahanbaku` varchar(51) NOT NULL,
  `stok` float NOT NULL,
  `satuan` varchar(31) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahanbaku`
--

INSERT INTO `bahanbaku` (`id_bahanbaku`, `nik`, `nama_bahanbaku`, `stok`, `satuan`, `tgl_masuk`, `tgl_kadaluarsa`) VALUES
(13, '10114474', 'Gula', 100, 'kilogram', '2017-01-26', '2017-01-31'),
(15, '10114474', 'Garam', 100, 'kilogram', '2017-01-28', '2017-02-28'),
(17, '10114474', 'Bawang Putih', 100, 'kilogram', '2017-01-27', '2017-01-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `pelayanan` tinyint(4) NOT NULL,
  `harga` tinyint(4) NOT NULL,
  `makanan` tinyint(4) NOT NULL,
  `minuman` tinyint(4) NOT NULL,
  `review` varchar(401) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kuesioner`
--

INSERT INTO `kuesioner` (`id_kuesioner`, `id_pesanan`, `pelayanan`, `harga`, `makanan`, `minuman`, `review`) VALUES
(1, 1, 5, 3, 5, 5, 'Mantap banget'),
(2, 2, 3, 3, 3, 3, NULL),
(3, 3, 4, 4, 4, 4, NULL),
(4, 6, 5, 1, 5, 5, 'Mantap pisan pokoknyamah, tapi mahal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `nama_meja` varchar(11) NOT NULL,
  `status` enum('Kosong','Terisi','Siap Saji','Bayar') NOT NULL DEFAULT 'Kosong'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`id_meja`, `nama_meja`, `status`) VALUES
(1, 'Meja 1', 'Bayar'),
(2, 'Meja 2', 'Terisi'),
(3, 'Meja 3', 'Terisi'),
(4, 'Meja 4', 'Terisi'),
(5, 'Meja 5', 'Terisi'),
(6, 'Meja 6', 'Kosong'),
(7, 'Meja 7', 'Kosong'),
(8, 'Meja 8', 'Kosong'),
(9, 'Meja 9', 'Kosong'),
(10, 'Meja 10', 'Kosong'),
(11, 'Meja 11', 'Kosong'),
(12, 'Meja 12', 'Kosong'),
(13, 'Meja 13', 'Kosong'),
(14, 'Meja 14', 'Kosong'),
(15, 'Meja 15', 'Kosong'),
(16, 'Meja 16', 'Kosong'),
(17, 'Meja 17', 'Kosong'),
(18, 'Meja 18', 'Kosong'),
(19, 'Meja 19', 'Kosong'),
(20, 'Meja 20', 'Terisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(51) NOT NULL,
  `foto` varchar(51) NOT NULL,
  `kategori` enum('Makanan','Minuman') NOT NULL DEFAULT 'Makanan',
  `estimasi_penyajian` tinyint(4) NOT NULL,
  `harga` double NOT NULL,
  `status` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `foto`, `kategori`, `estimasi_penyajian`, `harga`, `status`) VALUES
(1, 'Nasi Goreng', 'bbqribs.jpg', 'Makanan', 13, 22000, 'Tidak'),
(3, 'Nasi Bakar', 'nasibakar20170128135426.png', 'Makanan', 12, 12000, 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_detail`
--

CREATE TABLE `menu_detail` (
  `id_detail_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_bahanbaku` int(11) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_detail`
--

INSERT INTO `menu_detail` (`id_detail_menu`, `id_menu`, `id_bahanbaku`, `qty`) VALUES
(3, 1, 15, 1),
(6, 3, 17, 0.2),
(9, 3, 15, 1),
(10, 3, 13, 0.1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nik` varchar(21) NOT NULL,
  `nama_pegawai` varchar(31) NOT NULL,
  `password` varchar(101) NOT NULL,
  `pekerjaan` enum('Admin','Customer Service','Kasir','Koki','Pantry','Pelayan') NOT NULL DEFAULT 'Pelayan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama_pegawai`, `password`, `pekerjaan`) VALUES
('10114003', 'Evan Gilang Ramadhan', '9935d767dccd8afff816e5984b792130', 'Koki'),
('10114037', 'Berry Baltschun', 'dd3ac120bddd494cd007475d3fa4bd14', 'Customer Service'),
('10114426', 'Taufiq Nugraha', '249b7c75a418dcb7e65f23e2e66ffe10', 'Kasir'),
('10114474', 'Faisal Ishak', '16e3ec72e9cc88a1104bad58da4b26fc', 'Pantry'),
('10118888', 'Steven Gerrard', 'f4153173a45fd1f32050073addc6fd4c', 'Koki'),
('10119999', 'Diego Chelsea Costa', '30c9644542fcf608ec266b876d587cd1', 'Pelayan'),
('12345', 'Broto', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nik` varchar(21) DEFAULT NULL,
  `id_meja` int(11) NOT NULL,
  `nama_pelanggan` varchar(51) NOT NULL,
  `tgl_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_bayar` double DEFAULT '0',
  `uang_bayar` double DEFAULT '0',
  `status` enum('Bayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nik`, `id_meja`, `nama_pelanggan`, `tgl_order`, `total_bayar`, `uang_bayar`, `status`) VALUES
(1, '10114426', 1, 'Andrew', '2017-01-10 00:00:00', 39600, 100000, 'Belum Bayar'),
(2, '10114426', 1, 'Gerrrard', '2017-01-30 00:00:00', 0, 0, 'Bayar'),
(3, '10114426', 1, 'Steve', '2017-01-28 00:00:00', 0, 0, 'Bayar'),
(6, NULL, 1, 'Sanchez', '2017-01-29 12:31:20', 0, 0, 'Belum Bayar'),
(7, NULL, 5, 'Diego', '2017-01-29 02:43:15', 0, 0, 'Belum Bayar'),
(8, NULL, 20, 'Armando', '2017-01-29 03:37:23', 0, 0, 'Belum Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `status` enum('Selesai','Belum') NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_detail_pesanan`, `id_pesanan`, `id_menu`, `qty`, `status`) VALUES
(1, 1, 1, 2, 'Belum'),
(3, 6, 1, 1, 'Selesai'),
(4, 7, 1, 1, 'Belum'),
(6, 8, 1, 1, 'Belum'),
(7, 8, 3, 1, 'Selesai'),
(8, 8, 3, 3, 'Belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahanbaku`
--
ALTER TABLE `bahanbaku`
  ADD PRIMARY KEY (`id_bahanbaku`),
  ADD KEY `fk_bahanbaku_pegawai` (`nik`);

--
-- Indexes for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`),
  ADD KEY `fk_kuesioner_pesanan` (`id_pesanan`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD PRIMARY KEY (`id_detail_menu`),
  ADD KEY `fk_detail_menu` (`id_menu`),
  ADD KEY `fk_detail_menu_bahanbaku` (`id_bahanbaku`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_pesanan_pegawai` (`nik`),
  ADD KEY `fk_pesanan_meja` (`id_meja`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `fk_detail_pesanan` (`id_pesanan`),
  ADD KEY `fk_detail_pesanan_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahanbaku`
--
ALTER TABLE `bahanbaku`
  MODIFY `id_bahanbaku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu_detail`
--
ALTER TABLE `menu_detail`
  MODIFY `id_detail_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahanbaku`
--
ALTER TABLE `bahanbaku`
  ADD CONSTRAINT `fk_bahanbaku_pegawai` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD CONSTRAINT `fk_kuesioner_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD CONSTRAINT `fk_detail_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_menu_bahanbaku` FOREIGN KEY (`id_bahanbaku`) REFERENCES `bahanbaku` (`id_bahanbaku`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_meja` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pesanan_pegawai` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pesanan_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;