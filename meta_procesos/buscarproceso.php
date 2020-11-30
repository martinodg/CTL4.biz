<?php
require_once("../conectar7.php"); 
 
if($_POST) {
	$page = $_POST['page']; // Current page number
	$per_page = $_POST['per_page']; // Articles per page
	if ($page != 1) $start = ($page-1) * $per_page;
	else $start=0;
}
    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $paginainicio=$_GET["paginainicio"];

    $query_nroLineas="SELECT codproceso FROM metaprocesos";
    /*echo $consulta;*/
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';

    $donde="tipoproceso.codtipo=metaprocesos.esbatch AND metaprocesos.codarticulo=articulos.codarticulo AND ";
    if ($parametro1<>""){ $donde=$donde."procesos.".$criterio1."='".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."procesos.".$criterio2."='".$parametro2."' AND ";}
    if ($parametro3<>""){ $donde=$donde."procesos.".$criterio3."='".$parametro3."' AND ";}

    echo '                      <div id="cabeceraResultado" class="header"> 
     					relacion de procesos definidos </div>';
    echo '				<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="8%">CODIGO</td>';
    echo '						<td width="20%">NOMBRE</td>';
    echo '						<td width="18%">ARTICULO</td>';
    echo '						<td width="18%">TIPO DE PROCESO</td>';
    echo '						<td width="18%">ESTADO</td>';
    echo '						<td width="8%">&nbsp;</td>';
    echo '						<td width="8%">&nbsp;</td>';
    echo '					</tr>';
    echo '			</table>';
    echo '			</div>';
    
    
	$consulta="SELECT metaprocesos.codproceso, metaprocesos.nombre, articulos.referencia, tipoproceso.nombre, estado.estado FROM metaprocesos, tipoproceso, articulos,  estado WHERE ".$donde."estado.codestado=metaprocesos.codstatus ORDER BY metaprocesos.nombre LIMIT ".$paginainicio.",10;";
    /*echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
    $nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                             if ($nr_procesos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="8%"><div align="center">'.$row[0].'</td>';
							echo '<td width="20%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="18%"><div align="center">'.$row[2].'</div></td>';
                            echo '<td width="18%"><div align="center">'.$row[3].'</div></td>';
                            echo '<td width="18%"><div align="center">'.$row[4].'</div></td>';

							
                                                        if ($row[7]<>1){
                                                            echo '<td width="8%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" title="Modificar"></a></div></td>';
                                                            echo '<td width="8%"><div align="center">&nbsp;</div></td>';
                                                        }else{
                                                            echo '<td width="8%"><div align="center"><img src="../img/end.svg" width="16" height="16" border="0" title="Visualizar"></a></div></td>';  
                                                            echo '<td width="8%"><div align="center">&nbsp;</div></td>';                                                             
                                                        }
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de proceso: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_procesos--;
                        }
mysqli_close($conexion); 
?>
