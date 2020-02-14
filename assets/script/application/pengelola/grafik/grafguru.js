// $(document).ready(function(){
//     getSekolah();
//   });


// function getSekolah(){
//   $.ajax({
//     url:getbasepath()+"pengelola/Pesertadidik/getSekolah",
//     type:"GET",
//     dataType:"JSON",
//     success:function(data){
//         console.log(data);
//         var option = "<option selected value=''> -- Pilih Sekolah -- </option>";
//         for (var i = 0; i < data.sekolah.length;i++){
//               var isi = data.sekolah[i]['namasekolah'];
//               var kode = data.sekolah[i]['npsn'];
//               option += "<option value='"+kode+"'> "+isi+" </option>";
//         }
//         $('#sekolah').html(option);
//     }
//   })
// }

// function cetak_grafik(){
//     var sekolah = $('#sekolah').val();
//     if(sekolah == 0){
//         alert('Pilih Sekolah Terlebih Dahulu.');
//     }else{
//       getGrafikGuruUsia();
//     }
// }

// function getGrafikGuruUsia(){
//   var sekolah = $('#sekolah').val();
//   $.ajax({
//     url: getbasepath()+"pengelola/grafik/getUmurGuru/"+sekolah,
//     type: "POST",
//     dataType:"JSON",
//     success:function(data){
//       $('#grafikGuruUmur').highcharts({
//           credits: {
//             enabled: false
//           },
//           chart: {
//               type: 'column'
//           },
//           title: {
//               text: 'Grafik Jumlah Guru Menurut Usia - '+data.sekolah
//           },
//           subtitle: {
//               text: ''
//           },
//           xAxis: {
//               categories: ["Umur"]
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
//     }
//   });
// }

// function getGrafikTendikUsia(){
//   var sekolah = $('#sekolah').val();
// 	$.ajax({
// 		url: getbasepath()+"pengelola/grafik/getUmurTendik/"+sekolah,
// 		type: "POST",
// 		dataType:"JSON",
// 		success:function(data){
// 			$('#grafikGuruUmur').highcharts({
//           chart: {
//               type: 'column'
//           },
//           title: {
//               text: 'Grafik Jumlah Guru Menurut Usia - '+data.sekolah
//           },
//           subtitle: {
//               text: ''
//           },
//           xAxis: {
//               categories: ["Umur"]
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
// 		}
// 	});
// }

$(document).ready(function(){
    getSekolah();
    getGrafikGuruUsia();
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
        //getGrafikGuruUsia();
    }
  })
}

function cetak_grafik(){
      getGrafikGuruUsia();
}

function getGrafikGuruUsia(){
  var sekolah = $('#sekolah').val();
  var url = "";
  if(sekolah == 0 || sekolah==null){
    
    url = getbasepath()+"pengelola/grafik/getUmurGuru/";
    console.log("A");
  }else{
    console.log("b");
    url = getbasepath()+"pengelola/grafik/getUmurGuru/"+sekolah;
  }
  $.ajax({
    url: url,
    type: "POST",
    dataType:"JSON",
    success:function(data){
      $('#grafikGuruUmur').highcharts({
        credits : {
          enabled : false,
        },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Jumlah Guru Menurut Usia '+data.sekolah
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: data.label,
              title: {
                  text: data.xaxis
              }
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