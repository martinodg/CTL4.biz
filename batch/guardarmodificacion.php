<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codbatch=$_GET["codbatch"];
    $cantidad=$_GET["cantidad"];
    $estado=$_GET["estado"];
    $fechaf=$_GET["fechaf"];
    $horaf=$_GET["horaf"];
    $codigo=$_GET["codarticulo"];
    
   
    If ($estado=="2"){
                    //Set query for discharged status
                    $query_operacion="UPDATE batch SET cantidad = $cantidad, fechaf='$fechaf', horaf='$horaf', codstatus='2' WHERE codbatch=$codbatch;";		
                    }    
    if ($estado=="1"){	
                    //Set query for ended status    
                    $query_operacion="UPDATE batch, articulos SET articulos.stock=articulos.stock+$cantidad, batch.cantidad=$cantidad, batch.fechaf='$fechaf', batch.horaf='$horaf', batch.codstatus='1' WHERE batch.codbatch=$codbatch AND articulos.codarticulo=$codigo;";
                    }   
    if ($estado=="0"){                                    
                    //Set query for iniciated status, so quantity modification only
                    $query_operacion="UPDATE batch SET cantidad = $cantidad, fechaf='0000-00-00', horaf='00:00', codstatus='0' WHERE codbatch=$codbatch;";			
                    }
    if (!mysqli_query($conexion,$query_operacion)){
               
    echo "<div class=\"mensaje\">ATENCION: Non ha podido ser modificado con exito el batch: '$codbatch'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"header\">ATENCION: El batch ha sido modificado con exito!</div>";
    }
 
mysqli_close($conexion);   
	
?>
