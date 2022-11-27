<?php 
require_once "../../clases/Conexion.php";
$obj = new conectar();
$conexion= $obj->conexion();

$sql="SELECT id_reportes,nombre,vehiculo,residencia,ruta,fecha 
from reportes";
$result=mysqli_query($conexion,$sql);


?>
<h1>Reporte diario</h1>
<!--
<form class="form-inline"  method="post"  name="formFechas" id="formFechas">
	<div class="col-xs-10 col-xs-offset-3">
		<div class="form-group">
			<button type="button" class="btn btn-success">
			<span class="glyphicon glyphicon-search"></span></button>

		</div>
		<div class="form-group">
			<label for="fecha_inicio">Desde:</label>
			<input type="date" class="form-control" name="fecha_inicio" required>
		</div>
		<div class="form-group">
			<label for="fecha_final">Hasta:</label>
			<input type="date" class="form-control" name="fecha_final" required>
		</div> -->

		<!--<div class="form-group"> -->
			<div class="row">
				<div class="col-sm-8"></div>
				<div class="col-sm-4">
					<label>Buscador</label>
					<select id="buscadorvivo" class="form-control input-sm">
						<option value="0">Seleciona uno</option>
						<?php
						while($ver=mysqli_fetch_row($result)): 
							?>
							<option value="<?php echo $ver[0] ?>">
								<?php echo $ver[1]." - ".$ver[5]; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div>
	<!--</div>
	</form> -->


	<script type="text/javascript">
		$(document).ready(function(){
			$('#buscadorvivo').select2();

			$('#buscadorvivo').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#buscadorvivo').val(),
					url:'reportes/crearsession.php',
					success:function(r){
						$('#tabla').load('reportes/tablaReportes.php');
					}
				});
			});
		});
	</script>

