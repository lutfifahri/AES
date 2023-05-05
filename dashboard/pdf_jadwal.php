<?php
// memanggil library FPDF
require('library/fpdf.php');
include '../koneksi.php';

class Pdf extends FPDF
{

    function letak($gambar)

    {

        //memasukkan gambar untuk header

        $this->Image($gambar, 10, 10, 50, 25);

        //menggeser posisi sekarang

    }

    function judul($teks1, $teks2, $teks3, $teks4, $teks5)

    {

        $this->Cell(25);

        $this->SetFont('Times', 'B', '12');

        $this->Cell(0, 5, $teks1, 0, 1, 'C');

        $this->Cell(25);

        $this->Cell(0, 5, $teks2, 0, 1, 'C');

        $this->Cell(25);

        $this->SetFont('Times', 'B', '12');

        $this->Cell(0, 5, $teks3, 0, 1, 'C');

        $this->Cell(25);

        $this->SetFont('Times', 'I', '8');

        $this->Cell(0, 5, $teks4, 0, 1, 'C');

        $this->Cell(25);

        $this->Cell(0, 2, $teks5, 0, 1, 'C');
    }

    function garis()

    {

        $this->SetLineWidth(1);

        $this->Line(10, 36, 290, 36);

        $this->SetLineWidth(0);

        $this->Line(10, 37, 290, 37);
    }
}

// intance object dan memberikan pengaturan halaman PDF
// $pdf = new FPDF('L', 'mm', 'A4');
// $pdf->AddPage();

//instantisasi objek

$pdf = new Pdf();

//Mulai dokumen

$pdf->AddPage('L', 'A4');

//meletakkan gambar

$pdf->letak('smk.jpg');

//meletakkan judul disamping logo diatas

$pdf->judul('SMK DHARMA PHATRA', 'NPSN : 10260799', 'SK Pendirian Sekolah : 4125/0853-II-SK/2010', 'JLN BALONGAN DESA PURAKA II KOMPLEK PERTAMINA PANGKALAN BERANDAN, Puraka Ii, Kec. Sei Lepan, Kab. Langkat Prov. Sumatera Utara', 'Telp.(10260799) | Kode Pos : 20857');

//membuat garis ganda tebal dan tipis

$pdf->garis();

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
// $pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(100, 7, 'Kelas', 1, 0, 'C');
$pdf->Cell(80, 7, 'Jurusan', 1, 0, 'C');
$pdf->Cell(100, 7, 'Tanggal', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode'];
$data = mysqli_query($koneksi, "SELECT  * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
while ($b = mysqli_fetch_array($data)) {
    $Kode = $b['Kode'];
    $pg = "Absen" . $Kode;
    $vql = mysqli_query($koneksi, "SELECT * FROM " . $pg . " WHERE Tipe!='Z' AND KodePu!='' ");
    $tam = mysqli_fetch_array($vql);

    # ========== ini untuk kelas =======
    $KodeKelas = $tam['KodeKelas'];   # ini Kode Kelas { K002 }
    $kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE Tipe!='Z' AND Kode = '$KodeKelas' ");
    $hasilKelas = mysqli_fetch_array($kelas);

    # ========== ini untuk  Jurusan =======
    $KodeJurusan = $tam['KodeJurusan'];   # ini Kode Jurusan { JRS001 }
    $Jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE Tipe!='Z' AND Kode = '$KodeJurusan' ");
    $hasilJurusan = mysqli_fetch_array($Jurusan);

    // $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(100, 6, $hasilKelas['Nama'], 1, 0);
    $pdf->Cell(80, 6, $hasilJurusan['Jurusan'], 1, 0);
    $pdf->Cell(100, 6, $tam['Tanggal'], 1, 1);
}
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(280, 10, 'Daftar Siswa Ujian', 1, 1, 'C');
# ============================ untuk peserta ujian

// $pdf->SetFont('Times', 'B', 13);
// $pdf->Cell(200, 20, '* PESERTA UJIAN *', 0, 0, 'C');

// $pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(40, 7, 'No Ujian', 1, 0, 'C');
$pdf->Cell(40, 7, 'No Induk', 1, 0, 'C');
$pdf->Cell(40, 7, 'Nisn', 1, 0, 'C');
$pdf->Cell(60, 7, 'Nama Siswa', 1, 0, 'C');
$pdf->Cell(10, 7, 'JK', 1, 0, 'C');
$pdf->Cell(80, 7, 'Tempat Lahir', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode'];
$data = mysqli_query($koneksi, "SELECT  * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
while ($b = mysqli_fetch_array($data)) {
    $Kode = $b['Kode'];
    $pg = "Absen" . $Kode;      # ini table absen siswa 
    $query = mysqli_query($koneksi, "SELECT * FROM " . $pg . " WHERE Tipe!='Z' AND KodePu!='' ");
    while ($aa = mysqli_fetch_array($query)) {
        # Menampilkan table Peserta ujian
        $Kodepu = $aa['KodePu'];
        $pujian = mysqli_query($koneksi, "SELECT * FROM pesertaujian WHERE Tipe!='Z' AND Kode='$Kodepu' ");
        while ($aku = mysqli_fetch_array($pujian)) {
            $kodesiswa = $aku['KodeSiswa'];
            $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Tipe!='Z' AND Kode = '$kodesiswa'");
            while ($aja = mysqli_fetch_array($siswa)) {
                $pdf->Cell(10, 6, $no++, 1, 0, 'C');
                $pdf->Cell(40, 6, $aku['NoUjian'], 1, 0, 'C');
                $pdf->Cell(40, 6, $aku['NoInduk'], 1, 0, 'C');
                $pdf->Cell(40, 6, $aja['Nisn'], 1, 0);
                $pdf->Cell(60, 6, $aja['Nama'], 1, 0);
                $pdf->Cell(10, 6, $aja['Jk'], 1, 0);
                $pdf->Cell(80, 6, $aja['TempatLahir'], 1, 1);
            }
        }
    }
}

# ================================= untuk paket soal
$pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(200, 20, '* PAKET UJIAN *', 0, 0, 'C');
$pdf->Cell(280, 10, 'Paket Ujian', 1, 1, 'C');

// $pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(90, 7, 'Nama Paket', 1, 0, 'C');
$pdf->Cell(20, 7, 'Waktu', 1, 0, 'C');
$pdf->Cell(52, 7, 'Mata Pelajaran', 1, 0, 'C');
$pdf->Cell(48, 7, 'Jadwal Mulai', 1, 0, 'C');
$pdf->Cell(60, 7, 'Jadwal Selesai', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode'];
$data = mysqli_query($koneksi, "SELECT  * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
$b = mysqli_fetch_array($data);
$Kode = $b['KodePsoal'];
$fahri = mysqli_query($koneksi, "SELECT  * FROM psoal WHERE Tipe!='Z' AND Kode='$Kode' ");
$isinya = mysqli_fetch_array($fahri);
$mapel = $isinya['Mapel'];
$mpelajaran = mysqli_query($koneksi, "SELECT * FROM mapel WHERE Tipe!='Z' AND Kode='$mapel' ");
$in = mysqli_fetch_array($mpelajaran);

$pdf->Cell(10, 6, $no++, 1, 0, 'C');
$pdf->Cell(90, 6, $isinya['Nama'], 1, 0, 'C');
$pdf->Cell(20, 6, $isinya['Ukuran'], 1, 0, 'C');
$pdf->Cell(52, 6, $in['MataPelajaran'], 1, 0);
$pdf->Cell(48, 6, $b['JadwalMulai'], 1, 0);
$pdf->Cell(60, 6, $b['JadwalSelesai'], 1, 1);

# ===================================== PILIHAN GANDA ===================================

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(280, 10, 'Pilihan Ganda', 1, 1, 'C');

// $pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(223, 7, 'Soal', 1, 0, 'C');
// $pdf->Cell(60, 7, 'a', 1, 0, 'C');
// $pdf->Cell(60, 7, 'b', 1, 0, 'C');
// $pdf->Cell(60, 7, 'c', 1, 0, 'C');
// $pdf->Cell(60, 7, 'd', 1, 0, 'C');
$pdf->Cell(47, 7, 'Kunci Jawaban', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode']; # {ABSN001}  kode jadwal

# tampilkan table jadwal
$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
$ya = mysqli_fetch_array($jadwal);
$kodepsoal = $ya['KodePsoal'];   # { KodePsoal }

# tampilkan  table psoal
$fahri12 = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode ='$kodepsoal' ");
$test = mysqli_fetch_array($fahri12);
$kodepsoal = $test['Kode'];
$kodepsoal2 = $test['Kodepsoal2'];
$paketsoal = "paketsoal" . $kodepsoal;      # ini untuk memanggil table paket soal

$query = mysqli_query($koneksi, "SELECT * FROM " . $paketsoal . " WHERE Tipe!='Z' AND Kodepg!='' ");
while ($aa = mysqli_fetch_array($query)) {
    $pilihanganda = $aa['Kodepg'];
    $inipilihanganda = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z' AND Kode='$pilihanganda' ");
    while ($inihasilnya = mysqli_fetch_array($inipilihanganda)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(223, 6, $inihasilnya['Soal'], 1, 0, '');
        // $pdf->Cell(60, 6, $inihasilnya['a'], 1, 0, 'C');
        // $pdf->Cell(60, 6, $inihasilnya['b'], 1, 0);
        // $pdf->Cell(60, 6, $inihasilnya['c'], 1, 0);
        // $pdf->Cell(60, 6, $inihasilnya['d'], 1, 0);
        $pdf->Cell(47, 6, $inihasilnya['Kunci_jawab'], 1, 1);
    }
}


// $pdf->SetFont('Times', 'B', 13);
// $pdf->Cell(200, 20, '* PILIHAN (`A`, `B`, `C`, `D`) PADA PILIHAN GANDA DIATAS *', 0, 0, 'C');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(280, 10, 'Pilihan (a, b, c, d) Pada Soal Pilihan Ganda', 1, 1, 'C');


// $pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
// $pdf->Cell(200, 7, 'Soal', 1, 0, 'C');
$pdf->Cell(75, 7, 'a', 1, 0, 'C');
$pdf->Cell(65, 7, 'b', 1, 0, 'C');
$pdf->Cell(65, 7, 'c', 1, 0, 'C');
$pdf->Cell(65, 7, 'd', 1, 0, 'C');
// $pdf->Cell(45, 7, 'Kunci Jawaban', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode']; # {ABSN001}  kode jadwal

# tampilkan table jadwal
$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
$ya = mysqli_fetch_array($jadwal);
$kodepsoal = $ya['KodePsoal'];   # { KodePsoal }

# tampilkan  table psoal
$fahri12 = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode ='$kodepsoal' ");
$test = mysqli_fetch_array($fahri12);
$kodepsoal = $test['Kode'];
$kodepsoal2 = $test['Kodepsoal2'];
$paketsoal = "paketsoal" . $kodepsoal;      # ini untuk memanggil table paket soal

$query = mysqli_query($koneksi, "SELECT * FROM " . $paketsoal . " WHERE Tipe!='Z' AND Kodepg!='' ");
while ($aa = mysqli_fetch_array($query)) {
    $pilihanganda = $aa['Kodepg'];
    $inipilihanganda = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z' AND Kode='$pilihanganda' ");
    while ($inihasilnya = mysqli_fetch_array($inipilihanganda)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        // $pdf->Cell(200, 6, $inihasilnya['Soal'], 1, 0, 'C');
        $pdf->Cell(75, 6, $inihasilnya['a'], 1, 0, '');
        $pdf->Cell(65, 6, $inihasilnya['b'], 1, 0);
        $pdf->Cell(65, 6, $inihasilnya['c'], 1, 0);
        $pdf->Cell(65, 6, $inihasilnya['d'], 1, 1);
        // $pdf->Cell(45, 6, $inihasilnya['Kunci_jawab'], 1, 1);
    }
}


// $pdf->SetFont('Times', 'B', 13);
// $pdf->Cell(200, 20, '* ESSAY *', 0, 0, 'C');
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(280, 10, 'ESSAY', 1, 1, 'C');

// $pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->setAutoPageBreak(false);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(175, 7, 'Soal', 1, 0, 'C');
$pdf->Cell(55, 7, 'Jawaban', 1, 0, 'C');
$pdf->Cell(40, 7, 'Nilai', 1, 0, 'C');
// $pdf->Cell(65, 7, 'Foto', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode = $_GET['Kode']; # {ABSN001}  kode jadwal

# tampilkan table jadwal
$jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' AND Kode='$Kode' ");
$ya = mysqli_fetch_array($jadwal);
$kodepsoal = $ya['KodePsoal'];   # { KodePsoal }

# tampilkan  table psoal
$fahri12 = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode ='$kodepsoal' ");
$test = mysqli_fetch_array($fahri12);
$kodepsoal = $test['Kode'];
$kodepsoal2 = $test['Kodepsoal2'];
$paketsoal = "paketsoal" . $kodepsoal;      # ini untuk memanggil table paket soal

$query = mysqli_query($koneksi, "SELECT * FROM " . $paketsoal . " WHERE Tipe!='Z' AND Kodeessay!='' ");
while ($aa = mysqli_fetch_array($query)) {
    $essay = $aa['Kodeessay'];
    $inipilihanganda = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z' AND Kode='$essay' ");
    while ($inihasilnya = mysqli_fetch_array($inipilihanganda)) {
        $gambar = $inihasilnya['Foto'];
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(175, 6, $inihasilnya['Soal'], 1, 0);
        $pdf->Cell(55, 6, $inihasilnya['Jawaban'], 1, 0, 'C');
        $pdf->Cell(40, 6, $inihasilnya['Nilai'], 1, 1);
        // $pdf->Cell(65, 6, $inihasilnya['Foto'], 1, 1);
        // $pdf->Image('img/' . $gambar, 10, 90, 1);
    }
}



$pdf->Output();
