$(document).ready(function() {
	getKelas();
  getMatpel();
});

function getKelas() {
	var jenjang = $('#jenjang').val();
	var sekolah = $('#sekolah').val();
	var a = 0;
	var b = 0;
	if(jenjang == "SD"){
		a = 1;
		b = 6;
	}else{
		a = 7;
		b = 9;
	}
	var c = '';
	if(sekolah != '' || sekolah != null){
		c = 'Semua ';
	}
	var option = "<option value='' > -- "+c+"Kelas -- </option>";
	for (var i = a; i <=b; i++) {
		if(i == b){
			option += "<option value='"+i+"' selected> Kelas "+i+"</option>";
		}else{
			option += "<option value='"+i+"'> Kelas "+i+"</option>";
		}
	}
	$('#kelas').html(option);
}

function reloadjenjang() {
	var jenjang = $('#jenjang').val();
	if(jenjang == "SD"){
		$('#matapelajaran').prop('disabled',true);
	}else{
		$('#matapelajaran').prop('disabled',false);
	}
	$('#kecamatan').val('');
	$('#sekolah').val('');
	getKelas();
	getMatpel();
	reloadsekolah();
}

function reload() {
	getGrafNilai();
}

function reloadsekolah() {

	var kec = $('#kecamatan').val();
	  if(kec != ''){
	      $('#sekolah').prop('disabled',false);
	      getSekolah();
	  }else{
	    $('#sekolah').prop('disabled',true);
	    $('#sekolah').val('');
	    getKelas();
	  }

	getGrafNilai();
}

function reloadkelas() {
	getGrafNilai();
}


function getMatpel() {
  var jenjang = $('#jenjang').val();
  $.ajax({
    url:getbasepath()+"pengelola/Analisisjwb/getMatpel",
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

function getKecamatan(){
  $.ajax({
    url:getbasepath()+"pengelola/Rekapjwbpd/getKecamatan",
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
        getMatpel();
    }
  })
}

function getSekolah() {
  var kecamatan = $('#kecamatan').val();
  var jenjang = $('#jenjang').val();
  $.ajax({
    url:getbasepath()+"pengelola/Analisisjwb/getSekolah",
    type:"POST",
    data:{kec : kecamatan,jenjang:jenjang},
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

function getGrafNilai(){
  var jenjang = $('#jenjang').val();
  var matpel = $('#matapelajaran').val();
  var thn_upload = $('#thn_upload').val();
  var kecamatan = $('#kecamatan').val();
  var sekolah = $('#sekolah').val();
  var kelas = $('#kelas').val();
  $.ajax({
    url: getbasepath()+"pengelola/Banding_ukg/getAnalisis",
    type: "POST",
    dataType:"JSON",
    data: {jenjang:jenjang,tahun:thn_upload,matpel:matpel,kecamatan:kecamatan,sekolah:sekolah,kelas:kelas},
    success:function(data){
      /*Highcharts.chart('konten_graf', {
      	colors: ['#f44242','#f4d641'],
      	  credits: { enabled: false },
       	  tooltip: { enabled: false },
          chart: {
              type: 'bar',
              height: data.tinggi // 16:9 ratio
          },
          title: {
              text: 'Grafik Hasil Ujian Siswa Terhadap UKG Guru'
          },
          xAxis: {
              categories: data.label
          },
          yAxis: {
              min: 0,
              title: {
                  text: ' '
              },
          },
          plotOptions: {
              series: {
                  stacking: 'normal'
              }
          },
          series: data.data
      });*/

      Highcharts.chart('konten_graf', {
      		colors: ['#000000','#008aff'],
       	  	tooltip: { enabled: false },
		    chart: {
		        type: 'bar'
		    },
		    title: {
		        text: 'Grafik Hasil Ujian Siswa Terhadap UKG Guru'
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
		});
    },
    error:function(x,y,z) {
    	var chart = $('#konten_graf').highcharts();
        var seriesLength = chart.series.length;
        for(var i = seriesLength -1; i > -1; i--) {
            chart.series[i].remove();
        }
    }
  });
}