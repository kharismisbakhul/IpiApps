// Indeks Pertumbuhan Ekonomi
let url = $(location).attr('href');
let segments = url.split('/');
let action = segments[5];
let data = action.split('?');

let iniUrl = 'http://localhost:8080/IpiApps/Admin/getIpi?' + data[1];
var nama_dimensi = [];
var tahun = [];
var nilaiIpi = [];
var nilaiDimenasi = [];

$(document).ready(function () {
	$.ajax({
		url: iniUrl,
		method: 'post',
		dataType: 'json',
		success: function (data) {

			for (var i in data['nama_dimensi']) {
				nama_dimensi.push(data['nama_dimensi'][i].nama_dimensi);
			}
			for (var i in data['tahun']) {
				tahun.push(data['tahun'][i].tahun);
			}
			for (var i in data['ipi']) {
				nilaiIpi.push(data['ipi'][i].nilai_rescale);
			}
			let setDataDimensi = [];
			setDataDimensi.push({
				'label': "Indeks Pembangunan Ekonomi (IPE)",
				'type': "line",
				'borderColor': '#FF0606',
				'data': nilaiIpi,
				'borderDashOffset': 1,
				'fill': false,
				'spanGaps': true
			})
			let color = [
				"rgb(132,60,12)",
				"rgb(84,130,53)",
				"rgb(191,144,0)",
			];
			let count = 1;
			for (var i in data['nama_dimensi']) {
				setDataDimensi.push({
					'label': nama_dimensi[i],
					'type': "bar",
					'backgroundColor': color[i],
					'data': data['dimensi'][count++]
				});
			}
			setDataDimensi.push({
				'label': 't',
				'type': "line",
				'backgroundColor': "rgb(243, 156, 18,0.3)",
				'data': [4, 4, 4, 4, 4, 4],
				'fill': true
			}, {
				'label': 't',
				'type': "line",
				'backgroundColor': "rgb(255, 112, 112,0.3)",
				'data': [7, 7, 7, 7, 7, 7],
				'fill': true
			}, {
				'label': 't',
				'type': "line",
				'backgroundColor': "rgb(112, 165, 255,0.3)",
				'data': [10, 10, 10, 10, 10, 10],
				'fill': true
			})
			const canvas = document.querySelector("#ipi-chart");
			const ctx = canvas.getContext('2d');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: tahun,
					datasets: setDataDimensi
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 10,
							bottom: 0
						}
					},
					scales: {
						xAxes: [{
							time: {
								unit: 'year'
							},
							gridLines: {
								display: true,
								drawBorder: false
							},
							ticks: {
								min: 2,
								max: 0,
								maxTicksLimit: 7
							},
							maxBarThickness: 30,
						}],
						yAxes: [{
							ticks: {
								min: 0,
								max: 10,
								maxTicksLimit: 20,
								padding: 10,
								// Include a dollar sign in the ticks
							},
							gridLines: {
								color: "rgb(220, 221, 225)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [5, 5],
								zeroLineBorderDash: [2],
							}
						}],
					},
					legend: {
						display: true
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 1,
						yPadding: 6,
						displayColors: false,
						caretPadding: 10,
					},
				}
			})
		},
		error: function (data) {
			$('#ipi-chart').remove();
			$('.chart').append('<img src="http://localhost:8080/IpiApps/assets/img/erorr_data.png" width="60%" alt="no data" class="rounded mx-auto d-block">')
		}
	});
})
// Akhir Indeks Pertumbuhan Ekonomi
