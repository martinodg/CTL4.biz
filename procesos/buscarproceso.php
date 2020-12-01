<?php
require_once("../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $paginainicio=$_GET["paginainicio"];

    $query_nroLineas="SELECT codproceso FROM procesos";
    /*echo $consulta;*/
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';

    $donde="procesos.codmproceso=metaprocesos.codproceso AND unidadesmedidas.codunidadmedida=procesos.codunidadmedida AND procesos.codstatus=estado.codestado AND estaciones.codestacion=procesos.codestacion AND trabajadores.codtrabajador=procesos.codtrabajador AND ";
    if ($parametro1<>""){ $donde=$donde."procesos.".$criterio1."='".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."procesos.".$criterio2."='".$parametro2."' AND ";}
    if ($parametro3<>""){ $donde=$donde."procesos.".$criterio3."='".$parametro3."' AND ";}
   
    $consulta="SELECT procesos.codproceso, procesos.codmproceso, metaprocesos.nombre, procesos.cantidad, unidadesmedidas.nombre, procesos.fechai, procesos.horai, procesos.fechaf, procesos.horaf, estado.estado, estaciones.nombre, trabajadores.nombre, procesos.codstatus FROM procesos, estado, metaprocesos, unidadesmedidas, estaciones, trabajadores WHERE ".$donde."procesos.borrado=0 ORDER BY metaprocesos.nombre LIMIT ".$paginainicio.",10;";
    //echo $consulta;
        
    echo '      <div id="cabeceraResultado" class="header">relacion de procesos </div>';
    echo '		<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="5%">CODIGO</td>';
    echo '						<td width="24%">NOMBRE DEL PROCESO</td>';
    echo '						<td width="5%">CANTIDAD</td>';
    echo '						<td width="5%">UN. DE MEDIDA</td>';
    echo '						<td width="5%">FECHA DE INICIO</td>';
    echo '						<td width="5%">HORA DE INICIO</td>';
    echo '                      <td width="8%">ESTACION</td>';
    echo '                      <td width="20%">TRABAJADOR</td>';
    echo '                      <td width="5%">FECHA DE FIN</td>';
    echo '						<td width="5%">HORA DE FIN</td>';
    echo '						<td width="8%">ESTADO</td>';
    echo '						<td width="5%">MODIFICAR</td>';
    echo '					</tr>';
    echo '			</table>';
    echo '		</div>';
    
    
	
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_procesos= mysqli_num_rows($rs_tabla);
            while ($nr_procesos > 0) {
                             if ($nr_procesos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                                echo '<tr class="'.$fondolinea.'">';
							        echo '<td width="5%"><div align="center">'.$row[0].'</td>';
							        echo '<td width="24%"><div align="center">'.$row[2].'</div></td>';
							        echo '<td width="5%"><div align="center">'.$row[3].'</div></td>';
							        echo '<td width="5%"><div align="center">'.$row[4].'</div></td>';
							        echo '<td width="5%"><div align="center">'.$row[5].'</div></td>';
                                    echo '<td width="5%"><div align="center">'.$row[6].'</div></td>';
                                    echo '<td width="8%"><div align="center">'.$row[10].'</div></td>';
                                    echo '<td width="20%"><div align="center">'.$row[11].'</div></td>';
                                    echo '<td width="5%"><div align="center">'.$row[7].'</div></td>';
                                    echo '<td width="5%"><div align="center">'.$row[8].'</div></td>';
                                    echo '<td width="8%"><div align="center">'.$row[9].'</div></td>';

                                    if ($row[12]<>2){
                                            echo '<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" title="Modificar"></a></div></td>';                 
                                    }else{
                                        echo '<td width="5%"><div align="center"><img src="../img/end.svg" width="16" height="16" border="0" title="Visualizar"></a></div></td>';                                                                     
                                    }
                                echo '</tr>';
                        echo '</table>';
            $nr_procesos--;
                        }
	
?>
