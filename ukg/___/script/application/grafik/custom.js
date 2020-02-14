function getGrafNilai(){
  var kecamatan = $('#kecamatan').val();
  $.ajax({
    url: base_url+"Grafik/getAnalisis",
    type: "POST",
    dataType:"JSON",
    data: {kecamatan:kecamatan},
    success:function(data){

      Highcharts.chart('Grafik', {
          colors: ['black','red'],
          tooltip: { enabled: true },
          chart: {
              type: 'bar',
              height: data.tinggi // 16:9 ratio
          },
        title: {
            text: 'Grafik Hasil UKG Guru Nasional'
        },
          xAxis: {
               categories: data.label,
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah Guru'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'bot',
              x: -40,
              y: 80,
              floating: false,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
          },
          plotOptions: {
              series: {
                  stacking: 'normal'
              }
          },
          series: data.data
      });

      /*Highcharts.chart('Grafik', {
          colors: ['black','red'],
            tooltip: { enabled: true },
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Grafik Hasil UKG Guru'
        },
        xAxis: {
            categories: data.label,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ' ',
            },
                labels: {
                  enabled: false
                }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'bot',
            x: -40,
            y: 80,
            floating: false,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data.data
    });*/
    },
    error:function(x,y,z) {
      var chart = $('#Grafik').highcharts();
        var seriesLength = chart.series.length;
        for(var i = seriesLength -1; i > -1; i--) {
            chart.series[i].remove();
        }
    }
  });
}

function getGrafNilaipersen(){
  var kecamatan = $('#kecamatan').val();
  $.ajax({
    url: base_url+"Grafik/getAnalisisPersen",
    type: "POST",
    dataType:"JSON",
    data: {kecamatan:kecamatan},
    success:function(data){

      Highcharts.chart('Grafik', {
          colors: ['black','red'],
          tooltip: { enabled: true },
          chart: {
              type: 'bar',
              height: data.tinggi // 16:9 ratio
          },
        title: {
            text: 'Grafik Hasil UKG Guru Nasional'
        },
          xAxis: {
               categories: data.label,
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Persentase'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'bot',
              x: -40,
              y: 80,
              floating: false,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
          },
          plotOptions: {
              series: {
                  pointPadding: 0,
                  groupPadding: 0.2,
                  stacking: "percent",
              }
          },
          series: data.data
      });
    },
    error:function(x,y,z) {
    	var chart = $('#Grafik').highcharts();
        var seriesLength = chart.series.length;
        for(var i = seriesLength -1; i > -1; i--) {
            chart.series[i].remove();
        }
    }
  });
}


function getGrafikGuruPermapel(){
  $.ajax({
    url: base_url+"grafik/getGrafikGuruPermapel",
    type: "POST",
    dataType:"JSON",
    success:function(data){
      $('#Grafik').highcharts({
        credits : {
          enabled : false,
        },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Total Guru Per Matapelajaran'
          },
          subtitle: {
              text: ''
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

function getKecamatan(){
  $.ajax({
    url:base_url+"grafik/getKecamatan",
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
    }
  })
}

function getGrafNilaipersenPermapel(){
  var kecamatan = $('#kecamatan').val();
  var jenjang = $('#jenjang').val();
  var matpel = $('#matpel').val();
  $.ajax({
    url: base_url+"Grafik/getAnalisisPersenPermodul",
    type: "POST",
    dataType:"JSON",
    data: {kecamatan:kecamatan,jenjang:jenjang,kd_matpel:matpel},
    success:function(data){

      Highcharts.chart('Grafik', {
          colors: ['black','red'],
          tooltip: { enabled: true },
          chart: {
              type: 'bar',
              height: data.tinggi // 16:9 ratio
          },
        title: {
            text: 'Grafik Hasil UKG Guru Nasional'
        },
          xAxis: {
              title: {
                  text: 'Modul'
              },
               categories: data.label,
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Persentase'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'bot',
              x: -40,
              y: 80,
              floating: false,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
          },
          plotOptions: {
              series: {
                  pointPadding: 0,
                  groupPadding: 0.2,
                  stacking: "percent",
              }
          },
          series: data.data
      });
    },
    error:function(x,y,z) {
      var chart = $('#Grafik').highcharts();
        var seriesLength = chart.series.length;
        for(var i = seriesLength -1; i > -1; i--) {
            chart.series[i].remove();
        }
    }
  });
}