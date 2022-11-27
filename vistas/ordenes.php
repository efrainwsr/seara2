<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Ordenes</title>
		<?php require_once "menu.php"; ?>

	</head>
	<body>
		<div class="container">
			<h2>Ordenes</h2>
		
		<div class="row">
			<div class="col-sm-12">
				<span class="btn btn-default" id="volverBtn"><i class="fa-solid fa-arrow-left"></i></span>

				<span class="btn btn-default" data-toggle="modal" data-target="#" class="btn btn-primary glyphicon glyphicon-plus" id="addUsuarioBtn" name="addUsuarioBtn"> Boton</span>
			</div>
		</div>

		<div class="col-12">
			<div id="verOrdenesLoad"></div>
		</div>

	</body>
	</html>

	

	<script>
		$(document).ready(function(){
			$('#verOrdenesLoad').load('ordenes/verOrdenes.php');
		});
	</script>






    <script>
    		
    	$('#volverBtn').click(function(){
			window.location.href = "inicio.php";
		});

    </script>


	<?php 
}else{
	header("location:../index.php");
}
?>

