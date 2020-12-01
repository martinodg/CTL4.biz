<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 

    $codproceso=$_GET["codproceso"];
    $codigomproceso=$_GET["codigomproceso"];
    $fechai=$_GET["fechaiproceso"];
    $horai=$_GET["horaiproceso"];
    //echo "$codigomproceso";
    
    //code to insert the date on the DB  
   
                //Ask for last codproceso and assing new value
        	
                
                //insert in DB
                $query_iniciarproceso="UPDATE procesos SET codmproceso='$codigomproceso', fechai='$fechai', horai='$horai', codstatus='1' WHERE codproceso='$codproceso';";
		/*echo $query_operacion;*/

                $rs_iniciarproceso=mysqli_query($conexion,$query_iniciarproceso);
                $query_buscaresbatch="SELECT esbatch from metaprocesos where codproceso='$codigomproceso';";
                $rs_buscaresbatch=mysqli_query($conexion,$query_buscaresbatch);
                $batcholote = mysqli_result($rs_buscaresbatch,0,"esbatch");
                //echo "$batcholote";
                if ($batcholote=='1'){
                        $tabla="batch";
                        $cod="codbatch";
                        $elemento="batch";
                }else{
                        $tabla="lote";
                        $cod="codlote";
                        $elemento="lote";

                }
                //echo "$tabla";
                //echo "$cod";
                //echo "$elemento";
                $query_batcholoteactivos="SELECT $tabla.$cod, articulos.referencia, $tabla.cantidad, $tabla.fechai, $tabla.horai from $tabla, articulos WHERE articulos.codarticulo=$tabla.codarticulo and $tabla.borrado='0' and $tabla.codstatus!='1';";
                //echo "<br>";
                //echo "$query_batcholoteactivos";
                $rs_batcholoteactivos=mysqli_query($conexion,$query_batcholoteactivos);
                $nr_batcholoteactivos=mysqli_num_rows($rs_batcholoteactivos);
                echo '                      <div id="cabeceraResultado" class="header"> Seleccionar un '.$elemento.' de la lista </div>';
echo '				<div id="frmResultado">';
echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
echo '					<tr class="cabeceraTabla">';
echo '						<td width="8%">CODIGO de Proceso</td>';
echo '						<td width="38%">NOMBRE de Articulo</td>';
echo '						<td width="38%">CANTIDAD</td>';
echo '						<td width="6%">FECHA DE INICIO</td>';
echo '						<td width="6%">HORA DE INICIO</td>';
echo '						<td width="5%">&nbsp;</td>';
echo '					</tr>';
echo '			</table>';
echo '			</div>';
while ($nr_batcholoteactivos > 0) {
        if ($nr_batcholoteactivos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
       $row = mysqli_fetch_row($rs_batcholoteactivos);
   echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
         echo '<tr class="'.$fondolinea.'">';
                                   echo '<td width="8%"><div align="center">'.$row[0].'</td>';
                                   echo '<td width="38%"><div align="center">'.$row[1].'</div></td>';
                                   echo '<td width="6%"><div align="center">'.$row[2].'</div></td>';
                                   echo '<td width="6%"><div align="center">'.$row[3].'</div></td>';
                                   echo '<td width="6%"><div align="center">'.$row[4].'</div></td>';
                                   echo '<td width="5%"><div align="center"><input type="radio" id="codbolasoc" name="codbolasoc" value="'.$row[0].'" /></div></td>';
         echo '</tr>';
   echo '</table>';
  
      /* echo "Codigo de proceso: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
  /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
      $nr_batcholoteactivos--;
   }
   echo ' <div id="botonBusqueda">';
   echo '<button type="button" id="btnnuevo" onMouseOver="style.cursor=cursor"> <img src="../img/new'.$elemento.'.svg" alt="nuevo'.$elemento.'" /> <span>Nuevo '.$elemento.'</span> </button>';
   echo '<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="nuevolote" /> <span>Aceptar</span> </button>';
   echo '</div>';    
   echo "<div class=\"header\">ATENCION: El proceso ha sido inicializado exitosamente con el codigo '$codproceso'!!</div>";
        echo mysqli_error($conexion) ;
    
 
mysqli_close($conexion);   
	
?>