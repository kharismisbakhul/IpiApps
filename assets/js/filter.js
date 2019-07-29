$(window).on('load', function () {

    //Pilihan Dimensi
    $.ajax({
        url: 'http://localhost/IpiApps/data/getTahun',
        method: 'get',
        dataType: 'json',

        success: function (data) {
            data.forEach(function (dataTahun) {
                $('.start-date').append(`<option>` + dataTahun + `</option>`);
            });
            $('.start-date').on('change', function () {
                var tahun_awal = $('.start-date').val();
                $('.end-date').html(``);
                $('.end-date').append(`<option>Pilih Tahun</option`);
                if (tahun_awal != "Pilih Tahun") {
                    $.ajax({
                        url: 'http://localhost/IpiApps/data/getTahunSelected/' + tahun_awal,
                        method: 'get',
                        dataType: 'json',

                        success: function (dataT) {
                            dataT.forEach(function (dataTahunSampai) {
                                $('.end-date').append(`<option>` + dataTahunSampai + `</option>`);
                            });
                        }
                    })
                }
                else {

                }
            })
        }

    })
})