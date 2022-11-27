<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ordenes.php";
	$obj= new ordenes();

	

	if(count($_SESSION['tablaOrdenTemp'])==0){
		echo 0;
	}else{
		$result=$obj->crearOrden();
		unset($_SESSION['tablaOrdenTemp']);
		echo $result;
	}
 ?>