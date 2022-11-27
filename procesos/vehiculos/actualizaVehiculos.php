<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Vehiculos.php";

$obj= new vehiculos();

$datos=array(
		$_POST['idVehiculo'],
	   // $_POST['empleadoSelectU'],
	   // $_POST['choferU'],
	    $_POST['capacidadU'],
	    $_POST['marcaU'],
	    $_POST['modeloU'],
	    $_POST['ruedasU'],
	    $_POST['rinU']
			);

    echo $obj->actualizaVehiculo($datos);

 ?>