$(document).ready(function(){
    getMatpel();
    getSekolah();
    getKecamatan();
  });

function getMain(kode) {
	$.ajax({
		url:getbasepath()+"managemen/Analisisjwb/getMain",
		type:"POST",
		data:{'kode':kode},
		success:function(data) {
			$('#konten_graf').html(data);
			getchart(kode);
		},
		error:function(x,y,z) {
			alert('Failed Network');
		}
	});
}

function getMatpel(){
  $.ajax({
    url:getbasepath()+"managemen/Analisisjwb/getMatpel",
    type:"GET",
    dataType:"JSON",
    success:function(data){
        var option = "<option selected value=''> -- Pilih Matpel -- </option>";
        for (var i = 0; i < data.length;i++){
              var isi = data[i]['matpel'];
              var kode = data[i]['id'];
              option += "<option value='"+kode+"'> "+isi+" </option>";
        }
        $('#matapelajaran').html(option);
        
    }
  })
}

function reload() {
	var kec = $('#kecamatan').val();
	if(kec != ''){
		getSekolah();
		$('#sekolah').prop('disabled',false);
	}else{
		$('#sekolah').val('');
		$('#sekolah').prop('disabled',true);
	}
}

function getAnalisis() {
	var kode = $('#matapelajaran').val();
	if(kode != ''){
		getMain(kode);
	}else{
		alert('Silahkan Pilih Mata Pelajaran');
	}
}


function getchart(kode) {
	var kecamatan = $('#kecamatan').val();
	var sekolah = $('#sekolah').val();
	var thn_upload = $('#thn_upload').val();
	$.ajax({
		url:getbasepath()+"managemen/Analisisjwb/getAnalisis",
		type:"POST",
		dataType:"JSON",
		data:{'kode':kode,'kecamatan':kecamatan,'sekolah':sekolah,'thn_upload':thn_upload},
		success:function(data) {
			var a= 1;
			for (var i = 0; i <data.datanomor.length; i++) {
				Highcharts.chart('grafno'+a, {
					credits : {
			          enabled : false,
			        },
				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie',
				        height: ( 1 / 1 * 100) + '%' // 16:9 ratio
				    },
				    title: {
				        text: 'Nomor '+a
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
				                },
				                connectorColor: 'silver'
				            }
				        }
				    },
				    series: [{
				        name: 'Banyak',
				        data: data.datanomor[i]
				    }]
				});
				a++;
			}
		},
		error:function(x,y,z) {
			alert('Failed Network');
		}
	});
}

function getKecamatan(){
  $.ajax({
    url:getbasepath()+"managemen/Rekapjwbpd/getKecamatan",
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
    }
  })
}

function getSekolah() {
  var kecamatan = $('#kecamatan').val();
  $.ajax({
    url:getbasepath()+"managemen/Analisisjwb/getSekolah",
    type:"POST",
    data:{kec : kecamatan},
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