$(document).ready(function(){
  getSiswa();
});

function getSiswa() {
      var table =   $('#tblSekolah').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"siswa/Json/listSiswa",
              "type": "POST",
              "data": {id_sekolah: user_id()}
          }
      });
}

function EditSiswa(id){
  $.ajax({
    url: getbasepath()+"siswa/Json/EditSiswa",
    type:"POST",
    data: {id_sekolah:id},
    success:function(data){
      $('#isiFormulir').html(data);
      $('.modal-title').text("Ubah Data Siswa");
      $('#modalEditSekolah').modal({backdrop: 'static',keyboard:false})
      $('#SaveAccount').text('Ubah Data');
      $('#id_sekolah').prop("disabled", false);
      $('#statusAction').val("1");
      getDetSiswa(id);
    }
  });
}

function tambahData(){
  
  $.ajax({
    url: getbasepath()+"siswa/Json/EditSiswa",
    type:"POST",
    success:function(data){
      $('#isiFormulir').html(data);
      $('.modal-title').text("Tambah Data Siswa");
      $('#modalEditSekolah').modal({backdrop: 'static',keyboard:false});
      $('#SaveAccount').text('Simpan Data');
      document.getElementById("tambahSiswa").reset();
      $('#id_sekolah').prop("disabled", true);
      $('#id_sekolah').val(user_id());
    }
  });
}

function getDetSiswa(id){
  $.ajax({
    url: getbasepath()+"siswa/Json/getDetSiswa",
    type:"POST",
    dataType:"JSON",
    data: {nisn:id},
    success:function(data){
      $('#nisnlama').val(data.nisn);
      $('#nisn').val(data.nisn);
      $('#nis').val(data.nis);
      $('#nama_siswa').val(data.nama_siswa);
      $('#tmp_lahir').val(data.tmp_lahir);
      $('#tgl_lahir').val(data.tgl_lahir);
      $('#nik_siswa').val(data.nik_siswa);
      $('#id_kel').val(data.id_kel);
      $('#id_agama').val(data.id_agama);
      $('#alamat').val(data.alamat);
      $('#rt').val(data.rt);
      $('#rw').val(data.rw);
      $('#dusun').val(data.dusun);
      $('#kelurahan').val(data.kelurahan);
      $('#kecamatan').val(data.kecamatan);
      $('#kode_pos').val(data.kode_pos);
      $('#jenis_tinggal').val(data.jenis_tinggal);
      $('#id_sekolah').val(data.id_sekolah);
      $('#id_kelas').val(data.id_kelas);
      $('#nama_ayah').val(data.nama_ayah);
      $('#tahun_lahir_ayah').val(data.tahun_lahir_ayah);
      $('#pendidikan_ayah').val(data.pendidikan_ayah);
      $('#pekerjaan_ayah').val(data.pekerjaan_ayah);
      $('#penghasilan_ayah').val(data.penghasilan_ayah);
      $('#nik_ayah').val(data.nik_ayah);
      $('#nama_ibu').val(data.nama_ibu);
      $('#tahun_lahir_ibu').val(data.tahun_lahir_ibu);
      $('#pendidikan_ibu').val(data.pendidikan_ibu);
      $('#pekerjaan_ibu').val(data.pekerjaan_ibu);
      $('#penghasilan_ibu').val(data.penghasilan_ibu);
      $('#nik_ibu').val(data.nik_ibu);
      $('#nama_wali').val(data.nama_wali);
      $('#tahun_lahir_wali').val(data.tahun_lahir_wali);
      $('#pendidikan_wali').val(data.pendidikan_wali);
      $('#pekerjaan_wali').val(data.pekerjaan_wali);
      $('#penghasilan_wali').val(data.penghasilan_wali);
      $('#nik_wali').val(data.nik_wali);
      $('#penerima_kps').val(data.penerima_kps);
      $('#nokps').val(data.nokps);
      $('#penerima_kip').val(data.penerima_kip);
      $('#nokip').val(data.nokip);
      $('#nama_kip').val(data.nama_kip);
    }
  });
}

function validasi(){
  var status = $('#statusAction').val();
  console.log(status);
  if(status != "1"){
    simpanData();
  }else{
    ubahData();
  }
}

function ubahData(){
  var nisnlama = $('#nisnlama').val();
  var nisn = $('#nisn').val();
  var nis = $('#nis').val();
  var nama_siswa = $('#nama_siswa').val();
  var tmp_lahir = $('#tmp_lahir').val();
  var tgl_lahir = $('#tgl_lahir').val();
  var nik_siswa = $('#nik_siswa').val();
  var id_kel = $('#id_kel').val();
  var id_agama = $('#id_agama').val();
  var alamat = $('#alamat').val();
  var rt = $('#rt').val();
  var rw = $('#rw').val();
  var dusun = $('#dusun').val();
  var kelurahan = $('#kelurahan').val();
  var kecamatan = $('#kecamatan').val();
  var kode_pos = $('#kode_pos').val();
  var jenis_tinggal = $('#jenis_tinggal').val();
  var id_sekolah = $('#id_sekolah').val();
  var id_kelas = $('#id_kelas').val();
  var nama_ayah = $('#nama_ayah').val();
  var tahun_lahir_ayah = $('#tahun_lahir_ayah').val();
  var pendidikan_ayah = $('#pendidikan_ayah').val();
  var pekerjaan_ayah = $('#pekerjaan_ayah').val();
  var penghasilan_ayah = $('#penghasilan_ayah').val();
  var nik_ayah = $('#nik_ayah').val();
  var nama_ibu = $('#nama_ibu').val();
  var tahun_lahir_ibu = $('#tahun_lahir_ibu').val();
  var pendidikan_ibu = $('#pendidikan_ibu').val();
  var pekerjaan_ibu = $('#pekerjaan_ibu').val();
  var penghasilan_ibu = $('#penghasilan_ibu').val();
  var nik_ibu = $('#nik_ibu').val();
  var nama_wali = $('#nama_wali').val();
  var tahun_lahir_wali = $('#tahun_lahir_wali').val();
  var pendidikan_wali = $('#pendidikan_wali').val();
  var pekerjaan_wali = $('#pekerjaan_wali').val();
  var penghasilan_wali = $('#penghasilan_wali').val();
  var nik_wali = $('#nik_wali').val();
  var penerima_kps = $('#penerima_kps').val();
  var nokps = $('#nokps').val();
  var penerima_kip = $('#penerima_kip').val();
  var nokip = $('#nokip').val();
  var nama_kip = $('#nama_kip').val();
   if (nisn != "" && nis != "" && nama_siswa != "" && tmp_lahir != "" && tgl_lahir != "" && id_kel != "" && id_agama != "" &&  id_sekolah != "" && id_kelas != "") {
    console.log('a');
      var dataac = [];
    var data = {
      'nisn' : nisn,
      'nis' : nis,
      'nama_siswa' : nama_siswa,
      'tmp_lahir' : tmp_lahir,
      'tgl_lahir' : tgl_lahir,
      'nik_siswa' : nik_siswa,
      'id_kel' : id_kel,
      'id_agama' : id_agama,
      'alamat' : alamat,
      'rt' : rt,
      'rw' : rw,
      'dusun' : dusun,
      'kelurahan' : kelurahan,
      'kecamatan' : kecamatan,
      'kode_pos' : kode_pos,
      'jenis_tinggal' : jenis_tinggal,
      'id_sekolah' : id_sekolah,
      'id_kelas' : id_kelas,
      'nama_ayah' : nama_ayah,
      'tahun_lahir_ayah' : tahun_lahir_ayah,
      'pendidikan_ayah' : pendidikan_ayah,
      'pekerjaan_ayah' : pekerjaan_ayah,
      'penghasilan_ayah' : penghasilan_ayah,
      'nik_ayah' : nik_ayah,
      'nama_ibu' : nama_ibu,
      'tahun_lahir_ibu' : tahun_lahir_ibu,
      'pendidikan_ibu' : pendidikan_ibu,
      'pekerjaan_ibu' : pekerjaan_ibu,
      'penghasilan_ibu' : penghasilan_ibu,
      'nik_ibu' : nik_ibu,
      'nama_wali' : nama_wali,
      'tahun_lahir_wali' : tahun_lahir_wali,
      'pendidikan_wali' : pendidikan_wali,
      'pekerjaan_wali' : pekerjaan_wali,
      'penghasilan_wali' : penghasilan_wali,
      'nik_wali' : nik_wali,
      'penerima_kps' : penerima_kps,
      'nokps' : nokps,
      'penerima_kip' : penerima_kip,
      'nokip' : nokip,
      'nama_kip' : nama_kip,
    };

    var dataa = {
      'nisn' : nisnlama,
      'data' : data
    }

  dataac = dataa;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "siswa/Json/updateData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
      if(data.Status == "1" || data.Status == "0"){
        alert("Data Berhasil di Simpan.");
      }else{
        alert("Gagal dalam Menyimpan Data.\nNISN Sudah Ada.");
      }
      $('#modalEditSekolah').modal('hide');
      var table = $('#tblSekolah').DataTable();
      table.ajax.reload();
      }); 
   }
}

function simpanData(){
  var nisn = $('#nisn').val();
  var nis = $('#nis').val();
  var nama_siswa = $('#nama_siswa').val();
  var tmp_lahir = $('#tmp_lahir').val();
  var tgl_lahir = $('#tgl_lahir').val();
  var nik_siswa = $('#nik_siswa').val();
  var id_kel = $('#id_kel').val();
  var id_agama = $('#id_agama').val();
  var alamat = $('#alamat').val();
  var rt = $('#rt').val();
  var rw = $('#rw').val();
  var dusun = $('#dusun').val();
  var kelurahan = $('#kelurahan').val();
  var kecamatan = $('#kecamatan').val();
  var kode_pos = $('#kode_pos').val();
  var jenis_tinggal = $('#jenis_tinggal').val();
  var id_sekolah = $('#id_sekolah').val();
  var id_kelas = $('#id_kelas').val();
  var nama_ayah = $('#nama_ayah').val();
  var tahun_lahir_ayah = $('#tahun_lahir_ayah').val();
  var pendidikan_ayah = $('#pendidikan_ayah').val();
  var pekerjaan_ayah = $('#pekerjaan_ayah').val();
  var penghasilan_ayah = $('#penghasilan_ayah').val();
  var nik_ayah = $('#nik_ayah').val();
  var nama_ibu = $('#nama_ibu').val();
  var tahun_lahir_ibu = $('#tahun_lahir_ibu').val();
  var pendidikan_ibu = $('#pendidikan_ibu').val();
  var pekerjaan_ibu = $('#pekerjaan_ibu').val();
  var penghasilan_ibu = $('#penghasilan_ibu').val();
  var nik_ibu = $('#nik_ibu').val();
  var nama_wali = $('#nama_wali').val();
  var tahun_lahir_wali = $('#tahun_lahir_wali').val();
  var pendidikan_wali = $('#pendidikan_wali').val();
  var pekerjaan_wali = $('#pekerjaan_wali').val();
  var penghasilan_wali = $('#penghasilan_wali').val();
  var nik_wali = $('#nik_wali').val();
  var penerima_kps = $('#penerima_kps').val();
  var nokps = $('#nokps').val();
  var penerima_kip = $('#penerima_kip').val();
  var nokip = $('#nokip').val();
  var nama_kip = $('#nama_kip').val();
   if (nisn != "" && nis != "" && nama_siswa != "" && tmp_lahir != "" && tgl_lahir != "" && id_kel != "" && id_agama != "" &&  id_sekolah != "" && id_kelas != "") {
    console.log('a');
      var dataac = [];
    var data = {
      'nisn' : nisn,
      'nis' : nis,
      'nama_siswa' : nama_siswa,
      'tmp_lahir' : tmp_lahir,
      'tgl_lahir' : tgl_lahir,
      'nik_siswa' : nik_siswa,
      'id_kel' : id_kel,
      'id_agama' : id_agama,
      'alamat' : alamat,
      'rt' : rt,
      'rw' : rw,
      'dusun' : dusun,
      'kelurahan' : kelurahan,
      'kecamatan' : kecamatan,
      'kode_pos' : kode_pos,
      'jenis_tinggal' : jenis_tinggal,
      'id_sekolah' : id_sekolah,
      'id_kelas' : id_kelas,
      'nama_ayah' : nama_ayah,
      'tahun_lahir_ayah' : tahun_lahir_ayah,
      'pendidikan_ayah' : pendidikan_ayah,
      'pekerjaan_ayah' : pekerjaan_ayah,
      'penghasilan_ayah' : penghasilan_ayah,
      'nik_ayah' : nik_ayah,
      'nama_ibu' : nama_ibu,
      'tahun_lahir_ibu' : tahun_lahir_ibu,
      'pendidikan_ibu' : pendidikan_ibu,
      'pekerjaan_ibu' : pekerjaan_ibu,
      'penghasilan_ibu' : penghasilan_ibu,
      'nik_ibu' : nik_ibu,
      'nama_wali' : nama_wali,
      'tahun_lahir_wali' : tahun_lahir_wali,
      'pendidikan_wali' : pendidikan_wali,
      'pekerjaan_wali' : pekerjaan_wali,
      'penghasilan_wali' : penghasilan_wali,
      'nik_wali' : nik_wali,
      'penerima_kps' : penerima_kps,
      'nokps' : nokps,
      'penerima_kip' : penerima_kip,
      'nokip' : nokip,
      'nama_kip' : nama_kip
    };

  dataac = data;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "siswa/Json/simpanData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
      if(data.Status){
        alert("Data Berhasil di Simpan.");
      }else{
        alert("Gagal dalam Menyimpan Data.\nNISN Sudah Ada.");
      }
      $('#modalEditSekolah').modal('hide');
      var table = $('#tblSekolah').DataTable();
      table.ajax.reload();
      }); 
   }
}

function importData(){
  $('#modaluploadfile').modal('show');
}

function uploadFile(){
  var a = validate_fileupload();
  if(a == true){
    var bar = document.getElementById("progressStatus");
    bar.className = "progress-bar progress-bar-primary progress-bar-striped active";
    bar.style.width="50%";
    var progress = 0;


    $('#progresstext').text("50% Sedang Mengunggah .......");
      
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: getbasepath()+'siswa/Excel/upload/', // point to server-side controller method
            dataType: 'json', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-success progress-bar-striped active";
                $('#progresstext').text("100% Berhasil di Unggah.");
                var table = $('#tblSekolah').DataTable();
                table.ajax.reload();
            },
            error: function (response) {
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
                $('#progresstext').text("100% Gagal Mengunggah.");
                
            }
        });
  }else{
    alert("Type File Tidak Didukung")
  }
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

function DeleteSiswa(id){
  $.ajax({
    url: getbasepath()+"siswa/Json/getDetSiswa",
        type: "POST",
        data: {nisn: id},
        dataType: "JSON",
        success: function(data){
            $('#modalDeleteSiswa').modal("show");
            $('#nisndel').val(data.nisn);
            $('#idsiswadel').val(data.id);
            $('#namadel').val(data.nama_siswa);
        }
  });
}

function deleteDataSiswa(){
  var id = $('#idsiswadel').val();
  $.ajax({
    url: getbasepath()+"siswa/Json/deleteDataSiswa",
        type: "POST",
        data: {id: id},
        dataType: "JSON",
        success: function(data){
            console.log(data);
            if(data['0'] != "0"){
              alert("Data Berhasil di Hapus.");
            }else{
              alert("Data Gagal di Hapus.");
            }
            $('#modalDeleteSiswa').modal("hide");
      var table = $('#tblSekolah').DataTable();
      table.ajax.reload();

        },
        error: function(error){
          alert("Data Gagal di Hapus.");
        }
  });
}

/*
  var bar = document.getElementById("progressStatus");
var progress = 0;


function setProgress(percent){
    bar.style.width = percent + "%";

    if (percent > 90)
        bar.className = "progress-bar progress-bar-success progress-bar-striped active";
    else if (percent > 81)
        bar.className = "progress-bar progress-bar-success progress-bar-striped active";
}

var interval = setInterval(
    function(){
        setProgress(++progress);
        if (progress == 100) window.clearInterval(interval);
    }, 100);
    */