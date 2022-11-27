<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";
	require_once "../../vistas/pagos/tablaPagos.php";

	$obj= new pagos();

	echo json_encode($obj->obtenDatosCliente($_POST['idcliente']));

 ?>