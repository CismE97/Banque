<?php 
function login_bd(){
    try{
	   $bdd = new PDO('mysql:host=localhost;dbname=myfinance;charset=utf8', 'root', '');
    }catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    
    return $bdd;
}

function isLogged(){
    if(isset($_SESSION['logged'])){
        return true;
    }else{
        return false;
    }
}

function login($email,$pwd,$login_auto=false){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `id_users`, `name_users`,`first_name_users`, `email_users`, `mdp_users` FROM users WHERE `email_users`=?");
    $req->execute(array($email));
    
    while ($donnees = $req->fetch()){
	   $id = $donnees['id_users'];
       $name = $donnees['name_users'];
       $firstname = $donnees['first_name_users'];
       $email_BD = $donnees['email_users'];
       $mdp_BD = $donnees['mdp_users'];
    }
    
    if(isset($email_BD)){
        if($email_BD == $email && $mdp_BD==$pwd){
            $_SESSION['logged'] = true;
            $_SESSION['logged_id'] = $id;
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}


function register(){
    die();
}




?>