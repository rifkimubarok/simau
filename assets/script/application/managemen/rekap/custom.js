$(document).ready(function(){
  getKabupaten();
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
              "url": getbasepath()+"managemen/Rekapjwbpd/listrekap",
              "type": "POST",
              "data":function(d) {
                  d.getkab = getKab();
                  d.getkec = getKec();
              }
          }
      });
}

function reload() {
  var kab = $('#Kabupaten').val();
  if(kab != ''){
      $('#kecamatan').prop('disabled',false);
  }else{
    $('#kecamatan').prop('disabled',true);
    $('#kecamatan').val('');
  }
  var hasil = $('#kecamatan').val();
  if(hasil != ''){
    $('#kec').text('Sekolah');
    $('#kab').text('Kecamatan');
  }else{
    $('#kec').text('Kecamatan');
    $('#kab').text('Kabupaten');
  }
  var table = $('#tblrekap').DataTable();
  table.ajax.reload();
}

function getKec(){
  var hasil = $('#kecamatan').val();
  return hasil;
}

function getKab(){
  var hasil = $('#Kabupaten').val();
  return hasil;
}

function getKabupaten(){
  $.ajax({
    url:getbasepath()+"managemen/Rekapjwbpd/getKabupaten",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Pilih Kabupaten -- </option>";
        for (var i = 0; i < data.kabupaten.length;i++){
              var isi = data.kabupaten[i]['nm_rayon'];
              var kode = data.kabupaten[i]['kd_rayon'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#Kabupaten').html(option);
    }
  })
}

function getKecamatan(){
  $.ajax({
    url:getbasepath()+"managemen/Rekapjwbpd/getKecamatan",
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
        $('#kecamatan').prop('disabled',true);
    }
  })
}