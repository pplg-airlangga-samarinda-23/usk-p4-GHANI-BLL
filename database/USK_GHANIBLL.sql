-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 10:31 PM
-- Server version: 8.0.44-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `USK_GHANIBLL`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `stok`) VALUES
(2, 'laskar pelangi', 'andrea hinata', 0),
(3, 'SIkancil', 'Gio Reynaldi', 5),
(4, 'Negeri 5 Menara', 'Koni Maise', 9),
(5, 'Dilan 1990', 'Pidi Baiq', 11),
(6, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 11),
(7, 'Hoolu', 'Supriyanto', 5),
(8, 'Burn out', 'Young Lex', 9),
(9, 'Comet', 'Dalingo', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id` int NOT NULL,
  `id_buku` int NOT NULL,
  `id_user` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id`, `id_buku`, `id_user`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(3, 2, 4, '2026-01-28', NULL, 'dipinjam'),
(4, 6, 4, '2026-01-28', NULL, 'dipinjam'),
(5, 2, 7, '2026-01-28', NULL, 'dipinjam'),
(6, 2, 7, '2026-01-28', NULL, 'dipinjam'),
(7, 3, 4, '2026-01-28', NULL, 'dipinjam'),
(8, 3, 8, '2026-01-28', NULL, 'dipinjam'),
(9, 3, 6, '2026-01-28', '2026-01-31', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','siswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(5, 'tes', '$2y$10$4ylSPlkQSlQQFi.J8yK5iu/itz3FFIi3OBJeGhCJezuaFfaDChoqC', 'siswa'),
(7, 'magang', '$2y$10$USoxir/HWctXPtgcNb9squZQH0RApAsUhnc3wY3mUFxLhSQ9QjlMy', 'siswa'),
(8, 'cinta', '$2y$10$OzGk7BoxX/2cprGF.pqAteXB0IrScK8RD08gP/IWErdKHEJMQpDCC', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
