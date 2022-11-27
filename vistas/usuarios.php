<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
		<script src="../js/usuarios-functions.js"></script>

	</head>
	<body>
		<div class="container">
			<h2>Administrar usuarios</h2>
		
		<div class="row">
			<div class="col-sm-12">
				<span class="btn btn-default" id="volverBtn"><i class="fa-solid fa-arrow-left"></i></span>

				<span class="btn btn-default" data-toggle="modal" data-target="#addUsuarioModal" class="btn btn-primary glyphicon glyphicon-plus" id="addUsuarioBtn" name="addUsuarioBtn"> Crear nuevo usuario</span>
			</div>
		</div>


		<!-- MODAL AEGRGAR USUARIO -->
		
		<div class="modal fade" id="addUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Crear nuevo usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistro" name="frmRegistro">


				<div name="divname" id="divname" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Nombre</span>
 					<input type="text" name="nombre" id="nombre" maxlength="15" class="form-control"placeholder="Juan" onkeypress="return soloLetras(event)"/>
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
   				 		<option value="A">Seleccione el cargo...</option>
   				 		<option value="Administrador">Administrador</option>
   				 		<option value="Cocinero">Cocinero</option>
    					<option value="Mesero">Mesero</option>
  					</select>
 			</div>
						</form>
					</div>
					<div class="modal-footer">
						<button id="registro" name="registro" type="button" class="btn btn-default btn-sm btn-block" data-dismiss="modal">Crear usuario</button>

					</div>
				</div>
			</div>
		</div>
				<div class="col-12">
					<div id="tablaUsuariosLoad" class="table-responsive"></div>
				</div>
			</div>
		</div>

<!-- FIN MODAL-->



<!-- Modal 		ACTUALIZAR -->

		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
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
 					<input type="text" name="passwordU" id="passwordU" maxlength="30"		class="form-control"placeholder="Ingresa tu contraseña" >
			</div>

			<!--<div name="modalcargo" id="modalcargo" class="input-group form-group">
  				<span class="input-group-addon" id="basic-addon1">Cargo</span>
 					<input type="text" name="tipoU" id="tipoU" maxlength="30"		class="form-control" >
			</div>-->

	
			<!-- <div id="modalcargo" class="input-group form-group">
					<span class="input-group-addon" id="basic-addon1">Cargo</span>
 				 	<select class="form-control" id="tipoU" name="tipoU">
   				 		<option value="A">Seleccione el cargo...</option>
   				 		<option value="Administrador">Administrador</option>
   				 		<option value="Cocinero">Cocinero</option>
    					<option value="Mesero">Mesero</option>
  					</select>
 			</div> -->

 
 			<div name="modalcargo" id="modalcargo" class="input-group form-group">
  				<span class="input-group-addon" id="basic-addon1">Cargo</span>
 					<input type="text" name="tipoU" id="tipoU" maxlength="30"		class="form-control" readonly>
			</div> 
		
		

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" name="btnActualizaUsuario" type="button" class="btn btn-warning btn-block" data-dismiss="modal">Actualiza Usuario</button>

					</div>
				</div>
			</div>
		</div>

	<!-- FIN MODAL-->

	</body>
	</html>

	

    <script>
    		
    	$('#volverBtn').click(function(){
			window.location.href = "inicio.php";
		});

    </script>



	<script type="text/javascript">
			soloLetras();
		</script>

	<?php 
}else{
	header("location:../index.php");
}
?>

