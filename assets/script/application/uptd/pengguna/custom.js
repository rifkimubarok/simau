$(document).ready(function(){
    //getProfile();
    getPengguna();
});

function getPengguna() {
      var table =   $('#tblPengguna').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"pengelola/Pengguna/listPengguna",
              "type": "POST"
          }
      });
}

function resetPass(id){
  $.ajax({
      url: getbasepath()+"pengelola/pengguna/reset/"+id,
      type: "POST",
      dataType: "JSON"
  });
    alert('Reset password berhasil!');
}

function generateuser() {
  $.ajax({
      url:getbasepath()+"pengelola/Pengguna/generateuser",
      type:"POST",
      dataType:"JSON",
      success: function(data) {
          if(data.Status == true){
            alert("Generate User Berhasil");
            reload();
          }else{
            alert("Tidak Ada User Yang Dibuat.")
          }
      },
      error:function(d,x,y) {
          alert("Generate User Gagal");
      }
  });
}

function reload() {
  var table =   $('#tblPengguna').DataTable();
  table.ajax.reload();
}