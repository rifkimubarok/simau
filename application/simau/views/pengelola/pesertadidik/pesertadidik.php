<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DAFTAR PESERTA DIDIK</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <div class="row" style="box-sizing: border-box; border: 1px solid #ccc;">
                                <m style ="line-height: 30px; padding-left: 17px;">Filter Berdasarkan : </m><br>


                                <div class="form-group col-md-3">
                                    <select class="form-control" id="kecamatan">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="jenjang">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="sekolah" onchange="reload()">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped table-bordered table-hover" id="tblpesertadidik" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="2%">No</th>
                                        <th width="10%">NISN</th>
                                        <th width="10%">NIPD</th>
                                        <th width="20%">Nama</th>
                                        <th width="5%">JK</th>
                                        <th width="5%">Kelas</th>
                                        <th  width="5%">Sekolah</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/pengelola/pesertadidik/custom.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Peserta Didik Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
    </div>
    