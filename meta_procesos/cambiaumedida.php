<?php
require_once("../conectar7.php"); 


    $metaproceso=$_GET["metaproceso"];
    $nlinea=$_GET["nlinea"];
    $unmedida=$_GET["unmedida"];


    $query_unidadesmedidas="SELECT codunidadmedida, nombre FROM unidadesmedidas ORDER BY codunidadmedida ASC";
    $res_unidadesmedidas=mysqli_query($conexion,$query_unidadesmedidas);
    $nr_unidadesmedidas= mysqli_num_rows($res_unidadesmedidas);
    echo '<select id="umselect" class="cboUnidadmedida">';
     while ($nr_unidadesmedidas > 0) {
                $row = mysqli_fetch_row($res_unidadesmedidas);
                if ($row[0]==$unmedida){
                        echo '<option value="'.$row[0].'" selected >'.$row[1].'</option>';
                }else{
                        echo '<option value="'.$row[0].'">'.$row[1].'</option>';

                }
           /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
           $nr_unidadesmedidas--;
            }
echo '</select> ';
echo '<button type="button" id="btnaceptarun" onMouseOver="style.cursor=cursor" onClick="aceptarcumedida('.$metaproceso.', '.$nlinea.')"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>';

?>
