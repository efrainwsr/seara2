<?php 
session_start();

require_once "../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();

 // unset($_SESSION['consulta']);

?>

<!DOCTYPE html>
<html>
<head>
  <script src="../librerias/jquery-3.2.1.min.js"></script>
	<?php require_once "menu.php" ?>

</head>
<body>

	<div class="container">
    <div id="buscador"></div>
    <div id="tabla"></div>
  </div>

  <!-- Modal para registros nuevos -->


  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Agrega nuevo reporte</h4>
        </div>
        <div class="modal-body">
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
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
            Agregar
          </button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal para edicion de datos -->

  <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
        </div>
        <div class="modal-body">
          <label>Titulo</label>
          <input type="text" name="nombreRV" id="nombreRV" class="form-control input-sm">
          
          <!--SELECT DE VEHICULOS -->
          <label>Vehiculo</label>
          <select class="form-control input-sm" id="vehiculoRV" name="vehiculoRV">
            <option value="A">Selecciona</option>
            <option value="Ninguno">Ninguno</option>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>

        </div>
      </div>
    </div>
  </div>

</body>
</html>


<script type="text/javascript">
   
    $(document).ready(function(){
      //$('#tablaEmpleadoLoad').load("reportes/tablaReportes.php");

      $('#guardarnuevo').click(function(){

        vacios=validarFormVacio('frmReportes');

        if(vacios > 0){
          alertify.alert("Debes llenar todos los campos!");
          return false;
        }


        datos=$('#frmReportes').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"../procesos/reportes/agregarDatos.php",
          success:function(r){

            if(r==1){
                //esta linea es para limpiar al insertar formularios registros
                $('#frmReportes')[0].reset();
                
                $('#tabla').load("reportes/tablaReportes.php");
                alertify.success("Empleado agregado con exito.");
              }else{
                alertify.error("No se pudo agregar el empleado.");
                //alert(r);
              }

            }
          });
     // });

   // });
  </script>


<script type="text/javascript">
  
function agregardatos(idreporte){

      $.ajax({
        type:"POST",
        data:"idreporte=" + idreporte,
        url:"../procesos/reportes/obtenDatosReporte.php",
        success:function(r){
          dato=jQuery.parseJSON(r);
          $('#reporteU').val(dato['id_reporte']);
          $('#nombreU').val(dato['nombre']);
          $('#vehiculoU').val(dato['vehiculo']);
          $('#clienteU').val(dato['cliente']);
          $('#descripcionU').val(dato['descripcion']);
      
        }
      });
    }

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('reportes/tablaReportes.php');
    $('#buscador').load('reportes/buscador.php');
  });
</script>

<script type="text/javascript">
/*  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombreR=$('#nombreR').val();
      vehiculoR=$('#vehiculoR').val();
      clienteR=$('#clienteR').val();
      rutaR=$('#rutaR').val();
      descripcionR=$('#descripcionR').val();
      agregardatos(nombreR,vehiculoR,clienteR,rutaR,descripcionR);
    });



    $('#actualizadatos').click(function(){
      actualizaDatos();
    });

  });*/
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#conjuntoRuta').select2();

  });
</script>
