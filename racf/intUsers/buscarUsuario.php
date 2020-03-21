<?php
include ("../../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $tipoBusqueda=$_GET["tipoBusqueda"];
    $paginainicio=$_GET["paginainicio"];
    
    
    $query_nroLineas="SELECT id_intUser FROM internalUsersTable";
    //echo $query_nroLineas;
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);


    $donde="internalUsersTable.codstatus=estado.codestado AND ";
    if ($parametro1<>""){ $donde=$donde."internalUsersTable.".$criterio1." LIKE '".$parametro1."%' AND ";}
    if ($parametro2<>""){ $donde=$donde."internalUsersTable.".$criterio2." LIKE '".$parametro2."%' AND ";}
    if ($parametro3<>""){ $donde=$donde."internalUsersTable.".$criterio3." LIKE '".$parametro3."%' AND ";}
    $consulta="SELECT internalUsersTable.id_intUser, internalUsersTable.intUserName, internalUsersTable.intUserMail, estado.estado, internalUsersTable.intUserPass, internalUsersTable.codstatus FROM internalUsersTable, estado WHERE ".$donde."internalUsersTable.borrado=0 ORDER BY internalUsersTable.intUserName LIMIT ".$paginainicio.",10;";
    //echo $consulta;
        
	$rs_tabla = mysqli_query($conexion,$consulta);
    $nr_usuarios= mysqli_num_rows($rs_tabla);
    
    if ($tipoBusqueda=='listar') {
        echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';

        echo '                      <div id="cabeceraResultado" class="header"> 
        Listado de Usuarios </div>';
        echo '				<div id="frmResultado">';
        echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
        echo '					<tr class="cabeceraTabla">';
        echo '						<td width="40%">NOMBRE DE USUARIO</td>';
        echo '						<td width="40%">E-MAIL DEL USUARIO</td>';
        echo '						<td width="10%">ESTADO</td>';
        echo '						<td width="10%">MODIFICAR</td>';				
        echo '					</tr>';
        echo '			</table>';
        echo '			</div>';



        while ($nr_usuarios > 0) {
            if ($nr_usuarios % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
            $row = mysqli_fetch_row($rs_tabla);
            echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
            echo '<tr class="'.$fondolinea.'">';
            echo '<td width="40%"><div align="center">'.$row[1].'</td>';
            echo '<td width="40%"><div align="center">'.$row[2].'</div></td>';
            echo '<td width="10%"><div align="center">'.$row[3].'</div></td>';
            if ($row[3]<>1){
                echo '<td width="10%"><div align="center"><a href="#"><img src="../../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" title="Modificar"></a></div></td>';
            }else{
                echo '<td width="10%"><div align="center"><img src="../../img/end.svg" width="16" height="16" border="0" title="Visualizar"></a></div></td>';  
            }
            echo '</tr>';
            echo '</table>';
            /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
            /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
            $nr_usuarios--;
       }
    }
    if ($tipoBusqueda=='modificar') {
        while ($nr_usuarios > 0) {
            $row = mysqli_fetch_row($rs_tabla);
                    $data['codusuario']= $row[0];
                    $data['nombre']= $row[1];
                    $data['mail']= $row[2];
                    $data['estado']= $row[3];
                    $data['codestado']= $row[5];
                    $data['clave']= $row[4];
                    echo json_encode($data);
              
        $nr_usuarios--;
        }
    }
    
	
?>
