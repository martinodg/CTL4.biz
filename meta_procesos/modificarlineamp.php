<?php
require_once("../conectar7.php"); 

$codigo=$_GET["codmproceso"];
$linea=$_GET["lineamproceso"];
$cantidad=$_GET["cantidadarticulo"];

$query_modificalinea="UPDATE metaprocesoslinea SET cantidad = '$cantidad' WHERE codlinea = '$linea' and codproceso = '$codigo';";
$rs_creaproceso=mysqli_query($conexion,$query_modificalinea);