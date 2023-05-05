<?php
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
    <title>Halo, <?php echo $data['fullname']; ?> - Aplikasi Enkripsi dan Dekripsi PT Semanta Mulia Transport</title>
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

        <!-- UNTUK MENU  -->
        <?php
        include 'menu.php';
        ?>
        <div class="content-wrapper">
            <div class="page-title">
                <div>
                    <h1><i class="fa fa-file"></i> Sekolah SMK Dharma Patra</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Dekripsi File</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $id_file = $_GET['id_file'];
                            $query = mysqli_query($koneksi, "SELECT * FROM file WHERE id_file='$id_file'");
                            $data2 = mysqli_fetch_array($query);
                            ?>
                            <h3 align="center">Dekripsi File <i style="color:blue"><?php echo $data2['file_name_finish'] ?></i></h3><br>
                            <form class="form-horizontal" method="post" action="decrypt-process.php">
                                <div class="table-responsive">
                                    <table class="table striped">
                                        <tr>
                                            <td>Nama File Sumber</td>
                                            <td>:</td>
                                            <td><?php echo $data2['file_name_source']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama File Enkripsi</td>
                                            <td>:</td>
                                            <td><?php echo $data2['file_name_finish']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ukuran File</td>
                                            <td>:</td>
                                            <td><?php echo $data2['file_size']; ?> KB</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Enkripsi</td>
                                            <td>:</td>
                                            <td><?php echo $data2['tgl_upload']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td><?php echo $data2['keterangan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Masukkan Password Untuk Mendekrip</td>
                                            <td></td>
                                            <td>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="fileid" value="<?php echo $data2['id_file']; ?>">
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile" required><br>
                                                    <input type="submit" name="decrypt_now" value="Dekripsi File" class="form-control btn btn-primary">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#file').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": true,
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