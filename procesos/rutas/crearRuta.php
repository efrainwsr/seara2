<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";
	$obj= new rutas();

	

	if(count($_SESSION['tablaRutasTemp'])==0){
		echo 0;
	}else{
		$result=$obj->crearRuta();
		unset($_SESSION['tablaRutasTemp']);
		echo $result;
	}
 ?>