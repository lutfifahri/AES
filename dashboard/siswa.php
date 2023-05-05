<?php
session_start();
include '../koneksi.php';

$sql = 'CREATE TABLE siswa ( ' .
    'id int NOT NULL AUTO_INCREMENT, ' .
    'Kode char(120) NOT NULL, ' .
    'File char(120) NOT NULL, ' .
    'Nama char(120) NOT NULL, ' .
    'Nisn char(120) NOT NULL, ' .
    'Jk char(120) NOT NULL, ' .
    'TempatLahir char(120) NOT NULL, ' .
    'TanggalLahir char(120) NOT NULL, ' .
    'AnakKe char(120) NOT NULL, ' .
    'Alamat char(120) NOT NULL, ' .
    'NoHp char(120) NOT NULL, ' .
    'NamaAyah char(120) NOT NULL, ' .
    'PekerjaanAyah char(120) NOT NULL, ' .
    'AlamatAyah char(120) NOT NULL, ' .
    'NoHpAyah char(120) NOT NULL, ' .
    'NamaIbu char(120) NOT NULL, ' .
    'PekerjaanIbu char(120) NOT NULL, ' .
    'AlamatIbu char(120) NOT NULL, ' .
    'NoHpIbu char(120) NOT NULL, ' .
    'NamaWali char(120) NOT NULL, ' .
    'PekerjaanWali char(120) NOT NULL, ' .
    'AlamatWali char(120) NOT NULL, ' .
    'NoHpWali char(120) NOT NULL, ' .
    'TransportasiSiswa char(120) NOT NULL, ' .
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
                    <h1><i class="fa fa-circle-o"></i>&nbsp;Siswa</h1>
                </div>
                <div>
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home fa-lg"></i></li>
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Data Siswa</li>
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
                                            <td width="5%"><strong>No</strong></td>
                                            <td width="20%"><strong>NISN</strong></td>
                                            <td width="20%"><strong>Nama</strong></td>
                                            <td width="20%"><strong>Jenis&nbsp;Kelamin</strong></td>
                                            <td width="20%"><strong>Tempat, Lahir</strong></td>
                                            <td width="15%"><strong>Anak Ke</strong></td>
                                            <td width="10%"><strong>No Hp</strong></td>
                                            <td width="10%"><strong>Transportasi&nbsp;Ke&nbsp;Sekolah</strong></td>
                                            <td width="30%"><strong>
                                                    <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Opsi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
                                                </strong></td>
                                        </tr>
                                    </thead>
                                    <?php
                                    # untuk koneksi ke database
                                    include '../koneksi.php';

                                    # tampilkan table siswa
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Tipe!='Z' ");
                                    while ($a = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td width="5%"><?php echo $no++; ?></td>
                                            <td width="20%"><?php echo $a['Nisn'] ?></td>
                                            <td width="20%"><?php echo $a['Nama'] ?></td>
                                            <td width="20%">
                                                <?php $test = $a['Jk'];
                                                if ($test == 'L') {
                                                    echo 'Laki-Laki';
                                                } else {
                                                    echo 'Perempuan';
                                                }
                                                ?>
                                            </td>
                                            <td width="20%"><?php echo $a['TempatLahir'] ?>, <?php echo $a['TanggalLahir'] ?></td>
                                            <td width="15%"><?php echo $a['AnakKe'] ?></td>
                                            <td width="10%"><?php echo $a['NoHp'] ?></td>
                                            <td width="10%"><?php echo $a['TransportasiSiswa'] ?></td>
                                            <td width="30%"><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalView<?php echo $a['id']; ?>"><i class="fa fa-eye"></i></a>&nbsp;<a href="#" data-toggle="modal" data-target="#modalEdit<?php echo $a['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></a>&nbsp;<a href="hapus-siswa.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
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
    $kuery = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Tipe!='Z'");
    while ($b = mysqli_fetch_array($kuery)) {
    ?>

        <!-- Modal View  -->
        <div id="modalView<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">
                            <p id="paragraf1">Detail Biodata Siswa</p>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-md-3 px-3 py-2">
                                    <figure class="figure">
                                        <center> <img src="img/<?php echo $b['File']; ?>" class="figure-img img-fluid rounded" alt="...."></center>
                                        <figcaption class="figure-caption text-center" id="paragraf1">NISN : <?php echo $b['Nisn'] ?></figcaption>
                                    </figure>
                                </div>
                                <div class="col-md">
                                    <div class="card-body">
                                        <table class="table table-sm table-responsive-sm nowrap" width="100%" id="paragraf1">
                                            <tr>
                                                <th>Nama</th>
                                                <th>:</th>
                                                <td><?php echo $b['Nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">NISN</th>
                                                <th width="10%">:</th>
                                                <td><?php echo $b['Nisn'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tempat & Tanggal Lahir</th>
                                                <th>:</th>
                                                <td><?php echo $b['TempatLahir'] ?>, <?php echo $b['TanggalLahir'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Anak Ke</th>
                                                <th>:</th>
                                                <td><?php echo $b['AnakKe'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <th>:</th>
                                                <td><?php echo $b['Alamat'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Hp</th>
                                                <th>:</th>
                                                <td><?php echo $b['NoHp'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ayah</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NamaAyah'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NamaAyah'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan Ayah</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['PekerjaanAyah'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['PekerjaanAyah'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat Ayah</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['AlamatAyah'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['AlamatAyah'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Hp Ayah</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NoHpAyah'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NoHpAyah'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ibu</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NamaIbu'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NamaIbu'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan Ibu</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['PekerjaanIbu'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['PekerjaanIbu'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat Ibu</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['AlamatIbu'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['AlamatIbu'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Hp Ibu</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NoHpIbu'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NoHpIbu'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Wali</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NamaWali'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NamaWali'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan Wali</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['PekerjaanWali'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['PekerjaanWali'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat Wali</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['AlamatWali'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['AlamatWali'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>No Hp Wali</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['NoHpWali'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['NoHpWali'];
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Transportasi Siswa</th>
                                                <th>:</th>
                                                <td><?php $a =  $b['TransportasiSiswa'];
                                                    if ($a == "") {
                                                        echo '<em>* Data Belum Diisi ......*</em>';
                                                    } else {
                                                        echo $b['TransportasiSiswa'];
                                                    }
                                                    ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal   -->

        <!-- modal Edit  -->
        <div id="modalEdit<?php echo $b['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Biodata Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1<?php echo $b['id']; ?>" data-toggle="tab">Biodata Siswa</a></li>
                                        <li><a href="#tab_2<?php echo $b['id']; ?>" data-toggle="tab">Orang Tua</a></li>
                                        <li><a href="#tab_3<?php echo $b['id']; ?>" data-toggle="tab">Data Wali</a></li>
                                    </ul>
                                    <form action="update-siswa.php?id=<?php echo $b['id']; ?>" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1<?php echo $b['id']; ?>">
                                                <p>* Identitas Siswa *</p>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                                        <input type="file" class="form-control" name="File" value="<?php echo $b['File']; ?>">
                                                        <figure class="figure">
                                                            <img src="img/<?php echo $b['File']; ?>" width="200" height="200" class="figure-img img-fluid rounded" alt="....">
                                                        </figure>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="Kode" class="col-sm-2 col-form-label">Kode</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="<?php echo $b['Kode']; ?>" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NISN" class="col-sm-2 col-form-label">NISN</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="Nisn" value="<?php echo $b['Nisn']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="Nama" value="<?php echo $b['Nama']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="Jk" class="col-sm-2 col-form-label">Jenis&nbsp;Kelamin</label>
                                                    <div class="col-sm-10">
                                                        <select name="Jk" id="" class="form-control">
                                                            <option value="">--Pilih--</option>
                                                            <option value="L" <?php if ($b['Jk'] == 'L') {
                                                                                    echo 'selected';
                                                                                } ?>>Laki-Laki</option>
                                                            <option value="P" <?php if ($b['Jk'] == 'P') {
                                                                                    echo 'selected';
                                                                                } ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NISN" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
                                                    <div class="col-sm-5">
                                                        <textarea name="TempatLahir" id="" cols="2" rows="2" class="form-control" required><?php echo $b['TempatLahir']; ?></textarea>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="date" class="form-control" name="TanggalLahir" value="<?php echo $b['TanggalLahir']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="AnakKe" value="<?php echo $b['AnakKe']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="Alamat" id="" cols="2" rows="2" class="form-control" required><?php echo $b['Alamat']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NoHp" class="col-sm-2 col-form-label">NoHp</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" name="NoHp" value="<?php echo $b['NoHp']; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="TransportasiSiswa" class="col-sm-2 col-form-label">Tranportasi Siswa Ke Sekolah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="TransportasiSiswa" value="<?php echo $b['TransportasiSiswa']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="User" class="col-sm-2 col-form-label">User</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control form-input1" value="<?php echo $data['fullname']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab_2<?php echo $b['id']; ?>">
                                                <p>* Identitas Ayah *</p>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="NamaAyah" value="<?php echo $b['NamaAyah']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="PekerjaanAyah" value="<?php echo $b['PekerjaanAyah']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="AlamatAyah" value="<?php echo $b['AlamatAyah']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NoHpAyah" class="col-sm-2 col-form-label">No.Hp Ayah</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="NoHpAyah" value="<?php echo $b['NoHpAyah']; ?>">
                                                    </div>
                                                </div>
                                                <hr>
                                                <p>* Identitas Ibu *</p>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="NamaIbu" value="<?php echo $b['NamaIbu']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="PekerjaanIbu" value="<?php echo $b['PekerjaanIbu']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="AlamatIbu" value="<?php echo $b['AlamatIbu']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NoHpIbu" class="col-sm-2 col-form-label">No.Hp Ibu</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="NoHpIbu" value="<?php echo $b['NoHpIbu']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_3<?php echo $b['id']; ?>">
                                                <p>Jika Siswa Tidak tinggal Dengan Orang tua, Boleh diisi dengan yang mewakilkannya</p>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="NamaWali" value="<?php echo $b['NamaWali']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="PekerjaanWali" value="<?php echo $b['PekerjaanWali']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="AlamatWali" value="<?php echo $b['AlamatWali']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-bottom:8px">
                                                    <label for="NoHpWali" class="col-sm-2 col-form-label">No.Hp Wali</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="NoHpWali" value="<?php echo $b['NoHpWali']; ?>">
                                                    </div>
                                                </div>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Biodata Siswa</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Orang Tua</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Data Wali</a></li>
                                </ul>
                                <form action="aksi-siswa.php" method="POST" autocomplete="off" id="formAdd" style="margin-bottom:0px" enctype="multipart/form-data">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <p>* Identitas Siswa *</p>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="myclass" name="File">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="Kode" class="col-sm-2 col-form-label">Kode</label>
                                                <div class="col-sm-10">
                                                    <?php
                                                    # Mengambil data dengan kode yang paling besar
                                                    $query  = mysqli_query($koneksi, "SELECT max(Kode) as kodeTerbesar FROM siswa WHERE Tipe!='Z'");
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

                                                    $huruf = "KDS";
                                                    $KodeSiswa = $huruf . sprintf("%03s", $urutan);
                                                    echo '<input type="text" class="form-control" id="myclass" name="Kode" value="' . $KodeSiswa . '" readonly required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NISN" class="col-sm-2 col-form-label">NISN</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="Nisn" placeholder="* Wajib Diisi" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="Nama" placeholder="* Wajib Diisi" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="Jk" class="col-sm-2 col-form-label">Jenis&nbsp;Kelamin</label>
                                                <div class="col-sm-10">
                                                    <select name="Jk" id="" class="form-control">
                                                        <option value="">--Pilih--</option>
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NISN" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
                                                <div class="col-sm-5">
                                                    <textarea name="TempatLahir" id="" cols="2" rows="2" class="form-control" placeholder="* Wajib Diisi" required></textarea>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="date" class="form-control" name="TanggalLahir">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="AnakKe" placeholder="* Wajib Diisi" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                <div class="col-sm-10">
                                                    <textarea name="Alamat" id="" cols="2" rows="2" class="form-control" placeholder="* Wajib Diisi" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NoHp" class="col-sm-2 col-form-label">NoHp</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="NoHp" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="TransportasiSiswa" class="col-sm-2 col-form-label">Tranportasi Siswa Ke Sekolah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="TransportasiSiswa">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="User" class="col-sm-2 col-form-label">User</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-input1" name="User" value="<?php echo $data['fullname']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab_2">
                                            <p>* Identitas Ayah *</p>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="NamaAyah">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="PekerjaanAyah">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="AlamatAyah">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NoHpAyah" class="col-sm-2 col-form-label">No.Hp Ayah</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="myclass" name="NoHpAyah">
                                                </div>
                                            </div>
                                            <hr>
                                            <p>* Identitas Ibu *</p>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="NamaIbu">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="PekerjaanIbu">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="AlamatIbu">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NoHpIbu" class="col-sm-2 col-form-label">No.Hp Ibu</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="myclass" name="NoHpIbu">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab_3">
                                            <p>Jika Siswa Tidak tinggal Dengan Orang tua, Boleh diisi dengan yang mewakilkannya</p>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="NamaWali">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="PekerjaanWali">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="myclass" name="AlamatWali">
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:8px">
                                                <label for="NoHpWali" class="col-sm-2 col-form-label">No.Hp Wali</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="myclass" name="NoHpWali">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" name="created_at" value="<?php echo date('Y-m-d') ?>">
                        <input type="hidden" name="updated_at" value="">
                        <input type="hidden" name="Tipe" value="">
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin Menyimpan data ini ?')" class="btn btn-info">Simpan</button>
                        </div>
                        </form>
                    </div>
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