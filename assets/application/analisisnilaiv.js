$(document).ready(function() {
  getKecamatan();
});

function getGrafNilai() {
  var jenjang = $("#jenjang").val();
  var matpel = $("#matapelajaran").val();
  var thn_upload = $("#thn_upload").val();
  var kecamatan = $("#kecamatan").val();
  var kelas = $("#kelas").val();
  $.ajax({
    url: getbasepath() + "dashboard/Analisisjwb/generateGraf",
    type: "POST",
    dataType: "JSON",
    data: {
      jenjang: jenjang,
      thn_upload: thn_upload,
      matpel: matpel,
      kecamatan: kecamatan,
      kelas: kelas
    },
    success: function(data) {
      Highcharts.chart("konten_graf", {
        chart: {
          type: "bar",
          height: data.tinggi // 16:9 ratio
        },
        title: {
          text: "Rata-rata Nilai Hasil ujian"
        },
        xAxis: {
          categories: data.nama_sekolah
        },
        yAxis: {
          min: 0,
          title: {
            text: "Range Nilai"
          }
        },
        legend: {
          reversed: true
        },
        plotOptions: {
          series: {
            stacking: "normal"
          }
        },
        series: data.data
      });
    },
    error: function(x, y, z) {
      var chart = $("#konten_graf").highcharts();
      if (chart != undefined) {
        var seriesLength = chart.series.length;
        for (var i = seriesLength - 1; i > -1; i--) {
          chart.series[i].remove();
        }
        chart.setSize(null, 200);
      }
    }
  });
}

function reload() {
  getMatpel();
  $("#kecamatan").val("");
  change_kelas();
}

function reloadSekolah() {
  getGrafNilai();
}

function getMatpel() {
  var jenjang = $("#jenjang").val();
  $.ajax({
    url: getbasepath() + "dashboard/referensi/getMatpel",
    type: "POST",
    dataType: "JSON",
    data: { jenjang: jenjang },
    beforeSend: function() {
      change_kelas();
    },
    success: function(data) {
      var option = "<option value=''> -- Semua Matpel --</option>";
      for (var i = 0; i < data.length; i++) {
        var isi = data[i]["matpel"];
        var kode = data[i]["id"];
        option += "<option value='" + kode + "'> " + isi + " </option>";
      }
      $("#matapelajaran").html(option);

      getGrafNilai();
    }
  });
}

function getKecamatan() {
  $.ajax({
    url: getbasepath() + "dashboard/referensi/getKec",
    type: "GET",
    dataType: "JSON",
    success: function(data) {
      var option = "<option selected value=''> -- Semua Kecamatan -- </option>";
      for (var i = 0; i < data.kec.length; i++) {
        var isi = data.kec[i]["kecamatan"];
        var kode = data.kec[i]["kecamatan"];
        option += "<option value='" + kode + "'> " + isi + " </option>";
      }
      $("#kecamatan").html(option);
      getMatpel();
    }
  });
}

function change_kelas() {
  var jenjang = $("#jenjang");
  var option = "";
  if (jenjang.val() == "SMP") {
    for (var i = 7; i < 10; i++) {
      option += "<option value='" + i + "'>Kelas " + i + "</option>";
    }
  } else {
    for (var i = 1; i < 7; i++) {
      option += "<option value='" + i + "'>Kelas " + i + "</option>";
    }
  }
  $("#kelas").html(option);
}
