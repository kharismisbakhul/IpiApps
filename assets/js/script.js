// // Indeks Pembangunan Inklusif
// let url = $(location).attr('href');
// let segments = url.split('/');
// let action = segments[5];
// let data = action.split('?');

// let iniUrl = 'http://localhost:8080/IpiApps/Admin/getIpi?' + data[1];
// var nama_dimensi = [];
// var tahun = [];
// var nilaiIpi = [];
// var nilaiDimenasi = [];

// $(document).ready(function () {
// 	$.ajax({
// 		url: iniUrl,
// 		method: 'post',
// 		dataType: 'json',
// 		success: function (data) {

// 			for (var i in data['nama_dimensi']) {
// 				nama_dimensi.push(data['nama_dimensi'][i].nama_dimensi);
// 			}
// 			for (var i in data['tahun']) {
// 				tahun.push(data['tahun'][i].tahun);
// 			}
// 			for (var i in data['ipi']) {
// 				nilaiIpi.push(data['ipi'][i].nilai_rescale);
// 			}
// 			let setDataDimensi = [];
// 			setDataDimensi.push({
// 				'label': "Indeks Pembangunan Ekonomi (IPE)",
// 				'type': "line",
// 				'borderColor': '#FF0606',
// 				'data': nilaiIpi,
// 				'borderDashOffset': 1,
// 				'fill': false,
// 				'spanGaps': true
// 			})
// 			let color = [
// 				"rgb(132,60,12)",
// 				"rgb(84,130,53)",
// 				"rgb(191,144,0)",
// 			];
// 			let count = 1;
// 			for (var i in data['nama_dimensi']) {
// 				setDataDimensi.push({
// 					'label': nama_dimensi[i],
// 					'type': "bar",
// 					'backgroundColor': color[i],
// 					'data': data['dimensi'][count++]
// 				});
// 			}
// 			const canvas = document.querySelector("#ipi-chart");
// 			const ctx = canvas.getContext('2d');
// 			new Chart(ctx, {
// 				type: 'bar',
// 				data: {
// 					labels: tahun,
// 					datasets: setDataDimensi
// 				},
// 				options: {
// 					maintainAspectRatio: false,
// 					layout: {
// 						padding: {
// 							left: 0,
// 							right: 0,
// 							top: 10,
// 							bottom: 0
// 						}
// 					},
// 					scales: {
// 						xAxes: [{
// 							time: {
// 								unit: 'year'
// 							},
// 							gridLines: {
// 								display: true,
// 								drawBorder: false
// 							},
// 							ticks: {
// 								min: 2,
// 								max: 0,
// 								maxTicksLimit: 7
// 							},
// 							maxBarThickness: 70,
// 						}],
// 						yAxes: [{
// 							ticks: {
// 								min: 0,
// 								max: 10,
// 								maxTicksLimit: 20,
// 								padding: 10,
// 								// Include a dollar sign in the ticks
// 							},
// 							gridLines: {
// 								color: "rgb(220, 221, 225)",
// 								zeroLineColor: "rgb(234, 236, 244)",
// 								drawBorder: false,
// 								borderDash: [5, 5],
// 								zeroLineBorderDash: [2],
// 							}
// 						}],
// 					},
// 					annotation: {
// 						annotations: [{
// 							type: 'box',
// 							yScaleID: 'y-axis-0',
// 							yMin: 0,
// 							yMax: 4,
// 							borderColor: 'rgba(255, 51, 51, 0.1',
// 							borderWidth: 2,
// 							backgroundColor: 'rgba(255, 51, 51, 0.1)',
// 						}, {
// 							type: 'box',
// 							yScaleID: 'y-axis-0',
// 							yMin: 4,
// 							yMax: 7,
// 							borderColor: 'rgba(255, 255, 0, 0.1)',
// 							borderWidth: 1,
// 							backgroundColor: 'rgba(255, 255, 0, 0.1)',
// 						}, {
// 							type: 'box',
// 							yScaleID: 'y-axis-0',
// 							yMin: 7,
// 							yMax: 10,
// 							borderColor: 'rgba(0, 204, 0, 0.1)',
// 							borderWidth: 1,
// 							backgroundColor: 'rgba(0, 204, 0, 0.1)',
// 						}],
// 					},
// 					legend: {
// 						display: true
// 					},
// 					tooltips: {
// 						titleMarginBottom: 10,
// 						titleFontColor: '#6e707e',
// 						titleFontSize: 14,
// 						backgroundColor: "rgb(255,255,255)",
// 						bodyFontColor: "#858796",
// 						borderColor: '#dddfeb',
// 						borderWidth: 1,
// 						xPadding: 1,
// 						yPadding: 6,
// 						displayColors: false,
// 						caretPadding: 10,
// 					},
// 				}
// 			})
// 		},
// 		error: function (data) {
// 			$('#ipi-chart').remove();
// 			$('.chart').append('<img src="http://localhost:8080/IpiApps/assets/img/error_data.png" width="60%" alt="no data" class="rounded mx-auto d-block">')
// 		}
// 	});
// })
// // Akhir Indeks Pembangunan Inklusif

// // Aktivitas Ekonomi
// var c = new Chart(document.getElementById("pertumbuhan-ek"), {
// 	type: 'bar',
// 	data: {
// 		labels: ["0", "2012", "2013", "2014", "2015", "2016", "2017", "0"],
// 		datasets: [{
// 				label: "Indeks Pembangunan Ekonomi (IPE)",
// 				type: "line",
// 				borderColor: '#654321',
// 				data: [{
// 					"2012": 6.23,
// 					"2013": 5.40,
// 					"2014": 4.36,
// 					"2015": 4.72,
// 					"2016": 3.68,
// 					"2017": 3.39
// 				}],
// 				fill: false
// 			},
// 			{
// 				label: "Indeks Inflasi (II)",
// 				type: "bar",
// 				backgroundColor: "rgb(248, 194, 145)",
// 				data: [0, 8.86, 6.67, 4.23, 3.89, 3.12, 1.29]
// 			}, {
// 				label: "Indeks Aktivitas Ekonomi (IAE)",
// 				type: "bar",
// 				backgroundColor: "rgb(241, 196, 15)",
// 				data: [0, 2.59, 4.37, 5.37, 3.86, 7.74, 5.85]
// 			}, {
// 				label: "Indeks Pembangunan Sumberdaya Manusia (IPSDM)",
// 				type: "bar",
// 				backgroundColor: "rgb(243, 156, 18)",
// 				data: [0, 4.98, 3.50, 5.30, 7.13, 5.08, 5.90]
// 			}
// 		]
// 	},
// 	options: {
// 		maintainAspectRatio: false,
// 		layout: {
// 			padding: {
// 				left: 10,
// 				right: 25,
// 				top: 25,
// 				bottom: 0
// 			}
// 		},
// 		scales: {
// 			xAxes: [{
// 				time: {
// 					unit: 'year'
// 				},
// 				gridLines: {
// 					display: false,
// 					drawBorder: false
// 				},
// 				ticks: {
// 					maxTicksLimit: 10
// 				},
// 				maxBarThickness: 30,
// 			}],
// 			yAxes: [{
// 				ticks: {
// 					min: 0,
// 					max: 10,
// 					maxTicksLimit: 20,
// 					padding: 10,
// 					// Include a dollar sign in the ticks
// 				},
// 				gridLines: {
// 					color: "#ff0000",
// 					zeroLineColor: "rgb(234, 236, 244)",
// 					drawBorder: false,
// 					borderDash: [5, 5],
// 					zeroLineBorderDash: [2],
// 				}
// 			}],
// 		},
// 		annotation: {
// 			annotations: [{
// 				type: 'box',
// 				yScaleID: 'y-axis-0',
// 				yMin: 4,
// 				yMax: 7,
// 				borderColor: 'rgba(255, 51, 51, 0.25)',
// 				borderWidth: 2,
// 				backgroundColor: 'rgba(255, 51, 51, 0.25)',
// 			}, {
// 				type: 'box',
// 				yScaleID: 'y-axis-0',
// 				yMin: -1,
// 				yMax: 1,
// 				borderColor: 'rgba(255, 255, 0, 0.25)',
// 				borderWidth: 1,
// 				backgroundColor: 'rgba(255, 255, 0, 0.25)',
// 			}, {
// 				type: 'box',
// 				yScaleID: 'y-axis-0',
// 				yMin: -2,
// 				yMax: -1,
// 				borderColor: 'rgba(0, 204, 0, 0.25)',
// 				borderWidth: 1,
// 				backgroundColor: 'rgba(0, 204, 0, 0.25)',
// 			}],
// 		},
// 		legend: {
// 			display: false
// 		},
// 		tooltips: {
// 			titleMarginBottom: 10,
// 			titleFontColor: '#6e707e',
// 			titleFontSize: 14,
// 			backgroundColor: "rgb(255,255,255)",
// 			bodyFontColor: "#858796",
// 			borderColor: '#dddfeb',
// 			borderWidth: 1,
// 			xPadding: 15,
// 			yPadding: 15,
// 			displayColors: false,
// 			caretPadding: 10,
// 		},
// 	}

// })
// console.log(c)
// // Akhir Aktivitas Ekonomi
