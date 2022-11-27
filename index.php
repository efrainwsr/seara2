<?php 

	session_start();
	 if(isset($_SESSION['id_usuario'])){
    header('location: vistas/inicio.php');
  }


	require_once "clases/Conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where tipo='Administrador'";
	$result=mysqli_query($conexion,$sql);
	$validar=0;
	if(mysqli_num_rows($result) > 0){
		$validar=1;
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Seara</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/fontawesome.js"></script>
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<link rel="shortcut icon" href="img/menu-logo.png" />


</head>
<body style="background-color: #fff">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-default"> 
					<div class="panel panel-heading">
						<img  style=" display: block; margin-left: auto;
  							margin-right: auto;" src="img/login-logo.png" width="300px" align="center">
					</div>
					<div class="panel panel-body">
					
							
						
			<form id="frmLogin">

				<div name="divname" id="divname" class="input-group form-group">
  					<div class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i> </div>
 					<input type="text" name="usuario" id="usuario" maxlength="30" class="form-control"placeholder="Ingresa tu usuario">
				</div>

				<div name="divusuario" id="divusuario" class="input-group form-group">
  					<div class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></div>
 					<input type="text" name="password" id="password" maxlength="30" class="form-control"placeholder="Ingresa tu contraseña">
				</div>

							<p></p>
							<button class="btn btn-primary btn-sm btn-block" id="entrarSistema" onkeypress="enter()">	Iniciar sesion
							</button>
							<?php if(!$validar): ?>
							<a href="registro.php" class="btn btn-danger btn-sm btn-block">		Registrar
							</a>
							<?php endif; ?>
						</form>
					</div>
				</div> 
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

		vacios=validarFormVacio('frmLogin');

			if(vacios > 0){
				alert("Clave o usuario incorrecto.");
				return false;
			}

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"procesos/regLogin/login.php",
			success:function(r){

				if(r==1){
					window.location="vistas/inicio.php";
				}else{
					alert("No se pudo acceder.");
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
       // var enter = document.getElementById("entrarSistema");
       // angular.element(enter).triggerHandler('click');

        vacios=validarFormVacio('frmLogin');

			if(vacios > 0){
				alert("Clave o usuario incorrecto.");
				return false;
			}

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"procesos/regLogin/login.php",
			success:function(r){

				if(r==1){
					window.location="vistas/inicio.php";
				}else{
					alert("No se pudo acceder.");
				}
			}
		});
    }
}
</script>