<?php 

require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();

$sql="SELECT id_cliente,
			 nombre,
			 conjunto,
			 direccion,
			 telefono,
			 gmap,
			 casas,
			 kgbasura,
			 pago 
		from cliente";
$result=mysqli_query($conexion,$sql); 

?>


<div class="table-responsive">
	<table class="table table-hover table-condensered table-bordered" style="text-align: center;">
		<caption><label>Clientes</label></caption>
		<tr>
			<td>Nombre</td>
			<td>Conjunto</td>
			<td>Direccion</td>
			<td>Telefono</td>
			<td>Gmap</td>           <!-- agregar el campo Gmap a la base de datos -->
			<td>Casas</td>
			<td>Kg. Basura</td>  <!-- agregar el campo Basura a la base de datos -->  
			<td>Pago</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>

		<?php while($ver=mysqli_fetch_row($result)): ?>

			<tr>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td><?php echo $ver[3]; ?></td>
				<td><?php echo $ver[4]; ?></td>
				<?php $link= $ver[5]; ?>
				<td><?php echo '<a href="'.$link.'" target="_blank" title="Ver ubicacion en google maps">Ver</a>'; ?></td>
				<td><?php echo $ver[6]; ?></td>
				<td><?php echo $ver[7]; ?></td>
				<td><?php echo $ver[8]; ?></td>
				<td>
					<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-pencil"></span>
					</span>

				</td>
				<td>
					<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
				</td>
			</tr>
	<?php endwhile; ?>
	</table>

</div>



