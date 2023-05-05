<?php
# koneksi database
include '../koneksi.php';

# ambil data dari form
$id             = $_POST['id'];
$Nama           = $_POST['Nama'];
$Ukuran         = $_POST['Ukuran'];
$Mapel          = $_POST['Mapel'];
$Keterangan     = $_POST['Keterangan'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];

# updated datanya
$query = mysqli_query($koneksi, "UPDATE psoal SET Nama='$Nama',  Ukuran='$Ukuran' , Mapel='$Mapel', Keterangan = '$Keterangan', updated_at='$updated_at' , User = '$User' WHERE id='$id' ");

# Alihkan ke halaman kelas
header("location:Psoal.php");
