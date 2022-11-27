<?php 
session_start();
if(isset($_SESSION['usuario'])){

require_once "../clases/Conexion.php";
require_once "menu.php";

  $c= new conectar();
  $conexion=$c->conexion();

$idorden=$_GET['idorden'];

 $sql="SELECT 	 ord.id_orden,
                 ord.id_mesa,
                 ord.id_usuario,
                 ord.fecha,
                 ord.hora,
                 ord.total,
                 ord.status,
                 u.id_usuario,
                 u.nombre,
                 u.apellido
    from orden ord, usuarios u
    where id_orden = '$idorden' and ord.id_usuario=ord.id_usuario group by id_orden";
    $result=mysqli_query($conexion,$sql);
    $ver=mysqli_fetch_row($result);


?>
<div class="container">

<!--
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<?php if($ver[6]==1): ?>
          <div class="thumbnail" style="border-color: #F4D03F;">
          	<?php else: ?>
          		<div class="thumbnail" style="border-color: #5499C7;">
          	<?php endif; ?>

              <div class="caption">
                <div class='col-lg-12'>
                    <span class="glyphicon glyphicon-list-alt"></span>
                    <span class="glyphicon glyphicon-print pull-right text-primary"></span>
                </div>
                    <h4>Orden <?php echo $ver[0]; ?></h4>
                    <h4 class="text-muted">Mesa <?php echo $ver[2]; ?></h4>


                     <div class='col-lg-12'>

                <?php

        $sql="SELECT ord.id_orden, 
                     ord.id_item,
                     ord.cantidad, #2
                     ord.nota,
                     car.id_item,
                     car.nombre,    #5
                     car.variante   #6
          from orden as ord 
          inner join carta as car
          on ord.id_item=car.id_item
          and ord.id_orden='$idorden' AND ord.id_item = car.id_item";
          $result=mysqli_query($conexion,$sql);
            
            while($res=mysqli_fetch_row($result)):
    ?>
       <p class=""><strong><?php echo $res[2]." ".$res[5]." ".$res[6]."   ".$res[3]; ?> </strong></p>


     <?php endwhile; ?>       
                </div>




                <div class='col-lg-12'>
                    <p class="text-muted">Hora: <?php echo $ver[4]; ?> </p>
                    <p class="text-muted">Total:<?php echo " ".number_format($ver[5], 2)." €"; ?> </p>
                </div>

                <h5 class="text-muted">Acciones: </h5>

                <?php if($ver[6]==1): ?>
          			<button type="button" class="btn btn-warning btn-xs btn-update btn-add-card" onclick="aceptarOrden('<?php echo $ver[0]; ?>')">Recibida</button>
          		<?php elseif($ver[6]==2): ?>
          			<button type="button" class="btn btn-success btn-xs btn-update btn-add-card" onclick="terminarOrden('<?php echo $ver[0]; ?>')">Terminada</button>
          		<?php endif; ?>


            </div>
          </div>
      </div>
     </div> -->



<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <?php if($ver[6]==1): ?>
          <div class="thumbnail" style="border-color: #F4D03F;">
            <?php else: ?>
                <div class="thumbnail" style="border-color: #5499C7;">
            <?php endif; ?>

              <div class="caption">
                <div class='col-lg-12'>
                    <span class="glyphicon glyphicon-list-alt"></span>
                    <span class="glyphicon glyphicon-print pull-right text-primary"></span>
                </div>
                    <h4>Orden <?php echo $ver[0]; ?></h4>
                    <h4 class="text-muted">Mesa <?php echo $ver[2]; ?></h4>


    <div class='col-lg-12'>

    <?php

        $sql="SELECT ord.id_orden, 
                     ord.id_item,
                     ord.cantidad, #2
                     ord.nota,
                     car.id_item,
                     car.nombre,    #5
                     car.variante,   #6
                     car.precio
          from orden as ord 
          inner join carta as car
          on ord.id_item=car.id_item
          and ord.id_orden='$idorden' AND ord.id_item = car.id_item";
          $result=mysqli_query($conexion,$sql);
            
            $res=mysqli_fetch_row($result);
    ?>
        
    </div>

    <table class="table-clean">
        <tr>
            <th class="th-clean">Cant.</th>
            <th class="th-clean">Nombre</th>
            <th class="th-clean">Var.</th>
            <th class="th-clean">Nota</th>
            <th class="th-clean">Precio</th>
        </tr>

        <tr>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo $res[6]; ?></td>
            <td><?php echo $res[4]; ?></td>
            <td><?php echo $res[7]; ?></td>
        </tr>
    </table>



                <div class='col-sm-12'>
        
           <p class="text-muted">Hora: <?php echo $ver[4]; ?> </p>
            <p class="text-muted">Total:<?php echo " ".number_format($ver[5], 2)." €"; ?> </p>
                
                </div>

                <h5 class="text-muted">Acciones: </h5>

                <?php if($ver[6]==1): ?>
                    <button type="button" class="btn btn-warning btn-xs btn-update btn-add-card" onclick="aceptarOrden('<?php echo $ver[0]; ?>')">Recibida</button>
                <?php elseif($ver[6]==2): ?>
                    <button type="button" class="btn btn-success btn-xs btn-update btn-add-card" onclick="terminarOrden('<?php echo $ver[0]; ?>')">Terminada</button>
                <?php endif; ?>


            </div>
          </div>
      </div>
     </div>



    </div>



<!--	<div class="row">

		<span class="btn btn-default" id="volverBtn"><i class="fa-solid fa-arrow-left"></i> Volver</span>
			
	</div>


	<div class="row">

	<table  class="table table-hover table-condensered table-striped" style="text-align: center;">
	<h3 class="text-primary">Orden <?php /*echo $ver[0];*/ ?></h3>
	<h4 class="text-muted">Mesa <?php /*echo $ver[2];*/ ?></h4>
	<tr>
		<th>Nombre</th>
		<th>Cantidad</th>
		<th>Variante</th>
		<th>Nota</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>

	<?php

		$sql="SELECT ord.id_orden,
                 	 ord.id_item,
                 	 ord.id_mesa,
                 	 ord.id_usuario,
                 	 ord.cantidad,
                 	 ord.fecha,
                 	 ord.hora,
                 	 ord.total,
                 	 ord.status,
                 	 ord.nota,
                 	 car.id_item,
                 	 car.nombre,
                 	 car.precio,
                 	 car.variante
          from orden as ord 
          inner join carta as car
          on ord.id_item=car.id_item
          and ord.id_orden='$idorden' AND ord.id_item = car.id_item";
          $result=mysqli_query($conexion,$sql);
			
			while($ver=mysqli_fetch_row($result)):
 	?>

	<tr>
		<td><?php echo $ver[11];  ?></td>
		<td><?php echo $ver[4];  ?></td>
		<td><?php echo $ver[13];  ?></td>
		<td><?php echo $ver[9];	 ?></td>
		<td>
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>		  	
		</td>
		 
		<?php  if($ver[4] != 'Administrador'): ?>
		<td>
			<span class="btn btn-danger btn-xs" onclick="ocultarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td>
	<?php endif; ?>
	</tr>
	<?php endwhile; ?>
</table>

	<div class="row">
			<div class="col-sm-12">
				<span class="btn btn-default" id="volverBtn"><i class="fa-solid fa-arrow-left"></i> Volver</span>
			</div>
		</div>
</div>
</div>
-->

<script>
		
		 function aceptarOrden(idorden){
            alertify.confirm('¿Desea tomar esta orden?', function(){ 
                $.ajax({
                    type:"POST",
                    data:"idorden=" + idorden,
                    url:"../procesos/ordenes/aceptarOrden.php",
                    success:function(r){
                        if(r>0){
                     window.location.href = "inicio.php";
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