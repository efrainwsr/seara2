<?php 

	class mesas{
		public function registroMesa($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into usuarios (nombre,
								apellido,
								email,
								password,
								tipo,
								fechaCaptura
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]',
								'$fecha')";
			return mysqli_query($conexion,$sql);
		}


		public function obtenDatosMesa($idmesa){
/*
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT *
					from mesas
					where id_mesa='$idmesa'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'idmesa' => $ver[0]
						);

			return $datos;
			*/
		} 

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									email='$datos[3]',
									password='$datos[4]',
									tipo='$datos[5]'
						where id_usuario='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios 
					where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}

		public function ocultarUsuario($idusuario){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set ver = '0'
								where id_usuario='$idusuario' and id_usuario !='1'";
			return mysqli_query($conexion,$sql);
			
		}
		}



 ?>