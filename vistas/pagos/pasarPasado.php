<?php
	session_start();
    unset($_SESSION['inicio']);
    unset($_SESSION['fin']);
    unset($_SESSION['actual']); 

	$pasado = date("Y-m-d", strtotime($_POST['pasado']));
   // $pasado = date("Y-m-d", strtotime($_POST['pasado']));

    $_SESSION['pasado']=$pasado;
   // $_SESSION['pasado']=$pasado;
    echo $pasado;
    //echo $pasado;

 ?>