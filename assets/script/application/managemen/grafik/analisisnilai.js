$(document).ready(function(){
  getKecamatan();
  getGrafNilai();
});

function getGrafNilai(){
  var kec = $('#kecamatan').val();
  var sekolah = $('#sekolah').val();
  var thn_upload = $('#thn_upload').val();
  $.ajax({
    url: getbasepath()+"managemen/Analisisjwb/getGrafNilai",
    type: "POST",
    dataType:"JSON",
    data: {kec:kec,npsn : sekolah,thn_upload:thn_upload},
    success:function(data){
      console.log(data)
      $('#konten_graf').highcharts({
        credits : {
          enabled : false,
        },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Rata-rata Nilai Hasil Ujian'
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: ["Mata Pelajaran"]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Siswa'
              }
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              },
              series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.0f}'
              }
          }
          },
          series: data.data
      });
    }
  });
}

function reload() {
  var kec = $('#kecamatan').val();
  if(kec != ''){
      $('#sekolah').prop('disabled',false);
      getSekolah();
  }else{
    $('#sekolah').prop('disabled',true);
    $('#sekolah').val('');
  }
  getGrafNilai();
}

function reloadSekolah() {
  getGrafNilai();
}

function getKecamatan(){
  $.ajax({
    url:getbasepath()+"managemen/Rekapjwbpd/getKecamatan",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Semua Kecamatan -- </option>";
        for (var i = 0; i < data.kecamatan.length;i++){
              var isi = data.kecamatan[i]['kecamatan'];
              var kode = data.kecamatan[i]['kecamatan'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#kecamatan').html(option);
        $('#sekolah').prop('disabled',true);
    }
  })
}

function getSekolah() {
  var kecamatan = $('#kecamatan').val();
  $.ajax({
    url:getbasepath()+"managemen/Analisisjwb/getSekolah",
    type:"POST",
    data:{kec : kecamatan},
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Semua Sekolah -- </option>";
        for (var i = 0; i < data.sekolah.length;i++){
              var isi = data.sekolah[i]['namasekolah'];
              var kode = data.sekolah[i]['npsn'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#sekolah').html(option);
    }
  });
}