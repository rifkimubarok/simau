<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
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
<button onclick="savedataimage()">a</button>
<br>
<br>

<button onclick="saveDataFix()">Simpan data ini</button>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIPD</th>
                <th>Jenis Kelamin</th>
                <th>Nisn</th>
                <th>tmp_lahir</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIPD</th>
                <th>Jenis Kelamin</th>
                <th>Nisn</th>
                <th>tmp_lahir</th>
            </tr>
        </tfoot>
    </table>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        getSiswa();
    });
    function savedataimage(){
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
            url: getbasepath()+'TestImport/uploadDataSiswa/', // point to server-side controller method
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
                var table = $('#example').DataTable();
                table.ajax.reload();
            },
            error: function (response) {
                bar.style.width="100%";
                bar.className = "progress-bar progress-bar-danger progress-bar-striped active";
                $('#progresstext').text("100% Gagal Mengunggah.");
            }
        });
    }

    function myTimer(){
        var bar = document.getElementById("progressStatus");
        bar.className = "progress-bar progress-bar-primary progress-bar-striped active";
        bar.style.width= a+"%";
    }

    function getbasepath(){
        return "<?php echo base_url(); ?>"
    }

    function getSiswa() {
      var table =   $('#example').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"TestImport/listSiswa",
              "type": "POST"
          }
      });
    }

    function saveDataFix(){
        $.ajax({
            url: getbasepath()+"TestImport/saveDataSiswa",
            type: "POST",
            dataType: "json",
            beforeSend:function(x,y,z){
                console.log(x);
                console.log(y);
                console.log(z);
            },
            success:function(data){
                alert("Data berhasil disimpan.");
                var table = $('#example').DataTable();
                table.ajax.reload();
            },
            error:function(error,x,y){
                alert("Kesalahan dalam menyimpan data.");
            }
        });
    }


</script>

            
</body>
</html>