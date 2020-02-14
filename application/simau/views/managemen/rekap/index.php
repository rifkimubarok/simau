<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">REKAP HASIL UJIAN</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Import Relasi DU/DI </button></p>
                </div> -->
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="Kabupaten" onchange="reload()">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="kecamatan" onchange="reload()">
                                    </select>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="tblrekap" width="100%">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th width="4%">No</th>
                                        <th width="10%" id="kab">Kabupaten</th>
                                        <th width="10%" id="kec">Kecamatan</th>
                                        <th width="5%">B. Indonesia</th>
                                        <th width="5%">IPA</th>
                                        <th width="5%">Matematika</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/managemen/rekap/custom.js"></script>
<style type="text/css">
    #modaluploadfile .modal-dialog{
        width: 70%;
    }
</style>
<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Relasi DU/DI Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
    </div>
    