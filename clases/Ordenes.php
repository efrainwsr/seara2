<?php
date_default_timezone_set('Europe/Lisbon');


class ordenes{


	public function obtenDatosItem($item){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT *
		from carta
		where id_item='$item'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
			'item' => $ver[0],
			'nombre' => $ver[1],
			'precio' => $ver[2],
			'variante' =>$ver[5],		
		);
		return $datos;

	}

	public function crearOrden(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$hora=date('h:i:s');
		$idorden=self::creaFolio();
		$idusuario=$_SESSION['id_usuario'];
		//$iditem=$_SESSION['iditem'];
		//$idmesa=$_SESSION['idmesa'];
		$datos=$_SESSION['tablaOrdenTemp'];
		$status="1";
		$total=$_SESSION['total'];
		
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$sql="INSERT into orden (   id_orden,
										id_item,
										id_mesa,
										id_usuario,
										cantidad,
										nota,
										fecha,
										hora,
										status,
										total)
				values (            
									'$idorden',
									'$d[0]',
									'$d[1]',
									'$idusuario',
									'$d[2]',
									'$d[3]',
									'$fecha',
									'$hora',
								    '$status',
									'$total')";

			$r=$r + $result=mysqli_query($conexion,$sql);
		}

		return $r;
		unset($_SESSION['total']);
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_orden from orden group by id_orden desc";

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

	public function aceptarOrden($idorden){
			$c= new conectar();
			$conexion=$c->conexion();
			$idusuario=$_SESSION['id_usuario'];

			$sql="UPDATE orden set status=2, id_cocinero ='$idusuario'
							   where id_orden='$idorden'";
			return mysqli_query($conexion,$sql);
			
		}

		public function terminarOrden($idorden){
			$c= new conectar();
			$conexion=$c->conexion();
			

			$sql="UPDATE orden set status = 3
								where id_orden='$idorden'";
			return mysqli_query($conexion,$sql);
			
		}
}

?>