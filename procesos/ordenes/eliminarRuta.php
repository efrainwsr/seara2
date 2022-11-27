<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";

	$obj= new rutas();

	
	echo $obj->eliminaRuta($_POST['idruta']);
 ?>