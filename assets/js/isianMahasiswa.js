$('.modalIsianMahasiswa').on('click', function () {
    var nim = $(this).data('id');
    if (cekData() == true) {
        $(".formIsian").attr('action', '');
        $(".formIsian").attr('action', window.location.origin + "/SiUjian/mahasiswa/updateIsianMahasiswa/" + nim);
        console.log($(".formIsian").attr('action'));
        $.ajax({
            url: 'http://localhost/SiUjian/Mahasiswa/getDataEditIsian/' + nim,
            dataType: 'json',
            type: 'get',
            success: function (data) {
                $('#judulTA').html(data.judulAkhir);
                $('#paradigma').html(data.paradigma);
                $('#kataKunci').html(data.kataKunci);
                $('#tujuanP').html(data.tujuanPenelitian);
                $('#metpen1').html(data.metodePenelitian1);
                $('#metpen2').html(data.metodePenelitian2);
                $('#temuan').html(data.temuan);
                $('#kontribusiImplikasi').html(data.kontribusiDanImplikasi);
            }
        });
    }
});

if (cekData() == true) {
    $('.isianTambahEdit').html('');
    $('.isianTambahEdit').html('Edit');
    $('.tombolIsian').html('');
    $('.tombolIsian').html('Edit');
}
else if (cekData() == false) {
    $('.isianTambahEdit').html('');
    $('.isianTambahEdit').html('Tambah');
    $('.tombolIsian').html('');
    $('.tombolIsian').html('Tambah');
}

function cekData() {
    var a = $('#mjudulTA').html();
    var b = $('#mparadigma').html();
    var c = $('#mkataKunci').html();
    var d = $('#mtujuanP').html();
    var e = $('#mmetpen1').html();
    var f = $('#mmetpen2').html();
    var g = $('#mtemuan').html();
    var h = $('#mkontribusiImplikasi').html();

    if (a != "" || b != "" || c != "" || d != "" || e != "" || f != "" || g != "" || h != "") {
        return true;
    }
    else {
        return false;
    }
}