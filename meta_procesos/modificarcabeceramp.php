<?php
require_once("../conectar7.php"); 

$codigo=$_GET["codmproceso"];
$nombre=$_GET["nombremproceso"];
$batch=$_GET["batch"];
$codarticulocreado=$_GET["codarticulocreado"];
$cantidadest=$_GET["cantidadest"];
$unmedida=$_GET["unmedida"];

//echo $batch;
$query_modificarcabeceramp="UPDATE metaprocesos SET nombre = '$nombre', esbatch='$batch', codarticulo='$codarticulocreado', cantidad='$cantidadest', codunidadmedida='$unmedida' where codproceso='$codigo';";
$rs_modificarcabeceramp=mysqli_query($conexion,$query_modificarcabeceramp);
echo "<h1><center>Datos del meta-proceso modificados</h1></center>";