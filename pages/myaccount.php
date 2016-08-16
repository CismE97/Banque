<?php include("./includes/myaccountHeader.php");?>
<div class="row account">
    <div class="col-md-12 ">
        <form method="post" action="">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" required>
                    <label for="firstname">Prénom :</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $first_name ?>" required>
                     <label for="email">E-Mail :</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" required>
                </div>
              <div class="form-group">
                <label for="pld_pwd">Ancien mot de passe</label>
                <input type="password" class="form-control" name="pld_pwd" id="pld_pwd" required>
                <label for="pwd">Mot de passe :</label>
                <input type="password" class="form-control" name="pwd" id="pwd">
                <label for="pwd2">Retapez votre mot de passe :</label>
                <input type="password" class="form-control" name="pwd2" id="pwd2">
                <label for="date_naiss">Date de naissance</label>
                <input type="date" class="form-control" name="date_naiss" id="date_naiss" value="<?php echo $birth_date_users ?>" required>
              </div>
                <input type="hidden" value="1" name="register" />
                <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
