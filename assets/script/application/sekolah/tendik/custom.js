$(document).ready(function(){
  getTendik();
});

function getTendik() {
      var table =   $('#tbltendik').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/tendik/listTendik",
              "type": "POST"
          }
      });
}


function ubahData(id){
  $.ajax({
    url:getbasepath()+"sekolah/tendik/getDialogubah/" + id,
    type: "GET",
    dataType: "JSON",
    success:function(data){
      $('#modalubahdata').modal({backdrop: 'static',keyboard:false});

      $('#id').val(data.id);
      $('#nama').val(data.nama);
      $('#nuptk').val(data.nuptk);
      $('#jk').val(data.jk);
      $('#tmp_lahir').val(data.tmp_lahir);
      $('#tgl_lahir').val(data.tgl_lahir);
      $('#nip').val(data.nip);
      $('#stat_kepegawaian').val(data.stat_kepegawaian);
      $('#jenis_ptk').val(data.jenis_ptk);
      $('#agama').val(data.agama);
      $('#alamat').val(data.alamat);
      $('#rt').val(data.rt);
      $('#rw').val(data.rw);
      $('#nama_dusun').val(data.nama_dusun);
      $('#desa').val(data.desa);
      $('#kecamatan').val(data.kecamatan);
      $('#kode_pos').val(data.kode_pos);
      $('#telepon').val(data.telepon);
      $('#hp').val(data.hp);
      $('#email').val(data.email);
      $('#tugas_tambahan').val(data.tugas_tambahan);
      $('#sk_cpns').val(data.sk_cpns);
      $('#tgl_cpns').val(data.tgl_cpns);
      $('#sk_pengangkatan').val(data.sk_pengangkatan);
      $('#tmt_pengangkatan').val(data.tmt_pengangkatan);
      $('#lembaga_pengangkatan').val(data.lembaga_pengangkatan);
      $('#pangkat_gol').val(data.pangkat_gol);
      $('#sumber_gaji').val(data.sumber_gaji);
      $('#nama_ibu_kandung').val(data.nama_ibu_kandung);
      $('#status_perkawinan').val(data.status_perkawinan);
      $('#nama_suami_istri').val(data.nama_suami_istri);
      $('#nip_suami_istri').val(data.nip_suami_istri);
      $('#pekerjaan_suami_istri').val(data.pekerjaan_suami_istri);
      $('#tmt_pns').val(data.tmt_pns);
      $('#lisensi_kepala_sekolah').val(data.lisensi_kepala_sekolah);
      $('#pernah_diklat').val(data.pernah_diklat);
      $('#keahlian_braile').val(data.keahlian_braile);
      $('#keahlian_isyarat').val(data.keahlian_isyarat);
      $('#npwp').val(data.npwp);
      $('#nama_wajib_pajak').val(data.nama_wajib_pajak);
      $('#kewarganegaraan').val(data.kewarganegaraan);
      $('#bank').val(data.bank);
      $('#no_rek').val(data.no_rek);
      $('#nama_rek').val(data.nama_rek);
      $('#nik').val(data.nik);
      $('#kode_sekolah').val(data.kode_sekolah);
    },
    error:function(error,x,y){
      alert('Kesalahan Saat Memuat Data');
    }
  });
}

function importData(){
  $.ajax({
    url:getbasepath()+"sekolah/tendik/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      getTendikTemp();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function getTendikTemp() {
      var table =   $('#tblImportTendik').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/tendik/listTendikTemp",
              "type": "POST"
          }
      });
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
            url: getbasepath()+'sekolah/tendik/uploadDataTendik/', // point to server-side controller method
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
                var table = $('#tblImportTendik').DataTable();
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

function saveDataFix(){
  $.ajax({
      url: getbasepath()+"sekolah/tendik/saveDataTendik",
      type: "POST",
      dataType: "json",
      success:function(data){
          alert("Data berhasil disimpan.");
          var table = $('#tblImportPesertaDidik').DataTable();
          table.ajax.reload();
          document.getElementById('hasilImport').style.display="block";
          $('#modaluploadfile').modal('hide');
          refreshData();
      },
      error:function(error,x,y){
          alert("Kesalahan dalam menyimpan data.");
      }
  });
}

function refreshData(){
  var table = $('#tbltendik').DataTable();
  table.ajax.reload();
}