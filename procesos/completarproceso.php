<?php
require_once("../conectar7.php"); 


    $codproceso=$_GET["codproceso"];
    $codmproceso=$_GET["codmproceso"];
    $bolasoc=$_GET["bolasoc"];

    //add batch or lote number associated with the process
    $query_completarproceso="UPDATE procesos SET bolasoc='$bolasoc' WHERE codproceso='$codproceso'";
    $rs_completarproceso=mysqli_query($conexion,$query_completarproceso);

   /* echo "<div class=\"header\">ATENCION: El meta-proceso pasado al php es: '$codmproceso'!!</div>";*/
    $donde="articulos.codarticulo=metaprocesoslinea.codarticulo AND ";
    if ($codmproceso<>""){ $donde=$donde."metaprocesos.codproceso=".$codmproceso." AND ";}
    

    
	$consulta="SELECT metaprocesoslinea.codarticulo, articulos.referencia, articulos.stock, metaprocesoslinea.cantidad, unidadesmedidas.nombre, metaprocesoslinea.codrecord FROM metaprocesoslinea, articulos, metaprocesos, unidadesmedidas WHERE ".$donde."metaprocesos.codproceso=metaprocesoslinea.codproceso AND unidadesmedidas.codunidadmedida=metaprocesoslinea.codunidadmedida";
    //echo $consulta; 
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
        echo ' <div id="cabeceraResultado" class="header">Articulo del lote </div>';
					
			echo '	<div id="frmResultado">';
			echo '	<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
			echo '			<tr class="cabeceraTabla">';
                        echo '                               <td width="15%">Codigo del Articulo</td>';
                         echo '                               <td width="35%">Nombre del Articulo</td>';
                         echo '                               <td width="18%">Stock</td>';
                         echo '                               <td width="18%">Cantidad</td>';
			echo '				<td width="14%">Validar</td>';
							
			echo '			</tr>';
            echo '	</table> ';    
            $totaldearticulos=$nr_lotes; 
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="15%" align="center">'.$row[0].'</td>';
							echo '<td width="35%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="18%"><div align="center">'.$row[2].'</div></td>';
                            echo '<td width="18%"><div align="center"><input id="cantidada'.$row[5].'" type="text" class="cajaPequena" NAME="cantidada'.$row[5].'" align="center" value="'.$row[3].'" maxlength="15">';
                            echo ' '.$row[4].'</div></td>';
                            echo '<td width="14%"><div align="center"><a href="#"><img id="validacion" src="../img/validacion.svg" width="16" height="16" border="0"  onClick="validararticuloproceso(&apos;' .$row[0]. '&apos;,&apos;' .$row[3]. '&apos;,&apos;' .$row[5]. '&apos;)"></a></div></td>';
							
                              echo '</tr>';
                        echo '</table>';
                       
                            $nr_lotes--;
                        }

    $consulta_outcome="SELECT metaprocesos.cantidad, unidadesmedidas.nombre, articulos.referencia, unidadesmedidas.codunidadmedida FROM metaprocesos, unidadesmedidas, articulos WHERE metaprocesos.codunidadmedida=unidadesmedidas.codunidadmedida AND metaprocesos.codproceso=$codmproceso AND metaprocesos.codarticulo=articulos.codarticulo;";
    //echo $consulta_outcome;
    $rs_consulta_outcome = mysqli_query($conexion,$consulta_outcome);               
    $row2 = mysqli_fetch_row($rs_consulta_outcome);
        
                        
    
    
                        echo '<div id="botonBusqueda">';
                        echo '<div align="left"><h2><span class="paginar">Ajuste la cantidad final de '.$row2[2].' producida a un total de: </span> <input id="cantidadproceso" type="text" class="cajaPequena" NAME="cantidadproceso"  value=" '.$row2[0].' " maxlength="15"><span class="paginar"></span><span class="paginar" id="umcantfinal"> '.$row2[1].' </span></H2></div>';
                        echo '<button type="button" id="btnfin" onClick="finalizar('.$codproceso.','.$codmproceso.',&apos;'.$row2[3].'&apos;)" onMouseOver="style.cursor=cursor"> <img src="../img/end.svg" alt="Finalizar" /> <span>Finalizar</span> </button>';
                        echo '</div>';
?>
