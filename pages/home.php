<?php
ob_start();
if(isset($_POST['register'])){
    if(register($_POST['name'],$_POST['firstname'],$_POST['email'],$_POST['pwd'],$_POST['pwd2'],$_POST['date_naiss'])){
        $result = "<div class='alert alert-success'>
                            <p><strong>Vous pouvez vous connecter !</strong></p>
                        </div>";
    }else{
        $result = "<div class='alert alert-danger'>
                            <p><strong>Inscription impossible ! </strong> Les deux mots de passes ne sont pas identiques </p>
                        </div>";
    }
}elseif(isset($_POST['login'])){
    if(isset($_POST['login_auto'])){
        login($_POST['email'],$_POST['pwd'],$_POST['login_auto']);
    }else{
        if(login($_POST['email'],$_POST['pwd'])){
            echo '<script>document.location.href="./dashboard";</script>';
            exit();
        }else{
            $result = "<div class='alert alert-danger'>
                            <p><strong>Connexion impossible ! </strong> Mot de passe ou adresse e-mail incorrect </p>
                        </div>";
        }
    }
}
?>
<div class="home">
<div class="text-vertical-center home-content">
        <div class="form-group">
            <div class="col-sm-12">
                <?php if(isset($result)){echo $result;} ?> 
            </div>
        </div>
    
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
                <h3>Gérez vos finances facilement</h3>
                <ul>
                    <li>Toutes vos dépenses à un seul endroit.</li>
                    <li>Plannifez vos dépenses facilement grâce à l'historique de vos dépenses.</li>
                    <li>Une vue direct sur votre solde restant.</li>
                    <li>Une visibilité instantanée sur vos dépenses grâce aux analyses graphiques</li>
                </ul>
            </div>
            <div class="col-md-6">
                <p><img class="img-responsive phone img-home "src="./img/phone.png"/></p>
            </div>
        </div>
    </div>
</section>
</div>
<div>
<section id="main-content" class="container">
    <div id="more">
        <div class="row">
            <div class="col-md-6">
                <h3>Un suivi sur tous vos appareils</h3>
                <ul>
                    <li>MyFinance est un site internet totalement responsive.</li>
                    <li>Utilisez donc votre gestionnaire de finances sur votre ordinateur, tablette et smartphone !</li>
                    <li>Une application smartphone et tablette est en cours de développement.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <p><img class="img-responsive img-home"src="./img/devices.jpg"/></p>
            </div>
        </div>
    </div>
</section>
</div>
<?php include("./includes/footer.php")?>
<?php include("./includes/modalLogin.php");?>
<?php include("./includes/modalRegister.php");?> 