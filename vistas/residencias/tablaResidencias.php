<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();
$tdolares=0;
$tcasas=0;
$tclientes=0;
?>

<div class="row">
<div class="table-responsive">
	<table class="table table-hover table-condensered table-striped" style="text-align: center;">
		<caption><label>Residencias</label></caption>
		<tr >
			<th>Residencia</th>
			<th>Cliente</th>
			<th>Casas</th>
			<th>Pago</th>
			<th>Telefono</th>
			<th>Direccion</th>
			<th>Kg. Desechos</th>  <!-- agregar el campo Basura a la base de datos -->  
			<th>Gmap</th>           <!-- agregar el campo Gmap a la base de datos -->
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
				// AND r.ver!='0'}

			  }

					$result=mysqli_query($conexion,$sql);
					while($ver=mysqli_fetch_row($result)){ 

						$datos=$ver[0]."||".
						$ver[2]."||".
						$ver[3]."||".
						$ver[4]."||".
						$ver[5]."||".
						$ver[6]."||".
						$ver[7]."||".
						$ver[8]."||".
						$ver[9]."||".
						$ver[10]."||".
						$ver[11];
						?> 

						<tr>
							<td><?php echo $ver[2]; ?></td>
							<td><?php echo $ver[10]; ?></td>
							<td><?php echo $ver[5]; ?></td>
							<td><?php echo $ver[7]; ?></td>
							<td><?php echo $ver[11]; ?></td>
							<td><?php echo $ver[3]; ?></td>
							<td><?php echo $ver[6]; ?></td>
							<?php $link= $ver[4];
							 $tdolares = $tdolares + $ver[7];
							 $tclientes++;
							 $tcasas = $tcasas + $ver[5];
							 ?>

							<td><?php echo '<a href="'.$link.'" target="_blank" title="Ver ubicacion en google maps">Ver</a>'; ?></td>
							<?php
							if($_SESSION['usuario']=="admin"):
								?>
								<td>
									<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalResidenciasUpdate" onclick="agregaDatosResidencia('<?php echo $ver[0]; ?>')">
										<span class="glyphicon glyphicon-pencil"></span>
									</span>

								</td>
								<?php if($ver[13]!='0'): ?>
								<td>
									<span class="btn btn-danger btn-xs" onclick="ocultarResidencia('<?php echo $ver[0]; ?>')">
										<span class="glyphicon glyphicon-remove"></span>
									</span>
								</td>
								<?php else: ?>
									<td>
										<span class="btn btn-success btn-xs" onclick="mostrarResidencia('<?php echo $ver[0]; ?>')">
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

<!-- TOTAL DOLARES -->
<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-success">
          <div class="panel-heading" style="background-color: #265; color: white;" >Dolares</div>
          <div class="panel-body">
            <?php echo "$ ".number_format($tdolares, 2);  ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-success">
          <div class="panel-heading" style="background-color: #157; color: white;" >Clientes</div>
          <div class="panel-body">
            <?php echo $tclientes;  ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-success">
          <div class="panel-heading" style="background-color: #f0ad4e; color: white;" >Casas</div>
          <div class="panel-body">
            <?php echo number_format($tcasas, 0);  ?>
        </div>
    </div>
</div>


