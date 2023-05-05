<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$Kode           = $_POST['Kode'];
$NoInduk        = $_POST['NoInduk'];
$NoUjian        = $_POST['NoUjian'];
$KodeSiswa      = $_POST['KodeSiswa'];
$created_at     = $_POST['created_at'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];
$Tipe           = $_POST['Tipe'];

// $pg = "pesertaujian" . $Kode;

// $sql = 'CREATE TABLE ' . $pg . ' ( ' .
//     'id int NOT NULL AUTO_INCREMENT, ' .
//     'Kode char(120) NOT NULL, ' .
//     'Pilih char(1) NOT NULL, ' .
//     'Tipe char(1) NOT NULL, ' .
//     'primary key (id))';
// $buattabel = mysqli_query($koneksi, $sql);

$query = mysqli_query($koneksi, "INSERT INTO pesertaujian (id, Kode, NoInduk, NoUjian, KodeSiswa, created_at, updated_at, User, Tipe) VALUES ('', '$Kode', '$NoInduk', '$NoUjian', '$KodeSiswa', '$created_at', '$updated_at', '$User', '$Tipe')");

header("location:Pujian.php");
