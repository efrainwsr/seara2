<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['idclienteU'],
			$_POST['nombreU'],
			$_POST['conjuntoU'],
			$_POST['direccionU'],
			$_POST['telefonoU'],
			$_POST['gmapU'],
			$_POST['casasU'],
			$_POST['kgbasuraU'],
			$_POST['pagoU']
				);

	echo $obj->actualizaCliente($datos);

	
	
 ?>