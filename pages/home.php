<?php
if(isset($_POST['register'])){
   register();
}elseif(isset($_POST['login'])){
    login();
}
?>

<div class="home">
<div class="text-vertical-center home-content">
        <h1>MyFinance</h1>
        <hr>
        <h3>L'application pour gérer son argent !</h3>
        <br>
        <a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#ModalLogin">Se connecter</a>
        <a href="#" class="btn btn-info" role="button" data-toggle="modal" data-target="#ModalRegister">S'inscrire</a>
</div>
</div>

 <?php include("./includes/modalLogin.php");?>
<?php include("./includes/modalRegister.php");?> 