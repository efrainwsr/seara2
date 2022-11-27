<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>


		<script>
		function comprobar(){
			var nombre = document.getElementsByName("divnombre");
			//myDiv.classList.replace("bg_1", "bg_2");
			console.log(nombre);
		}
	</script>





	</head>
	<body>
		<div class="container">
			<h1>Administrar usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro" name="frmRegistro">

				<div name="divname" id="divname" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Nombre</span>
 					<input type="text" name="nombre" id="nombre" maxlength="30" class="form-control"placeholder="Juan" onkeypress="return soloLetras(event)"/>
				</div>

				<div name="divapellido" id="divapellido" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Apellido</span>
 					<input type="text" name="apellido" id="apellido" maxlength="30" class="form-control"placeholder="Perez" onkeypress="return soloLetras(event)"/>
				</div>




				<div name="divusuario" id="divusuario" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Usuario</span>
 					<input type="text" name="usuario" id="usuario" maxlength="30" class="form-control"placeholder="juan.perez" onkeypress="return soloLetras(event)"/>
				</div>

			<div name="divpassword" id="divpassword" class="input-group form-group">
  				<span class="input-group-addon" id="basic-addon1">Contraseña</span>
 					<input type="text" name="password" id="password" maxlength="30"		class="form-control"placeholder="Ingresa tu contraseña" >
			</div>


			<div id="divcargo" class="input-group form-group">
					<span class="input-group-addon" id="basic-addon1">Cargo</span>
 				 	<select class="form-control" id="tipo" name="tipo">
   				 		<option value="A">Seleccione el cargo</option>
   				 		<option value="2">Mesero</option>
    					<option value="3">Cocinero</option>
  					</select>
 				</div>


						<p></p>
						<button class="btn btn-primary" id="registro">Registrar usuario</button>

					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU" name="frmRegistroU">

							<input type="text" hidden="" id="idUsuario" name="idUsuario">


				<div name="modalname" id="modalname" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Nombre</span>
 					<input type="text" name="nombreU" id="nombreU" maxlength="30" class="form-control"placeholder="Juan" onkeypress="return soloLetras(event)"/>
				</div>

				<div name="modalapellido" id="modalapellido" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Apellido</span>
 					<input type="text" name="apellidoU" id="apellidoU" maxlength="30" class="form-control"placeholder="Perez" onkeypress="return soloLetras(event)"/>
				</div>




				<div name="modalusuario" id="modalusuario" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Usuario</span>
 					<input type="text" name="usuarioU" id="usuarioU" maxlength="30" class="form-control"placeholder="juan.perez" onkeypress="return soloLetras(event)"/>
				</div>

			<div name="modalpassword" id="modalpassword" class="input-group form-group">
  				<span class="input-group-addon" id="basic-addon1">Contraseña</span>
 					<input type="text" name="password" id="password" maxlength="30"		class="form-control"placeholder="Ingresa tu contraseña" >
			</div>


			<div id="modalcargo" class="input-group form-group">
					<span class="input-group-addon" id="basic-addon1">Cargo</span>
 				 	<select class="form-control" id="tipo" name="tipo">
   				 		<option value="A">Seleccione el cargo</option>
   				 		<option value="2">Mesero</option>
    					<option value="3">Cocinero</option>
  					</select>
 			</div>









							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU" maxlength="30" onkeypress="return soloLetras(event)" />
							<div id="mensaje11" class="errores"> Campo Requerido</div>
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU" maxlength="30" onkeypress="return soloLetras(event)" />
							<div id="mensaje22" class="errores"> Campo Requerido</div>
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU" maxlength="15">
							<div id="mensaje33" class="errores"> Campo Requerido</div>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" name="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['email']);
				}
			});
		}

		function eliminarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito.");
						}else{
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

		function ocultarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/removerUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito.");
						}else{
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
			$('#btnActualizaUsuario').click(function(){

				vacios=validarFormVacio('frmRegistroU');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Modificacion exitosa.");
						}else{
							alertify.error("No se pudo modificar.");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
			

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito.");
						}else{
							alertify.error("Fallo al agregar.");
						}
					}
				});
			});
		});
	</script>

<script>
        
        $(document).ready(function(){
            //función click
            $("#registro").click(function(){
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var usuario = $("#usuario").val();
                var password = $("#password").val();
                var tipo = $("#tipo").val();
               
                if(nombre == ""){
                    var errornombre = document.getElementById('divname');
                    errornombre.className = "input-group has-error form-group";
                
                }else{
                	errornombre.className = "input-group form-group";
                }
                    if(apellido == ""){
                        //document.frmRegistro.apellido.focus()
                        let errorapellido = document.getElementById('divapellido');
                    	errorapellido.className = "input-group has-error form-group";

                    }else{
                        
                    }
                    if(usuario == ""){
                        let errorusuario = document.getElementById('divusuario');
                    	errorusuario.className = "input-group has-error form-group";
                            /*$("#mensaje3").fadeIn("slow");
                            document.frmRegistro.telefono.focus()*/
                            //return false;
                        }
                        else{
                            //$("#mensaje3").fadeOut();
                        }
                     if(password == ""){
                        let divpassword = document.getElementById('divpassword');
                    	divpassword.className = "input-group has-error form-group";

                           /* $("#mensaje4").fadeIn("slow");
                            document.frmRegistro.password.focus()
                            return false; */
                        }
                        else{
                           
                        }

                     if(tipo == "A" ){
                        var errorcargo = document.getElementById('divcargo');
                    	errorcargo.className = "input-group has-error form-group";

                    }else{
                        	errorcargo.className = "input-group form-group";
 						}
                    
            });//click
       });//ready
    </script>

    <script>
        
        $(document).ready(function(){
            //función click
            $("#btnActualizaUsuario").click(function(){
                var nombreU = $("#nombreU").val();
                var apellidoU = $("#apellidoU").val();
                var usuarioU = $("#usuarioU").val();         
                if(nombreU == ""){
                    $("#mensaje11").fadeIn("slow");
                    document.frmRegistroU.nombre.focus()
                    return false;
                }else{
                	$("#mensaje1").fadeOut();
                }
                    if(apellidoU == ""){
                        $("#mensaje22").fadeIn("slow");
                        document.frmRegistroU.apellidoU.focus()
                        return false;
                    }
                    else{
                        $("#mensaje2").fadeOut();
 			}
                        if(usuarioU == ""){
                            $("#mensaje33").fadeIn("slow");
                            document.frmRegistroU.usuarioU.focus()
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