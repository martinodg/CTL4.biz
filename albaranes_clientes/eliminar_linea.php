<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

require_once("../conectar7.php");

$codalbaran=$_GET["codalbarantmp"];
$numlinea=$_GET["numlinea"];

$consulta = "DELETE FROM albalineatmp WHERE codalbaran ='".$codalbaran."' AND numlinea='".$numlinea."'";
$rs_consulta = mysqli_query($conexion,$consulta);
echo "<script>parent.location.href='frame_lineas.php?codalbarantmp=".$codalbaran."';</script>";

?>