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
	$idmov=$_GET["idmov"];
	$codfactura=$_GET["codfactura"];
	$codproveedor=$_GET["codproveedor"];
	$fechapago=$_GET["fechapago"];
	$importe=$_GET["importe"];
	$importe="-".$importe;
	$fecha=explota($fechapago);
	
	$act_factura="DELETE FROM pagos WHERE idmov='$idmov' AND codfactura='$codfactura' AND codproveedor='$codproveedor'";
	$rs_act=mysqli_query($conexion,$act_factura);
	
	$sel_libro="INSERT INTO librodiario (id,fecha,tipodocumento,coddocumento,codcomercial,codformapago,numpago,total) VALUES 
	('','$fecha','1','$codfactura','','','','$importe')";
	$rs_libro=mysqli_query($conexion,$sel_libro);
?>
</body>
</html>
