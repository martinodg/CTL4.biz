<?php
include ("../../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $tipoBusqueda=$_GET["tipoBusqueda"];
    
    

    $donde="";
    if ($parametro1<>""){ $donde=$donde."subresourcesToRolesTable.".$criterio1." = '".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."rolesTable.".$criterio2." LIKE '".$parametro2."%' AND ";}
    if ($parametro3<>""){ $donde=$donde."rolesTable.".$criterio3." LIKE '".$parametro3."%' AND ";}
    $consulta="SELECT resourcesTable.id_resource , resourcesTable.resourceName FROM resourcesTable;";
    //SELECT rolesToUsersTable.id_role, internalUsersTable.id_intUser, rolesTable.roleName FROM internalUsersTable, rolesTable, rolesToUsersTable WHERE internalUsersTable.id_intUser='2' AND rolesToUsersTable.id_role=rolesTable.id_role 
    //ORDER BY internalUsersTable.intUserName LIMIT ".$paginainicio.",10
    //echo $consulta;
    //$donde2="";
    //if ($parametro1<>""){ $donde2=$donde2."internalUsersTable.".$criterio1." <> '".$parametro1."' AND ";}
    //echo $consulta2;
    
    
    
    $rs_tabla = mysqli_query($conexion,$consulta);
    $nr_recursos= mysqli_num_rows($rs_tabla);
    
    if ($tipoBusqueda=='listar') {
        echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';
     
        echo '<div id="cabeceraResultado" class="header" class="d-table">Recursos Asignados al Role </div>';
        echo '		<div id="frmResultado">';
        echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
        echo '              <thead>';        
        echo '					<tr class="ul-cabeceraTabla">';
        echo '						<th>NOMBRE DEL RECURSO</th>';
        echo '						<th>SELECCIONAR</th>';
        echo '					</tr>';
        echo '              </thead>';
       



        while ($nr_recursos > 0) {
            if ($nr_recursos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
            $row = mysqli_fetch_row($rs_tabla);
            echo '<tbody>';
            echo '<tr class="resCategoria">';
            echo '<td>'.$row[1].'</td>';
            $consultaCheckRecurso="SELECT resourcesToRolesTable.borrado FROM resourcesToRolesTable WHERE resourcesToRolesTable.id_role=$parametro1 AND resourcesToRolesTable.id_resource=$row[0];"; 
            $checkresult=mysqli_query($conexion,$consultaCheckRecurso);
            $checkrow=mysqli_fetch_row($checkresult);
            $ischeck=$checkrow[0];
            echo " recurso: ";
            echo $row[0];
            Echo " role: ";
            echo $parametro1;
            echo " Check: ";
            echo $ischeck;
            if ($ischeck=='1') { $check="";
                                $hiden="hiden";
            } else {
                $check="checked";
                $hiden="";
            }
            echo $check;
            echo '<td><label class="switch"> <input type="checkbox" id="SWrecurso'.$row[0].'" name="'.$row[0].'" onclick="ABReso('.$row[0].')" '.$check.'> <span class="slider round"></span> </label></td>';
            echo '</tr>';
            
            $consulta2="SELECT subResourceTable.id_sresource as id, subResourceTable.subResourceName as name FROM subResourceTable WHERE subResourceTable.id_resource=$row[0];";  
            $rs_tabla2 = mysqli_query($conexion,$consulta2);
            $nr_recursos2= mysqli_num_rows($rs_tabla2);
            while ($nr_recursos2 > 0) {
                if ($nr_recursos2 % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                $row2 = mysqli_fetch_row($rs_tabla2);
              
              
                echo '<tr class="hrow'.$row[0].' '.$fondolinea.' '.$hiden.'" >';
                echo '<td>'.$row2[1].'</td>';
                echo '<td><label class="switch" ><input type="checkbox" id="SWSubRecurso'.$row2[0].'" name="'.$row2[0].'" onclick="ABSubReso('.$row2[0].')" > <span class="slider round"></span> </label></td>';                
                echo '</tr>';
                
        
                
            
                /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                $nr_recursos2--;
        
        
        
            }
            $nr_recursos--;
            echo '</tr>';
       }
     
    $rs_tabla2 = mysqli_query($conexion,$consulta2);
    $nr_recursos2= mysqli_num_rows($rs_tabla2);
  

    
    }
    if ($tipoBusqueda=='modificar') {
        while ($nr_recursos > 0) {
            $row = mysqli_fetch_row($rs_tabla);
                    $data['codusuario']= $row[0];
                    $data['nombre']= $row[1];
                    $data['mail']= $row[2];
                    $data['estado']= $row[3];
                    $data['clave']= $row[4];
                    echo json_encode($data);
              
        $nr_recursos--;
        }
    }
    
	
?>
