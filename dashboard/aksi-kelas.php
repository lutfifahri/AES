<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$Kode           = $_POST['Kode'];
$Nama           = $_POST['Nama'];
$Kelas          = $_POST['Kelas'];
$created_at     = $_POST['created_at'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];
$Tipe           = $_POST['Tipe'];

$query = mysqli_query($koneksi, "INSERT INTO kelas (id, Kode, Nama, Kelas, created_at, updated_at, User, Tipe) VALUES ('', '$Kode', '$Nama', '$Kelas', '$created_at', '$updated_at', '$User', '$Tipe')");

header("location:Kelas.php");
