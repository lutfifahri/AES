<?php
include '../koneksi.php';

$a  =   mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE Kode = '$_GET[Kode]' "));

$b  = array(
    'Nisn'          => $a['Nisn'],
    'Jk'            => $a['Jk'],
    'TempatLahir'   => $a['TempatLahir'],
    'TanggalLahir'  => $a['TanggalLahir'],
    'NamaAyah'      => $a['NamaAyah'],
);

echo json_encode($b);
