<?php

  $id=$_GET['idruta'];

$obj = new conectar();
$conexion= $obj->conexion();

/*$sql="SELECT ru.id_ruta, 
            cli.conjunto, 
            cli.nombre,    
            cli.casas,     
            cli.kgbasura 
          from rutas as ru 
          inner join cliente as cli
          on ru.id_cliente=cli.id_cliente
          and ru.id_ruta='$id'"; 
          $result=mysqli_query($conexion,$sql);*/

          $sql="SELECT
              r.nombre,
              cli.nombre,
              r.casas,
              r.kgbasura,
              cli.telefono
              from cliente cli, residencia r, rutas ru
              on ru.id_ruta='$id'";
        $result=mysqli_query($conexion,$sql);
        

  if($result->num_rows > 0){
    
    while ($row = mysqli_fetch_array($result)){ ?>
    
    ['<div class="info_content">' + 
    	'<h5><?php echo $row[1];?></h5>' + 
    	'<b><i><label> <?php echo "Cliente: ".$row[2];?>    </label> </b> </i> <br>' +
    	'<b><i><label> <?php echo "Casas: ".$row[3];?>      </label> </b> </i> <br>' +
    	'<b><i><label> <?php echo "Kg. Basura: ".$row[4];?> </label> </b> </i> <br>' + 
    '</div>'], 

    <?php }
  }



?>