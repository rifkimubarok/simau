$(document).ready(function() {
  getKecamatan();
});

function getGrafNilai() {
  var kec = $("#kecamatan").val();
  var sekolah = $("#sekolah").val();
  var thn_upload = $("#thn_upload").val();
  var jenjang = $("#jenjang").val();
  var kelas = $("#kelas").val();
  $.ajax({
    url: getbasepath() + "dashboard/analisisjwb/getGrafNilai",
    type: "POST",
    dataType: "JSON",
    data: {
      kec: kec,
      thn_upload: thn_upload,
      npsn: sekolah,
      jenjang: jenjang,
      kelas: kelas
    },
    success: function(data) {
      console.log(data);
      $("#konten_graf").highcharts({
        credits: {
          enabled: false
        },
        chart: {
          type: "column"
        },
        title: {
          text: "Rata-rata Nilai Hasil Ujian"
        },
        subtitle: {
          text: ""
        },
        xAxis: {
          categories: ["Mata Pelajaran"]
        },
        yAxis: {
          min: 0,
          title: {
            text: "Rata - rata Nilai"
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
              format: "{point.y:.0f}"
            }
          }
        },
        series: data.data
      });
    }
  });
}

function reload() {
  var kec = $("#kecamatan").val();
  if (kec != "") {
    $("#sekolah").prop("disabled", false);
    getSekolah();
  } else {
    $("#sekolah").prop("disabled", true);
    $("#sekolah").val("");
  }
  change_kelas();
}

function reloadSekolah() {
  getGrafNilai();
}

function getKecamatan() {
  $.ajax({
    url: getbasepath() + "dashboard/referensi/getKec",
    type: "GET",
    dataType: "JSON",
    beforeSend: function() {
      change_kelas();
    },
    success: function(data) {
      var option = "<option selected value=''> -- Semua Kecamatan -- </option>";
      for (var i = 0; i < data.kec.length; i++) {
        var isi = data.kec[i]["kecamatan"];
        var kode = data.kec[i]["kecamatan"];
        option += "<option value='" + kode + "'> " + isi + " </option>";
      }
      $("#kecamatan").html(option);
      if (login() != 9) {
        $("#sekolah").prop("disabled", true);
      } else {
        getSekolah();
      }
    }
  });
}

function getSekolah() {
  var kecamatan = $("#kecamatan").val();
  var jenjang = $("#jenjang").val();
  $.ajax({
    url: getbasepath() + "dashboard/referensi/getSekolah",
    type: "get",
    data: { kec: kecamatan, jenjang: jenjang },
    dataType: "JSON",
    success: function(data) {
      var option = "<option selected value=''> -- Semua Sekolah -- </option>";
      for (var i = 0; i < data.sekolah.length; i++) {
        var isi = data.sekolah[i]["namasekolah"];
        var kode = data.sekolah[i]["npsn"];
        option += "<option value='" + kode + "'> " + isi + " </option>";
      }
      $("#sekolah").html(option);
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
  getGrafNilai();
}
