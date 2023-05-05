<?php
session_start();
include '../koneksi.php';

$sql = 'CREATE TABLE temp_pg ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'Tipe char(1) NOT NULL, ' .
    'primary key (id))';
$buattabel = mysqli_query($koneksi, $sql);

$sql1 = 'CREATE TABLE temp_essay ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'Tipe char(1) NOT NULL, ' .
    'primary key (id))';
$buattabel = mysqli_query($koneksi, $sql1);


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
        <header class="main-header hidden-print"><a class="logo" href="" style="font-size:13pt"><img src="../assets/images/logoDarma.png" alt="" class="img-responsive"></a>
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
                    <h1><i class="fa fa-circle-o"></i>&nbsp;Pilih Soal Paket</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Data Pilih Soal Paket</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">List Soal</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Bank Soal Pilihan Ganda</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Bank Soal Essay</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="table-responsive">
                                            <br>
                                            <form action="aksi-listsoal.php" method="POST">
                                                <button type="submit" class="btn btn-info" name="submit">Simpan</button>
                                                <br><br>
                                                <p><label for="">Kode &nbsp;</label>
                                                    <input type="text" name="Kodepaket" required>
                                                </p>
                                                <br>
                                                <?php
                                                $inikode = $_GET['Kode'];
                                                echo '<input type="hidden" name="Kodeini" value="' . $inikode . '">';
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table id="table12" class="table striped">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>No</strong></td>
                                                                        <td><strong>Konten Soal</strong></td>
                                                                        <td><strong>Kunci</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                # untuk koneksi ke database
                                                                include '../koneksi.php';

                                                                # tampilkan table kelas
                                                                $no = 1;
                                                                $query = mysqli_query($koneksi, "SELECT * FROM temp_pg  WHERE Tipe!='Z' ");
                                                                while ($a = mysqli_fetch_array($query)) {
                                                                    $Kode = $a['Kode'];
                                                                    $tampil = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda WHERE Tipe!='Z' AND Kode='$Kode' ");
                                                                    $aa = mysqli_fetch_array($tampil);
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $no++; ?></td>
                                                                        <td><?php echo $aa['Soal'] ?></td>
                                                                        <td><?php echo $aa['Kunci_jawab'] ?></td>
                                                                    </tr>
                                                                    <!-- modal Edit  -->
                                                                <?php  } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table id="tableIde" class="table striped">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>No</strong></td>
                                                                        <td><strong>Konten Soal</strong></td>
                                                                        <td><strong>Kunci</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                # untuk koneksi ke database
                                                                include '../koneksi.php';
                                                                # tampilkan table kelas
                                                                $no = 1;
                                                                $query = mysqli_query($koneksi, "SELECT * FROM temp_essay  WHERE Tipe!='Z' ");
                                                                while ($a = mysqli_fetch_array($query)) {
                                                                    $Kode = $a['Kode'];
                                                                    $tampil = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z' AND Kode='$Kode' ");
                                                                    $aa = mysqli_fetch_array($tampil);
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $no++; ?></td>
                                                                        <td><?php echo $aa['Soal'] ?></td>
                                                                        <td><?php echo $aa['Jawaban'] ?></td>
                                                                    </tr>
                                                                    <!-- modal Edit  -->
                                                                <?php  } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab_2">
                                        <div class="table-responsive">
                                            <br>
                                            <form action="aksi-pilihpaket1.php" method="POST">
                                                <button type="submit" class="btn btn-info" name="submit">Simpan</button>
                                                <br><br>
                                                <?php
                                                $kodeini = $_GET['Kode'];
                                                echo '<input type="hidden" name="Kodeini" value="' . $kodeini . '">';
                                                ?>
                                                <table id="table" class="table striped">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>No</strong></td>
                                                            <td><strong>Konten Soal</strong></td>
                                                            <td><strong>Kunci</strong></td>
                                                            <td><strong>
                                                                    <center>Opsi</center>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    # untuk koneksi ke database
                                                    include '../koneksi.php';
                                                    # tampilkan table kelas
                                                    $no = 1;
                                                    $query = mysqli_query($koneksi, "SELECT * FROM pilihan_ganda  WHERE Tipe!='Z' ");
                                                    while ($a = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $a['Soal'] ?></td>
                                                            <td><?php echo $a['Kunci_jawab'] ?></td>
                                                            <td>
                                                                <center><input type="checkbox" value="<?php echo $a['Pilih']; ?>" <?php if ($a['Pilih'] == 'V') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> name="<?php echo $a['id'] . $a['Kunci_jawab']; ?>"></center>
                                                            </td>
                                                        </tr>
                                                        <!-- modal Edit  -->
                                                    <?php  } ?>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="table-responsive">
                                            <form action="aksi-pilihpaket2.php" method="POST">
                                                <br>
                                                <button type="submit" class="btn btn-info" name="submit">Simpan</button>
                                                <br><br>
                                                <?php
                                                $kodeini = $_GET['Kode'];
                                                echo '<input type="hidden" name="Kodeini" value="' . $kodeini . '">';
                                                ?>
                                                <table id="file" class="table striped">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>No</strong></td>
                                                            <td><strong>Konten Soal</strong></td>
                                                            <td><strong>Kunci</strong></td>
                                                            <td><strong>
                                                                    <center>Opsi</center>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    # untuk koneksi ke database
                                                    include '../koneksi.php';

                                                    # tampilkan table kelas
                                                    $no = 1;
                                                    $query = mysqli_query($koneksi, "SELECT * FROM essay WHERE Tipe!='Z' ");
                                                    while ($a = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $a['Soal'] ?></td>
                                                            <td><?php echo $a['Jawaban'] ?></td>
                                                            <td>
                                                                <center><input type="checkbox" value="<?php echo $a['Pilih']; ?>" <?php if ($a['Pilih'] == 'V') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> name="<?php echo $a['id'] . $a['Kode']; ?>"></center>
                                                            </td>
                                                        </tr>
                                                    <?php  } ?>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end Modal   -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table12').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [0, "asc"]
            });
            $('#tableIde').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [0, "asc"]
            });
            $('#file').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [0, "asc"]
            });
            $('#table').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [0, "asc"]
            });
        });
    </script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>