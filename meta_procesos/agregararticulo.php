<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 

    $codproceso=$_GET["codmproceso"];
    $nombreproceso=$_GET["nombremproceso"];
    $batch=$_GET["batch"];
    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $cantidad=$_GET["cantidadart"];
    $unmedida=$_GET['unmedida'];
                                 
    //verify the last code linea for this code meta-process
    $codlineaprevia = "SELECT max(codlinea) as maximo FROM metaprocesoslinea WHERE codproceso='$codproceso'";
		                        $rs_codlineaprevia=mysqli_query($conexion,$codlineaprevia);
		                        $codlinea=mysqli_result($rs_codlineaprevia,0,"maximo");
                                //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
                                if ($codlinea=="") { $codlinea=0;} 
                                $codlinea++;                
    //insert the item to add into the table metaprocesoslinea
    $query_operacion="INSERT INTO metaprocesoslinea (codproceso, codlinea, codarticulo, cantidad, codunidadmedida) VALUES ('$codproceso','$codlinea',$codarticulo,'$cantidad', '$unmedida')";				
	/*echo $query_operacion;*/
    $rs_operacion=mysqli_query($conexion,$query_operacion);
    
mysqli_close($conexion);   	
?>
