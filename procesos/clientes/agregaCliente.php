<?php 

session_start();

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();

	$datos=array(
		$_POST['id_cliente'],
		$_POST['nombre'],
		$_POST['telefono'],

	);

	echo $obj->agregaCliente($datos);


	
 ?>