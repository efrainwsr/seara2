<?php 

	session_start();
	//print_r($_SESSION['tablaOrdenTemp']);

 ?>



 <div class="table-responsive">
 <table class="table  table-hover table-condensed table-striped" style="text-align: center;">
 	<caption>
 		
 	</caption>
 	<tr>
 		<th>Nombre</th>
 		<th>Cantidad</th>
 		<th>Precio</th>
 		<th>Variante</th>
 		<th>Quitar</th>
 	</tr>
 	<?php 
 	$totalOrden=0;//esta variable tendra el total de casas acumulado en la ruta
    $subtotal=0;
 	
 		
        if(isset($_SESSION['tablaOrdenTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaOrdenTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[6]; ?></td>
 		<td><?php echo $d[2]; ?></td>
 		<td><?php echo $d[4]." €"; ?></td>
 		<td><?php echo $d[5]; ?></td>
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarI('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 	 <?php 
        $subtotal=$d[2]*$d[4];
 	 	$totalOrden=$subtotal+$totalOrden;
        $_SESSION['total']=$totalOrden;
 	
 	}
 	endif; ?>


 </table>

    <tr>
        <td style="text-align: left;"><strong>Total: </strong><?php echo $totalOrden." €"; ?></td>
    </tr>

        <!--<span class="btn btn-success" onclick="crearRuta()"> Generar Ruta
            <span class="glyphicon glyphicon-road"></span>
        </span>-->
</div>
