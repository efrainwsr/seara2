<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ordenes.php";

	$obj= new ordenes();

	
	echo $obj->terminarOrden($_POST['idorden']);

	
	
 ?>