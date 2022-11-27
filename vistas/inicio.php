<?php 

session_start();

if(isset($_SESSION['id_usuario'])){

	require_once "../clases/Conexion.php";
	$obj = new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT * from mesas";
	$result=mysqli_query($conexion,$sql);


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php require_once "menu.php" ?>

</head>
<body>

	<div class="container">
		<h2>Dashboard</h2>

		<?php if($_SESSION['cargo']=='Mesero' || $_SESSION['cargo']=='Administrador'): ?>
			<div class="row">
				<div class="col-12">
					<div id="vistaMesas"></div>
					
				</div>
			</div>	
	<?php endif; ?>

			<?php if($_SESSION['cargo']=='Cocinero' || $_SESSION['cargo']=='Administrador'): ?>
			<div class="row">
					<div class="col-12">	
						<div id="vistaOrdenesNuevas"></div>
					</div>
			</div>
			<div class="row">
					<div class="col-12">
						<div id="vistaOrdenesTomadas"></div>
					</div>
			</div>
			<?php endif; ?>
			</div>		
		</div>
				
</div>



</body>
</html>

<script>
	$(document).ready(function(){

			$('#vistaMesas').load('mesas/vistaMesas.php');
			$('#vistaOrdenesNuevas').load('ordenes/vistaOrdenesNuevas.php');
			$('#vistaOrdenesTomadas').load('ordenes/vistaOrdenesTomadas.php');
			
		});
</script>


<script>

$(document).ready(function () {
		setInterval(
			function(){
				$('#vistaOrdenesNuevas').load('ordenes/vistaOrdenesNuevas.php');
				//$('#vistaOrdenesTomadas').load('ordenes/vistaOrdenesTomadas.php');
				},5000
			);
});

    
    function aceptarOrden(idorden){
            alertify.confirm('¿Desea tomar esta orden?', function(){ 
                $.ajax({
                    type:"POST",
                    data:"idorden=" + idorden,
                    url:"../procesos/ordenes/aceptarOrden.php",
                    success:function(r){
                        if(r>0){
                     $('#vistaOrdenesNuevas').load('ordenes/vistaOrdenesNuevas.php');
					$('#vistaOrdenesTomadas').load('ordenes/vistaOrdenesTomadas.php');
                            alertify.success("Orden aceptada.");
                        }else{
                            alertify.error("No se pudo aceptar la orden.");
                        }
                    }
                });
            }, function(){ 
                alertify.error('Accion cancelada.')
            });
        }



         function terminarOrden(idorden){
            alertify.confirm('¿Desea terminar esta orden?', function(){ 
                $.ajax({
                    type:"POST",
                    data:"idorden=" + idorden,
                    url:"../procesos/ordenes/terminarOrden.php",
                    success:function(r){
                        if(r==1){
                     $('#vistaOrdenesNuevas').load('ordenes/vistaOrdenesNuevas.php');
					$('#vistaOrdenesTomadas').load('ordenes/vistaOrdenesTomadas.php');
                            alertify.success("Orden terminada.");
                        }else{
                            alertify.error("No se pudo completar la accion.");
                        }
                    }
                });
            }, function(){ 
                alertify.error('Accion cancelada.')
            });
        }
</script>



<?php


}else{
	header("location:../index.php");}

?>
