var url = $(location).attr("href");
var segments = url.split("/");
var action = segments[5];
var data = action.split("?");

let iniUrl = "http://localhost:8080/IpiApps/Admin/reportApi?" + data[1];
let tahun = [];
let nilaiIpi = [];
let nilaiDimensi = [];
let max_tahun;
let min_tahun;

$(document).ready(function () {
	$(".table-global").hide();
	$.ajax({
		url: iniUrl,
		method: "get",
		dataType: "json",
		startTime: parseInt(parseInt(performance.now()) / 100),
		beforeSend: function (data) {
			var x = this.startTime;
			console.log(parseInt(x))

		},
		success: function (data) {
			$(".table-global").show();
			_getDataToTable(data);
		},
		done: function () {
			progress.progressTimer('complete');
		},
		error: function (data) {
			$(".loader").remove();
			$("#chart-subdimensi").remove();
			$(".global").append(
				'<img src="http://localhost:8080/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block" width="30%" alt="no data">'
			);
		}
	})
});

var progress = $(".loading-progress").progressTimer({
	timeLimit: (parseInt(performance.now()) / 100) + 3,
	onFinish: function () {
		$(".loading-progress").remove();
	}
});

// Akhir Indeks Pembangunan Inklusif

//untutk data table
function _getDataToTable(data) {
	$(".iniDataIpi").append(`<tr class="ipi"></tr>`);
	for (var i in data["ipi"]) {
		$(".ipi").append(
			`
        <td scope="col">` +
			parseFloat(data["ipi"][i]).toFixed(2) +
			`</td>
        `
		);
	}
	for (var i in data['dimensi']) {
		for (var j in data['tahun']) {
			if (data['dimensi'][i][data['tahun'][j].tahun]) {
				$(".dimensi" + i).append(
					`
            <td scope="col">` +
					parseFloat(data["dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
					`</td>
            `
				)
			}
		}
	}

	for (var i in data['sub_dimensi']) {
		for (var j in data['tahun']) {
			if (data['sub_dimensi'][i][data['tahun'][j].tahun]) {
				$(".subdimensi" + i).append(
					`
            <td scope="col">` +
					parseFloat(data["sub_dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
					`</td>
            `
				)
			}
		}
	}

	console.log(data['indikator'])
	for (var i in data['sub_dimensi']) {
		for (var j in data['indikator'][i]) {
			for (var k in data['tahun']) {
				$(".indikator" + j).append(
					`
            <td scope="col">` +
					parseFloat(data["indikator"][i][j][data['tahun'][k].tahun]).toFixed(2) +
					`</td>
            `
				)
			}
		}
	}

}
