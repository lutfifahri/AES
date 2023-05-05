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
                    <h1><i class="fa fa-circle-o"></i>&nbsp;User</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Data User</li>
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
                                            <td><strong>Username</strong></td>
                                            <td><strong>Fullname</strong></td>
                                            <td><strong>Levels</strong></td>
                                            <td><strong>
                                                    <center>Opsi</center>
                                                </strong></td>
                                        </tr>
                                    </thead>
                                    <?php
                                    # untuk koneksi ke database
                                    include '../koneksi.php';

                                    # tampilkan table kelas
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE Tipe!='Z' ");
                                    while ($a = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $a['username'] ?></td>
                                            <td><?php echo $a['fullname'] ?></td>
                                            <td><?php echo $a['job_title'] ?></td>
                                            <td>
                                                <center><a href="#" data-toggle="modal" data-target="#modalEdit<?php echo $a['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></a>&nbsp;<a href="hapus-kelas.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></center>
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
    $kuery = mysqli_query($koneksi, "SELECT * FROM users WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
    ?>
        <!-- modal Edit  -->
        <div id="modalEdit<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="update-user.php?id=<?php echo $b['id']; ?>" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px" enctype="multipart/form-data">
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" value="<?php echo $b['id']; ?>" name="id">
                                            <input type="text" class="form-control" name="username" value="<?php echo $b['username']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="PasswordLama" class="col-sm-2 col-form-label">Password Lama</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="PasswordLama" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="PasswordBaru" class="col-sm-2 col-form-label">Password Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="PasswordBaru" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Confirmasi" class="col-sm-2 col-form-label">Confirmasi</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="Confirmasi" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="fullname" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fullname" value="<?php echo $b['fullname']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:8px">
                                        <label for="Hak Akses" class="col-sm-2 col-form-label">Hak Akses</label>
                                        <div class="col-sm-10">
                                            <select name="job_title" id="job_title" class="form-control">
                                                <option value="">--Pilih--</option>
                                                <option value="ADMIN" <?php if ($b['job_title'] == 'ADMIN') {
                                                                            echo 'selected';
                                                                        } ?>>ADMIN</option>
                                                <option value="DOSEN" <?php if ($b['job_title'] == 'DOSEN') {
                                                                            echo 'selected';
                                                                        } ?>>DOSEN</option>
                                            </select>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Biodata Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="aksi-datauser.php" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px">
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="Username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" value="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="password" class="col-sm-2 col-form-label">password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="password" value="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="User" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-input1" name="fullname" value="">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:8px">
                            <label for="Hak Akses" class="col-sm-2 col-form-label">Hak Akses</label>
                            <div class="col-sm-10">
                                <select name="job_title" id="job_title" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="DOSEN">DOSEN</option>
                                </select>
                            </div>
                        </div>
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