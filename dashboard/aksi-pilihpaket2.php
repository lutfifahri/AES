<?php
# Koneksi Ke database
include '../koneksi.php';
$Kodeini = $_POST['Kodeini'];
# Menampilkkan table pilihan ganda
$Sql = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z'");
while ($a = mysqli_fetch_array($Sql)) {
    $id     = $a['id'];
    $Kode   = $a['Kode'];
    $Soal     = $a['Soal'];

    if (isset($_POST[$id . $Kode])) {
        $data3 = "V";
    } else {
        $data3 = "";
    }

    $query = mysqli_query($koneksi, "UPDATE essay SET Pilih = '$data3'  WHERE id ='$id'");
}

$xx = mysqli_query($koneksi, "UPDATE temp_essay SET Tipe = 'Z' ");

$fahri = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z' AND Pilih = 'V' ");
while ($b = mysqli_fetch_array($fahri)) {
    $Kode = $b['Kode'];
    $insert = mysqli_query($koneksi, "INSERT INTO temp_essay (`id`, `Kode`, `Tipe`) VALUES (NULL, '$Kode', '')");
}

header("location:pilih-paket.php?Kode=" . $Kodeini . "");
