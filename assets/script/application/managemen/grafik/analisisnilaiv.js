$(document).ready(function(){
  getMatpel();
});

function getGrafNilai(){
  var jenjang = $('#jenjang').val();
  var matpel = $('#matapelajaran').val();
  var thn_upload = $('#thn_upload').val();
  $.ajax({
    url: getbasepath()+"managemen/Analisisjwb/generateGraf",
    type: "POST",
    dataType:"JSON",
    data: {matpel:matpel,thn_upload:thn_upload},
    success:function(data){
      Highcharts.chart('konten_graf', {
          chart: {
              type: 'bar',
              height: data.tinggi // 16:9 ratio
          },
          title: {
              text: 'Rata-rata Nilai Hasil ujian'
          },
          xAxis: {
              categories: data.nama_sekolah
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Range Nilai'
              }
          },
          legend: {
              reversed: true
          },
          plotOptions: {
              series: {
                  stacking: 'normal'
              }
          },
          series: data.data
      });
    }
  });
}

function reload() {
  getMatpel();
}

function reloadSekolah() {
  getGrafNilai();
}

function getMatpel() {
  var jenjang = $('#jenjang').val();
  $.ajax({
    url:getbasepath()+"managemen/Analisisjwb/getMatpel",
    type:"POST",
    dataType:"JSON",
    data:{jenjang:jenjang},
    success:function(data){
        var option = "<option value=''> -- Semua Matpel --</option>";
        for (var i = 0; i < data.length;i++){
              var isi = data[i]['matpel'];
              var kode = data[i]['id'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#matapelajaran').html(option);

        getGrafNilai();
    }
  });
}