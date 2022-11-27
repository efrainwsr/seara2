<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Vehiculos.php";

	$obj= new vehiculos();


	$idvehi=$_POST['idvehi'];

	echo json_encode($obj->obtenDatosVehiculo($idvehi));

 ?>