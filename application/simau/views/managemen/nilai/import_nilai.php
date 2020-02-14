<div  class="col-md-12">
     <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar"
          aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="progressStatus">
            <p id="progresstext" name="progresstext"></p>
          </div>
        </div>
</div>
<div class="col-md-12">
    <div class="form-group col-md-12">
        <input type="file" name="file" id="file" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group col-md-3">
        <button class="btn-primary form-control" onclick="uploadFile()">Upload</button>
    </div>
</div>

<div class="col-lg-12 col-md-6" id="hasilImport" style="display: none;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <p align="right"><button class="btn btn-outline btn-primary" onclick="saveDataFix()"><i class="fa fa-save"></i>  Simpan Data Ini </button></p>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-striped table-bordered table-hover" id="tblImport" width="100%">
                        <thead>
                            <tr valign="middle">
                                <th width="5%">No</th>
                                <th width="5%">Kode</th>
                                <th width="10%">Nama Sekolah</th>
                                <th width="5%">S</th>
                                <th width="5%">Peserta</th>
                                <th width="8%">TL(%)</th>
                                <th width="8%">Rank</th>
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