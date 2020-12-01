<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

require_once("../conectar.php");

$codpresupuesto=$_GET["codpresupuestotmp"];
$numlinea=$_GET["numlinea"];

$consulta = "DELETE FROM presulineatmp WHERE codpresupuesto ='".$codpresupuesto."' AND numlinea='".$numlinea."'";
$rs_consulta = mysqli_query($conexion,$consulta);
echo "<script>parent.location.href='frame_lineas.php?codpresupuestotmp=".$codpresupuesto."';</script>";

?>