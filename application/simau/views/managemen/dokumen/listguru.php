<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DAFTAR GURU PENSIUN</h1>
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
                            <div class="form-group col-md-9 col-sm-3">
                                <ul class="nav navbar-top-links navbar-right">
                                    <li class="dropdown">
                                            <button class="btn btn-outline btn-primary dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-print"></i>  Cetak Dokumen 
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a onclick='printdokument()'><i class="fa fa-file-pdf-o"></i> PDF</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a onclick="printexcel()"><i class="fa fa-file-excel-o"></i> Excel</a>
                                            </li>
                                        </ul>
                                        <!-- /.dropdown-user -->
                                    </li>
                                    <!-- /.dropdown -->
                                </ul>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/managemen/dokumen/listguru.js"></script>

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
    