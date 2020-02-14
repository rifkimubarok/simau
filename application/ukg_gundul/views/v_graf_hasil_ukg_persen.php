<?php 
if ($this->session->userdata('admin_level') == 'guru' || $this->session->userdata('admin_level') == 'admin') {
  ?>
<div class="panel panel-info">
<div class="panel-heading">Grafik Hasil UKG Guru</div>
<div class="panel-body">
	<div class="col-md-12">
        <div class="row" style="box-sizing: border-box; border: 1px solid #ccc;">
            <m style ="line-height: 30px; padding-left: 17px;">Filter Berdasarkan : </m><br>
            <div class="form-group col-md-3">
                <select class="form-control" id="kecamatan" onchange="getGrafNilaipersen();">
                	<option value="">-- Semua Kecamatan --</option>
                </select>
            </div>
        </div>
        <br>
      </div>
    <div id="Grafik"></div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>___/script/application/grafik/custom.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		getGrafNilaipersen();
        getKecamatan();
	});
</script>
<?php } ?>