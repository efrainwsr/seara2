<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Residencias.php";

	$obj= new residencias();

	
	echo $obj->mostrarResidencia($_POST['idresidencia']);

	
	
 ?>