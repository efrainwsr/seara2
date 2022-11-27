<?php
	session_start();
    unset($_SESSION['inicio']);
    unset($_SESSION['fin']); 

	$actual = date("Y-m-d", strtotime($_POST['actual']));
   // $pasado = date("Y-m-d", strtotime($_POST['pasado']));

    $_SESSION['actual']=$actual;
   // $_SESSION['pasado']=$pasado;
    echo $actual;
    //echo $pasado;

 ?>