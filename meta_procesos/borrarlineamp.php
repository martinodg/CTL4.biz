<?php
require_once("../conectar7.php"); 

$codigo=$_GET["codmproceso"];
$linea=$_GET["lineamproceso"];


$query_borrar="DELETE FROM metaprocesoslinea WHERE codproceso='$codigo' and codlinea='$linea';";
echo $query_borrar;
$rs_borrar=mysqli_query($conexion,$query_borrar);
$query_renumerar="SET @pos := 0; UPDATE metaprocesoslinea SET codlinea = ( SELECT @pos := @pos + 1 ) where codproceso='$codigo' ORDER BY codrecord ASC;";
$rs_renumerar=mysqli_multi_query($conexion,$query_renumerar);
echo "<h1><center>record borrado</h1></center>";