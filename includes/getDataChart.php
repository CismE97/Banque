<?php
/*
- Fonction getDataChart
- Retourne les données pour le graphique
*/
if (isset($_POST['callFunc1'])) {
        echo getDataChart($_POST['callFunc1']);
}

function getDataChart($id_user){
    //Calcul des dépenses par catégorie :
    $first_day = date('Y-m-d', strtotime('first day of this month'));
    $last_day = date('Y-m-d', strtotime('last day of this month')); 
    
    $data = array();
    try{
	   $bdd = new PDO('mysql:host=localhost;dbname=myfinance;charset=utf8', 'root', '');
    }catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    
    //Get category : 
    $req = $bdd->prepare("SELECT `id_cat`, `name_cat` FROM `category`");
    $req->execute();
    
    $total_cat = array();
    $names_cat = array();
    
    while ($donnees = $req->fetch()){
	   $id_cat = round($donnees['id_cat'],2);
	   $name_cat = $donnees['name_cat'];
       array_push($total_cat,$id_cat);
       array_push($names_cat,$name_cat);
    }
    
    //Get total
    foreach($total_cat as $cat){
        $req = $bdd->prepare("SELECT SUM(`price_spe`) total_cat FROM `expenses` WHERE `cat_spe` = ? and `fk_user_spe` = ? and  `date_spe` between ? and ?");
        $req->execute(array($cat,$id_user,$first_day,$last_day));

        while ($donnees = $req->fetch()){
           $total_price_cat = round($donnees['total_cat'],2);
           array_push($data,$total_price_cat);
        }
    } 
    
    array_push($data,$names_cat);
    
    
    //Envoi des données au JS*/
    return json_encode($data);  
}
?>