<?php 
	require_once "clases/Conexion.php";
	$obj=new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";
	$result=mysqli_query($conexion,$sql);

	if(mysqli_num_rows($result) > 0){
		header("location:index.php");
	}

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<link rel="shortcut icon" href="img/favicon.png" />
</head>


<body>
	<br><br><br>
	<div class="container">
		<div class ="row">
			<div class = "col-sm-4"></div>
			<div class = "col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar administrador</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Contraseña</label>
							<input type="text" class="form-control input-sm" name="password" id="password">

							<input value="1" type="hidden" class="form-control input-sm"  name="tipo" id="tipo">

							<p></p>
							<button onkeypress="enter()" class="btn btn-primary" id="registro">Registrar</button>
							<a href="index.php" class="btn btn-default">Regresar al login</a>
						</form>

					</div>
				</div>
			</div>
			<div class = "col-sm-4"></div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vacios=validarFormVacio('frmRegistro');

			if(vacios > 0){
				alert("Debes llenar todos los campos!");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/registrarUsuario.php",
				success:function(r){

					if(r==1){
						window.location="index.php";
						alert("Agregado con exito");

						
					}else{
						alert("Fallo al agregar");
					}


				}
			});
		});
	});		
</script>


<script>
	function enter(e) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        var enter = document.getElementById("entrarSistema");
        angular.element(enter).triggerHandler('click');
    }
}
</script>