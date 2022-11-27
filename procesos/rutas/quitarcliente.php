<?php 

	session_start();
	$index=$_POST['ind'];
	unset($_SESSION['tablaRutasTemp'][$index]);
	$datos=array_values($_SESSION['tablaRutasTemp']);
	unset($_SESSION['tablaRutasTemp']);
	$_SESSION['tablaRutasTemp']=$datos;

 ?>