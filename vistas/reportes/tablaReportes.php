<?php  
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();
/*
$sql="SELECT id_reportes,
			 nombre,
			 vehiculo,
			 cliente,
			 ruta,
			 fecha
		from reportes";
$result=mysqli_query($conexion,$sql); 
*/


?>


<div class="table-responsive">
	<table class="table table-hover table-condensered " style="text-align: center;">
		<caption><label>Reportes</label></caption>
		<tr>
			<th>Fecha</th>
				<th>Titulo</th>
				<th>Vehiculo</th>
				<th>Residencia</th>
				<th>Ruta</th>
			<!--<th>Editar</th>-->
				<!--<th>Eliminar</th> -->
				<th>Informe</th>
		</tr>

		<?php 

				if(isset($_SESSION['consulta'])){
					if($_SESSION['consulta'] > 0){
						$idp=$_SESSION['consulta'];
						$sql="SELECT id_reportes,nombre,vehiculo,residencia,ruta,fecha 
						from reportes where id_reportes='$idp'";
					}else{
						$sql="SELECT id_reportes,nombre,vehiculo,residencia,ruta,fecha 
						from reportes";
					}
				}else{
					$sql="SELECT id_reportes,nombre,vehiculo,residencia,ruta,fecha 
						from reportes";
				}

				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3]."||".
						   $ver[4]."||".
						   $ver[5]; 
			 ?>

		  <?php //while($ver=mysqli_fetch_row($result)): 
		  	
		  ?>

			<tr>
				<td><?php echo $ver[5]; ?></td>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td><?php echo $ver[3]; ?></td>
				<td><?php echo $ver[4]; ?></td> 


			<!--	<td>
					<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalReportesUpdate" onclick="agregaDatosReporte('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-pencil"></span>
					</span>

				</td>
			-->
				<!--<td>
					<span class="btn btn-danger btn-xs" onclick="eliminaReporte('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
				</td> -->
				<td>
						<a href="../procesos/reportes/crearReporteDiarioPdf.php?idreporte=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Informe <span class="glyphicon glyphicon-file"></span>
						</a>
					</td>
			</tr>
	<?php 
    }
	//endwhile; ?>
	</table>

</div>