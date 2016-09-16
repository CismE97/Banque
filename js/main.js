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
                            "#27ae60",
                            "#c0392b",
                            "#f39c12",
                            "#f1c40f",
                            "#16a085",
                            "#3498db",
                            "#F37934"
                        ],
                        hoverBackgroundColor: [
                            "#27ae60",
                            "#c0392b",
                            "#f39c12",
                            "#f1c40f",
                            "#16a085",
                            "#3498db",
                            "#F37934"
                        ]
                    }]
            }});
    }
});

$( function() {
    $( ".datepicker" ).datepicker();
    $( ".datepicker" ).datepicker( "option", "dateFormat","yy-mm-dd" );
  } );




function confirmDelete(id) {
     var r = confirm("Voulez-vous vraiement supprimer cet enregistrement ?");
     if (r == true) {
         var URL = "./delExpense/"+id;
         document.location.href= URL;
     }
}

function confirmDeleteBud(id){
    var r = confirm("Voulez-vous vraiement supprimer cet enregistrement ?");
     if (r == true) {
         var URL = "./delLineBudget/"+id;
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
$(document).ready(function() {
    $('.img-home').addClass("hidden2").viewportChecker({
            classToAdd: 'visible animated flipInX', // Class to add to the elements when they are visible
            offset: 100   
    }); 
    $('.img-home').removeClass("hidden2");
});


/*Ajout ligne budget*/
$( "#cash_input_button" ).click(function() {
  $('#cash_input > tbody:last-child').append('<tr><td><input type="text" name="input_desc[]"></td><td><input type="number" name="input_value[]"></td></tr>');
});

$( "#cash_output_button" ).click(function() {
    $('#cash_output > tbody:last-child').append('<tr><td><input type="text" name="output_desc[]"></td><td><input type="number" name="output_value[]"></td></tr>');
});




