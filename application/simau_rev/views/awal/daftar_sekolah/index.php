
<div class="col col-sm-8 col-md-10 col-centered">
  <div class="panel">
    <div class="panel-body">
      
      <style>
      table.dataTable thead th, table.dataTable thead td {
        padding: 3px;
        background: #ddd;
        border: 1px solid #aaa;
      }

      table.dataTable tbody th, table.dataTable tbody td {
        padding: 3px;
        white-space: no-wrap;
      }
    </style>
      <h5 class="post-title"> <span>DAFTAR SEKOLAH BINAAN DISDIKPORA KAB. GUNUNG KIDUL</span> </h5>
      <form class="form-inline">
        
        <div class='form-group'>
            <select class='form-control input-sm' id='kec'>
            <option value=''>Semua Kecamatan</option>
            <?php 
            foreach ($kecamatan as $a) {
            echo "<option value='$a->kecamatan'>$a->kecamatan</option>";
            }
            ?>
            </select>
        </div>

        <!-- <div class='form-group'>
            <select class='form-control input-sm' id='kab'>
            <option value=''>Semua Kabupaten</option>
            <?php 
            foreach ($kabupaten as $a) {
            echo "<option value='$a->kd_rayon'>$a->kd_rayon</option>";
            }
            ?>
            </select>
        </div> -->
        
        <div class='form-group'>
            <select class='form-control input-sm' id='jenjang'>
            <option value=''>Semua Jenjang</option>
            <?php 
            foreach ($jenjang as $a) {
            echo "<option value='$a->jenjang'>$a->jenjang</option>";
            }
            ?>
            </select>
        </div>
      </form>
      <br>
      <table class="table table-striped table-bordered table-hover" id="calon_list" width="100%">
          <thead>
              <tr valign="middle">
                  <th>No</th>
                  <th>Nama Sekolah</th>
                  <th>Jenjang</th>
                  <th>Kecamatan</th>
                  <!-- <th>Kabupaten</th> -->
                  <th>Alamat</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
        <br>
        <time><i class="fa fa-calendar"></i>Terakhir dilihat : 
        <?php 
          echo date('l, d-m-Y');
          echo (' ');
          echo date('H:i:s');
        ?></time>
      </div>
  </div>
</div>

  <script type="text/javascript" src="<?php echo base_url('assets/script/application/awal/daftar_sekolah/custom.js') ?>"></script>
  
                                
