<?php
// memanggil library FPDF
require('library/fpdf.php');
include '../koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, '* JADWAL UJIAN *', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'No', 1, 0, 'C');
$pdf->Cell(70, 7, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 7, 'Jadwal Awal', 1, 0, 'C');
$pdf->Cell(55, 7, 'Jadwal Akhir', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$Kode   = $_GET['Kode'];
if (isset($_GET['tgl_awal']) ||  isset($_GET['tgl_akhir'])) {
    $Tgl_awal   = $_GET['tgl_awal'];
    $Tgl_akhir  = $_GET['tgl_akhir'];

    $data = mysqli_query($koneksi, "SELECT  * FROM jadwal WHERE (Tanggal BETWEEN '$Tgl_awal' AND '$Tgl_akhir') AND Tipe!='Z'");
} else {
    $data = mysqli_query($koneksi, "SELECT  * FROM jadwal WHERE Tipe!='Z' ");
}
while ($d = mysqli_fetch_array($data)) {
    $KodePsoal = $d['KodePsoal'];
    $query = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode = '$KodePsoal' ");
    $a = mysqli_fetch_array($query);


    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(70, 6, $a['Nama'], 1, 0);
    $pdf->Cell(40, 6, $d['JadwalMulai'], 1, 0);
    $pdf->Cell(55, 6, $d['JadwalSelesai'], 1, 1);
}

$pdf->Output();
