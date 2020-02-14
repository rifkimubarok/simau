$(document).ready(function(){
    getSekolah();
    grafikSekolah();
    grafikPieSekolah();
    setInformation();
  });


function getSekolah(){
  $.ajax({
    url:getbasepath()+"awal/Grafik_sekolah/getSekolah",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        console.log(data);
        var option = "<option selected value=''> -- Semua Kecamatan -- </option>";
        for (var i = 0; i < data.kecamatan.length;i++){
              var isi = data.kecamatan[i]['kecamatan'];
              var kode = data.kecamatan[i]['code'];
              option += "<option value='"+isi+"'> "+isi+" </option>";
        }
        $('#kecamatan').html(option);

        var option = "<option selected value=''> -- Semua Jenjang -- </option>";
        for (var i = 0; i < data.jenjang.length;i++){
              var isi = data.jenjang[i]['jenjang'];
              var kode = data.jenjang[i]['npsn'];
              option += "<option value='"+isi+"'> "+isi+" </option>";
        }
        $('#jenjang').html(option);
    }
  })
}


function tampil_grafik(){
      grafikSekolah();
      grafikPieSekolah();
      setInformation();
}

function setInformation() {
  var kecamatan = $('#kecamatan').val();
  $.ajax({
    url:getbasepath()+"awal/grafik_sekolah/getInformasi",
    type:"POST",
    dataType:"JSON",
    data:{"kecamatan":kecamatan},
    success:function(data) {
      $('#totpeg').text(data.totpeg);
      $('#totmula').text(data.totmula);
      $('#totmupe').text(data.totmupe);
      $('#totmu').text(data.totmu);
    }
  });
}

function grafikSekolah(){
  var kecamatan = $('#kecamatan').val();
  var url = "";
  if(kecamatan == 0 || kecamatan==null){
    
    url = getbasepath()+"awal/grafik_sekolah/getGrafikSekolah/";
    console.log("A");
  }else{
    console.log("b");
    url = getbasepath()+"awal/grafik_sekolah/getGrafikSekolah/"+kecamatan;
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType:"JSON",
    success:function(data){
      $('#container').highcharts({
        credits : {
          enabled : false,
        },
        colors: ['#D62F2F', '#402FD6'],
          chart: {
                backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                ],
              },

              type: 'column',
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,

              style: {
                fontFamily: 'inherit'
            },
          },
          title: {
              text: 'Grafik Sekolah Binaan '+data.kecamatan
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: ['Jenjang']
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Sekolah'
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

function grafikPieSekolah(){
  var kecamatan = $('#kecamatan').val();
  var url = "";
  if(kecamatan == 0 || kecamatan==null){
    
    url = getbasepath()+"awal/grafik_sekolah/getPieGrafikSekolah/";
    console.log("A");
  }else{
    console.log("b");
    url = getbasepath()+"awal/grafik_sekolah/getPieGrafikSekolah/"+kecamatan;
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType:"JSON",
    success: function(data) {
      Highcharts.chart('pie_chart', {
        credits : {
          enabled : false,
        },

        colors: ['#D62F2F', '#402FD6'],
          chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                ],
              },

              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie',

              style: {
                fontFamily: 'inherit'
            },
          },
          title: {
              text: 'Presentase Sekolah Binaan '+data.kecamatan
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
            plotOptions: {
                pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
            },
            series: [{
                name: 'Presentase',
                sliced: true,
                selected: true,
                colorByPoint: true,
                data: data.data

            }]
        }); 
    }
  });
}