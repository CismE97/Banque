<?php 
function login_bd(){
    try{
	   $bdd = new PDO('mysql:host=localhost;port=8888;dbname=myfinance;charset=utf8', 'root', 'root');
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
        if($email_BD == $email && password_verify($pwd, $mdp_BD)){
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

function register($name,$firstname,$email,$pwd,$pwd2,$date_naiss){
    if($pwd == $pwd2){
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $bdd = login_bd();
        $req = $bdd->prepare('INSERT INTO users(name_users, first_name_users, email_users, mdp_users, birth_date_users, registration_date_users) VALUES(:name, :first_name, :email, :pwd, :birth_date, :registration_date)');
        $req->execute(array(
        'name' => $name,
        'first_name' => $firstname,
        'email' => $email,
        'pwd' => $pwd,
        'birth_date' => $date_naiss,
        'registration_date' => date("Y-m-d")
	));
    return true;
    }else{
        return false;
    }
}

/*
- Fonction getLastExpenses
- Retourne les 10 dernières dépenses
*/
function getLastExpenses(){
   $bdd = login_bd();
   
   $first_day = date('Y-m-d', strtotime('first day of this month'));
   $last_day = date('Y-m-d', strtotime('last day of this month'));
    
   $req = $bdd->prepare("SELECT e.`id_spe`, e.`description_spe`, e.`date_spe`, e.`price_spe`, c.`name_cat` FROM expenses e INNER JOIN category c ON c.`id_cat` = e.`cat_spe` WHERE e.`fk_user_spe` = ? and  e.`date_spe` between ? and ? ORDER BY  e.`date_spe` DESC LIMIT 10");
   $req->execute(array($_SESSION['logged_id'],$first_day,$last_day));
  
   $table = "";
    while ($donnees = $req->fetch()){
       $table.="<tr><td>".$donnees['description_spe']."</td><td>".$donnees['name_cat']."</td><td>".date("d/m/Y", strtotime($donnees['date_spe']))."</td><td>".getCurrencyAbridged()." ".$donnees['price_spe']."</td><td>
       <a href='#'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></a></span>
       <a href='#' onclick='confirmDelete(".$donnees['id_spe'].")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></a></span></td></tr>";    
    }
    return $table;
}

/*
- Fonction getTotalExpenses
- Retourne le total dépensé pour le mois en cours
*/
function getTotalExpenses(){
    $bdd = login_bd();
   
    $first_day = date('Y-m-d', strtotime('first day of this month'));
    $last_day = date('Y-m-d', strtotime('last day of this month'));
    
    
    $req = $bdd->prepare("SELECT SUM(e.`price_spe`) somme FROM expenses e  WHERE e.`fk_user_spe` = ? and  e.`date_spe` between ? and ?");
    $req->execute(array($_SESSION['logged_id'],$first_day,$last_day));  
   
    while ($donnees = $req->fetch()){
       $total = $donnees['somme'];
    
    }
    return $total;  
}

function addExpenses($description,$category,$date,$price){
    $bdd = login_bd();
    $req = $bdd->prepare('INSERT INTO expenses(`fk_user_spe`, `date_spe`, `description_spe`, `price_spe`, `cat_spe`) VALUES(:user, :date, :description, :price, :category)');
    $req->execute(array(
	'user' => $_SESSION['logged_id'],
	'date' => $date,
	'description' => $description,
	'price' => $price,
	'category' => $category
	));
}

function getDataUser($id){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `name_users`,`first_name_users`, `email_users`, `mdp_users`,`birth_date_users`, `registration_date_users` FROM users WHERE `id_users`=?");
    $req->execute(array($id));
    
    $data = array();
    while ($donnees = $req->fetch()){
       array_push($data, $donnees['name_users'], $donnees['first_name_users'],$donnees['email_users'],$donnees['mdp_users'], $donnees['birth_date_users'], $donnees['registration_date_users']);
    }
    return $data; 
}

function updateUser($name,$firstname,$email,$old_pwd,$date_naiss,$pwd = null,$pwd2 = null){    
    //Get old password
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `mdp_users` FROM users WHERE `id_users`=?");
    $req->execute(array($_SESSION['logged_id']));
    while ($donnees = $req->fetch()){
       $old_mdp_DB = $donnees['mdp_users'];
    }
    
    //IF same password
    if(password_verify($old_pwd,$old_mdp_DB)){
        if(isset($pwd)){
            if($pwd == $pwd2){
                $bdd = login_bd();
                $req = $bdd->prepare('UPDATE users SET name_users = :name_users, first_name_users = :firstname, email_users = :email, birth_date_users = :date_naiss, mdp_users = :pwd WHERE id_users = :id');
                $req->execute(array(
                'name_users' => $name,
                'firstname' => $firstname,
                'email' => $email,
                'date_naiss' => $date_naiss,
                'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
                'id' => $_SESSION['logged_id']
            ));
                return 'OK-Modification effectuée avec succès !';  
            }else{
                $erreur = "ER-Les deux mots de passe ne sont pas identiques!"; 
                return $erreur;
            }
        }else{
            $bdd = login_bd();
            $req = $bdd->prepare('UPDATE users SET name_users = :name_users, first_name_users = :firstname, email_users = :email, birth_date_users = :date_naiss WHERE id_users = :id');
            $req->execute(array(
                'name_users' => $name,
                'firstname' => $firstname,
                'email' => $email,
                'date_naiss' => $date_naiss,
                'id' => $_SESSION['logged_id']
            ));
            return 'OK-Modification effectuée avec succès !';
        }
    }else{
        $erreur = "ER-Mot de passe incorrect !"; 
        return $erreur;
    }  
}

function getCurrency(){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT c.`name_curr`, c.`abridged_curr` FROM users u INNER JOIN currencies c ON c.`id_cat` = u.`currency_user` WHERE u.`id_users` = ?");
    $req->execute(array($_SESSION['logged_id'])); 
    while ($donnees = $req->fetch()){
       $name_curr = $donnees['name_curr']; 
    }
    return $name_curr;
}

function getCurrencyAbridged(){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT c.`name_curr`, c.`abridged_curr` FROM users u INNER JOIN currencies c ON c.`id_curr` = u.`currency_user` WHERE u.`id_users` = ?");
    $req->execute(array($_SESSION['logged_id'])); 
    while ($donnees = $req->fetch()){
       $abridged_curr = $donnees['abridged_curr'];
    }
    return $abridged_curr;
}

function getAllCurrencies(){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `name_curr`, `id_curr` FROM currencies");
    $req->execute(array()); 
    $result = "";
    while ($donnees = $req->fetch()){
        if(getCurrency()== $donnees['name_curr']){
           $result .= "<option value='".$donnees['id_curr']."' selected='selected'>".$donnees['name_curr']."</option>"; 
        }else{
            $result .= "<option value='".$donnees['id_curr']."'>".$donnees['name_curr']."</option>";  
        }
    }
    return $result;
}

function updateUserSettings($budget,$currency){
  if($budget >= 0 && is_numeric($budget)){
        $bdd = login_bd();
        $req = $bdd->prepare('UPDATE users SET budget_user = :budget_user, currency_user = :currency WHERE id_users = :id');
            $req->execute(array(
                'budget_user' => $budget,
                'currency' => $currency,
                'id' => $_SESSION['logged_id']
            ));
      return 'OK-Modification effectuée avec succès !';   
  }else{
      return "ER-Budget invalide !";
  }
}

function getCategories($id_cat=null){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `name_cat`, `id_cat` FROM category");
    $req->execute(array()); 
    $result = "";
    while ($donnees = $req->fetch()){
        if(isset($id_cat)){
            if($id_cat == $donnees['id_cat']){
                $result .= "<option value='".$donnees['id_cat']."' selected='selected'>".$donnees['name_cat']."</option>"; 
            }else{
                $result .= "<option value='".$donnees['id_cat']."'>".$donnees['name_cat']."</option>";  
            }
        }else{
            $result .= "<option value='".$donnees['id_cat']."'>".$donnees['name_cat']."</option>";
        }
    }
    return $result;
}

function getAllExpenses($search = null,$id_cat = null,$month = null, $year = null){
    if(!isset($search)){
        $search = '%';
    }
    if($id_cat==0){
      $id_cat = '%';
    }
    
    $bdd = login_bd();
    $req = $bdd->prepare("
            SELECT e.`id_spe`, e.`description_spe`, e.`date_spe`, e.`price_spe`, c.`name_cat` 
            FROM expenses e 
            INNER JOIN category c 
            ON c.`id_cat` = e.`cat_spe` 
            WHERE e.`fk_user_spe` = ? and c.`id_cat` LIKE ? and  e.`date_spe` between ? and ? and e.`description_spe` LIKE ?
            ORDER BY  e.`date_spe` DESC");
    
    if(isset($month) && isset($year)){
        $first_day = new DateTime($year.'-'.$month.'-19');
        $first_day->modify('first day of this month');
        $last_day = new DateTime($year.'-'.$month.'-19');
        $last_day->modify('last day of this month');
        $req->execute(array($_SESSION['logged_id'],$id_cat, $first_day->format('Y-m-d'),$last_day->format('Y-m-d'),'%'.$search.'%'));
    }else{
        $first_day = date('Y-m-d', strtotime('first day of this month'));
        $last_day = date('Y-m-d', strtotime('last day of this month'));
        $req->execute(array($_SESSION['logged_id'],$id_cat, $first_day,$last_day,'%'.$search.'%'));
    }
    
    
    $table = "";
    if($req->rowCount()>0){
        while ($donnees = $req->fetch()){
           $table.="<tr><td>".$donnees['description_spe']."</td><td>".$donnees['name_cat']."</td><td>".date("d/m/Y", strtotime($donnees['date_spe']))."</td><td>".getCurrencyAbridged()." ".$donnees['price_spe']."</td><td>
           <a href='#'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></a></span>
           <a href='#' onclick='confirmDelete(".$donnees['id_spe'].")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></a></span></td></tr>";     
        }  
    }else{
        $table.="<tr><td>Aucun résultat</td></tr>";
    }   
    return $table;   
}

function  delExpense($id){
    $bdd = login_bd();
    $req = $bdd->prepare('DELETE FROM expenses WHERE id_spe=:id');
    $req->execute(array(
    'id' => $id
    ));
}
/* ------------- BUDGET -----------------------*/
function add_budget($type,$input_desc,$input_value){
    $bdd = login_bd();
    $req = $bdd->prepare('INSERT INTO budget(`fk_user_bud`, `type_bud`, `desc_bud`, `price_bud`) VALUES(:user, :type, :description, :price)');
    $req->execute(array(
	'user' => $_SESSION['logged_id'],
	'type' => $type,
	'description' => $input_desc,
	'price' => $input_value
	));
}

function get_all_budget($type){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT `desc_bud`, `price_bud` FROM budget WHERE `type_bud` =  ? AND `fk_user_bud` = ? ");
    $req->execute(array($type, $_SESSION['logged_id'])); 
    
    $data = "";
    while ($donnees = $req->fetch()){
        $desc = $donnees['desc_bud'];
        $price = $donnees['price_bud'];
        
        $data .= "<tr><td>".$desc."</td><td>".getCurrencyAbridged()." ".$price."</td></tr>";
    }
    return $data;
}

function get_money_left(){
    $input = getBudget();
    
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT SUM(`price_bud`) total_output FROM budget WHERE `type_bud` =  ? AND `fk_user_bud` = ?");
    $req->execute(array("output", $_SESSION['logged_id'])); 
    
    while ($donnees = $req->fetch()){
       $output = $donnees['total_output'];
    }
    return $input - $output; 
}

function getBudget(){
    $bdd = login_bd();
    $req = $bdd->prepare("SELECT SUM(`price_bud`) total_input FROM budget WHERE `type_bud` =  ? AND `fk_user_bud` = ?");
    $req->execute(array("input", $_SESSION['logged_id'])); 
    
    while ($donnees = $req->fetch()){
       $input = $donnees['total_input'];
    }
    return $input;
}
?>