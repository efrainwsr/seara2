<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empleados.php";
	$id=$_POST['idempleado'];

	$obj= new empleado();
	echo $obj->eliminaEmpleado($id);

 ?>