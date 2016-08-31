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
                            "#f39c12",
                            "#f1c40f",
                            "#16a085",
                            "#3498db",
                            "#27ae60"
                        ],
                        hoverBackgroundColor: [
                            "#F37934",
                            "#c0392b",
                            "#f39c12",
                            "#f1c40f",
                            "#16a085",
                            "#3498db",
                            "#27ae60"
                        ]
                    }]
            }});
    }
});

 function confirmDelete(id) {
     var r = confirm("Voulez-vous vraiement supprimer cet enregistrement ?");
     if (r == true) {
         var URL = "./delExpense/"+id;
         document.location.href= URL;
     }
    }


$(document).ready(function(){
   $('.js-scrollTo').on('click',function (){
       var page = $(this).attr('href');
       var speed = 750;
       $('html, body').animate({scrollTop : $(page).offset().top - 70}, speed);
       return false;
   }); 
});




