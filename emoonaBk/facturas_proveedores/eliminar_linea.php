<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

require_once("../conectar7.php");

$codfactura=$_GET["codfacturatmp"];
$numlinea=$_GET["numlinea"];

$consulta = "DELETE FROM factulineaptmp WHERE codfactura ='".$codfactura."' AND numlinea='".$numlinea."'";
$rs_consulta = mysqli_query($conexion,$consulta);
echo "<script>parent.location.href='frame_lineas.php?codfacturatmp=".$codfactura."';</script>";

?>