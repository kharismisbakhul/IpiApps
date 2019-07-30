//Load
var start = 0;
var end = 0;

$(window).on("load", function() {
	//Pilih Tahun
	$("#submit-search").on("click", function() {
		$(".chart-bar-dimensi-ipe").html("");
		$(".chart-bar-dimensi-ipe").append(
			"<canvas id='dimensi-pertumbuhanEkonomi' width='850' height='500'></canvas>"
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
			// console.log(data);
			$("#span-table").attr("colspan", "");
			$("#span-table").attr("colspan", data["col_span"]);
			$("#range-tahun").html("");
			$.each(data["range_tahun"], function(index, rangeTahun) {
				$("#range-tahun").append("<th scope='col'>" + rangeTahun + "</th>");
			});
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

			var rgb = [
				"rgb(248, 194, 145)",
				"rgb(241, 196, 15)",
				"rgb(243, 156, 18)"
			];
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
					backgroundColor: rgb[i],
					data: data["subdimensi_d"][0][i]["nilai"]
				});
			}
			dimensiChart.update();
			// End function
		}
	});
}
