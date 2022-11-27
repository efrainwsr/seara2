<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Vehiculos.php";

	$obj= new vehiculos();

	
	echo $obj->ocultarVehiculo($_POST['idvehiculo']);

	
	
 ?>