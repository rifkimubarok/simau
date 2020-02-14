
function showJurusan() {
	var jenjang = $('#id_pendidikan').val();
	if(jenjang == "3" || jenjang == "6" || jenjang == "7" || jenjang == "8" || jenjang == "9" || jenjang == "10"  || jenjang == "11"  || jenjang == "12"){
		$('#jurusan').prop("disabled", false);
	}else{
		$('#jurusan').prop("disabled", true);
	}
}

function simpanDataPegawai(){
	var NIP = $('#NIP').val();
	var nama_pegawai = $('#nama_pegawai').val();
	var NUPTK = $('#NUPTK').val();
	var tmp_lahir = $('#tmp_lahir').val();
	var tgl_lahir = $('#tgl_lahir').val();
	var id_kel = $('#id_kel').val();
	var id_agama = $('#id_agama').val();
	var status_perkawinan = $('#status_perkawinan').val();
	var jml_anak = $('#jml_anak').val();
	var id_pendidikan = $('#id_pendidikan').val();
	var jurusan = $('#jurusan').val();
	var tahun_lulus = $('#tahun_lulus').val();
	var id_jabatan = $('#id_jabatan').val();
	var tugas_mengajar = $('#tugas_mengajar').val();
	var tugas_tambahan = $('#tugas_tambahan').val();
	var tgl_sk = $('#tgl_sk').val();
	var no_sk_terakhir = $('#no_sk_terakhir').val();
	var ms_kerja_tahun = $('#ms_kerja_tahun').val();
	var masa_kerja_bulan = $('#masa_kerja_bulan').val();
	var tgl_mulai_kerja = $('#tgl_mulai_kerja').val();
	var id_sekolah = $('#id_sekolah').val();
	var id_gol = $('#id_gol').val();
	var gaji_pokok = $('#gaji_pokok').val();
	var status = $('#status').val();
	var NIP1 = "";
	var NUPTK1 = "";
	if(NIP == ""){
		NIP1 = "-";
	}else{
		NIP1 = NIP;
	}

	if (NUPTK == "") {
		NUPTK1 = "-";
	}else{
		NUPTK1 = NUPTK;
	}

	var dataac = [];
		var data = {
			'NIP' : NIP1,
			'nama_pegawai' : nama_pegawai,
			'NUPTK' : NUPTK1,
			'tmp_lahir' : tmp_lahir,
			'tgl_lahir' : tgl_lahir,
			'id_kel' : id_kel,
			'id_agama' : id_agama,
			'status_perkawinan' : status_perkawinan,
			'jml_anak' : jml_anak,
			'id_pendidikan' : id_pendidikan,
			'jurusan' : jurusan,
			'tahun_lulus' : tahun_lulus,
			'id_jabatan' : id_jabatan,
			'tugas_mengajar' : tugas_mengajar,
			'tugas_tambahan' : tugas_tambahan,
			'tgl_sk' : tgl_sk,
			'no_sk_terakhir' : no_sk_terakhir,
			'ms_kerja_tahun' : ms_kerja_tahun,
			'masa_kerja_bulan' : masa_kerja_bulan,
			'tgl_mulai_kerja' : tgl_mulai_kerja,
			'id_sekolah' : id_sekolah,
			'id_gol' : id_gol,
			'gaji_pokok' : gaji_pokok,
			'status' : status
		};

	dataac = data;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "pegawai/Json/addPegawai",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
    	alert('Data Pegawai Berhasil diSimpan.')
    	document.getElementById('tambahPegawai').reset();
        });
}

function updateDataPegawai(){
	var NIP = $('#NIP').val();
	var id_guru = $('#id_guru').val();
	var nama_pegawai = $('#nama_pegawai').val();
	var NUPTK = $('#NUPTK').val();
	var tmp_lahir = $('#tmp_lahir').val();
	var tgl_lahir = $('#tgl_lahir').val();
	var id_kel = $('#id_kel').val();
	var id_agama = $('#id_agama').val();
	var status_perkawinan = $('#status_perkawinan').val();
	var jml_anak = $('#jml_anak').val();
	var id_pendidikan = $('#id_pendidikan').val();
	var jurusan = $('#jurusan').val();
	var tahun_lulus = $('#tahun_lulus').val();
	var id_jabatan = $('#id_jabatan').val();
	var tugas_mengajar = $('#tugas_mengajar').val();
	var tugas_tambahan = $('#tugas_tambahan').val();
	var tgl_sk = $('#tgl_sk').val();
	var no_sk_terakhir = $('#no_sk_terakhir').val();
	var ms_kerja_tahun = $('#ms_kerja_tahun').val();
	var masa_kerja_bulan = $('#masa_kerja_bulan').val();
	var tgl_mulai_kerja = $('#tgl_mulai_kerja').val();
	var id_sekolah = $('#id_sekolah').val();
	var id_gol = $('#id_gol').val();
	var gaji_pokok = $('#gaji_pokok').val();
	var status = $('#status').val();
	var NIP1 = "";
	var NUPTK1 = "";
	var id_sekolahsebelumnya = $('#id_sekolahsebelumnya').val();
	if(NIP == ""){
		NIP1 = "-";
	}else{
		NIP1 = NIP;
	}

	if (NUPTK == "") {
		NUPTK1 = "-";
	}else{
		NUPTK1 = NUPTK;
	}

	var dataac = [];
		var data = {
			'NIP' : NIP1,
			'nama_pegawai' : nama_pegawai,
			'NUPTK' : NUPTK1,
			'tmp_lahir' : tmp_lahir,
			'tgl_lahir' : tgl_lahir,
			'id_kel' : id_kel,
			'id_agama' : id_agama,
			'status_perkawinan' : status_perkawinan,
			'jml_anak' : jml_anak,
			'id_pendidikan' : id_pendidikan,
			'jurusan' : jurusan,
			'tahun_lulus' : tahun_lulus,
			'id_jabatan' : id_jabatan,
			'tugas_mengajar' : tugas_mengajar,
			'tugas_tambahan' : tugas_tambahan,
			'tgl_sk' : tgl_sk,
			'no_sk_terakhir' : no_sk_terakhir,
			'ms_kerja_tahun' : ms_kerja_tahun,
			'masa_kerja_bulan' : masa_kerja_bulan,
			'tgl_mulai_kerja' : tgl_mulai_kerja,
			'id_sekolah' : id_sekolah,
			'id_gol' : id_gol,
			'gaji_pokok' : gaji_pokok,
			'status' : status
		};

		var dataa = {
			id_guru: id_guru,
			id_sekolah: id_sekolah,
			id_sekolahsebelumnya: id_sekolahsebelumnya,
			data: data
		}
	dataac = dataa;
    return $.ajax({
        type: "POST",
        url: getbasepath() + "pegawai/Json/updatePegawai",
        contentType: "text/plain; charset=utf-8",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        data: JSON.stringify(dataac),
        dataType: "JSON"
    }).always(function(data) {
    	alert('Data Pegawai Berhasil di Ubah');
    	var table = $('#tblAbsenGuru').DataTable();
    	table.ajax.reload();
    	$('#modalEditGuru').modal('hide');
        });
}

function editpegawai(idguru){
    $.ajax({
        url: getbasepath()+"pegawai/Json/editDataPegawai",
        type: "POST",
        data: {idGuru: idguru},
        success: function(data){
            $('#isiFormulir').html(data);
            $('#modalEditGuru').modal({backdrop: 'static',keyboard:false});
        }
    });
}

function deletepegawai(id){
	$.ajax({
		url: getbasepath()+"pegawai/Json/getDataPegawai",
        type: "POST",
        data: {idGuru: id},
        dataType: "JSON",
        success: function(data){
            $('#modalDeleteGuru').modal("show");
            $('#nipdel').val(data.NIP);
            $('#idGuruDel').val(data.id_guru);
            $('#namadel').val(data.nama_pegawai);
        }
	});
}

function deleteData(){
	var id = $('#idGuruDel').val();
	$.ajax({
		url: getbasepath()+"pegawai/Json/deleteDataPegawai",
        type: "POST",
        data: {idGuru: id},
        dataType: "JSON",
        success: function(data){
            
            if(data['0'] != "0"){
            	alert("Data Berhasil di Hapus.");

            }else{
            	alert("Data Gagal di Hapus.");
            }
            $('#modalDeleteGuru').modal("hide");
    	var table = $('#tblAbsenGuru').DataTable();
    	table.ajax.reload();
        },
        error: function(error){
        	alert("Data Gagal di Hapus.");
        }
	});
}