
<?php require_once "dependencias.php" ?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
  

</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-default navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/menu-logo.png" width="200 px" ></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>

          </li>



          <!-- Aqui se puede editar las diferentes opciones del menu que puede ver cada usuario--- meter dentro del if -->

          <?php if($_SESSION['cargo']=='Administrador'):{  ?>
            <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
          <?php  } endif; ?>


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"    aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-list-alt"></span> Ordenes<span   class="caret">
                </span>
            </a>
            
            <ul class="dropdown-menu">
              <li><a href="empleado.php">En preparación</a></li>
              <li><a href="vehiculo.php">Terminadas</a></li>
              <li><a href="ordenes.php">Ver ordenes</a></li>
            </ul>
          </li>


           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"    aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-cutlery"></span> Menú<span   class="caret">
                </span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="carta.php">Menú</a></li>
              <li><a href="empleado.php">Platillos</a></li>
              <li><a href="vehiculo.php">Bebidas</a></li>
            </ul>
          </li>

        <?php if($_SESSION['cargo']=='Administrador'):{ ?>

          <li>
            <a href="clientesResidencias.php"><span class="glyphicon glyphicon-usd">  </span> Ventas</a>
          </li>
        <?php } endif; ?>


      

        <li>
          <a href="../procesos/salir.php" style="color: red"><span class="glyphicon glyphicon-user"> Salir</span></a>
        </li>


          <li>
            <a href="#"><span class=""><?php echo $_SESSION['usuario'];?></span></a>
          </li>

        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->





<!-- /container -->        


</body>
</html>

