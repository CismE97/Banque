<?php
ob_start();
if(isset($_POST['register'])){
 register($_POST['name'],$_POST['firstname'],$_POST['email'],$_POST['pwd'],$_POST['pwd2'],$_POST['date_naiss']);
}elseif(isset($_POST['login'])){
    if(isset($_POST['login_auto'])){
        login($_POST['email'],$_POST['pwd'],$_POST['login_auto']);
    }else{
        if(login($_POST['email'],$_POST['pwd'])){
            echo '<script>document.location.href="./dashboard";</script>';
            exit();
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
        <div class="getMore">
            <a class="js-scrollTo btn btn-info" href="#more">
                En savoir plus <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </a>
        </div>
</div>
</div>
<div style="background-color:#E7E7E9;">
<section id="main-content" class="container">
    <div id="more">
        <div class="row">
            <div class="col-md-6">
                <p><img class="img-responsive phone"src="./img/phone.png"/></p>
            </div>
            <div class="col-md-6">
                <h3>Gérez vos finances facilement</h3>
                <ul>
                    <li>Toutes vos dépenses à un seul endroit.</li>
                    <li>Plannifez vos dépenses facilement grâce à l'historique de vos dépenses.</li>
                    <li>Une vue direct sur votre solde restant.</li>
                    <li>Une visibilité instantanée sur vos dépenses grâce aux analyses graphiques</li>
                </ul>
            </div>
        </div>
    </div>
</section>
</div>
<section id="main-content" class="container">
    <div id="more">
        <div class="row vertical-align">
            <div class="col-md-6">
                <h3>Un suivi sur tous vos appareils</h3>
                <ul>
                    <li>MyFinance est un site internet totalement responsive.</li>
                    <li>Utilisez donc votre gestionnaire de finances sur votre ordinateur, tablette et smartphone !</li>
                    <li>Une application smartphone et tablette est en cours de développement.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <p><img class="img-responsive"src="./img/devices.jpg"/></p>
            </div>
        </div>
    </div>
</section>



<?php include("./includes/footer.php")?>
<?php include("./includes/modalLogin.php");?>
<?php include("./includes/modalRegister.php");?> 