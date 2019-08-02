//Hapus Indikator
$('.hapus-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {
			var d = [];
			for (i = 0; i < data.length; i++) {
				d.push(data[i]['nama_dimensi']);
			}
			$('#modal-dimensi-hapus').append(`<option>Pilih Dimensi</option>`);
			$('#modal-subDimensi-hapus').append(`<option>Pilih Sub Dimensi</option>`);
			$('#modal-indikator-hapus').append(`<option>Pilih Indikator</option>`);
			d.forEach(function (item) {
				$('#modal-dimensi-hapus').append(`<option>` + item + `</option>`);
			});

			//Milih Dimensi
			$('.modal-dimensi-hapus').on('change', function () {
				$('#modal-subDimensi-hapus').html(``);
				$('#modal-subDimensi-hapus').append(`<option>Pilih Sub Dimensi</option>`);
				var a = $('#modal-dimensi-hapus').val();
				if (a != "Pilih Dimensi") {
					var regex = / /gi;
					var b = a.replace(regex, '_');

					// Pilihan Sub Dimensi
					$.ajax({
						url: segments[0] + '/IpiApps/data/getSubDimensi/' + b,
						method: 'get',
						dataType: 'json',
						success: function (dataSD) {
							var sd = [];
							for (i = 0; i < dataSD.length; i++) {
								sd.push(dataSD[i]['nama_sub_dimensi']);
							}
							sd.forEach(function (itemsd) {
								$('#modal-subDimensi-hapus').append(`<option>` + itemsd + `</option>`);
							});

							$('.modal-subDimensi-hapus').on('change', function () {
								var c = $('#modal-subDimensi-hapus').val();
								$('.modal-indikator-hapus').html(``);
								$('.modal-indikator-hapus').append(`<option>Pilih Indikator</option`);
								if (c != "Pilih Sub Dimensi") {
									var regex = / /gi;
									var d = c.replace(regex, '_');
									// window.location = window.location.origin + "/IpiApps/data/getIndikator/" + d;

									// Pilihan Indikator
									$.ajax({
										url: segments[0] + '/IpiApps/data/getIndikator/' + d,
										method: 'get',
										dataType: 'json',
										success: function (dataI) {
											var indikator = [];
											for (i = 0; i < dataI.length; i++) {
												indikator.push(dataI[i]['nama_indikator']);
											}
											indikator.forEach(function (itemI) {
												$('#modal-indikator-hapus').append(`<option>` + itemI + `</option>`);
											});
										}
									})
								} else {
									$('.modal-indikator-hapus').html(``);
									$('.modal-indikator-hapus').append(`<option>Pilih Indikator</option`);
								}
							});
						}
					});
				} else {
					$('.modal-subDimensi-hapus').html(``);
					$('.modal-subDimensi-hapus').append(`<option>Pilih Sub Dimensi</option>`);
					$('.modal-indikator-hapus').html(``);
					$('.modal-indikator-hapus').append(`<option>Pilih Indikator</option`);

				}
			})
		}
	});
});
