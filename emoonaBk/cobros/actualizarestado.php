<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
</head>
<? require_once("../conectar7.php"); ?>
<body>
<?
	$estado=$_GET["estado"];
	$codfactura=$_GET["codfactura"];
	$act_factura="UPDATE facturas SET estado='$estado' WHERE codfactura='$codfactura'";
	$rs_act=mysqli_query($conexion,$act_factura);
?>
</body>
</html>
