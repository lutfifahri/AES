<?php
# koneksi database
include '../koneksi.php';

# ambil data dari form
$id         = $_POST['id'];
$Nama       = $_POST['Nama'];
$Kelas      = $_POST['Kelas'];
$updated_at = $_POST['updated_at'];

# updated datanya
$query = mysqli_query($koneksi, "UPDATE kelas SET Nama='$Nama', Kelas='$Kelas', updated_at='$updated_at' WHERE id='$id' ");

# Alihkan ke halaman kelas
header("location:Kelas.php");
