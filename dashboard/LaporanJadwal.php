<?php
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
session_start();
include '../koneksi.php';

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
                    <h1><i class="fa fa-print"></i>&nbsp;Laporan Kelola Jadwal</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Laporan Kelola Jadwal</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="print_jadwal.php" target="_blank" method="GET" autocomplete="off" id="formAdd" style="margin-bottom:0px">
                            <div class="row">
                                <div class="col">
                                    <label for="Nama" class="col-sm-6 col-form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control tglawal" name="tgl_awal" placeholder="First name" value="<?php echo date('Y-m-d') ?>">
                                </div>
                                <div class="col">
                                    <label for="Nama" class="col-sm-6 col-form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control tglakhir" name="tgl_akhir" placeholder="Last name" value="<?php echo date('Y-m-d') ?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" style="margin-bottom:8px">
                                <label for="Paket Ujian" class="col-sm-2 col-form-label">Paket Ujian</label>
                                <div class="col-sm-10">
                                    <select name="Kode" class="form-control gudang" id="KodeGudang">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $data1 = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Tipe!='Z' ");
                                        while ($oke = mysqli_fetch_array($data1)) {
                                        ?>
                                            <option value='<?php echo $oke['Kode'] ?>'>
                                                <?php
                                                $KodePsoal = $oke['KodePsoal'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM psoal WHERE Tipe!='Z' AND Kode = '$KodePsoal' ");
                                                $a = mysqli_fetch_array($query);
                                                echo $a['Nama'];
                                                ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info btn-sm" type="submit" name="Simpan"><i class="fa fa-print"></i>&nbsp; Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end Modal   -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>