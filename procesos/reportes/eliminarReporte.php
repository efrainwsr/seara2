<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Reportes.php";

	$obj= new reportes();

	
	echo $obj->eliminaReporte($_POST['idreporte']);
 ?>