<?php
include ("../../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $tipoBusqueda=$_GET["tipoBusqueda"];
    
    

    $donde="";
    if ($parametro1<>""){ $donde=$donde."subresourcesToRolesTable.".$criterio1." = '".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."rolesTable.".$criterio2." LIKE '".$parametro2."%' AND ";}
    if ($parametro3<>""){ $donde=$donde."rolesTable.".$criterio3." LIKE '".$parametro3."%' AND ";}
    $consulta="SELECT resourcesTable.id_resource , resourcesTable.resourceName 	FROM resourcesTable;";
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
        echo '			<div class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
        echo '					<ul class="ul-cabeceraTabla">';
        echo '						<li><div align="center">NOMBRE DEL RECURSO</div></li>';
        echo '						<li><div align="center">SELECCIONAR</div></li>';
        echo '					</ul>';
        echo '			</div>';
        echo '			</div>';



        while ($nr_recursos > 0) {
            if ($nr_recursos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
            $row = mysqli_fetch_row($rs_tabla);
            echo '<div class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
            echo '<ul>';
            echo '<li><span>'.$row[1].'</span></li>';
            echo '<li><label class="switch"> <input type="checkbox" id="rActivo" name="rActivo" > <span class="slider round"></span> </label></li>';
            echo '</ul>';
            /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
            /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
            $consulta2="SELECT subResourceTable.id_sresource as id, subResourceTable.subResourceName as name FROM subResourceTable WHERE subResourceTable.id_resource=$row[0];";  
            $rs_tabla2 = mysqli_query($conexion,$consulta2);
            $nr_recursos2= mysqli_num_rows($rs_tabla2);
            while ($nr_recursos2 > 0) {
                if ($nr_recursos2 % 2) { $fondolinea="itemParTablaAAgregar"; } else { $fondolinea="itemImparTablaAAgregar"; }
                $row2 = mysqli_fetch_row($rs_tabla2);
              
                echo '<div class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=1 ID="Table1">';
                echo '<ul>';
                echo '<li><span>'.$row2[1].'</span></li>';
                echo '<li><label class="switch"><input type="checkbox" id="rActivo" name="rActivo" > <span class="slider round"></span> </label></li>';
                echo '</ul>';
                echo '</div>';
                /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                $nr_recursos2--;
        
        
        
            }
            $nr_recursos--;
       }

    $rs_tabla2 = mysqli_query($conexion,$consulta2);
    $nr_recursos2= mysqli_num_rows($rs_tabla2);
    echo '                      <div id="cabeceraResultado" class="header"> 
    Recursos disponibiles</div>';
    echo '				<div id="frmResultado">';
    echo '			<div class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<ul class="cabeceraTabla">';
    echo '						<li width="20%"><div align="center">CODIGO DEL RECURSO</div></li>';
    echo '						<li width="60%"><div align="center">NOMBRE DEL RECURSO</div></li>';
    echo '						<li width="20%"><div align="center">AGREGAR A LA LISTA</div></li>';
    echo '					</ul>';
    echo '			</div>';
    echo '			</div>';

    
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
