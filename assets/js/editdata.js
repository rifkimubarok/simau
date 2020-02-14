//fungsi untuk mengubah text dari table untuk menjadi field isian
function inline_edit(id, url){

    //ambil text dari masing2 kolom
    var pilihan       = $('#pilihan1'+id+' p').text();
    var status        = $('#status'+id+' p').text();

    var selectedT = (status == 'T') ? 'selected' : '';
    var selectedB = (status == 'B') ? 'selected' : '';
    var selectedV = (status == 'V') ? 'selected' : '';

    var selectedAK = (pilihan == 'Akuntansi dan Keuangan Lembaga') ? 'selected' : '';
    var selectedBP = (pilihan == 'Bisnis Daring dan Pemasaran') ? 'selected' : '';
    var selectedOP = (pilihan == 'Otomatisasi dan Tata Kelola Perkantoran') ? 'selected' : '';
	var selectedTB = (pilihan == 'Tata Boga') ? 'selected' : '';
    var selectedHT = (pilihan == 'Perhotelan') ? 'selected' : '';
    var selectedMM = (pilihan == 'Multimedia') ? 'selected' : '';
    var selectedPL = (pilihan == 'Rekayasa Perangkat Lunak') ? 'selected' : '';
		
    //proses mengubah menjadi field isian
    $('#status'+id+' p').replaceWith('<select data-url="'+url+'" name="status" onfocusout="update(this)" data-id="'+id+'" class="form-control input-sm"><option value="T" '+selectedT+'>Terdaftar</option><option value="B" '+selectedB+'>Belum Terdaftar</option><option value="V" '+selectedV+'>Verifikasi</option></select>');
    $('#pilihan1'+id+' p').replaceWith('<select data-url="'+url+'" name="pilihan1" onfocusout="update(this)" data-id="'+id+'" class="form-control input-sm"><option value="AK" '+selectedAK+'>Akuntansi dan Keuangan Lembaga</option><option value="BP" '+selectedBP+'>Bisnis Daring dan Pemasaran</option><option value="OP" '+selectedOP+'>Otomatisasi dan Tata Kelola Perkantoran</option><option value="TB" '+selectedTB+'>Tata Boga</option><option value="HT" '+selectedHT+'>Perhotelan</option><option value="MM" '+selectedMM+'>Multimedia</option><option value="PL" '+selectedPL+'>Rekayasa Perangkat Lunak</option></select>');

    $('#inline_edit'+id).replaceWith('<a id="cancel_edit'+id+'" onclick="cancel_edit(\''+id+'\', \''+url+'\')" href="#">Cancel </a>');

}

//fungsi untuk membalikan seperti semula
function cancel_edit(id, url){

    var pilihan1 = ($('select[name=pilihan1]').val() == 'AK' ) ? 'Akuntansi dan Keuangan Lembaga' : ($('select[name=pilihan1]').val() == 'BP' ) ? 'Bisnis Daring dan Pemasaran' :($('select[name=pilihan1]').val() == 'OP' ) ? 'Otomatisasi dan Tata Kelola Perkantoran' :($('select[name=pilihan1]').val() == 'TB' ) ? 'Tata Boga' :($('select[name=pilihan1]').val() == 'HT' ) ? 'Perhotelan' :($('select[name=pilihan1]').val() == 'MM' ) ? 'Multimedia' :'Rekayasa Perangkat Lunak';
	var status = ($('select[name=status]').val() == 'T' ) ? 'Terdaftar' : ($('select[name=status]').val() == 'B' ) ? 'Belum Verifikasi' : 'Verifikasi';

    $('#pilihan1'+id+' select').replaceWith('<p>'+pilihan1+'</p>');
	$('#status'+id+' select').replaceWith('<p>'+status+'</p>');

    $('#cancel_edit'+id).replaceWith('<a id="inline_edit'+id+'" onclick="inline_edit(\''+id+'\', \''+url+'\')" href="#">Inline Edit </a>');

}

// fungsi untuk mengupdate data yang telah di edit pada tabel
function update(get){
    // value nya kosng?
    if ( ! get.value) {
        // tampilkan pemberitahuan
        alert('Tidak boleh ada data yang Kosong!');
        // jangan biarkan user klik ke area lain
        $(get).focus();
        
    } else {
        // lakukan proses edit dengan ajax

        var url = $(get).attr('data-url');
        var data = {
            // id mahasiswa
            'id'    : $(get).attr('data-id'),
            // field yang akan di update
            'field' : $(get).attr('name'),
            // isi dari field tersebut
            'value' : $(get).val(),
        };

        $.ajax({
            type        : 'POST', 
            url         :  url,
            data        :  data
        });

        // ini buat ngecek inputannya berjenis apa
        if($(get).is('select')){

            var text1 = (data['value'] == 'T') ? 'Terdaftar' : (data['value'] == 'B') ? 'Belum Verifikasi' : 'Verifikasi';
			var text2 = (data['value'] == 'AK') ? 'Akuntansi dan Keuangan Lembaga' : (data['value'] == 'BP') ? 'Bisnis Daring dan Pemasaran' : (data['value'] == 'OP') ? 'Otomatisasi dan Tata Kelola Perkantoran' : (data['value'] == 'TB') ? 'Tata Boga' : (data['value'] == 'HT') ? 'Perhotelan' : (data['value'] == 'MM') ? 'Multimedia' :'Rekayasa Perangkat Lunak';
            $(get).replaceWith(text1);
			$(get).replaceWith(text2);
        }else{
			$(get).replaceWith(data['value']);
        }
    }
}