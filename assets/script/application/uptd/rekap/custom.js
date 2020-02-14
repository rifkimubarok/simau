$(document).ready(function(){
  getKecamatan();
  getRekap();
});

function getRekap() {
      var table =   $('#tblrekap').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"uptd/Rekapjwbpd/listrekap",
              "type": "POST",
              "data":function(d) {
                  d.getkec = getKec();
              }
          }
      });
}

function reload() {
  var hasil = $('#kecamatan').val();
  if(hasil != ''){
    $('#kec').text('Sekolah');
    $('#kab').text('Kecamatan');
  }else{
    $('#kec').text('-');
    $('#kab').text('Kecamatan');
  }
  var table = $('#tblrekap').DataTable();
  table.ajax.reload();
}

function getKec(){
  var hasil = $('#kecamatan').val();
  return hasil;
}

function getKecamatan(){
  $.ajax({
    url:getbasepath()+"uptd/Rekapjwbpd/getKecamatan",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Pilih Kecamatan -- </option>";
        for (var i = 0; i < data.kecamatan.length;i++){
              var isi = data.kecamatan[i]['kecamatan'];
              var kode = data.kecamatan[i]['kecamatan'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#kecamatan').html(option);
    }
  })
}