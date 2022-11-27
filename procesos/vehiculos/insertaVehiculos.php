<?php  
session_start();
$iduser=$_SESSION['iduser'];

require_once "../../clases/Conexion.php";
require_once "../../clases/Vehiculos.php";

$obj=new vehiculos();

$datos=array();


//$datos[0]=$_POST['empleadoSelect'];
//$datos[1]=$_POST['chofer'];
$datos[0]=$_POST['placa'];
$datos[1]=$_POST['capacidad'];
$datos[2]=$_POST['marca'];
$datos[3]=$_POST['modelo'];
$datos[4]=$_POST['ruedas'];
$datos[5]=$_POST['rin'];

echo $obj->insertaVehiculos($datos);

?>