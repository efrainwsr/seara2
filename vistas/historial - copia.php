<?php  
session_start();


if(isset($_SESSION['usuario'])){
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Historial de pagos</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/listas.css">
    <?php require_once "menu.php"?>

  </head>
  <body>

    <div class="container">

      <h2>Historial de pagos</h2>
      <div class="row">
        <div class="col-sm-12">
          <div class="dropdown">
            <button class="dropbtn ">Año 2020</button>
            <div class="dropdown-content">
              <a href="#">Enero</a>
              <a href="#">Febrero</a>
              <a href="#">Marzo</a>
              <a href="#">Abril</a>
              <a href="#">Mayo</a>
              <a href="#">Junio</a>
              <a href="#">Julio</a>
              <a href="#">Agosto</a>
              <a href="#">Septiembre</a>
              <a href="#">Octubre</a>
              <a href="#">Noviembre</a>
              <a href="#">Diciembre</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div id="tablaMes"> <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> </div>
        </div>
      </div>



    </div> <!-- Container -->

  </body>
  </html>

  






  <?php
}else{
  header("location:../index.php");
}

?>
