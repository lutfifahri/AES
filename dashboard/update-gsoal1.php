<?php
# koneksi ke database
include '../koneksi.php';

$id             = $_POST['id'];
$Soal           = $_POST['Soal'];
$Jawaban        = $_POST['Jawaban'];
$Nilai          = $_POST['Nilai'];
$iniuntukgambar = $_FILES['Foto']['name'];  // DI GANTI MENJADI VARIABLE NAMA BARU UNTUK GAMBAR
// $Foto           = $_POST['Foto'];
$Keterangan     = $_POST['Keterangan'];
$created_at     = $_POST['created_at'];
$updated_at     = $_POST['updated_at'];
$User           = $_POST['User'];
$Tipe           = $_POST['Tipe'];

# Membuat logika untuk insert gambar
if ($iniuntukgambar != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x                      = explode('.', $iniuntukgambar);
    $ekstensi               = strtolower(end($x));
    $file_tmp               = $_FILES['Foto']['tmp_name'];
    $angka_acak             = rand(1, 999);
    $nama_baru              = $angka_acak . '-' . $iniuntukgambar;
    if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
        move_uploaded_file($file_tmp, 'img/' . $nama_baru);


        # Syntak untuk update {Ubah}
        $queryUbah = mysqli_query($koneksi, "UPDATE essay SET Soal = '$Soal', Jawaban='$Jawaban', Nilai='$Nilai', Foto='$nama_baru', Keterangan='$Keterangan', updated_at='$updated_at', User='$User' WHERE id='$id' ");

        if (!$queryUbah) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi)) .
                " - " . mysqli_error($koneksi);
        } else {
            header("location:Gsoal.php");
        }
    } else {
        # JIKA FILE EKSTENSI TIDAK JPG DAN PNG MAKA ALERT INI YANG TAMPIL
        echo "<script>alert('Ekstensi Gambar Yang Boleh Jpg, Png, Jpeg. '); window.location='Gsoal.php';</script>";
    }
} else {
    # Syntak untuk update {Ubah}
    $queryUbah1 = mysqli_query($koneksi, "UPDATE essay SET Soal = '$Soal', Jawaban='$Jawaban', Nilai='$Nilai', Keterangan='$Keterangan', updated_at='$updated_at', User='$User' WHERE id='$id' ");

    if (!$queryUbah1) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        # TAMPIL ALERT DAN AKAN REDIRECT KE HALAMAN INDEX
        header("location:Gsoal.php");
    }
}
