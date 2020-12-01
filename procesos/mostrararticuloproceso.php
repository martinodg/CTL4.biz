<?php
require_once("../conectar7.php"); 


    $codproceso=$_GET["codproc"];
   /* echo "<div class=\"header\">ATENCION: El meta-proceso pasado al php es: '$codmproceso'!!</div>";*/
    $donde="articulos.codarticulo=proclinea.codarticulo AND ";
    if ($codproceso<>""){ $donde=$donde."proclinea.codproceso=".$codproceso." AND ";}
    

    
	$consulta="SELECT proclinea.codlinea, articulos.referencia, proclinea.cantidad, unidadesmedidas.nombre FROM proclinea, articulos, unidadesmedidas WHERE ".$donde."proclinea.codarticulo=articulos.codarticulo AND unidadesmedidas.codunidadmedida=proclinea.codunidadmedida";
   //echo $consulta; 
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
        echo ' <div id="cabeceraResultado" class="header">Materias primas del meta-proceso </div>';
					
			echo '	<div id="frmResultado">';
			echo '	<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
			echo '			<tr class="cabeceraTabla">';
			echo '				<td width="15%"> Materia Prima # </td>';
			echo '				<td width="45%">Nombre de la Materia Prima</td>';
                        echo '                                <td width="25%">Cantidad</td>';
			echo '				<td width="15%">Modificar</td>';
							
			echo '			</tr>';
			echo '	</table> ';     
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="15%" align="center">'.$row[0].'</td>';
							echo '<td width="45%"><div align="center">'.$row[1].'</div></td>';
                            echo '<td width="25%"><div align="center"><input id="cantidad'.$row[0].'" type="text" class="cajaPequena" NAME="cantidad'.$row[0].'" align="center" value="'.$row[2].'" maxlength="15">';
                            echo ' '.$row[3].'</div></td>';
                            echo '<td width="15%"><div align="center"><a href="#"><img src="../img/validacion.svg" width="16" height="16" border="0" onClick="validarlinea(&apos;'.$codproceso.'&apos;,&apos;'.$row[0].'&apos;,&apos;'.$row[2].'&apos;)"></a>
                            <a href="#"><img src="../img/borrar.svg" width="16" height="16" border="0"  onClick="borrarlineap(&apos;'.$codproceso.'&apos;,&apos;'.$row[0].'&apos;)"></a>
                            </div></td>';
							
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_lotes--;
                        }
	
?>
