<?php 

	class usuarios{
		public function registroUsuario($datos){
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





		public function loginUser($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			//$password=sha1($datos[1]);
			$_SESSION['usuario']=$datos[0];
			$_SESSION['iduser']=self::traeID($datos);





			$sql="SELECT * from usuarios 
				where email='$datos[0]'
				and password='$datos[1]' and ver !='0'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			if(mysqli_num_rows($result) > 0){
				$_SESSION['id_usuario']=$ver[0];
				$_SESSION['usuario']=$ver[3];
				$_SESSION['cargo']=$ver[7];

				return 1;
			}else{
				return 0;
			}
		}





		public function traeID($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			//$password=sha1($datos[1]);

			$sql="SELECT id_usuario 
					from usuarios 
					where email='$datos[0]'
					and password='$datos[1]'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}




		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_usuario,
							nombre,
							apellido,
							email,
							password,
							tipo
					from usuarios
					where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_usuario' => $ver[0],
							'nombre' => $ver[1],
							'apellido' => $ver[2],
							'email' => $ver[3],
							'password' => $ver[4],
							'tipo' => $ver[5]


						);

			return $datos;
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