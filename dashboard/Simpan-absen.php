<?php
# koneksi Ke database
include '../koneksi.php';

$kodeJadwal         = $_POST['KodeJadwal'];
$Kode               = $_POST['Kode'];
$KodeKelas          = $_POST['KodeKelas'];
$KodeJurusan        = $_POST['KodeJurusan'];
$Tanggal            = $_POST['Tanggal'];
$User               = $_POST['User'];


$pg = "Absen" . $kodeJadwal;

// # UPDATE TIPE KE { V }
$ubah = mysqli_query($koneksi, "UPDATE jadwal SET Tipe = 'V' WHERE Tipe!='Z' AND Kode='$kodeJadwal' ");

# Simpan
$query = mysqli_query($koneksi, "SELECT * FROM pesertaujian WHERE Tipe!='Z' ");
while ($a = mysqli_fetch_array($query)) {
    $id         = $a['id'];
    $NoInduk    = $a['NoInduk'];
    $KodePu     = $a['Kode'];

    if (isset($_POST[$id . $NoInduk])) {
        $data3 = "" . $KodePu . "";
    } else {
        $data3 = "";
    }

    $simpan = mysqli_query($koneksi, "INSERT INTO  " . $pg . " (`id`, `Kode`, `KodePu`, `KodeKelas`, `KodeJurusan`, `KodeJadwal`, `Tanggal`, `User`, `Tipe`) VALUES ('', '$Kode', '$data3', '$KodeKelas', '$KodeJurusan', '$kodeJadwal', '$Tanggal', '$User', '$Tipe')");
}

header("location:Kelolajadwal.php");
