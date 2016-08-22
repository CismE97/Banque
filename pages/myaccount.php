<?php 
    if(isset($_POST["name"]) && $_POST["name"] != "" && isset($_POST["firstname"]) && $_POST["firstname"] != "" && isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["old_pwd"]) && $_POST["old_pwd"] != "" && isset($_POST["date_naiss"]) && $_POST["date_naiss"] != "") {
        if($_POST["pwd"]==$_POST["pwd"] && $_POST["pwd"]!=""){
            $result = updateUser($_POST["name"],$_POST["firstname"],$_POST["email"],$_POST["old_pwd"],$_POST["date_naiss"],$_POST["pwd"],$_POST['pwd2']); 
        }else{
            $result =  updateUser($_POST["name"],$_POST["firstname"],$_POST["email"],$_POST["old_pwd"],$_POST["date_naiss"]);
        }  
    }
?>
<?php include("./includes/myaccountHeader.php");?>
<div class="row account">
    <div class="col-md-12 ">
        <?php if(isset($result)){ ?>
            <?php if(substr($result, 0, 2)=='OK'){?>
                <div class="alert alert-success">
                    <p><?php echo substr($result, 3);?></p>
                </div>
            <?php }else{ ?>
                <div class="alert alert-danger">
                    <p><?php echo substr($result, 3);?></p>
                </div>
            <?php } 
        }?>
        <form method="post" action="">
                <div class="form-group">
                    <label for="name">Nom : *</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" required>
                    <label for="firstname">Prénom : *</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $first_name ?>" required>
                     <label for="email">E-Mail : *</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" required readonly="readonly">
                </div>
              <div class="form-group">
                <label for="old_pwd">Ancien mot de passe : *</label>
                <input type="password" class="form-control" name="old_pwd" id="old_pwd" required>
                <label for="pwd">Mot de passe :</label>
                <input type="password" class="form-control" name="pwd" id="pwd" readonly="readonly">
                <label for="pwd2">Retapez votre mot de passe :</label>
                <input type="password" class="form-control" name="pwd2" id="pwd2" readonly="readonly">
                <label for="date_naiss">Date de naissance : *</label>
                <input type="date" class="form-control" name="date_naiss" id="date_naiss" value="<?php echo $birth_date_users ?>" required>
              </div>
               <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
