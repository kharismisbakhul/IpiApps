//Pindah Indikator - Awal
$('.pindah-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {

			$('.temp-d-1').remove();
			$('#modal-dimensi-1').append(`<option class='temp-d-1'>Pilih Dimensi</option>`);
			$('#modal-subDimensi-1').append(`<option class='temp-sd-1'>Pilih Sub Dimensi</option>`);
			$('#modal-indikator-1').append(`<option class='temp-i-1'>Pilih Indikator</option>`);
			for (var i in data) {
				$('#modal-dimensi-1').append(`<option value='` + data[i].kode_d + `'  class='temp-d-1'>` + data[i].nama_dimensi + `</option>`);
			};

		}
	});

	//Milih Dimensi
	$('.modal-dimensi-1').on('change', function () {
		var a = $('#modal-dimensi-1').val();
		if (a) {
			$.ajax({
				url: segments[0] + '/IpiApps/data/getSubDimensi/' + a,
				method: 'get',
				dataType: 'json',
				success: function (dataSD) {
					$('.temp-sd-1').remove()
					$('.temp-i-1').remove()
					$('#modal-subDimensi-1').append(`<option class='temp-sd-1'>Pilih Sub Dimensi</option>`);
					$('#modal-indikator-1').append(`<option class='temp-i-1'>Pilih Indikator</option>`);
					for (var i in dataSD) {
						$('#modal-subDimensi-1').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-sd-1'>` + dataSD[i].nama_sub_dimensi + `</option>`);
					};
				}
			})
		}
	})

	// Pilihan Indikator
	$('.modal-subDimensi-1').on('change', function () {
		var c = $('#modal-subDimensi-1').val();
		if (c) {
			$.ajax({
				url: segments[0] + '/IpiApps/data/getIndikator/' + c,
				method: 'get',
				dataType: 'json',
				success: function (dataI) {
					$('.temp-i-1').remove()
					$('#modal-indikator-1').append(`<option class='temp-i-1'>Pilih Indikator</option>`);
					for (var i in dataI) {
						$('#modal-indikator-1').append(`<option value="` + dataI[i].kode_indikator + `"  class='temp-i-1'>` + dataI[i].nama_indikator + `</option>`);
					};
				}
			})
		}
	});
})

// Pindah Indikator - Tujuan
$('.pindah-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {
			$('.temp-i-d-2').remove()
			$('.temp-i-sd-2').remove()
			$('.temp-i-b-2').remove()
			$('#modal-dimensi-2').append(`<option class='temp-i-d-2'>Pilih Dimensi</option>`);
			$('#modal-subDimensi-2').append(`<option class='temp-i-sd-2'>Pilih Sub Dimensi</option>`);
			$('#modal-baris-indeks-2').append(`<option class='temp-i-b-2'>Pilih Baris / Indeks</option>`);
			for (var i in data) {
				$('#modal-dimensi-2').append(`<option value='` + data[i].kode_d + `'  class='temp-i-d-2'>` + data[i].nama_dimensi + `</option>`);
			};

		}
	});

});

//Milih Dimensi
$('.modal-dimensi-2').on('change', function () {
	$('.temp-i-sd-2').remove();
	$('.temp-i-b-2').remove()
	$('#modal-subDimensi-2').append(`<option  class='temp-i-sd-2'>Pilih Sub Dimensi</option>`);
	$('#modal-baris-indeks-2').append(`<option  class='temp-i-b-2'>Pilih Baris / Indeks</option>`);
	var a = $('#modal-dimensi-2').val();
	if (a != "Pilih Dimensi") {
		// Pilihan Sub Dimensi
		$.ajax({
			url: segments[0] + '/IpiApps/data/getSubDimensi/' + a,
			method: 'get',
			dataType: 'json',
			success: function (dataSD) {
				for (var i in dataSD) {
					$('#modal-subDimensi-2').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-i-sd-2'>` + dataSD[i].nama_sub_dimensi + `</option>`);
				}
			}
		});

	}
})

//Milih SubDimensi
$('#modal-subDimensi-2').on('change', function () {
	$('.temp-i-b-2').remove();
	$('#modal-baris-indeks-2').append(`<option  class='temp-i-b-2'>Pilih Baris / Indeks</option>`);
	var a = $('#modal-subDimensi-2').val();
	if (a != "Pilih Sub Dimensi") {
		// Pilihan Indeks
		$.ajax({
			url: segments[0] + '/IpiApps/data/getIndikator/' + a,
			method: 'get',
			dataType: 'json',
			success: function (dataB) {
				for (var i in dataB) {
					$('#modal-baris-indeks-2').append(`<option value='` + (++i) + `' class='temp-i-b-2'>` + i + `</option>`);
				}
				$('#modal-baris-indeks-2').append(`<option value='` + (dataB.length + 1) + `' class='temp-i-b-2'>Terakhir</option>`);
			}
		});
	}
})
