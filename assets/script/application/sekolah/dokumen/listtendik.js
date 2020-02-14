$(document).ready(function(){
  getTendik();
});

function getTendik() {
      var table =   $('#tblguru').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/tendik/listTendikPensiun",
              "type": "POST"
          }
      });
}

function reload() {
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
}


function refreshData(){
  var table = $('#tblguru').DataTable();
  table.ajax.reload();
}

function printdokument() {
    window.location.href=getbasepath()+"sekolah/tendik/cetak_dokumen/";
}