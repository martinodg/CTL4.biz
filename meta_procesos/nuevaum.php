<?php
require_once("../conectar7.php"); 


    $metaproceso=$_GET["metaproceso"];
    $nlinea=$_GET["nlinea"];
    $unmedida=$_GET["unmedida"];


    $query_modnuevaum="UPDATE metaprocesoslinea SET codunidadmedida = '$unmedida' where codproceso='$metaproceso' AND codlinea='$nlinea';";
    $res_modnuevaum=mysqli_query($conexion,$query_modnuevaum);
   
echo '<H1> Unidad de medida modificada </H1>';

?>
