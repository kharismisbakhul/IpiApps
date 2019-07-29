//Load
var start = 0;
var end = 0;
$(window).on("load", function() {
	//Pilih Tahun
	$("#submit-search").on("click", function() {
		$(".chart-bar-subdimensi-ipsdm").html("");
		$(".chart-bar-subdimensi-ipsdm").append(
			"<canvas id='subdimensi-ipsdm' width='850' height='500'></canvas>"
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
	//Pilihan Dimensi
	$.ajax({
		url: "http://localhost/IpiApps/data/getDataChart/" + start + "/" + end,
		method: "get",
		dataType: "json",

		success: function(data) {
			console.log(data);
			$("#span-table").attr("colspan", "");
			$("#span-table").attr("colspan", data["col_span"]);
			$("#range-tahun").html("");
			$.each(data["range_tahun"], function(index, rangeTahun) {
				$("#range-tahun").append("<th scope='col'>" + rangeTahun + "</th>");
			});
			$("#subdimensi-table").html("");
			$("#subdimensi-table").append(
				"<tr id='subdimensi-value' class='subdimensi-value'>"
			);
			$("#subdimensi-value").html("");
			$("#subdimensi-value").append(
				"<td colspan='2'>" + data.subDimensi[2].nama_sub_dimensi + "</td>"
			);

			$.each(data["subDimensi"][2]["nilai"], function(index, nilaisubdimensi) {
				$("#subdimensi-value").append(
					"<td style='border: 1px solid black'>" + nilaisubdimensi + "</td>"
				);
			});

			$.each(data["indikator_sd"][2], function(index, indikator) {
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

			var rgb = [
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)",
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)"
			];
			window.myLineChart = new Chart($("#subdimensi-ipsdm"), {
				type: "bar",
				data: {
					labels: data["range_tahun"],
					datasets: [
						{
							label: data["subDimensi"][2]["nama_sub_dimensi"],
							type: "line",
							borderColor: "#654321",
							data: data["subDimensi"][2]["nilai"],
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
			for (var i = 0; i < data["indikator_sd"][2].length; i++) {
				myLineChart.data.datasets.push({
					label: data["indikator_sd"][2][i]["nama_indikator"],
					type: "bar",
					backgroundColor: rgb[i],
					data: data["indikator_sd"][2][i]["nilai"]
				});
			}
			window.myLineChart.update();
			// End function
		}
	});
}
