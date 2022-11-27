<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empleados.php";

	$obj= new empleado();

	
	echo $obj->ocultarEmpleado($_POST['idempleado']);

	
	
 ?>