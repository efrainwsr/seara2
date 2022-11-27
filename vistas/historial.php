<?php

session_start();
unset($_SESSION['inicio']);
unset($_SESSION['fin']); 
unset($_SESSION['actual']); 
if(isset($_SESSION['usuario'])){
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Historial de pagos</title>
    <meta charset="utf-8">

    <?php require_once "menu.php"?>

  </head>
  <body>
    
    <div class="container">
     <h2>Historial de pagos</h2>
     
     <div id="buscador"></div>
     <div id="tablaHistorial"></div>

     



   </div> <!-- Container -->

 </body>
 </html>

 

 <script type="text/javascript">
  $(document).ready(function(){
    $('#tablaHistorial').load('pagos/tablaHistorial.php');
    $('#buscador').load('pagos/buscador.php');
  });
</script>




<?php
}else{
  header("location:../index.php");
}

?>
