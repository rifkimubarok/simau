$(document).ready(function(){
    getSekolah();
    getKec();
    getJenjang();
});

function getSekolah() {
      var table =   $('#tblsekolah').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"pengelola/Sekolah/listsekolah",
              "type": "POST",
              "data" :function(d) {
                d.kecamatan = getKec2();
                d.jenjang = getJenjang2();
              }
          }
      });
}

function getKec2(){
  var hasil = $('#kecamatan').val();
  return hasil;
}

function getJenjang2(){
  var hasil = $('#jenjang').val();
  return hasil;
}

function getKec(){
  $.ajax({
    url:getbasepath()+"pengelola/Pesertadidik/getKec",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        console.log(data);
        var option = "<option selected value=''> -- Pilih Kecamatan -- </option>";
        for (var i = 0; i < data.kec.length;i++){
              var isi = data.kec[i]['kecamatan'];
              option += "<option value='"+isi+"'> "+isi+" </option>";
        }
        $('#kecamatan').html(option);
    }
  })
}

function getJenjang(){
  $.ajax({
    url:getbasepath()+"pengelola/Pesertadidik/getJenjang",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        console.log(data);
        var option = "<option selected value=''> -- Pilih Jenjang -- </option>";
        for (var i = 0; i < data.jenjang.length;i++){
              var isi = data.jenjang[i]['jenjang'];
              option += "<option value='"+isi+"'> "+isi+" </option>";
        }
        $('#jenjang').html(option);
    }
  })
}

function tambahData() {
    $.ajax({
        url:getbasepath()+"pengelola/Sekolah/tambahData",
        type:"GET",
        success:function(data) {
            $('#isiModalTambahData').html(data);
            $('#modalTambahData').modal({backdrop: 'static',keyboard:false});
        }
    });
}

function reload() {
    var table =  $('#tblsekolah').DataTable();
    table.ajax.reload();
}

function ubahData(id){
  $.ajax({
    url:getbasepath()+"pengelola/Sekolah/getDialogubah/" + id,
    type: "GET",
    dataType: "JSON",
    success:function(data){
    $('#modalubahdata').modal({backdrop: 'static',keyboard:false});
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
    $('#pengawas').val(data.pengawas);
    },
    error:function(error,x,y){
      alert('Kesalahan Saat Memuat Data');
    }
  });
}

function closeModalUpload() {
    $('#modaluploadfile').modal('hide');
}

function validate_fileupload()
{
    var fileName = $('#file').val();
    var allowed_extensions = new Array("xls","xlsx");
    var file_extension = fileName.split('.').pop(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

    for(var i = 0; i <= allowed_extensions.length; i++)
    {
        if(allowed_extensions[i]==file_extension)
        {
            return true; // valid file extension
        }
    }

    return false;
}

function uploadFile(){
  var a = validate_fileupload();
  if(a == true){
    $('#progresstext').text(" ");
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
            url: getbasepath()+'pengelola/Sekolah/getDataProfile/', // point to server-side controller method
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
                $('#modaluploadfile').modal('hide');
                alert('Import Profile Berhasil.');
                alert('Silahkan Periksa Kembali Data Sebelum Disimpan.');
            },
            error: function (response) {
                clearInterval(interval);
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
                $('#progresstext').text("100% Gagal Mengunggah.");
            }
        });
  }else{
    alert("Type File Tidak Didukung")
  }
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
    $('#pengawas').val(data.pengawas);
}


function importData(){
  $.ajax({
    url:getbasepath()+"pengelola/Sekolah/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function simpanData() {

    var dataac = [];
    var icon = '';
    if($('#jenjang').val() == 'SMA'){
        icon = 'university1.png';
    }else if($('#jenjang').val() == 'SMK'){
        icon = 'university2.png';
    }else if($('#jenjang').val() == 'SLB'){
        icon = 'university0.png';
    }
        var data = {
            'namasekolah': $('#namasekolah').val(),
            'npsn': $('#npsn').val(),
            'jenjang': $('#jenjang').val(),
            'status': $('#status').val(),
            'alamat': $('#alamat').val(),
            'rt': $('#rt').val(),
            'rw': $('#rw').val(),
            'kodepos': $('#kodepos').val(),
            'kelurahan': $('#kelurahan').val(),
            'kecamatan': $('#kecamatan').val(),
            'kabupaten': $('#kabupaten').val(),
            'provinsi': $('#provinsi').val(),
            'negara': $('#negara').val(),
            'posisilat': $('#posisilat').val(),
            'posisilong': $('#posisilong').val(),
            'sk_pendiri': $('#sk_pendiri').val(),
            'tgl_sk_pendiri': $('#tgl_sk_pendiri').val(),
            'status_milik': $('#status_milik').val(),
            'sk_izin': $('#sk_izin').val(),
            'tgl_sk_izin': $('#tgl_sk_izin').val(),
            'kbth_khss_dlayani': $('#kbth_khss_dlayani').val(),
            'no_rek': $('#no_rek').val(),
            'nama_bank': $('#nama_bank').val(),
            'cabang_bank': $('#cabang_bank').val(),
            'nama_rek': $('#nama_rek').val(),
            'mbs': $('#mbs').val(),
            'l_tanah_milik': $('#l_tanah_milik').val(),
            'l_tanah_nomilik': $('#l_tanah_nomilik').val(),
            'nama_wajib_pajak': $('#nama_wajib_pajak').val(),
            'npwp': $('#npwp').val(),
            'no_telp': $('#no_telp').val(),
            'no_fax': $('#no_fax').val(),
            'email': $('#email').val(),
            'website': $('#website').val(),
            'w_penyelenggara': $('#w_penyelenggara').val(),
            'sedia_bos': $('#sedia_bos').val(),
            'sert_iso': $('#sert_iso').val(),
            'sumber_listrik': $('#sumber_listrik').val(),
            'daya_listrik': $('#daya_listrik').val(),
            'internet': $('#internet').val(),
            'internet_alter': $('#internet_alter').val(),
            'cukup_air': $('#cukup_air').val(),
            'memproses_air': $('#memproses_air').val(),
            'air_minum': $('#air_minum').val(),
            'siswa_air_minum': $('#siswa_air_minum').val(),
            'jml_wc_khusus': $('#jml_wc_khusus').val(),
            'air_sanitasi': $('#air_sanitasi').val(),
            'sedia_air': $('#sedia_air').val(),
            'tipe_wc': $('#tipe_wc').val(),
            'jml_tmp_cuci': $('#jml_tmp_cuci').val(),
            'sabun_air': $('#sabun_air').val(),
            'jml_wc_bisa_laki': $('#jml_wc_bisa_laki').val(),
            'jml_wc_bisa_perem': $('#jml_wc_bisa_perem').val(),
            'jml_wc_bisa_bersama': $('#jml_wc_bisa_bersama').val(),
            'jml_wc_tidak_laki': $('#jml_wc_tidak_laki').val(),
            'jml_wc_tidak_perem': $('#jml_wc_tidak_perem').val(),
            'jml_wc_tidak_bersama': $('#jml_wc_tidak_bersama').val(),
            'icon': icon
        };
    
    dataac = data;

    $.ajax({
        type: "POST",
        url: getbasepath() + "pengelola/Sekolah/simpanData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON",
        success:function(data) {
            alert('Data Sekolah Berhasil Disimpan.');
            $('#modalTambahData').modal('hide');
            reload();
        },
        error:function(error,x,y) {
            alert('Kesalahan Dalam Memperbaharui Data.');
        }
    });
}

function getProfile(){
    $.ajax({
        url:getbasepath()+"sekolah/Sekolah/getProfile",
        type:"POST",
        dataType:"JSON",
        success:function(data){
            if(data){
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
                $('#pengawas').val(data.pengawas);
            }   
        },
        error:function(error,x,y){
            alert('Kesalahan Dalam Menampilkan Profile Sekolah.')
        }
    })
}
