<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DAFTAR GURU</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-3 col-sm-3">
                                <select class="form-control" id="sekolah" onchange="reload()">
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <select class="form-control" id="bulan" onchange="reload()">
                                    <option value="">-- Bulan --</option>
                                    <?php 
                                        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        for ($i=1 ;$i <= 12; $i++) { 
                                            ?>
                                                <option value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                                            <?php
                                        }
                                     ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <select class="form-control" id="tahun" onchange="reload()">
                                    <option value="">-- Tahun --</option>
                                    <?php 
                                        $tahun = date("Y");
                                        $tahunmulai = $tahun - 10;
                                        $tahunakhir = $tahun + 10;
                                        for ($i=$tahunmulai; $i <=$tahunakhir ; $i++) { 
                                          echo "<option value='".$i."'>".$i."</option>";
                                        }
                                       ?>
                                </select>
                            </div>
                            <div class="form-group col-md-5 col-sm-5">
                                <p align="right"><button class="btn btn-outline btn-primary" onclick="printexcel()"><i class="fa fa-print"></i>  Cetak Dokumen </button></p>
                            </div>
                        </div>
                            
                            <table class="table table-striped table-bordered table-hover" id="tblguru" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="2%">No</th>
                                        <th width="10%">NIP</th>
                                        <th width="20%">Nama</th>
                                        <th width="5%">Golongan</th>
                                        <th width="8%">Asal Sekolah</th>
                                        <th  width="5%">TMT BERKALA</th>
                                        <th  width="5%">TGL BERKALA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/managemen/dokumen/listguruberkala.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Guru Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
    </div>
    