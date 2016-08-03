<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyFinance</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
  </head>
  <body>
    <?php include("./includes/header.php");?>
    <?php if(!isset($_GET["page"])){    
        include("pages/home.php"); 
    }else{?> 
      <section id="main-content" class="container">
        <div class="row">
            <div class="col-xs-12">     
            <?php
            if(isset($_GET["page"])) {
              switch ($_GET['page']) {
                default:
                include("pages/404.php");
                break;
              }
            }?>
      </div>
    </div>
  </section><?php }?>
      
      <?php include("./includes/footer.php");?>    
    
      
      
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!--<script src="./js/viewportchecker.js"></script>-->
    <!--<script src="./js/scripts.js"></script>-->
  </body>
</html>