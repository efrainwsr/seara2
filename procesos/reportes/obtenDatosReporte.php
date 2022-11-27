<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Reportes.php";

	$obj= new reportes();

	echo json_encode($obj->obtenDatosReporte($_POST['idreporte']));

 ?>