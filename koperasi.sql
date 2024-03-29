-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2024 pada 16.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(45) NOT NULL,
  `alamat_anggota` varchar(45) NOT NULL,
  `tgl_lahir_anggota` datetime NOT NULL,
  `nik_anggota` int(11) NOT NULL,
  `gender_anggota` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_tlpn_anggota` int(11) NOT NULL,
  `email_anggota` varchar(45) NOT NULL,
  `password_anggota` varchar(255) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_anggota` varchar(45) NOT NULL,
  `role_anggota` enum('anggota','bendahara') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `nama_anggota`, `alamat_anggota`, `tgl_lahir_anggota`, `nik_anggota`, `gender_anggota`, `no_tlpn_anggota`, `email_anggota`, `password_anggota`, `create_by`, `create_time`, `status_anggota`, `role_anggota`) VALUES
(1, 'Anos Voldigoad', '', '0000-00-00 00:00:00', 0, 'Laki-Laki', 0, 'anos@admin.com', '$2y$10$FGRmDatbeUuyFiER1HDADOsWvskUBGIRVcNOxm6kni8khaa4M8w8u', 0, '2024-01-09 19:11:18', '', 'bendahara'),
(2, 'Putri', '', '0000-00-00 00:00:00', 0, 'Laki-Laki', 0, 'putri@gmail.com', '$2y$10$Qu5FhDhT4xIFdoUO23HFieSizzq2AksvMZXQyi/TAm9e9QzQPOj9S', 0, '2024-01-09 19:12:32', '', 'bendahara'),
(3, 'siraj nurul bil haq', '', '0000-00-00 00:00:00', 0, 'Laki-Laki', 0, 'myadmin@admin.com', '$2y$10$yuJ0hW3z1MZd/Tt6h0EFWetVA.aDvBPsOK2rbuUUezCRhACrYaloG', 0, '2024-01-09 19:41:54', '', 'anggota'),
(4, 'test', '', '0000-00-00 00:00:00', 0, 'Laki-Laki', 0, 'test@gmail.com', '$2y$10$iSQwTnN.Vw2FyQnC2zwAUuhBpJFlSFHMA9YtE0n8zYTJBX11ihrnq', 0, '2024-01-09 21:59:49', '', 'anggota'),
(5, 'Priman', '', '0000-00-00 00:00:00', 0, 'Laki-Laki', 0, 'priman@gmail.com', '$2y$10$5pvDubny1N8aeWzkCTLcmOBjkezK.lNX6jwWZqYawzzWxaMo7yF3K', 0, '2024-01-12 14:26:15', '', 'anggota');

--
-- Trigger `tbl_anggota`
--
DELIMITER $$
CREATE TRIGGER `tr_register_simpanan` AFTER INSERT ON `tbl_anggota` FOR EACH ROW BEGIN
    -- Mendapatkan nilai ID anggota yang baru saja diinsert
    DECLARE new_id_anggota INT;
    SET new_id_anggota = NEW.id_anggota;

    -- Mengisi data ke dalam tbl_simpanan
    INSERT INTO tbl_simpanan (id_anggota, jml_simpanan, tgl_simpanan)
    VALUES (new_id_anggota, 0, NOW()); -- Ubah nilai default jml_simpanan sesuai kebutuhan
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran_pinjaman`
--

CREATE TABLE `tbl_pembayaran_pinjaman` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `jml_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pembayaran_pinjaman`
--

INSERT INTO `tbl_pembayaran_pinjaman` (`id_pembayaran`, `id_pinjaman`, `tgl_pembayaran`, `jml_pembayaran`) VALUES
(20, 20, '2024-01-11', 50000),
(21, 21, '2024-01-11', 50000),
(22, 22, '2024-01-12', 1000000),
(23, 23, '2024-01-12', 500000),
(24, 24, '2024-01-12', 0);

--
-- Trigger `tbl_pembayaran_pinjaman`
--
DELIMITER $$
CREATE TRIGGER `update_status_pinjaman` AFTER UPDATE ON `tbl_pembayaran_pinjaman` FOR EACH ROW BEGIN
    DECLARE total_pembayaran INT;
    DECLARE total_pinjaman INT;

    -- Get the total pembayaran for the corresponding pinjaman
    SELECT SUM(jml_pembayaran) INTO total_pembayaran
    FROM tbl_pembayaran_pinjaman
    WHERE id_pinjaman = NEW.id_pinjaman;

    -- Get the total pinjaman amount
    SELECT jml_pinjaman INTO total_pinjaman
    FROM tbl_pinjaman
    WHERE id_pinjaman = NEW.id_pinjaman;

    -- Check if the total_pembayaran is equal to total_pinjaman
    IF total_pembayaran = total_pinjaman THEN
        -- Update status_pinjaman to 'Lunas'
        UPDATE tbl_pinjaman
        SET status_pinjaman = 'Lunas'
        WHERE id_pinjaman = NEW.id_pinjaman;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjaman`
--

CREATE TABLE `tbl_pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jml_pinjaman` int(11) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `status_pinjaman` enum('Belum Lunas','Lunas','Diproses') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pinjaman`
--

INSERT INTO `tbl_pinjaman` (`id_pinjaman`, `id_anggota`, `jml_pinjaman`, `tgl_pinjaman`, `status_pinjaman`) VALUES
(20, 4, 50000, '2024-01-11', 'Lunas'),
(21, 4, 50000, '2024-01-11', 'Lunas'),
(22, 2, 1000000, '2024-01-12', 'Lunas'),
(23, 2, 500000, '2024-01-12', 'Lunas'),
(24, 2, 1000000, '2024-01-12', 'Belum Lunas');

--
-- Trigger `tbl_pinjaman`
--
DELIMITER $$
CREATE TRIGGER `tr_byr_pinjaman` AFTER INSERT ON `tbl_pinjaman` FOR EACH ROW BEGIN
    -- Mendapatkan nilai ID anggota yang baru saja diinsert
    DECLARE new_id_pinjaman INT;
    SET new_id_pinjaman = NEW.id_pinjaman;

    -- Mengisi data ke dalam tbl_simpanan
    INSERT INTO tbl_pembayaran_pinjaman (id_pinjaman, jml_pembayaran, tgl_pembayaran)
    VALUES (new_id_pinjaman, 0, NOW()); -- Ubah nilai default jml_simpanan sesuai kebutuhan
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_simpanan`
--

CREATE TABLE `tbl_simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jml_simpanan` int(11) NOT NULL,
  `tgl_simpanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_simpanan`
--

INSERT INTO `tbl_simpanan` (`id_simpanan`, `id_anggota`, `jml_simpanan`, `tgl_simpanan`) VALUES
(1, 3, 100000, '2024-01-09 21:53:57'),
(2, 2, 1500000, '2024-01-09 22:58:06'),
(3, 3, 0, '2024-01-09 22:58:25'),
(4, 4, 250000, '2024-01-10 04:59:49'),
(5, 5, 1000000, '2024-01-12 21:26:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tbl_pembayaran_pinjaman`
--
ALTER TABLE `tbl_pembayaran_pinjaman`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indeks untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_pinjaman`
--
ALTER TABLE `tbl_pembayaran_pinjaman`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran_pinjaman`
--
ALTER TABLE `tbl_pembayaran_pinjaman`
  ADD CONSTRAINT `tbl_pembayaran_pinjaman_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `tbl_pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD CONSTRAINT `tbl_pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tbl_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  ADD CONSTRAINT `tbl_simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tbl_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
