<?php
# koneksi database
include '../koneksi.php';

# ambil data dari form
$id             = $_POST['id'];
$NamaSingkat    = $_POST['NamaSingkat'];
$Jurusan        = $_POST['Jurusan'];
$updated_at     = $_POST['updated_at'];

# updated datanya
$query = mysqli_query($koneksi, "UPDATE jurusan SET NamaSingkat='$NamaSingkat', Jurusan='$Jurusan', updated_at='$updated_at' WHERE id='$id' ");

# Alihkan ke halaman kelas
header("location:Jurusan.php");
