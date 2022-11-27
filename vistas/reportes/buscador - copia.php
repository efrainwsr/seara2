<?php 
	require_once "../../clases/Conexion.php";
	$obj = new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT id_reportes,nombre,vehiculo,cliente,ruta 
						from reportes";
				$result=mysqli_query($conexion,$sql);
				

 ?>
<h1>Reporte diario</h1>
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
					<?php echo $ver[1]; ?>
				</option>

			<?php endwhile; ?>

		</select>
	</div>
</div>


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