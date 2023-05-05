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

        <div class="content-wrapper">
            <div class="page-title">
                <div>
                    <h1><i class="fa fa-dashboard"></i> Sekolah SMK Dharma Patra</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p>Sekolah SMK Dharma Patra adalah salah satu pendidikan dengan jenjang
                                Sekolah Menengah Kejuruan (SMK), sama hanya dengan sekolah-sekolah yang
                                lain setiap akan kenaikan kelas atau kelulusan baik itu semester genap atau pun
                                semester ganjil sekolah SMK Dharma Patra selalu mengadakan ujian. Ujian
                                adalah sebagai salah satu tahapan evaluasi dalam proses belajar mengajar karena
                                memiliki peranan yang sangat penting. Melalui ujian akan dapat diketahui tingkat
                                keberhasilan dari proses belajar mengajar yang telah dilakukan. Sistem ujian
                                konvensional dengan media kertas akan efektif dan efesien jika digunakan pada
                                ujian dengan jumlah peserta sedikit, lokasi terpusat dan waktu fleksible . namun
                                berlaku sebaliknya, jika dilakukan pada ujian dengan jumlah peserta sangat
                                banyak, lokasi tersebar dan waktu yang sangat bersamaan seperti Ujian Sekolah
                                tingkat kenaikan kelas ataupun kelulusan pada sekolah SMK Dharma Patra.</p>

                            <h3>Metode AES (Advanced Encryption Standard)</h3>
                            <p> Advanced Encryption Standard (AES) adalah algoritma kriptografi yang menjadi standar algoritma
                                enkripsi kunci simetris pada saat ini. Dalam algoritma kriptografi AES 128, 1blok plainteks berukuran 128 bit
                                terlebih dahulu dikonversi menjadi matriks heksadesimal berukuran 4x4 yang disebut state. Setiap elemen state
                                berukuran 1 byte. Proses enkripsi pada AES merupakan transformasi terhadap state secara berulang dalam 10
                                ronde. Setiap ronde AES membutuhkan satu kunci hasil dari generasi kunci yang menggunakan 2 transformasi
                                yaitu subtitusi dan transformasi. Pada proses enkripsi AES mengunakan 4 transformasi dasar dengan urutan
                                trasformasi subbytes, shiftrows, mixcolumns, dan addroundkey. Sedangkan pada proses dekripsi mengunakan
                                invers semua transformasi dasar pada algoritma AES kecuali addroundkey dengan urutan transformasi
                                invshiftrows, invsubbytes, addroundkey,dan invmixcolumns. Pada data teks, proses enkripsi diawali dengan
                                mengkonversi teks menjadi kode ASCII dalam bilangan heksadesimal yang dibentuk menjadi matriks byte 4x4.
                                Selanjutnya dilakukan beberapa trnsformasi dasar seperti subbytes, shiftrows, mixcolumns, dan addroundkey.
                                Akan tetapi ketika melakukan trasformasi data yang diproses pada setiap trasformasi berupa data biner dari
                                matriks heksadesimal. Kriptografi AES 128 bit memiliki ruang kunci 2128 yang merupakan nilai yang sangat besar
                                dan dianggap aman untuk digunakan sehingga terhindar dari brute force attack</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card" style="background-color: #e67e22;">
                        <div class="card-body">
                            <center><img src="../assets/images/dharma.png" alt="" class="img-responsive"></center>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <?php
                if ($data['job_title'] !== "DOSEN") {
                ?>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalsiswa FROM siswa WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Siswa</h4>
                                <p> <b><?php echo $datauser['totalsiswa']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa  fa-university fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalkelas FROM kelas WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Kelas</h4>
                                <p> <b><?php echo $datauser['totalkelas']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa  fa-cube fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalmapel FROM mapel WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Mata Pelajaran</h4>
                                <p> <b><?php echo $datauser['totalmapel']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa  fa-bell-o fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totaljurusan FROM jurusan WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Jurusan</h4>
                                <p> <b><?php echo $datauser['totaljurusan']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totaljurusan FROM pesertaujian WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Peserta Ujian</h4>
                                <p> <b><?php echo $datauser['totaljurusan']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa fa-newspaper-o fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalpsoal FROM psoal WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Paket Soal</h4>
                                <p> <b><?php echo $datauser['totalpsoal']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa fa-building-o fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalpsoal FROM pilihan_ganda WHERE Tipe!='Z'");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalpsoal1 FROM essay WHERE Tipe!='Z'");
                            $datauser1 = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Gudang Soal</h4>
                                <p> Pilihan Ganda = <b><?php echo $datauser['totalpsoal']; ?></b></p>
                                <p> Essay = <b><?php echo $datauser1['totalpsoal1']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalencrypt FROM file WHERE status='1'");
                            $dataencrypt = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>Enkripsi</h4>
                                <p> <b><?php echo $dataencrypt['totalencrypt']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small warning"><i class="icon fa fa-files-o fa-3x"></i>
                            <div class="info">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT count(*) totaldecrypt FROM file WHERE status='2'");
                                $datadecrypt = mysqli_fetch_array($query);
                                ?>
                                <h4>Dekripsi</h4>
                                <p> <b><?php echo $datadecrypt['totaldecrypt']; ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-small primary"><i class="icon fa fa-user fa-3x"></i>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT count(*) totalpsoal FROM users WHERE Tipe!='Z' ");
                            $datauser = mysqli_fetch_array($query);
                            ?>
                            <div class="info">
                                <h4>User</h4>
                                <p> <b><?php echo $datauser['totalpsoal']; ?></b></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-4">
                    <div class="widget-small primary"><i class="icon fa fa-user fa-3x"></i>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT count(*) totalpsoal FROM jadwal WHERE Tipe!='Z' ");
                        $datauser = mysqli_fetch_array($query);
                        ?>
                        <div class="info">
                            <h4>Jadwal</h4>
                            <p> <b><?php echo $datauser['totalpsoal']; ?></b></p>
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