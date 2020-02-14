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

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/panel/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/panel/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/panel/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/panel/vendor/font-awesome-4/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <center>
                            <img height="100" src="<?php echo base_url(); ?>assets/image/logo.png">
                            <div class="title">
                                <h3 style="margin: 0;">Selamat Datang</h3>
                                <br>
                            </div>
                            </center>
                        </div>
                        
                        <?php
                        $attributes = array('name' => 'captcha_form', 'id' => 'captcha_form');
                        echo form_open("auth/cek_login", $this->uri->uri_string(), $attributes);
                        ?>
                        <fieldset>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <br>                                
                        <?php
                        if ($captcha_form) {
                            ?>
                            <p align="center"><?php echo $captcha_html; ?></p>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control" id="secure" name="secure" placeholder="Kode Pengaman">
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                        <button type="submit" class="btn btn-info btn-login form-control" id="btnLogin" name="register">Masuk</button><br><br>
                        </fieldset>
                        <?php
                        echo form_close();
                        ?>      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/panel/vendor/jquery/jquery2.2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/panel/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/panel/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/panel/dist/js/sb-admin-2.js"></script>

</body>

</html>
