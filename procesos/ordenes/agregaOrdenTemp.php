<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$iditem=$_POST['item'];  
	$idmesa=$_POST['mesa'];
	$cantidad=$_POST['cantidad'];
	$nota=$_POST['nota'];
	$precio=$_POST['precio'];
	$variante=$_POST['variante'];
	$nombre=$_POST['nombre'];

/*
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
*/

	$orden=     $iditem."||".   
				$idmesa."||". 		
				$cantidad."||".     
				$nota."||".	      
				$precio."||".		      
				$variante."||".
				$nombre;   

	$_SESSION['tablaOrdenTemp'][]=$orden;


 ?>