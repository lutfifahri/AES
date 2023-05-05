<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "UPDATE siswa SET Tipe = 'Z' WHERE id = '$id' ");

header("location:siswa.php");
