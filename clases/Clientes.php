<?php

class clientes{

	public function agregaCliente($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		$idusuario=$_SESSION['iduser'];

		$sql="INSERT into cliente (id_usuario,
		id_cliente,
		nombre,
		telefono)

		values ('$idusuario',
		'$datos[0]',
		'$datos[1]',
		'$datos[2]')";
		return mysqli_query($conexion,$sql);

	}

		public function obtenDatosCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_cliente,
							nombre,
							telefono
				from cliente where id_cliente='$idcliente'";
				
			$result=mysqli_query($conexion,$sql); 
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_cliente' => $ver[0], 
					'nombre' => $ver[1],
					'telefono' => $ver[2]


						);
		return $datos;
	}


	public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE cliente set
										nombre='$datos[1]',
										telefono='$datos[2]'
			where id_cliente='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminaCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from cliente 
					where id_cliente='$idcliente'";

			return mysqli_query($conexion,$sql);
		}

		public function ocultarCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE cliente set ver = '0'
								where id_cliente='$idcliente'";
			return mysqli_query($conexion,$sql);
			
			
		}
		public function mostrarCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE cliente set ver = '1'
								where id_cliente='$idcliente'";
			return mysqli_query($conexion,$sql);
			
		}
}	


?>