<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Carta.php";

	$obj= new carta();


	$datos=array(
			$_POST['iditem'],
			$_POST['nombreU'],
			$_POST['precioU'],
			$_POST['categoriaU'],
			$_POST['descU'],
			$_POST['varianteU'],
			$_POST['statusU']
							);

	echo $obj->actualizaCarta($datos);

	
	
 ?>