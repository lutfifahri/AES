<?php
# Koneksi Ke database
include '../koneksi.php';

$kodeini = $_POST['Kodeini'];

# Menampilkkan table pilihan ganda
$Sql = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z'");
while ($a = mysqli_fetch_array($Sql)) {
    $id     = $a['id'];
    $Kode   = $a['Kode'];
    $kj     = $a['Kunci_jawab'];

    if (isset($_POST[$id . $kj])) {
        $data3 = "V";
    } else {
        $data3 = "";
    }

    $query = mysqli_query($koneksi, "UPDATE pilihan_ganda SET Pilih = '$data3'  WHERE id ='$id'");
}

$xx = mysqli_query($koneksi, "UPDATE temp_pg SET Tipe = 'Z' ");

$fahri = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z' AND Pilih = 'V' ");
while ($b = mysqli_fetch_array($fahri)) {
    $Kode = $b['Kode'];
    $insert = mysqli_query($koneksi, "INSERT INTO temp_pg (`id`, `Kode`, `Tipe`) VALUES (NULL, '$Kode', '')");
}

header("location:pilih-paket.php?Kode=" . $kodeini . "");
