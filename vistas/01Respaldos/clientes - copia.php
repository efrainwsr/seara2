<?php 

session_start();

if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Inicio</title>
		<?php require_once "menu.php"
			  ?>
			  <script scr="../librerias/jqueryNumeric/jquery.numeric.js"></script> 
	</head>


	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre"placeholder="Juan narvaez">
						<label>Conjunto</label>
						<input type="text" class="form-control input-sm" id="conjunto" name="conjunto"placeholder="Edificio/Residencia del cliente">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Av. atlantico, los olivos">
						<label>Telefono</label>
						<input type="text" maxlength="12" class="form-control input-sm" id="telefono" name="telefono"placeholder="0424-8785432">
						<label>Link en google maps</label>
						<input type="text" class="form-control input-sm" id="gmap" name="gmap" placeholder="https://goo.gl/maps/1sqEawKoof8ay34g7">
						<label>Cant. Casas</label>
						<input type="text"  maxlength="4" class="positive-integer form-control input-sm integer" id="casas" name="casas" placeholder="80">
						<label>Basura estimada en Kg</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="kgbasura" name="kgbasura" placeholder="300">
						<label>Pago</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="pago" name="pago" placeholder="Pago mensual del cliente. Ej: 100">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Conjunto</label>
							<input type="text" class="form-control input-sm" id="conjuntoU" name="conjuntoU">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<label>Telefono</label>
							<input type="text" maxlength="12" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label>Link de google maps</label>
							<input type="text" class="form-control input-sm" id="gmapU" name="gmapU">
							<label>Cantidad de casas</label>
							<input type="text" maxlength="4" class="positive-integer form-control input-sm" id="casasU" name="casasU">
							<label>Basura estimada en Kg.</label>
							<input type="text" maxlength="6" class="decimal-2-places form-control input-sm" id="kgbasuraU" name="kgbasuraU">
							<label>Monto a pagar</label>
							<input type="text" class="decimal-2-places form-control input-sm" id="pagoU" name="pagoU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosCliente(idcliente){

			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idclienteU').val(dato['id_cliente']);
					$('#nombreU').val(dato['nombre']);
					$('#conjuntoU').val(dato['conjunto']);
					$('#direccionU').val(dato['direccion']);
					$('#telefonoU').val(dato['telefono']);
					$('#gmapU').val(dato['gmap']);
					$('#casasU').val(dato['casas']);
					$('#kgbasuraU').val(dato['kgbasura']);
					$('#pagoU').val(dato['pago']);

				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Eliminado con exito!");
						}else{
							alert(r);
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

					vacios=validarFormVacio('frmClientes');

					if(vacios > 0){
						alertify.alert("Debes llenar todos los campos!");
						return false;
					}


					datos=$('#frmClientes').serialize();
					$.ajax({
						type:"POST",
						data:datos,
						url:"../procesos/clientes/agregaCliente.php",
						success:function(r){
							
							if(r==1){
								$('#frmClientes')[0].reset();
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
								alertify.success("Cliente agregado con exito.");
							}else{
								alertify.error("No se pudo agregar el cliente.");
							}

						}
					});
				});

			});
		</script>

		<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Modificado con exito.");
						}else{
							alertify.error("No se pudo modificar.");
						}
					}
				});
			})
		})
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

	<?php


}else{
	header("location:../index.php");
}

?>

