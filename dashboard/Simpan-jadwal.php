<?php

# Koneksi Ke database
include '../koneksi.php';

$Kode           =   $_POST['Kode'];
$KodePsoal      =   $_POST['KodePsoal'];
$JadwalMulai    =   $_POST['JadwalMulai'];
$JadwalSelesai  =   $_POST['JadwalSelesai'];
$User           =   $_POST['User'];
$Tanggal        =   $_POST['Tanggal'];


$pg = "Absen" . $Kode;

$sql = 'CREATE TABLE ' . $pg . ' ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'KodePu char(120) NOT NULL, ' .
    'KodeKelas char(120) NOT NULL, ' .
    'KodeJurusan char(120) NOT NULL, ' .
    'KodeJadwal char(120) NOT NULL, ' .
    'Tanggal date NOT NULL, ' .
    'User char(65) NOT NULL, ' .
    'Tipe char(1) NOT NULL, ' .
    'primary key (id))';
$buattabel = mysqli_query($koneksi, $sql);

# insert jadwal
$insert = mysqli_query($koneksi, "INSERT INTO `jadwal` (`id`, `Kode`, `KodePsoal`, `JadwalMulai`, `JadwalSelesai`, `User`, `Tanggal`, `Tipe`) VALUES ('','$Kode', '$KodePsoal', '$JadwalMulai', '$JadwalSelesai', '$User', '$Tanggal', '')");


# Update { Status }
$update = mysqli_query($koneksi, "UPDATE psoal SET Status = 'Z' WHERE Kode = '$KodePsoal' ");

header("location:Kelolajadwal.php");
