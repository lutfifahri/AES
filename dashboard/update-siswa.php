<?php
# Koneksi Ke Database
include '../koneksi.php';

# ambil data dari form
$id                 = $_POST['id'];
$Kode               = $_POST['Kode'];
// $File               = $_POST['File'];
$iniuntukgambar     = $_FILES['File']['name'];  // DI GANTI MENJADI VARIABLE NAMA BARU UNTUK GAMBAR
$Nama               = $_POST['Nama'];
$Nisn               = $_POST['Nisn'];
$Jk                 = $_POST['Jk'];
$TempatLahir        = $_POST['TempatLahir'];
$TanggalLahir       = $_POST['TanggalLahir'];
$AnakKe             = $_POST['AnakKe'];
$Alamat             = $_POST['Alamat'];
$NoHp               = $_POST['NoHp'];
$NamaAyah           = $_POST['NamaAyah'];
$PekerjaanAyah      = $_POST['PekerjaanAyah'];
$AlamatAyah         = $_POST['AlamatAyah'];
$NoHpAyah           = $_POST['NoHpAyah'];
$NamaIbu            = $_POST['NamaIbu'];
$PekerjaanIbu       = $_POST['PekerjaanIbu'];
$AlamatIbu          = $_POST['AlamatIbu'];
$NoHpIbu            = $_POST['NoHpIbu'];
$NamaWali           = $_POST['NamaWali'];
$PekerjaanWali      = $_POST['PekerjaanWali'];
$AlamatWali         = $_POST['AlamatWali'];
$NoHpWali           = $_POST['NoHpWali'];
$TransportasiSiswa  = $_POST['TransportasiSiswa'];
$created_at         = $_POST['created_at'];
$updated_at         = $_POST['updated_at'];
$User               = $_POST['User'];
$Tipe               = $_POST['Tipe'];

# Membuat logika untuk insert gambar
if ($iniuntukgambar != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x                      = explode('.', $iniuntukgambar);
    $ekstensi               = strtolower(end($x));
    $file_tmp               = $_FILES['File']['tmp_name'];
    $angka_acak             = rand(1, 999);
    $nama_baru              = $angka_acak . '-' . $iniuntukgambar;
    if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
        move_uploaded_file($file_tmp, 'img/' . $nama_baru);

        # Syntak Untuk Update {Ubah} Dengan Gambar
        $query = mysqli_query($koneksi, "UPDATE siswa SET  File='$nama_baru', Nama='$Nama', Nisn='$Nisn', Jk='$Jk', TempatLahir='$TempatLahir', TanggalLahir='$TanggalLahir', AnakKe='$AnakKe', Alamat='$Alamat', NoHp='$NoHp', NamaAyah='$NamaAyah', PekerjaanAyah='$PekerjaanAyah', AlamatAyah='$AlamatAyah', NoHpAyah='$NoHpAyah', NamaIbu='$NamaIbu', PekerjaanIbu='$PekerjaanIbu', AlamatIbu='$AlamatIbu', NoHpIbu='$NoHpIbu', NamaWali='$NamaWali', PekerjaanWali='$PekerjaanWali', AlamatWali='$AlamatWali', NoHpWali='$NoHpWali', TransportasiSiswa='$TransportasiSiswa', updated_at='$updated_at' WHERE id = '$id' ");

        if (!$query) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi)) .
                " - " . mysqli_error($koneksi);
        } else {
            header("location:siswa.php");
        }
    } else {
        # JIKA FILE EKSTENSI TIDAK JPG DAN PNG MAKA ALERT INI YANG TAMPIL
        echo "<script>alert('Ekstensi Gambar Yang Boleh Jpg, Png, Jpeg. '); window.location='siswa.php';</script>";
    }
} else {
    $queryDua = mysqli_query($koneksi, "UPDATE siswa SET Nama='$Nama', Nisn='$Nisn', Jk='$Jk', TempatLahir='$TempatLahir', TanggalLahir='$TanggalLahir', AnakKe='$AnakKe', Alamat='$Alamat', NoHp='$NoHp', NamaAyah='$NamaAyah', PekerjaanAyah='$PekerjaanAyah', AlamatAyah='$AlamatAyah', NoHpAyah='$NoHpAyah', NamaIbu='$NamaIbu', PekerjaanIbu='$PekerjaanIbu', AlamatIbu='$AlamatIbu', NoHpIbu='$NoHpIbu', NamaWali='$NamaWali', PekerjaanWali='$PekerjaanWali', AlamatWali='$AlamatWali', NoHpWali='$NoHpWali', TransportasiSiswa='$TransportasiSiswa', updated_at='$updated_at' WHERE id = '$id' ");

    if (!$queryDua) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        # TAMPIL ALERT DAN AKAN REDIRECT KE HALAMAN INDEX
        header("location:siswa.php");
    }
}
