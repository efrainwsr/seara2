<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();
$tdolares=0;
$tbolivares=0;
$fechaActual=date("Y-m-d");

    // p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente";
$sql="SELECT p.id_pago,
p.id_residencia,
p.tasa,
p.fecha,
p.referencia,
p.dolares,
p.bs,
r.id_residencia,
r.casas,
r.nombre,
cli.nombre,
p.emisor,
p.receptor
from pagos p, residencia r, cliente cli
WHERE p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente 
AND MONTH(p.fecha)=MONTH(CURDATE())";
//AND MONTH(p.fecha)=MONTH(CURDATE()) CONSULTAR SOLO PAGOS DEL MES ACTUAL
$result=mysqli_query($conexion,$sql);

?>

<div class="table-responsive">
    <table id="tablax" class="table table-hover table-condensered  table-striped" style="text-align: center;" >

        <thead>
           <th>Cliente</th>
           <th>Residencia</th>
           <th>Fecha</th>
           <th>Referencia</th>
           <th>Tasa</th>
           <th>Dolares</th>
           <th>Bolivares</th>
           <th>Ver detalles</th>
           <?php
           if($_SESSION['usuario']=="admin"):
            ?>
            <th>Editar</th>
        <?php endif; ?>
    </thead>


    <tbody>

     <?php while($ver=mysqli_fetch_row($result)){ ?> 

        <tr>
            <?php 
            $dolar = number_format($ver[5], 1);  
            $tdolares=$ver[5]+$tdolares;
            $tbolivares=$ver[6]+$tbolivares; ?>

            <td><?php echo $ver[10]; ?></td>
            <td><?php echo $ver[9]; ?></td>
            <td><?php echo $ver[3]; ?></td>
            <td><?php echo $ver[4]; ?></td>
            <td><?php echo number_format($ver[2], 0); ?></td>
            <td><?php echo "$ ".$dolar; ?></td>
            <td><?php echo number_format($ver[6], 0); ?></td>
            <td> <a href="detallePago.php?idpago=<?php echo $ver[0] ?>" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-file"></span>
            </a>
        </td>

        <?php if($_SESSION['usuario']=="admin"): ?>
            <td>
                <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalResidenciasUpdate" onclick="agregaDatosResidencia('<?php echo $ver[0]; ?>')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
            </td>
        <?php endif;?>
    </tr>
        <?php //endwhile; 
    }
    ?>

</tbody>
</table>
</div>




<input id="totalbs" name="totalbs" readonly="" type="text" hidden="" value="<?php echo $tbolivares; ?>">
<input id="totaldolares" name="totaldolares" readonly="" type="text" hidden="" value="<?php echo $tdolares; ?>">

<!-- TOTAL DOLARES -->
<div class="row">
    <div class="col-sm-2">
        <div class="panel panel-success">
          <div class="panel-heading" style="background-color: #265; color: white;" >Total de dolares</div>
          <div class="panel-body">
            <?php echo "$ ".number_format($tdolares, 2);  ?>
        </div>
    </div>
</div>


<!-- TOTAL BOLIVARES -->
<div class="col-sm-2">
    <div class="panel panel-warning">
      <div class="panel-heading" style=" background-color: #fa4;  color: white;">Total de bolivares</div>
      <div class="panel-body">
        <?php echo number_format($tbolivares, 0);  ?>
    </div>
</div>
</div>
<div class="col-sm-8"></div>

</div>


</body>


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



/*
    $(document).ready(function () {
        
        var totalbs=document.getElementById('totalbs').value;
        document.getElementById("bsSuperior").value = totalbs;
    });
    */

</script>


<script type="text/javascript">
    totaldolares =$("#totaldolares").val();
    totalbs =$("#totalbs").val();
    $.ajax({
        url:"../procesos/pagos/pasarTotales.php",
        type: "POST",
        data: {
            totaldolares: totaldolares,
            totalbs: totalbs,
        },
    });
</script>


