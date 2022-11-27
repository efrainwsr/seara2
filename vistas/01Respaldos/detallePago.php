<?php 
session_start();
require_once "../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();

$idpago=$_GET['idpago'];
$tdolares=0;
$tbolivares=0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('menu.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

    <div class="container" style="padding-left: 0px;">


<!--
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
 -->

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
 p.receptor,
 cli.telefono,
 cli.id_cliente,
 r.pago,
 r.gmap
 from pagos p, residencia r, cliente cli
 WHERE p.id_pago='$idpago' AND p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente";


 $result=mysqli_query($conexion,$sql);
 $ver=mysqli_fetch_row($result);

 ?> 

 <?php 
 $dolar = number_format($ver[5], 1);  
 $tdolares=$ver[5]+$tdolares;
 $tbolivares=$ver[6]+$tbolivares; ?>


<!--
     <div class="col-md-5">
        <div class="panel panel-success">
            <div class="panel-heading"  style="background-color: #265; color: white;">
                <h3 class="panel-title">Residencia: <?php echo $ver[9]; ?></h3>
            </div>
            <div class="panel-body">
                <div><strong>Fecha: </strong> <?php echo $ver[3];?>  </div>
                <div> <strong>Cliente: </strong>        <?php echo $ver[10];?> </div>
                <div> <strong>Referencia: </strong>     <?php echo $ver[4];?>  </div>
                <div> <strong>Banco emisor: </strong>   <?php echo $ver[11];?>  </div>
                <div> <strong>Banco receptor: </strong> <?php echo $ver[12];?> </div>
                <div><strong>Tasa: </strong> <?php echo number_format($ver[2], 0); ?> </div>
                <div><strong>Dolares:</strong> <?php echo "$ ".$dolar; ?></div>
                <div><strong>Bolivares:</strong> <?php echo number_format($ver[6], 0);?> </div>
            </div>
            <div class="panel-footer">Panel footer</div>
        </div>
    </div>
-->


<!-- INICIO DETALLES DE PAGO -->

<div class="col-md-5">
    <h4>Detalles de pago</h4>
    <div class="list-group">
        <div class="list-group-item list-group-item-action flex-column align-items-start " style="background-color: #265; color: white;">
                <h4 class="mb-1"><?php echo $ver[9]; ?></h4>
                <small><?php echo $ver[3];?></small>
        </div>

        <span class="list-group-item list-group-item-action"><strong>Cliente: </strong><?php echo $ver[10];?></span>
        <span class="list-group-item list-group-item-action"><strong>Referencia: </strong><?php echo $ver[4];?></span>
        <span class="list-group-item list-group-item-action"><strong>Banco emisor: </strong><?php echo $ver[11];?></span>
        <span class="list-group-item list-group-item-action"><strong>Banco receptor: </strong> <?php echo $ver[12];?></span>
        <span class="list-group-item list-group-item-action"><strong>Tasa: </strong> <?php echo number_format($ver[2], 0); ?></span>
        <span class="list-group-item list-group-item-action"><strong>Dolares:</strong> <?php echo "$ ".$dolar; ?></span>
        <span class="list-group-item list-group-item-action"><strong>Bolivares:</strong> <?php echo number_format($ver[6], 0);?></span>
    </div>
</div>

<!-- FIN DETALLES DE PAGO -->

<div class="col-sm-1"></div>


<!-- INICIO DETALLES DE PAGO -->

<div class="col-md-5">
    <h4>Detalles del cliente</h4>
    <div class="list-group">
        <div class="list-group-item list-group-item-action flex-column align-items-start " style="background-color: #157; color: white;">
            <h4 class="mb-1"><?php echo $ver[10]; ?></h4>
        </div>

        <span class="list-group-item list-group-item-action"><strong>Telefono: </strong><?php echo $ver[13];?></span>
        <span class="list-group-item list-group-item-action"><strong>ID: </strong><?php echo $ver[14];?></span>
    </div>



    <h4>Detalles de residencia</h4>
    <div class="list-group">
        <div class="list-group-item list-group-item-action flex-column align-items-start " style="background-color: #fb5; color: white;">
            <h4 class="mb-1"><?php echo $ver[9]; ?></h4>
        </div>

        <span class="list-group-item list-group-item-action"><strong>Casas: </strong><?php echo $ver[8];?></span>
        <span class="list-group-item list-group-item-action"><strong>pago: </strong><?php echo $ver[15]." $";?></span>
        <span class="list-group-item list-group-item-action"><strong>Ubicacion: </strong><a target="_blank" href="<?php echo $ver[16];?>"><span class="glyphicon glyphicon-map-marker"></span>Ir</a></span>
    </div>
</div>

<!-- FIN DETALLES DE PAGO -->


</div>
</body>
</html>



