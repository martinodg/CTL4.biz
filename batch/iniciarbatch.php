<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $cantidad=$_GET["cantidadart"];
    $fechai=$_GET["fechaibatch"];
    $horai=$_GET["horaibatch"];
    
    If ($codarticulo and $nombrearticulo and $fechai and $horai <>""){
    //code to insert the date on the DB  
   
                //Ask for last codbatch and assing new value
        	$consultaprevia = "SELECT max(codbatch) as maximo FROM batch";
		$rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
		$codbatch=mysqli_result($rs_consultaprevia,0,"maximo");
		if ($codbatch=="") { $codbatch=0; }
		$codbatch++;
                
                //insert in DB
                $query_operacion="INSERT INTO batch (codbatch, codarticulo, cantidad, fechai, horai, codstatus, borrado) VALUES ('$codbatch', '$codarticulo', '$cantidad', '$fechai', '$horai', '0', '0')";				
		/*echo $query_operacion;*/

                $rs_operacion=mysqli_query($conexion,$query_operacion);
		
	/*	$codbatch=mysqli_insert_id($conexion); */
                
                
                
        echo "<div class=\"header\">ATENCION: El batch ha sido creado exitosamente con el codigo '$codbatch'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"mensaje\">ATENCION: Los Campos relativos al articulo del batch son obligatorios!</div>";
    }
 
mysqli_close($conexion);   
	
?>
