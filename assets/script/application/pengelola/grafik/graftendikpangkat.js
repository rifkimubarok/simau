$(document).ready(function(){
    getSekolah();
    grafikTendikPangkat();
  });


function getSekolah(){
  $.ajax({
    url:getbasepath()+"pengelola/Pesertadidik/getSekolah",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Semua Sekolah -- </option>";
        for (var i = 0; i < data.sekolah.length;i++){
              var isi = data.sekolah[i]['namasekolah'];
              var kode = data.sekolah[i]['npsn'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#sekolah').html(option);
        //grafikTendikPangkat();
    }
  })
}

function cetak_grafik(){
      grafikTendikPangkat();
}

function grafikTendikPangkat(){
  var sekolah = $('#sekolah').val();
  var url = "";
  if(sekolah == 0 || sekolah==null){
    
    url = getbasepath()+"pengelola/grafik/getGrafikGolonganTendik/";
    console.log("A");
  }else{
    console.log("b");
    url = getbasepath()+"pengelola/grafik/getGrafikGolonganTendik/"+sekolah;
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType:"JSON",
    success:function(data){
      $('#grafikTendikPangkat').highcharts({
        credits : {
          enabled : false,
        },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Jumlah Tendik Menurut Golongan '+data.sekolah
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: ['Golongan']
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