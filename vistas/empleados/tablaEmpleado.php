
<?php 

	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql= "SELECT id_empleado,
					nombre,
					telefono,
					observaciones,
					fecha,
					sueldo 
			FROM empleados where ver != '0'";
	$result=mysqli_query($conexion,$sql);
 ?>




<table class="table table-hover table-condensered  table-striped" style="text-align: center;">
	<caption> <label>Empleados</label></caption>
	
	<tr>
		<th>Cedula</th>
		<th>Nombre</th>
		<th>Telefono</th>
		<th>Observ.</th>
		<th>Fecha</th>
		<th>Sueldo</th>
	    <th>Editar</th>
	    <th>Remover</th>
			
	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>

	<tr>
		<td><?php echo $ver[0] ?></td>
		<td><?php echo $ver[1] ?></td>
		<td><?php echo $ver[2] ?></td>
		<td><?php echo $ver[3] ?></td>
		<td><?php echo $ver[4] ?></td>
		<td><?php echo $ver[5] ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaEmpleado" onclick="obtenDatosEmpleado('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-pencil"></span>
					</span>
		</td>
		<td>
					<span class="btn btn-danger btn-xs" onclick="eliminaEmpleado('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-remove"></span>
					</span>

				</td>
		<!--<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaEmpleado('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td>-->
	</tr>
 
<?php endwhile; ?>
</table>