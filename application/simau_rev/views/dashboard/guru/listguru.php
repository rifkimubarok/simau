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
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Import Guru </button></p>
                </div>
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
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="statuss" onchange="reload()">
                                        <option selected value="">-- Pilih Status --</option>
                                        <option value="PNS">PNS</option>
                                        <option value="Guru Honor Sekolah">Guru Honor Sekolah</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped table-bordered table-hover" id="tblguru" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="2%">No</th>
                                        <th width="10%">NIP/NUPTK</th>
                                        <th width="20%">Nama</th>
                                        <th width="5%">JK</th>
                                        <th width="5%">Status</th>
                                        <th width="8%">Jenis PTK</th>
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
<script>
$(document).ready(function () {
  get_sekolah();
  getguru();
  getKec();
  getJenjang();
  $("#kecamatan").change(function () {
    var kec = $(this).val();
    var jenjang = $("#jenjang").val();
    var url = '';
    if (jenjang == '') {
      url = getbasepath() + "dashboard/referensi/getSekolah?kec=" + kec;
    } else {
      url = getbasepath() + "dashboard/referensi/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
    }
    get_sekolah(url);
    reload();
  });

  $("#jenjang").change(function () {
    var jenjang = $(this).val();
    var kec = $("#kecamatan").val();
    var url = '';
    if (kec == '') {
      url = getbasepath() + "dashboard/referensi/getSekolah?jenjang=" + jenjang;
    } else {
      url = getbasepath() + "dashboard/referensi/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
    }
    get_sekolah(url);
    reload();
  });
});
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/application/guru.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/application/referensi.js"></script>

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
    