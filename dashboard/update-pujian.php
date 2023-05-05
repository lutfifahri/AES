<?php
# koneksi database
include '../koneksi.php';

# ambil data dari form
$id         = $_POST['id'];
$NoInduk    = $_POST['NoInduk'];
$NoUjian    = $_POST['NoUjian'];
$updated_at = $_POST['updated_at'];

# updated datanya
$query = mysqli_query($koneksi, "UPDATE pesertaujian SET NoInduk='$NoInduk', NoUjian='$NoUjian', updated_at='$updated_at' WHERE id='$id' ");

# Alihkan ke halaman kelas
header("location:Pujian.php");
