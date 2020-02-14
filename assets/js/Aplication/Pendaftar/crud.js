$(document).ready(function(){
    getReferensi();
});

function statusDaftar(){
    var id = $('#NISN1').val();
    $.ajax({
        url : getbasepath() +"pendaftar/edit_data/statusDaftar/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0; i < data.status.length; i++) {
                if(data.status[i]['status'] == '02' || data.status[i]['status']=='03'){
                    document.getElementById('statusDaftar').style.display='block';
                }
                console.log('Status : '+data.status[i]['status']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error pengambilan data !');
        }
    });
}

function getReferensi(){
    $.ajax({
        url : getbasepath() +"pendaftar/edit_data/getReferensi/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var cAgama,cKeahlian,cPekerjaan,cSekolah,cPrestasi;
            var kAgama,kKeahlian,kPekerjaan,kSekolah,kPrestasi;
            var optAgama,optKeahlian1,optKeahlian2,optPekerjaan,optSekolah,optPrestasi;
            var juara;
            optAgama = '<option value="-" selected>-- Agama --</option>';
            optKeahlian1 = '<option value="-" selected>-- Pilihan 1 --</option>';
            optKeahlian2 = '<option value="-" selected>-- Pilihan 2 --</option>';
            optPekerjaan = '<option value="-" selected>-- Pilih Pekerjaan --</option>';
            optSekolah = '<option value="-" selected>-- Asal Sekolah --</option>';
            optPrestasi = '<option value="-" selected>-- Kejuaraan Tingkat --</option>';
             // Set title to Bootstrap modal title
             for(var i = 0; i < data.ref_agama.length; i++){
                cAgama = data.ref_agama[i]['code'];
                kAgama =  data.ref_agama[i]['agama'];
                optAgama += '<option value="'+cAgama+'">'+kAgama+'</option>';
             }

             for(var i = 0; i < data.ref_sekolah.length; i++){
                cSekolah = data.ref_sekolah[i]['code'];
                kSekolah =  data.ref_sekolah[i]['namasekolah'];
                optSekolah += '<option value="'+cSekolah+'">'+kSekolah+'</option>';
             }

             for(var i = 0; i < data.ref_pekerjaan.length; i++){
                cPekerjaan = data.ref_pekerjaan[i]['code'];
                kPekerjaan =  data.ref_pekerjaan[i]['pekerjaan'];
                optPekerjaan += '<option value="'+cPekerjaan+'">'+kPekerjaan+'</option>';
             }

             for(var i = 0; i < data.ref_keahlian.length; i++){
                cKeahlian = data.ref_keahlian[i]['code'];
                kKeahlian =  data.ref_keahlian[i]['description'];
                optKeahlian1 += '<option value="'+cKeahlian+'">'+kKeahlian+'</option>';
                optKeahlian2 += '<option value="'+cKeahlian+'">'+kKeahlian+'</option>';
             }

             for(var i = 0; i < data.ref_prestasi.length; i++){
                cPrestasi = data.ref_prestasi[i]['code'];
                kPrestasi =  data.ref_prestasi[i]['prestasi'];
                juara = data.ref_prestasi[i]['juara_ke']
                optPrestasi += '<option value="'+cPrestasi+'">'+kPrestasi+' Juara Ke-'+juara+'</option>';
             }

             $("#agama").html(optAgama);
             $("#asal_sekolah").html(optSekolah);
             $("#pek_ayah").html(optPekerjaan);
             $("#pek_ibu").html(optPekerjaan);
             $("#pilihan1").html(optKeahlian1);
             $("#pilihan2").html(optKeahlian2);
             $("#pilihan2").html(optKeahlian2);
             $("#prestasi1").html(optPrestasi);
             $("#prestasi2").html(optPrestasi);
             $("#prestasi3").html(optPrestasi);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error pengambilan data !');
        }
    });
}

function edit_calon()
{
    save_method = 'update';
    //$('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string // show bootstrap modal
    $('.modal-title').text('Lengkapi Data Calon Peserta Didik');
    pushData(); // Set Title to Bootstrap modal title
    $('#modal_form').modal({
        backdrop: 'static', 
        keyboard:false
    });
}

function pushData() {
    var id = $('#NISN1').val();

    //Ajax Load data from ajax
    $.ajax({
        url :getbasepath() + "pendaftar/edit_data/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#statusAction').val('update');
            $('#idSiswa').val(data.id);
            $('#NISN').val(data.NISN);
            $('#nama_calon').val(data.nama_calon);
            $('#NIK').val(data.NIK);
            console.log(data.nama_calon);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tgl_lahir').val(data.tgl_lahir);
            $("#jk option").filter(function() {
                return this.value == data.jk; 
            }).attr('selected', true);
            $("#asal_sekolah option").filter(function() {
                return this.value == data.asal_sekolah; 
            }).attr('selected', true);
            $("#agama option").filter(function() {
                return this.value == data.agama; 
            }).attr('selected', true);
            $('#tinggi').val(data.tinggi);
            $('#berat').val(data.berat);
            $('#no_kip').val(data.no_kip);
            $('#no_kks').val(data.no_kks);
            $('#kampung').val(data.kampung);
            $('#rt').val(data.rt);
            $('#rw').val(data.rw);
            $('#desa').val(data.desa);
            $('#kec').val(data.kec);
            $('#kab').val(data.kab);
            $('#prov').val(data.prov);
            $('#kodepos').val(data.kodepos);
            $('#jarak').val(data.jarak);
            $('#nama_ayah').val(data.nama_ayah);
            $('#nama_ibu').val(data.nama_ibu);
            $('#no_hp').val(data.no_hp);
            $('#penghasilan').val(data.penghasilan);
            $("#pek_ibu option").filter(function() {
                return this.value == data.pek_ibu; 
            }).attr('selected', true);
            $("#pek_ayah option").filter(function() {
                return this.value == data.pek_ayah; 
            }).attr('selected', true);
            $('#nilai_ipa').val(data.nilai_ipa);
            $('#nilai_mat').val(data.nilai_mat);
            $('#nilai_indo').val(data.nilai_indo);
            $('#nilai_ingg').val(data.nilai_ing);
            $('#namaprestasi1').val(data.namaprestasi1);
            $('#namaprestasi2').val(data.namaprestasi2);
            $('#namaprestasi3').val(data.namaprestasi3);
            $("#prestasi1 option").filter(function() {
                return this.value == data.prestasi1; 
            }).attr('selected', true);
            $("#prestasi2 option").filter(function() {
                return this.value == data.prestasi2; 
            }).attr('selected', true);
            $("#prestasi3 option").filter(function() {
                return this.value == data.prestasi3; 
            }).attr('selected', true);
            $("#pilihan1 option").filter(function() {
                return this.value == data.pilihan1; 
            }).attr('selected', true);
            $("#pilihan2 option").filter(function() {
                return this.value == data.pilihan2; 
            }).attr('selected', true);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error pengambilan data !');
        }
    });
}