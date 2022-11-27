<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Rutas.php";

	$objv= new rutas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idruta=$_GET['idruta'];

 $sql="SELECT ru.id_ruta,
		      ru.fecha,
		      u.email,
		      u.id_usuario
	from rutas ru, usuarios u
	where ru.id_ruta = '$idruta' AND ru.id_usuario=u.id_usuario";

$result=mysqli_query($conexion,$sql);

	$folio=mysqli_fetch_row($result)[0];
	$fecha=mysqli_fetch_row($result)[1];
    //$nombreRuta=mysqli_fetch_row($result)[2];
   
    

    

 ?>	


 <html><head>
 	<title>Informe de ruta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head><body>
 		<div align="center"><img src="../../img/logo-index.png"  height="150"></div>
 		<br>
 		<br>
 		<h3 align="center">Informe de ruta</h3>
 		<hr width=250>
 		<table class="">
 			<tr>
 				<td><strong> Fecha: <?php echo $fecha; ?></strong></td>
 			</tr>
 			<tr>
 				<td><strong> Ruta #: <?php echo $folio; ?></strong></td>
 			</tr>
 			<tr>
 				<td><strong> Nombre: <?php echo $objv->nombreRuta($idruta); ?></strong></td>
 			</tr>
 			
 		</table>
 		<br>
 		<br>

 		



 		<table class="table">
 			<tr>
 				<td><strong>Residencia</strong></td>
 				<td><strong>Cliente</strong></td>
 				<td><strong>Casas</strong></td>
 				<td><strong>Kg. Desechos</strong></td>
 				<td><strong>Telefono</strong></td>
 				<td><strong>Direccion</strong></td>
 				<td><strong>Gmap</strong></td>
 			</tr>

 			<?php 
 			 /*$sql="SELECT ru.id_ruta,   
						ru.fecha,      
						ru.nombre_ruta,
						r.nombre,  
						cli.nombre,	   
				        r.casas,     
				        r.kgbasura,  
				        cli.telefono,  
				        r.direccion,
				        r.gmap
					from rutas  as ru 
					inner join cliente as cli inner join residencia as r
					on ru.id_cliente=cli.id_cliente 
					and ru.id_ruta='$idruta' AND ru.id_cliente=r.id_cliente";
				$result=mysqli_query($conexion,$sql); */

/*
				$sql="SELECT ru.id_ruta,   
						ru.fecha,      
						ru.nombre_ruta,
						r.nombre,  
						cli.nombre,	   
				        r.casas,     
				        r.kgbasura,  
				        cli.telefono,  
				        r.direccion,
				        r.gmap
					from rutas ru, cliente cli, residencia r 
					where ru.id_ruta='$idruta' AND r.id_residencia=ru.id_residencia";
				$result=mysqli_query($conexion,$sql);
*/
				$sql="SELECT ru.id_ruta,         
					            ru.nombre_ruta,
					            r.nombre,   
				                r.casas,     
				                r.kgbasura,
				                r.direccion,
				                r.gmap,
				                cli.nombre,
				                cli.telefono
          from rutas as ru 
          inner join residencia as r inner join cliente as cli
          on ru.id_residencia=r.id_residencia
          and ru.id_ruta='$idruta' AND r.id_cliente = cli.id_cliente";
          $result=mysqli_query($conexion,$sql);
			
			$totalCasas=0;
			$totalBasura=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				
 				<td><?php echo $mostrar[2]; ?></td>
 				<td><?php echo $mostrar[7]; ?></td>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo $mostrar[4]; ?></td>
 				<td><?php echo $mostrar[8]; ?></td>
 				<td><?php echo $mostrar[5]; ?></td>
 				<?php $link= $mostrar[6]; ?>
 				<td><?php echo '<a href="'.$link.'" target="_blank" title="Ver ubicacion en google maps" >Link</a>'; ?></td>
 			</tr>
 			<?php 
 				$totalCasas=$totalCasas + $mostrar[3];
 				$totalBasura=$totalBasura + $mostrar[4];
 			endwhile;
 			 ?>
 			 
 		</table>
 		<table>
 			<tr>
 			 	<td>Total de casas:  <strong><?php echo "".$totalCasas; ?></strong></td>
 			 </tr>
 			 <tr>
 			 	<td>Total de Basura:  <strong><?php echo "Kg. ".$totalBasura; ?></strong></td>
 			 </tr>
 		</table>
 	

 </body></html>