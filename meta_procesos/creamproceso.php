<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 
$batch=$_GET["batch"];
$nombremproceso=$_GET["nombremproceso"];
$codArticuloCreado=$_GET["codArticuloCreado"];
$cantidad=$_GET["cantidad"];
$unmedida=$_GET['unmedida'];

 

                                //Ask for last codproceso and assing new value
        	                    $consultaprevia = "SELECT max(codproceso) as maximo FROM metaprocesos";
		                        $rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
		                        $codproceso=mysqli_result($rs_consultaprevia,0,"maximo");
                                //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
                                if ($codproceso=="") { $codproceso=0;} 
                                $codproceso++;
                                //insert the new entry on meta-process table.
                                $query_creamproceso="INSERT INTO metaprocesos (codproceso, codarticulo, nombre, esbatch, cantidad, codunidadmedida, codstatus) VALUES ('$codproceso', '$codArticuloCreado', '$nombremproceso', '$batch', '$cantidad', '$unmedida', '4')";
                                $rs_creaproceso=mysqli_query($conexion,$query_creamproceso);
                                echo $codproceso;
                                 
 ?>
 