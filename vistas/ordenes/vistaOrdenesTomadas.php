<?php 

	session_start();
    require_once "../../clases/Conexion.php";
    $c= new conectar();
    $conexion=$c->conexion();

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
<h3 class="text-muted">Ordenes aceptadas</h3>

<?php while($ver=mysqli_fetch_row($result)): ?>

    <?php if($ver[8]==2): ?>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="thumbnail" style="border-color: #5499C7;">
              <div class="caption">
                <div class='col-lg-12'>
                    <span class="glyphicon glyphicon-list-alt"></span>
                    <span class="glyphicon glyphicon-print pull-right text-primary"></span>
                </div>
                    <h4>Orden <?php echo $ver[0]; ?></h4>
                    <h4 class="text-muted">Mesa <?php echo $ver[2]; ?></h4>
                    
                <div class='col-lg-12'>
                    <p class="text-muted">Hora: <?php echo $ver[6]; ?> </p>
                    <p class="text-muted">Total:<?php echo " ".number_format($ver[7], 2)." €"; ?> </p>
                </div>

                <h5 class="text-muted">Acciones: </h5>

                <button type="button" class="btn btn-success btn-xs btn-update btn-add-card" onclick="terminarOrden('<?php echo $ver[0]; ?>')">Terminada</button>

                 <a href="detallesOrden.php?idorden=<?php echo $ver[0] ?>">
                <button type="button" class="btn btn-primary btn-xs btn-update btn-add-card">Detalles</button>
            </div>
          </div>
      </div>
    <?php endif; ?>

<?php endwhile; ?>
