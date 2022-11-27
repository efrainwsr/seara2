<?php 


session_start();
unset($_SESSION['consulta']);

if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<script scr="../librerias/jqueryNumeric/jquery.numeric.js"></script> 
	</head>


	<body>
		<h1>Clientes</h1>
		<div class="container">
			<div id="buscador"></div>
			
			<div class="row">
				<div class="col-sm-3">
					<form id="frmClientes" name="frmClientes">
						
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre"placeholder="Juan narvaez" minlength="3" maxlength="30" onkeypress="return soloLetras(event)" />
						<div id="mensaje1" class="errores"> Campo Requerido</div>

						<label>Cedula/Rif</label>
						<input type="text" class="form-control input-sm positive-integer" id="id_cliente" name="id_cliente" minlength="7" maxlength="8" placeholder="27999888">
						<div id="mensaje2" class="errores"> Campo Requerido</div>

						<label>Telefono</label>
						<input type="text" maxlength="11" class="form-control input-sm positive-integer" id="telefono" name="telefono"placeholder="04248785432">
						<div id="mensaje3" class="errores"> Campo Requerido</div>

						<br>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				<div class="col-sm-9">
					<div id="tablaClientesLoad"></div>
					<!--<div id="tabla"></div> -->
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
						<form id="frmClientesU" name="frmClientesU">
							<input hidden="" type="text" id="idclienteU" name="idclienteU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU" onkeypress="return soloLetras(event)" />
							<div id="mensaje11" class="errores"> Campo Requerido</div>

							<label>Telefono</label>
							<input type="text" maxlength="11" class="form-control input-sm 		positive-integer" id="telefonoU" name="telefonoU"placeholder="04248785432">
							<div id="mensaje22" class="errores"> Campo Requerido</div>
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
					$('#telefonoU').val(dato['telefono']);

					


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

		function ocultarCliente(idcliente){
			alertify.confirm('¿Seguro que desea remover este cliente? las residencias asociadas ya no seran visibles.', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/removerCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Removido con exito!");
							$('#buscador').load('clientes/buscador.php');
							$('#clientes').load('clientes.php');
						}else{
							alert(r);
							alertify.error("No se pudo Remover.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

		function mostrarCliente(idcliente){
			alertify.confirm('¿Desea reactivar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/mostrarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente reactivado");
							$('#buscador').load('clientes/buscador.php');
							$('#clientes').load('clientes.php');
						}else{
							alert(r);
							alertify.error("No se pudo reactivar");
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
					//alertify.alert("Debes llenar todos los campos!");
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
							$('#buscador').load('clientes/buscador.php');
						}else{
							//alertify.error("No se pudo agregar el cliente.");
							alertify.error("Cliente ya registrado.");
								 document.frmClientes.id_cliente.focus()
						}

					}
				}); 
			});

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){

				vacios=validarFormVacio('frmClientesU');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				} 

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
			$(".decimal-9-places").numeric({ decimalPlaces: 9 });
			$(".decimal-10-places").numeric({ decimalPlaces: 10 });
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
		$(document).ready(function(){
			$('#tabla').load('clientes/tablaClientes.php');
			$('#buscador').load('clientes/buscador.php');
		});
	</script>

	<script>
        
        $(document).ready(function(){
            //función click
            $("#btnAgregarCliente").click(function(){
                var nombre = $("#nombre").val();
                var cedula = $("#id_cliente").val();
                var telefono = $("#telefono").val();
               
                if(nombre == ""){
                    $("#mensaje1").fadeIn("slow");
                    document.frmClientes.nombre.focus()
                    return false;
                }else{
                	$("#mensaje1").fadeOut();
                }
                    if(cedula == ""){
                        $("#mensaje2").fadeIn("slow");
                        document.frmClientes.id_cliente.focus()
                        return false;
                    }
                    else{
                        $("#mensaje2").fadeOut();
 
                        if(telefono == ""){
                            $("#mensaje3").fadeIn("slow");
                            document.frmClientes.telefono.focus()
                            return false;
                        }
                        else{
                            $("#mensaje3").fadeOut();
                        }
                    }
            });//click
       });//ready
    </script>

    <script>
        
        $(document).ready(function(){
            //función click
            $("#btnAgregarClienteU").click(function(){
                var nombreU = $("#nombreU").val();
                var telefonoU = $("#telefonoU").val();
               
                if(nombreU == ""){
                    $("#mensaje11").fadeIn("slow");
                    document.frmClientesU.nombreU.focus()
                    return false;
                }else{
                	$("#mensaje11").fadeOut();
                }
 
                        if(telefonoU == ""){
                            $("#mensaje33").fadeIn("slow");
                            document.frmClientesU.telefonoU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje33").fadeOut();
                        }
            });//click
       });//ready
    </script>

	<script type="text/javascript">
		soloLetras();
	</script>

	<?php


}else{
	header("location:../index.php");
}

?>

