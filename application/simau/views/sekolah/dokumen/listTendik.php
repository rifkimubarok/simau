<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DAFTAR TENDIK PENSIUN</h1>
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
                            <div class="form-group col-md-12 col-sm-6">
                                <p align="right"><button class="btn btn-outline btn-primary" onclick="printdokument()"><i class="fa fa-print"></i>  Cetak Dokumen </button></p>
                            </div>
                        </div>
                            
                            <table class="table table-striped table-bordered table-hover" id="tblguru" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="2%">No</th>
                                        <th width="10%">NIP/NUPTK</th>
                                        <th width="20%">Nama</th>
                                        <th width="5%">Tempat/Tgl Lahir</th>
                                        <th width="5%">Golongan</th>
                                        <th width="8%">Asal Sekolah</th>
                                        <th  width="5%">Jenis PTK</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/sekolah/dokumen/listtendik.js"></script>

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
    