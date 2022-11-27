
<?php require_once "dependencias.php" ?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
  

</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="" ></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>

          </li>



          <!-- Aqui se puede editar las diferentes opciones del menu que puede ver cada usuario--- meter dentro del if -->

          <?php if($_SESSION['cargo']==1):{  ?>
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
              <li><a href="vehiculo.php">Entregadas</a></li>
            </ul>
          </li>


           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"    aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-cutlery"></span> Menú<span   class="caret">
                </span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="empleado.php">Platillos</a></li>
              <li><a href="vehiculo.php">Bebidas</a></li>
            </ul>
          </li>

        <?php if($_SESSION['cargo']==1):{ ?>

          <li>
            <a href="clientesResidencias.php"><span class="glyphicon glyphicon-usd">  </span> Ventas</a>
          </li>
        <?php } endif; ?>


        <!-- Desincorporar 

        <li><a href="clientesResidencias.php"><span class="glyphicon glyphicon-user"></span> Clientes</a>
        </li>

        <li><a href="pagos.php"><span class="glyphicon glyphicon-usd"></span> Pagos</a>
        </li>

        <li><a href="historial.php"><span class="glyphicon glyphicon-list-alt"></span> Historial</a>
        </li>

        <li><a href="rutas.php"><span class="glyphicon glyphicon-road"></span> Rutas</a>
        </li>

        <li><a href="reportes.php"><span class="glyphicon glyphicon-file"></span> Reporte diario</a>
        </li>

        Desincorporar Hasta aqui -->

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

<script type="text/javascript">
  $(window).scroll(function() {
    if ($(document).scrollTop() > 130) {
      $('.logo').height(50);

    }
    else {
      $('.logo').height(70);
    }
  }
  );
</script>