$(document).ready(function(){
  getSekolah();
  getKec();
  getJenjang();
  getSiswa();
  $("#kecamatan").change(function () {
        var kec = $(this).val();
        var url = '';
          url = getbasepath()+"managemen/Pesertadidik/getSekolah?kec=" + kec;
        $.ajax({
        url:url,
        type:"GET",
        dataType:"JSON",
        success:function(data){
          reload();
          var option = "<option selected value=''> -- Pilih Sekolah -- </option>";
          for (var i = 0; i < data.sekolah.length;i++){
              var isi = data.sekolah[i]['namasekolah'];
              var id = data.sekolah[i]['npsn'];
              option += "<option value='"+id+"'> "+isi+" </option>";
        }
        $('#sekolah').html(option);
        }
        })
  });
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
              "url": getbasepath()+"managemen/Pesertadidik/listPesertaDidik",
              "type": "POST",
              "data" :function(d) {
                d.npsn = getNpsn();
                d.kecamatan = getKec2();
              }
          }
      });
}

function reload() {
  var table = $('#tblpesertadidik').DataTable();
  table.ajax.reload();
}

function getNpsn(){
  var hasil = $('#sekolah').val();
  return hasil;
}

function getKec2(){
  var hasil = $('#kecamatan').val();
  return hasil;
}

function getJenjang2(){
  var hasil = $('#jenjang').val();
  return hasil;
}

function getSekolah(){
  $.ajax({
    url:getbasepath()+"managemen/Pesertadidik/getSekolah",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        console.log(data);
        var option = "<option selected value=''> -- Pilih Sekolah -- </option>";
        for (var i = 0; i < data.sekolah.length;i++){
              var isi = data.sekolah[i]['namasekolah'];
              var kode = data.sekolah[i]['npsn'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#sekolah').html(option);
    }
  })
}

function getKec(){
  $.ajax({
    url:getbasepath()+"managemen/Pesertadidik/getKec",
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
    url:getbasepath()+"managemen/Pesertadidik/getJenjang",
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

function importData(){
  $.ajax({
    url:getbasepath()+"sekolah/Pesertadidik/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      getSiswaTemp();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
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
                var table = $('#tblImportPesertaDidik').DataTable();
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
