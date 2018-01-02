-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Mei 2017 pada 07.37
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--
CREATE DATABASE IF NOT EXISTS `cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cart`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `summary`, `price`, `quantity`, `image`) VALUES
(1, 'Juice Blender', 'Bisa blender jus, bumbu masakan', 10, '1', 'img_1.png'),
(2, 'TV remote', 'Bisa untuk semua tv', 20, '1', 'img_2.png'),
(3, 'Sony camera', 'Kamera murah', 30, '1', 'img_3.png'),
(4, 'Iron clothes', 'Setrika baju, celana', 40, '1', 'img_4.png'),
(5, 'Washing machine', 'Mesin cuci dan penyedod debu', 50, '1', 'img_5.png'),
(6, 'Air purifier', 'Pendingin ruangan', 60, '1', 'img_6.jpg'),
(7, 'Water purifier', 'Pembersih air minum', 70, '1', 'img_7.jpg'),
(8, 'Gas stove', 'Kompor gas', 80, '1', 'img_8.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shopping`
--

CREATE TABLE `shopping` (
  `id_user` int(2) NOT NULL,
  `id` int(11) NOT NULL,
  `amount_quantity` varchar(10) NOT NULL,
  `amount_price` double NOT NULL,
  `order_number` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(2) NOT NULL,
  `name_user` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name_user`) VALUES
(1, 'Tedir Ghazali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`id_user`,`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
