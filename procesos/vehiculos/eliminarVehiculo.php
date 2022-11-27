<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/Vehiculos.php";
//$idvehi=$_POST['idvehiculo'];

	$obj=new vehiculos();

	//echo $obj->eliminaVehiculo($idvehi);
	echo $obj->eliminaVehiculo($_POST['idvehiculo']);
 ?>