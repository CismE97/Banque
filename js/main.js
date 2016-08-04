const CHART = document.getElementById("lineChart");
Chart.defaults.global.legend.position = 'bottom';
let lineChart = new Chart (CHART, {
    type: 'doughnut',
    data: data = {
    labels: [
        "Nourriture",
        "Factures",
        "Loisirs"
    ],
    datasets: [
        {
            data: [300, 50, 100],
            backgroundColor: [
                "#F37934",
                "#c0392b",
                "#f39c12"
            ],
            hoverBackgroundColor: [
                "#F37934",
                "#c0392b",
                "#f39c12"
            ]
        }]
}});


