<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();

/*
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
*/
?>

<div class="row">
<div class="table-responsive">
	<table class="table table-hover table-condensered table-striped" style="text-align: center;">
		<caption><label>Clientes</label></caption>
		<tr >
			<th>Nombre</th>
			<th>Telefono</th>
			<th>Cedula/Rif</th>           <!-- agregar el campo Gmap a la base de datos -->
			<?php
        		//if($_SESSION['usuario']=="admin"):
         	?>
			<th>Editar</th>
			<th>Remover/Reactivar</th>
			<?php //endif; ?>
			
		</tr>

		<?php //while($ver=mysqli_fetch_row($result)): ?>
		<?php
				if(isset($_SESSION['consulta'])){
					if($_SESSION['consulta'] > 0){
						$idp=$_SESSION['consulta'];
						$sql="SELECT id_cliente,
								     nombre,								 
								     telefono,
								     ver
						from cliente where id_cliente='$idp' AND ver!='666'";
					}else{
						$sql="SELECT id_cliente,
								 nombre,								 
								 telefono,
								 ver
								from cliente where ver !='0' AND ver!='666'";
					}
				}else{
					$sql="SELECT id_cliente,
								 nombre,								 
								 telefono,
								 ver
								from cliente where ver !='0' AND ver!='666'";
				}

				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3];
			 ?>

			<tr>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td><?php echo $ver[0]; ?></td>
				<?php
        		if($_SESSION['usuario']=="admin"):
         		?>
				<td>
					<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-pencil"></span>
					</span>

				</td>
				<?php if($ver[3]!='0'): ?>
				<td>
					<span class="btn btn-danger btn-xs" onclick="ocultarCliente('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-remove"></span>
					</span>
				</td>
				<?php else: ?>
				<td>
					<span class="btn btn-success btn-xs" onclick="mostrarCliente('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-ok">Activar</span>
					</span>
				</td>
			    <?php endif; ?>
				<?php 
       			endif;
          		?>
			<!--	<td>
					<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span> 
				</td>-->
			</tr>
	<?php //endwhile; 

	}
	?>
	</table>

</div>
</div>


