<?php

  // Archivo de Conexión a la Base de Datos 
  require_once "../../../clases/Conexion.php";
  $id=$_GET['idruta'];
$obj = new conectar();
$conexion= $obj->conexion();




/*$sql="SELECT    ru.id_ruta,
				        r.lat,              
                r.lng,   
                r.direccion,
                r.id_residencia,
                ru.id_residencia 
          from rutas as ru 
          inner join residencia as r
          on ru.id_residencia=r.id_residencia 
          and ru.id_ruta='$id'";
        $result=mysqli_query($conexion,$sql); */


$sql="SELECT
             lat,
             lng,
             direccion
             from residencia";
        $result=mysqli_query($conexion,$sql)

  while ($ver = mysqli_fetch_array($result)) {
      echo '["' . $ver[2] . '", ' . $ver[0] . ', ' . $ver[1] . '],';
  }
?>