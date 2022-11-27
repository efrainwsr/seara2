<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";

	$objv= new rutas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idruta=$_GET['idruta'];

 $sql="SELECT ru.id_ruta,
		ru.fecha,
		ru.nombre_ruta,
		ru.dia,
		cli.nombre,
        cli.conjunto,
        cli.direccion
	from rutas  as ru 
	inner join cliente as cli
	on ru.id_cliente=cli.id_cliente
	and ru.id_ruta='$idruta'";

$result=mysqli_query($conexion,$sql);

	$folio=mysqli_fetch_row($result)[0];
	$fecha=mysqli_fetch_row($result)[1];
    $nombreRuta=mysqli_fetch_row($result)[2];

 ?>	


 <html><head>
 	<title>Informe de ruta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head><body>
 		<img src="../../img/reporte.png" width="200" height="200">
 		<br>
 		<table class="table">
 			<tr>
 				<td>Fecha: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>ID Ruta: <?php echo $folio; ?></td>
 			</tr>
 			<tr>
 				<td>Nombre Ruta: <?php echo $objv->nombreRuta($idruta); ?></td>
 			</tr>	
 		</table>


 		<table class="table">
 			<tr>
 				<td>Conjunto</td>
 				<td>Cliente</td>
 				<td>Casas</td>
 				<td>Kg. Basura</td>
 				<td>Telefono</td>
 				<td>Direccion</td>
 				<td>Gmap</td>
 			</tr>

 			<?php 
 			 $sql="SELECT ru.id_ruta,   
						ru.fecha,      
						ru.nombre_ruta,
						cli.conjunto,  
						cli.nombre,	   
				        cli.casas,     
				        cli.kgbasura,  
				        cli.telefono,  
				        cli.direccion,
				        cli.gmap  
					from rutas  as ru 
					inner join cliente as cli
					on ru.id_cliente=cli.id_cliente
					and ru.id_ruta='$idruta'";
				$result=mysqli_query($conexion,$sql);
			
			$totalCasas=0;
			$totalBasura=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<?php $link= $mostrar[9]; ?>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo $mostrar[4]; ?></td>
 				<td><?php echo $mostrar[5]; ?></td>
 				<td><?php echo $mostrar[6]; ?></td>
 				<td><?php echo $mostrar[7]; ?></td>
 				<td><?php echo $mostrar[8]; ?></td>
 				<td><?php echo '<a href="'.$link.'" target="_blank" title="Ver ubicacion en google maps" >Link</a>'; ?></td>
 			</tr>
 			<?php 
 				$totalCasas=$totalCasas + $mostrar[5];
 				$totalBasura=$totalBasura + $mostrar[6];
 			endwhile;
 			 ?>
 			 <tr>
 			 	<td>Total de casas:  <?php echo "".$totalCasas; ?></td>
 			 </tr>
 			 <tr>
 			 	<td>Total de Basura:  <?php echo "Kg. ".$totalBasura; ?></td>
 			 </tr>
 		</table>

 </body></html>