<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Rutas.php";
require_once "../../clases/Vehiculos.php";

$c= new conectar();
$conexion=$c->conexion();

$obj= new rutas();
$objv= new vehiculos();

$sql="SELECT id_ruta,
fecha,
nombre_ruta,
dia,
casas
from rutas where ver !='0' group by id_ruta";
$result=mysqli_query($conexion,$sql);


?>

<br>
<h4>Ver Rutas</h4>
<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-condensered" style="text-align: center;">
				
				<tr>
					<th>Nombre</th>
					<th>N° Residencias </th>
					<th>N° Casas </th>
					<th>Dia</th>
					<th>Kg. Desechos</th>
					<!--	<th>Vehiculo optimo</th> -->
					<th>Ver informe</th>
					<th>Ver en Maps</th>
					<th>Eliminar</th>
				</tr>
				<?php while($ver=mysqli_fetch_row($result)): ?>
					<tr>

						<td>
							<?php
							echo $obj->nombreRuta($ver[0]);
							?>	
						</td>
						
						<td> <?php //echo $cantResi; ?></td>
						
						<td><?php
						echo $obj->totalCasas($ver[0]); 
						?></td>
						<td> <?php echo $ver[3]; ?></td>
						<td>
							<?php
							echo "Kg ".$obj->totalKgbasura($ver[0]);
							$totalBasura=$obj->totalKgbasura($ver[0]);
							?>
						</td>

							<td>
								<a href="../procesos/rutas/crearReportePdf.php?idruta=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
									Informe <span class="glyphicon glyphicon-file"></span>
								</a>
							</td>
							<td>
								<a href="rutas/gmap/vistaGmap.php?idruta=<?php echo $ver[0] ?>" target="_blank" class="btn btn-success btn-sm">
									Gmap <span class="glyphicon glyphicon-map-marker"></span>
								</a>
							</td>
							<td>
								<span class="btn btn-danger btn-xs" onclick="ocultarRuta('<?php echo $ver[0]; ?>')">
									<span class="glyphicon glyphicon-remove"></span>
								</span>
							</td>
						</tr>
					<?php endwhile;  ?>
				</table>
			</div>
		</div> 
		<div class="col-sm-1">
		</div>
	</div>

	<script type="text/javascript">

		function eliminaRuta(idruta){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idruta=" + idruta,
					url:"../procesos/rutas/eliminarRuta.php",
					success:function(r){
						if(r==1){
							$('#rutasHechas').load('rutas/rutasyReportes.php');
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

		function ocultarRuta(idruta){
			alertify.confirm('¿Desea eliminar esta ruta?', function(){ 
				$.ajax({
					type:"POST",
					data:"idruta=" + idruta,
					url:"../procesos/rutas/removerRuta.php",
					success:function(r){
						if(r==1){
							$('#rutasHechas').load('rutas/rutasyReportes.php');
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}
	</script>