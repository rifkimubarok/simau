<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>UKG Gunung Kidul | Ujian Berbasis Komputer</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo base_url();?>___/img/fav.png" rel="icon" type="image/png">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>___/modern/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>___/modern/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="<?php echo base_url(); ?>___/modern/css/lines.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>___/modern/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="<?php echo base_url(); ?>___/modern/js/jquery.min.js"></script>
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->    
<!-- Nav CSS -->
<link href="<?php echo base_url(); ?>___/modern/css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>___/modern/js/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>___/modern/js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="<?php echo base_url(); ?>___/modern/js/d3.v3.js"></script>
<script src="<?php echo base_url(); ?>___/modern/js/rickshaw.js"></script>
<link href="<?php echo base_url(); ?>___/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet">

</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">UKG GUNUNG KIDUL</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="<?php echo base_url(); ?>___/modern/images/user.png"></a>
	        		<ul class="dropdown-menu">
						<li class="m_2"><a href="#" onclick="return rubah_password();"><i class="fa fa-wrench"></i> Settings</a></li>
						<li class="m_2"><a href="<?php echo base_url() ;?>adm/logout"><i class="fa fa-lock"></i> Logout</a></li>	
	        		</ul>
	      		</li>
			</ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php echo gen_menu1(); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
        <div class="graphs">
          <?php 
            if ($this->uri->segment(2) == '' and ($this->session->userdata('admin_level') == 'guru' || $this->session->userdata('admin_level') == 'admin')) {
              ?>
             	<div class="col_3">
                  <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                            <i class="pull-left fa fa-user user1 icon-rounded"></i>
                            <div class="stats">
                              <h5><strong><?php echo $stat['allSD']; ?></strong></h5>
                              <span>Total Guru SD</span>
                            </div>
                        </div>
                  </div>
                	<div class="col-md-3 widget widget1">
                		<div class="r3_counter_box">
                            <i class="pull-left fa fa-user icon-rounded"></i>
                            <div class="stats">
                              <h5><strong><?php echo $stat['allSMP']; ?></strong></h5>
                              <span>Total Guru SMP</span>
                            </div>
                        </div>
                	</div>
                	<div class="col-md-3 widget widget1">
                		<div class="r3_counter_box">
                            <i class="pull-left fa fa-users user2 icon-rounded"></i>
                            <div class="stats">
                              <h5><strong><?php echo $stat['all']; ?></strong></h5>
                              <span>Total Guru</span>
                            </div>
                        </div>
                	</div>
                	<div class="col-md-3 widget">
                		<div class="r3_counter_box">
                            <i class="pull-left fa fa-list dollar1 icon-rounded"></i>
                            <div class="stats">
                              <h5><strong><?php echo $stat['jmlmapel']; ?></strong></h5>
                              <span>Jumlah Mapel</span>
                            </div>
                        </div>
                	 </div>
                	<div class="clearfix"> </div>
              </div>
              <?php
            }
           ?>
    <div class="content_bottom">
      <?php $this->load->view($p); ?>
		<div class="clearfix"> </div>
	    </div>
			<div class="col-md-12 footer">
	            <p style="font-size: 10px;">Copyright &copy; 2018 UKG Gunung Kidul. All Rights Reserved </p>
		    </div>
		</div>
       </div>
      <!-- /#page-wrapper -->
   </div>

   <div id="tampilkan_modal"></div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>___/modern/js/bootstrap.min.js"></script>

	<?php 
	if ($this->uri->segment(2) == "m_soal" && $this->uri->segment(3) == "edit") {
	?>
	<script src="<?php echo base_url(); ?>___/plugin/ckeditor/ckeditor.js"></script>
	<?php
	}
	?>
	<!-- editor
	<script src="<?php echo base_url(); ?>___/plugin/editor/nicEdit.js"></script>
	 -->

	<script src="<?php echo base_url(); ?>___/plugin/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>___/plugin/datatables/dataTables.bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>___/plugin/jquery_zoom/jquery.zoom.min.js"></script> 
	<script src="<?php echo base_url(); ?>___/js/jquery.countdownTimer.js"></script> 
  <script src="<?php echo base_url();?>___/js/highcharts/highcharts.js"></script>
  <script src="<?php echo base_url();?>___/js/highcharts/data.js"></script>
  <script src="<?php echo base_url();?>___/js/highcharts/series-label.js"></script>
  <script src="<?php echo base_url();?>___/js/highcharts/exporting.js"></script>


	<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	var editor_style = "<?php echo $this->config->item('editor_style'); ?>";
	var uri_js = "<?php echo $this->config->item('uri_js'); ?>";
	</script>
	<script src="<?php echo base_url(); ?>___/js/aplikasi.js"></script> 
</body>
</html>
