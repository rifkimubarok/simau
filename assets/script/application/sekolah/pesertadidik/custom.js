$(document).ready(function(){
  getSiswa();
});

function getSiswa() {
      var table =   $('#tblpesertadidik').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/Pesertadidik/listPesertaDidik",
              "type": "POST"
          }
      });
}

function ubahData(id){
  $.ajax({
    url:getbasepath()+"sekolah/Pesertadidik/getDialogubah/" + id,
    type: "GET",
    dataType: "JSON",
    success:function(data){
      $('#modalubahdata').modal({backdrop: 'static',keyboard:false});
      $('#id').val(data.id);
      $('#nama').val(data.nama);
      $('#nipd').val(data.nipd);
      $('#jk').val(data.jk);
      $('#nisn').val(data.nisn);
      $('#tmp_lahir').val(data.tmp_lahir);
      $('#tgl_lahir').val(data.tgl_lahir);
      $('#nik').val(data.nik);
      $('#agama').val(data.agama);
      $('#alamat').val(data.alamat);
      $('#rt').val(data.rt);
      $('#rw').val(data.rw);
      $('#dusun').val(data.dusun);
      $('#kelurahan').val(data.kelurahan);
      $('#kecamatan').val(data.kecamatan);
      $('#kode_pos').val(data.kode_pos);
      $('#jenis_tinggal').val(data.jenis_tinggal);
      $('#alat_transport').val(data.alat_transport);
      $('#telepon').val(data.telepon);
      $('#hp').val(data.hp);
      $('#email').val(data.email);
      $('#skhun').val(data.skhun);
      $('#penerima_kps').val(data.penerima_kps);
      $('#no_kps').val(data.no_kps);
      $('#nama_ayah').val(data.nama_ayah);
      $('#thn_lahir_ayah').val(data.thn_lahir_ayah);
      $('#jenjang_ayah').val(data.jenjang_ayah);
      $('#pekerjaan_ayah').val(data.pekerjaan_ayah);
      $('#penghasilan_ayah').val(data.penghasilan_ayah);
      $('#nik_ayah').val(data.nik_ayah);
      $('#nama_ibu').val(data.nama_ibu);
      $('#thn_lahir_ibu').val(data.thn_lahir_ibu);
      $('#jenjang_ibu').val(data.jenjang_ibu);
      $('#pekerjaan_ibu').val(data.pekerjaan_ibu);
      $('#penghasilan_ibu').val(data.penghasilan_ibu);
      $('#nik_ibu').val(data.nik_ibu);
      $('#nama_wali').val(data.nama_wali);
      $('#thn_lahir_wali').val(data.thn_lahir_wali);
      $('#jenjang_wali').val(data.jenjang_wali);
      $('#pekerjaan_wali').val(data.pekerjaan_wali);
      $('#penghasilan_wali').val(data.penghasilan_wali);
      $('#nik_wali').val(data.nik_wali);
      $('#rombel').val(data.rombel);
      $('#no_peserta_un').val(data.no_peserta_un);
      $('#no_seri_ijazah').val(data.no_seri_ijazah);
      $('#penerima_kip').val(data.penerima_kip);
      $('#no_kip').val(data.no_kip);
      $('#nama_kip').val(data.nama_kip);
      $('#no_kks').val(data.no_kks);
      $('#no_reg_akta').val(data.no_reg_akta);
      $('#bank').val(data.bank);
      $('#no_rek').val(data.no_rek);
      $('#nama_rek').val(data.nama_rek);
      $('#layak_pip').val(data.layak_pip);
      $('#alasan_layak').val(data.alasan_layak);
      $('#kebutuhan_khusus').val(data.kebutuhan_khusus);
      $('#sekolah_asal').val(data.sekolah_asal);
      $('#kode_sekolah').val(data.kode_sekolah);
      $('#kelas').val(data.kelas);
      $('#jurusan').val(data.jurusan);
      $('#buntut').val(data.buntut);
    },
    error:function(error,x,y){
      alert('Kesalahan Saat Memuat Data');
    }
  });
}

function getDatasiswa(){
  $.ajax({
    url:getbasepath()+"sekolah/Pesertadidik/getDataSiswa",
    type:"GET",
    dataType:"JSON",
    data:{'ID':8},
    success:function(data){
      console.log(data.nisn);
    },
    error:function(x,y,z){
      console.log(x+y+z);
    }
  })
}

function importData(){
  $.ajax({
    url:getbasepath()+"sekolah/pesertadidik/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      getpembelajaranTemp();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function getpembelajaranTemp() {
      var table =   $('#tblimport').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/pesertadidik/listPesertaDidikTemp",
              "type": "POST"
          }
      });
}

function validate_fileupload()
{
    var fileName = $('#file').val();
    var allowed_extensions = new Array("xls","xlsx","csv");
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
        var interval = setInterval( increment, 1000);
        var i = 1;
        function increment(){
            i = i % 360 + 1;
            var bar = document.getElementById("progressStatus");
            bar.className = "progress-bar progress-bar-primary progress-bar-striped active";
            bar.style.width= i+"%";
            if(i == 100){
                i=0;
            }
        }
        $.ajax({
            url: getbasepath()+'sekolah/Pesertadidik/uploadDataSiswa/', // point to server-side controller method
            dataType: 'json', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                clearInterval(interval);
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-success progress-bar-striped active";
                $('#progresstext').text("100% Berhasil di Unggah.");
                var table = $('#tblImport').DataTable();
                table.ajax.reload();
                document.getElementById('hasilImport').style.display="block";
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


function getSiswaTemp() {
      var table =   $('#tblImportPesertaDidik').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/Pesertadidik/listPesertaDidikTemp",
              "type": "POST"
          }
      });
}

function saveDataFix(){
  $.ajax({
      url: getbasepath()+"sekolah/Pesertadidik/saveDataSiswa",
      type: "POST",
      dataType: "json",
      success:function(data){
          alert("Data berhasil disimpan.");
          var table = $('#tblImportPesertaDidik').DataTable();
          table.ajax.reload();
          document.getElementById('hasilImport').style.display="block";
          refreshData();
      },
      error:function(error,x,y){
          alert("Kesalahan dalam menyimpan data.");
      }
  });
}

function refreshData(){
  var table = $('#tblpesertadidik').DataTable();
  table.ajax.reload();
}



function DeleteSiswa(id){
  $.ajax({
    url: getbasepath()+"siswa/Json/listPesertaDidikTemp",
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
