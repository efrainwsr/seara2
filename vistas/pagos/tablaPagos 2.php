<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();
$tdolares=0;
?>


<div class="container">
	<table class="table table-hover table-condensered table-striped" style="text-align: center;">
		<caption><label>Pagos</label></caption>
		<tr >
			<th>Cliente</th>
			<th>Residencia</th>
			<th>Casas</th>
			<th>Fecha</th>
			<th>Referencia</th>
			<th>Tasa</th>
			<th>Dolares</th>
			<th>Bolivares</th>
			<?php
			if($_SESSION['usuario']=="admin"):
				?>
				<th>Editar</th>
			<?php endif; ?>
			
		</tr>

		<?php //while($ver=mysqli_fetch_row($result)): ?>
		<?php
			/*	if(isset($_SESSION['consulta'])){
					if($_SESSION['consulta'] > 0){
						$idp=$_SESSION['consulta'];
						$sql="SELECT r.id_residencia,
										r.id_cliente,
										r.nombre,
										r.direccion,
										r.gmap,
										r.casas,
										r.kgbasura,
										r.pago,
										r.lat,
										r.lng,
										cli.nombre,
										cli.telefono,
										cli.ver,
										r.ver 
						from residencia r, cliente cli 
						where id_residencia='$idp' AND r.id_cliente = cli.id_cliente";
					}else{
						$sql="SELECT r.id_residencia,
					r.id_cliente,
					r.nombre,
					r.direccion,
					r.gmap,
					r.casas,
					r.kgbasura,
					r.pago,
					r.lat,
					r.lng,
					cli.nombre,
					cli.telefono,
					cli.ver,
					r.ver		 
					from residencia r, cliente cli
					where r.id_cliente = cli.id_cliente AND cli.ver !='0' AND r.ver!='0' ";
					}
				}else{ */
					$sql="SELECT p.id_pago,
								 p.id_residencia,
								 p.tasa,
								 p.fecha,
								 p.referencia,
								 p.dolares,
								 p.bs,
								 r.id_residencia,
								 r.casas,
								 r.nombre,
								 cli.nombre
					from pagos p, residencia r, cliente cli
					WHERE p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente";

				// AND r.ver!='0'}

			//  }

					$result=mysqli_query($conexion,$sql);
					while($ver=mysqli_fetch_row($result)){ 

						$datos=$ver[2]."||".
						$ver[3]."||".
						$ver[4]."||".
						$ver[5]."||".
						$ver[6]."||".
						$ver[8]."||".
						$ver[9]."||".
						$ver[10];
						?> 

						<tr>

							<?php $dolar = number_format($ver[5], 1);  
							$tdolares=$ver[5]+$tdolares; ?>
							<td><?php echo $ver[10]; ?></td>
							<td><?php echo $ver[9]; ?></td>
							<td><?php echo $ver[8]; ?></td>
							<td><?php echo $ver[3]; ?></td>
							<td><?php echo $ver[4]; ?></td>
							<td><?php echo $ver[2]; ?></td>
							<td><?php echo $dolar; ?></td>
							<td><?php echo $ver[6]; ?></td>
							
				
							<?php
							if($_SESSION['usuario']=="admin"):
								?>
								<td>
									<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalResidenciasUpdate" onclick="agregaDatosResidencia('<?php echo $ver[0]; ?>')">
										<span class="glyphicon glyphicon-pencil"></span>
									</span>

								</td>
								<?php endif;?>
		</tr>
	<?php //endwhile; 

}
?>
</table>

</div>



