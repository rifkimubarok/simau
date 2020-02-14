<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIMAU - DISPORA GUNUNG KIDUL</title>
    <link href="<?php echo base_url();?>assets/image/logo.png" rel="icon" type="image/png">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/panel/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/font-awesome-4/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/panel/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/panel/vendor/jquery-bootstrap-scrolling-tabs-master/dist/jquery.scrolling-tabs.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/formWizard/styleFormWizard.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    table.dataTable thead .sorting:after {
        color: #333;
    }
    #modaltambahdata .modal-dialog{
        width: 70%;
        max-width: 120%;
    }
    #modalubahpassword .modal-dialog{
        width: 50%;
        max-width: 45%;
    }
</style>
</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #bef092">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>pengelola"><span><img src="<?php echo base_url();?>assets/image/logo.png" width='24px' > <b>SIMAU - DISPORA GUNUNG KIDUL</b></span></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Selamat Datang, <?php echo $this->session->userdata('nama')
							?>
							<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a onclick="ubahpassword()" href="#"><i class="fa fa-gear fa-fw"></i> Ubah Nama Pengguna/Kata Sandi
                        </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation" style="background-color: #e1e9d9">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <?php
                            if($this->session->userdata('level')=='2'){
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
                                            <a href="<?php echo base_url(); ?>pengelola/tendik"><i class="fa fa-home fa-vcard-o"></i> Tendik</a>
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
                                                <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbpie"><i class="fa fa-home fa-bar-chart-o"></i> Grafik Capaian Nilai Siswa</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbnilai""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>pengelola/Analisisjwb/g_jwbnilaiv""><i class="fa fa-home fa-bar-chart-o"></i> Grafik Rata-rata Nilai Perkecamatan</a>
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
                            if($this->session->userdata('level')=='5' || $this->session->userdata('level')=='6'){
                               ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>sekolah"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>sekolah/profile"><i class="fa fa-home fa-graduation-cap"></i> Profile Sekolah</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>sekolah/Pesertadidik"><i class="fa fa-home fa-users"></i> Peserta Didik</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>sekolah/jwbpd"><i class="fa fa-home fa-list"></i> List Jawaban</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>sekolah/tendik"><i class="fa fa-home fa-list"></i> Tenaga Kependidikan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>sekolah/guru"><i class="fa fa-home fa-list"></i> Guru</a>
                                </li>
                        <?php 
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/jquery/jquery2.2.min.js"></script>
        <?php echo $_content; ?>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/panel/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url();?>assets/panel/vendor/datatables.net/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/panel/vendor/jquery-bootstrap-scrolling-tabs-master/dist/jquery.scrolling-tabs.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/panel/vendor/jquery-numberformat/akunting.js"></script>
    <script type='text/javascript' src="<?php echo base_url();?>assets/panel/vendor/jquery-numberformat/autoNumeric-2.0-BETA.js"></script> 
    <script type='text/javascript' src="<?php echo base_url();?>assets/panel/vendor/jquery-numberformat/numericpack.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/highcharts.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/js/highcharts-3d.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/js/highcharts-exporting.js" type="text/javascript"></script>
      <!-- <script src="<?php echo base_url();?>assets/js/jquery.jeditable.mini.js"></script> -->
    <script>
    $(document).ready(function() {
        var oldpass = document.getElementById("old").value;
        var newpass = document.getElementById("new").value;
        var verify = document.getElementById("verify").value;
        if(oldpass == null){
            
        }
        document.getElementById('abc').style.display = 'none';
        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
        })
        formatnumberonkeyup();
    });
    function abc(){
        if(document.getElementById('checkbox').checked == false){
            document.getElementById('abc').style.display = 'none';
        }else{
            document.getElementById('abc').style.display = 'inline';
        }
    }
    function formatnumberonkeyup() {
        $('.inputinvoice').autoNumeric('init', {aSep: '.', aDec: ','});
        $(".inputmoney").autoNumeric('init', {aSep: ',', aDec: '.'});
    }
    
    function ubahpassword(){
      $('#modalubahpassword').modal('show');
    }

    function getbasepath(){
        return "<?php echo base_url(); ?>";
    }

    function user_id(){
        return "<?php echo $this->session->userdata('user_id'); ?>";
    }
    </script>
<div class="modal fade in" id="modalubahpassword" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-o"></i> Ubah Nama Pengguna Dan Kata Sandi </h4>
            </div>
            <form id="form" method="post" role="form" action="<?php echo base_url().'change_password/change'?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-lg-6">
                           <label>Nama Pengguna</label>
                                <input value="<?php echo $this->session->userdata('nama') ?>" class="form-control" type="text" name="name" id="name" placeholder="Masukkan Nama Pengguna" required>
                            </div>
                            <div id="abc">
                                <div class="form-group col-lg-6">
                                <label>Kata Sandi Lama</label>
                                    <input class="form-control" type="password" name="old" id="old" placeholder="********">
                                </div>
                                <div class="form-group col-lg-6">
                                <label>Kata Sandi Baru</label>
                                    <input class="form-control" type="password" name="new" id="new" placeholder="**********">
                                </div>
                                <div class="form-group col-lg-6">
                                <label>Masukkan Ulang Kata Sandi</label>
                                    <input class="form-control" type="password" name="verify" id="verify" placeholder="**********">
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="checkbox" name="checkbox" id="checkbox" onclick="abc()" value="1"> Saya ingin mengubah kata sandi saya
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss='modal'>Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>
