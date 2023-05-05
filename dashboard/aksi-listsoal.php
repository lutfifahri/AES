<?php
include '../koneksi.php';

$kodepaket  = $_POST['Kodepaket'];
$inikode    = $_POST['Kodeini'];
$pg = "paketsoal" . $inikode;

# update table psoal { `Status` , `Kodesoal2` }
$psoal = mysqli_query($koneksi, "UPDATE psoal SET Status='V', Kodepsoal2='$kodepaket' WHERE Kode='$inikode'");

// echo "UPDATE psoal SET Status='Z', Kodesoal2='$inikode' WHERE Kode='$inikode'";

# tampilkan table temp_pg
$pilihanganda = mysqli_query($koneksi, "SELECT * FROM temp_pg WHERE Tipe!='Z' ");
while ($a = mysqli_fetch_array($pilihanganda)) {
    $Kodepilihanganda = $a['Kode'];
    $insert = mysqli_query($koneksi, "INSERT INTO " . $pg . " (`id`, `Kode`, `Kodepg`, `Kodeessay`, `Tipe`) VALUES ('', '$kodepaket', '$Kodepilihanganda','', '') ");
}
$essay = mysqli_query($koneksi, "SELECT * FROM temp_essay WHERE Tipe!='Z' ");
while ($aa = mysqli_fetch_array($essay)) {
    $Kodeessay = $aa['Kode'];
    # insert tabel paket soal
    $insert = mysqli_query($koneksi, "INSERT INTO " . $pg . " (`id`, `Kode`, `Kodepg`, `Kodeessay`, `Tipe`) VALUES ('', '$kodepaket', '','$Kodeessay', '') ");

    // echo "INSERT INTO " . $pg . " (`id`, `Kode`, `Kodepg`, `Kodeessay`, `Tipe`) VALUES ('', '$iniadalahkode', '$Kodepilihanganda','$Kodeessay', '') ";
}

# update table pilihanganda ke "" dan essay ke ""
$cobakya = mysqli_query($koneksi, "UPDATE pilihan_ganda SET Pilih = '' ");
$essay = mysqli_query($koneksi, "UPDATE essay SET Pilih = '' ");

$hapuspg = 'TRUNCATE TABLE temp_pg';
$delete1 = mysqli_query($koneksi, $hapuspg);

$hapusessay = 'TRUNCATE TABLE temp_essay';
$delete2 = mysqli_query($koneksi, $hapusessay);

header("location:Kepaket.php");
