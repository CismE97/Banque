<?php 
if(!isLogged()){
   header('Location: ./'); 
}else{
     $data = getDataUser($_SESSION['logged_id']);
     $first_name = $data[1];
     $name = $data[0];
     $email = $data[2];
     $mdp = $data[3];
     $birth_date_users = $data[4];
     $registration_date = date("d/m/Y", strtotime($data[5]));
}
?>

<div class="row account">
    <div class="col-md-3">
        <img src="<?php echo BASE_URL?>./img/default_user.png" alt="default" class="img-rounded">
    </div>
    <div class="col-md-5">
        <h2><?php echo $first_name.' '.$name; ?></h2>
        <p><?php echo $email; ?></p>
    </div>
    <div class="col-md-4">
        <p class="register_date">Date d'inscription : <?php echo $registration_date; ?></p>
        <p class="budget">Budget :  <?php echo getCurrencyAbridged();?> <?php echo getBudget();?></p>
    </div>
</div>
<div class="row">
    <div class="col-md-12 navbar_account">
        <div class="row vdivide">
            <div class="col-sm-2 text-center"><p><a href="<?php echo BASE_URL?>./myaccount">Profil</a></p></div>
            <div class="col-sm-2 text-center"><p><a href="<?php echo BASE_URL?>./myaccount/settings">Paramètres</a></p></div>
        </div>
    </div>
</div>