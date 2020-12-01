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
	$fechapago=$_GET["fechapago"];
	$fechapago=explota($fechapago);
	$codfactura=$_GET["codfactura"];
	$codproveedor=$_GET["codproveedor"];
	$act_factura="UPDATE facturasp SET fechapago='$fechapago' WHERE codfactura='$codfactura' AND codproveedor='$codproveedor'";
	$rs_act=mysqli_query($conexion,$act_factura);
?>
</body>
</html>
