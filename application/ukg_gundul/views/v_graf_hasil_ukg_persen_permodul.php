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
                <select class="form-control" id="kecamatan" onchange="getGrafNilaipersenPermapel();">
                  <option value="">-- Semua Kecamatan --</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <select class="form-control" id="jenjang" onchange="getGrafNilaipersenPermapel();">
                  <?php 
                      foreach ($jenjang as $jen) {
                          echo "<option value='".$jen->jenjang."'>".$jen->jenjang."</option>";
                      }
                   ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <select class="form-control" id="matpel" onchange="getGrafNilaipersenPermapel();">
                  <option value="">-- Semua Mata Pelajaran --</option>
                	<?php 
                      foreach ($mapel as $map) {
                          echo "<option value='".$map->kd_matpel."'>".$map->matpel."</option>";
                      }
                   ?>
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
		getGrafNilaipersenPermapel();
    getKecamatan();
	});
</script>
<?php } ?>