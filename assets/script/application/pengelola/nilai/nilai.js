$(document).ready(function(){
  getnilai();
});

function getnilai() {
      var table =   $('#tbllist').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"pengelola/nilai/nilai/listnilai",
              "type": "POST"
          }
      });
}

function importData(){
  $.ajax({
    url:getbasepath()+"pengelola/nilai/nilai/getDialogImport",
    type: "GET",
    success:function(data){
      $('#isiModalImport').html(data);
      $('#modaluploadfile').modal({backdrop: 'static',keyboard:false});
      getnilaiTemp();
    },
    error:function(error,x,y){
      alert('Kesalahan Jaringan');
    }
  });
}

function getnilaiTemp() {
      var table =   $('#tblImport').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"pengelola/nilai/nilai/listnilaiTemp",
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
            url: getbasepath()+'pengelola/nilai/nilai/uploadDatanilai/', // point to server-side controller method
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

function saveDataFix(){
  $.ajax({
      url: getbasepath()+"pengelola/nilai/nilai/saveData",
      type: "POST",
      dataType: "json",
      success:function(data){
          alert("Data berhasil disimpan.");
          var table = $('#tblImport').DataTable();
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
  var table = $('#tbllist').DataTable();
  table.ajax.reload();
}