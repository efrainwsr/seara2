<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Empleados.php";

$_POST['idempleado'];
//$_POST['idsector'];

$datos=array(

	$_POST['idempleado'],
	$_POST['nombreU'],
	$_POST['telefonoU'],
	$_POST['observacionesU'],
	$_POST['sueldoU'],
	$_POST['cedulaU']
);

$obj= new empleado(); 

echo $obj->actualizaEmpleado($datos);

 ?>