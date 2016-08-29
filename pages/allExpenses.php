<?php 
if(!isLogged()){
    echo '<script>document.location.href="./";</script>';
}else{
    $id_cat = null;
    if(isset($_POST['submit'])){
        $search = $_POST['search'];
        $month = $_POST["month"];
        $year = $_POST["year"];
        
        if(isset($_POST["category"])) {
            $id_cat = $_POST['category'];
            $allExpenses = getAllExpenses($search,$id_cat,$month,$year);
        }else{
            $allExpenses = getAllExpenses($search,$month,$year);
        }  
    }else{
        $allExpenses = getAllExpenses(); 
    }
    
?>
<div class="row" style="margin:1%;">
    <div class="col-md-12">
        <h2>Historiques des dépenses : </h2>
    </div>
</div>
<div class="row" style="margin:1%;">
   <form class="form-inline" method="post">
      <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">Description</label>
        <div class="input-group">
          <input type="text" name="search" value="<?php if(isset($search)){echo $search;}?>"class="form-control" id="exampleInputAmount" placeholder="Recherche">
          <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
        </div>
        <div class="input-group">
             <div class="input-group-addon"><span class="glyphicon glyphicon-pushpin"></span></div>
            <select name="category" class="form-control">
                  <option value="0">-- Toutes les catégories -- </option>
                  <?php echo getCategories($id_cat) ?>
            </select>   
        </div>  
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
             <select name="month" class="form-control">
                 <?php
                    for ($m=1; $m<=12; $m++) {
                        if($month == $m){
                            echo '  <option value="' . $m . '"selected>' . date('F', mktime(0,0,0,$m)) . '</option>';
                        }else{
                            echo '  <option value="' . $m . '">' . date('F', mktime(0,0,0,$m)) . '</option>';
                        }     
                    }
                 ?>
            </select>   
        </div>
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
             <select name="year" class="form-control">
                   <?php
                        for ($y=0; $y<=10; $y++){
                            if($year == date("Y",strtotime("-".$y." year"))){
                                echo "<option selected>".date("Y",strtotime("-".$y." year"))."</option>";
                            }else{
                                echo "<option>".date("Y",strtotime("-".$y." year"))."</option>";
                            }
                            
                        }
                    ?>
            </select>   
        </div>
      </div>
      <button name="submit" type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>

<div class="row" style="margin:1%;">
    <div class="col-md-12">
        <table class="table" >
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Catégorie</th> 
                    <th>Date</th>
                    <th>Somme</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $allExpenses; ?> 
            </tbody>
        </table>
    </div>
</div>
<?php }?>