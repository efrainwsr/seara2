
<?php 
	session_start();
	//require_once "../php/conexion.php";
	//$conexion=conexion();

 ?>
<div class="row">
	<div class="col-sm-12">
	
		<table class="table table-hover table-condensered table-bordered" style="text-align: center;">
		<caption>
			<button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
				Agregar nuevo 
				<span class="glyphicon glyphicon-plus"></span>
			</button>
		</caption>
			<tr>
				<td>Fecha</td>
				<td>Titulo</td>
				<td>Vehiculo</td>
				<td>Cliente</td>
				<td>Ruta</td>
				<td>Editar</td>
				<td>Eliminar</td>
				<td>Informe</td>
			</tr>

			<?php 
/*
				if(isset($_SESSION['consulta'])){
					if($_SESSION['consulta'] > 0){
						$idp=$_SESSION['consulta'];
						$sql="SELECT id,nombre,apellido,email,telefono 
						from t_persona where id='$idp'";
					}else{
						$sql="SELECT id,nombre,apellido,email,telefono 
						from t_persona";
					}
				}else{
					$sql="SELECT id,nombre,apellido,email,telefono 
						from t_persona";
				}

				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3]."||".
					   $ver[4];
		*/		 ?>

			<tr>
				<td><?php //echo $ver[1] ?></td>
				<td><?php ////echo $ver[2] ?></td>
				<td><?php //echo $ver[3] ?></td>
				<td><?php //echo $ver[4] ?></td>
				<td></td>

				<td>
					<button class="btn btn-warning btn-xs glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php //echo $datos ?>')">
						
					</button>
				</td>
				<td>
					<button class="btn btn-danger btn-xs glyphicon glyphicon-remove" 
					onclick="preguntarSiNo('<?php //echo $ver[0] ?>')">
						
					</button>
				</td>
				<td>
					<!--<a href="../procesos/rutas/crearReportePdf.php?idruta=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Informe <span class="glyphicon glyphicon-file"></span>
						</a>-->
				</td>
			</tr>
			<?php 
	//	}
			 ?>
		</table>
	</div>
</div>