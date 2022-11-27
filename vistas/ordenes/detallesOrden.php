<?php 
session_start();
if(isset($_SESSION['usuario'])){


?>
	<!DOCTYPE html>
<html>
	<head>
		<?php require_once "../menu.php"; 
		require_once "../../clases/Conexion.php";?>

	</head>
	<body>
		
	</body>
</html>

	<?php 
}else{
	header("location:../index.php");
}
?>