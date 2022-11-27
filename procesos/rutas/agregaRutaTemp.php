<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$conjuntoRuta=$_POST['conjuntoRuta'];   //id de la residencia
	$nombreRuta=$_POST['nombreRuta'];
	$dia = implode("-",$_POST['diaV']);
	//$dia=$_POST['diaV'];
	$direccion=$_POST['direccionV'];
	$nombreCliente=$_POST['nombreV'];
	$casas=$_POST['casasV'];
	$idcliente=$_POST['idclienteV'];
	//$residenciaRuta=$_POST['residenciaRuta'];


	$sql="SELECT id_cliente, nombre
			from cliente 
			where id_cliente='$idcliente'";
	$result=mysqli_query($conexion,$sql);
	$c=mysqli_fetch_row($result);

	$ncliente=$c[1];
	$idclienteR=$c[0];
	
	

	$sql="SELECT nombre, gmap, kgbasura
				from residencia
				where id_residencia='$conjuntoRuta'";
		$result=mysqli_query($conexion,$sql);
		$c=mysqli_fetch_row($result);
		$nombreResidencia=$c[0];
		$gmap=$c[1];
		$kgbasura=$c[2];




	$ruta=      $conjuntoRuta."||".   //0  id_residencia
				$nombreRuta."||".     //1
				$dia."||".			  //2
				$direccion."||".      //3
				$casas."||".	      //4
				$gmap."||".		      //5
				$kgbasura."||".           //6 
				$nombreResidencia."||".  //7   
				$idclienteR."||".         //8  id_cliente
				$ncliente;              //9    nombre del cliente

	$_SESSION['tablaRutasTemp'][]=$ruta;


 ?>