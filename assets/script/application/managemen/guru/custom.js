$(document).ready(function(){
  getSekolah();
  getguru();
  getKec();
  getJenjang();
  $("#kecamatan").change(function () {
        var kec = $(this).val();
        var jenjang = $("#jenjang").val();
        var url = '';
        if(jenjang == ''){
          url = getbasepath()+"managemen/Pesertadidik/getSekolah?kec=" + kec;
        }else{
          url = getbasepath()+"managemen/Pesertadidik/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
        }
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
   $("#jenjang").change(function () {
        var jenjang = $(this).val();
        var kec = $("#kecamatan").val();
        var url = '';
        if(kec == ''){
          url = getbasepath()+"managemen/Pesertadidik/getSekolah?jenjang=" + jenjang;
        }else{
          url = getbasepath()+"managemen/Pesertadidik/getSekolah?kec=" + kec + "&jenjang=" + jenjang;
        }
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

function getguru() {
      var table =   $('#tblguru').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"managemen/guru/listguru",
              "type": "POST",
              "data":function(d) {
                  d.npsn = getNpsn();
                  d.stat_kepegawaian = getstatus();
                d.kecamatan = getKec2();
                d.jenjang = getJenjang2();
              }
          }
      });
}

function reload() {
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
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
function getNpsn(){
  var hasil = $('#sekolah').val();
  return hasil;
}

function getstatus(){
  var hasil = $('#statuss').val();
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

function importData(){
  $.ajax({
    url:getbasepath()+"sekolah/guru/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      getguruTemp();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function getguruTemp() {
      var table =   $('#tblImportguru').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/guru/listguruTemp",
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
            url: getbasepath()+'sekolah/guru/uploadDataguru/', // point to server-side controller method
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
                var table = $('#tblImportguru').DataTable();
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
      url: getbasepath()+"sekolah/guru/saveDataguru",
      type: "POST",
      dataType: "json",
      success:function(data){
          alert("Data berhasil disimpan.");
          var table = $('#tblImportguru').DataTable();
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
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
}