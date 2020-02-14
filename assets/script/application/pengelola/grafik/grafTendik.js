$(document).ready(function(){
    getSekolah();
    getGrafikTendikUsia();
  });


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

function cetak_grafik(){
    getGrafikTendikUsia();
}

function getGrafikTendikUsia(){
  var sekolah = $('#sekolah').val();
  var url = "";
  if(sekolah == 0 || sekolah==null){
    
    url = getbasepath()+"pengelola/grafik/getUmurTendik/";
    console.log("A");
  }else{
    console.log("b");
    url = getbasepath()+"pengelola/grafik/getUmurTendik/"+sekolah;
  }
  $.ajax({
    url: url,
    type: "GET",
    dataType:"JSON",
    success:function(data){
      $('#grafikTendikUmur').highcharts({
        credits : {
          enabled : false,
        },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Jumlah Tendik Menurut Usia '+data.sekolah
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: ["Umur"]
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Guru'
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