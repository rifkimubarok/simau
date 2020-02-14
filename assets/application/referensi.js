function getKec() {
    $.ajax({
        url: getbasepath() + "dashboard/referensi/getKec",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var option = "<option selected value=''> -- Pilih Kecamatan -- </option>";
            for (var i = 0; i < data.kec.length; i++) {
                var isi = data.kec[i]['kecamatan'];
                option += "<option value='" + isi + "'> " + isi + " </option>";
            }
            $('#kecamatan').html(option);
        }
    })
}

function getJenjang() {
    $.ajax({
        url: getbasepath() + "dashboard/referensi/getJenjang",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var option = "<option selected value=''> -- Pilih Jenjang -- </option>";
            for (var i = 0; i < data.jenjang.length; i++) {
                var isi = data.jenjang[i]['jenjang'];
                option += "<option value='" + isi + "'> " + isi + " </option>";
            }
            $('#jenjang').html(option);
        }
    })
}


function get_sekolah(url = '') {
    let uri = url == '' ? getbasepath() + "dashboard/referensi/getSekolah" : url;
    $.ajax({
        url: uri,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            var option = "<option selected value=''> -- Pilih Sekolah -- </option>";
            for (var i = 0; i < data.sekolah.length; i++) {
                var isi = data.sekolah[i]['namasekolah'];
                var kode = data.sekolah[i]['npsn'];
                option += "<option value='" + kode + "'> " + isi + " </option>";
            }
            $('#sekolah').html(option);
        }
    })
}