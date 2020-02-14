$(document).ready(function () {
  getGrafikBanyakSiswaPerkelas_Pengelola();
  // getGrafikBanyakSiswaPerkelas_Sekolah();
  // getGrafikGuruPerjenjang();
});


function getGrafikBanyakSiswaPerkelas_Pengelola() {
  $.ajax({
    url: getbasepath() + "dashboard/index/getGrafikMuridPerkelas",
    type: "POST",
    dataType: "JSON",
    success: function (data) {
      console.log(data.data)
      $('#grafik_banyaksiswa_pengelola').highcharts({
        credits: {
          enabled: false,
        },
        chart: {
          type: 'column'
        },
        title: {
          text: 'Total Siswa Per Kelas'
        },
        subtitle: {
          text: ''
        },
        xAxis: {
          categories: ["Laki-laki", "Perempuan"]
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

function getGrafikBanyakSiswaPerkelas_Sekolah() {
  $.ajax({
    url: getbasepath() + "dashboard/index/getGrafikMuridPerkelas",
    type: "POST",
    dataType: "JSON",
    success: function (data) {
      console.log(data.data)
      $('#grafik_banyaksiswa_sekolah').highcharts({
        credits: {
          enabled: false,
        },
        chart: {
          type: 'column'
        },
        title: {
          text: 'Total Siswa Per Kelas'
        },
        subtitle: {
          text: ''
        },
        xAxis: {
          categories: ["Laki-laki", "Perempuan"]
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

// function getGrafikPengunjungM(bulan,tahun) {
//  $.ajax({
//    url: getbasepath()+"Home/getjsonGrafikPengunjungM/"+bulan+"/"+tahun,
//    method: "GET",
//    dataType: "JSON",
//    success:function(data) {
//      var d= data.data.data;
//      var dataPengunjung = d.map(function(item) {
//              return parseInt(item, 10);
//          });
//      Highcharts.chart('grafikPerMinggu', {
//        chart: {
//            type: 'line'
//        },
//        title: {
//            text: 'Grafik Pengunjung Puskesmas per Minggu'
//        },
//        xAxis: data.kategori,
//        yAxis: {
//            title: {
//                text: 'Orang'
//            }
//        },
//        plotOptions: {
//            line: {
//                dataLabels: {
//                    enabled: true
//                },
//                enableMouseTracking: false
//            }
//        },
//        series: [{"name":data.data.name,"data":dataPengunjung}]
//    });
//    }
//  });
// }

// function getPiePengunjungM(bulan,tahun) {
//  $.ajax({
//    url: getbasepath()+"Home/getjsonPiePengunjungM/"+bulan+"/"+tahun,
//    method: "GET",
//    dataType: "JSON",
//    success: function(data) {
//      Highcharts.chart('pieJenisPerMinggu', {
//            chart: {
//                plotBackgroundColor: null,
//                plotBorderWidth: null,
//                plotShadow: false,
//                type: 'pie'
//            },
//            title: {
//                text: 'Persentasi Jenis Pengunjung Puskesmas Bulan Ini.'
//            },
//            tooltip: {
//                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//            },
//            plotOptions: {
//                pie: {
//                    allowPointSelect: true,
//                    cursor: 'pointer',
//                    dataLabels: {
//                        enabled: false
//                    },
//                    showInLegend: true
//                }
//            },
//            series: [{
//                name: 'Pengunjung',
//                colorByPoint: true,
//                data: data.data
//            }]
//        }); 
//    }
//  });
// }

// function getGrafikGuruPerjenjang(){
//  $.ajax({
//    url: getbasepath()+"Dashboard/getGrafikGuruPerjenjang",
//    type: "POST",
//    dataType:"JSON",
//    success:function(data){
//      console.log(data.data)
//      $('#grafik_guruperjenjang').highcharts({
//           chart: {
//               type: 'column'
//           },
//           title: {
//               text: 'Total Guru Per Jenjang'
//           },
//           subtitle: {
//               text: ''
//           },
//           xAxis: {
//               categories: ["Jenjang"]
//           },
//           yAxis: {
//               min: 0,
//               title: {
//                   text: 'Total Guru'
//               }
//           },
//           plotOptions: {
//               column: {
//                   pointPadding: 0.2,
//                   borderWidth: 0
//               },
//               series: {
//               borderWidth: 0,
//               dataLabels: {
//                   enabled: true,
//                   format: '{point.y:.0f}'
//               }
//           }
//           },
//           series: data.data
//       });
//    }
//  });
// }