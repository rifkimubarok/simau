$(document).ready(function(){
  getSekolah();
});

function getSekolah() {
      var table =   $('#tblSekolah').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"sekolah/Json/listSekolah",
              "type": "POST"
          }
      });
}

function editSekolah(id){
  $.ajax({
    url: getbasepath()+"sekolah/Json/editSekolah",
    type:"POST",
    data: {id_sekolah:id},
    success:function(data){
      $('#isiFormulir').html(data);
      $('.modal-title').text("Ubah Data Sekolah");
      $('#modalEditSekolah').modal({backdrop: 'static',keyboard:false})
      $('#SaveAccount').text('Ubah Data');
      getDetSekolah(id);
    }
  });
}

function tambahData(){
  
  $.ajax({
    url: getbasepath()+"sekolah/Json/editSekolah",
    type:"POST",
    success:function(data){
      $('#isiFormulir').html(data);
      $('.modal-title').text("Tambah Data Sekolah");
      $('#modalEditSekolah').modal({backdrop: 'static',keyboard:false});
      $('#SaveAccount').text('Simpan Data');
      document.getElementById("tambahSekolah").reset();
    }
  });
}

function getDetSekolah(id){
  $.ajax({
    url: getbasepath()+"sekolah/Json/getDetSekolah",
    type:"POST",
    dataType:"JSON",
    data: {id_sekolah:id},
    success:function(data){
      $('#id').val(data.id);
      $('#NPSN').val(data.NPSN);
      $('#nama_sekolah').val(data.nama_sekolah);
      $('#alamat').val(data.alamat);
      $('#desa').val(data.desa);
      $('#telepon').val(data.telepon);
      $('#kecamatan').val(data.kecamatan);
      $('#kabupaten').val(data.kabupaten);
      $('#thn_pendirian').val(data.thn_pendirian);
      $('#lat').val(data.lat);
      $('#lng').val(data.lng);
      $('#statusAction').val("1");
      $('#nameofimage').val(data.foto);
      $('#statusUpload').val('1');
      document.getElementById("showingimage").style.display="block";
      var src = getbasepath()+"assets/images/upload/"+data.foto;
      $('#showingimage').attr('src', src).width(150);
    }
  });
}

function validasi(){
  var status = $('#statusAction').val();
  if(status == "1"){
    ubahData();
  }else{
    simpanData();
  }
}

function ubahData(){
  var id = $('#id').val();
  var NPSN = $('#NPSN').val();
  var nama_sekolah = $('#nama_sekolah').val();
  var alamat = $('#alamat').val();
  var desa = $('#desa').val();
  var telepon = $('#telepon').val();
  var kecamatan = $('#kecamatan').val();
  var kabupaten = $('#kabupaten').val();
  var thn_pendirian = $('#thn_pendirian').val();
  var lat = $('#lat').val();
  var lng = $('#lng').val();
  var foto = $('#nameofimage').val();

  var dataac = [];
    var data = {
      'NPSN' : NPSN,
      'nama_sekolah' : nama_sekolah,
      'alamat' : alamat,
      'desa' : desa,
      'telepon' : telepon,
      'kecamatan' : kecamatan,
      'kabupaten' : kabupaten,
      'thn_pendirian' : thn_pendirian,
      'lat' : lat,
      'lng' : lng,
      'foto' : foto
    };

    var dataa = {
      id: id,
      data: data
    }
  dataac = dataa;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "sekolah/Json/updateData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
      alert('Data Berhasil di Ubah');
      $('#modalEditSekolah').modal('hide');
      var table = $('#tblSekolah').DataTable();
      table.ajax.reload();
      }); 
}

function simpanData(){
  var NPSN = $('#NPSN').val();
  var nama_sekolah = $('#nama_sekolah').val();
  var alamat = $('#alamat').val();
  var desa = $('#desa').val();
  var telepon = $('#telepon').val();
  var kecamatan = $('#kecamatan').val();
  var kabupaten = $('#kabupaten').val();
  var thn_pendirian = $('#thn_pendirian').val();
  var lat = $('#lat').val();
  var lng = $('#lng').val();
  var foto = $('#nameofimage').val();
   if (NPSN != "" && nama_sekolah != "" && alamat != "" && desa != "" && kecamatan != "" && kabupaten != "" && thn_pendirian != "" ) {
    console.log('a');
      var dataac = [];
    var data = {
      'NPSN' : NPSN,
      'nama_sekolah' : nama_sekolah,
      'alamat' : alamat,
      'desa' : desa,
      'telepon' : telepon,
      'kecamatan' : kecamatan,
      'kabupaten' : kabupaten,
      'thn_pendirian' : thn_pendirian,
      'lat' : lat,
      'lng' : lng,
      'foto' : foto
    };

  dataac = data;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "sekolah/Json/simpanData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
      alert('Data Berhasil di Ubah');
      $('#modalEditSekolah').modal('hide');
      var table = $('#tblSekolah').DataTable();
      table.ajax.reload();
      }); 
   }
}