<!-- Modal Login -->
<?php
$bdd = login_bd();
    
$req = $bdd->prepare("SELECT `id_cat`, `name_cat` FROM  category");
$req->execute(array());
?>
<div id="ModalAddExpense" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Ajouter une dépense</h4>
      </div>
        <form method="post" action="">
        <div class="modal-body">
                <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
            <div class="form-group">
                    <label for="category">Catégorie :</label>
                    <select class="form-control" name="category" id="category" required>
                    <?php
                    // Loop through the query results, outputing the options one by one
                     while ($donnees = $req->fetch()){
                        echo '<option value="'.$donnees['id_cat'].'">'.$donnees['name_cat'].'</option>';
                    }?>
                    </select>
                    
                </div>
              <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" class="form-control" id="date" name="date" required>  
              </div>
            <div class="form-group">
                    <label for="price">Somme : (CHF)</label>
                   <input type="number" class="form-control" id="price" name="price" min="1" step="0.01" required>
                    <input type="hidden" value="1" name="addExpense" />
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
        </form>
    </div>

  </div>
</div>