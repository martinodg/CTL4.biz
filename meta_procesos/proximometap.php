 <?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 

 

                                //Ask for last codproceso and assing new value
        	                    $consultaprevia = "SELECT max(codproceso) as maximo FROM metaprocesos";
		                        $rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
		                        $codproceso=mysqli_result($rs_consultaprevia,0,"maximo");
                                //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
                                if ($codproceso=="") { $codproceso=0;} 
                                $codproceso++;
                                //insert the new entry on meta-process table.
                                /*$query_creamproceso="INSERT INTO metaprocesos (codproceso, esbatch, nombre, codstatus) VALUES ('$codproceso','$batch','$nombreproceso','0')";
                                $rs_creaproceso=mysqli_query($conexion,$query_creamproceso);*/
                                $data['codmproc']= $codproceso;
                                echo json_encode($data); 
 
 ?>
 