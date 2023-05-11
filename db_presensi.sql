-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2023 pada 10.21
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cabang`
--

CREATE TABLE `tbl_cabang` (
  `id` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `alamat_cabang` varchar(100) NOT NULL,
  `lokasi_cabang` varchar(100) NOT NULL,
  `radius_absensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_cabang`
--

INSERT INTO `tbl_cabang` (`id`, `nama_cabang`, `alamat_cabang`, `lokasi_cabang`, `radius_absensi`) VALUES
(1, 'kantor induk usp', 'brodong lamongan', '-6.872487203207259, 112.28034471225683', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `nik` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `agama` varchar(10) NOT NULL,
  `menikah` enum('S','B') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`nik`, `nama`, `alamat`, `tgl_lahir`, `jk`, `agama`, `menikah`, `username`, `password`, `no_telpon`, `status`, `foto`, `id_jabatan`, `id_cabang`) VALUES
('35241010070002', 'M. ARIF TUNGKY', 'TAJI MADURAN LAMONGAN', '1994-07-10', 'L', 'ISLAM', 'B', 'endo', 'persib15', '085708196506', 1, 'endo.png', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `foto_masuk` varchar(100) NOT NULL,
  `foto_pulang` varchar(100) NOT NULL,
  `lokasi_masuk` varchar(100) NOT NULL,
  `lokasi_pulang` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `terlambat` int(11) NOT NULL,
  `jml_terlambat` int(11) NOT NULL,
  `sift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id`, `nik`, `tgl_presensi`, `jam_masuk`, `jam_pulang`, `foto_masuk`, `foto_pulang`, `lokasi_masuk`, `lokasi_pulang`, `status`, `terlambat`, `jml_terlambat`, `sift`) VALUES
(3, '35241010070002', '2023-05-11', '15:13:18', '00:00:00', '35241010070002-2023-05-11-M.png', 'avatar.jpg', '-6.872962466839669,112.27924709558843', '', 0, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
