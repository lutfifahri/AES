<?php
# koneksi database
include '../koneksi.php';

# ambil data dari form
$id             = $_POST['id'];
$NamaSingkat    = $_POST['NamaSingkat'];
$MataPelajaran  = $_POST['MataPelajaran'];
$updated_at     = $_POST['updated_at'];

# updated datanya
$query = mysqli_query($koneksi, "UPDATE mapel SET NamaSingkat='$NamaSingkat', MataPelajaran='$MataPelajaran', updated_at='$updated_at' WHERE id='$id' ");

# Alihkan ke halaman kelas
header("location:MataPelajaran.php");
