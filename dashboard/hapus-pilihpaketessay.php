<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "UPDATE temp_essay SET Tipe = 'Z' WHERE id = '$id' ");

header("location:pilih-paket.php");
