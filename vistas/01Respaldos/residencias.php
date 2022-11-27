<?php 


session_start();
unset($_SESSION['consulta']);
require_once "../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();

if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<script scr="../librerias/jqueryNumeric/jquery.numeric.js"></script>
</script>

	</head>


	<body>
		<h1>Residencias</h1>
		<div class="container">
			<div id="buscador2"></div>
			
			<div class="row">
				<div class="col-sm-3">
					<form id="frmResidencia" name="frmResidencia">

						<label>Residencia *</label>
						<input type="text" class="form-control input-sm" id="conjunto" name="conjunto"placeholder="Edificio/Residencia del cliente" maxlength="45" minlength="3">
						<div id="mensaje1" class="errores"> Campo Requerido</div>

						<label>Cant. Casas *</label>
						<input type="text"  maxlength="4" class="positive-integer form-control input-sm integer" id="casas" name="casas" placeholder="80">
						<div id="mensaje2" class="errores"> Campo Requerido</div>
<!--
						<label>Basura estimada en Kg *</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="kgbasura" name="kgbasura" maxlength="7" placeholder="300">
						<div id="mensaje3" class="errores"> Campo Requerido</div>
-->
						<label>Pago *</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="pago" name="pago" placeholder="Pago mensual del cliente. Ej: 100" maxlength="13">
						<div id="mensaje4" class="errores"> Campo Requerido</div>
<!--
						<label>Direccion *</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion" maxlength="200" placeholder="Av. atlantico, los olivos">
						<div id="mensaje5" class="errores"> Campo Requerido</div>
-->					
						<label>Cliente *</label>
				          <select class="form-control input-sm" id="clienteR" name="clienteR">
				            <?php 
				            $sql="SELECT id_cliente,nombre
				            from cliente where ver !='0'";
				            $result=mysqli_query($conexion,$sql);
				            while ($cliente=mysqli_fetch_row($result)):
				              ?>
				              <option value="<?php echo $cliente[0]?>"><?php echo $cliente[1]." - ".$cliente[0] ?></option>
				            <?php endwhile; ?>
				          </select>
				        <br><br>
<!--
						<label>Ubicaciones</label>
						<br>
						<label>Link en google maps *</label>
						<input type="text" class="form-control input-sm" id="gmap" name="gmap" placeholder="https://goo.gl/maps/1sqEawKoof8ay34g7" maxlength="80">
						<div id="mensaje6" class="errores"> Campo Requerido</div>

						<label>Latitud *</label>
						<input type="text" class="decimal-9-places form-control input-sm" id="latitud" name="latitud" placeholder="8.2608001" maxlength="9">
						<div id="mensaje7" class="errores"> Campo Requerido</div>

						<label>Longitud *</label>
						<input type="text" class="decimal-10-places form-control input-sm" id="longitud" name="longitud" placeholder="-62.7825491" maxlength="11">
						<div id="mensaje8" class="errores"> Campo Requerido</div>
-->
						<br>
						<span class="btn btn-primary" id="btnAgregarResidencia">Agregar</span>
						<!--<span class="btn btn-primary" id="btnAgregarResidencia" onclick="validar()">Agregar</span> -->
					</form>
				</div>
				<div class="col-sm-9">
					<div id="tablaResidenciasLoad"></div>
					<!--<div id="tabla"></div> -->
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalResidenciasUpdate" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Residencia</h4>
					</div>
					<div class="modal-body">
						<form id="frmResidenciasU" name="frmResidenciasU">
							<input type="text" hidden="" id="idresidenciaU" name="idresidenciaU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="conjuntoU" name="conjuntoU">
							<div id="mensaje11" class="errores"> Campo Requerido</div>

							<label>Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<div id="mensaje55" class="errores"> Campo Requerido</div>

							<label>Link de google maps</label>
							<input type="text" class="form-control input-sm" id="gmapU" name="gmapU" maxlength="80">
							<div id="mensaje66" class="errores"> Campo Requerido</div>
							
							<label>Cantidad de casas</label>
							<input type="text" maxlength="4" class="positive-integer form-control input-sm" id="casasU" name="casasU">
							<div id="mensaje22" class="errores"> Campo Requerido</div>

							<label>Basura estimada en Kg.</label>
							<input type="text" maxlength="6" class="decimal-2-places form-control input-sm" id="kgbasuraU" name="kgbasuraU">
							<div id="mensaje33" class="errores"> Campo Requerido</div>

							<label>Pago</label>
							<input type="text" class="decimal-2-places form-control input-sm" id="pagoU" name="pagoU" maxlength="13">
							<div id="mensaje44" class="errores"> Campo Requerido</div>

							
							<label>Latitud</label>
							<input type="text" class="decimal-9-places form-control input-sm" id="latitudU" name="latitudU" placeholder="8.2608001" maxlength="9" >
							<div id="mensaje77" class="errores"> Campo Requerido</div>

							<label>Longitud</label>
							<input type="text" class="decimal-10-places form-control input-sm" id="longitudU" name="longitudU" placeholder="-62.7825491" maxlength="11">
							<div id="mensaje88" class="errores"> Campo Requerido</div>

							<br>
							<label>Cliente</label>
							<input readonly type="text" class="form-control input-sm" id="clienteU" name="clienteU">
							<!-- SELECT DE CLIENTE UPDATE-->
							<label>Cambiar cliente</label>
				            <select class="form-control input-sm" id="clienteRV" name="clienteRV">
				            <!--<option value="A">Selecciona</option>-->
				            <!--<option value="S/C">Ninguno</option>-->
				            <?php 
				            $sql="SELECT id_cliente,nombre
				            from cliente where ver !='0'";
				            $result=mysqli_query($conexion,$sql);
				            while ($cliente=mysqli_fetch_row($result)):
				              ?>
				              <option value="<?php echo $cliente[0]?>"><?php echo $cliente[1]." - ".$cliente[0] ?></option>
				            <?php endwhile; ?>
				          </select>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarResidenciaU" name="btnAgregarResidenciaU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosResidencia(idresidencia){

			$.ajax({
				type:"POST",
				data:"idresidencia=" + idresidencia,
				url:"../procesos/residencias/obtenDatosResidencia.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idresidenciaU').val(dato['id_residencia']);
					$('#conjuntoU').val(dato['conjunto']);
					$('#direccionU').val(dato['direccion']);
					$('#gmapU').val(dato['gmap']);
					$('#casasU').val(dato['casas']);
					$('#kgbasuraU').val(dato['kgbasura']);
					$('#pagoU').val(dato['pago']);
					$('#latitudU').val(dato['latitud']);
					$('#longitudU').val(dato['longitud']);
					$('#clienteU').val(dato['id_cliente','nombreCli']);
					
				}
			});
		}

	/* function eliminarCliente(idcliente){
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
		} */

		function ocultarResidencia(idresidencia){
			alertify.confirm('¿Desea remover esta residencia?', function(){ 
				$.ajax({
					type:"POST",
					data:"idresidencia=" + idresidencia,
					url:"../procesos/residencias/removerResidencia.php",
					success:function(r){
						if(r==1){
							$('#tablaResidenciasLoad').load("residencias/tablaResidencias.php");
							alertify.success("Removido con exito!");
							$('#buscador2').load('residencias/buscador.php');
							$('#residencias').load('residencias.php');
						}else{
							alertify.error("No se pudo Remover.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}


		function mostrarResidencia(idresidencia){
			alertify.confirm('¿Desea reactivar esta residencia?', function(){ 
				$.ajax({
					type:"POST",
					data:"idresidencia=" + idresidencia,
					url:"../procesos/residencias/mostrarResidencia.php",
					success:function(r){
						if(r==1){

							$('#tablaResidenciasLoad').load("residencias/tablaResidencias.php");
							alertify.success("Residencia reactivada");
							$('#buscador2').load('residencias/buscador.php');
							$('#residencias').load('residencias.php');

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
			$('#tablaResidenciasLoad').load("residencias/tablaResidencias.php");

			$('#btnAgregarResidencia').click(function(){

/*				vacios=validarFormVacio('frmResidencia');
				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}
*/
				datos=$('#frmResidencia').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/residencias/agregaResidencia.php",
					success:function(r){

						if(r==1){
							$('#frmResidencia')[0].reset();
							$('#tablaResidenciasLoad').load("residencias/tablaResidencias.php");
							alertify.success("Cliente agregado con exito.");
							$('#buscador').load('residencias/buscador.php');
							$('#clienteRV').load('residencias.php');
						}else{
							alertify.error("Ya existe una residencia con este nombre.");
							document.frmResidencia.conjunto.focus()
							
						}

					}
				}); 
			});

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarResidenciaU').click(function(){
				

				vacios=validarFormVacio('frmResidenciasU');
				if(vacios > 0){
				//alertify.alert("Debes llenar todos los campos.");
				return false;
			}


				datos=$('#frmResidenciasU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/residencias/actualizaResidencia.php",
					success:function(r){

						if(r==1){
							$('#frmResidencia')[0].reset();
							$('#tablaResidenciasLoad').load("residencias/tablaResidencias.php");
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
			$('#tabla').load('residencias/tablaResidencias.php');
			$('#buscador2').load('residencias/buscador.php');
		});
	</script>

	<script type="text/javascript">
		soloLetras();
	</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteR').select2();
		 //$('#clienteRV').select2();
		  $('#clienteRV').select2({
		  	width: '100%',
        dropdownParent: $('#abremodalResidenciasUpdate')
    });
	});

</script>


<script>
        
        $(document).ready(function(){
            //función click
            $("#btnAgregarResidencia").click(function(){
                var nombre = $("#conjunto").val();
                var casas = $("#casas").val();
                var kgbasura = $("#kgbasura").val();
                var pago= $("#pago").val();
                var direccion= $("#direccion").val();
                var gmap= $("#gmap").val();
                var latitud= $("#latitud").val();
                var longitud= $("#longitud").val();
               
                if(nombre == ""){
                    $("#mensaje1").fadeIn("slow");
                    document.frmResidencia.conjunto.focus()
                    return false;
                }else{
                	$("#mensaje1").fadeOut();
                }
                    if(casas == ""){
                        $("#mensaje2").fadeIn("slow");
                        document.frmResidencia.casas.focus()
                        return false;
                    }
                    else{
                        $("#mensaje2").fadeOut();
 					}
                        if(kgbasura == ""){
                            $("#mensaje3").fadeIn("slow");
                            document.frmResidencia.kgbasura.focus()
                            return false;
                        }
                        else{
                            $("#mensaje3").fadeOut();
 						}
                            if(pago == ""){
                                $("#mensaje4").fadeIn("slow");
                                document.frmResidencia.pago.focus()
                                return false;
                            }
                            else{
                            $("#mensaje4").fadeOut();
                        	
                        	}
                        	if(direccion == ""){
                                $("#mensaje5").fadeIn("slow");
                                document.frmResidencia.direccion.focus()
                                return false;
                            }
                            else{
                            $("#mensaje5").fadeOut();
                        	
                        	}
                        	if(gmap == ""){
                                $("#mensaje6").fadeIn("slow");
                                document.frmResidencia.gmap.focus()
                                return false;
                            }
                            else{
                            $("#mensaje6").fadeOut();
                        	
                        	}
                        	if(latitud == ""){
                                $("#mensaje7").fadeIn("slow");
                                document.frmResidencia.latitud.focus()
                                return false;
                            }
                            else{
                            $("#mensaje7").fadeOut();
                        	
                        	}
                        	if(longitud == ""){
                                $("#mensaje8").fadeIn("slow");
                                document.frmResidencia.longitud.focus()
                                return false;
                            }
                            else{
                            $("#mensaje8").fadeOut();
                        	
                        	}
              
            });//click
       });//ready
    </script>


<script>
        
        $(document).ready(function(){
            //función click
            $("#btnAgregarResidenciaU").click(function(){
                var nombreU = $("#conjuntoU").val();
                var casasU = $("#casasU").val();
                var kgbasuraU = $("#kgbasuraU").val();
                var pagoU= $("#pagoU").val();
                var direccionU= $("#direccionU").val();
                var gmapU= $("#gmapU").val();
                var latitudU= $("#latitudU").val();
                var longitudU= $("#longitudU").val();
               
                if(nombreU == ""){
                    $("#mensaje11").fadeIn("slow");
                    document.frmResidenciaU.conjuntoU.focus()
                    return false;
                }else{
                	$("#mensaje11").fadeOut();
                }
                    if(casasU == ""){
                        $("#mensaje22").fadeIn("slow");
                        document.frmResidenciaU.casasU.focus()
                        return false;
                    }
                    else{
                        $("#mensaje22").fadeOut();
 
                        if(kgbasuraU == ""){
                            $("#mensaje33").fadeIn("slow");
                            document.frmResidenciaU.kgbasuraU.focus()
                            return false;
                        }
                        else{
                            $("#mensaje33").fadeOut();
 
                            if(pagoU == ""){
                                $("#mensaje44").fadeIn("slow");
                                document.frmResidenciaU.pagoU.focus()
                                return false;
                            }
                            else{
                            $("#mensaje44").fadeOut();
                        	
                        	}
                        	if(direccionU == ""){
                                $("#mensaje55").fadeIn("slow");
                                document.frmResidenciaU.direccionU.focus()
                                return false;
                            }
                            else{
                            $("#mensaje55").fadeOut();
                        	
                        	}
                        	if(gmapU == ""){
                                $("#mensaje66").fadeIn("slow");
                                document.frmResidenciaU.gmapU.focus()
                                return false;
                            }
                            else{
                            $("#mensaje66").fadeOut();
                        	
                        	}
                        	if(latitudU == ""){
                                $("#mensaje77").fadeIn("slow");
                                document.frmResidenciaU.latitudU.focus()
                                return false;
                            }
                            else{
                            $("#mensaje77").fadeOut();
                        	
                        	}
                        	if(longitudU == ""){
                                $("#mensaje88").fadeIn("slow");
                                document.frmResidenciaU.longitudU.focus()
                                return false;
                            }
                            else{
                            $("#mensaje88").fadeOut();
                        	
                        	}
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

