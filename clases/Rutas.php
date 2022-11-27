<?php

class rutas{
	public function obtenDatosCliente($idresidencia){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT r.id_cliente,
		r.direccion,
		r.casas,
		cli.id_cliente,
		cli.nombre
		from cliente cli, residencia r
		where r.id_residencia='$idresidencia' AND r.id_cliente=cli.id_cliente";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
			'nombre' => $ver[4],
			'direccion' => $ver[1],
			'casas' => $ver[2],
			'idcliente' =>$ver[0],		
		);
		return $datos;

	}

	public function crearRuta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$idruta=self::creaFolio();
		$datos=$_SESSION['tablaRutasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$sql="INSERT into rutas (   id_ruta,
										id_cliente,
										id_usuario,
										fecha,
										casas,
										dia,
										kgbasura,
										nombre_ruta,
										id_residencia,
										nombre_residencia)
				values (            
									'$idruta',
									'$d[8]',
									'$idusuario',
									'$fecha',
									'$d[4]',
									'$d[2]',
									'$d[6]',
									'$d[1]',
									'$d[0]',
								    '$d[7]')";

			$r=$r + $result=mysqli_query($conexion,$sql);
		}

		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_ruta from rutas group by id_ruta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}

	public function nombreRuta($idRuta){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT nombre_ruta 
		from rutas 
		where id_ruta='$idRuta'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0];
	}

	public function totalKgbasura($idruta){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT kgbasura 
		from rutas
		where id_ruta='$idruta'";
		$result=mysqli_query($conexion,$sql);

		$totalBasura=0;

		while($ver=mysqli_fetch_row($result)){
			$totalBasura=$totalBasura + $ver[0];
		}

		return $totalBasura;
	}

	public function totalCasas($idruta){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT casas 
		from rutas
		where id_ruta='$idruta'";
		$result=mysqli_query($conexion,$sql);

		$totalCasas=0;

		while($ver=mysqli_fetch_row($result)){
			$totalCasas=$totalCasas + $ver[0];
		}

		return $totalCasas;
	}


	public function eliminaRuta($idruta){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="DELETE from rutas where id_ruta='$idruta'";

		return mysqli_query($conexion,$sql);
	}

	public function ocultarRuta($idruta){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE rutas set ver = '0'
								where id_ruta='$idruta'";
			return mysqli_query($conexion,$sql);
			
		}
}

?>