<?php 
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Pagos.php";
$fecha=strtotime($_POST['fecha']);
$fecha = date('Y-m-d',$fecha);
$obj= new pagos();



if(isset($_POST['residencia'])){

	$dolares=$_POST['dolares'];
	$bs=$_POST['bs'];
	$tasa=$_POST['tasa'];

	$selectr = explode("-", $_POST['residencia']);
	$residencia= $selectr[0];
	$cliente= $selectr[1];
	$campos = array();

	if($residencia==""){
		array_push($campos, "Campo vacio");
	}

	if(strlen($dolares) < 0 && strlen($bs) < 0 && strlen($tasa) < 0){
		array_push($campos, "Ingrese, dolar, bs o tasa");

	}else{

		if(strlen($dolares) > 0 && strlen($bs) > 0 && strlen($tasa) > 0){
			$bs=$dolares*$tasa;
		}
		if ($dolares=="") {
			$dolares = $bs/$tasa;

		}elseif ($bs=="") {
			$bs = $dolares*$tasa;

		}elseif ($tasa=="") {
			$tasa = $bs/$dolares;
		}	
		
		$datos=array($residencia,$fecha,$_POST['referencia'],$tasa,$dolares,$bs,
		$_POST['bancoE'],$_POST['bancoR'],$cliente);

	echo $obj->agregaPago($datos);

}//else

}

?>