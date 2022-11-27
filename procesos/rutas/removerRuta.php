<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";

	$obj= new rutas();
	echo $obj->ocultarRuta($_POST['idruta']);

	
	
 ?>