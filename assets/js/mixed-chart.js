new Chart(document.getElementById("dashboard-chart"), {
    type: 'bar',
    data: {
        labels: ["2012", "2013", "2014", "2015", "2016", "2017"],
        datasets: [
            {
                label: "Indeks Pembangunan Inklusif (IPI)",
                type: "line",
                borderColor: '#e74c3c',
                data: [4.60, 4.42, 5.01, 5.24, 5.50, 5.05],
                fill: false
            },
            {
                label: "Indeks Pertumbuhan Ekonomi (IPE)",
                type: "bar",
                backgroundColor: "#654321",
                data: [6.23, 5.40, 4.36, 4.72, 3.68, 3.39]
            }, {
                label: "Indeks Inklusifitas (II)",
                type: "bar",
                backgroundColor: "#27ae60",
                data: [2.59, 4.37, 5.37, 3.86, 7.74, 5.85]
            }, {
                label: "Indeks Keberlanjutan (IK)",
                type: "bar",
                backgroundColor: "#cc8e35",
                data: [4.98, 3.50, 5.30, 7.13, 5.08, 5.90]
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
            xAxes: [{
                time: {
                    unit: 'year'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 10
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
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [5, 5],
                    zeroLineBorderDash: [2],
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
    }
})

new Chart(document.querySelector("#ipi-chart"), {
    type: 'bar',
    data: {
        labels: ["2012", "2013", "2014", "2015", "2016", "2017"],
        datasets: [
            {
                label: "Indeks Pembangunan Ekonomi (IPE)",
                type: "line",
                borderColor: '#654321',
                data: [6.23, 5.40, 4.36, 4.72, 3.68, 3.39],
                fill: false
            },
            {
                label: "Indeks Inflasi (II)",
                type: "bar",
                backgroundColor: "rgb(248, 194, 145)",
                data: [8.86, 6.67, 4.23, 3.89, 3.12, 1.29]
            }, {
                label: "Indeks Aktivitas Ekonomi (IAE)",
                type: "bar",
                backgroundColor: "rgb(241, 196, 15)",
                data: [2.59, 4.37, 5.37, 3.86, 7.74, 5.85]
            }, {
                label: "Indeks Pembangunan Sumberdaya Manusia (IPSDM)",
                type: "bar",
                backgroundColor: "rgb(243, 156, 18)",
                data: [4.98, 3.50, 5.30, 7.13, 5.08, 5.90]
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
            xAxes: [{
                time: {
                    unit: 'year'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 10
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
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
    }
})