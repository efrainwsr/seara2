<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();



$sql="SELECT id_item,
             nombre,
             precio,
             descripcion,
             categoria,
             variante,
             status
        from carta";
$result=mysqli_query($conexion,$sql); 


?>

<div class="table-responsive">
    <table id="tablax" class="table table-hover table-condensered  table-striped" style="text-align: center;" >

        <thead>
           <th>Nombre</th>
           <th>Precio</th>
           <th>Descripcion</th>
           <th>Categoria</th>
           <th>Variante</th>
           <th>Estado</th>
           <?php
           if($_SESSION['cargo']=="Administrador"):
            ?>
            <th>Editar</th>
        <?php endif; ?>
    </thead>


    <tbody class="textTablax">

     <?php while($ver=mysqli_fetch_row($result)){ ?> 

        <tr>
            <td><?php echo $ver[1]; ?></td>
            <td><?php echo number_format($ver[2], 2)." €"; ?></td>
            <td><?php echo $ver[3]; ?></td>
            <td><?php echo $ver[4]; ?></td>
            <td><?php echo $ver[5]; ?></td>
            <td><?php echo $ver[6]; ?></td>

        <?php if($_SESSION['cargo']=="Administrador"): ?>
            <td>
                <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalCartaUpdate" onclick="agregaDatosCarta('<?php echo $ver[0]; ?>')">
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


</script>



