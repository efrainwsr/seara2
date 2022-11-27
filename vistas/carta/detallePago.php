<?php 
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();

$idpago=$_GET['idpago'];
$tdolares=0;
$tbolivares=0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>


    <table id="tablax" class="table table-hover table-condensered  table-striped" style="text-align: center;" >

        <thead>
         <th>Cliente</th>
         <th>Residencia</th>
         <th>Casas</th>
         <th>Fecha</th>
         <th>Referencia</th>
         <th>Emisor</th>
         <th>Receptor</th>
         <th>Tasa</th>
         <th>Dolares</th>
         <th>Bolivares</th>
     </thead>
     <tbody>

       <?php
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
       WHERE p.id_pago='$idpago' AND p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente";


       $result=mysqli_query($conexion,$sql);
       $ver=mysqli_fetch_row($result);


        $datos=$ver[2]."||".
        $ver[3]."||".
        $ver[4]."||".
        $ver[5]."||".
        $ver[6]."||".
        $ver[8]."||".
        $ver[9]."||".
        $ver[10]."||".
        $ver[11]."||".
        $ver[12];
        ?> 

        <tr>

            <?php 
            $dolar = number_format($ver[5], 1);  
            $tdolares=$ver[5]+$tdolares;
            $tbolivares=$ver[6]+$tbolivares; ?>
            <td><?php echo $ver[10]; ?></td>
            <td><?php echo $ver[9]; ?></td>
            <td><?php echo $ver[8]; ?></td>
            <td><?php echo $ver[3]; ?></td>
            <td><?php echo $ver[4]; ?></td>
            <td><?php echo $ver[11]; ?></td>
            <td><?php echo $ver[12]; ?></td>
            <td><?php echo number_format($ver[2], 0); ?></td>
            <td><?php echo "$ ".$dolar; ?></td>
            <td><?php echo number_format($ver[6], 0); ?></td> 
        </tr>

    </tbody>
</table>

</div>


</body>
</html>

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
                    sortAscending: ": active para ordenar la columna en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente"
                }
            },
            scrollY: 400,
            lengthMenu: [ [10, 25, -1], [10, 25, "All"] ],
        });
    });

</script>


