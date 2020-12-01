<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 


    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $cantidad=$_GET["cantidadart"];
    $fechai=$_GET["fechailote"];
    $horai=$_GET["horailote"];
    
    If ($codarticulo and $nombrearticulo and $fechai and $horai <>""){
    //code to insert the date on the DB  
   
                //Ask for last codlote and assing new value
        	$consultaprevia = "SELECT max(codlote) as maximo FROM lote";
		$rs_consultaprevia=mysqli_query($conexion,$consultaprevia);
		$codlote=mysqli_result($rs_consultaprevia,0,"maximo");
		if ($codlote=="") { $codlote=0; }
		$codlote++;
                
                //insert in DB
                $query_operacion="INSERT INTO lote (codlote, codarticulo, cantidad, fechai, horai, codstatus, borrado) VALUES ('$codlote', '$codarticulo', '$cantidad', '$fechai', '$horai', '0', '0')";				
		/*echo $query_operacion;*/

                $rs_operacion=mysqli_query($conexion,$query_operacion);
		
	/*	$codlote=mysqli_insert_id($conexion); */
                
                
                
        echo "<div class=\"header\">ATENCION: El lote ha sido creado exitosamente con el codigo '$codlote'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"mensaje\">ATENCION: Los Campos relativos al articulo del lote son obligatorios!</div>";
    }
 
mysqli_close($conexion);   
	
?>
