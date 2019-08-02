var url = $(location).attr("href");
var segments = url.split("/");
var action = segments[5];
var data = action.split("?");

let iniUrl = segments[0] + "/IpiApps/Admin/reportApi?" + data[1];
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
			$(".loading-progress").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
		},
		success: function (data) {
			$('.loader').remove();
			// console.log(data);
			$(".table-global").show();
			_getDataToTable(data);
			// $('.export-to-excel').on('click', function () {
			// 	$('.btn-export').html('');
			// 	var tables = $("table").tableExport({
			// 		headings: true, // (Boolean), display table headings (th/td elements) in the <thead>
			// 		footers: true, // (Boolean), display table footers (th/td elements) in the <tfoot>
			// 		formats: ["xlsx"], // (String[]), filetypes for the export
			// 		fileName: "Report", // (id, String), filename for the downloaded file
			// 		bootstrap: true, // (Boolean), style buttons using bootstrap
			// 		position: "bottom", // (top, bottom), position of the caption element relative to table
			// 		ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s)
			// 		ignoreCols: null, // (Number, Number[]), column indices to exclude from the exported file(s)
			// 		ignoreCSS: false, // (selector, selector[]), selector(s) to exclude from the exported file(s)
			// 		emptyCSS: false, // (selector, selector[]), selector(s) to replace cells with an empty string in the exported file(s)
			// 		trimWhitespace: false // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s)
			// 	});

			// 	$(".btn-toolbar").clone(true).appendTo(".btn-export");
			// 	$('.bottom').style.display = "none";
			// 	$('.btn-toolbar').html('');
			// 	tables.tableExport.remove();
			// });
		},
		done: function () {
			progress.progressTimer('complete');
		},
		error: function (data) {
			$(".loader").remove();
			$("#chart-subdimensi").remove();
			$(".global").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block" width="30%" alt="no data">`
			);
		}
	})
});

var progress = $(".loading-progress").progressTimer({
	timeLimit: 10,
	onFinish: function () {
		alert('completed!');
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
			$(".dimensi" + i).append(
				`
            <td scope="col">` +
				parseFloat(data["dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
				`</td>
            `
			)

		}
	}

	for (var i in data['sub_dimensi']) {
		for (var j in data['tahun']) {

			$(".subdimensi" + i).append(
				`
            <td scope="col">` +
				parseFloat(data["sub_dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
				`</td>
            `
			)
			console.log(data["sub_dimensi"][2][2018])

		}
	}

	// console.log(data['indikator'])
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
