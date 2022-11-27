<?php

$obj = new conectar();
$conexion= $obj->conexion();
$sql="SELECT
              r.nombre,
              cli.nombre,
              r.casas,
              r.kgbasura,
              cli.telefono
              from cliente cli, residencia r
              where r.id_cliente=cli.id_cliente";
        $result=mysqli_query($conexion,$sql);

  if($result->num_rows > 0){
    
    while ($row = mysqli_fetch_array($result)){ ?>
    
    ['<div class="info_content">' + 
    	'<h5><?php echo $row[0];?></h5>' + 
    	'<b><i><label> <?php echo "Cliente: ".$row[1];?>    </label> </b> </i> <br>' +
      '<b><i><label> <?php echo "Telefono: ".$row[4];?>    </label> </b> </i> <br>' +
    	'<b><i><label> <?php echo "Casas: ".$row[2];?>      </label> </b> </i> <br>' +
    	'<b><i><label> <?php echo "Kg. Basura: ".$row[3];?> </label> </b> </i> <br>' + 
    '</div>'], 

    <?php }
  }



?>