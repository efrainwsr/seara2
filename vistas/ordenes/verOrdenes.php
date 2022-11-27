<?php 

	session_start();
    require_once "../../clases/Conexion.php";
    $c= new conectar();
    $conexion=$c->conexion();

    $total=0;
    $subtotal=0;

    $sql="SELECT ord.id_orden,
                 ord.id_item,
                 ord.id_mesa,
                 ord.id_usuario,
                 ord.cantidad,
                 ord.fecha,
                 ord.hora,
                 ord.total,
                 ord.status,
                 car.id_item,
                 car.nombre,
                 car.precio,
                 car.variante
    from orden ord, carta car 
    where ord.id_orden > 1
    group by ord.id_orden";

    $result=mysqli_query($conexion,$sql);

 ?>
<div class="table-responsive">
 <table id="tablax" class="table table-hover table-condensed table-striped" style="text-align: center;">
    <caption>
    </caption>
    <thead>
        <th>Orden</th>
        <th>Mesa</th>
       <!-- <th>Fecha</th> -->
        <th>Total</th>
        <th>Status</th>
        <th>Detalles</th>
    </thead>


<?php while($ver=mysqli_fetch_row($result)):
  ?>
 	
    <tr>
 		<td><?php echo "Orden ".$ver[0] ?></td>
 		<td><?php echo "Mesa ".$ver[2] ?></td>
 		<!--<td><?php echo $ver[5] ?></td>-->
 		<td><?php echo number_format($ver[7], 2)." €" ?></td>
        <?php if($ver[8]==1): ?>
        <td>
 			<span class="btn btn-default btn-xs" onclick="">Emitida
 			</span>
 		</td>
         <?php endif; ?>
        <?php if($ver[8]==2): ?>
        <td>
            <span class="btn btn-warning btn-xs" onclick="">Aceptada
            </span>
        </td>
        <?php endif; ?>
        <?php if($ver[8]==3): ?>
        <td>
            <span class="btn btn-success btn-xs" onclick="">Entregada
            </span>
        </td>
        <?php endif; ?>
        <td>
            <span class="btn btn-info btn-xs" onclick="">Detalles
            </span>
        </td>
 	</tr>
    <?php  endwhile; ?>
</table>
</div>

 	 


<!--
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="thumbnail">
              <div class="caption">
                <div class='col-lg-12'>
                    <span class="glyphicon glyphicon-list-alt"></span>
                    <span class="glyphicon glyphicon-print pull-right text-primary"></span>
                </div>
                    <h4>Orden <?php echo $ver[0]; ?></h4>
                    <h4 class="text-muted">Mesa <?php echo $ver[2]; ?></h4>
              
                <div class='col-lg-12'>
                    <p class="text-muted">Fecha: <?php echo $ver[5]." - ".$ver[6]; ?> </p>
                    <p class="text-muted">Total:<?php echo $ver[7]." €"; ?> </p>
                </div>

                <button type="button" class="btn btn-warning btn-xs btn-update btn-add-card" onclick="ocultarUsuario('<?php echo $ver[0]; ?>')">Recibida</button>

                <button type="button" class="btn btn-success btn-xs btn-update btn-add-card"  onclick="ocultarUsuario('<?php echo $ver[0]; ?>')">Terminada</button>

                <button type="button" class="btn btn-primary btn-xs btn-update btn-add-card" onclick="ocultarUsuario('<?php echo $ver[0]; ?>')">Detalles</button>
            </div>
          </div>
      </div>
      </div>

-->.


<!-- DATATABLE -->
<script>
    $(document).ready(function () {
        $('#tablax').DataTable({
            "bLengthChange": false,
            "pageLength": 10,
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