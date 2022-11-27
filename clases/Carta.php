<?php

	class carta{

		public function agregaCarta($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		//$idusuario=$_SESSION['iduser'];

		$sql="INSERT into carta (
		nombre,
		precio,
		categoria,
		descripcion,
		variante,
		status)

		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$datos[5]')";
		return mysqli_query($conexion,$sql);

	}





	public function obtenDatosCarta($iditem){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_item,
							nombre,
							precio,
							categoria,
							descripcion,
							variante,
							status
					from carta
					where id_item='$iditem'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_carta' => $ver[0],
							'nombre' => $ver[1],
							'precio' => $ver[2],
							'categoria' => $ver[3],
							'descripcion' => $ver[4],
							'variante' => $ver[5],
							'status' => $ver[6]
						);

			return $datos;
		}


	public function actualizaCarta($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE carta set nombre='$datos[1]',
									precio='$datos[2]',
									categoria='$datos[3]',
									descripcion='$datos[4]',
									variante='$datos[5]',
									status='$datos[6]'
						where id_item='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}




}

 ?>