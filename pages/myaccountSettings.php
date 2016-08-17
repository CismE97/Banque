<?php include("./includes/myaccountHeader.php");?>
<div class="row account">
    <div class="col-md-12 ">
        <form method="post" class="form-horizontal" action="">
            <div class="form-group">   
                <label class="control-label col-sm-3" for="name">Budget mensuel :</label>
                <div class="input-group col-md-9 ">
                    <span class="input-group-addon">CHF</span>
                    <input type="number" class="form-control col-sm-10" name="name" id="name" value="" required>
                </div>
            </div>

            <div class="form-group">
                  <label for="currency" class="control-label col-sm-3">Devise :</label>
                  <div class="input-group col-md-9 ">
                          <span class="input-group-addon">CHF</span>
                          <select class="form-control" id="currency">
                            <option>Franc Suisse </option>
                            <option>Euro </option>
                            <option>Dollar</option>
                            <option>Livre Sterling</option>
                         </select>     
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>