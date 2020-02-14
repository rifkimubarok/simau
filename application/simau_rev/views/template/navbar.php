<?php
    $session = get_session("user");
    $level = isset($session->level) ? $session->level : 0;

    if($level == '1'){
        ?>
            <li>
                <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-university"></i> Sekolah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/Sekolah"><i class="fa fa-home fa-graduation-cap"></i> Daftar Sekolah</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/guru"><i class="fa fa-home fa-vcard-o"></i> Guru</a>
                </li>
            </ul>
        </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Nilai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                
                <li>
                    <a href="<?php echo base_url(); ?>dashboard/nilai"><i class="fa fa-home fa-file-text"></i> Data Nilai UN</a>
                </li>
            </ul>
        </li>
            <li class="">
                        <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Rekap<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/Jwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Jawaban Terupload</a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo base_url(); ?>dashboard/Rekapjwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Hasil Ujian</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-area-chart"></i> Grafik<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/Analisisjwb/g_jwbpie"><i class="fa fa-home fa-bar-chart-o"></i> Grafik Analisis Butir Soal</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/Analisisjwb/g_jwbnilai""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/Analisisjwb/g_jwbnilaiv""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai Perkecamatan</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/banding_ukg""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Banding Ujian</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-cogs"></i> System<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/Pengguna"><i class="fa fa-home fa-group"></i> Kelola Akun</a>
                    </li>
                </ul>
            </li>
        <?php 
    }
?>
<?php
    if($level == '2'){
        ?>
            <li>
                <a href="<?php echo base_url(); ?>pengelola"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-university"></i> Sekolah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li>
                    <a href="<?php echo base_url(); ?>pengelola/Sekolah"><i class="fa fa-home fa-graduation-cap"></i> Daftar Sekolah</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>pengelola/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>pengelola/guru"><i class="fa fa-home fa-vcard-o"></i> Guru</a>
                </li>
            </ul>
        </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Nilai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                
                <li>
                    <a href="<?php echo base_url(); ?>pengelola/nilai/nilai"><i class="fa fa-home fa-file-text"></i> Data Jumlah Nilai UN</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>pengelola/nilai/rekap"><i class="fa fa-home fa-files-o"></i> Rekapitulasi Kelulusan</a>
                </li>
            </ul>
        </li>
            <li class="">
                        <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Rekap<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Jwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Jawaban Terupload</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Rekapjwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Hasil Ujian</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-area-chart"></i> Grafik<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbpie"><i class="fa fa-home fa-bar-chart-o"></i> Grafik Analisis Butir Soal</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbnilai""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbnilaiv""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai Perkecamatan</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/banding_ukg""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Banding Ujian</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-cogs"></i> System<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>pengelola/Pengguna"><i class="fa fa-home fa-group"></i> Kelola Akun</a>
                    </li>
                </ul>
            </li>
        <?php 
    }
?>
<?php
    if($level == '5' || $level == '6'){
        ?>
        <li>
            <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard/profile"><i class="fa fa-home fa-graduation-cap"></i> Profile Sekolah</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard/jwbpd"><i class="fa fa-home fa-list"></i> List Jawaban</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard/guru"><i class="fa fa-home fa-list"></i> Guru</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard/banding_ukg""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Banding Ujian</a>
        </li>
<?php 
    }
?>
<?php
    if($level == '7' || $level == '8'){
        ?>
            <li>
                <a href="<?php echo base_url(); ?>managemen"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-university"></i> Sekolah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li>
                    <a href="<?php echo base_url(); ?>managemen/Sekolah"><i class="fa fa-home fa-graduation-cap"></i> Daftar Sekolah</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>managemen/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>managemen/guru"><i class="fa fa-home fa-vcard-o"></i> Guru</a>
                </li>
            </ul>
        </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Nilai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                
                <li>
                    <a href="<?php echo base_url(); ?>managemen/nilai/nilai"><i class="fa fa-home fa-file-text"></i> Data Jumlah Nilai UN</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>managemen/nilai/rekap"><i class="fa fa-home fa-files-o"></i> Rekapitulasi Kelulusan</a>
                </li>
            </ul>
        </li>
            <li class="">
                        <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Rekap<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/Jwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Jawaban Terupload</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/Rekapjwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Hasil Ujian</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-area-chart"></i> Grafik<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/Analisisjwb/g_jwbpie"><i class="fa fa-home fa-bar-chart-o"></i> Grafik Analisis Butir Soal</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/Analisisjwb/g_jwbnilai""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/Analisisjwb/g_jwbnilaiv""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai Perkecamatan</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>managemen/banding_ukg""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Banding Ujian</a>
                    </li>
                </ul>
            </li>
        <?php 
    }
?>
<?php
    if($level == '9'){
        ?>
            <li>
                <a href="<?php echo base_url(); ?>uptd"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-university"></i> Sekolah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                <li>
                    <a href="<?php echo base_url(); ?>uptd/Sekolah"><i class="fa fa-home fa-graduation-cap"></i> Daftar Sekolah</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>uptd/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>uptd/guru"><i class="fa fa-home fa-vcard-o"></i> Guru</a>
                </li>
            </ul>
        </li>
            <!--  <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Nilai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                
                <li>
                    <a href="<?php echo base_url(); ?>uptd/nilai/nilai"><i class="fa fa-home fa-file-text"></i> Data Jumlah Nilai UN</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>uptd/nilai/rekap"><i class="fa fa-home fa-files-o"></i> Rekapitulasi Kelulusan</a>
                </li>
            </ul>
        </li> -->
            <li class="">
                        <a href="#"><i class="fa fa-bar-chart-o fa-clipboard"></i> Rekap<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>uptd/Jwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Jawaban Terupload</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>uptd/Rekapjwbpd"><i class="fa fa-home fa-file-text"></i> Rekap Hasil Ujian</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-area-chart"></i> Grafik<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>uptd/Analisisjwb/g_jwbpie"><i class="fa fa-home fa-bar-chart-o"></i> Grafik Analisis Butir Soal</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>uptd/Analisisjwb/g_jwbnilai""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>uptd/Analisisjwb/g_jwbnilaiv""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai Perkecamatan</a>
                    </li>
                </ul>
            </li>
        <?php 
    }
?>