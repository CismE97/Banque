$.ajax({
    url: './includes/getDataChart.php',
    type: 'post',
    data: { "callFunc1": $('#hiddenID').text()},
    success: function(response) { 
        var phpData = JSON.parse(response);
        var labels_name = phpData.pop();
        
        const CHART = document.getElementById("lineChart");
        Chart.defaults.global.legend.position = 'bottom';
        
            var lineChart = new Chart (CHART, {
                type: 'doughnut',
                data: data = {
                labels: labels_name,
                datasets: [
                    {
                        data: phpData,
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
    }
});




