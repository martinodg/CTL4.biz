<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codproceso=$_GET["codproceso"];
    $cantidad=$_GET["cantidad"];
    $estado=$_GET["estado"];
    $fechaf=$_GET["fechaf"];
    $horaf=$_GET["horaf"];
    $codigo=$_GET["codarticulo"];
    
   
    If ($estado=="2"){
                    //Set query for discharged status
                    $query_operacion="UPDATE procesos SET cantidad = $cantidad, fechaf='$fechaf', horaf='$horaf', codstatus='2' WHERE codproceso=$codproceso;";		
                    }    
    if ($estado=="1"){	
                    //Set query for ended status    
                    $query_operacion="UPDATE procesos, articulos SET articulos.stock=articulos.stock+$cantidad, procesos.cantidad=$cantidad, procesos.fechaf='$fechaf', procesos.horaf='$horaf', procesos.codstatus='1' WHERE procesos.codproceso=$codproceso AND articulos.codarticulo=$codigo;";
                    }   
    if ($estado=="0"){                                    
                    //Set query for iniciated status, so quantity modification only
                    $query_operacion="UPDATE procesos SET cantidad = $cantidad, fechaf='0000-00-00', horaf='00:00', codstatus='0' WHERE codproceso=$codproceso;";			
                    }
    if (!mysqli_query($conexion,$query_operacion)){
               
    echo "<div class=\"mensaje\">ATENCION: Non ha podido ser modificado con exito el proceso: '$codproceso'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"header\">ATENCION: El proceso ha sido modificado con exito!</div>";
    }
 
mysqli_close($conexion);   
	
?>
