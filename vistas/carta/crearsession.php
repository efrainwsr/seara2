<?php
	session_start();
	unset($_SESSION['actual']); 



    $inicio = date("Y-m-d", strtotime($_POST['inicio']));
    $fin = date("Y-m-d", strtotime($_POST['fin']));

    $_SESSION['inicio']=$inicio;
    $_SESSION['fin']=$fin;

    echo $inicio;
    echo $fin;

 ?>