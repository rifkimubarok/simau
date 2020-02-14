<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DATA PROFILE SEKOLAH</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="simpanData()"><i class="fa fa-save"></i>  Simpan Data </button> <button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Import Profile Sekolah </button></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="">
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a data-toggle="tab" href="#home">Identitas Sekolah</a></li>
                              <li><a data-toggle="tab" href="#menu1">Data Pelengkap</a></li>
                              <li><a data-toggle="tab" href="#menu2">Kontak Sekolah</a></li>
                              <li><a data-toggle="tab" href="#menu3">Data Periodik</a></li>
                              <li><a data-toggle="tab" href="#menu4">Sanitasi</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>nama</label>
                                                <input class="form-control" type="text" name="nama" id="nama" placeholder="nama" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>nipd</label>
                                                <input class="form-control" type="text" name="nipd" id="nipd" placeholder="nipd" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>nisn</label>
                                                <input class="form-control" type="text" name="nisn" id="nisn" placeholder="nisn" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>jk</label>
                                                <input class="form-control" type="text" name="jk" id="jk" placeholder="jk" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>tmp_lahir</label>
                                                <input class="form-control" type="text" name="tmp_lahir" id="tmp_lahir" placeholder="tmp_lahir" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>tgl_lahir</label>
                                                <input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="tgl_lahir" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>nik</label>
                                                <input class="form-control" type="text" name="nik" id="nik" placeholder="nik" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>agama</label>
                                                <input class="form-control" type="text" name="agama" id="agama" placeholder="agama" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>alamat</label>
                                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="alamat" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>rt</label>
                                                <input class="form-control" type="text" name="rt" id="rt" placeholder="rt" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>rw</label>
                                                <input class="form-control" type="text" name="rw" id="rw" placeholder="rw" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>dusun</label>
                                                <input class="form-control" type="text" name="dusun" id="dusun" placeholder="dusun" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>kelurahan</label>
                                                <input class="form-control" type="text" name="kelurahan" id="kelurahan" placeholder="kelurahan" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>kecamatan</label>
                                                <input class="form-control" type="text" name="kecamatan" id="kecamatan" placeholder="kecamatan" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>kode_pos</label>
                                                <input class="form-control" type="text" name="kode_pos" id="kode_pos" placeholder="kode_pos" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>jenis_tinggal</label>
                                                <input class="form-control" type="text" name="jenis_tinggal" id="jenis_tinggal" placeholder="jenis_tinggal" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>alat_transport</label>
                                                <input class="form-control" type="text" name="alat_transport" id="alat_transport" placeholder="alat_transport" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>telepon</label>
                                                <input class="form-control" type="text" name="telepon" id="telepon" placeholder="telepon" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>hp</label>
                                                <input class="form-control" type="text" name="hp" id="hp" placeholder="hp" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>email</label>
                                                <input class="form-control" type="text" name="email" id="email" placeholder="email" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>skhun</label>
                                                <input class="form-control" type="text" name="skhun" id="skhun" placeholder="skhun" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>penerima_kps</label>
                                                <input class="form-control" type="text" name="penerima_kps" id="penerima_kps" placeholder="penerima_kps" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>no_kps</label>
                                                <input class="form-control" type="text" name="no_kps" id="no_kps" placeholder="no_kps" required>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu1" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>nama_ayah</label>
                                                <input class="form-control" type="text" name="nama_ayah" id="nama_ayah" placeholder="nama_ayah" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>thn_lahir_ayah</label>
                                                <input class="form-control" type="text" name="thn_lahir_ayah" id="thn_lahir_ayah" placeholder="thn_lahir_ayah" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>jenjang_ayah</label>
                                                <input class="form-control" type="text" name="jenjang_ayah" id="jenjang_ayah" placeholder="jenjang_ayah" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>pekerjaan_ayah</label>
                                                <input class="form-control" type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" placeholder="pekerjaan_ayah" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>penghasilan_ayah</label>
                                                <input class="form-control" type="text" name="penghasilan_ayah" id="penghasilan_ayah" placeholder="penghasilan_ayah" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>nik_ayah</label>
                                                <input class="form-control" type="text" name="nik_ayah" id="nik_ayah" placeholder="nik_ayah" required>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu2" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>nama_ibu</label>
                                                <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" placeholder="nama_ibu" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>thn_lahir_ibu</label>
                                                <input class="form-control" type="text" name="thn_lahir_ibu" id="thn_lahir_ibu" placeholder="thn_lahir_ibu" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>jenjang_ibu</label>
                                                <input class="form-control" type="text" name="jenjang_ibu" id="jenjang_ibu" placeholder="jenjang_ibu" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>pekerjaan_ibu</label>
                                                <input class="form-control" type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" placeholder="pekerjaan_ibu" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>penghasilan_ibu</label>
                                                <input class="form-control" type="text" name="penghasilan_ibu" id="penghasilan_ibu" placeholder="penghasilan_ibu" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>nik_ibu</label>
                                                <input class="form-control" type="text" name="nik_ibu" id="nik_ibu" placeholder="nik_ibu" required>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>

                            
                                <div id="menu3" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-6">
                                            <label>nama_wali</label>
                                                <input class="form-control" type="text" name="nama_wali" id="nama_wali" placeholder="nama_wali" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>thn_lahir_wali</label>
                                                <input class="form-control" type="text" name="thn_lahir_wali" id="thn_lahir_wali" placeholder="thn_lahir_wali" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>jenjang_wali</label>
                                                <input class="form-control" type="text" name="jenjang_wali" id="jenjang_wali" placeholder="jenjang_wali" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>pekerjaan_wali</label>
                                                <input class="form-control" type="text" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="pekerjaan_wali" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>penghasilan_wali</label>
                                                <input class="form-control" type="text" name="penghasilan_wali" id="penghasilan_wali" placeholder="penghasilan_wali" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>nik_wali</label>
                                                <input class="form-control" type="text" name="nik_wali" id="nik_wali" placeholder="nik_wali" required>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>


                            
                                <div id="menu4" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-4">
                                            <label>rombel</label>
                                                <input class="form-control" type="text" name="rombel" id="rombel" placeholder="rombel" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_peserta_un</label>
                                                <input class="form-control" type="text" name="no_peserta_un" id="no_peserta_un" placeholder="no_peserta_un" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_seri_ijazah</label>
                                                <input class="form-control" type="text" name="no_seri_ijazah" id="no_seri_ijazah" placeholder="no_seri_ijazah" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>penerima_kip</label>
                                                <input class="form-control" type="text" name="penerima_kip" id="penerima_kip" placeholder="penerima_kip" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_kip</label>
                                                <input class="form-control" type="text" name="no_kip" id="no_kip" placeholder="no_kip" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>nama_kip</label>
                                                <input class="form-control" type="text" name="nama_kip" id="nama_kip" placeholder="nama_kip" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_kks</label>
                                                <input class="form-control" type="text" name="no_kks" id="no_kks" placeholder="no_kks" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_reg_akta</label>
                                                <input class="form-control" type="text" name="no_reg_akta" id="no_reg_akta" placeholder="no_reg_akta" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>bank</label>
                                                <input class="form-control" type="text" name="bank" id="bank" placeholder="bank" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>no_rek</label>
                                                <input class="form-control" type="text" name="no_rek" id="no_rek" placeholder="no_rek" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>nama_rek</label>
                                                <input class="form-control" type="text" name="nama_rek" id="nama_rek" placeholder="nama_rek" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>layak_pip</label>
                                                <input class="form-control" type="text" name="layak_pip" id="layak_pip" placeholder="layak_pip" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>alasan_layak</label>
                                                <input class="form-control" type="text" name="alasan_layak" id="alasan_layak" placeholder="alasan_layak" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>kebutuhan_khusus</label>
                                                <input class="form-control" type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" placeholder="kebutuhan_khusus" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>sekolah_asal</label>
                                                <input class="form-control" type="text" name="sekolah_asal" id="sekolah_asal" placeholder="sekolah_asal" required>
                                                <input class="form-control" type="hidden" name="kode_sekolah" id="kode_sekolah" placeholder="kode_sekolah" required>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>