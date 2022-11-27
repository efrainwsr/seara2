<?php

	class pagos{

		public function agregaPago($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		//$idusuario=$_SESSION['iduser'];

		$sql="INSERT into pagos (id_residencia,
		fecha,
		referencia,
		tasa,
		dolares,
		bs,
		emisor,
		receptor,
		id_cliente)

		values ('$datos[0]',
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

 ?>