<?php 

session_start();

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Reportes.php";

	$obj= new reportes();

	$datos=array(
		$_POST['nombreR'],
		$_POST['vehiculoR'],
		$_POST['clienteR'],
		$_POST['rutaR'],
		$_POST['descripcionR']
	);

	echo $obj->agregaReporte($datos);

	
 ?>