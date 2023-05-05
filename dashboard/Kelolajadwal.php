<?php
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
session_start();
include '../koneksi.php';

$sql = 'CREATE TABLE jadwal ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'KodePsoal char(120) NOT NULL, ' .
    'JadwalMulai char(120) NOT NULL, ' .
    'JadwalSelesai char(120) NOT NULL, ' .
    'User char(65) NOT NULL, ' .
    'Tanggal date NOT NULL, ' .
    'Tipe char(1) NOT NULL, ' .
    'primary key ( id ))';
$buattabel = mysqli_query($koneksi, $sql);

if (empty($_SESSION['username'])) {
    header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
$queryupdate = mysqli_query($koneksi, $sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT fullname,job_title,last_activity FROM users WHERE username='$user'");
$data = mysqli_fetch_array($query);
?>

<head>
    <title>Halo, <?php echo $data['fullname']; ?> - Aplikasi Enkripsi dan Dekripsi Sekolah SMK Dharma Patra</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/css/jquery.dataTables.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>

<body class="sidebar-mini fixed">
    <div class="wrapper">
        <header class="main-header hidden-print"><a class="logo" href="index.php" style="font-size:13pt">SMK Dharma Patra</a>
            <nav class="navbar navbar-static-top">
                <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
                <div class="navbar-custom-menu">
                    <ul class="top-nav">
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                            <ul class="dropdown-menu settings-menu">
                                <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- untuk menu -->
        <?php
        include 'menu.php';
        ?>
        <!-- selesai  -->

        <div class="content-wrapper">
            <div class="page-title">
                <div>
                    <h1><i class="fa fa-circle-o"></i>&nbsp;Kelola Jadwal</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Data Kelola Jadwal</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <br><br>
                                <table id="file" class="table striped">
                                    <thead>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td><strong>Nama Paket</strong></td>
                                            <td><strong>Mata Pelajaran</strong></td>
                                            <?php
                                            if ($data['job_title'] !== "DOSEN") {
                                            ?>
                                                <td>
                                                    <center><strong>Status</strong></center>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    # untuk koneksi ke database
                                    include '../koneksi.php';
                                    # tampilkan table jurusan
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' ");
                                    while ($a = mysqli_fetch_array($query)) {
                                        $aa = $a['Mapel'];
                                        $query1 = mysqli_query($koneksi, "SELECT * FROM Mapel WHERE Tipe!='Z' AND Kode = '$aa' ");
                                        $hasilnya = mysqli_fetch_array($query1);
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $a['Nama'] ?></td>
                                            <td><?php echo $hasilnya['MataPelajaran'] ?></td>
                                            <?php
                                            if ($data['job_title'] !== "DOSEN") {
                                            ?>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $hasil = $a['Status'];
                                                        if ($hasil == 'V') {
                                                            echo '<a href="#" data-toggle="modal" data-target="#modalEdit' . $a['id'] . '" class="btn btn-info btn-sm"><i class="fa fa-tags"></i> Kelola Jadwal</a>';
                                                        } else if ($hasil == 'Z') {
                                                            echo '<a href="#" class="btn btn-warning btn" disabled> Sudah Disimpan</a>';
                                                        } else {
                                                            echo '<a href="#" class="btn btn-danger btn" disabled> Belum Terdaftar</a>';
                                                        }
                                                        ?>
                                                    </center>

                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php  } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <br><br>
                                <table id="jadwal" class="table striped">
                                    <thead>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td><strong>Nama Paket</strong></td>
                                            <td><strong>Jadwal Mulai</strong></td>
                                            <td><strong>Jadwal Selesai</strong></td>
                                            <td><strong>
                                                    <center>Opsi</center>
                                                </strong>
                                            </td>
                                            <td>&nbsp;
                                            </td>
                                        </tr>
                                    </thead>
                                    <?php
                                    # untuk koneksi ke database
                                    include '../koneksi.php';
                                    # tampilkan table jurusan
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' ");
                                    while ($aa = mysqli_fetch_array($query)) {
                                        $tampil = $aa['KodePsoal'];
                                        $sql = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode = '$tampil'");
                                        $hasil = mysqli_fetch_array($sql);
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $hasil['Nama'] ?></td>
                                            <td><?php echo $aa['JadwalMulai'] ?></td>
                                            <td><?php echo $aa['JadwalSelesai'] ?></td>
                                            <td>
                                                <center><?php
                                                        $Tipe = $aa['Tipe'];
                                                        if ($Tipe == 'V') {
                                                            echo '<a href="#" class="btn btn-warning" disabled>SUDAH DI ABSEN</a>';
                                                        } else {
                                                            echo '<a href="#" data-toggle="modal" data-target="#modalEdit' . $aa['id'] . '" class="btn btn-info">ABSEN</a>';
                                                        }
                                                        ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php
                                                    $Tipe = $aa['Tipe'];
                                                    if ($Tipe == 'V') {
                                                        echo '<a href="#" data-toggle="modal" data-target="#modalPrint' . $aa['id'] . '" class="btn btn-default"><i class="fa fa-print"></i></a>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $kuery = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
    ?>
        <!-- modal Edit  -->
        <div id="modalEdit<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Kelola Jadwal Ujian </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="Simpan-jadwal.php" method="POST" autocomplete="off" style="margin-bottom:0px">
                                    <input type="hidden" class="form-control" value="<?php echo $b['id']; ?>" name="id">
                                    <?php
                                    # Mengambil data dengan kode yang paling besar
                                    $query  = mysqli_query($koneksi, "SELECT max(KodePsoal) as kodeTerbesar FROM jadwal WHERE Tipe!='Z'");
                                    $tampil = mysqli_fetch_array($query);
                                    $kk = $tampil['kodeTerbesar'];

                                    # Mengambil angka dari Kode Siswa, Menggunakan fungsi substr
                                    # dan diubah ke integer dengan (int)
                                    $urutan = (int) substr($kk, 3, 3);

                                    #Bilangan yang diambil ini di tambah 1 untuk menentukan nomor urut berikutnya;
                                    $urutan++;

                                    # membentuk Kode Siswa baru
                                    # perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                                    # misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                                    # angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya KDS 

                                    $huruf = "ABSN";
                                    $kk = $huruf . sprintf("%03s", $urutan);
                                    echo '<input type="hidden" class="form-control" name="Kode" value="' . $kk . '"  required>';
                                    ?>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Kodepsoal" class="col-sm-2 col-form-label">Paket Soal</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="KodePsoal" value="<?php echo $b['Kode']; ?>">
                                            <input type="text" class="form-control" value="<?php echo $b['Nama']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="JadwalMulai" class="col-sm-2 col-form-label">Jadwal Mulai</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" name="JadwalMulai" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="JadwalSelesai" class="col-sm-2 col-form-label">Jadwal Selesai</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" name="JadwalSelesai" class="form-control">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-input1" name="User" value="<?php echo $data['fullname']; ?>" readonly>
                        <input type="hidden" name="Tanggal" value="<?php echo date('Y-m-d') ?>">
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>



    <?php
    $kuery = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
    ?>
        <!-- modal Edit  -->
        <div id="modalEdit<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Absen </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="Simpan-absen.php" method="POST" autocomplete="off" style="margin-bottom:0px">
                                    <input type="hidden" class="form-control" value="<?php echo $b['id']; ?>" name="id">
                                    <input type="hidden" class="form-control" value="<?php echo $b['Kode']; ?>" name="KodeJadwal">
                                    <?php
                                    $KodeAbsen = $b['Kode'];

                                    $pg = "Absen" . $KodeAbsen;

                                    # Mengambil data dengan kode yang paling besar
                                    $query  = mysqli_query($koneksi, "SELECT max(Kode) as kodeTerbesar FROM " . $pg . " WHERE Tipe!='Z'");
                                    $tampil = mysqli_fetch_array($query);
                                    $KodeSiswa = $tampil['kodeTerbesar'];

                                    # Mengambil angka dari Kode Siswa, Menggunakan fungsi substr
                                    # dan diubah ke integer dengan (int)
                                    $urutan = (int) substr($KodeSiswa, 3, 3);

                                    #Bilangan yang diambil ini di tambah 1 untuk menentukan nomor urut berikutnya;
                                    $urutan++;

                                    # membentuk Kode Siswa baru
                                    # perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                                    # misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                                    # angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya KDS 

                                    $huruf = "Data";
                                    $KodeSiswa = $huruf . sprintf("%03s", $urutan);
                                    echo '<input type="hidden" class="form-control" name="Kode" value="' . $KodeSiswa . '" readonly required>';
                                    ?>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Kodepsoal" class="col-sm-2 col-form-label">Peserta Ujian</label>
                                        <div class="col-sm-10">
                                            <div class="table-responsive">
                                                <table id="jadwal1" class="table striped" border="1">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>No</strong></td>
                                                            <td><strong>No Ujian</strong></td>
                                                            <td><strong>No Induk</strong></td>
                                                            <td><strong>Nama Siswa</strong></td>
                                                            <td>
                                                                <center>Opsi</center>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    # untuk koneksi ke database
                                                    include '../koneksi.php';
                                                    # tampilkan table jurusan
                                                    $no = 1;
                                                    $query = mysqli_query($koneksi, "SELECT * FROM pesertaujian WHERE Tipe!='Z' ");
                                                    while ($aa = mysqli_fetch_array($query)) {
                                                        $tampil = $aa['KodeSiswa'];
                                                        $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Kode = '$tampil'");
                                                        $hasil = mysqli_fetch_array($sql);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $aa['NoUjian'] ?></td>
                                                            <td><?php echo $aa['NoInduk'] ?></td>
                                                            <td><?php echo $hasil['Nama'] ?></td>
                                                            <td>
                                                                <center><input type="checkbox" class="nampilJadwal" value="<?php echo $aa['Kode']; ?>" name="<?php echo $aa['id'] . $aa['NoInduk']; ?>"></center>
                                                            </td>
                                                        </tr>
                                                    <?php  } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="KodeKelas" class="col-sm-2 col-form-label">Kelas & jurusan</label>
                                        <div class="col-sm-5">
                                            <select name="KodeKelas" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE Tipe!='Z' ");
                                                while ($aaa = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $aaa['Kode']; ?>"><?php echo $aaa['Nama']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <select name="KodeJurusan" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                $sql = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE Tipe!='Z' ");
                                                while ($aaa = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $aaa['Kode']; ?>"><?php echo $aaa['Jurusan']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-input1" name="User" value="<?php echo $data['fullname']; ?>" readonly>
                        <input type="hidden" name="Tanggal" value="<?php echo date('Y-m-d') ?>">
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>


    <?php
    $kuery = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
        $Kode = $b['Kode'];
        $pg = "Absen" . $Kode;
        $vql = mysqli_query($koneksi, "SELECT * FROM " . $pg . " WHERE Tipe!='Z' ");
        $tam = mysqli_fetch_array($vql);
    ?>
        <!-- modal Edit  -->
        <div id="modalPrint<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">Jadwal Ujian </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="Simpan-absen.php" method="POST" autocomplete="off" style="margin-bottom:0px">
                                    <input type="hidden" class="form-control" value="<?php echo $b['id']; ?>" name="id">
                                    <input type="hidden" class="form-control" value="<?php echo $b['Kode']; ?>" name="KodeJadwal">
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Kodepsoal" class="col-sm-3 col-form-label">Kelas : <?php
                                                                                                        $nah = $tam['KodeKelas'];
                                                                                                        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE Tipe!='Z' AND Kode = '$nah' ");
                                                                                                        $hasil = mysqli_fetch_array($kelas);
                                                                                                        echo $hasil['Kelas'];
                                                                                                        ?>&nbsp;(&nbsp;<?php echo $hasil['Nama']; ?>&nbsp; )</label>
                                        <label for="Kodepsoal" class="col-sm-3 col-form-label">Jurusan : <?php
                                                                                                            $nah = $tam['KodeJurusan'];
                                                                                                            $kelas = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE Tipe!='Z' AND Kode = '$nah' ");
                                                                                                            $hasil = mysqli_fetch_array($kelas);
                                                                                                            echo $hasil['Jurusan'];
                                                                                                            ?></label>
                                        <label for="Kodepsoal" class="col-sm-3 col-form-label">Tanggal : <?php echo $tam['Tanggal']; ?></label>
                                        <br><br>
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table id="jadwal1" class="table striped" border="1">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>No</strong></td>
                                                            <td><strong>No Ujian</strong></td>
                                                            <td><strong>No Induk</strong></td>
                                                            <td><strong>Nama Siswa</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $iniKode = $b['Kode'];
                                                    $Absen = "Absen" . $iniKode;
                                                    $no = 1;
                                                    $query = mysqli_query($koneksi, "SELECT * FROM " . $Absen . " WHERE Tipe!='Z'  AND KodePu!=''");
                                                    while ($aa = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <?php
                                                            $Kodepu = $aa['KodePu'];
                                                            $pujian = mysqli_query($koneksi, "SELECT * FROM pesertaujian WHERE Tipe!='Z' AND Kode='$Kodepu' ");
                                                            while ($aku = mysqli_fetch_array($pujian)) {
                                                            ?>
                                                                <td><?php echo $aku['NoUjian'] ?></td>
                                                                <td><?php echo $aku['NoInduk'] ?></td>
                                                                <?php
                                                                $kodesiswa = $aku['KodeSiswa'];
                                                                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Tipe!='Z' AND Kode = '$kodesiswa'");
                                                                while ($aja = mysqli_fetch_array($siswa)) {
                                                                ?>
                                                                    <td><?php echo $aja['Nama'] ?></td>
                                                                <?php } ?>

                                                            <?php } ?>
                                                        </tr>
                                                    <?php  } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table id="jadwal1" class="table striped" border="1">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Nama Paket</strong></td>
                                                            <td><strong>Limit Waktu</strong></td>
                                                            <td><strong>Mata Pelajaran</strong></td>
                                                            <td><strong>Keterangan</strong></td>
                                                            <td><strong>Jadwal Mulai</strong></td>
                                                            <td><strong>Jadwal Selesai</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $iniuntukkodesoal = $b['KodePsoal'];
                                                    $fahri = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Kode='$iniuntukkodesoal' AND Tipe!='Z' ");
                                                    $isinya = mysqli_fetch_array($fahri);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $isinya['Nama'] ?></td>
                                                        <td><?php echo $isinya['Ukuran'] ?></td>
                                                        <td><?php
                                                            $mapel =  $isinya['Mapel'];
                                                            $mpelajaran = mysqli_query($koneksi, "SELECT * FROM mapel WHERE Tipe!='Z' AND Kode='$mapel' ");
                                                            $in = mysqli_fetch_array($mpelajaran);
                                                            echo $in['MataPelajaran'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $isinya['Keterangan'] ?></td>
                                                        <td><?php echo $b['JadwalMulai'] ?></td>
                                                        <td><?php echo $b['JadwalSelesai'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1<?php echo $b['Kode']; ?>" data-toggle="tab">Pilihan Ganda</a></li>
                                        <li><a href="#tab_2<?php echo $b['Kode']; ?>" data-toggle="tab">Essay</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1<?php echo $b['Kode']; ?>">
                                            <p>* Soal Untuk Pilihan Ganda *</p>
                                            <table id="" class="table striped" border="0">
                                                <tr>
                                                    <td rowspan="2">No</td>
                                                    <td rowspan="2">Soal</td>
                                                    <td colspan="4">
                                                        <div align="center">Opsi Pilihan </div>
                                                    </td>
                                                    <td rowspan="2">Kunci&nbsp;Jawab</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div align="center">a</div>
                                                    </td>
                                                    <td>
                                                        <div align="center">b</div>
                                                    </td>
                                                    <td>
                                                        <div align="center">c</div>
                                                    </td>
                                                    <td>
                                                        <div align="center">d</div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $iniuntukkodesoal = $b['KodePsoal'];    # { KodePsoal }
                                                # tampilkan  table psoal
                                                $fahri12 = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode ='$iniuntukkodesoal' ");
                                                $test = mysqli_fetch_array($fahri12);
                                                $kodepsoal = $test['Kode'];
                                                $kodepsoal2 = $test['Kodepsoal2'];
                                                $no = 1;
                                                $paketsoal = "paketsoal" . $kodepsoal;      # ini untuk memanggil table paket soal
                                                $query = mysqli_query($koneksi, "SELECT * FROM " . $paketsoal . " WHERE Tipe!='Z' AND Kodepg!='' ");
                                                while ($aa = mysqli_fetch_array($query)) {
                                                    $pilihanganda = $aa['Kodepg'];
                                                    $inipilihanganda = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z' AND Kode='$pilihanganda' ");
                                                    while ($inihasilnya = mysqli_fetch_array($inipilihanganda)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo  $inihasilnya['Soal']; ?></td>
                                                            <td><?php echo  $inihasilnya['a']; ?></td>
                                                            <td><?php echo  $inihasilnya['b']; ?></td>
                                                            <td><?php echo  $inihasilnya['c']; ?></td>
                                                            <td><?php echo  $inihasilnya['d']; ?></td>
                                                            <td>
                                                                <center><?php echo  $inihasilnya['Kunci_jawab']; ?></center>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab_2<?php echo $b['Kode']; ?>">
                                            <p>* Soal Untuk Essay *</p>
                                            <table id="" class="table striped" border="0">
                                                <tr>
                                                    <td>No</td>
                                                    <td>Soal</td>
                                                    <td>Jawaban</td>
                                                    <td>Nilai</td>
                                                    <td>Gambar</td>
                                                    <td>Keterangan</td>
                                                </tr>
                                                <?php
                                                $iniuntukkodesoal = $b['KodePsoal'];    # { KodePsoal }
                                                # tampilkan  table psoal
                                                $fahri12 = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode ='$iniuntukkodesoal' ");
                                                $test = mysqli_fetch_array($fahri12);
                                                $kodepsoal = $test['Kode'];
                                                $kodepsoal2 = $test['Kodepsoal2'];
                                                $no = 1;
                                                $paketsoal = "paketsoal" . $kodepsoal;      # ini untuk memanggil table paket soal
                                                $query = mysqli_query($koneksi, "SELECT * FROM " . $paketsoal . " WHERE Tipe!='Z' AND Kodeessay!='' ");
                                                while ($aa = mysqli_fetch_array($query)) {
                                                    $Kodeessay = $aa['Kodeessay'];
                                                    $iniuntukessay = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z' AND Kode='$Kodeessay' ");
                                                    while ($inihasilnya = mysqli_fetch_array($iniuntukessay)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo  $inihasilnya['Soal']; ?></td>
                                                            <td><?php echo  $inihasilnya['Jawaban']; ?></td>
                                                            <td><?php echo  $inihasilnya['Nilai']; ?></td>
                                                            <td><img src="img/<?php echo  $inihasilnya['Foto']; ?>" width="100" height="100" alt=""></td>
                                                            <td><?php echo  $inihasilnya['Keterangan']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <!-- <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info"><i class="fa fa-print"></i> CETAK</button> -->
                            <a href="pdf_jadwal.php?Kode=<?php echo $b['Kode'];  ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> CETAK</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>

    <!-- end Modal   -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#file').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": true,
                "order": [0, "asc"]
            });
            $('#jadwal').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": true,
                "order": [0, "asc"]
            });
        });

        $("#inijadwal").click(function() { // checkbox Penjualanbb

            if ((this).checked == true) {

                $('.nampilJadwal').prop('checked', true);

            } else {

                $('.nampilJadwal').prop('checked', false);

            }

        });
    </script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>