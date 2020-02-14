<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DAFTAR TENDIK</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Import Tenaga Pendidik </button></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <table class="table table-striped table-bordered table-hover" id="tbltendik" width="100%">
                                <thead>
                                    <tr valign="middle">
                                        <th width="7%">No</th>
                                        <th width="10%">NIP/NUPTK</th>
                                        <th width="20%">Nama</th>
                                        <th width="7%">JK</th>
                                        <th width="5%">Status</th>
                                        <th width="8%">Jenis PTK</th>
                                        <th  width="7%">Action</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/sekolah/tendik/custom.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data TENDIK Dari Excel <i class="fa fa-file-excel-o"></i></h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade in" id="modalubahdata" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ubah Data Tendik <i class="fa fa-file-excel-o"></i></h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                        <div class="">
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a data-toggle="tab" href="#home">Data Pribadi</a></li>
                              <li><a data-toggle="tab" href="#menu1">Data Kepegawaian</a></li>
                              <li><a data-toggle="tab" href="#menu4">Data Kewarganegaraan</a></li>
                              <li><a data-toggle="tab" href="#menu2">Data Tambahan</a></li>
                              <li><a data-toggle="tab" href="#menu3">Data Lainnya</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form" method="post" role="form" action="<?php echo base_url().'sekolah/tendik/ubah'?>">
                                            <div class="form-group col-lg-6">
                                            <label>Nama</label>
                                            <input type="hidden" name="id" id="id">
                                                <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>NUPTK</label>
                                                <input class="form-control" type="text" name="nuptk" id="nuptk" placeholder="NUPTK">
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>Jenis Kelamin</label>
                                                <input class="form-control" type="text" name="jk" id="jk" placeholder="Jenis Kelamin">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Tempat Lahir</label>
                                                <input class="form-control" type="text" name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Tanggal Lahir</label>
                                                <input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>NIP</label>
                                                <input class="form-control" type="text" name="nip" id="nip" placeholder="NIP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Status Kepegawaian</label>
                                                <input class="form-control" type="text" name="stat_kepegawaian" id="stat_kepegawaian" placeholder="Status Kepegawaian">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Jenis PTK</label>
                                                <input class="form-control" type="text" name="jenis_ptk" id="jenis_ptk" placeholder="Jenis PTK">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Agama</label>
                                                <input class="form-control" type="text" name="agama" id="agama" placeholder="Agama">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Alamat</label>
                                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat">
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>RT</label>
                                                <input class="form-control" type="text" name="rt" id="rt" placeholder="RT">
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>RW</label>
                                                <input class="form-control" type="text" name="rw" id="rw" placeholder="RW">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Dusun</label>
                                                <input class="form-control" type="text" name="nama_dusun" id="nama_dusun" placeholder="Dusun">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kelurahan</label>
                                                <input class="form-control" type="text" name="kelurahan" id="desa" placeholder="Kelurahan">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kecamatan</label>
                                                <input class="form-control" type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kode Pos</label>
                                                <input class="form-control" type="text" name="kode_pos" id="kode_pos" placeholder="Kode Pos">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Telepon</label>
                                                <input class="form-control" type="text" name="telepon" id="telepon" placeholder="telepon">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>HP</label>
                                                <input class="form-control" type="text" name="hp" id="hp" placeholder="HP">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Email</label>
                                                <input class="form-control" type="text" name="email" id="email" placeholder="Email">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Tugas Tambahan</label>
                                                <input class="form-control" type="text" name="tugas_tambahan" id="tugas_tambahan" placeholder="Tugas Tambahan">
                                            </div>
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu1" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>SK CPNS</label>
                                                <input class="form-control" type="text" name="sk_cpns" id="sk_cpns" placeholder="SK CPNS">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tanggal CPNS</label>
                                                <input class="form-control" type="text" name="tgl_cpns" id="tgl_cpns" placeholder="Tanggal CPNS">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>SK Pengangkatan</label>
                                                <input class="form-control" type="text" name="sk_pengangkatan" id="sk_pengangkatan" placeholder="SK Pengangkatan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>TMT Pengangkatan</label>
                                                <input class="form-control" type="text" name="tmt_pengangkatan" id="tmt_pengangkatan" placeholder="TMT Pengangkatan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Lembaga Pengangkatan</label>
                                                <input class="form-control" type="text" name="lembaga_pengangkatan" id="lembaga_pengangkatan" placeholder="Lembaga Pengangkatan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pangkat Golongan</label>
                                                <input class="form-control" type="text" name="pangkat_gol" id="pangkat_gol" placeholder="Pangkat Golongan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Sumber Gaji</label>
                                                <input class="form-control" type="text" name="sumber_gaji" id="sumber_gaji" placeholder="Sumber Gaji">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu2" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Nama Ibu Kandung</label>
                                                <input class="form-control" type="text" name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Nama Ibu Kandung">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Status Kawin</label>
                                                <input class="form-control" type="text" name="status_perkawinan" id="status_perkawinan" placeholder="Status Kawin">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Nama Suami/istri</label>
                                                <input class="form-control" type="text" name="nama_suami_istri" id="nama_suami_istri" placeholder="Nama Suami/istri">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIP Suami/Istri</label>
                                                <input class="form-control" type="text" name="nip_suami_istri" id="nip_suami_istri" placeholder="NIP Suami/Istri">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan Suami/Istri</label>
                                                <input class="form-control" type="text" name="pekerjaan_suami_istri" id="pekerjaan_suami_istri" placeholder="Pekerjaan Suami/Istri">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>TMT PNS</label>
                                                <input class="form-control" type="text" name="tmt_pns" id="tmt_pns" placeholder="TMT PNS">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu3" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Sudah Lisensi Kepala Sekolah</label>
                                                <input class="form-control" type="text" name="lisensi_kepala_sekolah" id="lisensi_kepala_sekolah" placeholder="Sudah Lisensi Kepala Sekolah">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pernah Diklat Kepengawasan</label>
                                                <input class="form-control" type="text" name="pernah_diklat" id="pernah_diklat" placeholder="Pernah Diklat Kepengawasan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Keahlian Braille</label>
                                                <input class="form-control" type="text" name="keahlian_braile" id="keahlian_braile" placeholder="Keahlian Braille">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Keahlian Bahasa Isyarat</label>
                                                <input class="form-control" type="text" name="keahlian_isyarat" id="keahlian_isyarat" placeholder="Keahlian Bahasa Isyarat">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>


                            
                                <div id="menu4" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-4">
                                            <label>NPWP</label>
                                                <input class="form-control" type="text" name="npwp" id="npwp" placeholder="NPWP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Nama Wajib Pajak</label>
                                                <input class="form-control" type="text" name="nama_wajib_pajak" id="nama_wajib_pajak" placeholder="Nama Wajib Pajak">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Kewarganegaraan</label>
                                                <input class="form-control" type="text" name="kewarganegaraan" id="kewarganegaraan" placeholder="Kewarganegaraan">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Bank</label>
                                                <input class="form-control" type="text" name="bank" id="bank" placeholder="Bank">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Rek Bank</label>
                                                <input class="form-control" type="text" name="no_rek" id="no_rek" placeholder="No Rek Bank">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Rek Atas Nama</label>
                                                <input class="form-control" type="text" name="nama_rek" id="nama_rek" placeholder="Rek Atas Nama">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik" id="nik" placeholder="NIK">
                                                <input type="hidden" name="kode_sekolah" id="kode_sekolah">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss='modal'>Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>
    
    