<?php 
if(!isLogged()){
    echo '<script>document.location.href="./";</script>';
}else{
    if(isset($_POST['addExpense'])){
       addExpenses($_POST['description'], $_POST['category'], $_POST['date'], $_POST['price']);
    }
    $data = getDataUser($_SESSION['logged_id']);
    $first_name = $data[1];
    $name = $data[0];
?>


<div class="row" style="margin:1%;">
<div class="col-md-11">
    <h2>Dashboard de <?php echo $first_name.' '.$name ?></h2>
</div>
<div class="col-md-1">
    <button type="button" id="add" class="btn btn-default btn-lg" data-toggle="modal" data-target="#ModalAddExpense">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
</div>
</div>

<div class="row">
<div class="col-md-4">
    <h3>Consommation : <?php echo  utf8_encode(strftime("%B %Y")); ?></h3>
    <p hidden id="hiddenID"><?php echo $_SESSION['logged_id'];?></p>
    <canvas id="lineChart" width="400" height="400"></canvas>
   
 </div>
<div class="col-md-8">
    <h3>Dernières dépenses : <?php echo  utf8_encode(strftime("%B %Y")); ?></h3>
    <table class="table" >
        <thead>
            <tr>
                <th>Description</th>
                <th>Catégorie</th> 
                <th>Date</th>
                <th>Somme</th>
            </tr>
        </thead>
    <tbody>
         <?php echo getLastExpenses();?> 
    </tbody>
    </table>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <a href="<?php echo BASE_URL?>./expenses" class="btn btn-primary" role="button">Voir plus...</a>
        </div>
    </div>
</div>
<div class="row" style="margin-top:10px;">
    <div class="col-md-12"><hr></div>
</div>
<div class="row" style="margin:1%;">
<div class="col-md-6 number">
    <h3>Somme restante : </h3>
    <p><?php echo getCurrencyAbridged();?> <?php echo round(getBudget()-getTotalExpenses(),2);?></p>
</div>
<div class="col-md-6 number">
    <h3>Somme dépensée : </h3>
    <p><?php echo getCurrencyAbridged();?> <?php echo round(getTotalExpenses(),2);?></p>
</div>
    
 <?php include("./includes/modalAddExpense.php");?>
<?php }?>

 