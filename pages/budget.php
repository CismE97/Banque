<?php 
if(!isLogged()){
    echo '<script>document.location.href="./";</script>';
}else{ 
    if(isset($_POST["input_desc"]) && isset($_POST["input_value"])){
        $input_desc = $_POST["input_desc"];
        $input_value = $_POST["input_value"];
        for($i = 0; $i < count($input_desc); $i++){
            add_budget("input", $input_desc[$i], $input_value[$i]);  
        }   
    }
    
    if(isset($_POST["output_desc"]) && isset($_POST["output_value"])){
        $output_desc = $_POST["output_desc"];
        $output_value = $_POST["output_value"];
        for($i = 0; $i < count($output_desc); $i++){
            add_budget("output", $output_desc[$i], $output_value[$i]);  
        }   
    }
    
    $input_data = get_all_budget("input");
    $output_data = get_all_budget("output");
    $money_left = get_money_left();
?>
<div class="row" style="margin:1%;">
    <div class="col-md-12">
        <h2>Gestion du budget : </h2>
    </div>
    <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
            <p><strong>Informations : </strong> Cet utilitaire vous permettra de concevoir votre budget. Ce n’est pas ici que vous devez inscrire vos dépenses, mais il vous permet d’avoir une idée globale de vos futures dépenses. (en général un budget se fait annuellement). 
            </p>
            <p>
            Le budget que vous retrouvez dans le dashboard est calculé avec la somme des entrées d'argent.     
            </p>
        </div>
    </div>
</div>
<form class="budget" method="post" action="">
    <div class="row" style="margin:1%;">
        <!-- Entrée d'argent-->
        <div class="col-md-6">
            <table id="cash_input"class="table">
                <thead class="table_plus">
                    <tr>
                        <th>ENTREE D'ARGENT</th>
                        <th colspan="2" style="text-align: right;"><button type="button" id="cash_input_button" class="btn btn-secondary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $input_data ?>
                </tbody>
            </table> 
        </div>
        <!-- Sortie d'argent-->
        <div class="col-md-6">
            <table id="cash_left" class="table">
                <thead class="table_rest">
                    <tr>
                        <th colspan="2">ARGENT RESTANT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Revenus après dépenses</td>
                        <td><?php echo getCurrencyAbridged().' '.$money_left ?></td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
    <div class="row" style="margin:1%;">
        <!-- Sortie d'argent-->
        <div class="col-md-6">
            <table id="cash_output" class="table">
                <thead class="table_minus">
                    <tr>
                        <th>SORTIES D'ARGENT</th>
                        <th colspan="2" style="text-align: right;"><button type="button" id="cash_output_button" class="btn btn-secondary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $output_data ?>
                </tbody>
            </table> 
        </div>
        <div class="col-md-6">
            <p hidden id="hiddenID"><?php echo $_SESSION['logged_id'];?></p>
            <canvas id="lineChartBudget"></canvas>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
<?php }?>