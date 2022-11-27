<?php

class vehiculos{

	public function insertaVehiculos($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="INSERT into vehiculo (id_vehiculo,
		capacidad,							
		marca,
		modelo,
		cant_ruedas,
		rin	) 
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$datos[5]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatosVehiculo($idvehiculo){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_vehiculo,
		capacidad,
		marca,
		modelo,
		cant_ruedas, 
		rin
		from vehiculo 
		where id_vehiculo='$idvehiculo'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
			"id_vehiculo" => $ver[0],
		//	"id_empleado" => $ver[1],
			"capacidad" => $ver[1],
			"marca" => $ver[2],
			"modelo" => $ver[3],
			"cant_ruedas" => $ver[4],
			"rin"  => $ver[5]
		);

		return $datos;
	}

	public function actualizaVehiculo($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE vehiculo set
		capacidad='$datos[1]',
		marca='$datos[2]',
		modelo='$datos[3]',
		cant_ruedas='$datos[4]',
		rin='$datos[5]'
		where id_vehiculo='$datos[0]'";

		return mysqli_query($conexion,$sql);
	}

	public function eliminaVehiculo($idvehiculo){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from vehiculo 
					where id_vehiculo='$idvehiculo'";
			return mysqli_query($conexion,$sql);

		}

		public function capacidad($idvehiculo){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT capacidad, modelo
		from vehiculo
		where id_vehiculo='$idvehiculo'";
		$result=mysqli_query($conexion,$sql);

		$capacidad=0;

		while($ver=mysqli_fetch_row($result)){
			$capacidad=$ver[0];
		}

		return $capacidad;
	}

	public function ocultarVehiculo($idvehiculo){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE vehiculo set ver = '0'
								where id_vehiculo='$idvehiculo'";
			return mysqli_query($conexion,$sql);
			
		}


	}

?>