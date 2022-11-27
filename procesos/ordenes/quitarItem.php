<?php 

	session_start();
	$index=$_POST['ind'];
	unset($_SESSION['tablaOrdenTemp'][$index]);
	$datos=array_values($_SESSION['tablaOrdenTemp']);
	unset($_SESSION['tablaOrdenTemp']);
	$_SESSION['tablaOrdenTemp']=$datos;

 ?>