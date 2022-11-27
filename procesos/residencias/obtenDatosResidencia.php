<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Residencias.php";

	$obj= new residencias();

	echo json_encode($obj->obtenDatosResidencia($_POST['idresidencia']));

 ?>