//Tambah Indikator
$('.tambah-indikator').on('click', function () {
    //Pilihan Dimensi
    $.ajax({
        url: 'http://localhost/IpiApps/data/getDimensi',
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
                $('#modal-subDimensi').html(``);
                $('#modal-subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
                var a = $('#modal-dimensi').val();
                if (a != "Pilih Dimensi") {
                    var regex = / /gi;
                    var b = a.replace(regex, '_');

                    // Pilihan Sub Dimensi
                    $.ajax({
                        url: 'http://localhost/IpiApps/data/getSubDimensi/' + b,
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