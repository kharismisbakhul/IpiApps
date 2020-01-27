//Tambah Indikator
$('.tambah-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {
			$('.temp-i-d').remove()
			$('.temp-i-sd').remove()
			$('.temp-i-b').remove()
			$('#modal-dimensi').append(`<option class='temp-i-d'>Pilih Dimensi</option>`);
			$('#modal-subDimensi').append(`<option class='temp-i-sd'>Pilih Sub Dimensi</option>`);
			$('#modal-baris-indeks').append(`<option class='temp-i-b'>Pilih Baris / Indeks</option>`);
			for (var i in data) {
				$('#modal-dimensi').append(`<option value='` + data[i].kode_d + `'  class='temp-i-d'>` + data[i].nama_dimensi + `</option>`);
			};

		}
	});

});

//Milih Dimensi
$('.modal-dimensi').on('change', function () {
	$('.temp-i-sd').remove();
	$('.temp-i-b').remove()
	$('#modal-subDimensi').append(`<option  class='temp-i-sd'>Pilih Sub Dimensi</option>`);
	$('#modal-baris-indeks').append(`<option  class='temp-i-b'>Pilih Baris / Indeks</option>`);
	var a = $('#modal-dimensi').val();
	if (a != "Pilih Dimensi") {
		// Pilihan Sub Dimensi
		$.ajax({
			url: segments[0] + '/IpiApps/data/getSubDimensi/' + a,
			method: 'get',
			dataType: 'json',
			success: function (dataSD) {
				for (var i in dataSD) {
					$('#modal-subDimensi').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-i-sd'>` + dataSD[i].nama_sub_dimensi + `</option>`);
				}
			}
		});

	}
})

//Milih SubDimensi
$('#modal-subDimensi').on('change', function () {
	$('.temp-i-b').remove();
	$('#modal-baris-indeks').append(`<option  class='temp-i-b'>Pilih Baris / Indeks</option>`);
	var a = $('#modal-subDimensi').val();
	if (a != "Pilih Sub Dimensi") {
		// Pilihan Indeks
		$.ajax({
			url: segments[0] + '/IpiApps/data/getIndikator/' + a,
			method: 'get',
			dataType: 'json',
			success: function (dataB) {
				for (var i in dataB) {
					$('#modal-baris-indeks').append(`<option value='` + (++i) + `' class='temp-i-b'>` + i + `</option>`);
				}
				$('#modal-baris-indeks').append(`<option value='` + (dataB.length + 1) + `' class='temp-i-b'>Terakhir</option>`);
			}
		});
	}
})
