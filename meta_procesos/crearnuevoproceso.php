<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 



//insert the new entry on meta-process table.
                                $query_creamproceso="INSERT INTO metaprocesos (codproceso, esbatch, nombre, codstatus) VALUES ('$codproceso','$batch','$nombreproceso','0')";
                                $rs_creaproceso=mysqli_query($conexion,$query_creamproceso);