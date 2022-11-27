<?php 
require_once "../../clases/Conexion.php";
$obj = new conectar();
$conexion= $obj->conexion();

$sql="SELECT id_residencia,
nombre,
id_cliente,
ver
from residencia
where ver!='0'";
$result=mysqli_query($conexion,$sql); 


?>
<div class="row">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		<label>Buscador</label>
		<select id="buscadorvivo2" class="form-control input-sm">
			<option value="0">Seleciona uno</option>
			<?php
			while($ver=mysqli_fetch_row($result)): 
				?>
				<?php if($ver[3] !='1'): ?>
					<option value="<?php echo $ver[0] ?>">
						<?php echo $ver[1]." - ".$ver[2]."   INACTIVO"; ?>
					</option>
					<?php elseif($ver[3]=='1'): ?>
						<option value="<?php echo $ver[0] ?>">
							<?php echo $ver[1]." - ".$ver[2]; ?>
						</option>
					<?php endif; ?>

				<?php endwhile; ?>

			</select>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			$('#buscadorvivo2').select2();

			$('#buscadorvivo2').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#buscadorvivo2').val(),
					url:'residencias/crearsession.php',
					success:function(r){
						$('#tablaResidenciasLoad').load('residencias/tablaResidencias.php');
					}
				});
			});
		});
	</script>