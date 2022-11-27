<?php 


session_start();
unset($_SESSION['consulta']);

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
			<div id="buscador"></div>
			
			<div class="row">
				<div class="col-sm-3">
					<form id="frmClientes">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre"placeholder="Juan narvaez" minlength="3" maxlength="30" onkeypress="return soloLetras(event)" />
						
						<label>Cedula</label>
						<input type="text" class="form-control input-sm positive-integer" id="cedula" name="cedula" minlength="7" maxlength="8" placeholder="27999888">
						<label>Conjunto</label>
						<input type="text" class="form-control input-sm" id="conjunto" name="conjunto"placeholder="Edificio/Residencia del cliente" maxlength="45">
						<label>Telefono</label>
						<input type="text" maxlength="11" class="form-control input-sm positive-integer" id="telefono" name="telefono"placeholder="04248785432">
						<label>Cant. Casas</label>
						<input type="text"  maxlength="4" class="positive-integer form-control input-sm integer" id="casas" name="casas" placeholder="80">
						<label>Basura estimada en Kg</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="kgbasura" name="kgbasura" maxlength="7" placeholder="300">
						<label>Pago</label>
						<input type="text" class="decimal-2-places form-control input-sm" id="pago" name="pago" placeholder="Pago mensual del cliente. Ej: 100" maxlength="13">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion" maxlength="200" placeholder="Av. atlantico, los olivos">
						<label>Link en google maps</label>
						<input type="text" class="form-control input-sm" id="gmap" name="gmap" placeholder="https://goo.gl/maps/1sqEawKoof8ay34g7" maxlength="80">
						<label>Latitud</label>
						<input type="text" class="decimal-9-places form-control input-sm" id="latitud" name="latitud" placeholder="8.2608001" maxlength="9">
						<label>Longitud</label>
						<input type="text" class="decimal-10-places form-control input-sm" id="longitud" name="longitud" placeholder="-62.7825491" maxlength="11">
						<br>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
						</form>
					</div>
					<div class="col-sm-9">
						<div id="tablaClientesLoad"></div>
						<!--<div id="tabla"></div> -->
					</div>
				</div>
			</div>

			<!-- Button trigger modal -->


			<!-- Modal -->
			<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
						</div>
						<div class="modal-body">
							<form id="frmClientesU">
								<input type="text" hidden="" id="idclienteU" name="idclienteU">
								<label>Nombre</label>
								<input type="text" class="form-control input-sm" id="nombreU" name="nombreU" onkeypress="return soloLetras(event)" />
								<label>Cedula</label>
								<input type="text" class="form-control input-sm positive-integer" id="cedulaU" name="cedulaU" minlength="7" maxlength="8" placeholder="27999888">
								<label>Conjunto</label>
								<input type="text" class="form-control input-sm" id="conjuntoU" name="conjuntoU">
								<label>Direccion</label>
								<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
								<label>Telefono</label>
								<label>Telefono</label>
								<input type="text" maxlength="11" class="form-control input-sm 		positive-integer" id="telefonoU" name="telefonoU"placeholder="04248785432">
								<label>Link de google maps</label>
								<input type="text" class="form-control input-sm" id="gmapU" name="gmapU" maxlength="80">
								<label>Cantidad de casas</label>
								<input type="text" maxlength="4" class="positive-integer form-control input-sm" id="casasU" name="casasU">
								<label>Basura estimada en Kg.</label>
								<input type="text" maxlength="6" class="decimal-2-places form-control input-sm" id="kgbasuraU" name="kgbasuraU">
								<label>Pago</label>
								<input type="text" class="decimal-2-places form-control input-sm" id="pagoU" name="pagoU" maxlength="13">
								<label>Latitud</label>
								<input type="text" class="decimal-9-places form-control input-sm" id="latitudU" name="latitudU" placeholder="8.2608001" maxlength="9" >
								<label>Longitud</label>
								<input type="text" class="decimal-10-places form-control input-sm" id="longitudU" name="longitudU" placeholder="-62.7825491" maxlength="11">
							</form>
						</div>
						<div class="modal-footer">
							<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

						</div>
					</div>
				</div>
			</div>

		</body>
		</html>

		<script type="text/javascript">
			function agregaDatosCliente(idcliente){

				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/obtenDatosCliente.php",
					success:function(r){
						dato=jQuery.parseJSON(r);
						$('#idclienteU').val(dato['id_cliente']);
						$('#nombreU').val(dato['nombre']);
						$('#conjuntoU').val(dato['conjunto']);
						$('#direccionU').val(dato['direccion']);
						$('#telefonoU').val(dato['telefono']);
						$('#gmapU').val(dato['gmap']);
						$('#casasU').val(dato['casas']);
						$('#kgbasuraU').val(dato['kgbasura']);
						$('#pagoU').val(dato['pago']);
						$('#latitudU').val(dato['latitud']);
						$('#longitudU').val(dato['longitud']);
						$('#cedulaU').val(dato['cedula']);


					}
				});
			}

			function eliminarCliente(idcliente){
				alertify.confirm('¿Desea eliminar este cliente?', function(){ 
					$.ajax({
						type:"POST",
						data:"idcliente=" + idcliente,
						url:"../procesos/clientes/eliminarCliente.php",
						success:function(r){
							if(r==1){
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
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

			function ocultarCliente(idcliente){
				alertify.confirm('¿Desea remover este cliente?', function(){ 
					$.ajax({
						type:"POST",
						data:"idcliente=" + idcliente,
						url:"../procesos/clientes/removerCliente.php",
						success:function(r){
							if(r==1){
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
								alertify.success("Removido con exito!");
							}else{
								alert(r);
								alertify.error("No se pudo Remover.");
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
				$('#tablaClientesLoad').load("clientes/tablaClientes.php");

				$('#btnAgregarCliente').click(function(){

					vacios=validarFormVacio('frmClientes');

					if(vacios > 0){
						alertify.alert("Debes llenar todos los campos!");
						return false;
					} 


					datos=$('#frmClientes').serialize();
					$.ajax({
						type:"POST",
						data:datos,
						url:"../procesos/clientes/agregaCliente.php",
						success:function(r){
							
							if(r==1){
								$('#frmClientes')[0].reset();
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
								alertify.success("Cliente agregado con exito.");
								$('#buscador').load('clientes/buscador.php');
							}else{
								alertify.error("No se pudo agregar el cliente.");
							}

						}
					}); 
				});

			});
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#btnAgregarClienteU').click(function(){
					datos=$('#frmClientesU').serialize();

					$.ajax({
						type:"POST",
						data:datos,
						url:"../procesos/clientes/actualizaCliente.php",
						success:function(r){

							if(r==1){
								$('#frmClientes')[0].reset();
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
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
				$(".decimal-9-places").numeric({ decimalPlaces: 9 });
				$(".decimal-10-places").numeric({ decimalPlaces: 10 });
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
				$('#tabla').load('clientes/tablaClientes.php');
				$('#buscador').load('clientes/buscador.php');
			});
		</script>

		<script type="text/javascript">
			soloLetras();
		</script>
		 <script>


var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización

//Funcion principal
initMap = function () 
{

    //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
           
          },function(error){console.log(error);});
    
}



function setMapa (coords)
{   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);
      
      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
      });
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Carga de la libreria de google maps 

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfpU5g8M7W7KzG41zVHAbGQo_4uKUGWPk&callback=initMap"></script>

		<?php


	}else{
		header("location:../index.php");
	}

	?>

