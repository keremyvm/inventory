<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo BASE_URL ?>main" class="logo">
     
      <span class="logo-mini">
        <img src="<?php echo IMG ?>plantilla/icono-blanco.png" alt="" class="img-responsive" style="padding: 10px;">
      </span>
     
      <span class="logo-lg">
        <img src="<?php echo IMG ?>plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding: 10px;">
      </span>

    </a>




    <!-- navegacion -->
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle Navigation</span>
      </a>
        <!-- perfil del user -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php 
                if (!empty($_SESSION["foto"])) {
                    echo '<img src="'.$_SESSION["foto"].'" alt="" class="user-image">';
                  }else{  
                 ?>
                <img src="<?php echo IMG ?>usuarios/default/anonymous.png" alt="" class="user-image">
                <?php 
                  }
                 ?>
                <span class="hidden-xs"><?php echo $_SESSION['nombre'];?></span>
              </a>
              <!-- DropDown Toggle -->
                 <ul class="dropdown-menu">
                   <li class="user-body">
                     <div class="pull-right">
                       <a href="<?php echo BASE_URL.'login/salir'?>" class="btn btn-default btn-flat">Salir</a>
                     </div>
                   </li>
                 </ul>
            </li>
          </ul>
        </div>
     
    </nav>
  </header>