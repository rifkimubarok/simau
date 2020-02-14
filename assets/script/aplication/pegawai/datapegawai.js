$(document).ready(function(){
  getPegawai();
});

function getPegawai() {
      var table =   $('#tblAbsenGuru').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"pegawai/Json/listPegawai",
              "type": "POST"
          }
      });
}