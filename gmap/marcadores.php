<?php

  // Archivo de Conexión a la Base de Datos 
  require_once "../clases/Conexion.php";
$obj = new conectar();
$conexion= $obj->conexion();
$sql="SELECT
             lat,
             lng,
             direccion
             from residencia";
        $result=mysqli_query($conexion,$sql);

  while ($ver = mysqli_fetch_array($result)) {
      echo '["' . $ver[2] . '", ' . $ver[0] . ', ' . $ver[1] . '],';
  }
?>