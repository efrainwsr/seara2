<?php 

session_start();

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Residencias.php";

	$obj= new residencias();

$kgbasura =0;
$direccion =0;
$gmap = 0;
$lat = 0;
$lng = 0;


$datos=array(
		$_POST['conjunto'],
		$_POST['casas'],
		$kgbasura,
		$_POST['pago'],
		$direccion,
		$_POST['clienteR'],
		$gmap,
		$lat,
		$lng

	);

/*
	$datos=array(
		$_POST['conjunto'],
		$_POST['casas'],
		$_POST['kgbasura'],
		$_POST['pago'],
		$_POST['direccion'],
		$_POST['clienteR'],
		$_POST['gmap'],
		$_POST['latitud'],
		$_POST['longitud']

	);
*/
	echo $obj->agregaResidencia($datos);


	
 ?>