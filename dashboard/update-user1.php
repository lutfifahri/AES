<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$id             = $_POST['id'];
$username       = $_POST['username'];
$PasswordLama   = Md5($_POST['PasswordLama']);
$PasswordBaru   = MD5($_POST['PasswordBaru']);
$Confirmasi     = MD5($_POST['Confirmasi']);
$fullname       = $_POST['fullname'];
$job_title      = $_POST['job_title'];

$iniuser        = mysqli_query($koneksi, "SELECT * FROM `users` WHERE username = '$username' AND password = '$PasswordLama'");
$cekuser        =   mysqli_num_rows($iniuser);


if ($_POST['PasswordLama'] != '') {
    if ($cekuser > 0) {
        if ($PasswordBaru == $Confirmasi) {
            $PasswordLama   = MD5($_POST['PasswordLama']);
            $PasswordBaru   = MD5($_POST['PasswordBaru']);
            $Confirmasi     = MD5($_POST['Confirmasi']);
            $update = mysqli_query($koneksi, "UPDATE `users` SET password = '$PasswordBaru' WHERE id = '$id'");
            header("location:ubahpassword.php");
        } else {
            echo "<script type='text/javascript'>alert('Maaf Confirmasi Password Tidak sesuai '); window.location='ubahpassword.php';</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Maaf Password Lama Tidak Sesuai. '); window.location='ubahpassword.php';</script>";
    }
} else {
    $update2 = mysqli_query($koneksi, "UPDATE `users` SET username = '$username', fullname = '$fullname', job_title = '$job_title'  WHERE id = '$id'");
    header("location:ubahpassword.php");
}
