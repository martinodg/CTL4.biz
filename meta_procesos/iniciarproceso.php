<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $cantidad=$_GET["cantidadart"];
    $fechai=$_GET["fechaiproceso"];
    $horai=$_GET["horaiproceso"];
    
    If ($codarticulo and $nombrearticulo and $fechai and $horai <>""){
    //code to insert the date on the DB  
   
                //Ask for last codproceso and assing new value
        	$consultaprevia = "SELECT max(codproceso) as maximo FROM proceso";
		$rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
		$codproceso=mysqli_result($rs_consultaprevia,0,"maximo");
		if ($codproceso=="") { $codproceso=0; }
		$codproceso++;
                
                //insert in DB
                $query_operacion="INSERT INTO proceso (codproceso, codarticulo, cantidad, fechai, horai, codstatus, borrado) VALUES ('$codproceso', '$codarticulo', '$cantidad', '$fechai', '$horai', '0', '0')";				
		/*echo $query_operacion;*/

                $rs_operacion=mysqli_query($conexion,$query_operacion);
		
	/*	$codproceso=mysqli_insert_id($conexion); */
                
                
                
        echo "<div class=\"header\">ATENCION: El proceso ha sido creado exitosamente con el codigo '$codproceso'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"mensaje\">ATENCION: Los Campos relativos al articulo del proceso son obligatorios!</div>";
    }
 
mysqli_close($conexion);   
	
?>
