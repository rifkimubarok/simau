<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">REKAPITULASI KELULUSAN</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Import Rekap Kelulusan </button></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <table class="table table-striped table-bordered table-hover" id="tbllist" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="7%">No</th>
                                        <th width="10%">Tahun</th>
                                        <th width="10%">Jumlah Peserta</th>
                                        <th width="5%">Lulus</th>
                                        <th width="5%">Tidak Lulus</th>
                                        <th width="8%">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space: nowrap;">
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/uptd/nilai/rekap.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Kelulusan Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
</div>
    
    