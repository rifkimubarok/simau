<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Daftar Pengguna</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="tambahData()"><i class="fa fa-plus"></i>  Tambah User </button> <button class="btn btn-outline btn-primary" onclick="generateuser()"><i class="fa fa-file-excel-o"></i>  Generate User </button></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <table class="table table-striped table-bordered table-hover" id="tblPengguna" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="2%">No</th>
                                        <th width="10%">Nama</th>
                                        <th width="5%">Jabatan</th>
                                        <th width="12%" style="white-space: nowrap;">Sekolah</th>
                                        <th width="8%">User Name</th>
                                        <th width="5%" style="text-align: center">Action</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/pengelola/pengguna/custom.js"></script>

<div class="modal fade in" id="modalTambahData" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Sekolah <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalTambahData">
        </div>
        </div>
      </div>
    </div>
    </div>
    