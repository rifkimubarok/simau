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
                <div class="panel-heading">
                    <p align="right">
                        <!-- <button class="btn btn-outline btn-primary" onclick="tambahData()">
                            <i class="fa fa-file-excel-o"></i> 
                            Tambah Data Peserta Didik
                        </button> -->
                        <button class="btn btn-outline btn-primary" onclick="importData()">
                            <i class="fa fa-file-excel-o"></i>
                            Import Peserta Didik
                        </button>
                    </p>
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
                                        <th  width="5%">Aksi</th>
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
$(document).ready(function(){
    getSiswa();
    getKec();
    getJenjang();
    get_sekolah();
    $("#kecamatan").change(function () {
        var kec = $(this).val();
        var jenjang = $("#jenjang").val();
        var url = '';
        if(jenjang == ''){
          url = getbasepath()+"dashboard/referensi/getSekolah?kec=" + kec;
        }else{
          url = getbasepath()+"dashboard/referensi/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
        }
        get_sekolah(url);
        reload();
  });
  $("#jenjang").change(function () {
        var jenjang = $(this).val();
        var kec = $("#kecamatan").val();
        var url = '';
        if(kec == ''){
          url = getbasepath()+"dashboard/referensi/getSekolah?jenjang=" + jenjang;
        }else{
          url = getbasepath()+"dashboard/referensi/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
        }
        get_sekolah(url);
        reload();
    });
})
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/application/pesertadidik.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/application/referensi.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
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

<div class="modal fade in" id="modalubahdata" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" style="width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ubah Data Peserta Didik <i class="fa fa-file-excel-o"></i></h4>
            </div>
            <div class="modal-body">
                
                    <div class="col-md-12">
                        <div class="">
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a data-toggle="tab" href="#home">Data Pribadi</a></li>
                              <li><a data-toggle="tab" href="#menu1">Data Ayah</a></li>
                              <li><a data-toggle="tab" href="#menu2">Data Ibu</a></li>
                              <li><a data-toggle="tab" href="#menu3">Data Wali</a></li>
                              <li><a data-toggle="tab" href="#menu4">Data Tambahan</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Nama</label>
                                            <input type="hidden" name="id" id="id">
                                                <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>NIPD</label>
                                                <input class="form-control" type="text" name="nipd" id="nipd" placeholder="NIPD">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>NISN</label>
                                                <input class="form-control" type="text" name="nisn" id="nisn" placeholder="NISN">
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>Jenis Kelamin</label>
                                                <select class="form-control" name="jk" id="jk">
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
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
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik" id="nik" placeholder="NIK">
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
                                                <input class="form-control" type="text" name="dusun" id="dusun" placeholder="Dusun">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kelurahan</label>
                                                <input class="form-control" type="text" name="kelurahan" id="kelurahan" placeholder="Kelurahan">
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
                                            <label>Jenis Tinggal</label>
                                                <input class="form-control" type="text" name="jenis_tinggal" id="jenis_tinggal" placeholder="Jenis Tinggal">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Alat Transportasi</label>
                                                <input class="form-control" type="text" name="alat_transport" id="alat_transport" placeholder="Alat Transportasi">
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
                                            <label>SKHUN</label>
                                                <input class="form-control" type="text" name="skhun" id="skhun" placeholder="SKHUN">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Penerima KPS</label>
                                                <input class="form-control" type="text" name="penerima_kps" id="penerima_kps" placeholder="Penerima KPS">
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>No KPS</label>
                                                <input class="form-control" type="text" name="no_kps" id="no_kps" placeholder="No KPS">
                                                <input type="hidden" name="kode_sekolah" id="kode_sekolah">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu1" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Nama</label>
                                                <input class="form-control" type="text" name="nama_ayah" id="nama_ayah" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_ayah" id="thn_lahir_ayah" placeholder="Tahun Lahir">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_ayah" id="jenjang_ayah" placeholder="Jenjang">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" placeholder="Pekerjaan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_ayah" id="penghasilan_ayah" placeholder="Penghasilan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_ayah" id="nik_ayah" placeholder="NIK">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu2" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Nama</label>
                                                <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_ibu" id="thn_lahir_ibu" placeholder="Tahun Lahir">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_ibu" id="jenjang_ibu" placeholder="Jenjang">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" placeholder="Pekerjaan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_ibu" id="penghasilan_ibu" placeholder="Penghasilan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_ibu" id="nik_ibu" placeholder="NIK">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu3" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>Nama</label>
                                                <input class="form-control" type="text" name="nama_wali" id="nama_wali" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_wali" id="thn_lahir_wali" placeholder="Tahun Lahir">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_wali" id="jenjang_wali" placeholder="Jenjang">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="Pekerjaan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_wali" id="penghasilan_wali" placeholder="Penghasilan">
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_wali" id="nik_wali" placeholder="NIK">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>


                            
                                <div id="menu4" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                                <label>Rombongan Belajar(Tingkat - Jurusan - No Jurusan)</label>
                                                <div class="col-md-3">
                                                    <input class="form-control" type="text" name="kelas" id="kelas" placeholder="Tingkat">
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="Jurusan">
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="form-control" type="text" name="buntut" id="buntut" placeholder="No Jurusan">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-5">
                                            <label>No Peserta UN</label>
                                                <input class="form-control" type="text" name="no_peserta_un" id="no_peserta_un" placeholder="No Peserta UN">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Seri Ijazah</label>
                                                <input class="form-control" type="text" name="no_seri_ijazah" id="no_seri_ijazah" placeholder="No Seri Ijazah">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Penerima KIP</label>
                                                <input class="form-control" type="text" name="penerima_kip" id="penerima_kip" placeholder="Penerima KIP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No KIP</label>
                                                <input class="form-control" type="text" name="no_kip" id="no_kip" placeholder="No KIP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Nama KIP</label>
                                                <input class="form-control" type="text" name="nama_kip" id="nama_kip" placeholder="Nama KIP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No KKS</label>
                                                <input class="form-control" type="text" name="no_kks" id="no_kks" placeholder="No KKS">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Registrasi Akta</label>
                                                <input class="form-control" type="text" name="no_reg_akta" id="no_reg_akta" placeholder="No Registrasi Akta">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Bank</label>
                                                <input class="form-control" type="text" name="bank" id="bank" placeholder="Bank">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Rekening</label>
                                                <input class="form-control" type="text" name="no_rek" id="no_rek" placeholder="No Rekening">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Nama Rekening</label>
                                                <input class="form-control" type="text" name="nama_rek" id="nama_rek" placeholder="Nama Rekening">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Layak PIP</label>
                                                <input class="form-control" type="text" name="layak_pip" id="layak_pip" placeholder="Layak PIP">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Alasan Layak</label>
                                                <input class="form-control" type="text" name="alasan_layak" id="alasan_layak" placeholder="Alasan Layak">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Kebutuhan Khusus</label>
                                                <input class="form-control" type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" placeholder="Kebutuhan Khusus">
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Sekolah Asal</label>
                                                <input class="form-control" type="text" name="sekolah_asal" id="sekolah_asal" placeholder="Sekolah Asal">
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
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
    