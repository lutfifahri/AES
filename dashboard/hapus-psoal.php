<?php
# koneksi ke database
include '../koneksi.php';

# ambil data id dari get id
$id = $_GET['id'];
$tampil = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND id = '$id' ");
$hampir = mysqli_fetch_array($tampil);
$Kodeini = $hampir['Kode']; # {PKT001}

# Menampilkan table jadwal
$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' AND KodePsoal = '$Kodeini' ");
$tampilnya = mysqli_fetch_array($jadwal);
$kodejadwal = $tampilnya['Kode'];           # { ABSN001 }

#{ 
$pg = "paketsoal" . $Kodeini;          # TABEL { paketsoalpkt001 }
$absen = "absen" . $kodejadwal;        # TABLE { absenabsn001 }
#}

$query = mysqli_query($koneksi, "UPDATE psoal SET Tipe = 'Z' WHERE id = '$id' ");

$ini = mysqli_query($koneksi, "UPDATE jadwal SET Tipe = 'Z' WHERE Kode = '$kodejadwal' ");

$sql = 'DROP TABLE ' . $pg . ' ';
$delete = mysqli_query($koneksi, $sql);

$sql1 = 'DROP TABLE ' . $absen . ' ';
$delete = mysqli_query($koneksi, $sql1);

# Alihkan ke halaman kelas
header("location:Psoal.php");
