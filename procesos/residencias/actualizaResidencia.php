<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Residencias.php";

	$obj= new residencias();
	

	$datos=array(
			$_POST['idresidenciaU'],
			$_POST['conjuntoU'],
			$_POST['direccionU'],
			$_POST['gmapU'],
			$_POST['casasU'],
			$_POST['kgbasuraU'],
			$_POST['pagoU'],
			$_POST['latitudU'],
			$_POST['longitudU'],
			$_POST['clienteRV']

				);

	echo $obj->actualizaResidencia($datos);

	
	
 ?>