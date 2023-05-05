<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$Kode           = $_POST['Kode'];
$Kodeini        = $_POST['Kode'];
$Nama           = $_POST['Nama'];
$Ukuran         = $_POST['Ukuran'];
$Mapel          = $_POST['Mapel'];
$Keterangan     = $_POST['Keterangan'];
$created_at     = $_POST['created_at'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];
$Tipe           = $_POST['Tipe'];

$pg = "paketsoal" . $Kodeini;

$sql = 'CREATE TABLE ' . $pg . ' ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'Kodepg char(120) NOT NULL, ' .
    'Kodeessay char(120) NOT NULL, ' .
    'Tipe char(1) NOT NULL, ' .
    'primary key (id))';
$buattabel = mysqli_query($koneksi, $sql);


$query = mysqli_query($koneksi, "INSERT INTO psoal (id, Kode, Nama, Ukuran, Mapel, Keterangan, created_at, updated_at, User, Tipe) VALUES ('', '$Kode', '$Nama', '$Ukuran', '$Mapel', '$Keterangan', '$created_at', '$updated_at', '$User', '$Tipe')");

header("location:Psoal.php");
