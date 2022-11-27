<?php 

session_start();

if(isset($_SESSION['usuario'])){
	
	$mesActual = date("F, Y");


	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Menú</title>
		<!-- Mostrar en lista desplegable. aqui conecta a la base y manda a un result los datos.
			Luego agregar un while para mostrar en el option.... Linea 35 -->
			<?php require_once "menu.php"; ?>
			<?php require_once "../clases/Conexion.php"; 
			$c= new conectar();
			$conexion=$c->conexion();
			?>
			<!--Fin de la conexion -->

			<script src="../js/carta-functions.js"></script>

		</head>
		<body>

			<div class="container">
				<h2>Menú</h2>

				<div class="row">

					<div class="col-sm-1">
						<span  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#abremodalAgregarItem" id="agregarItem">Agregar nuevo
							<span class="glyphicon glyphicon-plus"></span>
						</span>
					</div>
	
				<!--	<div class="col-sm-2">
						<span  class="btn btn-primary btn-sm" id="historialBtn">Historial
							<span class="glyphicon glyphicon-list-alt"></span>
						</span>
					</div>
				-->

				<!--
					<div class="col-sm-3">
						<div id="totalBs">Total Bolivares:
							<?php echo number_format($totalbs, 0); ?> 
						</div>
					</div>

					<div class="col-sm-2">
						<div id="totalDolares">Total Dolares: 
							<?php echo number_format($totalDolares, 1);?> 
						</div>
					</div>
				-->

				</div>

				<!--<div id="buscador"></div>-->
				<div class="row">
					<div class="col-sm-12">
						<div id="tablaCartaLoad"></div>
						<!--<div id="historial"></div>-->
					</div>
				</div>

				
			</div>



			<!-- Modal AGREGAR -->
			<div class="modal fade" id="abremodalAgregarItem" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar al menú</h4>
						</div>

						<div class="modal-body">
							
							<form id="frmAgregarItem" name="frmAgregarItem" enctype="multipart/form-data">
								
							<!--	<input type="text" hidden="" readonly="" id="idpago" name="idpago"> -->

					<div name="divname" id="divname" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Nombre</span>
 						<input type="text" name="nombre" id="nombre" maxlength="45" class="form-control"placeholder="" onkeypress="return soloLetras(event)"/>
					</div>

					<div name="divprecio" id="divprecio" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Precio</span>
 						<input type="text" name="precio" id="precio" maxlength="15" class="form-control decimal-2-places"placeholder="">
					</div>

					<div id="divcategoria" class="input-group form-group">
							<span class="input-group-addon" id="basic-addon1">Categoria</span>
 				 			<select class="form-control" id="categoria" name="categoria">
   				 				<option selected value="A">Seleccione categoria...</option>
   				 				<option value="Comida">Comida</option>
   				 				<option value="Bebida">Bebida</option>
    							<option value="Postre">Postre</option>
  							</select>
 						</div>


					<div name="divdesc" id="divdesc" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Descripcion</span>
 						<input type="text" name="desc" id="desc" maxlength="45" class="form-control"placeholder="">
					</div>

						

 						<div id="divvariante" class="input-group form-group">
							<span class="input-group-addon" id="basic-addon1">Variante</span>
 				 			<select class="form-control" id="variante" name="variante">
   				 				<option select value="normal">Normal</option>
   				 				<option value="Pequeño">Pequeño</option>
   				 				<option value="Mediano">Mediano</option>
    							<option value="Grande">Grande</option>
    							<option value="Sencillo">Sencillo</option>
    							<option value="Especial">Especial</option>
    							<option value="1/4">1/4</option>
    							<option value="1/2">1/2</option>
    							<option value="3/4">3/4</option>
  							</select>
 						</div>


 					<div name="divstatus" id="divstatus" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">status</span>
 						<select class="form-control" id="status" name="status">
   				 				<option selected value="Disponible">Disponible</option>
   				 				<option value="No disponible">No disponible</option>
  							</select>
					</div>							
							</form>

						</div>
						<div class="modal-footer">
							<button id="btnAgregarItem" name="btnAgregarItem" type="button" 	class="		btn 		btn-default btn-sm btn-block" data-dismiss="modal">Agregar
							</button>
					</div>
					
					</div>
				</div>
			</div>


			<!-- MODAL EDITAR-->


			<div class="modal fade" id="abremodalCartaUpdate" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Editar elemento del menú</h4>
						</div>

						<div class="modal-body">
							
							<form id="frmActualizarItem" name="frmActualizarItem" enctype="multipart/form-data">
								
								<input type="text" hidden="" readonly="" id="iditem" name="iditem">

					<div name="modalname" id="modalname" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Nombre</span>
 						<input type="text" name="nombreU" id="nombreU" maxlength="45" class="form-control"placeholder="" onkeypress="return soloLetras(event)"/>
					</div>

					<div name="modalprecio" id="modalprecio" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Precio</span>
 						<input type="text" name="precioU" id="precioU" maxlength="15" class="form-control decimal-2-places"placeholder="">
					</div>

					<div id="modalcategoria" name="modalcategoria" class="input-group form-group">
							<span class="input-group-addon" id="basic-addon1">Categoria</span>
 				 			<select class="form-control" id="categoriaU" name="categoriaU">
   				 				<option selected value="A">Seleccione categoria...</option>
   				 				<option value="Comida">Comida</option>
   				 				<option value="Bebida">Bebida</option>
    							<option value="Postre">Postre</option>
  							</select>
 						</div>


					<div name="modaldesc"  id="modaldesc" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">Descripcion</span>
 						<input type="text" name="descU" id="descU" maxlength="45" class="form-control"placeholder="">
					</div>

						

 						<div id="modalvariante" name="modalvariante" class="input-group form-group">
							<span class="input-group-addon" id="basic-addon1">Variante</span>
 				 			<select class="form-control" id="varianteU" name="varianteU">
   				 				<option select value="normal">Normal</option>
   				 				<option value="Pequeño">Pequeño</option>
   				 				<option value="Mediano">Mediano</option>
    							<option value="Grande">Grande</option>
    							<option value="Sencillo">Sencillo</option>
    							<option value="Especial">Especial</option>
    							<option value="1/4">1/4</option>
    							<option value="1/2">1/2</option>
    							<option value="3/4">3/4</option>
  							</select>
 						</div>


 					<div name="modalstatus" id="modalstatus" class="input-group form-group">
  						<span class="input-group-addon" id="basic-addon1">status</span>
 						<select class="form-control" id="statusU" name="statusU">
   				 				<option selected value="Disponible">Disponible</option>
   				 				<option value="No disponible">No disponible</option>
  							</select>
					</div>							
							</form>

						</div>
						<div class="modal-footer">
							<button id="btnActualizarItem" name="btnActualizarItem" type="button" 	class="		btn 		btn-default btn-sm btn-block" data-dismiss="modal">Actualizar
							</button>
					</div>
					
					</div>
				</div>
			</div>



		</body>
		</html>

		<script type="text/javascript">
			
		function agregaDatosCarta(iditem){

			$.ajax({
				type:"POST",
				data:"iditem=" + iditem,
				url:"../procesos/carta/obtenDatosCarta.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#iditem').val(dato['id_carta']);
					$('#nombreU').val(dato['nombre']);
					$('#precioU').val(dato['precio']);
					$('#categoriaU').val(dato['categoria']);
					$('#descU').val(dato['descripcion']);
					$('#varianteU').val(dato['variante']);
					$('#statusU').val(dato['status']);
				}
			});
		}


		</script>




		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablaCartaLoad').load('carta/tablaCarta.php');

			
			});
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
			soloLetras();
		</script>


   <script type="text/javascript">
   					

			$(document).ready(function(){

			$('#btnAgregarItem').click(function(){

				datos=$('#frmAgregarItem').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/carta/agregaCarta.php",
					success:function(r){
			

						if(r==1){
							$('#frmAgregarItem')[0].reset();
							$('#tablaCartaLoad').load('carta/tablaCarta.php');
							alertify.success("Agregado con exito.");
						}else{
							alertify.error("Fallo al agregar.");
						}
					}
				});
			});
		});




			$(document).ready(function(){
			$('#btnActualizarItem').click(function(){

				vacios=validarFormVacio('frmActualizarItem');

				if(vacios > 0){
					//alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmActualizarItem').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/carta/actualizaCarta.php",
					success:function(r){

						if(r==1){
							$('#tablaCartaLoad').load('carta/tablaCarta.php');
							alertify.success("Modificacion exitosa.");
						}else{
							alertify.error("No se pudo modificar.");
						}
					}
				});
			});
		});



   </script>



   <script type="text/javascript">
   	$(document).ready(function(){
   		$('#tabla').load('carta/tablaCarta.php');
   		//$('#buscador').load('pagos/buscador.php');
   	});
   </script>




<script type="text/javascript">
    		
   $('#volverBtn').click(function(){
			window.location.href = "inicio.php";
	});

</script>

<!-- DATATABLE -->
<script>
    $(document).ready(function () {
        $('#tablax').DataTable({
            "bLengthChange": false,
            "pageLength": 20,
            responsive: true,

            language: {
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Mostrar _MENU_ resultados",
                info: " ",
                infoEmpty: " ",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontraron datos con tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla.",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo"
                },
                aria: {
                    sortAscending: ": active para ordenar la columna de manera ascendente",
                    sortDescending: ": active para ordenar la columna de manera descendente"
                }
            },
            scrollY: 400,
            lengthMenu: [ [10, 25, -1], [10, 25, "All"] ],
        });
    });


</script>




<?php


}else{
	header("location:../index.php");
}

?>

