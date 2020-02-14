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
                                                <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>NIPD</label>
                                                <input class="form-control" type="text" name="nipd" id="nipd" placeholder="NIPD" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>NISN</label>
                                                <input class="form-control" type="text" name="nisn" id="nisn" placeholder="NISN" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>Jenis Kelamin</label>
                                                <input class="form-control" type="text" name="jk" id="jk" placeholder="Jenis Kelamin" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Tempat Lahir</label>
                                                <input class="form-control" type="text" name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Tanggal Lahir</label>
                                                <input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik" id="nik" placeholder="NIK" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Agama</label>
                                                <input class="form-control" type="text" name="agama" id="agama" placeholder="Agama" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Alamat</label>
                                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>RT</label>
                                                <input class="form-control" type="text" name="rt" id="rt" placeholder="RT" required>
                                            </div>
                                            <div class="form-group col-lg-2">
                                            <label>RW</label>
                                                <input class="form-control" type="text" name="rw" id="rw" placeholder="RW" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Dusun</label>
                                                <input class="form-control" type="text" name="dusun" id="dusun" placeholder="Dusun" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kelurahan</label>
                                                <input class="form-control" type="text" name="kelurahan" id="kelurahan" placeholder="Kelurahan" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kecamatan</label>
                                                <input class="form-control" type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Kode Pos</label>
                                                <input class="form-control" type="text" name="kode_pos" id="kode_pos" placeholder="Kode Pos" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Jenis Tinggal</label>
                                                <input class="form-control" type="text" name="jenis_tinggal" id="jenis_tinggal" placeholder="Jenis Tinggal" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Alat Transportasi</label>
                                                <input class="form-control" type="text" name="alat_transport" id="alat_transport" placeholder="Alat Transportasi" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Telepon</label>
                                                <input class="form-control" type="text" name="telepon" id="Telepon" placeholder="telepon" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>HP</label>
                                                <input class="form-control" type="text" name="hp" id="hp" placeholder="HP" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Email</label>
                                                <input class="form-control" type="text" name="email" id="email" placeholder="Email" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>SKHUN</label>
                                                <input class="form-control" type="text" name="skhun" id="skhun" placeholder="SKHUN" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>Penerima KPS</label>
                                                <input class="form-control" type="text" name="penerima_kps" id="penerima_kps" placeholder="Penerima KPS" required>
                                            </div>
                                            <div class="form-group col-lg-3">
                                            <label>No KPS</label>
                                                <input class="form-control" type="text" name="no_kps" id="no_kps" placeholder="No KPS" required>
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
                                                <input class="form-control" type="text" name="nama_ayah" id="nama_ayah" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_ayah" id="thn_lahir_ayah" placeholder="Tahun Lahir" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_ayah" id="jenjang_ayah" placeholder="Jenjang" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" placeholder="Pekerjaan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_ayah" id="penghasilan_ayah" placeholder="Penghasilan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_ayah" id="nik_ayah" placeholder="NIK" required>
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
                                                <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_ibu" id="thn_lahir_ibu" placeholder="Tahun Lahir" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_ibu" id="jenjang_ibu" placeholder="Jenjang" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" placeholder="Pekerjaan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_ibu" id="penghasilan_ibu" placeholder="Penghasilan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_ibu" id="nik_ibu" placeholder="NIK" required>
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
                                                <input class="form-control" type="text" name="nama_wali" id="nama_wali" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Tahun Lahir</label>
                                                <input class="form-control" type="text" name="thn_lahir_wali" id="thn_lahir_wali" placeholder="Tahun Lahir" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Jenjang</label>
                                                <input class="form-control" type="text" name="jenjang_wali" id="jenjang_wali" placeholder="Jenjang" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Pekerjaan</label>
                                                <input class="form-control" type="text" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="Pekerjaan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>Penghasilan</label>
                                                <input class="form-control" type="text" name="penghasilan_wali" id="penghasilan_wali" placeholder="Penghasilan" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                            <label>NIK</label>
                                                <input class="form-control" type="text" name="nik_wali" id="nik_wali" placeholder="NIK" required>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>


                            
                                <div id="menu4" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group col-lg-4">
                                            <label>Rombongan Belajar</label>
                                                <input class="form-control" type="text" name="rombel" id="rombel" placeholder="Rombongan Belajar" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Peserta UN</label>
                                                <input class="form-control" type="text" name="no_peserta_un" id="no_peserta_un" placeholder="No Peserta UN" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Seri Ijazah</label>
                                                <input class="form-control" type="text" name="no_seri_ijazah" id="no_seri_ijazah" placeholder="No Seri Ijazah" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Penerima KIP</label>
                                                <input class="form-control" type="text" name="penerima_kip" id="penerima_kip" placeholder="Penerima KIP" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No KIP</label>
                                                <input class="form-control" type="text" name="no_kip" id="no_kip" placeholder="No KIP" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Nama KIP</label>
                                                <input class="form-control" type="text" name="nama_kip" id="nama_kip" placeholder="Nama KIP" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No KKS</label>
                                                <input class="form-control" type="text" name="no_kks" id="no_kks" placeholder="No KKS" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Registrasi Akta</label>
                                                <input class="form-control" type="text" name="no_reg_akta" id="no_reg_akta" placeholder="No Registrasi Akta" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Bank</label>
                                                <input class="form-control" type="text" name="bank" id="bank" placeholder="Bank" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>No Rekening</label>
                                                <input class="form-control" type="text" name="no_rek" id="no_rek" placeholder="No Rekening" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Nama Rekening</label>
                                                <input class="form-control" type="text" name="nama_rek" id="nama_rek" placeholder="Nama Rekening" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Layak PIP</label>
                                                <input class="form-control" type="text" name="layak_pip" id="layak_pip" placeholder="Layak PIP" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Alasan Layak</label>
                                                <input class="form-control" type="text" name="alasan_layak" id="alasan_layak" placeholder="Alasan Layak" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Kebutuhan Khusus</label>
                                                <input class="form-control" type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" placeholder="Kebutuhan Khusus" required>
                                            </div>
                                            <div class="form-group col-lg-4">
                                            <label>Sekolah Asal</label>
                                                <input class="form-control" type="text" name="sekolah_asal" id="sekolah_asal" placeholder="Sekolah Asal" required>
                                                <input class="form-control" type="hidden" name="kode_sekolah" id="kode_sekolah" placeholder="Kode Sekolah" required>
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