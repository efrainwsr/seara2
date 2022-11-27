<?php 

session_start();
if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Empleados</title>
		<?php require_once "menu.php" ?>
	</head>
	<body>

		<div class="container">
			<h1>Empleado</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmEmpleado">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre" placeholder="Ejemplo, Juan narvaez" maxlength="30" onkeypress="return soloLetras(event)">
						<label>Telefono*</label>
						<input type="text" maxlength="12" class="form-control input-sm positive-integer" name="telefono" id="telefono"placeholder="Ejemplo, 04128978765" maxlength="11">
						<label>Observaciones*</label>
						<input type="text" class="form-control input-sm" name="observaciones" id="observaciones" placeholder="Ejemplo, tiempo completo">
						<label>Sueldo*</label>
						<input type="text" class="form-control input-sm decimal-2-places" name="sueldo" id="sueldo" placeholder="Ejemplo, 2000" maxlength="13">
						<label>Cedula*</label>
						<input type="text" class="positive-integer form-control input-sm" name="cedula" id="cedula" placeholder="Ejemplo, 20987234" maxlength="8">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarEmpleado">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaEmpleadoLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="actualizaEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Empleados</h4>
					</div>
					<div class="modal-body">
						<form id="frmEmpleadoU">
							<input type="text" hidden="" id="idempleado" name="idempleado">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU" placeholder="Ejemplo, Juan narvaez" maxlength="30" onkeypress="return soloLetras(event)" />
							<label>Telefono*</label>
							<input type="text" class="positive-integer form-control input-sm" name="telefonoU" id="telefonoU"placeholder="Ejemplo, 04128978765" maxlength="11">
							<label>Observaciones*</label>
							<input type="text" id="observacionesU" name="observacionesU" class="form-control input-sm" placeholder="Ejemplo, tiempo completo" maxlength="200">
							<label>Sueldo*</label>
							<input type="text" class="decimal-2-places form-control input-sm" name="sueldoU" id="sueldoU" placeholder="Ejemplo, 2000" maxlength="13">
							
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaEmpleado" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaEmpleadoLoad').load("empleados/tablaEmpleado.php");

			$('#btnAgregarEmpleado').click(function(){

				vacios=validarFormVacio('frmEmpleado');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!");
					return false;
				}


				datos=$('#frmEmpleado').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/empleados/agregaEmpleado.php",
					success:function(r){

						if(r==1){
								//esta linea es para limpiar al insertar formularios registros
								$('#frmEmpleado')[0].reset();
								
								$('#tablaEmpleadoLoad').load("empleados/tablaEmpleado.php");
								alertify.success("Empleado agregado con exito.");
							}else{
								alertify.error("No se pudo agregar el empleado.");
								//alert(r);
							}

						}
					});
			});

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaEmpleado').click(function(){

				datos=$('#frmEmpleadoU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/empleados/actualizaEmpleado.php",
					success:function(r){
						if(r==1){
							$('#tablaEmpleadoLoad').load("empleados/tablaEmpleado.php");
							alertify.success("Actualizado con exito");
						}else{
							alertify.error("no se pudo actaulizar");
						}
					}
				});
			});
		});
	</script> 

	<script type="text/javascript">

	
		function ocultarEmpleado(idempleado){
			alertify.confirm('Desea remover este empleado?', function(){ 
				$.ajax({
					type:"POST",
					data:"idempleado=" + idempleado,
					url:"../procesos/empleados/removerEmpleados.php",
					success:function(r){
						if(r==1){
							$('#tablaEmpleadoLoad').load("empleados/tablaEmpleado.php");
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar");
							alert(r);
						}
					}
				}); 
			}, function(){ alertify.error('Cancelado')
		});

		}

		function obtenDatosEmpleado(idempleado){
			
			$.ajax({
				type:"POST",
				data:"idempleado=" + idempleado,
				url:"../procesos/empleados/obtenDatosEmpleado.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idempleado').val(dato['id_empleado']);
					$('#nombreU').val(dato['nombre']);
					$('#telefonoU').val(dato['telefono']);
					$('#observacionesU').val(dato['observaciones']);
					$('#sueldoU').val(dato['sueldo']);
					$('#cedulaU').val(dato['cedula']);

				}
			});
		}

		function eliminaEmpleado(idempleado){
			alertify.confirm('Desea eliminar este empleado?', function(){ 
				$.ajax({
					type:"POST",
					data:"idempleado=" + idempleado,
					url:"../procesos/empleados/eliminaEmpleado.php",
					success:function(r){
						if(r==1){
							$('#tablaEmpleadoLoad').load("empleados/tablaEmpleado.php");
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				}); 
			}, function(){ alertify.error('Cancelado')
		});

		}


	</script>

	<script type="text/javascript">
	$(document).ready(function(){
		validarNumeros()
	});

	function validarNumeros(){
		$(".numeric").numeric();
		$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
		$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
		$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
		$(".decimal-2-places").numeric({ decimalPlaces: 2 });
		$(".decimal-3-places").numeric({ decimalPlaces: 3 });
		$("#remove").click(
			function(e)
			{
				e.preventDefault();
				$(".numeric,.integer,.positive,.positive-integer,.decimal-2-places").removeNumeric();
			}
			);
	}
</script>
<script type="text/javascript">
			soloLetras();
		</script>

	<?php


}else{
	header("location:../index.php");
}

?>
