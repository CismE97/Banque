<?php 
    if(isset($_POST['currency'])){
        $selected_val = $_POST['currency'];
        if(isset($_POST["budget"])) {
              $result =  updateUserSettings($_POST["budget"],$selected_val);
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
        <form method="post" class="form-horizontal" action="">
            <div class="form-group">   
                <label class="control-label col-sm-3" for="budget">Budget mensuel :</label>
                <div class="input-group col-md-9 ">
                    <span class="input-group-addon"><?php echo getCurrencyAbridged();?></span>
                    <input type="number" class="form-control col-sm-10" name="budget" id="budget" value="<?php echo getBudget();?>" required readonly="readonly">
                </div>
            </div>

            <div class="form-group">
                  <label for="currency" class="control-label col-sm-3">Devise :</label>
                  <div class="input-group col-md-9 ">
                          <span class="input-group-addon"><?php echo getCurrencyAbridged();?></span>
                          <select class="form-control" name="currency">
                            <?php echo getAllCurrencies();?>
                          </select>     
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>


