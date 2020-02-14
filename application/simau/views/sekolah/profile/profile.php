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
                                            <div class="form-group col-md-6">
                                                <label>Nama Sekolah</label>
                                                <input type="text" class="form-control" name="namasekolah" id="namasekolah">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>NPSN</label>
                                                <input type="text" class="form-control" name="npsn" id="npsn">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jenjang Pendidikan</label>
                                                <input type="text" class="form-control" name="jenjang" id="jenjang">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Status Sekolah</label>
                                                <input type="text" class="form-control" name="status" id="status">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Alamat Sekolah</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>RT</label>
                                                <input type="text" class="form-control" name="rt" id="rt">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>RW</label>
                                                <input type="text" class="form-control" name="rw" id="rw">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Kode Pos</label>
                                                <input type="text" class="form-control" name="kodepos" id="kodepos">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Kelurahan</label>
                                                <input type="text" class="form-control" name="kelurahan" id="kelurahan">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Kecamatan</label>
                                                <input type="text" class="form-control" name="kecamatan" id="kecamatan">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Kabupaten</label>
                                                <input type="text" class="form-control" name="kabupaten" id="kabupaten">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Provinsi</label>
                                                <input type="text" class="form-control" name="provinsi" id="provinsi">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Negara</label>
                                                <input type="text" class="form-control" name="negara" id="negara">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Posisi Latitude</label>
                                                <input type="text" class="form-control" name="posisilat" id="posisilat">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Posisi Longitude</label>
                                                <input type="text" class="form-control" name="posisilong" id="posisilong">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-3">
                                                <label>SK Pendirian Sekolah</label>
                                                <input type="text" class="form-control" name="sk_pendiri" id="sk_pendiri">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Tanggal SK Pendirian</label>
                                                <input type="text" class="form-control" name="tgl_sk_pendiri" id="tgl_sk_pendiri">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Status Kepemilikan</label>
                                                <input type="text" class="form-control" name="status_milik" id="status_milik">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>SK Izin Operasional</label>
                                                <input type="text" class="form-control" name="sk_izin" id="sk_izin">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Tgl SK Izin Operasional</label>
                                                <input type="text" class="form-control" name="tgl_sk_izin" id="tgl_sk_izin">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Kebutuhan Khusus Dilayani</label>
                                                <input type="text" class="form-control" name="kbth_khss_dlayani" id="kbth_khss_dlayani">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Nomor Rekening</label>
                                                <input type="text" class="form-control" name="no_rek" id="no_rek">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Nama Bank</label>
                                                <input type="text" class="form-control" name="nama_bank" id="nama_bank">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Cabang KCP/Unit</label>
                                                <input type="text" class="form-control" name="cabang_bank" id="cabang_bank">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Rekening Atas Nama</label>
                                                <input type="text" class="form-control" name="nama_rek" id="nama_rek">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>MBS</label>
                                                <input type="text" class="form-control" name="mbs" id="mbs">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Luas Tanah Milik (m<sup>2</sup>)</label>
                                                <input type="text" class="form-control" name="l_tanah_milik" id="l_tanah_milik">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Luas Tanah Bukan Milik (m<sup>2</sup>)</label>
                                                <input type="text" class="form-control" name="l_tanah_nomilik" id="l_tanah_nomilik">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nama Wajib Pajak</label>
                                                <input type="text" class="form-control" name="nama_wajib_pajak" id="nama_wajib_pajak">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>NPWP</label>
                                                <input type="text" class="form-control" name="npwp" id="npwp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-6">
                                                <label>Nomor Telepon</label>
                                                <input type="text" class="form-control" name="no_telp" id="no_telp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nomor Fax</label>
                                                <input type="text" class="form-control" name="no_fax" id="no_fax">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="email">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Website</label>
                                                <input type="text" class="form-control" name="website" id="website">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu3" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Waktu Penyelenggaraan</label>
                                                <input type="text" class="form-control" name="w_penyelenggara" id="w_penyelenggara">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Bersedia Menerima Bos?</label>
                                                <input type="text" class="form-control" name="sedia_bos" id="sedia_bos">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Sertifikat ISO</label>
                                                <input type="text" class="form-control" name="sert_iso" id="sert_iso">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sumber Listrik</label>
                                                <input type="text" class="form-control" name="sumber_listrik" id="sumber_listrik">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Daya Listrik (watt)</label>
                                                <input type="text" class="form-control" name="daya_listrik" id="daya_listrik">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Akses Internet</label>
                                                <input type="text" class="form-control" name="internet" id="internet">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Akses Internet Alternatif</label>
                                                <input type="text" class="form-control" name="internet_alter" id="internet_alter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu4" class="tab-pane fade in">
                                  <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-6">
                                                <label>Kecukupan Air</label>
                                                <input type="text" class="form-control" name="cukup_air" id="cukup_air">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Sekolah Memproses Air Sendiri</label>
                                                <input type="text" class="form-control" name="memproses_air" id="memproses_air">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Air Minum Untuk Siswa</label>
                                                <input type="text" class="form-control" name="air_minum" id="air_minum">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Mayoritas Siswa Membawa Air Minum</label>
                                                <input type="text" class="form-control" name="siswa_air_minum" id="siswa_air_minum">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jumlah Toilet Berkebutuhan Khusus</label>
                                                <input type="text" class="form-control" name="jml_wc_khusus" id="jml_wc_khusus">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Sumber Air Sanitasi</label>
                                                <input type="text" class="form-control" name="air_sanitasi" id="air_sanitasi">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Ketersediaan Air di Lingkungan Sekolah</label>
                                                <input type="text" class="form-control" name="sedia_air" id="sedia_air">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Tipe Jamban</label>
                                                <input type="text" class="form-control" name="tipe_wc" id="tipe_wc">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jumlah Tempat Cuci Tangan</label>
                                                <input type="text" class="form-control" name="jml_tmp_cuci" id="jml_tmp_cuci">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Apakah Sabun dan Air Mengalir pada Tempat Cuci Tangan</label>
                                                <input type="text" class="form-control" name="sabun_air" id="sabun_air">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Laki-laki Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_bisa_laki" id="jml_wc_bisa_laki">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Perempuan Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_bisa_perem" id="jml_wc_bisa_perem">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Bersama Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_bisa_bersama" id="jml_wc_bisa_bersama">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Laki-laki Tidak Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_tidak_laki" id="jml_wc_tidak_laki">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Perempuan Tidak Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_tidak_perem" id="jml_wc_tidak_perem">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jml Jamban Bersama Tidak Dapat Digunakan</label>
                                                <input type="text" class="form-control" name="jml_wc_tidak_bersama" id="jml_wc_tidak_bersama">
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
    <!-- /.row -->
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/script/application/sekolah/profile/custom.js"></script>

<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Import Data Profile Sekolah </h4>
      </div>
      <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
      </div>
    </div>
    </div>
    

<script type="text/javascript">
    $(document).ready(function() {
        $('.nav-tabs').scrollingTabs({
            scrollToTabEdge: true  
        });
    });
</script>