<?php
if(isset($_POST['register'])){
 register($_POST['name'],$_POST['firstname'],$_POST['email'],$_POST['pwd'],$_POST['pwd2'],$_POST['date_naiss']);
}elseif(isset($_POST['login'])){
    if(isset($_POST['login_auto'])){
        login($_POST['email'],$_POST['pwd'],$_POST['login_auto']);
    }else{
        if(login($_POST['email'],$_POST['pwd'])){
             header('Location: ./dashboard'); 
        }else{
            echo 'false';
            die();
        }
    }
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