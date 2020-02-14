<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Daftar Siswa</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading pull-right">
                    <?php 
                        if($this->session->userdata('user_id') == "34"){
                            ?>
                                <button class="btn btn-outline btn-primary" onclick="tambahData()">Tambah Siswa <i class="fa fa-plus"></i></button>
                            <?php
                        }else{
                            ?>
                                <div class="btn-group">
                                    <button class="btn btn-outline btn-primary" onclick="tambahData()">Tambah Siswa <i class="fa fa-plus"></i></button>
                                    <button class="btn btn-outline btn-primary" onclick="importData()">Import Dari Excel <i class="fa fa-file-excel-o"></i></button>
                                </div>
                            <?php
                        }
                     ?>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="">
                            <table class="table table-striped table-bordered table-hover" id="tblSekolah" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th>No</th>
                                        <th>NISN </th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Sekolah</th>
                                        <th width="50px">Action</th>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/script/aplication/siswa/listsiswa.js"></script>

<div class="modal fade in" id="modalEditSekolah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ubah Data Sekolah</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div id="isiFormulir">
                    
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
    
  </div>

  <div class="modal fade in" id="modalDeleteSiswa" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Data Siswa</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group col-md-12">
                    <label>NISN</label>
                    <input type="text" name="nisndel" id="nisndel" disabled="" class="form-control">
                    <input type="hidden" name="idsiswadel" id="idsiswadel" value="">
                </div>
                <div class="form-group col-md-12">
                    <label>Nama</label>
                    <input type="text" name="namadel" id="namadel" disabled="" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6">
                        <button class="btn-danger form-control col-md-6" onclick="deleteDataSiswa()"> Hapus </button>
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn-default form-control col-md-6" data-dismiss="modal"> Batal </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Siswa Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div  class="col-lg-12">
                 <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar"
                      aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="progressStatus">
                        <p id="progresstext" name="progresstext"></p>
                      </div>
                    </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-md-12">
                    <input type="file" name="file" id="file" class="form-control">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-md-3">
                    <button class="btn-primary form-control" onclick="uploadFile()">Upload</button>
                </div>
                <div class="form-group col-md-5">
                    <a class="btn-success form-control" href="<?php echo base_url(); ?>assets/files/formatexcel.rar">Download Format Excel <i class="fa fa-download"></i></a>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
    </div>