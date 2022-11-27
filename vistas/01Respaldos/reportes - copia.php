<?php 

session_start();
require_once "../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();

if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Inicio</title>
		<?php require_once "menu.php"
			  ?>
			  <script scr="../librerias/jqueryNumeric/jquery.numeric.js"></script> 
	</head>


	<body>
		<div class="container">
			<h1>Reporte diario</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmReportes">
          <label>Titulo</label>
        	<input type="text" name="nombreR" id="nombreR" class="form-control input-sm">
        	
          <!--SELECT DE VEHICULOS -->
          <label>Vehiculo</label>
          <select class="form-control input-sm" id="vehiculoR" name="vehiculoR">
            <option value="A">Selecciona</option>
            <option value="Ninguno">Ninguno</option>
            <?php 
            $sql="SELECT id_vehiculo, modelo 
            from vehiculo";
            $result=mysqli_query($conexion,$sql);
            while ($vehiculo=mysqli_fetch_row($result)):
              ?>
              <option value="<?php echo $vehiculo[1]?>"><?php echo $vehiculo[1]?></option>
            <?php endwhile; ?>
          </select>

          <!-- SELECT DE CLIENTE -->
          <label>Cliente involucrado</label>
          <select class="form-control input-sm" id="clienteR" name="clienteR">
            <option value="A">Selecciona</option>
            <option value="Ninguno">Ninguno</option>
            <?php 
            $sql="SELECT id_cliente,nombre,conjunto 
            from cliente";
            $result=mysqli_query($conexion,$sql);
            while ($cliente=mysqli_fetch_row($result)):
              ?>
              <option value="<?php echo $cliente[2]." ".$cliente[1] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
            <?php endwhile; ?>
          </select>

          <!-- SELECT DE RUTA -->
          <label>Ruta</label>
          <select class="form-control input-sm" id="rutaR" name="rutaR">
            <option value="A">Selecciona</option>
            <option value="Ninguna">Ninguna</option>
            <?php 
            $sql="SELECT id_ruta, nombre_ruta, dia 
            from rutas";
            $result=mysqli_query($conexion,$sql);
            while ($ruta=mysqli_fetch_row($result)):
              ?>
              <option value="<?php echo $ruta[1]?>"><?php echo $ruta[1]." - ".$ruta[2]?></option>
            <?php endwhile; ?>
          </select>

          <label>Descripcion</label>
          <textarea class="form-control" rows="4" name="descripcionR" id="descripcionR"></textarea>
          <p></p>
		  <span class="btn btn-primary" id="btnAgregarReporte">Agregar</span>
        </form>
				</div>
				<div class="col-sm-8">
					<div id="tablaReportesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalReportesUpdate"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar reporte</h4>
					</div>
					<div class="modal-body">
						<form id="frmReportesU">
							<input type="text" hidden="" id="idreporteRV" name="idreporteRV">
							<label>Titulo</label>
          					<input type="text" name="nombreRV" id="nombreRV" class="form-control input-sm">
          
          <!--SELECT DE VEHICULOS -->
				          <label>Vehiculo</label>
				          <select class="form-control input-sm" id="vehiculoRV" name="vehiculoRV">
				            <option value="A">Selecciona</option>
				            <option selected="true" value="Ninguno">Ninguno</option>
				            <?php 
				            $sql="SELECT id_vehiculo, modelo 
				            from vehiculo";
				            $result=mysqli_query($conexion,$sql);
				            while ($vehiculo=mysqli_fetch_row($result)):
				              ?>
				              <option value="<?php echo $vehiculo[0]?>"><?php echo $vehiculo[1]?></option>

				            <?php endwhile; ?>
				          </select>

          <!-- SELECT DE CLIENTE -->
				          <label>Cliente involucrado</label>
				          <select class="form-control input-sm" id="clienteRV" name="clienteRV">
				            <option value="A">Selecciona</option>
				            <?php 
				            $sql="SELECT id_cliente,nombre,conjunto 
				            from cliente";
				            $result=mysqli_query($conexion,$sql);
				            while ($cliente=mysqli_fetch_row($result)):
				              ?>
				              <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
				            <?php endwhile; ?>
				          </select>

          <!-- SELECT DE RUTA -->
				          <label>Ruta</label>
				          <select class="form-control input-sm" id="rutaRV" name="rutaRV">
				            <option value="A">Selecciona</option>
				            <option value="Ninguna">Ninguna</option>
				            <?php 
				            $sql="SELECT id_ruta, nombre_ruta, dia 
				            from rutas";
				            $result=mysqli_query($conexion,$sql);
				            while ($ruta=mysqli_fetch_row($result)):
				              ?>
				              <option value="<?php echo $ruta[0]?>"><?php echo $ruta[1]." - ".$ruta[2]?></option>
				            <?php endwhile; ?>
				          </select>

          <label>Descripcion</label>
          <textarea class="form-control" rows="4" name="descripcionRV" id="descripcionRV"></textarea>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarReporteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosReporte(idreporte){

			$.ajax({
				type:"POST",
				data:"idreporte=" + idreporte,
				url:"../procesos/reportes/obtenDatosReporte.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					  $('#idreporteRV').val(dato['id_reportes']);
			          $('#nombreRV').val(dato['nombre']);
			          $('#vehiculoRV').val(dato['vehiculo']);
			          $('#clienteRV').val(dato['cliente']);
			          $('#rutaRV').val(dato['ruta']);
			          $('#descripcionRV').val(dato['descripcion']);

				}
			});
		}

		function eliminaReporte(idreporte){
			alertify.confirm('¿Desea eliminar este reporte?', function(){ 
				$.ajax({
					type:"POST",
					data:"idreporte=" + idreporte,
					url:"../procesos/reportes/eliminarReporte.php",
					success:function(r){
						if(r==1){
							$('#tablaReportesLoad').load("reportes/tablaReportes.php");
							alertify.success("Eliminado con exito!");
						}else{
							alert(r);
							alertify.error("No se pudo eliminar.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaReportesLoad').load("reportes/tablaReportes.php");

			$('#btnAgregarReporte').click(function(){

					vacios=validarFormVacio('frmReportes');

					/*if(vacios > 0){
						alertify.alert("Debes llenar todos los campos!");
						return false;
					}*/


					datos=$('#frmReportes').serialize();
					$.ajax({
						type:"POST",
						data:datos,
						url:"../procesos/reportes/agregaReporte.php",
						success:function(r){
							
							if(r==1){
								$('#frmReportes')[0].reset();
								$('#tablaReportesLoad').load("reportes/tablaReportes.php");
								alertify.success("Reporte creado con exito.");
							}else{
								alertify.error("No se pudo crear el reporte.");
								
							}

						}
					});
				});

			});
		</script>

		<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarReporteU').click(function(){
				datos=$('#frmReportesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/reportes/actualizaReporte.php",
					success:function(r){

						if(r==1){
							$('#frmReportes')[0].reset();
							$('#tablaReportesLoad').load("reportes/tablareportes.php");
							alertify.success("Modificado con exito.");
						}else{
							alertify.error("No se pudo modificar.");
						}
					}
				});
			})
		})
	</script>

	<script type="text/javascript">

	$(document).ready(function(){
		validarNumeros()
	});

	function validarNumeros(){
		$(".numeric").numeric();
		$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
		$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
		$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
		$(".decimal-2-places").numeric({ decimalPlaces: 2 });
		$(".decimal-3-places").numeric({ decimalPlaces: 3 });
		$("#remove").click(
			function(e)
			{
				e.preventDefault();
				$(".numeric,.integer,.positive,.positive-integer,.decimal-2-places").removeNumeric();
			}
			);
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#vehiculoR').select2();
		$('#vehiculoRV').select2();
		$('#clienteR').select2();
		$('#clienteRV').select2();
		$('#rutaR').select2();
		$('#rutaRV').select2();
		width: '100%',
		dropdownParent: $('#abremodalReportesUpdate')

	});
</script>

	<?php


}else{
	header("location:../index.php");
}

?>