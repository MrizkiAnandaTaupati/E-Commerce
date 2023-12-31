-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Agu 2023 pada 20.36
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_tika`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(30) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `nama_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `nama_admin`) VALUES
(1, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'Rizki Ananda'),
(2, 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', 'Cantika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `isi_chat` text NOT NULL,
  `pengirim_chat` enum('pelanggan','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_pelanggan`, `id_admin`, `isi_chat`, `pengirim_chat`) VALUES
(10, 2, 0, 'pagi kak, apa stok bandeng prestonya masih ada?', 'pelanggan'),
(11, 2, 1, 'masih kak,silahkan diorder', 'admin'),
(12, 7, 0, 'halo kak stik tulang bandengnya masih ada?', 'pelanggan'),
(13, 7, 1, 'masih kak', 'admin'),
(14, 3, 0, 'halo kak', 'pelanggan'),
(15, 3, 0, 'halo', 'pelanggan'),
(16, 3, 0, 'halo', 'pelanggan'),
(17, 3, 0, 'halo', 'pelanggan'),
(18, 3, 0, 'hai', 'pelanggan'),
(19, 3, 0, 'hai', 'pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Frozen Food'),
(2, 'Makanan basah'),
(3, 'Makanan Kering');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pelanggan`, `id_produk`, `jumlah`) VALUES
(1, 9, 22, 1),
(2, 9, 20, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `jk_pelanggan` enum('laki laki','perempuan') NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `hp_pelanggan` varchar(15) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `jk_pelanggan`, `alamat_pelanggan`, `hp_pelanggan`, `email_pelanggan`) VALUES
(1, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'Rizki Ananda', 'laki laki', 'Jogja', '085236416597', 'rizki@gmail.com'),
(2, 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 'Cantika', 'perempuan', 'Juwana', '085236416597', 'tika@gmail.com'),
(3, 'user3', '0b7f849446d3383546d15a480966084442cd2193', 'Erika', 'perempuan', 'Kudus', '085236416597', 'erika@gmail.com'),
(4, 'user4', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e', 'Anton', 'laki laki', 'Semarang', '085236416597', 'anton@gmail.com'),
(5, 'user5', '7d112681b8dd80723871a87ff506286613fa9cf6', 'Sari', 'perempuan', 'Juwana', '089765476234', 'sarii@gmail.com'),
(6, 'user6', '312a46dc52117efa4e3096eda510370f01c83b27', 'Jessica', 'perempuan', 'Pati', '081234675891', 'jessica@gmail.com'),
(7, 'user7', '7bdeecc97cf8f9b9188ba2751aa1755dad9ff819', 'Cika', 'perempuan', 'Juwana', '081233564325', 'cika@gmail.com'),
(8, 'user8', 'a14c955bda572b817deccc3a2135cc5f2518c1d3', 'Cici', 'perempuan', 'Kudus', '081234566782', 'cici@gmail.com'),
(9, 'user9', '86f28434210631fa6bda6db990aba7391f512774', 'Chiko', 'laki laki', 'Semarang', '085432777665', 'chiko@gmail.com'),
(10, 'user10', 'd089da97b9e447158a0466d15fe291f2c43b982e', 'Moza', 'perempuan', 'Demak', '081444678541', 'moza@gmail.com'),
(11, 'user11', '3d5cbfed48ce23d2f0dc0a0baa3ec2ee93867b2b', 'Nancy', 'perempuan', 'Salatiga', '089661542376', 'nancy@gmail.com'),
(12, 'user12', 'e45ed40f34005e1636649ab18bbd16ada02cb251', 'Prita', 'perempuan', 'Kudus', '081435677221', 'prita@gmail.com'),
(13, 'user13', 'd6fa2beb1c302491b40f447d8784fc0bcce1ca8e', 'Draco', 'laki laki', 'Demak', '085677543981', 'draco@gmail.com'),
(14, 'user14', 'be17881e010a71c3fa3f4e9650242341c764b39a', 'Kania', 'perempuan', 'Pati', '081655772345', 'kania@gmail.com'),
(15, 'user15', '5de2a2a23e0b3beee08b75a6b0c0cd3847f0d7be', 'Arimbi', 'perempuan', 'Semarang', '089111564786', 'arimbi@gmail.com'),
(16, 'user16', 'bbe2aeb4e25b2b007eb4b63d59bdf4ad6be2378b', 'Vena', 'perempuan', 'Semarang', '089854333225', 'vena@gmail.com'),
(17, 'user17', 'd47e69ada060f488a539a1383dac8275b76d9dd5', 'Riko', 'laki laki', 'Pati', '085444761222', 'riko@gmail.com'),
(18, 'user18', '5484904228e84abd75e235c359d3dcffc222583c', 'Linlin', 'perempuan', 'Kudus', '089671888542', 'linlin@gmail.com'),
(19, 'user19', '95bb0330ffec243b47d3916e7ccf507e27fd5c2d', 'Lovely', 'perempuan', 'Salatiga', '081453665776', 'lovely@gmail.com'),
(20, 'user20', '6571420001ed3ab44b515e25ccd5877195a5da6b', 'Niko', 'laki laki', 'Jepara', '085671554332', 'niko@gmail.com'),
(21, 'user21', '163314f09e8aaf4472274c78bd520d915a7a4711', 'Coba', 'perempuan', 'Semarang', '089765432123', 'ninik@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama_bayar` varchar(100) NOT NULL,
  `bank_bayar` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama_bayar`, `bank_bayar`, `tanggal_bayar`, `jumlah_bayar`, `bukti_bayar`) VALUES
(22, 49, 'Prita', 'Mandiri', '2023-06-21', 32000, 'rolls-royce.jpg20230621090213'),
(23, 51, 'Kania', 'BCA', '2023-06-21', 71000, 'Picture111.png20230621092839'),
(24, 59, 'Cantika', 'cod', '2023-06-21', 50000, '20230621103454'),
(25, 63, 'Jessica', 'cod', '2023-06-21', 46000, '20230621104441'),
(26, 64, 'Cika', 'BRI', '2023-06-21', 153000, 'buktitf.jpg'),
(27, 57, 'Niko', 'cod', '2023-06-21', 83000, '20230621113357'),
(28, 56, 'Lovely', 'BNI', '2023-06-21', 71000, 'rolls-royce.jpg20230621151827'),
(29, 55, 'Linlin', 'Mandiri', '2023-06-21', 60000, 'Picture11.png20230621152953'),
(30, 54, 'Riko', 'BRI', '2023-06-22', 87000, 'rolls-royce.jpg20230621192206'),
(31, 48, 'Nancy', 'cod', '2023-06-22', 26000, '20230621192606'),
(32, 65, 'Erika', 'Mandiri', '2023-06-25', 20000, 'buktitf.jpg20230625125415'),
(33, 66, 'Erika', 'cod', '2023-06-25', 108000, '20230625130447'),
(34, 71, 'Anton', 'BCA', '2023-07-23', 31000, 'iphone.jpg20230723162957'),
(35, 72, 'Anton', 'transfer', '2023-07-24', 33000, 'rolls-royce.jpg20230724052815'),
(36, 73, 'Anton', 'BCA', '2023-07-24', 438000, 'astonmartin.jpg20230724054807'),
(37, 74, 'Coba', 'BCA', '2023-07-24', 220000, 'Picture111.png20230724060259');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `batas_pembayaran` datetime NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `status_pembelian` enum('pending','lunas','kirim','selesai','batal') NOT NULL,
  `metode_pembayaran` enum('transfer','cod') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `batas_pembayaran`, `total_pembelian`, `status_pembelian`, `metode_pembayaran`) VALUES
(43, 8, '2023-06-21 13:06:18', '2023-06-22 13:06:18', 31000, 'pending', 'transfer'),
(44, 9, '2023-06-21 13:09:28', '2023-06-22 13:09:28', 51000, 'batal', 'cod'),
(46, 10, '2023-06-21 13:24:58', '2023-06-22 13:24:58', 39000, 'pending', 'transfer'),
(47, 10, '2023-06-21 13:26:50', '2023-06-22 13:26:50', 51000, 'pending', 'transfer'),
(48, 11, '2023-06-21 13:35:53', '2023-06-22 13:35:53', 26000, 'kirim', 'cod'),
(49, 12, '2023-06-21 13:48:43', '2023-06-22 13:48:43', 32000, 'lunas', 'transfer'),
(50, 13, '2023-06-21 14:04:28', '2023-06-22 14:04:28', 48000, 'pending', 'cod'),
(51, 14, '2023-06-21 14:19:51', '2023-06-22 14:19:51', 71000, 'kirim', 'transfer'),
(52, 15, '2023-06-21 14:39:06', '2023-06-22 14:39:06', 37000, 'pending', 'transfer'),
(53, 16, '2023-06-21 14:43:51', '2023-06-22 14:43:51', 52000, 'pending', 'cod'),
(54, 17, '2023-06-21 15:12:17', '2023-06-22 15:12:17', 87000, 'selesai', 'transfer'),
(55, 18, '2023-06-21 15:18:59', '2023-06-22 15:18:59', 60000, 'kirim', 'transfer'),
(56, 19, '2023-06-21 15:20:50', '2023-06-22 15:20:50', 71000, 'kirim', 'transfer'),
(57, 20, '2023-06-21 15:22:12', '2023-06-22 15:22:12', 83000, 'selesai', 'cod'),
(58, 1, '2023-06-21 15:23:49', '2023-06-22 15:23:49', 47000, 'batal', 'transfer'),
(59, 2, '2023-06-21 15:30:58', '2023-06-22 15:30:58', 50000, 'kirim', 'cod'),
(60, 3, '2023-06-21 15:37:11', '2023-06-22 15:37:11', 80000, 'batal', 'transfer'),
(61, 4, '2023-06-21 15:38:50', '2023-06-22 15:38:50', 86000, 'pending', 'cod'),
(62, 5, '2023-06-21 15:40:20', '2023-06-22 15:40:20', 95000, 'batal', 'transfer'),
(63, 6, '2023-06-21 15:41:52', '2023-06-22 15:41:52', 46000, 'lunas', 'cod'),
(64, 7, '2023-06-21 15:47:11', '2023-06-22 15:47:11', 153000, 'kirim', 'transfer'),
(65, 3, '2023-06-25 17:41:09', '2023-06-26 17:41:09', 20000, 'lunas', 'transfer'),
(66, 3, '2023-06-25 17:59:32', '2023-06-26 17:59:32', 108000, 'lunas', 'cod'),
(67, 5, '2023-07-02 13:19:10', '2023-07-03 13:19:10', 62000, 'batal', 'transfer'),
(68, 4, '2023-07-02 13:48:12', '2023-07-03 13:48:12', 56000, 'batal', 'transfer'),
(69, 6, '2023-07-02 13:50:20', '2023-07-03 13:50:20', 62000, 'pending', 'cod'),
(70, 4, '2023-07-21 22:09:37', '2023-07-22 22:09:37', 26000, 'batal', 'transfer'),
(71, 4, '2023-07-23 21:26:11', '2023-07-24 21:26:11', 31000, 'lunas', 'transfer'),
(72, 4, '2023-07-24 10:26:17', '2023-07-25 10:26:17', 33000, 'lunas', 'transfer'),
(73, 4, '2023-07-24 10:45:51', '2023-07-25 10:45:51', 438000, 'lunas', 'transfer'),
(74, 21, '2023-07-24 11:01:45', '2023-07-25 11:01:45', 220000, 'lunas', 'transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `nama_beli` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `berat_beli` int(11) NOT NULL,
  `subharga_beli` int(11) NOT NULL,
  `subberat_beli` int(11) NOT NULL,
  `rating_produk` int(11) NOT NULL,
  `ulasan_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah_beli`, `nama_beli`, `harga_beli`, `berat_beli`, `subharga_beli`, `subberat_beli`, `rating_produk`, `ulasan_produk`) VALUES
(54, 43, 17, 1, 'Stik Tulang Bandeng', 16000, 100, 16000, 100, 0, ''),
(55, 44, 15, 1, 'Frozen Empek-Empek Bandeng', 21000, 150, 21000, 150, 0, ''),
(56, 44, 14, 1, 'Frozen Otak-Otak Bandeng', 19000, 150, 19000, 150, 0, ''),
(59, 46, 19, 1, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 0, ''),
(60, 46, 20, 1, 'Keripik Duri Bandeng', 18000, 100, 18000, 100, 0, ''),
(61, 47, 19, 1, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 0, ''),
(62, 47, 8, 1, 'Frozen Bakso Bandeng', 21000, 150, 21000, 150, 0, ''),
(63, 48, 19, 1, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 0, ''),
(64, 49, 23, 1, 'Galantin Bandeng', 15000, 150, 15000, 150, 0, ''),
(65, 50, 5, 2, 'Bandeng Crispy', 17000, 150, 34000, 300, 0, ''),
(66, 51, 12, 3, 'Frozen Cireng Bandeng', 18000, 150, 54000, 450, 0, ''),
(67, 52, 2, 1, 'Pepes bandeng', 19000, 150, 19000, 150, 0, ''),
(68, 53, 18, 2, 'Frozen Sempolan Bandeng', 20000, 100, 40000, 200, 0, ''),
(69, 54, 20, 4, 'Keripik Duri Bandeng', 18000, 100, 72000, 400, 5, 'renyah'),
(70, 55, 1, 2, 'Bandeng presto tulang lunak', 15000, 150, 30000, 300, 0, ''),
(71, 55, 16, 1, 'Frozen Bandeng Pindang Lunak', 15000, 150, 15000, 150, 0, ''),
(72, 56, 18, 2, 'Frozen Sempolan Bandeng', 20000, 100, 40000, 200, 0, ''),
(73, 56, 14, 1, 'Frozen Otak-Otak Bandeng', 19000, 150, 19000, 150, 0, ''),
(74, 57, 5, 2, 'Bandeng Crispy', 17000, 150, 34000, 300, 5, 'sangat enak dan crispy'),
(75, 57, 19, 1, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 1, 'sangat enak'),
(76, 57, 20, 1, 'Keripik Duri Bandeng', 18000, 100, 18000, 100, 0, ''),
(77, 58, 18, 2, 'Frozen Sempolan Bandeng', 20000, 100, 40000, 200, 0, ''),
(78, 59, 19, 1, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 0, ''),
(79, 59, 20, 1, 'Keripik Duri Bandeng', 18000, 100, 18000, 100, 0, ''),
(80, 60, 21, 0, 'Bandeng Rica-Rica', 26000, 150, 26000, 150, 0, ''),
(81, 60, 14, 0, 'Frozen Otak-Otak Bandeng', 19000, 150, 19000, 150, 0, ''),
(82, 61, 6, 1, 'Bandeng Matah', 18000, 150, 18000, 150, 0, ''),
(83, 61, 16, 1, 'Frozen Bandeng Pindang Lunak', 15000, 150, 15000, 150, 0, ''),
(84, 62, 6, 0, 'Bandeng Matah', 18000, 150, 18000, 150, 0, ''),
(85, 62, 5, 0, 'Bandeng Crispy', 17000, 150, 17000, 150, 0, ''),
(86, 62, 12, 0, 'Frozen Cireng Bandeng', 18000, 150, 18000, 150, 0, ''),
(87, 63, 17, 1, 'Stik Tulang Bandeng', 16000, 100, 16000, 100, 0, ''),
(88, 63, 1, 1, 'Bandeng presto tulang lunak', 15000, 150, 15000, 150, 0, ''),
(89, 64, 11, 1, 'Frozen Lumpia Bandeng', 24000, 150, 24000, 150, 0, ''),
(90, 64, 10, 1, 'Frozen Nugget Bandeng', 27000, 150, 27000, 150, 0, ''),
(91, 65, 16, 1, 'Frozen Bandeng Pindang Lunak', 15000, 150, 15000, 150, 0, ''),
(92, 66, 11, 1, 'Frozen Lumpia Bandeng', 24000, 150, 24000, 150, 0, ''),
(93, 67, 7, 0, 'Bandeng Penyet', 24000, 150, 24000, 150, 0, ''),
(94, 67, 18, 0, 'Frozen Sempolan Bandeng', 20000, 100, 20000, 100, 0, ''),
(95, 68, 3, 1, 'Bandeng Bakar', 24000, 150, 24000, 150, 0, ''),
(96, 68, 18, 1, 'Frozen Sempolan Bandeng', 20000, 100, 20000, 100, 0, ''),
(97, 69, 15, 1, 'Frozen Empek-Empek Bandeng', 21000, 150, 21000, 150, 0, ''),
(98, 69, 7, 1, 'Bandeng Penyet', 24000, 150, 24000, 150, 0, ''),
(99, 70, 19, 0, 'Kerupuk Duri Bandeng', 15000, 100, 15000, 100, 0, ''),
(100, 71, 18, 1, 'Frozen Sempolan Bandeng', 20000, 100, 20000, 100, 0, ''),
(101, 72, 24, 1, 'Tahu Bakso Bandeng', 21000, 100, 21000, 100, 0, ''),
(102, 73, 1, 10, 'Bandeng presto tulang lunak', 15000, 150, 150000, 1500, 0, ''),
(103, 74, 24, 5, 'Tahu Bakso Bandeng', 21000, 100, 105000, 500, 0, ''),
(104, 74, 19, 5, 'Kerupuk Duri Bandeng', 15000, 100, 75000, 500, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `hp_penerima` varchar(15) NOT NULL,
  `provinsi_penerima` varchar(100) NOT NULL,
  `distrik_penerima` varchar(100) NOT NULL,
  `tipe_penerima` enum('kota','kabupaten') NOT NULL,
  `kodepos_penerima` varchar(20) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `ekspedisi_pengiriman` varchar(100) NOT NULL,
  `paket_pengiriman` varchar(100) NOT NULL,
  `estimasi_pengiriman` varchar(100) NOT NULL,
  `berat_pengiriman` int(11) NOT NULL,
  `ongkos_pengiriman` int(11) NOT NULL,
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pembelian`, `nama_penerima`, `hp_penerima`, `provinsi_penerima`, `distrik_penerima`, `tipe_penerima`, `kodepos_penerima`, `alamat_penerima`, `ekspedisi_pengiriman`, `paket_pengiriman`, `estimasi_pengiriman`, `berat_pengiriman`, `ongkos_pengiriman`, `resi_pengiriman`) VALUES
(44, 43, 'Cici', '081234566782', 'Jawa Tengah', 'Kudus', 'kabupaten', '59311', 'Kudus', 'JNE', 'REG', '4-5', 100, 15000, ''),
(45, 44, 'Chiko', '085432777665', 'Jawa Tengah', 'Semarang', 'kabupaten', '50511', 'Semarang', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 300, 11000, ''),
(46, 45, 'Moza', '081444678541', 'DI Yogyakarta', 'Yogyakarta', 'kota', '55111', 'Jogja', '', '', '', 250, 0, ''),
(47, 46, 'Moza', '081444678541', 'DI Yogyakarta', 'Sleman', 'kabupaten', '55513', 'Sleman,Jogja', 'POS INDONESIA', 'Pos Reguler', '2 HARI', 200, 6000, ''),
(48, 47, 'Moza', '081444678541', 'Jawa Tengah', 'Demak', 'kabupaten', '59519', 'Demak', 'JNE', 'REG', '4-5', 250, 15000, ''),
(49, 48, 'Nancy', '089661542376', 'Jawa Tengah', 'Semarang', 'kabupaten', '50511', 'Salatiga', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 100, 11000, '21PTN000012365'),
(50, 49, 'Prita', '081435677221', 'Jawa Barat', 'Bekasi', 'kota', '17121', 'Bekasi', 'JNE', 'OKE', '4-5', 150, 17000, ''),
(51, 50, 'Draco', '085677543981', 'Jawa Timur', 'Surabaya', 'kota', '60119', 'Surabaya', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 300, 14000, ''),
(52, 51, 'Kania', '081655772345', 'Banten', 'Tangerang', 'kota', '15111', 'Tangerang', 'JNE', 'OKE', '3-4', 450, 17000, '5416800054292318'),
(53, 52, 'Arimbi', '089111564786', 'Jawa Tengah', 'Blora', 'kabupaten', '58219', 'Blora', 'JNE', 'REG', '4-5', 150, 18000, ''),
(54, 53, 'Vena', '089854333225', 'Jawa Tengah', 'Semarang', 'kabupaten', '50511', 'Semarang', 'JNE', 'REG', '2-3', 200, 12000, ''),
(55, 54, 'Riko', '085444761222', 'DKI Jakarta', 'Jakarta Barat', 'kota', '11220', 'Jakarta Barat', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 400, 15000, '21PTN000092761'),
(56, 55, 'Linlin', '089671888542', 'Jawa Tengah', 'Kudus', 'kabupaten', '59311', 'Kudus', 'JNE', 'REG', '4-5', 450, 15000, '541680005429120'),
(57, 56, 'Lovely', '081453665776', 'Jawa Tengah', 'Kendal', 'kabupaten', '51314', 'Kendal', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 350, 12000, '21PTN0000928784'),
(58, 57, 'Niko', '085671554332', 'Jawa Barat', 'Bandung', 'kabupaten', '40311', 'Bandung', 'JNE', 'OKE', '4-5', 500, 16000, '1700112357519'),
(59, 58, 'Rizki Ananda', '085236416597', 'DI Yogyakarta', 'Yogyakarta', 'kota', '55111', 'Jogja', 'JNE', 'CTC', '1-2', 200, 7000, ''),
(60, 59, 'Cantika', '085236416597', 'Banten', 'Tangerang', 'kabupaten', '15914', 'Tangerang', 'JNE', 'OKE', '3-4', 200, 17000, '541680005429019'),
(61, 60, 'Erika', '085236416597', 'Lampung', 'Bandar Lampung', 'kota', '35139', 'Bandar Lampung', 'JNE', 'OKE', '4-5', 300, 35000, ''),
(62, 61, 'Anton', '085236416597', 'Kalimantan Barat', 'Pontianak', 'kabupaten', '78971', 'Pontianak', 'JNE', 'OKE', '7-8', 300, 53000, ''),
(63, 62, 'Sari', '089765476234', 'Kalimantan Selatan', 'Banjarmasin', 'kota', '70117', 'Banjarmasin', 'JNE', 'OKE', '4-5', 450, 42000, ''),
(64, 63, 'Jessica', '081234675891', 'Jawa Barat', 'Bogor', 'kota', '16119', 'Bogor', 'POS INDONESIA', 'Pos Reguler', '3 HARI', 250, 15000, ''),
(65, 64, 'Cika', '081233564325', 'Sulawesi Tenggara', 'Buton', 'kabupaten', '93754', 'Buton', 'JNE', 'REG', '6-7', 300, 102000, '170010063257519'),
(66, 65, 'Erika', '085236416597', 'DI Yogyakarta', 'Bantul', 'kabupaten', '55715', 'Jl.  Sorowajan, Bnguntapan, Bantul, Yogyakarta', 'JNE', 'OKE', '2-3', 150, 5000, ''),
(67, 66, 'Erika', '085236416597', 'Sulawesi Tengah', 'Palu', 'kota', '94111', 'Jl.Undata No.10, Ds. Besusu Barat, Kec.Palu, Kota Palu, Sulawesi Tengah', 'JNE', 'OKE', '5-6', 150, 84000, ''),
(68, 67, 'Sari', '089765476234', 'Jawa Barat', 'Cirebon', 'kota', '45116', 'Cirebon', 'JNE', 'REG', '2-3', 250, 18000, ''),
(69, 68, 'Anton', '085236416597', 'Jawa Tengah', 'Semarang', 'kabupaten', '50511', 'Semarang', 'JNE', 'REG', '2-3', 250, 12000, ''),
(70, 69, 'Jessica', '081234675891', 'Jawa Timur', 'Malang', 'kota', '65112', 'Malang', 'JNE', 'REG', '2-3', 300, 17000, ''),
(71, 70, 'Anton', '085236416597', 'Jawa Tengah', 'Semarang', 'kabupaten', '50511', 'Semarang', 'JNE', 'OKE', '4-5', 100, 11000, ''),
(72, 71, 'Anton', '085236416597', 'Jawa Tengah', 'Semarang', 'kota', '50135', 'Semarang', 'JNE', 'OKE', '4-5', 100, 11000, ''),
(73, 72, 'Anton', '085236416597', 'Jawa Tengah', 'Semarang', 'kota', '50135', 'Semarang', 'JNE', 'REG', '2-3', 100, 12000, ''),
(74, 73, 'Anton', '085236416597', 'Papua', 'Jayapura', 'kota', '99114', 'Semarang', 'JNE', 'OKE', '5-7', 1500, 288000, ''),
(75, 74, 'Coba', '089765432123', 'Lampung', 'Lampung Selatan', 'kabupaten', '35511', 'Lampung', 'JNE', 'OKE', '7-8', 1000, 40000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `stok_produk`, `berat_produk`, `foto_produk`) VALUES
(1, 3, 'Bandeng presto tulang lunak', 15000, 'Ikan bandeng presto yang sudah di bumbui dengan berbagai macam rempah yang sangat nikmat', -3, 150, 'bandeng.jpg'),
(2, 2, 'Pepes bandeng', 19000, 'Pepes bandeng dengan bumbu rempah yang medok dan cita rasa pedas yang khas', 9, 150, '20230414061930pepesbandengg.jpg'),
(3, 2, 'Bandeng Bakar', 24000, 'Bandeng yang dibakar dengan bumbu yang nikmat', 9, 150, '20230414062224bandengbakarr.jpg'),
(4, 2, 'Bakso Bandeng', 13000, 'Bakso yang terbuat dari ikan bandeng', 10, 150, '20230414062855baksobandeng.jpg'),
(5, 3, 'Bandeng Crispy', 17000, 'Bandeng yang digoreng dengan bumbu dan tepung', 6, 150, '20230414063118bandengcrispyy.jpg'),
(6, 2, 'Bandeng Matah', 18000, 'Bandeng yang disajikan dengan sambal matah', 9, 150, '20230414063242bandengmatah.jpg'),
(7, 2, 'Bandeng Penyet', 24000, 'Bandeng yang disajikan dengan sambal penyet', 9, 150, '20230414063503bandengpenyett.jpg'),
(8, 1, 'Frozen Bakso Bandeng', 21000, 'Bakso bandeng yang bisa digoreng kapan aja', 9, 150, '20230414063728frozenbandeng.jpg'),
(9, 1, 'Frozen Bandeng Crispy', 21000, 'Bandeng crispy yang bisa digoreng kapan aja', 10, 150, '20230414063830frozenbandengcrispy.jpg'),
(10, 1, 'Frozen Nugget Bandeng', 27000, 'Nugget bandeng yang dapat digoreng kapan saja', 9, 150, '20230414070731frozennuggetbandeng.jpg'),
(11, 1, 'Frozen Lumpia Bandeng', 24000, 'Lumpia bandeng yang dapat digoreng kapan saja', 8, 150, '20230414070836frozenlumpia.jpg'),
(12, 1, 'Frozen Cireng Bandeng', 18000, 'Cireng bandeng yang dapat digoreng kapan saja', 7, 150, '20230414070954frozencireng.jpg'),
(13, 1, 'Frozen Cilok Bandeng', 16000, 'Cilok bandeng yang dapat dimasak kapan saja', 10, 150, '20230414071115frozencilokbandeng.jpg'),
(14, 1, 'Frozen Otak-Otak Bandeng', 19000, 'Otak-otak bandeng yang dapat dimasak kapan saja', 8, 150, '20230414071232frozenotakotak.jpg'),
(15, 1, 'Frozen Empek-Empek Bandeng', 21000, 'Empek-empek bandeng yang dapat dimasak kapan saja', 8, 150, '20230414071351frozenpempek.jpg'),
(16, 1, 'Frozen Bandeng Pindang Lunak', 15000, 'Bandeng pindang lunak yang dapat dimasak kapan saja', 7, 150, '20230414071529frozenpindanglunak.jpg'),
(17, 3, 'Stik Tulang Bandeng', 16000, 'Stik dari tulang bandeng', 8, 100, '20230414073023stiktulangbandeng.jpg'),
(18, 1, 'Frozen Sempolan Bandeng', 20000, 'Sempolan terbuat dari daging bandeng', 2, 100, '20230414073134sempolanikanbandeng.jpg'),
(19, 3, 'Kerupuk Duri Bandeng', 15000, 'Kerupuk dari duri bandeng', 0, 100, '20230414073249kerupukduribandeng.jpg'),
(20, 3, 'Keripik Duri Bandeng', 18000, 'Keripik yang terbuat dari duri bandeng', 3, 100, '20230414073341keripikduribandeng.jpg'),
(21, 2, 'Bandeng Rica-Rica', 26000, 'Bandeng rica-rica yang dimasak dengan bumbu yang nikmat', 10, 150, '20230414073628bandengricaricaa.jpg'),
(22, 2, 'Garang Asem Bandeng', 25000, 'Garang asem bandeng yang diolah dengan bumbu yang nikmat', 10, 150, '20230414073953garangasembandengg.jpg'),
(23, 2, 'Galantin Bandeng', 15000, 'Galantin yang terbuat dari ikan bandeng ', 9, 150, '20230414085142galantinbandeng.jpg'),
(24, 2, 'Tahu Bakso Bandeng', 21000, 'Tahu bakso menggunakan ikan bandeng', 4, 100, '20230414090104tahubasobandengg.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `bank_rekening` varchar(50) NOT NULL,
  `nomor_rekening` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `bank_rekening`, `nomor_rekening`) VALUES
(1, 'BCA', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
