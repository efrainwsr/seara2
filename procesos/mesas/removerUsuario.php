<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios();

	
	echo $obj->ocultarUsuario($_POST['idusuario']);

	
	
 ?>