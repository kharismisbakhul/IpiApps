//Load
var start = 0;
var end = 0;
// $(window).on("load", function() {
// 	alert("JALAN DONG");
// });

if ($(location).attr("pathname") == "/IpiApps/admin/pertumbuhanEkonomi") {
	alert("INI DIMENSI PE");
}

$(window).on("load", function() {
	//Pilih Tahun
	$("#submit-search").on("click", function() {
		$(".chart-bar-ipi").html("");
		$(".chart-bar-ipi").append(
			"<canvas id='ipi_chart' width='400' height='400'></canvas>"
		);
		// Dummy
		$(".chart-bar-dimensi-ipe").html("");
		$(".chart-bar-dimensi-ipe").append(
			"<canvas id='dimensi-pertumbuhanEkonomi' width='850' height='500'></canvas>"
		);
		$(".chart-bar-subdimensi-ii").html("");
		$(".chart-bar-subdimensi-ii").append(
			"<canvas id='subdimensi-ii' width='850' height='500'></canvas>"
		);
		clickedFilter();
	});
	ajaxData(start, end);
});
function clickedFilter() {
	start = $(".start-date").val();
	end = $(".end-date").val();
	if (start == "Pilih Tahun" && end == "Pilih Tahun") {
		start = 0;
		end = 0;
	}
	ajaxData(start, end);
}

function ajaxData(start, end) {
	//Ajax Data
	$.ajax({
		url: "http://localhost/IpiApps/data/getDataChart/" + start + "/" + end,
		method: "get",
		dataType: "json",

		success: function(data) {
			// console.log(data);
			$("#span-table").attr("colspan", "");
			$("#span-table").attr("colspan", data["col_span"]);
			$("#range-tahun").html("");
			$.each(data["range_tahun"], function(index, rangeTahun) {
				$("#range-tahun").append("<th scope='col'>" + rangeTahun + "</th>");
			});
			$("#ipi-table").html("");
			$("#ipi-table").append("<tr id='ipi-value' class='ipi-value'>");

			$("#ipi-value").html("");
			$("#ipi-value").append("<td colspan='2'>" + data.ipi.nama_ipi + "</td>");

			$.each(data["ipi"]["nilai"], function(index, nilaiIPI) {
				$("#ipi-value").append(
					"<td style='border: 1px solid black'>" + nilaiIPI + "</td>"
				);
			});
			$.each(data["dimensi"], function(index, dimensi) {
				$("#ipi-table").append(
					"<tr id='dimensi-" +
						index +
						"-value' class='dimensi-" +
						index +
						"-value'><td style='border: 1px solid black'>" +
						(index + 1) +
						"</td><td style='border: 1px solid black'>" +
						dimensi.nama_dimensi +
						"</td></tr>"
				);
				$.each(dimensi.nilai, function(index2, nilaiDimensi) {
					$("#dimensi-" + index + "-value").append(
						"<td style='border: 1px solid black'>" + nilaiDimensi + "</td>"
					);
				});
			});

			//Dummy
			$("#dimensi-table").html("");
			$("#dimensi-table").append(
				"<tr id='dimensi-value' class='dimensi-value'>"
			);

			$("#dimensi-value").html("");
			$("#dimensi-value").append(
				"<td colspan='2'>" + data.dimensi[0].nama_dimensi + "</td>"
			);

			$.each(data["dimensi"][0]["nilai"], function(index, nilaidimensi) {
				$("#dimensi-value").append(
					"<td style='border: 1px solid black'>" + nilaidimensi + "</td>"
				);
			});

			$.each(data["subdimensi_d"][0], function(index, subdimensi) {
				$("#dimensi-table").append(
					"<tr id='subdimensi-" +
						index +
						"-value' class='subdimensi-" +
						index +
						"-value'><td style='border: 1px solid black'>" +
						(index + 1) +
						"</td><td style='border: 1px solid black'>" +
						subdimensi.nama_sub_dimensi +
						"</td></tr>"
				);
				$.each(subdimensi.nilai, function(index2, nilaisubDimensi) {
					$("#subdimensi-" + index + "-value").append(
						"<td style='border: 1px solid black'>" + nilaisubDimensi + "</td>"
					);
				});
			});

			var rgbD = [
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)"
			];

			var rgb = [
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)"
			];
			var ipiChart = new Chart($("#ipi_chart"), {
				type: "bar",
				data: {
					labels: data["range_tahun"],
					datasets: [
						{
							label: data["ipi"]["nama_ipi"],
							type: "line",
							borderColor: "#654321",
							data: data["ipi"]["nilai"],
							fill: false
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						}
					},
					scales: {
						xAxes: [
							{
								time: {
									unit: "year"
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 10
								},
								maxBarThickness: 30
							}
						],
						yAxes: [
							{
								ticks: {
									min: 0,
									max: 10,
									maxTicksLimit: 20,
									padding: 10
									// Include a dollar sign in the ticks
								},
								gridLines: {
									color: "rgb(220, 221, 225)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: false,
									borderDash: [5, 5],
									zeroLineBorderDash: [2]
								}
							}
						]
					},
					legend: {
						display: false
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: "#6e707e",
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: "#dddfeb",
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10
					}
				}
			});
			for (var i = 0; i < data["dimensi"].length; i++) {
				ipiChart.data.datasets.push({
					label: data["dimensi"][i]["nama_dimensi"],
					type: "bar",
					backgroundColor: rgb[i],
					data: data["dimensi"][i]["nilai"]
				});
			}
			ipiChart.update();
			// End function

			//Dummy
			var dimensiChart = new Chart($("#dimensi-pertumbuhanEkonomi"), {
				type: "bar",
				data: {
					labels: data["range_tahun"],
					datasets: [
						{
							label: data["dimensi"][0]["nama_dimensi"],
							type: "line",
							borderColor: "#654321",
							data: data["dimensi"][0]["nilai"],
							fill: false
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						}
					},
					scales: {
						xAxes: [
							{
								time: {
									unit: "year"
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 10
								},
								maxBarThickness: 30
							}
						],
						yAxes: [
							{
								ticks: {
									min: 0,
									max: 10,
									maxTicksLimit: 20,
									padding: 10
									// Include a dollar sign in the ticks
								},
								gridLines: {
									color: "rgb(220, 221, 225)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: false,
									borderDash: [5, 5],
									zeroLineBorderDash: [2]
								}
							}
						]
					},
					legend: {
						display: false
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: "#6e707e",
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: "#dddfeb",
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10
					}
				}
			});
			for (var i = 0; i < data["subdimensi_d"][0].length; i++) {
				dimensiChart.data.datasets.push({
					label: data["subdimensi_d"][0][i]["nama_sub_dimensi"],
					type: "bar",
					backgroundColor: rgbD[i],
					data: data["subdimensi_d"][0][i]["nilai"]
				});
			}
			dimensiChart.update();
			// End function

			//Dummy 3
			$("#subdimensi-table").html("");
			$("#subdimensi-table").append(
				"<tr id='subdimensi-value' class='subdimensi-value'>"
			);
			$("#subdimensi-value").html("");
			$("#subdimensi-value").append(
				"<td colspan='2'>" + data.subDimensi[0].nama_sub_dimensi + "</td>"
			);

			$.each(data["subDimensi"][0]["nilai"], function(index, nilaisubdimensi) {
				$("#subdimensi-value").append(
					"<td style='border: 1px solid black'>" + nilaisubdimensi + "</td>"
				);
			});

			$.each(data["indikator_sd"][0], function(index, indikator) {
				$("#subdimensi-table").append(
					"<tr id='indikator-" +
						index +
						"-value' class='indikator-" +
						index +
						"-value'><td style='border: 1px solid black'>" +
						(index + 1) +
						"</td><td style='border: 1px solid black'>" +
						indikator.nama_indikator +
						"</td></tr>"
				);
				$.each(indikator.nilai, function(index2, nilaiindikator) {
					$("#indikator-" + index + "-value").append(
						"<td style='border: 1px solid black'>" + nilaiindikator + "</td>"
					);
				});
			});

			var rgbSD = [
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)"
			];
			subDimensiChart = new Chart($("#subdimensi-ii"), {
				type: "bar",
				data: {
					labels: data["range_tahun"],
					datasets: [
						{
							label: data["subDimensi"][0]["nama_sub_dimensi"],
							type: "line",
							borderColor: "#654321",
							data: data["subDimensi"][0]["nilai"],
							fill: false
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						}
					},
					scales: {
						xAxes: [
							{
								time: {
									unit: "year"
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 10
								},
								maxBarThickness: 30
							}
						],
						yAxes: [
							{
								ticks: {
									min: 0,
									max: 10,
									maxTicksLimit: 20,
									padding: 10
									// Include a dollar sign in the ticks
								},
								gridLines: {
									color: "rgb(220, 221, 225)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: false,
									borderDash: [5, 5],
									zeroLineBorderDash: [2]
								}
							}
						]
					},
					legend: {
						display: false
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: "#6e707e",
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: "#dddfeb",
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10
					}
				}
			});
			for (var i = 0; i < data["indikator_sd"][0].length; i++) {
				subDimensiChart.data.datasets.push({
					label: data["indikator_sd"][0][i]["nama_indikator"],
					type: "bar",
					backgroundColor: rgbSD[i],
					data: data["indikator_sd"][0][i]["nilai"]
				});
			}
			subDimensiChart.update();
			// End function
		}
	});
}
