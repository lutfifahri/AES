<?php
session_start();
include '../koneksi.php';

$sql = 'CREATE TABLE mapel ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'NamaSingkat char(120) NOT NULL, ' .
    'MataPelajaran char(120) NOT NULL, ' .
    'created_at date NOT NULL, ' .
    'updated_at char(10) NOT NULL, ' .
    'User char(120) NOT NULL, ' .
    'Tipe char(120) NOT NULL, ' .
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
                    <h1><i class="fa fa-circle-o"></i>&nbsp;Mata Pelajaran</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Data Mata Pelajaran</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                                <br><br>
                                <table id="file" class="table striped">
                                    <thead>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td><strong>Nama Guru</strong></td>
                                            <td><strong>Mata Pelajaran</strong></td>
                                            <td><strong>
                                                    <center>Opsi</center>
                                                </strong></td>
                                        </tr>
                                    </thead>
                                    <?php
                                    # untuk koneksi ke database
                                    include '../koneksi.php';

                                    # tampilkan table mapel
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE Tipe!='Z' ");
                                    while ($a = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $a['NamaSingkat'] ?></td>
                                            <td><?php echo $a['MataPelajaran'] ?></td>
                                            <td>
                                                <center><a href="#" data-toggle="modal" data-target="#modalEdit<?php echo $a['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></a>&nbsp;<a href="hapus-mapel.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></center>
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
    $kuery = mysqli_query($koneksi, "SELECT * FROM mapel WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
    ?>
        <!-- modal Edit  -->
        <div id="modalEdit<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="update-mapel.php?id=<?php echo $b['id']; ?>" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px" enctype="multipart/form-data">
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Kode" class="col-sm-2 col-form-label">Kode</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" value="<?php echo $b['id']; ?>" name="id">
                                            <input type="text" class="form-control" value="<?php echo $b['Kode']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="NamaSingkat" class="col-sm-2 col-form-label">Nama Singkat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="NamaSingkat" value="<?php echo $b['NamaSingkat']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="MataPelajaran" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="MataPelajaran" value="<?php echo $b['MataPelajaran']; ?>">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d') ?>">
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <?php } ?>

    <!-- Modal -->
    <div id="modalTambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="aksi-mapel.php" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px">
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="Kode" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <?php
                                # Mengambil data dengan kode yang paling besar
                                $query  = mysqli_query($koneksi, "SELECT max(Kode) as kodeTerbesar FROM mapel WHERE Tipe!='Z'");
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

                                $huruf = "MP";
                                $KodeSiswa = $huruf . sprintf("%03s", $urutan);
                                echo '<input type="text" class="form-control" name="Kode" value="' . $KodeSiswa . '" readonly required>';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="NamaSingkat" class="col-sm-2 col-form-label">Nama Singkat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NamaSingkat" value="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="MataPelajaran" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="MataPelajaran" value="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="User" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-input1" name="User" value="<?php echo $data['fullname']; ?>" readonly>
                            </div>
                        </div>
                        <input type="hidden" name="created_at" value="<?php echo date('Y-m-d') ?>">
                        <input type="hidden" name="updated_at" value="">
                        <input type="hidden" name="Tipe" value="">
                        <div class="modal-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        });
    </script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>