<!DOCTYPE html>
<html>
<head>
    <title>Import Profile with excel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div style="margin-top:20px"></div>
<div  class="col-lg-12">
     <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar"
          aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="progressStatus">
            <p id="progresstext" name="progresstext"></p>
          </div>
        </div>
</div>
<form id="contactform" action="<?php echo base_url();?>excel/upload/" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file" />
    <p id="showimage"></p>
</form>
<button onclick="savedataimage()">Upload</button>
<br>
<br>


<div class="col-md-8">
    <form>
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
            <label>StatusSekolah</label>
            <input type="text" class="form-control" name="status" id="status">
        </div>
        <div class="form-group col-md-6">
            <label>Alamat Sekolah</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
        </div>
        <div class="form-group col-md-6">
            <label>RT</label>
            <input type="text" class="form-control" name="rt" id="rt">
        </div>
        <div class="form-group col-md-6">
            <label>RW</label>
            <input type="text" class="form-control" name="rw" id="rw">
        </div>
        <div class="form-group col-md-6">
            <label>Kode Pos</label>
            <input type="text" class="form-control" name="kodepos" id="kodepos">
        </div>
        <div class="form-group col-md-6">
            <label>Kelurahan</label>
            <input type="text" class="form-control" name="kelurahan" id="kelurahan">
        </div>
        <div class="form-group col-md-6">
            <label>Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan" id="kecamatan">
        </div>
        <div class="form-group col-md-6">
            <label>Kabupaten</label>
            <input type="text" class="form-control" name="kabupaten" id="kabupaten">
        </div>
        <div class="form-group col-md-6">
            <label>Provinsi</label>
            <input type="text" class="form-control" name="provinsi" id="provinsi">
        </div>
        <div class="form-group col-md-6">
            <label>Negara</label>
            <input type="text" class="form-control" name="negara" id="negara">
        </div>
        <div class="form-group col-md-6">
            <label>Posisi Latitude</label>
            <input type="text" class="form-control" name="posisilat" id="posisilat">
        </div>
        <div class="form-group col-md-6">
            <label>Posisi Longitude</label>
            <input type="text" class="form-control" name="posisilong" id="posisilong">
        </div>
        <div class="form-group col-md-6">
            <label>SK Pendirian Sekolah</label>
            <input type="text" class="form-control" name="sk_pendiri" id="sk_pendiri">
        </div>
        <div class="form-group col-md-6">
            <label>Tanggal SK Pendirian</label>
            <input type="text" class="form-control" name="tgl_sk_pendiri" id="tgl_sk_pendiri">
        </div>
        <div class="form-group col-md-6">
            <label>Status Kepemilikan</label>
            <input type="text" class="form-control" name="status_milik" id="status_milik">
        </div>
        <div class="form-group col-md-6">
            <label>SK Izin Operasional</label>
            <input type="text" class="form-control" name="sk_izin" id="sk_izin">
        </div>
        <div class="form-group col-md-6">
            <label>Tanggal SK Izin Operasional</label>
            <input type="text" class="form-control" name="tgl_sk_izin" id="tgl_sk_izin">
        </div>
        <div class="form-group col-md-6">
            <label>Kebutuhan Khusus Dilayani</label>
            <input type="text" class="form-control" name="kbth_khss_dlayani" id="kbth_khss_dlayani">
        </div>
        <div class="form-group col-md-6">
            <label>Nomor Rekening</label>
            <input type="text" class="form-control" name="no_rek" id="no_rek">
        </div>
        <div class="form-group col-md-6">
            <label>Nama Bank</label>
            <input type="text" class="form-control" name="nama_bank" id="nama_bank">
        </div>
        <div class="form-group col-md-6">
            <label>Cabang KCP/Unit</label>
            <input type="text" class="form-control" name="cabang_bank" id="cabang_bank">
        </div>
        <div class="form-group col-md-6">
            <label>Rekening Atas Nama</label>
            <input type="text" class="form-control" name="nama_rek" id="nama_rek">
        </div>
        <div class="form-group col-md-6">
            <label>MBS</label>
            <input type="text" class="form-control" name="mbs" id="mbs">
        </div>
        <div class="form-group col-md-6">
            <label>Luas Tanah Milik (m<sup>2</sup>)</label>
            <input type="text" class="form-control" name="l_tanah_milik" id="l_tanah_milik">
        </div>
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-6">
            <label>Waktu Penyelenggaraan</label>
            <input type="text" class="form-control" name="w_penyelenggara" id="w_penyelenggara">
        </div>
        <div class="form-group col-md-6">
            <label>Bersedia Menerima Bos?</label>
            <input type="text" class="form-control" name="sedia_bos" id="sedia_bos">
        </div>
        <div class="form-group col-md-6">
            <label>Sertifikat ISO</label>
            <input type="text" class="form-control" name="sert_iso" id="sert_iso">
        </div>
        <div class="form-group col-md-6">
            <label>Sumber Listrik</label>
            <input type="text" class="form-control" name="sumber_listrik" id="sumber_listrik">
        </div>
        <div class="form-group col-md-6">
            <label>Daya Listrik (watt)</label>
            <input type="text" class="form-control" name="daya_listrik" id="daya_listrik">
        </div>
        <div class="form-group col-md-6">
            <label>Akses Internet</label>
            <input type="text" class="form-control" name="internet" id="internet">
        </div>
        <div class="form-group col-md-6">
            <label>Akses Internet Alternatif</label>
            <input type="text" class="form-control" name="internet_alter" id="internet_alter">
        </div>
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
        <div class="form-group">
            <button onclick="saveDataFix()" class="btn btn-primary">Simpan data ini</button>
        </div>
    </form>
</div>

<script src="<?php echo base_url(); ?>assets/js/test/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/test/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/test/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    });


    function savedataimage(){
        var bar = document.getElementById("progressStatus");
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        var interval = setInterval(increment, 100);
        var i = 1;
        function increment(){
            i = i % 360 + 2;
            var bar = document.getElementById("progressStatus");
            bar.className = "progress-bar progress-bar-primary progress-bar-striped active";
            bar.style.width= i+"%";
            if(i == 100){
                i=0;
            }
        }
        var loop1 =0;
        $.ajax({
            url: getbasepath()+'TestImport/getDataProfile/', // point to server-side controller method
            dataType: 'json', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                clearInterval(interval);
                $('#showimage').html("Data Berhasil Di upload");
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-success progress-bar-striped active";
                $('#progresstext').text("100% Berhasil di Unggah.");
                setValue(response);
            },
            error: function (response) {
                clearInterval(interval);
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
                $('#progresstext').text("100% Gagal Mengunggah.");
            }
        });
    }

    function getbasepath(){
        return "<?php echo base_url(); ?>"
    }

    function setValue(data){
        $('#namasekolah').val(data.namasekolah);
        $('#npsn').val(data.npsn);
        $('#jenjang').val(data.jenjang);
        $('#status').val(data.status);
        $('#alamat').val(data.alamat);
        $('#rt').val(data.rt);
        $('#rw').val(data.rw);
        $('#kodepos').val(data.kodepos);
        $('#kelurahan').val(data.kelurahan);
        $('#kecamatan').val(data.kecamatan);
        $('#kabupaten').val(data.kabupaten);
        $('#provinsi').val(data.provinsi);
        $('#negara').val(data.negara);
        $('#posisilat').val(data.posisilat);
        $('#posisilong').val(data.posisilong);
        $('#sk_pendiri').val(data.sk_pendiri);
        $('#tgl_sk_pendiri').val(data.tgl_sk_pendiri);
        $('#status_milik').val(data.status_milik);
        $('#sk_izin').val(data.sk_izin);
        $('#tgl_sk_izin').val(data.tgl_sk_izin);
        $('#kbth_khss_dlayani').val(data.kbth_khss_dlayani);
        $('#no_rek').val(data.no_rek);
        $('#nama_bank').val(data.nama_bank);
        $('#cabang_bank').val(data.cabang_bank);
        $('#nama_rek').val(data.nama_rek);
        $('#mbs').val(data.mbs);
        $('#l_tanah_milik').val(data.l_tanah_milik);
        $('#l_tanah_nomilik').val(data.l_tanah_nomilik);
        $('#nama_wajib_pajak').val(data.nama_wajib_pajak);
        $('#npwp').val(data.npwp);
        $('#no_telp').val(data.no_telp);
        $('#no_fax').val(data.no_fax);
        $('#email').val(data.email);
        $('#website').val(data.website);
        $('#w_penyelenggara').val(data.w_penyelenggara);
        $('#sedia_bos').val(data.sedia_bos);
        $('#sert_iso').val(data.sert_iso);
        $('#sumber_listrik').val(data.sumber_listrik);
        $('#daya_listrik').val(data.daya_listrik);
        $('#internet').val(data.internet);
        $('#internet_alter').val(data.internet_alter);
        $('#cukup_air').val(data.cukup_air);
        $('#memproses_air').val(data.memproses_air);
        $('#air_minum').val(data.air_minum);
        $('#siswa_air_minum').val(data.siswa_air_minum);
        $('#jml_wc_khusus').val(data.jml_wc_khusus);
        $('#air_sanitasi').val(data.air_sanitasi);
        $('#sedia_air').val(data.sedia_air);
        $('#tipe_wc').val(data.tipe_wc);
        $('#jml_tmp_cuci').val(data.jml_tmp_cuci);
        $('#sabun_air').val(data.sabun_air);
        $('#jml_wc_bisa_laki').val(data.jml_wc_bisa_laki);
        $('#jml_wc_bisa_perem').val(data.jml_wc_bisa_perem);
        $('#jml_wc_bisa_bersama').val(data.jml_wc_bisa_bersama);
        $('#jml_wc_tidak_laki').val(data.jml_wc_tidak_laki);
        $('#jml_wc_tidak_perem').val(data.jml_wc_tidak_perem);
        $('#jml_wc_tidak_bersama').val(data.jml_wc_tidak_bersama);
    }


</script>

            
</body>
</html>