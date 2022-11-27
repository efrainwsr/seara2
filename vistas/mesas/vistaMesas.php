<?php
	session_start();
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT * from mesas";
	$result=mysqli_query($conexion,$sql);

 ?>
<script src="../js/mesa-functions.js"></script>


<div class="row">
			<div class="col-sm-12">
				<span  class="btn btn-primary btn-sm" data-toggle="modal" data-target="			#abremodalAgregarItem" id="agregarItem">Agregar mesa
					<!--<span class="glyphicon glyphicon-plus"></span>-->
				</span>

				<span  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#crearOrden" id="btnCrearOrden">Crear nueva orden
					<!--<span class="glyphicon glyphicon-plus"></span>-->
				</span>
			</div>
</div>
	


<div class="row">

			<?php while($ver=mysqli_fetch_row($result)){ ?> 
				
				<?php if($ver[3]==1){
					$status="Disponible";
					}else{
						$status="No Disponible";
					}
				 ?>


				<?php if($ver[3]!=0): ?>

					<div class="col-xs-2">
        				<div class="panel panel-success" data-toggle="modal" data-target="#crearOrden" >

          					<div class="panel-heading" style="background-color: #265; color: white;	" ><?php echo $ver[0]; ?> </div>
          					<div class="panel-body"><?php echo $status; ?></div>
    					</div>
					</div>

				<?php endif; ?>

				<?php if($ver[3]==0): ?>
					<div class="col-xs-2">
        				<div class="panel panel-success">
          					<div class="panel-heading" style="background-color: #f00; color: white;	" >Mesa <?php echo $ver[0]; ?></div>
          					<div class="panel-body"><?php echo $status; ?></div>
    						</div>
						</div>
				<?php endif; ?>

			<?php } ?>



			<!-- MODAL CREAR ORDEN -->
		 
		<div class="modal fade" id="crearOrden" tabindex="-1" name="crearOrden"  role="dialog" aria-labelledby="myModalLabel" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Crear nueva orden</h4>
					</div>
					<div class="modal-body">
						<form id="frmOrden" name="frmOrden" >
	
				
				<div id="divmesa" name="divmesa" class="input-group form-group">
					<span class="input-group-addon" id="basic-addon1">Mesa</span>
 				 	<select class="form-control" id="mesa" name="mesa">
 				 		<option value="A">Seleccione una mesa</option>
 				 	<?php 
						$sql="SELECT id_mesa,status 
							from mesas";
							$result=mysqli_query($conexion,$sql);
						while($ver=mysqli_fetch_row($result)):
							if($ver[1]==1){
								$stat="Disponible";
							}else{
								$stat="No disponible";}
					?>
			<option value="<?php echo $ver[0]; ?>"><?php echo "Mesa ".$ver[0]." - ".$stat; ?></option>
				<?php endwhile; ?>
  					</select>
 				</div>

 	

				<div id="divitem" name="divitem" class="input-group form-group">
					<span class="input-group-addon" id="basic-addon1">Menú</span>
 				 	<select class="form-control" id="item" name="item">
 				 		<option value="A">Seleccione en el menú</option>
 				 	<?php 
						$sql="SELECT id_item,nombre,variante 
							from carta";
							$result=mysqli_query($conexion,$sql);
						while ($carta=mysqli_fetch_row($result)):
					?>
				<option value="<?php echo $carta[0] ?>"><?php echo $carta[1]." ".$carta[2]; ?></option>
				<?php endwhile; ?>
  					</select>
 				</div>

 				<div name="divcantidad" id="divcantidad" class="input-group form-group">
  				<span class="input-group-addon" id="basic-addon1">Cantidad</span>
 				<input type="number" id="cantidad" name="cantidad" min="1" max="15">
				</div>

				<div name="divnota" id="divnota" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Nota</span>
 					<input  type="text" name="nota" id="nota" maxlength="30" class="form-control" value=" ">
				</div>

 				<div name="divnombre" id="divnombre" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Nombre</span>
 					<input readonly type="text" name="nombre" id="nombre" maxlength="30" class="form-control"placeholder="" onkeypress="return soloLetras(event)"/>
				</div>
				

				<div name="divprecio" id="divprecio" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">€</span>
 					<input type="text" name="precio" id="precio" readonly maxlength="15" class="form-control"placeholder="">
				</div>

				<div name="divvariante" id="divvariante" class="input-group form-group">
  					<span class="input-group-addon" id="basic-addon1">Variante</span>
 					<input readonly type="text" name="variante" id="variante" maxlength="30" class="form-control"placeholder="" onkeypress="return soloLetras(event)"/>
				</div>
		</form>
						<div class="row"> 
							<div class="col-sm-12">
							<span class="btn btn-primary btn-sm" id="btnAgregar">Agregar a la orden</span>

							<button id="btnVaciarOrden" name="btnVaciarOrden" type="button" class="btn btn-danger btn-sm">Eliminar orden</button>
						<!--	<span class="btn btn-danger" id="btnVaciarClientes">Vaciar</span> -->
						</div>
						</div>
					

						<div class="row">
							<div class="col-sm-12">
								<div id="tablaOrdenTempLoad"></div>
							</div>
						</div>


					</div>
					<div class="modal-footer">
						<button id="btnCrearOrden" name="btnCrearOrden" type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal" onclick="crearOrden()">Crear orden</button>

						

					</div>

				</div>
			</div>
		</div>

	</div>





<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");

	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	
		new Selectr(document.getElementById('mesa'));
		new Selectr(document.getElementById('item'));

			$('#btnAgergarOrden').click(function(){
			vacios=validarFormVacio('frmOrden');
			
			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmOrden').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ordenes/agregaOrdenTemp.php",
				success:function(r){
					$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");

				}
			});
		});

	});
</script>


<script type="text/javascript">
		$('#item').change(function(){
			$.ajax({
				type:"POST",
				data:"item=" + $('#item').val(),
				url:"../procesos/ordenes/llenarFormOrden.php",
				success:function(r){
				
					dato=jQuery.parseJSON(r);

					//$('#id_clienteV').val(dato['id_cliente']);
					//$('#mesa').val(dato['mesa']);
					$('#item').val(dato['item']);
					$('#nombre').val(dato['nombre']);
					$('#precio').val(dato['precio']);
					$('#variante').val(dato['variante']);
					

					//$('#oculto').val(dato['dia']);
				}
			});
		});
</script>






<script>
	$('#btnAgregar').click(function(){
			vacios=validarFormVacio('frmOrden');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!");
				return false;
			}

			datos=$('#frmOrden').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ordenes/agregaOrdenTemp.php",
				success:function(r){
					$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");

				}
			});
		});
</script>

<script>
	function quitarI(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/ordenes/quitarItem.php",
			success:function(r){
				$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");
				alertify.success("Removido.");
			}
		});
	}
</script>

<script>
	function crearOrden(){
		$.ajax({
			url:"../procesos/ordenes/crearOrden.php",
			success:function(r){
				if(r > 0){
					$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");
					$('#frmOrden')[0].reset();
				alertify.alert("Orden creada con exito.");
				alertify.success("Orden creada con exito.");

					Push.create("Nueva orden.", {
    				body: "Un pedido ha sido realizado",
    				icon: '../img/menu-logo.png',
    				timeout: 10000,
    				onClick: function () {
        			window.focus();
        			this.close();
    				}
				});


				}else if(r==0){
					alertify.alert("Por favor ingrese los datos.");
				}else{
					alertify.error("No se pudo crear la orden.");
					alert(r);

				}
			}
		});
	}
</script>


<script>
	$('#btnVaciarOrden').click(function(){

		$.ajax({
			url:"../procesos/ordenes/vaciarTemp.php",
			success:function(r){
				$('#frmOrden')[0].reset();
				$("#item").val("A");
				$('#tablaOrdenTempLoad').load("ordenes/tablaOrdenTemp.php");

			}
		});
	});
</script>
