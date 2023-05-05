-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 11:35 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aes`
--

-- --------------------------------------------------------

--
-- Table structure for table `essay`
--

CREATE TABLE `essay` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Soal` char(120) NOT NULL,
  `Jawaban` char(150) NOT NULL,
  `Nilai` char(150) NOT NULL,
  `Foto` char(120) NOT NULL,
  `Keterangan` text NOT NULL,
  `Pilih` varchar(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `essay`
--

INSERT INTO `essay` (`id`, `Kode`, `Soal`, `Jawaban`, `Nilai`, `Foto`, `Keterangan`, `Pilih`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'PKT001', '<p>Siapakah Nama Saya</p>\r\n', '<p>Ya Saya Lah</p>\r\n', '45', '427-p6.jpg', '--', '', '2023-03-07', '2023-03-08', 'TEST', ''),
(2, 'PKT002', '<p>Rumah adalah</p>\r\n', '<p>tempat tinggal</p>\r\n', '10', '', '-', '', '2023-03-08', '', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `file_name_source` varchar(255) DEFAULT NULL,
  `file_name_finish` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `tgl_upload` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `username`, `file_name_source`, `file_name_finish`, `file_url`, `file_size`, `password`, `tgl_upload`, `status`, `keterangan`) VALUES
(34, 'admin', '48684-php.docx', '45692-php.rda', 'file_encrypt/45692-php.rda', 12.4824, '827ccb0eea8a706c', '2022-12-15 16:05:00', '2', 'data test untuk skripsi'),
(35, 'admin', '79210-php.docx', '52471-php.rda', 'file_encrypt/52471-php.rda', 12.4824, '827ccb0eea8a706c', '2022-12-15 16:07:07', '2', 'data'),
(36, 'test', '37482-proposal-skripsi-qadri-frans.doc', '43558-proposal-skripsi-qadri-frans.rda', 'file_encrypt/43558-proposal-skripsi-qadri-frans.rda', 2672, '827ccb0eea8a706c', '2023-02-20 16:15:05', '2', '12345'),
(37, 'test', '23364-inijadwalujian.pdf', '11573-inijadwalujian.rda', 'file_encrypt/11573-inijadwalujian.rda', 2.82129, '827ccb0eea8a706c', '2023-03-20 10:32:17', '2', 'ini untuk enskripsi jadwal ujian'),
(38, 'test', '85148-nama.docx', '2854-nama.rda', 'file_encrypt/2854-nama.rda', 12.417, '2afaf6b4406d421a', '2023-03-27 19:40:21', '2', 'optional'),
(39, 'test', '63717-nama.docx', '16484-nama.rda', 'file_encrypt/16484-nama.rda', 12.417, '2afaf6b4406d421a', '2023-03-27 20:57:49', '1', '23815RISKIAMALIA');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `KodePsoal` char(120) NOT NULL,
  `JadwalMulai` datetime NOT NULL,
  `JadwalSelesai` datetime NOT NULL,
  `User` char(65) NOT NULL,
  `Tanggal` date NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `Kode`, `KodePsoal`, `JadwalMulai`, `JadwalSelesai`, `User`, `Tanggal`, `Tipe`) VALUES
(8, 'ABSN001', 'PKT001', '2023-03-17 04:16:00', '2023-03-17 04:16:00', 'TEST', '2023-03-15', 'Z'),
(9, 'ABSN002', 'PKT002', '2023-03-17 04:18:00', '2023-03-17 04:18:00', 'TEST', '2023-03-17', 'Z'),
(10, 'ABSN003', 'PKT003', '2023-03-18 06:27:00', '2023-03-18 06:27:00', 'TEST', '2023-03-17', 'Z'),
(11, 'ABSN004', 'PKT004', '2023-03-15 07:10:00', '2023-03-14 05:10:00', 'TEST', '2023-03-17', 'Z'),
(12, 'ABSN005', 'PKT005', '2023-03-28 01:18:00', '2023-03-28 03:18:00', 'TEST', '2023-03-28', 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `NamaSingkat` char(120) NOT NULL,
  `Jurusan` char(120) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `Kode`, `NamaSingkat`, `Jurusan`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'JRS001', 'IPA', 'Ilmu Pengatuan Alam', '2023-03-01', '', 'TEST', ''),
(2, 'JRS002', 'IPS', 'Ilmu Pengetahuan Sosial', '2023-03-01', '2023-03-14', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Nama` char(120) NOT NULL,
  `Kelas` char(120) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `Kode`, `Nama`, `Kelas`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'K001', 'Satu', 'I', '2023-02-22', '2023-02-22', 'TEST', ''),
(2, 'K002', 'DUA (KESENIAN DAERAH)', 'II', '2023-03-15', '2023-03-15', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `NamaSingkat` char(120) NOT NULL,
  `MataPelajaran` char(120) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `Kode`, `NamaSingkat`, `MataPelajaran`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'MP001', 'Lutfi fahri, S. kom', 'Bahasa Indonesia', '2023-02-26', '2023-03-08', 'TEST', ''),
(2, 'MP002', 'Novita Sari , S. kom', 'Bahasa English', '2023-02-26', '2023-03-08', 'TEST', ''),
(3, 'MP003', 'Ilham Ramadani, SP. i', 'MateMatika', '2023-02-26', '2023-03-14', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `paketsoalpkt006`
--

CREATE TABLE `paketsoalpkt006` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Kodepg` char(120) NOT NULL,
  `Kodeessay` char(120) NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesertaujian`
--

CREATE TABLE `pesertaujian` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `NoInduk` char(120) NOT NULL,
  `NoUjian` char(120) NOT NULL,
  `KodeSiswa` char(120) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesertaujian`
--

INSERT INTO `pesertaujian` (`id`, `Kode`, `NoInduk`, `NoUjian`, `KodeSiswa`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'P001', '1070801001', '001', 'KDS001', '2023-03-01', '2023-03-01', 'TEST', 'Z'),
(2, 'P002', '1070801002', '002', 'KDS002', '2023-03-01', '', 'TEST', 'Z'),
(3, 'P001', '1070801001', '001', 'KDS001', '2023-03-14', '', 'TEST', ''),
(4, 'P002', '1070801002', '002', 'KDS002', '2023-03-14', '', 'TEST', ''),
(5, 'P003', '1865161654', '003', 'KDS003', '2023-03-15', '', 'TEST', 'Z'),
(6, 'P004', '2846516516', '004', 'KDS004', '2023-03-15', '', 'TEST', 'Z'),
(7, 'P005', '1684646546', '005', 'KDS005', '2023-03-15', '', 'TEST', 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_ganda`
--

CREATE TABLE `pilihan_ganda` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Soal` char(120) NOT NULL,
  `Kunci_jawab` char(1) NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `Foto` char(120) NOT NULL,
  `Keterangan` text NOT NULL,
  `Pilih` varchar(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pilihan_ganda`
--

INSERT INTO `pilihan_ganda` (`id`, `Kode`, `Soal`, `Kunci_jawab`, `a`, `b`, `c`, `d`, `Foto`, `Keterangan`, `Pilih`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'PKT001', '<p>Pada tumbuhan biji, Pembuahan didahului oleh penyerbukan , yaitu ......</p>\r\n', 'b', 'Adanya Persilangan sel jantan dan sel betina', 'Menempelnya serbuk sari di kepala butik', 'adanya biji', 'adanya akar yang akan menjadi tunas baru', '', '-', '', '2023-03-07', '2023-03-17', 'TEST', ''),
(2, 'PKT002', '<p>Bagian bunga yang merupakan sel kelamin betina adalah ...</p>\r\n', 'a', 'Putik', 'Kelopak', 'Mahkota', 'Serbuk Sari', '', '-', '', '2023-03-07', '', 'TEST', ''),
(3, 'PKT003', '<p>Dibawah ini merupakan perantara penyerbukan pada tumbuhan , kecuali</p>\r\n', 'd', 'air', 'angin', 'hewan', 'cahaya matahari', '', '-', '', '2023-03-07', '', 'TEST', ''),
(4, 'PKT004', '<p>Berikut ini yang bukan termasuk perkembangbiakan vegetatif alami adalah</p>\r\n', 'd', 'Umbi batang', 'Geragih', 'Cangkok', 'rhizoma', '286-p8.jpg', '-', '', '2023-03-07', '2023-03-09', 'TEST', ''),
(5, 'PKT005', '<p>Perkembang biakan vegetatif buatan, artinya perkembang biakan yang terjadi karena adanya bantuan ...</p>\r\n', 'c', 'Tumbuhan', 'Hewan', 'Manusia', 'Alam', '829-p1.png', '-', '', '2023-03-07', '', 'TEST', ''),
(6, 'PKT006', '<p>Apakah yang dimaksud matahari</p>\r\n', 'd', 'ya', 'b aja', 'c aja', 'd aja', '', '-', '', '2023-03-08', '2023-03-08', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `psoal`
--

CREATE TABLE `psoal` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Nama` char(120) NOT NULL,
  `Ukuran` char(120) NOT NULL,
  `Mapel` char(120) NOT NULL,
  `Keterangan` text NOT NULL,
  `Status` char(120) NOT NULL,
  `Kodepsoal2` varchar(65) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psoal`
--

INSERT INTO `psoal` (`id`, `Kode`, `Nama`, `Ukuran`, `Mapel`, `Keterangan`, `Status`, `Kodepsoal2`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(7, 'PKT001', 'UJIAN 2022/2023', '5', 'MP001', '-', 'Z', 'PAKET-001', '2023-03-13', '', 'TEST', 'Z'),
(8, 'PKT002', 'UJIAN N 2023', '6', 'MP002', '-', 'Z', 'PAKET-002', '2023-03-13', '', 'TEST', 'Z'),
(9, 'PKT003', 'UJIAN N Matematika 2023', '10', 'MP003', '-', 'Z', 'PAKET-003', '2023-03-14', '', 'TEST', 'Z'),
(10, 'PKT001', 'UJIAN  BAHASA INDONESIA', '5', 'MP001', '-', 'Z', 'PAKET-001', '2023-03-15', '2023-03-15', 'TEST', 'Z'),
(11, 'PKT002', 'UJIAN BAHAS ENGLISH', '5', 'MP002', '-', 'Z', 'PAKET-002', '2023-03-15', '', 'TEST', 'Z'),
(12, 'PKT003', 'UJIAN MATEMATIKA', '5', 'MP003', '-', 'Z', 'PAKET-003', '2023-03-15', '', 'TEST', 'Z'),
(13, 'PKT001', 'UJIAN  BAHASA INDONESIA 2023', '5', 'MP001', 'Ini untuk ujian yang akan mendatang, persiapkan mental murid-murid', 'Z', 'PAKET-001', '2023-03-15', '', 'TEST', 'Z'),
(14, 'PKT002', 'UJIAN BAHASA ENGLISH 2023', '5', 'MP002', 'INI UNTUK UJIAN YANG AKAN MENDATANG', 'Z', 'PAKET-002', '2023-03-15', '', 'TEST', 'Z'),
(15, 'PKT003', 'UJIAN MATEMATIKA 2023', '5', 'MP003', 'INI UNTUK UJIAN YANG AKAN MENDATANG PERSIAPKAN DIRI MURID2', 'Z', 'PAKET-003', '2023-03-15', '', 'TEST', 'Z'),
(16, 'PKT001', 'test', '1', 'MP001', '-', 'Z', 'PAKET-001', '2023-03-16', '', 'TEST', 'Z'),
(17, 'PKT002', 'test2', '5', 'MP001', '-', 'Z', 'PAKET-002', '2023-03-16', '', 'TEST', 'Z'),
(18, 'PKT001', 'UJIAN NASIONAL MATEMATIKA', '21', 'MP001', '232', 'Z', 'PAKET-001', '2023-03-16', '2023-03-16', 'TEST', 'Z'),
(19, 'PKT002', 'UJIAN NASIONAL BAHASA INDONESIA', '32', 'MP001', '23', 'Z', 'PAKET-002', '2023-03-16', '2023-03-16', 'TEST', 'Z'),
(20, 'PKT003', 'UIJAN NASIONAL ENGGLISH', '4', 'MP002', '4', 'Z', 'PAKET-003', '2023-03-16', '2023-03-16', 'TEST', 'Z'),
(21, 'PKT004', 'UJIAN MA', '5', 'MP003', '-', 'Z', 'PAKET-004', '2023-03-16', '', 'TEST', 'Z'),
(22, 'PKT005', 'test', '2', 'MP003', '', 'Z', 'PAKET-005', '2023-03-16', '', 'TEST', 'Z'),
(23, 'PKT006', 'ini', '5', 'MP001', '-', '', '', '2023-03-27', '', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `File` char(120) NOT NULL,
  `Nama` char(120) NOT NULL,
  `Nisn` char(120) NOT NULL,
  `Jk` char(165) NOT NULL,
  `TempatLahir` char(120) NOT NULL,
  `TanggalLahir` char(120) NOT NULL,
  `AnakKe` char(120) NOT NULL,
  `Alamat` char(120) NOT NULL,
  `NoHp` char(120) NOT NULL,
  `NamaAyah` char(120) NOT NULL,
  `PekerjaanAyah` char(120) NOT NULL,
  `AlamatAyah` char(120) NOT NULL,
  `NoHpAyah` char(120) NOT NULL,
  `NamaIbu` char(120) NOT NULL,
  `PekerjaanIbu` char(120) NOT NULL,
  `AlamatIbu` char(120) NOT NULL,
  `NoHpIbu` char(120) NOT NULL,
  `NamaWali` char(120) NOT NULL,
  `PekerjaanWali` char(120) NOT NULL,
  `AlamatWali` char(120) NOT NULL,
  `NoHpWali` char(120) NOT NULL,
  `TransportasiSiswa` char(120) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` char(10) NOT NULL,
  `User` char(120) NOT NULL,
  `Tipe` char(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `Kode`, `File`, `Nama`, `Nisn`, `Jk`, `TempatLahir`, `TanggalLahir`, `AnakKe`, `Alamat`, `NoHp`, `NamaAyah`, `PekerjaanAyah`, `AlamatAyah`, `NoHpAyah`, `NamaIbu`, `PekerjaanIbu`, `AlamatIbu`, `NoHpIbu`, `NamaWali`, `PekerjaanWali`, `AlamatWali`, `NoHpWali`, `TransportasiSiswa`, `created_at`, `updated_at`, `User`, `Tipe`) VALUES
(1, 'KDS001', '623-592-user.png', 'Abdul Syukur Jaelani', '0011576749', 'L', 'SIANTAR (BAHBUTONG)', '1997-03-05', '1', 'JL.TANJUNG MULIA KAWAT 1 GG MUSSOLAH', '085833003458', 'BAMBANG YOGI BUSTAMAN', 'KARYAWAN SWASTA', 'RIAU (PEKAN BARU)', '08756146456', 'ERNA WATI', 'IBU RUMAH TANGGA', 'RIAU (PEKAN BARU)', '0816541651231', '', '', '', '', 'NAIK SPEDA MOTOR', '2023-02-21', '2023-03-14', 'TEST', ''),
(2, 'KDS002', '602-592-user.png', 'Aldi Rama Putra', '0005212326', 'L', 'SEI SEMUJUR', '1998-03-05', '3', 'JL.MARELAN', '0826546541', '', '', '', '', '', '', '', '', '', '', '', '', 'NAIK SEPEDA MOTOR', '2023-02-22', '2023-03-01', 'TEST', ''),
(3, 'KDS003', '', 'Test', '056165161321', 'P', 'MEDAN', '1997-04-05', '2', 'MEDAN', '0832165456', 'TEST', 'TEST', 'TEST', '08651635135', 'TEST', 'TEST', 'TEST', '086616', '', '', '', '', 'HONDA SCOPY', '2023-03-15', '2023-03-17', 'TEST', ''),
(4, 'KDS004', '', 'NOVITA SARI', '08651616516', 'P', 'MEDAN', '1998-05-05', '3', 'MEDAN', '0863216156', 'TEST', 'TEST', 'TEST', '08615651651', 'TEST', 'TEST', 'TEST', '08165156', '', '', '', '', 'HONDA', '2023-03-15', '', 'TEST', ''),
(5, 'KDS005', '183-4m89r9vc.png', 'LUTFI FAHRI, S.KOM', '171300265', 'L', 'SIANTAR (BAHBUTONG)', '1997-03-05', '1', 'JL.TANJUNG MULIA KAWAT 1 GG MUSSOLAH', '085833003458', 'SARNO', 'MANAGER (PABRIK KELAPA SAWIT)', 'RIAU', '081648465162', 'ENDANG WIDIYART', 'IBU RUMAH TANGGA', 'RIAU', '0816486494985', '', '', '', '', 'HONDA VARIO', '2023-03-15', '', 'TEST', '');

-- --------------------------------------------------------

--
-- Table structure for table `temp_essay`
--

CREATE TABLE `temp_essay` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_pg`
--

CREATE TABLE `temp_pg` (
  `id` int(11) NOT NULL,
  `Kode` char(120) NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_activity` datetime NOT NULL,
  `status` enum('1','2') NOT NULL,
  `Tipe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `job_title`, `job_date`, `last_activity`, `status`, `Tipe`) VALUES
(1, 'ADMIN', 'cf79ae6addba60ad018347359bd144d2', 'ADU', 'ADMIN', '2023-03-27 21:35:16', '2023-03-28 04:24:42', '', ''),
(2, 'DOSEN', '827ccb0eea8a706c4c34a16891f84e7b', 'TEST', 'DOSEN', '2023-03-27 21:35:12', '2023-03-28 04:23:44', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `essay`
--
ALTER TABLE `essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paketsoalpkt006`
--
ALTER TABLE `paketsoalpkt006`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesertaujian`
--
ALTER TABLE `pesertaujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilihan_ganda`
--
ALTER TABLE `pilihan_ganda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psoal`
--
ALTER TABLE `psoal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_essay`
--
ALTER TABLE `temp_essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_pg`
--
ALTER TABLE `temp_pg`
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
-- AUTO_INCREMENT for table `essay`
--
ALTER TABLE `essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paketsoalpkt006`
--
ALTER TABLE `paketsoalpkt006`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesertaujian`
--
ALTER TABLE `pesertaujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pilihan_ganda`
--
ALTER TABLE `pilihan_ganda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `psoal`
--
ALTER TABLE `psoal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_essay`
--
ALTER TABLE `temp_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_pg`
--
ALTER TABLE `temp_pg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
