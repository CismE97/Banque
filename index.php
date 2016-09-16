<?php session_start(); 
    include('./includes/config.php');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyFinance</title>
    <link href="<?php echo BASE_URL?>./bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL?>./style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>./animate.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  </head>
  <body>
     <?php include("./includes/functions.php");?>
    <?php include("./includes/header.php");?>
    <?php if(!isset($_GET["page"])){    
        include("pages/home.php"); 
    }else{?> 
      <section id="main-content" class="container">
        <div class="row">
            <div class="col-xs-12">     
            <?php
            if(isset($_GET["spage"])){
                if($_GET["spage"] == 'settings'){
                   include("pages/myaccountSettings.php");
                    
                }elseif($_GET["page"] == 'delExpense' && is_numeric($_GET["spage"])){
                    include("pages/delExpense.php");
                }
                
            }else{
                if(isset($_GET["page"])) {
                  switch ($_GET['page']) {
                    case "home":
                    include("pages/home.php");
                    break;
                    case "dashboard":
                    include("pages/dashboard.php");
                    break;
                    case "myaccount":
                    include("pages/myaccount.php");
                    break;
                    case "expenses":
                    include("pages/allExpenses.php");
                    break;
                    case "budget":
                    include("pages/budget.php");
                    break;
                    case "logout":
                    include("pages/logout.php");
                    break;
                    default:
                    include("pages/404.php");
                    break;
                  }
                }
            }?>
      </div>
    </div>
   
  </section> 
  <?php include("./includes/footer.php");?> <?php }?>   
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL?>./bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>
    <script src="<?php echo BASE_URL?>./js/main.js"></script>
    <script src="<?php echo BASE_URL?>./js/viewportchecker.js"></script>
    <script>
     
      
      
    </script>
     <!--<script src="./js/viewportchecker.js"></script>-->
    <!--<script src="./js/scripts.js"></script>-->
  </body>
</html>