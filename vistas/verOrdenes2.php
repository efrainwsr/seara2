<?php 

	session_start();
	//print_r($_SESSION['tablaRutasTemp']);

 ?>



 <div class="table-responsive">
 <table class="table  table-hover table-condensed table-striped" style="text-align: center;">
 	<caption>
 		<span class="btn btn-success" onclick="crearRuta()"> Generar Ruta
 			<span class="glyphicon glyphicon-road"></span>
 		</span>
 	</caption>
 	<tr>
 		<th>Residencia</th>
 		<th>Cliente</th>
 		<th>Casas</th>
 		<th>Kg. Basura</th>
 		<th>Ver en Gmap</th>
 		<th>Quitar</th>
 	</tr>
 	<?php 
 	$totalCasas=0;//esta variable tendra el total de casas acumulado en la ruta
 	$totalBasura=0;
 	$cliente=""; //en esta se guarda el nombre del cliente
 		if(isset($_SESSION['tablaRutasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaRutasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[7] ?></td>
 		<td><?php echo $d[9] ?></td>
 		<td><?php echo $d[4] ?></td>
 		<td><?php echo $d[6] ?></td>
 		<?php $link= $d[5]; ?>
 		<td><?php echo '<a href="'.$link.'" target="_blank" title="Ver ubicacion en google maps" >Link</a>'; ?></td>
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarC('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 	 <?php 

 	 	$totalCasas=$totalCasas + $d[4];
 		$i++;
 		$totalBasura=$totalBasura + $d[6];
 	}
 	endif; ?>

 	<tr>
 		<td style="text-align: left;"><strong>Cantidad de casas: </strong><?php echo "".$totalCasas; ?></td>
 	</tr>
 	<tr>
 		<td style="text-align: left;"><strong>Cantidad de basura:</strong> <?php echo "".$totalBasura; ?></td>
 	</tr>

 </table>
</div>
