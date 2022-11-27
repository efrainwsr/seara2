<?php 

session_start();

if(isset($_SESSION['usuario'])){
	
/*
	//$dolartoday="https://s3.amazonaws.com/dolartoday/data.json";
	$json= file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
	$datos=json_decode($json, true);
	$dolar = round($datos["USD"]["promedio"]);
	$fecha = $datos["_timestamp"]["fecha"];
	$totalbs=$_SESSION['TOTALBS'];
	$totalDolares=$_SESSION['TOTALDOLARES'];

*/

	
	$mesActual = date("F, Y");


	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Pagos</title>
		<!-- Mostrar en lista desplegable. aqui conecta a la base y manda a un result los datos.
			Luego agregar un while para mostrar en el option.... Linea 35 -->
			<?php require_once "menu.php"; ?>
			<?php require_once "../clases/Conexion.php"; 
			$c= new conectar();
			$conexion=$c->conexion();
			?>
			<!--Fin de la conexion -->

		</head>
		<body>

			<div class="container">
				<h2>Pagos <?php echo $mesActual; ?></h2>

				<div class="row">

					<div class="col-sm-1">
						<span  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#abremodalAgregarPago" id="agregarNuevo">Agregar nuevo
							<span class="glyphicon glyphicon-plus"></span>
						</span>
					</div>

					<div class="col-sm-1"></div>
	
				<!--	<div class="col-sm-2">
						<span  class="btn btn-primary btn-sm" id="historialBtn">Historial
							<span class="glyphicon glyphicon-list-alt"></span>
						</span>
					</div>
				-->

				<!--
					<div class="col-sm-3">
						<div id="totalBs">Total Bolivares:
							<?php echo number_format($totalbs, 0); ?> 
						</div>
					</div>

					<div class="col-sm-2">
						<div id="totalDolares">Total Dolares: 
							<?php echo number_format($totalDolares, 1);?> 
						</div>
					</div>
				-->

				</div>

				<!--<div id="buscador"></div>-->
				<div class="row">
					<div class="col-sm-12">
						<div id="tablaPagosLoad"></div>
						<!--<div id="historial"></div>-->
					</div>
				</div>

				
			</div>



			<!-- Modal AGREGAR -->
			<div class="modal fade" id="abremodalAgregarPago" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar Pago</h4>
						</div>
						<div class="modal-body">
							<form id="frmAgregarPago" name="frmAgregarPago" enctype="multipart/form-data">
								
								<input type="text" hidden="" readonly="" id="idpago" name="idpago">

								<label>Residencia</label>
								<select class="form-control input-sm" id="residencia" name="residencia">
									<option value="0">Seleccione un cliente</option>
									<?php 
									$sql="SELECT r.id_residencia,
									r.nombre,
									cli.nombre,
									cli.id_cliente
									from residencia r, cliente cli 
									where r.id_cliente=cli.id_cliente AND r.ver !='0'";
									$result=mysqli_query($conexion,$sql);
									while ($residencia=mysqli_fetch_row($result)):
										?>
										<option value="<?php echo $residencia[0]."-".$residencia[3]; ?>"><?php echo $residencia[1]." - ".$residencia[2] ?></option>
									<?php endwhile; ?>
								</select>
								<div id="mensaje1" class="errores"> Campo Requerido</div>

								<label>Fecha</label>
								<br>
								<input type="date" name="fecha" step="1" min="2020-01-01" value="<?php echo date("Y-m-d");?>">
								<br>


								<label>Banco emisor</label>
								<select class="form-control input-sm" id="bancoE" name="bancoE">
									<option value=" - ">Seleccione uno</option>
									<option value="Venezolano de credito">Venezolano de credito</option>
									<option value="Banesco">Banesco</option>
									<option value="Caroní">Caroní</option>
									<option value="Delsur">Delsur</option>
									<option value="B.N.C">B.N.C</option>
									<option value="B.O.D">B.O.D</option>
									<option value="Banca amiga">Banca amiga</option>
									<option value="BanCaribe">BanCaribe</option>
									<option value="Banco activo">Banco activo</option>
									<option value="Banco Exterior">Exterior</option>
									<option value="Mercantil">Mercantil</option>
									<option value="Banco Plaza">Banco Plaza</option>
									<option value="Banplus">Banplus</option>
									<option value="Bicentenario">Bicentenario</option>
									<option value="Provincial">Provincial</option>
									<option value="Sofitasa">Sofitasa</option>
									<option value="Venezuela">Venezuela</option>
								</select>

								<label>Banco receptor</label>
								<select class="form-control input-sm" id="bancoR" name="bancoR">
									<option value=" - ">Seleccione uno</option>
									<option value="Venezolano de credito">Venezolano de credito</option>
									<option value="Banesco">Banesco</option>
									<option value="Caroní">Caroní</option>
									<option value="Delsur">Delsur</option>
									<option value="B.N.C">B.N.C</option>
									<option value="B.O.D">B.O.D</option>
									<option value="Banca amiga">Banca amiga</option>
									<option value="BanCaribe">BanCaribe</option>
									<option value="Banco activo">Banco activo</option>
									<option value="Banco Exterior">Exterior</option>
									<option value="Mercantil">Mercantil</option>
									<option value="Banco Plaza">Banco Plaza</option>
									<option value="Banplus">Banplus</option>
									<option value="Bicentenario">Bicentenario</option>
									<option value="Provincial">Provincial</option>
									<option value="Sofitasa">Sofitasa</option>
									<option value="Venezuela">Venezuela</option>
								</select>


								<label>Referencia</label>
								<input type="text" class="form-control input-sm positive-integer" id="referencia" name="referencia" maxlength="20" placeholder="Ejemplo 004548">
					
								<label id="labelTasa">Tasa</label>
								<div id="mensajefull" class="" >Complete al menos 2 de estos campos</div>
								<input type="text" maxlength="7" class="form-control input-sm  decimal-2-places" id="tasa" name="tasa" placeholder="Ejemplo 500120" value="<?php //echo $dolar ?>">
								<div id="mensaje2" class="errores" > Campo Requerido</div>
								<div id="mensajeTasa" class="errores2" > ! </div>

								<label>Dolares</label>			
								<input type="text" maxlength="7" class="form-control input-sm decimal-2-places" id="dolares" name="dolares" placeholder="Ejemplo, 80">
								<div id="mensaje3" class="errores"> Campo Requerido</div>
								<div id="mensajeDolares" class="errores2" > ! </div>

								<label>Bolivares</label>
								<input type="text" maxlength="15" class="form-control input-sm decimal-2-places" id="bs" name="bs" placeholder="Ejemplo 155999">
								<div id="mensaje4" class="errores"> Campo Requerido</div>
								<div id="mensajeBs" class="errores2" > ! </div>
							</form>
						</div>
						<div class="modal-footer">
							<button id="btnAgregaPago" type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button>

						</div>
					</div>
				</div>
			</div>


			<!-- Modal EDITAR -->
			<div class="modal fade" id="abremodalAgregarPago" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar Pago</h4>
						</div>
						<div class="modal-body">
							<form id="frmAgregarPago" name="frmAgregarPago" enctype="multipart/form-data">
								
								<input type="text" hidden="" readonly="" id="idpago" name="idpago">

								<label>Residencia</label>
								<select class="form-control input-sm" id="residencia" name="residencia">
									<option value="0">Seleccione un cliente</option>
									<?php 
									$sql="SELECT r.id_residencia,
									r.nombre,
									cli.nombre,
									cli.id_cliente
									from residencia r, cliente cli 
									where r.id_cliente=cli.id_cliente AND r.ver !='0'";
									$result=mysqli_query($conexion,$sql);
									while ($residencia=mysqli_fetch_row($result)):
										?>
										<option value="<?php echo $residencia[0]."-".$residencia[3]; ?>"><?php echo $residencia[1]." - ".$residencia[2] ?></option>
									<?php endwhile; ?>
								</select>

								<label>Fecha</label>
								<br>
								<input type="date" name="fecha" step="1" min="2020-01-01" value="<?php echo date("Y-m-d");?>">
								<div id="mensaje22" class="errores"> Campo Requerido</div>
								<br>


								<label>Banco emisor</label>
								<select class="form-control input-sm" id="bancoE" name="bancoE">
									<option value=" - ">Seleccione uno</option>
									<option value="Venezolano de credito">Venezolano de credito</option>
									<option value="Banesco">Banesco</option>
									<option value="Caroní">Caroní</option>
									<option value="Delsur">Delsur</option>
									<option value="B.N.C">B.N.C</option>
									<option value="B.O.D">B.O.D</option>
									<option value="Banca amiga">Banca amiga</option>
									<option value="BanCaribe">BanCaribe</option>
									<option value="Banco activo">Banco activo</option>
									<option value="Banco Exterior">Exterior</option>
									<option value="Mercantil">Mercantil</option>
									<option value="Banco Plaza">Banco Plaza</option>
									<option value="Banplus">Banplus</option>
									<option value="Bicentenario">Bicentenario</option>
									<option value="Provincial">Provincial</option>
									<option value="Sofitasa">Sofitasa</option>
									<option value="Venezuela">Venezuela</option>
								</select>

								<label>Banco receptor</label>
								<select class="form-control input-sm" id="bancoR" name="bancoR">
									<option value=" - ">Seleccione uno</option>
									<option value="Venezolano de credito">Venezolano de credito</option>
									<option value="Banesco">Banesco</option>
									<option value="Caroní">Caroní</option>
									<option value="Delsur">Delsur</option>
									<option value="B.N.C">B.N.C</option>
									<option value="B.O.D">B.O.D</option>
									<option value="Banca amiga">Banca amiga</option>
									<option value="BanCaribe">BanCaribe</option>
									<option value="Banco activo">Banco activo</option>
									<option value="Banco Exterior">Exterior</option>
									<option value="Mercantil">Mercantil</option>
									<option value="Banco Plaza">Banco Plaza</option>
									<option value="Banplus">Banplus</option>
									<option value="Bicentenario">Bicentenario</option>
									<option value="Provincial">Provincial</option>
									<option value="Sofitasa">Sofitasa</option>
									<option value="Venezuela">Venezuela</option>
								</select>


								<label>Referencia</label>
								<input type="text" class="form-control input-sm positive-integer" id="referencia" name="referencia" maxlength="20" placeholder="Ejemplo 004548">
								<div id="mensaje33" class="errores"> Campo Requerido</div>
					
								
								<input type="text" maxlength="7" class="form-control input-sm  decimal-2-places" id="tasa" name="tasa" placeholder="Ejemplo 500120" value="<?php //echo $dolar ?>">
								<div id="mensaje44" class="errores" > Campo Requerido</div>

								<label>Dolares</label>			
								<input type="text" maxlength="7" class="form-control input-sm decimal-2-places" id="dolares" name="dolares" placeholder="Ejemplo, 80">
								<div id="mensaje55" class="errores"> Campo Requerido</div>

								<label>Bolivares</label>
								<input type="text" maxlength="15" class="form-control input-sm decimal-2-places" id="bs" name="bs" placeholder="Ejemplo 155999">
								<div id="mensaje55" class="errores"> Campo Requerido</div>
							</form>
						</div>
						<div class="modal-footer">
							<button id="btnAgregaPago" type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button>

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
			function registrar(){
				datos=$('#frmAgregarPago').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/pagos/agregaPago.php",
					success:function(r){
						//alert(r);

						if(r==1){
							alertify.success("Agregado con exito.");
							$('#frmAgregarPago')[0].reset();
							$('#tablaPagosLoad').load('pagos/tablaPagos.php');
							$('#residencia')[0].reset();
							
							
						}else{
							alertify.error("Fallo al registrar pago.");
						
						}
					}
				});
			}
		</script>


		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablaPagosLoad').load('pagos/tablaPagos.php');

			
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
            $("#btnAgregaPago").click(function(){

            	var residencia = $("#residencia").val();
            	var tasa = $("#tasa").val();
            	var dolares = $("#dolares").val();
            	var bs = $("#bs").val();
 

            	if(residencia == "0"){
            		$("#mensaje1").fadeIn("slow");
            		document.frmAgregarPago.residencia.focus()
            		return false;
            	}else{
            		$("#mensaje1").fadeOut();
            	}


            	if(tasa=="" && dolares=="" && bs==""){
            		$("#mensajefull").fadeIn("slow");
            		$("#mensajeTasa").fadeIn("slow");
            		$("#mensajeDolares").fadeIn("slow");
            		$("#mensajeBs").fadeIn("slow");
            		document.frmAgregarPago.tasa.focus()
            		return false;
            	}else{
            		$("#mensajefull").fadeOut();
            		$("#mensajeTasa").fadeOut();
            		$("#mensajeBs").fadeOut();
            		$("#mensajeDolares").fadeOut();
            		$("#mensaje4").fadeOut();
            	}


            	if(tasa > 0 && dolares > 0 && bs >0){
            		agregarPago();
            		$("#mensajefull").fadeOut();
            		$("#mensajeTasa").fadeOut();
            		$("#mensajeBs").fadeOut();
            		$("#mensajeDolares").fadeOut();
            		$("#mensaje4").fadeOut();
            	}

            	if (tasa=="" && dolares >0 && bs > 0){
            		agregarPago();
            	}else{
            		
            		$("#mensajeBs").fadeIn("slow");
            		$("#mensajeDolares").fadeIn("slow");
            		$("#mensajefull").fadeIn("slow");
            		document.frmAgregarPago.dolares.focus()
            		return false;
            	}

            	if(dolares=="" && tasa > 0 && bs > 0){
            		agregarPago();
            	}else{
            		
            		$("#mensajeBs").fadeIn("slow");
            		$("#mensajeTasa").fadeIn("slow");
            		$("#mensajefull").fadeIn("slow");
            		document.frmAgregarPago.tasa.focus()
            		return false;	
            	}

            	if(bs=="" && dolares > 0 && tasa > 0){
            		agregarPago();
            	}else{
            		
            		$("#mensajeTasa").fadeIn("slow");
            		$("#mensajeDolares").fadeIn("slow");
            		$("#mensajefull").fadeIn("slow");
            		document.frmAgregarPago.tasa.focus()
            		return false;	
            	}


            /*
            	if(tasa == ""){
            		$("#mensaje2").fadeIn("slow");
            		document.frmAgregarPago.tasa.focus()
            		return false;
            	}
            	else{
            		$("#mensaje2").fadeOut();
            	}
            	if(dolares == ""){
            		$("#mensaje3").fadeIn("slow");
            		document.frmAgregarPago.dolares.focus()
            		return false;
            	}
            	else{
            		$("#mensaje3").fadeOut();
            	}
            	if(bs == ""){
            		$("#mensaje4").fadeIn("slow");
            		document.frmAgregarPago.bs.focus()
            		return false;
            	}
            	else{
            		$("#mensaje4").fadeOut();
            	}
            	*/
            });//click
       });//ready
   </script>


   <script type="text/javascript">
   					
   		function agregarPago(){
				
			datos=$('#frmAgregarPago').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/pagos/agregaPago.php",
					success:function(r){
						//alert(r);

						if(r==1){
							alertify.success("Agregado con exito.");
							$('#frmAgregarPago')[0].reset();
							$('#tablaPagosLoad').load('pagos/tablaPagos.php');
							$('#residencia')[0].reset();	
						}else{
							alertify.error("Fallo al registrar pago.");
						
						}
					}
				});
			}
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

   <script type="text/javascript">
   	$(document).ready(function(){
   		$('#tabla').load('pagos/tablaPagos.php');
   		//$('#buscador').load('pagos/buscador.php');
   	});
   </script>

   <script type="text/javascript"> 			//SELECT2
   $(document).ready(function(){
   	$('#residencia').select2({
   		width: '100%',
   		dropdownParent: $('#abremodalAgregarPago')
   	});

   	$('#bancoE').select2({
   		width: '100%',
   		dropdownParent: $('#abremodalAgregarPago')
   	});
   	$('#bancoR').select2({
   		width: '100%',
   		dropdownParent: $('#abremodalAgregarPago')
   	});

   });

</script>






   <script type="text/javascript">     // FUNCIONES PARA EL CHECKBOX
   /*
   $("#cdolar").on("click", function() {  
   	if ($("#cdolar").length == $("#cdolar:checked").length) {  
   		$("#cbs").prop("checked", false);
   			$("#bs").attr("readonly","readonly"); // nuevo
   			$("#dolares").removeAttr("readonly"); // nuevo
   			//$("#bs").prop("disabled", true);        // anterior 
   			//$("#dolares").prop("disabled", false); // anterior
   			$("#bs").val(" ");
   		} else {
   			//$("#bs").prop("disabled", false);
   			$("#bs").removeAttr("readonly");

   		}  
   	});

   $("#cbs").on("click", function() {  
   	if ($("#cbs").length == $("#cbs:checked").length) {  
   		$("#cdolar").prop("checked", false);
   			$("#dolares").attr("readonly","readonly"); // nuevo
   			$("#bs").removeAttr("readonly"); // nuevo
   			//$("#bs").prop("disabled", false);		//anterior
   			//$("#dolares").prop("disabled", true);   //anterior
   			$("#dolares").val(" ");
   		} else {  
   			//$("#dolares").prop("disabled", false);
   			$("#dolares").removeAttr("readonly");

   		}  
   	});
*/

   </script>



   <script type="text/javascript">

   /*	function validaForm(){
    // Campos de texto
    if($("#residencia").val() == "0"){
    	alert("Seleccione un cliente.");
        $("#residencia").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#apellidos").val() == ""){
    	alert("El campo Apellidos no puede estar vacío.");
    	$("#apellidos").focus();
    	return false;
    }
    if($("#direccion").val() == ""){
    	alert("El campo Dirección no puede estar vacío.");
    	$("#direccion").focus();
    	return false;
    }

    // Checkbox
    if(!$("#mayor").is(":checked")){
    	alert("Debe confirmar que es mayor de 18 años.");
    	return false;
    }

    return true; // Si todo está correcto
}
*/
</script>

<script type="text/javascript">
	/*
	if( $(idForm + " input.require").val() == "" )
	{
		alert("Alguno de los campos son obligatorios");
		return false;
	}
	//Comprobamos si existe input de tipo tel con la clase 'require y validamos su formato
	else if( $(idForm + " input[type='tel'].require").length && !exprTel.test($(idForm + " input[type='tel'].require").val()) ){
		alert("El teléfono no es válido");
		return false;
	}
	//Comprobamos si existe input de tipo email con la clase 'require y validamos su formato
	else if( $(idForm + " input[type='email'].require").length && !exprEmail.test($(idForm + " input[type='email'].require").val()) ){
		alert("El email no es válido");
		return false;
	}
	//Comprobamos si existe input de tipo checkbox con la clase 'require y validamos si esta marcado
	else if( $(idForm + " input[type='checkbox'].require").length && !$(idForm + " input[type='checkbox'].require").prop("checked") ){
		alert("Marca el check porfavor");
		return false;
	}
	//Devuelve true si todo está correcto
	else {
		return true;
	}
*/

</script>




<?php


}else{
	header("location:../index.php");
}

?>

