<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$Kode           = $_POST['Kode'];
$NamaSingkat    = $_POST['NamaSingkat'];
$MataPelajaran  = $_POST['MataPelajaran'];
$created_at     = $_POST['created_at'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];
$Tipe           = $_POST['Tipe'];

$query = mysqli_query($koneksi, "INSERT INTO mapel (id, Kode, NamaSingkat, MataPelajaran, created_at, updated_at, User, Tipe) VALUES ('', '$Kode', '$NamaSingkat', '$MataPelajaran', '$created_at', '$updated_at', '$User', '$Tipe')");

header("location:MataPelajaran.php");
