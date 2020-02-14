$(document).ready(function(){
    // peta_awal();
    getLeaflet();
  });

function getbasepath(){
return "<?php echo base_url(); ?>";
}

var peta;
var x = new Array();
var y = new Array();

function peta_awal(){
	// posisi default peta saat diload
	var lokasibaru = new google.maps.LatLng(-7.803249,110.3398251);
	var petaoption = {
		zoom: 10,
		center: lokasibaru,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	peta = new google.maps.Map(document.getElementById("map_canvas"),petaoption);
	// memanggil function ambilpeta() untuk menampilkan koordinat
	ambilpeta();
}

function getKec2(){
  var hasil = $('#kecamatan').val();
  return hasil;
}

function reload(){
	document.getElementById('aa').innerHTML = "<div id='map' style='width: 100%; height: 450px;'></div>";
	getLeaflet();
}

function getJenjang2(){
  var hasil = $('#jenjang').val();
  return hasil;
}

function ambilpeta(){
    url = getbasepath() + "awal/Maps/getMaps";
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
        	// var infowindow = new google.maps.InfoWindow();
			var markers = [];
            for(i=0;i<msg.sekolah.cabang.length;i++){
				x[i] = msg.sekolah.cabang[i].x;
				y[i] = msg.sekolah.cabang[i].y;
                var point = new google.maps.LatLng(msg.sekolah.cabang[i].x,msg.sekolah.cabang[i].y);
                  tanda = new google.maps.Marker({
							position: point,
							map: peta,
							icon: getbasepath()+'assets/images/'+msg.sekolah.cabang[i].icon,
							clickable: true
				});
                  var contentString = "<h4>"+msg.sekolah.cabang[i].namasekolah+"</h4><br><p><small>"+msg.sekolah.cabang[i].alamat+" Des./Kel. "+msg.sekolah.cabang[i].kelurahan+"<br>RT/RW "+msg.sekolah.cabang[i].rt+"/"+msg.sekolah.cabang[i].rw+" "+msg.sekolah.cabang[i].kecamatan+" "+'Gunung Kidul'+" </small></p>";
		            var infowindow = new google.maps.InfoWindow({
			          content: contentString,
			          position: point
			        });
				    //infoWindow.setPosition(point);
			        tanda.addListener('click', function() {
			          infowindow.open(peta, tanda);
			        });
				markers.push(tanda);
				// google.maps.event.addListener(markers, 'click', function() {
	   //            infowindow.setContent('<div><p>aaa</p></div>');
	   //            infowindow.open(peta, tanda);
	   //          });
			}
			var markerCluster = new MarkerClusterer(peta, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
    });
}


function getLeaflet() {

	var map = new L.Map('map'); 
	var kec = '';
	var jenjang = '';
	if(getKec2() != null){
		kec = getKec2();
	}
	if(getJenjang2() != null){
		jenjang = getJenjang2();
	}
	$.ajax({
		url:getbasepath()+"awal/Maps/getMaps?kec="+kec+"&jenjang="+jenjang,
		dataType:"json",
		success:function(data) {
                     
                 	//Legenda
					L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		            attribution: '<a target="_blank" href = "http://leafletjs.com/" > Leaflet </a> | &copy; <a target="_blank" href="'+getbasepath()+'">GUNUNG KIDUL - SISTEM ANALISIS US/USBN</a>',
		            maxZoom: 18
	         	}).addTo(map);
		         var legend = L.control({position: 'bottomright'});
					legend.onAdd = function (map) {
						var div = L.DomUtil.create('div', 'info legend'),
							labels = [	'<i><img src="'+getbasepath()+'assets/images/university2.png" width="24" height="24"></i> Nilai Sekolah Diatas KCM <br>',
									 	'<i><img src="'+getbasepath()+'assets/images/university3.png" width="24" height="24"></i>  Nilai Sekolah Rata-rata KCM <br>',
									 	'<i><img src="'+getbasepath()+'assets/images/university4.png" width="24" height="24"></i> Nilai Sekolah Dibawah KCM'];
						div.innerHTML = labels.join('<br>');
						return div;
					};
					legend.addTo(map);
			         map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

			         var gundul = new L.LatLng(-8.001500,110.649400); 
			         map.setView(gundul, 10);
			         
					var length = data.data.length;
					for(var i = 0; i<length;i++){

			         var markerLocation = new L.LatLng(data.data[i].lat,data.data[i].long);
			         var LeafIcon = L.Icon.extend({
				        options: {
				            iconAnchor:   [15, 35],
				            popupAnchor:  [-1, -2]
				        }
				    });
			         var redIcon = new LeafIcon({iconUrl:data.data[i].icon});
			         var greenIcon = L.icon({
							    iconUrl: data.data[i].icon// point from which the popup should open relative to the iconAnchor
							});
			        
			         
			         var marker = L.marker(markerLocation, {icon: redIcon}).addTo(map);
			         marker.bindPopup(data.data[i].infowindow_content);

				}
		}
	});

	$.getJSON(getbasepath()+"assets/script/application/awal/maps/040300.geojson",function(result){
		L.geoJson(result, {
			onEachFeature: function (feature, peta) {
				var style = {
					fillColor: "#5f6063",
					color: "#273746",
					weight: 1,
					opacity: 0.8,
					fillOpacity: 0.3
				};
				peta.setStyle(style);
			}
		}).addTo(map);
	});
}