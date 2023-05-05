<?php
include '../koneksi.php';

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM pesertaujian WHERE Tipe!='Z' AND id='$id' ");
$tampil = mysqli_fetch_array($sql);
$Kodeini = $tampil['Kode'];

$query = mysqli_query($koneksi, "UPDATE pesertaujian SET Tipe = 'Z' WHERE id = '$id' ");

$pg = "pesertaujian" . $Kodeini;

$sql = 'DROP TABLE ' . $pg . ' ';
$delete = mysqli_query($koneksi, $sql);

header("location:Pujian.php");
