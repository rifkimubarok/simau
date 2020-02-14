$(document).ready(function(){
  getListJawaban();
});

function getListJawaban() {
      var table =   $('#tblkeahlian').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/Jwbpd/listjwbpd",
              "type": "POST",
              "data":function(d) {
                  d.thn_upload = getTahun();
              }
          }
      });
}

function getTahun() {
  var tahun = $('#thn_upload').val();
  return tahun;
}


function importData(){
  $.ajax({
    url:getbasepath()+"sekolah/Jwbpd/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      //getkeahlianTemp();
      getGuru();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function validate_fileupload()
{
    var fileName = $('#file').val();
    var allowed_extensions = new Array("xls","xlsx","txt","XLS","XLSX",'TXT');
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
  var b = $('#matpel').val();
  if(a == true && b != ''){
    $('#progresstext').text(" ");
    var bar = document.getElementById("progressStatus");
        var file_data = $('#file').prop('files')[0];
        var matpel = $('#matpel').val();
        var guru = $('#guru').val();
        var thn_upload = $('#thn_upload').val();
        var kelas = $('#kelas').val();
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('kd_matpel', matpel);
        form_data.append('kd_guru', guru);
        form_data.append('thn_upload', thn_upload);
        form_data.append('kelas', kelas);
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
        var fileName = $('#file').val();
        var file_extension = fileName.split('.').pop();
        if(file_extension == "txt"){
          uploadTxt(form_data,interval,bar);
        }else{
          uploadExcel(form_data,interval,bar);
        }

  }else{
    if(b !=''){
      alert("Type File Tidak diDukung.");
    }else{
      alert("Mata Pelajaran Tidak Boleh Kosong.");
    }
  }
}

function uploadTxt(form_data,interval,bar) {
  $.ajax({
        url: getbasepath()+'sekolah/Jwbpd/uploadTxt/', // point to server-side controller method
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
        },
        error: function (response) {
            clearInterval(interval);
            bar.style.width="100%";
            bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
            $('#progresstext').text("100% Gagal Mengunggah.");
        }
    });
}

function uploadExcel(form_data,interval,bar){
    $.ajax({
        url: getbasepath()+'sekolah/Jwbpd/uploadExcel/', // point to server-side controller method
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
        },
        error: function (response) {
            clearInterval(interval);
            bar.style.width="100%";
            bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
            $('#progresstext').text("100% Gagal Mengunggah.");
        }
    });
}

function refreshData(){
  var table = $('#tblkeahlian').DataTable();
  table.ajax.reload();
}

function getGuru() {
   $.ajax({
    url:getbasepath()+"sekolah/Jwbpd/getGuru",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Pilih Guru -- </option>";
        for (var i = 0; i < data.length;i++){
              var isi = data[i]['nama'];
              var kode = '';
              if( data[i]['nip'] != ''){
                   kode = data[i]['nip'];
              }else if( data[i]['nip'] == '' &&  data[i]['nuptk'] != ''){
                    kode =  data[i]['nuptk'];
              }else if( data[i]['no_peserta'] != ''){
                    kode =  data[i]['nuptk'];
              }else{
                    kode = data[i]['id'];
              }
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#guru').html(option);
        
    }
  })
}