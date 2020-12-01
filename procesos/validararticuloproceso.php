<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 

    $codproceso=$_GET["codproceso"];
    $codarticulo=$_GET["codarticulo"];
    $refresco=$_GET["refresco"];

 //verify the last code linea for this code process
 $codlineaprevia = "SELECT max(codlinea) as maximo FROM proclinea WHERE codproceso='$codproceso'";
 $rs_codlineaprevia=mysqli_query($conexion,$codlineaprevia);
 $codlinea=mysqli_result($rs_codlineaprevia,0,"maximo");
 //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
 if ($codlinea=="") { $codlinea=0;} 
 $codlinea++;                
//verify codarticulo is repeated or not

$query_verificarepetidos="SELECT COUNT(1) as total FROM proclinea WHERE codproceso = '$codproceso' AND codarticulo='$codarticulo';";
$rs_verificarepetidos=mysqli_query($conexion,$query_verificarepetidos);
$repetido=mysqli_fetch_assoc($rs_verificarepetidos);
$insersiones=$repetido['total'];
//verify if line was already validated then we update, if not we insert a new proclinea for the new validated item
if ($insersiones>=1){
    $query_validararticulo="UPDATE proclinea SET cantidad='$refresco' WHERE codarticulo='$codarticulo' AND codproceso='$codproceso'";
}
if ($insersiones==0) {
    $query_validararticulo="INSERT INTO proclinea (codproceso, codlinea, codarticulo, cantidad) VALUES ('$codproceso', '$codlinea','$codarticulo','$refresco');";   
}

//insert the item to add into the table proclinea
$rs_validararticulo=mysqli_query($conexion,$query_validararticulo);

echo "La linea ha sido validada e insertada en la base de datos con el numero de linea '$codlinea' para el proceso '$codproceso'";
 
mysqli_close($conexion);   
	
?>