<?php
# koneksi ke database
include '../koneksi.php';

# ambil data id dari get id
$id = $_GET['id'];

$query = mysqli_query($koneksi, "UPDATE kelas SET Tipe = 'Z' WHERE id = '$id' ");
# Alihkan ke halaman kelas
header("location:Kelas.php");
