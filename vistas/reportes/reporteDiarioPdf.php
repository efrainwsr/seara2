<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Reportes.php";

	$objv= new reportes();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idreporte=$_GET['idreporte'];

 $sql="SELECT id_reportes,
 			  id_usuario,
 			  nombre,
 			  vehiculo,
 			  residencia,
 			  ruta,
 			  descripcion,
 			  fecha
	from reportes where id_reportes='$idreporte'";

$result=mysqli_query($conexion,$sql);
$ver=mysqli_fetch_row($result);
$nombre=$ver[1];

$sql="SELECT id_usuario,
			 nombre,
			 apellido
	from usuarios where id_usuario='$nombre'";
	$result2=mysqli_query($conexion,$sql);
    $ver2=mysqli_fetch_row($result2);

 ?>	


 <html><head>
 	<title>Informe de ruta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head><body>
 		<div align="center"><img src="../../img/logo-index.png"  height="150"></div>
 		<br>
 		<br>
 		<h3 align="center">Reporte de novedades</h3>
 		<hr width=250>
 		<table class="">
 			<tr>
 				<td><strong>Fecha: <?php echo $ver[7];?></strong> </td>
 			</tr>
 			<tr>
 				<td> <strong>Nombre: <?php echo $ver[2];?></strong></td>
 			</tr>
 			<tr>
 				<td><strong>Autor: <?php echo $ver2[1]." ".$ver2[2]." (".$ver2[0].")";?></strong></td>
 			</tr>

 		</table>
 		<br>
 		<br>
 		<table class="table">
 			<tr>
 				<td><strong> Vehiculo involucrado</strong></td>
 				<td><strong> Residencia involucrada</strong></td>
 				<td><strong> Ruta</strong></td>
 			</tr>

 			<tr>
 				<td><?php echo $ver[3];?></td>
 				<td><?php echo $ver[4];?></td>			
 				<td><?php echo $ver[5];?></td>
 			</tr>
 		</table>

 		<br>
 		<br>
 		<h4><?php print($ver[6]); ?></h4>



 		

 </body></html>