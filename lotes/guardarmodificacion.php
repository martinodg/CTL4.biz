<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codlote=$_GET["codlote"];
    $cantidad=$_GET["cantidad"];
    $estado=$_GET["estado"];
    $fechaf=$_GET["fechaf"];
    $horaf=$_GET["horaf"];
    $codigo=$_GET["codarticulo"];
    
   
    If ($estado=="2"){
                    //Set query for discharged status
                    $query_operacion="UPDATE lote SET cantidad = $cantidad, fechaf='$fechaf', horaf='$horaf', codstatus='2' WHERE codlote=$codlote;";		
                    }    
    if ($estado=="1"){	
                    //Set query for ended status    
                    $query_operacion="UPDATE lote, articulos SET articulos.stock=articulos.stock+$cantidad, lote.cantidad=$cantidad, lote.fechaf='$fechaf', lote.horaf='$horaf', lote.codstatus='1' WHERE lote.codlote=$codlote AND articulos.codarticulo=$codigo;";
                    }   
    if ($estado=="0"){                                    
                    //Set query for iniciated status, so quantity modification only
                    $query_operacion="UPDATE lote SET cantidad = $cantidad, fechaf='0000-00-00', horaf='00:00', codstatus='0' WHERE codlote=$codlote;";			
                    }
    if (!mysqli_query($conexion,$query_operacion)){
               
    echo "<div class=\"mensaje\">ATENCION: Non ha podido ser modificado con exito el lote: '$codlote'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"header\">ATENCION: El lote ha sido modificado con exito!</div>";
    }
 
mysqli_close($conexion);   
	
?>
