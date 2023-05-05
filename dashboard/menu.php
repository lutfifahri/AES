<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="../assets/images/users.png" alt="User Image"></div>
            <div class="pull-left info">
                <p style="margin-top:-5px;"><?php echo $data['fullname']; ?></p>
                <p class="designation"><?php echo $data['job_title']; ?></p>
                <p class="designation" style="font-size:6pt;">Aktivitas Terakhir: <?php echo $data['last_activity'] ?></p>
            </div>
        </div>
        <?php
        $level = $data['job_title'];  # ADMIN
        if ($level == "ADMIN") {
        ?>
            <ul class="sidebar-menu">
                <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                <li class="treeview"><a href="#"><i class="fa  fa-sitemap"></i><span>Master Siswa</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="siswa.php"><i class="fa fa-circle-o"></i> Siswa</a></li>
                        <li><a href="Kelas.php"><i class="fa fa-circle-o"></i> Kelas</a></li>
                        <li><a href="MataPelajaran.php"><i class="fa fa-circle-o"></i> Mata Pelajaran</a></li>
                        <li><a href="Jurusan.php"><i class="fa fa-circle-o"></i> Jurusan</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa  fa-sitemap"></i><span>Master Bank Soal</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="Pujian.php"><i class="fa fa-circle-o"></i> Peserta Ujian</a></li>
                        <li><a href="Psoal.php"><i class="fa fa-circle-o"></i> Paket Soal</a></li>
                        <li><a href="Gsoal.php"><i class="fa fa-circle-o"></i> Gudang Soal</a></li>
                        <li><a href="Kepaket.php"><i class="fa fa-circle-o"></i> Masukan Soal Ke Paket</a></li>
                        <li><a href="Kelolajadwal.php"><i class="fa fa-circle-o"></i> Kelola Jadwal</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa fa-print"></i><span>Laporan</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="LaporanJadwal.php"><i class="fa fa-circle-o"></i> Laporan Jadwal</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa  fa-bug"></i><span>File</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="encrypt.php"><i class="fa fa-circle-o"></i> Enkripsi</a></li>
                        <li><a href="decrypt.php"><i class="fa fa-circle-o"></i> Dekripsi</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa fa-gears (alias)"></i><span>Managemen User</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="datauser.php"><i class="fa fa-circle-o"></i> Data User</a></li>
                        <li><a href="ubahpassword.php"><i class="fa fa-circle-o"></i> Ubah Password</a></li>
                    </ul>
                </li>
                <li><a href="logout.php"><i class="fa  fa-sign-out"></i><span>Sign-Out</span></a></li>
            </ul>
        <?php } ?>
        <?php
        $level = $data['job_title'];  # ADMIN
        if ($level == "DOSEN") {
        ?>
            <ul class="sidebar-menu">
                <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                <li class="treeview"><a href="#"><i class="fa  fa-sitemap"></i><span>Master Bank Soal</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="Kelolajadwal.php"><i class="fa fa-circle-o"></i> Kelola Jadwal</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa fa-print"></i><span>Laporan</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="LaporanJadwal.php"><i class="fa fa-circle-o"></i> Laporan Jadwal</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa fa-gears (alias)"></i><span>Managemen User</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="ubahpassword.php"><i class="fa fa-circle-o"></i> Ubah Password</a></li>
                    </ul>
                </li>
                <li><a href="logout.php"><i class="fa  fa-sign-out"></i><span>Sign-Out</span></a></li>
            </ul>
        <?php } ?>
    </section>
</aside>