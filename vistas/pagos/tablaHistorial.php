<?php
session_start();
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion= $obj->conexion();
?>

<div class="row">
	<div class="table-responsive">
		<table class="table table-hover table-condensered table-striped" style="text-align: center;">
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
			
			<?php
			if(isset($_SESSION['fin'])){
				if($_SESSION['fin'] > 0){
					$inicio=$_SESSION['inicio'];
					$fin=$_SESSION['fin'];
					$sql="SELECT
					p.id_pago,
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
					where p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente
					AND p.fecha between '$inicio' AND '$fin'";
					//MONTH(p.fecha)=MONTH('$idp'()) AND YEAR(p.fecha)=YEAR('$idp'())";
				}else{
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
				      ORDER BY p.fecha DESC";
				    }
			}

			if(isset($_SESSION['actual'])){
				if($_SESSION['actual'] > 0){
					$actual=$_SESSION['actual'];
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
				}
		    }
		    /*
		    if(isset($_SESSION['pasado'])){
				if($_SESSION['pasado'] > 0){
					$pasado=$_SESSION['pasado'];
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
					AND DATE_FORMAT('$pasado', - INTERVAL 1 MONTH,'%Y-%m-%d')";
				}
		    }
		    */

			else{
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
				WHERE p.id_residencia=r.id_residencia AND r.id_cliente=cli.id_cliente ORDER BY p.fecha DESC";
			}

			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)){ ?>

			<tr>
            <?php 
            $dolar = number_format($ver[5], 1);  
            //$tdolares=$ver[5]+$tdolares;
            //$tbolivares=$ver[6]+$tbolivares; ?>

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
</table>


</div>
</div>
