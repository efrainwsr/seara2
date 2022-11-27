
<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT id_vehiculo,
				 modelo,
				 marca,
				 capacidad,
				 cant_ruedas,
				 rin
		  from vehiculo where ver != '0'";
	$result=mysqli_query($conexion,$sql);

 ?>


<table class="table table-hover table-condensered  table-striped" style="text-align: center;">
	<caption> <label>Vehiculos</label></caption>
	
	<tr>
		<th>Placa</th>
		<th>Modelo</th>
		<th>Marca</th>
		<th>Capacidad</th>
		<th>Ruedas</th>
		<th>Rin</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>

		
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
<td>
			<span data-toggle="modal" data-target="#abremodalUpdateVehiculo" class="btn btn-warning btn-xs" onclick="agregaDatosVehiculo('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
				
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaVehiculo('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td>
	<?php endwhile;  ?>
	</tr>