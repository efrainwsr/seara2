<?php



	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empleados.php";

	$fecha=date("Y-m-d");
	//$idusuario=$_SESSION['iduser'];
	$id_empleado=$_POST['cedula'];
	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$observaciones=$_POST['observaciones'];
	$sueldo=$_POST['sueldo'];
	

	$datos=array(
		$id_empleado,
		$nombre,
		$telefono,
		$observaciones,
		$sueldo,
		$fecha
				);

	$obj= new empleado();

	echo $obj->agregaEmpleado($datos);



  ?>