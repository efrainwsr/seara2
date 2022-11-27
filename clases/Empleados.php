<?php 



class empleado{

	public function agregaEmpleado($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="INSERT into empleados(id_empleado,
		nombre,
		telefono,
		observaciones,
		sueldo,
		fecha)

		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$datos[5]')";

		return mysqli_query($conexion,$sql);
	}

	public function obtenDatosEmpleado($idempleado){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_empleado,
		nombre,  
		telefono,
		observaciones,
		sueldo
		from empleados 
		where id_empleado='$idempleado'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
			"id_empleado" => $ver[0],
			"nombre" => $ver[1],
			"telefono" => $ver[2],
			"observaciones" => $ver[3],
			"sueldo" => $ver[4]
		);

		return $datos;
	}




	public function actualizaEmpleado($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE empleados set nombre='$datos[1]',
									telefono='$datos[2]',
									observaciones='$datos[3]',
									sueldo='$datos[4]'
		where id_empleado='$datos[0]'";
		echo mysqli_query($conexion,$sql);
	}

	public function eliminaEmpleado($idempleado){
		$c= new conectar();
		$conexion=$c->conexion();
		$sql="DELETE from empleados 
		where id_empleado='$idempleado'";
		return mysqli_query($conexion,$sql);
	}

	public function ocultarEmpleado($idempleado){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE empleados set ver = '0'
								where id_empleado='$idempleado'";
			return mysqli_query($conexion,$sql);
			
		}
}

?>