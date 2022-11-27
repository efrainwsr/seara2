<?php 
	require_once ('../../vendor/autoload.php');
	require_once ('../../vistas/rutas/plantilla.php');

 $css = file_get_contents('../../css/style.css'); 

$mpdf = new \Mpdf\Mpdf([

 
]);


$plantilla = getPlantilla();

$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output(); 

//http://localhost/damarisfp/procesos/rutas/crearReportempdf.php
?>
