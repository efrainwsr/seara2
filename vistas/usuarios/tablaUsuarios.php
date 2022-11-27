<?php

	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_usuario,
				 nombre,
				 apellido,
				 email,
				 tipo
			from usuarios where ver != '0' ORDER BY tipo ";
	$result=mysqli_query($conexion,$sql);

 ?>

<table  class="table table-hover table-condensered table-striped" style="text-align: center;">
	<caption><label></label></caption>
	<tr>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Usuario</th>
		<th>Cargo</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>

<?php while($ver=mysqli_fetch_row($result)):
/*
	if($ver[4] == 1){
		$tipo_usuario = "Administrador";
	
	}else if($ver[4] == 2){
		$tipo_usuario = "Cocinero";
	
	}else if($ver[4] == 3){
		$tipo_usuario = "Mesero";
	}
*/

  ?>

	<tr>
		<td><?php echo $ver[1];  ?></td>
		<td><?php echo $ver[2];  ?></td>
		<td><?php echo $ver[3];  ?></td>
		<td><?php echo $ver[4];	 ?></td>
		<td>
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>		  	
		</td>
		 
		<?php  if($ver[4] != 'Administrador'): ?>
		<td>
			<span class="btn btn-danger btn-xs" onclick="ocultarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td>
	<?php endif; ?>
		<!--<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td> -->
	</tr>
	<?php endwhile; ?>

</table>





