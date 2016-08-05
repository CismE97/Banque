<header>
<?php setlocale (LC_TIME, 'fr_FR.utf8','fra');?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./dashboard">MyFinance</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <?php if(!isLogged()){ ?> 
            <li><a href="#" data-toggle="modal" data-target="#ModalLogin">Se connecter</a></li>
            <li><a href="#" data-toggle="modal" data-target="#ModalRegister">S'inscrire</a></li>
          <?php }else{ ?>
            <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>  
            <li><a href="./logout"><i class="glyphicon glyphicon-off"></i></a></li>  
          <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>