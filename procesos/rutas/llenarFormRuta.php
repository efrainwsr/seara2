<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";

	$obj=new rutas();

	echo json_encode($obj->obtenDatosCliente($_POST['idresidencia']))


  ?>