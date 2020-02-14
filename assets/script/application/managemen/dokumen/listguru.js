$(document).ready(function(){
  getSekolah();
  getguru();
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
              "url": getbasepath()+"pengelola/guru/listGuruPensi",
              "type": "POST",
              "data":function(d) {
                  d.npsn = getNpsn();
              }
          }
      });
}

function reload() {
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
}

function getNpsn(){
  var hasil = $('#sekolah').val();
  return hasil;
}

function getSekolah(){
  $.ajax({
    url:getbasepath()+"pengelola/Pesertadidik/getSekolah",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        console.log(data);
        var option = "<option selected value=''> -- Semua Sekolah -- </option>";
        for (var i = 0; i < data.sekolah.length;i++){
              var isi = data.sekolah[i]['namasekolah'];
              var kode = data.sekolah[i]['npsn'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#sekolah').html(option);
    }
  })
}

function refreshData(){
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
}

function printdokument() {
    window.location.href=getbasepath()+"pengelola/guru/cetak_dokumen/"+getNpsn();
}

function printexcel() {
    window.location.href=getbasepath()+"pengelola/guru/cetak_excel/"+getNpsn();
}