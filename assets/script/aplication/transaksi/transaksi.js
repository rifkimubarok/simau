$(document).ready(function(){
      loadLastTransaksi();
});
//load last Transaksi
var idTransaksi = "";
function loadLastTransaksi(){
  $.ajax({
    url:getbasepath()+"transaksi/Json/getLastTransaksi",
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      if(data.status == "gagal"){
        addTransaksi();
      }else{
        console.log(data.status);
        idTransaksi = data.id_trans;
        getPerkakas(idTransaksi);
        getTanah(idTransaksi);
        getBangunan(idTransaksi);
        getJenisBangunan(idTransaksi);
        getMurid(idTransaksi);
        getAbsensiGuru(idTransaksi);
        getMuridUsia(idTransaksi);
        getMuridAgama(idTransaksi);
        $('#idTransaksi').val(data.id_trans);
        $('#statusewa').val(data.kondisi);
        $('#hargaperbulan').val(data.harga_sewa);
        $('#statusairbersih').val(data.persediaan_air);
        $('#jmlSakit').val(data.murid_sakit);
        $('#jmlIzin').val(data.murid_ijin);
        $('#jmlLain').val(data.murid_lainnya);
        $('#totalAbsen').val(data.total_absen);
        $('#persenAbsen').val(data.persentase);
        $('#gLaki').val(data.jml_guruL);
        $('#gPerem').val(data.jml_guruP);
        $('#gJml').val(data.total_guru);
        $('#pLaki').val(data.jml_penjagaL);
        $('#pPerem').val(data.jml_penjagaP);
        $('#pJml').val(data.total_penjaga);
        getStatusSewa();
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
    }
  });
}

function addTransaksi(){
  $.ajax({
    url: getbasepath()+"transaksi/Json/addNewTransaksi",
    type:"POST",
    dataType: "JSON",
    success:function(data){
      loadLastTransaksi();
    },
    error:function(jqXHR, textStatus, errorThrown){
      alert("Gagal Menambah Transaksi Baru");
    }
  });
}


// Start Transaksi perkakas

function getPerkakas(idTransaksi) {
      var table =   $('#tblPerkakas').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true,
           //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listPerkakas",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });

      $('#poliklinik').on('change', function () {
        if (!!this.value) {
            table.column(4).search(this.value).draw();
        } else {

            table.column(4).search(this.value).draw();
        }
      } );
}

var baik,sedang,buruk;
var idperkakas = '0';
function enablePerkakas(id){
   if(idperkakas == '0'){
      console.log(idperkakas);
      idperkakas = id;
   }else{
    cancelPerkakas(idperkakas);
   }
   idperkakas = id;
   $('#baik'+id).prop("disabled", false);
   $('#sedang'+id).prop("disabled", false);
   $('#rusak'+id).prop("disabled", false);
   document.getElementById("ubah"+id).style.display="none";
   document.getElementById("save"+id).style.display="block";
   document.getElementById("cancel"+id).style.display="block";
   baik = $('#baik'+id).val();
   sedang = $('#sedang'+id).val();
   buruk = $('#rusak'+id).val();
}

function cancelPerkakas(id) {
  console.log('asds'+id);
   $('#baik'+id).prop("disabled", true);
   $('#sedang'+id).prop("disabled", true);
   $('#rusak'+id).prop("disabled", true);
   document.getElementById("ubah"+id).style.display="block";
   document.getElementById("save"+id).style.display="none";
   document.getElementById("cancel"+id).style.display="none";
   $('#baik'+id).val(baik);
   $('#sedang'+id).val(sedang);
   $('#rusak'+id).val(buruk);
   jumlahPerkakas(id);
}

function jumlahPerkakas(id) {
  var baik = parseInt($('#baik'+id).val());
  var sedang = parseInt($('#sedang'+id).val());
  var rusak = parseInt($('#rusak'+id).val());
  var jumlah = baik+sedang+rusak;
  $('#jumlah'+id).val(jumlah);
}

function simpanDataPerkakas(id,id_perkakas){
   baik = $('#baik'+id).val();
   sedang = $('#sedang'+id).val();
   buruk = $('#rusak'+id).val();

   var dataac = [];
    
        var data = {
            'id': id,
            'id_perkakas': id_perkakas,
            'baik': $('#baik'+id).val(),
            'sedang': $('#sedang'+id).val(),
            'buruk': $('#rusak'+id).val(),
            'jumlah': $('#jumlah'+id).val()
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updatePerkakas",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelPerkakas(id);
        });
}

//End Transaksi Perkakas

//Start Transaksi Tanah

function getTanah(idTransaksi) {
      var table =   $('#tblTanah').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true, //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listTanah",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

var luastanah,nopersil,tahunbeli,hargatanah;
var idtanah = '0';
function enabletanah(id){
   if(idtanah == '0'){
      idtanah = id;
   }else{
    cancelTanah(idtanah);
   }
   idtanah = id;
   $('#luastanah'+id).prop("disabled", false);
   $('#nopersil'+id).prop("disabled", false);
   $('#tahunbeli'+id).prop("disabled", false);
   $('#hargatanah'+id).prop("disabled", false);
   document.getElementById("tanahubah"+id).style.display="none";
   document.getElementById("tanahsave"+id).style.display="block";
   document.getElementById("tanahcancel"+id).style.display="block";
   luastanah = $('#luastanah'+id).val();
   nopersil = $('#nopersil'+id).val();
   tahunbeli = $('#tahunbeli'+id).val();
   hargatanah = $('#hargatanah'+id).val();
}

function cancelTanah(id) {
   $('#luastanah'+id).prop("disabled", true);
   $('#nopersil'+id).prop("disabled", true);
   $('#tahunbeli'+id).prop("disabled", true);
   $('#hargatanah'+id).prop("disabled", true);
   document.getElementById("tanahubah"+id).style.display="block";
   document.getElementById("tanahsave"+id).style.display="none";
   document.getElementById("tanahcancel"+id).style.display="none";
   $('#luastanah'+id).val(luastanah);
   $('#nopersil'+id).val(nopersil);
   $('#tahunbeli'+id).val(tahunbeli);
   $('#hargatanah'+id).val(hargatanah); 
}

function simpanDatatanah(id){
  luastanah = $('#luastanah'+id).val();
  nopersil = $('#nopersil'+id).val();
  tahunbeli = $('#tahunbeli'+id).val();
  hargatanah = $('#hargatanah'+id).val();

   var dataac = [];
    
        var data = {
            'id': id,
            'luas_tanah': luastanah,
            'no_persil': nopersil,
            'tahun_beli': tahunbeli,
            'harga': hargatanah
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateTanah",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelTanah(id);
        });
}

//End Transaksi Tanah

//Start Transaksi Bangunan

function getBangunan(idTransaksi) {
      var table =   $('#tblBangunan').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true,
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listBangunan",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

var baik_bgn,baik_ruang,sedang_bgn,sedang_ruang,rusak_bgn,rusak_ruang,jml_bgn,jml_ruang;
var idbangunan = '0';
function enablebangunan(id) {
  if(idbangunan == '0'){
      idbangunan = id;
   }else{
    cancelbangunan(idbangunan);
   }
   idbangunan = id;
   $('#baik_bgn'+id).prop("disabled", false);
   $('#baik_ruang'+id).prop("disabled", false);
   $('#sedang_bgn'+id).prop("disabled", false);
   $('#sedang_ruang'+id).prop("disabled", false);
   $('#rusak_bgn'+id).prop("disabled", false);
   $('#rusak_ruang'+id).prop("disabled", false);
   document.getElementById("bangunanubah"+id).style.display="none";
   document.getElementById("bangunansave"+id).style.display="block";
   document.getElementById("bangunancancel"+id).style.display="block";
   baik_bgn= $('#baik_bgn'+id).val();
   baik_ruang= $('#baik_ruang'+id).val();
   sedang_bgn= $('#sedang_bgn'+id).val();
   sedang_ruang= $('#sedang_ruang'+id).val();
   rusak_bgn= $('#rusak_bgn'+id).val();
   rusak_ruang= $('#rusak_ruang'+id).val();
   jml_bgn= $('#jml_bgn'+id).val();
   jml_ruang= $('#jml_ruang'+id).val();
}

function cancelbangunan(id){
  $('#baik_bgn'+id).prop("disabled", true);
   $('#baik_ruang'+id).prop("disabled", true);
   $('#sedang_bgn'+id).prop("disabled", true);
   $('#sedang_ruang'+id).prop("disabled", true);
   $('#rusak_bgn'+id).prop("disabled", true);
   $('#rusak_ruang'+id).prop("disabled", true);
   document.getElementById("bangunanubah"+id).style.display="block";
   document.getElementById("bangunansave"+id).style.display="none";
   document.getElementById("bangunancancel"+id).style.display="none";
   $('#baik_bgn'+id).val(baik_bgn);
   $('#baik_ruang'+id).val(baik_ruang);
   $('#sedang_bgn'+id).val(sedang_bgn);
   $('#sedang_ruang'+id).val(sedang_ruang);
   $('#rusak_bgn'+id).val(rusak_bgn);
   $('#rusak_ruang'+id).val(rusak_ruang);
   $('#jml_bgn'+id).val(jml_bgn);
   $('#jml_ruang'+id).val(jml_ruang);
}

function jumlahBangunan(id) {
  console.log('a');
   var baik_bgn1= parseInt($('#baik_bgn'+id).val());
   var baik_ruang1= parseInt($('#baik_ruang'+id).val());
   var sedang_bgn1= parseInt($('#sedang_bgn'+id).val());
   var sedang_ruang1= parseInt($('#sedang_ruang'+id).val());
   var rusak_bgn1= parseInt($('#rusak_bgn'+id).val());
   var rusak_ruang1= parseInt($('#rusak_ruang'+id).val());
   var jml_bgn1= parseInt($('#jml_bgn'+id).val());
   var jml_ruang1= parseInt($('#jml_ruang'+id).val());
   var hasil_bgn = baik_bgn1+sedang_bgn1+rusak_bgn1;
   var hasil_ruang = baik_ruang1+sedang_ruang1+rusak_ruang1;
  $('#jml_bgn'+id).val(hasil_bgn);
  $('#jml_ruang'+id).val(hasil_ruang);
}

function simpanDatabangunan(id){
   baik_bgn= $('#baik_bgn'+id).val();
   baik_ruang= $('#baik_ruang'+id).val();
   sedang_bgn= $('#sedang_bgn'+id).val();
   sedang_ruang= $('#sedang_ruang'+id).val();
   rusak_bgn= $('#rusak_bgn'+id).val();
   rusak_ruang= $('#rusak_ruang'+id).val();
   jml_bgn= $('#jml_bgn'+id).val();
   jml_ruang= $('#jml_ruang'+id).val();

   var dataac = [];
    
        var data = {
            'id': id,
            'baik_bgn': baik_bgn,
            'baik_ruang': baik_ruang,
            'sedang_bgn': sedang_bgn,
            'sedang_ruang': sedang_ruang,
            'rusak_bgn': rusak_bgn,
            'rusak_ruang': rusak_ruang,
            'jml_bgn': jml_bgn,
            'jml_ruang': jml_ruang
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateBangunan",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelbangunan(id);
        });
}

// End Transaksi Bangunan

//Start Transaksi Jenis Bangunan
function getJenisBangunan(idTransaksi) {
      var table =   $('#tblJenisBangunan').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true, //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listJenisBangunan",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

var permanent,semipermanent,darurat,thnp,thnsp,thnd,hargajenis;
var idjenisbangunan = '0';
function enablejenis(id) {
   if(idjenisbangunan == '0'){
      idjenisbangunan = id;
   }else{
    canceljenis(idjenisbangunan);
   }
   idjenisbangunan = id;
   $('#permanent'+id).prop("disabled", false);
   $('#semipermanent'+id).prop("disabled", false);
   $('#darurat'+id).prop("disabled", false);
   $('#thnp'+id).prop("disabled", false);
   $('#thnsp'+id).prop("disabled", false);
   $('#thnd'+id).prop("disabled", false);
   $('#hargajenis'+id).prop("disabled", false);
   document.getElementById("jenisubah"+id).style.display="none";
   document.getElementById("jenissave"+id).style.display="block";
   document.getElementById("jeniscancel"+id).style.display="block";
   permanent = $('#permanent'+id).val();
   semipermanent = $('#semipermanent'+id).val();
   darurat = $('#darurat'+id).val();
   thnp = $('#thnp'+id).val();
   thnsp = $('#thnsp'+id).val();
   thnd = $('#thnd'+id).val();
   hargajenis = $('#hargajenis'+id).val();
}

function canceljenis(id) {
  $('#permanent'+id).prop("disabled", true);
   $('#semipermanent'+id).prop("disabled", true);
   $('#darurat'+id).prop("disabled", true);
   $('#thnp'+id).prop("disabled", true);
   $('#thnsp'+id).prop("disabled", true);
   $('#thnd'+id).prop("disabled", true);
   $('#hargajenis'+id).prop("disabled", true);
   document.getElementById("jenisubah"+id).style.display="block";
   document.getElementById("jenissave"+id).style.display="none";
   document.getElementById("jeniscancel"+id).style.display="none";
   $('#permanent'+id).val(permanent);
   $('#semipermanent'+id).val(semipermanent);
   $('#darurat'+id).val(darurat);
   $('#thnp'+id).val(thnp);
   $('#thnsp'+id).val(thnsp);
   $('#thnd'+id).val(thnd);
   $('#hargajenis'+id).val(hargajenis);
}

function simpanDatajenis(id) {
   permanent = $('#permanent'+id).val();
   semipermanent = $('#semipermanent'+id).val();
   darurat = $('#darurat'+id).val();
   thnp = $('#thnp'+id).val();
   thnsp = $('#thnsp'+id).val();
   thnd = $('#thnd'+id).val();
   hargajenis = $('#hargajenis'+id).val();

   var dataac = [];
    
        var data = {
            'id': id,
            'permanent': permanent,
            'semi_permanent': semipermanent,
            'darurat': darurat,
            'thn_p': thnp,
            'thn_sp': thnsp,
            'thn_d': thnd,
            'harga': hargajenis
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateJenisBangunan",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         canceljenis(id);
        });
}
//End Transaski JenisBangunan

//Start Transaksi Sewa
function getStatusSewa() {
  var status = $('#statusewa').val();
  if(status == "MENYEWA"){
    document.getElementById('hargasewaperbulan').style.display="block";
  }else{
    $('#hargaperbulan').val('0');
    document.getElementById('hargasewaperbulan').style.display="none";
  }
}

function simpanDataSewa(){
   noTrans = $('#idTransaksi').val();
   var status = $('#statusewa').val();
   hargasewa = $('#hargaperbulan').val();

   var dataac = [];
    
        var data = {
            'id_trans': noTrans,
            'kondisi': status,
            'harga_sewa': hargasewa
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateKondisi",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         alert("Data Berhasil di Simpan.");
        }); 
}

//End Transaksi Sewa

//Start Transaksi Murid
function getMurid(idTransaksi) {
      var table =   $('#tblMurid').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: false, //Initial no order.
          "order": [],

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listMurid",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

var kelas1L,kelas1P,kelas2L,kelas2P,kelas3L,kelas3P,kelas4L,kelas4P,kelas5L,kelas5P,kelas6L,kelas6P,totalL,totalP,totalmurid;
var idmurid = '0';
function enablemurid(id) {
  if(idmurid == '0'){
      idmurid = id;
   }else{
    cancelmurid(idmurid);
   }
   idmurid = id;
  $('#kelas1L'+id).prop("disabled", false);
  $('#kelas1P'+id).prop("disabled", false);
  $('#kelas2L'+id).prop("disabled", false);
  $('#kelas2P'+id).prop("disabled", false);
  $('#kelas3L'+id).prop("disabled", false);
  $('#kelas3P'+id).prop("disabled", false);
  $('#kelas4L'+id).prop("disabled", false);
  $('#kelas4P'+id).prop("disabled", false);
  $('#kelas5L'+id).prop("disabled", false);
  $('#kelas5P'+id).prop("disabled", false);
  $('#kelas6L'+id).prop("disabled", false);
  $('#kelas6P'+id).prop("disabled", false);
   document.getElementById("muridubah"+id).style.display="none";
   document.getElementById("muridsave"+id).style.display="block";
   document.getElementById("muridcancel"+id).style.display="block";
  kelas1L =$('#kelas1L'+id).val();
  kelas1P =$('#kelas1P'+id).val();
  kelas2L =$('#kelas2L'+id).val();
  kelas2P =$('#kelas2P'+id).val();
  kelas3L =$('#kelas3L'+id).val();
  kelas3P =$('#kelas3P'+id).val();
  kelas4L =$('#kelas4L'+id).val();
  kelas4P =$('#kelas4P'+id).val();
  kelas5L =$('#kelas5L'+id).val();
  kelas5P =$('#kelas5P'+id).val();
  kelas6L =$('#kelas6L'+id).val();
  kelas6P =$('#kelas6P'+id).val();
  totalL =$('#totalL'+id).val();
  totalP =$('#totalP'+id).val();
  totalmurid =$('#totalmurid'+id).val();
}

function cancelmurid(id){
  $('#kelas1L'+id).prop("disabled", true);
  $('#kelas1P'+id).prop("disabled", true);
  $('#kelas2L'+id).prop("disabled", true);
  $('#kelas2P'+id).prop("disabled", true);
  $('#kelas3L'+id).prop("disabled", true);
  $('#kelas3P'+id).prop("disabled", true);
  $('#kelas4L'+id).prop("disabled", true);
  $('#kelas4P'+id).prop("disabled", true);
  $('#kelas5L'+id).prop("disabled", true);
  $('#kelas5P'+id).prop("disabled", true);
  $('#kelas6L'+id).prop("disabled", true);
  $('#kelas6P'+id).prop("disabled", true);
   document.getElementById("muridubah"+id).style.display="block";
   document.getElementById("muridsave"+id).style.display="none";
   document.getElementById("muridcancel"+id).style.display="none";
  $('#kelas1L'+id).val(kelas1L);
  $('#kelas1P'+id).val(kelas1P);
  $('#kelas2L'+id).val(kelas2L);
  $('#kelas2P'+id).val(kelas2P);
  $('#kelas3L'+id).val(kelas3L);
  $('#kelas3P'+id).val(kelas3P);
  $('#kelas4L'+id).val(kelas4L);
  $('#kelas4P'+id).val(kelas4P);
  $('#kelas5L'+id).val(kelas5L);
  $('#kelas5P'+id).val(kelas5P);
  $('#kelas6L'+id).val(kelas6L);
  $('#kelas6P'+id).val(kelas6P);
  $('#totalL'+id).val(totalL);
  $('#totalP'+id).val(totalP);
  $('#totalmurid'+id).val(totalmurid);
}

function jumlahmurid(id) {
  var element = $('#tblMurid');
    var divider = 2;
    var originalTable = element.clone();
    var tds = $(originalTable).children('tbody').children('tr').length;
    console.log(tds);
    var noTransaksi = $('#idTransaksi').val();
    var datatest = [];
    
    var kelas1LI = 0;    var kelas1PI = 0;    var kelas2LI = 0;    var kelas2PI = 0;    var kelas3LI = 0;    var kelas3PI = 0;
    var kelas4LI = 0;    var kelas4PI = 0;    var kelas5LI = 0;    var kelas5PI = 0;    var kelas6LI = 0;    var kelas6PI = 0;
    var totalLI = 0;    var totalPI = 0;    var totalmuridI = 0;

    var kelas1LA = 0;    var kelas1PA = 0;    var kelas2LA = 0;    var kelas2PA = 0;    var kelas3LA = 0;    var kelas3PA = 0;
    var kelas4LA = 0;    var kelas4PA = 0;    var kelas5LA = 0;    var kelas5PA = 0;    var kelas6LA = 0;    var kelas6PA = 0;
    var totalLA = 0;    var totalPA = 0;    var totalmuridA = 0;
    for (var i = 1; i<=tds-2; i++) {
        
          var kelas1L = parseInt($('#kelas1L'+i).val());          var kelas1P = parseInt($('#kelas1P'+i).val());
          var kelas2L = parseInt($('#kelas2L'+i).val());          var kelas2P = parseInt($('#kelas2P'+i).val());
          var kelas3L = parseInt($('#kelas3L'+i).val());          var kelas3P = parseInt($('#kelas3P'+i).val());
          var kelas4L = parseInt($('#kelas4L'+i).val());          var kelas4P = parseInt($('#kelas4P'+i).val());
          var kelas5L = parseInt($('#kelas5L'+i).val());          var kelas5P = parseInt($('#kelas5P'+i).val());
          var kelas6L = parseInt($('#kelas6L'+i).val());          var kelas6P = parseInt($('#kelas6P'+i).val());
          var totalL  = parseInt($('#totalL'+i).val());          var totalP  = parseInt($('#totalP'+i).val());
          var totalmurid  = parseInt($('#totalmurid'+i).val());          var idtrmurid = parseInt($('#idtrmurid'+i).val());
          if(i % 2 ==1){
            if(i==1){
              kelas1LI += kelas1L;  kelas1PI += kelas1P;
              kelas2LI += kelas2L;  kelas2PI += kelas2P;
              kelas3LI += kelas3L;  kelas3PI += kelas3P;
              kelas4LI += kelas4L;  kelas4PI += kelas4P;
              kelas5LI += kelas5L;  kelas5PI += kelas5P;
              kelas6LI += kelas6L;  kelas6PI += kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              totalLI += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPI += kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridI += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
            if(i==3){
              kelas1LI -= kelas1L;  kelas1PI -= kelas1P;
              kelas2LI -= kelas2L;  kelas2PI -= kelas2P;
              kelas3LI -= kelas3L;  kelas3PI -= kelas3P;
              kelas4LI -= kelas4L;  kelas4PI -= kelas4P;
              kelas5LI -= kelas5L;  kelas5PI -= kelas5P;
              kelas6LI -= kelas6L;  kelas6PI -= kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              totalLI -= kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPI -= kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridI -= kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
            if(i==5){
              kelas1LI += kelas1L;  kelas1PI += kelas1P;
              kelas2LI += kelas2L;  kelas2PI += kelas2P;
              kelas3LI += kelas3L;  kelas3PI += kelas3P;
              kelas4LI += kelas4L;  kelas4PI += kelas4P;
              kelas5LI += kelas5L;  kelas5PI += kelas5P;
              kelas6LI += kelas6L;  kelas6PI += kelas6P;
              totalLI += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPI += kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridI += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
          }else{
            if(i==2){
              kelas1LA += kelas1L;  kelas1PA += kelas1P;
              kelas2LA += kelas2L;  kelas2PA += kelas2P;
              kelas3LA += kelas3L;  kelas3PA += kelas3P;
              kelas4LA += kelas4L;  kelas4PA += kelas4P;
              kelas5LA += kelas5L;  kelas5PA += kelas5P;
              kelas6LA += kelas6L;  kelas6PA += kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              totalLA += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPA += kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridA += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
            if(i==4){
              kelas1LA -= kelas1L;  kelas1PA -= kelas1P;
              kelas2LA -= kelas2L;  kelas2PA -= kelas2P;
              kelas3LA -= kelas3L;  kelas3PA -= kelas3P;
              kelas4LA -= kelas4L;  kelas4PA -= kelas4P;
              kelas5LA -= kelas5L;  kelas5PA -= kelas5P;
              kelas6LA -= kelas6L;  kelas6PA -= kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              totalLA -= kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPA -= kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridA -= kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
            if(i==6){
              kelas1LA += kelas1L;  kelas1PA += kelas1P;
              kelas2LA += kelas2L;  kelas2PA += kelas2P;
              kelas3LA += kelas3L;  kelas3PA += kelas3P;
              kelas4LA += kelas4L;  kelas4PA += kelas4P;
              kelas5LA += kelas5L;  kelas5PA += kelas5P;
              kelas6LA += kelas6L;  kelas6PA += kelas6P;
              totalLA += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L;
              totalPA += kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              totalmuridA += kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P;
              $('#totalL'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L);
              $('#totalP'+i).val(kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
              $('#totalmurid'+i).val(kelas1L+kelas2L+kelas3L+kelas4L+kelas5L+kelas6L+kelas1P+kelas2P+kelas3P+kelas4P+kelas5P+kelas6P);
            }
          }
    }

    console.log("Jumlah Akhir L indonesia " + totalLI);
    console.log("Jumlah Akhir P indonesia " + totalPI);
    $('#kelas1L7').val(kelas1LI);            $('#kelas1P7').val(kelas1PI);
    $('#kelas2L7').val(kelas2LI);            $('#kelas2P7').val(kelas2PI);
    $('#kelas3L7').val(kelas3LI);            $('#kelas3P7').val(kelas3PI);
    $('#kelas4L7').val(kelas4LI);            $('#kelas4P7').val(kelas4PI);
    $('#kelas5L7').val(kelas5LI);            $('#kelas5P7').val(kelas5PI);
    $('#kelas6L7').val(kelas6LI);            $('#kelas6P7').val(kelas6PI);
    $('#totalL7').val(totalLI);              $('#totalP7').val(totalPI);
    $('#totalP7').val(totalPI);
    $('#totalL7').val(totalLI);
    $('#totalmurid7').val(totalmuridI);
    $('#kelas1L8').val(kelas1LA);            $('#kelas1P8').val(kelas1PA);
    $('#kelas2L8').val(kelas2LA);            $('#kelas2P8').val(kelas2PA);
    $('#kelas3L8').val(kelas3LA);            $('#kelas3P8').val(kelas3PA);
    $('#kelas4L8').val(kelas4LA);            $('#kelas4P8').val(kelas4PA);
    $('#kelas5L8').val(kelas5LA);            $('#kelas5P8').val(kelas5PA);
    $('#kelas6L8').val(kelas6LA);            $('#kelas6P8').val(kelas6PA);
    $('#totalL8').val(totalLA);              $('#totalP8').val(totalPA);
    $('#totalP8').val(totalPA);
    $('#totalL8').val(totalLA);
    $('#totalmurid8').val(totalmuridA);
}

function simpanDatamurid(id) {
    var element = $('#tblMurid');
    var divider = 2;
    var originalTable = element.clone();
    var tds = $(originalTable).children('tbody').children('tr').length;
    console.log(tds);
    var noTransaksi = $('#idTransaksi').val();
    var datatest = [];
    x=0;
    for (var i = 1; i<=tds; i++) {
        var data = {
          "kelas1L": $('#kelas1L'+i).val(),
          "kelas1P": $('#kelas1P'+i).val(),
          "kelas2L": $('#kelas2L'+i).val(),
          "kelas2P": $('#kelas2P'+i).val(),
          "kelas3L": $('#kelas3L'+i).val(),
          "kelas3P": $('#kelas3P'+i).val(),
          "kelas4L": $('#kelas4L'+i).val(),
          "kelas4P": $('#kelas4P'+i).val(),
          "kelas5L": $('#kelas5L'+i).val(),
          "kelas5P": $('#kelas5P'+i).val(),
          "kelas6L": $('#kelas6L'+i).val(),
          "kelas6P": $('#kelas6P'+i).val(),
          "totalL" : $('#totalL'+i).val(),
          "totalP" : $('#totalP'+i).val(),
          "totalmurid" : $('#totalmurid'+i).val(),
          "idtrmurid": $('#idtrmurid'+i).val()
        }
        datatest[x] = data;
        x += 1;
    }
    var dataac = [];
      var dataa={
        "id_trans" : noTransaksi,
        "data" : datatest
      }
      dataac = dataa;
    //console.log(datatest);
    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/cekData",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelmurid(id);
         var table = $('#tblMurid').DataTable();
         table.ajax.reload();
         idmurid ='0';
    });
}

function cekBody(id){
    kelas1L =$('#kelas1L'+id).val();
    kelas1P =$('#kelas1P'+id).val();
    kelas2L =$('#kelas2L'+id).val();
    kelas2P =$('#kelas2P'+id).val();
    kelas3L =$('#kelas3L'+id).val();
    kelas3P =$('#kelas3P'+id).val();
    kelas4L =$('#kelas4L'+id).val();
    kelas4P =$('#kelas4P'+id).val();
    kelas5L =$('#kelas5L'+id).val();
    kelas5P =$('#kelas5P'+id).val();
    kelas6L =$('#kelas6L'+id).val();
    kelas6P =$('#kelas6P'+id).val();
    jmlL = $('#totalL'+id).val();
    jmlP = $('#totalP'+id).val();
    jml = $('#totalmurid'+id).val();
    var dataac = [];
    
        var data = {'id':id,
          'kelas1L' : kelas1L,
          'kelas1P' : kelas1P,
          'kelas2L' : kelas2L,
          'kelas2P' : kelas2P,
          'kelas3L' : kelas3L,
          'kelas3P' : kelas3P,
          'kelas4L' : kelas4L,
          'kelas4P' : kelas4P,
          'kelas5L' : kelas5L,
          'kelas5P' : kelas5P,
          'kelas6L' : kelas6L,
          'kelas6P' : kelas6P,
          'totalL' : jmlL,
          'totalP' : jmlP,
          'totalmurid' : jml
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateMurid",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelmurid(id);
        });
}
//End Transaksi Murid

//Start Transaksi Absen Murid
function hitungMuridAbsen(){
  var sakit = parseInt($('#jmlSakit').val());
  var izin = parseInt($('#jmlIzin').val());
  var lainnya = parseInt($('#jmlLain').val());
  var totalAbsen = sakit+izin+lainnya;
  $('#totalAbsen').val(totalAbsen);
}

function simpanDataAbsenMurid(){
  var sakit = parseInt($('#jmlSakit').val());
  var izin = parseInt($('#jmlIzin').val());
  var lainnya = parseInt($('#jmlLain').val());
  var total = parseInt($('#totalAbsen').val());
  var persentase = parseInt($('#persenAbsen').val());
  var noTransaksi = $('#idTransaksi').val();

   var dataac = [];
    
        var data = {
            'id_trans': noTransaksi,
            'murid_sakit': sakit,
            'murid_ijin': izin,
            'murid_lainnya': lainnya,
            'total_absen':total,
            'persentase':persentase
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateAbsenSiswa",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         alert('Data Absensi Murid Berhasil di Simpan.');
        });  
}

//End Transaksi Absen Murid

//Start Transaksi Jumlah Guru & Penjaga
function jumlahGuruPenjaga(){
    var gLaki =parseInt($('#gLaki').val());
    var gPerem =parseInt($('#gPerem').val());
    var gJml =parseInt($('#gJml').val());
    var pLaki =parseInt($('#pLaki').val());
    var pPerem =parseInt($('#pPerem').val());
    var pJml =parseInt($('#pJml').val());
    var JmlG = gLaki+gPerem;
    var JmlP = pLaki + pPerem;
        $('#gJml').val(JmlG);
        $('#pJml').val(JmlP);
}

function simpanGuruPenjaga() {
    var gLaki =parseInt($('#gLaki').val());
    var gPerem =parseInt($('#gPerem').val());
    var gJml =parseInt($('#gJml').val());
    var pLaki =parseInt($('#pLaki').val());
    var pPerem =parseInt($('#pPerem').val());
    var pJml =parseInt($('#pJml').val());
    var noTransaksi = $('#idTransaksi').val();

    var dataac = [];
    
        var data = {
            'id_trans': noTransaksi,
            'jml_guruL': gLaki,
            'jml_guruP': gPerem,
            'total_guru': gJml,
            'jml_penjagaL':pLaki,
            'jml_penjagaP':pPerem,
            'total_penjaga':pJml
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateGuruPenjaga",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         alert('Data Jumlah Guru & Penjaga Berhasil di Simpan.');
        });  
}

//End Transaksi Jumlah Guru & Penjaga

//Start Transaksi Penyedia Air
function simpanDataPenyediaAir() {
    var persediaan_air =$('#statusairbersih').val();
    var noTransaksi = $('#idTransaksi').val();

    var dataac = [];
    
        var data = {
            'id_trans': noTransaksi,
            'persediaan_air': persediaan_air
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updatePenyediaAir",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         alert('Data Persediaan Air Berhasil di Simpan.');
        });  
}
//End Transaksi Penyedia Air

//Start Transaksi Guru
function getAbsensiGuru(idTransaksi) {
      var table =   $('#tblAbsenGuru').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true, //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listAbsensiGuru",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}
var sakitguru,ijinguru,lainnyaguru;
var idguru = '0';
function enableguru(id) {
  if(idguru == '0'){
      idguru = id;
   }else{
    cancelguru(idguru);
   }
   idguru = id;
   $('#sakitguru'+id).prop("disabled", false);
   $('#ijinguru'+id).prop("disabled", false);
   $('#lainnyaguru'+id).prop("disabled", false);
   document.getElementById("guruubah"+id).style.display="none";
   document.getElementById("gurusave"+id).style.display="block";
   document.getElementById("gurucancel"+id).style.display="block";
   document.getElementById("guruedit"+id).style.display="none";
   sakitguru= $('#sakitguru'+id).val();
   ijinguru= $('#ijinguru'+id).val();
   lainnyaguru= $('#lainnyaguru'+id).val();
}

function cancelguru(id){
   idguru = '0';
   $('#sakitguru'+id).prop("disabled", true);
   $('#ijinguru'+id).prop("disabled", true);
   $('#lainnyaguru'+id).prop("disabled", true);
   document.getElementById("guruubah"+id).style.display="block";
   document.getElementById("gurusave"+id).style.display="none";
   document.getElementById("gurucancel"+id).style.display="none";
   document.getElementById("guruedit"+id).style.display="block";
   $('#sakitguru'+id).val(sakitguru);
   $('#ijinguru'+id).val(ijinguru);
   $('#lainnyaguru'+id).val(lainnyaguru);
}

function simpanDataguru(id){
    sakitguru= $('#sakitguru'+id).val();
    ijinguru= $('#ijinguru'+id).val();
    lainnyaguru= $('#lainnyaguru'+id).val();

    var dataac = [];
    
        var data = {
            'id': id,
            'sakitguru': sakitguru,
            'ijinguru': ijinguru,
            'lainnyaguru': lainnyaguru
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateAbsenGuru",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelguru(id);
        });  
}

function editDataGuru(idguru){
    $.ajax({
        url: getbasepath()+"transaksi/Json/editDataGuru",
        type: "POST",
        data: {idGuru: idguru},
        success: function(data){
            $('#isiFormulir').html(data);
            $('#modalEditGuru').modal({backdrop: 'static',keyboard:false});
        }
    });
}
//Enda Transaksi Guru

//Start Transaksi Jumlah Murid Usia
function getMuridUsia(idTransaksi) {
      var table =   $('#tblMuridUsia').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true, //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listMuridUsia",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

function editmuridusia(id,kelas) {
    $.ajax({
      url:getbasepath()+"transaksi/Json/getMuridUsia",
      type:"POST",
      dataType:"JSON",
      data:{'id':id},
      success:function(data) {
        $('.modal-title').text('Data Usia Murid Kelas '+kelas);
        $('#6L').val(data[0]['u6L']);$('#6P').val(data[0]['u6P']);
        $('#7L').val(data[0]['u7L']);$('#7P').val(data[0]['u7P']);
        $('#8L').val(data[0]['u8L']);$('#8P').val(data[0]['u8P']);
        $('#9L').val(data[0]['u9L']);$('#9P').val(data[0]['u9P']);
        $('#10L').val(data[0]['u10L']);$('#10P').val(data[0]['u10P']);
        $('#11L').val(data[0]['u11L']);$('#11P').val(data[0]['u11P']);
        $('#12L').val(data[0]['u12L']);$('#12P').val(data[0]['u12P']);
        $('#13L').val(data[0]['u13L']);$('#13P').val(data[0]['u13P']);
        $('#14L').val(data[0]['u14L']);$('#14P').val(data[0]['u14P']);
        $('#15L').val(data[0]['u15L']);$('#15P').val(data[0]['u15P']);
        $('#idmuridusia').val(data[0]['id']);
        $('#modalEditMuridUsia').modal({backdrop: 'static',keyboard:false});
      },
      error:function(errorThrown){
        alert("Gagal Mengambil Data");
      }
    });
}

function saveMuridusia(){
  $.ajax({
      url:getbasepath()+"transaksi/Json/saveMuridUsia",
      type:"POST",
      dataType:"JSON",
      data: $('#dataMuridUsia').serialize(),
      success:function(data){
        alert('Data Berhasil diSimpan');
        $('#modalEditMuridUsia').modal('hide');
        var table = $('#tblMuridUsia').DataTable();
        table.ajax.reload();
      },
      error:function(jqXHR, textStatus, errorThrown){
        alert(jqXHR+textStatus+errorThrown);
      }
    });
}

function generateTableUsia(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/generateSiswaJmlUsia",
    type:"POST",
    dataType: "JSON",
    data: {"id_trans": noTrans},
    success: function(data){
      alert(data.Status+"\n"+data.keterangan);
      var table = $('#tblMuridUsia').DataTable();
      table.ajax.reload();
    },
    error: function(errorThrown,error){
      alert("Errror");
    }
  });
}      
//End Transaksi Jumlah Murid Usia

//Start Transaksi Jumlah Murid Agama
function getMuridAgama(idTransaksi) {
      var table =   $('#tblMuridAgama').DataTable({
          "processing": true, //Feature control the processing indicator.
          "serverSide": true,
          paging: false,
          scrollY: '', /*'65vh'*/
          scrollCollapse: true,
          responsive: true, //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": getbasepath()+"transaksi/Json/listMuridAgama",
              "type": "POST",
              "data": function(d){
               d.noTrans= idTransaksi;
            }
          }
      });
}

function generateTableAgama(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/generateSiswaJmlAgama",
    type:"POST",
    dataType: "JSON",
    data: {"id_trans": noTrans},
    success: function(data){
      alert(data.Status+"\n"+data.keterangan);
      var table = $('#tblMuridAgama').DataTable();
      table.ajax.reload();
    },
    error: function(errorThrown,error){
      alert("Errror");
    }
  });
}   

var islam,katolik,protestan,budha,hindu,konghucu;
var idmuridusia = '0';
function enablemuridagama(id){
  if(idmuridusia == '0'){
      idmuridusia = id;
   }else{
    cancelmuridagama(idmuridusia);
   }
   idmuridusia = id;
   $('#islam'+id).prop("disabled", false);
   $('#katolik'+id).prop("disabled", false);
   $('#protestan'+id).prop("disabled", false);
   $('#budha'+id).prop("disabled", false);
   $('#hindu'+id).prop("disabled", false);
   $('#konghucu'+id).prop("disabled", false);
   document.getElementById("muridagamaubah"+id).style.display="none";
   document.getElementById("muridagamasave"+id).style.display="block";
   document.getElementById("muridagamacancel"+id).style.display="block";
   islam = $('#islam'+id).val();
   katolik = $('#katolik'+id).val();
   protestan = $('#protestan'+id).val();
   budha = $('#budha'+id).val();
   hindu = $('#hindu'+id).val();
   konghucu = $('#konghucu'+id).val();
}

function cancelmuridagama(id){
   $('#islam'+id).prop("disabled", true);
   $('#katolik'+id).prop("disabled", true);
   $('#protestan'+id).prop("disabled", true);
   $('#budha'+id).prop("disabled", true);
   $('#hindu'+id).prop("disabled", true);
   $('#konghucu'+id).prop("disabled", true);
   document.getElementById("muridagamaubah"+id).style.display="block";
   document.getElementById("muridagamasave"+id).style.display="none";
   document.getElementById("muridagamacancel"+id).style.display="none";
   $('#islam'+id).val(islam);
   $('#katolik'+id).val(katolik);
   $('#protestan'+id).val(protestan);
   $('#budha'+id).val(budha);
   $('#hindu'+id).val(hindu);
   $('#konghucu'+id).val(konghucu);
}

function simpanDatamuridagama(id){
   islam = $('#islam'+id).val();
   katolik = $('#katolik'+id).val();
   protestan = $('#protestan'+id).val();
   budha = $('#budha'+id).val();
   hindu = $('#hindu'+id).val();
   konghucu = $('#konghucu'+id).val();

   var dataac = [];
    
        var data = {
            'id' : id,
            'islam' : islam,
            'katolik' : katolik,
            'protestan' : protestan,
            'budha' : budha,
            'hindu' : hindu,
            'konghucu' : konghucu
        };
    
    dataac = data;

    return $.ajax({
        type: "POST",
        url: getbasepath() + "transaksi/Json/updateMuridAgama",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
         cancelmuridagama(id);
        });    
}
//End Transaksi Jumlah Murid Agama

function cetakDokumen() {
  id = $('#idTransaksi').val();
  var url = getbasepath()+"transaksi/main/cetak";
    var f = document.createElement("form");
  f.setAttribute('method',"post");
  f.setAttribute('action',url);

  var a = document.createElement("input"); //input element, text
  a.setAttribute('type',"hidden");
  a.setAttribute('name',"noTransaksi");
  a.setAttribute('id',"noTransaksi");
  a.setAttribute('value',id);
  f.appendChild(a);
  //f.submit();
  document.getElementsByTagName('body')[0].appendChild(f);
  f.submit();
}

//Start Transaksi Laporan
function laporkanAgama(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/laporkanAgama",
    type: "POST",
    dataType: "JSON",
    data: {'id_trans':noTrans},
    success: function(data){
      alert("Data Berhasil diLaporkan");
    },
    error:function(errorThrown){

    }
  });
}

function laporkanJmlSiswa(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/laporkanJmlSiswa",
    type: "POST",
    dataType: "JSON",
    data: {'id_trans':noTrans},
    success: function(data){
      alert("Data Berhasil diLaporkan");
    },
    error:function(errorThrown){

    }
  });
}

function laporkanPerkakas(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/laporkanPerkakas",
    type: "POST",
    dataType: "JSON",
    data: {'id_trans':noTrans},
    success: function(data){
      alert("Data Berhasil diLaporkan");
    },
    error:function(errorThrown){

    }
  });
}

function laporkanJmlSiswaUsia(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/laporkanJmlSiswaUsia",
    type: "POST",
    dataType: "JSON",
    data: {'id_trans':noTrans},
    success: function(data){
      alert("Data Berhasil diLaporkan");
    },
    error:function(errorThrown){

    }
  });
}

function laporkanKeadaanSekolah(){
  noTrans = $('#idTransaksi').val();
  $.ajax({
    url:getbasepath()+"transaksi/Json/laporkanKeadaanSekolah",
    type: "POST",
    dataType: "JSON",
    data: {'id_trans':noTrans},
    success: function(data){
      alert("Data Berhasil diLaporkan");
    },
    error:function(errorThrown){

    }
  });
}
//End Transaksi Laporan
