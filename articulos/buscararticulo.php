<?php
require_once("../conectar7.php"); 


    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $codfamilia=$_GET["codfamilia"];
    $destino=$_GET["destino"];
    $donde="articulos.codfamilia=familias.codfamilia AND ";
    if ($codfamilia<>""){ $donde=$donde."articulos.codfamilia=".$codfamilia." AND ";}
    if ($codarticulo<>""){ $donde=$donde."articulos.codarticulo=".$codarticulo." AND ";}
    if ($nombrearticulo<>""){ $donde=$donde."articulos.referencia LIKE '".$nombrearticulo."%' AND ";}
    

    
	$consulta="SELECT articulos.codarticulo, familias.nombre, articulos.referencia, articulos.descripcion, articulos.stock FROM articulos, familias WHERE ".$donde."articulos.borrado=0 ORDER BY articulos.descripcion;";
  /* echo $consulta; */
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
        echo ' <div id="cabeceraResultado" class="header">Seleccionar Articulo</div>';
					
			echo '	<div id="frmResultado">';
			echo '	<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
			echo '			<tr class="cabeceraTabla">';
			echo '				<td width="16%">CODIGO</td>';
			echo '				<td width="18%">Tipo</td>';
                        echo '                                <td width="16%">Nombre</td>';
                        echo '                               <td width="16%">Descripcion</td>';
                         echo '                               <td width="16%">Stock</td>';
			echo '				<td width="15%">Selecciona</td>';
							
			echo '			</tr>';
			echo '	</table> ';     
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="16%" align="center">'.$row[0].'</td>';
							echo '<td width="18%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="16%"><div align="center">'.$row[2].'</div></td>';
							echo '<td width="16%"><div align="center">'.$row[3].'</div></td>';
							echo '<td width="16%"><div align="center">'.$row[4].'</div></td>';
							echo '<td width="15%"><div align="center"><a href="#"><img src="../img/validacion.svg" width="16" height="16" border="0"  onClick="validararticulo(' .$row[0]. ',&apos;' .$row[2]. '&apos;,&apos;'.$destino.'&apos;)"></a></div></td>';
							
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_lotes--;
                        }
	
?>
