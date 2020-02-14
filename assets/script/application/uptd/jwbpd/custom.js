$(document).ready(function(){
  getjwbpd();
});

function getjwbpd() {
      var table =   $('#tbljwb').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"uptd/Jwbpd/listjwbpd",
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


function refreshData(){
  var table = $('#tbljwb').DataTable();
  table.ajax.reload();
}