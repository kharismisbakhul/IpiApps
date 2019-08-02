//Input Data
$(window).on('load', function () {

    //Pilihan Dimensi
    $.ajax({
        url: segments[0]+'/IpiApps/data/getDimensi',
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
            $('.tahun').empty();
            $('#tahun').append(`<option>Pilih Tahun</option>`);
            d.forEach(function (item) {
                $('#dimensi').append(`<option>` + item + `</option>`);
            });

            //Milih Dimensi
            $('.dimensi').on('change', function () {
                reset(0);
                var a = $('#dimensi').val();
                console.log(a);
                if (a != "Pilih Dimensi") {
                    var regex = / /gi;
                    var b = a.replace(regex, '_');

                    // Pilihan Sub Dimensi
                    $.ajax({
                        url: segments[0]+'/IpiApps/data/getSubDimensi/' + b,
                        method: 'get',
                        dataType: 'json',
                        success: function (dataSD) {
                            var sd = [];
                            for (i = 0; i < dataSD.length; i++) {
                                sd.push(dataSD[i]['nama_sub_dimensi']);
                            }
                            sd.forEach(function (itemsd) {
                                $('#subDimensi').append(`<option>` + itemsd + `</option>`);
                            });

                            //Milih Sub Dimensi
                            $('.subDimensi').on('change', function () {
                                reset(1);
                                //bug disini keatas
                                var c = $('#subDimensi').val();
                                console.log(c);
                                if (c != "Pilih Sub Dimensi") {
                                    var regex = / /gi;
                                    var d = c.replace(regex, '_');
                                    // window.location = window.location.origin + "/IpiApps/data/getIndikator/" + d;

                                    // Pilihan Indikator
                                    $.ajax({
                                        url: segments[0]+'/IpiApps/data/getIndikator/' + d,
                                        method: 'get',
                                        dataType: 'json',
                                        success: function (dataI) {
                                            var indikator = [];
                                            for (i = 0; i < dataI.length; i++) {
                                                indikator.push(dataI[i]['nama_indikator']);
                                            }
                                            indikator.forEach(function (itemI) {
                                                $('#indikator').append(`<option>` + itemI + `</option>`);
                                            });

                                            //Milih Indikator
                                            //Normal
                                            $('.indikator').on('change', function () {
                                                reset(2);
                                                var ind = $('#indikator').val();
                                                console.log(ind);
                                                //Pilihan Tahun
                                                if (ind != "Pilih Indikator") {
                                                    //Append Tahun
                                                    $.ajax({
                                                        url: segments[0]+'/IpiApps/data/getTahun',
                                                        method: 'get',
                                                        dataType: 'json',
                                                        success: function (dataTahun) {
                                                            $('.tahun').empty();
                                                            $('.tahun').append(`<option>Pilih Tahun</option>`);
                                                            dataTahun.forEach(function (dataT) {
                                                                $('#tahun').append(`<option>` + dataT + `</option>`);
                                                            });
                                                        }
                                                    });

                                                    //Milih Tahun
                                                    $('.tahun').on('change', function () {
                                                        reset(3);
                                                        var tahun = $('#tahun').val();
                                                        console.log(tahun);
                                                        if (tahun != "Pilih Tahun") {
                                                            var regex = / /gi;
                                                            var ind_nama = ind.replace(regex, '_');
                                                            // window.location = window.location.origin + "/IpiApps/data/getNilaiIndikator/" + ind_nama + "/" + tahun;

                                                            //Ambil nilai indikator sesuai tahun
                                                            $.ajax({
                                                                url: segments[0]+'/IpiApps/data/getNilaiIndikator/' + ind_nama + '/' + tahun,
                                                                method: 'get',
                                                                dataType: 'json',
                                                                success: function (nilai_indikator) {
                                                                    // var nilai = (nilai_indikator['nilai']).toFixed(2);
                                                                    $("#nilai").val(parseFloat(nilai_indikator['nilai']).toFixed(2));
                                                                }
                                                            });
                                                        }
                                                        else {
                                                            reset(3);
                                                        }
                                                    });
                                                }
                                                else {
                                                    reset(2);
                                                }
                                            });
                                        }
                                    })
                                }
                                else {
                                    reset(1);
                                }
                            });

                        }
                    });
                }
                else {
                    reset(0);
                }
            })
        }
    });
})

//reset field
function reset(type) {
    if (type == 0) {
        $('.subDimensi').html(``);
        $('.subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
        reset(1);
    }
    else if (type == 1) {
        $('.indikator').html(``);
        $('.indikator').append(`<option>Pilih Indikator</option`);
        reset(2);
    }
    else if (type == 2) {
        $('.tahun').empty();
        $('.tahun').append(`<option>Pilih Tahun</option>`);
        reset(3);
    }
    else if (type == 3) {
        $("#nilai").val(``);
    }
}