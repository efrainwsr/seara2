<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Carta.php";

	$obj= new carta();

	echo json_encode($obj->obtenDatosCarta($_POST['iditem']));

 ?>