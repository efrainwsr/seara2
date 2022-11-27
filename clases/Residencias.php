<?php

class residencias{

	public function agregaResidencia($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		$idusuario=$_SESSION['iduser'];

		$sql = "select * from residencia where nombre='$datos[0]'";
		$result = mysqli_query($conexion, $sql);

		
		if(mysqli_num_rows($result)>0)
		{
	 // Si es mayor a cero imprimimos que ya existe el usuario
			//echo "Ya existe el registro que intenta registrar";
		}
		else
		{
// Si no hay resultados, ingresamos el registro a la base de datos
			$sql="INSERT into residencia (nombre,
			casas,
			kgbasura,
			pago,
			direccion,
			id_cliente,
			gmap,
			lat,
			lng)
			values (
			'$datos[0]',
			'$datos[1]',
			'$datos[2]',
			'$datos[3]',
			'$datos[4]',
			'$datos[5]',
			'$datos[6]',
			'$datos[7]',
			'$datos[8]')";
			return mysqli_query($conexion,$sql);
}
			

		}

		public function obtenDatosResidencia($idresidencia){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT r.id_residencia, 
			r.nombre,
			r.direccion,
			r.gmap,
			r.casas,
			r.kgbasura,
			r.pago,
			r.lat,
			r.lng,
			cli.id_cliente,
			cli.nombre,
			r.id_cliente 
			from residencia r, cliente cli where r.id_residencia='$idresidencia'
			AND r.id_cliente=cli.id_cliente";

			$result=mysqli_query($conexion,$sql); 
			$ver=mysqli_fetch_row($result);

			$datos=array(
				"id_residencia" => $ver[0], 
				"conjunto" => $ver[1],
				"direccion" => $ver[2],
				"gmap" => $ver[3],
				"casas" => $ver[4],
				"kgbasura" => $ver[5],
				"pago" => $ver[6],
				"latitud" => $ver[7],
				"longitud" => $ver[8],
				"id_cliente" => $ver[9],
				"nombreCli" => $ver[10],


					//'id_cliente' => $ver[6]
			);
			return $datos;
		}


		public function actualizaResidencia($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			if($datos[9]=='0'){
				$sql="UPDATE residencia set nombre='$datos[1]',
				direccion='$datos[2]',
				gmap='$datos[3]',
				casas='$datos[4]',
				kgbasura='$datos[5]',
				pago='$datos[6]',
				lat='$datos[7]', 
				lng='$datos[8]'
				where id_residencia='$datos[0]'";

			}else{
				$sql="UPDATE residencia set nombre='$datos[1]',
				direccion='$datos[2]',
				gmap='$datos[3]',
				casas='$datos[4]',
				kgbasura='$datos[5]',
				pago='$datos[6]',
				lat='$datos[7]', 
				lng='$datos[8]',
				id_cliente='$datos[9]'
				where id_residencia='$datos[0]'";
			}
			return mysqli_query($conexion,$sql);
		}

		public function eliminaCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from cliente 
			where id_cliente='$idcliente'";

			return mysqli_query($conexion,$sql);
		}

		public function ocultarResidencia($idresidencia){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE residencia set ver = '0'
			where id_residencia='$idresidencia'";
			return mysqli_query($conexion,$sql);
			
		}

		public function mostrarResidencia($idresidencia){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE residencia set ver = '1'
			where id_residencia='$idresidencia'";
			return mysqli_query($conexion,$sql);
			
		}
	}	


	?>