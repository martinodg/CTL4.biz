<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
</head>
<? require_once("../conectar7.php"); 
require_once("../funciones/fechas.php");
?>
<body>
<?
	$fechavencimiento=$_GET["fechavencimiento"];
	$fechavencimiento=explota($fechavencimiento);
	$codfactura=$_GET["codfactura"];
	$act_factura="UPDATE facturas SET fechavencimiento='$fechavencimiento' WHERE codfactura='$codfactura'";
	$rs_act=mysqli_query($conexion,$act_factura);
?>
</body>
</html>
