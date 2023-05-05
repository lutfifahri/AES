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

        <?php
        $furqon = mysqli_query($koneksi, "SELECT * FROM users WHERE Tipe!='Z' AND username = '$user' ");
        $j = mysqli_fetch_array($furqon);
        ?>
        <div class="content-wrapper">
            <div class="page-title">
                <div>
                    <h1><i class="fa fa-circle-o"></i>&nbsp;Ubah Password</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>Ubah Password</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="update-user1.php?id=<?php echo $j['id']; ?>" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px" enctype="multipart/form-data">
                                <div class="form-group row" style="margin-bottom:8px">
                                    <label for="Username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" value="<?php echo $j['id']; ?>" name="id">
                                        <input type="text" class="form-control" name="username" value="<?php echo $j['username']; ?>">
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
                                        <input type="text" class="form-control" name="fullname" value="<?php echo $j['fullname']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom:8px">
                                    <label for="Hak Akses" class="col-sm-2 col-form-label">Hak Akses</label>
                                    <div class="col-sm-10">
                                        <select name="job_title" id="job_title" class="form-control">
                                            <option value="">--Pilih--</option>
                                            <option value="ADMIN" <?php if ($j['job_title'] == 'ADMIN') {
                                                                        echo 'selected';
                                                                    } ?>>ADMIN</option>
                                            <option value="DOSEN" <?php if ($j['job_title'] == 'DOSEN') {
                                                                        echo 'selected';
                                                                    } ?>>DOSEN</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d') ?>">
                                <div class="modal-footer">
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>

            <!-- # ini untuk footer  -->
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript">
        /** tambah class active jika di klik */
        var url = window.location;
        // ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
        // ini untuk menu beranak, jadi otomatis akan terbuka sesuai dengan link tujuan
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
    </script>
</body>

</html>