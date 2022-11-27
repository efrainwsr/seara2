<?php
   session_start();
  require_once "../../../clases/Conexion.php";

  

  $id=$_GET['idruta'];

$obj = new conectar();
$conexion= $obj->conexion();
$sql="SELECT ru.id_ruta,         
            ru.nombre_ruta,
            r.nombre,   
                r.casas,     
                r.kgbasura,
                r.direccion,
                r.gmap,
                cli.nombre,
                cli.telefono
          from rutas as ru 
          inner join residencia as r inner join cliente as cli
          on ru.id_residencia=r.id_residencia
          and ru.id_ruta='$id' AND r.id_cliente = cli.id_cliente";
        $result=mysqli_query($conexion,$sql); 

  // Creamos una tabla para listar los datos 
  echo "<div class='table-responsive'>";

  echo "<table class='table' style='text-align: center;'>
          <thead>
            <tr>
              <th>Residencia</th>
              <th>Cliente</th>
              <th>Telefono</th>
              <th>Casas</th>
              <th>Kg. Basura</th> 
              <th>Abrir en Gmap</th>
            </tr>
            </thead>
            <tbody>";

  while ($ver = mysqli_fetch_row($result)) {

      $link = $ver[6]; 
      echo "<tr>";
      echo "<td scope='col'>" . $ver[2] . "</td>";
      echo "<td scope='col'>" . $ver[7] . "</td>";
       echo "<td scope='col'>" . $ver[8] . "</td>";
      //echo "<td scope='col'>" . preg_replace('/\\\\u([\da-fA-F]{4})/', '&#x\1;', $ver[6]) . "</td>";
      echo "<td scope='col'>" . $ver[3] . "</td>";
      echo "<td scope='col'>" . $ver[4] . "</td>";
      echo "<td scope='col'>" . "<a href= '$link' target='_blank' title='Abrir en Google Maps' >Link</a>" . "</td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
  echo "</div>";

?> 


