<?php 

require_once "../../clases/Conexion.php";
$obj = new conectar();
$conexion= $obj->conexion();

/*
$sql="SELECT id_pago,
fecha
from pagos
group by DATE_FORMAT(fecha, '%m')";
$result=mysqli_query($conexion,$sql);
*/

$hoy=date('Y-m-d');

$sql="SELECT DATE_FORMAT(fecha, '%Y-%m-%d')
from pagos 
GROUP BY MONTH(fecha) , YEAR(fecha)DESC";
$result=mysqli_query($conexion,$sql);



/*
$json= file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
	$datos=json_decode($json, true);
	$dolar = $datos["USD"]["promedio"];
	//var_dump($dolar);

*/

	?>

	<div class="row">


		<div class="form-group row">
			<div class="col-xs-5"></div>

			<button class="btn btn-primary btn-sm" name="actual" id="actual">
				<span class="glyphicon glyphicon-menu-down"> Mes actual</span>
			</button>

			<button class="btn btn-primary btn-sm" name="pasado" id="pasado">
				<span class="glyphicon glyphicon-menu-left" > Mes pasado</span>
			</button>


			<label>Desde:</label>
			<input type="date" name="inicio" id="inicio" value="<?php echo $hoy;?>" min="" max="">

			<label>Hasta:</label>
			<input type="date" name="fin" id="fin" value="<?php echo $hoy;?>" min="" max="">

			<button class="btn btn-primary btn-xs" name="buscar" id="buscar">
				<span class="glyphicon glyphicon-search" ></span>
			</button>

			<button class="btn btn-primary btn-xs" name="clear" id="clear">
				<span class="glyphicon glyphicon-remove" ></span>
			</button>
		</div>



<script type="text/javascript">
	$("#buscar").click(function(){
		inicio =$("#inicio").val();
		fin =$("#fin").val();
		$.ajax({
			url:"pagos/crearsession.php",
			type: "POST",
			data: {
				inicio: inicio,
				fin: fin,
			},
			success:function(r){
				$('#tablaHistorial').load('pagos/tablaHistorial.php');
			}
		});
	});

	$("#actual").click(function(){
		actual ='<?php echo $hoy ?>'
		//pasado =$("#pasado").val();
		$.ajax({
			url:"pagos/pasarActual.php",
			type: "POST",
			data: {
				actual: actual,
				//pasado: pasado,
			},
			success:function(r){
				$('#tablaHistorial').load('pagos/tablaHistorial.php');
			}
		});
	});

	$("#pasado").click(function(){
		pasado ='<?php echo $hoy ?>'
		$.ajax({
			url:"pagos/pasarPasado.php",
			type: "POST",
			data: {
				pasado: pasado,
			},
			success:function(r){
				$('#tablaHistorial').load('pagos/tablaHistorial.php');
			}
		});
	});

	</script>
