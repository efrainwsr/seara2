<?php

class reportes{

	public function agregaReporte($datos){
		$c= new conectar();
		$conexion=$c->conexion();
		$fecha=date('Y-m-d');
		$idusuario=$_SESSION['iduser'];

		$sql="INSERT into reportes (id_usuario,
		nombre,
		vehiculo,
		residencia,
		ruta,
		descripcion,
		fecha
		)

		values ('$idusuario',
		'$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$fecha')";
		return mysqli_query($conexion,$sql);	
	}

		public function obtenDatosReporte($idreporte){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_reportes,
							nombre,
							vehiculo,
							residencia,
							ruta,
							descripcion 
				from reportes where id_reportes='$idreporte'";
				
			$result=mysqli_query($conexion,$sql); 
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_reportes' => $ver[0], 
					'nombre' => $ver[1],
					'vehiculo' => $ver[2],
					'residencia' => $ver[3],
					'ruta' => $ver[4],
					'descripcion' => $ver[5]
						);
		return $datos;
	}


	public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE cliente set nombre='$datos[1]',
										conjunto='$datos[2]',
										direccion='$datos[3]',
										telefono='$datos[4]',
										gmap='$datos[5]',
										casas='$datos[6]',
										kgbasura='$datos[7]',
										pago='$datos[8]' 
								where id_cliente='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminaReporte($idreporte){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from reportes 
					where id_reportes='$idreporte'";

			return mysqli_query($conexion,$sql);
		}
}	


?>