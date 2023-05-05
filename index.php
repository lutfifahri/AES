<?php
include 'koneksi.php';

$sql1 = 'CREATE TABLE users ( ' .
    'username VARCHAR(15) NOT NULL, ' .
    'password VARCHAR(100) NOT NULL, ' .
    'fullname VARCHAR(50) NOT NULL, ' .
    'job_title VARCHAR(50) NOT NULL, ' .
    'job_date TIMESTAMP NOT NULL, ' .
    'last_activity DATETIME NOT NULL, ' .
    'status ENUM("1","2") NOT NULL, ' .
    'primary key ( username ))';
$buattabel1 = mysqli_query($koneksi, $sql1);

$cek = mysqli_query($koneksi, "SELECT count(*) as total FROM users WHERE username ='TEST' ");
$ceks = mysqli_fetch_array($cek);
$tanggal = date('Y-m-d'); // tanggal otomatis
if ($ceks['total'] > 0) {
} else {
    $insert = mysqli_query($koneksi, "INSERT INTO users VALUES  ('admin','827ccb0eea8a706c4c34a16891f84e7b','ADIMINSTRATOR','Admin','" . $tanggal . "','','1')");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi Enkripsi dan Dekripsi Sekolah SMK Dharma Patra</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Metode AES (Advanced Encryption Standard)</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="auth.php" method="post">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input class="form-control" type="text" name="username" placeholder="Username" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" name="login">Login <i class="fa fa-sign-in fa-lg"></i></button><br>
                    <p style="font-size:10pt">Copyright 2022 - Sekolah SMK Dharma Patra</p>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/essential-plugins.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/pace.min.js"></script>
<script src="assets/js/main.js"></script>

</html>