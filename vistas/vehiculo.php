<?php 

session_start();

if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Vehiculos</title>
		
			<?php require_once "menu.php"; ?>
			<?php require_once "../clases/Conexion.php"; 
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_empleado,nombre
			from empleados";
			$result=mysqli_query($conexion,$sql); 
			?>

		</head>
		<body>

			<div class="container">
				<h1>Vehiculos</h1>
				<div class="row">
					<div class="col-sm-4">
						<form id="frmVehiculos" name="frmVehiculos" enctype="multipart/form-data">
							<!-- Inicion del htm desplegable y el while que pide datos del result de arriba -->
					<!--		<label>Vehiculo</label>
						<select class="form-control input-sm" id="empleadoSelect" name="empleadoSelect">
								<option value="A">Selecciona Empleado</option>
								<option value="0">Sin Empleado</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select> 
					-->
							<!-- Fin -->
							<label>Numero de placa</label>
							<input type="text" maxlength="8" class="form-control input-sm" id="placa" name="placa" placeholder="Ejemplo, GHG8HJU">
							<div id="mensaje1" class="errores"> Campo Requerido</div>
							<label>Capacidad en kg.</label>
							<input type="text" maxlength="7" class="decimal-2-places form-control input-sm" id="capacidad" name="capacidad" placeholder="Ejemplo, 1500 ">
							<div id="mensaje2" class="errores"> Campo Requerido</div>

							<label>Marca</label>
							<input type="text" class="form-control input-sm" id="marca" name="marca" placeholder="Ejemplo, FORD " onkeypress="return soloLetras(event)" />
							<div id="mensaje3" class="errores"> Campo Requerido</div>

							<label>Modelo</label>
							<input type="text" class="form-control input-sm" id="modelo" name="modelo" placeholder="Ejemplo, F-150">
							<div id="mensaje4" class="errores"> Campo Requerido</div>

							<label>Cant. Ruedas</label>
							<input type="text" maxlength="2" class="positive-integer form-control input-sm" id="ruedas" name="ruedas" placeholder="Ejemplo, 4">
							<div id="mensaje5" class="errores"> Campo Requerido</div>

							<label>Rin</label>
							<input type="text" maxlength="2" class="positive-integer form-control input-sm" id="rin" name="rin" placeholder="Ejemplo, 16">
							<div id="mensaje6" class="errores"> Campo Requerido</div>
							<p></p>
							<span id="btnAgregaVehiculo" class="btn btn-primary">Agregar</span>
						</form>	
					</div>
					<div class="col-sm-8">
						<div id="tablaVehiculosLoad"></div>

					</div>
				</div>
			</div>

			<!-- Button trigger modal -->

			<!-- Modal -->
			<div class="modal fade" id="abremodalUpdateVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Actualiza Vehiculo</h4>
						</div>
						<div class="modal-body">
							<form id="frmVehiculoU" name="frmVehiculoU" enctype="multipart/form-data">
						<!--		<label>Empleado</label>
						<select class="form-control input-sm" id="empleadoSelectU" name="empleadoSelectU">
									<option value="A">Selecciona Empleado</option>
									<?php 
									$sql="SELECT id_empleado,nombre
									from empleados";
									$result=mysqli_query($conexion,$sql);
									?>
									<?php while($ver=mysqli_fetch_row($result)): ?>
										<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
									<?php endwhile; ?>
							</select>
					-->	
								<label>Placa</label>
								<input type="text" readonly="" class="form-control input-sm" id="idVehiculo" name="idVehiculo" placeholder="Ejemplo, GHG 8HJU">

								<label>Capacidad</label>
								<input type="text" maxlength="7" class="form-control input-sm decimal-2-places" id="capacidadU" name="capacidadU" placeholder="Ejemplo, 1500">
								<div id="mensaje11" class="errores"> Campo Requerido</div>

								<label>Marca</label>
								<input type="text" class="form-control input-sm" id="marcaU" name="marcaU" placeholder="Ejemplo, FORD">
								<div id="mensaje22" class="errores"> Campo Requerido</div>
								<label>modelo</label>
								<input type="text" class="form-control input-sm" id="modeloU" name="modeloU" placeholder="Ejemplo, F-150">
								<div id="mensaje33" class="errores"> Campo Requerido</div>
								<label>ruedas</label>
								<input type="text" maxlength="2" class="form-control input-sm positive-integer" id="ruedasU" name="ruedasU" placeholder="Ejemplo, 4">
								<div id="mensaje44" class="errores"> Campo Requerido</div>
								<label>Rin</label>
								<input type="text" maxlength="2" class="form-control input-sm positive-integer" id="rinU" name="rinU" placeholder="Ejemplo, 16">
								<div id="mensaje55" class="errores"> Campo Requerido</div>

							</form>
						</div>
						<div class="modal-footer">
							<button id="btnActualizavehiculo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

						</div>
					</div>
				</div>
			</div>


		</body>
		</html>

		<script type="text/javascript">
			function agregaDatosVehiculo(idvehiculo){
				$.ajax({
					type:"POST",
					data:"idvehi=" + idvehiculo,
					url:"../procesos/vehiculos/obtenDatosVehiculo.php",
					success:function(r){
						
						dato=jQuery.parseJSON(r);
						$('#idVehiculo').val(dato['id_vehiculo']);
						//$('#empleadoSelectU').val(dato['id_empleado']);
						$('#placaU').val(dato['placa']);
						$('#capacidadU').val(dato['capacidad']);
						$('#marcaU').val(dato['marca']);
						$('#modeloU').val(dato['modelo']);
						$('#ruedasU').val(dato['cant_ruedas']);
						$('#rinU').val(dato['rin']);
						//$('#placaU').val(dato['placa']);


					}
				});
			}

			function eliminaVehiculo(idvehiculo){
				alertify.confirm('Desea eliminar este vehiculo?', function(){ 
					$.ajax({
						type:"POST",
						data:"idvehiculo=" + idvehiculo,
						url:"../procesos/vehiculos/eliminarVehiculo.php",
						success:function(r){
							if(r==1){
								$('#tablaVehiculosLoad').load("vehiculos/tablaVehiculos.php");
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

			function ocultarVehiculo(idvehiculo){
				alertify.confirm('Desea remover este vehiculo?', function(){ 
					$.ajax({
						type:"POST",
						data:"idvehiculo=" + idvehiculo,
						url:"../procesos/vehiculos/removerVehiculo.php",
						success:function(r){
							if(r==1){
								$('#tablaVehiculosLoad').load("vehiculos/tablaVehiculos.php");
								alertify.success("Removido con exito!");
							}else{
								alertify.error("No se pudo Remover");
								alert(r);
							}
						}
					}); 
				}, function(){ alertify.error('Cancelado')
			});

			}

		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#btnActualizavehiculo').click(function(){

					vacios=validarFormVacio('frmVehiculoU');

					if(vacios > 0){
						//alertify.alert("Debes llenar todos los campos!");
						return false;
					}
				
					datos=$('#frmVehiculoU').serialize();
					$.ajax({
						type:"POST",
						data:datos,
						url:"../procesos/vehiculos/actualizaVehiculos.php",
						success:function(r){
							if(r==1){
								$('#tablaVehiculosLoad').load("vehiculos/tablaVehiculos.php");
								alertify.success("Actualizado con exito.");
							}else{
								alert(r);
								alertify.error("Error al actualizar.");
							}
						}
					});
				});
			});
		</script>


		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablaVehiculosLoad').load("vehiculos/tablaVehiculos.php");

				$('#btnAgregaVehiculo').click(function(){

					vacios=validarFormVacio('frmVehiculos');

					if(vacios > 0){
						//alertify.alert("Debes llenar todos los campos!");
						return false;
					}

					var formData = new FormData(document.getElementById("frmVehiculos"));

					$.ajax({
						url: "../procesos/vehiculos/insertaVehiculos.php",
						type: "post",
						dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,

						success:function(r){



							if(r == 1){
								$('#frmVehiculos')[0].reset();
								$('#tablaVehiculosLoad').load("vehiculos/tablaVehiculos.php");
								alertify.success("Agregado con exito.");
							}else{
								alertify.error("Vehiculo ya registrado.");
								 document.frmVehiculos.placa.focus()
								//alert(r);

							}
						}
					});

				});
			});
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
		
		<script>
        $(document).ready(function(){
            //función click
            $("#btnAgregaVehiculo").click(function(){
                var placa = $("#placa").val();
                var capacidad = $("#capacidad").val();
                var marca = $("#marca").val();
                var modelo = $("#modelo").val();
                var ruedas = $("#ruedas").val();
                var rin = $("#rin").val();
               
                if(placa == ""){
                    $("#mensaje1").fadeIn("slow");
                    document.frmVehiculos.placa.focus()
                    return false;
                }else{
                	$("#mensaje1").fadeOut();
                }
                    if(capacidad == ""){
                        $("#mensaje2").fadeIn("slow");
                        document.frmVehiculos.capacidad.focus()
                        return false;
                    }
                    else{
                        $("#mensaje2").fadeOut();
 }
                        if(marca == ""){
                            $("#mensaje3").fadeIn("slow");
                            document.frmVehiculos.marca.focus()
                            return false;
                        }
                        else{
                            $("#mensaje3").fadeOut();
                        }
                        if(modelo == ""){
                            $("#mensaje4").fadeIn("slow");
                            document.frmVehiculos.modelo.focus()
                            return false;
                        }
                        else{
                            $("#mensaje4").fadeOut();
                        }
                        if(ruedas == ""){
                            $("#mensaje5").fadeIn("slow");
                            document.frmVehiculos.ruedas.focus()
                            return false;
                        }
                        else{
                            $("#mensaje5").fadeOut();
                        }
                        if(rin == ""){
                            $("#mensaje6").fadeIn("slow");
                            document.frmVehiculos.rin.focus()
                            return false;
                        }
                        else{
                            $("#mensaje6").fadeOut();
                        }
                    
            });//click
       });//ready
    </script>

    <script>
        $(document).ready(function(){
            //función click
            $("#btnActualizavehiculo").click(function(){
                //var placa = $("#placa").val();
                var capacidadU = $("#capacidadU").val();
                var marcaU = $("#marcaU").val();
                var modeloU = $("#modeloU").val();
                var ruedasU = $("#ruedasU").val();
                var rinU = $("#rinU").val();
                       
                    if(capacidadU == ""){
                        $("#mensaje11").fadeIn("slow");
                        document.frmVehiculoU.capacidadU.focus()
                        return false;
                    }
                    else{
                        $("#mensaje11").fadeOut();
 
                        if(marcaU == ""){
                            $("#mensaje22").fadeIn("slow");
                            document.frmVehiculoU.marcaU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje22").fadeOut();
                        }
                        if(modeloU == ""){
                            $("#mensaje33").fadeIn("slow");
                            document.frmVehiculoU.modeloU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje33").fadeOut();
                        }
                        if(ruedasU == ""){
                            $("#mensaje44").fadeIn("slow");
                            document.frmVehiculoU.ruedasU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje44").fadeOut();
                        }
                        if(rinU == ""){
                            $("#mensaje55").fadeIn("slow");
                            document.frmVehiculoU.rinU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje55").fadeOut();
                        }
                    }
            });//click
       });//ready
    </script>



		<?php


	}else{
		header("location:../index.php");
	}

	?>

