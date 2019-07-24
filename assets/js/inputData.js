//Input Data
$(window).on('load', function () {

    //Pilihan Dimensi
    $.ajax({
        url: 'http://localhost/IpiApps/admin/getDimensi',
        method: 'get',
        dataType: 'json',

        success: function (data) {
            var d = [];
            for (i = 0; i < data.length; i++) {
                d.push(data[i]['nama_dimensi']);
            }
            $('#dimensi').append(`<option>Pilih Dimensi</option>`);
            $('#subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
            $('#indikator').append(`<option>Pilih Indikator</option>`);
            $('.tahun').html(``);
            $('#tahun').append(`<option>Pilih Tahun</option>`);
            d.forEach(function (item) {
                $('#dimensi').append(`<option>` + item + `</option>`);
            });

            //Milih Dimensi
            $('.dimensi').on('change', function () {
                var a = $('#dimensi').val();
                if (a != "Pilih Dimensi") {
                    $('.subDimensi').html(``);
                    var regex = / /gi;
                    var b = a.replace(regex, '_');

                    // Pilihan Sub Dimensi
                    $.ajax({
                        url: 'http://localhost/IpiApps/admin/getSubDimensi/' + b,
                        method: 'get',
                        dataType: 'json',
                        success: function (dataSD) {
                            var sd = [];
                            for (i = 0; i < dataSD.length; i++) {
                                sd.push(dataSD[i]['nama_sub_dimensi']);
                            }
                            $('#subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
                            sd.forEach(function (itemsd) {
                                $('#subDimensi').append(`<option>` + itemsd + `</option>`);
                            });

                            //Milih Sub Dimensi
                            $('.subDimensi').on('change', function () {
                                var c = $('#subDimensi').val();
                                if (c != "Pilih Sub Dimensi") {
                                    $('.indikator').html(``);
                                    var regex = / /gi;
                                    var d = c.replace(regex, '_');
                                    var tahun = $('#tahun').val();
                                    // window.location = window.location.origin + "/IpiApps/admin/getIndikator/" + d;

                                    // Pilihan Indikator
                                    $.ajax({
                                        url: 'http://localhost/IpiApps/admin/getIndikator/' + d,
                                        method: 'get',
                                        dataType: 'json',
                                        success: function (dataI) {
                                            var indikator = [];
                                            for (i = 0; i < dataI.length; i++) {
                                                indikator.push(dataI[i]['nama_indikator']);
                                            }
                                            $('#indikator').append(`<option>Pilih Indikator</option>`);
                                            indikator.forEach(function (itemI) {
                                                $('#indikator').append(`<option>` + itemI + `</option>`);
                                            });

                                            //Milih Indikator
                                            $('.indikator').on('change', function () {
                                                var ind = $('#indikator').val();
                                                //Pilihan Tahun
                                                if (ind != "Pilih Indikator") {
                                                    $('.tahun').html(``);
                                                    $('#tahun').append(`
                                                    <option>Pilih Tahun</option>)
                                                    <option>2012</option>)
                                                    <option>2013</option>)
                                                    <option>2014</option>)
                                                    <option>2015</option>)
                                                    <option>2016</option>)
                                                    <option>2017</option>`);

                                                    //Milih Tahun
                                                    $('.tahun').on('change', function () {
                                                        var tahun = $('#tahun').val();
                                                        if (tahun != "Pilih Tahun") {
                                                            var regex = / /gi;
                                                            var ind_nama = ind.replace(regex, '_');
                                                            // window.location = window.location.origin + "/IpiApps/admin/getNilaiIndikator/" + ind_nama + "/" + tahun;

                                                            //Ambil nilai indikator sesuai tahun
                                                            $.ajax({
                                                                url: 'http://localhost/IpiApps/admin/getNilaiIndikator/' + ind_nama + '/' + tahun,
                                                                method: 'get',
                                                                dataType: 'json',
                                                                success: function (nilai_indikator) {
                                                                    // var nilai = (nilai_indikator['nilai']).toFixed(2);
                                                                    $("#nilai").val(nilai_indikator['nilai']);
                                                                }
                                                            });
                                                        }
                                                        else {
                                                            $("#nilai").val(``);
                                                        }
                                                    });
                                                }
                                                else {
                                                    $('.tahun').html(``);
                                                    $('.tahun').append(`<option>Pilih Tahun</option>`);
                                                }
                                            });
                                        }
                                    })
                                }
                                else {
                                    $('.indikator').html(``);
                                    $('.indikator').append(`<option>Pilih Indikator</option`);
                                    $('.tahun').html(``);
                                    $('.tahun').append(`<option>Pilih Tahun</option>`);
                                }
                            });

                        }
                    });
                }
                else {
                    $('.subDimensi').html(``);
                    $('.subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
                    $('.indikator').html(``);
                    $('.indikator').append(`<option>Pilih Indikator</option>`);
                    $('.tahun').html(``);
                    $('.tahun').append(`<option>Pilih Tahun</option>`);
                }
            })
        }
    });
})

//Tambah Indikator
$('.tambah-indikator').on('click', function () {
    //Pilihan Dimensi
    $.ajax({
        url: 'http://localhost/IpiApps/admin/getDimensi',
        method: 'get',
        dataType: 'json',

        success: function (data) {
            var d = [];
            for (i = 0; i < data.length; i++) {
                d.push(data[i]['nama_dimensi']);
            }
            $('#modal-dimensi').append(`<option>Pilih Dimensi</option>`);
            $('#modal-subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
            d.forEach(function (item) {
                $('#modal-dimensi').append(`<option>` + item + `</option>`);
            });

            //Milih Dimensi
            $('.modal-dimensi').on('change', function () {
                var a = $('#modal-dimensi').val();
                if (a != "Pilih Dimensi") {
                    $('.subDimensi').html(``);
                    var regex = / /gi;
                    var b = a.replace(regex, '_');

                    // Pilihan Sub Dimensi
                    $.ajax({
                        url: 'http://localhost/IpiApps/admin/getSubDimensi/' + b,
                        method: 'get',
                        dataType: 'json',
                        success: function (dataSD) {
                            var sd = [];
                            for (i = 0; i < dataSD.length; i++) {
                                sd.push(dataSD[i]['nama_sub_dimensi']);
                            }
                            sd.forEach(function (itemsd) {
                                $('#modal-subDimensi').append(`<option>` + itemsd + `</option>`);
                            });
                        }
                    });
                }
                else {
                    $('.modal-subDimensi').html(``);
                    $('.modal-subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
                }
            })
        }
    });
});