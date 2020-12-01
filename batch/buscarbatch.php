<?php
require_once("../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $paginainicio=$_GET["paginainicio"];

    $query_nroLineas="SELECT codbatch FROM batch";
    /*echo $consulta;*/
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';


    $donde="batch.codarticulo=articulos.codarticulo AND batch.codstatus=estado.codestado AND ";
    if ($parametro1<>""){ $donde=$donde."batch.".$criterio1."='".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."batch.".$criterio2."='".$parametro2."' AND ";}
    if ($parametro3<>""){ $donde=$donde."batch.".$criterio3."='".$parametro3."' AND ";}

    echo '                      <div id="cabeceraResultado" class="header"> 
     					relacion de batchS </div>';
    echo '				<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="8%">CODIGO</td>';
    echo '						<td width="38%">ARTICULO</td>';
    echo '						<td width="6%">CANTIDAD</td>';
    echo '						<td width="6%">FECHA DE INICIO</td>';
    echo '						<td width="6%">HORA DE INICIO</td>';
    echo '                                                <td width="6%">FECHA DE FIN</td>';
    echo '						<td width="6%">HORA DE FIN</td>';
    echo '                                               <td width="6%">ESTADO</td>';
    echo '						<td width="6%">&nbsp;</td>';
    echo '						<td width="5%">&nbsp;</td>';
    echo '					</tr>';
    echo '			</table>';
    echo '			</div>';
    
    
	$consulta="SELECT batch.codbatch, articulos.referencia, batch.cantidad, batch.fechai, batch.horai, batch.fechaf, batch.horaf, batch.codstatus, estado.estado FROM batch, articulos,estado WHERE ".$donde."batch.borrado=0 ORDER BY batch.codbatch LIMIT ".$paginainicio.",10;";
    //echo $consulta;
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_batchs= mysqli_num_rows($rs_tabla);
                 while ($nr_batchs > 0) {
                             if ($nr_batchs % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="8%"><div align="center">'.$row[0].'</td>';
							echo '<td width="38%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[2].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[3].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[4].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[5].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[6].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[8].'</div></td>';
                                                        if ($row[7]<>1){
                                                            echo '<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" title="Modificar"></a></div></td>';
                                                            echo '<td width="5%"><div align="center">&nbsp;</div></td>';
                                                        }else{
                                                            echo '<td width="5%"><div align="center"><img src="../img/end.svg" width="16" height="16" border="0" title="Visualizar"></a></div></td>';  
                                                            echo '<td width="5%"><div align="center">&nbsp;</div></td>';                                                             
                                                        }
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de batch: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_batchs--;
                        }
	
?>
