<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ordenes.php";

	$obj=new ordenes();


	echo json_encode($obj->obtenDatosItem($_POST['item']))


  ?>