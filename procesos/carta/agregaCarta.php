<?php 

session_start();

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Carta.php";

	$obj= new carta();

	$datos=array(
		$_POST['nombre'],
		$_POST['precio'],
		$_POST['categoria'],
		$_POST['desc'],
		$_POST['variante'],
		$_POST['status'],

	);

	echo $obj->agregaCarta($datos);


	
 ?>