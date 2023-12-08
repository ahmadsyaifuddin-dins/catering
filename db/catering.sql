-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Jul 2017 pada 08.48
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE IF NOT EXISTS `detail_pesanan` (
`id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpicateringuserng data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `produk_id`, `qty`, `pesanan_id`) VALUES
(1, 4, 5, 1),
(2, 7, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_pembayaran`
--

CREATE TABLE IF NOT EXISTS `info_pembayaran` (
`id` int(11) NOT NULL,
  `info` longtext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `info_pembayaran`
--

INSERT INTO `info_pembayaran` (`id`, `info`) VALUES
(2, 'Transaksi pembayaran bisa di bayar DP 50% dulu sebelum H-1 ,jika tidak maka transaksi akan di batalkan .\r\n\r\nUntuk pembayaran bisa di lakukan ke no rekening :\r\n\r\nBNI : 038625363873 /an Eko iswanto  \r\n\r\natau hubungi (085714957809)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE IF NOT EXISTS `kategori_produk` (
`id` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`, `deskripsi`) VALUES
(6, 'Tumis', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya'),
(7, 'Lalap', 'Lalap adalah sayur-sayuran yang biasa disajikan beserta masakan  Lalap menyerupai salad.'),
(8, 'Makanan penutup', 'Makanan penutup adalah bagian hidangan yang pada umumnya disajikan pada akhir makan '),
(9, 'Minuman', 'Bermacam-macam minuman'),
(10, 'Daging', 'Daging adalah bahan pangan yang sangat bermanfaat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE IF NOT EXISTS `kontak` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(200) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `subjek`, `pesan`) VALUES
(1, '', 'admin@gmail.com', '', ''),
(2, '', 'dede@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
`id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama`, `ongkir`) VALUES
(2, 'Bandung', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
`id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('pending','verified','','') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pesanan`, `id_user`, `file`, `total`, `status`, `keterangan`, `created_at`) VALUES
(2, 1, 6, '49eb6a44db57cba8d66b3404fa9f0ad4Kode Warna HTML HEX COLOR.jpg', 105000, 'verified', 'suah bayar lunas sist', '2017-05-28 23:00:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
`id` int(5) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_digunakan` datetime NOT NULL,
  `user_id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `read` enum('0','1') NOT NULL,
  `status` enum('lunas','belum lunas','','') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal_pesan`, `tanggal_digunakan`, `user_id`, `nama`, `alamat`, `kota`, `ongkir`, `telephone`, `read`, `status`) VALUES
(1, '2017-06-09 00:00:00', '2017-06-09 12:00:00', 6, 'Rofina', 'cimahibohay', 'Bandung', 30000, '9989', '0', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
`id` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `kategori_produk_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `gambar`, `harga`, `kategori_produk_id`) VALUES
(4, 'Tumis toge', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya', '49eb6a44db57cba8d66b3404fa9f0ad4cat10.jpg', '5000', 6),
(5, 'Tumis Kangkung', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya', '49eb6a44db57cba8d66b3404fa9f0ad4cat11.jpg', '5000', 6),
(7, 'Tumis Wortel', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya', '49eb6a44db57cba8d66b3404fa9f0ad4cat32.jpg', '5000', 6),
(8, 'Tumis Bihun', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya', '49eb6a44db57cba8d66b3404fa9f0ad4cat21.jpeg', '5000', 6),
(9, 'Tumis Tempe', 'Masakan dari sayuran dsb, yang digoreng sebentar (supaya lemas), lalu direbus bersama minyak dan bumbunya', '49eb6a44db57cba8d66b3404fa9f0ad4cat9.jpg', '5000', 6),
(10, 'Petai', 'Lalap adalah sayur-sayuran yang biasa disajikan beserta masakan  Lalap menyerupai salad.', '49eb6a44db57cba8d66b3404fa9f0ad4cat4.jpg', '6000', 7),
(11, 'Lalap Campuran', 'Lalap adalah sayur-sayuran yang biasa disajikan beserta masakan  Lalap menyerupai salad.', '49eb6a44db57cba8d66b3404fa9f0ad4cat5.JPG', '4000', 7),
(14, 'Agar-Agar', 'Makanan penutup adalah bagian hidangan yang pada umumnya disajikan pada akhir makan', '49eb6a44db57cba8d66b3404fa9f0ad4agar.jpg', '2000', 8),
(15, 'Puding', 'Makanan penutup adalah bagian hidangan yang pada umumnya disajikan pada akhir makan', '49eb6a44db57cba8d66b3404fa9f0ad4cat12.jpg', '2500', 8),
(16, 'Kue bolu', 'Makanan penutup adalah bagian hidangan yang pada umumnya disajikan pada akhir makan', '49eb6a44db57cba8d66b3404fa9f0ad4cat14.jpg', '1500', 8),
(17, 'Buah-Buahan', 'Makanan penutup adalah bagian hidangan yang pada umumnya disajikan pada akhir makan', '49eb6a44db57cba8d66b3404fa9f0ad4cat13.jpg', '5000', 8),
(18, 'Teh botol ', 'Minuman penyegar dahaga', '49eb6a44db57cba8d66b3404fa9f0ad4tehbotol.jpg', '4000', 9),
(19, 'Air mineral gelas', 'Minuman Air putih', '49eb6a44db57cba8d66b3404fa9f0ad4cat30.jpg', '500', 9),
(20, 'Sate sapi/ayam', 'Daging yang di tusuk menjadi beberapa bagian dan di bakar dengan bumbu kacang', '49eb6a44db57cba8d66b3404fa9f0ad4cat7.jpg', '1500', 10),
(21, 'Ayam goreng', 'Daging ayam yang di goreng dengan bumbu khas susundaan kitchen', '49eb6a44db57cba8d66b3404fa9f0ad4cat16.jpg', '7500', 10),
(22, 'Ikan Goreng', 'Ikan goreng yang di beri bumbu khas susundaan kichen', '49eb6a44db57cba8d66b3404fa9f0ad4cat17.jpg', '6000', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('user','admin') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `telephone`, `alamat`, `password`, `status`) VALUES
(1, 'Administrator', 'admin@gmail.com', '08985432330', 'Bandung', 'e00cf25ad42683b3df678c61f42c6bda', 'admin'),
(6, 'Rofina', 'dede@gmail.com', '9989', 'cimahibohay', 'c89ee91ad8cdf83841d3b743413e403a', 'user'),
(7, 'putry ', 'putry@gmail.com', '08943365657', 'Dago atas', 'dfb6911307efce22788a7f211628a4c2', 'user'),
(8, 'Dea Khadev', 'dea.kharisma11@gmail.com', '089632191939', 'admin@gmail.com', '022485071cbcf3464da3448693cd4006', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
 ADD PRIMARY KEY (`id`,`produk_id`,`pesanan_id`), ADD KEY `pesanan_id` (`pesanan_id`), ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `info_pembayaran`
--
ALTER TABLE `info_pembayaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
 ADD PRIMARY KEY (`id`,`user_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`id`,`kategori_produk_id`), ADD KEY `kategori_produk_id` (`kategori_produk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `info_pembayaran`
--
ALTER TABLE `info_pembayaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_produk_id`) REFERENCES `kategori_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
produkcatering