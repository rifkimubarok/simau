<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>    
    
    <title>SIMPELDIK - BP3 WILAYAH VII</title>
    <meta name="generator" content="Bootply">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link href="<?php echo base_url();?>assets/image/logo.png" rel="icon" type="image/png">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Magnific-popup lightbox -->
    <link href="<?php echo base_url();?>assets/css/magnific-popup.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/magnify.min.css" rel="stylesheet">
    <!-- Simple text rotator -->
    <link href="<?php echo base_url();?>assets/css/simpletextrotator.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate css -->
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <!-- Custom styles CSS -->
    <link href="<?php echo base_url();?>assets/css/custom.min.css" rel="stylesheet">
    <!-- Custom styles EasyUI -->
    <link href="<?php echo base_url();?>assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
	
</head>

<body>
	<div class="wrapper">
		<!-- Preloader -->
		<div id="preloader" style="display: none;">
			<div id="preloader-status" style="display: none;">
				<div id="preloader-msg">Loading Website</div>
			</div>
		</div>
		
		<header class="masthead">
			<div class="container bg">
				<div class="row">
					<div class="col col-sm-2 col-md-1">
						<img src="<?php echo base_url();?>assets/image/logo.png" class="logo hidden-xs">
					</div>
					<div class="col col-sm-10 col-md-11">
						<h4 class="title">
							<p class="wow bounceInDown hidden-xs" style="visibility: visible; animation-name: bounceInDown;">DINAS PENDIDIKAN PROVINSI JAWA BARAT</p>
							<p class="wow bounceInDown hidden-xs" style="visibility: visible; animation-name: bounceInDown;">BALAI PELAYANAN DAN PENGAWASAN PENDIDIKAN WILAYAH VII</p>
							<p class="subtitle wow bounceInUp" data-wow-delay="0.2s" style="text-transform: uppercase; visibility: visible; animation-delay: 0.2s; animation-name: bounceInUp;">Sistem Pelaporan Data Pendidikan (SIMPELDIK)</p>
						</h4>	
						<ul class="nav-right visible-lg">
							<li><a href="<?php echo base_url();?>">Home</a></li>
							<li><a href="http://www.jabarprov.go.id/" target="_blank">Provinsi Jawa Barat</a></li>
							<li><a href="http://www.disdik.jabarprov.go.id/" target="_blank">Dinas Pendidikan Provinsi Jawa Barat</a></li>
						</ul>
					</div>
				</div>
			</div>
		</header>

		<nav class="navbar navbar-static" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
						<span class="fa fa-bars"></span>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i>Home</a></li>
						<li><a href="<?php echo base_url();?>awal/Tentang_simpelda"><i class="fa fa-info-circle"></i>Tentang SIMPELDIK</a></li>
						<!--<li><a href="syarat_peserta"><i class="fa fa-briefcase"></i>Persyaratan</a></li>-->
						<!--<li><a href=""><i class="fa fa-calendar"></i>Jadwal</a></li>-->
						<li><a href="<?php echo base_url();?>awal/Daftar_sekolah"><i class="fa fa-building-o"></i>Daftar Sekolah</a></li>
					</ul>
					<ul class="nav navbar-right navbar-nav">
						<li class="dropdown">
							<a href="<?php echo base_url();?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
							<ul class="dropdown-menu" style="padding:12px;">
								<form class="form-inline">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<div class="input-group-btn">
											<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Begin Body -->
		<div class="container">
			<div class="row">
				<div class="col col-sm-4 col-md-3">
					<div id="sidebar wow zoomInUp">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h5 class="panel-title">Login Pengguna</h5>
							</div>
							<div class="panel-body">
                                <?php
                                $attributes = array('name' => 'captcha_form', 'id' => 'captcha_form');
                                echo form_open("auth/cek_login", $this->uri->uri_string(), $attributes);
                                ?>
                                <div class="form-group">
									<input type="text" class="form-control" id="username" name="username" placeholder="Usernamee">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>                                
                                <?php
                                if ($captcha_form) {
                                    ?>
                                    <p><?php echo $captcha_html; ?></p>
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="secure" name="secure" placeholder="Kode Pengaman">
                                    </div>
                                    <?php
                                }
                                ?>
								<button type="submit" class="btn btn-info btn-login" id="btnLogin" name="register">Masuk</button><br><br>
                                <?php
                                echo form_close();
                                ?>                                        
                                <div class="alert alert-danger fade in" id="error" style="display:none;">
                                    <button type="button" class="close">x</button>
                                    <span class="error"></span>
                                </div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $content;?>
				<!-- <div class="col col-sm-8 col-md-9">
					<div class="panel">
						<div class="panel-body">	
                        	<div class="panel panel-default">	
                                <div class="panel-heading">
                                    <h5 class="panel-title">PETA SEKOLAH BINAAN DINAS PENDIDIKAN PROVINSI JAWA BARAT - BP3 WILAYAH VII</h5>
                                </div>	
                            </div>			
                            <div class="pengantar">
                                <?php echo $map['html']; ?>                                                   
                                <br>
                            </div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
    
    <!-- Javascript -->
    <script>var base_url = '/';</script>
	<!-- jQuery -->

	<script src="<?php echo base_url();?>assets/js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.form.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
	<script src="<?php echo base_url();?>assets/js/highcharts-3d.js"></script>
	<script src="<?php echo base_url();?>assets/js/highcharts-exporting.js"></script>
	<!-- Keyboard -->
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
	<!-- WOW - Reveal Animations When You Scroll -->
	<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
	<!-- Custom Scripts -->
	<script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.min.js"></script>

</body>
</html>