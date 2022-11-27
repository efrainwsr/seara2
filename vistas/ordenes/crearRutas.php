<?php

require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
?>

<br>
<h4>Crear ruta</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmCrearRutas">
			<label>Nombre de la Ruta</label>
			<input type="text" class="form-control input-sm" id="nombreRuta" name="nombreRuta" placeholder="Ruta av atlantico" maxlength="45">

 		<!--
			<label>Dias</label>
			<input type="text" class="form-control input-sm" id="diaV" name="diaV" placeholder="Lunes-viernes" maxlength="20">

		-->
		<!-- Default checkbox inline -->
		<br>
		<label>Dias</label>
			<div>
				<input type="checkbox" hidden="" name="diaV[]" value=" ">
			<label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Lunes">L
		    </label>
		    <label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Martes">M
		    </label>
		    <label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Miercoles">MM
		    </label>
		    <label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Jueves">J
		    </label>
		    <label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Viernes">V
		    </label>
		    <label class="checkbox-inline">
		      <input type="checkbox"  name="diaV[]" value="Sabado">S
		    </label> 
		   </div>
		<!-- End checkbox -->
		<br>
			<label>Residencia</label>
			<select class="form-control input-sm" id="conjuntoRuta" name="conjuntoRuta">
				<option value="A">Selecciona</option>
				<?php 
				$sql="SELECT id_residencia,nombre 
				from residencia where ver !='0' AND ver!='666'";
				$result=mysqli_query($conexion,$sql);
				while ($residencia=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $residencia[0] ?>"><?php echo $residencia[1]; ?></option>
				<?php endwhile; ?>
			</select>
			<label>Direccion</label>
			<textarea readonly="" id="direccionV" name="direccionV" class="form-control input-sm"></textarea>
			<label>Cliente</label>
			<input readonly="" type="text" class="form-control input-sm" id="nombreV" name="nombreV">
			<input readonly="" type="text" class="form-control input-sm" id="idclienteV" name="idclienteV">
			<label>Numero de casas</label>
			<input readonly="" type="text" class="form-control input-sm" id="casasV" name="casasV">
			<p></p>
			<span class="btn btn-primary" id="btnCrearRuta">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarClientes">Vaciar</span>
		</form>
	</div>
	<div class="col-sm-8">
		<div id="tablaRutasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaRutasTempLoad').load("rutas/tablaRutasTemp.php");

		$('#conjuntoRuta').change(function(){
			$.ajax({
				type:"POST",
				data:"idresidencia=" + $('#conjuntoRuta').val(),
				url:"../procesos/rutas/llenarFormRuta.php",
				success:function(r){
				
					dato=jQuery.parseJSON(r);

					//$('#id_clienteV').val(dato['id_cliente']);
					$('#nombreV').val(dato['nombre']);
					$('#direccionV').val(dato['direccion']);
					$('#casasV').val(dato['casas']);
					$('#idclienteV').val(dato['idcliente']);
					//$('#oculto').val(dato['dia']);
				}
			});
		});

		$('#btnCrearRuta').click(function(){
			vacios=validarFormVacio('frmCrearRutas');
			
			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!");
				return false;
			}

			datos=$('#frmCrearRutas').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/rutas/agregaRutaTemp.php",
				success:function(r){
					$('#tablaRutasTempLoad').load("rutas/tablaRutasTemp.php");

				}
			});
		});

		$('#btnVaciarClientes').click(function(){

		$.ajax({
			url:"../procesos/rutas/vaciarTemp.php",
			success:function(r){
				$('#tablaRutasTempLoad').load("rutas/tablaRutasTemp.php");

			}
		});
	});


	});
</script>



<script type="text/javascript">
	function quitarC(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/rutas/quitarcliente.php",
			success:function(r){
				$('#tablaRutasTempLoad').load("rutas/tablaRutasTemp.php");
				alertify.success("Se ha quitado el cliente.");
			}
		});
	}

	function crearRuta(){
		$.ajax({
			url:"../procesos/rutas/crearRuta.php",
			success:function(r){
				if(r > 0){
					$('#tablaRutasTempLoad').load("rutas/tablaRutasTemp.php");
					$('#frmCrearRutas')[0].reset();
				alertify.alert("Ruta creada con exito, consulte la informacion de esta en ver rutas.");
				alertify.success("Ruta creada con exito.");
				}else if(r==0){
					alertify.alert("No hay lista de clientes.");
				}else{
					alertify.error("No se pudo crear la ruta.");
					alert(r);

				}
			}
		});
	}
	

</script>

<script type="text/javascript">
			soloLetras();
		</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#conjuntoRuta').select2();

	});
</script>

