<?php
require_once("../conectar7.php"); 


    $lote=$_GET["lote"];
    
    $consulta="SELECT lote.codlote, articulos.referencia, lote.cantidad, lote.fechai, lote.horai, lote.codstatus, lote.codarticulo FROM lote, articulos WHERE lote.codlote =".$lote." AND lote.codarticulo=articulos.codarticulo AND lote.codstatus!=1 AND lote.borrado=0;";
  /*  echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
                 while ($nr_lotes > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codlote']= $row[0];
                                    $data['articulo']= $row[1];
                                    $data['cantidad']= $row[2];
                                    $data['fechai']= $row[3];
                                    $data['horai']= $row[4];
                                    $data['status']= $row[5];
                                    $data['codarticulo']= $row[6];
                                    echo json_encode($data);
                              
                        $nr_lotes--;
                        }
	
?>
