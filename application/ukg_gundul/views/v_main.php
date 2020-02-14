<div class="panel panel-info">
<div class="panel-heading">Selamat datang di Sistem Ujian Online</div>
<div class="panel-body">
    <div class="alert alert-info">Selamat datang <b><?php echo $this->session->userdata('admin_nama')."</b>. Username : <b>".$sess_user; ?></b></div>
  </div>
</div>
<?php 
if ($this->session->userdata('admin_level') == 'guru' || $this->session->userdata('admin_level') == 'admin') {
  ?>
<div class="panel panel-info">
<div class="panel-heading">Grafik Banyak Guru Per Matapelajaran</div>
<div class="panel-body">
    <div id="Grafik"></div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>___/script/application/grafik/custom.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		getGrafikGuruPermapel();
	})
</script>
<?php } ?>