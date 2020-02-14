<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>UKG Gunung Kidul - Ujian Berbasis Komputer</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<?php echo base_url();?>___/img/fav.png" rel="icon" type="image/png">
<meta name="description" content="UKG Gunung Kidul - Ujian Berbasis Komputer">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
	<div class="col-md-4 col-md-offset-4">
	<form action="" method="post" name="fl" id="f_login" onsubmit="return login();">
		
		<div class="panel panel-default top150">
			<div class="panel-body">
				<center>
                            <img height="100" src="<?php echo base_url(); ?>___/img/logo.png">
                            <div class="title">
                                <h3 style="margin: 0;">Selamat Datang</h3>
                                <h2 style="margin: 0;">UKG Guru</h2>
                                <br>
                            </div>
                            </center>
				<div id="konfirmasi"></div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" id="username" name="username" autofocus value="" placeholder="Username" class="form-control" />
				</div> <!-- /field -->
				
				<div class="input-group top15">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="form-control"/>
				</div> <!-- /password -->
				<div class="login-actions">
					<button class="button btn btn-dafault btn-large col-lg-12 top15">Masuk</button>
				</div> <!-- .actions -->
			</div>
		</div> <!-- /login-fields -->
		
		
	</form>
	</div>
	<div class="col-md-4"></div>
</div> 
    

<script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script>
<script type="text/javascript">
	base_url = "<?php echo base_url(); ?>";
	uri_js = "<?php echo $this->config->item('uri_js'); ?>";
</script>
<script src="<?php echo base_url(); ?>___/js/aplikasi_admin.js"></script> 
</body>
</html>
