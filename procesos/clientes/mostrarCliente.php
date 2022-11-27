<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();

	
	echo $obj->mostrarCliente($_POST['idcliente']);

	
	
 ?>