<?php
# koneksi ke database ya!!
include '../koneksi.php';

# ambil data {post} dari form
$username       = $_POST['username'];
$password       = MD5($_POST['password']);
$fullname       = $_POST['fullname'];
$job_title      = $_POST['job_title'];

$query = mysqli_query($koneksi, "INSERT INTO users (`username`, `password`, `fullname`, `job_title`, `job_date`, `last_activity`, `status`, `Tipe`) VALUES ('$username', '$password', '$fullname', '$job_title', '$', '', '', '')");

header("location:datauser.php");
