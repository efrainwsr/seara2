<?php 

session_start();

if(isset($_SESSION['usuario'])){
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Rutas</title>
	<?php require_once "menu.php" ?>
	
</head>
<body>

	<div class="container">
		
		<h1>Rutas</h1>
		<div class="row">
			<div class="col-sm-12">

				<span class="btn btn-primary glyphicon glyphicon-road" id="crearRutasBtn"> Crear ruta</span>
				<span class="btn btn-primary glyphicon glyphicon-list-alt" id="rutasHechasBtn"> Ver rutas</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="crearRutas"></div>
				<div id="rutasHechas"></div>
			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
			$('#rutasHechas').load('rutas/rutasyReportes.php');
			$('#rutasHechas').show();

		$('#crearRutasBtn').click(function(){
			esconderSeccionRutas();
			$('#crearRutas').load('rutas/crearRutas.php');
			$('#crearRutas').show();
			
		});
		$('#rutasHechasBtn').click(function(){
			esconderSeccionRutas();
			$('#rutasHechas').load('rutas/rutasyReportes.php');
			$('#rutasHechas').show();
		});

		function esconderSeccionRutas(){
			$('#crearRutas').hide();
			$('#rutasHechas').hide();
		}

	});
</script>

<?php


}else{
	header("location:../index.php");}

?>

