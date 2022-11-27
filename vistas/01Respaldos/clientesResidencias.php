<?php 

session_start();

if(isset($_SESSION['usuario'])){
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<?php require_once "menu.php" ?>
	
</head>
<body>

	<div class="container">
		
		
		<div class="row">
			<div class="col-sm-12">
				<br>
				
				<span class="btn btn-primary glyphicon glyphicon-user" id="clientesBtn"> Clientes</span>
				<span class="btn btn-primary glyphicon glyphicon-home" id="residenciasBtn"> Residencias</span>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<div id="clientes"></div>
				<div id="residencias"></div>
			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
			$('#clientes').load('clientes.php');
			$('#clientes').show();

		$('#clientesBtn').click(function(){
			esconderSeccionClientes();
			$('#clientes').load('clientes.php');
			$('#clientes').show();
			
		});
		$('#residenciasBtn').click(function(){
			esconderSeccionClientes();
			$('#residencias').load('residencias.php');
			$('#residencias').show();
		});

		function esconderSeccionClientes(){
			$('#clientes').hide();
			$('#residencias').hide();
		}

	});
</script>

<?php


}else{
	header("location:../index.php");}

?>